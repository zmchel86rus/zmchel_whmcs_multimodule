<?php
if (!defined("WHMCS")) die('Direct access not allowed');

if (zm_pb_maintenance_required()) {
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'HEAD') echo zm_pb_maintenance_response();
    exit;
}

function zm_pb_maintenance_required()
{
    $adminId = (int) ($_SESSION['adminid'] ?? 0);
    if ($adminId > 0 && \Illuminate\Database\Capsule\Manager::table('tbladmins')->where('id', $adminId)->where('disabled', 0)->exists()) return false;

    $uri = $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] ?? ($_SERVER['REQUEST_URI'] ?? '/');
    $path = parse_url($uri, PHP_URL_PATH) ?: '/';
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    if ($base !== '' && strpos($path, $base . '/') === 0) $path = substr($path, strlen($base));
    $path = ltrim($path, '/');
    // The form is a visitor endpoint, unlike provider callbacks under /modules/.
    if ($path === 'modules/addons/' . ZM_PB_NAME . '/public/contact.php') return true;
    if (preg_match('~^(?:includes|modules|crons|api|oauth|assets|vendor)(?:/|$)~i', $path)) return false;
    if (in_array(strtolower($path), ['api.php', 'cron.php'], true)) return false;
    $route = is_string($_GET['rp'] ?? null) ? ltrim($_GET['rp'], '/') : '';
    if (preg_match('~^(?:api|oauth)(?:/|$)~i', $route)) return false;
    return true;
}

function zm_pb_maintenance_response()
{
    $language = strtolower((string) ($_SESSION['Language'] ?? ZM_PB_DEFLANG));
    $uri = $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] ?? ($_SERVER['REQUEST_URI'] ?? '/');
    $path = parse_url($uri, PHP_URL_PATH) ?: '/';
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    if ($base !== '' && strpos($path, $base . '/') === 0) $path = substr($path, strlen($base));
    if (ZM_PB_ENABLE_LANG_ROUTE) {
        $prefix = explode('/', ltrim($path, '/'), 2)[0];
        foreach (ZM_PB_LANGS as $name => $info) if ($prefix === $info['code_lower']) { $language = $name; break; }
    }
    $messages = require ZM_PB_INCDIR . 'maintenance_lang.php';
    $text = $messages[$language] ?? $messages['english'];
    $locale = ZM_PB_LANGS[$language]['locale_BCP47'] ?? 'en';
    $company = (string) ($GLOBALS['CONFIG']['CompanyName'] ?? '');
    $css = ZM_PB_ASSETSURL . 'css/maintenance.css?v=' . filemtime(ZM_PB_ASSETSDIR . 'css/maintenance.css');
    $escape = function ($value) { return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); };

    http_response_code(503);
    header('Retry-After: 3600');
    header('Cache-Control: no-store, private');
    header('Content-Type: text/html; charset=utf-8');
    header('X-Robots-Tag: noindex');
    $accept = (string) ($_SERVER['HTTP_ACCEPT'] ?? '');
    if (strpos($accept, 'application/json') !== false || strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '', 'XMLHttpRequest') === 0) {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode(['success' => false, 'message' => $text['message']], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
    }
    ob_start();
    require ZM_PB_TEMPLATESDIR . 'client_side/maintenance.php';
    return ob_get_clean();
}
