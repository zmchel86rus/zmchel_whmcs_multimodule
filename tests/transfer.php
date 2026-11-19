<?php
/** PHP + SQLite + DOM + fileinfo; never connects to WHMCS or writes to its files. */
error_reporting(E_ALL & ~E_DEPRECATED);
use Illuminate\Database\Capsule\Manager as Capsule;
$module = dirname(__DIR__) . '/';
require dirname(__DIR__, 4) . '/vendor/autoload.php';
$root = sys_get_temp_dir() . '/zmpb-transfer-' . bin2hex(random_bytes(6));
foreach (['inc', 'module-assets/generated', 'assets/zmchel_whmcs_multimodule', 'templates/test', 'resources'] as $dir) mkdir($root . '/' . $dir, 0755, true);
foreach (['transfer.php', 'menu_manager.php', 'sitemap_manager.php', 'redirects_manager.php', 'footer_menu.php'] as $file) copy($module . 'inc/' . $file, $root . '/inc/' . $file);
define('ZM_PB_VER', 'test'); define('ROOTDIR', $root); define('ZM_PB_NAME', 'zmchel_whmcs_multimodule');
define('ZM_PB_ROOTDIR', $module);
define('ZM_PB_INCDIR', $root . '/inc/'); define('ZM_PB_LIBDIR', $module . 'lib/'); define('ZM_PB_ALANGDIR', $module . 'admin_lang/');
define('ZM_PB_ASSETSDIR', $root . '/module-assets/'); define('ZM_PB_FULLHOST', 'https://target.test/');
define('ZM_PB_RESOURCESDIR', $root . '/resources/');
define('ZM_PB_ASSETSURL', ZM_PB_FULLHOST . 'modules/addons/zmchel_whmcs_multimodule/assets/');
define('ZM_PB_MAINSYSTEM_ASSETS_DIR', $root . '/assets/' . ZM_PB_NAME . '/'); define('ZM_PB_MAINSYSTEM_ASSETS_URL', ZM_PB_FULLHOST . 'assets/' . ZM_PB_NAME . '/');
define('ZM_PB_MEDIA_MANAGER_FILE', $module . 'lib/media_manager.php');
$availableLanguages = (require $module . 'supported_langs.php') + (require $module . 'disabled_langs.php');
define('ZM_PB_LANGS', ['english' => $availableLanguages['english']]); define('ZM_PB_DEFLANG', 'english');
$GLOBALS['ZM_PB_ADMINLANG'] = require ZM_PB_ALANGDIR . 'russian.php';
define('ZM_PB_ENABLE_LANG_ROUTE', true); define('ZM_PB_PRETTY_URLS', true); define('ZM_PB_MAINSYSTEM_PRETTY_URLS', true);
define('ZM_PB_ENABLE_PAGE_OVERRIDES', true); define('ZM_PB_ENABLE_REDIRECTS_MANAGER', true); define('ZM_PB_ENABLE_FOOTERMENU', true);
define('ZM_PB_MAINSYSTEM_DEFAULT_PAGES', ['index', 'contact']); define('ZM_PB_ACCEPTED_OVERRIDES', ['full']);
define('ZM_PB_ALLOWED_CONSTS_CHANGE', ['ZM_PB_ENABLE_PAGE_OVERRIDES']);
$GLOBALS['CONFIG']['Template'] = 'test';
file_put_contents($root . '/templates/test/footer.tpl', '<footer></footer>');
file_put_contents(ZM_PB_INCDIR . 'editable_consts.php', "<?php\n### EDITABLE CONSTS ###\nif (!defined('ZM_PB_ENABLE_PAGE_OVERRIDES')) define('ZM_PB_ENABLE_PAGE_OVERRIDES', true);\n### EDITABLE CONSTS ###\n");
file_put_contents(ZM_PB_INCDIR . 'rewrite_rules_custom.php', '<?php return [];');
file_put_contents(ZM_PB_INCDIR . 'rewrite_rules.php', '<?php return [];');
$capsule = new Capsule(); $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']); $capsule->setAsGlobal();
require $module . 'inc/helpers.php';
require $module . 'inc/menu_schema.php';
require $module . 'lib/transfer.php';
function check($ok, $message) { if (!$ok) throw new RuntimeException($message); }
function jsonData($data) { return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR); }
try {
    $fields = [
        'zm_pb_pages' => 'name slug auth_type status type template_file langs created_at updated_at',
        'zm_pb_pages_settings' => 'page_id lang lang_status lang_active settings content created_at updated_at',
        'zm_pb_sitemap' => 'page_id active url changefreq priority sitemap_type created_at updated_at',
        'zm_pb_module_settings' => 'type setting_name setting_storage_type setting_value',
        'zm_pb_redirects' => 'active from to status_code type method conditions created_at updated_at',
        'zm_pb_attachments' => 'name filename mime_type alt title description url sizes created_at updated_at',
    ];
    foreach ($fields as $table => $columns) Capsule::schema()->create($table, function ($t) use ($columns) {
        $t->increments('id'); foreach (explode(' ', $columns) as $column) $t->text($column)->nullable();
    });
    mkdir($root . '/attachments');
    $legacyFile = 'legacy.png';
    $legacyUrl = ZM_PB_FULLHOST . 'attachments/' . $legacyFile;
    $legacyBytes = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+jRZkAAAAASUVORK5CYII=');
    file_put_contents($root . '/attachments/' . $legacyFile, $legacyBytes);
    $legacyId = Capsule::table('zm_pb_attachments')->insertGetId([
        'filename' => $legacyFile, 'name' => 'Legacy image', 'url' => $legacyUrl, 'sizes' => '{}']);
    Capsule::table('zm_pb_pages_settings')->insert(['page_id' => 998, 'content' => '<img src="' . $legacyUrl . '">']);
    Capsule::table('zm_pb_pages_settings')->insert(['page_id' => 999, 'content' => json_encode(['src' => $legacyUrl])]);
    require $module . 'inc/media_storage.php';
    zm_pb_media_migrate_legacy();
    check(is_file(ZM_PB_MAINSYSTEM_ASSETS_DIR . $legacyFile) && is_file($root . '/attachments/' . $legacyFile),
        'Legacy media was not copied safely');
    check(Capsule::table('zm_pb_attachments')->where('id', $legacyId)->value('url') === ZM_PB_MAINSYSTEM_ASSETS_URL . $legacyFile
        && strpos(Capsule::table('zm_pb_pages_settings')->where('page_id', 998)->value('content'), ZM_PB_MAINSYSTEM_ASSETS_URL . $legacyFile) !== false,
        'Legacy media URLs were not updated');
    check(json_decode(Capsule::table('zm_pb_pages_settings')->where('page_id', 999)->value('content'), true)['src'] === ZM_PB_MAINSYSTEM_ASSETS_URL . $legacyFile,
        'Escaped legacy media URLs were not updated');
    check(is_file(ZM_PB_MAINSYSTEM_ASSETS_DIR . '.htaccess') && is_file(ZM_PB_MAINSYSTEM_ASSETS_DIR . 'index.php'),
        'Public media directory protections were not created');
    Capsule::table('zm_pb_attachments')->where('id', $legacyId)->delete();
    Capsule::table('zm_pb_pages_settings')->where('page_id', 998)->delete();
    Capsule::table('zm_pb_pages_settings')->where('page_id', 999)->delete();
    unlink(ZM_PB_MAINSYSTEM_ASSETS_DIR . $legacyFile);
    unlink($root . '/attachments/' . $legacyFile);
    mkdir(ZM_PB_ASSETSDIR . 'media');
    $oldModuleFile = 'legacy-module.png';
    $oldModuleUrl = ZM_PB_ASSETSURL . 'media/' . $oldModuleFile;
    file_put_contents(ZM_PB_ASSETSDIR . 'media/' . $oldModuleFile, $legacyBytes);
    $oldModuleId = Capsule::table('zm_pb_attachments')->insertGetId([
        'filename' => $oldModuleFile, 'name' => 'Module media', 'url' => $oldModuleUrl, 'sizes' => '{}']);
    zm_pb_media_migrate_legacy();
    check(is_file(ZM_PB_MAINSYSTEM_ASSETS_DIR . $oldModuleFile)
        && Capsule::table('zm_pb_attachments')->where('id', $oldModuleId)->value('url') === ZM_PB_MAINSYSTEM_ASSETS_URL . $oldModuleFile,
        'Media in the old module assets directory was not migrated');
    Capsule::table('zm_pb_attachments')->where('id', $oldModuleId)->delete();
    unlink(ZM_PB_MAINSYSTEM_ASSETS_DIR . $oldModuleFile);
    unlink(ZM_PB_ASSETSDIR . 'media/' . $oldModuleFile);
    foreach (zm_pb_menu_table_definitions() as $create) $create();
    $page = ['id' => 3, 'name' => 'Test', 'slug' => 'test', 'auth_type' => 'mixed', 'status' => 'publish', 'type' => 'page', 'langs' => '["english"]'];
    Capsule::table('zm_pb_pages')->insert($page);
    $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+jRZkAAAAASUVORK5CYII=');
    file_put_contents(ZM_PB_MAINSYSTEM_ASSETS_DIR . 'test.png', $png);
    Capsule::table('zm_pb_attachments')->insert(['filename' => 'test.png', 'name' => 'Test image', 'url' => ZM_PB_MAINSYSTEM_ASSETS_URL . 'test.png', 'sizes' => '{}']);
    $content = jsonData(['format' => 'grapesjs', 'html' => '<img src="' . ZM_PB_MAINSYSTEM_ASSETS_URL . 'test.png">',
        'project' => ['pages' => []], 'css' => 'p{color:red}', 'code' => [['id' => 'code_test', 'type' => 'js', 'code' => 'window.test=1;']]]);
    $saved = zm_pb_save_grapes_content(3, 'english', $content);
    Capsule::table('zm_pb_pages_settings')->insert(['page_id' => 3, 'lang' => 'english', 'lang_status' => 'draft', 'lang_active' => 1, 'content' => $saved]);
    Capsule::table('zm_pb_sitemap')->insert(['page_id' => 3, 'active' => 1, 'url' => ZM_PB_FULLHOST . 'test', 'changefreq' => 'daily', 'priority' => '0.7', 'sitemap_type' => 'page']);
    Capsule::table('zm_pb_module_settings')->insert(['setting_name' => 'page_overrides', 'type' => 'required', 'setting_storage_type' => 'json',
        'setting_value' => jsonData(['from' => ['contact'], 'to' => ['test'], 'type' => ['full']])]);
    require ZM_PB_INCDIR . 'menu_manager.php';
    zm_pb_menu_save(['name' => 'Main', 'mode' => 'replace', 'device' => 'mixed', 'active' => 1, 'locations' => ['primary_navbar'],
        'items' => jsonData([['key' => 'root', 'parent' => '', 'type' => 'page', 'page_id' => 3, 'url' => ZM_PB_FULLHOST . 'test'],
            ['key' => 'child', 'parent' => 'root', 'type' => 'custom', 'label' => 'External', 'url' => 'https://external.test/']])]);
    Capsule::table('zm_pb_redirects')->insert(['from' => '/old', 'to' => ZM_PB_FULLHOST . 'test/', 'active' => 1, 'status_code' => 301, 'type' => 'system', 'method' => 'GET', 'conditions' => jsonData(['page_id' => 3, 'language' => 'english'])]);
    $sections = ['pages', 'menus', 'settings', 'redirects', 'rewrites', 'media'];
    if (class_exists('ZipArchive')) {
        $cssPath = ZM_PB_ASSETSDIR . 'generated/page_3_english_styles.css';
        unlink($cssPath);
        $missingWarnings = [];
        $missingZip = ZM_PB_Transfer::exportArchive(['pages'], $missingWarnings);
        $missingArchive = new ZipArchive();
        check($missingArchive->open($missingZip) === true, 'ZIP with missing CSS could not be opened');
        $missingManifest = json_decode($missingArchive->getFromName('manifest.json'), true, 512, JSON_THROW_ON_ERROR);
        $missingContent = json_decode($missingManifest['sections']['pages'][0]['translations'][0]['content'], true, 512, JSON_THROW_ON_ERROR);
        check(($missingWarnings['page_3_english_styles.css']['reason'] ?? null) === 'missing'
            && ($missingManifest['warnings'][0]['file'] ?? null) === 'page_3_english_styles.css'
            && $missingContent['cssFile'] === null && $missingContent['css'] === ''
            && $missingArchive->getFromName($missingContent['code'][0]['file']) === 'window.test=1;',
            'Missing CSS aborted export or left a broken archive reference');
        $missingArchive->close();
        unlink($missingZip);
        file_put_contents($cssPath, 'p{color:red}');
    }
    $archive = ZM_PB_Transfer::export($sections);
    if (class_exists('ZipArchive')) {
        $zipPath = ZM_PB_Transfer::exportArchive($sections);
        $zip = new ZipArchive();
        check($zip->open($zipPath) === true, 'ZIP export could not be opened');
        $manifest = json_decode($zip->getFromName('manifest.json'), true, 512, JSON_THROW_ON_ERROR);
        $zipContent = json_decode($manifest['sections']['pages'][0]['translations'][0]['content'], true, 512, JSON_THROW_ON_ERROR);
        check($manifest['version'] === 2 && !isset($zipContent['css'])
            && $zip->getFromName($zipContent['cssFile']) === 'p{color:red}'
            && $zip->getFromName($zipContent['code'][0]['file']) === 'window.test=1;', 'ZIP CSS/JS asset payload is missing');
        $zip->close();
    }
    $decoded = json_decode($archive, true, 512, JSON_THROW_ON_ERROR);
    $portable = json_decode($decoded['sections']['pages'][0]['translations'][0]['content'], true);
    check($portable['css'] === 'p{color:red}' && $portable['code'][0]['code'] === 'window.test=1;', 'Generated code omitted');
    check(array_keys(json_decode(ZM_PB_Transfer::export(['menus']), true)['sections']) === ['menus'], 'Selective export leaked sections');
    // A different installation already uses the old numeric ID for an unrelated page.
    Capsule::table('zm_pb_pages')->where('id', 3)->update(['slug' => 'unrelated']);
    Capsule::table('zm_pb_menu_items')->delete(); Capsule::table('zm_pb_menu_locations')->delete(); Capsule::table('zm_pb_menus')->delete();
    Capsule::table('zm_pb_redirects')->delete();
    $archive = str_replace('https://target.test/', 'https://source.test/', $archive);
    $counts = ZM_PB_Transfer::import($archive, $sections);
    $newId = Capsule::table('zm_pb_pages')->where('slug', 'test')->value('id');
    check($newId && (int) $newId !== 3, 'ID collision not remapped');
    check((int) Capsule::table('zm_pb_menu_items')->where('type', 'page')->value('page_id') === (int) $newId, 'Menu page reference broken');
    check((int) Capsule::table('zm_pb_menu_items')->where('type', 'custom')->value('parent_id') === (int) Capsule::table('zm_pb_menu_items')->where('type', 'page')->value('id'), 'Menu tree broken');
    $imported = json_decode(Capsule::table('zm_pb_pages_settings')->where('page_id', $newId)->value('content'), true);
    check(strpos($imported['html'], ZM_PB_MAINSYSTEM_ASSETS_URL . 'test.png') !== false, 'Media URL not localized');
    check(strpos($imported['cssUrl'], 'page_' . $newId . '_english_styles.css') !== false, 'CSS still uses source page ID');
    if (isset($zipPath)) {
        ZM_PB_Transfer::importFile($zipPath, ['pages']);
        check(file_get_contents(ZM_PB_ASSETSDIR . 'generated/page_' . $newId . '_english_styles.css') === 'p{color:red}', 'ZIP import did not recreate CSS');

        check(isset($availableLanguages['albanian']) && !isset(ZM_PB_LANGS['albanian']), 'Disabled language fixture is missing');
        $disabledZipPath = $root . '/disabled-language.zip';
        check(copy($zipPath, $disabledZipPath), 'Could not copy ZIP fixture');
        $disabledZip = new ZipArchive();
        check($disabledZip->open($disabledZipPath) === true, 'Could not open ZIP fixture');
        $disabledManifest = json_decode($disabledZip->getFromName('manifest.json'), true, 512, JSON_THROW_ON_ERROR);
        $disabledPage = &$disabledManifest['sections']['pages'][0];
        $disabledPage['langs'] = jsonData(['english', 'albanian']);
        $disabledTranslation = $disabledPage['translations'][0];
        $disabledTranslation['lang'] = 'albanian';
        $disabledPage['translations'][] = $disabledTranslation;
        unset($disabledPage);
        $disabledItems = $disabledManifest['sections']['menus'][0]['items'];
        $disabledItems[1]['labels']['albanian'] = 'Disabled language label';
        $disabledManifest['sections']['menus'][0]['items'] = $disabledItems;
        $disabledZip->deleteName('manifest.json');
        check($disabledZip->addFromString('manifest.json', jsonData($disabledManifest)), 'Could not update ZIP manifest');
        $disabledZip->close();
        ZM_PB_Transfer::importFile($disabledZipPath, ['pages', 'menus']);
        check(in_array('albanian', json_decode(Capsule::table('zm_pb_pages')->where('id', $newId)->value('langs'), true), true)
            && Capsule::table('zm_pb_pages_settings')->where('page_id', $newId)->where('lang', 'albanian')->exists()
            && file_get_contents(ZM_PB_ASSETSDIR . 'generated/page_' . $newId . '_albanian_styles.css') === 'p{color:red}',
            'Import dropped a disabled page language or its generated styles');
        $storedLabels = Capsule::table('zm_pb_menu_items')->where('type', 'custom')->value('labels');
        check((json_decode($storedLabels, true)['albanian'] ?? null) === 'Disabled language label',
            'Import dropped a disabled menu language');
        check(!isset(ZM_PB_LANGS['albanian']) && isset((require $module . 'disabled_langs.php')['albanian']),
            'Import enabled a disabled language');
    }
    check(Capsule::table('zm_pb_attachments')->count() === 1, 'Same media duplicated');
    ZM_PB_Transfer::import($archive, $sections);
    check(Capsule::table('zm_pb_pages')->count() === 2 && Capsule::table('zm_pb_menus')->count() === 1, 'Repeated import duplicated entities');
    $beforeCss = file_get_contents(ZM_PB_ASSETSDIR . 'generated/page_' . $newId . '_english_styles.css');
    $bad = json_decode($archive, true);
    $project = json_decode($bad['sections']['pages'][0]['translations'][0]['content'], true); $project['css'] = 'p{color:blue}';
    $bad['sections']['pages'][0]['translations'][0]['content'] = jsonData($project);
    $bad['sections']['menus'][0]['items'][0]['target'] = 'invalid-target';
    $failed = false;
    try { ZM_PB_Transfer::import(jsonData($bad), ['pages', 'menus']); } catch (RuntimeException $error) { $failed = true; }
    check($failed && file_get_contents(ZM_PB_ASSETSDIR . 'generated/page_' . $newId . '_english_styles.css') === $beforeCss, 'Failed import did not roll back asset overwrite');
    $restored = json_decode(Capsule::table('zm_pb_pages_settings')->where('page_id', $newId)->value('content'), true);
    check($restored === $imported, 'Failed import did not roll back database');
    $bad = json_decode($archive, true); $bad['sections']['media'][0]['filename'] = '../configuration.php';
    $failed = false; try { ZM_PB_Transfer::import(jsonData($bad), ['media']); } catch (RuntimeException $error) { $failed = true; }
    check($failed, 'Media path traversal accepted');
    $partial = json_decode(ZM_PB_Transfer::export(['pages']), true);
    check(array_keys(ZM_PB_Transfer::import(jsonData($partial), $sections)) === ['pages'], 'Absent sections not skipped');
    $orphan = json_decode($archive, true);
    $orphan['sections']['menus'][0]['items'][0]['page_id'] = 9999;
    $importWarnings = [];
    ZM_PB_Transfer::import(jsonData($orphan), ['pages', 'menus'], null, $importWarnings);
    check(count($importWarnings) === 1
        && Capsule::table('zm_pb_menu_items')->where('type', 'page')->count() === 0
        && Capsule::table('zm_pb_menu_items')->where('type', 'custom')->where('label', 'test')->exists(),
        'Import did not preserve an orphaned page item as a custom link');
    $settingsPath = ZM_PB_INCDIR . 'editable_consts.php';
    $settingsBefore = file_get_contents($settingsPath);
    $result = zm_pb_update_consts_in_file(['ZM_PB_ENABLE_PAGE_OVERRIDES' => false, 'ZM_PB_UNDECLARED' => true], true);
    check(($result['status'] ?? '') === 'error' && file_get_contents($settingsPath) === $settingsBefore, 'Strict settings update wrote only some constants');
    $bad = json_decode($archive, true); $bad['source_url'] = 'ftp://source.test/';
    $failed = false; try { ZM_PB_Transfer::import(jsonData($bad), ['pages']); } catch (RuntimeException $error) { $failed = true; }
    check($failed, 'Non-HTTP source URL accepted');
    echo "PASS transfer selection, assets, URL/ID remapping, media, repeated import, rollback and traversal rejection\n";
} finally {
    if (isset($zipPath) && is_file($zipPath)) unlink($zipPath);
    $real = realpath($root); $temp = realpath(sys_get_temp_dir());
    if (!$real || !$temp || strpos($real, $temp . DIRECTORY_SEPARATOR . 'zmpb-transfer-') !== 0) throw new RuntimeException('Unsafe cleanup path');
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $file) {
        if ($file->isDir()) rmdir($file->getPathname()); else unlink($file->getPathname());
    }
    rmdir($root);
}
