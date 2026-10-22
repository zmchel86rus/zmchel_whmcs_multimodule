# Maelekezo ya zmchel WHMCS Multimodule

**Kabla ya kutumia moduli, tengeneza thamani za salt za kipekee na uziweke katika `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` na `ZM_PB_NONCE_SALT`.** Moduli ilitengenezwa na kupimwa kwenye **WHMCS 8.13.1–8.13.7**. Uoanifu wa **PHP 7.4–8.5** umekaguliwa. Apache inaungwa mkono kikamilifu; Nginx inaweza kuhitaji usanidi wa ziada kwa uelekezaji wa lugha kwenye ukurasa wa mwanzo. **Moduli ni ya bure.**

## Kuunda kurasa

Fungua **Addons → zmchel WHMCS Multimodule** katika eneo la usimamizi la WHMCS. Kabla ya kubadilisha URL, uelekezaji upya au sheria za seva, hamisha mipangilio ya moduli. Kwenye orodha ya kurasa, ongeza ukurasa wenye jina la ndani na *slug* kama `kuhusu-sisi`, bila kikoa au `.php`. Chagua ufikiaji wa wote, wa walioingia kwenye akaunti au mchanganyiko; kisha chagua hali ya rasimu au iliyochapishwa, aina ya ukurasa na lugha. Lugha chaguomsingi ya WHMCS lazima iwe ndani ya `supported_langs.php`.

Baada ya kuhifadhi, fungua ukurasa na ujaze maudhui, taarifa za meta na mipangilio ya ramani ya tovuti kwa kila lugha. Kila sehemu ina kitufe chake cha kuhifadhi. Kagua ujumbe wa matokeo na ukurasa wa umma. Kufuta kwanza huhamisha ukurasa kwenye pipa; kufuta kabisa hufanyika kutoka huko.

## Kihariri na lugha

Chagua lugha katika kichupo cha maudhui, buruta vizuizi vya GrapesJS kwenye eneo la kazi, kisha hariri maandishi, picha na mipangilio. Kuna sehemu, safu wima, majedwali, FAQ, fomu ya mawasiliano, orodha, ugawaji wa kurasa na maeneo ya wageni au wanachama. Unaweza kunakili muundo kwa lugha nyingine kisha kutafsiri maandishi kabla ya kuchapisha. Vizuizi vya viungo na vitufe vinaweza kuongeza lugha ya sasa kwenye URL za ndani; zima chaguo hilo kwa viungo vya nje, faili, `mailto:` na njia za WHMCS zisizo na tafsiri.

URL rafiki na uelekezaji wa lugha vikiwashwa, lugha kuu hutumia njia fupi kama `/sw/`, au bila kiambishi ikiwa njia ya lugha chaguomsingi imezimwa. Tofauti za kikanda hutumia locale ya BCP 47. Jaribu viungo katika lugha kadhaa.

## SEO, picha na matengenezo

Kwa kila lugha, jaza kichwa, maelezo, robots, URL kanoniki na taarifa za mitandao ya kijamii. Ukurasa uliochapishwa ambao si wa mfumo unaweza kuingia kwenye ramani ya tovuti ya XML. Pakia picha kupitia Media Manager, ongeza maandishi mbadala na kagua ubora baada ya uboreshaji. Katika Menu Manager, panga kurasa na viungo maalumu, weka majina ya kila lugha, eneo na mwonekano.

Redirect Manager huweka uelekezaji upya wa kudumu wa `301` au wa muda wa `302`. Rewrite Manager huandika sheria za `.htaccess` kwa Apache; Nginx inahitaji sheria zinazolingana kwenye seva. Hamisha JSON kabla ya uingizaji mkubwa wa data. Maelezo zaidi kwa Kiingereza: [menyu](../english/docs/menus.md), [ugawaji wa kurasa](../english/docs/pagination.md), [uelekezaji upya](../english/docs/redirects.md), [ramani ya tovuti](../english/docs/sitemaps.md), [Smarty](../english/docs/smarty.md), [data yenye muundo](../english/docs/structured-data.md), [uhamishaji wa data](../english/docs/transfer.md).
