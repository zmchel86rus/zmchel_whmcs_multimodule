<?php
if (!defined("WHMCS")) die('Direct access not allowed');
require_once "module_init.php"; 

if ( ZM_PB_MAINTENANCEMOD && PHP_SAPI !== 'cli' && !defined('ADMINAREA')) require_once ZM_PB_HOOKSDIR . 'maintenance.php';

require_once ZM_PB_HOOKSDIR."admin.php";
require_once ZM_PB_HOOKSDIR."client.php";
require_once ZM_PB_HOOKSDIR."schema.php";
require_once ZM_PB_HOOKSDIR."redirects.php";
require_once ZM_PB_HOOKSDIR."navigation_language.php";
require_once ZM_PB_HOOKSDIR."menu.php";
require_once ZM_PB_HOOKSDIR."sitemap.php";
require_once ZM_PB_HOOKSDIR."router.php";
