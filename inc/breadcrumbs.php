<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

function zm_pb_breadcrumb_label($settings)
{
    $label = trim((string) ($settings->breadcrumb ?? ''));
    if ($label === '') $label = trim((string) ($settings->meta_title ?? ''));
    $label = str_ireplace(['%%SEP%%', '%%comname%%'], [ZM_PB_SEPARATOR, $GLOBALS['CONFIG']['CompanyName'] ?? ''], $label);
    return htmlspecialchars($label, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Identify only a root breadcrumb for a supported WHMCS override. */
function zm_pb_breadcrumb_source($link)
{
    if (!is_string($link) || $link === '') return null;
    $parts = parse_url(html_entity_decode($link, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    if ($parts === false) return null;
    if (isset($parts['host']) && strcasecmp($parts['host'], parse_url(ZM_PB_FULLHOST, PHP_URL_HOST) ?: '') !== 0) return null;
    $path = $parts['path'] ?? '';
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    if ($base !== '' && ($path === $base || strpos($path, $base . '/') === 0)) $path = substr($path, strlen($base));
    $path = trim($path, '/');
    if (ZM_PB_ENABLE_LANG_ROUTE) {
        $segments = explode('/', $path, 2);
        foreach (ZM_PB_LANGS as $info) if ($segments[0] === $info['code_lower']) { $path = $segments[1] ?? ''; break; }
    }
    $path = preg_replace('/\.php$/i', '', $path);
    if ($path === '' || $path === 'index') {
        parse_str($parts['query'] ?? '', $query);
        if (isset($query['m']) || (!empty($query['rp']) && $query['rp'] !== '/')) return null;
        return 'index';
    }
    return in_array($path, ZM_PB_MAINSYSTEM_DEFAULT_PAGES, true) ? $path : null;
}

function zm_pb_breadcrumb_home_url($language)
{
    if (ZM_PB_ENABLE_LANG_ROUTE && ZM_PB_PRETTY_URLS && $language !== ZM_PB_DEFLANG && isset(ZM_PB_LANGS[$language])) {
        return ZM_PB_FULLHOST . ZM_PB_LANGS[$language]['code_lower'] . '/';
    }
    return ZM_PB_FULLHOST . (ZM_PB_MAINSYSTEM_PRETTY_URLS ? '' : 'index.php');
}

function zm_pb_breadcrumb_overrides($language)
{
    if (!ZM_PB_ENABLE_PAGE_OVERRIDES || !zm_pb_has_table('zm_pb_module_settings')) return [];
    static $configuration = null;
    static $pages = [];
    if ($configuration === null) {
        $row = \Illuminate\Database\Capsule\Manager::table('zm_pb_module_settings')->where('setting_name', 'page_overrides')->first();
        $configuration = json_decode($row->setting_value ?? '[]', true);
        if (!is_array($configuration)) $configuration = [];
    }
    $replacements = [];
    foreach ((array) ($configuration['from'] ?? []) as $index => $source) {
        $type = $configuration['type'][$index] ?? '';
        $slug = $configuration['to'][$index] ?? '';
        if (!is_string($source) || !in_array($source, ZM_PB_MAINSYSTEM_DEFAULT_PAGES, true) || !in_array($type, ZM_PB_ACCEPTED_OVERRIDES, true) || !is_string($slug) || $slug === '') continue;
        if ($source !== 'index' && !in_array($type, ['full', 'meta_only', 'partial_before_meta', 'partial_after_meta'], true)) continue;
        if (!array_key_exists($slug, $pages)) $pages[$slug] = zm_pb_load_page_by_slug($slug);
        $data = $pages[$slug];
        $page = $data['page'] ?? null;
        $loggedIn = !empty($_SESSION['uid']);
        if (!$page || $page->status !== 'publish' || $page->type === 'system' || ($page->auth_type === 'auth' && !$loggedIn) || ($page->auth_type === 'noauth' && $loggedIn)) continue;
        $available = $data['settings'] ?? [];
        $localized = $available[$language] ?? $available[ZM_PB_DEFLANG] ?? ($available ? reset($available) : null);
        if (!$localized || !is_object($localized->settings ?? null)) continue;
        $label = zm_pb_breadcrumb_label($localized->settings);
        if ($label !== '') $replacements[$source] = $label;
    }
    return $replacements;
}

function zm_pb_update_breadcrumbs(array $breadcrumbs, array $replacements, $language, array $context = [])
{
    $settings = $context['settings'] ?? null;
    if ($settings && isset($settings->enable_breadcrumb) && !$settings->enable_breadcrumb) return [];
    foreach ($breadcrumbs as $key => $item) {
        if (!is_array($item)) continue;
        $source = zm_pb_breadcrumb_source($item['link'] ?? '');
        if ($source === null && count($breadcrumbs) === 1 && ($context['source'] ?? null) === 'index') $source = 'index';
        if ($source !== null && isset($replacements[$source])) {
            $breadcrumbs[$key]['label'] = $replacements[$source];
            if ($source === 'index' && ($item['link'] ?? '') !== '') $breadcrumbs[$key]['link'] = zm_pb_breadcrumb_home_url($language);
        }
    }
    if ($settings && $breadcrumbs) {
        $label = zm_pb_breadcrumb_label($settings);
        $last = array_key_last($breadcrumbs);
        if ($label !== '' && is_array($breadcrumbs[$last])) $breadcrumbs[$last]['label'] = $label;
    }
    return $breadcrumbs;
}

function zm_pb_client_breadcrumbs(array $vars)
{
    if (!is_array($vars['breadcrumb'] ?? null) || !$vars['breadcrumb']) return [];
    $context = $GLOBALS['zm_pb_breadcrumb_context'] ?? [];
    $language = strtolower((string) ($context['lang'] ?? $vars['language'] ?? $_SESSION['Language'] ?? ZM_PB_DEFLANG));
    $request = zm_pb_parse_request();
    if (ZM_PB_ENABLE_LANG_ROUTE && !empty($request['lang'])) {
        foreach (ZM_PB_LANGS as $name => $info) if ($info['code_lower'] === $request['lang']) { $language = $name; break; }
    }
    if (!isset(ZM_PB_LANGS[$language])) $language = ZM_PB_DEFLANG;
    $breadcrumbs = zm_pb_update_breadcrumbs($vars['breadcrumb'], zm_pb_breadcrumb_overrides($language), $language, $context);
    return ['breadcrumb' => $breadcrumbs];
}
