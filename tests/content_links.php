<?php
/** Run with: php modules/addons/zmchel_whmcs_multimodule/tests/content_links.php */
define('ZM_PB_VER', 'test');
define('ZM_PB_ENABLE_LANG_ROUTE', true);
define('ZM_PB_PRETTY_URLS', true);
define('ZM_PB_DEFLANG', 'english');
define('ZM_PB_FULLHOST', 'https://example.test/');
define('ZM_PB_LANGS', [
    'english' => ['code_lower' => 'en'],
    'russian' => ['code_lower' => 'ru'],
    'german' => ['code_lower' => 'de'],
]);
define('ZM_PB_MAINSYSTEM_DEFAULT_PAGES', ['index', 'contact']);
require dirname(__DIR__) . '/lib/content_links.php';

function expect_link($input, $language, $expected)
{
    $actual = ZM_PB_ContentLinks::localize($input, $language);
    if ($actual !== $expected) throw new RuntimeException($input . ' -> ' . $actual . ' (expected ' . $expected . ')');
}

expect_link('/contact/', 'russian', '/ru/contact/');
expect_link('/de/contact/?count=25#results', 'russian', '/ru/contact/?count=25#results');
expect_link('https://example.test/ru/contact/', 'english', 'https://example.test/contact/');
expect_link('/contact/', 'english', '/contact/');
expect_link('/', 'russian', '/ru/');
expect_link('#form', 'russian', '#form');
expect_link('?page=2', 'russian', '?page=2');
expect_link('/login', 'russian', '/login');
expect_link('/password/reset', 'russian', '/password/reset');
expect_link('/clientarea.php', 'russian', '/clientarea.php');
expect_link('/assets/logo.svg', 'russian', '/assets/logo.svg');
expect_link('mailto:help@example.test', 'russian', 'mailto:help@example.test');
expect_link('https://external.test/contact/', 'russian', 'https://external.test/contact/');
echo "Content links OK\n";
