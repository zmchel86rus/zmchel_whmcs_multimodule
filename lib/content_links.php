<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
require_once dirname(__DIR__) . '/inc/route_guard.php';

/** Localize explicit content links without changing external or WHMCS system URLs. */
class ZM_PB_ContentLinks
{
    private static function isPublishedPage($slug)
    {
        static $cache = [];
        if (array_key_exists($slug, $cache)) return $cache[$slug];
        $cache[$slug] = false;
        if (!class_exists('Illuminate\\Database\\Capsule\\Manager')) return false;
        try {
            $cache[$slug] = \Illuminate\Database\Capsule\Manager::table('zm_pb_pages')
                ->where('slug', $slug)->where('status', 'publish')->exists();
        } catch (Throwable $error) {
            // Routing must keep working even while module tables are being repaired.
        }
        return $cache[$slug];
    }

    public static function localize($url, $language)
    {
        if (!is_string($url) || $url === '' || !defined('ZM_PB_ENABLE_LANG_ROUTE')
            || !ZM_PB_ENABLE_LANG_ROUTE || !defined('ZM_PB_PRETTY_URLS') || !ZM_PB_PRETTY_URLS
            || !isset(ZM_PB_LANGS[$language]) || $url[0] === '#' || $url[0] === '?'
            || strpos($url, '//') === 0) return $url;

        $parts = parse_url($url);
        $site = parse_url(ZM_PB_FULLHOST);
        if ($parts === false || $site === false || isset($parts['user']) || isset($parts['pass'])
            || (isset($parts['scheme']) && !in_array(strtolower($parts['scheme']), ['http', 'https'], true))) return $url;
        if (isset($parts['host']) && (strcasecmp($parts['host'], $site['host'] ?? '') !== 0
            || ($parts['port'] ?? null) !== ($site['port'] ?? null))) return $url;

        $path = $parts['path'] ?? '';
        if ($path === '') return $url;
        $base = rtrim($site['path'] ?? '', '/');
        if ($path[0] === '/' && $base !== '') {
            if ($path !== $base && strpos($path, $base . '/') !== 0) return $url;
            $path = substr($path, strlen($base));
        }
        $path = ltrim($path, '/');
        foreach (ZM_PB_LANGS as $info) {
            $code = $info['code_lower'];
            if ($path === $code || strpos($path, $code . '/') === 0) {
                $path = ltrim(substr($path, strlen($code)), '/');
                break;
            }
        }

        if ($path !== '') {
            $root = strtolower(explode('/', $path, 2)[0]);
            if (zm_pb_is_native_route($path) || $root === 'store'
                || (defined('ROOTDIR') && is_file(ROOTDIR . '/' . $root . '.php')
                    && (!defined('ZM_PB_MAINSYSTEM_DEFAULT_PAGES')
                        || !in_array($root, ZM_PB_MAINSYSTEM_DEFAULT_PAGES, true))
                    && !self::isPublishedPage($root))) return $url;
        }

        $prefix = $language === ZM_PB_DEFLANG ? '' : ZM_PB_LANGS[$language]['code_lower'] . '/';
        $result = $base . '/' . $prefix . $path;
        if (isset($parts['host'])) {
            $origin = ($parts['scheme'] ?? $site['scheme'] ?? 'https') . '://' . $parts['host'];
            if (isset($parts['port'])) $origin .= ':' . $parts['port'];
            $result = $origin . $result;
        }
        if (isset($parts['query'])) $result .= '?' . $parts['query'];
        if (isset($parts['fragment'])) $result .= '#' . $parts['fragment'];
        return $result;
    }
}
