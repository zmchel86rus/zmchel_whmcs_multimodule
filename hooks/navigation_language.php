<?php
if (!defined('WHMCS')) die('Direct access not allowed');
if (PHP_SAPI === 'cli' || defined('ADMINAREA') || !ZM_PB_ENABLE_LANG_ROUTE) return;

// Native pages without an override use the saved preference, even when they
// have no language prefix. Apply both early data and the final template context.
$nativeLanguage = function ($vars) {
    if (defined('ZMPB_LANGUAGE_SWITCH_PENDING') || isset($_GET['language'])) return [];
    require_once ZM_PB_LIBDIR . 'navigation_language.php';
    if (!zm_pb_route_uses_user_language(zm_pb_parse_request())) return [];
    $language = zm_pb_preferred_language();
    $catalog = ZM_PB_LanguageCatalog::core($language);
    if ($catalog === null) return [];
    $result = ['language' => $language, 'LANG' => $catalog];
    $GLOBALS['_LANG'] = $catalog;
    if (isset($vars['Lang']) && is_array($vars['Lang'])) {
        $auction = ZM_PB_LanguageCatalog::auction($language);
        if ($auction !== null) $result['Lang'] = $auction;
    }
    return $result;
};
add_hook('ClientAreaPage', 1, $nativeLanguage);
add_hook('ClientAreaPage', 9999, $nativeLanguage);
unset($nativeLanguage);

// Run after core/addon menu customization and before the managed menu is applied.
add_hook('ClientAreaSecondaryNavbar', 998, function ($secondaryNavbar) {
    if (!$secondaryNavbar) return;
    require_once ZM_PB_LIBDIR . 'navigation_language.php';
    $language = ZM_PB_NavigationLanguage::responseLanguage();
    if ($language !== null) ZM_PB_NavigationLanguage::secondaryNavbar($secondaryNavbar, $language);
});
