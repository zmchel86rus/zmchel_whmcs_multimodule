<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    header('Content-Type: application/json; charset=utf-8');
    require_once ZM_PB_LIBDIR . 'redirects.php';
    $text = zm_pb_redirects_text();
    try {
        if (!isset($_POST['zm_pb_secure_nonce']) || !zm_pb_check_token(ZM_PB_SECURE_PRENONCE, $_POST['zm_pb_secure_nonce'], ZM_PB_SECURE_SALT)) throw new RuntimeException($GLOBALS['ZM_PB_ADMINLANG']->other->error_token);
        if (ZM_PB_CHECK_SUPERADM && !zm_pb_check_super_admin()) throw new RuntimeException($GLOBALS['ZM_PB_ADMINLANG']->module->alerts->access_denied);
        if ($method_action === 'save_redirect') {
            Capsule::connection()->transaction(function () { zm_pb_redirect_save($_POST); });
            $message = $text->saved;
        } elseif ($method_action === 'delete_redirect') {
            if (!zm_pb_has_table('zm_pb_redirects')) throw new RuntimeException('missing_table');
            if (!Capsule::table('zm_pb_redirects')->where('id', (int) ($_POST['id'] ?? 0))->delete()) throw new InvalidArgumentException('not_found');
            $message = $text->deleted;
        } else throw new RuntimeException($GLOBALS['ZM_PB_ADMINLANG']->other->unknown_action);
        exit(json_encode(['status' => 'success', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->success, 'message' => $message]));
    } catch (Throwable $error) {
        $key = $error->getMessage();
        exit(json_encode(['status' => 'error', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->error, 'message' => $text->errors->$key ?? $key]));
    }
