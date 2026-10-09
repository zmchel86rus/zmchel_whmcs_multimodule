<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
require_once ZM_PB_INCDIR . 'sitemap_manager.php';
use Illuminate\Database\Capsule\Manager as Capsule;

/** Creates public sitemap documents; never creates or repairs database tables. */
class ZM_PB_Sitemap
{
    private const NS = 'http://www.sitemaps.org/schemas/sitemap/0.9';
    private const MAX_URLS = 50000;
    private const MAX_BYTES = 52428800;

    public static function entries()
    {
        foreach (['zm_pb_sitemap', 'zm_pb_pages', 'zm_pb_pages_settings'] as $table) {
            if (!zm_pb_has_table($table)) throw new RuntimeException('missing_tables');
        }
        $configuration = [];
        if (ZM_PB_ENABLE_PAGE_OVERRIDES) {
            if (!zm_pb_has_table('zm_pb_module_settings')) throw new RuntimeException('missing_tables');
            $configuration = json_decode(Capsule::table('zm_pb_module_settings')->where('setting_name', 'page_overrides')->value('setting_value') ?? '[]', true);
        }
        $overrides = zm_pb_sitemap_overrides($configuration);
        $redirects = [];
        if (defined('ZM_PB_ENABLE_REDIRECTS_MANAGER') && ZM_PB_ENABLE_REDIRECTS_MANAGER) {
            require_once ZM_PB_LIBDIR . 'redirects.php';
            $redirects = zm_pb_redirect_rules();
        }
        $rows = Capsule::table('zm_pb_sitemap as sitemap')->join('zm_pb_pages as page', 'page.id', '=', 'sitemap.page_id')
            ->where('sitemap.active', true)->where('page.status', 'publish')->whereIn('page.type', ['page', 'post'])
            ->whereIn('page.auth_type', ['mixed', 'noauth'])
            ->select('sitemap.*', 'page.slug', 'page.type as page_type', 'page.updated_at as page_updated_at', 'page.created_at as page_created_at')
            ->orderBy('page.id')->get();
        // Match zm_pb_load_page_by_slug: publication belongs to the page, while
        // language availability uses lang_active. The editor leaves lang_status at draft.
        $translations = Capsule::table('zm_pb_pages_settings')->whereIn('page_id', $rows->pluck('page_id')->all())
            ->where('lang_active', true)->whereIn('lang', array_keys(ZM_PB_LANGS))
            ->orderBy('id')->get()->groupBy('page_id');
        $groups = ['pages' => [], 'posts' => []];
        $seen = [];
        foreach ($rows as $row) {
            $localized = [];
            foreach ($translations[$row->page_id] ?? [] as $translation) $localized[$translation->lang] = $translation;
            if (!$localized || !is_string($row->slug) || $row->slug === '') continue;
            $versions = [ZM_PB_DEFLANG => $localized[ZM_PB_DEFLANG] ?? reset($localized)];
            $sources = $overrides[$row->slug] ?? [null];
            if (ZM_PB_ENABLE_LANG_ROUTE && ($sources === [null] || ZM_PB_PRETTY_URLS)) {
                foreach ($localized as $language => $translation) if ($language !== ZM_PB_DEFLANG) $versions[$language] = $translation;
            }
            foreach ($sources as $source) {
                // Each native page is a separate translation group, even when sharing a layout.
                $entries = []; $alternates = []; $defaultUrl = null;
                foreach ($versions as $language => $translation) {
                    $url = zm_pb_sitemap_url($row->slug, $language, $source, trim((string) ($row->url ?? '')));
                    if ($url === null || strlen($url) >= 2048 || isset($seen[$url]) || isset($entries[$url])) continue;
                    if ($redirects) {
                        try { if (zm_pb_redirect_resolve($url, $redirects, $overrides) !== null) continue; }
                        catch (InvalidArgumentException $error) { continue; }
                    }
                    if ($language === ZM_PB_DEFLANG) $defaultUrl = $url;
                    // A fallback translation is not an English version just because its URL has no prefix.
                    $contentLanguage = $translation->lang;
                    $code = ZM_PB_LANGS[$contentLanguage]['code_ISO639_1'] ?? '';
                    if ($code !== '') $alternates[$code] = $url;
                    $last = max(zm_pb_sitemap_timestamp($row->page_updated_at), zm_pb_sitemap_timestamp($row->page_created_at),
                        zm_pb_sitemap_timestamp($translation->updated_at ?? null), zm_pb_sitemap_timestamp($translation->created_at ?? null));
                    $entries[$url] = ['url' => $url, 'page_id' => (int) $row->page_id,
                        'sitemap_type' => $row->page_type, 'lang' => $contentLanguage, 'lastmod' => $last ? gmdate('c', $last) : '',
                        'changefreq' => in_array($row->changefreq, ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'], true) ? $row->changefreq : 'monthly',
                        'priority' => number_format(max(0, min(1, (float) $row->priority)), 1, '.', '')];
                }
                if ($defaultUrl !== null) $alternates['x-default'] = $defaultUrl;
                foreach ($entries as $url => $entry) {
                    $seen[$url] = true;
                    $entry['alternates'] = $alternates;
                    $groups[$row->page_type === 'post' ? 'posts' : 'pages'][] = $entry;
                }
            }
        }
        return $groups;
    }

    private static function entryXml(array $entry)
    {
        $writer = new XMLWriter(); $writer->openMemory(); $writer->setIndent(true);
        $writer->startElement('url'); $writer->writeElement('loc', $entry['url']);
        foreach ($entry['alternates'] ?? [] as $language => $url) {
            $writer->startElement('xhtml:link');
            $writer->writeAttribute('rel', 'alternate');
            $writer->writeAttribute('hreflang', $language);
            $writer->writeAttribute('href', $url);
            $writer->endElement();
        }
        if ($entry['lastmod'] !== '') $writer->writeElement('lastmod', $entry['lastmod']);
        $writer->writeElement('changefreq', $entry['changefreq']); $writer->writeElement('priority', $entry['priority']);
        $writer->endElement();
        return $writer->outputMemory();
    }

    /** Split on both protocol limits. Empty categories do not leave obsolete sitemap files. */
    public static function documents(array $groups)
    {
        $documents = [];
        $head = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="' . self::NS . '" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
        $tail = "</urlset>\n";
        foreach (['pages', 'posts'] as $group) {
            $part = 1; $count = 0; $xml = $head;
            foreach ($groups[$group] ?? [] as $entry) {
                $item = self::entryXml($entry);
                if ($count && ($count >= self::MAX_URLS || strlen($xml) + strlen($item) + strlen($tail) > self::MAX_BYTES)) {
                    $documents['sitemap_' . $group . ($part === 1 ? '' : '_' . $part) . '.xml'] = $xml . $tail;
                    $part++; $count = 0; $xml = $head;
                }
                $xml .= $item; $count++;
            }
            if ($count) $documents['sitemap_' . $group . ($part === 1 ? '' : '_' . $part) . '.xml'] = $xml . $tail;
        }
        return $documents;
    }

    private static function indexXml(array $documents, $now)
    {
        $files = [];
        foreach (zm_pb_sitemap_files() as $name => $file) {
            // Indexes cannot recursively reference themselves or other sitemap indexes.
            if ($file['type'] !== 'urlset' || zm_pb_sitemap_owned($name)) continue;
            $files[$name] = $file['lastmod'];
        }
        foreach ($documents as $name => $unused) $files[$name] = gmdate('c', $now);
        if (count($files) > self::MAX_URLS) throw new RuntimeException('too_many_files');
        ksort($files);
        $writer = new XMLWriter(); $writer->openMemory(); $writer->setIndent(true);
        $writer->startDocument('1.0', 'UTF-8'); $writer->startElementNS(null, 'sitemapindex', self::NS);
        foreach ($files as $name => $lastmod) {
            $writer->startElement('sitemap'); $writer->writeElement('loc', rtrim(ZM_PB_FULLHOST, '/') . '/' . rawurlencode($name));
            $writer->writeElement('lastmod', $lastmod); $writer->endElement();
        }
        $writer->endElement(); $writer->endDocument();
        return $writer->outputMemory();
    }

    private static function publish(array $documents, $now)
    {
        $staged = []; $backups = []; $touched = []; $obsolete = [];
        foreach (glob(ROOTDIR . '/sitemap_*.xml') ?: [] as $path) {
            if (zm_pb_sitemap_owned(basename($path)) && !isset($documents[basename($path)])) $obsolete[] = $path;
        }
        try {
            foreach ($documents as $name => $xml) {
                $path = ROOTDIR . '/' . $name;
                if (is_link($path) || (file_exists($path) && !is_file($path))) throw new RuntimeException('unsafe_path');
                $temporary = tempnam(ROOTDIR, '.zmpb-sitemap-');
                if ($temporary === false) throw new RuntimeException('root_not_writable');
                $staged[$path] = $temporary;
                if (file_put_contents($temporary, $xml, LOCK_EX) !== strlen($xml)) throw new RuntimeException('write_failed');
                chmod($temporary, 0644);
            }
            foreach (array_merge(array_keys($staged), $obsolete) as $path) {
                if (is_link($path) || (file_exists($path) && !is_file($path))) throw new RuntimeException('unsafe_path');
                $backups[$path] = null;
                if (is_file($path)) {
                    $backup = tempnam(ROOTDIR, '.zmpb-previous-');
                    if ($backup === false) throw new RuntimeException('write_failed');
                    $backups[$path] = $backup;
                    if (!copy($path, $backup)) throw new RuntimeException('write_failed');
                    chmod($backup, fileperms($path) & 0777);
                }
            }
            // The index is inserted last, after every file it references is ready.
            foreach ($staged as $path => $temporary) {
                if (!rename($temporary, $path)) throw new RuntimeException('write_failed');
                $touched[] = $path;
            }
            foreach ($obsolete as $path) {
                if (!unlink($path)) throw new RuntimeException('write_failed');
                $touched[] = $path;
            }
            if (!defined('ZMPB_EDIT_CONSTS')) define('ZMPB_EDIT_CONSTS', true);
            $result = zm_pb_update_consts_in_file(['ZM_PB_SITEMAP_LASTUPD' => gmdate('c', $now)]);
            if (($result['status'] ?? '') !== 'success') throw new RuntimeException('settings_not_writable');
        } catch (Throwable $error) {
            foreach (array_reverse($touched) as $path) {
                if ($backups[$path] !== null) {
                    if (!rename($backups[$path], $path)) error_log('zmchel WHMCS Multimodule sitemap: could not restore ' . basename($path));
                } else { @unlink($path); }
            }
            throw $error;
        } finally {
            foreach (array_merge(array_values($staged), array_values($backups)) as $path) if ($path !== null && is_file($path)) @unlink($path);
        }
    }

    public static function generate($force = false)
    {
        if (!ZM_PB_ENABLE_SITEMAP) return ['status' => 'disabled'];
        if (!$force && !zm_pb_sitemap_due()) return ['status' => 'skipped'];
        if (!is_dir(ZM_PB_RESOURCESDIR) && !mkdir(ZM_PB_RESOURCESDIR, 0755, true) && !is_dir(ZM_PB_RESOURCESDIR)) throw new RuntimeException('lock_failed');
        $lock = fopen(ZM_PB_RESOURCESDIR . 'sitemap.lock', 'c');
        if ($lock === false) throw new RuntimeException('lock_failed');
        if (!flock($lock, LOCK_EX | LOCK_NB)) { fclose($lock); return ['status' => 'busy']; }
        try {
            if (!$force && !zm_pb_sitemap_due()) return ['status' => 'skipped'];
            if (!is_dir(ROOTDIR) || !is_writable(ROOTDIR)) throw new RuntimeException('root_not_writable');
            if (!is_writable(ZM_PB_INCDIR . 'editable_consts.php')) throw new RuntimeException('settings_not_writable');
            $now = time();
            $groups = self::entries(); $documents = self::documents($groups);
            $documents['sitemap_index.xml'] = self::indexXml($documents, $now);
            self::publish($documents, $now);
            return ['status' => 'success', 'last_update' => gmdate('c', $now), 'files' => array_keys($documents),
                'pages' => count($groups['pages']), 'posts' => count($groups['posts'])];
        } finally { flock($lock, LOCK_UN); fclose($lock); }
    }
}
