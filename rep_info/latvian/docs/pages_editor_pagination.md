# Lapošana un filtri

Noklikšķiniet uz saraksta bloka. Esc atceļ izvēli. Novietojiet lapošanu ārpus izvēlētā bloka.

Smarty gadījumā norādiet pilnā saraksta mainīgo. Ja mainīgais nav norādīts, tiek lapoti konteinera HTML elementi; pēc vajadzības norādiet rindu klasi vai tagu tr. Saitēs tiek saglabāti count, sort un filtri. Tiek atbalstīti vairāki neatkarīgi saraksti.

Velciet lapas izmēra izvēlni uz lapošanas bloku vai citiem lapas blokiem. Tā paliks piesaistīta šai lapošanai.

Izvēlieties Smarty saraksta bloku. Meklēšanai un lapošanai jābūt saistītai ar vienu un to pašu bloku.

Norādiet pilnā saraksta mainīgo. Meklēšana pārbauda jebkuru izvēlēto lauku, bet filtri tiek piemēroti kopā. Nosacījumi tiek piemēroti pirms lapu skaita aprēķināšanas; filtru piemērošana vai atiestatīšana atgriež pirmajā lapā. Ja lapošana jau ir piesaistīta, tiek izmantots tās mainīgais.

Lapošanu un filtrus piesaistiet vienam sarakstam. Izvēlieties rezultātu skaitu un URL formu; pārbaudiet otro lapu un vienu filtru.

## Saites un saraksta avots

Novietojiet lapošanu ārpus saraksta bloka un izvēlieties šo bloku par mērķi. Smarty sarakstam norādiet mainīgo ar visiem ierakstiem; citādi tiek sadalīti konteinera HTML elementi. Izvēlieties saišu formātu pēc moduļa iestatījuma, `/page/2/` vai `?page=2`. Ceļa formātam vajadzīgi rewrite noteikumi. Neatkarīgi saraksti izmanto atsevišķus parametrus; saites saglabā valodu, filtrus un kārtojumu.

## Lapas izmērs, SEO un filtri

Nosakiet ierakstu skaitu un, ja vajag, ieslēdziet izvēli 10/25/50/100/250. Izmēra maiņa atgriež sarakstu pirmajā lapā. Noindex darbojas tikai no otrās lapas; pārbaudiet virsrakstu un kanonisko URL. Piesaistiet filtrus tam pašam sarakstam un publiskajā vietnē pārbaudiet otro lapu un filtrētu rezultātu.

## page / count / pager

Smarty sarakstam norādiet mainīgo ar visiem elementiem un atstājiet `{foreach}` ciklu: modulis sarakstu sadala pats, tāpēc nepievienojiet otru `array_slice`. Bez mainīgā sadala konteinera HTML elementus; var norādīt rindas klasi vai tagu `tr`, bet `thead` un `tfoot` paliek vietā. Pogu skaitu ap pašreizējo lapu iestatiet atsevišķi datoram un tālrunim. Tiešajos PHP maršrutos izmantojiet `?page=2`; `/page/2/` vajag rewrite noteikumus. Nākamajām lapām ir savs canonical, un tām var pievienot `noindex`.

Ja ir vairāki neatkarīgi saraksti, pirmais izmanto `page`, `count` un `sort`, bet pārējie — parametrus ar bloka ID. Ceļā `/page/N/` parametrs `pager` norāda, kuram sarakstam pieder numurs. Smarty blokā `$zm_pagination` dod `total`, `page`, `pages`, `count` un `offset`. `count` ierobežo līdz 10–250. Ja saraksts ir tukšs vai vienā lapā, lapošanas panelis tiek paslēpts.

## YYYY-MM-DD

Filtri darbojas ar to pašu sarakstu, ar kuru darbojas lapošana. Teksta meklēšana var pārbaudīt vairākus ar komatiem atdalītus laukus; datumu diapazons izmanto `YYYY-MM-DD` un ietver visu pēdējo dienu.

## Flex / Grid

Izvēlieties Flex vai Grid, iestatiet platumu un kolonnas katrai ierīcei. Filtra piemērošana vai notīrīšana atgriež sarakstu pirmajā lapā. Vienumu skaita izvēlni var pārvietot, nezaudējot saiti; dublēts panelis vada to pašu sarakstu.

## Instrukcijas

- Elementu skaita izvēlne: 10, 25, 50, 100, 250
- Neindeksēt 2. un turpmākās lapas
- Saišu formāts
- Noklusējuma elementu skaits lapā
