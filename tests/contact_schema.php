<?php
/** Standalone schema regression test; no WHMCS bootstrap or database required. */
define('ZM_PB_VER', 'test');
define('ZM_PB_SCHEMAS_DIR', dirname(__DIR__) . '/assets/schemas/');
define('ZM_PB_DEFLANG', 'english');
define('ZM_PB_LANGS', [
    'russian' => ['locale_BCP47' => 'ru-RU'], 'english' => ['locale_BCP47' => 'en-US'],
    'german' => ['locale_BCP47' => 'de-DE'], 'ukranian' => ['locale_BCP47' => 'uk-UA'],
    'spanish' => ['locale_BCP47' => 'es-ES'],
]);
require dirname(__DIR__) . '/lib/schema.php';
function check($condition, $message) { if (!$condition) throw new RuntimeException($message); }
function jsonld(array $schema) {
    $html = zm_pb_schema_jsonld($schema);
    check((bool) preg_match('~^<script type="application/ld\+json">(.*)</script>\s*$~s', $html, $match), 'Missing JSON-LD script');
    $decoded = json_decode($match[1], true);
    check(json_last_error() === JSON_ERROR_NONE && is_array($decoded), 'Invalid JSON-LD');
    return $decoded;
}
foreach (['https://example.test', 'https://other.test/billing/'] as $systemUrl) {
    $base = rtrim($systemUrl, '/') . '/';
    $GLOBALS['CONFIG'] = ['SystemURL' => $systemUrl, 'CompanyName' => 'Company "Example"',
        'LogoURL' => 'assets/img/logo.png', 'Email' => 'support@example.test',
        'CompanyAddress' => 'Line 1<br>Line 2'];
    foreach (['english' => '', 'russian' => 'ru/'] as $language => $prefix) {
        $url = $base . $prefix . 'contact/';
        $values = ['TITLE' => 'Contact "Example"', 'DESCRIPTION' => 'Help & support', 'URL' => $url,
            'LANG_BCP47' => ZM_PB_LANGS[$language]['locale_BCP47'], 'SITE_URL' => $systemUrl,
            'SITE_NAME' => $GLOBALS['CONFIG']['CompanyName']];
        $contact = jsonld(zm_pb_schema_template('contactpage', $values));
        $organization = jsonld(zm_pb_schema_organization($language));
        $website = jsonld(zm_pb_schema_website());
        check($website['@type'] === 'WebSite' && $website['@id'] === $base . '#website'
            && $website['url'] === $base && $website['name'] === $GLOBALS['CONFIG']['CompanyName'], 'WebSite identity or WHMCS data changed');
        check($website['publisher'] === ['@id' => $organization['@id']], 'WebSite publisher does not reference Organization');
        foreach (['webpage', 'aboutpage', 'faqpage'] as $pageType) {
            $pageSchema = jsonld(zm_pb_schema_template($pageType, $values));
            check($pageSchema['isPartOf']['@id'] === $website['@id']
                && $pageSchema['isPartOf']['url'] === $website['url'],
                $pageType . ' does not reference the published WebSite');
        }
        check($contact['@id'] === $url . '#webpage' && $contact['url'] === $url, 'Page URL or identity changed');
        check($contact['mainEntity'] === ['@id' => $organization['@id']], 'Duplicate Organization or mismatched reference');
        check($organization['@id'] === $base . '#organization', 'Organization identity varies by page language');
        check($contact['isPartOf']['@id'] === $base . '#website', 'Missing WebSite identity');
        check($organization['logo'] === $base . 'assets/img/logo.png', 'Relative logo was not resolved');
        check($organization['contactPoint']['@id'] === $base . '#customer-support', 'Missing ContactPoint identity');
        check($organization['contactPoint']['email'] === 'support@example.test', 'WHMCS email lost');
        check($organization['contactPoint']['availableLanguage'] === ['ru-RU', 'en-US', 'de-DE', 'uk-UA', 'es-ES'], 'Supported BCP47 languages lost');
        check(!isset($organization['inLanguage']) && $contact['inLanguage'] === $values['LANG_BCP47'], 'Page language lost or invalid Organization language property');
        check($organization['address'] === "Line 1\nLine 2", 'WHMCS address changed');
        check(substr_count(json_encode([$contact, $organization]), '"@type":"Organization"') === 1, 'Organization duplicated');
        check(substr_count(json_encode([$contact, $organization]), '"@type":"ContactPoint"') === 1, 'ContactPoint duplicated');
        $toc = zm_pb_schema_contents('contents', 'Contents', [['url' => $url . '#support', 'name' => 'Support']],
            ['schema_type' => 'contactpage', 'schema' => $values]);
        check($toc['@graph'][0]['@id'] === $contact['@id'], 'Contents references a different ContactPage');
    }
}
check(zm_pb_schema_homepage_request(['slug' => '', 'lang' => 'uk'], ['rp' => '/'])
    && zm_pb_schema_homepage_request(['slug' => 'index.php', 'lang' => ''], [])
    && !zm_pb_schema_homepage_request(['slug' => 'contact', 'lang' => 'uk'], [])
    && !zm_pb_schema_homepage_request(['slug' => 'index.php', 'lang' => ''], ['rp' => '/contact']),
    'WebSite schema must be limited to the homepage');
foreach ([
    '/assets/logo.png' => 'https://example.test/assets/logo.png',
    '../assets/logo.png' => 'https://example.test/assets/logo.png',
    '//cdn.example.test/logo.png' => 'https://cdn.example.test/logo.png',
    'https://cdn.example.test/logo.png' => 'https://cdn.example.test/logo.png',
    'logo.png?image=https://cdn.example.test/logo.png' => 'https://example.test/billing/logo.png?image=https://cdn.example.test/logo.png',
    '' => '',
] as $logo => $expected) {
    check(zm_pb_schema_logo_url($logo, 'https://example.test/billing/') === $expected, 'Logo URL resolution failed: ' . $logo);
}
echo "PASS ContactPage/Organization/WebSite identities, homepage routing, JSON, languages, logos, and contents references\n";
