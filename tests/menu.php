<?php
/** Isolated SQLite test: never reads WHMCS configuration or connects to the live database. */
error_reporting(E_ALL & ~E_DEPRECATED);
require dirname(__DIR__, 4) . '/vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
define('ZM_PB_VER', 'test');
define('ROOTDIR', dirname(__DIR__, 4));
define('ZM_PB_SUPERADM_ID', 1);
define('ZM_PB_NAME', 'zmchel_whmcs_multimodule');
define('ZM_PB_ROOTDIR', dirname(__DIR__) . '/');
define('ZM_PB_INCDIR', ZM_PB_ROOTDIR . 'inc/');
define('ZM_PB_LIBDIR', ZM_PB_ROOTDIR . 'lib/');
define('ZM_PB_ASSETSDIR', ZM_PB_ROOTDIR . 'assets/');
define('ZM_PB_SCHEMAS_DIR', ZM_PB_ASSETSDIR . 'schemas/');
define('ZM_PB_ASSETSURL', 'https://example.test/modules/addons/zmchel_whmcs_multimodule/assets/');
define('ZM_PB_FULLHOST', 'https://example.test/');
define('ZM_PB_DEFLANG', 'english');
define('ZM_PB_ENABLE_LANG_ROUTE', true);
define('ZM_PB_PRETTY_URLS', !in_array('--plain', $argv, true));
define('ZM_PB_MAINSYSTEM_PRETTY_URLS', true);
define('ZM_PB_ENABLE_PAGE_OVERRIDES', true);
define('ZM_PB_MAINSYSTEM_DEFAULT_PAGES', ['index', 'contact']);
define('ZM_PB_ACCEPTED_OVERRIDES', ['full', 'partial_before', 'partial_after', 'meta_only']);
define('ZM_PB_ENABLE_MAINNAV', true);
define('ZM_PB_ENABLE_SECONDARYNAV', false);
define('ZM_PB_ENABLE_MAINSIDEBAR', true);
define('ZM_PB_ENABLE_SECONDARYSIDEBAR', false);
define('ZM_PB_LANGS', require ZM_PB_ROOTDIR . 'supported_langs.php');
function check($condition, $message) { if (!$condition) throw new RuntimeException($message); }
function zm_pb_has_table($name) { return Capsule::schema()->hasTable($name); }
function zm_pb_parse_request() { return ['lang' => 'ru', 'slug' => 'test']; }
require ZM_PB_INCDIR . 'menu_schema.php';
require ZM_PB_LIBDIR . 'menu.php';
$capsule = new Capsule();
$capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '']);
$capsule->setAsGlobal();
Capsule::schema()->create('zm_pb_pages', function ($t) {
    $t->increments('id'); foreach (['name', 'slug', 'status', 'auth_type', 'type', 'created_at'] as $key) $t->string($key);
});
Capsule::schema()->create('zm_pb_pages_settings', function ($t) {
    $t->increments('id'); $t->unsignedInteger('page_id'); $t->string('lang'); $t->boolean('lang_active'); $t->string('lang_status'); $t->text('settings');
});
Capsule::schema()->create('zm_pb_module_settings', function ($t) {
    $t->string('setting_name'); $t->text('setting_value');
});
foreach (zm_pb_menu_table_definitions() as $create) $create();
foreach (zm_pb_menu_columns() as $name => $columns) foreach (array_keys($columns) as $column) check(Capsule::schema()->hasColumn($name, $column), 'Missing schema column');
$pageId = Capsule::table('zm_pb_pages')->insertGetId(['name' => 'Test', 'slug' => 'test', 'status' => 'publish', 'auth_type' => 'mixed', 'type' => 'page', 'created_at' => '2026-01-01']);
$secondPageId = Capsule::table('zm_pb_pages')->insertGetId(['name' => 'Contact', 'slug' => 'contact', 'status' => 'publish', 'auth_type' => 'mixed', 'type' => 'page', 'created_at' => '2026-01-01']);
foreach (['english' => 'English title', 'russian' => 'Russian title'] as $lang => $title) Capsule::table('zm_pb_pages_settings')->insert(['page_id' => $pageId, 'lang' => $lang, 'lang_active' => true, 'lang_status' => 'publish', 'settings' => json_encode(['breadcrumb' => $title])]);
Capsule::table('zm_pb_pages_settings')->insert(['page_id' => $secondPageId, 'lang' => 'english', 'lang_active' => true,
    'lang_status' => 'draft', 'settings' => json_encode(['breadcrumb' => 'Overridden home'])]);
Capsule::table('zm_pb_module_settings')->insert(['setting_name' => 'page_overrides', 'setting_value' => json_encode([
    'from' => ['index'], 'to' => ['contact'], 'type' => ['full']])]);
$reportedItems = [];
foreach ([$pageId, $secondPageId] as $index => $id) {
    $reportedItems[] = ['key' => 'new_1790712369741_' . ($index + 1), 'parent' => '', 'type' => 'page', 'page_id' => $id,
        'labels' => array_fill_keys(array_keys(ZM_PB_LANGS), ''), 'label' => '',
        'url' => 'https://example.test/' . ($index ? 'contact' : 'mainpage'), 'target' => '_self',
        'visibility' => 'mixed', 'title' => '', 'classes' => '', 'rel' => '', 'icon' => '', 'description' => ''];
}
$reportedJson = json_encode($reportedItems, JSON_UNESCAPED_UNICODE);
$reportedMenuId = zm_pb_menu_save(['menu_id' => '0', 'items' => 'zm_pb_b64:' . base64_encode($reportedJson), 'name' => 'Главное меню',
    'active' => '1', 'mode' => 'replace', 'device' => 'mixed', 'locations' => ['primary_navbar']]);
check($reportedMenuId > 0, 'Reported menu payload was rejected');
$homeUrl = 'https://example.test/';
$russianHomeUrl = ZM_PB_PRETTY_URLS ? 'https://example.test/ru/' : $homeUrl;
check(zm_pb_menu_page_url((object) ['slug' => 'contact'], 'english') === $homeUrl, 'Home override URL not canonical');
check(zm_pb_menu_page_url((object) ['slug' => 'contact'], 'russian') === $russianHomeUrl, 'Localized home override URL broken');
$reportedAdmin = zm_pb_menu_admin_data($reportedMenuId);
check($reportedAdmin['items'][1]['url'] === $homeUrl && $reportedAdmin['pages']['page'][0]['url'] === $homeUrl,
    'Override URL missing from saved item or admin page list');
$reportedRows = Capsule::table('zm_pb_menu_items')->where('menu_id', $reportedMenuId)->orderBy('position')->get()->map(function ($i) { return (array) $i; })->all();
$reportedPages = Capsule::table('zm_pb_pages')->whereIn('id', [$pageId, $secondPageId])->get()->keyBy('id')->all();
$reportedSettings = [$pageId => [], $secondPageId => []];
foreach (Capsule::table('zm_pb_pages_settings')->get() as $setting) $reportedSettings[$setting->page_id][$setting->lang] = $setting;
$reportedTree = ZM_PB_Menu::tree($reportedRows, $reportedPages, $reportedSettings, 'russian', false, zm_pb_menu_override_sources());
check(count($reportedTree) === 2 && $reportedTree[1]['url'] === $russianHomeUrl,
    'Rendered menu ignored home override or requested language');
$corruptedInput = ['items' => htmlspecialchars($reportedJson, ENT_QUOTES, 'UTF-8'), 'name' => 'Corrupted JSON'];
$blocked = false;
try { zm_pb_menu_save($corruptedInput); } catch (InvalidArgumentException $error) { $blocked = $error->getMessage() === 'invalid_items#17:field=items'; }
check($blocked, 'HTML-escaped JSON unexpectedly parsed');
$badEncoding = ['items' => 'zm_pb_b64:not-base64', 'name' => 'Bad encoding'];
$blocked = false;
try { zm_pb_menu_save($badEncoding); } catch (InvalidArgumentException $error) { $blocked = $error->getMessage() === 'invalid_items#16:field=items'; }
check($blocked, 'Invalid menu transport unexpectedly parsed');
$badLabel = $reportedItems;
$badLabel[1]['labels']['russian'] = ['unexpected'];
$blocked = false;
try { zm_pb_menu_validate_items($badLabel); } catch (InvalidArgumentException $error) { $blocked = $error->getMessage() === 'invalid_items#13:item=2:field=labels'; }
check($blocked, 'Invalid label lacks item and field diagnostics');
$menuText = (object) ['errors' => (object) ['invalid_items' => 'Некорректные параметры пункта меню.']];
check(zm_pb_menu_error_message(new InvalidArgumentException('invalid_items#17:field=items'), $menuText) === 'Некорректные параметры пункта меню. (#17:field=items)', 'Diagnostic marker lost during translation');
$input = ['name' => 'Main', 'active' => 1, 'auto_add' => 1, 'mode' => 'replace', 'device' => 'pc', 'locations' => ['primary_navbar', 'primary_sidebar'],
    'items' => json_encode([
        ['key' => 'a', 'parent' => '', 'type' => 'page', 'page_id' => $pageId, 'label' => '', 'url' => '/wrong'],
        ['key' => 'b', 'parent' => 'a', 'type' => 'custom', 'label' => 'Child', 'url' => '/contact', 'target' => '_blank'],
        ['key' => 'c', 'parent' => 'b', 'type' => 'custom', 'label' => 'Deep', 'url' => 'https://external.test/', 'visibility' => 'auth'],
    ])];
$menuId = zm_pb_menu_save($input);
check($menuId > 0, 'Save failed');
$admin = zm_pb_menu_admin_data($menuId);
check(count($admin['items']) === 3 && $admin['selected']->device === 'pc', 'Saved fields missing');
check($admin['locations']['primary_navbar']['menu_id'] === $menuId, 'Location missing');
check($admin['items'][1]['parent'] === $admin['items'][0]['key'], 'Tree persistence broken');
$defaultUrl = ZM_PB_PRETTY_URLS ? 'https://example.test/test' : 'https://example.test/index.php?m=zmchel_whmcs_multimodule&slug=test';
check($admin['items'][0]['url'] === $defaultUrl, 'Default-language URL not canonical');
$localized = zm_pb_menu_page_url((object) ['slug' => 'test'], 'russian');
check(strpos($localized, ZM_PB_PRETTY_URLS ? '/ru/test' : '&lang=ru') !== false, 'Localized page URL broken');
check(ZM_PB_Menu::localizeUrl('https://external.test/path', 'russian') === 'https://external.test/path', 'External URL altered');
// Opt out only from URL localization: preserve translated labels and saved URLs.
$customItems = [
    ['key' => 'account', 'type' => 'custom', 'label' => 'Account', 'url' => '/clientarea.php?action=details#profile',
        'localize_url' => '0', 'labels' => ['russian' => 'Личный кабинет']],
    ['key' => 'literal', 'type' => 'custom', 'label' => 'Exact URL', 'url' => '/ru/contact/?a=1&b=2', 'localize_url' => false],
    ['key' => 'automatic', 'type' => 'custom', 'label' => 'Contact', 'url' => '/contact/'],
];
$customMenuId = zm_pb_menu_save(['name' => 'Custom language URLs', 'items' => json_encode($customItems)]);
$customAdmin = zm_pb_menu_admin_data($customMenuId);
check(!$customAdmin['items'][0]['localize_url'] && $customAdmin['items'][2]['localize_url'], 'Localization choice/default not persisted');
check($customAdmin['items'][1]['url'] === $customItems[1]['url'], 'Save normalized an opted-out URL');
$customRows = Capsule::table('zm_pb_menu_items')->where('menu_id', $customMenuId)->orderBy('position')->get()
    ->map(function ($item) { return (array) $item; })->all();
foreach (['english', 'russian'] as $language) {
    $customTree = ZM_PB_Menu::tree($customRows, [], [], $language, true);
    check($customTree[0]['url'] === $customItems[0]['url'], 'System link changed for ' . $language);
    check($customTree[1]['url'] === $customItems[1]['url'], 'Explicit language/query string changed');
    check($customTree[0]['label'] === ($language === 'russian' ? 'Личный кабинет' : 'Account'), 'URL opt-out disabled label translations');
    check($customTree[2]['url'] === ZM_PB_Menu::localizeUrl($customAdmin['items'][2]['url'], $language), 'Automatic URL localization regressed');
}
$badUrlSetting = [['key' => 'bad', 'type' => 'custom', 'label' => 'Bad', 'localize_url' => ['0']]];
$blocked = false;
try { zm_pb_menu_validate_items($badUrlSetting); } catch (InvalidArgumentException $error) { $blocked = strpos($error->getMessage(), 'field=localize_url') !== false; }
check($blocked, 'Invalid localization flag accepted');
if (ZM_PB_PRETTY_URLS) check(ZM_PB_Menu::localizeUrl('https://example.test/en/test?q=1#part', 'english') === 'https://example.test/test?q=1#part', 'Default language prefix survived');
foreach (['javascript:alert(1)', 'data:text/html,test', '//evil.test/', '&#x6a;avascript:alert(1)', "https://ok.test/\n"] as $url) check(!zm_pb_menu_safe_url($url), 'Unsafe URL accepted');
foreach ([
    [['key' => 'a', 'parent' => 'a', 'type' => 'custom', 'label' => 'X']],
    [['key' => 'a', 'parent' => 'b', 'type' => 'custom', 'label' => 'X'], ['key' => 'b', 'parent' => 'a', 'type' => 'custom', 'label' => 'Y']],
    [['key' => 'a', 'parent' => 'missing', 'type' => 'custom', 'label' => 'X']],
] as $invalid) {
    $blocked = false; try { zm_pb_menu_validate_items($invalid); } catch (InvalidArgumentException $e) { $blocked = true; }
    check($blocked, 'Invalid tree accepted');
}
$rows = Capsule::table('zm_pb_menu_items')->where('menu_id', $menuId)->orderBy('position')->get()->map(function ($i) { return (array) $i; })->all();
$pages = [$pageId => Capsule::table('zm_pb_pages')->where('id', $pageId)->first()];
$settings = []; foreach (Capsule::table('zm_pb_pages_settings')->get() as $setting) $settings[$pageId][$setting->lang] = $setting;
$guest = ZM_PB_Menu::tree($rows, $pages, $settings, 'russian', false);
check($guest[0]['label'] === 'Russian title' && !$guest[0]['children'][0]['children'], 'Localization/auth filtering broken');
$auth = ZM_PB_Menu::tree($rows, $pages, $settings, 'russian', true);
check(count($auth[0]['children'][0]['children']) === 1, 'Deep authorized item missing');
$pages[$pageId]->auth_type = 'auth';
check(!ZM_PB_Menu::tree($rows, $pages, $settings, 'russian', false), 'Hidden parent leaked descendants');
// The page builder serves active language versions even while their translation status is draft.
Capsule::table('zm_pb_pages_settings')->where('page_id', $pageId)->update(['lang_status' => 'draft']);
$factory = new WHMCS\View\Menu\MenuFactory();
$navbar = $factory->createItem('root'); $navbar->addChild('Native', ['label' => 'Native']);
foreach (['page', 'post'] as $type) {
    $newId = Capsule::table('zm_pb_pages')->insertGetId(['name' => 'New ' . $type, 'slug' => 'new-' . $type,
        'status' => 'publish', 'auth_type' => 'mixed', 'type' => $type, 'created_at' => '2099-01-01']);
    Capsule::table('zm_pb_pages_settings')->insert(['page_id' => $newId, 'lang' => 'english', 'lang_active' => true,
        'lang_status' => 'publish', 'settings' => json_encode(['breadcrumb' => 'Auto ' . $type])]);
}
$_SESSION = [];
if (ZM_PB_PRETTY_URLS) {
ZM_PB_Menu::apply($navbar, 'primary_navbar');
check(strpos($navbar->getChild('Native')->getClass(), 'native-hide-pc') !== false, 'Native mobile menu lost');
check(count($navbar->getChildren()) === 3, 'New page not auto-added or new post incorrectly auto-added');
foreach ($navbar->getChildren() as $child) {
    if (strpos($child->getName(), 'zmpb_menu_') === 0) check(strpos(' ' . $child->getClass() . ' ', ' no-collapse ') !== false,
        'Custom top-level menu item may be moved into More');
}
check(strpos(ZM_PB_Menu::assets(), 'Russian title') !== false, 'Deep rendering assets missing');
$sidebar = $factory->createItem('sidebar'); ZM_PB_Menu::apply($sidebar, 'primary_sidebar');
$panel = array_values($sidebar->getChildren())[0];
check(strpos($panel->getBodyHtml(), 'zm-pb-sidebar-menu') !== false, 'Sidebar body missing');
}
Capsule::connection()->enableQueryLog(); Capsule::connection()->flushQueryLog();
ZM_PB_Menu::apply($navbar, 'secondary_navbar');
check(!Capsule::connection()->getQueryLog(), 'Disabled location queried database');
$other = $input; $other['name'] = 'Other'; $other['locations'] = ['primary_navbar'];
$otherId = zm_pb_menu_save($other);
check(Capsule::table('zm_pb_menu_locations')->where('location', 'primary_navbar')->value('menu_id') === $otherId, 'Location transfer failed');
$broken = $input; $broken['menu_id'] = $menuId; $broken['items'] = '[{"key":"x","parent":"","type":"page","page_id":999,"label":""}]';
$blocked = false; try { zm_pb_menu_save($broken); } catch (InvalidArgumentException $e) { $blocked = true; }
check($blocked && Capsule::table('zm_pb_menu_items')->where('menu_id', $menuId)->count() === 3, 'Failed save damaged menu');
Capsule::statement("CREATE TEMP TRIGGER reject_menu_insert BEFORE INSERT ON zm_pb_menu_items BEGIN SELECT RAISE(ABORT, 'test write failure'); END");
$broken = $input; $broken['menu_id'] = $menuId; $broken['name'] = 'Must roll back';
$blocked = false; try { zm_pb_menu_save($broken); } catch (Throwable $error) { $blocked = true; }
Capsule::statement('DROP TRIGGER reject_menu_insert');
check($blocked && Capsule::table('zm_pb_menus')->where('id', $menuId)->value('name') === 'Main'
    && Capsule::table('zm_pb_menu_items')->where('menu_id', $menuId)->count() === 3, 'Database write failure lost saved menu');

// Compile and render the real administration template with all controls.
$smarty = new Smarty(); $smarty->setTemplateDir(ZM_PB_ROOTDIR . 'templates/'); $smarty->setCompileDir(sys_get_temp_dir() . '/zm-pb-menu-test-compiled');
$language = require ZM_PB_ROOTDIR . 'admin_lang/russian.php';
$smarty->assign(['menu_ready' => true, 'alertHtml' => '', 'menu_data' => $admin,
    'menu_editor_json' => '{}', 'page_assets' => '', 'menu_manager_translates' => $language->menu_manager,
    'module_translates' => $language->module, 'module_subpages' => ['menu_manager'], 'menuName' => 'menu_manager',
    'addonName' => ZM_PB_NAME, 'zm_pb_forms_nonce' => 'test', 'zm_pb_admin_nonce' => 'test']);
$rendered = $smarty->fetch('menu_manager.tpl');
check(strpos($rendered, 'zm-pb-menu-editor') !== false && strpos($rendered, 'name="device"') !== false, 'Admin template failed');
$smarty->assign('menu_ready', false);
$unavailable = $smarty->fetch('menu_manager.tpl');
check(strpos($unavailable, 'addonmodules.php?module=' . ZM_PB_NAME . '&amp;subpage=module_db') !== false
    && strpos($unavailable, '<form') === false, 'Missing tables must link to module_db without a creation form');
$smarty->assign('menu_ready', true);
if ($fixture = getenv('ZMPB_MENU_BROWSER_FIXTURE')) {
    $admin['pages']['page'][0]['name'] = 'English title';
    $state = ['items' => $admin['items'], 'pages' => $admin['pages'], 'languages' => array_keys(ZM_PB_LANGS),
        'languageLabels' => (array) $language->module->supported_langs->translate, 'text' => $language->menu_manager];
    $smarty->assign('menu_editor_json', json_encode($state, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT));
    $assetBase = 'file:///' . str_replace('\\', '/', ZM_PB_ASSETSDIR);
    $html = '<!doctype html><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">'
        . '<link rel="stylesheet" href="' . $assetBase . 'css/menu-manager.css">'
        . '<script src="file:///' . str_replace('\\', '/', ROOTDIR . '/assets/js/jquery.min.js') . '"></script>'
        . '<script>const csrfToken="test-token";window.confirm=()=>true;jQuery.growl={notice:()=>{},error:()=>{}};jQuery.ajax=(options)=>{window.captured=Object.fromEntries(options.data.entries());options.success({status:"error",title:"Test",message:"captured"});};</script>'
        . $smarty->fetch('menu_manager.tpl')
        . '<script src="' . $assetBase . 'js/sortablejs.js"></script><script src="' . $assetBase . 'js/menu-manager.js"></script><script src="' . $assetBase . 'js/main.js"></script>';
    file_put_contents($fixture, $html);
}
echo 'PASS menu schema, save, nesting, safe URLs, language URLs, auth, device visibility, real WHMCS navbar/sidebar, location transfer, atomic rejection, disabled queries, admin template (' . (ZM_PB_PRETTY_URLS ? 'pretty' : 'plain') . ")\n";
