<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    require_once ZM_PB_LIBDIR . 'redirects.php';
    $text = zm_pb_redirects_text();
    $smarty->assign('redirects_text', $text);
    $smarty->assign('redirects_ready', false);
    try {
        if (ZM_PB_CHECK_SUPERADM && !zm_pb_check_super_admin()) throw new RuntimeException(ZM_PB_ADMINLANG->module->alerts->access_denied);
        if (!zm_pb_has_table('zm_pb_redirects')) throw new RuntimeException('missing_table');
        $count = Capsule::table('zm_pb_redirects')->count();
        $lastPage = max(1, (int) ceil($count / 50));
        $page = min($lastPage, max(1, (int) ($_GET['page'] ?? 1)));
        $smarty->assign('redirect_rules', Capsule::table('zm_pb_redirects')->orderBy('id', 'desc')->skip(($page - 1) * 50)->take(50)->get()->all());
        $smarty->assign('redirect_edit', Capsule::table('zm_pb_redirects')->where('id', (int) ($_GET['id'] ?? 0))->first());
        $smarty->assign('redirect_page', $page);
        $smarty->assign('redirect_last_page', $lastPage);
        $smarty->assign('redirects_enabled', ZM_PB_ENABLE_REDIRECTS_MANAGER);
        $smarty->assign('redirects_ready', true);
    } catch (Throwable $error) {
        $key = $error->getMessage();
        $smarty->assign('alertType', 'danger');
        $smarty->assign('alertMessage', $text->errors->$key ?? $key);
        $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
    }
