<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    if( empty($method_action) ){
        $page_assets = '<script src="'.ZM_PB_ASSETSURL.'js/mediamanager.js?v='.filemtime(ZM_PB_ASSETSDIR.'js/mediamanager.js').'"></script>';
        
        $smarty->assign('page_assets', $page_assets);
        $smarty->assign('modal_mediamanager_image', $smarty->fetch( ZM_PB_TEMPLATESPARTSDIR .'modal_mediamanager_image.tpl' ) );
    } elseif ($method_action === 'media_manager_list') {
        header('Content-Type: application/json; charset=utf-8');
        exit(json_encode(array_merge(['status' => 'success'], zm_pb_media_manager_page($_GET))));
    }
