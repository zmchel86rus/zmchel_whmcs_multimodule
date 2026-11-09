<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
require_once __DIR__ . '/../inc/language_aliases.php';

/** Language catalogs for the current response; never changes the WHMCS session. */
class ZM_PB_LanguageCatalog
{
    private static $core = [];

    private static function supported($language)
    {
        return is_string($language) && defined('ZM_PB_LANGS') && isset(ZM_PB_LANGS[$language]);
    }

    public static function core($language)
    {
        $language = zm_pb_lm_supported_key((string) $language);
        if (!self::supported($language)) return null;
        if (array_key_exists($language, self::$core)) return self::$core[$language];
        $name = $language;
        foreach (zm_pb_lm_language_keys($language) as $candidate) {
            if (is_file(ROOTDIR . '/lang/' . $candidate . '.php')) { $name = $candidate; break; }
        }
        $file = ROOTDIR . '/lang/' . $name . '.php';
        if (!is_file($file)) return self::$core[$language] = null;
        $override = ROOTDIR . '/lang/overrides/' . $name . '.php';
        $_LANG = [];
        require $file;
        if (is_file($override)) require $override;
        return self::$core[$language] = is_array($_LANG) ? $_LANG : null;
    }

}
