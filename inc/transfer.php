<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

function zm_pb_transfer_text() {
    return ZM_PB_ADMINLANG->transfer ?? (require ZM_PB_ALANGDIR . 'english.php')->transfer;
}

function zm_pb_transfer_error($key, ...$details) {
    $template = zm_pb_transfer_text()->errors->$key ?? $key;
    return $details ? sprintf($template, ...$details) : $template;
}

function zm_pb_transfer_sections($input) {
    $available = ['pages', 'menus', 'settings', 'redirects', 'rewrites', 'media'];
    if (!is_array($input) || !$input) throw new InvalidArgumentException(zm_pb_transfer_error('select_sections'));
    foreach ($input as $value) if (!is_string($value) || !in_array($value, $available, true)) throw new InvalidArgumentException(zm_pb_transfer_error('unknown_section'));
    return array_values(array_unique($input));
}

/** A journal for explicitly chosen module files; archive filenames are never used as paths. */
class ZM_PB_TransferFiles {
    private $previous = [];

    public function remember($path) {
        if (array_key_exists($path, $this->previous)) return;
        if (is_link($path) || (file_exists($path) && !is_file($path))) throw new RuntimeException(zm_pb_transfer_error('invalid_path', basename($path)));
        $old = is_file($path) ? @file_get_contents($path) : null;
        if ($old === false) throw new RuntimeException(zm_pb_transfer_error('read_failed', basename($path)));
        $this->previous[$path] = $old;
    }

    public function write($path, $contents) {
        $this->remember($path);
        $temporary = @tempnam(dirname($path), '.zmpb-import-');
        if ($temporary === false) throw new RuntimeException(zm_pb_transfer_error('temp_failed'));
        try {
            if (@file_put_contents($temporary, $contents, LOCK_EX) !== strlen($contents)) throw new RuntimeException(zm_pb_transfer_error('write_failed'));
            chmod($temporary, is_file($path) ? (fileperms($path) & 0777) : 0644);
            if (!@rename($temporary, $path)) throw new RuntimeException(zm_pb_transfer_error('replace_failed', basename($path)));
        } finally { if (is_file($temporary)) unlink($temporary); }
    }

    public function rollback() {
        foreach (array_reverse($this->previous, true) as $path => $contents) {
            try {
                if ($contents === null) { if (is_file($path) && !unlink($path)) throw new RuntimeException('unlink'); }
                else $this->write($path, $contents);
                if (function_exists('opcache_invalidate')) @opcache_invalidate($path, true);
            } catch (Throwable $error) { error_log('ZM PB import rollback failed: ' . $path); }
        }
    }
}
