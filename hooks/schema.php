<?php
if (!defined('WHMCS')) die('Direct access not allowed');
if (PHP_SAPI === 'cli' || defined('ADMINAREA')
    || !in_array($_SERVER['REQUEST_METHOD'] ?? '', ['GET', 'HEAD'], true)) return;

require_once ZM_PB_LIBDIR . 'schema.php';
$request = zm_pb_parse_request();
if ((!ZM_PB_ENABLE_LANG_ROUTE && !empty($request['lang']))
    || !zm_pb_schema_homepage_request($request, $_GET)) return;

add_hook('ClientAreaHeadOutput', 1, function () {
    return zm_pb_schema_jsonld(zm_pb_schema_website());
});
