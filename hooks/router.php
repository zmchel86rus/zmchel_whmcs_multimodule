<?php
if (!defined("WHMCS")) die('Direct access not allowed');
if (php_sapi_name() === 'cli' || defined('ADMINAREA')
    || !in_array($_SERVER['REQUEST_METHOD'] ?? '', ['GET', 'HEAD'], true)) return;
use Illuminate\Database\Capsule\Manager as Capsule;

//perf301Mark('PB_route_S');

$request = zm_pb_parse_request();
// Installed Apache rules may still exist after the feature is disabled.
if (!ZM_PB_ENABLE_LANG_ROUTE && !empty($request['lang'])) return;

$publicUri = $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] ?? ($_SERVER['REQUEST_URI'] ?? '');
$requestPath = parse_url($publicUri, PHP_URL_PATH);
if (preg_match('/^\/admin\//i', $requestPath)) return;
if ((!empty($_GET['rp']) && $_GET['rp'] !== '/' && empty($request['lang']) && empty($request['page'])
        && (!is_string($_GET['rp']) || trim($_GET['rp'], '/') !== trim($request['slug'], '/'))) ||
    (isset($_GET['m']) && $_GET['m'] !== ZM_PB_NAME)) return;

if (!empty($request['lang']) && empty($request['slug']) && ($_GET['rp'] ?? null) === '/') {
    $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] = $publicUri;
    $queryString = $_SERVER['QUERY_STRING'] ?? '';
    $_SERVER['REQUEST_URI'] = '/index.php?' . ($queryString !== '' ? $queryString : 'rp=/');
    $_SERVER['REDIRECT_URL'] = '/index.php';
}

// An explicit selection must reach WHMCS before the late redirect hook runs.
// Do not render an override or force the previous URL language on this request.
if (defined('ZMPB_LANGUAGE_SWITCH_PENDING')) return;

// Apply the language from the URL to this response without changing the client profile.
require_once ZM_PB_INCDIR . 'route_guard.php';
if (!empty($request['lang']) && !zm_pb_route_uses_user_language($request)) {
    foreach (ZM_PB_LANGS as $languageName => $languageInfo) {
        if ($languageInfo['code_lower'] !== $request['lang']) continue;
        if (!defined('USER_LANG')) define('USER_LANG', $languageName);
        $languageFile = ROOTDIR . '/lang/' . $languageName . '.php';
        if (is_file($languageFile)) {
            $_LANG = [];
            require $languageFile;
            $overrideFile = ROOTDIR . '/lang/overrides/' . $languageName . '.php';
            if (is_file($overrideFile)) require $overrideFile;
            $GLOBALS['_LANG'] = $_LANG;
            add_hook('ClientAreaPage', 1, function () use ($languageName, $_LANG) {
                return ['LANG' => $_LANG, 'language' => $languageName];
            });
        }
        break;
    }
}

$requested_slug = strtolower(trim((string) ($request['slug'] ?? ''), '/'));
$system_page = $requested_slug === '' || $requested_slug === 'index.php' ? 'index' : null;
if ($system_page === null) {
    $candidate = preg_replace('/\.php$/i', '', $requested_slug);
    if (in_array($candidate, ZM_PB_MAINSYSTEM_DEFAULT_PAGES, true)) $system_page = $candidate;
}
$override_target = '';
$override_type = '';
if ($system_page !== null && ZM_PB_ENABLE_PAGE_OVERRIDES) {
    $settings = Capsule::table('zm_pb_module_settings')
        ->where('setting_name', 'page_overrides')
        ->first();
    $page_overrides = json_decode($settings->setting_value ?? '[]', true);
    $sources = is_array($page_overrides['from'] ?? null) ? $page_overrides['from'] : [];
    $index = array_search($system_page, $sources, true);
    if ($index !== false) {
        $target = $page_overrides['to'][$index] ?? '';
        $type = $page_overrides['type'][$index] ?? '';
        if (is_string($target) && $target !== '' && in_array($type, ZM_PB_ACCEPTED_OVERRIDES, true)) {
            $override_target = $target;
            $override_type = $type;
        }
    }
}
$hasLanguageSelection = false;
foreach ($_GET as $key => $value) {
    if (strcasecmp((string) $key, 'language') === 0) { $hasLanguageSelection = true; break; }
}
if (!$hasLanguageSelection && !isset($_GET['m'])
    && preg_match('/^([a-z0-9-]+)\.php$/iD', $requested_slug, $phpSlug)) {
    $candidate = strtolower($phpSlug[1]);
    require_once ZM_PB_INCDIR . 'url_redirects.php';
    if (zm_pb_php_slug_redirect_eligible($candidate, $system_page !== null ? $override_target !== '' : null)) {
        $target = zm_pb_php_slug_redirect_target($publicUri, $candidate, $request['lang'] ?? '');
        if ($target !== null) {
            header('Location: ' . $target, true, 301);
            exit;
        }
    }
}
// HEAD must follow the same page lookup as GET. Returning here lets WHMCS
// handle module URLs as unknown routes and respond with a false 404.
if ($system_page === null) {
    require_once ZM_PB_INCDIR . 'route_guard.php';
    if (zm_pb_is_native_route($requested_slug)) return;
    // Unknown URLs may be valid WHMCS or other module routes. Only claim pages
    // that actually exist in this module; WHMCS handles everything else.
    if (!zm_pb_has_table('zm_pb_pages') || !Capsule::table('zm_pb_pages')->where('slug', $request['slug'])->exists()) return;
}

if( ZM_PB_CUSTOM_HEADER || ZM_PB_CUSTOM_FOOTER ){
    $settings = Capsule::table('zm_pb_module_settings')
        ->whereIn('setting_name', ['custom_footer', 'custom_header'])
        ->pluck('setting_value', 'setting_name');

    $custom_header = json_decode($settings['custom_header'] ?? '""', true);
    $custom_footer = json_decode($settings['custom_footer'] ?? '""', true);
    $custom_header = is_string($custom_header) ? $custom_header : '';
    $custom_footer = is_string($custom_footer) ? $custom_footer : '';

    if( ZM_PB_CUSTOM_HEADER ){
        add_hook('ClientAreaHeadOutput', 1, function($vars) use ($custom_header){ return html_entity_decode($custom_header, ENT_QUOTES | ENT_HTML5, 'UTF-8');});
    }
    if( ZM_PB_CUSTOM_FOOTER ){
        add_hook('ClientAreaFooterOutput', 1, function($vars) use ($custom_footer){ return html_entity_decode($custom_footer, ENT_QUOTES | ENT_HTML5, 'UTF-8');});
    }
}

if ($system_page !== null) {
    if ($override_target === '') return;

    if ($system_page === 'index' && !defined('ZMPB_PAGE_OVERRIDE_MAIN')) define('ZMPB_PAGE_OVERRIDE_MAIN', true);
    if (!defined('ZMPB_PAGE_OVERRIDE_TYPE')) define('ZMPB_PAGE_OVERRIDE_TYPE', $override_type);
    $request['override_from'] = $system_page;
    $request['override_path'] = $requested_slug === '' || substr($requested_slug, -4) === '.php'
        ? $requested_slug : $requested_slug . '/';
    $request['slug'] = $override_target;
}

// A partial override still lets WHMCS render the base route. The pagination
// suffix must not reach its native router as an unknown system page.
if (isset($request['page']) && $system_page !== null) {
    $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] = $publicUri;
    $nativeRoute = $system_page === 'index' ? '/' : '/' . $system_page;
    $_GET['rp'] = $nativeRoute;
    $_REQUEST['rp'] = $nativeRoute;
    parse_str($_SERVER['QUERY_STRING'] ?? '', $nativeQuery);
    $nativeQuery['rp'] = $nativeRoute;
    $_SERVER['QUERY_STRING'] = http_build_query($nativeQuery, '', '&', PHP_QUERY_RFC3986);
    $_SERVER['REQUEST_URI'] = '/index.php?' . $_SERVER['QUERY_STRING'];
}

if ( !defined("ZMPB_BUILD_PAGE") ) {
    define('ZMPB_BUILD_PAGE', true );
    require_once ZM_PB_PAGE_BUILDER_FILE;
}
