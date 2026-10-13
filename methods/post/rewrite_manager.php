<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    header('Content-Type: application/json; charset=utf-8');
    if (!in_array($method_action, ['install_rules', 'remove_rules', 'add_rule', 'delete_rule'], true)) {
        exit(json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error, 'message'=>ZM_PB_ADMINLANG->other->unknown_action]));
    }
    if (!isset($_POST['zm_pb_secure_nonce']) ||
        !zm_pb_check_token(ZM_PB_SECURE_PRENONCE, $_POST['zm_pb_secure_nonce'], ZM_PB_SECURE_SALT)) {
        exit(json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error, 'message'=>ZM_PB_ADMINLANG->other->error_token]));
    }
    if (ZM_PB_CHECK_SUPERADM && !zm_pb_check_super_admin()) {
        exit(json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error, 'message'=>ZM_PB_ADMINLANG->module->alerts->access_denied]));
    }
    require_once ZM_PB_LIBDIR . 'rewrite_manager.php';
    try {
        if ($method_action === 'add_rule') {
            $pattern = $_POST['rule_pattern'] ?? '';
            $target = $_POST['rule_target'] ?? '';
            $flags = $_POST['rule_flags'] ?? '';
            if (!is_string($pattern) || !is_string($target) || !is_string($flags)) throw new InvalidArgumentException('invalid_rule');
            zm_pb_rewrite_add_custom_rule($pattern, $target, $flags);
            $message = ZM_PB_ADMINLANG->rewrite_manager->rule_added;
        } elseif ($method_action === 'delete_rule') {
            $id = $_POST['rule_id'] ?? '';
            if (!is_string($id)) throw new InvalidArgumentException('invalid_rule');
            zm_pb_rewrite_delete_custom_rule($id);
            $message = ZM_PB_ADMINLANG->rewrite_manager->rule_deleted;
        } elseif ($method_action === 'remove_rules') {
            zm_pb_uninject_htaccess_rules();
            $message = ZM_PB_ADMINLANG->rewrite_manager->removed;
        } else {
            zm_pb_rewrite_install(zm_pb_rewrite_rules());
            $message = ZM_PB_ADMINLANG->rewrite_manager->installed;
        }
        exit(json_encode(['status'=>'success', 'title'=>ZM_PB_ADMINLANG->other->success, 'message'=>$message]));
    } catch (InvalidArgumentException $e) {
        $key = $e->getMessage();
        $message = ZM_PB_ADMINLANG->rewrite_manager->$key ?? ZM_PB_ADMINLANG->rewrite_manager->invalid_rule;
        exit(json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error, 'message'=>$message]));
    } catch (Exception $e) {
        $key = $e->getMessage();
        exit(json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error, 'message'=>ZM_PB_ADMINLANG->rewrite_manager->$key ?? $key]));
    }
