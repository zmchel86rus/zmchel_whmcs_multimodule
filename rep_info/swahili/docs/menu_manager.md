# Menyu

Unda menyu, ongeza kurasa au viungo maalumu, kisha panga vipengele kwa kuviburuta. Chagua kipengele kikuu kwa menyu ndogo, weka majina kwa kila lugha, uonekano kwa wageni au wateja na vifaa. Teua eneo; kila eneo linaweza kuwa na menyu moja tu. Kwa viungo vya ndani, chagua kama URL ifuate lugha ya sasa. Kagua menyu ya umma kwenye kompyuta na simu.

Kwa kila kipengee unaweza kuweka kichwa, maelezo, madarasa ya CSS, `rel`, ikoni na kufungua kwenye kichupo kipya; kurasa zilizochapishwa zinaweza kuongezwa kiotomatiki. Chagua kando kwa kompyuta na simu ikiwa menyu inaongeza au inachukua nafasi ya urambazaji wa WHMCS. Kiungo cha ukurasa wa moduli huhesabiwa upya kwa slug, lugha na hali ya URL ya sasa; lebo tupu hutumia kichwa kilichotafsiriwa au jina la ukurasa. Kutembelea ukurasa hakubadilishi lugha ya wasifu wa mteja. Seva hukataa miundo ya URL isiyo salama na HTML kwenye lebo.

## WHMCS

Washa nafasi za menyu za WHMCS zinazohitajika katika mipangilio ya moduli. Kila nafasi inaweza kuwa na menyu moja, lakini menyu hiyo hiyo inaweza kutumiwa katika nafasi kadhaa. Mwonekano wa kompyuta unaanza kwenye upana wa 768 px; skrini nyembamba hutumia mwonekano wa simu. Nafasi iliyozimwa haibadilishi menyu ya kawaida ya WHMCS.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Kwenye njia za mfumo wa WHMCS bila uelekezaji wa lugha wa moduli, lebo za menyu hutumia lugha iliyohifadhiwa ya mteja; kurasa za moduli hutumia lugha ya URL. Lugha chaguo-msingi ikipewa njia yake, nayo hupata kiambishi. URL ya kawaida ni `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Kiungo maalumu kinaweza kubaki bila ujanibishaji, kwa mfano `clientarea.php`. Kuficha kipengee mzazi huficha tawi lake lote.

URL ya kipengee cha ukurasa huhesabiwa upya kwa kutumia slug ya sasa na tafsiri iliyochapishwa. Tafsiri ikikosekana, toleo lililochapishwa la lugha chaguo-msingi hutumiwa. Kiungo maalumu kinaweza kuhifadhi URL iliyowekwa; anwani za nje, mailto, tel na nanga haziongezewi kiambishi cha lugha. Rasimu, kurasa zilizofutwa na zile zisizoruhusiwa hazionyeshwi.

## zm_pb_menus

Data huhifadhiwa katika majedwali `zm_pb_menus`, `zm_pb_menu_items` na `zm_pb_menu_locations`. Unda au rekebisha majedwali katika sehemu ya Hifadhidata ya Moduli. Muundo wa menyu una viwango visivyozidi 10 na vipengee 300; ukifuta mzazi, watoto wake hupanda kiwango kimoja.

## Maelekezo

- Unda menyu
- Ongeza kurasa, machapisho au viungo maalum.
- Buruta vipengee ili kubadilisha mpangilio. Weka viwango vya ndani kwa kutumia kiteuzi cha mzazi au vitufe vya kuhamisha.
- Tumia lugha ya ukurasa wa sasa
- Tumia URL iliyoingizwa bila kuibadilisha
- Majina katika lugha nyingine
- Inaonekana kwa
- Vifaa
- Kila eneo linaweza kuwa na menyu moja. Ukichagua eneo, ugawaji wake utaondolewa kwenye menyu nyingine na kuhamishwa hapa.
- Vipengee vya kiwango cha juu huwa safu wima, na vipengee vya ndani huwa viungo. Tumia URL # kwa kichwa kisicho na kiungo.
- Majedwali ya menyu bado hayajaundwa. Yaongeze katika Hifadhidata ya Moduli.
