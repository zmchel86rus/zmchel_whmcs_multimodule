<?php
/** Standalone regression test for pagination with arbitrary record fields. */
define('ZM_PB_VER', 'test');
require dirname(__DIR__) . '/lib/pagination.php';

function check($condition, $message)
{
    if (!$condition) throw new RuntimeException($message);
}

$document = new DOMDocument();
$element = $document->createElement('div');
$element->setAttribute('data-zm-pb-page-target', 'items');
$element->setAttribute('data-zm-pb-page-variable', 'items');
$element->setAttribute('data-zm-pb-page-count', '10');
ZM_PB_Pagination::register($element);
$element->setAttribute('data-zm-pb-list-control', 'search');
$element->setAttribute('data-zm-pb-list-settings', '{}');
check(ZM_PB_ListControls::register($element, 'items')['definitions'] === [],
    'A new search block must not assume a record field');

class GenericQuery
{
    public $orders = [['created_at', 'desc']];
    public $limit = 20;
    public $offset = 5;
    public $state;

    public function __construct()
    {
        $this->state = (object) [];
    }

    public function setBindings($bindings, $type) { return $this; }
    public function count()
    {
        check($this->limit === null && $this->offset === null && $this->orders === null,
            'The count query retained a page window or sort order');
        return 25;
    }
    public function orderBy($column, $direction)
    {
        check($column === 'score', 'An unknown column was added to the query: ' . $column);
        $this->orders[] = [$column, $direction];
        return $this;
    }
    public function offset($offset) { $this->offset = $offset; return $this; }
    public function limit($limit) { $this->limit = $limit; return $this; }
    public function get()
    {
        $this->state->orders = $this->orders;
        $this->state->window = [$this->offset, $this->limit];
        return [];
    }
}

$_GET = ['page' => '2', 'sort' => '-score'];
$query = new GenericQuery();
ZM_PB_Pagination::query('items', $query, ['score' => 'score']);
check($query->state->orders === [['score', 'desc'], ['created_at', 'desc']] && $query->state->window === [10, 10],
    'Requested sort or page window is wrong');
check($query->orders === [['created_at', 'desc']] && $query->limit === 20 && $query->offset === 5,
    'Pagination changed the source query');

$_GET = ['page' => '1'];
$query = new GenericQuery();
ZM_PB_Pagination::query('items', $query, ['score' => 'score']);
check($query->state->orders === [['created_at', 'desc']],
    'Pagination discarded source ordering without a requested sort');

$_GET = ['sort' => '-metrics.score'];
$items = [
    'one' => ['title' => 'First', 'metrics' => ['score' => 5]],
    'two' => ['title' => 'Second', 'metrics' => ['score' => 5]],
    'three' => ['title' => 'Third', 'metrics' => ['score' => 8]],
];
$sorted = ZM_PB_Pagination::collection('items', $items);
check(array_keys($sorted) === ['three', 'one', 'two'],
    'Collection sorting did not use the requested field or preserve ties');

$_GET = ['sort' => '-unknown'];
check(ZM_PB_Pagination::collection('items', $items) === $items,
    'An unknown collection field changed the original order');

$element = $document->createElement('div');
$element->setAttribute('data-zm-pb-page-target', 'keyed-items');
$element->setAttribute('data-zm-pb-page-variable', 'keyed');
$element->setAttribute('data-zm-pb-page-count', '10');
ZM_PB_Pagination::register($element);
$element->setAttribute('id', 'key-filter');
$element->setAttribute('data-zm-pb-list-control', 'filters');
$element->setAttribute('data-zm-pb-list-settings', json_encode(['fields' => [
    ['field' => 'title', 'arrayKey' => '1', 'label' => 'Array key', 'type' => 'text'],
]]));
$filter = ZM_PB_ListControls::register($element, 'keyed-items');
$_GET = [$filter['definitions'][0]['name'] => 'example.test'];
$keyed = [
    'first.example.test' => ['title' => 'First'],
    'other.test' => ['title' => 'example.test'],
    'second.example.test' => ['title' => 'Second'],
];
check(!ZM_PB_ListControls::canQuery('keyed-items', ['title' => 'title']),
    'An array key filter was incorrectly sent to SQL');
$result = ZM_PB_Pagination::variables('keyed-items', ['keyed' => $keyed]);
check(array_keys($result['keyed']) === ['first.example.test', 'second.example.test']
    && $result['zm_pagination']['total'] === 2,
    'Array key filtering lost keys or counted the wrong rows');
$_GET = [$filter['definitions'][0]['name'] => '0'];
check(array_keys(ZM_PB_ListControls::filter('keyed-items', [0 => ['title' => 'Zero'], 1 => ['title' => 'One']])) === [0],
    'Numeric array keys were not searchable');

echo "PASS generic pagination fields, stable collection sort, array keys, and provider ordering\n";
