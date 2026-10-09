<?php
/** Render saved content without WHMCS, its database or Smarty. */
define('ZM_PB_VER', 'test');
define('ZM_PB_LIBDIR', dirname(__DIR__) . '/lib/');
define('ZM_PB_ASSETSDIR', dirname(__DIR__) . '/assets/');
define('ZM_PB_ASSETSURL', 'https://example.test/modules/addons/zmchel_whmcs_multimodule/assets/');
define('ZM_PB_SCHEMAS_DIR', ZM_PB_ASSETSDIR . 'schemas/');
require ZM_PB_LIBDIR . 'content_builder.php';
function check($condition, $message) { if (!$condition) throw new RuntimeException($message); }
function document($html) {
    $doc = new DOMDocument(); $previous = libxml_use_internal_errors(true);
    $doc->loadHTML('<?xml encoding="UTF-8"?>' . $html);
    libxml_clear_errors(); libxml_use_internal_errors($previous);
    return [$doc, new DOMXPath($doc)];
}
function build($html, array $context) {
    return ZM_PB_ContentBuilder::build(json_encode(['format' => 'grapesjs', 'html' => $html]), 'mixed', $context);
}
function graphs(DOMXPath $xpath) {
    $result = [];
    foreach ($xpath->query('//script[@type="application/ld+json"]') as $script) {
        $schema = json_decode($script->textContent, true);
        check(is_array($schema), 'Invalid JSON-LD'); $result[] = $schema;
    }
    return $result;
}
$_SESSION = [];
$context = ['page_id' => 10, 'page_type' => 'page', 'schema_type' => 'webpage', 'schema_enabled' => true,
    'schema' => ['URL' => 'https://example.test/ru/test/', 'TITLE' => 'Test page', 'LANG_BCP47' => 'ru-RU']];
$source = '<h2 id="before">Before contents</h2><nav data-zm-pb-toc="1" data-zm-pb-toc-title="Contents" data-zm-pb-toc-numbered="1"><h2>Stale heading</h2></nav>'
    . '<div data-zm-pb-auth="auth"><h2>Private heading</h2></div><div hidden><h2>Hidden heading</h2></div>'
    . '<section><h2 id="keep">Overview &amp; examples</h2><h3>Details</h3><h4>Features</h4></section>'
    . '<h2 id="duplicate">Repeat</h2><h2 id="duplicate">Repeat</h2>'
    . '<nav data-zm-pb-toc="1" data-zm-pb-toc-title="Later contents" data-zm-pb-toc-min="3" data-zm-pb-toc-max="3"></nav>'
    . '<h3>Later</h3><form><h2>Form heading</h2></form>';
$html = build($source, $context);
[$doc, $xpath] = document($html);
$contents = $xpath->query('//nav[@data-zm-pb-toc]');
check($contents->length === 2, 'Contents missing');
check($xpath->query('.//a', $contents->item(0))->length === 6, 'Wrong heading range or visibility');
check($xpath->query('.//a', $contents->item(1))->length === 1, 'Second contents included earlier headings or wrong levels');
check($xpath->query('.//ol/li/ol/li/ol/li', $contents->item(0))->length === 1, 'Heading hierarchy missing');
check($xpath->query('.//a', $contents->item(0))->item(0)->getAttribute('href') === 'https://example.test/ru/test/#keep', 'Existing anchor not preserved');
$seen = [];
foreach ($xpath->query('//h2[@id] | //h3[@id] | //h4[@id]') as $heading) {
    $id = $heading->getAttribute('id'); check(!isset($seen[$id]), 'Duplicate heading anchor'); $seen[$id] = true;
}
foreach ($xpath->query('//nav[@data-zm-pb-toc]//a') as $link) {
    $id = rawurldecode(parse_url($link->getAttribute('href'), PHP_URL_FRAGMENT));
    check(isset($seen[$id]) && $id !== 'before', 'Contents points to absent or earlier heading');
}
$schemas = graphs($xpath);
check(count($schemas) === 2 && $schemas[0]['@graph'][0]['@type'] === 'WebPage', 'Ordinary page mislabeled as article');
check($schemas[0]['@graph'][1]['@type'] === 'SiteNavigationElement', 'Navigation schema missing');
check($schemas[0]['@graph'][2]['@type'] === 'WebPageElement', 'Heading schema missing');
check(strpos(json_encode($schemas), 'Private heading') === false && strpos(json_encode($schemas), 'Form heading') === false, 'Excluded content leaked into schema');
check(build($source, $context) === $html, 'Generated anchors or contents are unstable');

$context['schema_type'] = 'article'; $context['page_type'] = 'post';
[, $articleXpath] = document(build($source, $context));
$article = graphs($articleXpath)[0]['@graph'];
check($article[0]['@type'] === 'Article' && $article[0]['@id'] === $context['schema']['URL'] . '#article', 'Article context not honored');
check($article[2]['isPartOf']['@id'] === $article[0]['@id'], 'Section linked to wrong article');
check(zm_pb_schema_template('article', $context['schema'])['@id'] === $article[0]['@id'], 'Main article schema uses a different identity');
$context['schema_type'] = 'webpage';
[, $pageXpath] = document(build($source, $context));
check(graphs($pageXpath)[0]['@graph'][0]['@type'] === 'WebPage', 'Explicit WebPage schema ignored for post');
$context['schema_enabled'] = false;
[, $disabledXpath] = document(build($source, $context));
check(!graphs($disabledXpath), 'Disabled schema still emitted');
check($disabledXpath->query('//nav[@data-zm-pb-toc]//a')->length === 7, 'Disabling schema broke contents');
$context['schema_enabled'] = true;
check(strpos(build('<h2>Before</h2><nav data-zm-pb-toc="1"></nav>', $context), '<nav') === false, 'Empty contents still shown');
$flat = '<nav data-zm-pb-toc="1" data-zm-pb-toc-nested="0" data-zm-pb-toc-min="2" data-zm-pb-toc-max="3"></nav><h1>Excluded</h1><h2>Top</h2><h3>Child</h3><h4>Excluded</h4>';
[, $flatXpath] = document(build($flat, $context));
check($flatXpath->query('//nav/ul/li')->length === 2 && $flatXpath->query('//nav//li/ul')->length === 0, 'Flat list or level filter failed');
echo "Table of contents rendering and schema OK\n";
