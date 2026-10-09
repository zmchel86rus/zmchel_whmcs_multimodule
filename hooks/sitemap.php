<?php
if (!defined('WHMCS')) die('Direct access not allowed');
if (!ZM_PB_ENABLE_SITEMAP) return;

add_hook('AfterCronJob', 9999, function () {
    require_once ZM_PB_INCDIR . 'sitemap_manager.php';
    if (!zm_pb_sitemap_due()) return;
    try {
        require_once ZM_PB_LIBDIR . 'sitemap.php';
        ZM_PB_Sitemap::generate();
    } catch (Throwable $error) {
        error_log('zmchel WHMCS Multimodule sitemap: ' . $error->getMessage());
        if (function_exists('logActivity')) logActivity('zmchel WHMCS Multimodule sitemap generation failed: ' . $error->getMessage());
    }
});
