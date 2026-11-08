# Importas ir eksportas

Prieš didelius pakeitimus eksportuokite reikalingas dalis. Po importo patikrinkite puslapius, meniu ir mediją, atskirai pritaikykite perrašymo taisykles ir atnaujinkite schemą. Tai nepakeičia WHMCS atsarginės kopijos. Importuojant palaikomi ir JSON failai.

## ZIP

Eksportas gali apimti puslapius ir įrašus su vertimais, turiniu, SEO ir CSS/JS; meniu su hierarchija ir vietomis; nustatymus, peradresavimus, savas taisykles ir medijos biblioteką su failais. Versijų istorija, surinkti Smarty kintamieji, WHMCS paskyros ir paslaptys bei temos failai neįtraukiami. ZIP failo riba yra 128 MiB; galioja ir PHP `upload_max_filesize` bei `post_max_size` ribos. Perkeldami meniu į kitą svetainę importuokite ir puslapius, o vienodus meniu pavadinimus išspręskite iš anksto.

Eksporto failas naudoja formatą `zmchel_whmcs_multimodule` (2 versija). Importuojant šaltinio svetainės URL pritaikomi prie paskirties svetainės `SystemURL`, o išorinės nuorodos išlieka. Importas nekuria lentelių: pirmiausia paruoškite jas Modulio duomenų bazėje. Prieš pradedant prašoma patvirtinimo; įrašai keičiami transakcijoje, o klaidos atveju pakeisti failai atkuriami.
