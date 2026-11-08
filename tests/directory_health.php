<?php
define('ZM_PB_VER', 'test');
require dirname(__DIR__) . '/inc/directory_health.php';

function expect_directory_health(bool $condition, string $message): void
{
    if (!$condition) throw new RuntimeException($message);
}

expect_directory_health(zm_pb_directory_health_has_broad_deny("Require all denied\n"), 'Direct deny was missed.');
expect_directory_health(zm_pb_directory_health_has_broad_deny("Deny from all\n"), 'Legacy Apache deny was missed.');
expect_directory_health(zm_pb_directory_health_has_broad_deny(
    "<IfModule mod_authz_core.c>\nRequire all denied\n</IfModule>\n"
), 'Conditional Apache deny was missed.');
expect_directory_health(zm_pb_directory_health_has_broad_deny(
    "<FilesMatch \".*\">\nRequire all denied\n</FilesMatch>\n"
), 'All-files deny was missed.');
expect_directory_health(!zm_pb_directory_health_has_broad_deny(
    "<FilesMatch \"^secret\\.txt$\">\nRequire all denied\n</FilesMatch>\n"
), 'A single-file rule was mistaken for a directory-wide deny.');

$directory = sys_get_temp_dir() . '/zm-pb-directory-check-' . bin2hex(random_bytes(6));
$missing = $directory . '-missing';
if (!mkdir($directory)) throw new RuntimeException('Could not prepare the directory test.');
$rules = $directory . '/.htaccess';
try {
    $issues = zm_pb_directory_health_check([
        ['path' => $directory, 'public' => true],
        ['path' => $missing, 'public' => false],
    ]);
    expect_directory_health(count($issues) === 1 && $issues[0]['code'] === 'missing',
        'Missing directory was not reported correctly.');
    expect_directory_health(!file_exists($missing), 'The check created a missing directory.');

    file_put_contents($rules, "<FilesMatch \".*\">\nRequire all denied\n</FilesMatch>\n");
    $issues = zm_pb_directory_health_check([['path' => $directory, 'public' => true]]);
    expect_directory_health(count($issues) === 1 && $issues[0]['code'] === 'htaccess_denied',
        'Public directory deny was not reported.');
    expect_directory_health(file_get_contents($rules) === "<FilesMatch \".*\">\nRequire all denied\n</FilesMatch>\n",
        'The check changed .htaccess.');
} finally {
    if (is_file($rules)) unlink($rules);
    rmdir($directory);
}

echo "Directory health checks OK\n";
