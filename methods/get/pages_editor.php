<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
require_once ZM_PB_INCDIR . 'menu_manager.php';

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
        $overrideSources = ZM_PB_ENABLE_PAGE_OVERRIDES ? zm_pb_menu_override_sources() : [];
        $pageVisitUrls = [];
        if ($main) {
            foreach ((array) $main->langs as $language) {
                if (isset(ZM_PB_LANGS[$language])) {
                    $pageVisitUrls[$language] = zm_pb_menu_page_url($main, $language, $overrideSources);
                }
            }
            $pageVisitUrls[ZM_PB_DEFLANG] = zm_pb_menu_page_url($main, ZM_PB_DEFLANG, $overrideSources);
        }
        $smarty->assign('page_visit_urls', $pageVisitUrls);

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
                    $message = $GLOBALS['ZM_PB_ADMINLANG']->module->alerts->it_is_override_page . $GLOBALS['ZM_PB_ADMINLANG']->pages_manager->page_overrides->translate->$override_from;

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
        $grapesLocale = ZM_PB_LANGS[$grapesLang]['code_ISO639_1'];
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
