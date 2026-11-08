<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Build a salt with every required character group. */
function zm_pb_random_activation_salt(): string
{
    $groups = [
        '0123456789',
        'abcdefghijklmnopqrstuvwxyz',
        'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        '@|{}-_[]()*!+,.&`=:;/<>'
    ];
    $characters = [];
    foreach ($groups as $group) {
        $characters[] = $group[random_int(0, strlen($group) - 1)];
    }
    $alphabet = implode('', $groups);
    for ($i = count($characters); $i < 64; $i++) {
        $characters[] = $alphabet[random_int(0, strlen($alphabet) - 1)];
    }
    for ($i = count($characters) - 1; $i > 0; $i--) {
        $swap = random_int(0, $i);
        [$characters[$i], $characters[$swap]] = [$characters[$swap], $characters[$i]];
    }
    return implode('', $characters);
}

/** Replace the three installation salts on every activation. */
function zm_pb_regenerate_activation_salts(string $file): void
{
    $lock = @fopen(dirname($file) . '/.zm-pb-salts.lock', 'c');
    if ($lock === false) throw new RuntimeException('Cannot open the module salt lock file.');

    try {
        if (!flock($lock, LOCK_EX)) throw new RuntimeException('Cannot lock the module salt file.');
        $contents = @file_get_contents($file);
        if ($contents === false) throw new RuntimeException('Cannot read module_init.php to update its salts.');

        $marker = '### SALTS CONSTS ###';
        $start = strpos($contents, $marker);
        $end = $start === false ? false : strpos($contents, $marker, $start + strlen($marker));
        if ($end === false) throw new RuntimeException('The salt block is missing from module_init.php.');

        $blockStart = $start + strlen($marker);
        $block = substr($contents, $blockStart, $end - $blockStart);
        foreach (['ZM_PB_ADMIN_SALT', 'ZM_PB_SECURE_SALT', 'ZM_PB_NONCE_SALT'] as $name) {
            $quoted = preg_quote($name, '/');
            $pattern = '/^([ \t]*)if[ \t]*\([ \t]*!defined\([\'\"]' . $quoted
                . '[\'\"]\)[ \t]*\)[ \t]*define\([\'\"]' . $quoted
                . '[\'\"][ \t]*,[^\r\n]*\);[ \t]*(\r?)$/m';
            $matches = preg_match_all($pattern, $block);
            if ($matches !== 1) throw new RuntimeException('Expected one writable definition for ' . $name . ' in module_init.php.');
            $salt = var_export(zm_pb_random_activation_salt(), true);
            $block = preg_replace_callback($pattern, static function ($match) use ($name, $salt) {
                return $match[1] . "if (!defined('" . $name . "')) define('" . $name . "', " . $salt . ");" . $match[2];
            }, $block, 1);
            if ($block === null) throw new RuntimeException('Could not update ' . $name . ' in module_init.php.');
        }

        $updated = substr($contents, 0, $blockStart) . $block . substr($contents, $end);
        $temporary = @tempnam(dirname($file), '.zm-pb-salts-');
        if ($temporary === false) throw new RuntimeException('Cannot create a temporary module_init.php file.');
        if (realpath(dirname($temporary)) !== realpath(dirname($file))) {
            @unlink($temporary);
            throw new RuntimeException('Cannot create a temporary file beside module_init.php.');
        }
        $temporaryPhp = $temporary . '.php';
        try {
            if (!@rename($temporary, $temporaryPhp)) throw new RuntimeException('Cannot prepare the temporary module_init.php file.');
            if (@file_put_contents($temporaryPhp, $updated, LOCK_EX) !== strlen($updated)) {
                throw new RuntimeException('Cannot write the new salts to module_init.php.');
            }
            $permissions = @fileperms($file);
            if ($permissions !== false) @chmod($temporaryPhp, $permissions & 0777);
            if (!@rename($temporaryPhp, $file)) throw new RuntimeException('Cannot replace module_init.php with the new salts.');
        } finally {
            if (is_file($temporary)) @unlink($temporary);
            if (is_file($temporaryPhp)) @unlink($temporaryPhp);
        }

        if (function_exists('opcache_invalidate')) @opcache_invalidate($file, true);
    } finally {
        flock($lock, LOCK_UN);
        fclose($lock);
    }
}
