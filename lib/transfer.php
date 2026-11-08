<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
use Illuminate\Database\Capsule\Manager as Capsule;
require_once ZM_PB_INCDIR . 'transfer.php';
require_once ZM_PB_INCDIR . 'helpers.php';

/** Portable module data, not a SQL dump. Never creates, alters or drops tables. */
class ZM_PB_Transfer {
    public const MAX_BYTES = 33554432;
    public const MAX_ARCHIVE_BYTES = 134217728;
    private static $tables = [
        'pages' => ['zm_pb_pages', 'zm_pb_pages_settings', 'zm_pb_sitemap'],
        'menus' => ['zm_pb_menus', 'zm_pb_menu_items', 'zm_pb_menu_locations', 'zm_pb_pages'],
        'settings' => ['zm_pb_module_settings'], 'redirects' => ['zm_pb_redirects', 'zm_pb_pages'],
        'rewrites' => [], 'media' => ['zm_pb_attachments'],
    ];

    private static function ready($sections) {
        foreach ($sections as $section) foreach (self::$tables[$section] as $table) {
            if (!zm_pb_has_table($table)) throw new RuntimeException(zm_pb_transfer_error('missing_table', $table));
        }
    }

    private static function fields(array $row, $fields) {
        return array_intersect_key($row, array_flip(explode(' ', $fields)));
    }

    private static function rows($table) {
        return array_map(function ($row) { return (array) $row; }, Capsule::table($table)->orderBy('id')->get()->all());
    }

    private static function read($path) {
        if (is_link($path) || !is_file($path) || filesize($path) > self::MAX_BYTES) throw new RuntimeException(zm_pb_transfer_error('unavailable_file', basename($path)));
        $value = file_get_contents($path);
        if ($value === false) throw new RuntimeException(zm_pb_transfer_error('read_file', basename($path)));
        return $value;
    }

    private static function generatedPath($url) {
        if (strpos($url, ZM_PB_ASSETSURL . 'generated/') !== 0) throw new RuntimeException(zm_pb_transfer_error('unknown_asset_url'));
        $name = basename(parse_url($url, PHP_URL_PATH));
        if (!preg_match('/^page_[0-9]+_[a-z][a-z-]*_(?:styles\.css|code_[a-z0-9]+\.(?:css|js))$/D', $name)) throw new RuntimeException(zm_pb_transfer_error('invalid_asset_name'));
        return ZM_PB_ASSETSDIR . 'generated/' . $name;
    }

    private static function generated($url) {
        return self::read(self::generatedPath($url));
    }

    private static function archiveAsset($url, ZipArchive $zip, array &$warnings) {
        $path = self::generatedPath($url);
        $size = @filesize($path);
        if (!file_exists($path) && !is_link($path)) {
            $warnings[basename($path)] = ['file' => basename($path), 'reason' => 'missing'];
            return null;
        }
        if (is_link($path) || !is_file($path) || $size === false || !is_readable($path)) {
            $warnings[basename($path)] = ['file' => basename($path), 'reason' => 'unavailable'];
            return null;
        }
        if ($size > self::MAX_ARCHIVE_BYTES) {
            $warnings[basename($path)] = ['file' => basename($path), 'reason' => 'too_large'];
            return null;
        }
        $entry = 'generated/' . basename($path);
        if ($zip->locateName($entry) === false && !$zip->addFile($path, $entry)) throw new RuntimeException(zm_pb_transfer_error('read_file', basename($path)));
        return $entry;
    }

    private static function portableContent($content, ?ZipArchive $zip = null, ?array &$warnings = null) {
        if (!$content) return '';
        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        if (($data['format'] ?? '') !== 'grapesjs') throw new RuntimeException(zm_pb_transfer_error('unsupported_content'));
        if ($zip) {
            if ($warnings === null) $warnings = [];
            $data['cssFile'] = !empty($data['cssUrl']) ? self::archiveAsset($data['cssUrl'], $zip, $warnings) : null;
            if ($data['cssFile'] === null) $data['css'] = is_string($data['css'] ?? null) ? $data['css'] : '';
        } else {
            $data['css'] = !empty($data['cssUrl']) ? self::generated($data['cssUrl']) : ($data['css'] ?? '');
        }
        if (!isset($data['code'])) {
            $data['code'] = [];
            foreach ($data['assets'] ?? [] as $id => $asset) {
                $block = ['id' => $id, 'type' => $asset['type']];
                if ($zip) {
                    $file = self::archiveAsset($asset['url'], $zip, $warnings);
                    if ($file !== null) $block['file'] = $file;
                    else $block['code'] = is_string($asset['code'] ?? null) ? $asset['code'] : '';
                } else $block['code'] = self::generated($asset['url']);
                $data['code'][] = $block;
            }
        }
        unset($data['assets'], $data['cssUrl']);
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
    }

    private static function mediaName($name) {
        require_once ZM_PB_MEDIA_MANAGER_FILE;
        if (!is_string($name) || !preg_match('/^[a-zA-Z0-9_-][a-zA-Z0-9_.-]*$/D', $name)
            || !in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), zm_pb_media_manager_allowed_extensions(), true)) {
            throw new RuntimeException(zm_pb_transfer_error('invalid_media_name'));
        }
        return $name;
    }

    public static function export(array $sections) {
        return self::exportData($sections);
    }

    private static function openExportArchive(): array {
        $directory = rtrim(ZM_PB_RESOURCESDIR, '/\\') . DIRECTORY_SEPARATOR;
        if (!is_dir($directory) || !is_writable($directory))
            throw new RuntimeException(zm_pb_transfer_error('temp_failed') . ' (resources is not writable)');
        $path = $directory . '.zmpb-export-' . bin2hex(random_bytes(16)) . '.zip';
        $originalMask = umask(0077);
        try { $file = @fopen($path, 'x+b'); }
        finally { umask($originalMask); }
        if ($file === false)
            throw new RuntimeException(zm_pb_transfer_error('temp_failed') . ' (resources file creation failed)');
        fclose($file);
        if (!@chmod($path, 0600)) {
            @unlink($path);
            throw new RuntimeException(zm_pb_transfer_error('temp_failed') . ' (resources file permissions failed)');
        }
        $zip = new ZipArchive();
        $result = @$zip->open($path, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        if ($result === true) return [$path, $zip];
        @unlink($path);
        throw new RuntimeException(zm_pb_transfer_error('temp_failed') . ' (ZipArchive::open returned ' . (string) $result . ')');
    }

    public static function exportArchive(array $sections, ?array &$warnings = null) {
        if (!class_exists('ZipArchive')) throw new RuntimeException(zm_pb_transfer_error('zip_required'));
        $warnings = [];
        [$path, $zip] = self::openExportArchive();
        try {
            try {
                $manifest = self::exportData($sections, $zip, $warnings);
                if (!$zip->addFromString('manifest.json', $manifest)) throw new RuntimeException(zm_pb_transfer_error('write_failed'));
            } catch (Throwable $error) { $zip->close(); throw $error; }
            if (!$zip->close()) throw new RuntimeException(zm_pb_transfer_error('write_failed'));
            if (!@chmod($path, 0600)) throw new RuntimeException(zm_pb_transfer_error('write_failed'));
            clearstatcache(true, $path);
            if (filesize($path) > self::MAX_ARCHIVE_BYTES) throw new RuntimeException(zm_pb_transfer_error('archive_too_large'));
            return $path;
        } catch (Throwable $error) {
            if (is_file($path)) unlink($path);
            throw $error;
        }
    }

    private static function exportData(array $sections, ?ZipArchive $zip = null, ?array &$warnings = null) {
        if ($warnings === null) $warnings = [];
        $sections = zm_pb_transfer_sections($sections); self::ready($sections);
        $result = ['format' => ZM_PB_NAME, 'version' => $zip ? 2 : 1, 'created_at' => gmdate('c'),
            'source_url' => ZM_PB_FULLHOST, 'page_refs' => [], 'sections' => []];
        if (array_intersect($sections, ['pages', 'menus', 'redirects'])) {
            foreach (self::rows('zm_pb_pages') as $row) $result['page_refs'][$row['id']] = self::fields($row, 'slug auth_type');
        }
        foreach ($sections as $section) {
            $data = [];
            if ($section === 'pages') {
                foreach (self::rows('zm_pb_pages') as $row) {
                    $row['translations'] = [];
                    foreach (Capsule::table('zm_pb_pages_settings')->where('page_id', $row['id'])->get() as $translation) {
                        $translation = (array) $translation;
                        $translation['content'] = self::portableContent($translation['content'], $zip, $warnings);
                        $row['translations'][] = $translation;
                    }
                    $row['sitemap'] = array_map(function ($item) { return (array) $item; }, Capsule::table('zm_pb_sitemap')->where('page_id', $row['id'])->get()->all());
                    $data[] = $row;
                }
            } elseif ($section === 'menus') {
                require_once ZM_PB_INCDIR . 'menu_manager.php';
                foreach (self::rows('zm_pb_menus') as $row) {
                    // Build the portable item tree directly; IDs become local keys on import.
                    $row['items'] = [];
                    foreach (Capsule::table('zm_pb_menu_items')->where('menu_id', $row['id'])->orderBy('position')->get() as $item) {
                        $item = (array) $item; $item['key'] = (string) $item['id'];
                        $item['parent'] = $item['parent_id'] ? (string) $item['parent_id'] : '';
                        $item['labels'] = json_decode($item['labels'] ?? '{}', true) ?: [];
                        $row['items'][] = $item;
                    }
                    $row['locations'] = Capsule::table('zm_pb_menu_locations')->where('menu_id', $row['id'])->pluck('location')->all();
                    $data[] = $row;
                }
            } elseif ($section === 'settings') {
                $data = ['constants' => [], 'rows' => self::rows('zm_pb_module_settings'), 'robots' => is_file(ROOTDIR . '/robots.txt') ? self::read(ROOTDIR . '/robots.txt') : null];
                foreach (ZM_PB_ALLOWED_CONSTS_CHANGE as $name) {
                    if (defined($name) && !in_array($name, ['ZM_PB_SITEMAP_LASTUPD', 'ZM_PB_MAINSYSTEM_PRETTY_URLS'], true)) $data['constants'][$name] = constant($name);
                }
            } elseif ($section === 'redirects') $data = self::rows('zm_pb_redirects');
            elseif ($section === 'rewrites') {
                require_once ZM_PB_LIBDIR . 'rewrite_manager.php';
                $data = zm_pb_rewrite_custom_rules();
            } elseif ($section === 'media') {
                foreach (self::rows('zm_pb_attachments') as $row) {
                    $row['files'] = [];
                    $names = [$row['filename']];
                    foreach (json_decode($row['sizes'] ?? '{}', true) ?: [] as $size) if (isset($size['filename'])) $names[] = $size['filename'];
                    foreach (array_unique($names) as $name) $row['files'][$name] = base64_encode(self::read(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR . self::mediaName($name)));
                    $data[] = $row;
                    if (strlen(json_encode($data, JSON_THROW_ON_ERROR)) > self::MAX_BYTES) throw new RuntimeException(zm_pb_transfer_error('export_too_large'));
                }
            }
            $result['sections'][$section] = $data;
        }
        if ($zip && $warnings) $result['warnings'] = array_values($warnings);
        $json = json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
        if (strlen($json) > self::MAX_BYTES) throw new RuntimeException(zm_pb_transfer_error('export_too_large'));
        return $json;
    }

    /** Rewrite URL strings, including JSON embedded in database string columns. */
    private static function localize($value, array $map) {
        if (is_array($value)) { foreach ($value as &$item) $item = self::localize($item, $map); return $value; }
        if (!is_string($value)) return $value;
        $decoded = json_decode($value, true);
        if (is_array($decoded)) return json_encode(self::localize($decoded, $map), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
        return strtr($value, $map);
    }

    private static function pageId($oldId, array $references) {
        $ref = $references[$oldId] ?? null;
        if (!is_array($ref) || !is_string($ref['slug'] ?? null) || !is_string($ref['auth_type'] ?? null)) throw new RuntimeException(zm_pb_transfer_error('missing_page_ref'));
        $id = Capsule::table('zm_pb_pages')->where('slug', $ref['slug'])->where('auth_type', $ref['auth_type'])->value('id');
        if (!$id) throw new RuntimeException(zm_pb_transfer_error('import_page_first', $ref['slug']));
        return (int) $id;
    }

    private static function importLanguages(): array {
        $disabled = require ZM_PB_ROOTDIR . 'disabled_langs.php';
        if (!is_array($disabled)) throw new RuntimeException(zm_pb_transfer_error('invalid_archive'));
        return ZM_PB_LANGS + $disabled;
    }

    private static function normalizeImportLanguages($value, array $languages): array {
        $result = [];
        foreach (is_array($value) ? $value : [] as $name) {
            if (!is_string($name)) continue;
            $language = zm_pb_lm_supported_key($name);
            if (isset($languages[$language])) $result[$language] = $language;
        }
        return array_values($result);
    }

    private static function importMedia(array $rows, $source, ZM_PB_TransferFiles $files) {
        $map = [];
        if (!is_dir(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR) && !mkdir(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, 0755, true)) throw new RuntimeException(zm_pb_transfer_error('create_media_dir'));
        foreach ($rows as $row) {
            $sizes = json_decode($row['sizes'] ?? '{}', true, 512, JSON_THROW_ON_ERROR) ?: [];
            $names = [self::mediaName($row['filename'] ?? '')];
            $existing = Capsule::table('zm_pb_attachments')->where('filename', $row['filename'])->first();
            $owned = $existing ? [$existing->filename] : [];
            foreach (json_decode($existing->sizes ?? '{}', true) ?: [] as $size) if (isset($size['filename'])) $owned[] = $size['filename'];
            foreach ($sizes as $size) $names[] = self::mediaName($size['filename'] ?? '');
            $renamed = [];
            foreach (array_unique($names) as $name) {
                $bytes = base64_decode($row['files'][$name] ?? '', true);
                if ($bytes === false || $bytes === '') throw new RuntimeException(zm_pb_transfer_error('corrupted_media', $name));
                $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                $mime = (new finfo(FILEINFO_MIME_TYPE))->buffer($bytes);
                $allowedMime = ['jpg' => ['image/jpeg'], 'jpeg' => ['image/jpeg'], 'png' => ['image/png'], 'gif' => ['image/gif'],
                    'webp' => ['image/webp'], 'pdf' => ['application/pdf'], 'mp3' => ['audio/mpeg'], 'wav' => ['audio/x-wav', 'audio/wav'],
                    'ogg' => ['audio/ogg', 'video/ogg', 'application/ogg'], 'mp4' => ['video/mp4', 'application/mp4'], 'webm' => ['video/webm', 'audio/webm']];
                if (!in_array($mime, $allowedMime[$extension] ?? [], true)) throw new RuntimeException(zm_pb_transfer_error('mime_mismatch', $name));
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true) && !@getimagesizefromstring($bytes)) throw new RuntimeException(zm_pb_transfer_error('invalid_image', $name));
                // Update module-owned files; a collision with another WHMCS attachment gets a new name.
                $path = ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR . $name;
                $newName = (!file_exists($path) || in_array($name, $owned, true))
                    ? $name : 'pb_' . hash('sha256', $bytes) . '.' . $extension;
                $files->write(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR . $newName, $bytes);
                $renamed[$name] = $newName;
                $oldUrl = rtrim($source, '/') . '/attachments/' . rawurlencode($name);
                $map[$oldUrl] = ZM_PB_MAINSYSTEM_ATTACHMENTS_URL . rawurlencode($newName);
            }
            foreach ($sizes as &$size) {
                $size['filename'] = $renamed[$size['filename']];
                $size['url'] = ZM_PB_MAINSYSTEM_ATTACHMENTS_URL . rawurlencode($size['filename']);
            }
            unset($size);
            $record = self::fields($row, 'name alt title description created_at updated_at');
            $record['filename'] = $renamed[$row['filename']];
            $record['url'] = ZM_PB_MAINSYSTEM_ATTACHMENTS_URL . rawurlencode($record['filename']);
            $record['mime_type'] = (new finfo(FILEINFO_MIME_TYPE))->file(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR . $record['filename']);
            $record['sizes'] = json_encode($sizes, JSON_THROW_ON_ERROR);
            Capsule::table('zm_pb_attachments')->updateOrInsert(['filename' => $record['filename']], $record);
            if (is_string($row['url'] ?? null)) $map[$row['url']] = $record['url'];
        }
        return $map;
    }

    public static function importFile($path, array $selected, ?array &$warnings = null) {
        $size = @filesize($path);
        if (!is_file($path) || $size === false || $size > self::MAX_ARCHIVE_BYTES) throw new RuntimeException(zm_pb_transfer_error('file_too_large'));
        $handle = fopen($path, 'rb');
        if ($handle === false) throw new RuntimeException(zm_pb_transfer_error('read_file', basename($path)));
        try { $signature = fread($handle, 4); } finally { fclose($handle); }
        if (substr($signature, 0, 2) !== 'PK') {
            if ($size > self::MAX_BYTES) throw new RuntimeException(zm_pb_transfer_error('legacy_file_too_large'));
            return self::import(self::read($path), $selected, null, $warnings);
        }
        if ($signature !== "PK\x03\x04") throw new RuntimeException(zm_pb_transfer_error('invalid_archive'));
        if (!class_exists('ZipArchive')) throw new RuntimeException(zm_pb_transfer_error('zip_required'));
        $zip = new ZipArchive();
        if ($zip->open($path) !== true) throw new RuntimeException(zm_pb_transfer_error('invalid_archive'));
        try {
            $seen = []; $total = 0;
            for ($index = 0; $index < $zip->numFiles; $index++) {
                $stat = $zip->statIndex($index);
                $name = $stat['name'] ?? '';
                if (($name !== 'manifest.json' && !preg_match('~^generated/page_[0-9]+_[a-z][a-z-]*_(?:styles\.css|code_[a-z0-9]+\.(?:css|js))$~D', $name))
                    || isset($seen[$name]) || !isset($stat['size']) || $stat['size'] > self::MAX_ARCHIVE_BYTES) {
                    throw new RuntimeException(zm_pb_transfer_error('invalid_archive'));
                }
                $seen[$name] = true;
                $total += $stat['size'];
                if ($total > self::MAX_ARCHIVE_BYTES * 4) throw new RuntimeException(zm_pb_transfer_error('invalid_archive'));
            }
            $manifest = $zip->statName('manifest.json');
            if (!$manifest || $manifest['size'] > self::MAX_BYTES) throw new RuntimeException(zm_pb_transfer_error('invalid_archive'));
            $json = $zip->getFromName('manifest.json');
            if (!is_string($json)) throw new RuntimeException(zm_pb_transfer_error('invalid_archive'));
            return self::import($json, $selected, $zip, $warnings);
        } finally { $zip->close(); }
    }

    private static function archiveContent(ZipArchive $zip, $entry, $suffix) {
        if (!is_string($entry) || !preg_match('~^generated/page_[0-9]+_[a-z][a-z-]*_' . $suffix . '$~D', $entry)) throw new RuntimeException(zm_pb_transfer_error('invalid_archive'));
        $bytes = $zip->getFromName($entry);
        if (!is_string($bytes)) throw new RuntimeException(zm_pb_transfer_error('missing_archive_asset', $entry));
        return $bytes;
    }

    public static function import($json, array $selected, ?ZipArchive $zip = null, ?array &$warnings = null) {
        $warnings = [];
        if (!is_string($json) || strlen($json) > self::MAX_BYTES) throw new RuntimeException(zm_pb_transfer_error('legacy_file_too_large'));
        $archive = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        $source = $archive['source_url'] ?? null;
        $sourceParts = is_string($source) ? parse_url($source) : false;
        if (($archive['format'] ?? '') !== ZM_PB_NAME || ($archive['version'] ?? null) !== ($zip ? 2 : 1)
            || !is_array($archive['sections'] ?? null) || !is_array($archive['page_refs'] ?? null)
            || !is_string($source) || !filter_var($source, FILTER_VALIDATE_URL) || !is_array($sourceParts)
            || !in_array(strtolower($sourceParts['scheme'] ?? ''), ['http', 'https'], true)
            || isset($sourceParts['user']) || isset($sourceParts['pass']) || isset($sourceParts['query']) || isset($sourceParts['fragment'])) throw new RuntimeException(zm_pb_transfer_error('invalid_archive'));
        $sections = array_values(array_intersect(zm_pb_transfer_sections($selected), array_keys($archive['sections'])));
        if (!$sections) throw new RuntimeException(zm_pb_transfer_error('no_selected_sections'));
        self::ready($sections);
        foreach ($sections as $key) if (!is_array($archive['sections'][$key])) throw new RuntimeException(zm_pb_transfer_error('corrupt_section', $key));
        $languages = array_intersect($sections, ['pages', 'menus']) ? self::importLanguages() : [];
        $files = new ZM_PB_TransferFiles(); $counts = [];
        $lock = @fopen(ZM_PB_INCDIR . 'transfer.lock', 'c');
        if (!$lock || !flock($lock, LOCK_EX | LOCK_NB)) { if (is_resource($lock)) fclose($lock); throw new RuntimeException(zm_pb_transfer_error('import_locked')); }
        try {
            Capsule::connection()->beginTransaction();
            $map = [];
            if (in_array('media', $sections, true)) {
                $map = self::importMedia($archive['sections']['media'], $archive['source_url'], $files);
                $counts['media'] = count($archive['sections']['media']);
            }
            $map[rtrim($archive['source_url'], '/') . '/'] = ZM_PB_FULLHOST;
            $data = self::localize($archive['sections'], $map);
            if (in_array('settings', $sections, true)) self::importSettings($data['settings'], $files);
            if (in_array('pages', $sections, true)) foreach ($data['pages'] as $row) self::importPage($row, $files, $languages, $zip);
            if (in_array('menus', $sections, true)) self::importMenus($data['menus'], $archive['page_refs'], $languages, $warnings);
            if (in_array('redirects', $sections, true)) self::importRedirects($data['redirects'], $archive['page_refs']);
            if (in_array('rewrites', $sections, true)) self::importRewrites($data['rewrites'], $files);
            if (in_array('menus', $sections, true)) {
                require_once ZM_PB_INCDIR . 'footer_menu.php';
                $theme = $GLOBALS['CONFIG']['Template'] ?? '';
                if (preg_match('/^[a-zA-Z0-9_-]+$/D', $theme) && is_file(ROOTDIR . '/templates/' . $theme . '/footer.tpl')) $files->remember(ROOTDIR . '/templates/' . $theme . '/footer.tpl');
                zm_pb_menu_sync_footer_template();
            }
            Capsule::connection()->commit();
            foreach ($sections as $key) $counts[$key] = $counts[$key] ?? count($data[$key]);
            return $counts;
        } catch (Throwable $error) {
            if (Capsule::connection()->transactionLevel() > 0) Capsule::connection()->rollBack();
            $files->rollback(); throw $error;
        } finally { flock($lock, LOCK_UN); fclose($lock); }
    }

    private static function importPage(array $row, ZM_PB_TransferFiles $files, array $languages, ?ZipArchive $zip = null) {
        if (!is_string($row['slug'] ?? null) || !preg_match('~^[a-zA-Z0-9_-]+(?:/[a-zA-Z0-9_-]+)*$~D', $row['slug'])
            || !in_array($row['auth_type'] ?? '', ['auth', 'noauth', 'mixed'], true)
            || !in_array($row['status'] ?? '', ['draft', 'publish', 'delayed', 'canceled'], true)
            || !in_array($row['type'] ?? '', ['page', 'post', 'system'], true)) throw new RuntimeException(zm_pb_transfer_error('invalid_page'));
        $record = self::fields($row, 'name slug template_file auth_type status type langs created_at updated_at');
        if (isset($record['langs'])) {
            $record['langs'] = json_encode(self::normalizeImportLanguages(json_decode($record['langs'], true), $languages), JSON_THROW_ON_ERROR);
        }
        if (!empty($record['template_file']) && (!is_string($record['template_file']) || preg_match('~(?:\.\.|[\\\\\x00])~', $record['template_file']))) throw new RuntimeException(zm_pb_transfer_error('invalid_template'));
        $match = ['slug' => $record['slug'], 'auth_type' => $record['auth_type']];
        $id = Capsule::table('zm_pb_pages')->where($match)->value('id');
        if ($id) {
            $oldLangs = self::normalizeImportLanguages(json_decode(Capsule::table('zm_pb_pages')->where('id', $id)->value('langs') ?? '[]', true), $languages);
            $newLangs = json_decode($record['langs'] ?? '[]', true, 512, JSON_THROW_ON_ERROR) ?: [];
            $record['langs'] = json_encode(array_values(array_unique(array_merge($oldLangs, $newLangs))), JSON_THROW_ON_ERROR);
        }
        if ($id) Capsule::table('zm_pb_pages')->where('id', $id)->update($record);
        else $id = Capsule::table('zm_pb_pages')->insertGetId($record);
        if (!is_array($row['translations'] ?? null) || !is_array($row['sitemap'] ?? null)) throw new RuntimeException(zm_pb_transfer_error('missing_page_data'));
        foreach ($row['translations'] as $translation) {
            $lang = zm_pb_lm_supported_key($translation['lang'] ?? '');
            if (!isset($languages[$lang])) throw new RuntimeException(zm_pb_transfer_error('unsupported_language', $lang));
            if (!in_array($translation['lang_status'] ?? '', ['draft', 'publish', 'delayed'], true)) throw new RuntimeException(zm_pb_transfer_error('invalid_translation_status'));
            $value = self::fields($translation, 'lang_status lang_active settings created_at updated_at');
            $content = $translation['content'] ?? '';
            if ($content !== '') {
                $parsed = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
                if (!isset($parsed['code']) || !is_array($parsed['code'])) throw new RuntimeException(zm_pb_transfer_error('missing_source_code'));
                if ($zip) {
                    $parsed['css'] = isset($parsed['cssFile']) ? self::archiveContent($zip, $parsed['cssFile'], 'styles\.css') : ($parsed['css'] ?? '');
                    unset($parsed['cssFile']);
                    foreach ($parsed['code'] as &$block) {
                        if (!is_array($block) || !is_string($block['id'] ?? null) || !preg_match('/^code_[a-z0-9]{1,32}$/D', $block['id'])
                            || !in_array($block['type'] ?? null, ['css', 'js'], true)) throw new RuntimeException(zm_pb_transfer_error('invalid_archive'));
                        $block['code'] = isset($block['file'])
                            ? self::archiveContent($zip, $block['file'], preg_quote($block['id'], '~') . '\.' . $block['type'])
                            : ($block['code'] ?? null);
                        if (!is_string($block['code'])) throw new RuntimeException(zm_pb_transfer_error('invalid_archive'));
                        unset($block['file']);
                    }
                    unset($block);
                    $content = json_encode($parsed, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
                }
            }
            zm_pb_adopt_page_language((int) $id, $lang);
            $value['content'] = zm_pb_save_grapes_content($id, $lang, $content, [$files, 'write'], $languages);
            Capsule::table('zm_pb_pages_settings')->updateOrInsert(['page_id' => $id, 'lang' => $lang], $value);
        }
        foreach ($row['sitemap'] as $sitemap) {
            $value = self::fields($sitemap, 'active url changefreq priority sitemap_type created_at updated_at');
            Capsule::table('zm_pb_sitemap')->updateOrInsert(['page_id' => $id], $value);
        }
    }

    private static function importMenuLinkLabel(array $item): string {
        $label = $item['label'] ?? '';
        if (is_string($label) && trim($label) !== '') return trim($label);
        foreach (is_array($item['labels'] ?? null) ? $item['labels'] : [] as $translation) {
            if (is_string($translation) && trim($translation) !== '') return trim($translation);
        }
        $url = $item['url'] ?? '';
        if (!is_string($url) || !zm_pb_menu_safe_url($url)) return '';
        $query = parse_url($url, PHP_URL_QUERY);
        if (is_string($query)) {
            parse_str($query, $parameters);
            $slug = $parameters['slug'] ?? null;
            if (is_string($slug) && preg_match('/^[a-zA-Z0-9_-]{1,100}$/D', $slug)) return $slug;
        }
        $path = parse_url($url, PHP_URL_PATH);
        $segment = is_string($path) ? rawurldecode(basename(rtrim($path, '/'))) : '';
        return preg_match('/^[a-zA-Z0-9_-]{1,100}$/D', $segment) ? $segment : '';
    }

    private static function importMenuItems(array $items, array $references, int $menuId, array &$warnings): array {
        require_once ZM_PB_INCDIR . 'menu_manager.php';
        $skipped = [];
        foreach ($items as &$item) {
            if (($item['type'] ?? '') !== 'page') continue;
            $pageId = $item['page_id'] ?? null;
            if (is_scalar($pageId) && isset($references[$pageId])) continue;
            $label = self::importMenuLinkLabel($item);
            if ($label !== '' && zm_pb_menu_safe_url($item['url'] ?? '')) {
                $item['type'] = 'custom';
                $item['page_id'] = null;
                $item['label'] = $label;
                $item['localize_url'] = false;
                $warnings[] = zm_pb_transfer_error('missing_page_ref') . ' [menu #' . $menuId
                    . ', item #' . (int) ($item['id'] ?? 0) . ', page #' . (int) $pageId . ' -> custom URL: ' . $label . ']';
                continue;
            }
            $skipped[(string) ($item['key'] ?? '')] = true;
        }
        unset($item);
        do {
            $changed = false;
            foreach ($items as $item) {
                $key = (string) ($item['key'] ?? '');
                $parent = (string) ($item['parent'] ?? '');
                if (!isset($skipped[$key]) && $parent !== '' && isset($skipped[$parent])) {
                    $skipped[$key] = true;
                    $changed = true;
                }
            }
        } while ($changed);
        $kept = [];
        foreach ($items as $item) {
            $key = (string) ($item['key'] ?? '');
            if (isset($skipped[$key])) {
                $warnings[] = zm_pb_transfer_error('missing_page_ref') . ' [menu #' . $menuId
                    . ', item #' . (int) ($item['id'] ?? 0) . ', page #' . (int) ($item['page_id'] ?? 0) . ']';
                continue;
            }
            $kept[] = $item;
        }
        return $kept;
    }

    private static function importMenus(array $rows, array $references, array $languages, array &$warnings) {
        require_once ZM_PB_INCDIR . 'menu_manager.php';
        foreach ($rows as $row) {
            $matches = Capsule::table('zm_pb_menus')->where('name', $row['name'] ?? '')->pluck('id')->all();
            if (count($matches) > 1) throw new RuntimeException(zm_pb_transfer_error('duplicate_menu', $row['name']));
            if (!is_array($row['items'] ?? null)) throw new RuntimeException(zm_pb_transfer_error('missing_menu_items'));
            $row['items'] = self::importMenuItems($row['items'], $references, (int) ($row['id'] ?? 0), $warnings);
            foreach ($row['items'] as &$item) if (($item['type'] ?? '') === 'page') $item['page_id'] = self::pageId($item['page_id'], $references);
            unset($item);
            $row['menu_id'] = $matches[0] ?? 0;
            $row['items'] = json_encode($row['items'], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
            zm_pb_menu_save($row, $languages);
        }
    }

    private static function importSettings(array $data, ZM_PB_TransferFiles $files) {
        if (!is_array($data['rows'] ?? null) || !is_array($data['constants'] ?? null)) throw new RuntimeException(zm_pb_transfer_error('invalid_settings'));
        foreach ($data['rows'] as $row) {
            if (!is_string($row['setting_name'] ?? null) || $row['setting_name'] === '') throw new RuntimeException(zm_pb_transfer_error('missing_setting_name'));
            $value = self::fields($row, 'type setting_storage_type setting_value');
            Capsule::table('zm_pb_module_settings')->updateOrInsert(['setting_name' => $row['setting_name']], $value);
        }
        $constants = [];
        foreach ($data['constants'] as $name => $value) {
            if (!in_array($name, ZM_PB_ALLOWED_CONSTS_CHANGE, true) || in_array($name, ['ZM_PB_SITEMAP_LASTUPD', 'ZM_PB_MAINSYSTEM_PRETTY_URLS'], true) || !defined($name)) throw new RuntimeException(zm_pb_transfer_error('invalid_constant', $name));
            [$valid, $normalized] = zm_pb_normalize_const_value(constant($name), $value);
            if (!$valid || ($name === 'ZM_PB_AUTO_REDIRECT_DAYS' && ($normalized < 0 || $normalized > 36500))) throw new RuntimeException(zm_pb_transfer_error('invalid_value', $name));
            $constants[$name] = $normalized;
        }
        if ($constants) {
            $files->remember(ZM_PB_INCDIR . 'editable_consts.php');
            if (!defined('ZMPB_EDIT_CONSTS')) define('ZMPB_EDIT_CONSTS', true);
            $result = zm_pb_update_consts_in_file($constants, true);
            if (($result['status'] ?? '') !== 'success') throw new RuntimeException(zm_pb_transfer_error('save_settings_failed'));
        }
        if (isset($data['robots'])) {
            if (!is_string($data['robots'])) throw new RuntimeException(zm_pb_transfer_error('invalid_robots'));
            $files->write(ROOTDIR . '/robots.txt', $data['robots']);
        }
    }

    private static function importRedirects(array $rows, array $references) {
        require_once ZM_PB_LIBDIR . 'redirects.php';
        foreach ($rows as $row) {
            if (($row['method'] ?? 'GET') !== 'GET') throw new RuntimeException(zm_pb_transfer_error('get_redirects_only'));
            $from = zm_pb_redirect_url($row['from'], true);
            $row['id'] = Capsule::table('zm_pb_redirects')->where('from', $from)->where('method', 'GET')->value('id') ?: 0;
            $id = zm_pb_redirect_save($row);
            $conditions = json_decode($row['conditions'] ?? 'null', true);
            if (($row['type'] ?? '') === 'system' && isset($conditions['page_id'])) {
                $conditions['page_id'] = self::pageId($conditions['page_id'], $references);
                Capsule::table('zm_pb_redirects')->where('id', $id)->update(['type' => 'system', 'conditions' => json_encode($conditions, JSON_THROW_ON_ERROR)]);
            }
        }
    }

    private static function importRewrites(array $rows, ZM_PB_TransferFiles $files) {
        require_once ZM_PB_LIBDIR . 'rewrite_manager.php';
        $files->remember(ZM_PB_INCDIR . 'rewrite_rules_custom.php');
        foreach ($rows as $row) {
            foreach (['pattern', 'target', 'flags'] as $key) if (!is_string($row[$key] ?? null)) throw new RuntimeException(zm_pb_transfer_error('invalid_rewrite'));
            try { zm_pb_rewrite_add_custom_rule($row['pattern'], $row['target'], $row['flags']); }
            catch (InvalidArgumentException $error) { if ($error->getMessage() !== 'duplicate_rule') throw $error; }
        }
    }
}
