<?php
if (!defined("WHMCS")) die('Direct access not allowed');

if (php_sapi_name() !== 'cli' && !defined('ADMINAREA')) {
    require_once ZM_PB_INCDIR . 'breadcrumbs.php';
    add_hook('ClientAreaPage', 1001, 'zm_pb_client_breadcrumbs');
    require_once ZM_PB_INCDIR . 'language_switch.php';
    require_once ZM_PB_INCDIR . 'url_redirects.php';
    if (in_array($_SERVER['REQUEST_METHOD'] ?? '', ['GET', 'HEAD'], true)) {
        $slashTarget = zm_pb_slash_redirect_target(
            $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] ?? ($_SERVER['REQUEST_URI'] ?? '')
        );
        if ($slashTarget === null && isset($_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'])) {
            $slashTarget = zm_pb_slash_redirect_target($_SERVER['REQUEST_URI'] ?? '');
        }
        if ($slashTarget === null && preg_match('~^[A-Z]+\s+(\S+)\s+HTTP/\d(?:\.\d)?$~i',
            $_SERVER['THE_REQUEST'] ?? '', $originalRequest)) {
            $slashTarget = zm_pb_slash_redirect_target($originalRequest[1]);
        }
        if ($slashTarget !== null) {
            $slashTarget = zm_pb_default_language_redirect_target($slashTarget, $_GET) ?? $slashTarget;
            $slashTarget = zm_pb_index_redirect_target($slashTarget) ?? $slashTarget;
            $slashPath = explode('?', $slashTarget, 2)[0];
            if (preg_match('~(?:^|/)([a-z0-9-]+)\.php$~iD', $slashPath, $phpSlug)) {
                $candidate = strtolower($phpSlug[1]);
                $languageCodes = [''];
                if (ZM_PB_ENABLE_LANG_ROUTE) {
                    foreach (ZM_PB_LANGS as $languageInfo) $languageCodes[] = $languageInfo['code_lower'];
                }
                foreach ($languageCodes as $languageCode) {
                    $prettyTarget = zm_pb_php_slug_redirect_target($slashTarget, $candidate, $languageCode);
                    if ($prettyTarget === null) continue;
                    if (zm_pb_php_slug_redirect_eligible($candidate)) $slashTarget = $prettyTarget;
                    break;
                }
            }
            header('Location: ' . $slashTarget, true, 301);
            exit;
        }
    }
    $switchUri = $_SERVER['ZM_PB_ORIGINAL_REQUEST_URI'] ?? ($_SERVER['REQUEST_URI'] ?? '');
    $indexTarget = zm_pb_index_redirect_target($switchUri);
    $switchTarget = ($_SERVER['REQUEST_METHOD'] ?? '') === 'GET'
        ? zm_pb_language_switch_target($switchUri, $_GET) : null;
    $repairTarget = $switchTarget === null && ($_SERVER['REQUEST_METHOD'] ?? '') === 'GET'
        ? zm_pb_language_query_repair_target($switchUri) : null;
    $defaultLanguageTarget = in_array($_SERVER['REQUEST_METHOD'] ?? '', ['GET', 'HEAD'], true)
        ? zm_pb_default_language_redirect_target($switchUri, $_GET) : null;
    $uaAliasTarget = in_array($_SERVER['REQUEST_METHOD'] ?? '', ['GET', 'HEAD'], true)
        ? zm_pb_ua_alias_redirect_target($switchUri, $_GET) : null;
    $homeTarget = in_array($_SERVER['REQUEST_METHOD'] ?? '', ['GET', 'HEAD'], true)
        ? zm_pb_language_home_target($switchUri, $_GET) : null;
    if ($switchTarget !== null) {
        define('ZMPB_LANGUAGE_SWITCH_PENDING', true);
        // Hook loading is too early: let WHMCS handle language= first.
        add_hook('ClientAreaPage', 1000, function () use ($switchTarget) {
            header('Cache-Control: no-store, private');
            header('Location: ' . $switchTarget, true, 302);
            exit;
        });
    } elseif ($repairTarget !== null) {
        header('Cache-Control: no-store, private');
        header('Location: ' . $repairTarget, true, 302);
        exit;
    } elseif ($defaultLanguageTarget !== null) {
        header('Location: ' . $defaultLanguageTarget, true, 301);
        exit;
    } elseif ($uaAliasTarget !== null) {
        header('Location: ' . $uaAliasTarget, true, 301);
        exit;
    } elseif ($homeTarget !== null) {
        // A preference depends on the session: do not cache a permanent redirect.
        header('Cache-Control: no-store, private');
        header('Location: ' . $homeTarget, true, 302);
        exit;
    } elseif ($indexTarget !== null) {
        // Preserve POST and other methods when canonicalizing an explicit URL.
        $status = in_array($_SERVER['REQUEST_METHOD'] ?? '', ['GET', 'HEAD'], true) ? 301 : 308;
        header('Location: ' . $indexTarget, true, $status);
        exit;
    }
    unset($switchUri, $switchTarget, $repairTarget, $defaultLanguageTarget, $uaAliasTarget, $homeTarget, $indexTarget);
}
