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
            Capsule::connection()->transaction(function () use ($id) {
                Capsule::table('zm_pb_sitemap')->where('page_id', $id)->delete();
                Capsule::table('zm_pb_pages_settings')->where('page_id', $id)->delete();
                Capsule::table('zm_pb_pages_revisions')->where('page_id', $id)->delete();
                if (!Capsule::table('zm_pb_pages')->where('id', $id)->where('status', 'canceled')->delete()) {
                    throw new RuntimeException('Page is no longer in the trash');
                }
            });
        } catch (Throwable $e) {
           exit( json_encode([
                'status'=>'error',
                'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error ,
                'message' => sprintf($GLOBALS['ZM_PB_ADMINLANG']->pages_manager->delete_errors->operation_failed, 6, $e->getMessage()),
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
