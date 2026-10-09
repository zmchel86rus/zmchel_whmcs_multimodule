<?php
/** Isolated menu translation test: no WHMCS bootstrap, database or session writes. */
define('ZM_PB_VER', 'test');
define('ZM_PB_INCDIR', dirname(__DIR__) . '/inc/');
define('ROOTDIR', dirname(__DIR__, 4));
define('ZM_PB_DEFLANG', 'english');
define('ZM_PB_MAINSYSTEM_DEFAULT_PAGES', ['index', 'contact', 'login', 'register']);
define('ZM_PB_ENABLE_LANG_ROUTE', !in_array('--disabled', $argv, true));
define('ZM_PB_LANGS', require dirname(__DIR__) . '/supported_langs.php');
define('AUCTION_LANGDIR', ROOTDIR . '/modules/addons/domain_auction/lang/');
if (in_array('--switch', $argv, true)) define('ZMPB_LANGUAGE_SWITCH_PENDING', true);
require ROOTDIR . '/vendor/autoload.php';
require dirname(__DIR__) . '/lib/navigation_language.php';
require dirname(__DIR__) . '/lib/menu.php';
function zm_pb_parse_request() { return $GLOBALS['testRequest']; }
function check($condition, $message) { if (!$condition) throw new RuntimeException($message); }

$_SESSION = ['Language' => 'english', 'uid' => 123];
$session = $_SESSION;
$GLOBALS['testRequest'] = ['lang' => 'ru', 'slug' => ''];
if (!ZM_PB_ENABLE_LANG_ROUTE || defined('ZMPB_LANGUAGE_SWITCH_PENDING')) {
    check(ZM_PB_NavigationLanguage::responseLanguage() === null, 'Disabled routing or pending language switch was ignored');
    echo "Navigation language guard OK\n";
    exit;
}
check(ZM_PB_NavigationLanguage::responseLanguage() === 'russian', 'URL language was not selected');
$GLOBALS['testRequest'] = ['lang' => '', 'slug' => 'contact'];
check(ZM_PB_NavigationLanguage::responseLanguage() === 'english', 'Unprefixed URL did not select default language');
$GLOBALS['testRequest']['slug'] = 'clientarea.php';
check(ZM_PB_NavigationLanguage::responseLanguage() === 'english', 'Native PHP URL ignored saved language');
$_SESSION['Language'] = 'russian';
define('USER_LANG', 'english'); // Simulate another addon's stale early constant.
foreach (['clientarea.php', 'clientarea', 'password/reset', 'account/security', 'cart.php', 'store/domains'] as $slug) {
    $GLOBALS['testRequest'] = ['lang' => '', 'slug' => $slug];
    check(ZM_PB_NavigationLanguage::responseLanguage() === 'russian', 'Native route lost Russian preference: ' . $slug);
    check(ZM_PB_Menu::language() === 'russian', 'Menu URLs/labels ignored preference: ' . $slug);
}
$GLOBALS['testRequest'] = ['lang' => 'en', 'slug' => 'clientarea.php'];
check(ZM_PB_NavigationLanguage::responseLanguage() === 'russian', 'Native language prefix overrode preference');
$GLOBALS['testRequest'] = ['lang' => '', 'slug' => 'index.php'];
$_GET['rp'] = '/password/reset';
check(ZM_PB_NavigationLanguage::responseLanguage() === 'russian', 'Native rp route lost preference');
unset($_GET['rp']);
foreach (['contact', 'login', 'custom-article'] as $slug) {
    $GLOBALS['testRequest'] = ['lang' => '', 'slug' => $slug];
    check(ZM_PB_NavigationLanguage::responseLanguage() === 'english', 'Public/default-language route changed');
}
check($_SESSION['Language'] === 'russian', 'Resolving response language changed session');
$_SESSION = $session;

$factory = new Knp\Menu\MenuFactory();
$menu = $factory->createItem('Secondary Navbar');
$account = $menu->addChild('Account', ['label' => 'Client Company']);
$english = ZM_PB_LanguageCatalog::core('english');
$russian = ZM_PB_LanguageCatalog::core('russian');
$account->addChild('Edit Account Details', ['label' => $english['clientareanavdetails'], 'uri' => 'clientarea.php?action=details']);
$account->addChild('Payment Methods', ['label' => $english['paymentMethods']['title']]);
$account->addChild('Security Settings', ['label' => $english['navAccountSecurity']]);
$account->addChild('Logout', ['label' => $english['clientareanavlogout']]);
$account->addChild('Custom Link', ['label' => 'Custom label']);
$account->addChild('User Profile', ['label' => 'My custom profile label']);
$account->addChild('Client Area Home', ['label' => ZM_PB_LanguageCatalog::auction('english')['my_account']]);
ZM_PB_NavigationLanguage::secondaryNavbar($menu, 'russian');
check($account->getChild('Edit Account Details')->getLabel() === $russian['clientareanavdetails'], 'Account details not translated');
check($account->getChild('Payment Methods')->getLabel() === $russian['paymentMethods']['title'], 'Nested translation key not translated');
check($account->getChild('Security Settings')->getLabel() === $russian['navAccountSecurity'], 'Security not translated');
check($account->getChild('Logout')->getLabel() === $russian['clientareanavlogout'], 'Logout not translated');
check($account->getChild('Client Area Home')->getLabel() === ZM_PB_LanguageCatalog::auction('russian')['my_account'], 'Auction account link not translated');
check($account->getLabel() === 'Client Company', 'Client name was replaced');
check($account->getChild('Custom Link')->getLabel() === 'Custom label', 'Custom item was replaced');
check($account->getChild('User Profile')->getLabel() === 'My custom profile label', 'Customized system label was replaced');
check($account->getChild('Edit Account Details')->getUri() === 'clientarea.php?action=details', 'Link target was replaced');
ZM_PB_NavigationLanguage::secondaryNavbar($menu, 'russian');
check($account->getChild('Logout')->getLabel() === $russian['clientareanavlogout'], 'Repeated translation changed the label');
check($_SESSION === $session, 'Session preference was changed');

unset($_SESSION['uid']);
$guestMenu = $factory->createItem('Secondary Navbar');
$guestAccount = $guestMenu->addChild('Account', ['label' => $english['account']]);
$guestAccount->addChild('Login', ['label' => $english['login']]);
$guestAccount->addChild('Register', ['label' => $english['register']]);
ZM_PB_NavigationLanguage::secondaryNavbar($guestMenu, 'russian');
check($guestAccount->getLabel() === $russian['account'], 'Guest account not translated');
check($guestAccount->getChild('Login')->getLabel() === $russian['login'], 'Guest login not translated');
check($guestAccount->getChild('Register')->getLabel() === $russian['register'], 'Guest registration not translated');
ZM_PB_NavigationLanguage::secondaryNavbar($factory->createItem('Empty navbar'), 'russian');
echo "Navigation account labels OK\n";
