<?php
if (!defined('WHMCS')) die('Direct access not allowed');
if (!ZM_PB_ENABLE_REDIRECTS_MANAGER && !ZM_PB_ENABLE_PAGE_OVERRIDES) return;
if (PHP_SAPI === 'cli' || defined('ADMINAREA') || defined('ZMPB_LANGUAGE_SWITCH_PENDING')
    || !in_array($_SERVER['REQUEST_METHOD'] ?? '', ['GET', 'HEAD'], true)) return;
require_once ZM_PB_LIBDIR . 'redirects.php';
try {
    $redirect = zm_pb_redirect_resolve($_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] ?? ($_SERVER['REQUEST_URI'] ?? '/'),
        zm_pb_redirect_rules(), zm_pb_redirect_overrides());
    if ($redirect !== null) {
        header('Location: ' . $redirect['url'], true, $redirect['status']);
        exit;
    }
} catch (InvalidArgumentException $error) {
    // An invalid URL or a loop must never take the client area down.
    if ($error->getMessage() === 'redirect_loop') error_log('zmchel WHMCS Multimodule: redirect loop prevented');
}
