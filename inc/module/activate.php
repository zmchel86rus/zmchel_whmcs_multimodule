<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
use Illuminate\Database\Capsule\Manager as Capsule;

function zmchel_whmcs_multimodule_activate(){
    $life = $GLOBALS['ZM_PB_ADMINLANG']->module->lifecycle;
    $output_text_result = $GLOBALS['ZM_PB_ADMINLANG']->module->main->title . ' ' . $GLOBALS['ZM_PB_ADMINLANG']->module->act . ":\n";

    require_once ZM_PB_INCDIR . 'module_languages.php';
    try {
        zm_pb_module_languages_enable_default(ZM_PB_ROOTDIR, ZM_PB_DEFLANG);
    } catch (Throwable $error) {
        return ['status' => 'error', 'description' => $error->getMessage()];
    }

    require_once ZM_PB_INCDIR . 'activation_salts.php';
    try {
        zm_pb_regenerate_activation_salts(ZM_PB_ROOTDIR . 'module_init.php');
    } catch (Throwable $error) {
        $output_text_result .= 'Could not update module salts: ' . $error->getMessage() . "\n";
        error_log('zmchel WHMCS Multimodule activation salts: ' . $error->getMessage());
    }

    require_once ZM_PB_INCDIR . 'activation_report.php';
    try {
        zm_pb_report_activation_usage();
    } catch (Throwable $error) {
        error_log('zmchel WHMCS Multimodule activation report: ' . $error->getMessage());
    }

    try {
        if ( zm_pb_has_table('zm_pb_module_settings') ) {
            $output_text_result .= sprintf($life->table_exists, 'zm_pb_module_settings') . "\n";
        } else {
            // Create table
            Capsule::schema()->create('zm_pb_module_settings', function ($table) {
                $table->increments('id');
                $table->enum('type', ['required', 'global_module', 'local_module', 'client', 'custom'])->default('custom');
                $table->enum('setting_storage_type', ['string', 'json', 'boolean', 'int', 'float'])->default('json');
                $table->string('setting_name', 128)->unique();
                $table->text('setting_value')->nullable();
            });

            Capsule::table('zm_pb_module_settings')->insert([
                [
                    'type' => 'required',
                    'setting_storage_type' => 'json',
                    'setting_name' => 'main_settings',
                    'setting_value' => '',
                ],
                [
                    'type' => 'required',
                    'setting_storage_type' => 'json',
                    'setting_name' => 'sitemap_settings',
                    'setting_value' => '',
                ],
                [
                    'type' => 'required',
                    'setting_storage_type' => 'json',
                    'setting_name' => 'custom_header',
                    'setting_value' => '',
                ],
                [
                    'type' => 'required',
                    'setting_storage_type' => 'json',
                    'setting_name' => 'custom_footer',
                    'setting_value' => '',
                ],
                [
                    'type' => 'required',
                    'setting_storage_type' => 'json',
                    'setting_name' => 'page_overrides',
                    'setting_value' => json_encode(['data' => '']),
                ],
            ]);
                
            $output_text_result .= sprintf($life->table_created, 'zm_pb_module_settings') . "\n";
        }

    } catch (Exception $e) {
        $output_text_result .= sprintf($life->table_create_error, 'zm_pb_module_settings', $e->getMessage()) . "\n";
    }

    try {
        if ( zm_pb_has_table('zm_pb_pages') ) {
            $output_text_result .= sprintf($life->table_exists, 'zm_pb_pages') . "\n";
        } else {
            // Create table
            Capsule::schema()->create('zm_pb_pages', function ($table) {
                $table->increments('id');
                $table->string('name', 128);
                $table->string('slug', 128);
                $table->string('template_file')->nullable();
                $table->enum('auth_type', ['auth', 'noauth', 'mixed'])->default('noauth');
                $table->enum('status', ['draft', 'publish', 'delayed', 'canceled'])->default('draft');
                $table->enum('type', ['system', 'page', 'post'])->default('page');
                $table->json('langs')->nullable();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();

                $table->unique(['slug', 'auth_type']);
            });
                
            $output_text_result .= sprintf($life->table_created, 'zm_pb_pages') . "\n";
        }
    } catch (Exception $e) {
        $output_text_result .= sprintf($life->table_create_error, 'zm_pb_pages', $e->getMessage()) . "\n";
    }

    try {
        if ( zm_pb_has_table('zm_pb_pages_settings') ) {
            $output_text_result .= sprintf($life->table_exists, 'zm_pb_pages_settings') . "\n";
        } else {
            // Create table
            Capsule::schema()->create('zm_pb_pages_settings', function ($table) {
                $table->increments('id');
                $table->unsignedInteger('page_id');
                $table->string('lang', 16)->nullable();
                $table->enum('lang_status', ['draft', 'publish', 'delayed'])->default('draft');
                $table->boolean('lang_active')->default(false);
                $table->json('settings')->nullable();
                $table->longText('content')->nullable();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->index(['page_id', 'lang']);
                $table->foreign('page_id')->references('id')->on('zm_pb_pages')->onDelete('cascade');
            });
                
            $output_text_result .= sprintf($life->table_created, 'zm_pb_pages_settings') . "\n";
        }
    } catch (Exception $e) {
        $output_text_result .= sprintf($life->table_create_error, 'zm_pb_pages_settings', $e->getMessage()) . "\n";
    }

    try {
        if ( zm_pb_has_table('zm_pb_pages_revisions') ) {
            $output_text_result .= sprintf($life->table_exists, 'zm_pb_pages_revisions') . "\n";
        } else {
            // Create table
            Capsule::schema()->create('zm_pb_pages_revisions', function ($table) {
                $table->increments('id');
                $table->unsignedInteger('page_id');
                $table->json('page_main')->nullable();
                $table->json('page_content')->nullable();
                $table->json('page_meta')->nullable();
                $table->json('page_sitemap')->nullable();
                $table->timestamp('created_at')->nullable();
                $table->index(['page_id']);
                $table->foreign('page_id')->references('id')->on('zm_pb_pages')->onDelete('cascade');
            });
                
            $output_text_result .= sprintf($life->table_created, 'zm_pb_pages_revisions') . "\n";
        }
    } catch (Exception $e) {
        $output_text_result .= sprintf($life->table_create_error, 'zm_pb_pages_revisions', $e->getMessage()) . "\n";
    }

    try {
        if ( zm_pb_has_table('zm_pb_sitemap') ) {
            $output_text_result .= sprintf($life->table_exists, 'zm_pb_sitemap') . "\n";
        }
        else
        {
            // Create table
            Capsule::schema()->create('zm_pb_sitemap', function ($table) {
                $table->increments('id');
                $table->unsignedInteger('page_id');
                $table->boolean('active')->default(true);
                $table->string('url', 256)->unique()->nullable();
                $table->enum('changefreq', ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'])->default('monthly');
                $table->decimal('priority', 2, 1)->default(0.5);
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->enum('sitemap_type', ['page', 'post'])->default('page');
                $table->index('page_id');
                $table->index('sitemap_type');
                $table->foreign('page_id')->references('id')->on('zm_pb_pages')->onDelete('cascade');
            });
                
            $output_text_result .= sprintf($life->table_created, 'zm_pb_sitemap') . "\n";
        }
    } catch (Exception $e) {
        $output_text_result .= sprintf($life->table_create_error, 'zm_pb_sitemap', $e->getMessage()) . "\n";
    }

    try {
        if ( zm_pb_has_table('zm_pb_attachments') ) {
            $output_text_result .= sprintf($life->table_exists, 'zm_pb_attachments') . "\n";
        } else {
            // Create table
            Capsule::schema()->create('zm_pb_attachments', function ($table) {
                $table->increments('id');
                $table->string('name', 128)->nullable();
                $table->string('filename', 128)->unique()->nullable();
                $table->string('mime_type', 64)->nullable();
                $table->string('alt', 256)->nullable();
                $table->string('title', 256)->nullable();
                $table->string('description', 1024)->nullable();
                $table->string('url', 256)->unique()->nullable();
                $table->json('sizes')->nullable();
                $table->boolean('optimization_attempted')->default(false);
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();

                $table->index('name');
                $table->index('filename');
                $table->index('mime_type');
            });
                
            $output_text_result .= sprintf($life->table_created, 'zm_pb_attachments') . "\n";
        }
    } catch (Exception $e) {
        $output_text_result .= sprintf($life->table_create_error, 'zm_pb_attachments', $e->getMessage()) . "\n";
    }

    try {
        if ( zm_pb_has_table('zm_pb_redirects') ) {
            $output_text_result .= sprintf($life->table_exists, 'zm_pb_redirects') . "\n";
        } else {
            // Create table
            Capsule::schema()->create('zm_pb_redirects', function ($table) {
                $table->increments('id');
                $table->boolean('active')->default(true);
                $table->string('from', 128);
                $table->string('to', 128);
                $table->unsignedSmallInteger('status_code')->default(301);
                $table->enum('type', ['service','system','simple'])->default('simple');
                $table->enum('method', ['GET', 'POST', 'PUT', 'DELETE', 'ALL'])->default('GET');
                $table->json('conditions')->nullable();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();

                $table->unique(['from', 'method']);
                $table->index('active');
            });
                
            $output_text_result .= sprintf($life->table_created, 'zm_pb_redirects') . "\n";
        }
    } catch (Exception $e) {
        $output_text_result .= sprintf($life->table_create_error, 'zm_pb_redirects', $e->getMessage()) . "\n";
    }

    require_once ZM_PB_INCDIR . 'menu_schema.php';
    foreach (zm_pb_menu_table_definitions() as $name => $create) {
        try {
            if (!zm_pb_has_table($name)) { $create(); $output_text_result .= sprintf($life->table_created, $name) . "\n"; }
        } catch (Throwable $error) { $output_text_result .= sprintf($life->table_create_error, $name, $error->getMessage()) . "\n"; }
    }

    $compileDir = ROOTDIR . '/templates_c/' . ZM_PB_NAME . '/';
    if (!is_dir($compileDir)) {
        mkdir($compileDir, 0755, true);
    }

    require_once ZM_PB_INCDIR . 'directory_health.php';
    try {
        $directoryText = $GLOBALS['ZM_PB_ADMINLANG']->module_settings->directory_check ?? null;
        $directoryIssues = zm_pb_directory_health_messages(zm_pb_directory_health_check(), $directoryText);
        if ($directoryIssues) {
            $output_text_result .= "\n" . ($directoryText->title ?? 'Possible file access issues') . ":\n";
            foreach ($directoryIssues as $issue)
                $output_text_result .= $issue['path'] . ': ' . $issue['message'] . "\n";
        }
    } catch (Throwable $error) {
        error_log('zmchel WHMCS Multimodule directory check: ' . $error->getMessage());
    }
    
    
    return array('status' => 'success', 'description' => $output_text_result);
}
