<?php
if (!defined("ZM_PB_VER")) die('Direct access not allowed');
use Illuminate\Database\Capsule\Manager as Capsule;

if (!function_exists('perf301Mark')) {

    $GLOBALS['perf301_enabled'] = true;
    $GLOBALS['perf301_start'] = microtime(true);
    $GLOBALS['perf301_last'] = $GLOBALS['perf301_start'];
    $GLOBALS['perf301_data'] = [];

    function perf301Mark($name)
    {
        if (empty($GLOBALS['perf301_enabled'])) {
            return;
        }

        $now = microtime(true);

        $GLOBALS['perf301_data'][$name] =
            round(($now - $GLOBALS['perf301_last']) * 1000, 2);

        $GLOBALS['perf301_last'] = $now;
    }

    function perf301Flush()
    {
        if (empty($GLOBALS['perf301_enabled'])) {
            return;
        }

        $total = round(
            (microtime(true) - $GLOBALS['perf301_start']) * 1000,
            2
        );

        header(
            'X-301-PERF: ' .
            implode(', ', array_map(
                fn($k, $v) => $k . '=' . $v,
                array_keys($GLOBALS['perf301_data']),
                $GLOBALS['perf301_data']
            )) .
            ', total=' . $total
        );
    }
}

if (!function_exists('zm_pb_value_type')) {
    function zm_pb_value_type($value): string {
        if (is_bool($value))   return 'bool';
        if (is_int($value))    return 'int';
        if (is_float($value))  return 'float';
        if (is_string($value)) return 'string';
        if (is_array($value))  return 'array';
        if (is_null($value))   return 'null';

        return 'undefined';
    }
}

if (!function_exists('zm_pb_normalize_const_value')) {
    function zm_pb_normalize_const_value($current, $value): array {
        if (is_bool($current)) {
            $v = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            return $v === null ? [false, null] : [true, $v];
        }

        if (is_int($current)) {
            $v = filter_var($value, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            return $v === null ? [false, null] : [true, $v];
        }

        if (is_float($current)) {
            $v = filter_var($value, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
            return ($v === null || !is_finite($v)) ? [false, null] : [true, $v];
        }

        if (is_string($current)) {
            return is_scalar($value) ? [true, (string) $value] : [false, null];
        }

        return [false, null];
    }
}

if (!function_exists('zm_pb_update_consts_in_file')) {

    function zm_pb_update_consts_in_file(array $constants_with_value, bool $requireAll = false): array {

        if( !defined('ZMPB_EDIT_CONSTS') ) return ['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->invalid_action];
        

        $result = [];
        foreach ($constants_with_value as $name => $_) {
            $result[(string) $name] = false;
        }

        $file = ZM_PB_INCDIR . 'editable_consts.php';
        if (!is_file($file) || !is_readable($file)) return $result;

        $contents = file_get_contents($file);
        if ($contents === false) return $result;

        $marker = '### EDITABLE CONSTS ###';

        $start = strpos($contents, $marker);
        if ($start === false) return $result;

        $blockStart = $start + strlen($marker);

        $end = strpos($contents, $marker, $blockStart);
        if ($end === false) return $result;

        $before = substr($contents, 0, $blockStart);
        $block  = substr($contents, $blockStart, $end - $blockStart);
        $after  = substr($contents, $end);
        // ---------------------------------------

        $literal = '(?:true|false|null|-?\d+(?:\.\d+)?(?:[eE][+-]?\d+)?'
                 . '|\'(?:[^\'\\\\]|\\\\.)*\''
                 . '|"(?:[^"\\\\]|\\\\.)*")';

        $changed = false;

        foreach ($constants_with_value as $name => $value) {
            $name = (string) $name;

            if (!in_array($name, ZM_PB_ALLOWED_CONSTS_CHANGE, true)) continue;
            if (!defined($name)) continue;

            [$ok, $normalized] = zm_pb_normalize_const_value(constant($name), $value);
            if (!$ok) continue;

            $q = preg_quote($name, '/');

            $pattern = '/'
                . '((?:\bif\s*\(\s*!\s*defined\s*\(\s*["\']' . $q . '["\']\s*\)\s*\)\s*)?'
                . '\bdefine\s*\(\s*["\']' . $q . '["\']\s*,\s*)'
                . $literal
                . '(\s*\)\s*;?)'
                . '/is';

            $newLiteral = var_export($normalized, true);

            $replaced = preg_replace_callback(
                $pattern,
                function ($m) use ($newLiteral) {
                    return $m[1] . $newLiteral . $m[2];
                },
                $block,
                1,
                $count
            );

            if ($replaced === null || $count === 0) continue;

            $block = $replaced;
            $result[$name] = true;
            $changed = true;
        }

        if ($requireAll && in_array(false, $result, true)) {
            return ['status' => 'error', 'title' => ZM_PB_ADMINLANG->other->error,
                'message' => 'Unable to update constants: ' . implode(', ', array_keys(array_filter($result, function ($saved) { return !$saved; })))];
        }
        if (!$changed) return ['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->update_with_arror];

        $contents = $before . $block . $after;

        $fail = function () use ($result) {
            return array_map(function () { return false; }, $result);
        };

        $tmp = $file . '.tmp';
        if (file_put_contents($tmp, $contents, LOCK_EX) === false) return $fail();

        @chmod($tmp, fileperms($file) & 0777);

        if (!rename($tmp, $file)) {
            @unlink($tmp);
            return $fail();
        }

        if (function_exists('opcache_invalidate')) {
            @opcache_invalidate($file, true);
        }

        return ['status'=>'success','title'=> ZM_PB_ADMINLANG->other->success ,'message' => ''];
    }
}

if (!function_exists('zm_pb_update_const_in_file')) {
    function zm_pb_update_const_in_file(string $const_name, $value): bool {
        $r = zm_pb_update_consts_in_file([$const_name => $value]);
        return $r[$const_name] ?? false;
    }
}

if (!function_exists('zm_pb_load_page_by_slug')) {
    function zm_pb_load_page_by_slug(string $slug) {
        if ($slug === '' || !zm_pb_has_table('zm_pb_pages') || !zm_pb_has_table('zm_pb_pages_settings')) {
            return null;
        }

        $page = Capsule::table('zm_pb_pages')->where('slug', $slug)->first();
        if (!$page) return null;

        $settingsByLang = [];
        // Load all language versions at once (to avoid multiple queries)
        if( ZM_PB_ENABLE_LANG_ROUTE ){
            $page_settings = Capsule::table('zm_pb_pages_settings')
                ->where('page_id', $page->id)
                ->where('lang_active', true)
                ->get();

            foreach ($page_settings as $page_setting) {
                if( !is_null($page_setting->settings) ) {
                    $decoded = json_decode($page_setting->settings,true);
                    if (is_array($decoded)) $page_setting->settings = (object) $decoded;
                }
                $settingsByLang[$page_setting->lang] = $page_setting;
            }
        } else {

            $lang = '';
            if( isset($_SESSION['Language'])) $lang = $_SESSION['Language'];
            elseif( isset($_SESSION['uid']) ) $lang = Capsule::table('tblclients')->where('id', $_SESSION['uid'])->value('language');
            else $lang = ZM_PB_DEFLANG;

            $page_settings = Capsule::table('zm_pb_pages_settings')
                ->where('page_id', $page->id)
                ->where('lang', $lang)
                ->where('lang_active', true)
                ->first();
            if (!$page_settings && $lang !== ZM_PB_DEFLANG) {
                $page_settings = Capsule::table('zm_pb_pages_settings')
                    ->where('page_id', $page->id)
                    ->where('lang', ZM_PB_DEFLANG)
                    ->where('lang_active', true)
                    ->first();
            }
            if (!$page_settings) {
                $page_settings = Capsule::table('zm_pb_pages_settings')
                    ->where('page_id', $page->id)
                    ->where('lang_active', true)
                    ->first();
            }
            if( $page_settings && !is_null($page_settings->settings) ) {
                $decoded = json_decode($page_settings->settings,true);
                if (is_array($decoded)) $page_settings->settings = (object) $decoded;
            }
            if ($page_settings) $settingsByLang[$page_settings->lang] = $page_settings;
        }
        

        return [
            'page'     => $page,
            'settings' => $settingsByLang,
        ];
    }
}

/**
 * Resolves the settings (language version) for the request.
 *  - If a specific lang prefix was requested and that version exists  -> use it
 *  - If a specific lang prefix was requested but version is missing   -> redirect to default lang URL (no prefix)
 *  - No prefix requested (default lang URL)                            -> use ZM_PB_DEFLANG version,
 *    fallback to any existing version if default is missing
 */
if (!function_exists('zm_pb_resolve_page_settings')) {
    function zm_pb_resolve_page_settings($pageData, $request = null) {
        if( is_null($request) ) $request = zm_pb_parse_request();
        $urlLang = $request['lang'];
        $defaultLang = ZM_PB_DEFLANG;

        // Map of url lang codes => internal lang names
        $langCodes = [];
        foreach (ZM_PB_LANGS as $langName => $langInfo) {
            $langCodes[$langInfo['code_lower']] = $langName;
        }

        $allSettings = $pageData['settings'];

        if ($urlLang !== '') {
            $langName = $langCodes[$urlLang];

            // Requested language version exists -> use it
            if (isset($allSettings[$langName])) {
                return $allSettings[$langName];
            }

            // Requested language version missing -> redirect to default lang version (URL without prefix)
            $targetUrl = ZM_PB_FULLHOST . $pageData['page']->slug . '/';
            header('Location: ' . $targetUrl, true, 302);
            exit;
        }

        // No lang prefix: default language version
        if (isset($allSettings[$defaultLang])) {
            return $allSettings[$defaultLang];
        }

        // Fallback: any existing active version
        if (!empty($allSettings)) {
            return reset($allSettings);
        }

        return null;
    }
}

if (!function_exists('zm_pb_render_page')) {
    function zm_pb_render_page($pageData, $page_settings) {
        $page = $pageData['page'];

        $seo = [];
        if ($page_settings && !empty($page_settings->settings)) {
            $decoded = json_decode($page_settings->settings, true);
            if (is_array($decoded)) $seo = $decoded;
        }

        $title = $seo['title'] ?? ($page->name ?? '');
        $description = $seo['meta_description'] ?? '';

        return [
            'templatefile' => ZM_PB_CLIENTSIDE_DEFAULT_TEMPLATE,
            'pagetitle'    => $title,
            'zm_pb_page' => [
                'id'          => (int) $page->id,
                'name'        => $page->name,
                'slug'        => $page->slug,
                'status'      => $page->status,
                'type'        => $page->type,
                'auth_type'   => $page->auth_type,
                'lang'        => $settings->lang ?? null,
                'title'       => $title,
                'description' => $description,
                'seo'         => $seo,
                'template_file' => $settings->template_file ?? null,
                'page_settings' => $settings && !empty($settings->settings) ? json_decode($settings->settings, true) : null,
                'content'       => $settings->content ?? '',
            ],
        ];
    }
}
/**
 * Parses the request URI and returns:
 *  - 'lang'   => url lang code ('', 'ru', 'en', ...) - '' means no lang prefix in URL (default lang)
 *  - 'slug'   => requested page slug
 */
if (!function_exists('zm_pb_parse_request')) {
    function zm_pb_parse_request() {
        static $parsed = null;
        if ($parsed !== null) return $parsed;

        $result = [
            'lang' => '',
            'slug' => '',
        ];

        $publicUri = $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] ?? ($_SERVER['REQUEST_URI'] ?? '');
        $uri = parse_url($publicUri, PHP_URL_PATH) ?: '';
        $basePath = parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '';
        if ($basePath !== '' && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        if (isset($_GET['m'], $_GET['slug']) && $_GET['m'] === ZM_PB_NAME) $result['slug'] = preg_replace('/[^a-z0-9\-]/i', '', $_GET['slug']);
        if (isset($_GET['m'], $_GET['lang']) && $_GET['m'] === ZM_PB_NAME) $result['lang'] = preg_replace('/[^a-z0-9\-]/i', '', $_GET['lang']);
        if (isset($_GET['m'], $_GET['slug']) && $_GET['m'] === ZM_PB_NAME) {
            $parsed = $result;
            return $parsed;
        }

        if( empty($result['slug']) || empty($result['lang']) ){
            $uri = trim($uri, '/');
            $segments = $uri === '' ? [] : explode('/', $uri);
            
            // Map of url lang codes => internal lang names
            $langCodes = [];
            foreach (ZM_PB_LANGS as $langName => $langInfo) {
                $langCodes[$langInfo['code_lower']] = $langName;
            }

            // First segment might be a language code
            if (!empty($segments) && isset($langCodes[zm_pb_stlc($segments[0])])) {
                $result['lang'] = zm_pb_stlc($segments[0]);
                array_shift($segments);
            }

            // Rest is the slug (single segment is expected, but join in case of nested)
            $result['slug'] = implode('/', $segments);
        }
        
        // The suffix belongs to the pagination block, not to the stored page slug.
        if (preg_match('~^(?:(.*)/)?page/([1-9][0-9]{0,8})$~D', $result['slug'], $pagination)) {
            $result['slug'] = $pagination[1];
            $result['page'] = (int) $pagination[2];
        }
        $parsed = $result;
        return $parsed;
    }
}


if (!function_exists('zm_pb_stlc')) {
    function zm_pb_stlc($str) { return strtolower($str); }
}
if (!function_exists('zm_pb_stuc')){ 
    function zm_pb_stuc($str) { return strtoupper($str); }
}

if (!function_exists('zm_pb_check_super_admin')) {
    function zm_pb_check_super_admin(){
        $adminId = (int) ($_SESSION['adminid'] ?? 0);
        $isSuperAdmin = $adminId === ZM_PB_SUPERADM_ID && Capsule::table('tbladmins')->where('id', $adminId)->where('disabled', 0)->exists();
        return $isSuperAdmin;
    }
}

if (!function_exists('zm_pb_has_table')) {
    $_pb_table_cache = [];
    
    function zm_pb_has_table($table) {
        global $_pb_table_cache;
        if (!isset($_pb_table_cache[$table])) {
            $_pb_table_cache[$table] = Capsule::schema()->hasTable($table);
        }
        return $_pb_table_cache[$table];
    }
}



if (!function_exists('zm_pb_has_column')) {
    $_pb_column_cache = [];
    
    function zm_pb_has_column($table, $column) {
        global $_pb_column_cache;
        $key = $table . '.' . $column;
        if (!isset($_pb_column_cache[$key])) {
            $_pb_column_cache[$key] = Capsule::schema()->hasColumn($table, $column);
        }
        return $_pb_column_cache[$key];
    }
}

if (!function_exists('zm_pb_generate_token')) {
    function zm_pb_generate_token($data, string $salt): string {
        return hash_hmac('sha256', $data, $salt);
    }
}

if (!function_exists('zm_pb_check_token')) {
    function zm_pb_check_token($pretoken, $expected, $salt): bool {
        return hash_equals( zm_pb_generate_token($pretoken,$salt) , $expected);
    }
}

if (!function_exists('zm_pb_content_error')) {
    function zm_pb_content_error($key, ...$details) {
        $template = defined('ZM_PB_ADMINLANG') ? (ZM_PB_ADMINLANG->pages_manager->content_errors->$key ?? $key) : $key;
        return $details ? sprintf($template, ...$details) : $template;
    }
}

if (!function_exists('zm_pb_save_grapes_content')) {
    function zm_pb_save_grapes_content($pageId, $lang, $rawContent, $writeAsset = null) {
        if (!isset(ZM_PB_LANGS[$lang])) throw new InvalidArgumentException(zm_pb_content_error('unsupported_language'));
        if (!is_string($rawContent) || trim($rawContent) === '') return '';

        if (strncmp($rawContent, 'zm_pb_b64:', 10) === 0) {
            $decodedContent = base64_decode(substr($rawContent, 10), true);
            if ($decodedContent === false) throw new InvalidArgumentException(zm_pb_content_error('invalid_encoding'));
            $rawContent = $decodedContent;
        }

        $data = json_decode($rawContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Accept older requests when an upstream WHMCS layer escaped the JSON string.
            foreach ([stripslashes($rawContent), html_entity_decode($rawContent, ENT_QUOTES | ENT_HTML5, 'UTF-8')] as $candidate) {
                $data = json_decode($candidate, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $rawContent = $candidate;
                    break;
                }
            }
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException(zm_pb_content_error('invalid_json', json_last_error_msg(), strlen($rawContent)));
            }
        }
        if (is_array($data) && is_string($data['html'] ?? null)) {
            require_once ZM_PB_LIBDIR . 'smarty_blocks.php';
            ZM_PB_SmartyBlocks::validateHtml($data['html']);
        }
        if (is_array($data) && ($data['format'] ?? '') === 'grapesjs'
            && is_array($data['project'] ?? null) && is_string($data['html'] ?? null)
            && is_array($data['assets'] ?? null) && !isset($data['code'])) {
            $data['html'] = preg_replace('~^<body(?:\s[^>]*)?>(.*)</body>$~is', '$1', trim($data['html']));
            return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
        }
        if (!is_array($data) || ($data['format'] ?? '') !== 'grapesjs' || !is_array($data['project'] ?? null)
            || !is_string($data['html'] ?? null)) {
            $fields = is_array($data) ? implode(', ', array_keys($data)) : gettype($data);
            throw new InvalidArgumentException(zm_pb_content_error('invalid_project', $fields));
        }
        $data['html'] = preg_replace('~^<body(?:\s[^>]*)?>(.*)</body>$~is', '$1', trim($data['html']));
        $data['css'] = is_string($data['css'] ?? null) ? $data['css'] : '';
        $data['code'] = is_array($data['code'] ?? null) ? $data['code'] : [];

        $directory = ZM_PB_ASSETSDIR . 'generated/';
        $writeAsset = $writeAsset ?? function ($path, $contents) {
            if (file_put_contents($path, $contents, LOCK_EX) !== strlen($contents)) throw new RuntimeException(zm_pb_content_error('asset_save_failed'));
        };
        if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
            throw new RuntimeException(zm_pb_content_error('assets_dir_failed'));
        }
        $prefix = 'page_' . (int) $pageId . '_' . $lang . '_';
        $urlBase = ZM_PB_ASSETSURL . 'generated/';
        $cssUrl = '';
        if ($data['css'] !== '') {
            $file = $prefix . 'styles.css';
            $writeAsset($directory . $file, $data['css']);
            $cssUrl = $urlBase . rawurlencode($file) . '?v=' . substr(hash('sha256', $data['css']), 0, 12);
        }

        $assets = [];
        foreach ($data['code'] as $codeBlock) {
            if (!is_array($codeBlock)) continue;
            $id = $codeBlock['id'] ?? '';
            $type = $codeBlock['type'] ?? '';
            $code = $codeBlock['code'] ?? '';
            if (!is_string($id) || !preg_match('/^code_[a-z0-9]{1,32}$/', $id)
                || !in_array($type, ['css', 'js'], true) || !is_string($code)) {
                throw new InvalidArgumentException(zm_pb_content_error('invalid_code_block'));
            }
            if ($code === '') continue;
            $file = $prefix . $id . '.' . $type;
            $writeAsset($directory . $file, $code);
            $assets[$id] = [
                'type' => $type,
                'url' => $urlBase . rawurlencode($file) . '?v=' . substr(hash('sha256', $code), 0, 12),
            ];
        }

        return json_encode([
            'format' => 'grapesjs',
            'project' => $data['project'],
            'html' => $data['html'],
            'cssUrl' => $cssUrl,
            'assets' => $assets,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
    }
}
if (!function_exists('zm_pb_transtaliteration')) {
    function zm_pb_transtaliteration($name,$type="file") {
        
        $transliteration_map_letters = [
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
            'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
            'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
            'у' => 'u', 'ф' => 'f', 'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'shch', 'ъ' => '', 'ы' => 'y', 'ь' => '',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
            'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
            'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
            'У' => 'U', 'Ф' => 'F', 'Х' => 'Kh', 'Ц' => 'Ts', 'Ч' => 'Ch',
            'Ш' => 'Sh', 'Щ' => 'Shch', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
            
            'є' => 'ie', 'і' => 'i', 'ї' => 'i', 'ґ' => 'g',
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            
            'ў' => 'u', 'Ў' => 'U',
        ];

        $transliteration_map_specsymbols = [
            // Replace punctuation and spacing.
            ' ' => '_', '-' => '_', '.' => '_', ',' => '_',
            '(' => '', ')' => '', '[' => '', ']' => '',
            '{' => '', '}' => '', '/' => '_', '\\' => '_',
            ':' => '', ';' => '', '!' => '', '?' => '',
            '"' => '', "'" => '', '`' => '', '~' => '',
            '@' => '_', '#' => '_', '$' => '_', '%' => '_',
            '^' => '_', '&' => '_', '*' => '_', '+' => '_',
            '=' => '_', '|' => '_',
        ];
        
        $transliteration_name = strtr($name, $transliteration_map_letters);

        if( $type === 'file' ) $transliteration_name = strtr($transliteration_name, $transliteration_map_specsymbols);
        
        $transliteration_name = preg_replace('/[^A-Za-z0-9_]/', '', $transliteration_name);
        $transliteration_name = preg_replace('/_+/', '_', $transliteration_name);
        $transliteration_name = trim($transliteration_name, '_');
        $transliteration_name = zm_pb_stlc($transliteration_name);
        
        return $transliteration_name;
    }
}
