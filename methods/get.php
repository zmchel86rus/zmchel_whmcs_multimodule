<?php 
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
if( $subpage === 'pages_editor' || $subpage === 'media_manager' || $subpage === 'module_settings') require_once ZM_PB_MEDIA_MANAGER_FILE;

if ($subpage === 'readme.md') {
    require __DIR__ . '/get/readme.php';
} elseif ($subpage === 'menu_manager') {
    require __DIR__ . '/get/menu_manager.php';
} elseif ($subpage === 'pages_manager') {
    require __DIR__ . '/get/pages_manager.php';
} elseif ($subpage === 'pages_editor') {
    require __DIR__ . '/get/pages_editor.php';
} elseif ($subpage === 'media_manager') {
    require __DIR__ . '/get/media_manager.php';
} elseif ($subpage === 'sitemap_manager') {
    require __DIR__ . '/get/sitemap_manager.php';
} elseif ($subpage === 'redirects_manager') {
    require __DIR__ . '/get/redirects_manager.php';
} elseif ($subpage === 'rewrite_manager') {
    require __DIR__ . '/get/rewrite_manager.php';
} elseif ($subpage === 'module_settings') {
    require __DIR__ . '/get/module_settings.php';
} elseif ($subpage === 'langs_manager') {
    require __DIR__ . '/get/langs_manager.php';
}
