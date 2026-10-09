<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Language catalogs for the current response; never changes the WHMCS session. */
class ZM_PB_LanguageCatalog
{
    private static $core = [];
    private static $auction = [];

    private static function supported($language)
    {
        return is_string($language) && defined('ZM_PB_LANGS') && isset(ZM_PB_LANGS[$language]);
    }

    public static function core($language)
    {
        if (!self::supported($language)) return null;
        if (array_key_exists($language, self::$core)) return self::$core[$language];
        $file = ROOTDIR . '/lang/' . $language . '.php';
        if (!is_file($file)) return self::$core[$language] = null;
        $override = ROOTDIR . '/lang/overrides/' . $language . '.php';
        $_LANG = [];
        require $file;
        if (is_file($override)) require $override;
        return self::$core[$language] = is_array($_LANG) ? $_LANG : null;
    }

    public static function auction($language)
    {
        if (!self::supported($language) || !defined('AUCTION_LANGDIR')) return null;
        if (array_key_exists($language, self::$auction)) return self::$auction[$language];
        $directory = rtrim(AUCTION_LANGDIR, '/\\') . '/';
        $file = $directory . $language . '.php';
        if (!is_file($file)) $file = $directory . 'english.php';
        if (!is_file($file)) return self::$auction[$language] = null;
        $_ADDONLANG = [];
        require $file;
        return self::$auction[$language] = is_array($_ADDONLANG) ? $_ADDONLANG : null;
    }
}
