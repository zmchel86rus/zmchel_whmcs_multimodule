<?php 
if (!defined("ZM_PB_VER")) die('Direct access not allowed');

if( ! isset($_POST['zm_pb_forms_nonce']) || empty($_POST['zm_pb_forms_nonce'])) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
if( ! zm_pb_check_token( ZM_PB_FORMS_PRENONCE , $_POST['zm_pb_forms_nonce'], ZM_PB_NONCE_SALT) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));

use Illuminate\Database\Capsule\Manager as Capsule;

if( $subpage === 'pages_editor' || $subpage === 'media_manager') require_once ZM_PB_MEDIA_MANAGER_FILE;

if ($subpage === 'menu_manager') {
    require_once ZM_PB_INCDIR . 'menu_manager.php';
    $text = zm_pb_menu_text();
    header('Content-Type: application/json; charset=utf-8');
    try {
        if (!isset($_POST['zm_pb_admin_nonce']) || !zm_pb_check_token(ZM_PB_ADMIN_PRENONCE, $_POST['zm_pb_admin_nonce'], ZM_PB_ADMIN_SALT)) throw new RuntimeException(ZM_PB_ADMINLANG->other->error_token);
        if (!zm_pb_menu_tables_ready()) {
            throw new RuntimeException($text->missing_tables);
        } elseif ($method_action === 'save_menu') {
            $id = zm_pb_menu_save($_POST); $message = $text->saved;
        } elseif ($method_action === 'delete_menu') {
            $id = (int) ($_POST['menu_id'] ?? 0);
            Capsule::connection()->transaction(function () use ($id) {
                Capsule::table('zm_pb_menu_locations')->where('menu_id', $id)->delete();
                Capsule::table('zm_pb_menu_items')->where('menu_id', $id)->delete();
                Capsule::table('zm_pb_menus')->where('id', $id)->delete();
            });
            $id = 0; $message = $text->deleted;
        } else { throw new RuntimeException(ZM_PB_ADMINLANG->other->invalid_action); }
        require_once ZM_PB_INCDIR . 'footer_menu.php';
        zm_pb_menu_sync_footer_template();
        exit(json_encode(['status' => 'success', 'title' => ZM_PB_ADMINLANG->other->success, 'message' => $message, 'menu_id' => $id]));
    } catch (Throwable $error) {
        exit(json_encode(['status' => 'error', 'title' => ZM_PB_ADMINLANG->other->error, 'message' => zm_pb_menu_error_message($error, $text)]));
    }
} elseif( $subpage === 'pages_manager' ){
    if ($method_action === 'create_page') {
        // Read the page fields.
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $auth_type = trim($_POST['auth_type'] ?? '');
        $status = $_POST['status'] ?? 'draft';
        $type = $_POST['type'] ?? 'page';
        $langs = isset($_POST['langs']) && is_array($_POST['langs']) 
            ? array_keys($_POST['langs']) 
            : [];
        $default_sys_lang = zm_pb_stlc(ZM_PB_DEFLANG);
        
        if( ! isset($langs[$default_sys_lang]) ) $langs[]= $default_sys_lang;

        // Keep slugs unique within each access type.
        $exists = Capsule::table('zm_pb_pages')
            ->where('slug', $slug)
            ->where('auth_type', $auth_type)
            ->exists();

        if ($exists) die(json_encode(['status'=>'error_duplicate', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->pages_manager->page_create->error_duplicate ]));
        

        try {
            // Save the page first to get its ID.
            $now = date('Y-m-d H:i:s');
            $pageId = Capsule::table('zm_pb_pages')->insertGetId([
                'name' => $name,
                'slug' => $slug,
                'auth_type' => $auth_type,
                'status' => $status,
                'type' => $type,
                'langs' => json_encode($langs),
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // Add settings for each selected language.
            foreach ($langs as $lang) {
                Capsule::table('zm_pb_pages_settings')->insert([
                    'page_id' => $pageId,
                    'lang' => $lang,
                    'lang_status' => 'draft',
                    'lang_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            exit( json_encode([
                'status'=>'success',
                'title'=> ZM_PB_ADMINLANG->other->success ,
                'message' => ZM_PB_ADMINLANG->pages_manager->page_create->success,
                'page_id' => $pageId
            ]) );

        } catch (Exception $e) {
            exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->db_operation_error .': ' . $e->getMessage()]) );
        }
    } elseif ($method_action === 'page_overrides') {

        $submitted = isset($_POST['page_overrides']) && is_array($_POST['page_overrides']) ? $_POST['page_overrides'] : [];

        try {
            $page_overrides = ['from' => [], 'to' => [], 'type' => []];
            $allowed_targets = Capsule::table('zm_pb_pages')->where('status', '!=', 'canceled')->pluck('slug')->all();
            $allowed_types = ['full', 'partial_before', 'partial_after', 'meta_only', 'partial_before_meta', 'partial_after_meta'];
            $used_sources = [];
            $sources = is_array($submitted['from'] ?? null) ? $submitted['from'] : [];
            foreach ($sources as $index => $source) {
                $source = is_string($source) ? trim($source) : '';
                $target = isset($submitted['to'][$index]) && is_string($submitted['to'][$index]) ? trim($submitted['to'][$index]) : '';
                $type = isset($submitted['type'][$index]) && is_string($submitted['type'][$index]) ? trim($submitted['type'][$index]) : '';
                if (!in_array($source, ZM_PB_MAINSYSTEM_DEFAULT_PAGES, true) || isset($used_sources[$source]) ||
                    !in_array($target, $allowed_targets, true) || !in_array($type, $allowed_types, true)) continue;

                $used_sources[$source] = true;
                $page_overrides['from'][] = $source;
                $page_overrides['to'][] = $target;
                $page_overrides['type'][] = $type;
            }
            $encoded = json_encode($page_overrides, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            if ($encoded === false) {
                throw new \RuntimeException(sprintf(ZM_PB_ADMINLANG->pages_manager->page_overrides->encode_error, json_last_error_msg()));
            }

            Capsule::connection()->transaction(function () use ($encoded) {
                Capsule::table('zm_pb_module_settings')->updateOrInsert(
                    ['setting_name' => 'page_overrides'],
                    [
                        'type'                 => 'required',
                        'setting_storage_type' => 'json',
                        'setting_value'        => $encoded,
                    ]
                );
            });
        } catch (Exception $e) {
            exit(json_encode([
                'status'  => 'error',
                'title'   => ZM_PB_ADMINLANG->other->error,
                'message' => ZM_PB_ADMINLANG->other->db_operation_error . ': ' . $e->getMessage(),
            ]));
        }

        exit(json_encode([
            'status'  => 'success',
            'title'   => ZM_PB_ADMINLANG->other->success,
            'message' => ZM_PB_ADMINLANG->other->updated,
        ]));
    }

    exit( json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->unknown_action]) );
} elseif( $subpage === 'pages_editor' ){
    if ($method_action === 'media_manager_upload') {
        header('Content-Type: application/json; charset=utf-8');
        exit(json_encode(zm_pb_media_manager_upload($_FILES['file'] ?? null)));
    } elseif ($method_action === 'edit_page_main'){
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
                    $new_canonical = $slug;
                    if( isset(ZM_PB_LANGS[$lang]) && $lang !== ZM_PB_DEFLANG ) $new_canonical = zm_pb_stlc(ZM_PB_LANGS[$lang]['code']) . '/' . $new_canonical;
                    $new_canonical = ZM_PB_FULLHOST . $new_canonical. '/';

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
                    'url'=> ZM_PB_FULLHOST . $slug,
                    'sitemap_type' => $type === 'post' ? 'post' : 'page',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } elseif ($should_be_in_sitemap && $sitemap_exists) {
                Capsule::table('zm_pb_sitemap')->where('page_id', $page_id)->update([
                    'page_id' => $page_id,
                    'active' => true,
                    'url'=> ZM_PB_FULLHOST . $slug,
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
    } elseif( $method_action === 'edit_page_content' ){
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
    } elseif( $method_action === 'edit_page_meta' ){
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
    } elseif( $method_action === 'edit_page_sitemap' ){
        try {
            $page_id = (int) ($_POST['page_id'] ?? 0);
            if( empty($page_id) ) exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->pages_manager->content_errors->page_id_required]) );

            // Only published, non-system pages belong in the sitemap.
            $page = Capsule::table('zm_pb_pages')->where('id', $page_id)->first();
            if( !$page ) exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->pages_manager->page_sitemap_noshow->no_found]) );
            if( $page->type === 'system' ) exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->pages_manager->page_sitemap_noshow->type]) );
            if( $page->status !== 'publish' ) exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->pages_manager->page_sitemap_noshow->no_publish]) );

            $edit_sitemap = $_POST['edit_sitemap'];

            $changefreq = $edit_sitemap['changefreq'] ?? 'monthly';
            $priority = (float) ($edit_sitemap['priority'] ?? 0.5);
            $url = trim($edit_sitemap['url'] ?? '');

            // Check the sitemap priority.
            $priority = max(0.0, min(1.0, $priority));

            // Check the update frequency.
            $allowed_freqs = ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'];
            if( !in_array($changefreq, $allowed_freqs) ) $changefreq = 'monthly';

            $now = date('Y-m-d H:i:s');

            // Update the existing sitemap entry when present.
            $sitemap_exists = Capsule::table('zm_pb_sitemap')->where('page_id', $page_id)->exists();

            if ($sitemap_exists) {
                Capsule::table('zm_pb_sitemap')
                    ->where('page_id', $page_id)
                    ->update([
                        'active' => true,
                        'changefreq' => $changefreq,
                        'priority' => $priority,
                        'url' => $url,
                        'updated_at' => $now,
                    ]);
            } else {
                Capsule::table('zm_pb_sitemap')->insert([
                    'page_id' => $page_id,
                    'active' => true,
                    'url' => $url,
                    'changefreq' => $changefreq,
                    'priority' => $priority,
                    'sitemap_type' => $page->type === 'post' ? 'post' : 'page',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            exit( json_encode([
                'status'=>'success',
                'title'=> ZM_PB_ADMINLANG->other->success ,
                'message' => ZM_PB_ADMINLANG->pages_manager->page_update->success->title . ' ' . ZM_PB_ADMINLANG->pages_manager->page_update->success->success_sitemap,
            ]) );

        } catch (Exception $e) {
            exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->db_operation_error .': ' . $e->getMessage()]) );
        }
        
    }

    exit( json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->unknown_action]) );
} elseif( $subpage === 'media_manager' ){
    if ($method_action === 'media_manager_upload') {
        header('Content-Type: application/json; charset=utf-8');
        exit(json_encode(zm_pb_media_manager_upload($_FILES['file'] ?? null)));
    } elseif ($method_action === 'media_manager_upload_data') {
        header('Content-Type: application/json; charset=utf-8');

        $data = [
            'file' => $_FILES['file'] ?? null,
            'name' => $_POST['name'] ?? null,
            'alt' => $_POST['alt'] ?? null,
            'title' => $_POST['title'] ?? null,
            'description' => $_POST['description'] ?? null,
        ];

        exit(json_encode(zm_pb_media_manager_upload($data, $method_action)));
    } elseif ($method_action === 'media_manager_image_optimize') {
        header('Content-Type: application/json; charset=utf-8');
        if (!isset($_POST['zm_pb_admin_nonce']) || !zm_pb_check_token(ZM_PB_ADMIN_PRENONCE, $_POST['zm_pb_admin_nonce'], ZM_PB_ADMIN_SALT)) {
            exit(json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error, 'message'=>ZM_PB_ADMINLANG->other->error_token]));
        }
        exit(json_encode(zm_pb_media_manager_action(['id' => $_POST['id'] ?? null], $method_action)));
    } elseif ($method_action === 'media_manager_image_save') {
        if( empty($_POST['id']) ) exit( json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->unknown_action]) ); 

        $data = [
            'id'=> $_POST['id'] ?? null,
            'name' => $_POST['name'] ?? null,
            'alt' => $_POST['alt'] ?? null,
            'title' => $_POST['title'] ?? null,
            'description' => $_POST['description'] ?? null,
        ];

        exit(json_encode(zm_pb_media_manager_action($data, $method_action)));
    }

    exit( json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->unknown_action]) );
} elseif ($subpage === 'sitemap_manager') {
    header('Content-Type: application/json; charset=utf-8');
    require_once ZM_PB_INCDIR . 'sitemap_manager.php';
    $text = zm_pb_sitemap_text();
    try {
        if ($method_action !== 'generate_sitemaps') throw new RuntimeException(ZM_PB_ADMINLANG->other->unknown_action);
        if (!isset($_POST['zm_pb_admin_nonce']) || !zm_pb_check_token(ZM_PB_ADMIN_PRENONCE, $_POST['zm_pb_admin_nonce'], ZM_PB_ADMIN_SALT)) throw new RuntimeException(ZM_PB_ADMINLANG->other->error_token);
        if (!ZM_PB_ENABLE_SITEMAP) throw new RuntimeException('disabled');
        require_once ZM_PB_LIBDIR . 'sitemap.php';
        $result = ZM_PB_Sitemap::generate(true);
        if ($result['status'] === 'busy') throw new RuntimeException('busy');
        exit(json_encode(['status' => 'success', 'title' => ZM_PB_ADMINLANG->other->success,
            'message' => sprintf($text->generated, $result['pages'], $result['posts']), 'result' => $result]));
    } catch (Throwable $error) {
        $key = $error->getMessage();
        exit(json_encode(['status' => 'error', 'title' => ZM_PB_ADMINLANG->other->error, 'message' => $text->errors->$key ?? $key]));
    }
} elseif ($subpage === 'redirects_manager') {
    header('Content-Type: application/json; charset=utf-8');
    require_once ZM_PB_LIBDIR . 'redirects.php';
    $text = zm_pb_redirects_text();
    try {
        if (!isset($_POST['zm_pb_secure_nonce']) || !zm_pb_check_token(ZM_PB_SECURE_PRENONCE, $_POST['zm_pb_secure_nonce'], ZM_PB_SECURE_SALT)) throw new RuntimeException(ZM_PB_ADMINLANG->other->error_token);
        if (ZM_PB_CHECK_SUPERADM && !zm_pb_check_super_admin()) throw new RuntimeException(ZM_PB_ADMINLANG->module->alerts->access_denied);
        if ($method_action === 'save_redirect') {
            Capsule::connection()->transaction(function () { zm_pb_redirect_save($_POST); });
            $message = $text->saved;
        } elseif ($method_action === 'delete_redirect') {
            if (!zm_pb_has_table('zm_pb_redirects')) throw new RuntimeException('missing_table');
            if (!Capsule::table('zm_pb_redirects')->where('id', (int) ($_POST['id'] ?? 0))->delete()) throw new InvalidArgumentException('not_found');
            $message = $text->deleted;
        } else throw new RuntimeException(ZM_PB_ADMINLANG->other->unknown_action);
        exit(json_encode(['status' => 'success', 'title' => ZM_PB_ADMINLANG->other->success, 'message' => $message]));
    } catch (Throwable $error) {
        $key = $error->getMessage();
        exit(json_encode(['status' => 'error', 'title' => ZM_PB_ADMINLANG->other->error, 'message' => $text->errors->$key ?? $key]));
    }
} elseif ($subpage === 'rewrite_manager') {
    header('Content-Type: application/json; charset=utf-8');
    if (!in_array($method_action, ['install_rules', 'add_rule', 'delete_rule'], true)) {
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
} elseif( $subpage === 'module_settings'){
    header('Content-Type: application/json');

    if( ! isset($_POST['zm_pb_secure_nonce']) || empty($_POST['zm_pb_secure_nonce'])) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));
	if( ! zm_pb_check_token( ZM_PB_SECURE_PRENONCE , $_POST['zm_pb_secure_nonce'], ZM_PB_SECURE_SALT) ) die(json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=> ZM_PB_ADMINLANG->other->error_token ]));

    $isSuperAdmin = zm_pb_check_super_admin();
    if (!$isSuperAdmin) exit( json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->module->alerts->access_denied]) );

    
    if (in_array($method_action, ['export_module', 'import_module'], true)) {
        header('Cache-Control: no-store, private');
        require_once ZM_PB_LIBDIR . 'transfer.php';
        $text = zm_pb_transfer_text();
        try {
            $sections = zm_pb_transfer_sections($_POST['transfer_sections'] ?? []);
            if ($method_action === 'export_module') {
                $json = ZM_PB_Transfer::export($sections);
                exit(json_encode(['status' => 'success', 'title' => ZM_PB_ADMINLANG->other->success, 'message' => $text->exported,
                    'download' => ['filename' => 'zmchel-whmcs-multimodule-' . gmdate('Ymd-His') . '.json', 'content' => $json]], JSON_THROW_ON_ERROR));
            }
            $file = $_FILES['transfer_file'] ?? null;
            if (!is_array($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK
                || !is_uploaded_file($file['tmp_name']) || ($file['size'] ?? 0) > ZM_PB_Transfer::MAX_BYTES) {
                throw new RuntimeException(zm_pb_transfer_error('upload_failed'));
            }
            $counts = ZM_PB_Transfer::import(file_get_contents($file['tmp_name']), $sections);
            $labels = array_map(function ($key) use ($text) { return $text->sections[$key]; }, array_keys($counts));
            exit(json_encode(['status' => 'success', 'title' => ZM_PB_ADMINLANG->other->success, 'message' => $text->imported . implode('; ', $labels)]));
        } catch (Throwable $error) {
            exit(json_encode(['status' => 'error', 'title' => ZM_PB_ADMINLANG->other->error, 'message' => $error->getMessage()]));
        }
    } elseif( $method_action === 'edit_module_vars' ){
        
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

    } elseif ($method_action === 'edit_module_custom_header') {
        try{
            $custom_header_input = $_POST['custom_header_input'] ?? null;
            $custom_header_enable = filter_var(
                $_POST['custom_header_enable'] ?? false,
                FILTER_VALIDATE_BOOLEAN
            );

            if ( is_null($custom_header_input) ) exit(json_encode(['status'  => 'error', 'title'   => ZM_PB_ADMINLANG->other->error, 'message' => ZM_PB_ADMINLANG->other->invalid_input]));

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
                'title'=> ZM_PB_ADMINLANG->other->success ,
                'message' => ($result ? '' : ZM_PB_ADMINLANG->other->nothing_update),
            ]) );

        } catch (Exception $e) {
            exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->db_operation_error .': ' . $e->getMessage()]) );
        }
    } elseif ($method_action === 'edit_module_custom_footer') {
        try{
            $custom_footer_input = $_POST['custom_footer_input'] ?? null;
            $custom_footer_enable = filter_var(
                $_POST['custom_footer_enable'] ?? false,
                FILTER_VALIDATE_BOOLEAN
            );

            if ( is_null($custom_footer_input) ) exit(json_encode(['status'  => 'error', 'title'   => ZM_PB_ADMINLANG->other->error, 'message' => ZM_PB_ADMINLANG->other->invalid_input]));

            if( !defined('ZMPB_EDIT_CONSTS') ) define('ZMPB_EDIT_CONSTS',true);
            if( empty($custom_footer_input) ) $custom_footer_enable = false;
            zm_pb_update_consts_in_file(['ZM_PB_CUSTOM_FOOTER'=>$custom_footer_enable]);

            $encoded = json_encode($custom_footer_input);

            $result = Capsule::table('zm_pb_module_settings')->updateOrInsert(
                ['setting_name' => 'custom_footer'],
                [
                    'type'                 => 'required',
                    'setting_storage_type' => 'json',
                    'setting_value'        => $encoded,
                ]
            );

            exit( json_encode([
                'status'=>'success',
                'title'=> ZM_PB_ADMINLANG->other->success ,
                'message' => ($result ? '' : ZM_PB_ADMINLANG->other->nothing_update),
            ]) );

        } catch (Exception $e) {
            exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->db_operation_error .': ' . $e->getMessage()]) );
        }
    } elseif ($method_action === 'edit_robots') {
        try{
            $edit_robots = $_POST['edit_robots'];

            $robots_file = ROOTDIR .'/robots.txt';
            $result = file_exists($robots_file) ? file_put_contents($robots_file,$edit_robots) : false;

            exit( json_encode([
                'status'=> ($result ? 'success' : 'error'),
                'title'=>  ($result ? ZM_PB_ADMINLANG->other->success : ZM_PB_ADMINLANG->other->error ),
                'message' => $result,
            ]) );

        } catch (Exception $e) {
            exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->db_operation_error .': ' . $e->getMessage()]) );
        }
    }

    exit( json_encode(['status'=>'error', 'title'=>ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->unknown_action]) );
}
