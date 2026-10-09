<?php
/** PHP + SQLite + DOM + fileinfo; never connects to WHMCS or writes to its files. */
error_reporting(E_ALL & ~E_DEPRECATED);
use Illuminate\Database\Capsule\Manager as Capsule;
$module = dirname(__DIR__) . '/';
require dirname(__DIR__, 4) . '/vendor/autoload.php';
$root = sys_get_temp_dir() . '/zmpb-transfer-' . bin2hex(random_bytes(6));
foreach (['inc', 'assets/generated', 'attachments', 'templates/test'] as $dir) mkdir($root . '/' . $dir, 0755, true);
foreach (['transfer.php', 'menu_manager.php', 'sitemap_manager.php', 'redirects_manager.php', 'footer_menu.php'] as $file) copy($module . 'inc/' . $file, $root . '/inc/' . $file);
define('ZM_PB_VER', 'test'); define('ROOTDIR', $root); define('ZM_PB_NAME', 'zmchel_whmcs_multimodule');
define('ZM_PB_INCDIR', $root . '/inc/'); define('ZM_PB_LIBDIR', $module . 'lib/'); define('ZM_PB_ALANGDIR', $module . 'admin_lang/');
define('ZM_PB_ASSETSDIR', $root . '/assets/'); define('ZM_PB_FULLHOST', 'https://target.test/');
define('ZM_PB_ASSETSURL', ZM_PB_FULLHOST . 'modules/addons/zmchel_whmcs_multimodule/assets/');
define('ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR', $root . '/attachments/'); define('ZM_PB_MAINSYSTEM_ATTACHMENTS_URL', ZM_PB_FULLHOST . 'attachments/');
define('ZM_PB_MEDIA_MANAGER_FILE', $module . 'lib/media_manager.php');
define('ZM_PB_LANGS', require $module . 'supported_langs.php'); define('ZM_PB_DEFLANG', 'english');
define('ZM_PB_ADMINLANG', require ZM_PB_ALANGDIR . 'russian.php');
define('ZM_PB_ENABLE_LANG_ROUTE', true); define('ZM_PB_PRETTY_URLS', true); define('ZM_PB_MAINSYSTEM_PRETTY_URLS', true);
define('ZM_PB_ENABLE_PAGE_OVERRIDES', true); define('ZM_PB_ENABLE_REDIRECTS_MANAGER', true); define('ZM_PB_ENABLE_FOOTERMENU', true);
define('ZM_PB_MAINSYSTEM_DEFAULT_PAGES', ['index', 'contact']); define('ZM_PB_ACCEPTED_OVERRIDES', ['full']);
define('ZM_PB_ALLOWED_CONSTS_CHANGE', ['ZM_PB_ENABLE_PAGE_OVERRIDES']);
$GLOBALS['CONFIG']['Template'] = 'test';
file_put_contents($root . '/templates/test/footer.tpl', '<footer></footer>');
file_put_contents(ZM_PB_INCDIR . 'editable_consts.php', "<?php\n### EDITABLE CONSTS ###\nif (!defined('ZM_PB_ENABLE_PAGE_OVERRIDES')) define('ZM_PB_ENABLE_PAGE_OVERRIDES', true);\n### EDITABLE CONSTS ###\n");
file_put_contents(ZM_PB_INCDIR . 'rewrite_rules_custom.php', '<?php return [];');
file_put_contents(ZM_PB_INCDIR . 'rewrite_rules.php', '<?php return [];');
$capsule = new Capsule(); $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']); $capsule->setAsGlobal();
require $module . 'inc/helpers.php';
require $module . 'inc/menu_schema.php';
require $module . 'lib/transfer.php';
function check($ok, $message) { if (!$ok) throw new RuntimeException($message); }
function jsonData($data) { return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR); }
try {
    $fields = [
        'zm_pb_pages' => 'name slug auth_type status type template_file langs created_at updated_at',
        'zm_pb_pages_settings' => 'page_id lang lang_status lang_active settings content created_at updated_at',
        'zm_pb_sitemap' => 'page_id active url changefreq priority sitemap_type created_at updated_at',
        'zm_pb_module_settings' => 'type setting_name setting_storage_type setting_value',
        'zm_pb_redirects' => 'active from to status_code type method conditions created_at updated_at',
        'zm_pb_attachments' => 'name filename mime_type alt title description url sizes created_at updated_at',
    ];
    foreach ($fields as $table => $columns) Capsule::schema()->create($table, function ($t) use ($columns) {
        $t->increments('id'); foreach (explode(' ', $columns) as $column) $t->text($column)->nullable();
    });
    foreach (zm_pb_menu_table_definitions() as $create) $create();
    $page = ['id' => 3, 'name' => 'Test', 'slug' => 'test', 'auth_type' => 'mixed', 'status' => 'publish', 'type' => 'page', 'langs' => '["english"]'];
    Capsule::table('zm_pb_pages')->insert($page);
    $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+jRZkAAAAASUVORK5CYII=');
    file_put_contents(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR . 'test.png', $png);
    Capsule::table('zm_pb_attachments')->insert(['filename' => 'test.png', 'name' => 'Test image', 'url' => ZM_PB_MAINSYSTEM_ATTACHMENTS_URL . 'test.png', 'sizes' => '{}']);
    $content = jsonData(['format' => 'grapesjs', 'html' => '<img src="https://target.test/attachments/test.png">',
        'project' => ['pages' => []], 'css' => 'p{color:red}', 'code' => [['id' => 'code_test', 'type' => 'js', 'code' => 'window.test=1;']]]);
    $saved = zm_pb_save_grapes_content(3, 'english', $content);
    Capsule::table('zm_pb_pages_settings')->insert(['page_id' => 3, 'lang' => 'english', 'lang_status' => 'draft', 'lang_active' => 1, 'content' => $saved]);
    Capsule::table('zm_pb_sitemap')->insert(['page_id' => 3, 'active' => 1, 'url' => ZM_PB_FULLHOST . 'test', 'changefreq' => 'daily', 'priority' => '0.7', 'sitemap_type' => 'page']);
    Capsule::table('zm_pb_module_settings')->insert(['setting_name' => 'page_overrides', 'type' => 'required', 'setting_storage_type' => 'json',
        'setting_value' => jsonData(['from' => ['contact'], 'to' => ['test'], 'type' => ['full']])]);
    require ZM_PB_INCDIR . 'menu_manager.php';
    zm_pb_menu_save(['name' => 'Main', 'mode' => 'replace', 'device' => 'mixed', 'active' => 1, 'locations' => ['primary_navbar'],
        'items' => jsonData([['key' => 'root', 'parent' => '', 'type' => 'page', 'page_id' => 3, 'url' => ZM_PB_FULLHOST . 'test'],
            ['key' => 'child', 'parent' => 'root', 'type' => 'custom', 'label' => 'External', 'url' => 'https://external.test/']])]);
    Capsule::table('zm_pb_redirects')->insert(['from' => '/old', 'to' => ZM_PB_FULLHOST . 'test/', 'active' => 1, 'status_code' => 301, 'type' => 'system', 'method' => 'GET', 'conditions' => jsonData(['page_id' => 3, 'language' => 'english'])]);
    $sections = ['pages', 'menus', 'settings', 'redirects', 'rewrites', 'media'];
    $archive = ZM_PB_Transfer::export($sections);
    $decoded = json_decode($archive, true, 512, JSON_THROW_ON_ERROR);
    $portable = json_decode($decoded['sections']['pages'][0]['translations'][0]['content'], true);
    check($portable['css'] === 'p{color:red}' && $portable['code'][0]['code'] === 'window.test=1;', 'Generated code omitted');
    check(array_keys(json_decode(ZM_PB_Transfer::export(['menus']), true)['sections']) === ['menus'], 'Selective export leaked sections');
    // A different installation already uses the old numeric ID for an unrelated page.
    Capsule::table('zm_pb_pages')->where('id', 3)->update(['slug' => 'unrelated']);
    Capsule::table('zm_pb_menu_items')->delete(); Capsule::table('zm_pb_menu_locations')->delete(); Capsule::table('zm_pb_menus')->delete();
    Capsule::table('zm_pb_redirects')->delete();
    $archive = str_replace('https://target.test/', 'https://source.test/', $archive);
    $counts = ZM_PB_Transfer::import($archive, $sections);
    $newId = Capsule::table('zm_pb_pages')->where('slug', 'test')->value('id');
    check($newId && (int) $newId !== 3, 'ID collision not remapped');
    check((int) Capsule::table('zm_pb_menu_items')->where('type', 'page')->value('page_id') === (int) $newId, 'Menu page reference broken');
    check((int) Capsule::table('zm_pb_menu_items')->where('type', 'custom')->value('parent_id') === (int) Capsule::table('zm_pb_menu_items')->where('type', 'page')->value('id'), 'Menu tree broken');
    $imported = json_decode(Capsule::table('zm_pb_pages_settings')->where('page_id', $newId)->value('content'), true);
    check(strpos($imported['html'], 'https://target.test/attachments/test.png') !== false, 'Media URL not localized');
    check(strpos($imported['cssUrl'], 'page_' . $newId . '_english_styles.css') !== false, 'CSS still uses source page ID');
    check(Capsule::table('zm_pb_attachments')->count() === 1, 'Same media duplicated');
    ZM_PB_Transfer::import($archive, $sections);
    check(Capsule::table('zm_pb_pages')->count() === 2 && Capsule::table('zm_pb_menus')->count() === 1, 'Repeated import duplicated entities');
    $beforeCss = file_get_contents(ZM_PB_ASSETSDIR . 'generated/page_' . $newId . '_english_styles.css');
    $bad = json_decode($archive, true);
    $project = json_decode($bad['sections']['pages'][0]['translations'][0]['content'], true); $project['css'] = 'p{color:blue}';
    $bad['sections']['pages'][0]['translations'][0]['content'] = jsonData($project);
    $bad['sections']['menus'][0]['items'][0]['page_id'] = 9999;
    $failed = false;
    try { ZM_PB_Transfer::import(jsonData($bad), ['pages', 'menus']); } catch (RuntimeException $error) { $failed = true; }
    check($failed && file_get_contents(ZM_PB_ASSETSDIR . 'generated/page_' . $newId . '_english_styles.css') === $beforeCss, 'Failed import did not roll back asset overwrite');
    $restored = json_decode(Capsule::table('zm_pb_pages_settings')->where('page_id', $newId)->value('content'), true);
    check($restored === $imported, 'Failed import did not roll back database');
    $bad = json_decode($archive, true); $bad['sections']['media'][0]['filename'] = '../configuration.php';
    $failed = false; try { ZM_PB_Transfer::import(jsonData($bad), ['media']); } catch (RuntimeException $error) { $failed = true; }
    check($failed, 'Media path traversal accepted');
    $partial = json_decode(ZM_PB_Transfer::export(['pages']), true);
    check(array_keys(ZM_PB_Transfer::import(jsonData($partial), $sections)) === ['pages'], 'Absent sections not skipped');
    $settingsPath = ZM_PB_INCDIR . 'editable_consts.php';
    $settingsBefore = file_get_contents($settingsPath);
    $result = zm_pb_update_consts_in_file(['ZM_PB_ENABLE_PAGE_OVERRIDES' => false, 'ZM_PB_UNDECLARED' => true], true);
    check(($result['status'] ?? '') === 'error' && file_get_contents($settingsPath) === $settingsBefore, 'Strict settings update wrote only some constants');
    $bad = json_decode($archive, true); $bad['source_url'] = 'ftp://source.test/';
    $failed = false; try { ZM_PB_Transfer::import(jsonData($bad), ['pages']); } catch (RuntimeException $error) { $failed = true; }
    check($failed, 'Non-HTTP source URL accepted');
    echo "PASS transfer selection, assets, URL/ID remapping, media, repeated import, rollback and traversal rejection\n";
} finally {
    $real = realpath($root); $temp = realpath(sys_get_temp_dir());
    if (!$real || !$temp || strpos($real, $temp . DIRECTORY_SEPARATOR . 'zmpb-transfer-') !== 0) throw new RuntimeException('Unsafe cleanup path');
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $file) {
        if ($file->isDir()) rmdir($file->getPathname()); else unlink($file->getPathname());
    }
    rmdir($root);
}
