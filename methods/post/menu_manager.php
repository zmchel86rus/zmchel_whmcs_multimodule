<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    require_once ZM_PB_INCDIR . 'menu_manager.php';
    $text = zm_pb_menu_text();
    header('Content-Type: application/json; charset=utf-8');
    try {
        if (!isset($_POST['zm_pb_admin_nonce']) || !zm_pb_check_token(ZM_PB_ADMIN_PRENONCE, $_POST['zm_pb_admin_nonce'], ZM_PB_ADMIN_SALT)) throw new RuntimeException($GLOBALS['ZM_PB_ADMINLANG']->other->error_token);
        if (!zm_pb_menu_tables_ready()) {
            throw new RuntimeException($text->missing_tables);
        } elseif ($method_action === 'save_menu') {
            $id = zm_pb_menu_save($_POST); $message = $text->saved;
        } elseif ($method_action === 'delete_menu') {
            $id = (int) ($_POST['menu_id'] ?? 0);
            Capsule::connection()->transaction(function () use ($id) {
                Capsule::table('zm_pb_menu_locations')->where('menu_id', $id)->delete();
                Capsule::table('zm_pb_menu_items')->where('menu_id', $id)->delete();
                Capsule::table('zm_pb_menus')->where('id', $id)->delete();
            });
            $id = 0; $message = $text->deleted;
        } else { throw new RuntimeException($GLOBALS['ZM_PB_ADMINLANG']->other->invalid_action); }
        require_once ZM_PB_INCDIR . 'footer_menu.php';
        zm_pb_menu_sync_footer_template();
        exit(json_encode(['status' => 'success', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->success, 'message' => $message, 'menu_id' => $id]));
    } catch (Throwable $error) {
        exit(json_encode(['status' => 'error', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->error, 'message' => zm_pb_menu_error_message($error, $text)]));
    }
