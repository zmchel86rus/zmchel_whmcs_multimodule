<?php
/** php modules/addons/zmchel_whmcs_multimodule/tests/pagination.php [query]
 * No database or WHMCS bootstrap. Requires the project's vendor and PHP DOM.
 */
require dirname(__DIR__, 4) . '/vendor/autoload.php';
define('ZM_PB_VER', 'test');
define('ZM_PB_USE_COLLECT_VARS', true);
define('ZM_PB_PRETTY_URLS', ($argv[1] ?? '') !== 'query');
define('ZM_PB_LIBDIR', dirname(__DIR__) . '/lib/');
define('ZM_PB_ASSETSDIR', dirname(__DIR__) . '/assets/');
define('ZM_PB_ASSETSURL', '/module-assets/');
require ZM_PB_LIBDIR . 'pagination.php';
require ZM_PB_LIBDIR . 'content_builder.php';
$hooks = [];
function add_hook($name, $priority, $callback) { $GLOBALS['hooks'][$name][$priority][] = $callback; }
function zm_pb_parse_request() { return $GLOBALS['test_route'] ?? []; }
function check($condition, $label) { if (!$condition) throw new RuntimeException($label); }
function registerPager($target, array $attrs = []) {
    $doc = new DOMDocument(); $nav = $doc->createElement('nav');
    $nav->setAttribute('data-zm-pb-page-target', $target);
    foreach ($attrs as $name => $value) $nav->setAttribute('data-zm-pb-page-' . $name, $value);
    return ZM_PB_Pagination::register($nav);
}

$_SERVER['REQUEST_URI'] = '/ru/closedauctions/?sort=-domain_rank&filter=foo%26bar';
$_GET = ['page' => '2', 'count' => '100', 'sort' => '-domain_rank'];
$id = registerPager('archive', ['variable' => '$auction_sites', 'duplicate' => '1']);
$rows = [];
for ($i = 0; $i < 15001; $i++) $rows[] = (object) ['domain_name' => sprintf('domain-%05d.test', $i), 'domain_rank' => $i];

// A query double checks count/window/order independently of a live database.
class PageQuery {
    public $orders = [['legacy', 'desc']], $limit = 20, $offset = 7, $rows, $log;
    public function __construct($rows) { $this->rows = $rows; $this->log = (object) []; }
    public function setBindings($bindings, $kind) { return $this; }
    public function count() {
        check($this->limit === null && $this->offset === null && $this->orders === null, 'COUNT inherited a limit or ordering');
        $this->log->count = count($this->rows); return count($this->rows);
    }
    public function orderBy($column, $direction) { $this->orders[] = [$column, $direction]; return $this; }
    public function offset($value) { $this->offset = $value; return $this; }
    public function limit($value) { $this->limit = $value; return $this; }
    public function get() {
        $this->log->window = [$this->offset, $this->limit]; $this->log->orders = $this->orders;
        return new Illuminate\Support\Collection(array_slice($this->rows, $this->offset ?? 0, $this->limit));
    }
}
$query = new PageQuery($rows);
$page = ZM_PB_Pagination::query('auction_sites', $query, ['domain_rank' => 'domain_rank']);
check($query->log->count === 15001 && $query->log->window === [100, 100], 'SQL page/total incorrect');
check($query->limit === 20 && $query->offset === 7, 'Provider mutated the original query');
check($query->log->orders === [['domain_rank', 'desc'], ['domain_name', 'asc']], 'Sort or stable tie breaker missing');
$context = ZM_PB_Pagination::variables($id, ['auction_sites' => $page]);
check(count($context['auction_sites']) === 100 && $context['zm_pagination']['pages'] === 151, 'Provider results paginated twice');
$url = ZM_PB_Pagination::url($id, 3);
check(strpos($url, ZM_PB_PRETTY_URLS ? '/page/3/' : 'page=3') !== false, 'Automatic URL format incorrect');
check(strpos($url, 'sort=-domain_rank') !== false && strpos($url, 'filter=foo%26bar') !== false, 'Query filters lost or double encoded');
$nav = ZM_PB_Pagination::render($id);
check(strpos($nav, 'data-total="15001"') !== false && strpos($nav, 'aria-current="page">2') !== false, 'Total/current page incorrect');
check(strpos($nav, 'pagination-mobile') !== false && strpos($nav, 'pagination-desktop') !== false, 'Responsive variants missing');
check(strpos($nav, 'zm-pb-page-status') === false, 'Page status must be hidden by default');
foreach (['500' => 250, '100000' => 250, '999999999999999999999999' => 250, '1' => 10, '0' => 10, '-5' => 10] as $input => $expected) {
    $_GET['count'] = (string) $input;
    $bounded = new PageQuery($rows);
    $boundedRows = ZM_PB_Pagination::query('auction_sites', $bounded);
    check($bounded->log->window[1] === $expected && count($boundedRows) === $expected, 'Unbounded SQL count: ' . $input);
}
$_GET['count'] = ['invalid'];
check(ZM_PB_Pagination::request($id)['count'] === 100, 'Array count should use the bounded default');
$_GET['count'] = '100';

// Restore new-request state for full render integration, including a late Smarty variable.
foreach (['configs', 'results'] as $name) {
    $property = new ReflectionProperty(ZM_PB_Pagination::class, $name); $property->setAccessible(true); $property->setValue(null, []);
}
$code = '{foreach from=$auction_sites item=v}<div class="record">{$v.domain_name}</div>{/foreach}';
$navHtml = '<nav data-zm-pb-pagination="1" data-zm-pb-page-target="archive" data-zm-pb-page-variable="auction_sites" data-zm-pb-page-count="100" data-zm-pb-page-duplicate="1"></nav>';
$smartyHtml = '<div id="archive" data-zm-pb-smarty="' . htmlspecialchars($code, ENT_QUOTES) . '"></div>';
$built = ZM_PB_ContentBuilder::build(json_encode(['format' => 'grapesjs', 'html' => $navHtml . $smartyHtml]), 'mixed', ['schema_enabled' => false]);
$GLOBALS['smarty'] = new Smarty();
$GLOBALS['smarty']->assign('auction_sites', new Illuminate\Support\Collection($rows));
foreach ($hooks['ClientAreaPage'] as $callbacks) foreach ($callbacks as $callback) $callback([]);
foreach ($hooks['ClientAreaFooterOutput'] as $callbacks) foreach ($callbacks as $callback) $callback([]);
$GLOBALS['smarty']->assign('built', $built);
ob_start();
$rendered = $GLOBALS['smarty']->fetch('eval:{$built}');
check(ob_get_clean() === '', 'Deferred rendering emitted output');
check(substr_count($rendered, 'class="record"') === 100, 'Smarty did not receive exactly one page');
check(substr_count($rendered, '<nav class="zm-pb-pagination ') === 2, 'Opposite-side duplicate missing');
check(strpos($rendered, 'id="archive"') !== false && strpos($rendered, 'ZM_PB_SMARTY_') === false, 'Target anchor or deferred replacement broken');
check(strpos($rendered, '<nav') < strpos($rendered, 'id="archive"') && strrpos($rendered, '<nav') > strpos($rendered, 'id="archive"'), 'Duplicate on wrong side');

// Independent list: custom row selector must keep table headers and avoid nested matches.
$staticId = registerPager('table', ['count' => '10', 'selector' => 'tr', 'url-mode' => 'query']);
$suffix = ZM_PB_Pagination::config($staticId)['suffix'];
$_GET['page' . $suffix] = '2';
$table = '<table><thead><tr><th>Header</th></tr></thead><tbody>';
foreach (range(1, 25) as $row) $table .= '<tr><td>row-' . $row . '</td></tr>';
$table .= '</tbody><tfoot><tr><td>Footer</td></tr></tfoot></table>';
$sliced = ZM_PB_Pagination::paginateHtml($staticId, $table);
check(strpos($sliced, '>row-11<') !== false && strpos($sliced, '>row-20<') !== false && strpos($sliced, '>row-10<') === false && strpos($sliced, '>row-21<') === false, 'HTML row paging incorrect');
check(strpos($sliced, '<th>Header</th>') !== false && strpos($sliced, '>Footer<') !== false, 'Table head/footer paginated as records');
check(strpos(ZM_PB_Pagination::url($staticId, 3), 'page' . $suffix . '=3') !== false, 'Independent list URL incorrect');
$_GET['page' . $suffix] = ['bad']; $_GET['count' . $suffix] = '99999999';
check(ZM_PB_Pagination::request($staticId)['page'] === 1 && ZM_PB_Pagination::request($staticId)['count'] === 250, 'Malformed/unbounded parameters accepted');

// Per-block format overrides the module setting, and switching removes an old path suffix.
foreach (['query', 'path'] as $mode) {
    foreach (['configs', 'results'] as $name) {
        $property = new ReflectionProperty(ZM_PB_Pagination::class, $name); $property->setAccessible(true); $property->setValue(null, []);
    }
    $id = registerPager('switch', ['url-mode' => $mode]);
    $_SERVER['REQUEST_URI'] = '/ru/closedauctions/page/2/?sort=domain_name&page=8';
    $url = ZM_PB_Pagination::url($id, 3);
    check($mode === 'query' ? strpos($url, '/page/') === false && strpos($url, 'page=3') !== false
        : strpos($url, '/page/3/') !== false && strpos($url, 'page=') === false, 'Block URL override failed: ' . $mode);
}
echo "PASS SQL count/window/sort, 15001 records, deferred Smarty, duplicate, responsive navigation, HTML rows, independent lists, URL modes and invalid parameters\n";

foreach (['configs', 'results'] as $name) {
    $property = new ReflectionProperty(ZM_PB_Pagination::class, $name); $property->setAccessible(true); $property->setValue(null, []);
}
define('ZM_PB_FULLHOST', 'https://example.test/');
ZM_PB_Pagination::language('russian');
$id = registerPager('seo-list', ['variable'=>'rows', 'count-select'=>'1', 'noindex'=>'1', 'size'=>'small', 'show-status'=>'1']);
$_GET = ['page'=>'2','amp;amp;count'=>'25'];
$_SERVER['REQUEST_URI'] = '/ru/list/?page=2&amp%3Bamp%3Bcount=25&count=50&filter=A%26amp%3BB';
$url = ZM_PB_Pagination::url($id, 3);
parse_str(parse_url($url, PHP_URL_QUERY), $query);
check(!isset($query['amp;count'], $query['amp;amp;count']) && $query['filter'] === 'A&amp;B', 'URL cleaning corrupted values or retained amp keys');
check(substr_count($url, 'count=') === 1, 'Duplicate count parameter');
$values = ZM_PB_Pagination::variables($id, ['rows'=>range(1,200)]);
$panel = ZM_PB_Pagination::render($id);
foreach ([10,25,50,100,250] as $size) check(strpos($panel, 'value="' . $size . '"') !== false, 'Count option missing');
check(strpos($panel, 'zm-pb-pagination-size-small') !== false, 'Panel size missing');
check(strpos($panel, 'Страница 2 / 8') !== false, 'Page status missing');
check(strpos(ZM_PB_Pagination::render($id, [], 'buttons'), 'data-zm-page-count') === false, 'Buttons included an embedded count selector');
check(strpos(ZM_PB_Pagination::render($id, [], 'count'), 'data-zm-page-count') !== false, 'Detached count selector missing');
$crumbs = [['label'=>'Home', 'link'=>'/'], ['label'=>'Archive', 'link'=>'']];
$pagedCrumbs = ZM_PB_Pagination::breadcrumbs($crumbs);
check($pagedCrumbs[1]['label'] === 'Archive — Страница 2' && ZM_PB_Pagination::breadcrumbs($pagedCrumbs) === $pagedCrumbs, 'Pagination breadcrumb missing or duplicated');
$source = '<html><head><title>Archive</title><meta name="description" content="Domains &amp; auctions"><link rel="canonical" href="https://example.test/"><meta name="robots" content="index, nofollow"></head><body></body></html>';
$seo = ZM_PB_Pagination::seo($source);
check(strpos($seo, 'Страница 2</title>') !== false && strpos($seo, 'noindex, nofollow') !== false, 'Page title or robots incorrect');
check(strpos($seo, 'content="Domains &amp; auctions — Страница 2"') !== false, 'Page description missing or double escaped');
check(substr_count($seo, 'rel="canonical"') === 1 && strpos($seo, 'href="https://example.test/ru/list/') !== false, 'Canonical not replaced');
check(ZM_PB_Pagination::seo($seo) === $seo, 'SEO applied twice');
$_GET['page'] = '1';
check(ZM_PB_Pagination::seo($source) === $source, 'First page SEO changed');
check(ZM_PB_Pagination::breadcrumbs($crumbs) === $crumbs, 'First page breadcrumbs changed');
echo "PASS amp cleanup, count selector, panel size, page title, canonical, noindex scope and idempotence\n";

// A moved selector keeps its own position, while automatic duplication duplicates only the pager layout.
foreach ([ZM_PB_Pagination::class => ['configs', 'results'], ZM_PB_SmartyBlocks::class => ['pending', 'resolved']] as $class => $names) {
    foreach ($names as $name) {
        $property = new ReflectionProperty($class, $name); $property->setAccessible(true); $property->setValue(null, []);
    }
}
$_GET = ['page' => '2', 'count' => '100000'];
$_SERVER['REQUEST_URI'] = '/ru/closedauctions/?page=2&count=100000&zone=com';
$layout = '<section id="selector-position"><div id="count-part" class="zm-pb-page-count-block" style="margin-left:auto" data-zm-pb-page-count-control="1" data-zm-pb-page-owner="pager-layout"></div></section>'
    . $smartyHtml
    . '<div id="pager-layout" class="zm-pb-pagination-layout" data-zm-pb-pagination="1" data-zm-pb-page-layout="1" data-zm-pb-page-target="archive" data-zm-pb-page-variable="auction_sites" data-zm-pb-page-count-select="1" data-zm-pb-page-duplicate="1">'
    . '<div id="buttons-part" class="zm-pb-pagination-buttons" data-zm-pb-page-buttons="1" data-zm-pb-page-owner="pager-layout"></div></div>';
$built = ZM_PB_ContentBuilder::build(json_encode(['format'=>'grapesjs', 'html'=>$layout]), 'mixed', ['schema_enabled'=>false]);
$GLOBALS['smarty']->assign('auction_sites', new Illuminate\Support\Collection($rows));
foreach ($hooks['ClientAreaFooterOutput'] as $callbacks) foreach ($callbacks as $callback) $callback([]);
$GLOBALS['smarty']->assign('built', $built);
$rendered = $GLOBALS['smarty']->fetch('eval:{$built}');
$doc = new DOMDocument();
$errors = libxml_use_internal_errors(true);
$doc->loadHTML('<?xml encoding="UTF-8"?>' . $rendered);
libxml_clear_errors(); libxml_use_internal_errors($errors);
$xpath = new DOMXPath($doc);
check($xpath->query('//*[@id="selector-position"]//select[@data-zm-page-count]')->length === 1, 'Moved selector lost its position');
check($xpath->query('//select[@data-zm-page-count]')->length === 1, 'Moved selector was duplicated with the pager');
check($xpath->query('//nav[contains(@class,"zm-pb-pagination")]')->length === 2, 'Layout pager duplicate missing');
check($xpath->query('//*[@id="buttons-part"]')->length === 1, 'Duplicate layout reused element IDs');
check($xpath->query('//select/option[@selected and @value="250"]')->length === 1, 'Detached selector bypassed backend count limit');
check($xpath->query('//*[@id="selector-position"]//input[@name="zone" and @value="com"]')->length === 1, 'Detached selector lost filters');
echo "PASS detached count position, duplicate layout, query preservation and bounded count\n";
