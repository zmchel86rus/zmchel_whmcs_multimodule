<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

        header('Cache-Control: no-store, private');
        require_once ZM_PB_LIBDIR . 'transfer.php';
        $text = zm_pb_transfer_text();
        try {
            $sections = zm_pb_transfer_sections($_POST['transfer_sections'] ?? []);
            if ($method_action === 'export_module') {
                $json = ZM_PB_Transfer::export($sections);
                exit(json_encode(['status' => 'success', 'title' => ZM_PB_ADMINLANG->other->success, 'message' => $text->exported,
                    'download' => ['filename' => 'zmchel-whmcs-multimodule-' . gmdate('Ymd-His') . '.json', 'content' => $json]], JSON_THROW_ON_ERROR));
            }
            $file = $_FILES['transfer_file'] ?? null;
            if (!is_array($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK
                || !is_uploaded_file($file['tmp_name']) || ($file['size'] ?? 0) > ZM_PB_Transfer::MAX_BYTES) {
                throw new RuntimeException(zm_pb_transfer_error('upload_failed'));
            }
            $counts = ZM_PB_Transfer::import(file_get_contents($file['tmp_name']), $sections);
            $labels = array_map(function ($key) use ($text) { return $text->sections[$key]; }, array_keys($counts));
            exit(json_encode(['status' => 'success', 'title' => ZM_PB_ADMINLANG->other->success, 'message' => $text->imported . implode('; ', $labels)]));
        } catch (Throwable $error) {
            exit(json_encode(['status' => 'error', 'title' => ZM_PB_ADMINLANG->other->error, 'message' => $error->getMessage()]));
        }
