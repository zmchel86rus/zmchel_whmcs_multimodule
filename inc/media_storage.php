<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

/** Copy module media into assets/media and update saved URLs without deleting the old files. */
function zm_pb_media_migrate_legacy(): void
{
    $marker = ZM_PB_MEDIA_DIR . '.legacy-migrated';
    if (is_file($marker) || !Capsule::schema()->hasTable('zm_pb_attachments')) return;

    $rows = Capsule::table('zm_pb_attachments')->where('url', 'like', '%/attachments/%')->get();
    if ($rows->isEmpty()) {
        if (is_dir(ZM_PB_MEDIA_DIR)) @touch($marker);
        return;
    }
    if (!is_dir(ZM_PB_MEDIA_DIR) && !@mkdir(ZM_PB_MEDIA_DIR, 0755, true) && !is_dir(ZM_PB_MEDIA_DIR)) return;

    $legacyDir = ROOTDIR . '/attachments/';
    $updates = [];
    $urlMap = [];
    foreach ($rows as $row) {
        $sizes = json_decode((string) ($row->sizes ?? '{}'), true);
        if (!is_array($sizes)) return;
        $names = [(string) $row->filename];
        foreach ($sizes as $size) {
            if (is_array($size) && isset($size['filename'])) $names[] = (string) $size['filename'];
        }
        $renamed = [];
        foreach (array_unique($names) as $name) {
            if ($name === '' || $name !== basename($name) || !preg_match('/^[A-Za-z0-9_.-]+$/D', $name)) return;
            $source = $legacyDir . $name;
            if (!is_file($source) || !is_readable($source)) return;
            $targetName = $name;
            $target = ZM_PB_MEDIA_DIR . $targetName;
            if (is_file($target) && hash_file('sha256', $source) !== hash_file('sha256', $target)) {
                $targetName = 'pb_' . hash_file('sha256', $source) . '.' . pathinfo($name, PATHINFO_EXTENSION);
                $target = ZM_PB_MEDIA_DIR . $targetName;
            }
            if (!is_file($target) && !@copy($source, $target)) return;
            $renamed[$name] = $targetName;
            $oldBase = substr((string) $row->url, 0, strrpos((string) $row->url, '/') + 1);
            $urlMap[$oldBase . rawurlencode($name)] = ZM_PB_MEDIA_URL . rawurlencode($targetName);
        }
        foreach ($sizes as &$size) {
            if (!is_array($size) || !isset($size['filename'])) continue;
            $oldUrl = $size['url'] ?? null;
            $size['filename'] = $renamed[$size['filename']];
            $size['url'] = ZM_PB_MEDIA_URL . rawurlencode($size['filename']);
            if (is_string($oldUrl)) $urlMap[$oldUrl] = $size['url'];
        }
        unset($size);
        $newUrl = ZM_PB_MEDIA_URL . rawurlencode($renamed[$row->filename]);
        $urlMap[$row->url] = $newUrl;
        $updates[(int) $row->id] = ['filename' => $renamed[$row->filename], 'url' => $newUrl,
            'sizes' => json_encode($sizes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)];
    }

    $escapedMap = [];
    foreach ($urlMap as $oldUrl => $newUrl)
        $escapedMap[str_replace('/', '\\/', $oldUrl)] = str_replace('/', '\\/', $newUrl);
    $urlMap += $escapedMap;
    Capsule::connection()->transaction(function () use ($updates, $urlMap): void {
        foreach ($updates as $id => $data) Capsule::table('zm_pb_attachments')->where('id', $id)->update($data);
        foreach (['zm_pb_pages_settings' => ['content', 'settings'],
                  'zm_pb_menu_items' => ['url'],
                  'zm_pb_redirects' => ['to'],
                  'zm_pb_module_settings' => ['setting_value']] as $table => $columns) {
            if (!Capsule::schema()->hasTable($table)) continue;
            foreach ($columns as $column) {
                if (!Capsule::schema()->hasColumn($table, $column)) continue;
                foreach (Capsule::table($table)->where($column, 'like', '%attachments%')->get(['id', $column]) as $record) {
                    $old = (string) $record->$column;
                    $new = strtr($old, $urlMap);
                    if ($new !== $old) Capsule::table($table)->where('id', $record->id)->update([$column => $new]);
                }
            }
        }
    });
    @touch($marker);
}
