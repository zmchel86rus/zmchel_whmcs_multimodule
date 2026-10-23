# Vefkort

Sjálfvirk myndun fer fram eftir WHMCS-cron þegar komið er að uppfærslu. Handvirk myndun hefst samstundis.

Virkar síður og færslur sem gestir geta skoðað eru teknar með, þar á meðal birtar tungumálaútgáfur þeirra. Yfirskrifanir nota opinberar vefslóðir þeirra síðna sem þær koma í staðinn fyrir.

Þegar þetta er virkt sýnir /html-sitemap vefkortið sem venjulega HTML-síðu; sitemap.xml helst óbreytt.

## XML

XML inniheldur gagnkvæma tengla fyrir virk tungumál og `x-default` fyrir heimilisfang sjálfgefins tungumáls. Upprunaslóðir áframsendinga fara hvorki í `loc` né tungumálavalkosti; varaþýðing er merkt raunverulegu tungumáli efnisins. Síðu- og færsluskrár skilgreina XHTML-nafnasvæðið.

`AfterCronJob`-hookið ber bilið `ZM_PB_SITEMAP_UPDFREQ` saman við tíma síðustu heppnuðu gerðar `ZM_PB_SITEMAP_LASTUPD`; ef vefkortið er óvirkt er handvirk gerð líka óheimil. Tungumálaútgáfur ráðast af `lang_active`, ekki `lang_status`. Viðbótarhlutar fá endingarnar `_2`, `_3` og svo framvegis. Ef gerð mistekst eru eldri skrár endurheimtar og tími síðasta árangurs breytist ekki. Athugaðu skrifréttindi í rótinni, `resources/` og `inc/editable_consts.php`; töflur eru lagfærðar sérstaklega í gagnagrunni einingarinnar.

Sjálfvirk gerð fer eftir cron-verkefni WHMCS og völdu bili; hnappurinn ræsir hana strax. Aðeins birtar síður og færslur sem gestir mega sjá, ásamt virkum þýðingum þeirra, eru teknar með. Ef síða kemur í stað kerfissíðu er opinbert URL kerfissíðunnar notað en ekki slug staðgengilsins. Skrám með yfir 50.000 URL-slóðum eða 50 MB er skipt niður. Vísirinn varðveitir önnur gild vefkort.

Einingin skrifar `sitemap_index.xml`, `sitemap_pages.xml` og `sitemap_posts.xml` í rót vefsins; engin skrá verður til fyrir tóman flokk. Sameinuð `sitemap.xml` skrá er ekki búin til. Endurbúðu til vefkort eftir breytingar á síðum eða tungumálum og opnaðu vísinn í vafra. Ef villa kemur upp skaltu athuga skrifheimild í rótinni; tími síðustu vel heppnuðu keyrslu breytist ekki.

## Leiðbeiningar

- Búa til vefkort
- Skrár í rót vefsins
- Síðasta árangursríka myndun
- Næsta uppfærsla í fyrsta lagi
- Ef ekkert er valið er vefkortið uppfært daglega.
- **Tíðni uppfærslna** — Ef reiturinn er auður er sjálfgefið gildi 'monthly'.
- **Forgangur uppfærslu** — Ef reiturinn er auður er sjálfgefið gildi '0.5'.
