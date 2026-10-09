<?php
/** Uses SQLite in memory and a random temporary site root. Never loads WHMCS configuration. */
error_reporting(E_ALL & ~E_DEPRECATED);
$module = dirname(__DIR__) . '/';
require dirname(__DIR__, 4) . '/vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
function check($condition, $message) { if (!$condition) throw new RuntimeException($message); }
function add_hook($name, $priority, $callback) { $GLOBALS['testHooks'][$name][$priority][] = $callback; }
$testRoot = sys_get_temp_dir() . '/zmpb-sitemap-test-' . bin2hex(random_bytes(6));
mkdir($testRoot . '/inc', 0755, true);
copy($module . 'inc/sitemap_manager.php', $testRoot . '/inc/sitemap_manager.php');
copy($module . 'inc/redirects_manager.php', $testRoot . '/inc/redirects_manager.php');
file_put_contents($testRoot . '/inc/editable_consts.php', "<?php\n### EDITABLE CONSTS ###\nif (!defined('ZM_PB_SITEMAP_LASTUPD')) define('ZM_PB_SITEMAP_LASTUPD', '');\n### EDITABLE CONSTS ###\n");
define('WHMCS', true); define('ZM_PB_VER', 'test'); define('ZM_PB_SUPERADM_ID', 1);
define('ROOTDIR', $testRoot); define('ZM_PB_INCDIR', $testRoot . '/inc/');
define('ZM_PB_LIBDIR', $module . 'lib/'); define('ZM_PB_ALANGDIR', $module . 'admin_lang/');
define('ZM_PB_RESOURCESDIR', $testRoot . '/resources/');
define('ZM_PB_NAME', 'zmchel_whmcs_multimodule'); define('ZM_PB_FULLHOST', 'https://example.test/billing/');
define('ZM_PB_DEFLANG', 'english'); define('ZM_PB_SITEMAP_LASTUPD', ''); define('ZM_PB_SITEMAP_UPDFREQ', '');
define('ZM_PB_ALLOWED_CONSTS_CHANGE', ['ZM_PB_SITEMAP_LASTUPD']);
define('ZM_PB_ENABLE_SITEMAP', !in_array('--disabled', $argv, true));
define('ZM_PB_ENABLE_REDIRECTS_MANAGER', true);
define('ZM_PB_PRETTY_URLS', !in_array('--plain', $argv, true));
define('ZM_PB_MAINSYSTEM_PRETTY_URLS', ZM_PB_PRETTY_URLS);
define('ZM_PB_ENABLE_LANG_ROUTE', !in_array('--routes-off', $argv, true));
define('ZM_PB_ENABLE_PAGE_OVERRIDES', !in_array('--overrides-off', $argv, true));
define('ZM_PB_MAINSYSTEM_DEFAULT_PAGES', ['index', 'contact', 'announcements', 'knowledgebase']);
define('ZM_PB_ACCEPTED_OVERRIDES', ['full', 'partial_before', 'partial_after', 'meta_only', 'partial_before_meta', 'partial_after_meta']);
define('ZM_PB_LANGS', [
    'english' => ['code_lower' => 'en', 'code_ISO639_1' => 'en'],
    'russian' => ['code_lower' => 'ru', 'code_ISO639_1' => 'ru'],
    'german' => ['code_lower' => 'de', 'code_ISO639_1' => 'de'],
    'ukranian' => ['code_lower' => 'uk', 'code_ISO639_1' => 'uk'],
]);
define('ZM_PB_ADMINLANG', require $module . 'admin_lang/russian.php');
require $module . 'inc/helpers.php';
require ZM_PB_LIBDIR . 'sitemap.php';
$capsule = new Capsule(); $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '']); $capsule->setAsGlobal();
$capsule->getConnection()->enableQueryLog();
$testHooks = [];
require $module . 'hooks/sitemap.php';

function locations($xml, $root = 'urlset') {
    $doc = new DOMDocument(); check($doc->loadXML($xml, LIBXML_NONET), 'Invalid generated XML');
    check($doc->documentElement->localName === $root, 'Wrong sitemap document type');
    check($doc->documentElement->namespaceURI === 'http://www.sitemaps.org/schemas/sitemap/0.9', 'Missing sitemap namespace');
    $xpath = new DOMXPath($doc); $xpath->registerNamespace('s', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    return array_map(function ($node) { return $node->textContent; }, iterator_to_array($xpath->query('//s:loc')));
}
function siteFiles() {
    $hashes = []; foreach (glob(ROOTDIR . '/*.xml') ?: [] as $path) $hashes[basename($path)] = hash_file('sha256', $path);
    ksort($hashes); return $hashes;
}
try {
    check(zm_pb_sitemap_interval('') === 86400 && zm_pb_sitemap_interval('unknown') === 86400, 'Daily default broken');
    foreach (['every_hour' => 3600, 'every_3hour' => 10800, 'every_6hour' => 21600, 'every_12hour' => 43200,
        'every_day' => 86400, 'every_2day' => 172800, 'every_3day' => 259200, 'every_week' => 604800, 'every_month' => 2592000] as $key => $seconds) {
        check(zm_pb_sitemap_interval($key) === $seconds, 'Wrong schedule interval');
    }
    if (!ZM_PB_ENABLE_SITEMAP) {
        check(ZM_PB_Sitemap::generate()['status'] === 'disabled' && ZM_PB_Sitemap::generate(true)['status'] === 'disabled', 'Disabled generator ran');
        check(!$testHooks && !zm_pb_sitemap_due() && !Capsule::connection()->getQueryLog() && !siteFiles(), 'Disabled sitemap accessed DB, files, or registered cron');
        echo "PASS sitemap disabled: no cron hook, database queries, or generated files, including forced generation\n";
    } else {
        check(isset($testHooks['AfterCronJob'][9999]) && zm_pb_sitemap_due(), 'AfterCronJob or first generation missing');
        Capsule::schema()->create('zm_pb_module_settings', function ($t) { $t->increments('id'); $t->string('setting_name'); $t->text('setting_value'); });
        Capsule::schema()->create('zm_pb_redirects', function ($t) {
            $t->increments('id'); $t->boolean('active'); $t->string('from'); $t->string('to'); $t->integer('status_code'); $t->string('method');
        });
        Capsule::schema()->create('zm_pb_pages', function ($t) {
            $t->increments('id'); foreach (['slug', 'status', 'type', 'auth_type', 'created_at', 'updated_at'] as $key) $t->string($key);
        });
        Capsule::schema()->create('zm_pb_pages_settings', function ($t) {
            $t->increments('id'); $t->integer('page_id'); $t->string('lang'); $t->boolean('lang_active');
            foreach (['lang_status', 'created_at', 'updated_at'] as $key) $t->string($key);
        });
        Capsule::schema()->create('zm_pb_sitemap', function ($t) {
            $t->increments('id'); $t->integer('page_id'); $t->boolean('active'); $t->string('url'); $t->string('changefreq'); $t->float('priority');
        });
        // Helpers cache schema existence; all fixtures are now ready.
        $GLOBALS['_pb_table_cache'] = [];
        function page($slug, $options = []) {
            $id = Capsule::table('zm_pb_pages')->insertGetId(['slug' => $slug, 'status' => $options['status'] ?? 'publish',
                'type' => $options['type'] ?? 'page', 'auth_type' => $options['auth'] ?? 'mixed',
                'created_at' => '2026-01-01 00:00:00', 'updated_at' => '2026-02-01 00:00:00']);
            Capsule::table('zm_pb_sitemap')->insert(['page_id' => $id, 'active' => $options['active'] ?? true,
                'url' => $options['url'] ?? ZM_PB_FULLHOST . $slug, 'changefreq' => 'weekly', 'priority' => 0.7]);
            foreach (['english', 'russian'] as $lang) Capsule::table('zm_pb_pages_settings')->insert(['page_id' => $id,
                'lang' => $lang, 'lang_active' => $lang === 'russian' ? ($options['russian_active'] ?? true) : true,
                // Production editor does not publish lang_status; only page.status is published.
                'lang_status' => 'draft',
                'created_at' => '2026-01-01 00:00:00', 'updated_at' => $lang === 'russian' ? '2026-03-01 00:00:00' : '2026-02-01 00:00:00']);
            return $id;
        }
        $aboutId = page('about'); page('news', ['type' => 'post']); page('homepage-layout'); page('english-only', ['russian_active' => false]);
        Capsule::table('zm_pb_pages_settings')->insert(['page_id' => $aboutId, 'lang' => 'ukranian', 'lang_active' => true,
            'lang_status' => 'draft', 'created_at' => '2026-01-01 00:00:00', 'updated_at' => '2026-03-01 00:00:00']);
        page('docs/installation');
        $fallbackId = page('fallback');
        Capsule::table('zm_pb_pages_settings')->where('page_id', $fallbackId)->where('lang', 'english')->delete();
        page('redirected-page');
        Capsule::table('zm_pb_redirects')->insert(['active' => true, 'from' => zm_pb_sitemap_url('redirected-page', 'english'),
            'to' => zm_pb_sitemap_url('about', 'english'), 'status_code' => 301, 'method' => 'GET']);
        page('private', ['auth' => 'auth']); page('draft', ['status' => 'draft']); page('disabled-page', ['active' => false]);
        page('system-page', ['type' => 'system']); page('custom', ['url' => ZM_PB_FULLHOST . 'offer?a=1&b=2']);
        page('external', ['url' => 'https://external.test/page']);
        page('duplicate', ['url' => ZM_PB_FULLHOST . 'offer?a=1&b=2']);
        Capsule::table('zm_pb_module_settings')->insert(['setting_name' => 'page_overrides', 'setting_value' => json_encode([
            'from' => ['index', 'contact'], 'to' => ['homepage-layout', 'homepage-layout'], 'type' => ['full', 'partial_before_meta']])]);
        $groups = ZM_PB_Sitemap::entries(); $urls = array_column(array_merge($groups['pages'], $groups['posts']), 'url');
        check(!in_array(zm_pb_sitemap_url('redirected-page', 'english'), $urls, true), 'Redirecting URL leaked into sitemap');
        foreach (array_merge($groups['pages'], $groups['posts']) as $entry) {
            if ($entry['page_id'] === $fallbackId) check(!isset($entry['alternates']['en']) && isset($entry['alternates']['ru']), 'Fallback advertised as missing English translation');
            check(!isset($entry['alternates']['de']), 'Unavailable German translation advertised');
            check(in_array($entry['url'], $entry['alternates'], true), 'Missing self-reference');
            foreach ($entry['alternates'] as $alternate) check(in_array($alternate, $urls, true), 'Alternate not included in sitemap');
            if (strpos($entry['url'], 'english-only') !== false) check(!isset($entry['alternates']['ru']), 'Inactive translation advertised');
        }
        check(in_array(zm_pb_sitemap_url('about', 'english'), $urls, true), 'Published page with default draft lang_status was omitted');
        check(count($groups['posts']) > 0, 'Published article with default draft lang_status was omitted');
        check(!array_filter($groups['pages'], function ($entry) {
            return strpos($entry['url'], 'english-only') !== false && $entry['lang'] === 'russian';
        }), 'Inactive translation leaked into sitemap');
        foreach (['private', 'draft', 'disabled-page', 'system-page', 'external'] as $denied) {
            check(!array_filter($urls, function ($url) use ($denied) { return strpos($url, $denied) !== false; }), 'Excluded page leaked');
        }
        check(count($urls) === count(array_unique($urls)), 'Duplicate URL included');
        check(!array_filter($urls, function ($url) { return strpos($url, '/en/') !== false || strpos($url, 'language=') !== false; }), 'Default prefix or profile-switch URL included');
        if (ZM_PB_ENABLE_PAGE_OVERRIDES) {
            check(!array_filter($urls, function ($url) { return strpos($url, 'homepage-layout') !== false; }), 'Override target URL leaked');
            check(in_array(ZM_PB_FULLHOST . (ZM_PB_MAINSYSTEM_PRETTY_URLS ? '' : 'index.php'), $urls, true), 'Override homepage source missing');
            check(in_array(ZM_PB_FULLHOST . 'contact' . (ZM_PB_MAINSYSTEM_PRETTY_URLS ? '/' : '.php'), $urls, true), 'Second override of same target missing');
        } else { check(in_array(zm_pb_sitemap_url('homepage-layout', 'english'), $urls, true), 'Disabled overrides still replaced URLs'); }
        check(in_array(ZM_PB_FULLHOST . 'offer?a=1&b=2', $urls, true), 'Custom URL lost');
        check(in_array(ZM_PB_PRETTY_URLS ? ZM_PB_FULLHOST . 'docs/installation/' : ZM_PB_FULLHOST . 'index.php?m=zmchel_whmcs_multimodule&slug=docs%2Finstallation', $urls, true), 'Nested slug URL is invalid');
        $hasRussian = (bool) array_filter($urls, function ($url) { return strpos($url, '/ru/') !== false || strpos($url, '&lang=ru') !== false; });
        check($hasRussian === ZM_PB_ENABLE_LANG_ROUTE, 'Language route setting ignored');
        $foreignXml = '<?xml version="1.0"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>https://example.test/billing/</loc></url></urlset>';
        file_put_contents(ROOTDIR . '/sitemap.xml', $foreignXml);
        file_put_contents(ROOTDIR . '/sitemap_domains.xml', $foreignXml);
        file_put_contents(ROOTDIR . '/products-sitemap.xml', $foreignXml);
        file_put_contents(ROOTDIR . '/sitemap_posts_2.xml', $foreignXml);
        file_put_contents(ROOTDIR . '/sitemap_other_index.xml', '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');
        file_put_contents(ROOTDIR . '/sitemap_invalid.xml', 'not XML');
        file_put_contents(ROOTDIR . '/sitemap_entity.xml', '<!DOCTYPE urlset [<!ENTITY x SYSTEM "file:///etc/passwd">]><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>&x;</loc></url></urlset>');
        $foreignHash = hash_file('sha256', ROOTDIR . '/sitemap_domains.xml');
        foreach ($testHooks['AfterCronJob'][9999] as $hook) $hook([]);
        check(is_file(ROOTDIR . '/sitemap_index.xml') && zm_pb_sitemap_last_update() >= time() - 10, 'Cron did not persist successful generation');
        $index = locations(file_get_contents(ROOTDIR . '/sitemap_index.xml'), 'sitemapindex');
        foreach (['sitemap.xml', 'sitemap_domains.xml', 'products-sitemap.xml', 'sitemap_pages.xml', 'sitemap_posts.xml'] as $name) check(in_array(ZM_PB_FULLHOST . $name, $index, true), 'Missing file in index: ' . $name);
        foreach (['sitemap_index.xml', 'sitemap_other_index.xml', 'sitemap_invalid.xml', 'sitemap_entity.xml', 'sitemap_posts_2.xml'] as $name) check(!in_array(ZM_PB_FULLHOST . $name, $index, true), 'Invalid, recursive, or obsolete index entry');
        check(!is_file(ROOTDIR . '/sitemap_posts_2.xml') && hash_file('sha256', ROOTDIR . '/sitemap_domains.xml') === $foreignHash, 'Cleanup changed another generator file');
        $pageXml = file_get_contents(ROOTDIR . '/sitemap_pages.xml'); $postXml = file_get_contents(ROOTDIR . '/sitemap_posts.xml');
        check(locations($pageXml) === array_column($groups['pages'], 'url') && locations($postXml) === array_column($groups['posts'], 'url'), 'XML entries differ from manager preview');
        $doc = new DOMDocument(); $doc->loadXML($pageXml, LIBXML_NONET);
        $xpath = new DOMXPath($doc); $xpath->registerNamespace('s', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xpath->registerNamespace('x', 'http://www.w3.org/1999/xhtml');
        check($doc->documentElement->getAttribute('xmlns:xhtml') === 'http://www.w3.org/1999/xhtml', 'Missing XHTML namespace');
        $byUrl = [];
        foreach ($xpath->query('/s:urlset/s:url') as $node) {
            $loc = $xpath->evaluate('string(s:loc)', $node); $links = [];
            foreach ($xpath->query('x:link', $node) as $link) {
                check($link->getAttribute('rel') === 'alternate', 'Wrong alternate rel');
                $links[$link->getAttribute('hreflang')] = $link->getAttribute('href');
            }
            $byUrl[$loc] = $links;
        }
        foreach ($byUrl as $loc => $links) foreach ($links as $url) check(($byUrl[$url] ?? null) === $links, 'Nonreciprocal alternate group: ' . $loc);
        $about = zm_pb_sitemap_url('about', 'english');
        check($byUrl[$about]['x-default'] === $about && $byUrl[$about]['en'] === $about, 'Default language prefix/fallback broken');
        if (ZM_PB_ENABLE_LANG_ROUTE) {
            check(($byUrl[$about]['uk'] ?? null) === zm_pb_sitemap_url('about', 'ukranian')
                && strpos($byUrl[$about]['uk'], ZM_PB_PRETTY_URLS ? '/uk/' : 'lang=uk') !== false
                && !isset($byUrl[$about]['ua']),
                'Ukrainian URL and hreflang must use uk');
        }
        if (ZM_PB_ENABLE_PAGE_OVERRIDES) {
            $contact = zm_pb_sitemap_url('homepage-layout', 'english', 'contact');
            check($byUrl[$contact]['x-default'] === $contact, 'Contact grouped with homepage translations');
        }
        check(strpos($pageXml, 'a=1&amp;b=2') !== false && strpos($pageXml, '2026-02-01T00:00:00') !== false, 'XML escaping or content lastmod broken');
        $last = zm_pb_sitemap_last_update(); check(!zm_pb_sitemap_due($last + 86399) && zm_pb_sitemap_due($last + 86400), 'Interval deadline broken');
        $before = siteFiles(); Capsule::connection()->flushQueryLog();
        foreach ($testHooks['AfterCronJob'][9999] as $hook) $hook([]);
        check(siteFiles() === $before && !Capsule::connection()->getQueryLog(), 'Cron regenerated too early');
        check(ZM_PB_Sitemap::generate(true)['status'] === 'success', 'Manual regeneration did not bypass schedule');
        $last = zm_pb_sitemap_last_update();
        $lock = fopen(ZM_PB_RESOURCESDIR . 'sitemap.lock', 'c'); flock($lock, LOCK_EX);
        try { check(ZM_PB_Sitemap::generate(true)['status'] === 'busy', 'Concurrent generation did not respect lock'); }
        finally { flock($lock, LOCK_UN); fclose($lock); }
        $before = siteFiles(); $settingsSource = file_get_contents(ZM_PB_INCDIR . 'editable_consts.php');
        file_put_contents(ZM_PB_INCDIR . 'editable_consts.php', '<?php /* cannot persist timestamp */');
        $blocked = false; try { ZM_PB_Sitemap::generate(true); } catch (RuntimeException $error) { $blocked = $error->getMessage() === 'settings_not_writable'; }
        file_put_contents(ZM_PB_INCDIR . 'editable_consts.php', $settingsSource);
        check($blocked && siteFiles() === $before && zm_pb_sitemap_last_update() === $last, 'Failed timestamp update did not restore prior sitemaps');
        check(!(glob(ROOTDIR . '/.zmpb-*') ?: []), 'Staged XML or backup files leaked');
        $smarty = new Smarty(); $smarty->setTemplateDir($module . 'templates/');
        mkdir(ROOTDIR . '/compiled'); $smarty->setCompileDir(ROOTDIR . '/compiled');
        $language = ZM_PB_ADMINLANG;
        $smarty->assign(['module_translates' => $language->module, 'sitemap_translates' => $language->pages_manager,
            'sitemap_manager_translates' => $language->sitemap_manager, 'other_translates' => $language->other,
            'module_subpages' => ['sitemap_manager'], 'menuName' => 'sitemap_manager', 'addonName' => ZM_PB_NAME,
            'alertHtml' => '', 'sitemap_status' => zm_pb_sitemap_status(), 'sitemap_ready' => true, 'elements_list' => array_merge($groups['pages'], $groups['posts']),
            'zm_pb_forms_nonce' => 'test', 'zm_pb_admin_nonce' => 'test', 'page_assets' => '']);
        $rendered = $smarty->fetch('sitemap_manager.tpl');
        check(strpos($rendered, 'value="generate_sitemaps"') !== false && strpos($rendered, 'sitemap_domains.xml') !== false, 'Manager controls or file list missing');
        check(strpos($rendered, 'href="https://example.test/billing/offer?a=1&amp;b=2"') !== false, 'Visit link is invalid');
        if (in_array('--limits', $argv, true)) {
            $documents = ZM_PB_Sitemap::documents(['pages' => array_fill(0, 50001, $groups['pages'][0])]);
            check(count($documents) === 2 && substr_count($documents['sitemap_pages.xml'], '<url>') === 50000
                && substr_count($documents['sitemap_pages_2.xml'], '<url>') === 1, 'Protocol URL limit not enforced');
        }
        echo 'PASS sitemap cron/manual, interval, persisted timestamp, overrides, translations, publication/auth, XML, root index discovery, file ownership, lock, rollback, manager ('
            . (ZM_PB_PRETTY_URLS ? 'pretty' : 'plain') . ', routes ' . (ZM_PB_ENABLE_LANG_ROUTE ? 'on' : 'off') . ', overrides ' . (ZM_PB_ENABLE_PAGE_OVERRIDES ? 'on' : 'off') . ")\n";
    }
} finally {
    // Remove only the exact random temporary tree created by this test.
    $resolved = realpath($testRoot);
    $temporaryRoot = realpath(sys_get_temp_dir());
    if ($resolved === false || $temporaryRoot === false
        || strpos($resolved, $temporaryRoot . DIRECTORY_SEPARATOR . 'zmpb-sitemap-test-') !== 0) {
        throw new RuntimeException('Refusing to clean up outside the temporary sitemap fixture');
    }
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($testRoot, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($iterator as $file) { if ($file->isDir()) rmdir($file->getPathname()); else unlink($file->getPathname()); }
    rmdir($testRoot);
}
