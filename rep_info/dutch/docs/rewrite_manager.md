# Herschrijfregels

## .htaccess

Open de beheerder en vergelijk de regels met het hoofd bestand `.htaccess`. Sla voor een eigen regel het URL-patroon, doel en de vlaggen op en kies daarna **Regels toevoegen of bijwerken** om het blok vóór de WHMCS-regels te schrijven. Controleer de status opnieuw en open een gepubliceerde pagina in de standaardtaal en een andere taal. Een te breed patroon kan andere pagina's raken. Bij Nginx → Apache gelden deze regels alleen voor verzoeken die Apache bereiken.

## Instructies

- Regels voor taal-URL's, waaronder pagina's onder /ru/, /en/ en andere voorvoegsels. De talen zijn afkomstig uit supported_langs.php; de regels worden vóór de WHMCS-regels in .htaccess ingevoegd.
- Nginx leest .htaccess niet, dus deze regels werken daar niet. Configureer gelijkwaardige regels in nginx.
- Er is een configuratie met nginx → Apache gedetecteerd. Deze regels werken alleen voor verzoeken die naar Apache worden doorgestuurd; nginx leest .htaccess niet.
- Regels controleren
- Regels toevoegen of bijwerken
- Alle regels uit .htaccess verwijderen
- URL-patroon
- Doel
- Vlaggen
- Klik na het toevoegen of verwijderen van een regel op ‘Regels toevoegen of bijwerken’ om de wijzigingen in .htaccess toe te passen.

## 1. Installatie en toegang

Activeer de add-on in WHMCS en geef bevoegde medewerkers toegang. Controleer in Module database of de vereiste tabellen bestaan. Bekijk daarna de instellingen voor nette URL's, taalroutes en menu's. Laat Apache de regels uit .htaccess lezen; configureer bij Nginx de equivalente serverregels zelf.
