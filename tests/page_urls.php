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
        return in_array($this->slug, ['closedauctions', 'contact'], true)
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
define('ZM_PB_ENABLE_PAGE_OVERRIDES', true);
define('ZM_PB_MAINSYSTEM_PRETTY_URLS', true);
define('ZM_PB_PRETTY_URLS', in_array('--pretty', $argv, true));
define('ZM_PB_LANGS', require dirname(__DIR__) . '/supported_langs.php');
require dirname(__DIR__) . '/inc/menu_manager.php';
require dirname(__DIR__) . '/inc/sitemap_manager.php';
require dirname(__DIR__) . '/inc/url_redirects.php';
require dirname(__DIR__) . '/lib/content_links.php';
require dirname(__DIR__) . '/lib/content_builder.php';

function expect_url($actual, $expected)
{
    if ($actual !== $expected) throw new RuntimeException("Expected $expected, got $actual");
}

$page = (object) ['slug' => 'closedauctions'];
$base = 'https://example.test/billing/';
expect_url(zm_pb_escaped_query_redirect_target('/billing/?m=zmchel_whmcs_multimodule&amp;slug=closedauctions&amp;lang=ru'),
    '/billing/?m=zmchel_whmcs_multimodule&slug=closedauctions&lang=ru');
expect_url(zm_pb_escaped_query_redirect_target('/billing/?m=another_module&amp;slug=closedauctions'), null);
if (ZM_PB_PRETTY_URLS) {
    expect_url(zm_pb_menu_page_url($page, 'russian', []), $base . 'ru/closedauctions/');
    expect_url(zm_pb_menu_page_url($page, 'english', ['closedauctions' => 'contact']), $base . 'contact/');
    expect_url(zm_pb_sitemap_url('closedauctions', 'russian'), $base . 'ru/closedauctions/');
    expect_url(ZM_PB_ContentLinks::localize('/billing/closedauctions/', 'russian'), '/billing/ru/closedauctions/');
} else {
    $plain = $base . '?m=zmchel_whmcs_multimodule&slug=closedauctions';
    expect_url(zm_pb_menu_page_url($page, 'english', []), $plain);
    expect_url(zm_pb_menu_page_url($page, 'russian', []), $plain . '&lang=ru');
    expect_url(zm_pb_menu_page_url($page, 'english', ['closedauctions' => 'contact']), $plain);
    expect_url(zm_pb_sitemap_url('closedauctions', 'russian', 'contact'), $plain . '&lang=ru');
    expect_url(ZM_PB_ContentLinks::localize('/billing/closedauctions/', 'english'), $plain);
    expect_url(ZM_PB_ContentLinks::localize($base . 'closedauctions/?sort=recent#results', 'russian'),
        $plain . '&lang=ru&sort=recent#results');
    expect_url(ZM_PB_ContentLinks::localize('/billing/contact/', 'english'),
        $base . '?m=zmchel_whmcs_multimodule&slug=contact');
    expect_url(ZM_PB_ContentLinks::localize('/billing/index.php?m=zmchel_whmcs_multimodule&slug=closedauctions', 'russian'),
        $plain . '&lang=ru');
    expect_url(ZM_PB_ContentLinks::localize('/billing/clientarea.php', 'english'), '/billing/clientarea.php');
    expect_url(ZM_PB_ContentLinks::localize('https://elsewhere.test/closedauctions/', 'english'),
        'https://elsewhere.test/closedauctions/');
    $markup = ZM_PB_ContentBuilder::build(json_encode(['format' => 'grapesjs',
        'html' => '<a href="/billing/closedauctions/">Page</a><a href="https://elsewhere.test/">External</a>']),
        'mixed', ['lang' => 'russian', 'schema_enabled' => false]);
    $document = new DOMDocument();
    $document->loadHTML($markup);
    $links = $document->getElementsByTagName('a');
    expect_url($links->item(0)->getAttribute('href'), $plain . '&lang=ru');
    expect_url($links->item(1)->getAttribute('href'), 'https://elsewhere.test/');
}
echo 'Page URL mode OK' . PHP_EOL;
