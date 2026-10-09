<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
require_once __DIR__ . '/language_catalog.php';
require_once dirname(__DIR__) . '/inc/route_guard.php';
require_once dirname(__DIR__) . '/inc/language_switch.php';

/** Translate existing account menu labels for this response. */
class ZM_PB_NavigationLanguage
{
    public static function responseLanguage()
    {
        if (!ZM_PB_ENABLE_LANG_ROUTE || defined('ZMPB_LANGUAGE_SWITCH_PENDING')) return null;
        $request = zm_pb_parse_request();
        if (zm_pb_route_uses_user_language($request)) return zm_pb_preferred_language();
        foreach (ZM_PB_LANGS as $language => $info) {
            if ($info['code_lower'] === ($request['lang'] ?? '')) return $language;
        }
        // Unprefixed pretty URLs use the default language. Native PHP URLs
        // without a language prefix continue to use WHMCS's own preference.
        if (!empty($request['lang']) || preg_match('~\.php(?:/|$)~i', $request['slug'] ?? '')) return null;
        return ZM_PB_DEFLANG;
    }

    private static function value(array $catalog, $key)
    {
        $value = $catalog;
        foreach (explode('.', $key) as $part) {
            if (!is_array($value) || !array_key_exists($part, $value)) return null;
            $value = $value[$part];
        }
        return is_string($value) ? $value : null;
    }

    private static function translate($item, array $keys, array $target, array $sources)
    {
        if (!$item) return;
        foreach ($keys as $key) {
            $label = self::value($target, $key);
            if ($label === null) continue;
            foreach ($sources as $source) {
                if (self::value($source, $key) === $item->getLabel()) {
                    $item->setLabel($label);
                    return;
                }
            }
        }
    }

    public static function secondaryNavbar($root, $language)
    {
        $target = ZM_PB_LanguageCatalog::core($language);
        if ($target === null) return;
        $account = null;
        foreach (['Account', 'My Account', 'account'] as $name) {
            $account = $root->getChild($name);
            if ($account) break;
        }
        if (!$account) return;
        $sourceLanguages = array_unique(['english', $language, strtolower((string) ($_SESSION['Language'] ?? ZM_PB_DEFLANG))]);
        $sources = [];
        foreach ($sourceLanguages as $sourceLanguage) {
            $catalog = ZM_PB_LanguageCatalog::core($sourceLanguage);
            if ($catalog !== null) $sources[] = $catalog;
        }
        // Logged-in clients can have their name/company in the parent label.
        if (empty($_SESSION['uid'])) self::translate($account, ['account', 'myaccount'], $target, $sources);
        $items = [
            'Edit Account Details' => ['clientareanavdetails'],
            'Account Details' => ['clientareanavdetails'],
            'User Management' => ['navUserManagement'],
            'Manage Users' => ['navUserManagement'],
            'Contacts/Sub-Accounts' => ['navContacts', 'clientareanavcontacts'],
            'Contacts' => ['navContacts', 'clientareanavcontacts'],
            'Payment Methods' => ['paymentMethods.title'],
            'Credit Card Details' => ['clientareanavccdetails'],
            'Change Password' => ['clientareanavchangepw'],
            'Security Settings' => ['navAccountSecurity', 'clientareanavsecurity'],
            'Account Security' => ['navAccountSecurity'],
            'Email History' => ['navemailssent'],
            'User Profile' => ['yourProfile', 'userProfile.profile'],
            'Your Profile' => ['yourProfile', 'userProfile.profile'],
            'Profile' => ['yourProfile', 'userProfile.profile'],
            'Switch Account' => ['navSwitchAccount'],
            'Login' => ['login'],
            'Register' => ['register', 'clientregistertitle'],
            'Forgot Password' => ['forgotpw'],
            'Forgot Password?' => ['forgotpw'],
            'Logout' => ['clientareanavlogout'],
        ];
        foreach ($items as $name => $keys) self::translate($account->getChild($name), $keys, $target, $sources);

        // The auction module adds this item using its own catalog.
        $home = $account->getChild('Client Area Home');
        if (!$home) return;
        $auction = ZM_PB_LanguageCatalog::auction($language);
        $auctionSources = [];
        foreach ($sourceLanguages as $sourceLanguage) {
            $catalog = ZM_PB_LanguageCatalog::auction($sourceLanguage);
            if ($catalog !== null) $auctionSources[] = $catalog;
        }
        if (isset($auction['my_account'])) {
            self::translate($home, ['my_account'], $auction, $auctionSources);
        } else {
            self::translate($home, ['myaccount', 'clientareanavhome'], $target, $sources);
        }
    }
}
