<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    require_once ZM_PB_INCDIR . 'transfer.php';
    $smarty->assign('transfer_text', zm_pb_transfer_text());
    require_once ZM_PB_INCDIR . 'redirects_manager.php';
    $smarty->assign('redirects_text', zm_pb_redirects_text());
    $isSuperAdmin = zm_pb_check_super_admin();

    if (!$isSuperAdmin && ZM_PB_CHECK_SUPERADM) {
		
        $alertMessage = $GLOBALS['ZM_PB_ADMINLANG']->module->alerts->access_denied;
        $alertType = 'danger';
        $smarty->assign('alertType', $alertType );
        $smarty->assign('alertMessage', $alertMessage);
		$smarty->assign('alertHtml', $smarty->fetch( ZM_PB_TEMPLATESPARTSDIR .'alert.tpl' ) );

    } else {
        if( empty($method_action) ){
        
            $editable_consts_main = [];
            $editable_consts_sitemap = [];
            $editable_consts_redirects = [];
            $editable_consts_header = [];
            $editable_consts_footer = [];

            foreach(ZM_PB_ALLOWED_CONSTS_CHANGE as $const_name){
                if ( defined($const_name) ) {
                    $short_lower_const_name = zm_pb_stlc( str_replace(ZM_PB_FREFIX,'',$const_name) );
                    $value = constant($const_name);

                    if( $short_lower_const_name === 'mainsystem_pretty_urls' ) continue;

                    if( strpos($short_lower_const_name, 'sitemap') !== false ) $editable_consts_sitemap[$short_lower_const_name] = ['type'=>zm_pb_value_type($value),'value'=>$value];
                    elseif( strpos($short_lower_const_name, 'redirect') !== false ) $editable_consts_redirects[$short_lower_const_name] = ['type'=>zm_pb_value_type($value),'value'=>$value];
                    elseif( $short_lower_const_name === 'custom_header' ) $editable_consts_header = ['type'=>zm_pb_value_type($value),'value'=>$value];
                    elseif( $short_lower_const_name === 'custom_footer' ) $editable_consts_footer = ['type'=>zm_pb_value_type($value),'value'=>$value];
                    else $editable_consts_main[$short_lower_const_name] = ['type'=>zm_pb_value_type($value),'value'=>$value];
                }
            }

            $settings = Capsule::table('zm_pb_module_settings')
                ->whereIn('setting_name', ['custom_footer', 'custom_header'])
                ->pluck('setting_value', 'setting_name');

            $custom_header_content = json_decode($settings['custom_header'] ?? '[]', true);
            $custom_footer_content = json_decode($settings['custom_footer'] ?? '[]', true);

            $smarty->assign('custom_header_content', $custom_header_content);
            $smarty->assign('custom_footer_content', $custom_footer_content);

            $smarty->assign('editable_consts_main', $editable_consts_main);
            $smarty->assign('editable_consts_sitemap', $editable_consts_sitemap);
            $smarty->assign('editable_consts_redirects', $editable_consts_redirects);
            $smarty->assign('editable_consts_header', $editable_consts_header);
            $smarty->assign('editable_consts_footer', $editable_consts_footer);

            $page_assets = '<script src="'.ZM_PB_ASSETSURL.'js/sortablejs.js"></script>
                <link rel="stylesheet" href="'.ZM_PB_ASSETSURL.'codemirror/codemirror.css">
                <link rel="stylesheet" href="'.ZM_PB_ASSETSURL.'codemirror/monokai.css">
                <script src="'.ZM_PB_ASSETSURL.'codemirror/codemirror.js"></script>
                <script src="'.ZM_PB_ASSETSURL.'codemirror/xml.js"></script>
                <script src="'.ZM_PB_ASSETSURL.'codemirror/javascript.js"></script>
                <script src="'.ZM_PB_ASSETSURL.'codemirror/css.js"></script>
                <script src="'.ZM_PB_ASSETSURL.'codemirror/htmlmixed.js"></script>
                <script src="'.ZM_PB_ASSETSURL.'js/mediamanager.js?v='.filemtime(ZM_PB_ASSETSDIR.'js/mediamanager.js').'"></script>';

            $robots_file = ROOTDIR .'/robots.txt';
            $robots = file_exists($robots_file) ? file_get_contents($robots_file) : '';

            $smarty->assign('fullhost', ZM_PB_FULLHOST);
            $smarty->assign('companyName', ($GLOBALS['CONFIG']['CompanyName'] ?? ''));
            $smarty->assign('robots', $robots);
            $smarty->assign('page_assets', $page_assets);
            $smarty->assign('mediamanager_modal', $smarty->fetch( ZM_PB_TEMPLATESPARTSDIR .'modal_mediamanager.tpl' ) );
        } elseif ($method_action === 'media_manager_list') {
            header('Content-Type: application/json; charset=utf-8');
            exit(json_encode(array_merge(['status' => 'success'], zm_pb_media_manager_page($_GET))));
        } 
    }
