<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    if ($method_action === 'media_manager_upload') {
        require __DIR__ . '/pages_editor/media_manager_upload.php';
    } elseif ($method_action === 'edit_page_main') {
        require __DIR__ . '/pages_editor/edit_page_main.php';
    } elseif ($method_action === 'edit_page_content') {
        require __DIR__ . '/pages_editor/edit_page_content.php';
    } elseif ($method_action === 'edit_page_meta') {
        require __DIR__ . '/pages_editor/edit_page_meta.php';
    } elseif ($method_action === 'edit_page_sitemap') {
        require __DIR__ . '/pages_editor/edit_page_sitemap.php';
    }

    exit( json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->unknown_action]) );
