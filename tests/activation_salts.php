<?php
/** Exercise salt rotation against a copy of module_init.php. */
define('ZM_PB_VER', 'test');
require dirname(__DIR__) . '/inc/activation_salts.php';

$directory = sys_get_temp_dir() . '/zm-pb-salts-' . bin2hex(random_bytes(8));
if (!mkdir($directory, 0700)) throw new RuntimeException('Cannot create test directory.');
$file = $directory . '/module_init.php';
if (!copy(dirname(__DIR__) . '/module_init.php', $file)) throw new RuntimeException('Cannot copy module_init.php.');

try {
    $original = file_get_contents($file);
    $withoutSalts = static function ($source) {
        return preg_replace("/(define\\('ZM_PB_(?:ADMIN|SECURE|NONCE)_SALT', )'[^']*'/", "$1'<salt>'", $source);
    };
    $symbols = '@|{}-_[]()*!+,.&`=:;/<>';
    $allowed = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' . $symbols;
    $previous = [];
    foreach (range(1, 2) as $activation) {
        zm_pb_regenerate_activation_salts($file);
        $updated = file_get_contents($file);
        if ($withoutSalts($updated) !== $withoutSalts($original)) {
            throw new RuntimeException('Salt rotation changed unrelated module settings.');
        }
        $values = [];
        foreach (['ZM_PB_ADMIN_SALT', 'ZM_PB_SECURE_SALT', 'ZM_PB_NONCE_SALT'] as $name) {
            if (!preg_match("/define\\('" . $name . "', '([^']{64})'\\);/", $updated, $match)) {
                throw new RuntimeException('Missing generated salt: ' . $name);
            }
            if (!preg_match('/[0-9]/', $match[1]) || !preg_match('/[a-z]/', $match[1]) ||
                !preg_match('/[A-Z]/', $match[1]) || strpbrk($match[1], $symbols) === false) {
                throw new RuntimeException('A required character group is missing from ' . $name);
            }
            foreach (str_split($match[1]) as $character) {
                if (strpos($allowed, $character) === false) {
                    throw new RuntimeException('Unexpected character in ' . $name);
                }
            }
            $values[] = $match[1];
        }
        if (count(array_unique($values)) !== 3 || $values === $previous) {
            throw new RuntimeException('Activation salts were not regenerated independently.');
        }
        $previous = $values;
    }
    $broken = str_replace("if (!defined('ZM_PB_NONCE_SALT')) define('ZM_PB_NONCE_SALT', '" . $previous[2] . "');", '', $updated);
    if ($broken === $updated || file_put_contents($file, $broken) !== strlen($broken)) {
        throw new RuntimeException('Cannot prepare the incomplete salt block fixture.');
    }
    try {
        zm_pb_regenerate_activation_salts($file);
        throw new RuntimeException('An incomplete salt block was accepted.');
    } catch (RuntimeException $error) {
        if (strpos($error->getMessage(), 'Expected one writable definition') === false) throw $error;
    }
    if (file_get_contents($file) !== $broken) throw new RuntimeException('A failed rotation changed module_init.php.');
    echo "PASS activation salts rotate, stay distinct, and leave invalid files untouched\n";
} finally {
    foreach (glob($directory . '/*') ?: [] as $path) if (is_file($path)) unlink($path);
    if (is_file($directory . '/.zm-pb-salts.lock')) unlink($directory . '/.zm-pb-salts.lock');
    rmdir($directory);
}
