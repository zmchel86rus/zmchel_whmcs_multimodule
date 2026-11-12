<?php
/** Admin requests must never register or write Smarty variable catalogs. */
define('WHMCS', true);
define('ZM_PB_VER', 'test');
define('ADMINAREA', true);
define('ZM_PB_COLLECT_VARS', true);
define('ZM_PB_LIBDIR', dirname(__DIR__) . '/lib/');
$resources = sys_get_temp_dir() . '/zm-pb-admin-vars-' . bin2hex(random_bytes(6)) . '/';
define('ZM_PB_RESOURCESDIR', $resources);

$hooks = [];
function add_hook($name, $priority, $callback) {
    $GLOBALS['hooks'][$name][$priority][] = $callback;
}

require dirname(__DIR__) . '/hooks/admin.php';
foreach (['ClientAreaPage', 'ClientAreaHeadOutput', 'ClientAreaFooterOutput'] as $stage) {
    if (isset($hooks[$stage])) throw new RuntimeException('Variable collector registered in admin area');
}

require ZM_PB_LIBDIR . 'smarty_variables.php';
ZM_PB_SmartyVariables::collect(
    ['template' => 'admin', 'templatefile' => 'addonmodules', 'example' => 'value'],
    'ClientAreaPage:9999'
);
if (file_exists($resources . 'available_vars')) {
    throw new RuntimeException('Variable collector wrote an admin catalog');
}

echo "PASS admin Smarty variable collection is disabled\n";
