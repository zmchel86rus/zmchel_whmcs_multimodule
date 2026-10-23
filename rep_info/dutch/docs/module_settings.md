# Module-instellingen

- [Import en export](module_settings_transfer.md)

## Instructies

- Kies welke talen de module kan gebruiken. Uitschakelen verwijdert de inhoud niet.
- Werk bij mooie URL's op Apache na een taalwijziging de regels in Rewrite Manager bij.
- **Leesbare URL's** — Schakel leesbare URL's in, inclusief systeem-URL's.
- **Taalroutering** — Schakel taalroutes in of uit. Indien ingeschakeld, zijn pagina's beschikbaar onder /de/, /en/, /es/ en andere ondersteunde taalvoorvoegsels. Indien uitgeschakeld, toont één pagina-URL de inhoud in de ingestelde taal van de gebruiker.
- **Route voor standaardtaal** — Geeft de standaardtaal een eigen URL-voorvoegsel en leidt modulepaginas zonder voorvoegsel ernaartoe om.
- **Onderhoudsmodus (module)** — Schakel de onderhoudsmodus van de module in of uit. Deze lichtere modus laat WHMCS-hooks en andere onderdelen doorwerken, in tegenstelling tot de systeemonderhoudsmodus.
- **Smarty-variabelen verzamelen** — Schakel het verzamelen van Smarty-variabelen in of uit.
- **Verzamelde Smarty-variabelen gebruiken** — Schakel het gebruik van verzamelde Smarty-variabelen in de pagina-editor in of uit.
- **Paginavervangingen** — Schakel paginavervangingen in of uit.
- **Bijwerkfrequentie** — Als er niets is geselecteerd, wordt de sitemap dagelijks bijgewerkt.
- **HTML-sitemap** — Indien ingeschakeld, wordt de sitemap op /html-sitemap als een gewone HTML-pagina weergegeven; sitemap.xml blijft ongewijzigd.
- **Websiteheader** — Aangepaste HTML voor het gedeelte <head>, inclusief <script> en <style>.
- **Websitefooter** — Aangepaste HTML vóór </body>, inclusief <script> en <style>.
- **robots.txt bewerken**

## 1. Installatie en toegang

Activeer de add-on in WHMCS en geef bevoegde medewerkers toegang. Controleer in Module database of de vereiste tabellen bestaan. Bekijk daarna de instellingen voor nette URL's, taalroutes en menu's. Laat Apache de regels uit .htaccess lezen; configureer bij Nginx de equivalente serverregels zelf.
