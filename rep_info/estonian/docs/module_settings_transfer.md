# Import ja eksport

Üks ZIP-fail kõigi või valitud jaotiste jaoks, kuni 128 MiB (arvestage PHP üleslaadimispiirangutega). Vastavaid lehti uuendatakse püsiviite ja juurdepääsutüübi, menüüsid nime alusel. Muud kirjed jäävad muutmata. Uuele saidile menüüsid importides kaasake ka lehed. Failist puuduvad valitud jaotised jäetakse vahele. Importimisel toetatakse ka JSON-faile.

CSS/JS kaasatakse koos lehtedega; pildid ja muud üleslaaditud failid koos meediateegiga. Muudatuste ajalugu, kogutud Smarty muutujaid ega WHMCS-i saladusi ei ekspordita. Pärast importi looge saidikaart uuesti; rakendage ümberkirjutamise reeglid ümberkirjutamise reeglite halduris.

Lehed ja postitused (tõlked, sisu, SEO, saidikaardi seaded, CSS/JS-plokid)

## ZIP

Eksport võib sisaldada lehti ja postitusi koos tõlgete, sisu, SEO ja CSS/JS-iga; menüüsid koos hierarhia ja asukohtadega; sätteid, ümbersuunamisi, kohandatud reegleid ning meediakogu koos failidega. Versiooniajalugu, kogutud Smarty muutujad, WHMCS-i kontod ja saladused ning kujunduse failid jäetakse välja. ZIP-faili piir on 128 MiB; kehtivad ka PHP `upload_max_filesize` ja `post_max_size`. Menüüde teise saiti viimisel importige ka lehed ning lahendage samanimelised menüüd enne importi.

Ekspordifail kasutab vormingut `zmchel_whmcs_multimodule` (versioon 2). Importimisel kohandatakse lähte saidi URL-id sihtsaidi `SystemURL` järgi, välislingid jäävad samaks. Import ei loo tabeleid: valmista need kõigepealt ette mooduli andmebaasi jaotises. Enne alustamist küsitakse kinnitust; kirjeid muudetakse tehingus ja asendatud failid taastatakse vea korral.
