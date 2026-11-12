<?php
namespace Michelf {
    final class MarkdownExtra
    {
        public $no_markup;
        public $no_entities;
        public $header_id_func;
        public $url_filter_func;

        public function transform(string $markdown): string
        {
            return preg_replace_callback('/\]\(([^)]+)\)/', function (array $match): string {
                return '](' . ($this->url_filter_func)($match[1]) . ')';
            }, $markdown);
        }
    }
}

namespace {
    $language = $argv[1] ?? 'russian';
    if (!preg_match('/^[a-z]+(?:-[a-z]+)?$/', $language) ||
        !is_dir(dirname(__DIR__) . '/rep_info/' . $language)) {
        throw new RuntimeException('Invalid test language.');
    }

    define('ZM_PB_VER', 'test');
    define('ZM_PB_NAME', 'zmchel_whmcs_multimodule');
    define('ZM_PB_ROOTDIR', dirname(__DIR__) . '/');
    define('ZM_PB_ADMIN_CLIENT_LANGNAME', $language);
    define('ZM_PB_LANGS', [$language => [], 'english' => []]);

    function zm_pb_lm_filename_aliases(): array { return []; }

    final class ReadmeSmartyStub
    {
        public $values = [];
        public function assign(string $key, $value): void { $this->values[$key] = $value; }
        public function fetch(string $template): string { return $template; }
    }

    $docs = [
        'pages_manager', 'pages_editor', 'pages_editor_pagination', 'pages_editor_smarty',
        'media_manager', 'menu_manager', 'redirects_manager', 'langs_manager',
        'sitemap_manager', 'module_db', 'module_settings', 'module_settings_transfer',
        'rewrite_manager', 'module_structured_data',
    ];
    foreach ($docs as $doc) {
        $smarty = new ReadmeSmartyStub();
        $_GET['doc'] = $doc;
        require dirname(__DIR__) . '/methods/get/readme.php';
        $local = ZM_PB_ROOTDIR . 'rep_info/' . $language . '/docs/' . $doc . '.md';
        $source = is_readable($local) ? $local : ZM_PB_ROOTDIR . 'rep_info/english/docs/' . $doc . '.md';
        $heading = strtok(file_get_contents($source), "\r\n");
        if (($smarty->values['readme_additional_doc'] ?? false) !== true ||
            strpos($smarty->values['readme_html'] ?? '', $heading) !== 0) {
            throw new RuntimeException('Guide did not load: ' . $doc . ' in ' . $language);
        }
    }

    $smarty = new ReadmeSmartyStub();
    $_GET['doc'] = 'pages_editor';
    require dirname(__DIR__) . '/methods/get/readme.php';
    if (strpos($smarty->values['readme_html'], 'doc=pages_editor_pagination') === false ||
        strpos($smarty->values['readme_html'], 'doc=pages_editor_smarty') === false) {
        throw new RuntimeException('Page Editor child guides did not resolve.');
    }

    $smarty = new ReadmeSmartyStub();
    unset($_GET['doc']);
    require dirname(__DIR__) . '/methods/get/readme.php';
    foreach (['pages_manager', 'pages_editor', 'media_manager', 'menu_manager',
              'redirects_manager', 'langs_manager', 'sitemap_manager', 'module_db',
              'module_settings', 'rewrite_manager'] as $doc) {
        if (strpos($smarty->values['readme_html'], 'doc=' . $doc) === false) {
            throw new RuntimeException('Instruction does not link to section: ' . $doc);
        }
    }

    $smarty = new ReadmeSmartyStub();
    $_GET['doc'] = '../private';
    require dirname(__DIR__) . '/methods/get/readme.php';
    if (($smarty->values['readme_additional_doc'] ?? true) !== false) {
        throw new RuntimeException('Unknown guide was accepted.');
    }

    echo "PASS section guides and links: $language\n";
}
