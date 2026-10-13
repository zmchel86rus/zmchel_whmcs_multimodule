<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

        try {
            $page_id = (int) ($_POST['page_id'] ?? 0);
            if( empty($page_id) ) exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->pages_manager->content_errors->page_id_required]) );

            $meta_data = $_POST['edit_meta'] ?? [];
            $now = date('Y-m-d H:i:s');

            foreach ($meta_data as $lang => $data) {

                $canonical = Capsule::table('zm_pb_pages')
                    ->where('id', $page_id)
                    ->value('slug');

                if( isset(ZM_PB_LANGS[$lang]) && $lang !== ZM_PB_DEFLANG ) $canonical = zm_pb_stlc(ZM_PB_LANGS[$lang]['code']) . '/' . $canonical;
                $canonical = ZM_PB_FULLHOST . $canonical . '/';

                $settings = [
                    'enable_breadcrumb' => filter_var($data['enable_breadcrumb'] ?? false,FILTER_VALIDATE_BOOLEAN),
                    'enable_og' => filter_var($data['enable_og'] ?? false,FILTER_VALIDATE_BOOLEAN),
                    'enable_twitter' => filter_var($data['enable_twitter'] ?? false,FILTER_VALIDATE_BOOLEAN),
                    'breadcrumb' => $data['breadcrumb'] ?? '',
                    'meta_title' => $data['meta_title'] ?? '',
                    'meta_og_title' => $data['meta_og_title'] ?? '',
                    'meta_twitter_title' => $data['meta_twitter_title'] ?? '',
                    'meta_description' => $data['meta_description'] ?? '',
                    'meta_og_description' => $data['meta_og_description'] ?? '',
                    'meta_twitter_description' => $data['meta_twitter_description'] ?? '',
                    'meta_image' => $data['meta_image'] ?? '',
                    'meta_og_image' => $data['meta_og_image'] ?? '',
                    'meta_twitter_image' => $data['meta_twitter_image'] ?? '',
                    'meta_keywords' => $data['meta_keywords'] ?? '',
                    'meta_canonical' => $canonical,
                    'meta_robots' => $data['meta_robots'] ?? 'i-f',
                    'meta_og_type' => zm_pb_stlc($data['meta_og_type']) ?? '',
                    'meta_schema' => zm_pb_stlc($data['meta_schema']) ?? '',
                ];

                $exists = Capsule::table('zm_pb_pages_settings')
                    ->where('page_id', $page_id)
                    ->where('lang', $lang)
                    ->exists();

                if ($exists) {
                    Capsule::table('zm_pb_pages_settings')
                        ->where('page_id', $page_id)
                        ->where('lang', $lang)
                        ->update([
                            'settings' => json_encode($settings),
                            'lang_active' => true,
                            'updated_at' => $now,
                        ]);
                } else {
                    Capsule::table('zm_pb_pages_settings')->insert([
                        'page_id' => $page_id,
                        'lang' => $lang,
                        'settings' => json_encode($settings),
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
                'message' => ZM_PB_ADMINLANG->pages_manager->page_update->success->title . ' ' . ZM_PB_ADMINLANG->pages_manager->page_update->success->success_meta,
            ]) );

        } catch (Exception $e) {
            exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->db_operation_error .': ' . $e->getMessage()]) );
        }
