<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

/** Prepare only the module's own directory inside the public WHMCS assets tree. */
function zm_pb_media_prepare_dir(): bool
{
    if (!is_dir(ZM_PB_MAINSYSTEM_ASSETS_DIR)
        && !@mkdir(ZM_PB_MAINSYSTEM_ASSETS_DIR, 0755, true)
        && !is_dir(ZM_PB_MAINSYSTEM_ASSETS_DIR)) return false;
    $rules = ZM_PB_MAINSYSTEM_ASSETS_DIR . '.htaccess';
    if (!is_file($rules) && @file_put_contents($rules,
        "Options -Indexes\n<FilesMatch \"\\.(?:php[0-9]?|phtml|phar|cgi|pl|py|sh)$\">\n    Require all denied\n</FilesMatch>\n") === false) return false;
    $index = ZM_PB_MAINSYSTEM_ASSETS_DIR . 'index.php';
    if (!is_file($index) && @file_put_contents($index, "<?php\nhttp_response_code(403);\nexit;\n") === false) return false;
    return is_writable(ZM_PB_MAINSYSTEM_ASSETS_DIR);
}

/** Copy older module media to the public assets directory and update saved URLs. */
function zm_pb_media_migrate_legacy(): void
{
    if (!zm_pb_media_prepare_dir() || !Capsule::schema()->hasTable('zm_pb_attachments')) return;
    $rows = Capsule::table('zm_pb_attachments')->where(function ($query) {
        $query->where('url', 'like', '%/attachments/%')
            ->orWhere('url', 'like', '%/modules/addons/' . ZM_PB_NAME . '/assets/media/%');
    })->get();
    if ($rows->isEmpty()) return;

    $updates = [];
    $urlMap = [];
    foreach ($rows as $row) {
        $oldPath = (string) parse_url((string) $row->url, PHP_URL_PATH);
        if (strpos($oldPath, '/attachments/') !== false) $legacyDir = ROOTDIR . '/attachments/';
        elseif (strpos($oldPath, '/modules/addons/' . ZM_PB_NAME . '/assets/media/') !== false)
            $legacyDir = ZM_PB_ASSETSDIR . 'media/';
        else continue;
        $sizes = json_decode((string) ($row->sizes ?? '{}'), true);
        if (!is_array($sizes)) continue;
        $names = [(string) $row->filename];
        foreach ($sizes as $size) {
            if (is_array($size) && isset($size['filename'])) $names[] = (string) $size['filename'];
        }
        $renamed = [];
        $rowUrlMap = [];
        $complete = true;
        foreach (array_unique($names) as $name) {
            if ($name === '' || $name !== basename($name) || !preg_match('/^[A-Za-z0-9_.-]+$/D', $name)) {
                $complete = false;
                break;
            }
            $source = $legacyDir . $name;
            if (!is_file($source) || !is_readable($source)) {
                $complete = false;
                break;
            }
            $targetName = $name;
            $target = ZM_PB_MAINSYSTEM_ASSETS_DIR . $targetName;
            if (is_file($target) && hash_file('sha256', $source) !== hash_file('sha256', $target)) {
                $targetName = 'pb_' . hash_file('sha256', $source) . '.' . pathinfo($name, PATHINFO_EXTENSION);
                $target = ZM_PB_MAINSYSTEM_ASSETS_DIR . $targetName;
            }
            if (!is_file($target) && !@copy($source, $target)) {
                $complete = false;
                break;
            }
            $renamed[$name] = $targetName;
            $oldBase = substr((string) $row->url, 0, strrpos((string) $row->url, '/') + 1);
            $rowUrlMap[$oldBase . rawurlencode($name)] = ZM_PB_MAINSYSTEM_ASSETS_URL . rawurlencode($targetName);
        }
        if (!$complete) continue;
        foreach ($sizes as &$size) {
            if (!is_array($size) || !isset($size['filename'])) continue;
            $oldUrl = $size['url'] ?? null;
            $size['filename'] = $renamed[$size['filename']];
            $size['url'] = ZM_PB_MAINSYSTEM_ASSETS_URL . rawurlencode($size['filename']);
            if (is_string($oldUrl)) $rowUrlMap[$oldUrl] = $size['url'];
        }
        unset($size);
        $newUrl = ZM_PB_MAINSYSTEM_ASSETS_URL . rawurlencode($renamed[$row->filename]);
        $rowUrlMap[$row->url] = $newUrl;
        $urlMap += $rowUrlMap;
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
                foreach (Capsule::table($table)->where(function ($query) use ($column) {
                    $query->where($column, 'like', '%attachments%')
                        ->orWhere($column, 'like', '%assets/media%');
                })->get(['id', $column]) as $record) {
                    $old = (string) $record->$column;
                    $new = strtr($old, $urlMap);
                    if ($new !== $old) Capsule::table($table)->where('id', $record->id)->update([$column => $new]);
                }
            }
        }
    });
}
