<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
use Illuminate\Database\Capsule\Manager as Capsule;

function zm_pb_menu_text()
{
    if (isset(ZM_PB_ADMINLANG->menu_manager)) return ZM_PB_ADMINLANG->menu_manager;
    $fallback = require ZM_PB_ALANGDIR . 'english.php';
    return $fallback->menu_manager;
}

function zm_pb_menu_error_message(Throwable $error, $text)
{
    $key = $error->getMessage();
    if (preg_match('/^invalid_items(#\d+(?::item=\d+)?(?::field=[a-z_]+)?)$/D', $key, $match)) {
        return ($text->errors->invalid_items ?? 'invalid_items') . ' (' . $match[1] . ')';
    }
    return $text->errors->$key ?? $key;
}

function zm_pb_menu_locations()
{
    return [
        'primary_navbar' => ['hook' => 'ClientAreaPrimaryNavbar', 'constant' => 'ZM_PB_ENABLE_MAINNAV'],
        'secondary_navbar' => ['hook' => 'ClientAreaSecondaryNavbar', 'constant' => 'ZM_PB_ENABLE_SECONDARYNAV'],
        'primary_sidebar' => ['hook' => 'ClientAreaPrimarySidebar', 'constant' => 'ZM_PB_ENABLE_MAINSIDEBAR'],
        'secondary_sidebar' => ['hook' => 'ClientAreaSecondarySidebar', 'constant' => 'ZM_PB_ENABLE_SECONDARYSIDEBAR'],
        'footer' => ['hook' => null, 'constant' => 'ZM_PB_ENABLE_FOOTERMENU'],
    ];
}

function zm_pb_menu_tables_ready()
{
    foreach (['zm_pb_menus', 'zm_pb_menu_items', 'zm_pb_menu_locations'] as $name) {
        if (!zm_pb_has_table($name)) return false;
    }
    return true;
}

function zm_pb_menu_safe_url($url)
{
    if (!is_string($url) || strlen($url) > 2048 || preg_match('/[\x00-\x20\x7f<>"\\\\]/', $url)) return false;
    if (html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8') !== $url) return false;
    if ($url === '' || $url[0] === '#') return true;
    if (strpos($url, '//') === 0) return false;
    $scheme = parse_url($url, PHP_URL_SCHEME);
    return $scheme === null || $scheme === false ? $scheme !== false : in_array(strtolower($scheme), ['https', 'http', 'mailto', 'tel'], true);
}

function zm_pb_menu_override_sources()
{
    if (!defined('ZM_PB_ENABLE_PAGE_OVERRIDES') || !ZM_PB_ENABLE_PAGE_OVERRIDES
        || !zm_pb_has_table('zm_pb_module_settings')) return [];
    $configuration = json_decode(Capsule::table('zm_pb_module_settings')
        ->where('setting_name', 'page_overrides')->value('setting_value') ?? '[]', true);
    if (!is_array($configuration)) return [];
    $result = [];
    foreach ((array) ($configuration['from'] ?? []) as $index => $source) {
        $target = $configuration['to'][$index] ?? '';
        $type = $configuration['type'][$index] ?? '';
        if (!is_string($source) || !in_array($source, ZM_PB_MAINSYSTEM_DEFAULT_PAGES, true)
            || !is_string($target) || $target === '' || !in_array($type, ZM_PB_ACCEPTED_OVERRIDES, true)) continue;
        if (!isset($result[$target])) $result[$target] = $source;
    }
    return $result;
}

/** Default-language URLs are calculated, never copied from a localized browser URL. */
function zm_pb_menu_page_url($page, $language = null, $overrideSources = null)
{
    $language = $language ?? ZM_PB_DEFLANG;
    $slug = trim((string) $page->slug, '/');
    $base = rtrim(ZM_PB_FULLHOST, '/');
    $prefix = ZM_PB_ENABLE_LANG_ROUTE && $language !== ZM_PB_DEFLANG ? (ZM_PB_LANGS[$language]['code_lower'] ?? '') : '';
    if ($overrideSources === null) $overrideSources = zm_pb_menu_override_sources();
    if (isset($overrideSources[$slug])) {
        $source = $overrideSources[$slug];
        $path = $source === 'index' ? (ZM_PB_MAINSYSTEM_PRETTY_URLS ? '' : 'index.php')
            : $source . (ZM_PB_MAINSYSTEM_PRETTY_URLS ? '/' : '.php');
        return $base . '/' . (ZM_PB_PRETTY_URLS && $prefix !== '' ? $prefix . '/' : '') . $path;
    }
    if (ZM_PB_PRETTY_URLS) return $base . '/' . ($prefix !== '' ? $prefix . '/' : '') . $slug;
    $url = $base . '/index.php?m=' . rawurlencode(ZM_PB_NAME) . '&slug=' . rawurlencode($slug);
    if ($prefix !== '') $url .= '&lang=' . rawurlencode($prefix);
    return $url;
}

function zm_pb_menu_page_label($page, $settings = null)
{
    $meta = $settings && is_string($settings->settings ?? null) ? json_decode($settings->settings, true) : [];
    if (!is_array($meta)) $meta = [];
    return trim((string) ($meta['breadcrumb'] ?? '')) ?: (trim((string) ($meta['meta_title'] ?? '')) ?: $page->name);
}

/** Validate the complete tree before starting any database writes. */
function zm_pb_menu_validate_items(array $items)
{
    if (count($items) > 300) throw new InvalidArgumentException('too_many_items');
    if ($items && array_keys($items) !== range(0, count($items) - 1)) throw new InvalidArgumentException('invalid_items#1');
    $result = [];
    foreach ($items as $position => $item) {
        if (!is_array($item)) throw new InvalidArgumentException('invalid_items#2:item=' . ($position + 1));
        if (!is_scalar($item['key'] ?? null) || !is_scalar($item['parent'] ?? '')) throw new InvalidArgumentException('invalid_items#3:item=' . ($position + 1));
        $key = (string) ($item['key'] ?? '');
        $parent = (string) ($item['parent'] ?? '');
        if (!preg_match('/^[A-Za-z0-9_-]{1,50}$/D', $key)) throw new InvalidArgumentException('invalid_items#4:item=' . ($position + 1));
        if (isset($result[$key])) throw new InvalidArgumentException('invalid_items#5:item=' . ($position + 1));
        $type = $item['type'] ?? '';
        if (!in_array($type, ['page', 'custom'], true)) throw new InvalidArgumentException('invalid_items#6:item=' . ($position + 1));
        $fields = [];
        foreach (['label' => 255, 'url' => 2048, 'title' => 255, 'description' => 1024, 'classes' => 255, 'rel' => 255, 'icon' => 128] as $field => $limit) {
            if (!is_string($item[$field] ?? '')) throw new InvalidArgumentException('invalid_items#7:item=' . ($position + 1) . ':field=' . $field);
            $fields[$field] = trim($item[$field] ?? '');
            if (mb_strlen($fields[$field]) > $limit || strip_tags($fields[$field]) !== $fields[$field]) throw new InvalidArgumentException('invalid_items#8:item=' . ($position + 1) . ':field=' . $field);
        }
        $fields['url'] = html_entity_decode($fields['url'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        if (!zm_pb_menu_safe_url($fields['url'])) throw new InvalidArgumentException('invalid_url');
        foreach (['classes', 'rel', 'icon'] as $field) {
            if (!preg_match('/^[A-Za-z0-9_ -]*$/D', $fields[$field])) throw new InvalidArgumentException('invalid_items#9:item=' . ($position + 1) . ':field=' . $field);
        }
        if ($type === 'custom' && $fields['label'] === '') throw new InvalidArgumentException('missing_label');
        $pageId = $type === 'page' ? (int) ($item['page_id'] ?? 0) : null;
        if ($type === 'page' && $pageId < 1) throw new InvalidArgumentException('invalid_page');
        $target = $item['target'] ?? '_self';
        $visibility = $item['visibility'] ?? 'mixed';
        $localizeUrl = $item['localize_url'] ?? true;
        if (!in_array($localizeUrl, [true, false, 0, 1, '0', '1'], true)) throw new InvalidArgumentException('invalid_items#18:item=' . ($position + 1) . ':field=localize_url');
        if (!in_array($target, ['_self', '_blank'], true)) throw new InvalidArgumentException('invalid_items#10:item=' . ($position + 1) . ':field=target');
        if (!in_array($visibility, ['mixed', 'auth', 'noauth'], true)) throw new InvalidArgumentException('invalid_items#11:item=' . ($position + 1) . ':field=visibility');
        $labels = [];
        foreach (is_array($item['labels'] ?? null) ? $item['labels'] : [] as $lang => $label) {
            if (!isset(ZM_PB_LANGS[$lang])) throw new InvalidArgumentException('invalid_items#12:item=' . ($position + 1) . ':field=labels');
            if (!is_string($label) || mb_strlen($label) > 255 || strip_tags($label) !== $label) throw new InvalidArgumentException('invalid_items#13:item=' . ($position + 1) . ':field=labels');
            if (trim($label) !== '') $labels[$lang] = trim($label);
        }
        $result[$key] = $fields + ['key' => $key, 'parent' => $parent, 'position' => $position, 'type' => $type,
            'page_id' => $pageId, 'target' => $target, 'visibility' => $visibility, 'labels' => $labels,
            'localize_url' => $type === 'page' || (bool) $localizeUrl];
    }
    foreach ($result as $key => $item) {
        $seen = [$key => true]; $parent = $item['parent'];
        while ($parent !== '') {
            if (!isset($result[$parent]) || isset($seen[$parent]) || count($seen) > 10) throw new InvalidArgumentException('invalid_tree');
            $seen[$parent] = true; $parent = $result[$parent]['parent'];
        }
    }
    return $result;
}

function zm_pb_menu_save(array $input)
{
    $name = trim(is_string($input['name'] ?? null) ? $input['name'] : '');
    if ($name === '' || mb_strlen($name) > 128 || strip_tags($name) !== $name) throw new InvalidArgumentException('missing_name');
    $id = (int) ($input['menu_id'] ?? 0);
    $mode = $input['mode'] ?? 'append';
    $device = $input['device'] ?? 'mixed';
    if (!in_array($device, ['mixed', 'pc', 'mobile'], true)) throw new InvalidArgumentException('invalid_items#14:field=device');
    if (!in_array($mode, ['append', 'replace'], true)) throw new InvalidArgumentException('invalid_items#15:field=mode');
    $rawItems = $input['items'] ?? null;
    if (is_string($rawItems) && strncmp($rawItems, 'zm_pb_b64:', 10) === 0) {
        $rawItems = base64_decode(substr($rawItems, 10), true);
        if ($rawItems === false) throw new InvalidArgumentException('invalid_items#16:field=items');
    }
    $decoded = is_string($rawItems) ? json_decode($rawItems, true) : null;
    if (!is_array($decoded)) throw new InvalidArgumentException('invalid_items#17:field=items');
    $items = zm_pb_menu_validate_items($decoded);
    // Schema changes are only performed by activation/module_db, never here.
    if (!Capsule::schema()->hasColumn('zm_pb_menu_items', 'localize_url')) throw new InvalidArgumentException('outdated_schema');
    $locations = is_array($input['locations'] ?? null) ? $input['locations'] : [];
    foreach ($locations as $location) if (!is_string($location) || !isset(zm_pb_menu_locations()[$location])) throw new InvalidArgumentException('invalid_location');
    $locations = array_values(array_unique($locations));
    $pageIds = array_values(array_unique(array_filter(array_column($items, 'page_id'))));
    $pages = $pageIds ? Capsule::table('zm_pb_pages')->whereIn('id', $pageIds)->whereIn('type', ['page', 'post'])->get()->keyBy('id') : [];
    $overrideSources = zm_pb_menu_override_sources();
    foreach ($items as &$item) {
        if ($item['type'] !== 'page') {
            require_once ZM_PB_LIBDIR . 'menu.php';
            if ($item['localize_url']) $item['url'] = ZM_PB_Menu::localizeUrl($item['url'], ZM_PB_DEFLANG);
            continue;
        }
        if (!isset($pages[$item['page_id']])) throw new InvalidArgumentException('invalid_page');
        $item['url'] = zm_pb_menu_page_url($pages[$item['page_id']], null, $overrideSources);
    }
    unset($item);
    return Capsule::connection()->transaction(function () use ($id, $input, $name, $mode, $device, $items, $locations) {
        $now = date('Y-m-d H:i:s');
        $data = ['name' => $name, 'active' => !empty($input['active']), 'mode' => $mode, 'device' => $device, 'auto_add' => !empty($input['auto_add']), 'updated_at' => $now];
        if ($id) {
            if (!Capsule::table('zm_pb_menus')->where('id', $id)->lockForUpdate()->first()) throw new InvalidArgumentException('not_found');
            Capsule::table('zm_pb_menus')->where('id', $id)->update($data);
        } else {
            $data['created_at'] = $now;
            $id = Capsule::table('zm_pb_menus')->insertGetId($data);
        }
        Capsule::table('zm_pb_menu_items')->where('menu_id', $id)->delete();
        $ids = [];
        foreach ($items as $key => $item) {
            unset($item['key'], $item['parent']);
            $item['labels'] = json_encode($item['labels'], JSON_UNESCAPED_UNICODE);
            $item['menu_id'] = $id; $item['parent_id'] = 0;
            $ids[$key] = Capsule::table('zm_pb_menu_items')->insertGetId($item);
        }
        foreach ($items as $key => $item) {
            if ($item['parent'] !== '') Capsule::table('zm_pb_menu_items')->where('id', $ids[$key])->update(['parent_id' => $ids[$item['parent']]]);
        }
        Capsule::table('zm_pb_menu_locations')->where('menu_id', $id)->delete();
        foreach ($locations as $location) {
            Capsule::table('zm_pb_menu_locations')->updateOrInsert(['location' => $location], ['menu_id' => $id]);
        }
        return $id;
    });
}

function zm_pb_menu_admin_data($id)
{
    $menus = Capsule::table('zm_pb_menus')->orderBy('name')->get()->all();
    $selected = $id ? Capsule::table('zm_pb_menus')->where('id', $id)->first() : null;
    $items = [];
    if ($selected) {
        foreach (Capsule::table('zm_pb_menu_items')->where('menu_id', $id)->orderBy('position')->get() as $item) {
            $row = (array) $item; $row['key'] = (string) $item->id; $row['parent'] = $item->parent_id ? (string) $item->parent_id : '';
            $row['labels'] = json_decode($item->labels ?? '{}', true) ?: []; $items[] = $row;
        }
    }
    $overrideSources = zm_pb_menu_override_sources();
    //$settings = Capsule::table('zm_pb_pages_settings')->where('lang', ZM_PB_DEFLANG)->get(['page_id', 'settings'])->keyBy('page_id');
    $pages = ['page' => [], 'post' => []];
    foreach (Capsule::table('zm_pb_pages')->whereIn('type', ['page', 'post'])->orderBy('name')->get() as $page) {
        $pages[$page->type][] = [
            'id' => $page->id, 
            //'name' => zm_pb_menu_page_label($page, $settings[$page->id] ?? null),
            'name' => $page->name,
            'url' => zm_pb_menu_page_url($page, null, $overrideSources), 'status' => $page->status];
    }
    $bindings = Capsule::table('zm_pb_menu_locations')->pluck('menu_id', 'location')->all();
    $locations = [];
    foreach (zm_pb_menu_locations() as $key => $config) {
        $locations[$key] = $config + ['enabled' => defined($config['constant']) && constant($config['constant']), 'menu_id' => $bindings[$key] ?? 0];
    }
    return ['menus' => $menus, 'selected' => $selected, 'items' => $items, 'pages' => $pages, 'locations' => $locations];
}
