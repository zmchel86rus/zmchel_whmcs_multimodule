<?php
/** Check Smarty block validation with the PHP handling APIs used by Smarty 3 and 4. */
$version = $argv[1] ?? '';
if ($version === '3') {
    class Smarty
    {
        const SMARTY_VERSION = '3.1.48';
        const PHP_REMOVE = 2;
        const FILTER_VARIABLE = 'variable';
        const PLUGIN_FUNCTION = 'function';
        public static $security;
        public $escape_html;
        public function enableSecurity($security) { self::$security = $security; }
        public function registerFilter($type, $callback) {}
        public function registerPlugin($type, $name, $callback) {}
        public function setPluginsDir($dirs) {}
        public function setTemplateDir($dirs) {}
        public function setConfigDir($dirs) {}
        public function createTemplate($code) { return new SmartyTestTemplate(); }
    }
} elseif ($version === '4') {
    class Smarty
    {
        const SMARTY_VERSION = '4.3.4';
        const FILTER_VARIABLE = 'variable';
        const PLUGIN_FUNCTION = 'function';
        public static $security;
        public $escape_html;
        public function enableSecurity($security) { self::$security = $security; }
        public function registerFilter($type, $callback) {}
        public function registerPlugin($type, $name, $callback) {}
        public function setPluginsDir($dirs) {}
        public function setTemplateDir($dirs) {}
        public function setConfigDir($dirs) {}
        public function createTemplate($code) { return new SmartyTestTemplate(); }
    }
} else {
    throw new InvalidArgumentException('Choose Smarty version 3 or 4');
}

class Smarty_Security
{
    public $php_handling = null;
    public $php_functions;
    public $php_modifiers;
    public $allowed_tags;
    public $allowed_modifiers;
    public $static_classes;
    public $trusted_static_methods;
    public $trusted_static_properties;
    public $streams;
    public $allow_constants;
    public $allow_super_globals;
    public $disabled_special_smarty_vars;
    public function __construct($smarty) {}
}
class SmartyTestTemplate
{
    public function compileTemplateSource() {}
}

define('ZM_PB_VER', 'test');
define('SMARTY_PLUGINS_DIR', __DIR__);
require dirname(__DIR__) . '/lib/smarty_blocks.php';

ZM_PB_SmartyBlocks::validate('{$label}');
if (($version === '3' ? Smarty::PHP_REMOVE : null) !== Smarty::$security->php_handling) {
    throw new RuntimeException('PHP handling mode does not match the Smarty version');
}
try {
    ZM_PB_SmartyBlocks::validate('{php}echo "unsafe";{/php}');
    throw new RuntimeException('PHP tag was accepted');
} catch (InvalidArgumentException $error) {
    // The module's own PHP tag check applies even when Smarty has no PHP handling mode.
}

echo "PASS Smarty {$version} block validation and PHP tag rejection\n";
