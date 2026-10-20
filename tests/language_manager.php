<?php
// Run with PHP 7.4 or later: php tests/language_manager.php
$root = sys_get_temp_dir() . '/zm_pb_lm_' . bin2hex(random_bytes(8));
mkdir($root . '/modules/addons/sample/lang', 0750, true);
mkdir($root . '/modules/addons/sample/admin_lang', 0750, true);
mkdir($root . '/modules/addons/self/admin_lang', 0750, true);
mkdir($root . '/admin/lang', 0750, true);
mkdir($root . '/lang/overrides', 0750, true);

define('ZM_PB_VER', 'test');
define('ROOTDIR', $root);
define('ZM_PB_ROOTDIR', $root . '/modules/addons/self/');
define('ZM_PB_ALANGDIR', ZM_PB_ROOTDIR . 'admin_lang/');
define('ZM_PB_INCDIR', $root . '/inc/');
define('ZM_PB_DEFLANG', 'english');
define('ZM_PB_LANGS', require dirname(__DIR__) . '/supported_langs.php');
require dirname(__DIR__) . '/inc/language_manager.php';
mkdir(ZM_PB_INCDIR, 0750, true);

function lm_check($condition, string $message): void
{
    if (!$condition) throw new RuntimeException($message);
}

function add_hook($name, $priority, $callback): void
{
    $GLOBALS['lm_hooks'][$name][$priority][] = $callback;
}

function lm_remove(string $directory): void
{
    foreach (scandir($directory) ?: [] as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $directory . '/' . $item;
        if (is_dir($path)) lm_remove($path);
        else unlink($path);
    }
    rmdir($directory);
}

try {
    file_put_contents(ZM_PB_ALANGDIR . 'english.php',
        "<?php return (object)['section' => (object)['title' => 'Original', 'mixed' => ['item' => (object)['name' => 'Old']]]];\n");
    mkdir(ZM_PB_ALANGDIR . 'overrides', 0750, true);
    file_put_contents(ZM_PB_ALANGDIR . 'overrides/english.php',
        "<?php return (object)['section' => (object)['title' => 'Manual']];\n");
    file_put_contents($root . '/lang/english.php',
        "<?php \$_LANG['locale'] = 'en_US'; \$_LANG['group']['title'] = 'Original';\n");
    file_put_contents($root . '/admin/lang/english.php',
        "<?php \$_ADMINLANG['group']['title'] = 'Original';\n");
    file_put_contents($root . '/modules/addons/sample/lang/english.php',
        "<?php \$_ADDONLANG['group']['title'] = 'Original';\n");
    file_put_contents($root . '/modules/addons/sample/admin_lang/english.php',
        "<?php return (object)['title' => 'Returned object'];\n");
    file_put_contents($root . '/lang/overrides/english.php', "<?php\n\$_LANG['manual'] = 'Keep me';\n");

    $sections = zm_pb_lm_sections();
    lm_check(isset($sections['module:addons:sample:lang']), 'Addon language directory was not found.');
    $returned = $sections['module:addons:sample:admin_lang'];
    lm_check(zm_pb_lm_catalog($returned, 'english')->title === 'Returned object',
        'Returned-object addon cannot be viewed.');
    try {
        zm_pb_lm_save($returned, 'english', [['type' => 'object', 'key' => 'title']], 'Changed');
        throw new RuntimeException('Unsupported addon was silently changed.');
    } catch (RuntimeException $error) {
        if ($error->getMessage() === 'Unsupported addon was silently changed.') throw $error;
    }
    $own = $sections['module_self'];
    $client = $sections['whmcs_client'];
    $admin = $sections['whmcs_admin'];
    $addon = $sections['module:addons:sample:lang'];

    $mixed = [
        ['type' => 'object', 'key' => 'section'],
        ['type' => 'object', 'key' => 'mixed'],
        ['type' => 'array', 'key' => 'item'],
        ['type' => 'object', 'key' => 'name'],
    ];
    zm_pb_lm_save($own, 'english', $mixed, "It's new\nand multiline");
    lm_check(zm_pb_lm_own('english')->section->mixed['item']->name === "It's new\nand multiline",
        'Mixed object/array path was not saved.');
    lm_check(zm_pb_lm_path_label($mixed) === "section->mixed['item']->name", 'Readable key path is wrong.');
    lm_check(zm_pb_lm_path(base64_encode(json_encode($mixed))) === $mixed, 'Key path did not round-trip.');
    zm_pb_lm_save($own, 'english', [['type' => 'object', 'key' => 'section'],
        ['type' => 'object', 'key' => 'title']], 'Changed');
    lm_check(zm_pb_lm_own('english')->section->mixed['item']->name === "It's new\nand multiline",
        'Saving a second row lost the first row.');
    lm_check(strpos(file_get_contents(ZM_PB_ALANGDIR . 'english.php'), 'Original') !== false,
        'Saving changed the original module language file.');
    lm_check(strpos(file_get_contents(ZM_PB_ALANGDIR . 'overrides/english.php'), 'Manual') !== false,
        'Saving changed a manual module override.');
    zm_pb_lm_save($own, 'english', [['type' => 'object', 'key' => 'section'],
        ['type' => 'object', 'key' => 'title']], 'Original');
    lm_check(zm_pb_lm_own('english')->section->title === 'Manual',
        'Restoring an original value removed a manual override.');
    zm_pb_lm_save($own, 'english', $mixed, 'Old');
    lm_check(!is_file(ZM_PB_ALANGDIR . 'overrides/managed/english.php'),
        'An unchanged module override was not removed.');
    $ownCustom = [['type' => 'object', 'key' => 'section'], ['type' => 'object', 'key' => 'added']];
    zm_pb_lm_save($own, 'english', $ownCustom, 'Custom value', true);
    zm_pb_lm_change_custom($own, 'english', $ownCustom, 'renamed');
    lm_check(!property_exists(zm_pb_lm_own('english')->section, 'added') &&
        zm_pb_lm_own('english')->section->renamed === 'Custom value', 'Module custom key was not renamed.');
    $ownRenamed = [['type' => 'object', 'key' => 'section'], ['type' => 'object', 'key' => 'renamed']];
    zm_pb_lm_change_custom($own, 'english', $ownRenamed, null);
    lm_check(!property_exists(zm_pb_lm_own('english')->section, 'renamed') &&
        !is_file(ZM_PB_ALANGDIR . 'overrides/managed/english.php'), 'Module custom key was not deleted.');

    $path = [['type' => 'array', 'key' => 'group'], ['type' => 'array', 'key' => 'title']];
    zm_pb_lm_save($client, 'english', $path, 'Client override');
    zm_pb_lm_save($client, 'english', [['type' => 'array', 'key' => 'customKey']], 'New value', true);
    zm_pb_lm_save($admin, 'english', $path, 'Admin override');
    lm_check(zm_pb_lm_catalog($client, 'english')['group']['title'] === 'Client override', 'Client override failed.');
    lm_check(zm_pb_lm_catalog($client, 'english')['customKey'] === 'New value', 'Custom translation failed.');
    file_put_contents($root . '/lang/spanish.php', "<?php \$_LANG['locale'] = 'es_ES';\n");
    lm_check(zm_pb_lm_source_catalog($client, 'spanish', 'english')['group']['title'] === 'Original',
        'The reference fallback includes an override from another language.');
    lm_check(zm_pb_lm_catalog($admin, 'english')['group']['title'] === 'Admin override', 'Admin override failed.');
    lm_check(zm_pb_lm_source_catalog($admin, 'english', 'english')['group']['title'] === 'Original',
        'The reference column includes the admin override.');
    zm_pb_lm_save($admin, 'english', $path, 'Original');
    lm_check(!is_file($root . '/admin/lang/overrides/english.php'),
        'An unchanged WHMCS admin override was not removed.');
    $adminCustom = [['type' => 'array', 'key' => 'extraText']];
    zm_pb_lm_save($admin, 'english', $adminCustom, 'Extra text', true);
    zm_pb_lm_change_custom($admin, 'english', $adminCustom, 'renamedText');
    $adminRenamed = [['type' => 'array', 'key' => 'renamedText']];
    lm_check(zm_pb_lm_catalog($admin, 'english')['renamedText'] === 'Extra text',
        'WHMCS admin custom key was not renamed.');
    zm_pb_lm_change_custom($admin, 'english', $adminRenamed, null);
    lm_check(!is_file($root . '/admin/lang/overrides/english.php'),
        'Deleting the last WHMCS admin custom key left an override file.');
    zm_pb_lm_add($admin, 'finnish');
    zm_pb_lm_add($admin, 'finnish');
    $adminBackup = zm_pb_lm_added_backup($admin, 'finnish', 'enabled');
    lm_check(is_file($adminBackup), 'The added WHMCS admin language has no backup.');
    unlink($root . '/admin/lang/finnish.php');
    zm_pb_lm_restore_added_languages();
    lm_check(is_file($root . '/admin/lang/finnish.php'), 'The WHMCS admin language was not restored.');
    zm_pb_lm_save($admin, 'finnish', $path, 'Finnish admin text');
    lm_check(zm_pb_lm_catalog($admin, 'finnish')['group']['title'] === 'Finnish admin text',
        'New WHMCS admin language failed.');
    lm_check(zm_pb_lm_source_catalog($admin, 'finnish', 'english')['group']['title'] === 'Original',
        'The reference column includes the selected language override.');
    $override = file_get_contents($root . '/lang/overrides/english.php');
    lm_check(strpos($override, "'Keep me'") !== false && strpos($override, '/* CUSTOMS */') !== false,
        'Existing manual override was removed.');
    zm_pb_lm_save($client, 'english', $path, 'Original');
    lm_check(strpos(file_get_contents($root . '/lang/overrides/english.php'), "'Keep me'") !== false &&
        count(zm_pb_lm_managed_entries($root . '/lang/overrides/english.php')) === 1,
        'Restoring one translation removed manual or custom entries.');
    $clientCustom = [['type' => 'array', 'key' => 'customKey']];
    try {
        zm_pb_lm_change_custom($client, 'english', $clientCustom, 'group');
        throw new RuntimeException('A custom key replaced an original key.');
    } catch (InvalidArgumentException $error) {
        lm_check($error->getMessage() === 'Translation key already exists.', 'Wrong key collision error.');
    }
    try {
        zm_pb_lm_change_custom($client, 'english', $path, null);
        throw new RuntimeException('An original key was deleted.');
    } catch (InvalidArgumentException $error) {
        lm_check($error->getMessage() === 'Only added translations can be changed or deleted.',
            'Original key deletion was not blocked.');
    }
    zm_pb_lm_change_custom($client, 'english', $clientCustom, 'new/key');
    $renamedCustom = [['type' => 'array', 'key' => 'new/key']];
    lm_check(!isset(zm_pb_lm_catalog($client, 'english')['customKey']) &&
        zm_pb_lm_catalog($client, 'english')['new/key'] === 'New value' &&
        isset(zm_pb_lm_flatten(zm_pb_lm_catalog($client, 'english'))[zm_pb_lm_path_id($renamedCustom)]),
        'Client custom key with a slash was not renamed or listed.');
    zm_pb_lm_change_custom($client, 'english', $renamedCustom, null);
    lm_check(!isset(zm_pb_lm_catalog($client, 'english')['new/key']) &&
        strpos(file_get_contents($root . '/lang/overrides/english.php'), "'Keep me'") !== false,
        'Deleting a custom key removed manual overrides.');

    zm_pb_lm_save($addon, 'english', $path, 'Addon override');
    lm_check(zm_pb_lm_catalog($addon, 'english')['group']['title'] === 'Addon override', 'Addon override failed.');
    lm_check(strpos(file_get_contents($root . '/modules/addons/sample/lang/english.php'), 'ZM_PB_LM_INCLUDE') !== false,
        'Addon did not load its override.');
    $addonFile = $root . '/modules/addons/sample/lang/english.php';
    $source = file_get_contents($addonFile);
    file_put_contents($addonFile, str_replace(
        "if (empty(\$GLOBALS['ZM_PB_LM_SKIP_OVERRIDES']) && is_file(__DIR__ . '/overrides/english.php'))",
        "if (is_file(__DIR__ . '/overrides/english.php'))", $source));
    zm_pb_lm_save($addon, 'english', $path, 'Original');
    lm_check(!is_file($root . '/modules/addons/sample/lang/overrides/english.php') &&
        strpos(file_get_contents($addonFile), 'ZM_PB_LM_SKIP_OVERRIDES') !== false,
        'An unchanged addon override was not removed or its loader was not updated.');
    zm_pb_lm_add($addon, 'finnish');
    zm_pb_lm_save($addon, 'finnish', $path, 'Finnish addon text');
    lm_check(zm_pb_lm_catalog($addon, 'finnish')['group']['title'] === 'Finnish addon text',
        'New addon language failed.');
    zm_pb_lm_toggle($addon, 'finnish', false);
    lm_check(zm_pb_lm_catalog($addon, 'finnish')['group']['title'] === 'Finnish addon text',
        'Disabled new addon language cannot be loaded.');

    zm_pb_lm_add($own, 'finnish');
    zm_pb_lm_add($own, 'finnish');
    zm_pb_lm_save($own, 'finnish', [['type' => 'object', 'key' => 'section'],
        ['type' => 'object', 'key' => 'title']], 'Suomi');
    lm_check(zm_pb_lm_own('finnish')->section->title === 'Suomi', 'New module language failed.');
    zm_pb_lm_toggle($own, 'finnish', false);
    zm_pb_lm_toggle($own, 'finnish', false);
    lm_check(zm_pb_lm_catalog($own, 'finnish')->section->title === 'Suomi',
        'Disabled language cannot be edited.');
    zm_pb_lm_toggle($own, 'finnish', true);
    zm_pb_lm_toggle($own, 'finnish', true);
    copy(ZM_PB_ALANGDIR . 'finnish.php', ZM_PB_ALANGDIR . 'disabled/finnish.php');
    try {
        zm_pb_lm_toggle($own, 'finnish', false);
        throw new RuntimeException('Conflicting language files were silently accepted.');
    } catch (RuntimeException $error) {
        if ($error->getMessage() === 'Conflicting language files were silently accepted.') throw $error;
    }
    unlink(ZM_PB_ALANGDIR . 'disabled/finnish.php');
    zm_pb_lm_add($client, 'finnish');
    lm_check(zm_pb_lm_catalog($client, 'finnish')['locale'] === 'fi_FI',
        'New WHMCS language has no locale.');
    zm_pb_lm_toggle($client, 'finnish', false);
    zm_pb_lm_toggle($client, 'finnish', false);
    lm_check(is_file(zm_pb_lm_added_backup($client, 'finnish', 'disabled')) &&
        !is_file(zm_pb_lm_added_backup($client, 'finnish', 'enabled')),
        'The backup did not follow the disabled language.');
    unlink($root . '/lang/disabled/finnish.php');
    zm_pb_lm_restore_added_languages();
    lm_check(is_file($root . '/lang/disabled/finnish.php') &&
        !is_file($root . '/lang/finnish.php'), 'A disabled language was not restored in its disabled state.');
    file_put_contents($root . '/lang/finnish.php', "<?php \$_LANG['locale'] = 'fi_FI';\n");
    zm_pb_lm_restore_added_languages();
    lm_check(!is_file($root . '/lang/finnish.php') &&
        is_file($root . '/lang/disabled/finnish.php'),
        'A restored core language was not kept disabled.');
    file_put_contents($root . '/lang/romanian.php',
        "<?php\nrequire (is_file(__DIR__ . '/english.php') ? __DIR__ : dirname(__DIR__)) . '/english.php';\n\$_LANG = \$_LANG ?? [];\n");
    zm_pb_lm_restore_added_languages();
    lm_check(is_file(zm_pb_lm_added_backup($client, 'romanian', 'enabled')),
        'A language added by an earlier manager version was not backed up.');
    lm_check(zm_pb_lm_catalog($client, 'finnish')['locale'] === 'fi_FI',
        'Disabled new WHMCS language cannot be loaded.');
    $rows = [
        ['label' => "section->title", 'value' => 'Translated text', 'source' => 'Original text'],
        ['label' => "section->other", 'value' => 'Different text', 'source' => 'Other original'],
    ];
    lm_check(count(zm_pb_lm_filter_rows($rows, 'TITLE')) === 1, 'Key search failed.');
    lm_check(count(zm_pb_lm_filter_rows($rows, 'translated')) === 1, 'Translation search failed.');
    lm_check(count(zm_pb_lm_filter_rows($rows, 'ORIGINAL TEXT')) === 1, 'Reference search failed.');
    lm_check(count(zm_pb_lm_filter_rows($rows, 'missing')) === 0, 'Search returned unrelated rows.');
    $rows[0]['added'] = false;
    $rows[1]['added'] = true;
    lm_check(count(zm_pb_lm_filter_rows($rows, '', 'original')) === 1 &&
        count(zm_pb_lm_filter_rows($rows, '', 'added')) === 1 &&
        count(zm_pb_lm_filter_rows($rows, '', 'all')) === 2,
        'Original and added translation filters returned the wrong rows.');
    if (function_exists('mb_stripos')) {
        $rows[] = ['label' => 'section->russian', 'value' => 'Перевод', 'source' => 'Исходный текст'];
        lm_check(count(zm_pb_lm_filter_rows($rows, 'ПЕРЕВОД')) === 1, 'Unicode translation search failed.');
    }
    file_put_contents($root . '/lang/finnish.php', "<?php \$_LANG['locale'] = 'fi_FI';\n");
    define('WHMCS', true);
    require dirname(__DIR__) . '/hooks/language_manager.php';
    lm_check(isset($GLOBALS['lm_hooks']['DailyCronJob'][10000]) &&
        !isset($GLOBALS['lm_hooks']['AfterCronJob']), 'Language checks must use the daily cron hook.');
    $dailyCheck = $GLOBALS['lm_hooks']['DailyCronJob'][10000][0];
    $dailyCheck();
    lm_check(!is_file($root . '/lang/finnish.php') &&
        is_file($root . '/lang/disabled/finnish.php'), 'Cron check did not disable a restored language.');
    lm_check(!is_file(ZM_PB_INCDIR . 'language_manager_last_check.txt'),
        'The language check still uses a stamp file.');
    file_put_contents($root . '/lang/finnish.php', "<?php \$_LANG['locale'] = 'fi_FI';\n");
    $dailyCheck();
    lm_check(!is_file($root . '/lang/finnish.php'), 'A repeated daily check did not disable the restored language.');
    echo "PASS language sections, one-row saves, override cleanup, backup restoration and disabled languages\n";
} finally {
    lm_remove($root);
}
