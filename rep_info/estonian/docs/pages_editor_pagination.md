# Lehitsemine

Klõpsa loendit sisaldaval plokil. Esc tühistab valiku. Lehekülgede jaotus peab asuma väljaspool valitud plokki.

Smarty puhul määra kogu loendit sisaldav muutuja. Ilma muutujata jaotatakse konteineri HTML-elemendid lehekülgedeks; vajaduse korral määra ridade klass või silt tr. Lingid säilitavad count, sort ja filtrid. Toetatud on sõltumatud loendid.

Elementide arvu valiku saab lohistada lehekülgede jaotuse sees või lehe teistesse plokkidesse. See jääb selle lehekülgede jaotusega seotuks.

Vali loendit sisaldav Smarty plokk. Otsing ja lehekülgede jaotus peavad olema seotud sama plokiga.

Määra kogu loendit sisaldav muutuja. Otsing kontrollib kõiki määratud välju ning filtreid rakendatakse koos. Tingimusi arvestatakse enne lehekülgede arvu arvutamist; filtrite rakendamine ja lähtestamine viib tagasi esimesele lehele. Kui lehekülgede jaotus on juba olemas, kasutatakse selle muutujat.

## Lingid ja loendi allikas

Paigutage lehitsemine loendiplokist väljapoole ja valige see plokk sihtmärgiks. Smarty loendi jaoks määrake muutuja, mis sisaldab kõiki kirjeid; muul juhul jagatakse konteineri HTML-elemendid. Valige lingi kuju mooduli seadest, `/page/2/` või `?page=2`. Rajapõhine kuju vajab rewrite-reegleid. Sõltumatud loendid kasutavad eraldi parameetreid; lingid säilitavad keele, filtrid ja järjestuse.

## Lehe suurus, SEO ja filtrid

Määrake kirjete arv ja lülitage vajaduse korral sisse valik 10/25/50/100/250. Arvu muutmine viib loendi tagasi esimesele lehele. Noindex kehtib alates teisest lehest; kontrollige pealkirja ja kanoonilist URL-i. Siduge filtrid sama loendiga ning testige avalikul saidil teist lehte ja filtreeritud tulemust.

## page / count / pager

Smarty loendi jaoks määrake kõiki kirjeid sisaldav muutuja ja jätke `{foreach}`-tsükkel alles: moodul jagab loendi ise, ärge lisage teist `array_slice`-i. Ilma muutujata jagatakse konteineri HTML-elemendid; saate määrata rea klassi või `tr`-sildi, `thead` ja `tfoot` jäävad alles. Määrake praeguse lehe ümber olevate nuppude arv arvutile ja mobiilile eraldi. Otseste PHP-teede puhul kasutage `?page=2`; `/page/2/` vajab rewrite-reegleid. Järgmistel lehtedel on oma canonical ja neile võib määrata `noindex`.

Kui lehel on mitu sõltumatut loendit, kasutab esimene parameetreid `page`, `count` ja `sort`; ülejäänud saavad ploki ID-ga parameetrid. Tee `/page/N/` puhul näitab `pager`, millise loendi number see on. Smarty-plokis annab `$zm_pagination` väärtused `total`, `page`, `pages`, `count` ja `offset`. `count` piiratakse vahemikku 10–250. Tühja või üheleheküljelise loendi korral lehitsemispaneeli ei näidata.

## YYYY-MM-DD

Filtrid töötavad sama loendiga nagu lehitsemine. Tekstiotsing saab kontrollida mitut komadega eraldatud välja; kuupäevavahemik kasutab vormingut `YYYY-MM-DD` ja hõlmab viimast päeva tervikuna.

## Flex / Grid

Vali Flex või Grid ning määra laiused ja veerud seadme järgi. Filtri rakendamine või lähtestamine viib loendi esimesele lehele. Kirjete arvu valijat võib liigutada ühendust kaotamata; dubleeritud paneel juhib sama loendit.

## Juhised

- Elementide arvu valik: 10, 25, 50, 100, 250
- Ära indekseeri lehti alates teisest lehest
- Linkide vorming
- Elementide vaikimisi arv
