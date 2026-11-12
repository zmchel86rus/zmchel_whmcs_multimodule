<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

function zm_pb_lm_filename_aliases(): array
{
    return ['ukranian' => 'ukrainian', 'portugues' => 'portuguese-pt',
        'portuguese' => 'portuguese-pt', 'portugues-br' => 'portuguese-br'];
}

/** Resolve older filenames in every language catalog. */
function zm_pb_lm_filename_aliases_for_section(array $section): array
{
    return zm_pb_lm_filename_aliases();
}

function zm_pb_lm_supported_aliases(): array
{
    return zm_pb_lm_filename_aliases();
}

function zm_pb_lm_supported_key(string $name): string
{
    $aliases = zm_pb_lm_supported_aliases();
    $canonical = $aliases[$name] ?? $name;
    if (isset(ZM_PB_LANGS[$canonical])) return $canonical;
    if (isset(ZM_PB_LANGS[$name])) return $name;
    foreach ($aliases as $legacy => $target)
        if ($target === $canonical && isset(ZM_PB_LANGS[$legacy])) return $legacy;
    return $canonical;
}

/** Include the saved spelling so existing page translations remain readable. */
function zm_pb_lm_language_keys(string $name): array
{
    $supported = zm_pb_lm_supported_key($name);
    $aliases = zm_pb_lm_supported_aliases();
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
