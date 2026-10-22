<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

function zm_pb_lm_filename_aliases(): array
{
    return ['ukranian' => 'ukrainian', 'portugues' => 'portuguese-pt',
        'portugues-br' => 'portuguese-br'];
}

function zm_pb_lm_supported_key(string $name): string
{
    $aliases = zm_pb_lm_filename_aliases();
    $canonical = $aliases[$name] ?? $name;
    if (isset(ZM_PB_LANGS[$canonical])) return $canonical;
    if (isset(ZM_PB_LANGS[$name])) return $name;
    $legacy = array_search($canonical, $aliases, true);
    return $legacy !== false && isset(ZM_PB_LANGS[$legacy]) ? $legacy : $canonical;
}
