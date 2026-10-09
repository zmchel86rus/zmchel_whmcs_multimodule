<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

function zm_pb_sitemap_text()
{
    if (isset(ZM_PB_ADMINLANG->sitemap_manager)) return ZM_PB_ADMINLANG->sitemap_manager;
    $language = require ZM_PB_ALANGDIR . 'english.php';
    return $language->sitemap_manager;
}

function zm_pb_sitemap_interval($frequency = null)
{
    $intervals = ['every_hour' => 3600, 'every_3hour' => 10800, 'every_6hour' => 21600,
        'every_12hour' => 43200, 'every_day' => 86400, 'every_2day' => 172800,
        'every_3day' => 259200, 'every_week' => 604800, 'every_month' => 2592000];
    return $intervals[$frequency ?? (defined('ZM_PB_SITEMAP_UPDFREQ') ? ZM_PB_SITEMAP_UPDFREQ : '')] ?? 86400;
}

function zm_pb_sitemap_timestamp($value)
{
    if ($value === '' || $value === null) return 0;
    if (is_numeric($value)) return max(0, (int) $value);
    return is_string($value) ? max(0, strtotime($value) ?: 0) : 0;
}

/** Read the persisted value as well: a concurrent generator may have updated the immutable constant. */
function zm_pb_sitemap_last_update()
{
    $value = defined('ZM_PB_SITEMAP_LASTUPD') ? ZM_PB_SITEMAP_LASTUPD : '';
    $path = ZM_PB_INCDIR . 'editable_consts.php';
    if (is_readable($path)) {
        $source = file_get_contents($path);
        if (is_string($source) && preg_match('/\bdefine\s*\(\s*["\']ZM_PB_SITEMAP_LASTUPD["\']\s*,\s*(?:["\']([0-9TZ :.+\/-]*)["\']|(\d+))\s*\)/', $source, $match)) {
            $value = $match[2] ?? $match[1];
        }
    }
    return zm_pb_sitemap_timestamp($value);
}

function zm_pb_sitemap_due($now = null)
{
    if (!defined('ZM_PB_ENABLE_SITEMAP') || !ZM_PB_ENABLE_SITEMAP) return false;
    $last = zm_pb_sitemap_last_update();
    return !$last || ($now ?? time()) >= $last + zm_pb_sitemap_interval();
}

function zm_pb_sitemap_owned($name)
{
    return (bool) preg_match('/^sitemap_(?:pages|posts)(?:_[1-9][0-9]*)?\.xml$/D', $name);
}

/** List local sitemap files without loading large domain sitemaps into memory or following XML entities. */
function zm_pb_sitemap_files()
{
    $files = [];
    foreach (glob(ROOTDIR . '/*.xml') ?: [] as $path) {
        if (is_link($path) || !is_file($path) || !is_readable($path)) continue;
        $reader = new XMLReader();
        $previous = libxml_use_internal_errors(true);
        $root = '';
        try {
            if ($reader->open($path, null, LIBXML_NONET)) {
                while ($reader->read()) {
                    if ($reader->nodeType === XMLReader::DOC_TYPE) break;
                    if ($reader->nodeType === XMLReader::ELEMENT) {
                        if ($reader->namespaceURI === 'http://www.sitemaps.org/schemas/sitemap/0.9'
                            && in_array($reader->localName, ['urlset', 'sitemapindex'], true)) $root = $reader->localName;
                        break;
                    }
                }
            }
        } finally {
            $reader->close(); libxml_clear_errors(); libxml_use_internal_errors($previous);
        }
        if ($root === '') continue;
        $name = basename($path);
        $files[$name] = ['name' => $name, 'url' => rtrim(ZM_PB_FULLHOST, '/') . '/' . rawurlencode($name),
            'lastmod' => gmdate('c', filemtime($path)), 'type' => $root, 'owned' => zm_pb_sitemap_owned($name)];
    }
    ksort($files);
    return $files;
}

function zm_pb_sitemap_overrides($configuration)
{
    $result = [];
    if (!ZM_PB_ENABLE_PAGE_OVERRIDES || !is_array($configuration)) return $result;
    foreach ((array) ($configuration['from'] ?? []) as $index => $source) {
        $target = $configuration['to'][$index] ?? '';
        $type = $configuration['type'][$index] ?? '';
        if (!is_string($source) || !in_array($source, ZM_PB_MAINSYSTEM_DEFAULT_PAGES, true)
            || !is_string($target) || $target === '' || !in_array($type, ZM_PB_ACCEPTED_OVERRIDES, true)) continue;
        $result[$target][] = $source;
    }
    return $result;
}

function zm_pb_sitemap_url($slug, $language, $source = null, $custom = '')
{
    $base = rtrim(ZM_PB_FULLHOST, '/') . '/';
    $prefix = ZM_PB_ENABLE_LANG_ROUTE && $language !== ZM_PB_DEFLANG ? (ZM_PB_LANGS[$language]['code_lower'] ?? '') : '';
    if ($source !== null) {
        $path = $source === 'index' ? (ZM_PB_MAINSYSTEM_PRETTY_URLS ? '' : 'index.php')
            : $source . (ZM_PB_MAINSYSTEM_PRETTY_URLS ? '/' : '.php');
        return $base . (ZM_PB_PRETTY_URLS && $prefix !== '' ? $prefix . '/' : '') . $path;
    }
    $path = trim($slug, '/');
    // Previously generated URLs are recalculated when pretty URL settings change.
    if ($custom !== '' && rtrim($custom, '/') !== rtrim($base . $path, '/')) {
        $parts = parse_url($custom);
        $host = parse_url($base);
        if ($parts === false || isset($parts['user']) || isset($parts['pass'])
            || (isset($parts['scheme']) && !in_array(strtolower($parts['scheme']), ['http', 'https'], true))
            || (isset($parts['host']) && strcasecmp($parts['host'], $host['host']) !== 0)
            || (($parts['port'] ?? null) !== ($host['port'] ?? null))
            || preg_match('/[\x00-\x20\x7f<>"\\\\]/', $custom)) return null;
        $basePath = $host['path'] ?? '/';
        $customPath = $parts['path'] ?? '';
        if (isset($parts['host']) || (isset($customPath[0]) && $customPath[0] === '/')) {
            if (strpos($customPath, $basePath) !== 0) return null;
            $customPath = substr($customPath, strlen($basePath));
        }
        foreach (ZM_PB_LANGS as $info) {
            $code = $info['code_lower'];
            if ($customPath === $code || strpos($customPath, $code . '/') === 0) {
                $customPath = ltrim(substr($customPath, strlen($code)), '/'); break;
            }
        }
        $query = [];
        parse_str($parts['query'] ?? '', $query);
        // Language profile changes and session-bearing URLs are never sitemap destinations.
        foreach (['language', 'lang', 'token', 'PHPSESSID'] as $name) unset($query[$name]);
        if (!ZM_PB_PRETTY_URLS && $prefix !== '' && ($query['m'] ?? '') === ZM_PB_NAME) $query['lang'] = $prefix;
        return $base . (ZM_PB_PRETTY_URLS && $prefix !== '' ? $prefix . '/' : '') . $customPath
            . ($query ? '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986) : '');
    }
    if (ZM_PB_PRETTY_URLS) return $base . ($prefix !== '' ? $prefix . '/' : '')
        . implode('/', array_map('rawurlencode', explode('/', $path))) . '/';
    return $base . 'index.php?m=' . rawurlencode(ZM_PB_NAME) . '&slug=' . rawurlencode($path)
        . ($prefix !== '' ? '&lang=' . rawurlencode($prefix) : '');
}

function zm_pb_sitemap_status()
{
    $last = zm_pb_sitemap_last_update();
    $frequency = defined('ZM_PB_SITEMAP_UPDFREQ') && ZM_PB_SITEMAP_UPDFREQ !== '' ? ZM_PB_SITEMAP_UPDFREQ : 'every_day';
    $language = require ZM_PB_ALANGDIR . 'english.php';
    return ['enabled' => ZM_PB_ENABLE_SITEMAP, 'last_update' => $last ? gmdate('Y-m-d H:i:s', $last) . ' UTC' : '',
        'next_update' => $last ? gmdate('Y-m-d H:i:s', $last + zm_pb_sitemap_interval()) . ' UTC' : '',
        'frequency' => $language->module_settings->sitemap->translate[$frequency] ?? $language->module_settings->sitemap->translate['every_day'],
        'files' => zm_pb_sitemap_files()];
}
