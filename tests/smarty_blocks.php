<?php
/** Run with WHMCS' PHP dependencies available; does not connect to a database. */
error_reporting(E_ALL & ~E_DEPRECATED);
require dirname(__DIR__, 4) . '/vendor/autoload.php';
define('ZM_PB_VER', 'test');
define('ZM_PB_USE_COLLECT_VARS', true);
define('ZM_PB_LIBDIR', dirname(__DIR__) . '/lib/');
define('ZM_PB_ASSETSDIR', dirname(__DIR__) . '/assets/');
define('ZM_PB_ASSETSURL', '/module-assets/');
$testDir = sys_get_temp_dir() . '/zm-pb-catalog-test-' . bin2hex(random_bytes(6)) . '/';
define('ZM_PB_RESOURCESDIR', $testDir);
if (!defined('WHMCS')) define('WHMCS', true);
if (!defined('ROOTDIR')) define('ROOTDIR', dirname(__DIR__, 4));
if (!defined('AUCTION_LANGDIR')) define('AUCTION_LANGDIR', ROOTDIR . '/modules/addons/domain_auction/lang/');
if (!defined('ZM_PB_LANGS')) define('ZM_PB_LANGS', [
    'english' => ['locale_BCP47' => 'en-US'],
    'russian' => ['locale_BCP47' => 'ru-RU'],
]);
require ZM_PB_LIBDIR . 'smarty_blocks.php';
require ZM_PB_LIBDIR . 'content_builder.php';
$hooks = [];
function add_hook($name, $priority, $callback) { $GLOBALS['hooks'][$name][$priority][] = $callback; }
function check($value, $message) { if (!$value) throw new RuntimeException($message); }

class LoadedDomains extends Illuminate\Support\Collection
{
    public function toArray() { throw new RuntimeException('Serialization is forbidden'); }
    public function jsonSerialize() { throw new RuntimeException('Serialization is forbidden'); }
}
class LoadedDomain extends Illuminate\Database\Eloquent\Model
{
    public function getAttribute($key) { throw new RuntimeException('Lazy attribute access is forbidden'); }
    public function toArray() { throw new RuntimeException('Serialization is forbidden'); }
}
class DatabaseTrap
{
    public function __get($key) { throw new RuntimeException('Object getter invoked'); }
    public function jsonSerialize() { throw new RuntimeException('Object serializer invoked'); }
}

try {
    $model = (new ReflectionClass(LoadedDomain::class))->newInstanceWithoutConstructor();
    $property = new ReflectionProperty(LoadedDomain::class, 'attributes');
    $property->setAccessible(true);
    $property->setValue($model, ['domain' => 'LEAK_DOMAIN', 'email' => 'LEAK_EMAIL', 'password' => 'LEAK_PASSWORD']);
    $domains = new LoadedDomains([$model, ['domain' => 'second.example']]);
    $variables = ['template' => 'zmchel', 'templatefile' => 'homepage', 'registered_domains' => $domains,
        'password' => 'LEAK_PASSWORD', 'content' => '<p>LEAK_HTML</p>', 'database' => new DatabaseTrap(),
        'nested' => ['phone' => 'LEAK_PHONE', 'data' => 'LEAK_NESTED']];
    mkdir($testDir . 'available_vars/legacy', 0750, true);
    file_put_contents($testDir . 'available_vars/legacy/index_smarty_vars.json', json_encode(['password' => 'LEAK_PASSWORD', 'content' => 'LEAK_HTML']));
    ZM_PB_SmartyVariables::collect($variables, 'ClientAreaPage:9999');
    check(strpos(file_get_contents($testDir . 'available_vars/legacy/index_smarty_vars.json'), 'LEAK_') === false, 'Old raw dump was not sanitized');
    $variables['late'] = true;
    ZM_PB_SmartyVariables::collect($variables, 'ClientAreaFooterOutput:9999');
    $catalogs = ZM_PB_SmartyVariables::catalogs();
    check(count($catalogs) === 1, 'Catalog missing');
    $json = json_encode($catalogs);
    check(strpos($json, 'LEAK_') === false, 'Actual values leaked into the catalog');
    $catalog = $catalogs[0];
    check($catalog['variables']['password']['redacted'], 'Sensitive variable not marked');
    check(isset($catalog['variables']['registered_domains']['children']['[]']['children']['domain']), 'Loaded collection/model structure missing');
    check(count($catalog['variables']['registered_domains']['stages']) === 2, 'Stages were not merged');
    check(is_file($testDir . 'available_vars/zmchel__homepage_smarty_vars.json'), 'Source/theme filename incorrect');
    check(is_file($testDir . 'available_vars/.htaccess'), 'Catalog directory unprotected');

    $code = '{foreach $registered_domains as $item}<p>{$item.domain|escape}</p>{foreachelse}none{/foreach}';
    ZM_PB_SmartyBlocks::validate($code);
    ZM_PB_SmartyBlocks::validate('<!-- ordinary HTML comment -->{* documented $obj->method() *}{literal}/* :: */{/literal}{$companyname}');
    check(ZM_PB_SmartyBlocks::render($code, $variables) === '<p>LEAK_DOMAIN</p><p>second.example</p>', 'Loaded data cannot be rendered without lazy calls');
    $GLOBALS['smarty'] = new Smarty();
    $GLOBALS['smarty']->assignGlobal('global_object', new DatabaseTrap());
    check(ZM_PB_SmartyBlocks::render('{$global_object}', []) === '', 'Global live object was not shadowed');
    check(ZM_PB_SmartyBlocks::render('{$text|escape}', ['text' => '<b>']) === '&lt;b&gt;', 'Explicit escape was applied twice');
    $loadLanguage = function ($language) {
        $_LANG = [];
        require ROOTDIR . '/lang/' . $language . '.php';
        $override = ROOTDIR . '/lang/overrides/' . $language . '.php';
        if (is_file($override)) require $override;
        return $_LANG;
    };
    $englishCatalog = $loadLanguage('english');
    $russianCatalog = $loadLanguage('russian');
    $loadAuctionLanguage = function ($language) {
        $_ADDONLANG = [];
        require AUCTION_LANGDIR . $language . '.php';
        return $_ADDONLANG;
    };
    $englishAuction = $loadAuctionLanguage('english');
    $russianAuction = $loadAuctionLanguage('russian');
    $russianAccount = htmlspecialchars($russianCatalog['account'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', false);
    $russianAuctionTitle = htmlspecialchars($russianAuction['sites_open'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', false);
    check($englishCatalog['account'] !== $russianCatalog['account'], 'Language fixture must differ');
    check($englishAuction['sites_open'] !== $russianAuction['sites_open'], 'Auction language fixture must differ');
    check(ZM_PB_SmartyBlocks::render('{lang key="account"}', ['LANG' => $englishCatalog], 'russian') === $russianAccount,
        'Smarty lang used the profile language instead of the page language');
    check(ZM_PB_SmartyBlocks::render('{$Lang.sites_open}', ['Lang' => $englishAuction], 'russian') === $russianAuctionTitle,
        'Smarty addon variable used the profile language instead of the page language');
    $formatted = '{if $auction_sites|@count > 0}{foreach from=$auction_sites item=v}'
        . '${$v.my_max_bid|string_format:"%.0f"} {$v.bid_increment|default:10}'
        . '{/foreach}{/if}';
    ZM_PB_SmartyBlocks::validate($formatted);
    check(ZM_PB_SmartyBlocks::render($formatted, ['auction_sites' => [['my_max_bid' => 1234.5]]]) === '$1234 10',
        'Formatting or default modifier failed');
    $invalid = ['{php}echo 1;{/php}', '{include file="x"}', '{fetch file="http://x"}', '{$smarty.template_object}',
        '{$smarty.session.uid}', '{$obj->query("select 1")}', '{Capsule::table("x")}', '{system("whoami")}',
        '{$x|shell_exec}', '{sql query="select 1"}', '{$x nofilter}', '{while true}x{/while}',
        '{assign var=x value=1 scope="global"}', '{call name="system"}', '{assign var=f value="strrev"}{$f("abc")}'];
    foreach ($invalid as $code) {
        $blocked = false;
        try { ZM_PB_SmartyBlocks::validate($code); } catch (InvalidArgumentException $error) { $blocked = true; }
        check($blocked, 'Unsafe Smarty accepted: ' . $code);
    }
    $messages = ["PASS catalog redaction, nested models/collections, stage merge, snapshot isolation, escaping, security"];

    // A wide archive used to consume the shared 20,000-node budget after only
    // a few hundred rows, and could also starve every variable following it.
    $archiveRow = (object) array_merge(array_fill_keys(array_map(function ($i) {
        return 'metric_' . $i;
    }, range(1, 60)), 123), ['domain_name' => 'middle.example', 'email' => 'DO_NOT_EXPOSE']);
    $archiveRows = array_fill(0, 15001, $archiveRow);
    $archiveRows[0] = clone $archiveRow;
    $archiveRows[0]->domain_name = 'first.example';
    $archiveRows[15000] = clone $archiveRow;
    $archiveRows[15000]->domain_name = 'last.example';
    $archiveCode = '{$auction_sites|count}|{foreach $auction_sites as $lot}{$lot.domain_name};{/foreach}|{$after_archive}';
    $archiveOutput = ZM_PB_SmartyBlocks::render($archiveCode, [
        'unrelated_list' => array_fill(0, 21000, 'unrelated'),
        'auction_sites' => new LoadedDomains($archiveRows),
        'after_archive' => 'tail',
    ]);
    check($archiveOutput === '15001|first.example;' . str_repeat('middle.example;', 14999) . 'last.example;|tail',
        'Large collection lost rows/fields or consumed another variable');
    check(ZM_PB_SmartyBlocks::render('{$lot.email|default:"hidden"}', ['lot' => $archiveRow]) === 'hidden',
        'Complete runtime snapshots must still redact private data');
    $limit = 2;
    $limited = false;
    try { ZM_PB_SmartyVariables::snapshot([1, 2, 3], 'list', 0, $limit); }
    catch (LengthException $error) { $limited = true; }
    check($limited, 'An explicit snapshot limit silently returned a partial list');
    unset($archiveRows, $archiveRow, $archiveOutput);
    $messages[] = 'PASS 15001 wide archive rows, variable independence and runtime redaction';

    // Build before native variables exist; resolve only after WHMCS footer hooks have populated them.
    $expression = '{foreach $registered_domains as $item}<p>{$item.domain}</p>{/foreach}';
    $html = '<section><h2>Before</h2><div data-zm-pb-smarty="' . htmlspecialchars($expression, ENT_QUOTES) . '"></div><h2>After</h2></section>';
    $html .= '<div data-zm-pb-auth="auth"><div data-zm-pb-smarty="{$secret}"></div></div>';
    $html .= '<div data-zm-pb-smarty="{lang key=&quot;account&quot;}"></div>';
    $html .= '<div data-zm-pb-smarty="{$Lang.sites_open}"></div>';
    $_SESSION = [];
    ob_start();
    $bufferLevel = ob_get_level();
    $built = ZM_PB_ContentBuilder::build(json_encode(['format' => 'grapesjs', 'html' => $html]), 'mixed',
        ['schema_enabled' => false, 'lang' => 'russian']);
    check(ob_get_level() === $bufferLevel && ob_get_length() === 0, 'Building content started or wrote to a response buffer');
    // ClientArea can create its own engine after the builder has queued its blocks.
    $GLOBALS['smarty'] = new Smarty();
    foreach ($hooks['ClientAreaPage'] as $callbacks) foreach ($callbacks as $callback) check($callback([]) === [], 'Page hook must not output content');
    $GLOBALS['smarty']->assign('registered_domains', new LoadedDomains([['domain' => '<late.example>']]));
    $GLOBALS['smarty']->assign('LANG', $englishCatalog);
    $GLOBALS['smarty']->assign('Lang', $englishAuction);
    ksort($hooks['ClientAreaFooterOutput']);
    foreach ($hooks['ClientAreaFooterOutput'] as $callbacks) foreach ($callbacks as $callback) $callback([]);
    $GLOBALS['smarty']->assign('builder_content', $built);
    $rendered = $GLOBALS['smarty']->fetch('eval:{$builder_content}');
    check(ob_get_level() === $bufferLevel && ob_get_length() === 0, 'Template rendering emitted output before Laminas');
    check(strpos($rendered, '<h2>Before</h2><p>&lt;late.example&gt;</p><h2>After</h2>') !== false, 'Late block rendered at the wrong place or without late data');
    check(strpos($rendered, 'ZM_PB_SMARTY_') === false, 'Deferred placeholder leaked');
    check(strpos($rendered, 'data-zm-pb-auth') === false, 'Denied authorization block survived');
    check(strpos($rendered, $russianAccount) !== false, 'Queued Smarty lang used the profile language');
    check(strpos($rendered, $russianAuctionTitle) !== false, 'Queued Smarty addon language used the profile language');
    // Use the same emitter that rejected the response in WHMCS, without mocking its assertions.
    $response = new Laminas\Diactoros\Response\HtmlResponse($rendered);
    check((new Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response), 'Laminas rejected the rendered response');
    check(ob_get_clean() === $rendered, 'Emitter changed the rendered response');
    $messages[] = 'PASS late rendering at original position, engine replacement, auth filtering, no premature output, real Laminas emission';

    // A separately fetched fragment may complete before the footer hook supplies its variables.
    $token = ZM_PB_SmartyBlocks::queue('{$fragment_title}');
    $GLOBALS['smarty']->assign('fragment_block', $token);
    $fragment = $GLOBALS['smarty']->fetch('eval:{assign var=fragment_title value="Template context"}<article>{$fragment_block}</article>');
    check($fragment === '<article>Template context</article>', 'Separate fetch did not use the completed template context');
    foreach (['before', 'after'] as $placement) {
        $GLOBALS['smarty']->assign('partial_block', '<div data-zm-pb-partial="' . $placement . '" hidden>' . $built . '</div>');
        $partial = $GLOBALS['smarty']->fetch('eval:<main>Native</main>{$partial_block}');
        check(strpos($partial, '<p>&lt;late.example&gt;</p>') !== false && strpos($partial, 'ZM_PB_SMARTY_') === false,
            'Partial content lost its Smarty block');
    }

    // Invalid scalar modifiers on a Collection and template warnings must never leak into the response.
    $errorLog = ini_get('error_log');
    ini_set('error_log', $testDir . 'errors.log');
    try {
        $handler = function () { throw new RuntimeException('Previous error handler was not replaced locally'); };
        set_error_handler($handler);
        try {
            $badBlock = ZM_PB_SmartyBlocks::queue('{$registered_domains|escape}') . ZM_PB_SmartyBlocks::queue('{$undefined_variable}');
            $GLOBALS['smarty']->assign('bad_block', $badBlock);
            ob_start();
            $failed = $GLOBALS['smarty']->fetch('eval:<section>{$bad_block}</section>');
            check(ob_get_clean() === '' && $failed === '<section></section>', 'Template error leaked output or an internal marker');
            $restored = set_error_handler($handler);
            restore_error_handler();
            check($restored === $handler, 'Smarty rendering did not restore the previous error handler');
        } finally { restore_error_handler(); }
        check(is_file($testDir . 'errors.log') && strpos(file_get_contents($testDir . 'errors.log'), 'Smarty block:') !== false,
            'Template error was not logged');
    } finally { ini_set('error_log', $errorLog); }
    $messages[] = 'PASS fragment fetch, partial placement, Collection error isolation, warning isolation, error handler restoration';
    echo implode("\n", $messages) . "\n";
} finally {
    // Only explicitly created test files under a random temporary directory.
    foreach (glob($testDir . 'available_vars/*_smarty_vars.json') ?: [] as $path) unlink($path);
    if (is_file($testDir . 'available_vars/.htaccess')) unlink($testDir . 'available_vars/.htaccess');
    if (is_file($testDir . 'errors.log')) unlink($testDir . 'errors.log');
    if (is_file($testDir . 'available_vars/legacy/index_smarty_vars.json')) unlink($testDir . 'available_vars/legacy/index_smarty_vars.json');
    if (is_dir($testDir . 'available_vars/legacy')) rmdir($testDir . 'available_vars/legacy');
    if (is_dir($testDir . 'available_vars')) rmdir($testDir . 'available_vars');
    if (is_dir($testDir)) rmdir($testDir);
}
