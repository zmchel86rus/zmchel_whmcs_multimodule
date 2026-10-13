<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    require_once ZM_PB_INCDIR . 'sitemap_manager.php';
    $text = zm_pb_sitemap_text();
    $smarty->assign('sitemap_manager_translates', $text);
    $smarty->assign('sitemap_status', zm_pb_sitemap_status());
    $smarty->assign('sitemap_ready', false);
    $smarty->assign('elements_list', []);
    try {
        require_once ZM_PB_LIBDIR . 'sitemap.php';
        $groups = ZM_PB_Sitemap::entries();
        $smarty->assign('elements_list', array_merge($groups['pages'], $groups['posts']));
        $smarty->assign('sitemap_ready', true);
        if (!ZM_PB_ENABLE_SITEMAP) {
            $smarty->assign('alertType', 'warning');
            $smarty->assign('alertMessage', $text->errors->disabled);
            $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
        }
    } catch (Throwable $error) {
        $key = $error->getMessage();
        $smarty->assign('alertType', 'danger');
        $smarty->assign('alertMessage', htmlspecialchars($text->errors->$key ?? $key, ENT_QUOTES, 'UTF-8'));
        $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
    }
