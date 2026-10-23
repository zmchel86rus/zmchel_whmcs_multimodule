# Paginering en filters

Koppel paginering en filters aan dezelfde lijst. Kies resultaten per pagina en de URL-vorm; test pagina 2 en een filterwaarde om de resultaten te controleren.

## Links en lijstbron

Plaats de paginering buiten het lijstblok en kies dat blok als doel. Geef voor een Smarty-lijst de variabele met alle items op; anders worden de HTML-elementen van de container verdeeld. Kies de linkvorm volgens de module-instelling, `/page/2/` of `?page=2`. Een padvorm vereist rewrite-regels. Onafhankelijke lijsten gebruiken aparte parameters; links behouden taal, filters en sortering.

## Paginagrootte, SEO en filters

Stel het aantal items in en schakel eventueel de keuzelijst 10/25/50/100/250 in. Een andere grootte brengt de lijst terug naar pagina één. Noindex geldt pas vanaf pagina twee; controleer titel en canonieke URL. Koppel filters aan dezelfde lijst en test pagina twee en een gefilterd resultaat op de openbare site.

## page / count / pager

Geef voor een Smarty-lijst de variabele met alle items op en laat de `{foreach}`-lus staan: de module splitst de lijst, dus voeg geen tweede `array_slice` toe. Zonder variabele worden de HTML-elementen in de container verdeeld; u kunt een rijklasse of `tr`-tag opgeven, terwijl `thead` en `tfoot` blijven staan. Stel het aantal knoppen rond de huidige pagina afzonderlijk in voor desktop en mobiel. Gebruik `?page=2` op directe PHP-routes; `/page/2/` vereist rewrite-regels. Latere pagina’s hebben een eigen canonical en kunnen `noindex` krijgen.

Bij meerdere onafhankelijke lijsten gebruikt de eerste `page`, `count` en `sort`; de andere krijgen parameters met de blok-ID. Bij het pad `/page/N/` geeft `pager` aan bij welke lijst het nummer hoort. In het Smarty-blok bevat `$zm_pagination` `total`, `page`, `pages`, `count` en `offset`. De waarde van `count` wordt begrensd op 10–250. Bij een lege lijst of één pagina wordt de pagineringsbalk verborgen.

## YYYY-MM-DD

Filters werken op dezelfde lijst als de paginering. Tekstzoekopdrachten kunnen meerdere, door komma's gescheiden velden controleren; het datumbereik gebruikt `YYYY-MM-DD` en omvat de hele laatste dag.

## Flex / Grid

Kies Flex of Grid en stel breedtes en kolommen per apparaat in. Een filter toepassen of wissen zet de lijst terug op de eerste pagina. De keuzelijst voor aantallen kan worden verplaatst zonder de koppeling te verliezen; een dubbele balk bedient dezelfde lijst.

## Instructies

- Klik op het lijstblok. Druk op Esc om te annuleren. Plaats de paginering buiten het doelblok.
- Geef voor Smarty de variabele van de volledige lijst op. Zonder variabele worden de HTML-elementen in de container over pagina's verdeeld; geef eventueel een rij-klasse of de tag tr op. Links behouden count, sort en filters. Meerdere onafhankelijke lijsten worden ondersteund.
- Items per pagina: 10, 25, 50, 100, 250
- Sleep de selector voor het aantal items per pagina naar de paginering of naar andere blokken op de pagina. De selector blijft aan deze paginering gekoppeld.
- Pagina 2 en verder niet indexeren
- Selecteer het Smarty-blok met de lijst. Zoeken en paginering moeten aan hetzelfde blok gekoppeld zijn.
- Geef de variabele van de volledige lijst op. De zoekopdracht doorzoekt alle gekozen velden; filters worden gecombineerd. De voorwaarden worden toegepast voordat het aantal pagina's wordt berekend; bij toepassen of opnieuw instellen ga je terug naar de eerste pagina. Als er al een pagineringskoppeling is, wordt de bijbehorende variabele gebruikt.
- Linkformaat
- Standaardaantal items per pagina
