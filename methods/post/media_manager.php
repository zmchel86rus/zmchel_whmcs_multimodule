<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    if ($method_action === 'media_manager_upload') {
        header('Content-Type: application/json; charset=utf-8');
        exit(json_encode(zm_pb_media_manager_upload($_FILES['file'] ?? null)));
    } elseif ($method_action === 'media_manager_upload_data') {
        header('Content-Type: application/json; charset=utf-8');

        $data = [
            'file' => $_FILES['file'] ?? null,
            'name' => $_POST['name'] ?? null,
            'alt' => $_POST['alt'] ?? null,
            'title' => $_POST['title'] ?? null,
            'description' => $_POST['description'] ?? null,
        ];

        exit(json_encode(zm_pb_media_manager_upload($data, $method_action)));
    } elseif ($method_action === 'media_manager_image_optimize') {
        header('Content-Type: application/json; charset=utf-8');
        if (!isset($_POST['zm_pb_admin_nonce']) || !zm_pb_check_token(ZM_PB_ADMIN_PRENONCE, $_POST['zm_pb_admin_nonce'], ZM_PB_ADMIN_SALT)) {
            exit(json_encode(['status'=>'error', 'title'=>$GLOBALS['ZM_PB_ADMINLANG']->other->error, 'message'=>$GLOBALS['ZM_PB_ADMINLANG']->other->error_token]));
        }
        exit(json_encode(zm_pb_media_manager_action(['id' => $_POST['id'] ?? null], $method_action)));
    } elseif ($method_action === 'media_manager_image_save') {
        if( empty($_POST['id']) ) exit( json_encode(['status'=>'error', 'title'=>$GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=>$GLOBALS['ZM_PB_ADMINLANG']->other->unknown_action]) );

        $data = [
            'id'=> $_POST['id'] ?? null,
            'name' => $_POST['name'] ?? null,
            'alt' => $_POST['alt'] ?? null,
            'title' => $_POST['title'] ?? null,
            'description' => $_POST['description'] ?? null,
        ];

        exit(json_encode(zm_pb_media_manager_action($data, $method_action)));
    }

    exit( json_encode(['status'=>'error', 'title'=>$GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=>$GLOBALS['ZM_PB_ADMINLANG']->other->unknown_action]) );
