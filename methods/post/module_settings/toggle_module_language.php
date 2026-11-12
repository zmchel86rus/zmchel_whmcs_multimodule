<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

try {
    $languages = $_POST['languages'] ?? (isset($_POST['language']) ? [$_POST['language']] : null);
    $operation = $_POST['language_operation'] ?? null;
    if (!is_array($languages) || !is_string($operation) || !in_array($operation, ['enable', 'disable'], true))
        throw new InvalidArgumentException($GLOBALS['ZM_PB_ADMINLANG']->other->invalid_input);
    require_once ZM_PB_INCDIR . 'module_languages.php';
    zm_pb_module_languages_toggle_many(ZM_PB_ROOTDIR, $languages, $operation === 'enable', ZM_PB_DEFLANG);
    exit(json_encode(['status' => 'success', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->success]));
} catch (Throwable $error) {
    exit(json_encode(['status' => 'error', 'title' => $GLOBALS['ZM_PB_ADMINLANG']->other->error,
        'message' => $error->getMessage()]));
}
