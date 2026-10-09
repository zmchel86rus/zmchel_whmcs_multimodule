<?php
define('ZM_PB_VER', 'test');
define('ZM_PB_INCDIR', dirname(__DIR__) . '/inc/');
define('ZM_PB_ASSETSDIR', dirname(__DIR__) . '/assets/');
define('ZM_PB_SCHEMAS_DIR', ZM_PB_ASSETSDIR . 'schemas/');
define('ZM_PB_FULLHOST', 'https://example.test/');
define('ZM_PB_ASSETSURL', '/modules/addons/zmchel_whmcs_multimodule/assets/');
define('ZM_PB_ENABLE_FOOTERMENU', true);
define('ZM_PB_ENABLE_LANG_ROUTE', false);
define('ZM_PB_PRETTY_URLS', false);
define('ZM_PB_DEFLANG', 'english');
define('USER_LANG', 'english');
define('ZM_PB_LANGS', ['english' => ['code_lower' => 'en']]);
require dirname(__DIR__) . '/inc/footer_menu.php';

$source = file_get_contents(dirname(__DIR__, 4) . '/templates/zmchel/footer.tpl');
if ($source === false) throw new RuntimeException('Missing theme fixture');
$enabled = zm_pb_menu_footer_template_contents($source, true);
$opening = strpos($enabled, '<footer id="footer" class="footer">');
$marker = strpos($enabled, '{* ZM PB FOOTER MENU BEGIN *}');
$container = strpos($enabled, '<div class="container">', $opening);
if ($opening === false || $marker === false || $container === false || !($opening < $marker && $marker < $container)) {
    throw new RuntimeException('Footer menu was not inserted after <footer>');
}
if (zm_pb_menu_footer_template_contents($enabled, true) !== $enabled) {
    throw new RuntimeException('Footer insertion is not idempotent');
}
if (zm_pb_menu_footer_template_contents($enabled, false) !== $source) {
    throw new RuntimeException('Footer removal changed unrelated template content');
}
$six = file_get_contents(dirname(__DIR__, 4) . '/templates/six/footer.tpl');
$sixEnabled = zm_pb_menu_footer_template_contents($six, true);
$sixOpening = strpos($sixEnabled, '<section id="footer">');
$sixMarker = strpos($sixEnabled, '{* ZM PB FOOTER MENU BEGIN *}');
$sixContainer = strpos($sixEnabled, '<div class="container">', $sixOpening);
if ($sixOpening === false || $sixMarker === false || $sixContainer === false ||
    !($sixOpening < $sixMarker && $sixMarker < $sixContainer) ||
    zm_pb_menu_footer_template_contents($sixEnabled, false) !== $six) {
    throw new RuntimeException('Six theme footer section was not handled');
}
$crlf = str_replace("\n", "\r\n", str_replace("\r\n", "\n", $source));
if (zm_pb_menu_footer_template_contents(zm_pb_menu_footer_template_contents($crlf, true), false) !== $crlf) {
    throw new RuntimeException('CRLF template content changed after removal');
}
try {
    zm_pb_menu_footer_template_contents($source . '{* ZM PB FOOTER MENU BEGIN *}', false);
    throw new RuntimeException('Incomplete marker was accepted');
} catch (RuntimeException $error) {
    if ($error->getMessage() !== 'footer_marker_incomplete') throw $error;
}
$temporary = tempnam(sys_get_temp_dir(), 'zmpb-footer-test-');
if ($temporary === false) throw new RuntimeException('Unable to create test file');
try {
    file_put_contents($temporary, $source);
    if (!zm_pb_menu_update_footer_template_file($temporary, true) || file_get_contents($temporary) !== $enabled) {
        throw new RuntimeException('Footer template file was not updated');
    }
    if (!zm_pb_menu_update_footer_template_file($temporary, false) || file_get_contents($temporary) !== $source) {
        throw new RuntimeException('Footer template file was not restored');
    }
} finally {
    unlink($temporary);
}

require dirname(__DIR__) . '/lib/menu.php';
$item = function ($id, $parent, $label, $url, $visibility = 'mixed') {
    return ['id' => $id, 'parent_id' => $parent, 'type' => 'custom', 'label' => $label, 'url' => $url,
        'labels' => '{}', 'visibility' => $visibility, 'target' => '_self', 'classes' => '', 'description' => ''];
};
$data = [
    'locations' => ['footer' => (object) ['id' => 1, 'name' => 'Footer', 'device' => 'mixed', 'auto_add' => false]],
    'items' => [1 => [$item(1, 0, 'Company', '#'), $item(2, 1, 'Contact', '/contact'),
        $item(3, 0, 'Help', '#'), $item(4, 3, 'Private', '/private', 'auth')]],
    'pages' => [], 'settings' => [], 'overrides' => [],
];
$property = (new ReflectionClass('ZM_PB_Menu'))->getProperty('data');
$property->setAccessible(true);
$property->setValue(null, $data);
$html = ZM_PB_Menu::footerHtml();
if (substr_count($html, 'class="zm-pb-footer-column ') !== 2 || strpos($html, 'href="/contact/"') === false ||
    strpos($html, 'Private') !== false || strpos($html, '--zm-pb-footer-columns:2') === false) {
    throw new RuntimeException('Footer columns, links or visibility are wrong');
}
$assets = ZM_PB_Menu::assets();
if (!preg_match('~<script type="application/ld\+json">(.*?)</script>~s', $assets, $match)) throw new RuntimeException('Footer navigation schema missing');
$navigation = json_decode($match[1], true);
if (($navigation['@type'] ?? '') !== 'SiteNavigationElement'
    || ($navigation['hasPart'][0]['hasPart'][0]['url'] ?? '') !== 'https://example.test/contact/'
    || strpos($match[1], 'Private') !== false) throw new RuntimeException('Footer schema does not match public menu');
if (strpos($assets, 'css/menu.css') === false || strpos($assets, 'js/menu.js') !== false) {
    throw new RuntimeException('Footer assets are wrong');
}
echo "PASS footer template and menu rendering\n";
