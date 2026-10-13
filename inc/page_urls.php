<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Build a public URL for a module page in the configured URL mode. */
function zm_pb_module_page_url($slug, $language = null)
{
    $slug = trim((string) $slug, '/');
    $language = isset(ZM_PB_LANGS[$language]) ? $language : ZM_PB_DEFLANG;
    $base = rtrim(ZM_PB_FULLHOST, '/') . '/';
    $code = ZM_PB_ENABLE_LANG_ROUTE && $language !== ZM_PB_DEFLANG
        ? (ZM_PB_LANGS[$language]['code_ISO639_1'] ?? '') : '';

    if (ZM_PB_PRETTY_URLS) {
        return $base . ($code !== '' ? $code . '/' : '')
            . implode('/', array_map('rawurlencode', explode('/', $slug))) . '/';
    }

    return $base . '?m=' . rawurlencode(ZM_PB_NAME) . '&slug=' . rawurlencode($slug)
        . ($code !== '' ? '&lang=' . rawurlencode($code) : '');
}

/** Compare a redirect target with the URL the browser actually requested. */
function zm_pb_is_self_redirect($target)
{
    $requestUri = $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] ?? ($_SERVER['REQUEST_URI'] ?? '');
    if (preg_match('~^[A-Z]+\s+(\S+)\s+HTTP/\d(?:\.\d)?$~i', $_SERVER['THE_REQUEST'] ?? '', $match)) {
        $requestUri = $match[1];
    }
    $requested = parse_url($requestUri);
    $destination = parse_url($target);
    if ($requested === false || $destination === false || !is_array($requested) || !is_array($destination)) return false;
    if (isset($destination['host'])) {
        $site = parse_url(ZM_PB_FULLHOST);
        if ($site === false || strcasecmp($destination['host'], $site['host'] ?? '') !== 0
            || ($destination['port'] ?? null) !== ($site['port'] ?? null)
            || strcasecmp($destination['scheme'] ?? '', $site['scheme'] ?? '') !== 0) return false;
    }
    $requestQuery = [];
    $targetQuery = [];
    parse_str($requested['query'] ?? '', $requestQuery);
    parse_str($destination['query'] ?? '', $targetQuery);
    ksort($requestQuery);
    ksort($targetQuery);
    return ($requested['path'] ?? '/') === ($destination['path'] ?? '/') && $requestQuery === $targetQuery;
}
