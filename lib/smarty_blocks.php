<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');
require_once __DIR__ . '/smarty_variables.php';
require_once __DIR__ . '/language_catalog.php';

/** Isolated, data-only Smarty context. No WHMCS plugins or live application objects. */
class ZM_PB_SmartyBlocks
{
    private static $pending = [];
    private static $resolved = [];
    private static $started = false;
    private static $variables = [];

    private static function engine()
    {
        $smarty = new Smarty();
        $security = new Smarty_Security($smarty);
        $security->php_handling = Smarty::PHP_REMOVE;
        $security->php_functions = ['isset', 'empty', 'count', 'in_array', 'is_array', 'array_key_exists'];
        $security->php_modifiers = ['count', 'nl2br', 'array_key_exists', 'round'];
        $security->allowed_tags = ['if', 'ifclose', 'else', 'elseif', 'foreach', 'foreachclose', 'foreachelse', 'section', 'sectionclose', 'sectionelse', 'assign', 'capture', 'captureclose', 'literal', 'literalclose', 'strip', 'stripclose', 'break', 'continue', 'lang'];
        $security->allowed_modifiers = ['escape', 'default', 'count', 'nl2br', 'upper', 'lower', 'capitalize', 'truncate', 'replace', 'regex_replace', 'cat', 'date_format', 'string_format', 'round'];
        $security->static_classes = ['none'];
        $security->trusted_static_methods = null;
        $security->trusted_static_properties = null;
        $security->streams = null;
        $security->allow_constants = false;
        $security->allow_super_globals = false;
        $security->disabled_special_smarty_vars = ['template_object', 'current_dir', 'config', 'template', 'version', 'ldelim', 'rdelim'];
        $smarty->enableSecurity($security);
        $smarty->escape_html = false;
        $smarty->registerFilter(Smarty::FILTER_VARIABLE, [self::class, 'escapeOutput']);
        $smarty->registerPlugin(Smarty::PLUGIN_FUNCTION, 'lang', [self::class, 'translate']);
        $smarty->setPluginsDir([SMARTY_PLUGINS_DIR]);
        $smarty->setTemplateDir([]);
        $smarty->setConfigDir([]);
        return $smarty;
    }

    public static function escapeOutput($value)
    {
        return is_scalar($value) || $value === null
            ? htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', false) : '';
    }

    /** Read translations assigned to this block's page language. */
    public static function translate($params, $template)
    {
        $key = $params['key'] ?? null;
        if (!is_string($key) || !preg_match('/^[A-Za-z0-9_.-]{1,160}$/D', $key)) return '';
        $catalog = $template->getTemplateVars('LANG');
        if (!is_array($catalog)) $catalog = $GLOBALS['_LANG'] ?? [];
        if (!is_array($catalog)) return '';
        if (array_key_exists($key, $catalog)) {
            $value = $catalog[$key];
        } else {
            $value = $catalog;
            foreach (explode('.', $key) as $segment) {
                if (!is_array($value) || !array_key_exists($segment, $value)) return '';
                $value = $value[$segment];
            }
        }
        return is_scalar($value) ? self::escapeOutput($value) : '';
    }

    private static function template($code)
    {
        if (!is_string($code) || strlen($code) > 100000) throw new InvalidArgumentException(function_exists('zm_pb_content_error') ? zm_pb_content_error('smarty_too_large') : 'smarty_too_large');
        // Defense in addition to Smarty security: object access and nofilter cannot be enabled by authors.
        $checked = preg_replace('/\{\*.*?\*\}|\{literal\}.*?\{\/literal\}/si', '', $code);
        if (preg_match('/<\?(?:php|=)|\{\/?(?:php|call|private_\w*)\b|\{[^{}]*(?:->|::|\bnofilter\b|\bscope\s*=)[^{}]*\}/i', $checked)) {
            throw new InvalidArgumentException(function_exists('zm_pb_content_error') ? zm_pb_content_error('smarty_forbidden') : 'smarty_forbidden');
        }
        return self::engine()->createTemplate('eval:' . $code);
    }

    public static function validate($code)
    {
        try { self::template($code)->compileTemplateSource(); }
        catch (Throwable $error) {
            if ($error instanceof InvalidArgumentException) throw $error;
            $message = function_exists('zm_pb_content_error') ? zm_pb_content_error('smarty_invalid', $error->getMessage()) : $error->getMessage();
            throw new InvalidArgumentException($message, 0, $error);
        }
    }

    public static function validateHtml($html)
    {
        $doc = new DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="UTF-8"?><html><body>' . $html . '</body></html>');
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        $xpath = new DOMXPath($doc);
        foreach ($xpath->query('//*[@data-zm-pb-smarty]') as $node) self::validate($node->getAttribute('data-zm-pb-smarty'));
    }

    public static function render($code, array $variables, $language = null)
    {
        $template = self::template($code);
        // Smarty global variables are shared across instances; shadow them before fetch merges them.
        foreach (Smarty::$global_tpl_vars as $name => $unused) $template->assign($name, null);
        foreach ($variables as $name => $value) {
            if ($name === 'smarty') continue;
            // Runtime lists must remain complete. Catalog sampling limits must
            // not truncate page content or consume other variables' allowance.
            $template->assign($name, ZM_PB_SmartyVariables::snapshot($value, $name));
        }
        if (is_string($language) && defined('ZM_PB_LANGS') && isset(ZM_PB_LANGS[$language])) {
            $catalog = ZM_PB_LanguageCatalog::core($language);
            if ($catalog !== null) $template->assign('LANG', $catalog);
            if (array_key_exists('Lang', $variables)) {
                $addonCatalog = ZM_PB_LanguageCatalog::auction($language);
                if ($addonCatalog !== null) $template->assign('Lang', $addonCatalog);
            }
        }
        // Template warnings must not become response output or contaminate the page HTML.
        set_error_handler(function ($severity, $message, $file, $line) {
            if (!(error_reporting() & $severity)) return false;
            throw new ErrorException($message, 0, $severity, $file, $line);
        });
        try { return $template->fetch(); }
        finally { restore_error_handler(); }
    }

    private static function attachOutputFilter()
    {
        $native = $GLOBALS['smarty'] ?? null;
        if ($native instanceof Smarty) $native->registerFilter(Smarty::FILTER_OUTPUT, [self::class, 'filterOutput']);
    }

    private static function renderPending(array $block, array $variables)
    {
        $pagination = $block['pagination'];
        if ($block['navigation']) return ZM_PB_Pagination::render($pagination, $variables,
            is_string($block['navigation']) ? $block['navigation'] : 'all');
        if ($pagination !== null) $variables = ZM_PB_Pagination::variables($pagination, $variables);
        $html = self::render($block['code'], $variables, $block['lang']);
        if ($pagination !== null && ZM_PB_Pagination::config($pagination)['variable'] === '') {
            $html = ZM_PB_Pagination::paginateHtml($pagination, $html);
        }
        return $html;
    }

    private static function orderedPending()
    {
        $blocks = self::$pending;
        // Render lists first: their final context supplies totals for navigation.
        uasort($blocks, function ($a, $b) { return (int) (bool) $a['navigation'] <=> (int) (bool) $b['navigation']; });
        return $blocks;
    }

    public static function queue($code, $language = null, $pagination = null, $navigation = false)
    {
        if (!self::$started) {
            self::$started = true;
            // WHMCS may initialize or replace its Smarty engine after the content is built.
            add_hook('ClientAreaPage', 10000, function ($vars) {
                self::attachOutputFilter();
                return class_exists('ZM_PB_Pagination', false) && is_array($vars['breadcrumb'] ?? null)
                    ? ['breadcrumb' => ZM_PB_Pagination::breadcrumbs($vars['breadcrumb'])] : [];
            });
            add_hook('ClientAreaHeadOutput', 10000, function () { self::attachOutputFilter(); return ''; });
            add_hook('ClientAreaFooterOutput', 10000, function ($vars) {
                self::attachOutputFilter();
                $native = $GLOBALS['smarty'] ?? null;
                $variables = $native instanceof Smarty ? $native->getTemplateVars() : [];
                self::$variables = array_replace(is_array($vars) ? $vars : [], $variables);
                foreach (self::orderedPending() as $token => $block) {
                    try { self::$resolved[$token] = self::renderPending($block, self::$variables); }
                    catch (Throwable $error) {
                        self::$resolved[$token] = '';
                        error_log('zmchel WHMCS Multimodule Smarty block: ' . $error->getMessage());
                    }
                }
                return '';
            });
        }
        self::attachOutputFilter();
        $token = '<!--ZM_PB_SMARTY_' . bin2hex(random_bytes(16)) . '-->';
        self::$pending[$token] = ['code' => $code, 'lang' => $language, 'pagination' => $pagination, 'navigation' => $navigation];
        return $token;
    }

    public static function filterOutput($html, Smarty_Internal_Template $template)
    {
        if (strpos($html, '<!--ZM_PB_SMARTY_') === false) return class_exists('ZM_PB_Pagination', false) ? ZM_PB_Pagination::seo($html) : $html;
        $replacements = [];
        $variables = array_replace(self::$variables, $template->getTemplateVars());
        foreach (self::orderedPending() as $token => $block) {
            if (strpos($html, $token) === false) continue;
            if (array_key_exists($token, self::$resolved)) {
                $replacements[$token] = self::$resolved[$token];
                continue;
            }
            // Separate template fetches can finish before footer hooks; use their completed context.
            try { $replacements[$token] = self::renderPending($block, $variables); }
            catch (Throwable $error) {
                $replacements[$token] = '';
                error_log('zmchel WHMCS Multimodule Smarty block: ' . $error->getMessage());
            }
        }
        $html = strtr($html, $replacements);
        return class_exists('ZM_PB_Pagination', false) ? ZM_PB_Pagination::seo($html) : $html;
    }
}
