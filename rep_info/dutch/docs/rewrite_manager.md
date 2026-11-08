# Herschrijfregels

## .htaccess

Open de beheerder en vergelijk de regels met het hoofd bestand `.htaccess`. Sla voor een eigen regel het URL-patroon, doel en de vlaggen op en kies daarna **Regels toevoegen of bijwerken** om het blok vóór de WHMCS-regels te schrijven. Controleer de status opnieuw en open een gepubliceerde pagina in de standaardtaal en een andere taal. Een te breed patroon kan andere pagina's raken. Bij Nginx → Apache gelden deze regels alleen voor verzoeken die Apache bereiken.

## 1. Installatie en toegang

Activeer de add-on in WHMCS en geef bevoegde medewerkers toegang. Controleer in Module database of de vereiste tabellen bestaan. Bekijk daarna de instellingen voor nette URL's, taalroutes en menu's. Laat Apache de regels uit .htaccess lezen; configureer bij Nginx de equivalente serverregels zelf.
