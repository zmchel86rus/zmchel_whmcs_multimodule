# Import ja eksport

Üks JSON-fail kõigi või valitud jaotiste jaoks, kuni 32 MiB (kehtivad ka PHP üleslaadimispiirangud). Vastavaid lehti uuendatakse püsiviite ja juurdepääsutüübi, menüüsid nime alusel. Muud kirjed jäävad muutmata. Uuele saidile menüüsid importides kaasake ka lehed. Failist puuduvad valitud jaotised jäetakse vahele.

CSS/JS kaasatakse koos lehtedega; pildid ja muud üleslaaditud failid koos meediateegiga. Muudatuste ajalugu, kogutud Smarty muutujaid ega WHMCS-i saladusi ei ekspordita. Pärast importi looge saidikaart uuesti; rakendage ümberkirjutamise reeglid ümberkirjutamise reeglite halduris.

Lehed ja postitused (tõlked, sisu, SEO, saidikaardi seaded, CSS/JS-plokid)

## JSON

Eksport võib sisaldada lehti ja postitusi koos tõlgete, sisu, SEO ja CSS/JS-iga; menüüsid koos hierarhia ja asukohtadega; sätteid, ümbersuunamisi, kohandatud reegleid ning meediakogu koos failidega. Versiooniajalugu, kogutud Smarty muutujad, WHMCS-i kontod ja saladused ning kujunduse failid jäetakse välja. JSON-faili piir on 32 MiB; kehtivad ka PHP `upload_max_filesize` ja `post_max_size`. Menüüde teise saiti viimisel importige ka lehed ning lahendage samanimelised menüüd enne importi.

Ekspordifail kasutab vormingut `zmchel_whmcs_multimodule` (versioon 1). Importimisel kohandatakse lähte saidi URL-id sihtsaidi `SystemURL` järgi, välislingid jäävad samaks. Import ei loo tabeleid: valmista need kõigepealt ette mooduli andmebaasi jaotises. Enne alustamist küsitakse kinnitust; kirjeid muudetakse tehingus ja asendatud failid taastatakse vea korral.

## Juhised

- Menüüd ja asukohad
- Mooduli seaded, lehtede asendused, päis/jalus, robots.txt
- Ümbersuunamised
- Kohandatud URL-i ümberkirjutamise reeglid
- Meediateek (failid ja kirjeldused)
- Valitud jaotiste vastavad kirjed uuendatakse failist. Kas jätkata?
