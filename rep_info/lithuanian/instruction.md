# zmchel WHMCS Multimodule instrukcija

**Prieš naudodami sugeneruokite unikalias druskas ir įrašykite ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT bei ZM_PB_NONCE_SALT į module_init.php.** Modulis sukurtas ir išbandytas su WHMCS 8.13.1–8.13.7. Apache palaikomas visiškai. Nginx taip pat gali veikti, tačiau kalbų maršrutizavimui pagrindiniame puslapyje gali reikėti papildomų nustatymų.

**Prieš pirmą naudojimą atverkite Modulio nustatymai → Palaikomos kalbos ir įjunkite reikalingas kalbas.**

**Patikrintos PHP versijos:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 ir 8.5.

**zmchel WHMCS Multimodule yra nemokamas.** WHMCS administravimo srityje galima tvarkyti puslapius ir straipsnius naudojant vaizdinę rengyklę, vertimus, meniu, medijos biblioteką, SEO laukus, XML svetainės schemas, peradresavimus ir URL perrašymo taisykles.

## Kalbų tvarkytuvė (kuriama)

WHMCS administravimo srityje atverkite Kalbų tvarkytuvę, pasirinkite skyrių (WHMCS klientų ar administratorių kalbas, šį ar kitą modulį) ir kalbą. Palyginkite originalą arba pavyzdinį tekstą su vertimu, pakeiskite vieną eilutę ir ją išsaugokite; esamus raktus galima eksportuoti ir importuoti kaip JSON. Naujos kalbos naudoja pavyzdinį tekstą, kol yra išverčiamos. Tvarkytuvė įjungia ir išjungia kalbų failus bei taiso senus pavadinimus; numatytąją kalbą pirmiausia pakeiskite WHMCS.

→ [Kalbų tvarkytuvė](docs/language-manager.md)

## 1. Diegimas ir prieiga

Įjunkite papildomą modulį WHMCS ir suteikite prieigą įgaliotiems administratoriams. Modulio duomenų bazės skiltyje patikrinkite būtinas lenteles. Peržiūrėkite tvarkingus URL, kalbų maršrutus ir meniu vietas. Apache naudoja .htaccess; Nginx atveju atitinkamas serverio taisykles nustatykite atskirai.

## 2. Puslapio kūrimas

Atverkite puslapių sąrašą ir pridėkite puslapį. Nurodykite vidinį pavadinimą ir slug iš lotyniškų raidžių, skaitmenų bei brūkšnelių, pavyzdžiui, about-us. Pasirinkite prieigą visiems, tik prisijungusiems klientams arba tik svečiams. Nustatykite būseną ir kalbas. Numatytoji WHMCS kalba turi būti palaikoma modulio.

## 3. Turinio redagavimas

Kiekvienai kalbai užpildykite Turinio, Metaduomenų ir Svetainės schemos skirtukus. Nuvilkite blokus į rengyklę, pakeiskite tekstą bei paveikslėlius ir išsaugokite kiekvieną skirtuką. Kopijavimas su turiniu suteikia pradinį variantą, o struktūros kopijavimas paruošia išdėstymą vertimui. Tekstas automatiškai neverčiamas.

## 4. Nuorodos ir skelbimas

Nuorodoms į išverstus modulio puslapius įjunkite dabartinės kalbos pridėjimą prie URL. Išjunkite jį išorinėms nuorodoms, el. paštui ir WHMCS maršrutams be kalbinių versijų. Paskelbę patikrinkite puslapį kaip svečias ir klientas, kompiuteryje ir telefone, bent dviem kalbomis.

## 5. Valdymas ir priežiūra

Meniu tvarkyklė valdo naršymą, o medijos tvarkyklė — vaizdus. Peradresavimų tvarkyklė kuria 301 ir 302 taisykles. Svetainės schemos įrankis generuoja XML failus. Prieš didelius pakeitimus eksportuokite nustatymus; pakeitę perrašymo taisykles pritaikykite jas iš naujo ir patikrinkite schemą.

## Išsamios temos

- [Meniu](docs/menus.md)
- [Puslapiavimas ir filtrai](docs/pagination.md)
- [Peradresavimai](docs/redirects.md)
- [Svetainės schemos](docs/sitemaps.md)
- [Smarty ir kintamieji](docs/smarty.md)
- [Struktūrizuoti duomenys](docs/structured-data.md)
- [Importas ir eksportas](docs/transfer.md)
