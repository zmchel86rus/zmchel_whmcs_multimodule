<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    if($type === 'page'){

        try {
            $page_exists = Capsule::table('zm_pb_pages')
            ->where('id', $id)
            ->where('status', '!=', 'canceled')
            ->exists();

            if ($page_exists) {
                Capsule::table('zm_pb_pages')
                ->where('id', $id)
                ->update([
                    'status' => 'canceled',
                ]);
            }
        } catch (Exception $e) {
           exit( json_encode([
                'status'=>'error',
                'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error ,
                'message' => sprintf($GLOBALS['ZM_PB_ADMINLANG']->pages_manager->delete_errors->operation_failed, 3, $e->getMessage()),
            ]) );
        }

        try {
            $page_exists = Capsule::table('zm_pb_sitemap')
            ->where('page_id', $id)
            ->where('active', '=', true)
            ->exists();

            if ($page_exists) {
                Capsule::table('zm_pb_sitemap')
                ->where('page_id', $id)
                ->update([
                    'active' => false,
                ]);
            }
        } catch (Exception $e) {
           exit( json_encode([
                'status'=>'error',
                'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error ,
                'message' => sprintf($GLOBALS['ZM_PB_ADMINLANG']->pages_manager->delete_errors->operation_failed, 4, $e->getMessage()),
            ]) );
        }

        exit( json_encode([
            'status'=>'success',
            'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->success ,
            'message' => $GLOBALS['ZM_PB_ADMINLANG']->other->page . " #ID {$id} " . $GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_status->translate->canceled,
        ]) );
    }
