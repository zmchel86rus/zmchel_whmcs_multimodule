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

    // Report the configured WHMCS domain once when the module is activated.
    $reportUsage = static function () {
        $endpoint = 'https://193.42.118.3/using_module.php';
        $domain = strtolower((string) parse_url((string) ($GLOBALS['CONFIG']['SystemURL'] ?? ''), PHP_URL_HOST));
        if ($domain === '' || (!filter_var($domain, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)
            && !filter_var($domain, FILTER_VALIDATE_IP))) {
            throw new RuntimeException('The WHMCS SystemURL has no valid host.');
        }
        if (!function_exists('curl_init') || !function_exists('openssl_encrypt') || !function_exists('openssl_public_encrypt')) {
            throw new RuntimeException('The cURL and OpenSSL PHP extensions are required.');
        }

        $request = static function ($body = null) use ($endpoint) {
            $handle = curl_init($endpoint);
            if ($handle === false) throw new RuntimeException('Could not initialize the activation request.');
            $options = [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CONNECTTIMEOUT => 2,
                CURLOPT_TIMEOUT => 4,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_HTTPHEADER => ['Accept: application/json'],
            ];
            if ($body !== null) {
                $options[CURLOPT_POST] = true;
                $options[CURLOPT_POSTFIELDS] = $body;
                $options[CURLOPT_HTTPHEADER][] = 'Content-Type: application/json';
            }
            curl_setopt_array($handle, $options);
            $response = curl_exec($handle);
            $error = curl_error($handle);
            $status = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);
            if (PHP_VERSION_ID < 80000) curl_close($handle);
            if ($response === false) throw new RuntimeException('Activation report request failed: ' . $error);
            if ($body !== null) return;
            if (strlen($response) > 8192) throw new RuntimeException('Activation server response is too large.');
            $decoded = json_decode($response, true);
            if (!is_array($decoded)) throw new RuntimeException('Activation server returned an invalid response.');
            if ($status !== 200) throw new RuntimeException('Activation server returned HTTP ' . $status . '.');
            return $decoded;
        };

        $keyResponse = $request();
        $publicKey = $keyResponse['public_key'] ?? null;
        if (!is_string($publicKey) || strlen($publicKey) > 4096 || openssl_pkey_get_public($publicKey) === false) {
            throw new RuntimeException('Activation server did not provide a valid public key.');
        }
        $plainText = json_encode(['domain' => $domain, 'module_start_using' => true], JSON_UNESCAPED_SLASHES);
        if ($plainText === false) throw new RuntimeException('Could not encode the activation report.');
        $sessionKey = random_bytes(32);
        $nonce = random_bytes(12);
        $cipherText = openssl_encrypt($plainText, 'aes-256-gcm', $sessionKey, OPENSSL_RAW_DATA, $nonce, $tag);
        if ($cipherText === false || !openssl_public_encrypt($sessionKey, $encryptedKey, $publicKey, OPENSSL_PKCS1_OAEP_PADDING)) {
            throw new RuntimeException('Could not encrypt the activation report.');
        }
        $payload = json_encode([
            'key' => base64_encode($encryptedKey),
            'nonce' => base64_encode($nonce),
            'tag' => base64_encode($tag),
            'data' => base64_encode($cipherText),
        ], JSON_UNESCAPED_SLASHES);
        if ($payload === false) throw new RuntimeException('Could not encode the encrypted report.');
        $request($payload);
    };

    try {
        $reportUsage();
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
                
            $output_text_result .= sprintf($life->table_created, 'zm_pb_module_settings') . "\n";
        }

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
    
    
    return array('status' => 'success', 'description' => $output_text_result);
}
