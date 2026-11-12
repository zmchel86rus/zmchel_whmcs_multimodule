<?php

$root = dirname(__DIR__);
$sections = [
    'pages_manager', 'pages_editor', 'media_manager', 'menu_manager',
    'langs_manager', 'redirects_manager', 'sitemap_manager', 'rewrite_manager',
    'module_settings', 'module_db',
];
$extras = [
    'pages_editor_pagination', 'pages_editor_smarty', 'module_structured_data',
    'module_settings_transfer',
];
$expected = array_merge($sections, $extras);
$sectionCounts = [
    'pages_manager' => 3, 'pages_editor' => 4, 'media_manager' => 2,
    'menu_manager' => 3, 'langs_manager' => 4, 'redirects_manager' => 1,
    'sitemap_manager' => 1, 'rewrite_manager' => 2, 'module_settings' => 1,
    'module_db' => 1, 'pages_editor_pagination' => 5,
    'pages_editor_smarty' => 4, 'module_structured_data' => 3,
    'module_settings_transfer' => 1,
];
$topics = [
    'pages_manager' => ['slug', 'WHMCS'],
    'pages_editor' => ['Schema', 'CAPTCHA', 'SMTP', 'mail()'],
    'media_manager' => ['srcset'],
    'menu_manager' => ['ZM_PB_ENABLE_MAINNAV', 'ZM_PB_ENABLE_SECONDARYNAV', 'zm_pb_menu_items', 'CSS', 'rel'],
    'langs_manager' => ['JSON', 'WHMCS'],
    'redirects_manager' => ['HTTP', '301', '308', 'GET', 'HEAD', 'zm_pb_redirects', '128'],
    'sitemap_manager' => ['sitemap_index.xml', 'sitemap_pages.xml', 'sitemap_posts.xml', 'x-default', 'lang_active'],
    'rewrite_manager' => ['.htaccess', 'nginx'],
    'module_settings' => ['WHMCS'],
    'module_settings_transfer' => ['ZIP', 'SystemURL', '128', 'upload_max_filesize', 'post_max_size'],
    'pages_editor_pagination' => ['/page/2/', '?page=2', 'noindex', '$zm_pagination', 'pager', 'YYYY-MM-DD', '{foreach}', 'array_slice', 'thead', 'tfoot'],
    'pages_editor_smarty' => ['|escape', 'nofilter', 'resources/available_vars/', 'Ctrl+Space', 'date_format'],
    'module_structured_data' => ['SiteNavigationElement', 'WebPageElement', 'FAQPage', 'BreadcrumbList', 'ContactPoint.availableLanguage'],
];
$loader = file_get_contents($root . '/methods/get/readme.php');
$locales = glob($root . '/rep_info/*', GLOB_ONLYDIR);
$knownLanguages = (require $root . '/supported_langs.php') + (require $root . '/disabled_langs.php');
$documentedLanguages = array_map('basename', $locales);
sort($documentedLanguages);
$expectedLanguages = array_keys($knownLanguages);
sort($expectedLanguages);
if ($documentedLanguages !== $expectedLanguages)
    throw new RuntimeException('Documentation languages do not match the module language list.');

foreach ($locales as $locale) {
    $language = basename($locale);
    $main = file_get_contents($locale . '/instruction.md');
    if (!preg_match('//u', $main)) throw new RuntimeException("Invalid UTF-8 in main guide: $language.");
    $overview = file_get_contents($locale . '/overview.md');
    if (!preg_match('//u', $overview)) throw new RuntimeException("Invalid UTF-8 in overview: $language.");
    $struckPlans = preg_match_all('/^- ~~.*~~\r?$/m', $overview);
    $htmlPlan = preg_match('/^- ~~[^\r\n]*~~\r?\n- (?!~~)[^\r\n]+/mu', $overview);
    if ($struckPlans !== 2 || !$htmlPlan) {
        throw new RuntimeException("Roadmap status differs in $language ($struckPlans, $htmlPlan).");
    }
    if (substr_count($main, '```') % 2 !== 0) {
        throw new RuntimeException("Unclosed code fence in main guide: $language.");
    }
    preg_match_all('/^## (.+)$/m', $main, $headings);
    if (count($headings[0]) !== 7) {
        throw new RuntimeException("Main guide sections differ in $language.");
    }
    preg_match_all('~\]\(docs/([a-z0-9_]+)\.md\)~', $main, $links);
    if ($links[1] !== $expected) {
        throw new RuntimeException("Main guide links differ in $language.");
    }
    $sectionsHeadingPos = strpos($main, $headings[0][5]);
    $extrasHeadingPos = strpos($main, $headings[0][6]);
    $sectionPos = strpos($main, '](docs/pages_manager.md)');
    $extrasPos = strpos($main, '](docs/pages_editor_pagination.md)');
    if ($sectionsHeadingPos === false || $extrasHeadingPos === false ||
        $sectionPos === false || $extrasPos === false ||
        $sectionsHeadingPos >= $sectionPos || $sectionPos >= $extrasHeadingPos ||
        $extrasHeadingPos >= $extrasPos) {
        throw new RuntimeException("Guide blocks are out of order in $language.");
    }
    foreach (['ZM_PB_ADMIN_SALT', 'ZM_PB_SECURE_SALT', 'ZM_PB_NONCE_SALT',
              '8.13', '9.1', '7.4', 'Smarty'] as $required) {
        if (strpos($main, $required) === false) {
            throw new RuntimeException("Main guide omits $required in $language.");
        }
    }
    if (strpos($main, '../english/docs/') !== false) {
        throw new RuntimeException("English fallback link remains in $language.");
    }
    foreach ($expected as $id) {
        $path = $locale . '/docs/' . $id . '.md';
        if (!is_file($path) || filesize($path) < 200) {
            throw new RuntimeException("Missing or unfinished guide: $language/$id.");
        }
        if (strpos($loader, "'" . $id . "'") === false) {
            throw new RuntimeException("Guide is not registered in readme.php: $id.");
        }
        $text = file_get_contents($path);
        if (!preg_match('//u', $text)) throw new RuntimeException("Invalid UTF-8 in $language/$id.");
        if (strpos($text, '/html-sitemap') !== false || strpos($text, '`lang_status`') !== false)
            throw new RuntimeException("Unimplemented sitemap guidance remains in $language/$id.");
        if (substr_count($text, '```') % 2 !== 0) {
            throw new RuntimeException("Unclosed code fence: $language/$id.");
        }
        if (strpos($text, '# ') !== 0 || substr_count($text, "\n") < 9) {
            throw new RuntimeException("Guide is too short: $language/$id.");
        }
        $hasProse = false;
        foreach (preg_split('/\R\s*\R/u', $text) as $paragraph) {
            $paragraph = trim($paragraph);
            if ($paragraph === '' || preg_match('/^[#\-|>]/u', $paragraph)) {
                continue;
            }
            if (count(preg_split('/\s+/u', $paragraph)) >= 20 ||
                (in_array($language, ['chinese', 'japanese', 'korean'], true) &&
                 preg_match_all('/\p{L}/u', $paragraph) >= 80)) {
                $hasProse = true;
                break;
            }
        }
        if (!$hasProse) {
            throw new RuntimeException("Guide contains only labels: $language/$id.");
        }
        $minimumWords = [
            'module_settings' => 70, 'pages_manager' => 100,
            'rewrite_manager' => 90, 'media_manager' => 80, 'module_db' => 80,
        ][$id] ?? 120;
        if (count(preg_split('/\s+/u', trim($text))) < $minimumWords &&
            !(in_array($language, ['chinese', 'japanese', 'korean'], true) &&
              preg_match_all('/\p{L}/u', $text) >= $minimumWords * 2)) {
            throw new RuntimeException("Guide is incomplete or truncated: $language/$id.");
        }
        foreach ($topics[$id] ?? [] as $topic) {
            if (stripos($text, $topic) === false) {
                throw new RuntimeException("Guide omits $topic: $language/$id.");
            }
        }
        if ($id === 'menu_manager' &&
            count(preg_split('/\s+/u', $text)) < 180 &&
            !(in_array($language, ['chinese', 'japanese', 'korean'], true) &&
              preg_match_all('/\p{L}/u', $text) >= 360)) {
            throw new RuntimeException("Menu guide was truncated: $language.");
        }
        if (preg_match_all('/^## /m', $text) !== $sectionCounts[$id]) {
            throw new RuntimeException("Guide sections differ: $language/$id.");
        }
        if (preg_match('/(?ms)^## [^\r\n]+\R\s*(?=^## |\z)/u', $text)) {
            throw new RuntimeException("Empty guide section: $language/$id.");
        }
        if ($id === 'pages_editor' &&
            (strpos($text, '](pages_editor_pagination.md)') === false ||
             strpos($text, '](pages_editor_smarty.md)') === false)) {
            throw new RuntimeException("Page Editor child guides are missing in $language.");
        }
        if ($id === 'module_settings' &&
            strpos($text, '](module_settings_transfer.md)') === false) {
            throw new RuntimeException("Transfer guide is missing in $language.");
        }
        foreach ([$path => $text] as $file => $markdown) {
            preg_match_all('~\]\(([^)]+\.md)\)~', $markdown, $matches);
            foreach ($matches[1] as $target) {
                if (!is_file(dirname($file) . '/' . $target)) {
                    throw new RuntimeException("Broken link in $file: $target.");
                }
            }
        }
    }
    foreach (['menus', 'pagination', 'redirects', 'sitemaps', 'smarty',
              'structured-data', 'transfer', 'language-manager',
              'module_settings_import_export'] as $old) {
        if (is_file($locale . '/docs/' . $old . '.md')) {
            throw new RuntimeException("Old guide name remains in $language: $old.");
        }
    }
}

echo 'PASS ', count($locales), ' main guides, ', count($locales) * count($expected),
    ' substantive guides, handler IDs, and local links', PHP_EOL;
