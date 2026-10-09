<?php
require_once dirname(__DIR__, 4) . '/init.php';
require_once dirname(__DIR__) . '/module_init.php';
require_once ZM_PB_LIBDIR . 'contact_form.php';
header('Cache-Control: no-store, private');
header('X-Content-Type-Options: nosniff');

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'GET' && ($_GET['action'] ?? '') === 'captcha') {
    $token = is_string($_GET['token'] ?? null) ? $_GET['token'] : '';
    ZM_PB_ContactForm::captcha($token);
    exit;
}
header('Content-Type: application/json; charset=utf-8');
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405); header('Allow: POST');
    echo json_encode(['success' => false, 'message' => 'Method not allowed']); exit;
}
try {
    $result = ZM_PB_ContactForm::submit($_POST);
} catch (Throwable $error) {
    if (function_exists('logActivity')) logActivity('Page Builder contact form: ' . $error->getMessage());
    $text = ZM_PB_ContactForm::text(ZM_PB_DEFLANG);
    $result = ['status' => 500, 'success' => false, 'message' => $text['form_send_failed'] ?? 'Unable to send the form.'];
}
http_response_code($result['status']); unset($result['status']);
echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
