# Gestructureerde gegevens

- **Pagina-editor → Metadata-instellingen → Schematype → Opslaan.**

Vul per taal de metagegevens en een passend paginatype in: WebPage, een artikeltype of ContactPage. Controleer na publicatie JSON-LD en de canonieke URL.

## Welke gegevens de module markeert

Menu's en inhoudsopgaven kunnen `SiteNavigationElement` opleveren, zichtbare vragen en antwoorden `FAQPage`, en een kruimelpad met meerdere onderdelen `BreadcrumbList`. Opmaakblokken, knoppen en filters krijgen niet automatisch een inhoudstype. Het gekozen Schema-type bepaalt de JSON-LD van de pagina; staat het uit, dan wordt die markering niet uitgevoerd.

## Controleren na publicatie

Controleer op de openbare pagina de JSON-LD, canonieke URL, taal en daadwerkelijk zichtbare inhoud. Geldige markering garandeert geen uitgebreid zoekresultaat.

## Schema.org

`SiteNavigationElement` gebruikt de werkelijk zichtbare menulinks en titels; de inhoudsopgave kan ook `WebPageElement` toevoegen voor bestaande koppen. `FAQPage` bevat alleen volledige vragen en antwoorden die de bezoeker ziet: verborgen blokken en gewone accordeons vallen buiten de markering. `BreadcrumbList` wordt alleen bij minstens twee items gemaakt. Organisatiegegevens komen uit WHMCS; contacttalen staan in `ContactPoint.availableLanguage` volgens BCP 47. Voor filters, paginering, formulieren en aangepaste HTML wordt geen Schema-type geraden.

## Instructies

- **Schematype** — Wanneer dit is uitgeschakeld, wordt voor deze pagina geen Schema.org-JSON-opmaak uitgevoerd.
- **Broodkruimelnavigatie** — Paginanaam in broodkruimelnavigatie
- **Canonieke URL**
- **Paginatitel**
- **Metabeschrijving**
- **Open Graph-titel** — Als dit leeg is, wordt de paginatitel gebruikt.
- **Open Graph-beschrijving** — Als dit leeg is, wordt de metabeschrijving gebruikt.
- **Open Graph-afbeelding** — Als dit leeg is, wordt de pagina-afbeelding gebruikt.
