<?php
// Compatibility entry point for language rules installed by earlier versions.
// New rules target index.php directly; keep this file until those rules update.
$path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
$segments = explode('/', trim($path, '/'), 2);
$languages = require dirname(__DIR__) . '/supported_langs.php';
foreach ($languages as $info) {
    if ($info['code_lower'] !== ($segments[0] ?? '')) continue;
    $route = '/' . ($segments[1] ?? '');
    $_GET['rp'] = $route;
    $query = $_SERVER['QUERY_STRING'] ?? '';
    $_SERVER['QUERY_STRING'] = 'rp=' . str_replace('%2F', '/', rawurlencode($route)) . ($query !== '' ? '&' . $query : '');
    break;
}
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = dirname(__DIR__, 4) . '/index.php';
require $_SERVER['SCRIPT_FILENAME'];
