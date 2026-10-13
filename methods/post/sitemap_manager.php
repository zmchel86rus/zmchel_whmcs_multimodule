<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    header('Content-Type: application/json; charset=utf-8');
    require_once ZM_PB_INCDIR . 'sitemap_manager.php';
    $text = zm_pb_sitemap_text();
    try {
        if ($method_action !== 'generate_sitemaps') throw new RuntimeException($GLOBALS['ZM_PB_ADMINLANG']->other->unknown_action);
        if (!isset($_POST['zm_pb_admin_nonce']) || !zm_pb_check_token(ZM_PB_ADMIN_PRENONCE, $_POST['zm_pb_admin_nonce'], ZM_PB_ADMIN_SALT)) throw new RuntimeException($GLOBALS['ZM_PB_ADMINLANG']->other->error_token);
        if (!ZM_PB_ENABLE_SITEMAP) throw new RuntimeException('disabled');
        require_once ZM_PB_LIBDIR . 'sitemap.php';
        $result = ZM_PB_Sitemap::generate(true);
        if ($result['status'] === 'busy') throw new RuntimeException('busy');
        exit(json_encode(['status' => 'success', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->success,
            'message' => sprintf($text->generated, $result['pages'], $result['posts']), 'result' => $result]));
    } catch (Throwable $error) {
        $key = $error->getMessage();
        exit(json_encode(['status' => 'error', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->error, 'message' => $text->errors->$key ?? $key]));
    }
