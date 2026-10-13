<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    $isSuperAdmin = zm_pb_check_super_admin();
    if (!$isSuperAdmin && ZM_PB_CHECK_SUPERADM) {
        $alertType = 'danger';
        $alertMessage = ZM_PB_ADMINLANG->module->alerts->access_denied;
    } else {
        require_once ZM_PB_LIBDIR . 'rewrite_manager.php';
        $webServer = zm_pb_rewrite_webserver();
        $serverMessages = [
            'nginx' => ZM_PB_ADMINLANG->rewrite_manager->server_nginx,
            'proxy' => ZM_PB_ADMINLANG->rewrite_manager->server_proxy,
            'unknown' => ZM_PB_ADMINLANG->rewrite_manager->server_unknown,
        ];
        $smarty->assign('rewrite_webserver', $webServer);
        $smarty->assign('rewrite_server_messages', $serverMessages);
        $smarty->assign('alertType', 'warning');
        $smarty->assign('alertMessage', htmlspecialchars($serverMessages[$webServer === 'nginx' ? 'nginx' : 'unknown'], ENT_QUOTES, 'UTF-8'));
        $smarty->assign('rewrite_server_alert', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
        try {
            $rewriteStatus = zm_pb_rewrite_status(zm_pb_rewrite_rules());
            $smarty->assign('rewrite_status', $rewriteStatus);
            $alertType = $rewriteStatus['installed'] ? 'success' : ($rewriteStatus['has_markers'] ? 'warning' : 'info');
            $alertMessage = $rewriteStatus['installed']
                ? ZM_PB_ADMINLANG->rewrite_manager->all_installed
                : ($rewriteStatus['has_markers']
                    ? ZM_PB_ADMINLANG->rewrite_manager->needs_update
                    : ZM_PB_ADMINLANG->rewrite_manager->not_installed);
        } catch (Exception $e) {
            $alertType = 'danger';
            $key = $e->getMessage();
            $alertMessage = htmlspecialchars(ZM_PB_ADMINLANG->rewrite_manager->$key ?? $key, ENT_QUOTES, 'UTF-8');
        }
    }
    $smarty->assign('alertType', $alertType);
    $smarty->assign('alertMessage', $alertMessage);
    $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
