<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Check only the paths used for module writes; this never creates or edits files. */
function zm_pb_directory_health_paths(): array
{
    $adminDir = defined('ADMIN_PATH') ? ADMIN_PATH : dirname($_SERVER['SCRIPT_FILENAME'] ?? '');
    if (!is_dir($adminDir . '/lang') && !empty($GLOBALS['customadminpath']))
        $adminDir = ROOTDIR . '/' . trim((string) $GLOBALS['customadminpath'], '/\\');
    if (!is_dir($adminDir . '/lang')) $adminDir = ROOTDIR . '/admin';

    return [
        ['path' => ROOTDIR, 'public' => false],
        ['path' => ZM_PB_ROOTDIR, 'public' => false],
        ['path' => ZM_PB_INCDIR, 'public' => false],
        ['path' => ZM_PB_ALANGDIR, 'public' => false],
        ['path' => ZM_PB_ROOTDIR . 'rep_info/', 'public' => false],
        ['path' => ZM_PB_RESOURCESDIR, 'public' => false],
        ['path' => ZM_PB_ASSETSDIR . 'generated/', 'public' => true],
        ['path' => ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, 'public' => true],
        ['path' => ROOTDIR . '/lang/', 'public' => false],
        ['path' => $adminDir . '/lang/', 'public' => false],
        ['path' => ROOTDIR . '/templates_c/' . ZM_PB_NAME . '/', 'public' => false],
    ];
}

/** Recognize directory-wide Apache denies without treating a single protected file as a blocked directory. */
function zm_pb_directory_health_has_broad_deny(string $rules): bool
{
    $scope = [];
    foreach (preg_split('/\r\n|\n|\r/', $rules) as $line) {
        $line = trim(preg_replace('/\s+#.*$/', '', $line));
        if ($line === '' || $line[0] === '#') continue;

        if (preg_match('/^<\s*\/\s*([a-z]+)\s*>$/i', $line, $match)) {
            if ($scope) array_pop($scope);
            continue;
        }
        if (preg_match('/^<\s*([a-z]+)\b(.*?)>$/i', $line, $match)) {
            $tag = strtolower($match[1]);
            $allFiles = ($tag === 'files' && preg_match('/^\s*["\']\*["\']\s*$/', $match[2])) ||
                ($tag === 'filesmatch' && preg_match('/^\s*["\'](?:\.\*|\^\.\*\$)["\']\s*$/', $match[2]));
            $scope[] = !in_array($tag, ['files', 'filesmatch', 'if', 'limit', 'limitexcept'], true) || $allFiles;
            continue;
        }

        if (in_array(false, $scope, true)) continue;
        if (preg_match('/^(?:Require\s+all\s+denied|Deny\s+from\s+all)\s*$/i', $line)) return true;
    }
    return false;
}

/** Return path and issue codes so activation and the settings page share one read-only check. */
function zm_pb_directory_health_check(?array $paths = null): array
{
    $issues = [];
    foreach ($paths ?? zm_pb_directory_health_paths() as $entry) {
        $path = rtrim((string) $entry['path'], '/\\');
        if ($path === '') $path = DIRECTORY_SEPARATOR;
        elseif (preg_match('/^[a-z]:$/i', $path)) $path .= DIRECTORY_SEPARATOR;
        if (!@is_dir($path)) {
            $issues[] = ['path' => $path, 'code' => 'missing'];
            continue;
        }
        if (!@is_readable($path)) $issues[] = ['path' => $path, 'code' => 'unreadable'];
        if (!@is_writable($path)) $issues[] = ['path' => $path, 'code' => 'unwritable'];

        if (empty($entry['public'])) continue;
        $rules = $path . DIRECTORY_SEPARATOR . '.htaccess';
        if (!@file_exists($rules)) continue;
        $contents = @file_get_contents($rules);
        if ($contents === false) {
            $issues[] = ['path' => $rules, 'code' => 'unreadable'];
        } elseif (zm_pb_directory_health_has_broad_deny($contents)) {
            $issues[] = ['path' => $rules, 'code' => 'htaccess_denied'];
        }
    }
    return $issues;
}

/** Turn issue codes into short messages from the active admin language. */
function zm_pb_directory_health_messages(array $issues, $translations): array
{
    $fallback = [
        'missing' => 'Directory is missing.',
        'unreadable' => 'Cannot read this path.',
        'unwritable' => 'Cannot write to this directory.',
        'htaccess_denied' => '.htaccess may block public access on Apache.',
    ];
    foreach ($issues as &$issue) {
        $code = $issue['code'];
        $issue['message'] = $translations->$code ?? $fallback[$code] ?? $code;
    }
    unset($issue);
    return $issues;
}
