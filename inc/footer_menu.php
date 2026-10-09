<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
use Illuminate\Database\Capsule\Manager as Capsule;

function zm_pb_footer_error($key, ...$details)
{
    $template = defined('ZM_PB_ADMINLANG') ? (ZM_PB_ADMINLANG->menu_manager->errors->$key ?? $key) : $key;
    return $details ? sprintf($template, ...$details) : $template;
}

/** Insert or remove only the block owned by this module. */
function zm_pb_menu_footer_template_contents($source, $enabled)
{
    $begin = '{* ZM PB FOOTER MENU BEGIN *}';
    $end = '{* ZM PB FOOTER MENU END *}';
    $hasBegin = strpos($source, $begin) !== false;
    $hasEnd = strpos($source, $end) !== false;
    if ($hasBegin !== $hasEnd) throw new RuntimeException(zm_pb_footer_error('footer_marker_incomplete'));
    if ($hasBegin) {
        $expression = '~\r?\n[ \t]*' . preg_quote($begin, '~') . '.*?' . preg_quote($end, '~') . '~s';
        $source = preg_replace($expression, '', $source, -1, $count);
        if ($count !== 1) throw new RuntimeException(zm_pb_footer_error('footer_marker_invalid'));
    }
    if (!$enabled) return $source;
    if (!preg_match('/<footer\b[^>]*>/i', $source, $match, PREG_OFFSET_CAPTURE)
        && !preg_match('/<section\b[^>]*\bid\s*=\s*["\']footer["\'][^>]*>/i', $source, $match, PREG_OFFSET_CAPTURE)) {
        throw new RuntimeException(zm_pb_footer_error('footer_container_missing'));
    }
    $newline = strpos($source, "\r\n") !== false ? "\r\n" : "\n";
    $block = $newline . '        ' . $begin
        . $newline . '        {if isset($zm_pb_footer_menu)}{$zm_pb_footer_menu nofilter}{/if}'
        . $newline . '        ' . $end;
    $position = $match[0][1] + strlen($match[0][0]);
    return substr_replace($source, $block, $position, 0);
}

function zm_pb_menu_sync_footer_template()
{
    $enabled = defined('ZM_PB_ENABLE_FOOTERMENU') && ZM_PB_ENABLE_FOOTERMENU
        && Capsule::table('zm_pb_menu_locations as l')
            ->join('zm_pb_menus as m', 'm.id', '=', 'l.menu_id')
            ->where('l.location', 'footer')->where('m.active', true)->exists();
    $themesDir = realpath(ROOTDIR . '/templates');
    if (!$themesDir) {
        if (!$enabled) return false;
        throw new RuntimeException(zm_pb_footer_error('themes_dir_missing'));
    }
    $changed = false;
    $errors = [];
    $processed = [];
    // Client themes live directly under /templates; admin themes live elsewhere.
    // Do not recurse into order forms, includes or other template fragments.
    foreach (new DirectoryIterator($themesDir) as $entry) {
        if ($entry->isDot() || !$entry->isDir()
            || in_array(strtolower($entry->getFilename()), ['orderforms', 'admin'], true)) continue;
        $path = realpath($entry->getPathname() . '/footer.tpl');
        if (!$path || !is_file($path) || isset($processed[$path])
            || strpos($path, $themesDir . DIRECTORY_SEPARATOR) !== 0) continue;
        $processed[$path] = true;
        try {
            if (zm_pb_menu_update_footer_template_file($path, $enabled)) $changed = true;
        } catch (RuntimeException $error) {
            // An unwritable theme must not prevent updating the remaining themes.
            $errors[] = $entry->getFilename() . ': ' . $error->getMessage();
        }
    }
    if ($errors) throw new RuntimeException(implode('; ', $errors));
    if (!$processed && $enabled) throw new RuntimeException(zm_pb_footer_error('footer_files_missing'));
    return $changed;
}

function zm_pb_menu_update_footer_template_file($path, $enabled)
{
    $source = file_get_contents($path);
    if ($source === false) throw new RuntimeException(zm_pb_footer_error('footer_read_failed', $path));
    $updated = zm_pb_menu_footer_template_contents($source, $enabled);
    if ($updated === $source) return false;
    $temporary = is_writable(dirname($path)) ? @tempnam(dirname($path), 'zmpb_footer_') : false;
    if ($temporary !== false) {
        try {
            if (@file_put_contents($temporary, $updated, LOCK_EX) === strlen($updated)) {
                $permissions = @fileperms($path);
                if ($permissions !== false) @chmod($temporary, $permissions & 0777);
                if (@rename($temporary, $path)) return true;
            }
        } finally {
            if (is_file($temporary)) @unlink($temporary);
        }
    }
    // Replacing an open file can fail on Windows even when the file is writable.
    if (is_writable($path) && @file_put_contents($path, $updated, LOCK_EX) === strlen($updated)) return true;
    throw new RuntimeException(zm_pb_footer_error('footer_write_failed', $path));
}
