<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

        try {
            $page_id = (int) ($_POST['page_id'] ?? 0);
            if( empty($page_id) ) exit( json_encode(['status'=>'error', 'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=>$GLOBALS['ZM_PB_ADMINLANG']->pages_manager->content_errors->page_id_required]) );

            // Only published, non-system pages belong in the sitemap.
            $page = Capsule::table('zm_pb_pages')->where('id', $page_id)->first();
            if( !$page ) exit( json_encode(['status'=>'error', 'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=>$GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_sitemap_noshow->no_found]) );
            if( $page->type === 'system' ) exit( json_encode(['status'=>'error', 'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=>$GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_sitemap_noshow->type]) );
            if( $page->status !== 'publish' ) exit( json_encode(['status'=>'error', 'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=>$GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_sitemap_noshow->no_publish]) );

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
                'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->success ,
                'message' => $GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_update->success->title . ' ' . $GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_update->success->success_sitemap,
            ]) );

        } catch (Exception $e) {
            exit( json_encode(['status'=>'error', 'title'=> $GLOBALS['ZM_PB_ADMINLANG']->other->error,'message'=>$GLOBALS['ZM_PB_ADMINLANG']->other->db_operation_error .': ' . $e->getMessage()]) );
        }
        
