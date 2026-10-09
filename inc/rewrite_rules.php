<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

// These rules are installed in the site .htaccess by Rewrite Manager.
// Keep language= in the internal request. External redirects for language changes
// run in ClientAreaPage, after WHMCS has saved the explicit language selection.
$rules = [];
if (!ZM_PB_ENABLE_LANG_ROUTE) return $rules;
$defaultCode = ZM_PB_LANGS[ZM_PB_DEFLANG]['code_lower'] ?? '';
if (preg_match('/^[a-z]{2,3}$/D', $defaultCode)) {
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    $rules[] = [
        'language' => ZM_PB_LANGS[ZM_PB_DEFLANG]['name'],
        'paths' => ['/' . $defaultCode . '/... → /...'],
        'directives' => [
            'RewriteCond %{REQUEST_METHOD} ^(?:GET|HEAD)$',
            'RewriteCond %{QUERY_STRING} !(^|&)language= [NC]',
            'RewriteRule ^' . $defaultCode . '(?:/(.*))?$ ' . $base . '/$1 [NC,R=301,L]',
        ],
    ];
}
if ((ZM_PB_LANGS['ukranian']['code_lower'] ?? '') === 'uk') {
    $base = rtrim(parse_url(ZM_PB_FULLHOST, PHP_URL_PATH) ?: '', '/');
    $rules[] = [
        'language' => ZM_PB_LANGS['ukranian']['name'],
        'paths' => ['/ua/... → /uk/...'],
        'directives' => [
            'RewriteCond %{REQUEST_METHOD} ^(?:GET|HEAD)$',
            'RewriteCond %{QUERY_STRING} !(^|&)language= [NC]',
            'RewriteRule ^ua(?:/(.*))?$ ' . $base . '/uk/$1 [NC,R=301,L]',
        ],
    ];
}
foreach (ZM_PB_LANGS as $language => $info) {
    $code = $info['code_lower'] ?? '';
    if (!preg_match('/^[a-z]{2,3}$/', $code) || !preg_match('/^[a-z]+$/', $language)) continue;
    $rules[] = [
        'language' => $info['name'],
        'paths' => ['/' . $code . '/', '/' . $code . '/...'],
        'directives' => [
            'RewriteRule ^' . $code . '/?$ index.php?rp=/ [QSA,L]',
            'RewriteRule ^' . $code . '/(.+)$ index.php?rp=/$1 [QSA,L]',
        ],
    ];
}

return $rules;
