<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
require_once __DIR__ . '/route_guard.php';
require_once __DIR__ . '/page_urls.php';

/** Read the WHMCS preference without changing it based on a URL prefix. */
function zm_pb_preferred_language()
{
    $language = is_string($_SESSION['Language'] ?? null) ?
        zm_pb_lm_supported_key(strtolower($_SESSION['Language'])) : '';
    if (isset(ZM_PB_LANGS[$language])) return $language;
    $clientId = (int) ($_SESSION['uid'] ?? 0);
    if ($clientId > 0) {
        $language = zm_pb_lm_supported_key(strtolower((string)
            \Illuminate\Database\Capsule\Manager::table('tblclients')->where('id', $clientId)->value('language')));
        if (isset(ZM_PB_LANGS[$language])) return $language;
    }
    return strtolower(ZM_PB_DEFLANG);
}

/** Remove the default-language prefix when that route is disabled. */
function zm_pb_default_language_redirect_target($uri, array $query = [])
{
    if (!ZM_PB_ENABLE_LANG_ROUTE || zm_pb_language_route_code(ZM_PB_DEFLANG) !== '') return null;
    if (!isset(ZM_PB_LANGS[ZM_PB_DEFLANG])) return null;
    foreach ($query as $name => $value) {
        // An explicit switch must reach WHMCS so it can save the preference.
        if (strcasecmp((string) $name, 'language') === 0) return null;
    }
    $code = ZM_PB_LANGS[ZM_PB_DEFLANG]['route_code'] ?? '';
    if (!preg_match('/^[a-z]{2,3}(?:-[a-z0-9]{2,8})*$/iD', $code)) return null;
    $parts = parse_url($uri);
    if ($parts === false || isset($parts['host']) || isset($parts['scheme'])) return null;
    $path = $parts['path'] ?? '';
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    if ($path === '' || $path[0] !== '/' || ($base !== '' && strpos($path, $base . '/') !== 0)) return null;
    $relative = substr($path, strlen($base));
    if (!preg_match('~^/' . preg_quote($code, '~') . '(?=/|$)~i', $relative, $match)) return null;
    $suffix = substr($relative, strlen($match[0]));
    $target = $base . '/' . ltrim($suffix, '/');
    return $target . (isset($parts['query']) && $parts['query'] !== '' ? '?' . $parts['query'] : '');
}

/** Redirect language routes to the spelling declared in supported_langs.php. */
function zm_pb_language_route_case_target($uri)
{
    if (!ZM_PB_ENABLE_LANG_ROUTE) return null;
    $parts = parse_url($uri);
    if ($parts === false || isset($parts['host']) || isset($parts['scheme'])) return null;
    $path = $parts['path'] ?? '';
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    if ($path === '' || $path[0] !== '/' || ($base !== '' && $path !== $base && strpos($path, $base . '/') !== 0)) return null;
    $query = $parts['query'] ?? '';
    parse_str($query, $parameters);
    if (isset($parameters['language'])) return null;

    $relative = substr($path, strlen($base));
    if (preg_match('~^/([^/]+)(?=/|$)~D', $relative, $match)) {
        foreach (ZM_PB_LANGS as $info) {
            $code = $info['route_code'];
            if (strcasecmp($match[1], $code) !== 0 || $match[1] === $code) continue;
            $path = $base . '/' . $code . substr($relative, strlen($match[0]));
            break;
        }
    }

    if (($parameters['m'] ?? null) === ZM_PB_NAME && is_string($parameters['slug'] ?? null)) {
        $query = preg_replace_callback('/(^|&)lang=([^&]*)/i', function ($match) {
            $requested = rawurldecode($match[2]);
            foreach (ZM_PB_LANGS as $info) {
                $code = $info['route_code'];
                if (strcasecmp($requested, $code) === 0 && $requested !== $code) {
                    return $match[1] . 'lang=' . rawurlencode($code);
                }
            }
            return $match[0];
        }, $query);
    }

    $target = $path . ($query !== '' ? '?' . $query : '');
    return $target !== $uri ? $target : null;
}

/** Only the unprefixed homepage follows the saved language automatically. */
function zm_pb_language_home_target($uri, array $query = [])
{
    if (!ZM_PB_ENABLE_LANG_ROUTE || !ZM_PB_PRETTY_URLS || array_key_exists('language', $query)) return null;
    if (isset($query['m']) || isset($query['slug'])) return null;
    if (!empty($query['rp']) && $query['rp'] !== '/') return null;
    $parts = parse_url($uri);
    if ($parts === false || isset($parts['host']) || isset($parts['scheme'])) return null;
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    $path = $parts['path'] ?? '';
    $homePaths = [$base . '/', $base];
    if (ZM_PB_MAINSYSTEM_PRETTY_URLS) $homePaths[] = $base . '/index.php';
    if (!in_array($path, $homePaths, true)) return null;

    $language = zm_pb_preferred_language();
    if (!isset(ZM_PB_LANGS[$language])) return null;
    $code = zm_pb_language_route_code($language);
    if (!preg_match('/^[a-z]{2,3}(?:-[a-z0-9]{2,8})*$/iD', $code)) return null;
    return $base . '/' . $code . '/' . (isset($parts['query']) && $parts['query'] !== '' ? '?' . $parts['query'] : '');
}

/** Undo repeated HTML-escaped ampersands that became part of query keys. */
function zm_pb_clean_amp_query($query)
{
    $parameters = explode('&', (string) $query);
    $regularNames = [];
    $regularLanguage = false;
    $lastMalformedLanguage = null;
    foreach ($parameters as $index => $parameter) {
        if ($parameter === '') continue;
        $name = urldecode(explode('=', $parameter, 2)[0]);
        $cleanName = preg_replace('/^(?:amp(?:;|%(?:25)*3b))+/i', '', $name);
        if ($cleanName === $name) {
            $regularNames[$name] = true;
            if (strcasecmp($name, 'language') === 0) $regularLanguage = true;
        } elseif (strcasecmp($cleanName, 'language') === 0) {
            $lastMalformedLanguage = $index;
        }
    }
    $cleaned = [];
    foreach ($parameters as $index => $parameter) {
        if ($parameter === '') continue;
        $pair = explode('=', $parameter, 2);
        $name = urldecode($pair[0]);
        $cleanName = preg_replace('/^(?:amp(?:;|%(?:25)*3b))+/i', '', $name);
        if ($cleanName === '') continue;
        if ($cleanName !== $name) {
            if (strcasecmp($cleanName, 'language') === 0
                && ($regularLanguage || $index !== $lastMalformedLanguage)) continue;
            if (isset($regularNames[$cleanName])) continue;
            $parameter = rawurlencode($cleanName) . (isset($pair[1]) ? '=' . $pair[1] : '');
        }
        $cleaned[] = $parameter;
    }
    return implode('&', $cleaned);
}

/** Repair a malformed language link before WHMCS reads and saves the language. */
function zm_pb_language_query_repair_target($uri)
{
    if (!ZM_PB_ENABLE_LANG_ROUTE) return null;
    $parts = parse_url($uri);
    if ($parts === false || isset($parts['host']) || isset($parts['scheme'])
        || empty($parts['path']) || $parts['path'][0] !== '/') return null;
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    if ($base !== '' && $parts['path'] !== $base && strpos($parts['path'], $base . '/') !== 0) return null;
    $query = $parts['query'] ?? '';
    $cleaned = zm_pb_clean_amp_query($query);
    if ($cleaned === $query) return null;
    parse_str($cleaned, $parameters);
    $language = $parameters['language'] ?? null;
    if (!is_string($language) || !isset(ZM_PB_LANGS[zm_pb_lm_supported_key(strtolower($language))])) return null;
    return $parts['path'] . ($cleaned !== '' ? '?' . $cleaned : '');
}

/** Build a local URL after WHMCS has processed an explicit language selection. */
function zm_pb_language_switch_target($uri, array $query)
{
    if (!ZM_PB_ENABLE_LANG_ROUTE || !is_string($query['language'] ?? null)) return null;
    $language = zm_pb_lm_supported_key(strtolower($query['language']));
    if (!isset(ZM_PB_LANGS[$language])) return null;
    $code = ZM_PB_LANGS[$language]['route_code'] ?? '';
    if (!preg_match('/^[a-z]{2,3}(?:-[a-z0-9]{2,8})*$/iD', $code)) return null;
    $parts = parse_url($uri);
    if ($parts === false || isset($parts['host'], $parts['scheme']) || empty($parts['path']) || $parts['path'][0] !== '/') return null;
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    $path = $parts['path'];
    if ($base !== '') {
        if ($path !== $base && strpos($path, $base . '/') !== 0) return null;
        $path = substr($path, strlen($base));
    }
    $path = ltrim($path, '/');
    $segments = explode('/', $path, 2);
    foreach (ZM_PB_LANGS as $info) {
        if (strcasecmp($segments[0], $info['route_code'] ?? '') === 0) {
            $path = $segments[1] ?? '';
            break;
        }
    }
    // Never turn a language selection on an endpoint into a public page route.
    if (preg_match('~^(?:admin|api|assets|modules|includes|vendor|crons|oauth)(?:/|$)~i', $path)) return null;

    $parameters = [];
    foreach (explode('&', zm_pb_clean_amp_query($parts['query'] ?? '')) as $parameter) {
        if ($parameter === '') continue;
        $name = urldecode(explode('=', $parameter, 2)[0]);
        if (strcasecmp($name, 'language') !== 0) $parameters[] = $parameter;
    }
    if (($query['m'] ?? null) === ZM_PB_NAME && is_string($query['slug'] ?? null)) {
        $target = zm_pb_module_page_url($query['slug'], $language);
        $extras = [];
        foreach ($parameters as $parameter) {
            $name = strtolower(urldecode(explode('=', $parameter, 2)[0]));
            if (!in_array($name, ['m', 'slug', 'lang', 'rp'], true)) $extras[] = $parameter;
        }
        return $target . ($extras ? (strpos($target, '?') === false ? '?' : '&') . implode('&', $extras) : '');
    }
    if (ZM_PB_MAINSYSTEM_PRETTY_URLS && preg_match('~(?:^|/)index\.php$~iD', $path)) $path = substr($path, 0, -strlen('index.php'));
    // A domain name is a public lot route, although its dot looks like a file extension.
    $lotRoute = zm_pb_is_public_lot_route($path);
    // Native WHMCS routes keep their URLs; module pages use the configured language prefix.
    $prefix = zm_pb_language_route_code($language);
    $prefix = $prefix === '' ? '' : $prefix . '/';
    // An old direct lot link should switch to the same public lot URL as a pretty link.
    if (strcasecmp($path, 'domainmarket.php') === 0 && ($query['a'] ?? '') === 'search') {
        $lot = strtolower(trim((string) ($query['domain_name'] ?? $query['domain'] ?? '')));
        if (zm_pb_is_public_lot_route($lot)) {
            $extras = [];
            foreach ($parameters as $parameter) {
                $name = strtolower(urldecode(explode('=', $parameter, 2)[0]));
                if (!in_array($name, ['a', 'domain_name', 'domain', 'lang'], true)) $extras[] = $parameter;
            }
            $lotTarget = $base . '/' . $prefix . rawurlencode($lot) . '/';
            return $lotTarget . ($extras ? '?' . implode('&', $extras) : '');
        }
    }
    $nativeRoute = preg_match('~\.php(?:/|$)~i', $path)
        || ($path !== '' && !$lotRoute && zm_pb_route_uses_user_language(['slug' => $path, 'lang' => '']));
    $target = $base . '/' . ($nativeRoute ? $path : $prefix . $path);
    return $target . ($parameters ? '?' . implode('&', $parameters) : '');
}
