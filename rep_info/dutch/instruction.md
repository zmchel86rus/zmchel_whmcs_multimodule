# Handleiding voor zmchel WHMCS Multimodule

**Genereer vóór gebruik unieke salts en vul ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT en ZM_PB_NONCE_SALT in module_init.php in.** De module is ontwikkeld en getest met WHMCS 8.13.1–8.13.7. Apache wordt volledig ondersteund. Nginx kan werken, maar taalroutering op de startpagina vereist mogelijk extra configuratie.

**Open vóór het eerste gebruik Module-instellingen → Ondersteunde talen en schakel de talen in die je nodig hebt.**

**Gecontroleerde PHP-versies:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 en 8.5.

**zmchel WHMCS Multimodule is gratis.** Beheer pagina's en artikelen vanuit de WHMCS-administratie, met een visuele editor, vertalingen, menu's, mediabestanden, SEO-velden, XML-sitemaps, omleidingen en herschrijfregels.

## Talenbeheer (in ontwikkeling)

Open Talenbeheer in het WHMCS-beheer en kies een onderdeel (WHMCS-client- of beheertalen, deze module of een andere module) en een taal. Vergelijk de oorspronkelijke tekst of referentie met de vertaling, bewerk één regel en sla die op; bestaande sleutels kun je ook als JSON exporteren en importeren. Nieuwe talen gebruiken de referentie totdat ze zijn vertaald. Talenbeheer schakelt taalbestanden in of uit en corrigeert oude bestandsnamen; wijzig eerst de standaardtaal in WHMCS.

→ [Talenbeheer](docs/language-manager.md)

## 1. Installatie en toegang

Activeer de add-on in WHMCS en geef bevoegde medewerkers toegang. Controleer in Module database of de vereiste tabellen bestaan. Bekijk daarna de instellingen voor nette URL's, taalroutes en menu's. Laat Apache de regels uit .htaccess lezen; configureer bij Nginx de equivalente serverregels zelf.

## 2. Pagina's maken

Open Paginalijst en kies Pagina toevoegen. Geef een interne naam en een slug met Latijnse letters, cijfers en koppeltekens op, bijvoorbeeld about-us. Kies toegang voor iedereen, alleen ingelogde klanten of alleen gasten. Selecteer de status en de ondersteunde talen. De standaardtaal van WHMCS moet ook door de module worden ondersteund.

## 3. Inhoud bewerken

Open de pagina en bewerk per taal de tabbladen Inhoud, Metagegevens en Sitemap. Sleep blokken naar het canvas, wijzig tekst en afbeeldingen en sla elk tabblad op. Gebruik Kopiëren met inhoud voor een uitgangsversie of Kopiëren van structuur voor een lege vertaalindeling. Een kopie vertaalt de tekst niet automatisch.

## 4. Links en publicatie

Gebruik bij een link naar een vertaalde modulepagina de optie om de huidige taal aan de URL toe te voegen. Schakel die uit voor externe links, e-mailadressen en WHMCS-routes zonder taalversie. Controleer na publicatie de pagina als gast en als klant, op desktop en mobiel. Test ook titel, afbeeldingen, formulieren en de tweede taal.

## 5. Beheer en onderhoud

Menu Manager beheert navigatie; Media Manager beheert afbeeldingen. Met Redirect Manager stel je 301- of 302-omleidingen in. Sitemap genereert XML-bestanden. Exporteer instellingen vóór grote wijzigingen of import. Pas gewijzigde herschrijfregels opnieuw toe en controleer de sitemap na publicatie.

## Uitgebreide onderwerpen

- [Menu's](docs/menus.md)
- [Paginering en filters](docs/pagination.md)
- [Omleidingen](docs/redirects.md)
- [Sitemaps](docs/sitemaps.md)
- [Smarty en variabelen](docs/smarty.md)
- [Gestructureerde gegevens](docs/structured-data.md)
- [Import en export](docs/transfer.md)
