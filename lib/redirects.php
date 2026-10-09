<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
use Illuminate\Database\Capsule\Manager as Capsule;
require_once ZM_PB_INCDIR . 'redirects_manager.php';
require_once ZM_PB_INCDIR . 'sitemap_manager.php';
function zm_pb_redirect_overrides() {
    if (!ZM_PB_ENABLE_PAGE_OVERRIDES || !zm_pb_has_table('zm_pb_module_settings')) return [];
    return zm_pb_sitemap_overrides(json_decode(Capsule::table('zm_pb_module_settings')
        ->where('setting_name', 'page_overrides')->value('setting_value') ?? '[]', true));
}

function zm_pb_redirect_override_target($url, array $overrides) {
    $request = zm_pb_redirect_request($url);
    if (!$request || (!ZM_PB_ENABLE_LANG_ROUTE && $request['lang'] !== '')) return null;
    $sources = $overrides[$request['slug']] ?? [];
    if (!$sources) return null;
    // A matching native slug is already a public destination, not an alias.
    if (in_array($request['slug'], $sources, true)) return null;
    $language = ZM_PB_DEFLANG;
    foreach (ZM_PB_LANGS as $name => $info) if ($info['code_lower'] === $request['lang']) $language = $name;
    $target = zm_pb_sitemap_url($request['slug'], $language, $sources[0]);
    return zm_pb_redirect_url($target) === zm_pb_redirect_url($url) ? null : $target;
}

function zm_pb_redirect_rules() {
    if (!ZM_PB_ENABLE_REDIRECTS_MANAGER || !zm_pb_has_table('zm_pb_redirects')) return [];
    return Capsule::table('zm_pb_redirects')->where('active', true)->whereIn('method', ['GET', 'ALL'])
        ->orderBy('id')->get()->all();
}

/** Resolve one response, but walk the entire chain to reject cycles before sending headers. */
function zm_pb_redirect_resolve($uri, array $rules, array $overrides) {
    $current = zm_pb_redirect_url($uri, true); $seen = []; $first = null;
    for ($hop = 0; $hop < 50; $hop++) {
        if (isset($seen[$current])) throw new InvalidArgumentException('redirect_loop');
        $seen[$current] = true;
        $target = zm_pb_redirect_override_target($current, $overrides); $status = 301;
        if ($target === null) {
            $path = explode('?', $current, 2)[0];
            // Query-specific rules have priority over a rule for the entire path.
            foreach ([$current, $path] as $candidate) {
                foreach ($rules as $rule) {
                    if (zm_pb_redirect_url($rule->from, true) !== $candidate) continue;
                    if (!in_array((int) $rule->status_code, [301, 302, 303, 307, 308], true)) continue;
                    $target = $rule->to; $status = (int) $rule->status_code; break 2;
                }
            }
        }
        if ($target === null) return $first;
        $next = zm_pb_redirect_url($target);
        if ($first === null) $first = ['url' => zm_pb_redirect_absolute($target), 'status' => $status];
        if (preg_match('~^https?://~i', $next)) return $first;
        $current = $next;
    }
    throw new InvalidArgumentException('redirect_loop');
}

function zm_pb_redirect_save(array $input) {
    if (!zm_pb_has_table('zm_pb_redirects')) throw new RuntimeException('missing_table');
    $id = (int) ($input['id'] ?? 0);
    $from = zm_pb_redirect_url(html_entity_decode((string) ($input['from'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'), true);
    $rawTarget = trim(html_entity_decode((string) ($input['to'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $to = zm_pb_redirect_url($rawTarget);
    $status = (int) ($input['status_code'] ?? 301);
    if (strlen($from) > 128 || strlen($rawTarget) > 128) throw new InvalidArgumentException('url_too_long');
    if (!in_array($status, [301, 302, 303, 307, 308], true)) throw new InvalidArgumentException('invalid_status');
    if ($from === $to) throw new InvalidArgumentException('redirect_loop');
    // Keep the destination's trailing slash; normalization is only for lookup/comparison.
    $to = preg_match('~^https?://~i', $rawTarget) ? $rawTarget : trim($rawTarget);
    $existing = $id ? Capsule::table('zm_pb_redirects')->where('id', $id)->first() : null;
    if ($id && !$existing) throw new InvalidArgumentException('not_found');
    $rules = Capsule::table('zm_pb_redirects')->where('id', '!=', $id)->whereIn('method', ['GET', 'ALL'])->get()->all();
    foreach ($rules as $rule) if (zm_pb_redirect_url($rule->from, true) === $from) throw new InvalidArgumentException('duplicate');
    $active = !empty($input['active']);
    if ($active) {
        $rules = array_values(array_filter($rules, function ($rule) { return (bool) $rule->active; }));
        $rules[] = (object) ['from' => $from, 'to' => $to, 'status_code' => $status];
        zm_pb_redirect_resolve($from, $rules, zm_pb_redirect_overrides());
    }
    $values = ['from' => $from, 'to' => $to, 'status_code' => $status, 'active' => $active,
        'type' => 'simple', 'method' => 'GET', 'conditions' => null, 'updated_at' => date('Y-m-d H:i:s')];
    if ($id) Capsule::table('zm_pb_redirects')->where('id', $id)->update($values);
    else { $values['created_at'] = $values['updated_at']; $id = Capsule::table('zm_pb_redirects')->insertGetId($values); }
    return $id;
}

/** Called inside the page-save transaction, using dates from BEFORE the modification. */
function zm_pb_redirect_page_change($page, $newSlug, $newStatus) {
    if ($page->slug === $newSlug) return;
    $overrides = zm_pb_redirect_overrides();
    $sources = $overrides[$page->slug] ?? [];
    if (zm_pb_has_table('zm_pb_module_settings')) {
        $row = Capsule::table('zm_pb_module_settings')->where('setting_name', 'page_overrides')->first();
        $config = json_decode($row->setting_value ?? '[]', true);
        $changed = false;
        foreach ($config['to'] ?? [] as $key => $value) {
            if ($value === $page->slug) { $config['to'][$key] = $newSlug; $changed = true; }
        }
        if ($changed) Capsule::table('zm_pb_module_settings')->where('setting_name', 'page_overrides')
            ->update(['setting_value' => json_encode($config, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)]);
    }
    $languages = Capsule::table('zm_pb_pages_settings')->where('page_id', $page->id)->where('lang_active', true)->get();
    $last = max(zm_pb_sitemap_timestamp($page->created_at), zm_pb_sitemap_timestamp($page->updated_at));
    foreach ($languages as $version) $last = max($last, zm_pb_sitemap_timestamp($version->updated_at), zm_pb_sitemap_timestamp($version->created_at));
    $due = ZM_PB_ENABLE_REDIRECTS_MANAGER && ZM_PB_AUTO_REDIRECTS && $page->status === 'publish' && $newStatus === 'publish'
        && $last > 0 && time() - $last >= max(0, ZM_PB_AUTO_REDIRECT_DAYS) * 86400;
    if (!zm_pb_has_table('zm_pb_redirects')) {
        if ($due) throw new RuntimeException('missing_table');
        return;
    }
    $versions = [ZM_PB_DEFLANG];
    if (ZM_PB_ENABLE_LANG_ROUTE) foreach ($languages as $version) if (isset(ZM_PB_LANGS[$version->lang])) $versions[] = $version->lang;
    $targetFor = function ($language) use ($newSlug, $sources) { return zm_pb_sitemap_url($newSlug, $language, $sources[0] ?? null); };
    // Repoint older automatic rules even if the latest rename happens before the age threshold.
    foreach (Capsule::table('zm_pb_redirects')->where('type', 'system')->get() as $rule) {
        $meta = json_decode($rule->conditions ?? '[]', true);
        if (($meta['page_id'] ?? null) !== (int) $page->id) continue;
        $to = $targetFor($meta['language'] ?? ZM_PB_DEFLANG);
        if (strlen($to) > 128) throw new InvalidArgumentException('url_too_long');
        if (zm_pb_redirect_url($rule->from) === zm_pb_redirect_url($to)) Capsule::table('zm_pb_redirects')->where('id', $rule->id)->delete();
        else Capsule::table('zm_pb_redirects')->where('id', $rule->id)->update(['to' => $to, 'updated_at' => date('Y-m-d H:i:s')]);
    }
    $rules = zm_pb_redirect_rules();
    foreach ($rules as $rule) zm_pb_redirect_resolve($rule->from, $rules, zm_pb_redirect_overrides());
    if (!$due) return;
    foreach (array_unique($versions) as $language) {
        $from = zm_pb_redirect_url(zm_pb_sitemap_url($page->slug, $language), true);
        $to = $targetFor($language);
        if ($from === zm_pb_redirect_url($to)) continue;
        // Respect manually configured rules for this address.
        if (Capsule::table('zm_pb_redirects')->where('from', $from)->whereIn('method', ['GET', 'ALL'])->exists()) continue;
        if (strlen($from) > 128 || strlen($to) > 128) throw new InvalidArgumentException('url_too_long');
        $candidate = (object) ['from' => $from, 'to' => $to, 'status_code' => 301];
        zm_pb_redirect_resolve($from, array_merge(zm_pb_redirect_rules(), [$candidate]), zm_pb_redirect_overrides());
        Capsule::table('zm_pb_redirects')->insert(['from' => $from, 'to' => $to, 'status_code' => 301, 'active' => true,
            'type' => 'system', 'method' => 'GET', 'conditions' => json_encode(['page_id' => (int) $page->id, 'language' => $language]),
            'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
    }
}
