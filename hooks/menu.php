<?php
if (!defined('WHMCS')) die('Direct access not allowed');

$menuHooks = [
    'primary_navbar' => ['ZM_PB_ENABLE_MAINNAV', 'ClientAreaPrimaryNavbar'],
    'secondary_navbar' => ['ZM_PB_ENABLE_SECONDARYNAV', 'ClientAreaSecondaryNavbar'],
    'primary_sidebar' => ['ZM_PB_ENABLE_MAINSIDEBAR', 'ClientAreaPrimarySidebar'],
    'secondary_sidebar' => ['ZM_PB_ENABLE_SECONDARYSIDEBAR', 'ClientAreaSecondarySidebar'],
];
$hasMenuOutput = false;
foreach ($menuHooks as $location => [$flag, $hook]) {
    if (!defined($flag) || !constant($flag)) continue;
    $hasMenuOutput = true;
    add_hook($hook, 999, function ($menu) use ($location) {
        require_once ZM_PB_LIBDIR . 'menu.php';
        ZM_PB_Menu::apply($menu, $location);
    });
}
if (defined('ZM_PB_ENABLE_FOOTERMENU') && ZM_PB_ENABLE_FOOTERMENU) {
    $hasMenuOutput = true;
    add_hook('ClientAreaPage', 998, function () {
        require_once ZM_PB_LIBDIR . 'menu.php';
        return ['zm_pb_footer_menu' => ZM_PB_Menu::footerHtml()];
    });
}
if ($hasMenuOutput) {
    add_hook('ClientAreaFooterOutput', 999, function () {
        return class_exists('ZM_PB_Menu', false) ? ZM_PB_Menu::assets() : '';
    });
}
unset($menuHooks, $location, $flag, $hook, $hasMenuOutput);
