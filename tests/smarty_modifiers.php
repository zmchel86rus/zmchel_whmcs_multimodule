<?php
/** Isolated Smarty policy test; does not load protected WHMCS classes. */
error_reporting(E_ALL & ~E_DEPRECATED);
require dirname(__DIR__, 4) . '/vendor/smarty/smarty/libs/Smarty.class.php';
define('ZM_PB_VER', 'test');
require dirname(__DIR__) . '/lib/smarty_blocks.php';

$directory = sys_get_temp_dir() . '/zmpb-smarty-modifiers-' . bin2hex(random_bytes(6));
if (!mkdir($directory, 0700) || !mkdir($directory . '/templates_c', 0700)) {
    throw new RuntimeException('Unable to create test directory');
}
$previous = getcwd();
try {
    chdir($directory);
    $code = '{if $auction_sites|@count > 0}{foreach from=$auction_sites item=v}'
        . '${$v.my_max_bid|string_format:"%.0f"} {$v.bid_increment|default:10}'
        . '{/foreach}{/if}';
    ZM_PB_SmartyBlocks::validate($code);
    $actual = ZM_PB_SmartyBlocks::render($code, ['auction_sites' => [['my_max_bid' => 1234.5]]]);
    if ($actual !== '$1234 10') throw new RuntimeException('Formatting failed: ' . $actual);
    $section = '{section name=col loop=3}x{sectionelse}empty{/section}';
    ZM_PB_SmartyBlocks::validate($section);
    if (ZM_PB_SmartyBlocks::render($section, []) !== 'xxx') throw new RuntimeException('Section loop failed');
    $replaced = ZM_PB_SmartyBlocks::render('{$label|regex_replace:"/[^A-Za-z0-9]/":"-"}', ['label' => 'a b']);
    if ($replaced !== 'a-b') throw new RuntimeException('Regex replacement failed: ' . $replaced);
    $rounded = ZM_PB_SmartyBlocks::render('{$ratio|round:2}', ['ratio' => 7 / 3]);
    if ($rounded !== '2.33') throw new RuntimeException('Round modifier failed: ' . $rounded);
    $computed = ZM_PB_SmartyBlocks::render('{assign var="ratio" value=$tf/$cf}{$ratio|round:2}', ['tf' => 7, 'cf' => 3]);
    if ($computed !== '2.33') throw new RuntimeException('Computed ratio failed: ' . $computed);
    $lookup = '{if $v.domain_name|array_key_exists:$side}found{else}missing{/if}';
    ZM_PB_SmartyBlocks::validate($lookup);
    if (ZM_PB_SmartyBlocks::render($lookup, ['v' => ['domain_name' => 'example.com'], 'side' => ['example.com' => 0]]) !== 'found') {
        throw new RuntimeException('Existing array key was not found');
    }
    if (ZM_PB_SmartyBlocks::render($lookup, ['v' => ['domain_name' => 'other.com'], 'side' => ['example.com' => 0]]) !== 'missing') {
        throw new RuntimeException('Missing array key was accepted');
    }
    $translation = ZM_PB_SmartyBlocks::render("{lang key='filters.date.from'}", [
        'LANG' => ['filters' => ['date' => ['from' => 'От & далее']]],
    ]);
    if ($translation !== 'От &amp; далее') throw new RuntimeException('Nested language key failed: ' . $translation);
    if (ZM_PB_SmartyBlocks::render("{lang key='filters.date.from'}", ['LANG' => []]) !== '') {
        throw new RuntimeException('Missing language key leaked output');
    }
    $GLOBALS['_LANG'] = ['filters' => ['date' => ['from' => 'From']]];
    if (ZM_PB_SmartyBlocks::render("{lang key='filters.date.from'}", []) !== 'From') {
        throw new RuntimeException('Client-area language fallback failed');
    }
    unset($GLOBALS['_LANG']);
    try {
        ZM_PB_SmartyBlocks::validate('{$value|shell_exec}');
        throw new RuntimeException('Unsafe modifier was accepted');
    } catch (InvalidArgumentException $error) {
        if ($error->getMessage() === 'Unsafe modifier was accepted') throw $error;
    }
    if (isset($argv[1])) {
        $fixture = file_get_contents($argv[1]);
        if ($fixture === false) throw new RuntimeException('Unable to read Smarty fixture');
        ZM_PB_SmartyBlocks::validate($fixture);
    }
    echo "PASS Smarty formatting, regex_replace, array_key_exists, lang tag, unsafe modifier denied\n";
} finally {
    chdir($previous);
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($files as $file) $file->isDir() ? rmdir($file->getPathname()) : unlink($file->getPathname());
    rmdir($directory);
}
