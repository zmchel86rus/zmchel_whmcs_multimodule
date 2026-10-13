<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

        try {
            $page_id = (int) ($_POST['page_id'] ?? 0);
            if( empty($page_id) ) exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->pages_manager->content_errors->page_id_required]) );

            $content_data = $_POST['edit_content'] ?? [];
            $now = date('Y-m-d H:i:s');
            $savedContent = [];

            foreach ($content_data as $lang => $data) {
                $content = zm_pb_save_grapes_content($page_id, $lang, $data['content'] ?? '');
                $savedContent[$lang] = $content;
                
                $exists = Capsule::table('zm_pb_pages_settings')
                    ->where('page_id', $page_id)
                    ->where('lang', $lang)
                    ->exists();

                if ($exists) {
                    Capsule::table('zm_pb_pages_settings')
                        ->where('page_id', $page_id)
                        ->where('lang', $lang)
                        ->update([
                            'content' => $content,
                            'updated_at' => $now,
                        ]);
                } else {
                    Capsule::table('zm_pb_pages_settings')->insert([
                        'page_id' => $page_id,
                        'lang' => $lang,
                        'content' => $content,
                        'lang_status' => 'draft',
                        'lang_active' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            exit( json_encode([
                'status'=>'success',
                'title'=> ZM_PB_ADMINLANG->other->success ,
                'message' => ZM_PB_ADMINLANG->pages_manager->page_update->success->title . ' ' . ZM_PB_ADMINLANG->pages_manager->page_update->success->success_content,
                'contents' => $savedContent,
            ]) );

        } catch (Exception $e) {
            exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->db_operation_error .': ' . $e->getMessage()]) );
        }
