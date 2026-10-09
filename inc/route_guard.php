<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Domain auction lot paths have dots but are public pages, not WHMCS files. */
function zm_pb_is_public_lot_route($slug)
{
    $slug = trim((string) $slug, '/');
    return preg_match('~^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z]{2,63}$~iD', $slug)
        && !preg_match('~\.(?:php|html?|asp|aspx|jsp|cgi|xml|txt|json|css|js|ico|pdf|svg|png|jpe?g|webp|gif|woff2?|ttf|eot)$~iD', $slug);
}

/** Native endpoints and their children belong to WHMCS, not page overrides. */
function zm_pb_route_uses_user_language(array $request)
{
    $slug = strtolower(trim((string) ($request['slug'] ?? ''), '/'));
    // WHMCS can expose native routes via index.php?rp=/password/reset.
    if (in_array($slug, ['', 'index.php'], true) && is_string($_GET['rp'] ?? null) && $_GET['rp'] !== '/') {
        $slug = strtolower(trim($_GET['rp'], '/'));
    }
    $page = preg_replace('/\.php$/i', '', $slug);
    if ($page === '' || $page === 'index') return false;
    if (zm_pb_is_public_lot_route($slug)) return false;
    if (defined('ZM_PB_MAINSYSTEM_DEFAULT_PAGES') && in_array($page, ZM_PB_MAINSYSTEM_DEFAULT_PAGES, true)) return false;
    if (zm_pb_is_native_route($slug)) return true;
    // Include routed storefront pages and children of native PHP entry points.
    $root = explode('/', $slug, 2)[0];
    return $root === 'store' || (preg_match('/^[a-z0-9_-]+$/D', $root)
        && is_file(ROOTDIR . '/' . $root . '.php'));
}

function zm_pb_is_native_route($slug)
{
    $slug = strtolower(trim((string) $slug, '/'));
    if (strpos($slug, '.') !== false) return true;
    $root = explode('/', $slug, 2)[0];
    return in_array($root, [
        'admin', 'clientarea', 'assets', 'templates_c', 'modules', 'includes',
        'vendor', 'crons', 'api', 'oauth', 'status', 'login', 'logout',
        'password', 'register', 'account', 'user', 'users', 'invite', 'auth',
    ], true);
}
