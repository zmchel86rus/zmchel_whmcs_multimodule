<?php
// Run with PHP 7.4 or later: php tests/language_manager.php
$root = sys_get_temp_dir() . '/zm_pb_lm_' . bin2hex(random_bytes(8));
mkdir($root . '/modules/addons/sample/lang', 0750, true);
mkdir($root . '/modules/addons/sample/admin_lang', 0750, true);
mkdir($root . '/modules/addons/self/admin_lang', 0750, true);
mkdir($root . '/admin/lang', 0750, true);
mkdir($root . '/lang/overrides', 0750, true);
copy(dirname(__DIR__) . '/supported_langs.php', $root . '/modules/addons/self/supported_langs.php');
copy(dirname(__DIR__) . '/disabled_langs.php', $root . '/modules/addons/self/disabled_langs.php');

define('ZM_PB_VER', 'test');
define('ROOTDIR', $root);
define('ZM_PB_ROOTDIR', $root . '/modules/addons/self/');
define('ZM_PB_ALANGDIR', ZM_PB_ROOTDIR . 'admin_lang/');
define('ZM_PB_INCDIR', $root . '/inc/');
define('ZM_PB_DEFLANG', 'english');
define('ZM_PB_SUPERADM_ID', 42);
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
    $runtime = (object)['module' => (object)[
        'alerts' => (object)['access_denied' => 'Only admin {super_admin_id}.'],
        'module_db' => (object)['alerts' => (object)['access_denied' => 'Database ID {super_admin_id}.']],
    ]];
    zm_pb_lm_apply_runtime_tokens($runtime);
    lm_check($runtime->module->alerts->access_denied === 'Only admin 42.' &&
        $runtime->module->module_db->alerts->access_denied === 'Database ID 42.',
        'Runtime administrator ID was not substituted.');
    foreach (['english', 'russian'] as $language) {
        $catalog = require dirname(__DIR__) . '/admin_lang/' . $language . '.php';
        lm_check(strpos($catalog->module->alerts->access_denied, '{super_admin_id}') !== false &&
            strpos($catalog->module->module_db->alerts->access_denied, '{super_admin_id}') !== false,
            'The original language file does not expose the editable ID placeholder.');
        zm_pb_lm_apply_runtime_tokens($catalog);
        lm_check(strpos($catalog->module->alerts->access_denied, '(ID 42)') !== false &&
            strpos($catalog->module->module_db->alerts->access_denied, '(ID 42)') !== false,
            'The administrator ID was not rendered in the language file.');
    }
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
    file_put_contents(ZM_PB_ALANGDIR . 'ukranian.php',
        "<?php return (object)['section' => (object)['title' => 'Ukrainian']];\n");
    file_put_contents(ZM_PB_ALANGDIR . 'overrides/ukranian.php',
        "<?php return (object)['section' => (object)['title' => 'Custom Ukrainian']];\n");
    file_put_contents(ZM_PB_ALANGDIR . 'overrides/managed/ukranian.php', "<?php return [];\n");
    lm_check(zm_pb_lm_name($own, 'ukranian') === 'ukranian', 'Legacy module filename was not found.');
    lm_check(count(zm_pb_lm_filename_candidates($own)) === 1 &&
        zm_pb_lm_filename_candidates($own)[0]['new'] === 'ukrainian' &&
        zm_pb_lm_supported_key('portugues-br') === 'portuguese-br',
        'Filename corrections or language aliases are wrong.');
    zm_pb_lm_fix_filename($own, 'ukranian');
    lm_check(zm_pb_lm_name($own, 'ukranian') === 'ukrainian' &&
        !is_file(ZM_PB_ALANGDIR . 'ukranian.php') &&
        is_file(ZM_PB_ALANGDIR . 'overrides/managed/ukrainian.php') &&
        !is_file(ZM_PB_ALANGDIR . 'overrides/managed/ukranian.php') &&
        zm_pb_lm_own('ukrainian')->section->title === 'Custom Ukrainian' &&
        zm_pb_lm_own('ukranian')->section->title === 'Custom Ukrainian',
        'Module filename correction lost the catalog or its override.');
    file_put_contents(ZM_PB_ALANGDIR . 'disabled/portugues-br.php',
        "<?php return (object)['section' => (object)['title' => 'Brazilian']];\n");
    zm_pb_lm_fix_filename($own, 'portugues-br');
    lm_check(is_file(ZM_PB_ALANGDIR . 'disabled/portuguese-br.php') &&
        !is_file(ZM_PB_ALANGDIR . 'disabled/portugues-br.php') &&
        zm_pb_lm_catalog($own, 'portuguese-br')->section->title === 'Brazilian',
        'A disabled module catalog could not be renamed or read.');
    zm_pb_lm_add($admin, 'portugues-br');
    lm_check(is_file(zm_pb_lm_added_backup($admin, 'portugues-br', 'enabled')),
        'Legacy WHMCS admin backup was not created.');
    zm_pb_lm_fix_filename($admin, 'portugues-br');
    lm_check(isset(zm_pb_lm_files($admin)['portuguese-br']) &&
        !isset(zm_pb_lm_files($admin)['portugues-br']) &&
        is_file(zm_pb_lm_added_backup($admin, 'portuguese-br', 'enabled')) &&
        !is_file(zm_pb_lm_added_backup($admin, 'portugues-br', 'enabled')) &&
        is_file($root . '/admin/lang/portugues-br.php') &&
        zm_pb_lm_load_php($root . '/admin/lang/portugues-br.php', '$_ADMINLANG')['group']['title'] === 'Original',
        'WHMCS admin filename correction or compatibility alias failed.');
    zm_pb_lm_add($client, 'portugues');
    zm_pb_lm_fix_filename($client, 'portugues');
    lm_check(zm_pb_lm_name($client, 'portuguese-pt') === 'portuguese-pt' &&
        !isset(zm_pb_lm_files($client)['portugues']) &&
        zm_pb_lm_catalog($client, 'portuguese-pt')['locale'] === 'pt_PT' &&
        zm_pb_lm_load_php($root . '/lang/portugues.php', '$_LANG')['locale'] === 'pt_PT',
        'WHMCS client filename correction failed.');
    zm_pb_lm_toggle($client, 'portuguese-pt', false);
    lm_check(is_file($root . '/lang/disabled/portugues.php') &&
        is_file($root . '/lang/disabled/portuguese-pt.php') &&
        !is_file($root . '/lang/portugues.php'), 'The compatibility alias did not follow the disabled language.');
    file_put_contents($root . '/lang/portugues.php', "<?php \$_LANG['restored'] = 'Core update';\n");
    zm_pb_lm_recheck_disabled();
    lm_check(!is_file($root . '/lang/portugues.php') &&
        count(glob($root . '/lang/disabled/portugues.php.restored-*') ?: []) === 1,
        'A core update re-enabled a corrected legacy filename.');
    zm_pb_lm_toggle($client, 'portuguese-pt', true);
    lm_check(is_file($root . '/lang/portugues.php') &&
        is_file($root . '/lang/portuguese-pt.php'), 'The compatibility alias was not enabled again.');
    file_put_contents($root . '/modules/addons/sample/lang/ukranian.php',
        "<?php \$_ADDONLANG['group']['title'] = 'Legacy addon';\n");
    zm_pb_lm_save($addon, 'ukranian', $path, 'Custom addon');
    zm_pb_lm_fix_filename($addon, 'ukranian');
    lm_check(zm_pb_lm_catalog($addon, 'ukrainian')['group']['title'] === 'Custom addon' &&
        strpos(file_get_contents($root . '/modules/addons/sample/lang/ukrainian.php'),
            'ZM_PB_LM_INCLUDE:ukrainian') !== false,
        'Addon filename correction lost its override loader.');
    zm_pb_lm_save($addon, 'ukrainian', $path, 'Changed addon');
    lm_check(zm_pb_lm_catalog($addon, 'ukrainian')['group']['title'] === 'Changed addon',
        'Corrected addon filename cannot save translations.');
    file_put_contents($root . '/lang/ukranian.php', "<?php \$_LANG['legacy'] = 'Keep';\n");
    file_put_contents($root . '/lang/ukrainian.php', "<?php \$_LANG['current'] = 'Keep';\n");
    try {
        zm_pb_lm_fix_filename($client, 'ukranian');
        throw new RuntimeException('A filename collision overwrote an existing catalog.');
    } catch (RuntimeException $error) {
        if ($error->getMessage() === 'A filename collision overwrote an existing catalog.') throw $error;
    }
    lm_check(is_file($root . '/lang/ukranian.php') && is_file($root . '/lang/ukrainian.php'),
        'A rejected filename correction removed a catalog.');
    $editor = zm_pb_lm_editor_rows($own, 'english', 'english');
    $titlePath = [['type' => 'object', 'key' => 'section'], ['type' => 'object', 'key' => 'title']];
    $titleId = zm_pb_lm_path_id($titlePath);
    lm_check($editor['rows'][$titleId]['source'] === 'Original' &&
        $editor['rows'][$titleId]['value'] === 'Manual',
        'The original column included an override.');
    zm_pb_lm_add($client, 'french');
    $newEditor = zm_pb_lm_editor_rows($client, 'french', 'english');
    lm_check($newEditor['rows'][zm_pb_lm_path_id($path)]['source'] === 'Original',
        'A new language did not use the reference column.');
    $existingEditor = zm_pb_lm_editor_rows($client, 'spanish', 'english');
    lm_check($existingEditor['rows'][zm_pb_lm_path_id($path)]['source'] === '',
        'An existing language showed a reference value as its original.');
    zm_pb_lm_save($client, 'english', [['type' => 'array', 'key' => 'customKey']], 'New value', true);
    $export = json_decode(zm_pb_lm_export_translations($client, 'whmcs_client', 'english', 'english'), true);
    lm_check(is_array($export) && count($export['translations']) > 0, 'Translation export is empty.');
    foreach ($export['translations'] as &$item) {
        if ($item['path'] === zm_pb_lm_path_id($path)) $item['translation'] = 'Bulk changed';
    }
    unset($item);
    $bad = $export;
    $bad['translations'][] = ['key' => 'missing', 'path' => zm_pb_lm_path_id([['type' => 'array', 'key' => 'missing']]),
        'translation' => 'Must not be added'];
    $bad['translations'][] = ['key' => 'another missing',
        'path' => zm_pb_lm_path_id([['type' => 'array', 'key' => 'another missing']]),
        'translation' => 'Must not be added'];
    $bad['translations'][] = $bad['translations'][count($bad['translations']) - 2];
    $bad['translations'][] = $export['translations'][0];
    $result = zm_pb_lm_import_translations($client, 'whmcs_client', 'english', 'english', $bad);
    lm_check($result['updated'] === 1 && count($result['skipped']) === 4 &&
        $result['skipped'][0] === ['key' => 'missing', 'reason' => 'unknown'] &&
        $result['skipped'][1] === ['key' => 'another missing', 'reason' => 'unknown'] &&
        $result['skipped'][2] === ['key' => 'missing', 'reason' => 'duplicate'] &&
        $result['skipped'][3]['reason'] === 'duplicate',
        'Unknown or duplicate keys were not skipped and reported.');
    lm_check(zm_pb_lm_catalog($client, 'english')['group']['title'] === 'Bulk changed' &&
        zm_pb_lm_catalog($client, 'english')['customKey'] === 'New value' &&
        !isset(zm_pb_lm_catalog($client, 'english')['missing']),
        'Bulk import lost translated or custom keys.');
    $unchanged = json_decode(zm_pb_lm_export_translations($client, 'whmcs_client', 'english', 'english'), true);
    lm_check(zm_pb_lm_import_translations($client, 'whmcs_client', 'english', 'english', $unchanged)['updated'] === 0,
        'Importing an unchanged export wrote translations again.');
    file_put_contents($root . '/modules/addons/sample/lang/portugues-br.php',
        "<?php \$_ADDONLANG['name'] = 'Brazilian';\n");
    file_put_contents($root . '/modules/addons/sample/admin_lang/portugues-br.php',
        "<?php \$_ADDONLANG['name'] = 'Brazilian admin';\n");
    $candidates = array_column(zm_pb_lm_global_filename_candidates($sections), 'new', 'old');
    lm_check(($candidates['portugues-br'] ?? null) === 'portuguese-br' &&
        ($candidates['ukranian'] ?? null) === 'ukrainian',
        'Global corrections did not include all sections and the supported list.');
    zm_pb_lm_fix_filename_all($sections, 'portugues-br');
    lm_check(is_file($root . '/modules/addons/sample/lang/portuguese-br.php') &&
        is_file($root . '/modules/addons/sample/admin_lang/portuguese-br.php') &&
        is_file($root . '/modules/addons/sample/lang/portugues-br.php') &&
        is_file($root . '/modules/addons/sample/admin_lang/portugues-br.php'),
        'A global correction missed a module section or its compatibility alias.');
    try {
        zm_pb_lm_fix_filename_all($sections, 'ukranian');
        throw new RuntimeException('Global correction ignored a filename collision.');
    } catch (RuntimeException $error) {
        if ($error->getMessage() === 'Global correction ignored a filename collision.') throw $error;
    }
    lm_check(isset(zm_pb_module_languages_state(rtrim(ZM_PB_ROOTDIR, '/'))['enabled']['ukranian']),
        'A rejected global correction changed supported_langs.php.');
    unlink($root . '/lang/ukrainian.php');
    zm_pb_lm_fix_filename_all($sections, 'ukranian');
    $lists = zm_pb_module_languages_state(rtrim(ZM_PB_ROOTDIR, '/'));
    lm_check(isset($lists['enabled']['ukrainian']) && !isset($lists['enabled']['ukranian']) &&
        is_file($root . '/lang/ukrainian.php') && is_file($root . '/lang/ukranian.php'),
        'The global correction did not update supported_langs.php and the client catalog.');
    lm_check(zm_pb_lm_rekey_json('["ukranian","english","ukrainian"]', 'ukranian', 'ukrainian', false)
        === '["ukrainian","english"]' &&
        zm_pb_lm_rekey_json('{"ukranian":"Text"}', 'ukranian', 'ukrainian', true)
        === '{"ukrainian":"Text"}', 'Saved language keys were not converted.');
    echo "PASS language sections, one-row saves, filename corrections, override cleanup, backup restoration and disabled languages\n";
} finally {
    lm_remove($root);
}
