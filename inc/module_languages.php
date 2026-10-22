<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

function zm_pb_module_languages_default(string $language): string
{
    return [
        'portugues' => 'portuguese-pt',
        'portugues-br' => 'portuguese-br',
        'ukranian' => 'ukrainian',
    ][$language] ?? $language;
}

function zm_pb_module_languages_state(string $directory): array
{
    $directory = rtrim($directory, '/\\');
    $enabledFile = $directory . '/supported_langs.php';
    $disabledFile = $directory . '/disabled_langs.php';
    if (!is_file($enabledFile) || !is_file($disabledFile) || is_link($enabledFile) || is_link($disabledFile))
        throw new RuntimeException('Language list files are missing or are symbolic links.');
    $enabled = require $enabledFile;
    $disabled = require $disabledFile;
    if (!is_array($enabled) || !is_array($disabled) || array_intersect_key($enabled, $disabled))
        throw new RuntimeException('Language lists are invalid or contain duplicate languages.');
    foreach ([$enabled, $disabled] as $list) {
        foreach ($list as $key => $info) {
            if (!is_string($key) || !preg_match('/^[a-z0-9_-]+$/D', $key) ||
                !is_array($info) || !isset($info['name'], $info['code'], $info['code_ISO639_1'], $info['locale_BCP47']))
                throw new RuntimeException('Language list contains an invalid entry.');
        }
    }
    return ['enabled' => $enabled, 'disabled' => $disabled];
}

function zm_pb_module_languages_entry(string $content, string $key): array
{
    $pattern = "/(?m)^[ \\t]*'" . preg_quote($key, '/') . "'[ \\t]*=>[ \\t]*\\[[^\\r\\n]*\\],[ \\t]*(?:\\r?\\n|$)/";
    if (preg_match_all($pattern, $content, $matches, PREG_OFFSET_CAPTURE) !== 1)
        throw new RuntimeException('Language entry is missing or cannot be moved safely.');
    return ['line' => $matches[0][0][0], 'offset' => $matches[0][0][1]];
}

function zm_pb_module_languages_insert(string $content, string $line): string
{
    if (preg_match('/(?m)^];[ \\t]*(?:\\r?\\n|$)/', $content, $match, PREG_OFFSET_CAPTURE) !== 1)
        throw new RuntimeException('Language list format is not supported.');
    $eol = strpos($content, "\r\n") !== false ? "\r\n" : "\n";
    return substr_replace($content, rtrim($line, "\r\n") . $eol, $match[0][1], 0);
}

function zm_pb_module_languages_pin_route(string $content, string $key, string $route): string
{
    $entry = zm_pb_module_languages_entry($content, $key);
    if (preg_match('/[\'\"]route_code[\'\"]\s*=>/', $entry['line'])) return $content;
    $position = strrpos($entry['line'], '],');
    if ($position === false) throw new RuntimeException('Language entry format is not supported.');
    $updated = substr_replace($entry['line'], ",'route_code'=>" . var_export($route, true), $position, 0);
    return substr_replace($content, $updated, $entry['offset'], strlen($entry['line']));
}

function zm_pb_module_languages_write(string $file, string $content): void
{
    if (!is_file($file) || is_link($file)) throw new RuntimeException('Language list file is unavailable.');
    $temp = tempnam(dirname($file), '.zm-pb-lang-');
    if ($temp === false) throw new RuntimeException('Cannot create a temporary language list file.');
    try {
        $mode = fileperms($file);
        if ($mode === false || !chmod($temp, $mode & 0777) ||
            file_put_contents($temp, $content) !== strlen($content) || !rename($temp, $file))
            throw new RuntimeException('Cannot save the language list.');
        if (function_exists('opcache_invalidate')) @opcache_invalidate($file, true);
    } finally {
        if (is_file($temp)) unlink($temp);
    }
}

function zm_pb_module_languages_rekey(string $directory, string $old, string $new): bool
{
    if (!preg_match('/^[a-z0-9_-]+$/D', $old) || !preg_match('/^[a-z0-9_-]+$/D', $new))
        throw new InvalidArgumentException('Invalid language name.');
    $directory = rtrim($directory, '/\\');
    $lock = fopen($directory . '/.zm-pb-langs.lock', 'c');
    if (!$lock || !flock($lock, LOCK_EX)) throw new RuntimeException('Cannot lock the language lists.');
    try {
        $lists = zm_pb_module_languages_state($directory);
        if (isset($lists['enabled'][$new]) || isset($lists['disabled'][$new])) {
            if (isset($lists['enabled'][$old]) || isset($lists['disabled'][$old]))
                throw new RuntimeException('Both language names already exist in the module lists.');
            return false;
        }
        $state = isset($lists['enabled'][$old]) ? 'enabled' :
            (isset($lists['disabled'][$old]) ? 'disabled' : null);
        if ($state === null) return false;
        $file = $directory . '/' . ($state === 'enabled' ? 'supported_langs.php' : 'disabled_langs.php');
        $content = file_get_contents($file);
        if ($content === false) throw new RuntimeException('Cannot read the language list.');
        $entry = zm_pb_module_languages_entry($content, $old);
        $quoted = "'" . $old . "'";
        $position = strpos($entry['line'], $quoted);
        if ($position === false)
            throw new RuntimeException('Cannot correct the language entry.');
        $renamed = substr_replace($entry['line'], "'" . $new . "'", $position, strlen($quoted));
        zm_pb_module_languages_write($file,
            substr_replace($content, $renamed, $entry['offset'], strlen($entry['line'])));
        return true;
    } finally {
        flock($lock, LOCK_UN);
        fclose($lock);
    }
}

function zm_pb_module_languages_toggle(string $directory, string $language, bool $enable, string $defaultLanguage): void
{
    if (!preg_match('/^[a-z0-9_-]+$/D', $language))
        throw new InvalidArgumentException('Invalid language.');
    $directory = rtrim($directory, '/\\');
    $lock = fopen($directory . '/.zm-pb-langs.lock', 'c');
    if (!$lock || !flock($lock, LOCK_EX)) throw new RuntimeException('Cannot lock the language lists.');
    try {
        $lists = zm_pb_module_languages_state($directory);
        $source = $enable ? 'disabled' : 'enabled';
        $target = $enable ? 'enabled' : 'disabled';
        if (isset($lists[$target][$language])) return;
        if (!isset($lists[$source][$language])) throw new InvalidArgumentException('Language not found.');
        if (!$enable && zm_pb_module_languages_default($language) ===
            zm_pb_module_languages_default(strtolower($defaultLanguage)))
            throw new InvalidArgumentException('The WHMCS default language cannot be disabled.');
        if (!$enable && count($lists['enabled']) < 2)
            throw new InvalidArgumentException('At least one language must remain enabled.');

        $sourceFile = $directory . '/' . ($enable ? 'disabled_langs.php' : 'supported_langs.php');
        $targetFile = $directory . '/' . ($enable ? 'supported_langs.php' : 'disabled_langs.php');
        $sourceContent = file_get_contents($sourceFile);
        $targetContent = file_get_contents($targetFile);
        if ($sourceContent === false || $targetContent === false)
            throw new RuntimeException('Cannot read the language lists.');
        $originalTargetContent = $targetContent;
        $contents = ['enabled' => $enable ? $targetContent : $sourceContent,
            'disabled' => $enable ? $sourceContent : $targetContent];
        $all = $lists['enabled'] + $lists['disabled'];
        $codeCounts = array_count_values(array_column($all, 'code_ISO639_1'));
        foreach ($lists as $state => $languages) {
            foreach ($languages as $key => $info) {
                $code = $info['code_ISO639_1'];
                if ($codeCounts[$code] > 1 && strcasecmp($info['code'], $code) !== 0)
                    $contents[$state] = zm_pb_module_languages_pin_route($contents[$state], $key, $info['locale_BCP47']);
            }
        }
        $sourceContent = $contents[$source];
        $targetContent = $contents[$target];
        $entry = zm_pb_module_languages_entry($sourceContent, $language);
        $sourceUpdated = substr_replace($sourceContent, '', $entry['offset'], strlen($entry['line']));
        $targetUpdated = zm_pb_module_languages_insert($targetContent, $entry['line']);

        zm_pb_module_languages_write($targetFile, $targetUpdated);
        try {
            zm_pb_module_languages_write($sourceFile, $sourceUpdated);
        } catch (Throwable $error) {
            zm_pb_module_languages_write($targetFile, $originalTargetContent);
            throw $error;
        }
    } finally {
        flock($lock, LOCK_UN);
        fclose($lock);
    }
}

function zm_pb_module_languages_enable_default(string $directory, string $defaultLanguage): string
{
    $default = strtolower($defaultLanguage);
    $canonical = zm_pb_module_languages_default($default);
    $aliases = ['ukranian' => 'ukrainian', 'portugues' => 'portuguese-pt',
        'portugues-br' => 'portuguese-br'];
    $legacy = array_search($canonical, $aliases, true);
    $lists = zm_pb_module_languages_state($directory);
    foreach (array_unique(array_filter([$canonical, $default, $legacy])) as $name) {
        if (isset($lists['enabled'][$name])) return $name;
        if (isset($lists['disabled'][$name])) {
            zm_pb_module_languages_toggle($directory, $name, true, $default);
            return $name;
        }
    }
    throw new InvalidArgumentException('The WHMCS default language is not in the module language lists.');
}
