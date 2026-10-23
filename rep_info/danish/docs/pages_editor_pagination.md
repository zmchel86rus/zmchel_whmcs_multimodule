# Sideinddeling og filtre

Knyt sideinddeling og filtre til samme liste. Vælg antal resultater og URL-form; test side 2 og en filterværdi for at kontrollere resultaterne.

## Links og listekilde

Placer sideinddelingen uden for listeblokken, og vælg blokken som mål. For en Smarty-liste angiver du variablen med alle elementer; ellers opdeles HTML-elementerne i containeren. Vælg linkformat efter modulindstillingen, `/page/2/` eller `?page=2`. Stiformatet kræver rewrite-regler. Uafhængige lister bruger særskilte parametre; links bevarer sprog, filtre og sortering.

## Sidestørrelse, SEO og filtre

Angiv antal elementer, og slå eventuelt valget 10/25/50/100/250 til. En ændring af antallet fører listen tilbage til side ét. Noindex gælder først fra side to; kontrollér titel og kanonisk URL. Knyt filtrene til samme liste, og afprøv derefter side to og et filtreret resultat på det offentlige websted.

## page / count / pager

For en Smarty-liste skal du angive variablen med alle elementer og beholde `{foreach}`-løkken: modulet opdeler listen, så tilføj ikke endnu et `array_slice`. Uden variabel opdeles HTML-elementerne i beholderen; en rækkeklasse eller `tr`-tag kan vælges, mens `thead` og `tfoot` bevares. Indstil antallet af knapper omkring den aktuelle side særskilt for computer og mobil. Brug `?page=2` på direkte PHP-ruter; `/page/2/` kræver rewrite-regler. Efterfølgende sider har deres egen canonical og kan få `noindex`.

Ved flere uafhængige lister bruger den første `page`, `count` og `sort`; de øvrige bruger parametre med blokkens ID. Med stien `/page/N/` angiver `pager`, hvilken liste tallet tilhører. I Smarty-blokken giver `$zm_pagination` værdierne `total`, `page`, `pages`, `count` og `offset`. `count` begrænses til 10–250. Hvis listen er tom eller kun har én side, skjules sidepanelet på den offentlige side.

## YYYY-MM-DD

Filtre arbejder på samme liste som sideinddelingen. Tekstsøgning kan kontrollere flere felter adskilt af kommaer; datointervallet bruger `YYYY-MM-DD` og medtager hele slutdagen.

## Flex / Grid

Vælg Flex eller Grid, og tilpas bredder og kolonner til enheder. Anvendelse eller nulstilling af et filter sender listen tilbage til første side. Antalsvælgeren kan flyttes uden at miste forbindelsen; et duplikeret panel styrer den samme liste.

## Vejledning

- Klik på listeblokken. Esc annullerer. Placer sideinddelingen uden for den valgte blok.
- Angiv variablen for hele listen til Smarty. Uden en variabel opdeles containerens HTML-elementer i sider; angiv eventuelt en klasse for rækkerne eller tagget tr. Links bevarer antal, sortering og filtre. Flere uafhængige lister understøttes.
- Antal pr. side: 10, 25, 50, 100, 250
- Træk vælgeren for antal elementer pr. side ind i sideinddelingen eller til andre blokke på siden. Den forbliver knyttet til denne sideinddeling.
- Indeksér ikke side 2 og frem
- Vælg Smarty-blokken med listen. Søgning og sideinddeling skal være knyttet til samme blok.
- Angiv variablen for hele listen. Søgningen matcher et hvilket som helst af de valgte felter; filtrene kombineres. Betingelserne anvendes før beregningen af antal sider; anvendelse eller nulstilling vender tilbage til første side. Hvis der allerede er en tilknyttet sideinddeling, bruges dens variabel.
- Linkformat
- Standardantal elementer pr. side
