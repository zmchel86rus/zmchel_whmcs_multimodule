<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
require_once ZM_PB_INCDIR . 'page_urls.php';

        try {
            $page_id = (int) ($_POST['page_id'] ?? 0);
            if( empty($page_id) ) exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->pages_manager->content_errors->page_id_required]) );

            $name = trim($_POST['edit_main']['name'] ?? '');
            $slug = trim($_POST['edit_main']['slug'] ?? '');
            $auth_type = trim($_POST['edit_main']['auth_type'] ?? '');
            $status = $_POST['edit_main']['status'] ?? 'draft';
            $type = $_POST['edit_main']['type'] ?? 'page';
            $langs = isset($_POST['edit_main']['langs']) && is_array($_POST['edit_main']['langs']) 
                ? array_keys($_POST['edit_main']['langs']) 
                : [];

            $default_sys_lang = zm_pb_stlc(ZM_PB_DEFLANG);
        
            if( ! isset($langs[$default_sys_lang]) ) $langs[]= $default_sys_lang;

            if( empty($name) || empty($slug) ) exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->pages_manager->content_errors->name_slug_required]) );

            $exists = Capsule::table('zm_pb_pages')
                ->where('slug', $slug)
                ->where('auth_type', $auth_type)
                ->where('id', '!=', $page_id)
                ->exists();

            if ($exists) exit( json_encode(['status'=>'error_duplicate', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->pages_manager->page_create->error_duplicate ]));

            Capsule::connection()->beginTransaction();
            $current_page = Capsule::table('zm_pb_pages')->where('id', $page_id)->lockForUpdate()->first();
            if (!$current_page) throw new RuntimeException(ZM_PB_ADMINLANG->pages_manager->page_sitemap_noshow->no_found);
            require_once ZM_PB_LIBDIR . 'redirects.php';
            zm_pb_redirect_page_change($current_page, $slug, $status);
            $old_langs = json_decode($current_page->langs, true) ?: [];
            $was_publish = $current_page->status === 'publish';
            $is_system = $type === 'system';
            
            $change_canonical = Capsule::table('zm_pb_pages')
                ->where('id', $page_id)
                ->value('slug');

            Capsule::table('zm_pb_pages')
                ->where('id', $page_id)
                ->update([
                    'name' => $name,
                    'slug' => $slug,
                    'auth_type' => $auth_type,
                    'status' => $status,
                    'type' => $type,
                    'langs' => json_encode($langs),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

            $new_langs = array_diff($langs, $old_langs);
            $removed_langs = array_diff($old_langs, $langs);

            foreach ($new_langs as $lang) {
                Capsule::table('zm_pb_pages_settings')->insert([
                    'page_id' => $page_id,
                    'lang' => $lang,
                    'lang_status' => 'draft',
                    'lang_active' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            if (!empty($removed_langs)) {
                Capsule::table('zm_pb_pages_settings')
                    ->where('page_id', $page_id)
                    ->whereIn('lang', $removed_langs)
                    ->update([
                        'lang_active' => false,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            }

            if($change_canonical !== $slug){
                foreach ($langs as $lang) {
                    $new_canonical = zm_pb_module_page_url($slug, $lang);

                    $exists = Capsule::table('zm_pb_pages_settings')
                        ->where('page_id', $page_id)
                        ->where('lang', $lang)
                        ->exists();

                    if ($exists) {

                        $settings = json_decode( Capsule::table('zm_pb_pages_settings')
                            ->where('page_id', $page_id)
                            ->where('lang', $lang)
                            ->value('settings') ,true);

                        $settings['meta_canonical'] = $new_canonical;

                        Capsule::table('zm_pb_pages_settings')
                            ->where('page_id', $page_id)
                            ->where('lang', $lang)
                            ->update([
                                'settings' => json_encode($settings),
                            ]);
                    }
                } 
            }


            $should_be_in_sitemap = ($status === 'publish' && !$is_system);
            $sitemap_exists = Capsule::table('zm_pb_sitemap')->where('page_id', $page_id)->exists();

            if ($should_be_in_sitemap && !$sitemap_exists) {
                Capsule::table('zm_pb_sitemap')->insert([
                    'page_id' => $page_id,
                    'active' => true,
                    'url'=> zm_pb_module_page_url($slug),
                    'sitemap_type' => $type === 'post' ? 'post' : 'page',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } elseif ($should_be_in_sitemap && $sitemap_exists) {
                Capsule::table('zm_pb_sitemap')->where('page_id', $page_id)->update([
                    'page_id' => $page_id,
                    'active' => true,
                    'url'=> zm_pb_module_page_url($slug),
                    'sitemap_type' => $type === 'post' ? 'post' : 'page',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } elseif (!$should_be_in_sitemap && $sitemap_exists) {
                Capsule::table('zm_pb_sitemap')
                    ->where('page_id', $page_id)
                    ->update([
                        'active' => false,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            }

            Capsule::connection()->commit();
            exit( json_encode([
                'status'=>'success',
                'title'=> ZM_PB_ADMINLANG->other->success ,
                'message' => ZM_PB_ADMINLANG->pages_manager->page_update->success->title . ' ' . ZM_PB_ADMINLANG->pages_manager->page_update->success->success_main,
            ]) );

        } catch (Throwable $e) {
            if (Capsule::connection()->transactionLevel() > 0) Capsule::connection()->rollBack();
            require_once ZM_PB_INCDIR . 'redirects_manager.php';
            $key = $e->getMessage();
            $text = zm_pb_redirects_text();
            exit(json_encode(['status' => 'error', 'title' => ZM_PB_ADMINLANG->other->error,
                'message' => $text->errors->$key ?? (ZM_PB_ADMINLANG->other->db_operation_error . ': ' . $key)]));
        }
