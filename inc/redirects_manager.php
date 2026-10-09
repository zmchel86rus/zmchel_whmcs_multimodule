<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

function zm_pb_redirects_text() {
    if (isset(ZM_PB_ADMINLANG->redirects_manager)) return ZM_PB_ADMINLANG->redirects_manager;
    $language = require ZM_PB_ALANGDIR . 'english.php';
    return $language->redirects_manager;
}

/** Store same-site URLs as paths. No regex rules, protocol-relative URLs or header controls. */
function zm_pb_redirect_url($value, $source = false) {
    if (!is_string($value)) throw new InvalidArgumentException('invalid_url');
    $value = trim($value);
    if ($value === '' || preg_match('/[\x00-\x20\x7f<>"\\\\]/', $value)
        || preg_match('/[\x00-\x1f\x7f\\\\]/', rawurldecode($value)) || strpos($value, '//') === 0) {
        throw new InvalidArgumentException('invalid_url');
    }
    $parts = parse_url($value); $base = parse_url(ZM_PB_FULLHOST);
    if ($parts === false || isset($parts['user']) || isset($parts['pass']) || isset($parts['fragment'])
        || (isset($parts['scheme']) && !isset($parts['host']))
        || (isset($parts['scheme']) && !in_array(strtolower($parts['scheme']), ['http', 'https'], true))) {
        throw new InvalidArgumentException('invalid_url');
    }
    if (isset($parts['host']) && (strcasecmp($parts['host'], $base['host']) !== 0 || ($parts['port'] ?? null) !== ($base['port'] ?? null))) {
        if ($source) throw new InvalidArgumentException('invalid_url');
        return $value;
    }
    $path = $parts['path'] ?? '/';
    if ($path === '' || $path[0] !== '/') throw new InvalidArgumentException('invalid_url');
    if (preg_match('~(?:^|/)\.{1,2}(?:/|$)~', rawurldecode($path))) throw new InvalidArgumentException('invalid_url');
    $path = $path === '/' ? '/' : rtrim($path, '/');
    $query = [];
    parse_str($parts['query'] ?? '', $query); ksort($query);
    return $path . ($query ? '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986) : '');
}

function zm_pb_redirect_absolute($url) {
    if (preg_match('~^https?://~i', $url)) return $url;
    $base = parse_url(ZM_PB_FULLHOST);
    return $base['scheme'] . '://' . $base['host'] . (isset($base['port']) ? ':' . $base['port'] : '') . $url;
}

function zm_pb_redirect_request($url) {
    $parts = parse_url($url); $query = [];
    parse_str($parts['query'] ?? '', $query);
    if (($query['m'] ?? '') === ZM_PB_NAME && is_string($query['slug'] ?? null)) {
        return ['slug' => $query['slug'], 'lang' => is_string($query['lang'] ?? null) ? $query['lang'] : ''];
    }
    $basePath = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    $path = $parts['path'] ?? '/';
    if ($basePath !== '' && $path !== $basePath && strpos($path, $basePath . '/') !== 0) return null;
    $segments = explode('/', trim(substr($path, strlen($basePath)), '/'));
    $language = '';
    foreach (ZM_PB_LANGS as $info) {
        if (($segments[0] ?? '') === $info['code_lower']) { $language = array_shift($segments); break; }
    }
    return ['slug' => rawurldecode(implode('/', $segments)), 'lang' => $language];
}
