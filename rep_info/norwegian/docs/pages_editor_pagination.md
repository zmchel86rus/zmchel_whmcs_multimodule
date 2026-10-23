# Paginering

Klikk på blokken som inneholder listen. Trykk Esc for å avbryte. Sideinndelingen må ligge utenfor den valgte blokken.

For Smarty oppgir du variabelen for hele listen. Uten variabel deles HTML-elementene i beholderen inn i sider; oppgi eventuelt radklasse eller taggen tr. Lenkene beholder count, sort og filtrene. Uavhengige lister støttes.

Velgeren for antall elementer kan dras innenfor sideinndelingen og til andre blokker på siden. Den forblir knyttet til denne sideinndelingen.

Velg en Smarty-blokk med en liste. Søk og sideinndeling må være knyttet til samme blokk.

Oppgi variabelen for hele listen. Søket kontrollerer alle de angitte feltene, og filtrene brukes samlet. Betingelsene brukes før sidene telles; bruk og tilbakestilling går tilbake til første side. Hvis sideinndeling allerede finnes, brukes variabelen derfra.

## Lenker og listekilde

Plasser pagineringen utenfor listeblokken og velg denne blokken som mål. For en Smarty-liste oppgir du variabelen med alle elementene; ellers deles HTML-elementene i beholderen. Velg lenkeformat etter modulinnstillingen, `/page/2/` eller `?page=2`. Stiformatet krever rewrite-regler. Uavhengige lister bruker egne parametere; lenkene beholder språk, filtre og sortering.

## Sidestørrelse, SEO og filtre

Angi antall elementer og aktiver eventuelt valget 10/25/50/100/250. Endring av størrelsen sender listen tilbake til første side. Noindex gjelder først fra side to; kontroller tittel og kanonisk URL. Knytt filtrene til samme liste, og test side to og et filtrert resultat på det offentlige nettstedet.

## page / count / pager

For en Smarty-liste må du angi variabelen med alle elementene og beholde `{foreach}`-løkken: modulen deler listen, så ikke legg til enda en `array_slice`. Uten variabel deles HTML-elementene i beholderen; du kan velge en radklasse eller `tr`-tag, mens `thead` og `tfoot` beholdes. Still inn antallet knapper rundt gjeldende side separat for datamaskin og mobil. Bruk `?page=2` på direkte PHP-ruter; `/page/2/` krever rewrite-regler. Senere sider har sin egen canonical og kan få `noindex`.

Når det finnes flere uavhengige lister, bruker den første `page`, `count` og `sort`; de andre får parametere med blokkens ID. Med banen `/page/N/` viser `pager` hvilken liste tallet tilhører. I Smarty-blokken gir `$zm_pagination` `total`, `page`, `pages`, `count` og `offset`. `count` begrenses til 10–250. Hvis listen er tom eller har bare én side, skjules sidepanelet.

## YYYY-MM-DD

Filtrene virker på den samme listen som sideinndelingen. Tekstsøk kan kontrollere flere felt atskilt med komma; datointervallet bruker `YYYY-MM-DD` og omfatter hele sluttdagen.

## Flex / Grid

Velg Flex eller Grid, og juster bredder og kolonner for ulike enheter. Å bruke eller fjerne et filter sender listen tilbake til første side. Velgeren for antall resultater kan flyttes uten å miste koblingen; et duplisert panel styrer samme liste.

## Instruksjoner

- Velg antall elementer: 10, 25, 50, 100, 250
- Ikke indekser side 2 og videre
- Lenkeformat
- Standard antall elementer
