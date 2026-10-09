<?php
/** PHP + pdo_sqlite. In-memory fixtures only; never loads WHMCS configuration. */
error_reporting(E_ALL & ~E_DEPRECATED);
use Illuminate\Database\Capsule\Manager as Capsule;
$module = dirname(__DIR__) . '/';
require dirname(__DIR__, 4) . '/vendor/autoload.php';
define('ZM_PB_VER', 'test'); define('ZM_PB_NAME', 'zmchel_whmcs_multimodule');
define('ZM_PB_INCDIR', $module . 'inc/'); define('ZM_PB_ALANGDIR', $module . 'admin_lang/');
define('ZM_PB_FULLHOST', 'https://example.test/billing/'); define('ZM_PB_DEFLANG', 'english');
define('ZM_PB_LANGS', ['english' => ['code_lower' => 'en'], 'russian' => ['code_lower' => 'ru']]);
define('ZM_PB_ENABLE_PAGE_OVERRIDES', true); define('ZM_PB_ENABLE_LANG_ROUTE', !in_array('--routes-off', $argv, true));
define('ZM_PB_PRETTY_URLS', !in_array('--plain', $argv, true)); define('ZM_PB_MAINSYSTEM_PRETTY_URLS', ZM_PB_PRETTY_URLS);
define('ZM_PB_ENABLE_REDIRECTS_MANAGER', !in_array('--disabled', $argv, true));
define('ZM_PB_AUTO_REDIRECTS', !in_array('--auto-off', $argv, true)); define('ZM_PB_AUTO_REDIRECT_DAYS', 14);
define('ZM_PB_MAINSYSTEM_DEFAULT_PAGES', ['index', 'contact']); define('ZM_PB_ACCEPTED_OVERRIDES', ['full', 'meta_only', 'partial_after']);
define('ZM_PB_ADMINLANG', require ZM_PB_ALANGDIR . 'russian.php');
$capsule = new Capsule(); $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']); $capsule->setAsGlobal();
require $module . 'inc/helpers.php';
require $module . 'lib/redirects.php';
function check($condition, $message) { if (!$condition) throw new RuntimeException($message); }
function rejects($callback, $key) {
    try { $callback(); } catch (InvalidArgumentException $e) { check($e->getMessage() === $key, 'Wrong rejection: ' . $e->getMessage()); return; }
    throw new RuntimeException('Expected rejection: ' . $key);
}
Capsule::schema()->create('zm_pb_redirects', function ($t) {
    $t->increments('id'); $t->boolean('active'); $t->string('from', 128); $t->string('to', 128);
    $t->integer('status_code'); $t->string('type'); $t->string('method'); $t->text('conditions')->nullable();
    $t->timestamps(); $t->unique(['from', 'method']);
});
Capsule::schema()->create('zm_pb_module_settings', function ($t) { $t->string('setting_name'); $t->text('setting_value'); });
Capsule::schema()->create('zm_pb_pages_settings', function ($t) {
    $t->increments('id'); $t->integer('page_id'); $t->string('lang'); $t->boolean('lang_active'); $t->timestamps();
});
$config = ['from' => ['contact'], 'to' => ['contacts-layout'], 'type' => ['partial_after']];
Capsule::table('zm_pb_module_settings')->insert(['setting_name' => 'page_overrides', 'setting_value' => json_encode($config)]);
$override = zm_pb_redirect_overrides();
$englishAlias = zm_pb_sitemap_url('contacts-layout', 'english');
$contact = zm_pb_sitemap_url('contacts-layout', 'english', 'contact');
check(zm_pb_redirect_resolve($englishAlias, [], $override) === ['url' => $contact, 'status' => 301], 'Override alias not redirected');
check(zm_pb_redirect_resolve($contact, [], $override) === null, 'Native address redirects to itself');
check(zm_pb_redirect_override_target('/billing/contact/', ['contact' => ['contact']]) === null, 'Matching slug loop');
if (ZM_PB_ENABLE_LANG_ROUTE && ZM_PB_PRETTY_URLS) {
    check(zm_pb_redirect_resolve('/billing/ru/contacts-layout/', [], $override)['url'] === 'https://example.test/billing/ru/contact/', 'Override language lost');
}
$id = zm_pb_redirect_save(['from' => '/billing/old/', 'to' => '/billing/new/?a=1&amp;b=2', 'status_code' => 302, 'active' => 1]);
check(Capsule::table('zm_pb_redirects')->where('id', $id)->value('to') === '/billing/new/?a=1&b=2', 'Ampersand corrupted');
check((bool) zm_pb_redirect_rules() === ZM_PB_ENABLE_REDIRECTS_MANAGER, 'Manager off setting ignored');
$rules = Capsule::table('zm_pb_redirects')->get()->all();
check(zm_pb_redirect_resolve('/billing/old/?tracking=abc', $rules, []) === ['url' => 'https://example.test/billing/new/?a=1&b=2', 'status' => 302], 'Path matching or destination query broken');
rejects(function () { zm_pb_redirect_save(['from' => 'https://example.test/billing/old', 'to' => '/other']); }, 'duplicate');
rejects(function () { zm_pb_redirect_save(['from' => '/same', 'to' => '/same/']); }, 'redirect_loop');
rejects(function () { zm_pb_redirect_save(['from' => '/billing/new', 'to' => '/billing/old', 'active' => 1]); }, 'redirect_loop');
rejects(function () use ($contact, $englishAlias) { zm_pb_redirect_save(['from' => $contact, 'to' => $englishAlias, 'active' => 1]); }, 'redirect_loop');
foreach (['//evil.test/', 'https://evil.test/', '/bad%0d%0aLocation:test', 'http:/broken'] as $url) {
    rejects(function () use ($url) { zm_pb_redirect_url($url, true); }, 'invalid_url');
}
check(zm_pb_redirect_url('/billing/path?text=hello%20world') === '/billing/path?text=hello%20world', 'Encoded spaces rejected');
$specific = (object) ['from' => '/billing/old?tracking=special', 'to' => '/billing/special/', 'status_code' => 307];
check(zm_pb_redirect_resolve('/billing/old/?tracking=special', array_merge($rules, [$specific]), [])['status'] === 307, 'Query-specific rule lost to path rule');
Capsule::table('zm_pb_redirects')->delete();
$old = date('Y-m-d H:i:s', time() - 15 * 86400);
$page = (object) ['id' => 10, 'slug' => 'first', 'status' => 'publish', 'created_at' => $old, 'updated_at' => $old];
foreach (['english', 'russian'] as $lang) Capsule::table('zm_pb_pages_settings')->insert(['page_id' => 10, 'lang' => $lang, 'lang_active' => true, 'created_at' => $old, 'updated_at' => $old]);
Capsule::connection()->transaction(function () use ($page) { zm_pb_redirect_page_change($page, 'second', 'publish'); });
$shouldAuto = ZM_PB_AUTO_REDIRECTS && ZM_PB_ENABLE_REDIRECTS_MANAGER;
check(Capsule::table('zm_pb_redirects')->count() === ($shouldAuto ? (ZM_PB_ENABLE_LANG_ROUTE ? 2 : 1) : 0), 'Age/config/language gate broken');
if ($shouldAuto) {
    $page->slug = 'second'; $page->updated_at = date('Y-m-d H:i:s');
    zm_pb_redirect_page_change($page, 'third', 'publish');
    foreach (Capsule::table('zm_pb_redirects')->get() as $rule) check(strpos($rule->to, 'third') !== false, 'Historical redirect was not repointed');
    check(!Capsule::table('zm_pb_redirects')->where('from', zm_pb_redirect_url(zm_pb_sitemap_url('second', 'english'), true))->exists(), 'Recent page created automatic redirect');
    $page->slug = 'third'; zm_pb_redirect_page_change($page, 'first', 'publish');
    check(Capsule::table('zm_pb_redirects')->count() === 0, 'Reverting slug left a self redirect');
}
$page->slug = 'first'; $page->updated_at = $old;
Capsule::table('zm_pb_pages_settings')->where('page_id', 10)->update(['updated_at' => date('Y-m-d H:i:s')]);
zm_pb_redirect_page_change($page, 'recent-content', 'publish');
check(Capsule::table('zm_pb_redirects')->count() === 0, 'Translation last modification ignored');
Capsule::table('zm_pb_pages_settings')->where('page_id', 10)->update(['updated_at' => $old]);
$page->status = 'draft'; zm_pb_redirect_page_change($page, 'freshly-published', 'publish');
check(Capsule::table('zm_pb_redirects')->count() === 0, 'Draft created an automatic redirect');
$page->slug = 'contacts-layout';
zm_pb_redirect_page_change($page, 'renamed-layout', 'draft');
check(zm_pb_redirect_overrides() === ['renamed-layout' => ['contact']], 'Slug rename broke override mapping');
check(zm_pb_redirect_resolve(zm_pb_sitemap_url('renamed-layout', 'english'), [], zm_pb_redirect_overrides())['url'] === $contact, 'Renamed alias not redirected');
try {
    Capsule::connection()->transaction(function () use ($page) {
        $page->slug = 'renamed-layout';
        zm_pb_redirect_page_change($page, 'failed-rename', 'draft');
        throw new RuntimeException('Simulated page save failure');
    });
} catch (RuntimeException $error) { check($error->getMessage() === 'Simulated page save failure', 'Unexpected transaction error'); }
check(zm_pb_redirect_overrides() === ['renamed-layout' => ['contact']], 'Failed page save did not roll back override mapping');
echo "PASS redirect validation, matching, overrides, loops, automatic age gates, languages, historical repointing and slug rollback\n";
