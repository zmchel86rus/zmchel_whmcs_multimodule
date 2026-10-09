<?php
/** php modules/addons/zmchel_whmcs_multimodule/tests/schema_output.php — no WHMCS or database. */
define('ZM_PB_VER', 'test');
define('ZM_PB_SCHEMAS_DIR', dirname(__DIR__) . '/assets/schemas/');
require dirname(__DIR__) . '/lib/schema.php';
function check($condition, $message) { if (!$condition) throw new RuntimeException($message); }
$items = [
    ['label'=>'Company', 'url'=>'#', 'children'=>[
        ['label'=>'Главная', 'url'=>'/ru/', 'children'=>[]],
        ['label'=>'Контакты', 'url'=>'/ru/contact/', 'children'=>[]],
    ]],
    ['label'=>'Section', 'url'=>'#details', 'children'=>[]],
    ['label'=>'Relative', 'url'=>'../help/', 'children'=>[]],
    ['label'=>'Filter', 'url'=>'?zone=com', 'children'=>[]],
    ['label'=>'Email', 'url'=>'mailto:help@example.test', 'children'=>[]],
    ['label'=>'Action', 'url'=>'#', 'children'=>[]],
    ['label'=>'</script><script>test</script>', 'url'=>'https://external.test/', 'children'=>[]],
];
$nav = zm_pb_schema_navigation('Footer', $items, 'ru-RU', 'https://example.test/ru/contact/?count=25');
check($nav['@type'] === 'SiteNavigationElement' && $nav['inLanguage'] === 'ru-RU', 'Wrong menu type/language');
check(count($nav['hasPart']) === 5, 'Empty/action entries leaked into schema');
check(!isset($nav['hasPart'][0]['url']) && count($nav['hasPart'][0]['hasPart']) === 2, 'Menu group hierarchy lost');
check($nav['hasPart'][0]['hasPart'][1]['url'] === 'https://example.test/ru/contact/', 'Localized menu URL changed');
check($nav['hasPart'][1]['url'] === 'https://example.test/ru/contact/?count=25#details', 'Fragment resolved against wrong page');
check($nav['hasPart'][2]['url'] === 'https://example.test/ru/help/', 'Relative menu URL resolved incorrectly');
check($nav['hasPart'][3]['url'] === 'https://example.test/ru/contact/?zone=com', 'Query menu URL resolved incorrectly');
$encoded = zm_pb_schema_jsonld($nav);
check(substr_count($encoded, '</script>') === 1 && strpos($encoded, '<script>test') === false, 'JSON-LD script injection');
check(zm_pb_schema_navigation('Empty', [], 'en-US', 'https://example.test/') === [], 'Empty menu emitted schema');

$doc = new DOMDocument();
$doc->loadHTML('<div id="root"><section data-zm-pb-faq="1">'
    . '<details><summary>Question <span hidden>internal</span>one?</summary><div class="zm-pb-accordion-answer"><p>First paragraph.</p><p>Second paragraph.</p><span style="display:none">secret</span></div></details>'
    . '<details hidden><summary>Hidden question?</summary><div class="zm-pb-accordion-answer">Hidden answer</div></details>'
    . '<details><summary>Empty?</summary><div class="zm-pb-accordion-answer"><span hidden>Hidden only</span></div></details>'
    . '</section><section data-zm-pb-faq="1" aria-hidden="true"><details><summary>Another hidden question?</summary><div class="zm-pb-accordion-answer">Secret</div></details></section>'
    . '<details><summary>Ordinary accordion</summary><div class="zm-pb-accordion-answer">Not a FAQ</div></details></div>');
$root = (new DOMXPath($doc))->query('//*[@id="root"]')->item(0);
$faq = zm_pb_schema_faq($root, ['URL'=>'https://example.test/faq/', 'TITLE'=>'FAQ']);
check(count($faq['mainEntity']) === 1, 'Hidden/empty/non-FAQ content included');
check($faq['mainEntity'][0]['name'] === 'Question one?', 'Hidden question text leaked');
check($faq['mainEntity'][0]['acceptedAnswer']['text'] === 'First paragraph. Second paragraph.', 'Answer paragraphs merged or hidden content leaked');
foreach (['organization', 'person', 'product', 'service'] as $type) {
    $schema = zm_pb_schema_template($type, ['TITLE'=>'Example', 'SITE_NAME'=>'Company', 'SITE_URL'=>'https://example.test/', 'LANG_BCP47'=>'ru-RU']);
    check(!isset($schema['inLanguage']), 'Unsupported inLanguage on ' . $type);
}
echo "PASS navigation URLs/hierarchy/language, JSON escaping, visible FAQ content, property domains\n";
