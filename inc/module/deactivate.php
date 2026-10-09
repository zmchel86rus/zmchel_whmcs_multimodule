<?php
if (!defined("ZM_PB_VER")) die('Direct access not allowed');
use Illuminate\Database\Capsule\Manager as Capsule;

function zmchel_whmcs_multimodule_deactivate(){
    $life = ZM_PB_ADMINLANG->module->lifecycle;
    $output_text_result = ZM_PB_ADMINLANG->module->main->title . ' ' . ZM_PB_ADMINLANG->module->deact . ":\n";
    $delete_tables = Capsule::table("tbladdonmodules")->where("module", ZM_PB_NAME)->where("setting", "db_action")->value("value");
    if ($delete_tables) {

        Capsule::statement("SET FOREIGN_KEY_CHECKS=0");
        foreach (['zm_pb_menu_locations', 'zm_pb_menu_items', 'zm_pb_menus'] as $tableName) {
            try {
                Capsule::schema()->dropIfExists($tableName);
                $output_text_result .= sprintf($life->table_deleted, $tableName) . "\n";
            } catch (Throwable $error) { $output_text_result .= sprintf($life->table_delete_error, $tableName, $error->getMessage()) . "\n"; }
        }

        try {
            if ( zm_pb_has_table("zm_pb_module_settings") ) {
                Capsule::schema()->dropIfExists("zm_pb_module_settings");
                $output_text_result .= sprintf($life->table_deleted, 'zm_pb_module_settings') . "\n";
            }
                
        } catch (Exception $e) {
            $output_text_result .= sprintf($life->table_delete_error, 'zm_pb_module_settings', $e->getMessage()) . "\n";
        }
		
		try {
            if ( zm_pb_has_table("zm_pb_pages") ) {
                Capsule::schema()->dropIfExists("zm_pb_pages");
                $output_text_result .= sprintf($life->table_deleted, 'zm_pb_pages') . "\n";
            }
                
        } catch (Exception $e) {
            $output_text_result .= sprintf($life->table_delete_error, 'zm_pb_pages', $e->getMessage()) . "\n";
        }
		
		try {
            if ( zm_pb_has_table("zm_pb_pages_settings") ) {
                Capsule::schema()->dropIfExists("zm_pb_pages_settings");
                $output_text_result .= sprintf($life->table_deleted, 'zm_pb_pages_settings') . "\n";
            }
                
        } catch (Exception $e) {
            $output_text_result .= sprintf($life->table_delete_error, 'zm_pb_pages_settings', $e->getMessage()) . "\n";
        }
		
		try {
            if ( zm_pb_has_table("zm_pb_pages_revisions") ) {
                Capsule::schema()->dropIfExists("zm_pb_pages_revisions");
                $output_text_result .= sprintf($life->table_deleted, 'zm_pb_pages_revisions') . "\n";
            }
                
        } catch (Exception $e) {
            $output_text_result .= sprintf($life->table_delete_error, 'zm_pb_pages_revisions', $e->getMessage()) . "\n";
        }
		
		try {
            if ( zm_pb_has_table("zm_pb_sitemap") ) {
                Capsule::schema()->dropIfExists("zm_pb_sitemap");
                $output_text_result .= sprintf($life->table_deleted, 'zm_pb_sitemap') . "\n";
            }
                
        } catch (Exception $e) {
            $output_text_result .= sprintf($life->table_delete_error, 'zm_pb_sitemap', $e->getMessage()) . "\n";
        }
		
		try {
            if ( zm_pb_has_table("zm_pb_attachments") ) {
                Capsule::schema()->dropIfExists("zm_pb_attachments");
                $output_text_result .= sprintf($life->table_deleted, 'zm_pb_attachments') . "\n";
            }
                
        } catch (Exception $e) {
            $output_text_result .= sprintf($life->table_delete_error, 'zm_pb_attachments', $e->getMessage()) . "\n";
        }
		
		try {
            if ( zm_pb_has_table("zm_pb_redirects") ) {
                Capsule::schema()->dropIfExists("zm_pb_redirects");
                $output_text_result .= sprintf($life->table_deleted, 'zm_pb_redirects') . "\n";
            }
                
        } catch (Exception $e) {
            $output_text_result .= sprintf($life->table_delete_error, 'zm_pb_redirects', $e->getMessage()) . "\n";
        }

        Capsule::statement("SET FOREIGN_KEY_CHECKS=1");
    }

    $rewrites_uninject_result = zm_pb_uninject_htaccess_rules(ZM_PB_NAME);
    if ($rewrites_uninject_result !== true) $output_text_result .= $rewrites_uninject_result;
    

    return array("status" => "success", "description" => $output_text_result);
}
