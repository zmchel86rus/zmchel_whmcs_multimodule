<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

    $smarty->assign('readme_html', '');
    $doc = isset($_GET['doc']) && is_string($_GET['doc']) ? $_GET['doc'] : '';
    $readmeLanguage = array_key_exists(ZM_PB_ADMIN_CLIENT_LANGNAME, ZM_PB_LANGS) ? ZM_PB_ADMIN_CLIENT_LANGNAME : 'english';
    $availableDocs = ['menus', 'pagination', 'redirects', 'sitemaps', 'smarty', 'structured-data', 'transfer'];
    $isAdditionalDoc = in_array($doc, $availableDocs, true);
    $relativePath = $isAdditionalDoc ? 'docs/' . $doc . '.md' : 'instruction.md';
    $readmePath = ZM_PB_ROOTDIR . 'rep_info/' . $readmeLanguage . '/' . $relativePath;
    if (!is_readable($readmePath)) {
        $readmePath = ZM_PB_ROOTDIR . 'rep_info/english/' . $relativePath;
    }
    $markdown = is_readable($readmePath) ? file_get_contents($readmePath) : false;
    if ($markdown === false) {
        $smarty->assign('alertType', 'danger');
        $smarty->assign('alertMessage', ($GLOBALS['ZM_PB_ADMINLANG'])->module->instruction_error);
        $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
    } else {
        if (!class_exists(\Michelf\MarkdownExtra::class)) {
            require_once ROOTDIR . '/vendor/michelf/php-markdown/Michelf/MarkdownExtra.inc.php';
        }
        $parser = new \Michelf\MarkdownExtra();
        $parser->no_markup = true;
        $parser->no_entities = true;
        $parser->header_id_func = static function ($heading) {
            $slug = mb_strtolower(trim($heading), 'UTF-8');
            $slug = preg_replace('/[^\p{L}\p{N}\s-]/u', '', $slug);
            return trim(preg_replace('/[\s-]+/u', '-', $slug), '-');
        };
        $parser->url_filter_func = static function ($url) {
            if (preg_match('~^(?:\.\./english/)?docs/([a-z0-9-]+)\.md$~D', $url, $matches)) {
                return 'addonmodules.php?module=' . rawurlencode(ZM_PB_NAME) . '&subpage=README.md&doc=' . rawurlencode($matches[1]);
            }
            return preg_match('~^(?:#[^\s]*|https?://[^\s]+)$~iD', $url) ? $url : '#';
        };
        $smarty->assign('readme_html', $parser->transform($markdown));
    }
    $smarty->assign('readme_additional_doc', (bool) $isAdditionalDoc);
