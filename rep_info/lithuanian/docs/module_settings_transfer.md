# Importas ir eksportas

Prieš didelius pakeitimus eksportuokite reikalingas dalis. Po importo patikrinkite puslapius, meniu ir mediją, atskirai pritaikykite perrašymo taisykles ir atnaujinkite schemą. Tai nepakeičia WHMCS atsarginės kopijos.

## JSON

Eksportas gali apimti puslapius ir įrašus su vertimais, turiniu, SEO ir CSS/JS; meniu su hierarchija ir vietomis; nustatymus, peradresavimus, savas taisykles ir medijos biblioteką su failais. Versijų istorija, surinkti Smarty kintamieji, WHMCS paskyros ir paslaptys bei temos failai neįtraukiami. JSON failo riba yra 32 MiB; galioja ir PHP `upload_max_filesize` bei `post_max_size` ribos. Perkeldami meniu į kitą svetainę importuokite ir puslapius, o vienodus meniu pavadinimus išspręskite iš anksto.

Eksporto failas naudoja formatą `zmchel_whmcs_multimodule` (1 versija). Importuojant šaltinio svetainės URL pritaikomi prie paskirties svetainės `SystemURL`, o išorinės nuorodos išlieka. Importas nekuria lentelių: pirmiausia paruoškite jas Modulio duomenų bazėje. Prieš pradedant prašoma patvirtinimo; įrašai keičiami transakcijoje, o klaidos atveju pakeisti failai atkuriami.

## Instrukcijos

- Vienas JSON failas visiems arba pasirinktiems skyriams, iki 32 MiB (taip pat taikomi PHP įkėlimo apribojimai). Sutampantys puslapiai atnaujinami pagal URL identifikatorių (slug) ir prieigos tipą, meniu – pagal pavadinimą. Kiti įrašai lieka nepakeisti. Importuodami meniu į naują svetainę įtraukite ir puslapius. Faile nesantys pasirinkti skyriai praleidžiami.
- CSS/JS įtraukiami kartu su puslapiais, o vaizdai ir kiti įkelti failai – su medijos biblioteka. Versijų istorija, surinkti „Smarty“ kintamieji ir konfidencialūs WHMCS duomenys neeksportuojami. Po importavimo iš naujo sugeneruokite svetainės schemą; URL perrašymo taisykles pritaikykite URL perrašymo tvarkytuvėje.
- Puslapiai ir įrašai (vertimai, turinys, SEO, svetainės schemos nustatymai, CSS/JS blokai)
- Meniu ir jų vietos
- Modulio nustatymai, perrašymai, antraštė / poraštė, robots.txt
- Peradresavimai
- Pasirinktinės URL perrašymo taisyklės
- Medijos biblioteka (failai ir aprašymai)
- Sutampantys įrašai pasirinktuose skyriuose bus atnaujinti pagal failą. Tęsti?
