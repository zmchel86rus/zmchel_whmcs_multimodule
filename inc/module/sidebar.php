<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

function zmchel_whmcs_multimodule_sidebar($vars){
    $module_subpages = ZM_PB_SUBPAGES;
    $module_translates = $GLOBALS['ZM_PB_ADMINLANG']->module;
    $addonName = ZM_PB_NAME;
    
    $include_subpages = ['sitemap_manager','module_db','module_settings'];
    $sidebar = '<div class="sidebar-header"><span class="header"><i class="fa fa-cogs"></i>'.$module_translates->main->title.'</span></div><ul class="menu">';
    
    foreach ($module_subpages as $subpage){
        if ( !in_array($subpage,$include_subpages) || $subpage == 'pages_editor') continue;
        $sidebar .='<li> <a href="addonmodules.php?module='.$addonName.'&subpage='.$subpage.'">'.$module_translates->$subpage->title.'</a></li>';
    }

    $sidebar .= '<li><a href="addonmodules.php?module='.$addonName.'&subpage=README.md">'.$module_translates->instruction.'</a></li>';
        
    $sidebar .= '</ul>';

    return $sidebar;
}