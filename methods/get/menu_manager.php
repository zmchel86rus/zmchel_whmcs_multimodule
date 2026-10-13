<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    require_once ZM_PB_INCDIR . 'menu_manager.php';
    $menuText = zm_pb_menu_text();
    $smarty->assign('menu_manager_translates', $menuText);
    $ready = zm_pb_menu_tables_ready();
    $smarty->assign('menu_ready', $ready);
    if ($ready) {
        try {
            $menuData = zm_pb_menu_admin_data((int) ($_GET['menu_id'] ?? 0));
            $smarty->assign('menu_data', $menuData);
            $smarty->assign('menu_editor_json', json_encode(['items' => $menuData['items'], 'pages' => $menuData['pages'],
                'languages' => array_keys(ZM_PB_LANGS),
                'languageLabels' => (array) (ZM_PB_ADMINLANG->module->supported_langs->translate ?? []),
                'text' => $menuText], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT));
        } catch (Throwable $error) {
            $smarty->assign('menu_ready', false);
            $smarty->assign('alertType', 'danger');
            $smarty->assign('alertMessage', htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8'));
            $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
        }
    } else {
        $smarty->assign('alertType', 'warning');
        $smarty->assign('alertMessage', $menuText->missing_tables);
        $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
    }
    $smarty->assign('page_assets', '<link rel="stylesheet" href="' . ZM_PB_ASSETSURL . 'css/menu-manager.css?v=' . filemtime(ZM_PB_ASSETSDIR . 'css/menu-manager.css') . '">'
        . '<script src="' . ZM_PB_ASSETSURL . 'js/sortablejs.js"></script>'
        . '<script src="' . ZM_PB_ASSETSURL . 'js/menu-manager.js?v=' . filemtime(ZM_PB_ASSETSDIR . 'js/menu-manager.js') . '"></script>');
