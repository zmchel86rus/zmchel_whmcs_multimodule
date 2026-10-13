<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

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

        if ($exists) die(json_encode(['status'=>'error_duplicate', 'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=> $GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_create->error_duplicate ]));
        

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
                'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->success ,
                'message' => $GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_create->success,
                'page_id' => $pageId
            ]) );

        } catch (Exception $e) {
            exit( json_encode(['status'=>'error', 'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=>$GLOBALS['ZM_PB_ADMINLANG']->other->db_operation_error .': ' . $e->getMessage()]) );
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
                throw new \RuntimeException(sprintf($GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_overrides->encode_error, json_last_error_msg()));
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
                'title'   => $GLOBALS['ZM_PB_ADMINLANG']->other->error,
                'message' => $GLOBALS['ZM_PB_ADMINLANG']->other->db_operation_error . ': ' . $e->getMessage(),
            ]));
        }

        exit(json_encode([
            'status'  => 'success',
            'title'   => $GLOBALS['ZM_PB_ADMINLANG']->other->success,
            'message' => $GLOBALS['ZM_PB_ADMINLANG']->other->updated,
        ]));
    }

    exit( json_encode(['status'=>'error', 'title'=>$GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=>$GLOBALS['ZM_PB_ADMINLANG']->other->unknown_action]) );
