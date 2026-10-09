<?php
if (!defined("WHMCS")) die('Direct access not allowed');

add_hook('AdminAreaFooterOutput', 10, function($vars) {
    $output = '';
    $is_module_name = isset($_GET['module']) && $_GET['module'] === ZM_PB_NAME;
    $module_subpage = $is_module_name && isset($_GET['subpage']) ? $_GET['subpage'] : '';
    if ( $vars['filename'] == 'addonmodules' && in_array($module_subpage,ZM_PB_SUBPAGES) ) {
        $output .= '
        <script src="' . ZM_PB_ASSETSURL . 'js/main.js?v=' . filemtime(ZM_PB_ASSETSDIR . 'js/main.js') . '"></script>
        <link rel="stylesheet" href="' . ZM_PB_ASSETSURL . 'css/main.css?v=' . filemtime(ZM_PB_ASSETSDIR . 'css/main.css') . '">
        <link rel="stylesheet" href="' . ZM_PB_ASSETSURL . 'css/countries.css">
        <style>
            .country-flags{
                background-image: url('.ZM_PB_ASSETSURL.'img/flags.png);
            }
            @media only screen and (-webkit-min-device-pixel-ratio: 2),only screen and (min--moz-device-pixel-ratio:2),only screen and (-o-min-device-pixel-ratio:2 / 1),only screen and (min-device-pixel-ratio:2),only screen and (min-resolution:192dpi),only screen and (min-resolution:2dppx) {
                .country-flags {
                    background-image:url('.ZM_PB_ASSETSURL.'img/flagsX2.png)
                }
            }
        </style>
        ';
        if ($module_subpage === 'pages_manager') {
            $script = 'js/page-overrides.js';
            $output .= '<script src="' . ZM_PB_ASSETSURL . $script . '?v=' . filemtime(ZM_PB_ASSETSDIR . $script) . '"></script>';
        }
        if ($module_subpage === 'rewrite_manager') {
            $script = 'js/rewrite-manager.js';
            $output .= '<script src="' . ZM_PB_ASSETSURL . $script . '?v=' . filemtime(ZM_PB_ASSETSDIR . $script) . '"></script>';
        }
    }
    return $output;
});

if (ZM_PB_COLLECT_VARS) {
    require_once ZM_PB_LIBDIR . 'smarty_variables.php';
    foreach (['ClientAreaPage' => 9999, 'ClientAreaHeadOutput' => 9999, 'ClientAreaFooterOutput' => 9999] as $stage => $priority) {
        add_hook($stage, $priority, function ($vars) use ($stage, $priority) {
            try {
                $native = $GLOBALS['smarty'] ?? null;
                $variables = $native instanceof Smarty ? $native->getTemplateVars() : [];
                ZM_PB_SmartyVariables::collect(array_replace(is_array($vars) ? $vars : [], $variables), $stage . ':' . $priority);
            } catch (Throwable $error) {
                error_log('zmchel WHMCS Multimodule variable collector: ' . $error->getMessage());
            }
            return;
        });
    }
}
