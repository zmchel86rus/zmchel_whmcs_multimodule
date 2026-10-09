<?php
if (!defined("ZM_PB_VER")) die('Direct access not allowed');

function zmchel_whmcs_multimodule_output($vars){
    $request_method = $_SERVER["REQUEST_METHOD"];
    $method_action = "";
    $subpage = "";

    if ($request_method === "GET") {
        $method_action = $_GET["action"] ?? "";
        $subpage = $_GET["subpage"] ?? "";
    } elseif ($request_method === "POST" && ! isset($_POST["_method"]) ) {
        $method_action = $_POST["action"] ?? "";
        $subpage = $_POST["subpage"] ?? "";
    } elseif ( $request_method === "POST" && isset($_POST["_method"]) && in_array($_POST["_method"], ["PUT", "DELETE"])) {
        $request_method = $_POST["_method"];
        $method_action = $_POST["action"] ?? "";
        $subpage = $_POST["subpage"] ?? "";
    }

    $method_action = zm_pb_stlc($method_action);
    $subpage = zm_pb_stlc($subpage);

    if( empty($subpage) ) {redir("module=".ZM_PB_NAME."&subpage=".ZM_PB_SUBPAGES[0]);exit;}

    $smarty = new Smarty();
    $smarty->setTemplateDir( ZM_PB_TEMPLATESDIR );
    $smarty->setCompileDir(ROOTDIR . "/templates_c/".ZM_PB_NAME."/");

    if($subpage != "media_manager") $smarty->assign( "media_manager_translates", ZM_PB_ADMINLANG->media_manager);

    if ($subpage === 'pages_editor') {
        $smarty->assign('pages_editor_translates', ZM_PB_ADMINLANG->pages_manager);
    } elseif ($subpage === 'sitemap_manager') {
        $smarty->assign('sitemap_translates', ZM_PB_ADMINLANG->pages_manager);
    } elseif ($subpage === 'menu_manager') {
        $smarty->assign($subpage . '_translates', ZM_PB_ADMINLANG->$subpage);
        $smarty->assign('pages_manager_translates', ZM_PB_ADMINLANG->pages_manager);
    } elseif (isset(ZM_PB_ADMINLANG->$subpage)) {
        $smarty->assign($subpage . '_translates', ZM_PB_ADMINLANG->$subpage);
    }
    $smarty->assign("other_translates", ZM_PB_ADMINLANG->other);
    $smarty->assign("module_translates", ZM_PB_ADMINLANG->module);
    $smarty->assign("module_subpages", ZM_PB_SUBPAGES);
    $smarty->assign("module_langs", ZM_PB_LANGS);
    $smarty->assign("addonName", ZM_PB_NAME);
    $smarty->assign("subpage", $subpage);
    $smarty->assign("menuName", $subpage);
    
    $smarty->assign("main_host_url", ZM_PB_FULLHOST);
    $smarty->assign("main_default_lang", ZM_PB_DEFLANG);
    
    $smarty->assign("zm_pb_admin_nonce", zm_pb_generate_token( ZM_PB_ADMIN_PRENONCE , ZM_PB_ADMIN_SALT) );
    $smarty->assign("zm_pb_forms_nonce", zm_pb_generate_token( ZM_PB_FORMS_PRENONCE , ZM_PB_NONCE_SALT) );
    $smarty->assign("zm_pb_secure_nonce", zm_pb_generate_token( ZM_PB_SECURE_PRENONCE , ZM_PB_SECURE_SALT) );

    $method_file = ZM_PB_METHODSDIR . zm_pb_stlc($request_method) . ".php";
    if( in_array($request_method, ZM_PB_ACCEPTED_METHODS) && file_exists( $method_file ) && $subpage != "module_db" ) require_once $method_file;
    elseif( in_array($request_method, ZM_PB_ACCEPTED_METHODS) && $subpage === "module_db" ) require_once ZM_PB_INCMODULEDIR . "db.php";

    
    $complete_page = "";

    if ($request_method === 'GET' && $subpage === 'readme.md') $complete_page = ZM_PB_TEMPLATESDIR . 'readme.tpl';
    elseif( file_exists(ZM_PB_TEMPLATESDIR . $subpage . ".tpl") ) $complete_page = ZM_PB_TEMPLATESDIR . $subpage . ".tpl";
    else $complete_page = ZM_PB_TEMPLATESDIR . "pages_manager.tpl";

    $smarty->display($complete_page);
}
