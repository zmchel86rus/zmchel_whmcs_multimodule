<?php
/** Run with PHP 8.1+: php tests/page_urls.php [--pretty]. */
class PageUrlTestQuery
{
    private $slug = '';
    private $status = '';
    private $type = '';

    public function where($column, $value, $ignored = null)
    {
        if ($column === 'slug') $this->slug = $value;
        if ($column === 'status') $this->status = $value;
        if ($column === 'type') $this->type = [$value, $ignored];
        return $this;
    }

    public function exists()
    {
        return in_array($this->slug, ['samplepage', 'contact'], true)
            && $this->status === 'publish' && $this->type === ['!=', 'system'];
    }
}

class PageUrlTestCapsule
{
    public static function table($table)
    {
        if ($table !== 'zm_pb_pages') throw new RuntimeException('Unexpected table: ' . $table);
        return new PageUrlTestQuery();
    }
}
class_alias('PageUrlTestCapsule', 'Illuminate\Database\Capsule\Manager');

define('ZM_PB_VER', 'test');
define('ZM_PB_INCDIR', dirname(__DIR__) . '/inc/');
define('ZM_PB_LIBDIR', dirname(__DIR__) . '/lib/');
define('ZM_PB_ASSETSDIR', dirname(__DIR__) . '/assets/');
define('ZM_PB_ASSETSURL', 'https://example.test/billing/modules/addons/zmchel_whmcs_multimodule/assets/');
define('ZM_PB_NAME', 'zmchel_whmcs_multimodule');
define('ZM_PB_FULLHOST', 'https://example.test/billing/');
define('ZM_PB_DEFLANG', 'english');
define('ZM_PB_ENABLE_LANG_ROUTE', true);
define('ZM_PB_ENABLE_DEFAULT_LANG_ROUTE', in_array('--default-route', $argv, true));
define('ZM_PB_ENABLE_PAGE_OVERRIDES', true);
define('ZM_PB_MAINSYSTEM_PRETTY_URLS', true);
define('ZM_PB_PRETTY_URLS', in_array('--pretty', $argv, true));
define('ZM_PB_LANGS', require dirname(__DIR__) . '/supported_langs.php');
$routeCodes = array_column(ZM_PB_LANGS, 'route_code');
if (count($routeCodes) !== count(array_unique($routeCodes))
    || ZM_PB_LANGS['portuguese-pt']['route_code'] !== 'pt'
    || ZM_PB_LANGS['portuguese-br']['route_code'] !== ZM_PB_LANGS['portuguese-br']['locale_BCP47']) {
    throw new RuntimeException('Language routes must be distinct, with Portuguese on /pt/ and Brazilian Portuguese on /pt-BR/');
}
require dirname(__DIR__) . '/inc/menu_manager.php';
require dirname(__DIR__) . '/inc/sitemap_manager.php';
require dirname(__DIR__) . '/inc/url_redirects.php';
require dirname(__DIR__) . '/lib/content_links.php';
require dirname(__DIR__) . '/lib/content_builder.php';

function expect_url($actual, $expected)
{
    if ($actual !== $expected) throw new RuntimeException("Expected $expected, got $actual");
}

$page = (object) ['slug' => 'samplepage'];
$base = 'https://example.test/billing/';
$defaultPrefix = ZM_PB_ENABLE_DEFAULT_LANG_ROUTE ? 'en/' : '';
$defaultQuery = ZM_PB_ENABLE_DEFAULT_LANG_ROUTE ? '&lang=en' : '';
expect_url(zm_pb_escaped_query_redirect_target('/billing/?m=zmchel_whmcs_multimodule&amp;slug=samplepage&amp;lang=ru'),
    '/billing/?m=zmchel_whmcs_multimodule&slug=samplepage&lang=ru');
expect_url(zm_pb_escaped_query_redirect_target('/billing/?m=another_module&amp;slug=samplepage'), null);
$_GET = ['m' => ZM_PB_NAME, 'amp;slug' => 'samplepage', 'amp;lang' => 'ru'];
$_REQUEST = $_GET;
$_SERVER['REQUEST_URI'] = '/billing/?m=zmchel_whmcs_multimodule&amp;slug=samplepage&amp;lang=ru';
if (!zm_pb_repair_escaped_query_request($_SERVER['REQUEST_URI'])) {
    throw new RuntimeException('Escaped module query was not repaired');
}
expect_url($_GET['slug'] ?? null, 'samplepage');
expect_url($_GET['lang'] ?? null, 'ru');
expect_url($_SERVER['REQUEST_URI'], '/billing/?m=zmchel_whmcs_multimodule&slug=samplepage&lang=ru');
if (isset($_GET['amp;slug']) || isset($_REQUEST['amp;slug'])) {
    throw new RuntimeException('Escaped query key survived repair');
}
unset($_GET, $_REQUEST, $_SERVER['REQUEST_URI'], $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'], $_SERVER['QUERY_STRING']);
if (ZM_PB_PRETTY_URLS) {
    expect_url(zm_pb_menu_page_url($page, 'russian', []), $base . 'ru/samplepage/');
    expect_url(zm_pb_menu_page_url($page, 'english', ['samplepage' => 'contact']), $base . $defaultPrefix . 'contact/');
    expect_url(zm_pb_module_page_url('samplepage', 'english'), $base . $defaultPrefix . 'samplepage/');
    expect_url(zm_pb_sitemap_url('samplepage', 'english'), $base . $defaultPrefix . 'samplepage/');
    expect_url(zm_pb_sitemap_url('samplepage', 'russian'), $base . 'ru/samplepage/');
    expect_url(ZM_PB_ContentLinks::localize('/billing/samplepage/', 'russian'), '/billing/ru/samplepage/');
    expect_url(ZM_PB_ContentLinks::localize('/billing/samplepage/', 'english'), '/billing/' . $defaultPrefix . 'samplepage/');
    expect_url(zm_pb_menu_page_url($page, 'portuguese-pt', []), $base . 'pt/samplepage/');
    expect_url(zm_pb_menu_page_url($page, 'portuguese-br', []), $base . 'pt-BR/samplepage/');
    expect_url(zm_pb_sitemap_url('samplepage', 'portuguese-pt'), $base . 'pt/samplepage/');
    expect_url(zm_pb_sitemap_url('samplepage', 'portuguese-br'), $base . 'pt-BR/samplepage/');
    expect_url(ZM_PB_ContentLinks::localize('/billing/pt/samplepage/', 'portuguese-br'), '/billing/pt-BR/samplepage/');
} else {
    $plain = $base . '?m=zmchel_whmcs_multimodule&slug=samplepage';
    expect_url(zm_pb_menu_page_url($page, 'english', []), $plain . $defaultQuery);
    expect_url(zm_pb_menu_page_url($page, 'russian', []), $plain . '&lang=ru');
    expect_url(zm_pb_menu_page_url($page, 'portuguese-pt', []), $plain . '&lang=pt');
    expect_url(zm_pb_menu_page_url($page, 'portuguese-br', []), $plain . '&lang=pt-BR');
    expect_url(zm_pb_sitemap_url('samplepage', 'portuguese-pt'), $plain . '&lang=pt');
    expect_url(zm_pb_sitemap_url('samplepage', 'portuguese-br'), $plain . '&lang=pt-BR');
    expect_url(zm_pb_menu_page_url($page, 'english', ['samplepage' => 'contact']), $plain . $defaultQuery);
    expect_url(zm_pb_sitemap_url('samplepage', 'english'), $plain . $defaultQuery);
    expect_url(zm_pb_sitemap_url('samplepage', 'russian', 'contact'), $plain . '&lang=ru');
    expect_url(ZM_PB_ContentLinks::localize('/billing/samplepage/', 'english'), $plain . $defaultQuery);
    expect_url(ZM_PB_ContentLinks::localize($base . 'samplepage/?sort=recent#results', 'russian'),
        $plain . '&lang=ru&sort=recent#results');
    expect_url(ZM_PB_ContentLinks::localize('/billing/contact/', 'english'),
        $base . '?m=zmchel_whmcs_multimodule&slug=contact' . $defaultQuery);
    expect_url(ZM_PB_ContentLinks::localize('/billing/index.php?m=zmchel_whmcs_multimodule&slug=samplepage', 'russian'),
        $plain . '&lang=ru');
    expect_url(ZM_PB_ContentLinks::localize('/billing/clientarea.php', 'english'), '/billing/clientarea.php');
    expect_url(ZM_PB_ContentLinks::localize('https://elsewhere.test/samplepage/', 'english'),
        'https://elsewhere.test/samplepage/');
    $markup = ZM_PB_ContentBuilder::build(json_encode(['format' => 'grapesjs',
        'html' => '<a href="/billing/samplepage/">Page</a><a href="https://elsewhere.test/">External</a>']),
        'mixed', ['lang' => 'russian', 'schema_enabled' => false]);
    $document = new DOMDocument();
    $document->loadHTML($markup);
    $links = $document->getElementsByTagName('a');
    expect_url($links->item(0)->getAttribute('href'), $plain . '&lang=ru');
    expect_url($links->item(1)->getAttribute('href'), 'https://elsewhere.test/');
}
if (ZM_PB_ENABLE_DEFAULT_LANG_ROUTE) {
    $expected = ZM_PB_PRETTY_URLS ? '/billing/en/samplepage/?sort=new' : $base . '?m=' . ZM_PB_NAME . '&slug=samplepage&lang=en&sort=new';
    expect_url(zm_pb_default_language_page_redirect_target('/billing/samplepage/?sort=new', 'samplepage'), $expected);
    $moduleQueryTarget = $base . (ZM_PB_PRETTY_URLS ? 'en/samplepage/?sort=new' : '?m=' . ZM_PB_NAME . '&slug=samplepage&lang=en&sort=new');
    expect_url(zm_pb_default_language_page_redirect_target('/billing/?m=' . ZM_PB_NAME . '&slug=samplepage&sort=new', 'samplepage'), $moduleQueryTarget);
    expect_url(zm_pb_default_language_page_redirect_target('/billing/en/samplepage/', 'samplepage'), null);
    expect_url(zm_pb_default_language_page_redirect_target('/elsewhere/samplepage/', 'samplepage'), null);
    $paginationTarget = ZM_PB_PRETTY_URLS
        ? '/billing/en/samplepage/page/2/'
        : $base . '?m=' . ZM_PB_NAME . '&slug=samplepage&lang=en&page=2';
    expect_url(zm_pb_default_language_page_redirect_target('/billing/samplepage/page/2/', 'samplepage', 2), $paginationTarget);
} else {
    expect_url(zm_pb_default_language_page_redirect_target('/billing/samplepage/', 'samplepage'), null);
}
require dirname(__DIR__) . '/inc/helpers.php';
$requestedLanguage = in_array('--br', $argv, true) ? 'portuguese-br' : 'portuguese-pt';
$requestedCode = ZM_PB_LANGS[$requestedLanguage]['route_code'];
if (ZM_PB_PRETTY_URLS) {
    $_GET = [];
    $_SERVER['REQUEST_URI'] = '/billing/' . $requestedCode . '/samplepage/';
} else {
    $_GET = ['m' => ZM_PB_NAME, 'slug' => 'samplepage', 'lang' => $requestedCode];
    $_SERVER['REQUEST_URI'] = '/billing/?m=' . ZM_PB_NAME . '&slug=samplepage&lang=' . $requestedCode;
}
$parsed = zm_pb_parse_request();
expect_url($parsed['lang'], $requestedCode);
expect_url($parsed['slug'], 'samplepage');
$pageData = ['page' => (object) ['slug' => 'samplepage'], 'settings' => [
    'portuguese-pt' => (object) ['lang' => 'portuguese-pt'],
    'portuguese-br' => (object) ['lang' => 'portuguese-br'],
]];
expect_url(zm_pb_resolve_page_settings($pageData, $parsed)->lang, $requestedLanguage);
if (ZM_PB_ENABLE_DEFAULT_LANG_ROUTE) {
    $fallbackPage = ['page' => (object) ['slug' => 'samplepage'], 'settings' => [
        'russian' => (object) ['lang' => 'russian'],
    ]];
    expect_url(zm_pb_resolve_page_settings($fallbackPage, ['lang' => 'en'])->lang, 'russian');
}
echo 'Page URL mode OK' . PHP_EOL;
