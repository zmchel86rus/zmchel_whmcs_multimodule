<?php 
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

if( ! isset($_POST['zm_pb_forms_nonce']) || empty($_POST['zm_pb_forms_nonce'])) die(json_encode(['status'=>'error', 'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error_token ]));
if( ! zm_pb_check_token( ZM_PB_FORMS_PRENONCE , $_POST['zm_pb_forms_nonce'], ZM_PB_NONCE_SALT) ) die(json_encode(['status'=>'error', 'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error_token ]));

use Illuminate\Database\Capsule\Manager as Capsule;

if( $subpage === 'pages_editor' || $subpage === 'media_manager') require_once ZM_PB_MEDIA_MANAGER_FILE;

if ($subpage === 'menu_manager') {
    require __DIR__ . '/post/menu_manager.php';
} elseif ($subpage === 'pages_manager') {
    require __DIR__ . '/post/pages_manager.php';
} elseif ($subpage === 'pages_editor') {
    require __DIR__ . '/post/pages_editor.php';
} elseif ($subpage === 'media_manager') {
    require __DIR__ . '/post/media_manager.php';
} elseif ($subpage === 'sitemap_manager') {
    require __DIR__ . '/post/sitemap_manager.php';
} elseif ($subpage === 'redirects_manager') {
    require __DIR__ . '/post/redirects_manager.php';
} elseif ($subpage === 'rewrite_manager') {
    require __DIR__ . '/post/rewrite_manager.php';
} elseif ($subpage === 'module_settings') {
    require __DIR__ . '/post/module_settings.php';
}
