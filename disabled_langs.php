<?php
$langs = [
    'russian'=> ['code'=>'RU','name'=>'Русский','locale'=>'ru_RU','locale_BCP47'=>'ru-RU','code_ISO639_1'=>'ru'],
    'english'=> ['code'=>'EN','name'=>'English','locale'=>'en_US','locale_BCP47'=>'en-US','code_ISO639_1'=>'en'],
    'german'=> ['code'=>'DE','name'=>'Deutsch','locale'=>'de_DE','locale_BCP47'=>'de-DE','code_ISO639_1'=>'de'],
    'ukranian'=> ['code'=>'UA','name'=>'Українська','locale'=>'uk_UA','locale_BCP47'=>'uk-UA','code_ISO639_1'=>'uk'],
    'spanish'=> ['code'=>'ES','name'=>'Español','locale'=>'es_ES','locale_BCP47'=>'es-ES','code_ISO639_1'=>'es'],

    'french' => ['code'=>'FR','name'=>'Français','locale'=>'fr_FR','locale_BCP47'=>'fr-FR','code_ISO639_1'=>'fr'],
    'portuguese-pt' => ['code'=>'PT','name'=>'Português (Portugal)','locale'=>'pt_PT','locale_BCP47'=>'pt-PT','code_ISO639_1'=>'pt'],
    'portuguese-br' => ['code'=>'BR','name'=>'Português (Brasil)','locale'=>'pt_BR','locale_BCP47'=>'pt-BR','code_ISO639_1'=>'pt'],
    'italian' => ['code'=>'IT','name'=>'Italiano','locale'=>'it_IT','locale_BCP47'=>'it-IT','code_ISO639_1'=>'it'],
    'croatian' => ['code'=>'HR','name'=>'Hrvatski','locale'=>'hr_HR','locale_BCP47'=>'hr-HR','code_ISO639_1'=>'hr'],
    'czech' => ['code'=>'CZ','name'=>'Čeština','locale'=>'cs_CZ','locale_BCP47'=>'cs-CZ','code_ISO639_1'=>'cs'],
    'estonian' => ['code'=>'EE','name'=>'Eesti','locale'=>'et_EE','locale_BCP47'=>'et-EE','code_ISO639_1'=>'et'],
    'norwegian' => ['code'=>'NO','name'=>'Norsk (bokmål)','locale'=>'nb_NO','locale_BCP47'=>'nb-NO','code_ISO639_1'=>'nb'],
    'swedish' => ['code'=>'SE','name'=>'Svenska','locale'=>'sv_SE','locale_BCP47'=>'sv-SE','code_ISO639_1'=>'sv'],
    'turkish' => ['code'=>'TR','name'=>'Türkçe','locale'=>'tr_TR','locale_BCP47'=>'tr-TR','code_ISO639_1'=>'tr'],
    'hungarian' => ['code'=>'HU','name'=>'Magyar','locale'=>'hu_HU','locale_BCP47'=>'hu-HU','code_ISO639_1'=>'hu'],

    'dutch' => ['code'=>'NL','name'=>'Nederlands','locale'=>'nl_NL','locale_BCP47'=>'nl-NL','code_ISO639_1'=>'nl'],
    'danish' => ['code'=>'DK','name'=>'Dansk','locale'=>'da_DK','locale_BCP47'=>'da-DK','code_ISO639_1'=>'da'],
    'macedonian' => ['code'=>'MK','name'=>'Македонски','locale'=>'mk_MK','locale_BCP47'=>'mk-MK','code_ISO639_1'=>'mk'],
    'romanian' => ['code'=>'RO','name'=>'Română','locale'=>'ro_RO','locale_BCP47'=>'ro-RO','code_ISO639_1'=>'ro'],
    'catalan' => ['code'=>'ES','name'=>'Català','locale'=>'ca_ES','locale_BCP47'=>'ca-ES','code_ISO639_1'=>'ca'],

    // Not yet supported by WHMCS itself ( пока что :) )
    'finnish' => ['code'=>'FI','name'=>'Suomi','locale'=>'fi_FI','locale_BCP47'=>'fi-FI','code_ISO639_1'=>'fi'],
    'polish' => ['code'=>'PL','name'=>'Polski','locale'=>'pl_PL','locale_BCP47'=>'pl-PL','code_ISO639_1'=>'pl'],
    'bulgarian' => ['code'=>'BG','name'=>'Български','locale'=>'bg_BG','locale_BCP47'=>'bg-BG','code_ISO639_1'=>'bg'],
    'serbian' => ['code'=>'RS','name'=>'Српски','locale'=>'sr_RS','locale_BCP47'=>'sr-Cyrl-RS','code_ISO639_1'=>'sr'],
    'lithuanian' => ['code'=>'LT','name'=>'Lietuvių','locale'=>'lt_LT','locale_BCP47'=>'lt-LT','code_ISO639_1'=>'lt'],
    'latvian' => ['code'=>'LV','name'=>'Latviešu','locale'=>'lv_LV','locale_BCP47'=>'lv-LV','code_ISO639_1'=>'lv'],
    'slovenian' => ['code'=>'SI','name'=>'Slovenščina','locale'=>'sl_SI','locale_BCP47'=>'sl-SI','code_ISO639_1'=>'sl'],
    'slovak' => ['code'=>'SK','name'=>'Slovenčina','locale'=>'sk_SK','locale_BCP47'=>'sk-SK','code_ISO639_1'=>'sk'],

    'indonesian' => ['code'=>'ID','name'=>'Bahasa Indonesia','locale'=>'id_ID','locale_BCP47'=>'id-ID','code_ISO639_1'=>'id'],
    'swahili' => ['code'=>'TZ','name'=>'Kiswahili','locale'=>'sw_TZ','locale_BCP47'=>'sw-TZ','code_ISO639_1'=>'sw'],
    'vietnamese' => ['code'=>'VN','name'=>'Tiếng Việt','locale'=>'vi_VN','locale_BCP47'=>'vi-VN','code_ISO639_1'=>'vi'],
    'malay' => ['code'=>'MY','name'=>'Bahasa Melayu','locale'=>'ms_MY','locale_BCP47'=>'ms-MY','code_ISO639_1'=>'ms'],
    'uzbek' => ['code'=>'UZ','name'=>'O‘zbekcha','locale'=>'uz_UZ','locale_BCP47'=>'uz-UZ','code_ISO639_1'=>'uz'],
    'azerbaijani' => ['code'=>'AZ','name'=>'Azərbaycanca','locale'=>'az_AZ','locale_BCP47'=>'az-AZ','code_ISO639_1'=>'az'],
    'kazakh' => ['code'=>'KZ','name'=>'Қазақша','locale'=>'kk_KZ','locale_BCP47'=>'kk-KZ','code_ISO639_1'=>'kk'],
    'icelandic' => ['code'=>'IS','name'=>'Íslenska','locale'=>'is_IS','locale_BCP47'=>'is-IS','code_ISO639_1'=>'is'],
    'belarusian' => ['code'=>'BY','name'=>'Беларуская','locale'=>'be_BY','locale_BCP47'=>'be-BY','code_ISO639_1'=>'be'],
    'albanian' => ['code'=>'AL','name'=>'Shqip','locale'=>'sq_AL','locale_BCP47'=>'sq-AL','code_ISO639_1'=>'sq'],
    'irish' => ['code'=>'IE','name'=>'Gaeilge','locale'=>'ga_IE','locale_BCP47'=>'ga-IE','code_ISO639_1'=>'ga'],
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
