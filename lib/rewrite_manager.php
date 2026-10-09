<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

function zm_pb_rewrite_webserver($software = null) {
    $software = (string) ($software ?? ($_SERVER['SERVER_SOFTWARE'] ?? ''));
    if (preg_match('/\b(?:nginx|openresty)\b/i', $software)) return 'nginx';
    if (preg_match('/\bapache\b/i', $software)) return 'apache';
    return 'unknown';
}

function zm_pb_rewrite_rules() {
    $rules = [];
    foreach (zm_pb_rewrite_custom_rules() as $rule) {
        $directive = zm_pb_rewrite_custom_directive($rule);
        $rules[] = [
            'language' => ZM_PB_ADMINLANG->rewrite_manager->custom,
            'paths' => [$rule['pattern']],
            'directives' => [$directive],
            'custom_id' => hash('sha256', $directive),
        ];
    }
    // Included PHP shares the caller's scope. The defaults file builds its own
    // $rules, so load it separately to preserve the custom rules collected above.
    $defaults = (static function () {
        return require ZM_PB_INCDIR . 'rewrite_rules.php';
    })();
    return array_merge($rules, $defaults);
}

function zm_pb_rewrite_custom_rules() {
    $path = ZM_PB_INCDIR . 'rewrite_rules_custom.php';
    // This file is edited at runtime. A different PHP-FPM worker can still have
    // an older compiled copy when OPcache timestamp validation is disabled.
    clearstatcache(true, $path);
    if (function_exists('opcache_invalidate')) @opcache_invalidate($path, true);
    $rules = require $path;
    if (!is_array($rules)) throw new RuntimeException('rules_file_invalid');
    return $rules;
}

function zm_pb_rewrite_custom_directive($rule) {
    return 'RewriteRule ' . $rule['pattern'] . ' ' . $rule['target'] . ' [' . $rule['flags'] . ']';
}

function zm_pb_rewrite_save_custom_rules($rules) {
    $path = ZM_PB_INCDIR . 'rewrite_rules_custom.php';
    $contents = "<?php\nif (!defined('ZM_PB_VER')) die('Direct access not allowed');\n\nreturn " . var_export(array_values($rules), true) . ";\n";
    $directory = dirname($path);
    $writeError = null;

    // A deployed file may be read-only while the inc directory is writable.
    // Replacing it through a temporary file also avoids leaving partial PHP behind.
    if (is_writable($directory)) {
        $temporary = @tempnam($directory, 'rewrite_');
        if ($temporary !== false) {
            try {
                if (@file_put_contents($temporary, $contents, LOCK_EX) === strlen($contents)) {
                    if (is_file($path)) @chmod($temporary, fileperms($path) & 0777);
                    if (@rename($temporary, $path)) {
                        if (function_exists('opcache_invalidate')) @opcache_invalidate($path, true);
                        return;
                    }
                }
                $writeError = error_get_last()['message'] ?? null;
            } finally {
                if (is_file($temporary)) @unlink($temporary);
            }
        }
    }

    // On Windows replacing an existing file can fail even when it is writable.
    if (is_writable($path)) {
        error_clear_last();
        if (@file_put_contents($path, $contents, LOCK_EX) === strlen($contents)) {
            if (function_exists('opcache_invalidate')) @opcache_invalidate($path, true);
            return;
        }
        $writeError = error_get_last()['message'] ?? $writeError;
    }

    throw new RuntimeException('rules_file_write_failed');
}

function zm_pb_rewrite_add_custom_rule($pattern, $target, $flags) {
    // WHMCS HTML-escapes request values. Undo that once, before validation;
    // stored Apache directives are plain text, and Smarty escapes their display.
    $pattern = trim(html_entity_decode($pattern, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $target = trim(html_entity_decode($target, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $flags = strtoupper(trim(html_entity_decode($flags, ENT_QUOTES | ENT_HTML5, 'UTF-8')));
    if (!preg_match('/^[^\s<>#]{1,200}$/', $pattern) ||
        !preg_match('/^[^\s<>#]{1,500}$/', $target) ||
        !preg_match('/^[A-Z0-9,_=-]{1,100}$/', $flags) ||
        @preg_match('#' . $pattern . '#', '') === false) {
        throw new InvalidArgumentException('invalid_rule');
    }
    $newRule = ['pattern' => $pattern, 'target' => $target, 'flags' => $flags];
    $directive = zm_pb_rewrite_custom_directive($newRule);
    $rules = zm_pb_rewrite_custom_rules();
    foreach (zm_pb_rewrite_rules() as $rule) {
        if (in_array($directive, $rule['directives'], true)) throw new InvalidArgumentException('duplicate_rule');
    }
    $rules[] = $newRule;
    zm_pb_rewrite_save_custom_rules($rules);
}

function zm_pb_rewrite_delete_custom_rule($id) {
    $rules = zm_pb_rewrite_custom_rules();
    foreach ($rules as $index => $rule) {
        if (hash_equals(hash('sha256', zm_pb_rewrite_custom_directive($rule)), $id)) {
            unset($rules[$index]);
            zm_pb_rewrite_save_custom_rules($rules);
            return;
        }
    }
    throw new InvalidArgumentException('invalid_rule');
}

function zm_pb_rewrite_block($rules) {
    $lines = [
        '# BEGIN ZM PageBuilder language routes',
        '<IfModule mod_rewrite.c>',
        'RewriteEngine On',
    ];
    $seen = [];
    foreach ($rules as $rule) {
        foreach ($rule['directives'] as $directive) {
            if (isset($seen[$directive])) continue;
            $seen[$directive] = true;
            $lines[] = $directive;
        }
    }
    $lines[] = '</IfModule>';
    $lines[] = '# END ZM PageBuilder language routes';
    return implode("\n", $lines) . "\n";
}

function zm_pb_rewrite_status($rules) {
    $path = ROOTDIR . '/.htaccess';
    $contents = is_file($path) ? @file_get_contents($path) : '';
    if ($contents === false) throw new RuntimeException('htaccess_read_failed');
    $block = zm_pb_rewrite_block($rules);
    $begin = '# BEGIN ZM PageBuilder language routes';
    $end = '# END ZM PageBuilder language routes';
    $oldBegin = '# BEGIN ZM PageBuilder language homepages';
    $oldEnd = '# END ZM PageBuilder language homepages';
    $normalized = str_replace("\r\n", "\n", $contents);
    foreach ($rules as &$rule) {
        $rule['installed'] = true;
        foreach ($rule['directives'] as $directive) {
            if (strpos($normalized, $directive) === false) $rule['installed'] = false;
        }
    }
    unset($rule);
    return [
        'rules' => $rules,
        'installed' => strpos($normalized, $block) === 0 &&
            substr_count($normalized, $begin) === 1 && substr_count($normalized, $oldBegin) === 0,
        'has_markers' => strpos($contents, $begin) !== false || strpos($contents, $end) !== false ||
            strpos($contents, $oldBegin) !== false || strpos($contents, $oldEnd) !== false,
        'path' => $path,
    ];
}

function zm_pb_rewrite_install($rules) {
    $path = ROOTDIR . '/.htaccess';
    $contents = is_file($path) ? @file_get_contents($path) : '';
    if ($contents === false) throw new RuntimeException('htaccess_read_failed');
    $original = $contents;

    $newline = strpos($contents, "\r\n") !== false ? "\r\n" : "\n";
    $block = str_replace("\n", $newline, zm_pb_rewrite_block($rules));
    foreach ([
        ['# BEGIN ZM PageBuilder language routes', '# END ZM PageBuilder language routes'],
        ['# BEGIN ZM PageBuilder language homepages', '# END ZM PageBuilder language homepages'],
    ] as $markers) {
        [$begin, $end] = $markers;
        if (substr_count($contents, $begin) !== substr_count($contents, $end)) {
            throw new RuntimeException('markers_incomplete');
        }
        while (($start = strpos($contents, $begin)) !== false) {
            $finish = strpos($contents, $end, $start + strlen($begin));
            if ($finish === false) throw new RuntimeException('markers_incomplete');
            $finish += strlen($end);
            if (substr($contents, $finish, strlen($newline)) === $newline) $finish += strlen($newline);
            if (substr($contents, $finish, strlen($newline)) === $newline) $finish += strlen($newline);
            $contents = substr($contents, 0, $start) . substr($contents, $finish);
        }
    }
    $updated = $block . ($contents !== '' ? $newline : '') . $contents;
    if ($updated === $original) return false;
    if (@file_put_contents($path, $updated, LOCK_EX) !== strlen($updated)) {
        throw new RuntimeException('htaccess_write_failed');
    }
    return true;
}
