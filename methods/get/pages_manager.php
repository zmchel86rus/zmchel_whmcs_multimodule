<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
require_once ZM_PB_INCDIR . 'menu_manager.php';

    if (empty($method_action) || $method_action === 'view_trash') {
        $viewTrash = $method_action === 'view_trash';
        $pageLoadFailed = false;
        if ($viewTrash) $smarty->assign('view_trash', true);
        try {
            $getFilter = function ($key) {
                return isset($_GET[$key]) && is_string($_GET[$key]) ? trim($_GET[$key]) : '';
            };
            $filters = [
                'auth' => $getFilter('filter_auth'),
                'type' => $getFilter('filter_type'),
                'status' => $getFilter('filter_status'),
                'lang' => $getFilter('filter_lang'),
                'name' => $getFilter('filter_name'),
            ];
            $filters['name'] = function_exists('mb_substr')
                ? mb_substr($filters['name'], 0, 128, 'UTF-8') : substr($filters['name'], 0, 128);
            $authOptions = (array) $GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_auth_type->translate;
            $typeOptions = (array) $GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_type->translate;
            $statusOptions = (array) $GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_status->translate;
            foreach (['auth' => $authOptions, 'type' => $typeOptions, 'status' => $statusOptions, 'lang' => ZM_PB_LANGS] as $key => $options) {
                if ($filters[$key] !== '' && !array_key_exists($filters[$key], $options)) $filters[$key] = '';
            }
            if ($viewTrash || $filters['status'] === 'canceled') $filters['status'] = '';

            $query = Capsule::table('zm_pb_pages')->where('status', $viewTrash ? '=' : '!=', 'canceled');
            if ($filters['auth'] !== '') $query->where('auth_type', $filters['auth']);
            if ($filters['type'] !== '') $query->where('type', $filters['type']);
            if (!$viewTrash && $filters['status'] !== '') $query->where('status', $filters['status']);
            if ($filters['lang'] !== '') $query->where('langs', 'like', '%"' . $filters['lang'] . '"%');
            if ($filters['name'] !== '') $query->where('name', 'like', '%' . $filters['name'] . '%');

            $perPage = 25;
            $total = (int) $query->count();
            $lastPage = max(1, (int) ceil($total / $perPage));
            $pageNumber = min(max(1, (int) $getFilter('page')), $lastPage);
            $overrideSources = ZM_PB_ENABLE_PAGE_OVERRIDES ? zm_pb_menu_override_sources() : [];
            $pages = $query->orderByDesc('id')->offset(($pageNumber - 1) * $perPage)->limit($perPage)->get()
                ->map(function ($page) use ($overrideSources) {
                    $page->langs = $page->langs ? (json_decode($page->langs, true) ?: []) : [];
                    $page->visit_url = zm_pb_menu_page_url($page, ZM_PB_DEFLANG, $overrideSources);
                    return $page;
                });
            $pages_trashed = Capsule::table('zm_pb_pages')
                ->where('status', '=', 'canceled')
                ->count();

            $smarty->assign('pages_list', $pages);
            $smarty->assign('pages_trashed', $pages_trashed);
            $smarty->assign('pages_filters', $filters);
            $smarty->assign('pages_pagination', [
                'page' => $pageNumber,
                'last_page' => $lastPage,
                'total' => $total,
                'from' => $total ? (($pageNumber - 1) * $perPage + 1) : 0,
                'to' => min($total, $pageNumber * $perPage),
                'pages' => range(max(1, $pageNumber - 2), min($lastPage, $pageNumber + 2)),
            ]);
            $urlFilters = [];
            foreach ($filters as $key => $value) {
                if ($value !== '') $urlFilters['filter_' . $key] = $value;
            }
            $baseUrl = 'addonmodules.php?module=' . rawurlencode(ZM_PB_NAME) . '&subpage=pages_manager';
            if ($viewTrash) $baseUrl .= '&action=view_trash';
            if ($urlFilters) $baseUrl .= '&' . http_build_query($urlFilters, '', '&', PHP_QUERY_RFC3986);
            $smarty->assign('pages_filter_url', $baseUrl);

            if (!$viewTrash && ZM_PB_ENABLE_PAGE_OVERRIDES) {
                $smarty->assign('pages_name_slug_array', Capsule::table('zm_pb_pages')
                    ->where('status', '!=', 'canceled')->orderBy('name')->pluck('name', 'slug')->all());
                $settings = Capsule::table('zm_pb_module_settings')
                    ->where('setting_name', 'page_overrides')
                    ->first();

                $page_overrides = json_decode($settings->setting_value ?? '[]', true);
                $page_override_rows = [];
                $used_override_sources = [];
                if (is_array($page_overrides) && isset($page_overrides['from']) && is_array($page_overrides['from'])) {
                    foreach ($page_overrides['from'] as $index => $source) {
                        if (!in_array($source, ZM_PB_MAINSYSTEM_DEFAULT_PAGES, true) || isset($used_override_sources[$source])) continue;
                        $used_override_sources[$source] = true;
                        $page_override_rows[] = [
                            'from' => $source,
                            'to' => $page_overrides['to'][$index] ?? '',
                            'type' => $page_overrides['type'][$index] ?? '',
                        ];
                    }
                }
                if (!$page_override_rows) $page_override_rows[] = ['from' => '', 'to' => '', 'type' => ''];

                $smarty->assign('enable_page_overrides', ZM_PB_ENABLE_PAGE_OVERRIDES);
                $smarty->assign('page_overrides', $page_overrides);
                $smarty->assign('page_override_rows', $page_override_rows);
            }
            
            $smarty->assign('whmcs_pages_list', ZM_PB_MAINSYSTEM_DEFAULT_PAGES);

        } catch (Exception $e) {
            $pageLoadFailed = true;
            $smarty->assign('alertType', 'danger' );
            $smarty->assign('alertMessage', $GLOBALS['ZM_PB_ADMINLANG']->other->db_operation_error .': ' . $e->getMessage() );
            $smarty->assign('alertHtml', $smarty->fetch( ZM_PB_TEMPLATESPARTSDIR .'alert.tpl' ) );
        }
        if ($viewTrash && !$pageLoadFailed) {
            $smarty->assign('alertType', 'danger');
            $smarty->assign('alertMessage', $GLOBALS['ZM_PB_ADMINLANG']->module->trash->description);
            $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
        }
    }
