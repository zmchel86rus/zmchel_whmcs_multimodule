<?php 
if (!defined("ZM_PB_VER")) die('Direct access not allowed');

$type = $_POST['type'] ?? '';
$id = $_POST['id'] ?? '';

if( empty($type) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->pages_manager->delete_errors->missing_type ]));
if( empty($id) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->pages_manager->delete_errors->missing_id ]));

if($method_action === 'trash'){
    if( ! isset($_POST['zm_pb_forms_nonce']) || empty($_POST['zm_pb_forms_nonce'])) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
    if( ! zm_pb_check_token( ZM_PB_FORMS_PRENONCE , $_POST['zm_pb_forms_nonce'], ZM_PB_NONCE_SALT) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
}
if($method_action === 'delete'){
    if( ! isset($_POST['zm_pb_admin_nonce']) || empty($_POST['zm_pb_admin_nonce'])) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
    if( ! zm_pb_check_token( ZM_PB_ADMIN_PRENONCE , $_POST['zm_pb_admin_nonce'], ZM_PB_ADMIN_SALT) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
}

use Illuminate\Database\Capsule\Manager as Capsule;
require_once ZM_PB_MEDIA_MANAGER_FILE;

if($method_action === 'trash'){
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
                'title'=> ZM_PB_ADMINLANG->other->error ,
                'message' => sprintf(ZM_PB_ADMINLANG->pages_manager->delete_errors->operation_failed, 3, $e->getMessage()),
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
                'title'=> ZM_PB_ADMINLANG->other->error ,
                'message' => sprintf(ZM_PB_ADMINLANG->pages_manager->delete_errors->operation_failed, 4, $e->getMessage()),
            ]) );
        }

        exit( json_encode([
            'status'=>'success',
            'title'=> ZM_PB_ADMINLANG->other->success ,
            'message' => ZM_PB_ADMINLANG->other->page . " #ID {$id} " . ZM_PB_ADMINLANG->pages_manager->page_status->translate->canceled,
        ]) );
    }
}

if($method_action === 'delete'){
    if($type === 'page'){

        $page_exists_to_delete = Capsule::table('zm_pb_pages')
            ->where('id', $id)
            ->where('status', '=', 'canceled')
            ->exists();

        if( ! $page_exists_to_delete ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> sprintf(ZM_PB_ADMINLANG->pages_manager->delete_errors->not_found, $id) ]));

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
                'title'=> ZM_PB_ADMINLANG->other->error ,
                'message' => sprintf(ZM_PB_ADMINLANG->pages_manager->delete_errors->operation_failed, 6, $e->getMessage()),
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
                'title'=> ZM_PB_ADMINLANG->other->error ,
                'message' => sprintf(ZM_PB_ADMINLANG->pages_manager->delete_errors->operation_failed, 7, $e->getMessage()),
            ]) );
        }

        try {
            Capsule::table('zm_pb_pages')->where('id', $id)->delete();
        } catch (Exception $e) {
           exit( json_encode([
                'status'=>'error',
                'title'=> ZM_PB_ADMINLANG->other->error ,
                'message' => sprintf(ZM_PB_ADMINLANG->pages_manager->delete_errors->operation_failed, 8, $e->getMessage()),
            ]) );
        }

        exit( json_encode([
            'status'=>'success',
            'title'=> ZM_PB_ADMINLANG->other->success ,
            'message' => ZM_PB_ADMINLANG->other->page . " #ID {$id} " . ZM_PB_ADMINLANG->other->deleted,
        ]) );
    } elseif($type === 'media'){
        if( empty($id) ) exit( json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->pages_manager->delete_errors->missing_id]) );

        $data = [
            'id'=> $id,
        ];
        exit(json_encode(zm_pb_media_manager_action($data, $method_action)));
    }
}
