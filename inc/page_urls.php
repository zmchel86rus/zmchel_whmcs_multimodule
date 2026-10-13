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

    return $base . 'index.php?m=' . rawurlencode(ZM_PB_NAME) . '&slug=' . rawurlencode($slug)
        . ($code !== '' ? '&lang=' . rawurlencode($code) : '');
}
