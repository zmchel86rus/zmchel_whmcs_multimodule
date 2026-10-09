<?php
/** Run with: php modules/addons/zmchel_whmcs_multimodule/tests/images.php */
define('ZM_PB_VER', 'test');
define('ZM_PB_LIBDIR', dirname(__DIR__) . '/lib/');
define('ZM_PB_ASSETSDIR', dirname(__DIR__) . '/assets/');
define('ZM_PB_ASSETSURL', 'https://example.test/modules/addons/zmchel_whmcs_multimodule/assets/');
define('ZM_PB_SCHEMAS_DIR', ZM_PB_ASSETSDIR . 'schemas/');
$hooks = [];
function add_hook($name, $priority, $callback) {
    global $hooks;
    $hooks[$name][] = $callback;
}
function check_image($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}
function render_image_test($html, $preloadEligible = true) {
    $raw = json_encode(['format' => 'grapesjs', 'html' => $html]);
    return ZM_PB_ContentBuilder::build($raw, 'mixed',
        ['schema_enabled' => false, 'preload_eligible' => $preloadEligible]);
}
function image_xpath($html) {
    $doc = new DOMDocument();
    $previous = libxml_use_internal_errors(true);
    $doc->loadHTML('<?xml encoding="UTF-8"?>' . $html);
    libxml_clear_errors();
    libxml_use_internal_errors($previous);
    return new DOMXPath($doc);
}

require ZM_PB_LIBDIR . 'content_builder.php';
$variants = [
    'thumbnail' => ['url' => 'https://example.test/attachments/banner_thumbnail.png', 'width' => 128, 'height' => 51],
    'large' => ['url' => 'https://example.test/attachments/banner_large.png', 'width' => 1024, 'height' => 409],
    'full' => ['url' => 'https://example.test/attachments/banner.png', 'width' => 1983, 'height' => 792],
];
$attributes = ' src="https://example.test/attachments/banner_large.png" width="1024" height="409" loading="lazy" alt="Banner"'
    . ' data-zm-pb-image-variants="' . htmlspecialchars(json_encode($variants), ENT_QUOTES, 'UTF-8') . '"';
$html = render_image_test('<div>Intro</div><img' . $attributes . '>');
$xpath = image_xpath($html);
$image = $xpath->query('//img')->item(0);
check_image($image && $xpath->query('//picture')->length === 1, 'Responsive image needs a picture wrapper');
$source = $xpath->query('//picture/source')->item(0);
check_image($source && $source->getAttribute('sizes') === '100vw', 'Responsive source missing');
check_image($image->getAttribute('width') === '1024' && $image->getAttribute('height') === '409', 'Intrinsic dimensions lost');
check_image(strpos($source->getAttribute('srcset'), 'banner.png 1983w') !== false, 'Full source must use its real width');
check_image(strpos($source->getAttribute('srcset'), 'banner_large.png 1024w') !== false, 'Large source missing');
check_image(!$image->hasAttribute('srcset'), 'Fallback image should use its src');
check_image($image->getAttribute('loading') === 'eager' && $image->getAttribute('fetchpriority') === 'high', 'Early image priority incorrect');
check_image(!$image->hasAttribute('data-zm-pb-image-variants'), 'Editor metadata leaked into HTML');
check_image(count($hooks['ClientAreaHeadOutput'] ?? []) === 1, 'Expected a single head preload hook');
$preload = $hooks['ClientAreaHeadOutput'][0]();
check_image(strpos($preload, 'rel="preload"') !== false && strpos($preload, 'imagesrcset=') !== false, 'Responsive head preload missing');
check_image(strpos($preload, ' href=') === false, 'Responsive preload should not fetch the fallback image separately');

$versioned = image_xpath(render_image_test('<img' . str_replace('banner_large.png"', 'banner_large.png?v=7"', $attributes) . '>'));
check_image($versioned->query('//picture/source')->length === 1, 'Versioned selected image lost its sources');

$disabled = image_xpath(render_image_test('<img' . $attributes . ' data-zm-pb-srcset="0">'));
$image = $disabled->query('//img')->item(0);
check_image($disabled->query('//picture')->length === 0 && !$image->hasAttribute('srcset'), 'Disabled srcset still rendered');

$later = image_xpath(render_image_test(str_repeat('<div>Block</div>', 5) . '<img' . $attributes . '>'));
$image = $later->query('//img')->item(0);
check_image($image->getAttribute('loading') === 'lazy' && $image->getAttribute('fetchpriority') === 'low', 'Later image priority incorrect');

$partialAfter = image_xpath(render_image_test('<img' . $attributes . '>', false));
$image = $partialAfter->query('//img')->item(0);
check_image($image->getAttribute('loading') === 'lazy' && $image->getAttribute('fetchpriority') === 'low', 'Partial content appended below the page should remain lazy');

if (extension_loaded('gd')) {
    require ZM_PB_LIBDIR . 'media_manager.php';
    $source = tempnam(sys_get_temp_dir(), 'zmpb-image-test-');
    $variant = $source . '-512.png';
    $pixels = imagecreatetruecolor(1200, 600);
    imagefilledrectangle($pixels, 0, 0, 1199, 599, imagecolorallocate($pixels, 33, 99, 166));
    imagepng($pixels, $source, 0);
    imagedestroy($pixels);
    $before = filesize($source);
    check_image(zm_pb_media_manager_resize_image($source, $variant, 512, 'png'), 'PNG variant not generated');
    check_image(zm_pb_media_manager_optimize_image($source, 'png'), 'PNG original not optimized');
    clearstatcache(true, $source);
    check_image(filesize($source) < $before, 'Optimized PNG did not shrink');
    check_image(getimagesize($variant)[0] === 512, 'Wrong variant width');
    $uncompressed = imagecreatetruecolor(512, 256);
    imagefilledrectangle($uncompressed, 0, 0, 511, 255, imagecolorallocate($uncompressed, 33, 99, 166));
    imagepng($uncompressed, $variant, 0);
    imagedestroy($uncompressed);
    clearstatcache(true, $variant);
    $oldVariantBytes = filesize($variant);
    check_image(zm_pb_media_manager_rebuild_variant($source, $variant, 512, 'png'), 'Existing variant was not rebuilt');
    clearstatcache(true, $variant);
    check_image(filesize($variant) < $oldVariantBytes, 'Rebuilt variant did not shrink');
    check_image(!zm_pb_media_manager_rebuild_variant($source, $variant, 512, 'png'), 'Rebuild should preserve an equally small variant');
    unlink($variant);
    unlink($source);

    $paletteSource = tempnam(sys_get_temp_dir(), 'zmpb-palette-test-');
    $paletteVariant = $paletteSource . '-512.png';
    $palette = imagecreate(1200, 600);
    imagefill($palette, 0, 0, imagecolorallocate($palette, 33, 99, 166));
    imagepng($palette, $paletteSource, 9);
    imagedestroy($palette);
    check_image(zm_pb_media_manager_resize_image($paletteSource, $paletteVariant, 512, 'png'), 'Palette PNG variant missing');
    $resizedPalette = imagecreatefrompng($paletteVariant);
    check_image(!imageistruecolor($resizedPalette), 'Opaque palette PNG became a truecolor variant');
    imagedestroy($resizedPalette);
    unlink($paletteVariant);
    unlink($paletteSource);
}
echo "Image output, priority and upload optimization OK\n";
