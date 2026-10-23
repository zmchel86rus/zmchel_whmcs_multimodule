# Moduledatabase

- **Moduledatabase:** `MISSING` → Selecteren → Herstellen Geselecteerde items.
- **Verwijderen Geselecteerde items** — Deze actie kan niet ongedaan worden gemaakt.

De pagina **Moduledatabase** toont de benodigde tabellen en kolommen en hun status. Alleen de aangewezen superbeheerder heeft toegang. Open de pagina als een ander onderdeel meldt dat een tabel of kolom ontbreekt. Controleer de lijst, selecteer alleen wat hersteld moet worden en klik op **Geselecteerde herstellen**. Sommige kolommen kunnen niet automatisch worden hersteld; controleer de status na afloop opnieuw.

**Geselecteerde verwijderen** verwijdert de gekozen databaseobjecten definitief. Exporteer de modulegegevens en maak een databaseback-up voordat je iets verwijdert.

## Instructies

- Toegang geweigerd. Alleen de hoofdbeheerder (ID …) heeft toegang tot de pagina Database van de module.
- Herstellen
- Geselecteerde items
- Verwijderen
- Deze actie kan niet ongedaan worden gemaakt.
- De menutabellen zijn nog niet aangemaakt. Voeg ze toe in Moduledatabase.
- Voeg eerst de kolom optimization_attempted toe in het tabelbeheer van de module.

## 1. Installatie en toegang

Activeer de add-on in WHMCS en geef bevoegde medewerkers toegang. Controleer in Module database of de vereiste tabellen bestaan. Bekijk daarna de instellingen voor nette URL's, taalroutes en menu's. Laat Apache de regels uit .htaccess lezen; configureer bij Nginx de equivalente serverregels zelf.
