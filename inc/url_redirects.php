<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Collapse repeated slashes in an origin-form request before parse_url sees // as a host. */
function zm_pb_slash_redirect_target($uri)
{
    if (!is_string($uri) || $uri === '' || $uri[0] !== '/' || preg_match('/[\x00-\x20\x7f#]/', $uri)) return null;
    $separator = strpos($uri, '?');
    $path = $separator === false ? $uri : substr($uri, 0, $separator);
    $cleanPath = preg_replace('~/+~', '/', $path);
    if ($cleanPath === $path) return null;
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    if ($base !== '' && $cleanPath !== $base && strpos($cleanPath, $base . '/') !== 0) return null;
    return $cleanPath . ($separator === false ? '' : substr($uri, $separator));
}

/** Use the same eligibility check for direct and slash-normalized PHP URLs. */
function zm_pb_php_slug_redirect_eligible($slug, $systemOverrideActive = null)
{
    if (!is_string($slug) || $slug === 'index' || !preg_match('/^[a-z0-9-]+$/iD', $slug)) return false;
    if (in_array($slug, ZM_PB_MAINSYSTEM_DEFAULT_PAGES, true)) {
        if (!ZM_PB_MAINSYSTEM_PRETTY_URLS || !ZM_PB_ENABLE_PAGE_OVERRIDES) return false;
        if ($systemOverrideActive !== null) return (bool) $systemOverrideActive;
        if (!zm_pb_has_table('zm_pb_module_settings')) return false;
        $settings = \Illuminate\Database\Capsule\Manager::table('zm_pb_module_settings')
            ->where('setting_name', 'page_overrides')->value('setting_value');
        $overrides = json_decode($settings ?? '[]', true);
        $sources = is_array($overrides['from'] ?? null) ? $overrides['from'] : [];
        $index = array_search($slug, $sources, true);
        $target = $index === false ? null : ($overrides['to'][$index] ?? null);
        $type = $index === false ? null : ($overrides['type'][$index] ?? null);
        return is_string($target) && $target !== '' && in_array($type, ZM_PB_ACCEPTED_OVERRIDES, true);
    }
    if (!ZM_PB_PRETTY_URLS || zm_pb_is_native_route($slug) || !zm_pb_has_table('zm_pb_pages')) return false;
    return \Illuminate\Database\Capsule\Manager::table('zm_pb_pages')->where('slug', $slug)
        ->where('status', 'publish')->where('type', '!=', 'system')->exists();
}

/** Canonicalize the public request, never the internal rewrite target. */
function zm_pb_index_redirect_target($uri)
{
    if (!ZM_PB_MAINSYSTEM_PRETTY_URLS) return null;
    $parts = parse_url($uri);
    if ($parts === false || isset($parts['host']) || isset($parts['scheme'])) return null;
    $path = $parts['path'] ?? '';
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    if ($path === '' || $path[0] !== '/' || ($base !== '' && strpos($path, $base . '/') !== 0)) return null;
    if (!preg_match('~/index\.php$~iD', $path)) return null;
    $target = substr($path, 0, -strlen('index.php'));
    return $target . (isset($parts['query']) && $parts['query'] !== '' ? '?' . $parts['query'] : '');
}

/** Canonical URL for a single-segment PHP page claimed by the page router. */
function zm_pb_php_slug_redirect_target($uri, $slug, $lang = '')
{
    if (!preg_match('/^[a-z0-9-]+$/iD', $slug)) return null;
    $parts = parse_url($uri);
    if ($parts === false || isset($parts['host']) || isset($parts['scheme'])) return null;
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    $prefix = $lang !== '' ? $lang . '/' : '';
    $expected = $base . '/' . $prefix . $slug . '.php';
    if (strcasecmp($parts['path'] ?? '', $expected) !== 0) return null;
    $target = $base . '/' . $prefix . strtolower($slug) . '/';
    return $target . (isset($parts['query']) && $parts['query'] !== '' ? '?' . $parts['query'] : '');
}
