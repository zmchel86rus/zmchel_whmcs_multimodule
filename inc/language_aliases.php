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

/** Include the saved spelling so existing page translations remain readable. */
function zm_pb_lm_language_keys(string $name): array
{
    $supported = zm_pb_lm_supported_key($name);
    $aliases = zm_pb_lm_filename_aliases();
    $canonical = $aliases[$supported] ?? $supported;
    $keys = [$supported, $canonical];
    foreach ($aliases as $old => $new) if ($new === $canonical) $keys[] = $old;
    return array_values(array_unique($keys));
}

function zm_pb_lm_normalize_languages($value): array
{
    $result = [];
    foreach (is_array($value) ? $value : [] as $name) {
        if (!is_string($name)) continue;
        $supported = zm_pb_lm_supported_key($name);
        if (isset(ZM_PB_LANGS[$supported])) $result[$supported] = $supported;
    }
    return array_values($result);
}
