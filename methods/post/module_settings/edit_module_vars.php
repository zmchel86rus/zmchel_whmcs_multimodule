<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

        
        $pre_editable_vars = $_POST['editable_vars'] ?? null;

        if (!is_array($pre_editable_vars)) exit(json_encode(['status'  => 'error', 'title'   => ZM_PB_ADMINLANG->other->error, 'message' => ZM_PB_ADMINLANG->other->invalid_input]));
        if (array_key_exists('auto_redirect_days', $pre_editable_vars)
            && filter_var($pre_editable_vars['auto_redirect_days'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 36500]]) === false) {
            require_once ZM_PB_INCDIR . 'redirects_manager.php';
            exit(json_encode(['status' => 'error', 'title' => ZM_PB_ADMINLANG->other->error, 'message' => zm_pb_redirects_text()->errors->invalid_days]));
        }
        

        if( !defined('ZMPB_EDIT_CONSTS') ) define('ZMPB_EDIT_CONSTS',true);

        $edit_vars = [];

        foreach($pre_editable_vars as $const_name => $const_val){
            $full_upper_const_name = zm_pb_stuc( ZM_PB_FREFIX.$const_name );
            if( in_array($full_upper_const_name,ZM_PB_ALLOWED_CONSTS_CHANGE) ) $edit_vars[$full_upper_const_name] = $const_val;
        }

        global $CONFIG;
        $friendly_mode = $CONFIG['RouteUriPathMode'];
        $update_const = true;
        if( $friendly_mode !== 'rewrite' ) $update_const = false;
        $edit_vars['ZM_PB_MAINSYSTEM_PRETTY_URLS'] =$update_const;

        $edit_result = zm_pb_update_consts_in_file($edit_vars);

        exit( json_encode($edit_result) );

