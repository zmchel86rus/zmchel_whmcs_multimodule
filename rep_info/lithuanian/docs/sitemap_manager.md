# Svetainės schemos

Įjunkite svetainės schemą ir sugeneruokite XML failus. Patikrinkite paskelbtas kalbines versijas sitemap_index.xml; jei atnaujinimų nėra, tikrinkite WHMCS cron ir rašymo teises.

## XML

XML pateikia abipuses nuorodas aktyvioms kalboms ir `x-default` numatytosios kalbos adresui. Peradresavimų šaltiniai nepatenka į `loc` ar kalbų alternatyvas; atsarginis vertimas pažymimas tikrąja turinio kalba. Puslapių ir įrašų failai deklaruoja XHTML vardų sritį.

`AfterCronJob` kablys lygina intervalą `ZM_PB_SITEMAP_UPDFREQ` su paskutinio sėkmingo generavimo laiku `ZM_PB_SITEMAP_LASTUPD`; išjungus svetainės žemėlapį, rankinis generavimas taip pat neprieinamas. Kalbų versijos parenkamos pagal `lang_active`, o ne `lang_status`. Papildomos dalys gauna priesagas `_2`, `_3` ir t. t. Jei generavimas nepavyksta, ankstesni failai atkuriami, o sėkmės laikas nesikeičia. Patikrinkite rašymo teises šaknyje, `resources/` ir `inc/editable_consts.php`; lenteles atskirai taisykite modulio duomenų bazėje.

Automatinis generavimas priklauso nuo WHMCS cron ir nustatyto intervalo; mygtukas jį pradeda iškart. Įtraukiami tik paskelbti, svečiams prieinami puslapiai ir įrašai su aktyviais vertimais. Jei puslapis pakeičia sistemos puslapį, naudojamas viešasis sistemos puslapio URL, o ne pakeičiančio puslapio slug. Failai, viršijantys 50 000 URL arba 50 MB, dalijami į dalis. Indeksas išsaugo kitus galiojančius svetainės žemėlapius.

Modulis svetainės šaknyje įrašo `sitemap_index.xml`, `sitemap_pages.xml` ir `sitemap_posts.xml`; tuščiai kategorijai failas nekuriamas. Bendras `sitemap.xml` negeneruojamas. Pakeitę puslapius ar kalbas, žemėlapius sukurkite iš naujo ir atverkite indeksą naršyklėje. Įvykus klaidai patikrinkite rašymo teises šakniniame kataloge; paskutinio sėkmingo generavimo laikas nesikeičia.

## Instrukcijos

- Automatinis generavimas vykdomas po WHMCS cron, kai ateina laikas atnaujinti. Rankinis generavimas pradedamas iš karto.
- Įtraukiami aktyvūs, svečiams pasiekiami puslapiai ir įrašai, įskaitant paskelbtas jų versijas kitomis kalbomis. Perrašymams naudojami vieši pakeičiamų puslapių URL.
- Generuoti svetainės schemas
- Failai svetainės šakniniame kataloge
- Paskutinis sėkmingas generavimas
- Kitas atnaujinimas ne anksčiau kaip
- Jei nieko nepasirinkta, svetainės schema atnaujinama kasdien.
- Įjungus /html-sitemap rodo svetainės schemą kaip įprastą HTML puslapį; sitemap.xml nesikeičia.
- **Atnaujinimo dažnumas** — Jei laukas tuščias, numatytoji reikšmė – 'monthly'.
- **Atnaujinimo prioritetas** — Jei laukas tuščias, numatytoji reikšmė – '0.5'.
