<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Return the public prefix for a language, including the default when enabled. */
function zm_pb_language_route_code($language)
{
    if (!ZM_PB_ENABLE_LANG_ROUTE || !isset(ZM_PB_LANGS[$language])) return '';
    if ($language === ZM_PB_DEFLANG
        && !(defined('ZM_PB_ENABLE_DEFAULT_LANG_ROUTE') && ZM_PB_ENABLE_DEFAULT_LANG_ROUTE)) return '';
    return ZM_PB_LANGS[$language]['route_code'];
}

/** Build a public URL for a module page in the configured URL mode. */
function zm_pb_module_page_url($slug, $language = null)
{
    $slug = trim((string) $slug, '/');
    $language = isset(ZM_PB_LANGS[$language]) ? $language : ZM_PB_DEFLANG;
    $base = rtrim(ZM_PB_FULLHOST, '/') . '/';
    $code = zm_pb_language_route_code($language);

    if (ZM_PB_PRETTY_URLS) {
        return $base . ($code !== '' ? $code . '/' : '')
            . implode('/', array_map('rawurlencode', explode('/', $slug))) . '/';
    }

    return $base . '?m=' . rawurlencode(ZM_PB_NAME) . '&slug=' . rawurlencode($slug)
        . ($code !== '' ? '&lang=' . rawurlencode($code) : '');
}

/** Canonicalize a known module page that was requested without a language route. */
function zm_pb_default_language_page_redirect_target($uri, $slug, $page = null)
{
    $code = zm_pb_language_route_code(ZM_PB_DEFLANG);
    if ($code === '') return null;
    $parts = parse_url($uri);
    if ($parts === false || isset($parts['host']) || isset($parts['scheme'])) return null;
    $path = $parts['path'] ?? '';
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    if ($path === '' || $path[0] !== '/' || ($base !== '' && $path !== $base && strpos($path, $base . '/') !== 0)) return null;
    parse_str($parts['query'] ?? '', $query);
    if (isset($query['language'])) return null;
    $relative = ltrim(substr($path, strlen($base)), '/');
    $firstSegment = explode('/', $relative, 2)[0];
    foreach (ZM_PB_LANGS as $info) {
        if ($firstSegment !== '' && strcasecmp($firstSegment, $info['route_code']) === 0) return null;
    }

    $moduleQuery = ($query['m'] ?? null) === ZM_PB_NAME && is_string($query['slug'] ?? null);
    if (ZM_PB_PRETTY_URLS && !$moduleQuery) {
        $target = $base . '/' . $code . '/' . $relative;
        if (isset($parts['query']) && $parts['query'] !== '') $target .= '?' . $parts['query'];
        return $target === $uri ? null : $target;
    }

    $target = zm_pb_module_page_url($slug, ZM_PB_DEFLANG);
    foreach (['m', 'slug', 'lang', 'rp'] as $reserved) unset($query[$reserved]);
    if (!ZM_PB_PRETTY_URLS && $page !== null && !isset($query['page'])) $query['page'] = (int) $page;
    if ($query) $target .= (strpos($target, '?') === false ? '?' : '&')
        . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
    return $target === $uri ? null : $target;
}
