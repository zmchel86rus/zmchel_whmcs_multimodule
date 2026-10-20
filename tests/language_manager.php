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

    $path = [['type' => 'array', 'key' => 'group'], ['type' => 'array', 'key' => 'title']];
    zm_pb_lm_save($client, 'english', $path, 'Client override');
    zm_pb_lm_save($client, 'english', [['type' => 'array', 'key' => 'customKey']], 'New value', true);
    zm_pb_lm_save($admin, 'english', $path, 'Admin override');
    lm_check(zm_pb_lm_catalog($client, 'english')['group']['title'] === 'Client override', 'Client override failed.');
    lm_check(zm_pb_lm_catalog($client, 'english')['customKey'] === 'New value', 'Custom translation failed.');
    lm_check(zm_pb_lm_catalog($admin, 'english')['group']['title'] === 'Admin override', 'Admin override failed.');
    zm_pb_lm_add($admin, 'finnish');
    zm_pb_lm_save($admin, 'finnish', $path, 'Finnish admin text');
    lm_check(zm_pb_lm_catalog($admin, 'finnish')['group']['title'] === 'Finnish admin text',
        'New WHMCS admin language failed.');
    $override = file_get_contents($root . '/lang/overrides/english.php');
    lm_check(strpos($override, "'Keep me'") !== false && strpos($override, '/* CUSTOMS */') !== false,
        'Existing manual override was removed.');

    zm_pb_lm_save($addon, 'english', $path, 'Addon override');
    lm_check(zm_pb_lm_catalog($addon, 'english')['group']['title'] === 'Addon override', 'Addon override failed.');
    lm_check(strpos(file_get_contents($root . '/modules/addons/sample/lang/english.php'), 'ZM_PB_LM_INCLUDE') !== false,
        'Addon did not load its override.');
    zm_pb_lm_add($addon, 'finnish');
    zm_pb_lm_save($addon, 'finnish', $path, 'Finnish addon text');
    lm_check(zm_pb_lm_catalog($addon, 'finnish')['group']['title'] === 'Finnish addon text',
        'New addon language failed.');
    zm_pb_lm_toggle($addon, 'finnish', false);
    lm_check(zm_pb_lm_catalog($addon, 'finnish')['group']['title'] === 'Finnish addon text',
        'Disabled new addon language cannot be loaded.');

    zm_pb_lm_add($own, 'finnish');
    zm_pb_lm_save($own, 'finnish', [['type' => 'object', 'key' => 'section'],
        ['type' => 'object', 'key' => 'title']], 'Suomi');
    lm_check(zm_pb_lm_own('finnish')->section->title === 'Suomi', 'New module language failed.');
    zm_pb_lm_toggle($own, 'finnish', false);
    lm_check(zm_pb_lm_catalog($own, 'finnish')->section->title === 'Suomi',
        'Disabled language cannot be edited.');
    zm_pb_lm_toggle($own, 'finnish', true);
    zm_pb_lm_add($client, 'finnish');
    lm_check(zm_pb_lm_catalog($client, 'finnish')['locale'] === 'fi_FI',
        'New WHMCS language has no locale.');
    zm_pb_lm_toggle($client, 'finnish', false);
    lm_check(zm_pb_lm_catalog($client, 'finnish')['locale'] === 'fi_FI',
        'Disabled new WHMCS language cannot be loaded.');
    file_put_contents($root . '/lang/finnish.php', "<?php \$_LANG['locale'] = 'fi_FI';\n");
    zm_pb_lm_recheck_disabled();
    lm_check(!is_file($root . '/lang/finnish.php') &&
        is_file($root . '/lang/disabled/finnish.php'), 'Cron check did not disable a restored language.');
    echo "PASS language sections, mixed keys, one-row saves, overrides, new and disabled languages\n";
} finally {
    lm_remove($root);
}
