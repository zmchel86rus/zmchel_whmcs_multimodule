<?php
if (!defined("ZM_PB_VER")) die('Direct access not allowed');
/* * ********************************************************************
 * Page Builder Main file
 * ******************************************************************** */
if (!defined("ZMPB_BUILD_PAGE")) die("#ERROR-BUILD-PAGE #1");

use WHMCS\ClientArea;

$slug = $request['slug'] ?? '';
$lang = $request['lang'] ?? '';
$public_slug = $request['override_from'] ?? $slug;
$public_path = $request['override_path'] ?? ($public_slug === 'index' ? '' : $public_slug . '/');
$full_slug = ( !empty($lang) && ZM_PB_ENABLE_LANG_ROUTE ? "$lang/" : "") . $public_path;
$override_type = defined('ZMPB_PAGE_OVERRIDE_TYPE') ? ZMPB_PAGE_OVERRIDE_TYPE : 'full';
$meta_only = $override_type === 'meta_only';
$enable_partial_with_meta = in_array($override_type,['partial_before_meta','partial_after_meta']);

if( !ZM_PB_ENABLE_LANG_ROUTE && !empty($lang) ){
    $targetUrl = ZM_PB_FULLHOST . $public_path;
    header('Location: ' . $targetUrl, true, 302);
    exit;
}

$pageData = zm_pb_load_page_by_slug($slug);

$is_admin = !empty($_SESSION['adminid']);

global $_LANG;
 
if ( !$pageData || ($pageData['page']->status !== 'publish' || $pageData['page']->type === 'system' ) && !$is_admin ) {
    if ($override_type !== 'full') return;
    $ca = new ClientArea();
    http_response_code(404);
    $ca->setPageTitle('404 ' . (!empty($_LANG['errorPage']['404']['title']) ? ' - ' . $_LANG['errorPage']['404']['title'] : ''));
    $ca->setTemplate('error/page-not-found');
    $ca->addToBreadCrumb( (ZM_PB_MAINSYSTEM_PRETTY_URLS ? '/' : 'index.php'), $_LANG['hometitle'] ?? 'Home');
    $ca->addToBreadCrumb('', '404');
    $ca->initPage();
    $ca->output();

    //perf301Mark('PB_route_E');
    //perf301Flush();

    exit;
}


$page = $pageData['page'];
$authType = $page->auth_type;
$clientLoggedIn = !empty($_SESSION['uid']);
$adminPreview = $is_admin && !isset($request['override_from']);

if ( $authType === 'auth' && !$clientLoggedIn && !$adminPreview ) {
    if (isset($request['override_from'])) return;
    redir('link=' . rawurlencode($full_slug), (ZM_PB_MAINSYSTEM_PRETTY_URLS ? '/login' : '/login.php'));
    exit;
} elseif ( $authType === 'noauth' && $clientLoggedIn && !$adminPreview ) {
    if (isset($request['override_from']) || $public_slug === 'index') return;
    header('Location: ' . ZM_PB_FULLHOST, true, 302);
    exit;
}

$settings_request = $request;
if (isset($request['override_from']) && $lang !== '') {
    $requested_language = null;
    foreach (ZM_PB_LANGS as $language_name => $language_data) {
        if ($language_data['code_lower'] === $lang) {
            $requested_language = $language_name;
            break;
        }
    }
    if ($requested_language === null || !isset($pageData['settings'][$requested_language])) {
        $settings_request['lang'] = '';
    }
}
$page_settings_data = zm_pb_resolve_page_settings($pageData, $settings_request);

if (!$page_settings_data) {
    if ($override_type !== 'full') return;
    $ca = new ClientArea();
    http_response_code(404);
    $ca->setPageTitle('404 ' . (!empty($_LANG['errorPage']['404']['title']) ? ' - ' . $_LANG['errorPage']['404']['title'] : ''));
    $ca->setTemplate('error/page-not-found');
    $ca->addToBreadCrumb( (ZM_PB_MAINSYSTEM_PRETTY_URLS ? '/' : 'index.php'), $_LANG['hometitle'] ?? 'Home');
    $ca->addToBreadCrumb('', '404');
    $ca->initPage();
    $ca->output();

    //perf301Mark('PB_route_E');
    //perf301Flush();

    exit;
}

if ( !in_array($override_type,ZM_PB_ACCEPTED_OVERRIDES) ) return;
// Schema context and partial content use these settings, so expand them first.
if (is_object($page_settings_data->settings ?? null)) {
    foreach ($page_settings_data->settings as $key => $meta_val) {
        if (!is_string($meta_val)) continue;
        $page_settings_data->settings->$key = str_ireplace(
            ['%%SEP%%', '%%comname%%'],
            [ZM_PB_SEPARATOR, $GLOBALS['CONFIG']['CompanyName'] ?? ''],
            $meta_val
        );
    }
}
require_once ZM_PB_LIBDIR . 'schema.php';
$schemaValues = [
    'TITLE' => (string) ($page_settings_data->settings->meta_title ?? ''),
    'DESCRIPTION' => (string) ($page_settings_data->settings->meta_description ?? ''),
    'URL' => ZM_PB_FULLHOST . $full_slug,
    'IMAGE' => (string) ($page_settings_data->settings->meta_image ?? ''),
    'LANG_BCP47' => ZM_PB_LANGS[$page_settings_data->lang]['locale_BCP47'] ?? '',
    'SITE_NAME' => (string) ($GLOBALS['CONFIG']['CompanyName'] ?? ''),
    'SITE_URL' => (string) ($GLOBALS['CONFIG']['SystemURL'] ?? ''),
];
$schemaType = strtolower((string) ($page_settings_data->settings->meta_schema ?? ''));
$pageContext = ['page_id' => (int) $page->id, 'page_type' => $page->type, 'lang' => $page_settings_data->lang,
    'schema_type' => $schemaType, 'schema' => $schemaValues, 'schema_enabled' => $schemaType !== 'turn_off'];
require_once ZM_PB_LIBDIR . 'language_catalog.php';
$pageLanguage = $page_settings_data->lang;
$isAuctionHomepage = $public_slug === 'index';
// Other addons can prepare their template strings from the profile language.
add_hook('ClientAreaPage', 9999, function($vars) use ($pageLanguage, $isAuctionHomepage) {
    $catalogs = [];
    $core = ZM_PB_LanguageCatalog::core($pageLanguage);
    if ($core !== null) $catalogs['LANG'] = $core;
    if ($isAuctionHomepage || (isset($vars['Lang']) && is_array($vars['Lang']))) {
        $auction = ZM_PB_LanguageCatalog::auction($pageLanguage);
        if ($auction !== null) $catalogs['Lang'] = $auction;
    }
    $smarty = $GLOBALS['smarty'] ?? null;
    if ($smarty instanceof Smarty) {
        foreach ($catalogs as $name => $catalog) $smarty->assign($name, $catalog);
    }
    return $catalogs;
});
if ($pageContext['schema_enabled'] && $schemaType !== 'organization') {
    $organizationLanguage = $page_settings_data->lang;
    add_hook('ClientAreaHeadOutput', 1, function() use ($organizationLanguage) { return zm_pb_schema_jsonld(zm_pb_schema_organization($organizationLanguage)); });
}

if ( in_array($override_type,['partial_before','partial_after','partial_before_meta','partial_after_meta']) ) {
    require_once ZM_PB_LIBDIR . 'content_builder.php';
    $placement = ($override_type === 'partial_before' || $override_type === 'partial_before_meta') ? 'before' : 'after';
    $partialContext = $pageContext;
    $partialContext['preload_eligible'] = $placement === 'before';
    $content = ZM_PB_ContentBuilder::build($page_settings_data->content ?? '', $page->auth_type, $partialContext);
    if ($content === '') return;
    $language = ZM_PB_LANGS[$page_settings_data->lang]['locale_BCP47'] ?? '';
    $script = 'js/content-partial.js';
    $script_url = htmlspecialchars(ZM_PB_ASSETSURL . $script . '?v=' . filemtime(ZM_PB_ASSETSDIR . $script), ENT_QUOTES, 'UTF-8');
    add_hook('ClientAreaFooterOutput', 1, function() use ($content, $page, $placement, $language, $script_url) {
        return '<div class="zm-pb-page" data-page-id="' . (int) $page->id . '" lang="' . htmlspecialchars($language, ENT_QUOTES, 'UTF-8') . '" data-zm-pb-partial="' . $placement . '" hidden>' .
            $content . '</div><script src="' . $script_url . '"></script>';
    });
    if( in_array($override_type,['partial_before','partial_after']) ) return;
}

$full_host = ZM_PB_FULLHOST;
$supported_langs = ZM_PB_LANGS;
$default_lang = ZM_PB_DEFLANG;
$langs_route = ZM_PB_ENABLE_LANG_ROUTE;
$page_langs = json_decode($page->langs, true);
if (!is_array($page_langs)) $page_langs = [];
$page_lang = $page_settings_data->lang;

if ($override_type === 'full' || $meta_only || $enable_partial_with_meta) {
    $GLOBALS['zm_pb_breadcrumb_context'] = [
        'settings' => $page_settings_data->settings,
        'lang' => $page_lang,
        'source' => $request['override_from'] ?? null,
    ];
}

if ($meta_only) {
    add_hook('ClientAreaPage', 999, function() use ($page_settings_data) {
        $seo = $page_settings_data->settings ?? null;
        if (!$seo) return [];
        return [
            'pagetitle' => (string) ($seo->meta_title ?? ''),
            'metaDescription' => (string) ($seo->meta_description ?? ''),
        ];
    });
} else {

    if ($enable_partial_with_meta) {
        add_hook('ClientAreaPage', 999, function() use ($page_settings_data) {
            $seo = $page_settings_data->settings ?? null;
            if (!$seo) return [];
            return [
                'pagetitle' => (string) ($seo->meta_title ?? ''),
                'metaDescription' => (string) ($seo->meta_description ?? ''),
            ];
        });
    }

    $ca = new ClientArea();

    if ( $is_admin) {
        $translates = ZM_PB_ADMINLANG;
        $module_name = ZM_PB_NAME;
        
        add_hook('ClientAreaHeadOutput', 1, function() use ($translates,$page,$module_name,$full_host) {
            $status = $page->status;
            $type = $page->type;
            $statusLabel = $translates->pages_manager->page_status->translate->$status ?? ucfirst($status);
            $typeLabel = $type === 'system' ? ' | ' . $translates->pages_manager->page_type->translate->$type : '';
            return '<div class="zm-pb-page"><div id="builder-page-info" class="d-flex ai-center jc-center pd-1 gap-1 pos-fix pos-p-b pos-p-l pos-p-r text-a-c" style="z-index:99999;background:#e9ecef;color:#565656;font-size:12px;min-height:3em;">' . 
            ($page->status !== 'publish' || $page->type === 'system' ? $translates->pages_manager->page_preview->title . ': ' : '' )  .
            htmlspecialchars($page->name, ENT_QUOTES, 'UTF-8') .
            ' | ' . 
            $translates->pages_manager->page_status->title . ': ' .
            htmlspecialchars($statusLabel . $typeLabel) . 
            ' | ' . 
            " <a href=\"".$full_host."admin/addonmodules.php?module=".$module_name."&subpage=pages_editor&page_id=".$page->id."\">".$translates->pages_manager->edit_page->title."</a> " .
            ' </div></div>';
        });
    }

    $template = ( isset($page->template_file) && !empty($page->template_file) ) ? $page->template_file : 'default';
    $breadcrumb = ( isset($page_settings_data->settings->breadcrumb) && !empty($page_settings_data->settings->breadcrumb) ) ? $page_settings_data->settings->breadcrumb : $page_settings_data->settings->meta_title;

    $ca->setPageTitle( $page_settings_data->settings->meta_title); 
    $ca->setTemplate(ZM_PB_CRUTCH_CLIENTSIDE_DIR.$template);

    if( $page_settings_data->settings->enable_breadcrumb ){

        if ( defined("ZMPB_PAGE_OVERRIDE_MAIN") ){
            $ca->addToBreadCrumb('', $breadcrumb);
        }
        else {
            $ca->addToBreadCrumb( (ZM_PB_MAINSYSTEM_PRETTY_URLS ? '/' : 'index.php'), $_LANG['hometitle'] ?? 'Home');
            $ca->addToBreadCrumb('', $breadcrumb);
        }
    }

    require_once ZM_PB_LIBDIR . 'content_builder.php';
    $fullContext = $pageContext;
    $fullContext['preload_eligible'] = true;
    $ca->assign('content', ZM_PB_ContentBuilder::build($page_settings_data->content ?? '', $page->auth_type, $fullContext));
    unset($page_settings_data->content);


    $ca->assign('page',  $page);
    $ca->assign('settings',  $page_settings_data);

    $current_lang = $supported_langs[$page_lang] ?? $supported_langs[$default_lang] ?? reset($supported_langs);

    $ca->assign('default_lang_code', $supported_langs[$default_lang]['code_ISO639_1']);
    $ca->assign('lang_code', $current_lang['code_ISO639_1']);
    $ca->assign('lang_route_code', $current_lang['code_lower']);
    $ca->assign('lang_locale', $current_lang['locale']);
    $ca->assign('lang_localeBCP47', $current_lang['locale_BCP47']);
    if (!empty(ZM_PB_SITE_FAVICON)) $ca->assign('custom_favicon_isset', true);

}

if( $override_type === 'full' || $meta_only || $enable_partial_with_meta ){
    add_hook('ClientAreaHeadOutput', 1, function($vars) use ($page_settings_data,$supported_langs,$langs_route,$page_langs,$default_lang,$public_path,$full_host,$full_slug,$page_lang,$meta_only) {
        $seo = $page_settings_data->settings;

        if( is_null($seo) ) return;

        $isset_lang = $supported_langs[$page_lang] ?? $supported_langs[$default_lang] ?? reset($supported_langs);

        $lang_code = $isset_lang['code_ISO639_1'];
        $lang_localeBCP47 = $isset_lang['locale_BCP47'];

        $attr_lang = "lang=\"{$lang_code}\"";

        $html = '';

        if (!empty(ZM_PB_SITE_FAVICON)) {
            $favicon_ext = strtolower(pathinfo(parse_url(ZM_PB_SITE_FAVICON, PHP_URL_PATH), PATHINFO_EXTENSION));

            $favicon_types = [
                'ico'   => 'image/x-icon',
                'png'   => 'image/png',
                'gif'   => 'image/gif',
                'jpg'   => 'image/jpeg',
                'jpeg'  => 'image/jpeg',
                'svg'   => 'image/svg+xml',
                'webp'  => 'image/webp',
                'avif'  => 'image/avif',
            ];

            $favicon_type = $favicon_types[$favicon_ext] ?? 'image/x-icon';

            $html .= '<link rel="icon" type="' . $favicon_type . '" href="' . ZM_PB_SITE_FAVICON . '">' . "\n" .
                    '<link rel="shortcut icon" type="' . $favicon_type . '" href="' . ZM_PB_SITE_FAVICON . '">' . "\n";
        }
        
        if (!empty($seo->meta_canonical)) {
            if ( defined("ZMPB_PAGE_OVERRIDE_MAIN") ) $html .= '<link rel="canonical" href="' . htmlspecialchars($full_host) . ($page_lang !== $default_lang ? $isset_lang['code_lower'].'/' : '') . '" />' . "\n";
            else $html .= '<link rel="canonical" href="' . htmlspecialchars($seo->meta_canonical) . '" />' . "\n";
        }

        $alt_links = '<link rel="alternate" hreflang="x-default" href="' . htmlspecialchars($full_host.$public_path, ENT_QUOTES, 'UTF-8') . '" />' . "\n";
        $alt_meta = '';
        
        foreach ($page_langs as $lang_name) {
            $lang_sub_code = $supported_langs[$lang_name]['code_ISO639_1'];
            $lang_route_code = $supported_langs[$lang_name]['code_lower'];
            $lang_sub_locale = $supported_langs[$lang_name]['locale'];
            $url = "{$full_host}{$lang_route_code}/{$public_path}";
            if( $lang_name === $default_lang || !$langs_route) $url = "{$full_host}{$public_path}";

            $alt_links .= '<link rel="alternate" hreflang="'.$lang_sub_code.'" href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" />' . "\n";
            $alt_meta .= '<meta property="'.($lang_name === $page_lang ? 'og:locale' : 'og:locale:alternate').'" content="'.htmlspecialchars($lang_sub_locale, ENT_QUOTES, 'UTF-8').'" />' . "\n";
        }


        $html .= $alt_links . $alt_meta;
        
        if ( !$meta_only && !empty($seo->meta_description)) $html .= '<meta name="description" '.$attr_lang.' content="' . htmlspecialchars($seo->meta_description) . '" />' . "\n";
        if (!empty($seo->meta_keywords)) $html .= '<meta name="keywords" '.$attr_lang.' content="' . htmlspecialchars($seo->meta_keywords) . '" />' . "\n";

        switch ($seo->meta_robots) {
            case 'i-f':
                $html .= "<meta name=\"robots\" content=\"index, follow\">\n";
                break;

            case 'n-f':
                $html .= "<meta name=\"robots\" content=\"noindex, follow\">\n";
                break;

            case 'i-n':
                $html .= "<meta name=\"robots\" content=\"index, nofollow\">\n";
                break;

            case 'n-n':
                $html .= "<meta name=\"robots\" content=\"noindex, nofollow\">\n";
                break;

            default:
                break;
        }
        

        // OpenGraph
        if ( $seo->enable_og ) {

            $html .= '<meta property="og:type" content="' . htmlspecialchars($seo->meta_og_type) . '" />' . "\n";

            if( !empty($seo->meta_og_title) ) $html .= '<meta property="og:title" content="' . htmlspecialchars($seo->meta_og_title) . '" />' . "\n";
            else $html .= '<meta property="og:title" content="' . htmlspecialchars($seo->meta_title) . '" />' . "\n";

            if( !empty($seo->meta_og_description) ) $html .= '<meta property="og:description" content="' . htmlspecialchars($seo->meta_og_description) . '" />' . "\n";
            else $html .= '<meta property="og:description" content="' . htmlspecialchars($seo->meta_description) . '" />' . "\n";

            $html .= '<meta property="og:url" content="' . htmlspecialchars($full_host . $full_slug, ENT_QUOTES, 'UTF-8') . '" />' . "\n";

            if( !empty($seo->meta_og_image) ) $html .= '<meta property="og:image" content="' . htmlspecialchars($seo->meta_og_image) . '" />' . "\n";
            else $html .= '<meta property="og:image" content="' . htmlspecialchars($seo->meta_image) . '" />' . "\n";

            $html .= '<meta property="og:site_name" content="' . htmlspecialchars($GLOBALS['CONFIG']['CompanyName'] ?? 'My Company') . '" />' . "\n";
        }

        // Twitter
        if ( $seo->enable_twitter ) {
            
            $html .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";
            $html .= '<meta name="twitter:site" content="' . htmlspecialchars($GLOBALS['CONFIG']['CompanyName'] ?? 'My Company') . '" />' . "\n";

            if( !empty($seo->meta_twitter_title) ) $html .= '<meta name="twitter:title" content="' . htmlspecialchars($seo->meta_twitter_title) . '" />' . "\n";
            else $html .= '<meta name="twitter:title" content="' . htmlspecialchars($seo->meta_title) . '" />' . "\n";

            if( !empty($seo->meta_twitter_description) ) $html .= '<meta name="twitter:description" content="' . htmlspecialchars($seo->meta_twitter_description) . '" />' . "\n";
            else $html .= '<meta name="twitter:description" content="' . htmlspecialchars($seo->meta_description) . '" />' . "\n";

            if( !empty($seo->meta_twitter_image) ) $html .= '<meta name="twitter:image" content="' . htmlspecialchars($seo->meta_twitter_image) . '" />' . "\n";
            else $html .= '<meta name="twitter:image" content="' . htmlspecialchars($seo->meta_image) . '" />' . "\n";

        }
        
        $seo->meta_schema = zm_pb_stlc($seo->meta_schema);

        if (!empty($seo->meta_schema) && $seo->meta_schema !== 'turn_off') {
            if ($seo->meta_schema === 'organization') $html .= zm_pb_schema_jsonld(zm_pb_schema_organization($page_lang));
            // FAQPage is emitted from visible question/answer blocks, with their real mainEntity.
            elseif (!in_array($seo->meta_schema, ['faqpage', 'website'], true)) $html .= zm_pb_schema_jsonld(zm_pb_schema_template($seo->meta_schema, [
                'TITLE' => $seo->meta_title, 'DESCRIPTION' => $seo->meta_description, 'URL' => $full_host . $full_slug,
                'IMAGE' => $seo->meta_image, 'LANG_BCP47' => $lang_localeBCP47,
                'SITE_NAME' => $GLOBALS['CONFIG']['CompanyName'] ?? '', 'SITE_URL' => $GLOBALS['CONFIG']['SystemURL'] ?? '',
                'ORGANIZATION_LOGO' => $GLOBALS['CONFIG']['LogoURL'] ?? '',
            ]));
        }

        
        
        return $html;
    });
}



if ( $meta_only || $enable_partial_with_meta ) return;

//perf301Mark('PB_route_E');
//perf301Flush();

$ca->initPage();
$ca->output();

exit;
