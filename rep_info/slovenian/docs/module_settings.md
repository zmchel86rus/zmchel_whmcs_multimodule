# Nastavitve modula

Najprej omogočite potrebne jezike, nato izberite obliko URL-jev in jezikovne poti ter shranite nastavitve. Če so se poti spremenile, posodobite pravila Apache v Rewrite Managerju ali ustrezno konfiguracijo Nginx. Preverite stran modula v privzetem in še enem dejavnem jeziku. Pred večjimi spremembami ali uvozom izvozite varnostno kopijo.

- [Uvoz in izvoz](module_settings_transfer.md)

## 1. Namestitev in dostop

V WHMCS aktivirajte dodatni modul in dodelite dostop pooblaščenim skrbnikom. V zbirki podatkov modula preverite potrebne tabele. Preglejte prijazne URL-je, jezikovne poti in položaje menijev. Apache uporablja .htaccess; v Nginxu enakovredna strežniška pravila nastavite posebej.
