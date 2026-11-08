<?php
/** Standalone ZIP asset checks; no WHMCS database or installation is needed. */
error_reporting(E_ALL & ~E_DEPRECATED);
if (!class_exists('ZipArchive')) throw new RuntimeException('PHP ZIP extension is required for this test');

$module = dirname(__DIR__) . '/';
$root = sys_get_temp_dir() . '/zmpb-archive-' . bin2hex(random_bytes(6));
mkdir($root . '/assets/generated', 0755, true);
mkdir($root . '/resources', 0755, true);
define('ZM_PB_VER', 'test');
define('ZM_PB_ROOTDIR', $module);
define('ZM_PB_INCDIR', $module . 'inc/');
define('ZM_PB_ALANGDIR', $module . 'admin_lang/');
define('ZM_PB_ASSETSDIR', $root . '/assets/');
define('ZM_PB_RESOURCESDIR', $root . '/resources/');
define('ZM_PB_ASSETSURL', 'https://source.test/assets/');
$availableLanguages = (require $module . 'supported_langs.php') + (require $module . 'disabled_langs.php');
define('ZM_PB_LANGS', ['english' => $availableLanguages['english']]);
$GLOBALS['ZM_PB_ADMINLANG'] = require ZM_PB_ALANGDIR . 'english.php';
require $module . 'lib/transfer.php';

try {
    $importLanguages = new ReflectionMethod(ZM_PB_Transfer::class, 'importLanguages');
    $importLanguages->setAccessible(true);
    $languages = $importLanguages->invoke(null);
    $normalize = new ReflectionMethod(ZM_PB_Transfer::class, 'normalizeImportLanguages');
    $normalize->setAccessible(true);
    if (!isset($languages['albanian']) || isset(ZM_PB_LANGS['albanian'])
        || $normalize->invoke(null, ['english', 'albanian', 'unknown'], $languages) !== ['english', 'albanian'])
        throw new RuntimeException('Import did not preserve a known disabled language');
    try {
        zm_pb_save_grapes_content(1, 'albanian', '');
        throw new RuntimeException('Page editing accepted a disabled language');
    } catch (InvalidArgumentException $error) {
        if (zm_pb_save_grapes_content(1, 'albanian', '', null, $languages) !== '') throw $error;
    }
    if (function_exists('mb_strlen')) {
        require $module . 'inc/menu_manager.php';
        $item = [['key' => 'test', 'type' => 'custom', 'label' => 'Test', 'labels' => ['albanian' => 'Shqip']]];
        try {
            zm_pb_menu_validate_items($item);
            throw new RuntimeException('Menu editing accepted a disabled language');
        } catch (InvalidArgumentException $error) {
            if (!isset(zm_pb_menu_validate_items($item, $languages)['test']['labels']['albanian'])) throw $error;
        }
    }
    $filterMenu = new ReflectionMethod(ZM_PB_Transfer::class, 'importMenuItems');
    $filterMenu->setAccessible(true);
    $menuItems = [
        ['id' => 1, 'key' => '1', 'parent' => '', 'type' => 'page', 'page_id' => 1],
        ['id' => 2, 'key' => '2', 'parent' => '', 'type' => 'page', 'page_id' => 99,
            'label' => '', 'url' => 'https://source.test/?m=module&slug=oldlink'],
        ['id' => 3, 'key' => '3', 'parent' => '5', 'type' => 'custom'],
        ['id' => 4, 'key' => '4', 'parent' => '', 'type' => 'custom'],
        ['id' => 5, 'key' => '5', 'parent' => '', 'type' => 'page', 'page_id' => 98, 'url' => ''],
    ];
    $menuWarnings = [];
    $menuArgs = [$menuItems, [1 => ['slug' => 'known', 'auth_type' => 'mixed']], 7, &$menuWarnings];
    $kept = $filterMenu->invokeArgs(null, $menuArgs);
    if (array_column($kept, 'id') !== [1, 2, 4] || count($menuWarnings) !== 3
        || $kept[1]['type'] !== 'custom' || $kept[1]['label'] !== 'oldlink'
        || $kept[1]['url'] !== 'https://source.test/?m=module&slug=oldlink')
        throw new RuntimeException('Custom menu links were lost or unresolvable items were kept');

    $cssName = 'page_1_portuguese-br_styles.css';
    $jsName = 'page_1_portuguese-br_code_example.js';
    $css = str_repeat('a', ZM_PB_Transfer::MAX_BYTES + 1);
    file_put_contents($root . '/assets/generated/' . $cssName, $css);
    file_put_contents($root . '/assets/generated/' . $jsName, 'window.example = true;');
    $content = json_encode(['format' => 'grapesjs', 'html' => '', 'project' => [],
        'cssUrl' => ZM_PB_ASSETSURL . 'generated/' . $cssName,
        'assets' => ['code_example' => ['type' => 'js', 'url' => ZM_PB_ASSETSURL . 'generated/' . $jsName]]], JSON_THROW_ON_ERROR);
    $path = $root . '/export.zip';
    file_put_contents($path, '');
    $zip = new ZipArchive();
    if ($zip->open($path, ZipArchive::OVERWRITE) !== true) throw new RuntimeException('Could not create test archive');
    $method = new ReflectionMethod(ZM_PB_Transfer::class, 'portableContent');
    $method->setAccessible(true);
    $portable = json_decode($method->invoke(null, $content, $zip), true, 512, JSON_THROW_ON_ERROR);
    $method->invoke(null, $content, $zip);
    if (isset($portable['css']) || isset($portable['code'][0]['code']) || $portable['cssFile'] !== 'generated/' . $cssName
        || $portable['code'][0]['file'] !== 'generated/' . $jsName || $zip->numFiles !== 2) throw new RuntimeException('CSS/JS remained embedded or was duplicated');
    $zip->close();
    $zip->open($path);
    if ($zip->getFromName('generated/' . $cssName) !== $css || $zip->getFromName('generated/' . $jsName) !== 'window.example = true;') {
        throw new RuntimeException('Generated CSS/JS was not archived intact');
    }
    $zip->close();

    unlink($root . '/assets/generated/' . $cssName);
    $zip->open($root . '/missing.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
    $zip->addFromString('manifest.json', '{}');
    $warnings = [];
    $args = [$content, $zip, &$warnings];
    $missing = json_decode($method->invokeArgs(null, $args), true, 512, JSON_THROW_ON_ERROR);
    if ($missing['cssFile'] !== null || $missing['css'] !== ''
        || $missing['code'][0]['file'] !== 'generated/' . $jsName
        || ($warnings[$cssName]['reason'] ?? null) !== 'missing')
        throw new RuntimeException('Missing generated CSS was not skipped or reported');
    $zip->close();

    unlink($root . '/assets/generated/' . $jsName);
    $zip->open($root . '/missing-code.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
    $zip->addFromString('manifest.json', '{}');
    $warnings = [];
    $args = [$content, $zip, &$warnings];
    $missing = json_decode($method->invokeArgs(null, $args), true, 512, JSON_THROW_ON_ERROR);
    if (isset($missing['code'][0]['file']) || $missing['code'][0]['code'] !== ''
        || !isset($warnings[$cssName], $warnings[$jsName]))
        throw new RuntimeException('Missing generated CSS/JS left broken archive references');
    $zip->close();

    $zip->open($root . '/unsafe.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
    $zip->addFromString('../escape.php', '<?php');
    $zip->addFromString('manifest.json', '{}');
    $zip->close();
    try {
        ZM_PB_Transfer::importFile($root . '/unsafe.zip', ['pages']);
        throw new RuntimeException('Unsafe ZIP entry was accepted');
    } catch (RuntimeException $error) {
        if ($error->getMessage() !== $GLOBALS['ZM_PB_ADMINLANG']->transfer->errors->invalid_archive) throw $error;
    }
    @ini_set('open_basedir', $root);
    $openExport = new ReflectionMethod(ZM_PB_Transfer::class, 'openExportArchive');
    $openExport->setAccessible(true);
    [$temporary, $exportZip] = $openExport->invoke(null);
    try {
        if (realpath(dirname($temporary)) !== realpath(ZM_PB_RESOURCESDIR)
            || !preg_match('/^\.zmpb-export-[a-f0-9]{32}\.zip$/D', basename($temporary))
            || !$exportZip->addFromString('manifest.json', '{}'))
            throw new RuntimeException('Export did not create a protected archive in resources');
    } finally {
        $exportZip->close();
        if (is_file($temporary)) unlink($temporary);
    }
    echo "PASS transfer ZIP assets, disabled languages, custom menu links and unsafe entries\n";
} finally {
    foreach (glob($root . '/assets/generated/*') ?: [] as $file) unlink($file);
    foreach (glob($root . '/*.zip') ?: [] as $file) unlink($file);
    rmdir($root . '/assets/generated');
    rmdir($root . '/assets');
    rmdir($root . '/resources');
    rmdir($root);
}
