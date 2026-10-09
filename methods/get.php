<?php 
if (!defined("ZM_PB_VER")) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
if( $subpage === 'pages_editor' || $subpage === 'media_manager' || $subpage === 'module_settings') require_once ZM_PB_MEDIA_MANAGER_FILE;

if ($subpage === 'readme.md') {
    $smarty->assign('readme_html', '');
    $doc = isset($_GET['doc']) && is_string($_GET['doc']) ? $_GET['doc'] : '';
    $isAdditionalDoc = preg_match('/^[a-z0-9-]+$/D', $doc) && is_file(ZM_PB_ROOTDIR . 'docs/' . $doc . '.md');
    $readmeLanguage = array_key_exists(ZM_PB_ADMINLANGNAME, ZM_PB_LANGS) ? ZM_PB_ADMINLANGNAME : 'english';
    $readmePath = $isAdditionalDoc ? ZM_PB_ROOTDIR . 'docs/' . $doc . '.md' : ZM_PB_ROOTDIR . 'rep_info/' . $readmeLanguage . '/instruction.md';
    if (!$isAdditionalDoc && !is_readable($readmePath)) {
        $readmePath = ZM_PB_ROOTDIR . 'rep_info/english/instruction.md';
    }
    $markdown = is_readable($readmePath) ? file_get_contents($readmePath) : false;
    if ($markdown === false) {
        $smarty->assign('alertType', 'danger');
        $smarty->assign('alertMessage', ZM_PB_ADMINLANG->module->instruction_error);
        $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
    } else {
        if (!class_exists(\Michelf\MarkdownExtra::class)) {
            require_once ROOTDIR . '/vendor/michelf/php-markdown/Michelf/MarkdownExtra.inc.php';
        }
        $parser = new \Michelf\MarkdownExtra();
        $parser->no_markup = true;
        $parser->no_entities = true;
        $parser->header_id_func = static function ($heading) {
            $slug = mb_strtolower(trim($heading), 'UTF-8');
            $slug = preg_replace('/[^\p{L}\p{N}\s-]/u', '', $slug);
            return trim(preg_replace('/[\s-]+/u', '-', $slug), '-');
        };
        $parser->url_filter_func = static function ($url) {
            if (preg_match('~^(?:\.\./\.\./)?docs/([a-z0-9-]+)\.md$~D', $url, $matches)) {
                return 'addonmodules.php?module=' . rawurlencode(ZM_PB_NAME) . '&subpage=README.md&doc=' . rawurlencode($matches[1]);
            }
            return preg_match('~^(?:#[^\s]*|https?://[^\s]+)$~iD', $url) ? $url : '#';
        };
        $smarty->assign('readme_html', $parser->transform($markdown));
    }
    $smarty->assign('readme_additional_doc', (bool) $isAdditionalDoc);
} elseif ($subpage === 'menu_manager') {
    require_once ZM_PB_INCDIR . 'menu_manager.php';
    $menuText = zm_pb_menu_text();
    $smarty->assign('menu_manager_translates', $menuText);
    $ready = zm_pb_menu_tables_ready();
    $smarty->assign('menu_ready', $ready);
    if ($ready) {
        try {
            $menuData = zm_pb_menu_admin_data((int) ($_GET['menu_id'] ?? 0));
            $smarty->assign('menu_data', $menuData);
            $smarty->assign('menu_editor_json', json_encode(['items' => $menuData['items'], 'pages' => $menuData['pages'],
                'languages' => array_keys(ZM_PB_LANGS),
                'languageLabels' => (array) (ZM_PB_ADMINLANG->module->supported_langs->translate ?? []),
                'text' => $menuText], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT));
        } catch (Throwable $error) {
            $smarty->assign('menu_ready', false);
            $smarty->assign('alertType', 'danger');
            $smarty->assign('alertMessage', htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8'));
            $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
        }
    } else {
        $smarty->assign('alertType', 'warning');
        $smarty->assign('alertMessage', $menuText->missing_tables);
        $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
    }
    $smarty->assign('page_assets', '<link rel="stylesheet" href="' . ZM_PB_ASSETSURL . 'css/menu-manager.css?v=' . filemtime(ZM_PB_ASSETSDIR . 'css/menu-manager.css') . '">'
        . '<script src="' . ZM_PB_ASSETSURL . 'js/sortablejs.js"></script>'
        . '<script src="' . ZM_PB_ASSETSURL . 'js/menu-manager.js?v=' . filemtime(ZM_PB_ASSETSDIR . 'js/menu-manager.js') . '"></script>');
} elseif( $subpage === 'pages_manager'){
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
            $authOptions = (array) ZM_PB_ADMINLANG->pages_manager->page_auth_type->translate;
            $typeOptions = (array) ZM_PB_ADMINLANG->pages_manager->page_type->translate;
            $statusOptions = (array) ZM_PB_ADMINLANG->pages_manager->page_status->translate;
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
            $pages = $query->orderByDesc('id')->offset(($pageNumber - 1) * $perPage)->limit($perPage)->get()
                ->map(function ($page) {
                    $page->langs = $page->langs ? (json_decode($page->langs, true) ?: []) : [];
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
            $smarty->assign('alertMessage', ZM_PB_ADMINLANG->other->db_operation_error .': ' . $e->getMessage() );
            $smarty->assign('alertHtml', $smarty->fetch( ZM_PB_TEMPLATESPARTSDIR .'alert.tpl' ) );
        }
        if ($viewTrash && !$pageLoadFailed) {
            $smarty->assign('alertType', 'danger');
            $smarty->assign('alertMessage', ZM_PB_ADMINLANG->module->trash->description);
            $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
        }
    }
} elseif( $subpage === 'pages_editor'){
    if( empty($method_action) ){

        $page_id = (int) $_GET['page_id'];

        if( empty($page_id) ) {redir('module='.ZM_PB_NAME.'&subpage='.ZM_PB_SUBPAGES[0]);exit;}
        

        $main = Capsule::table('zm_pb_pages')
            ->where('id', $page_id)
            ->first();

        if ($main && $main->langs) $main->langs = json_decode($main->langs, true);


        $pre_settings = Capsule::table('zm_pb_pages_settings')
            ->where('page_id', $page_id)
            ->get();

        $settings = [];
        foreach ($pre_settings as $pre_setting) {
            $settings[$pre_setting->lang] = $pre_setting;
            $settings[$pre_setting->lang]->settings = json_decode($settings[$pre_setting->lang]->settings,true);
        }

        $sitemap = Capsule::table('zm_pb_sitemap')
            ->where('page_id', $page_id)
            ->first();

        $page_data = (object) [
            'main'=>$main,
            'settings'=>$settings,
            'sitemap'=>$sitemap
        ];

        if( ZM_PB_ENABLE_PAGE_OVERRIDES ){
            $settings = Capsule::table('zm_pb_module_settings')
                ->where('setting_name', 'page_overrides')
                ->first();

            $page_overrides = json_decode($settings->setting_value ?? '[]', true);
            if ( is_array($page_overrides) 
                && isset($page_overrides['from']) 
                && is_array($page_overrides['from'])
                && isset($page_overrides['to']) 
                && is_array($page_overrides['to'])
            ) {
                $message = '';
                if( in_array($main->slug,$page_overrides['to']) ) {
                    $index = array_search($main->slug, $page_overrides['to'], true);
                    $override_from = $page_overrides['from'][$index];
                    $message = ZM_PB_ADMINLANG->module->alerts->it_is_override_page . ZM_PB_ADMINLANG->pages_manager->page_overrides->translate->$override_from;

                    if($override_from === 'index') $smarty->assign('override_main_page', true);

                    $smarty->assign('alertType', 'info' );
                    $smarty->assign('alertMessage', $message );
                    $smarty->assign('alertHtml', $smarty->fetch( ZM_PB_TEMPLATESPARTSDIR .'alert.tpl' ) );
                }
            }
        }
            
        $smarty->assign('page_data', $page_data);
        $smarty->assign('mediamanager_modal', $smarty->fetch( ZM_PB_TEMPLATESPARTSDIR .'modal_mediamanager.tpl' ) );

        $grapesLang = in_array(ZM_PB_ADMINLANGNAME, array_keys(ZM_PB_LANGS), true) ? ZM_PB_ADMINLANGNAME : 'english';
        $grapesLocale = ZM_PB_LANGS[$grapesLang]['code_lower'];
        $grapesText = json_decode(file_get_contents(ZM_PB_ASSETSDIR.'grapesjs/langs/'.$grapesLang.'.json'), true);
        $smarty->assign('grapes_translates', $grapesText);
        $grapesCore = file_get_contents(ZM_PB_ASSETSDIR.'grapesjs/langs/core/'.$grapesLocale.'.js');
        $editorAssetUrl = function ($path) {
            return ZM_PB_ASSETSURL.$path.'?v='.filemtime(ZM_PB_ASSETSDIR.$path);
        };
        $tinyMcePacks = ['ru' => 'russian.js', 'de' => 'de.js', 'es' => 'es.js', 'uk' => 'uk.js'];
        $tinyMceLanguage = isset($tinyMcePacks[$grapesLocale]) ? $grapesLocale : 'en';
        $tinyMcePack = $tinyMceLanguage !== 'en'
            ? '<script src="'.htmlspecialchars($editorAssetUrl('tinymce/langs/'.$tinyMcePacks[$tinyMceLanguage]), ENT_QUOTES, 'UTF-8').'"></script>'
            : '';
        $grapesConfig = [
            'locale' => $grapesLocale,
            'useSmarty' => defined('ZM_PB_USE_COLLECT_VARS') && ZM_PB_USE_COLLECT_VARS === true,
            'contentCssUrl' => $editorAssetUrl('css/content.css'),
            'grapesEditorCssUrl' => $editorAssetUrl('css/grapes-editor.css'),
            'codeMirrorCssUrl' => ZM_PB_ASSETSURL.'codemirror/codemirror.css',
            'codeMirrorThemeUrl' => ZM_PB_ASSETSURL.'codemirror/monokai.css',
            'tinyMceBaseUrl' => ZM_PB_ASSETSURL.'tinymce',
            'tinyMceLanguage' => $tinyMceLanguage,
            'departments' => Capsule::table('tblticketdepartments')->orderBy('order')->get(['id', 'name'])->map(function($department) {
                return ['id' => (int) $department->id, 'name' => $department->name];
            })->all(),
        ];
        $jsFlags = JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT;
        if ($grapesConfig['useSmarty']) {
            require_once ZM_PB_LIBDIR . 'smarty_variables.php';
            $grapesConfig['smartyCatalogs'] = ZM_PB_SmartyVariables::catalogs();
        }
        $page_assets = '<link rel="stylesheet" href="'.ZM_PB_ASSETSURL.'grapesjs/grapes.min.css">
            <link rel="stylesheet" href="'.$editorAssetUrl('css/grapes-editor.css').'">
            <link rel="stylesheet" href="'.ZM_PB_ASSETSURL.'codemirror/codemirror.css">
            <link rel="stylesheet" href="'.ZM_PB_ASSETSURL.'codemirror/monokai.css">
            <script src="'.ZM_PB_ASSETSURL.'grapesjs/grapes.min.js"></script>
            <script src="'.ZM_PB_ASSETSURL.'codemirror/codemirror.js"></script>
            <script src="'.ZM_PB_ASSETSURL.'codemirror/xml.js"></script>
            <script src="'.ZM_PB_ASSETSURL.'codemirror/css.js"></script>
            <script src="'.ZM_PB_ASSETSURL.'codemirror/javascript.js"></script>
            <script src="'.ZM_PB_ASSETSURL.'codemirror/htmlmixed.js"></script>
            <script src="'.ZM_PB_ASSETSURL.'tinymce/tinymce.min.js"></script>
            '.$tinyMcePack.'
            <script>(function(){var exports={};'.$grapesCore.'window.zmPbGrapesLocale=exports.default;})();
            window.zmPbGrapesText='.json_encode($grapesText, $jsFlags).';
            window.zmPbGrapesConfig='.json_encode($grapesConfig, $jsFlags).';</script>
            <script src="'.$editorAssetUrl('grapesjs/components/layout.js').'"></script>
            <script src="'.$editorAssetUrl('grapesjs/components/structure.js').'"></script>
            <script src="'.$editorAssetUrl('grapesjs/components/basic.js').'"></script>
            <script src="'.$editorAssetUrl('grapesjs/components/richtext.js').'"></script>
            <script src="'.$editorAssetUrl('grapesjs/components/dynamic.js').'"></script>
            <script src="'.$editorAssetUrl('grapesjs/components/smarty-editor.js').'"></script>
            <script src="'.$editorAssetUrl('grapesjs/components/widgets.js').'"></script>
            <script src="'.$editorAssetUrl('grapesjs/components/table-of-contents.js').'"></script>
            <script src="'.$editorAssetUrl('grapesjs/components/pagination.js').'"></script>
            <script src="'.$editorAssetUrl('grapesjs/components/list-controls.js').'"></script>
            <script src="'.$editorAssetUrl('grapesjs/components/contact-form.js').'"></script>
            <script src="'.$editorAssetUrl('grapesjs/components/controls.js').'"></script>
            <script src="'.$editorAssetUrl('js/blocks-editor.js').'"></script>
            <script src="'.$editorAssetUrl('js/page-editor-dirty.js').'"></script>
            <script src="'.ZM_PB_ASSETSURL.'js/mediamanager.js?v='.filemtime(ZM_PB_ASSETSDIR.'js/mediamanager.js').'"></script>';
        
        $smarty->assign('page_assets', $page_assets);
    } elseif ($method_action === 'media_manager_list') {
        header('Content-Type: application/json; charset=utf-8');
        exit(json_encode(array_merge(['status' => 'success'], zm_pb_media_manager_page($_GET))));
    } 
} elseif( $subpage === 'media_manager'){
    if( empty($method_action) ){
        $page_assets = '<script src="'.ZM_PB_ASSETSURL.'js/mediamanager.js?v='.filemtime(ZM_PB_ASSETSDIR.'js/mediamanager.js').'"></script>';
        
        $smarty->assign('page_assets', $page_assets);
        $smarty->assign('modal_mediamanager_image', $smarty->fetch( ZM_PB_TEMPLATESPARTSDIR .'modal_mediamanager_image.tpl' ) );
    } elseif ($method_action === 'media_manager_list') {
        header('Content-Type: application/json; charset=utf-8');
        exit(json_encode(array_merge(['status' => 'success'], zm_pb_media_manager_page($_GET))));
    }
} elseif( $subpage === 'sitemap_manager'){
    require_once ZM_PB_INCDIR . 'sitemap_manager.php';
    $text = zm_pb_sitemap_text();
    $smarty->assign('sitemap_manager_translates', $text);
    $smarty->assign('sitemap_status', zm_pb_sitemap_status());
    $smarty->assign('sitemap_ready', false);
    $smarty->assign('elements_list', []);
    try {
        require_once ZM_PB_LIBDIR . 'sitemap.php';
        $groups = ZM_PB_Sitemap::entries();
        $smarty->assign('elements_list', array_merge($groups['pages'], $groups['posts']));
        $smarty->assign('sitemap_ready', true);
        if (!ZM_PB_ENABLE_SITEMAP) {
            $smarty->assign('alertType', 'warning');
            $smarty->assign('alertMessage', $text->errors->disabled);
            $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
        }
    } catch (Throwable $error) {
        $key = $error->getMessage();
        $smarty->assign('alertType', 'danger');
        $smarty->assign('alertMessage', htmlspecialchars($text->errors->$key ?? $key, ENT_QUOTES, 'UTF-8'));
        $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
    }
} elseif ($subpage === 'redirects_manager') {
    require_once ZM_PB_LIBDIR . 'redirects.php';
    $text = zm_pb_redirects_text();
    $smarty->assign('redirects_text', $text);
    $smarty->assign('redirects_ready', false);
    try {
        if (ZM_PB_CHECK_SUPERADM && !zm_pb_check_super_admin()) throw new RuntimeException(ZM_PB_ADMINLANG->module->alerts->access_denied);
        if (!zm_pb_has_table('zm_pb_redirects')) throw new RuntimeException('missing_table');
        $count = Capsule::table('zm_pb_redirects')->count();
        $lastPage = max(1, (int) ceil($count / 50));
        $page = min($lastPage, max(1, (int) ($_GET['page'] ?? 1)));
        $smarty->assign('redirect_rules', Capsule::table('zm_pb_redirects')->orderBy('id', 'desc')->skip(($page - 1) * 50)->take(50)->get()->all());
        $smarty->assign('redirect_edit', Capsule::table('zm_pb_redirects')->where('id', (int) ($_GET['id'] ?? 0))->first());
        $smarty->assign('redirect_page', $page);
        $smarty->assign('redirect_last_page', $lastPage);
        $smarty->assign('redirects_enabled', ZM_PB_ENABLE_REDIRECTS_MANAGER);
        $smarty->assign('redirects_ready', true);
    } catch (Throwable $error) {
        $key = $error->getMessage();
        $smarty->assign('alertType', 'danger');
        $smarty->assign('alertMessage', $text->errors->$key ?? $key);
        $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
    }
} elseif ($subpage === 'rewrite_manager') {
    $isSuperAdmin = zm_pb_check_super_admin();
    if (!$isSuperAdmin && ZM_PB_CHECK_SUPERADM) {
        $alertType = 'danger';
        $alertMessage = ZM_PB_ADMINLANG->module->alerts->access_denied;
    } else {
        require_once ZM_PB_LIBDIR . 'rewrite_manager.php';
        $webServer = zm_pb_rewrite_webserver();
        $serverMessages = [
            'nginx' => ZM_PB_ADMINLANG->rewrite_manager->server_nginx,
            'proxy' => ZM_PB_ADMINLANG->rewrite_manager->server_proxy,
            'unknown' => ZM_PB_ADMINLANG->rewrite_manager->server_unknown,
        ];
        $smarty->assign('rewrite_webserver', $webServer);
        $smarty->assign('rewrite_server_messages', $serverMessages);
        $smarty->assign('alertType', 'warning');
        $smarty->assign('alertMessage', htmlspecialchars($serverMessages[$webServer === 'nginx' ? 'nginx' : 'unknown'], ENT_QUOTES, 'UTF-8'));
        $smarty->assign('rewrite_server_alert', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
        try {
            $rewriteStatus = zm_pb_rewrite_status(zm_pb_rewrite_rules());
            $smarty->assign('rewrite_status', $rewriteStatus);
            $alertType = $rewriteStatus['installed'] ? 'success' : ($rewriteStatus['has_markers'] ? 'warning' : 'info');
            $alertMessage = $rewriteStatus['installed']
                ? ZM_PB_ADMINLANG->rewrite_manager->all_installed
                : ($rewriteStatus['has_markers']
                    ? ZM_PB_ADMINLANG->rewrite_manager->needs_update
                    : ZM_PB_ADMINLANG->rewrite_manager->not_installed);
        } catch (Exception $e) {
            $alertType = 'danger';
            $key = $e->getMessage();
            $alertMessage = htmlspecialchars(ZM_PB_ADMINLANG->rewrite_manager->$key ?? $key, ENT_QUOTES, 'UTF-8');
        }
    }
    $smarty->assign('alertType', $alertType);
    $smarty->assign('alertMessage', $alertMessage);
    $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
} elseif( $subpage === 'module_settings'){
    require_once ZM_PB_INCDIR . 'transfer.php';
    $smarty->assign('transfer_text', zm_pb_transfer_text());
    require_once ZM_PB_INCDIR . 'redirects_manager.php';
    $smarty->assign('redirects_text', zm_pb_redirects_text());
    $isSuperAdmin = zm_pb_check_super_admin();

    if (!$isSuperAdmin && ZM_PB_CHECK_SUPERADM) {
		
        $alertMessage = ZM_PB_ADMINLANG->module->alerts->access_denied;
        $alertType = 'danger';
        $smarty->assign('alertType', $alertType );
        $smarty->assign('alertMessage', $alertMessage);
		$smarty->assign('alertHtml', $smarty->fetch( ZM_PB_TEMPLATESPARTSDIR .'alert.tpl' ) );

    } else {
        if( empty($method_action) ){
            $settings = Capsule::table('zm_pb_module_settings')
                ->whereIn('setting_name', ['custom_footer', 'custom_header'])
                ->pluck('setting_value', 'setting_name');

            $editable_vars = [];

            foreach(ZM_PB_ALLOWED_CONSTS_CHANGE as $const_name){
                if ( defined($const_name) ) {
                    $short_lower_const_name = zm_pb_stlc( str_replace(ZM_PB_FREFIX,'',$const_name) );
                    $value = constant($const_name);
                    $editable_vars[$short_lower_const_name] = ['type'=>zm_pb_value_type($value),'value'=>$value];
                }
            }

            $custom_header = json_decode($settings['custom_header'] ?? '[]', true);
            $custom_footer = json_decode($settings['custom_footer'] ?? '[]', true);

            $smarty->assign('custom_header', $custom_header);
            $smarty->assign('custom_footer', $custom_footer);
            $smarty->assign('editable_vars', $editable_vars);

            $page_assets = '<script src="'.ZM_PB_ASSETSURL.'js/sortablejs.js"></script>
                <link rel="stylesheet" href="'.ZM_PB_ASSETSURL.'codemirror/codemirror.css">
                <link rel="stylesheet" href="'.ZM_PB_ASSETSURL.'codemirror/monokai.css">
                <script src="'.ZM_PB_ASSETSURL.'codemirror/codemirror.js"></script>
                <script src="'.ZM_PB_ASSETSURL.'codemirror/xml.js"></script>
                <script src="'.ZM_PB_ASSETSURL.'codemirror/javascript.js"></script>
                <script src="'.ZM_PB_ASSETSURL.'codemirror/css.js"></script>
                <script src="'.ZM_PB_ASSETSURL.'codemirror/htmlmixed.js"></script>
                <script src="'.ZM_PB_ASSETSURL.'js/mediamanager.js?v='.filemtime(ZM_PB_ASSETSDIR.'js/mediamanager.js').'"></script>';

            $robots_file = ROOTDIR .'/robots.txt';
            $robots = file_exists($robots_file) ? file_get_contents($robots_file) : '';

            $smarty->assign('fullhost', ZM_PB_FULLHOST);
            $smarty->assign('companyName', ($GLOBALS['CONFIG']['CompanyName'] ?? ''));
            $smarty->assign('robots', $robots);
            $smarty->assign('page_assets', $page_assets);
            $smarty->assign('mediamanager_modal', $smarty->fetch( ZM_PB_TEMPLATESPARTSDIR .'modal_mediamanager.tpl' ) );
        } elseif ($method_action === 'media_manager_list') {
            header('Content-Type: application/json; charset=utf-8');
            exit(json_encode(array_merge(['status' => 'success'], zm_pb_media_manager_page($_GET))));
        } 
    }
}
