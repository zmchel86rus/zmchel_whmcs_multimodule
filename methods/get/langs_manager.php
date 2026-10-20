<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
$smarty->assign('lm_access_denied', false);
$smarty->assign('lm_text', $GLOBALS['ZM_PB_ADMINLANG']->langs_manager);

if (!zm_pb_check_super_admin()) {
    $smarty->assign('lm_access_denied', true);
    $smarty->assign('alertType', 'danger');
    $smarty->assign('alertMessage', $GLOBALS['ZM_PB_ADMINLANG']->module->alerts->access_denied);
    $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
    return;
}

try {
    zm_pb_lm_restore_added_languages();
    $sections = zm_pb_lm_sections();
    $selectedId = isset($_GET['section']) && is_string($_GET['section']) && isset($sections[$_GET['section']])
        ? $_GET['section'] : 'whmcs_client';
    $section = $sections[$selectedId];
    $sectionRows = [];
    foreach ($sections as $id => $item) {
        $files = is_dir($item['directory']) ? zm_pb_lm_files($item) : [];
        $missing = 0;
        foreach (array_keys(ZM_PB_LANGS) as $supported) {
            if (!isset($files[zm_pb_lm_name($item, $supported)])) $missing++;
        }
        $disabled = 0;
        foreach ($files as $file) if ($file['state'] === 'disabled') $disabled++;
        $sectionRows[] = ['id' => $id, 'title' => $item['title'], 'total' => count($files),
            'disabled' => $disabled, 'missing' => $missing,
            'url' => 'addonmodules.php?' . http_build_query(['module' => ZM_PB_NAME, 'subpage' => 'langs_manager',
                'section' => $id], '', '&', PHP_QUERY_RFC3986)];
    }
    $files = is_dir($section['directory']) ? zm_pb_lm_files($section) : [];
    $language = isset($_GET['language']) && is_string($_GET['language']) && isset($files[$_GET['language']])
        ? $_GET['language'] : (array_key_first($files) ?? '');
    $baseUrl = 'addonmodules.php?' . http_build_query(['module' => ZM_PB_NAME, 'subpage' => 'langs_manager',
        'section' => $selectedId], '', '&', PHP_QUERY_RFC3986);
    $languageLabels = (array) ($GLOBALS['ZM_PB_ADMINLANG']->module->supported_langs->translate ?? []);
    $languageRows = [];
    foreach ($files as $name => $file) {
        $supported = zm_pb_lm_supported_name($section, $name);
        $languageRows[] = ['name' => $name, 'title' => $supported
            ? ($languageLabels[$supported] ?? ZM_PB_LANGS[$supported]['name']) : $name,
            'state' => $file['state'], 'url' => $baseUrl . '&language=' . rawurlencode($name)];
    }
    $missingLanguages = [];
    foreach (ZM_PB_LANGS as $key => $info) {
        $name = zm_pb_lm_name($section, $key);
        if (!isset($files[$name])) $missingLanguages[] = ['name' => $name,
            'title' => $languageLabels[$key] ?? $info['name']];
    }
    $search = isset($_GET['q']) && is_string($_GET['q']) ? trim($_GET['q']) : '';
    if (strlen($search) > 200) $search = '';
    $view = isset($_GET['view']) && is_string($_GET['view']) &&
        in_array($_GET['view'], ['all', 'original', 'added'], true) ? $_GET['view'] : 'all';
    $editUrl = $baseUrl . ($language !== '' ? '&language=' . rawurlencode($language) : '');
    $smarty->assign('lm_sections', $sectionRows);
    $smarty->assign('lm_languages', $languageRows);
    $smarty->assign('lm_missing', $missingLanguages);
    $smarty->assign('lm_section', $selectedId);
    $smarty->assign('lm_language', $language);
    $smarty->assign('lm_base_url', $baseUrl);
    $smarty->assign('lm_edit_url', $editUrl);
    $viewUrl = $editUrl . ($view !== 'all' ? '&view=' . $view : '');
    $smarty->assign('lm_current_url', $viewUrl . ($search !== '' ? '&q=' . rawurlencode($search) : ''));
    $smarty->assign('lm_reset_url', $viewUrl);
    $smarty->assign('lm_search', $search);
    $smarty->assign('lm_view', $view);
    $smarty->assign('lm_current_title', $section['title']);
    if ($language !== '') {
        $reference = zm_pb_lm_name($section, ZM_PB_DEFLANG);
        if (!isset($files[$reference])) $reference = isset($files['english']) ? 'english' : $language;
        $target = zm_pb_lm_catalog($section, $language);
        $source = zm_pb_lm_source_catalog($section, $language, $reference);
        $shape = zm_pb_lm_merge(zm_pb_lm_copy($source), $target);
        $targetRows = zm_pb_lm_flatten($target);
        $sourceRows = zm_pb_lm_flatten($source);
        $overrideDir = $section['directory'] . '/overrides' . ($section['kind'] === 'self' ? '/managed' : '');
        $managed = zm_pb_lm_managed_entries($overrideDir . '/' . $language . '.php');
        $all = $sourceRows + $targetRows;
        foreach ($all as $id => &$row) {
            $row['value'] = $targetRows[$id]['value'] ?? '';
            $row['source'] = $sourceRows[$id]['value'] ?? '';
            $row['added'] = !isset($sourceRows[$id]) || !empty($managed[$id]['custom']);
            $row['managed_custom'] = !empty($managed[$id]['custom']);
            $row['key'] = (string) $row['path'][count($row['path']) - 1]['key'];
        }
        unset($row);
        $all = zm_pb_lm_filter_rows($all, $search, $view);
        uasort($all, static function ($a, $b) { return strcmp($a['label'], $b['label']); });
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 50;
        $pages = max(1, (int) ceil(count($all) / $perPage));
        $page = min($page, $pages);
        $smarty->assign('lm_rows', array_slice($all, ($page - 1) * $perPage, $perPage));
        $smarty->assign('lm_page', $page);
        $smarty->assign('lm_pages', $pages);
        $smarty->assign('lm_total', count($all));
        $smarty->assign('lm_reference', $reference);
        $smarty->assign('lm_parents', zm_pb_lm_containers($shape));
        $smarty->assign('lm_state', $files[$language]['state']);
        $smarty->assign('lm_readonly', $section['kind'] === 'module' &&
            zm_pb_lm_variable($section, $files[$language]['file']) === '');
    }
    $smarty->assign('page_assets', '<script src="' . ZM_PB_ASSETSURL . 'js/language-manager.js?v=' .
        filemtime(ZM_PB_ASSETSDIR . 'js/language-manager.js') . '"></script>');
} catch (Throwable $error) {
    $smarty->assign('lm_access_denied', true);
    $smarty->assign('alertType', 'danger');
    $smarty->assign('alertMessage', htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8'));
    $smarty->assign('alertHtml', $smarty->fetch(ZM_PB_TEMPLATESPARTSDIR . 'alert.tpl'));
}
