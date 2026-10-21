<?php
// Run with PHP 7.4 or later: php tests/module_languages.php
define('ZM_PB_VER', 'test');
require dirname(__DIR__) . '/inc/module_languages.php';

function ml_check(bool $condition, string $message): void
{
    if (!$condition) throw new RuntimeException($message);
}

$directory = sys_get_temp_dir() . '/zm_pb_languages_' . bin2hex(random_bytes(8));
mkdir($directory, 0750, true);
copy(dirname(__DIR__) . '/supported_langs.php', $directory . '/supported_langs.php');
copy(dirname(__DIR__) . '/disabled_langs.php', $directory . '/disabled_langs.php');

try {
    foreach (['english', 'german', 'portuguese-pt', 'portuguese-br'] as $language) {
        if (isset(zm_pb_module_languages_state($directory)['disabled'][$language])) {
            zm_pb_module_languages_toggle($directory, $language, true, 'english');
        }
    }
    $initial = zm_pb_module_languages_state($directory);
    $initialCount = count($initial['enabled']);
    ml_check($initialCount > 1, 'Initial language lists are wrong.');

    zm_pb_module_languages_toggle($directory, 'german', false, 'english');
    $state = zm_pb_module_languages_state($directory);
    ml_check(!isset($state['enabled']['german']) && isset($state['disabled']['german']),
        'Disabling did not move the language.');
    ml_check(!isset((require $directory . '/supported_langs.php')['german']),
        'The public supported list still exposes a disabled language.');
    zm_pb_module_languages_toggle($directory, 'german', false, 'english');
    zm_pb_module_languages_toggle($directory, 'german', true, 'english');
    $state = zm_pb_module_languages_state($directory);
    ml_check(isset($state['enabled']['german']) && !isset($state['disabled']['german']),
        'Enabling did not restore the language.');

    zm_pb_module_languages_toggle($directory, 'portuguese-pt', false, 'english');
    $state = zm_pb_module_languages_state($directory);
    ml_check($state['enabled']['portuguese-br']['route_code'] === 'pt-BR',
        'Disabling the primary Portuguese language changed the Brazilian route.');
    zm_pb_module_languages_toggle($directory, 'portuguese-pt', true, 'english');
    ml_check(zm_pb_module_languages_state($directory)['enabled']['portuguese-pt']['route_code'] === 'pt',
        'Re-enabling the primary Portuguese language changed its route.');
    zm_pb_module_languages_toggle($directory, 'portuguese-br', false, 'english');
    zm_pb_module_languages_toggle($directory, 'portuguese-pt', false, 'english');
    zm_pb_module_languages_toggle($directory, 'portuguese-br', true, 'english');
    ml_check(zm_pb_module_languages_state($directory)['enabled']['portuguese-br']['route_code'] === 'pt-BR',
        'Re-enabling a regional variant without its primary language changed its route.');
    zm_pb_module_languages_toggle($directory, 'portuguese-pt', true, 'english');
    try {
        zm_pb_module_languages_toggle($directory, 'portuguese-pt', false, 'portugues');
        throw new RuntimeException('The aliased WHMCS default language was disabled.');
    } catch (InvalidArgumentException $error) {
        ml_check(strpos($error->getMessage(), 'default language') !== false,
            'The aliased default language was rejected for the wrong reason.');
    }

    try {
        zm_pb_module_languages_toggle($directory, 'english', false, 'english');
        throw new RuntimeException('The default language was disabled.');
    } catch (InvalidArgumentException $error) {
        ml_check(strpos($error->getMessage(), 'default language') !== false,
            'The default language was rejected for the wrong reason.');
    }
    ml_check(count(zm_pb_module_languages_state($directory)['enabled']) === $initialCount,
        'A rejected operation changed the language lists.');
    echo "PASS module language toggles, default protection and regional routes\n";
} finally {
    foreach (glob($directory . '/*') ?: [] as $file) if (is_file($file)) unlink($file);
    if (is_file($directory . '/.zm-pb-langs.lock')) unlink($directory . '/.zm-pb-langs.lock');
    rmdir($directory);
}
