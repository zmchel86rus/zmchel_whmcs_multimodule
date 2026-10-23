# Ramani ya tovuti

Utengenezaji wa kiotomatiki huendeshwa baada ya cron ya WHMCS wakati sasisho linapohitajika. Utengenezaji wa mikono huanza mara moja.

Kurasa na machapisho yanayotumika na kupatikana kwa wageni, pamoja na matoleo yao ya lugha yaliyochapishwa, hujumuishwa. Kurasa mbadala hutumia URL za umma za kurasa zinazobadilishwa nazo.

Ikiwa hakuna kilichochaguliwa, ramani ya tovuti husasishwa kila siku.

Ikiwashwa, /html-sitemap huonyesha ramani ya tovuti kama ukurasa wa kawaida wa HTML; sitemap.xml haiathiriwi.

## XML

XML ina viungo vya pande zote kwa lugha zinazotumika na `x-default` kwa anwani ya lugha chaguo-msingi. Vyanzo vya uelekezaji upya haviingii kwenye `loc` au mbadala za lugha; maudhui ya akiba huwekewa lugha yake halisi. Faili za kurasa na machapisho hutangaza nafasi ya majina ya XHTML.

Hook ya `AfterCronJob` hulinganisha muda wa `ZM_PB_SITEMAP_UPDFREQ` na muda wa uundaji wa mwisho uliofanikiwa `ZM_PB_SITEMAP_LASTUPD`; ramani ya tovuti ikizimwa, uundaji wa mkono pia haupatikani. Matoleo ya lugha huchaguliwa kwa `lang_active`, si `lang_status`. Sehemu za ziada hupata viambishi `_2`, `_3` na kuendelea. Uundaji ukishindwa, faili za zamani hurejeshwa na muda wa mafanikio haubadiliki. Angalia ruhusa ya kuandika kwenye mzizi, `resources/` na `inc/editable_consts.php`; rekebisha majedwali kando kwenye hifadhidata ya moduli.

Uundaji wa kiotomatiki hutegemea cron ya WHMCS na muda uliowekwa; kitufe huanza mara moja. Kurasa na machapisho yaliyotolewa na yanayoonekana kwa wageni pekee, pamoja na tafsiri zake zinazotumika, hujumuishwa. Ukurasa unapochukua nafasi ya ukurasa wa mfumo, URL ya umma ya ukurasa wa mfumo hutumika badala ya slug ya mbadala. Faili zinazozidi URL 50,000 au MB 50 hugawanywa. Faharasa huhifadhi ramani nyingine halali za tovuti.

Moduli huandika `sitemap_index.xml`, `sitemap_pages.xml` na `sitemap_posts.xml` katika mzizi wa tovuti; aina tupu haitengenezi faili. Haitengenezi `sitemap.xml` ya pamoja. Baada ya kubadili kurasa au lugha, zalisha ramani tena na ufungue faharasa kwenye kivinjari. Kukitokea kosa, angalia ruhusa ya kuandika kwenye mzizi wa tovuti; muda wa uzalishaji wa mwisho uliofanikiwa haubadiliki.

## Maelekezo

- Tengeneza ramani za tovuti
- Faili kwenye mzizi wa tovuti
- Utengenezaji wa mwisho uliofanikiwa
- Sasisho linalofuata si kabla ya
- **Mzunguko wa kusasisha** — Ikiwa imeachwa tupu, chaguo-msingi ni 'monthly'.
- **Kipaumbele cha kusasisha** — Ikiwa imeachwa tupu, chaguo-msingi ni '0.5'.
