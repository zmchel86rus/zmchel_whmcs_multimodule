<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

        header('Cache-Control: no-store, private');
        require_once ZM_PB_LIBDIR . 'transfer.php';
        $text = zm_pb_transfer_text();
        try {
            $sections = zm_pb_transfer_sections($_POST['transfer_sections'] ?? []);
            if ($method_action === 'export_module') {
                $warnings = [];
                $archive = ZM_PB_Transfer::exportArchive($sections, $warnings);
                try {
                    if ($warnings) {
                        $messages = [];
                        foreach ($warnings as $warning) {
                            $key = ['missing' => 'missing_asset_file', 'unavailable' => 'unreadable_asset_file',
                                'too_large' => 'large_asset_file'][$warning['reason']] ?? 'unreadable_asset_file';
                            $messages[] = zm_pb_transfer_error($key, $warning['file']);
                        }
                        $visible = [];
                        foreach ($messages as $message) {
                            $candidate = array_merge($visible, [$message]);
                            if (strlen(base64_encode(json_encode($candidate, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE))) > 3500) break;
                            $visible = $candidate;
                        }
                        header('X-ZM-PB-Export-Warning-Count: ' . count($messages));
                        header('X-ZM-PB-Export-Warnings: ' . base64_encode(json_encode($visible, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE)));
                    }
                    header('Content-Type: application/zip');
                    header('Content-Disposition: attachment; filename="zmchel-whmcs-multimodule-' . gmdate('Ymd-His') . '.zip"');
                    header('Content-Length: ' . filesize($archive));
                    readfile($archive);
                } finally { unlink($archive); }
                exit;
            }
            $file = $_FILES['transfer_file'] ?? null;
            if (!is_array($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK
                || !is_uploaded_file($file['tmp_name']) || ($file['size'] ?? 0) > ZM_PB_Transfer::MAX_ARCHIVE_BYTES) {
                throw new RuntimeException(zm_pb_transfer_error('upload_failed'));
            }
            $warnings = [];
            $counts = ZM_PB_Transfer::importFile($file['tmp_name'], $sections, $warnings);
            $labels = array_map(function ($key) use ($text) { return $text->sections[$key]; }, array_keys($counts));
            exit(json_encode(['status' => 'success', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->success,
                'message' => $text->imported . implode('; ', $labels), 'warnings' => $warnings]));
        } catch (Throwable $error) {
            exit(json_encode(['status' => 'error', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->error, 'message' => $error->getMessage()]));
        }
