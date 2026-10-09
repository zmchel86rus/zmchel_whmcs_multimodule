<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
require_once __DIR__ . '/list_controls.php';

/** Request-local pagination. No session state and no database writes. */
class ZM_PB_Pagination
{
    private static $configs = [];
    private static $results = [];
    private static $language = 'english';
    public static function language($language) { self::$language = $language ?: 'english'; }
    public static function cleanQuery(array $query)
    {
        foreach (array_keys($query) as $key) {
            $clean = preg_replace('/^(?:amp;)+/', '', (string) $key);
            if ($clean !== (string) $key) {
                if ($clean !== '' && !array_key_exists($clean, $query)) $query[$clean] = $query[$key];
                unset($query[$key]);
            }
        }
        foreach ($query as $key => $value) {
            if (is_array($value)) $value = self::cleanQuery($value);
            if ($value === null || $value === [] || (is_string($value) && trim($value) === '')) unset($query[$key]);
            else $query[$key] = $value;
        }
        return $query;
    }
    private static function label($key)
    {
        $labels = ['russian' => ['page'=>'Страница','count'=>'На странице'], 'english'=>['page'=>'Page','count'=>'Per page'],
            'german'=>['page'=>'Seite','count'=>'Pro Seite'], 'ukranian'=>['page'=>'Сторінка','count'=>'На сторінці'], 'spanish'=>['page'=>'Página','count'=>'Por página']];
        return ($labels[self::$language] ?? $labels['english'])[$key];
    }

    private static function number($value, $default, $min, $max)
    {
        return is_scalar($value) && preg_match('/^[0-9]{1,9}$/D', (string) $value)
            ? max($min, min($max, (int) $value)) : $default;
    }

    private static function pageSize($value, $default = 100)
    {
        if (!is_scalar($value) || !preg_match('/^[+-]?[0-9]+$/D', (string) $value)) return max(10, min(250, (int) $default));
        // Clamp before casting to int, including values larger than PHP_INT_MAX.
        return (int) max(10, min(250, (float) $value));
    }

    public static function register(DOMElement $element, $paginate = true)
    {
        $target = $element->getAttribute('data-zm-pb-page-target');
        if ($target === '' || strlen($target) > 160) return null;
        if (isset(self::$configs[$target])) return $target;
        $get = function ($key) use ($element) { return $element->getAttribute('data-zm-pb-page-' . $key); };
        $variable = ltrim(trim($get('variable')), '$');
        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/D', $variable)) $variable = '';
        $suffix = self::$configs ? '_' . substr(hash('sha256', $target), 0, 8) : '';
        $config = ['target' => $target, 'variable' => $variable, 'suffix' => $suffix,
            'count' => self::pageSize($get('count')), 'duplicate' => $get('duplicate') === '1',
            'label' => $get('label') ?: 'Pagination', 'selector' => $get('selector')];
        $config['url-mode'] = in_array($get('url-mode'), ['query', 'path'], true) ? $get('url-mode') : 'auto';
        $config['paginate'] = $paginate;
        $config['count-select'] = $get('count-select') === '1';
        $config['show-status'] = $get('show-status') === '1';
        $config['noindex'] = $get('noindex') === '1';
        $config['size'] = in_array($get('size'), ['small', 'large'], true) ? $get('size') : 'standard';
        foreach (['desktop' => [2, 2, 2], 'mobile' => [1, 1, 1]] as $device => $defaults) {
            foreach (['start', 'end', 'middle'] as $index => $part) {
                $config[$device . '-' . $part] = self::number($get($device . '-' . $part), $defaults[$index], 0, 10);
            }
        }
        self::$configs[$target] = $config;
        return $target;
    }

    public static function config($id) { return self::$configs[$id] ?? null; }
    public static function bindVariable($id, $variable) { self::$configs[$id]['variable'] = $variable; }

    public static function isBound($variable)
    {
        foreach (self::$configs as $config) if ($config['variable'] === $variable) return true;
        return false;
    }

    public static function request($id)
    {
        $_GET = self::cleanQuery($_GET);
        $config = self::$configs[$id];
        $suffix = $config['suffix'];
        $route = function_exists('zm_pb_parse_request') ? zm_pb_parse_request() : [];
        return [
            'page' => self::number(self::pathOwner() === $id && isset($route['page']) ? $route['page'] : ($_GET['page' . $suffix] ?? null), 1, 1, 100000000),
            'count' => self::pageSize($_GET['count' . $suffix] ?? null, $config['count']),
            'sort' => is_string($_GET['sort' . $suffix] ?? null) ? substr($_GET['sort' . $suffix], 0, 60) : '',
        ];
    }

    private static function pathOwner()
    {
        $owner = $_GET['pager'] ?? null;
        return is_string($owner) && isset(self::$configs[$owner]) ? $owner : array_key_first(self::$configs);
    }

    private static function window($id, $total, $provider = false)
    {
        $result = self::request($id);
        $result['total'] = max(0, (int) $total);
        if (!self::$configs[$id]['paginate']) $result['count'] = max(1, $result['total']);
        $result['pages'] = max(1, (int) ceil($result['total'] / $result['count']));
        $result['page'] = min($result['page'], $result['pages']);
        $result['offset'] = ($result['page'] - 1) * $result['count'];
        $result['provider'] = $provider;
        self::$results[$id] = $result;
        return $result;
    }

    /** Providers opt in only for a bound variable; other uses of the collection stay unchanged. */
    private static function providerId($variable)
    {
        $ids = [];
        foreach (self::$configs as $id => $config) if ($config['variable'] === $variable) $ids[] = $id;
        return count($ids) === 1 ? $ids[0] : null;
    }

    public static function query($variable, $query, array $sorts = [])
    {
        $id = self::providerId($variable);
        if ($id === null) {
            if (self::isBound($variable)) {
                // Several blocks can use different windows of the same full collection.
                $query = clone $query;
                $query->limit = null;
                $query->offset = null;
            }
            return $query->get();
        }
        $query = clone $query;
        if (!ZM_PB_ListControls::canQuery($id, $sorts)) {
            $query->limit = null; $query->offset = null;
            return new \Illuminate\Support\Collection(self::collection($variable, $query->get()));
        }
        ZM_PB_ListControls::query($id, $query, $sorts);
        $countQuery = clone $query;
        $countQuery->limit = null;
        $countQuery->offset = null;
        $countQuery->orders = null;
        $countQuery->setBindings([], 'order');
        $result = self::window($id, $countQuery->count(), true);
        $query = clone $query;
        $sort = ltrim($result['sort'], '-');
        if (isset($sorts[$sort])) {
            $query->orders = null;
            $query->setBindings([], 'order');
            $query->orderBy($sorts[$sort], substr($result['sort'], 0, 1) === '-' ? 'desc' : 'asc');
        }
        // Stable tie breaker prevents records jumping between pages with equal prices/dates.
        $query->orderBy('domain_name', 'asc');
        return $query->offset($result['offset'])->limit($result['count'])->get();
    }

    public static function collection($variable, $items)
    {
        $id = self::providerId($variable);
        return $id === null ? $items : self::slice($id, $items, true);
    }

    private static function slice($id, $items, $provider = false)
    {
        if ($items instanceof Traversable) $items = iterator_to_array($items);
        if (!is_array($items)) $items = [];
        if (!$provider && class_exists('ZM_PB_SmartyVariables', false)) {
            $items = ZM_PB_SmartyVariables::snapshot($items, self::$configs[$id]['variable']);
            if (!is_array($items)) $items = [];
        }
        $items = ZM_PB_ListControls::filter($id, $items);
        $request = self::request($id);
        $field = ltrim($request['sort'], '-');
        if (in_array($field, ['domain_name', 'base_price', 'highest_bid', 'expiry_date', 'domain_rank'], true)) {
            $direction = substr($request['sort'], 0, 1) === '-' ? -1 : 1;
            // Never invoke object getters/lazy database relations while sorting a template variable.
            $value = function ($row, $key) {
                $fields = is_array($row) ? $row : (is_object($row) ? get_object_vars($row) : []);
                return is_scalar($fields[$key] ?? null) ? $fields[$key] : '';
            };
            uasort($items, function ($a, $b) use ($field, $direction, $value) {
                return (($value($a, $field) <=> $value($b, $field)) ?: ($value($a, 'domain_name') <=> $value($b, 'domain_name'))) * $direction;
            });
        }
        $result = self::window($id, count($items), $provider);
        return array_slice($items, $result['offset'], $result['count'], true);
    }

    public static function variables($id, array $variables)
    {
        $variable = self::$configs[$id]['variable'];
        if ($variable !== '' && empty(self::$results[$id]['provider'])) {
            $variables[$variable] = self::slice($id, $variables[$variable] ?? []);
        }
        $variables['zm_pagination'] = self::$results[$id] ?? self::request($id);
        return $variables;
    }

    /** Fallback for ordinary containers or Smarty without a collection binding. */
    public static function paginateHtml($id, $html)
    {
        $doc = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="UTF-8"?><html><body><div id="zm-pagination-fragment">' . $html . '</div></body></html>');
        libxml_clear_errors(); libxml_use_internal_errors($previous);
        $xpath = new DOMXPath($doc);
        $root = $xpath->query('//*[@id="zm-pagination-fragment"]')->item(0);
        if (!$root) return $html;
        $selector = self::$configs[$id]['selector'];
        $items = [];
        if (preg_match('/^\.([a-zA-Z_][a-zA-Z0-9_-]*)$/D', $selector, $match)) {
            foreach ($xpath->query('.//*[contains(concat(" ", normalize-space(@class), " "), " ' . $match[1] . ' ")]', $root) as $item) $items[] = $item;
        } elseif (preg_match('/^[a-zA-Z][a-zA-Z0-9]*$/D', $selector)) {
            foreach ($root->getElementsByTagName(strtolower($selector)) as $item) $items[] = $item;
        } else {
            $container = $root;
            do {
                $items = [];
                foreach ($container->childNodes as $child) {
                    if ($child instanceof DOMElement && !in_array(strtolower($child->tagName), ['script', 'style', 'link', 'thead', 'tfoot'], true)) $items[] = $child;
                }
                if (count($items) !== 1) break;
                $container = $items[0];
                // A leaf is itself a single item, not an empty list.
                if (!$container->getElementsByTagName('*')->length) break;
            } while (true);
        }
        // A matching row cannot be both an item and a descendant of another item.
        $selected = new SplObjectStorage();
        foreach ($items as $item) $selected->attach($item);
        $items = array_values(array_filter($items, function ($item) use ($selected) {
            for ($parent = $item->parentNode; $parent; $parent = $parent->parentNode) {
                if ($parent instanceof DOMElement && in_array(strtolower($parent->tagName), ['thead', 'tfoot'], true)) return false;
                if ($selected->contains($parent)) return false;
            }
            return true;
        }));
        $result = self::window($id, count($items));
        foreach ($items as $index => $item) {
            if ($index < $result['offset'] || $index >= $result['offset'] + $result['count']) $item->parentNode->removeChild($item);
        }
        $output = '';
        foreach ($root->childNodes as $child) $output .= $doc->saveHTML($child);
        return $output;
    }

    public static function url($id, $page)
    {
        $config = self::$configs[$id];
        $request = self::request($id);
        $uri = $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] ?? ($_SERVER['REQUEST_URI'] ?? '/');
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $path = '/' . ltrim($path, '/'); // Never emit a protocol-relative URL.
        parse_str((string) parse_url($uri, PHP_URL_QUERY), $query);
        $query = self::cleanQuery($query);
        // rp added by an internal rewrite is not part of the public URL.
        $pretty = $config['url-mode'] === 'path' || ($config['url-mode'] === 'auto' && defined('ZM_PB_PRETTY_URLS') && ZM_PB_PRETTY_URLS);
        $pretty = $pretty && !preg_match('/\.php(?:\/|$)/i', $path);
        $owner = self::pathOwner();
        $route = function_exists('zm_pb_parse_request') ? zm_pb_parse_request() : [];
        if ($pretty || $owner === $id) {
            $path = preg_replace('~/page/[0-9]+/?$~', '/', $path);
        }
        if ($pretty) {
            // Only one list can own /page/N; retain the previous owner's page
            // in its query parameter when switching between independent lists.
            if ($owner !== $id && isset($route['page'], self::$configs[$owner])) {
                $query['page' . self::$configs[$owner]['suffix']] = self::request($owner)['page'];
            }
            $path = rtrim($path, '/') . ($page > 1 ? '/page/' . $page . '/' : '/');
            unset($query['page' . $config['suffix']]);
            if ($config['suffix'] === '') unset($query['pager']);
            else $query['pager'] = $id;
        } else {
            if ($owner === $id) unset($query['pager']);
            $query['page' . $config['suffix']] = $page;
        }
        $query['count' . $config['suffix']] = $request['count'];
        $qs = http_build_query($query, '', '&', PHP_QUERY_RFC3986);
        return $path . ($qs !== '' ? '?' . $qs : '') . '#' . rawurlencode($id);
    }

    private static function esc($value) { return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

    public static function render($id, array $variables = [], $part = 'all')
    {
        if ($part === 'count') return self::renderCount($id, $variables);
        if (!isset(self::$results[$id])) self::variables($id, $variables);
        if (!isset(self::$results[$id])) return '';
        $result = self::$results[$id]; $config = self::$configs[$id];
        if ($result['pages'] <= 1 && ($part !== 'all' || !$config['count-select']) && !$config['show-status']) return '';
        $html = '<nav class="zm-pb-pagination zm-pb-pagination-size-' . $config['size'] . '" aria-label="' . self::esc($config['label']) . '" data-total="' . $result['total'] . '">';
        foreach (['desktop', 'mobile'] as $device) {
            $pages = [$result['page'] => true];
            for ($i = 1; $i <= min($result['pages'], $config[$device . '-start']); $i++) $pages[$i] = true;
            for ($i = max(1, $result['pages'] - $config[$device . '-end'] + 1); $i <= $result['pages']; $i++) $pages[$i] = true;
            for ($i = max(1, $result['page'] - $config[$device . '-middle']); $i <= min($result['pages'], $result['page'] + $config[$device . '-middle']); $i++) $pages[$i] = true;
            ksort($pages);
            $html .= '<ul class="zm-pb-pagination-' . $device . '">';
            if ($result['page'] > 1) $html .= '<li><a rel="prev" href="' . self::esc(self::url($id, $result['page'] - 1)) . '" aria-label="' . self::esc($config['label']) . ': ' . ($result['page'] - 1) . '">‹</a></li>';
            $last = 0;
            foreach ($pages as $page => $unused) {
                if ($last && $page > $last + 1) $html .= '<li class="zm-pb-pagination-gap" aria-hidden="true">…</li>';
                $html .= $page === $result['page'] ? '<li><span aria-current="page">' . $page . '</span></li>'
                    : '<li><a href="' . self::esc(self::url($id, $page)) . '">' . $page . '</a></li>';
                $last = $page;
            }
            if ($result['page'] < $result['pages']) $html .= '<li><a rel="next" href="' . self::esc(self::url($id, $result['page'] + 1)) . '" aria-label="' . self::esc($config['label']) . ': ' . ($result['page'] + 1) . '">›</a></li>';
            $html .= '</ul>';
        }
        if ($part === 'all' && $config['count-select']) $html .= self::renderCount($id, $variables);
        if ($config['show-status']) $html .= '<span class="zm-pb-page-status">' . self::esc(self::label('page')) . ' ' . $result['page'] . ' / ' . $result['pages'] . '</span>';
        return $html . '</nav>';
    }

    private static function renderCount($id, array $variables)
    {
        if (!isset(self::$configs[$id]) || !self::$configs[$id]['count-select']) return '';
        if (!isset(self::$results[$id])) self::variables($id, $variables);
        if (!isset(self::$results[$id])) return '';
        $result = self::$results[$id]; $config = self::$configs[$id];
        $html = '';
        $action = self::url($id, 1);
        parse_str((string) parse_url($action, PHP_URL_QUERY), $query);
        unset($query['count' . $config['suffix']]);
        $html .= '<form method="get" class="zm-pb-page-count" action="' . self::esc((parse_url($action, PHP_URL_PATH) ?: '/') . '#' . rawurlencode($id)) . '">';
        foreach ($query as $name => $value) $html .= ZM_PB_ListControls::hidden($name, $value);
        $html .= '<label><span>' . self::esc(self::label('count')) . '</span><select name="count' . $config['suffix'] . '" data-zm-page-count>';
        $counts = array_unique(array_merge([10,25,50,100,250], [$result['count']])); sort($counts);
        foreach ($counts as $count) $html .= '<option value="' . $count . '"' . ($count === $result['count'] ? ' selected' : '') . '>' . $count . '</option>';
        $html .= '</select></label></form>';
        return $html;
    }

    public static function breadcrumbs(array $items)
    {
        if (!$items) return $items;
        foreach (self::$configs as $id => $config) {
            if (!$config['paginate'] || self::request($id)['page'] <= 1) continue;
            $page = self::$results[$id]['page'] ?? self::request($id)['page'];
            if ($page <= 1) return $items;
            $last = array_key_last($items);
            $suffix = ' — ' . self::label('page') . ' ' . $page;
            if (isset($items[$last]['label']) && is_string($items[$last]['label'])
                && substr($items[$last]['label'], -strlen($suffix)) !== $suffix) {
                $items[$last]['label'] .= $suffix;
            }
            break;
        }
        return $items;
    }

    /** Runs on the completed document, after deferred lists have supplied their totals. */
    public static function seo($html)
    {
        if (stripos($html, '<html') === false || stripos($html, '</head>') === false || strpos($html, '<!--zm-pb-page-seo-->') !== false) return $html;
        $active = null; $noindex = false;
        foreach (self::$configs as $id => $config) {
            if (!$config['paginate'] || self::request($id)['page'] <= 1) continue;
            if ($config['noindex']) $noindex = true;
            if ($active === null) $active = $id;
        }
        if ($active === null) return $html;
        $page = self::$results[$active]['page'] ?? self::request($active)['page'];
        $suffix = self::label('page') . ' ' . $page;
        $html = preg_replace_callback('~<title\b[^>]*>(.*?)</title>~is', function ($m) use ($suffix) {
            return '<title>' . $m[1] . ' — ' . self::esc($suffix) . '</title>';
        }, $html, 1);
        $html = preg_replace_callback('~<meta\b(?=[^>]*\bname\s*=\s*["\']description["\'])[^>]*>~i', function ($tag) use ($suffix) {
            return preg_replace_callback('~(\bcontent\s*=\s*)(["\'])(.*?)\2~is', function ($m) use ($suffix) {
                $description = html_entity_decode($m[3], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                return $m[1] . $m[2] . self::esc(rtrim($description) . ' — ' . $suffix) . $m[2];
            }, $tag[0], 1);
        }, $html, 1);
        if (defined('ZM_PB_FULLHOST')) {
            $site = parse_url(ZM_PB_FULLHOST);
            $canonical = ($site['scheme'] ?? 'https') . '://' . ($site['host'] ?? '') . (isset($site['port']) ? ':' . $site['port'] : '') . explode('#', self::url($active, $page), 2)[0];
            $html = preg_replace('~<link\b(?=[^>]*\brel=["\']canonical["\'])[^>]*>~i', '', $html);
            $html = preg_replace_callback('~</head>~i', function () use ($canonical) { return '<link rel="canonical" href="' . self::esc($canonical) . '"></head>'; }, $html, 1);
        }
        if ($noindex) {
            // Preserve any existing nofollow directive while replacing conflicting index directives.
            $nofollow = preg_match('~<meta\b(?=[^>]*\bname=["\']robots["\'])(?=[^>]*\bcontent=["\'][^"\']*nofollow)[^>]*>~i', $html);
            $html = preg_replace('~<meta\b(?=[^>]*\bname=["\']robots["\'])[^>]*>~i', '', $html);
            $html = preg_replace('~</head>~i', '<meta name="robots" content="noindex, ' . ($nofollow ? 'nofollow' : 'follow') . '"></head>', $html, 1);
        }
        return preg_replace('~</head>~i', '<!--zm-pb-page-seo--></head>', $html, 1);
    }
}
