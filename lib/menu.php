<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
use Illuminate\Database\Capsule\Manager as Capsule;
require_once ZM_PB_INCDIR . 'menu_manager.php';

class ZM_PB_Menu
{
    private static $data;
    private static $rendered = [];
    private static $navigation = [];

    private static function load()
    {
        if (self::$data !== null) return self::$data;
        self::$data = ['locations' => [], 'items' => [], 'pages' => [], 'settings' => [], 'overrides' => []];
        if (!zm_pb_menu_tables_ready() || !zm_pb_has_table('zm_pb_pages') || !zm_pb_has_table('zm_pb_pages_settings')) return self::$data;
        self::$data['overrides'] = zm_pb_menu_override_sources();
        $locations = Capsule::table('zm_pb_menu_locations as l')->join('zm_pb_menus as m', 'm.id', '=', 'l.menu_id')
            ->where('m.active', true)->select('m.*', 'l.location')->get();
        foreach ($locations as $menu) self::$data['locations'][$menu->location] = $menu;
        $ids = array_unique(array_map(function ($m) { return $m->id; }, self::$data['locations']));
        if (!$ids) return self::$data;
        $pageIds = [];
        foreach (Capsule::table('zm_pb_menu_items')->whereIn('menu_id', $ids)->orderBy('position')->get() as $item) {
            self::$data['items'][$item->menu_id][] = (array) $item;
            if ($item->page_id) $pageIds[] = $item->page_id;
        }
        $autoMenus = array_filter(self::$data['locations'], function ($m) { return $m->auto_add; });
        $query = Capsule::table('zm_pb_pages')->whereIn('type', ['page', 'post']);
        if (!$autoMenus) $query->whereIn('id', array_unique($pageIds));
        foreach ($query->get() as $page) self::$data['pages'][$page->id] = $page;
        foreach (Capsule::table('zm_pb_pages_settings')->whereIn('page_id', array_keys(self::$data['pages']))
            ->where('lang_active', true)->get(['page_id', 'lang', 'settings']) as $settings) {
            self::$data['settings'][$settings->page_id][$settings->lang] = $settings;
        }
        return self::$data;
    }

    public static function language()
    {
        require_once __DIR__ . '/navigation_language.php';
        $responseLanguage = ZM_PB_NavigationLanguage::responseLanguage();
        if ($responseLanguage !== null) return $responseLanguage;
        if (defined('USER_LANG') && isset(ZM_PB_LANGS[strtolower(USER_LANG)])) return strtolower(USER_LANG);
        $request = zm_pb_parse_request();
        foreach (ZM_PB_LANGS as $name => $info) if ($info['code_lower'] === ($request['lang'] ?? '')) return $name;
        if (!ZM_PB_ENABLE_LANG_ROUTE) {
            $lang = strtolower((string) ($_SESSION['Language'] ?? ZM_PB_DEFLANG));
            if (isset(ZM_PB_LANGS[$lang])) return $lang;
        }
        return ZM_PB_DEFLANG;
    }

    public static function localizeUrl($url, $language)
    {
        if (!zm_pb_menu_safe_url($url) || !ZM_PB_ENABLE_LANG_ROUTE || !ZM_PB_PRETTY_URLS || $url === '' || $url[0] === '#') return $url;
        $parts = parse_url($url);
        $site = parse_url(ZM_PB_FULLHOST);
        if (isset($parts['scheme']) && !in_array(strtolower($parts['scheme']), ['http', 'https'], true)) return $url;
        if (isset($parts['host']) && (strcasecmp($parts['host'], $site['host'] ?? '') !== 0 || ($parts['port'] ?? null) !== ($site['port'] ?? null))) return $url;
        $base = rtrim($site['path'] ?? '', '/');
        $path = $parts['path'] ?? '';
        if (isset($parts['host']) || strpos($path, '/') === 0) {
            if ($base !== '' && $path !== $base && strpos($path, $base . '/') !== 0) return $url;
            $path = substr($path, strlen($base));
        }
        $path = ltrim($path, '/');
        foreach (ZM_PB_LANGS as $info) {
            $code = $info['code_lower'];
            if ($path === $code || strpos($path, $code . '/') === 0) { $path = ltrim(substr($path, strlen($code)), '/'); break; }
        }
        // Assets, callbacks and control endpoints are not language routes.
        if (preg_match('~^(?:modules|assets|includes|vendor|api|oauth|crons)(?:/|$)~i', $path)) return $url;
        $prefix = $language !== ZM_PB_DEFLANG ? (ZM_PB_LANGS[$language]['code_lower'] ?? '') : '';
        $result = rtrim(ZM_PB_FULLHOST, '/') . '/' . ($prefix !== '' ? $prefix . '/' : '') . $path;
        if (isset($parts['query'])) $result .= '?' . $parts['query'];
        if (isset($parts['fragment'])) $result .= '#' . $parts['fragment'];
        return $result;
    }

    /** Normalize local page paths without changing files, external URLs or query values. */
    private static function pageTrailingSlash($url)
    {
        if ($url === '' || $url[0] === '#' || $url[0] === '?') return $url;
        $parts = parse_url($url);
        if ($parts === false) return $url;
        if (isset($parts['scheme']) && !in_array(strtolower($parts['scheme']), ['http', 'https'], true)) return $url;
        $site = parse_url(ZM_PB_FULLHOST);
        if (isset($parts['host']) && (strcasecmp($parts['host'], $site['host'] ?? '') !== 0
            || ($parts['port'] ?? null) !== ($site['port'] ?? null))) return $url;
        $path = $parts['path'] ?? '';
        if (substr($path, -1) === '/' || preg_match('~\.[a-z0-9]+$~i', rawurldecode($path))) return $url;
        $end = strcspn($url, '?#');
        return substr($url, 0, $end) . '/' . substr($url, $end);
    }

    /** Pure preparation step: filters whole denied branches and returns a nested tree. */
    public static function tree(array $items, array $pages, array $settings, $language, $loggedIn, array $overrideSources = [])
    {
        $children = [];
        foreach ($items as $item) $children[(int) ($item['parent_id'] ?? 0)][] = $item;
        $walk = function ($parent, $depth, $ancestors) use (&$walk, $children, $pages, $settings, $language, $loggedIn, $overrideSources) {
            if ($depth > 10) return [];
            $result = [];
            foreach ($children[$parent] ?? [] as $item) {
                $id = (int) $item['id'];
                if (isset($ancestors[$id])) continue;
                $visibility = $item['visibility'] ?? 'mixed';
                if (($visibility === 'auth' && !$loggedIn) || ($visibility === 'noauth' && $loggedIn)) continue;
                $labels = is_string($item['labels'] ?? null) ? json_decode($item['labels'], true) : ($item['labels'] ?? []);
                $label = $labels[$language] ?? ($item['label'] ?? '');
                if (($item['type'] ?? '') === 'page') {
                    $page = $pages[$item['page_id']] ?? null;
                    if (!$page || $page->status !== 'publish' || ($page->auth_type === 'auth' && !$loggedIn) || ($page->auth_type === 'noauth' && $loggedIn)) continue;
                    $localized = $settings[$page->id][$language] ?? ($settings[$page->id][ZM_PB_DEFLANG] ?? null);
                    if (!$localized) continue;
                    $urlLanguage = isset($overrideSources[$page->slug]) ? $language : $localized->lang;
                    $url = zm_pb_menu_page_url($page, $urlLanguage, $overrideSources);
                    if ($label === '') $label = zm_pb_menu_page_label($page, $localized);
                } else {
                    $url = $item['url'] ?? '';
                    if ($item['localize_url'] ?? true) $url = self::localizeUrl($url, $language);
                }
                if (!zm_pb_menu_safe_url($url)) continue;
                $item['url'] = self::pageTrailingSlash($url); $item['label'] = $label;
                $next = $ancestors; $next[$id] = true;
                $item['children'] = $walk($id, $depth + 1, $next);
                $result[] = $item;
            }
            return $result;
        };
        return $walk(0, 0, []);
    }

    public static function apply($root, $location)
    {
        $config = zm_pb_menu_locations()[$location] ?? null;
        if (!$config || !defined($config['constant']) || !constant($config['constant'])) return;
        try {
            $data = self::load(); $menu = $data['locations'][$location] ?? null;
            if (!$menu) return;
            $items = self::itemsForMenu($data, $menu);
            $tree = self::tree($items, $data['pages'], $data['settings'], self::language(), !empty($_SESSION['uid']), $data['overrides']);
            $device = in_array($menu->device ?? '', ['pc', 'mobile'], true) ? $menu->device : 'mixed';
            if ($menu->mode === 'replace') {
                foreach ($root->getChildren() as $name => $native) {
                    if ($device === 'mixed') $root->removeChild($name);
                    else $native->setClass(trim($native->getClass() . ' zm-pb-menu-native-hide-' . $device));
                }
                self::$rendered['assets'] = true;
            }
            if (!$tree) return;
            $prefix = 'zmpb_menu_' . $menu->id . '_' . $location . '_';
            if (strpos($location, 'sidebar') !== false) {
                $panel = $root->addChild($prefix . 'panel', ['label' => self::escape($menu->name), 'order' => 90]);
                $panel->setClass('zm-pb-menu-device-' . $device);
                $panel->setBodyHtml(self::sidebarHtml($tree));
            } else {
                self::addItems($root, $tree, $prefix, 90);
                foreach ($tree as $item) {
                    $child = $root->getChild($prefix . $item['id']);
                    $child->setClass(trim($child->getClass() . ' no-collapse zm-pb-menu-device-' . $device));
                }
                self::$rendered[$location] = ['prefix' => $prefix, 'items' => $tree];
            }
            self::$navigation[$location] = ['name' => $menu->name, 'items' => $tree];
            self::$rendered['assets'] = true;
        } catch (Throwable $error) { error_log('zmchel WHMCS Multimodule menu: ' . $error->getMessage()); }
    }

    private static function itemsForMenu(array $data, $menu)
    {
        $items = $data['items'][$menu->id] ?? [];
        if ($menu->auto_add) {
            $existing = array_column($items, 'page_id');
            foreach ($data['pages'] as $page) {
                if ($page->type !== 'page' || in_array($page->id, $existing) || !$page->created_at || $page->created_at <= $menu->created_at) continue;
                $items[] = ['id' => 1000000000 + $page->id, 'type' => 'page', 'page_id' => $page->id, 'parent_id' => 0, 'label' => '', 'visibility' => 'mixed'];
            }
        }
        return $items;
    }

    public static function footerHtml()
    {
        if (!defined('ZM_PB_ENABLE_FOOTERMENU') || !ZM_PB_ENABLE_FOOTERMENU) return '';
        try {
            $data = self::load();
            $menu = $data['locations']['footer'] ?? null;
            if (!$menu) return '';
            $tree = self::tree(self::itemsForMenu($data, $menu), $data['pages'], $data['settings'],
                self::language(), !empty($_SESSION['uid']), $data['overrides']);
            if (!$tree) return '';
            $device = in_array($menu->device ?? '', ['pc', 'mobile'], true) ? $menu->device : 'mixed';
            $columns = min(count($tree), 4);
            $html = '<nav class="zm-pb-footer-menu zm-pb-menu-device-' . $device . '" aria-label="' . self::escape($menu->name) . '">'
                . '<div class="container"><div class="zm-pb-footer-grid" style="--zm-pb-footer-columns:' . $columns . '">';
            foreach ($tree as $item) {
                $html .= '<div class="zm-pb-footer-column ' . self::escape($item['classes'] ?? '') . '">'
                    . '<h2 class="zm-pb-footer-heading">' . self::footerLink($item) . '</h2>';
                if (!empty($item['description'])) $html .= '<p class="zm-pb-footer-description">' . self::escape($item['description']) . '</p>';
                if ($item['children']) $html .= self::footerList($item['children']);
                $html .= '</div>';
            }
            self::$rendered['assets'] = true;
            self::$navigation['footer'] = ['name' => $menu->name, 'items' => $tree];
            return $html . '</div></div></nav>';
        } catch (Throwable $error) {
            error_log('zmchel WHMCS Multimodule footer menu: ' . $error->getMessage());
            return '';
        }
    }

    private static function footerLink(array $item)
    {
        $label = (!empty($item['icon']) ? '<i class="' . self::escape($item['icon']) . '" aria-hidden="true"></i> ' : '')
            . self::escape($item['label'] ?? '');
        if (empty($item['url']) || $item['url'] === '#') return '<span>' . $label . '</span>';
        $target = $item['target'] ?? '_self';
        $rel = trim(($item['rel'] ?? '') . ($target === '_blank' ? ' noopener noreferrer' : ''));
        return '<a href="' . self::escape($item['url']) . '" target="' . self::escape($target)
            . '" rel="' . self::escape($rel) . '" title="' . self::escape($item['title'] ?? '') . '">' . $label . '</a>';
    }

    private static function footerList(array $items)
    {
        $html = '<ul class="zm-pb-footer-links">';
        foreach ($items as $item) {
            $html .= '<li class="' . self::escape($item['classes'] ?? '') . '">' . self::footerLink($item);
            if (!empty($item['description'])) $html .= '<small>' . self::escape($item['description']) . '</small>';
            if ($item['children']) $html .= self::footerList($item['children']);
            $html .= '</li>';
        }
        return $html . '</ul>';
    }

    private static function addItems($parent, array $items, $prefix, $offset)
    {
        foreach ($items as $index => $item) {
            $child = $parent->addChild($prefix . $item['id'], ['label' => self::escape($item['label']),
                'uri' => $item['url'] ?: '#', 'order' => $offset + $index, 'icon' => $item['icon'] ?? '']);
            $child->setClass(trim('zm-pb-menu-item ' . ($item['classes'] ?? '')));
            foreach (['target', 'title', 'rel'] as $attribute) $child->setAttribute($attribute, self::escape($item[$attribute] ?? ''));
            if ($item['children']) self::addItems($child, $item['children'], $prefix, 0);
        }
    }

    public static function escape($text) { return htmlspecialchars((string) $text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

    private static function sidebarHtml(array $items)
    {
        $html = '<ul class="zm-pb-sidebar-menu">';
        foreach ($items as $item) {
            $rel = trim(($item['rel'] ?? '') . (($item['target'] ?? '') === '_blank' ? ' noopener noreferrer' : ''));
            $link = '<a href="' . self::escape($item['url'] ?: '#') . '" target="' . self::escape($item['target'] ?? '_self')
                . '" rel="' . self::escape($rel) . '" title="' . self::escape($item['title'] ?? '') . '">';
            if (!empty($item['icon'])) $link .= '<i class="' . self::escape($item['icon']) . '" aria-hidden="true"></i> ';
            $link .= self::escape($item['label']) . '</a>';
            $html .= '<li class="' . self::escape($item['classes'] ?? '') . '">';
            if ($item['children']) $html .= '<details><summary>' . $link . '</summary>' . self::sidebarHtml($item['children']) . '</details>';
            else $html .= $link;
            if (!empty($item['description'])) $html .= '<small>' . self::escape($item['description']) . '</small>';
            $html .= '</li>';
        }
        return $html . '</ul>';
    }

    public static function assets()
    {
        if (empty(self::$rendered['assets'])) return '';
        $menus = self::$rendered; unset($menus['assets']);
        $flags = JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_INVALID_UTF8_SUBSTITUTE;
        $html = '<link rel="stylesheet" href="' . self::escape(ZM_PB_ASSETSURL . 'css/menu.css?v=' . filemtime(ZM_PB_ASSETSDIR . 'css/menu.css')) . '">';
        if ($menus) $html .= '<script type="application/json" id="zm-pb-menu-data">' . json_encode($menus, $flags) . '</script>'
            . '<script src="' . self::escape(ZM_PB_ASSETSURL . 'js/menu.js?v=' . filemtime(ZM_PB_ASSETSDIR . 'js/menu.js')) . '" defer></script>';
        // JSON-LD also covers WHMCS themes which do not render custom Item attributes.
        require_once __DIR__ . '/schema.php';
        $base = defined('ZM_PB_FULLHOST') ? ZM_PB_FULLHOST : ($GLOBALS['CONFIG']['SystemURL'] ?? '');
        $site = parse_url($base);
        $uri = $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] ?? ($_SERVER['REQUEST_URI'] ?? '');
        $pageUrl = $base;
        if (!empty($site['host']) && strpos($uri, '/') === 0 && strpos($uri, '//') !== 0) {
            $pageUrl = ($site['scheme'] ?? 'https') . '://' . $site['host'] . (isset($site['port']) ? ':' . $site['port'] : '') . $uri;
        }
        $language = ZM_PB_LANGS[self::language()]['locale_BCP47'] ?? '';
        foreach (self::$navigation as $menu) $html .= zm_pb_schema_jsonld(zm_pb_schema_navigation($menu['name'], $menu['items'], $language, $pageUrl));
        return $html;
    }
}
