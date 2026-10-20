<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** The editor only accepts directories discovered here, never a path from a request. */
function zm_pb_lm_sections(): array
{
    $adminDir = defined('ADMIN_PATH') ? ADMIN_PATH : dirname($_SERVER['SCRIPT_FILENAME'] ?? '');
    if (!is_dir($adminDir . '/lang') && !empty($GLOBALS['customadminpath']) &&
        is_string($GLOBALS['customadminpath']))
        $adminDir = ROOTDIR . '/' . trim($GLOBALS['customadminpath'], '/\\');
    if (!is_dir($adminDir . '/lang')) $adminDir = ROOTDIR . '/admin';
    $sections = [
        'whmcs_client' => ['title' => 'WHMCS — client', 'directory' => ROOTDIR . '/lang', 'kind' => 'client', 'variable' => '$_LANG'],
        'whmcs_admin' => ['title' => 'WHMCS — admin', 'directory' => $adminDir . '/lang', 'kind' => 'admin', 'variable' => '$_ADMINLANG'],
        'module_self' => ['title' => 'zmchel WHMCS Multimodule — admin', 'directory' => ZM_PB_ALANGDIR, 'kind' => 'self', 'variable' => ''],
    ];
    $modulesDir = ROOTDIR . '/modules';
    if (!is_dir($modulesDir)) return $sections;
    $modulesRoot = realpath($modulesDir);
    foreach (scandir($modulesDir) ?: [] as $group) {
        if (!preg_match('/^[a-zA-Z0-9_-]+$/D', $group) || !is_dir($modulesDir . '/' . $group)) continue;
        foreach (scandir($modulesDir . '/' . $group) ?: [] as $module) {
            if (!preg_match('/^[a-zA-Z0-9_-]+$/D', $module)) continue;
            $base = $modulesDir . '/' . $group . '/' . $module;
            $resolved = realpath($base);
            if (!$resolved || strpos($resolved, $modulesRoot . DIRECTORY_SEPARATOR) !== 0 ||
                $resolved === realpath(ZM_PB_ROOTDIR)) continue;
            foreach (['lang' => 'client', 'admin_lang' => 'admin'] as $folder => $kind) {
                $langDir = realpath($base . '/' . $folder);
                if (!$langDir || strpos($langDir, $resolved . DIRECTORY_SEPARATOR) !== 0) continue;
                $id = 'module:' . $group . ':' . $module . ':' . $folder;
                $sections[$id] = ['title' => $module . ' — ' . $folder, 'directory' => $langDir,
                    'kind' => 'module', 'variable' => '$_ADDONLANG'];
            }
        }
    }
    return $sections;
}

function zm_pb_lm_files(array $section): array
{
    $result = [];
    foreach (['enabled' => $section['directory'], 'disabled' => $section['directory'] . '/disabled'] as $state => $dir) {
        if (!is_dir($dir) || is_link($dir)) continue;
        foreach (glob($dir . '/*.php') ?: [] as $file) {
            $name = basename($file, '.php');
            if ($name === 'index' || is_link($file) || !preg_match('/^[a-z0-9_-]+$/D', $name)) continue;
            if (!isset($result[$name]) || $state === 'enabled') $result[$name] = ['file' => $file, 'state' => $state];
        }
    }
    ksort($result);
    return $result;
}

function zm_pb_lm_name(array $section, string $supported): string
{
    if ($supported === 'ukranian' &&
        (is_file($section['directory'] . '/ukrainian.php') ||
         is_file($section['directory'] . '/disabled/ukrainian.php'))) return 'ukrainian';
    if ($section['kind'] === 'self' || $section['kind'] === 'admin') {
        if ($supported === 'portuguese-pt') return 'portugues';
        if ($supported === 'portuguese-br') return 'portugues-br';
    }
    return $supported;
}

function zm_pb_lm_supported_name(array $section, string $name): ?string
{
    foreach (array_keys(ZM_PB_LANGS) as $key) {
        if (zm_pb_lm_name($section, $key) === $name) return $key;
    }
    return null;
}

function zm_pb_lm_variable(array $section, string $file): string
{
    if ($section['kind'] !== 'module') return $section['variable'];
    $source = file_get_contents($file);
    if (preg_match('/\$_(ADDONLANG|ADMINLANG|LANG)\s*(?:\[|=)/', (string) $source, $matches))
        return '$_' . $matches[1];
    return '';
}

/** Load only a previously discovered PHP catalog inside a local scope. */
function zm_pb_lm_load_php(string $file, string $variable)
{
    $read = static function ($path) use ($variable) {
        $_LANG = []; $_ADMINLANG = []; $_ADDONLANG = [];
        $returned = require $path;
        if ($variable === '$_LANG') return $_LANG;
        if ($variable === '$_ADMINLANG') return $_ADMINLANG;
        if ($variable === '$_ADDONLANG') return $_ADDONLANG;
        return $returned;
    };
    return $read($file);
}

function zm_pb_lm_copy($value)
{
    if (is_object($value)) {
        $copy = new stdClass();
        foreach ($value as $key => $item) $copy->$key = zm_pb_lm_copy($item);
        return $copy;
    }
    if (is_array($value)) return array_map('zm_pb_lm_copy', $value);
    return $value;
}

function zm_pb_lm_merge($base, $extra)
{
    if (is_object($base) && is_object($extra)) {
        foreach ($extra as $key => $item) $base->$key = isset($base->$key) ? zm_pb_lm_merge($base->$key, $item) : zm_pb_lm_copy($item);
        return $base;
    }
    if (is_array($base) && is_array($extra)) {
        foreach ($extra as $key => $item) $base[$key] = array_key_exists($key, $base) ? zm_pb_lm_merge($base[$key], $item) : zm_pb_lm_copy($item);
        return $base;
    }
    return zm_pb_lm_copy($extra);
}

function zm_pb_lm_set(&$catalog, array $path, string $value): void
{
    $cursor =& $catalog;
    foreach ($path as $index => $segment) {
        if (!isset($segment['type'], $segment['key']) || !in_array($segment['type'], ['array', 'object'], true)) return;
        $key = $segment['key'];
        if ($segment['type'] === 'object') {
            if (!is_object($cursor)) return;
            if ($index === count($path) - 1) { $cursor->$key = $value; return; }
            if (!isset($cursor->$key)) $cursor->$key = $path[$index + 1]['type'] === 'object' ? new stdClass() : [];
            $cursor =& $cursor->$key;
        } else {
            if (!is_array($cursor)) return;
            if ($index === count($path) - 1) { $cursor[$key] = $value; return; }
            if (!isset($cursor[$key])) $cursor[$key] = $path[$index + 1]['type'] === 'object' ? new stdClass() : [];
            $cursor =& $cursor[$key];
        }
    }
}

function zm_pb_lm_own(string $name, bool $allowDisabled = false, bool $withOverride = true)
{
    $english = ZM_PB_ALANGDIR . 'english.php';
    $default = $name === 'english' ? require $english : zm_pb_lm_own('english', false, $withOverride);
    $file = ZM_PB_ALANGDIR . $name . '.php';
    if ($allowDisabled && !is_file($file)) $file = ZM_PB_ALANGDIR . 'disabled/' . $name . '.php';
    if ($name !== 'english' && is_file($file) && filesize($file)) {
        $result = require $file;
        if (is_object($result)) {
            if (!get_object_vars($result)) {
                $preferred = zm_pb_lm_name(['kind' => 'self', 'directory' => ZM_PB_ALANGDIR], ZM_PB_DEFLANG);
                if ($preferred !== $name && is_file(ZM_PB_ALANGDIR . $preferred . '.php'))
                    $default = zm_pb_lm_own($preferred, false, $withOverride);
            } else $default = zm_pb_lm_merge($default, $result);
        }
    }
    foreach ($withOverride ? [ZM_PB_ALANGDIR . 'overrides/' . $name . '.php',
        ZM_PB_ALANGDIR . 'overrides/managed/' . $name . '.php'] : [] as $override) {
        if (!is_file($override)) continue;
        try {
            $entries = require $override;
            if (is_object($entries)) $default = zm_pb_lm_merge($default, $entries);
            if (is_array($entries)) foreach ($entries as $entry) {
                if (isset($entry['path'], $entry['value']) && is_array($entry['path']) && is_string($entry['value']))
                    zm_pb_lm_set($default, $entry['path'], $entry['value']);
            }
        } catch (Throwable $error) {
            error_log('zmchel language override: ' . $error->getMessage());
        }
    }
    return $default;
}

function zm_pb_lm_catalog(array $section, string $name, bool $withOverride = true)
{
    if ($section['kind'] === 'self') return zm_pb_lm_own($name, true, $withOverride);
    $files = zm_pb_lm_files($section);
    if (!isset($files[$name])) return [];
    $file = $files[$name]['file'];
    $variable = zm_pb_lm_variable($section, $file);
    if ($variable === '' && $section['kind'] !== 'module')
        throw new RuntimeException('This catalog does not use a supported PHP language variable.');
    if (!$withOverride && $section['kind'] === 'module') {
        $previousSkip = $GLOBALS['ZM_PB_LM_SKIP_OVERRIDES'] ?? null;
        $GLOBALS['ZM_PB_LM_SKIP_OVERRIDES'] = true;
        try {
            $catalog = zm_pb_lm_load_php($file, $variable);
        } finally {
            if ($previousSkip === null) unset($GLOBALS['ZM_PB_LM_SKIP_OVERRIDES']);
            else $GLOBALS['ZM_PB_LM_SKIP_OVERRIDES'] = $previousSkip;
        }
    } else $catalog = zm_pb_lm_load_php($file, $variable);
    if ($variable === '') return is_array($catalog) || is_object($catalog) ? $catalog : [];
    $override = $section['directory'] . '/overrides/' . $name . '.php';
    $moduleAlreadyLoaded = $section['kind'] === 'module' && $files[$name]['state'] === 'enabled' &&
        strpos((string) file_get_contents($file), 'ZM_PB_LM_INCLUDE:' . $name) !== false;
    if ($withOverride && is_file($override) && !$moduleAlreadyLoaded) {
        $changes = zm_pb_lm_load_php($override, $variable);
        $catalog = zm_pb_lm_merge($catalog, $changes);
    }
    return $catalog;
}

function zm_pb_lm_source_catalog(array $section, string $name, string $reference)
{
    $source = zm_pb_lm_catalog($section, $reference, false);
    if ($name === $reference) return $source;
    return zm_pb_lm_merge(zm_pb_lm_copy($source), zm_pb_lm_catalog($section, $name, false));
}

function zm_pb_lm_flatten($catalog, array $path = [], array &$rows = []): array
{
    if (is_array($catalog) || is_object($catalog)) {
        foreach ($catalog as $key => $item) {
            $next = $path;
            $next[] = ['type' => is_object($catalog) ? 'object' : 'array', 'key' => $key];
            zm_pb_lm_flatten($item, $next, $rows);
        }
    } elseif (is_string($catalog) || is_numeric($catalog)) {
        $id = zm_pb_lm_path_id($path);
        $rows[$id] = ['path' => $path, 'value' => (string) $catalog, 'label' => zm_pb_lm_path_label($path), 'id' => $id];
    }
    return $rows;
}

function zm_pb_lm_filter_rows(array $rows, string $query, string $view = 'all'): array
{
    $query = trim($query);
    return array_filter($rows, static function (array $row) use ($query, $view): bool {
        if ($view === 'original' && !empty($row['added'])) return false;
        if ($view === 'added' && empty($row['added'])) return false;
        if ($query === '') return true;
        foreach (['label', 'value', 'source'] as $field) {
            $text = $row[$field] ?? '';
            if (function_exists('mb_stripos') ? mb_stripos($text, $query, 0, 'UTF-8') !== false :
                stripos($text, $query) !== false) return true;
        }
        return false;
    });
}

function zm_pb_lm_containers($catalog, array $path = [], array &$result = []): array
{
    if (!is_array($catalog) && !is_object($catalog)) return $result;
    $result[] = ['id' => $path ? base64_encode(json_encode($path, JSON_UNESCAPED_UNICODE)) : '',
        'label' => $path ? zm_pb_lm_path_label($path) : '(root)'];
    foreach ($catalog as $key => $value) {
        if (!is_array($value) && !is_object($value)) continue;
        $next = $path;
        $next[] = ['type' => is_object($catalog) ? 'object' : 'array', 'key' => $key];
        zm_pb_lm_containers($value, $next, $result);
    }
    return $result;
}

function zm_pb_lm_at($catalog, array $path)
{
    foreach ($path as $part) {
        $key = $part['key'];
        if (is_object($catalog) && property_exists($catalog, (string) $key)) $catalog = $catalog->$key;
        elseif (is_array($catalog) && array_key_exists($key, $catalog)) $catalog = $catalog[$key];
        else return null;
    }
    return $catalog;
}

function zm_pb_lm_path_label(array $path): string
{
    $label = '';
    foreach ($path as $part) {
        $label .= $part['type'] === 'object' ? ($label === '' ? (string) $part['key'] : '->' . $part['key'])
            : '[' . var_export($part['key'], true) . ']';
    }
    return $label;
}

function zm_pb_lm_path_id(array $path): string
{
    return base64_encode(json_encode($path, JSON_UNESCAPED_UNICODE));
}

function zm_pb_lm_path(string $encoded): array
{
    if (strlen($encoded) > 4096) throw new InvalidArgumentException('Invalid translation key.');
    $json = base64_decode($encoded, true);
    $path = $json === false ? null : json_decode($json, true);
    if (!is_array($path) || !$path || count($path) > 12) throw new InvalidArgumentException('Invalid translation key.');
    foreach ($path as $segment) {
        if (!is_array($segment) || !isset($segment['type'], $segment['key']) ||
            !in_array($segment['type'], ['array', 'object'], true) ||
            !(is_string($segment['key']) || is_int($segment['key'])) ||
            strlen((string) $segment['key']) > 200 || (string) $segment['key'] === '')
            throw new InvalidArgumentException('Invalid translation key.');
    }
    return $path;
}

function zm_pb_lm_managed_entries(string $file): array
{
    if (!is_file($file)) return [];
    $content = file_get_contents($file);
    if ($content === false) throw new RuntimeException('Cannot read the existing override.');
    if (!preg_match('~/\* ZM_PB_LM_DATA:([A-Za-z0-9+/=]+) \*/~', (string) $content, $match)) return [];
    $data = json_decode(base64_decode($match[1], true), true);
    return is_array($data) ? $data : [];
}

function zm_pb_lm_write(string $file, string $content): void
{
    $dir = dirname($file);
    if (!is_dir($dir) && !mkdir($dir, 0750, true) && !is_dir($dir)) throw new RuntimeException('Cannot create the override directory.');
    if (is_link($dir) || is_link($file)) throw new RuntimeException('Symbolic links cannot be edited.');
    $temp = tempnam($dir, '.zm-pb-');
    if ($temp === false) throw new RuntimeException('Cannot create a temporary file.');
    try {
        if (is_file($file)) {
            $mode = fileperms($file);
            if ($mode === false) throw new RuntimeException('Cannot read file permissions.');
            chmod($temp, $mode & 0777);
        }
        if (file_put_contents($temp, $content) !== strlen($content) || !rename($temp, $file))
            throw new RuntimeException('Cannot save the language file.');
        if (function_exists('opcache_invalidate')) @opcache_invalidate($file, true);
    } finally {
        if (is_file($temp)) unlink($temp);
    }
}

function zm_pb_lm_save(array $section, string $name, array $path, string $value, bool $custom = false): void
{
    if (strlen($value) > 65535 || strpos($value, "\0") !== false || preg_match('//u', $value) !== 1)
        throw new InvalidArgumentException('Invalid translation text.');
    zm_pb_lm_update_entries($section, $name, static function (array $entries) use ($path, $value, $custom): array {
        $entryId = zm_pb_lm_path_id($path);
        $entries[$entryId] = ['path' => $path, 'value' => $value,
            'custom' => $custom || !empty($entries[$entryId]['custom'])];
        return $entries;
    });
}

function zm_pb_lm_change_custom(array $section, string $name, array $path, ?string $newKey): void
{
    if ($newKey !== null && ($newKey === '' || strlen($newKey) > 200 ||
        preg_match('//u', $newKey) !== 1 || preg_match('/[\x00-\x1F]/', $newKey)))
        throw new InvalidArgumentException('Invalid translation key.');
    zm_pb_lm_update_entries($section, $name, static function (array $entries) use ($section, $name, $path, $newKey): array {
        $entryId = zm_pb_lm_path_id($path);
        if (empty($entries[$entryId]['custom']))
            throw new InvalidArgumentException('Only added translations can be changed or deleted.');
        if ($newKey === null) {
            unset($entries[$entryId]);
            return $entries;
        }
        $last = count($path) - 1;
        if ((string) $path[$last]['key'] === $newKey) return $entries;
        $catalog = zm_pb_lm_catalog($section, $name);
        $parent = zm_pb_lm_at($catalog, array_slice($path, 0, -1));
        if (!is_array($parent) && !is_object($parent))
            throw new InvalidArgumentException('Translation parent not found.');
        if ((is_array($parent) && array_key_exists($newKey, $parent)) ||
            (is_object($parent) && property_exists($parent, $newKey)))
            throw new InvalidArgumentException('Translation key already exists.');
        $newPath = $path;
        $newPath[$last]['key'] = $newKey;
        $newId = zm_pb_lm_path_id($newPath);
        if (isset($entries[$newId])) throw new InvalidArgumentException('Translation key already exists.');
        $entry = $entries[$entryId];
        $entry['path'] = $newPath;
        unset($entries[$entryId]);
        $entries[$newId] = $entry;
        return $entries;
    });
}

function zm_pb_lm_update_entries(array $section, string $name, callable $change): void
{
    $files = zm_pb_lm_files($section);
    if (!isset($files[$name])) throw new InvalidArgumentException('Language not found.');
    $dir = $section['directory'] . '/overrides' . ($section['kind'] === 'self' ? '/managed' : '');
    if (!is_dir($dir) && !mkdir($dir, 0750, true) && !is_dir($dir)) throw new RuntimeException('Cannot create the override directory.');
    $lock = fopen($dir . '/.zm-pb-language-manager.lock', 'c');
    if (!$lock || !flock($lock, LOCK_EX)) throw new RuntimeException('Cannot lock the language file.');
    try {
        $file = $dir . '/' . $name . '.php';
        $entries = zm_pb_lm_managed_entries($file);
        $entries = $change($entries);
        if ($section['kind'] === 'module') zm_pb_lm_upgrade_module_include($files[$name]['file'], $name);
        $original = zm_pb_lm_catalog($section, $name, false);
        foreach ($entries as $id => $entry) {
            $baseValue = zm_pb_lm_at($original, $entry['path']);
            if ((is_string($baseValue) || is_numeric($baseValue)) &&
                $entry['value'] === (string) $baseValue) unset($entries[$id]);
        }
        if ($section['kind'] === 'self') {
            $regular = []; $customEntries = [];
            foreach ($entries as $entry) {
                if (!empty($entry['custom'])) $customEntries[] = $entry;
                else $regular[] = $entry;
            }
            $content = "<?php\n/* Managed by zmchel language manager. */\n";
            if (is_file($file)) {
                $existing = file_get_contents($file);
                if ($existing === false) throw new RuntimeException('Cannot read the existing override.');
                if (strpos($existing, 'Managed by zmchel language manager.') === false)
                    throw new RuntimeException('An existing override file is not managed by this editor.');
            }
            if (!$entries) {
                if (is_file($file) && !unlink($file)) throw new RuntimeException('Cannot remove the empty override.');
                if (function_exists('opcache_invalidate')) @opcache_invalidate($file, true);
                return;
            }
            $marker = base64_encode(json_encode($entries, JSON_UNESCAPED_UNICODE));
            $content .= "/* ZM_PB_LM_DATA:$marker */\nreturn array_merge(\n" .
                var_export($regular, true) . ",\n/* CUSTOMS */\n" . var_export($customEntries, true) . "\n);\n";
            zm_pb_lm_write($file, $content);
            return;
        }
        $variable = zm_pb_lm_variable($section, $files[$name]['file']);
        if ($variable === '') throw new RuntimeException('This catalog cannot be saved automatically.');
        $lines = []; $customLines = [];
        foreach ($entries as $entry) {
            $expression = $variable;
            foreach ($entry['path'] as $segment) {
                $expression .= $segment['type'] === 'object' ? '->{' . var_export($segment['key'], true) . '}' : '[' . var_export($segment['key'], true) . ']';
            }
            $line = $expression . ' = ' . var_export($entry['value'], true) . ';';
            if (!empty($entry['custom'])) $customLines[] = $line;
            else $lines[] = $line;
        }
        $marker = base64_encode(json_encode($entries, JSON_UNESCAPED_UNICODE));
        $block = "/* ZM_PB_LM_START */\n/* ZM_PB_LM_DATA:$marker */\n" . implode("\n", $lines) .
            ($customLines ? "\n/* CUSTOMS */\n" . implode("\n", $customLines) : '') . "\n/* ZM_PB_LM_END */";
        $content = is_file($file) ? file_get_contents($file) : "<?php\n";
        if ($content === false) throw new RuntimeException('Cannot read the existing override.');
        $pattern = '~/\* ZM_PB_LM_START \*/.*?/\* ZM_PB_LM_END \*/~s';
        if (!$entries) {
            if (!preg_match($pattern, $content)) return;
            $content = preg_replace($pattern, '', $content, 1);
            if (preg_match('/^\s*(?:<\?php\s*|\?>\s*)+$/', $content)) {
                if (!unlink($file)) throw new RuntimeException('Cannot remove the empty override.');
                if (function_exists('opcache_invalidate')) @opcache_invalidate($file, true);
            } else zm_pb_lm_write($file, $content);
            return;
        }
        if (preg_match($pattern, $content)) $content = preg_replace_callback($pattern, static function () use ($block) { return $block; }, $content, 1);
        else $content .= (preg_match('/\?>\s*$/', $content) ? "\n<?php\n" : "\n") . $block . "\n";
        zm_pb_lm_write($file, $content);
        if ($section['kind'] === 'module') zm_pb_lm_ensure_module_include($files[$name]['file'], $name);
    } finally {
        flock($lock, LOCK_UN);
        fclose($lock);
    }
}

function zm_pb_lm_ensure_module_include(string $file, string $name): void
{
    $source = file_get_contents($file);
    if ($source === false) throw new RuntimeException('Cannot read the module language file.');
    $tag = 'ZM_PB_LM_INCLUDE:' . $name;
    if (strpos($source, $tag) !== false) return;
    $line = "// $tag\nif (empty(\$GLOBALS['ZM_PB_LM_SKIP_OVERRIDES']) && is_file(__DIR__ . '/overrides/$name.php')) require __DIR__ . '/overrides/$name.php';\n";
    $source .= (preg_match('/\?>\s*$/', $source) ? "\n<?php\n" : "\n") . $line;
    zm_pb_lm_write($file, $source);
}

function zm_pb_lm_upgrade_module_include(string $file, string $name): void
{
    $source = file_get_contents($file);
    if ($source === false) throw new RuntimeException('Cannot read the module language file.');
    if (strpos($source, 'ZM_PB_LM_INCLUDE:' . $name) === false) return;
    $old = "if (is_file(__DIR__ . '/overrides/$name.php')) require __DIR__ . '/overrides/$name.php';";
    $new = "if (empty(\$GLOBALS['ZM_PB_LM_SKIP_OVERRIDES']) && is_file(__DIR__ . '/overrides/$name.php')) require __DIR__ . '/overrides/$name.php';";
    if (strpos($source, $old) !== false) zm_pb_lm_write($file, str_replace($old, $new, $source));
}

function zm_pb_lm_added_backup(array $section, string $name, string $state): string
{
    return $section['directory'] . '/overrides/.zm-pb-added-languages/' . $state . '/' . $name . '.php';
}

function zm_pb_lm_is_added_file(string $file): bool
{
    if (!is_file($file) || is_link($file)) return false;
    $source = file_get_contents($file);
    if ($source === false) throw new RuntimeException('Cannot read the language file.');
    if (strpos($source, '/* Added by zmchel language manager. */') !== false) return true;
    // Earlier manager versions created this exact loader without a marker.
    return (bool) preg_match("~^<\\?php\\s+require \\(is_file\\(__DIR__ \\. '/[a-z0-9_-]+\\.php'\\) \\? __DIR__ : dirname\\(__DIR__\\)\\) \\. '/[a-z0-9_-]+\\.php';~", $source);
}

function zm_pb_lm_sync_added_backup(array $section, string $name, string $state, string $file): void
{
    if (!in_array($section['kind'], ['client', 'admin'], true) || !zm_pb_lm_is_added_file($file)) return;
    $source = file_get_contents($file);
    if ($source === false) throw new RuntimeException('Cannot read the language file.');
    $backup = zm_pb_lm_added_backup($section, $name, $state);
    if (!is_file($backup) || file_get_contents($backup) !== $source) zm_pb_lm_write($backup, $source);
    $other = zm_pb_lm_added_backup($section, $name, $state === 'enabled' ? 'disabled' : 'enabled');
    if (is_file($other) && !is_link($other) && !unlink($other))
        throw new RuntimeException('Cannot remove the old language backup.');
}

/** Keep manager-created WHMCS languages available after core updates. */
function zm_pb_lm_restore_added_languages(): void
{
    foreach (zm_pb_lm_sections() as $id => $section) {
        if (!in_array($id, ['whmcs_client', 'whmcs_admin'], true)) continue;
        $disabledBackups = dirname(zm_pb_lm_added_backup($section, 'example', 'disabled'));
        if (is_dir($disabledBackups) && !is_link($disabledBackups)) {
            foreach (glob($disabledBackups . '/*.php') ?: [] as $backup) {
                $name = basename($backup, '.php');
                if (!preg_match('/^[a-z0-9_-]+$/D', $name) || is_link($backup)) continue;
                $enabled = $section['directory'] . '/' . $name . '.php';
                $disabled = $section['directory'] . '/disabled/' . $name . '.php';
                if (!is_file($enabled) || is_link($enabled) || is_link($disabled)) continue;
                if (!is_dir(dirname($disabled)) && !mkdir(dirname($disabled), 0750, true))
                    throw new RuntimeException('Cannot create the disabled directory.');
                $previous = null;
                if (is_file($disabled)) {
                    $previous = $disabled . '.previous-' . date('YmdHis') . '-' . bin2hex(random_bytes(3));
                    if (!rename($disabled, $previous)) throw new RuntimeException('Cannot back up the disabled language.');
                }
                if (!rename($enabled, $disabled)) {
                    if ($previous !== null) rename($previous, $disabled);
                    throw new RuntimeException('Cannot restore the disabled language state.');
                }
            }
        }
        foreach (zm_pb_lm_files($section) as $name => $entry) {
            zm_pb_lm_sync_added_backup($section, $name, $entry['state'], $entry['file']);
        }
        foreach (['enabled', 'disabled'] as $state) {
            $dir = dirname(zm_pb_lm_added_backup($section, 'example', $state));
            if (!is_dir($dir) || is_link($dir)) continue;
            foreach (glob($dir . '/*.php') ?: [] as $backup) {
                $name = basename($backup, '.php');
                if (!preg_match('/^[a-z0-9_-]+$/D', $name) || is_link($backup)) continue;
                $target = $section['directory'] . ($state === 'disabled' ? '/disabled' : '') . '/' . $name . '.php';
                if (is_file($target)) continue;
                $source = file_get_contents($backup);
                if ($source === false) throw new RuntimeException('Cannot read the language backup.');
                zm_pb_lm_write($target, $source);
            }
        }
    }
}

function zm_pb_lm_add(array $section, string $name): void
{
    if (zm_pb_lm_supported_name($section, $name) === null)
        throw new InvalidArgumentException('This language cannot be added.');
    $existing = zm_pb_lm_files($section)[$name] ?? null;
    if ($existing) {
        zm_pb_lm_sync_added_backup($section, $name, $existing['state'], $existing['file']);
        return;
    }
    if ($section['kind'] === 'self') $content = "<?php\n/* Custom language; English strings fill missing keys. */\nreturn (object)[];\n";
    else {
        $files = zm_pb_lm_files($section);
        $preferred = zm_pb_lm_name($section, ZM_PB_DEFLANG);
        $reference = isset($files[$preferred]) && $files[$preferred]['state'] === 'enabled' ? $preferred :
            (isset($files['english']) ? 'english' : array_key_first($files));
        if (!$reference || $files[$reference]['state'] !== 'enabled') throw new RuntimeException('No base language is available.');
        $variable = zm_pb_lm_variable($section, $files[$reference]['file']);
        if ($variable === '') throw new RuntimeException('This catalog cannot be added automatically.');
        $content = "<?php\n/* Added by zmchel language manager. */\nrequire (is_file(__DIR__ . '/" . $reference . ".php') ? __DIR__ : dirname(__DIR__)) . '/" . $reference . ".php';\n";
        $content .= $variable . ' = ' . $variable . " ?? [];\n";
        $supported = zm_pb_lm_supported_name($section, $name);
        if ($section['kind'] === 'client') $content .= '$_LANG[\'locale\'] = ' . var_export(ZM_PB_LANGS[$supported]['locale'], true) . ";\n";
    }
    $file = $section['directory'] . '/' . $name . '.php';
    if (is_file($file)) throw new RuntimeException('Language file already exists.');
    if (in_array($section['kind'], ['client', 'admin'], true))
        zm_pb_lm_write(zm_pb_lm_added_backup($section, $name, 'enabled'), $content);
    zm_pb_lm_write($file, $content);
}

function zm_pb_lm_toggle(array $section, string $name, bool $enable): void
{
    $files = zm_pb_lm_files($section);
    if (!isset($files[$name])) throw new InvalidArgumentException('Language not found.');
    if (!$enable && ($name === 'english' || $name === zm_pb_lm_name($section, ZM_PB_DEFLANG)))
        throw new InvalidArgumentException('The default language cannot be disabled.');
    $enabled = $section['directory'] . '/' . $name . '.php';
    $disabled = $section['directory'] . '/disabled/' . $name . '.php';
    if (is_file($enabled) && is_file($disabled))
        throw new RuntimeException('Both enabled and disabled language files already exist.');
    if ($files[$name]['state'] === ($enable ? 'enabled' : 'disabled')) return;
    $target = $section['directory'] . ($enable ? '' : '/disabled') . '/' . $name . '.php';
    if (is_file($target)) throw new RuntimeException('Target language file already exists.');
    if (!is_dir(dirname($target)) && !mkdir(dirname($target), 0750, true)) throw new RuntimeException('Cannot create the disabled directory.');
    $preparedBackup = null;
    $backupExisted = false;
    if (in_array($section['kind'], ['client', 'admin'], true) && zm_pb_lm_is_added_file($files[$name]['file'])) {
        $source = file_get_contents($files[$name]['file']);
        if ($source === false) throw new RuntimeException('Cannot read the language file.');
        $preparedBackup = zm_pb_lm_added_backup($section, $name, $enable ? 'enabled' : 'disabled');
        $backupExisted = is_file($preparedBackup);
        zm_pb_lm_write($preparedBackup, $source);
    }
    if (!rename($files[$name]['file'], $target)) {
        if ($preparedBackup !== null && !$backupExisted) unlink($preparedBackup);
        throw new RuntimeException('Cannot move the language file.');
    }
    if (function_exists('opcache_invalidate')) @opcache_invalidate($target, true);
    zm_pb_lm_sync_added_backup($section, $name, $enable ? 'enabled' : 'disabled', $target);
}

/** Updates may restore files that were intentionally moved to disabled/. */
function zm_pb_lm_recheck_disabled(): void
{
    foreach (zm_pb_lm_sections() as $section) {
        $dir = $section['directory'];
        if (!is_dir($dir . '/disabled') || is_link($dir . '/disabled')) continue;
        foreach (glob($dir . '/disabled/*.php') ?: [] as $disabled) {
            $name = basename($disabled);
            $enabled = $dir . '/' . $name;
            if (!is_file($enabled) || is_link($enabled) || is_link($disabled)) continue;
            $backup = $disabled . '.previous-' . date('YmdHis') . '-' . bin2hex(random_bytes(3));
            if (!rename($disabled, $backup)) throw new RuntimeException('Cannot back up disabled language: ' . $name);
            if (!rename($enabled, $disabled)) {
                rename($backup, $disabled);
                throw new RuntimeException('Cannot disable restored language: ' . $name);
            }
        }
    }
}
