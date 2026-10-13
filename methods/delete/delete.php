<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    if($type === 'page'){

        $page_exists_to_delete = Capsule::table('zm_pb_pages')
            ->where('id', $id)
            ->where('status', '=', 'canceled')
            ->exists();

        if( ! $page_exists_to_delete ) die(json_encode(['status'=>'error', 'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=> sprintf($GLOBALS['ZM_PB_ADMINLANG']->pages_manager->delete_errors->not_found, $id) ]));

        try {
            $page_exists = Capsule::table('zm_pb_sitemap')
            ->where('page_id', $id)
            ->exists();

            if ($page_exists) {
                Capsule::table('zm_pb_pages')->where('page_id', $id)->delete();
            }
        } catch (Exception $e) {
           exit( json_encode([
                'status'=>'error',
                'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error ,
                'message' => sprintf($GLOBALS['ZM_PB_ADMINLANG']->pages_manager->delete_errors->operation_failed, 6, $e->getMessage()),
            ]) );
        }

        try {
            $page_exists = Capsule::table('zm_pb_pages_settings')
            ->where('page_id', $id)
            ->exists();

            if ($page_exists) {
                Capsule::table('zm_pb_pages_settings')->where('id', $id)->delete();
            }
        } catch (Exception $e) {
           exit( json_encode([
                'status'=>'error',
                'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error ,
                'message' => sprintf($GLOBALS['ZM_PB_ADMINLANG']->pages_manager->delete_errors->operation_failed, 7, $e->getMessage()),
            ]) );
        }

        try {
            Capsule::table('zm_pb_pages')->where('id', $id)->delete();
        } catch (Exception $e) {
           exit( json_encode([
                'status'=>'error',
                'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error ,
                'message' => sprintf($GLOBALS['ZM_PB_ADMINLANG']->pages_manager->delete_errors->operation_failed, 8, $e->getMessage()),
            ]) );
        }

        exit( json_encode([
            'status'=>'success',
            'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->success ,
            'message' => $GLOBALS['ZM_PB_ADMINLANG']->other->page . " #ID {$id} " . $GLOBALS['ZM_PB_ADMINLANG']->other->deleted,
        ]) );
    } elseif($type === 'media'){
        if( empty($id) ) exit( json_encode(['status'=>'error', 'title'=>$GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=>$GLOBALS['ZM_PB_ADMINLANG']->pages_manager->delete_errors->missing_id]) );

        $data = [
            'id'=> $id,
        ];
        exit(json_encode(zm_pb_media_manager_action($data, $method_action)));
    }
