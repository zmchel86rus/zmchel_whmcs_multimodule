<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
header('Content-Type: application/json; charset=utf-8');

try {
    if (!zm_pb_check_super_admin()) throw new RuntimeException('Access denied.');
    if (!isset($_POST['zm_pb_admin_nonce']) ||
        !zm_pb_check_token(ZM_PB_ADMIN_PRENONCE, $_POST['zm_pb_admin_nonce'], ZM_PB_ADMIN_SALT))
        throw new RuntimeException($GLOBALS['ZM_PB_ADMINLANG']->other->error_token);
    $sections = zm_pb_lm_sections();
    $id = $_POST['section'] ?? '';
    $name = $_POST['language'] ?? '';
    if (!is_string($id) || !is_string($name) ||
        !preg_match('/^[a-z0-9_-]+$/D', $name)) throw new InvalidArgumentException('Invalid language section.');
    if ($method_action === 'fix_language_filename') {
        if ($id !== 'all') throw new InvalidArgumentException('Invalid language section.');
        zm_pb_lm_fix_filename_all($sections, $name);
        exit(json_encode(['status' => 'success', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->success]));
    }
    if (!isset($sections[$id])) throw new InvalidArgumentException('Invalid language section.');
    $section = $sections[$id];
    if ($method_action === 'export_translations' || $method_action === 'import_translations') {
        $files = zm_pb_lm_files($section);
        if (!isset($files[$name])) throw new InvalidArgumentException('Language not found.');
        $reference = zm_pb_lm_name($section, ZM_PB_DEFLANG);
        if (!isset($files[$reference])) $reference = isset($files['english']) ? 'english' : $name;
        if ($method_action === 'export_translations') {
            $content = zm_pb_lm_export_translations($section, $id, $name, $reference);
            $filename = 'translations-' . preg_replace('/[^a-zA-Z0-9_-]/', '-', $id) . '-' . $name . '.json';
            exit(json_encode(['status' => 'success', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->success,
                'download' => ['filename' => $filename, 'content' => $content]], JSON_UNESCAPED_UNICODE));
        }
        if ($section['kind'] === 'module' && zm_pb_lm_variable($section, $files[$name]['file']) === '')
            throw new RuntimeException('This catalog cannot be saved automatically.');
        $upload = $_FILES['translations_file'] ?? null;
        if (!is_array($upload) || ($upload['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK ||
            !isset($upload['tmp_name'], $upload['size']) || !is_string($upload['tmp_name']) ||
            !is_int($upload['size']) || $upload['size'] > 8 * 1024 * 1024 ||
            !is_uploaded_file($upload['tmp_name']))
            throw new InvalidArgumentException('Translation file is missing or too large (maximum 8 MiB).');
        $content = file_get_contents($upload['tmp_name']);
        if ($content === false) throw new RuntimeException('Cannot read the translation file.');
        $data = json_decode($content, true);
        if (!is_array($data)) throw new InvalidArgumentException('Invalid translation JSON file.');
        $result = zm_pb_lm_import_translations($section, $id, $name, $reference, $data);
        $text = $GLOBALS['ZM_PB_ADMINLANG']->langs_manager;
        $message = '';
        if ($result['skipped']) {
            $lines = [$text->import_skipped];
            foreach ($result['skipped'] as $entry) {
                $reason = $entry['reason'] === 'duplicate' ? $text->import_duplicate : $text->import_unknown;
                $lines[] = $entry['key'] . ' — ' . $reason;
            }
            $message = implode("\n", $lines);
        }
        exit(json_encode(['status' => 'success', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->success,
            'count' => $result['updated'], 'message' => $message], JSON_UNESCAPED_UNICODE));
    } elseif ($method_action === 'rename_translation' || $method_action === 'delete_translation') {
        $keyPath = $_POST['key_path'] ?? null;
        if (!is_string($keyPath)) throw new InvalidArgumentException('Invalid translation key.');
        $path = zm_pb_lm_path($keyPath);
        $newKey = $method_action === 'rename_translation' ? ($_POST['new_key'] ?? null) : null;
        if ($method_action === 'rename_translation' && !is_string($newKey))
            throw new InvalidArgumentException('Invalid translation key.');
        zm_pb_lm_change_custom($section, $name, $path, $newKey);
    } elseif ($method_action === 'save_translation' || $method_action === 'add_translation') {
        $files = zm_pb_lm_files($section);
        if (!isset($files[$name])) throw new InvalidArgumentException('Language not found.');
        $value = $_POST['value'] ?? null;
        if (!is_string($value)) throw new InvalidArgumentException('Invalid translation.');
        $catalog = zm_pb_lm_catalog($section, $name);
        $reference = zm_pb_lm_name($section, ZM_PB_DEFLANG);
        if (!isset($files[$reference])) $reference = isset($files['english']) ? 'english' : $name;
        $shape = zm_pb_lm_merge(zm_pb_lm_copy(zm_pb_lm_catalog($section, $reference)), $catalog);
        if ($method_action === 'save_translation') {
            if (!isset($_POST['key_path']) || !is_string($_POST['key_path']))
                throw new InvalidArgumentException('Invalid translation key.');
            $path = zm_pb_lm_path($_POST['key_path']);
            if (zm_pb_lm_at($shape, $path) === null) throw new InvalidArgumentException('Translation key not found.');
        } else {
            $parent = $_POST['parent_path'] ?? '';
            if (!is_string($parent)) throw new InvalidArgumentException('Invalid parent key.');
            $path = $parent === '' ? [] : zm_pb_lm_path($parent);
            $container = zm_pb_lm_at($shape, $path);
            $key = $_POST['new_key'] ?? '';
            if ((!is_array($container) && !is_object($container)) || !is_string($key) ||
                $key === '' || strlen($key) > 200 || preg_match('//u', $key) !== 1 ||
                preg_match('/[\x00-\x1F]/', $key))
                throw new InvalidArgumentException('Invalid translation key.');
            if ((is_array($container) && array_key_exists($key, $container)) ||
                (is_object($container) && property_exists($container, $key)))
                throw new InvalidArgumentException('Translation key already exists.');
            $path[] = ['type' => is_object($container) ? 'object' : 'array', 'key' => $key];
        }
        zm_pb_lm_save($section, $name, $path, $value, $method_action === 'add_translation');
    } elseif ($method_action === 'add_language') {
        zm_pb_lm_add($section, $name);
    } elseif ($method_action === 'disable_language' || $method_action === 'enable_language') {
        zm_pb_lm_toggle($section, $name, $method_action === 'enable_language');
    } else {
        throw new InvalidArgumentException($GLOBALS['ZM_PB_ADMINLANG']->other->unknown_action);
    }
    exit(json_encode(['status' => 'success', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->success]));
} catch (Throwable $error) {
    exit(json_encode(['status' => 'error', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->error,
        'message' => $error->getMessage()]));
}
