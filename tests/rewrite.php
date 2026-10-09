<?php
/** Isolated rewrite-manager persistence test; writes only to a temporary directory. */
define('ZM_PB_VER', 'test');
$directory = sys_get_temp_dir() . '/zm-pb-rewrite-test-' . bin2hex(random_bytes(6));
if (!mkdir($directory, 0700)) throw new RuntimeException('Unable to create test directory');
define('ROOTDIR', $directory);
define('ZM_PB_INCDIR', $directory . '/');
define('ZM_PB_ADMINLANG', (object) ['rewrite_manager' => (object) ['custom' => 'Custom']]);
define('ZM_PB_ENABLE_LANG_ROUTE', !in_array('--routes-off', $argv, true));
define('ZM_PB_LANGS', require dirname(__DIR__) . '/supported_langs.php');
define('ZM_PB_DEFLANG', 'english');
define('ZM_PB_FULLHOST', 'https://example.test/billing/');
define('ZM_PB_PRETTY_URLS', true);
define('ZM_PB_MAINSYSTEM_PRETTY_URLS', true);
require dirname(__DIR__) . '/inc/language_switch.php';
require dirname(__DIR__) . '/inc/url_redirects.php';

try {
    if (zm_pb_slash_redirect_target('//billing/contact.php?count=25') !== '/billing/contact.php?count=25'
        || zm_pb_slash_redirect_target('//billing//8ttogrammi.de/') !== '/billing/8ttogrammi.de/'
        || zm_pb_slash_redirect_target('/billing//contact.php?count=25') !== '/billing/contact.php?count=25'
        || zm_pb_slash_redirect_target('/billing/ru///contact.php?next=https%3A%2F%2Fexample.test%2Fa%2Fb')
            !== '/billing/ru/contact.php?next=https%3A%2F%2Fexample.test%2Fa%2Fb'
        || zm_pb_slash_redirect_target('/billing/contact.php?next=a//b') !== null
        || zm_pb_slash_redirect_target('/elsewhere//contact.php') !== null
        || zm_pb_index_redirect_target(zm_pb_slash_redirect_target('/billing//index.php')) !== '/billing/') {
        throw new RuntimeException('Repeated slash canonical target is wrong');
    }
    if (zm_pb_clean_amp_query('count=50&amp;language=german') !== 'count=50&language=german'
        || zm_pb_clean_amp_query('count=50&amp;amp%3Blanguage=german&amp;language=russian') !== 'count=50&language=russian'
        || zm_pb_clean_amp_query('count=50&amp;language=german&language=russian') !== 'count=50&language=russian'
        || zm_pb_clean_amp_query('count=50&amp%253Blanguage=german') !== 'count=50&language=german'
        || zm_pb_clean_amp_query('q=a%26b&amp;language=german') !== 'q=a%26b&language=german') {
        throw new RuntimeException('Malformed ampersand query was not cleaned');
    }
    if (zm_pb_php_slug_redirect_target('/billing/closedauctions.php?count=25&sort=asc', 'closedauctions') !== '/billing/closedauctions/?count=25&sort=asc'
        || zm_pb_php_slug_redirect_target('/billing/ru/closedauctions.php?page=2', 'closedauctions', 'ru') !== '/billing/ru/closedauctions/?page=2'
        || zm_pb_php_slug_redirect_target('/billing/other/closedauctions.php', 'closedauctions') !== null
        || zm_pb_php_slug_redirect_target('/other/closedauctions.php', 'closedauctions') !== null) {
        throw new RuntimeException('PHP page canonical target is wrong');
    }
    if (ZM_PB_ENABLE_LANG_ROUTE) {
        if (zm_pb_language_query_repair_target('/billing/ru/closedauctions/?count=50&amp;language=german') !== '/billing/ru/closedauctions/?count=50&language=german'
            || zm_pb_language_query_repair_target('/billing/ru/closedauctions/?count=50&language=german') !== null
            || zm_pb_language_switch_target('/billing/ru/closedauctions/?count=50&amp;amp%3Blanguage=german&amp;language=russian', ['language' => 'russian']) !== '/billing/ru/closedauctions/?count=50'
            || zm_pb_default_language_redirect_target('/billing/en/contact/?count=25') !== '/billing/contact/?count=25'
            || zm_pb_default_language_redirect_target('/billing/en/') !== '/billing/'
            || zm_pb_default_language_redirect_target('/billing/en') !== '/billing/'
            || zm_pb_default_language_redirect_target('/billing/en/contact/', ['language' => 'German']) !== null
            || zm_pb_default_language_redirect_target('/billing/enough/') !== null
            || zm_pb_default_language_redirect_target('/elsewhere/en/contact/') !== null
            || zm_pb_language_switch_target('/billing/en/contact/?language=english&count=25', ['language' => 'english']) !== '/billing/contact/?count=25'
            || zm_pb_language_switch_target('/billing/en/contact/?language=russian', ['language' => 'russian']) !== '/billing/ru/contact/'
            || zm_pb_language_switch_target('/billing/login?language=russian', ['language' => 'russian']) !== '/billing/login'
            || zm_pb_language_switch_target('/billing/login?returnto=clientarea&language=german', ['language' => 'german']) !== '/billing/login?returnto=clientarea'
            || zm_pb_language_switch_target('/billing/ru/login?language=spanish', ['language' => 'spanish']) !== '/billing/login'
            || zm_pb_language_switch_target('/billing/register?language=spanish', ['language' => 'spanish']) !== '/billing/register'
            || zm_pb_language_switch_target('/billing/password/reset?language=german', ['language' => 'german']) !== '/billing/password/reset'
            || zm_pb_language_switch_target('/billing/store/domains?language=russian', ['language' => 'russian']) !== '/billing/store/domains'
            || zm_pb_language_switch_target('/billing/lecafe.com/?language=russian', ['language' => 'russian']) !== '/billing/ru/lecafe.com/'
            || zm_pb_language_switch_target('/billing/ru/lecafe.com/?language=spanish', ['language' => 'spanish']) !== '/billing/es/lecafe.com/'
            || zm_pb_language_switch_target('/billing/uk/lecafe.com/?language=german', ['language' => 'german']) !== '/billing/de/lecafe.com/'
            || zm_pb_language_switch_target('/billing/ua/lecafe.com/?language=english', ['language' => 'english']) !== '/billing/lecafe.com/'
            || zm_pb_language_switch_target('/billing/ru/lecafe.com/?language=ukranian', ['language' => 'ukranian']) !== '/billing/uk/lecafe.com/'
            || zm_pb_language_switch_target('/billing/domainmarket.php?a=search&domain_name=lecafe.com&language=russian', ['a' => 'search', 'domain_name' => 'lecafe.com', 'language' => 'russian']) !== '/billing/ru/lecafe.com/'
            || zm_pb_ua_alias_redirect_target('/billing/ua/lecafe.com/?count=25') !== '/billing/uk/lecafe.com/?count=25'
            || zm_pb_ua_alias_redirect_target('/billing/ua/') !== '/billing/uk/'
            || zm_pb_ua_alias_redirect_target('/billing/uk/lecafe.com/') !== null
            || zm_pb_ua_alias_redirect_target('/billing/ua/lecafe.com/?language=russian', ['language' => 'russian']) !== null
            || zm_pb_route_uses_user_language(['slug' => 'lecafe.com', 'lang' => 'ru'])
            || !zm_pb_route_uses_user_language(['slug' => 'robots.txt', 'lang' => 'ru'])
            || zm_pb_language_switch_target('/billing/clientarea.php?language=russian', ['language' => 'russian']) !== '/billing/clientarea.php') {
            throw new RuntimeException('Default language canonical target is wrong');
        }
    } elseif (zm_pb_default_language_redirect_target('/billing/en/contact/') !== null) {
        throw new RuntimeException('Disabled language routes still redirect');
    }
    // Use the actual include: its local $rules variable used to overwrite custom rules.
    copy(dirname(__DIR__) . '/inc/rewrite_rules.php', $directory . '/rewrite_rules.php');
    file_put_contents($directory . '/rewrite_rules_custom.php', "<?php return [];\n");
    require dirname(__DIR__) . '/lib/rewrite_manager.php';
    $defaultCount = ZM_PB_ENABLE_LANG_ROUTE ? count(ZM_PB_LANGS) + 2 : 0;
    if (ZM_PB_ENABLE_LANG_ROUTE) {
        $defaults = require $directory . '/rewrite_rules.php';
        if ($defaults[0]['directives'] !== [
            'RewriteCond %{REQUEST_METHOD} ^(?:GET|HEAD)$',
            'RewriteCond %{QUERY_STRING} !(^|&)language= [NC]',
            'RewriteRule ^en(?:/(.*))?$ /billing/$1 [NC,R=301,L]',
        ]) throw new RuntimeException('Default language Apache redirect is wrong');
        if ($defaults[1]['directives'] !== [
            'RewriteCond %{REQUEST_METHOD} ^(?:GET|HEAD)$',
            'RewriteCond %{QUERY_STRING} !(^|&)language= [NC]',
            'RewriteRule ^ua(?:/(.*))?$ /billing/uk/$1 [NC,R=301,L]',
        ]) throw new RuntimeException('Old Ukrainian Apache redirect is wrong');
    }

    // Emulate another request writing the data file after this worker loaded it.
    if (zm_pb_rewrite_custom_rules() !== []) throw new RuntimeException('Unexpected initial rules');
    $existing = [
        ['pattern' => '^clientarea\\\\/?$', 'target' => 'clientarea.php', 'flags' => 'QSA,L'],
        ['pattern' => '^clientarea/?$', 'target' => 'clientarea.php', 'flags' => 'QSA,L'],
        ['pattern' => 'test', 'target' => 'test', 'flags' => 'QSA,L'],
    ];
    file_put_contents($directory . '/rewrite_rules_custom.php', "<?php return " . var_export($existing, true) . ";\n");
    if (count(zm_pb_rewrite_custom_rules()) !== 3) {
        throw new RuntimeException('Existing rules are missing from the listing');
    }
    $combined = zm_pb_rewrite_rules();
    if (count($combined) !== 3 + $defaultCount || !isset($combined[0]['custom_id'])
        || $combined[0]['directives'] !== [zm_pb_rewrite_custom_directive($existing[0])]) {
        throw new RuntimeException('Default rules overwrote or reordered custom rules');
    }
    $duplicateRejected = false;
    try { zm_pb_rewrite_add_custom_rule('test', 'test', 'QSA,L'); }
    catch (InvalidArgumentException $error) { $duplicateRejected = $error->getMessage() === 'duplicate_rule'; }
    if (!$duplicateRejected) throw new RuntimeException('Existing custom rule was not detected as a duplicate');

    $target = 'index.php?rp=/my-page&first=1&second=2&encoded=%26';
    zm_pb_rewrite_add_custom_rule('^my-page/?$', htmlspecialchars($target, ENT_QUOTES, 'UTF-8'), 'QSA,L');
    $rules = zm_pb_rewrite_custom_rules();
    if (count($rules) !== 4 || $rules[3]['pattern'] !== '^my-page/?$' || $rules[3]['target'] !== $target) {
        throw new RuntimeException('Custom rule did not persist');
    }
    if (strpos(file_get_contents($directory . '/rewrite_rules_custom.php'), '&amp;') !== false) {
        throw new RuntimeException('HTML-escaped ampersand was saved in the rules file');
    }
    $duplicateRejected = false;
    try { zm_pb_rewrite_add_custom_rule('^my-page/?$', $target, 'QSA,L'); }
    catch (InvalidArgumentException $error) { $duplicateRejected = $error->getMessage() === 'duplicate_rule'; }
    if (!$duplicateRejected) throw new RuntimeException('Encoded and plain targets were not treated as the same rule');
    $invalidRejected = false;
    try { zm_pb_rewrite_add_custom_rule('^invalid$', 'index.php?a=1&#10;RewriteEngine&#32;Off', 'L'); }
    catch (InvalidArgumentException $error) { $invalidRejected = $error->getMessage() === 'invalid_rule'; }
    if (!$invalidRejected) throw new RuntimeException('Decoded input bypassed rule validation');
    $status = zm_pb_rewrite_status(zm_pb_rewrite_rules());
    if (count($status['rules']) !== 4 + $defaultCount || $status['rules'][3]['installed']) {
        throw new RuntimeException('Saved rule status is wrong before installation');
    }
    $original = "# Existing site configuration\nOptions -Indexes\n";
    file_put_contents($directory . '/.htaccess', $original);
    zm_pb_rewrite_install(zm_pb_rewrite_rules());
    $status = zm_pb_rewrite_status(zm_pb_rewrite_rules());
    if (!$status['installed'] || !$status['rules'][3]['installed']) {
        throw new RuntimeException('Custom rule did not reach .htaccess');
    }
    $installed = file_get_contents($directory . '/.htaccess');
    if (strpos($installed, 'RewriteRule ^my-page/?$ ' . $target . ' [QSA,L]') === false
        || strpos($installed, '&amp;') !== false) {
        throw new RuntimeException('Query separators were corrupted in .htaccess');
    }
    foreach ($status['rules'] as $rule) foreach ($rule['directives'] as $directive) {
        if (substr_count($installed, $directive) !== 1) throw new RuntimeException('Missing or duplicated installed directive');
    }
    if (substr($installed, -strlen($original)) !== $original) throw new RuntimeException('Existing site configuration was changed');
    if (zm_pb_rewrite_install(zm_pb_rewrite_rules()) !== false) throw new RuntimeException('Repeated installation changed the rules');
    zm_pb_rewrite_delete_custom_rule($status['rules'][3]['custom_id']);
    if (count(zm_pb_rewrite_custom_rules()) !== 3) throw new RuntimeException('Custom rule deletion did not persist');
    zm_pb_rewrite_install(zm_pb_rewrite_rules());
    if (strpos(file_get_contents($directory . '/.htaccess'), 'RewriteRule ^my-page/?$ ') !== false) {
        throw new RuntimeException('Deleted custom rule remains installed');
    }
    echo 'PASS custom rewrite merge, save, duplicate check, reload, install, delete (language routes '
        . (ZM_PB_ENABLE_LANG_ROUTE ? 'on' : 'off') . ")\n";
} finally {
    foreach (['rewrite_rules.php', 'rewrite_rules_custom.php', '.htaccess'] as $name) {
        $path = $directory . '/' . $name;
        if (is_file($path)) unlink($path);
    }
    rmdir($directory);
}
