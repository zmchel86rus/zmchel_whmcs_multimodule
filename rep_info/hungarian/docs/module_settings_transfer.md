# Importálás és exportálás

Egyetlen ZIP-fájl használható az összes vagy a kijelölt szakaszhoz, legfeljebb 128 MiB méretig (vegye figyelembe a PHP feltöltési korlátait). Az egyező oldalak a slug és a hozzáférési típus, a menük a nevük alapján frissülnek. A többi rekord változatlan marad. Ha új webhelyre importál menüket, az oldalakat is vegye fel. A fájlból hiányzó kijelölt szakaszok kimaradnak. Az importálás a JSON-fájlokat is támogatja.

A CSS/JS az oldalakkal, a képek és más feltöltött fájlok a médiatárral együtt kerülnek exportálásra. A változatelőzmények, az összegyűjtött Smarty-változók és a WHMCS bizalmas adatai nem kerülnek exportálásra. Importálás után generálja újra a webhelytérképet, az átírási szabályokat pedig alkalmazza az URL-átírás-kezelőben.

A kijelölt szakaszokban található egyező rekordok frissülnek a fájlból. Folytatja?

## ZIP

Az export tartalmazhatja az oldalakat és bejegyzéseket a fordításokkal, tartalommal, SEO-adatokkal és CSS/JS-kóddal; a menüket a hierarchiával és helyekkel; a beállításokat, átirányításokat, egyéni szabályokat és a médiatár fájljait. A verzióelőzmények, gyűjtött Smarty-változók, WHMCS-fiókok és titkok, valamint a témafájlok kimaradnak. A ZIP-fájl korlátja 128 MiB; a PHP `upload_max_filesize` és `post_max_size` korlátai is érvényesek. Másik webhelyre vitt menükhöz az oldalakat is importálja, és előbb oldja fel az azonos menüneveket.

Az exportfájl formátuma `zmchel_whmcs_multimodule` (2. verzió). Importáláskor a forráswebhely URL-címei a cél `SystemURL` értékéhez igazodnak, a külső hivatkozások változatlanok maradnak. Az import nem hoz létre táblákat: előbb készítse elő őket a Modul adatbázisa részben. Indítás előtt megerősítés jelenik meg; a rekordok tranzakcióban módosulnak, a felülírt fájlok hiba esetén visszaállnak.
