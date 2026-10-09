<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Never serialize application objects or call their getters/JSON serializers. */
class ZM_PB_SmartyVariables
{
    private static $legacyChecked = false;
    private static function sensitive($name)
    {
        return (bool) preg_match('/password|passwd|secret|token|csrf|session|cookie|credential|api.?key|private.?key|credit.?card|cardnum|cvv|email|phone|address|firstname|lastname|fullname|ipaddress|remoteaddr|clientdetails|loggedinuser|userValidation|^admin$/i', (string) $name);
    }

    public static function members($value)
    {
        if (is_array($value)) return $value;
        if (!is_object($value)) return null;
        // Read only stored attributes/items. Eloquent relations and query builders stay inaccessible.
        $property = $value instanceof \Illuminate\Support\Collection ? 'items'
            : ($value instanceof \Illuminate\Database\Eloquent\Model ? 'attributes' : null);
        if ($property !== null) {
            $reflection = new ReflectionObject($value);
            $field = $reflection->getProperty($property);
            $field->setAccessible(true);
            $data = $field->getValue($value);
            return is_array($data) ? $data : [];
        }
        return $value instanceof stdClass ? get_object_vars($value) : null;
    }

    private static function describe($value, $name, $depth, &$budget)
    {
        if (--$budget < 0) return ['type' => 'unknown', 'truncated' => true];
        $node = ['type' => is_object($value) ? get_class($value) : gettype($value)];
        if (strpos($node['type'], '@anonymous') !== false) $node['type'] = 'anonymous object';
        if (self::sensitive($name)) return $node + ['redacted' => true];
        if ($depth >= 6) return $node + ['truncated' => true];
        $members = self::members($value);
        if ($members !== null) {
            $collection = $value instanceof \Illuminate\Support\Collection;
            $node['kind'] = $collection || !$members || !array_filter(array_keys($members), 'is_string') ? 'list' : 'record';
            $node['children'] = [];
            $sampled = 0;
            foreach ($members as $key => $item) {
                if ($budget <= 0 || count($node['children']) >= 60) { $node['truncated'] = true; break; }
                // Dynamic associative keys might themselves contain personal information.
                if (!$collection && is_string($key) && !preg_match('/^[A-Za-z_][A-Za-z0-9_]{0,79}$/D', $key)) {
                    $node['dynamic_keys'] = true;
                    continue;
                }
                $slot = $collection || is_int($key) ? '[]' : $key;
                $child = self::describe($item, $slot, $depth + 1, $budget);
                $node['children'][$slot] = isset($node['children'][$slot])
                    ? self::merge($node['children'][$slot], $child) : $child;
                if (($collection || is_int($key)) && ++$sampled >= 5) { $node['sampled'] = true; break; }
            }
        } elseif (is_object($value)) {
            $node['opaque'] = true;
        } else {
            // Synthetic examples only: even "harmless" text can contain customer data or HTML secrets.
            $examples = ['string' => 'example', 'integer' => 123, 'double' => 12.5, 'boolean' => true, 'NULL' => null];
            $node['example'] = $examples[gettype($value)] ?? null;
            if (is_string($value)) {
                if (preg_match('/domain/i', $name)) $node['example'] = 'example.com';
                elseif (preg_match('/url|link/i', $name)) $node['example'] = 'https://example.com/';
                elseif (preg_match('/date/i', $name)) $node['example'] = '2026-01-01';
            }
            $node['example_is_synthetic'] = true;
        }
        return $node;
    }

    private static function merge(array $old, array $new)
    {
        $types = array_unique(array_merge($old['types'] ?? [$old['type']], $new['types'] ?? [$new['type']]));
        $result = array_replace($old, $new);
        $result['types'] = array_values($types);
        if (isset($old['children'])) {
            $result['children'] = $old['children'];
            foreach ($new['children'] ?? [] as $key => $child) {
                $result['children'][$key] = isset($result['children'][$key])
                    ? self::merge($result['children'][$key], $child) : $child;
            }
        }
        return $result;
    }

    public static function collect(array $variables, $stage)
    {
        $theme = (string) ($variables['template'] ?? 'unknown');
        $source = (string) ($variables['templatefile'] ?? 'unknown');
        // Missing template identity at an early hook must not mix unrelated pages.
        if ($theme === 'unknown' || $source === 'unknown') return;
        $slug = function ($value) { return substr(preg_replace('/[^a-zA-Z0-9_-]/', '_', $value), 0, 90); };
        $dir = ZM_PB_RESOURCESDIR . 'available_vars/';
        if (!is_dir($dir) && !mkdir($dir, 0750, true) && !is_dir($dir)) return;
        file_put_contents($dir . '.htaccess', "<IfModule mod_authz_core.c>\nRequire all denied\n</IfModule>\n<IfModule !mod_authz_core.c>\nDeny from all\n</IfModule>\n");
        self::sanitizeLegacy($dir);
        $path = $dir . $slug($theme) . '__' . $slug($source) . '_smarty_vars.json';
        $handle = fopen($path, 'c+');
        if (!$handle) return;
        try {
            if (!flock($handle, LOCK_EX)) return;
            $old = json_decode(stream_get_contents($handle), true);
            $catalog = is_array($old) && ($old['version'] ?? null) === 2 ? $old : [];
            $catalog['version'] = 2;
            $catalog['theme'] = $theme;
            $catalog['source'] = $source;
            $catalog['stage_note'] = 'Observed at hooks; this is availability, not the exact producer of the variable.';
            $catalog['examples'] = 'synthetic';
            $budget = 3500;
            foreach ($variables as $name => $value) {
                if (!preg_match('/^[A-Za-z_][A-Za-z0-9_]{0,79}$/D', (string) $name) || $budget <= 0) continue;
                $node = self::describe($value, $name, 0, $budget);
                $entry = $catalog['variables'][$name] ?? [];
                $node = $entry ? self::merge($entry, $node) : $node;
                $node['stages'] = array_values(array_unique(array_merge($entry['stages'] ?? [], [$stage])));
                $catalog['variables'][$name] = $node;
            }
            ksort($catalog['variables']);
            $json = json_encode($catalog, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
            if ($json !== false) { rewind($handle); ftruncate($handle, 0); fwrite($handle, $json); }
        } finally { flock($handle, LOCK_UN); fclose($handle); }
    }

    private static function sanitizeLegacy($dir)
    {
        if (self::$legacyChecked) return;
        self::$legacyChecked = true;
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS));
        foreach ($files as $file) {
            if (!$file->isFile() || $file->isLink() || !preg_match('/_smarty_vars\.json$/D', $file->getFilename())) continue;
            $handle = fopen($file->getPathname(), 'r+');
            if (!$handle) continue;
            try {
                if (!flock($handle, LOCK_EX)) continue;
                // Oversized old dumps are discarded rather than loading arbitrary application data into memory.
                $old = $file->getSize() <= 10000000 ? json_decode(stream_get_contents($handle), true) : null;
                if (is_array($old) && ($old['version'] ?? null) === 2 && ($old['examples'] ?? '') === 'synthetic') continue;
                $budget = 3500;
                $catalog = ['version' => 2, 'theme' => basename($file->getPath()),
                    'source' => preg_replace('/_smarty_vars\.json$/', '', $file->getFilename()),
                    'examples' => 'synthetic', 'stage_note' => 'Sanitized legacy dump; producer and hook stage unknown.', 'variables' => []];
                foreach (is_array($old) ? $old : [] as $name => $value) {
                    if ($budget <= 0 || !preg_match('/^[A-Za-z_][A-Za-z0-9_]{0,79}$/D', (string) $name)) continue;
                    $catalog['variables'][$name] = self::describe($value, $name, 0, $budget) + ['stages' => ['legacy:unknown']];
                }
                $json = json_encode($catalog, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
                if ($json !== false) { rewind($handle); ftruncate($handle, 0); fwrite($handle, $json); }
            } finally { flock($handle, LOCK_UN); fclose($handle); }
        }
    }

    public static function catalogs()
    {
        $catalogs = [];
        // Old raw variable dumps are deliberately never served to the browser.
        foreach (array_slice(glob(ZM_PB_RESOURCESDIR . 'available_vars/*_smarty_vars.json') ?: [], 0, 100) as $path) {
            if (filesize($path) > 1500000) continue;
            $data = json_decode(file_get_contents($path), true);
            if (is_array($data) && ($data['version'] ?? null) === 2 && ($data['examples'] ?? '') === 'synthetic') $catalogs[] = $data;
        }
        return $catalogs;
    }

    public static function snapshot($value, $name = '', $depth = 0, &$budget = null)
    {
        // Null means a complete runtime snapshot. The collector has its own
        // bounded describe() traversal; truncating live lists hides real rows.
        // Explicitly bounded callers get an error instead of a partial result.
        if ($budget !== null && --$budget < 0) {
            throw new LengthException('Smarty variable snapshot exceeds the requested budget.');
        }
        if ($depth > 10 || self::sensitive($name)) return null;
        if (is_scalar($value) || $value === null) return $value;
        $members = self::members($value);
        if ($members === null) return null;
        $result = [];
        foreach ($members as $key => $item) {
            if (self::sensitive($key)) continue;
            $result[$key] = self::snapshot($item, $key, $depth + 1, $budget);
        }
        return $result;
    }
}
