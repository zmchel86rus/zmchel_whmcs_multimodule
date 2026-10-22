# Nemokamas WHMCS daugiafunkcis modulis

**Prieš naudodami sugeneruokite unikalias druskas ir įrašykite ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT bei ZM_PB_NONCE_SALT į module_init.php.** Modulis sukurtas ir išbandytas su WHMCS 8.13.1–8.13.7. Apache palaikomas visiškai. Nginx taip pat gali veikti, tačiau kalbų maršrutizavimui pagrindiniame puslapyje gali reikėti papildomų nustatymų.

**Prieš pirmą naudojimą atverkite Modulio nustatymai → Palaikomos kalbos ir įjunkite reikalingas kalbas.**

**Patikrintos PHP versijos:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 ir 8.5.

**zmchel WHMCS Multimodule yra nemokamas.** WHMCS administravimo srityje galima tvarkyti puslapius ir straipsnius naudojant vaizdinę rengyklę, vertimus, meniu, medijos biblioteką, SEO laukus, XML svetainės schemas, peradresavimus ir URL perrašymo taisykles.

## Kalbų tvarkytuvė (kuriama)

WHMCS administravimo srityje atverkite Kalbų tvarkytuvę, pasirinkite skyrių (WHMCS klientų ar administratorių kalbas, šį ar kitą modulį) ir kalbą. Palyginkite originalą arba pavyzdinį tekstą su vertimu, pakeiskite vieną eilutę ir ją išsaugokite; esamus raktus galima eksportuoti ir importuoti kaip JSON. Naujos kalbos naudoja pavyzdinį tekstą, kol yra išverčiamos. Tvarkytuvė įjungia ir išjungia kalbų failus bei taiso senus pavadinimus; numatytąją kalbą pirmiausia pakeiskite WHMCS.

## Tolesnė plėtra

- Pridėti įdėtinius puslapius ir jų kategorijas.
- Suskaidyti dabartinį monolitą į bendradarbiaujančius komponentus.
- Sukurti modulio administravimo teisių tvarkyklę.
- Išplėsti numatytųjų kalbų sąrašą supported_langs.php.
- Pridėti kodo rengyklę modulio šablonams ir klientų temoms, išskyrus administravimo temą.
- Sukurti WHMCS ir kitų modulių kalbos failų tvarkyklę.
- Patobulinti medijos tvarkyklę.
- Sukurti išsamią ir veiksmingą SEO tvarkyklę, įkvėptą Yoast SEO.
- Pridėti daugiakalbes XML schemas ir HTML svetainės schemos puslapį.
- Pridėti naudojimo statistiką puslapių tvarkyklėje.
- Mažinti JS, CSS ir HTML kodą, talpinti ištisus puslapius podėlyje ir optimizuoti modulio bei WHMCS lenteles.
- Pridėti patikimą modulio naujinimo sistemą.

Tai planai, o ne griežtas darbų grafikas.

## Pasiūlyti idėją

Siųskite pasiūlymą el. paštu. [ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E)

## Užduoti klausimą

Siųskite klausimą apie modulį el. paštu. [ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E)
