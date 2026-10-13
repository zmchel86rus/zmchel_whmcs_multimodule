<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    header('Content-Type: application/json');

    if( ! isset($_POST['zm_pb_secure_nonce']) || empty($_POST['zm_pb_secure_nonce'])) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
	if( ! zm_pb_check_token( ZM_PB_SECURE_PRENONCE , $_POST['zm_pb_secure_nonce'], ZM_PB_SECURE_SALT) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));

    $isSuperAdmin = zm_pb_check_super_admin();
    if (!$isSuperAdmin) exit( json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->module->alerts->access_denied]) );

    
    if (in_array($method_action, ['export_module', 'import_module'], true)) {
        require __DIR__ . '/module_settings/transfer.php';
    } elseif ($method_action === 'edit_module_vars') {
        require __DIR__ . '/module_settings/edit_module_vars.php';
    } elseif ($method_action === 'edit_module_custom_header') {
        require __DIR__ . '/module_settings/edit_module_custom_header.php';
    } elseif ($method_action === 'edit_module_custom_footer') {
        require __DIR__ . '/module_settings/edit_module_custom_footer.php';
    } elseif ($method_action === 'edit_robots') {
        require __DIR__ . '/module_settings/edit_robots.php';
    }

    exit( json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->unknown_action]) );
