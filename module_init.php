<?php
if (!defined("WHMCS")) die("This file cannot be accessed directly");
require_once __DIR__ . "/../../../init.php";
use Illuminate\Database\Capsule\Manager as Capsule;
global $CONFIG;


### SALTS CONSTS ###

/** Recommendations for salt generation
 * Numbers from '0' to '9'
 * Letters from 'a' to 'Z'
 * Special chars @ | { } - _ [ ] ( ) * ! + , . & ` = : ; / < >
 * 
 * Salt Length >= 64
 */
if (!defined('ZM_PB_ADMIN_SALT')) define('ZM_PB_ADMIN_SALT', '');
if (!defined('ZM_PB_SECURE_SALT')) define('ZM_PB_SECURE_SALT', '');
if (!defined('ZM_PB_NONCE_SALT')) define('ZM_PB_NONCE_SALT', '');
### SALTS CONSTS ###

if (!defined("ZM_PB_DEFLANG")) define('ZM_PB_DEFLANG', strtolower($CONFIG['Language'] ?? 'english') );
if (!defined("ZM_PB_ALLOWED_CONSTS_CHANGE")) define('ZM_PB_ALLOWED_CONSTS_CHANGE', [
    'ZM_PB_CHECK_SUPERADM',
    'ZM_PB_PRETTY_URLS',
    'ZM_PB_MAINSYSTEM_PRETTY_URLS',
    'ZM_PB_MAINTENANCEMOD',
    'ZM_PB_COLLECT_VARS',
    'ZM_PB_USE_COLLECT_VARS',
    'ZM_PB_SITE_FAVICON',
    //'ZM_PB_SITE_AUTOFAVICON',
    'ZM_PB_CUSTOM_HEADER',
    'ZM_PB_CUSTOM_FOOTER',
    'ZM_PB_SITEMAP_LASTUPD',
    'ZM_PB_SITEMAP_UPDFREQ',

    'ZM_PB_ENABLE_PAGE_OVERRIDES',
    'ZM_PB_ENABLE_LANG_ROUTE',
    'ZM_PB_ENABLE_SITEMAP',
    'ZM_PB_ENABLE_REDIRECTS_MANAGER',
    'ZM_PB_AUTO_REDIRECTS',
    'ZM_PB_AUTO_REDIRECT_DAYS',
    'ZM_PB_ENABLE_MAINNAV',
    'ZM_PB_ENABLE_SECONDARYNAV',
    'ZM_PB_ENABLE_MAINSIDEBAR',
    'ZM_PB_ENABLE_SECONDARYSIDEBAR',

    'ZM_PB_SEPARATOR',
]);


### INFO CONSTS ###
if (!defined("ZM_PB_SUPERADM_ID")) define('ZM_PB_SUPERADM_ID', 1 );
if (!defined("ZM_PB_FREFIX")) define('ZM_PB_FREFIX', "ZM_PB_" );
if (!defined("ZM_PB_VER")) define('ZM_PB_VER', "0.0.0" );
if (!defined("ZM_PB_NAME")) define('ZM_PB_NAME', basename(__DIR__) );
### INFO CONSTS ###


### DIRS CONSTS ###
if (!defined("ZM_PB_ROOTDIR")) define('ZM_PB_ROOTDIR', ROOTDIR . "/modules/addons/".basename(__DIR__)."/" );
if (!defined("ZM_PB_ROOTDIR_INNER")) define('ZM_PB_ROOTDIR_INNER', "modules/addons/".basename(__DIR__)."/" );
if (!defined("ZM_PB_TEMPLATESDIR")) define('ZM_PB_TEMPLATESDIR', ZM_PB_ROOTDIR . "templates/" );
if (!defined("ZM_PB_TEMPLATESPARTSDIR")) define('ZM_PB_TEMPLATESPARTSDIR', ZM_PB_TEMPLATESDIR . "parts/" );
if (!defined("ZM_PB_HOOKSDIR")) define('ZM_PB_HOOKSDIR', ZM_PB_ROOTDIR . "hooks/" );
if (!defined("ZM_PB_METHODSDIR")) define('ZM_PB_METHODSDIR', ZM_PB_ROOTDIR . "methods/" );
if (!defined("ZM_PB_INCDIR")) define('ZM_PB_INCDIR', ZM_PB_ROOTDIR . "inc/" );
if (!defined("ZM_PB_INCMODULEDIR")) define('ZM_PB_INCMODULEDIR', ZM_PB_INCDIR . "module/" );
if (!defined("ZM_PB_LIBDIR")) define('ZM_PB_LIBDIR', ZM_PB_ROOTDIR . "lib/" );
if (!defined("ZM_PB_RESOURCESDIR")) define('ZM_PB_RESOURCESDIR', ZM_PB_ROOTDIR . "resources/" );
if (!defined("ZM_PB_ASSETSDIR")) define('ZM_PB_ASSETSDIR', ZM_PB_ROOTDIR . "assets/" );
if (!defined("ZM_PB_ALANGDIR")) define('ZM_PB_ALANGDIR', ZM_PB_ROOTDIR . "admin_lang/" ); // saved as object
if (!defined("ZM_PB_CLIENTSIDE_DIR")) define('ZM_PB_CLIENTSIDE_DIR', 'client_side/' );
if (!defined("ZM_PB_CRUTCH_CLIENTSIDE_DIR")) define('ZM_PB_CRUTCH_CLIENTSIDE_DIR', '../../'.ZM_PB_ROOTDIR_INNER. "templates/".ZM_PB_CLIENTSIDE_DIR );
if (!defined("ZM_PB_SCHEMAS_DIR")) define('ZM_PB_SCHEMAS_DIR', ZM_PB_ASSETSDIR.'schemas/' );
### DIRS CONSTS ###

require_once ZM_PB_INCDIR.'editable_consts.php';

### MODULE URLS CONSTS ###
if (!defined("ZM_PB_ROOTURL")) define('ZM_PB_ROOTURL', $CONFIG['SystemURL']."/modules/addons/".basename(__DIR__)."/" );
if (!defined("ZM_PB_ASSETSURL")) define('ZM_PB_ASSETSURL', ZM_PB_ROOTURL . "assets/" );
### MODULE URLS CONSTS ###


### SUP MODULE MAINSYSTEM CONSTS ###
if (!defined("ZM_PB_MAINSYSTEM_DEFAULT_PAGES")) define('ZM_PB_MAINSYSTEM_DEFAULT_PAGES', [
    'index',
    //'login',
    //'logout',
    //'dologin',
    //'register',
    //'reset', // password reset
    //'pwresetvalidation',
    'announcements',
    //'announcementsrss',
    'knowledgebase',
    'contact',
    //'clientarea',
    //'viewinvoice',
    //'viewquote',
    //'viewemail',
    //'supporttickets',
    //'submitticket',
    //'viewticket',
    //'affiliates',
    //'banned',
]);

# SUP MODULE MAINSYSTEM DIRS CONSTS
if (!defined("ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR")) define('ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR', ROOTDIR . "/attachments/" );
if (!defined("ZM_PB_MAINSYSTEM_ASSETS_DIR")) define('ZM_PB_MAINSYSTEM_ASSETS_DIR', ROOTDIR . "/assets/");

# SUP MODULE MAINSYSTEM URLS CONSTS
if (!defined("ZM_PB_MAINSYSTEM_ATTACHMENTS_URL")) define('ZM_PB_MAINSYSTEM_ATTACHMENTS_URL', $CONFIG['SystemURL'] . "/attachments/" );
if (!defined("ZM_PB_MAINSYSTEM_ASSETS_URL")) define('ZM_PB_MAINSYSTEM_ASSETS_URL', $CONFIG['SystemURL'] . "/assets/");
if (!defined("ZM_PB_FULLHOST")) define('ZM_PB_FULLHOST', rtrim(strtolower($CONFIG['SystemURL']), '/') . '/' );

### SUP MODULE MAINSYSTEM CONSTS ###


### SUP MODULE CONSTS ###
if (!defined("ZM_PB_ACCEPTED_METHODS")) define('ZM_PB_ACCEPTED_METHODS', ['GET','POST','DELETE'] );
if (!defined("ZM_PB_ACCEPTED_OVERRIDES")) define('ZM_PB_ACCEPTED_OVERRIDES', ['full','partial_before','partial_after','meta_only','partial_before_meta','partial_after_meta'] );
if (!defined("ZM_PB_SUBPAGES")) define('ZM_PB_SUBPAGES', ['pages_manager','pages_editor','sitemap_manager','media_manager','menu_manager','rewrite_manager','redirects_manager','module_db','module_settings',/*'module_logs','code_editor','langs_editor',*/] );
if (!defined("ZM_PB_PAGE_BLOCK_EDITOR_TOOLS")) define('ZM_PB_PAGE_BLOCK_EDITOR_TOOLS', ['auth_zone', 'not_auth_zone', 'mixed_auth_zone', 'tinymce', 'paragraph', 'image', 'video', 'link', 'button', 'map', 'divider', 'spacer', 'flex', 'grid', 'carousel', 'custom_js', 'custom_css', 'smarty_variable']);
### SUP MODULE CONSTS ###


### SUP MODULE CACHE CONSTS ###
if (!defined("ZM_PB_VER_CACHE_STATIC")) define('ZM_PB_VER_CACHE_STATIC', substr(md5( ZM_PB_VER ), 0, 8));
if (!defined("ZM_PB_VER_CACHE_DYNAMIC")) define('ZM_PB_VER_CACHE_DYNAMIC', (object)[
        'hourly'=> substr(md5( ZM_PB_VER . '_' . date('Y-m-d H') ), 0, 8),
        'daily'=> substr(md5( ZM_PB_VER . '_' . date('Y-m-d') ), 0, 8),
        'weekly'=> substr(md5( ZM_PB_VER . '_' . date('o-W') ), 0, 8),
        'monthly'=> substr(md5( ZM_PB_VER . '_' . date('Y-m') ), 0, 8),
        'annually'=> substr(md5( ZM_PB_VER . '_' . date('Y') ), 0, 8),
    ]
);
### SUP MODULE CACHE CONSTS ###


$adminId = $_SESSION['adminid'] ?? 0;

### SUP MODULE SECURE CONSTS ###
if (!defined("ZM_PB_FORMS_PRENONCE")) define('ZM_PB_FORMS_PRENONCE', ZM_PB_VER_CACHE_STATIC .'_'. ZM_PB_VER_CACHE_DYNAMIC->daily);
if (!defined("ZM_PB_ADMIN_PRENONCE")) define('ZM_PB_ADMIN_PRENONCE', ZM_PB_VER_CACHE_STATIC .'_'. ZM_PB_VER_CACHE_DYNAMIC->hourly .'_'. substr(md5( $adminId ), 0, 12) );
if (!defined("ZM_PB_SECURE_PRENONCE")) define('ZM_PB_SECURE_PRENONCE', ZM_PB_VER_CACHE_STATIC .'_'. ZM_PB_VER_CACHE_DYNAMIC->hourly .'_'. $adminId);
### SUP MODULE SECURE CONSTS ###


$adminlang = ZM_PB_DEFLANG ?? 'english';
if ($adminId) {
    $admin = Capsule::table('tbladmins')->where('id', $adminId)->first();
    $adminlang = $admin->language ?? ZM_PB_DEFLANG ?? 'english';
}
$adminlang = strtolower((string) $adminlang);
if ($adminlang === 'ukrainian') $adminlang = 'ukranian'; // Existing language file and supported_langs.php key.

### SUP MODULE LANGS CONSTS ###
if (!defined("ZM_PB_LANGS")) define('ZM_PB_LANGS', ( require_once ZM_PB_ROOTDIR.'supported_langs.php') );
if (!defined("ZM_PB_ADMINLANG") && defined("ZM_PB_ALANGDIR")){
    $admin_lang_file = ZM_PB_ALANGDIR . "{$adminlang}.php";
    if( !file_exists($admin_lang_file) ) $admin_lang_file = ZM_PB_ALANGDIR . "english.php";
    $admin_lang_data = require $admin_lang_file;
    define('ZM_PB_ADMINLANG', $admin_lang_data);
}
if (!defined("ZM_PB_ADMINLANGNAME")) define('ZM_PB_ADMINLANGNAME', $adminlang );
### SUP MODULE LANGS CONSTS ###
unset($adminId);

### MODULE FILES CONSTS ###
if (!defined("ZM_PB_MEDIA_MANAGER_FILE")) define('ZM_PB_MEDIA_MANAGER_FILE', ZM_PB_LIBDIR . 'media_manager.php');
if (!defined("ZM_PB_PAGE_BUILDER_FILE")) define('ZM_PB_PAGE_BUILDER_FILE', ZM_PB_LIBDIR . 'page_builder.php');
if (!defined("ZM_PB_HELPERS_FILE")) define('ZM_PB_HELPERS_FILE', ZM_PB_INCDIR . 'helpers.php');
if (!defined("ZM_PB_CLIENTSIDE_DEFAULT_TEMPLATE")) define('ZM_PB_CLIENTSIDE_DEFAULT_TEMPLATE', ZM_PB_CLIENTSIDE_DIR . 'default');
### MODULE FILES CONSTS ###


require_once ZM_PB_HELPERS_FILE;
