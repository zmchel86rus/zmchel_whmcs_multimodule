<?php 
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

$type = $_POST['type'] ?? '';
$id = $_POST['id'] ?? '';

if( empty($type) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->pages_manager->delete_errors->missing_type ]));
if( empty($id) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->pages_manager->delete_errors->missing_id ]));

if($method_action === 'trash'){
    if( ! isset($_POST['zm_pb_forms_nonce']) || empty($_POST['zm_pb_forms_nonce'])) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
    if( ! zm_pb_check_token( ZM_PB_FORMS_PRENONCE , $_POST['zm_pb_forms_nonce'], ZM_PB_NONCE_SALT) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
}
if($method_action === 'delete'){
    if( ! isset($_POST['zm_pb_admin_nonce']) || empty($_POST['zm_pb_admin_nonce'])) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
    if( ! zm_pb_check_token( ZM_PB_ADMIN_PRENONCE , $_POST['zm_pb_admin_nonce'], ZM_PB_ADMIN_SALT) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
}

use Illuminate\Database\Capsule\Manager as Capsule;
require_once ZM_PB_MEDIA_MANAGER_FILE;


if ($method_action === 'trash') {
    require __DIR__ . '/delete/trash.php';
}
if ($method_action === 'delete') {
    require __DIR__ . '/delete/delete.php';
}
