# Ugawaji wa kurasa

Bofya kitalu cha orodha. Esc hughairi. Weka ugawaji wa kurasa nje ya kitalu lengwa.

Kwa Smarty, weka kigezo cha orodha kamili. Bila kigezo, vipengee vya HTML vilivyo ndani ya kontena hugawanywa katika kurasa; unaweza kubainisha darasa la safu au tagi ya tr. Viungo huhifadhi count, sort na vichujio. Orodha nyingi zinazojitegemea zinaweza kutumika.

Kiteuzi cha vipengee kwa kila ukurasa: 10, 25, 50, 100, 250

Buruta kiteuzi cha idadi ya vipengee kwa kila ukurasa ndani ya ugawaji wa kurasa au kwenye vitalu vingine vya ukurasa. Kitaendelea kuunganishwa na ugawaji huu wa kurasa.

Chagua kitalu cha orodha ya Smarty. Utafutaji na ugawaji wa kurasa lazima viwe na kitalu kilekile lengwa.

Weka kigezo cha orodha kamili. Utafutaji hulinganisha sehemu yoyote iliyochaguliwa; vichujio hutumika pamoja. Masharti hutumika kabla ya kuhesabu kurasa; kutumia au kuweka upya hurudisha kwenye ukurasa wa kwanza. Muunganisho uliopo wa ugawaji wa kurasa hutoa kigezo hicho.

## Viungo na chanzo cha orodha

Weka ugawaji wa kurasa nje ya bloku ya orodha na uchague bloku hiyo kama lengo. Kwa orodha ya Smarty, taja kigeu chenye vipengele vyote; vinginevyo vipengele vya HTML vya kontena hugawanywa. Chagua umbo la viungo kwa mpangilio wa moduli, `/page/2/` au `?page=2`. Umbo la njia linahitaji sheria za rewrite. Orodha huru hutumia parameta tofauti; viungo huhifadhi lugha, vichujio na mpangilio.

## Ukubwa wa ukurasa, SEO na vichujio

Weka idadi ya vipengele na ikihitajika washa chaguo la 10/25/50/100/250. Kubadili ukubwa hurudisha orodha kwenye ukurasa wa kwanza. Noindex hutumika kuanzia ukurasa wa pili pekee; kagua kichwa na URL kanoniki. Unganisha vichujio na orodha hiyo hiyo, kisha jaribu ukurasa wa pili na matokeo yaliyochujwa kwenye tovuti ya umma.

## page / count / pager

Kwa orodha ya Smarty, taja kigeu chenye vipengee vyote na uache mzunguko wa `{foreach}`: moduli hugawa orodha, hivyo usiongeze `array_slice` ya pili. Bila kigeu, vipengee vya HTML kwenye kontena hugawanywa; unaweza kuchagua darasa la mstari au lebo ya `tr`, huku `thead` na `tfoot` zikiendelea kubaki. Weka idadi ya vitufe karibu na ukurasa wa sasa tofauti kwa kompyuta na simu. Kwa njia za moja kwa moja za PHP tumia `?page=2`; `/page/2/` huhitaji sheria za rewrite. Kurasa zinazofuata zina canonical yake na zinaweza kupewa `noindex`.

Kama kuna orodha kadhaa zinazojitegemea, ya kwanza hutumia `page`, `count` na `sort`; nyingine hutumia vigezo vyenye ID ya bloku. Katika njia `/page/N/`, `pager` huonyesha orodha ambayo nambari inaihusu. Ndani ya bloku ya Smarty, `$zm_pagination` hutoa `total`, `page`, `pages`, `count` na `offset`. `count` huzuiliwa kati ya 10–250. Orodha ikiwa tupu au ina ukurasa mmoja, paneli ya kurasa hufichwa.

## YYYY-MM-DD

Vichujio hufanya kazi kwenye orodha ileile inayogawanywa kwa kurasa. Utafutaji wa maandishi unaweza kukagua sehemu kadhaa zilizotenganishwa kwa koma; kipindi cha tarehe hutumia `YYYY-MM-DD` na hujumuisha siku nzima ya mwisho.

## Flex / Grid

Chagua Flex au Grid na urekebishe upana na safu kwa kila kifaa. Kutumia au kuondoa kichujio hurudisha orodha ukurasa wa kwanza. Kiteuzi cha idadi ya matokeo kinaweza kuhamishwa bila kupoteza uhusiano; paneli rudufu hudhibiti orodha ileile.

## Maelekezo

- Usiweke kwenye faharasa ukurasa wa 2 na unaofuata
- Muundo wa viungo
- Idadi chaguomsingi ya vipengee kwa ukurasa
