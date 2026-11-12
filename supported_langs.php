<?php 
$langs = [
];

// Keep the primary language on its ISO route; use the locale for regional variants.
$codeCounts = array_count_values(array_column($langs, 'code_ISO639_1'));
foreach ($langs as &$info) {
    $code = $info['code_ISO639_1'];
    $isVariant = $codeCounts[$code] > 1 && strcasecmp($info['code'], $code) !== 0;
    $info['route_code'] = $info['route_code'] ?? ($isVariant ? $info['locale_BCP47'] : $code);
}
unset($info);

return $langs;
