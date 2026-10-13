<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

        try{
            $custom_header_input = $_POST['custom_header_input'] ?? null;
            $custom_header_enable = filter_var(
                $_POST['custom_header_enable'] ?? false,
                FILTER_VALIDATE_BOOLEAN
            );

            if ( is_null($custom_header_input) ) exit(json_encode(['status'  => 'error', 'title'   => $GLOBALS['ZM_PB_ADMINLANG']->other->error, 'message' => $GLOBALS['ZM_PB_ADMINLANG']->other->invalid_input]));

            if( !defined('ZMPB_EDIT_CONSTS') ) define('ZMPB_EDIT_CONSTS',true);
            if( empty($custom_header_input) ) $custom_header_enable = false;
            zm_pb_update_consts_in_file(['ZM_PB_CUSTOM_HEADER'=>$custom_header_enable]);


            $encoded = json_encode($custom_header_input);

            $result = Capsule::table('zm_pb_module_settings')->updateOrInsert(
                ['setting_name' => 'custom_header'],
                [
                    'type'                 => 'required',
                    'setting_storage_type' => 'json',
                    'setting_value'        => $encoded,
                ]
            );

            exit( json_encode([
                'status'=>'success',
                'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->success ,
                'message' => ($result ? '' : $GLOBALS['ZM_PB_ADMINLANG']->other->nothing_update),
            ]) );

        } catch (Exception $e) {
            exit( json_encode(['status'=>'error', 'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=>$GLOBALS['ZM_PB_ADMINLANG']->other->db_operation_error .': ' . $e->getMessage()]) );
        }
