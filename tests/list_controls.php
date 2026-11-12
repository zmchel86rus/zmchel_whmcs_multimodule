<?php
// Run from the WHMCS root: php modules/addons/zmchel_whmcs_multimodule/tests/list_controls.php
// Uses vendor classes, but does not connect to a database.
require dirname(__DIR__, 4) . '/vendor/autoload.php';
define('ZM_PB_VER', 'test');
define('ZM_PB_PRETTY_URLS', true);
require dirname(__DIR__) . '/lib/pagination.php';
function check($value, $message) { if (!$value) throw new RuntimeException($message); }
function zm_pb_parse_request() { return $GLOBALS['route'] ?? []; }
function control($kind, $id, $target, $settings) {
    $doc = new DOMDocument(); $el = $doc->createElement('div');
    foreach (['id' => $id, 'data-zm-pb-list-control' => $kind, 'data-zm-pb-page-target' => $target,
        'data-zm-pb-page-variable' => 'items', 'data-zm-pb-page-count' => '10',
        'data-zm-pb-list-settings' => json_encode($settings)] as $name => $value) $el->setAttribute($name, $value);
    return $el;
}
$element = control('search', 'search', 'target', ['searchFields' => 'title,category', 'label' => 'Search']);
ZM_PB_Pagination::register($element);
$search = ZM_PB_ListControls::register($element, 'target');
$filters = ZM_PB_ListControls::register(control('filters', 'filters', 'target', ['fields' => [
    ['field' => 'score', 'label' => 'Score', 'type' => 'range'],
    ['field' => 'group', 'label' => 'Group', 'type' => 'select', 'options' => "even : Even\nodd : Odd"],
    ['field' => 'featured', 'label' => 'Featured', 'type' => 'checkbox'],
]]), 'target');
$q = $search['definitions'][0]['name'];
[$score, $group, $featured] = array_column($filters['definitions'], 'name');
$rows = [];
for ($i = 0; $i < 20; $i++) $rows[] = ['title' => 'ITEM-' . $i, 'score' => $i,
    'group' => $i % 2 ? 'odd' : 'even', 'featured' => 1, 'category' => 'Технологии'];
$_GET = [$q => 'item', $score . '_min' => '4', $score . '_max' => '12', $group => 'even', $featured => '1', 'page' => '2'];
$values = ZM_PB_Pagination::variables('target', ['items' => new Illuminate\Support\Collection(array_merge($rows, $rows, $rows, $rows, $rows))]);
check($values['zm_pagination']['total'] === 25 && $values['zm_pagination']['pages'] === 3, 'Totals counted before filtering');
check(array_column($values['items'], 'score') === [4, 6, 8, 10, 12, 4, 6, 8, 10, 12], 'Wrong filtered page');
$_GET[$q] = 'тЕхНоЛоГ';
check(count(ZM_PB_ListControls::filter('target', $rows)) === 5, 'Unicode OR search failed');
$_GET[$q] = '%';
check(ZM_PB_ListControls::filter('target', $rows) === [], 'Wildcard interpreted as match-all');
$_GET[$q] = ['invalid']; $_GET[$group] = 'not-configured';
check(count(ZM_PB_ListControls::filter('target', $rows)) === 9, 'Malformed input/unknown option should be ignored');
$_GET[$score . '_min'] = '12'; $_GET[$score . '_max'] = '4';
check(count(ZM_PB_ListControls::filter('target', $rows)) === 9, 'Reversed range incorrect');
$_GET[$q] = 'item'; $_GET[$group] = 'even';
check(!ZM_PB_ListControls::canQuery('target', ['title' => 'title']), 'Unknown fields accepted as SQL identifiers');

class SearchQuery {
    public $conditions = [];
    public function getGrammar() { return new Illuminate\Database\Query\Grammars\MySqlGrammar(); }
    public function where($column, $operator = null, $value = null) {
        if ($column instanceof Closure) { $group = new self(); $column($group); $this->conditions[] = $group->conditions; }
        else $this->conditions[] = [$column, $operator, $value];
        return $this;
    }
    public function orWhereRaw($sql, $bindings) { $this->conditions[] = [$sql, $bindings]; return $this; }
}
$query = new SearchQuery();
$fields = ['title', 'category', 'score', 'group', 'featured'];
$columns = array_combine($fields, $fields);
check(ZM_PB_ListControls::canQuery('target', $columns), 'Allowed query fields rejected');
ZM_PB_ListControls::query('target', $query, $columns);
check(count($query->conditions) === 4 && count($query->conditions[0]) === 2, 'Search OR/filter AND grouping incorrect');
check($query->conditions[0][0][1] === ['item'] && strpos($query->conditions[0][0][0], '?') !== false, 'Search value interpolated into SQL');
$_SERVER['REQUEST_URI'] = '/ru/archive/page/7/?' . http_build_query($_GET + ['sort' => '-score']);
$GLOBALS['route'] = ['page' => 7];
$html = ZM_PB_ListControls::render($search);
check(strpos($html, 'action="/ru/archive/#target"') !== false, 'Search failed to reset pretty page');
check(strpos($html, 'name="' . $group . '" value="even"') !== false, 'Search lost another block filter');
check(substr_count($html, 'name="' . $q . '"') === 1, 'Old search duplicated as hidden field');
check(strpos($html, 'name="sort" value="-score"') !== false, 'Sort lost');
$standalone = control('search', 'standalone', 'all', ['searchFields' => 'title']);
ZM_PB_Pagination::register($standalone, false);
$allSearch = ZM_PB_ListControls::register($standalone, 'all');
$_GET[$allSearch['definitions'][0]['name']] = 'item';
$all = ZM_PB_Pagination::variables('all', ['items' => $rows]);
check(count($all['items']) === 20, 'Search without pagination truncated the list');
echo "PASS combined conditions, Unicode, literal wildcards, filtered totals/pages, SQL bindings, URL reset and standalone search\n";

$dates = ZM_PB_ListControls::register(control('filters', 'dates', 'dates-target', ['layout'=>'flex','direction'=>'column','gap'=>'12', 'fields'=>[
    ['field'=>'created_at','type'=>'date','label'=>'Date','width'=>'100'],
]]), 'dates-target');
$name = $dates['definitions'][0]['name'];
$_GET[$name . '_min'] = '2026-10-03'; $_GET[$name . '_max'] = '2026-10-04';
$items = [['created_at'=>'2026-10-02 23:59:59'],['created_at'=>'2026-10-03 00:00:00'],['created_at'=>'2026-10-04 23:59:59'],['created_at'=>'2026-10-05 00:00:00']];
check(array_keys(ZM_PB_ListControls::filter('dates-target',$items)) === [1,2], 'End date excluded timestamps within the day');
$dateQuery = new SearchQuery();
ZM_PB_ListControls::query('dates-target', $dateQuery, ['created_at'=>'created_at']);
check($dateQuery->conditions[0][1] === ['created_at','<','2026-10-05'], 'SQL date upper bound incorrect');
$_GET[$name . '_min'] = '2026-02-31'; unset($_GET[$name . '_max']);
check(count(ZM_PB_ListControls::filter('dates-target',$items)) === 4, 'Invalid calendar date was applied');
ZM_PB_Pagination::register(control('filters','dates','dates-target',[]), false);
$dateHtml = ZM_PB_ListControls::render($dates);
check(substr_count($dateHtml,'type="date"') === 2 && strpos($dateHtml,'--zm-list-direction:column') !== false && strpos($dateHtml,'--zm-list-width:100%') !== false, 'Date controls/layout absent');
echo "PASS date boundaries, SQL date bounds, invalid dates and flex layout\n";
