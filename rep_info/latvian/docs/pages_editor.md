# Lapu redaktors

- [Lapošana un filtri](pages_editor_pagination.md)
- [Smarty un mainīgie](pages_editor_smarty.md)
- [Strukturētie dati](module_structured_data.md)

## 3. Satura rediģēšana

Katrai valodai aizpildiet Satura, Metadatu un Vietnes kartes cilnes. Ievelciet blokus redaktorā, mainiet tekstu un attēlus un saglabājiet katru cilni. Kopēšana ar saturu dod sākuma versiju; struktūras kopēšana sagatavo izkārtojumu tulkošanai. Teksts netiek tulkots automātiski.

## 4. Saites un publicēšana

Saitēm uz tulkotām moduļa lapām ieslēdziet pašreizējās valodas pievienošanu URL. Izslēdziet to ārējām saitēm, e-pasta adresēm un WHMCS maršrutiem bez valodu versijām. Pēc publicēšanas pārbaudiet lapu kā viesis un klients, datorā un tālrunī, vismaz divās valodās.

## SEO

Pamat iestatījumos pārbaudiet nosaukumu, slug, tipu, statusu, piekļuvi un valodas. WHMCS noklusējuma valodai modulī jābūt ieslēgtai; publicētai lapai vajadzīgs saturs attēlotajā valodā. Katrai valodai aizpildiet virsrakstu un aprakstu, pēc tam pārbaudiet canonical, robots, Open Graph, navigācijas ceļu un Schema. Vietnes kartes cilnē izvēlieties biežumu un prioritāti publiskai nesistēmas lapai. Saglabājiet un pārbaudiet publisko URL un XML.

## Kontaktforma

Pievienojiet bloku **Kontaktforma**. Izvēlieties **WHMCS pieteikumu** ar atbalsta nodaļu vai **e-pastu** ar saņēmēju; aizpildiet virsrakstu, aprakstu, tematu un pogas tekstu. Katram laukam norādiet nosaukumu, tipu, obligātumu un pārbaudi. Viesa pieteikumam vajag laukus ar sūtītāja vārda un e-pasta lomām. Nolaižamajā sarakstā rakstiet vienu variantu katrā rindā, piemēram `sales : Pārdošana`. Katram piekrišanas tekstam veidojiet atsevišķu lauku un izmantojiet WHMCS CAPTCHA. Saglabājiet un nosūtiet īstu pārbaudi kā viesis; pārbaudiet pieteikumu vai piegādi, kļūdas un formas notīrīšanu. Redaktora zaļais statuss neapstiprina piegādi; ja `mail()` nedarbojas, konfigurējiet SMTP WHMCS.

## Instrukcijas

- Ligzdots elastīgā izkārtojuma konteiners (Flex). Ievelciet tajā citus blokus.
- Ligzdots CSS Grid konteiners. Ievelciet tajā citus blokus.
- Ligzdots Bootstrap karuselis. Ievelciet tajā blokus; katrs kļūs par slaidu.
- Visi bloki zem šī bloka tiek rādīti tikai pieteikušiem lietotājiem. Darbojas tikai tad, ja lapas piekļuves veids ir „Jaukta piekļuve”.
- Visi bloki zem šī bloka tiek rādīti tikai viesiem. Darbojas tikai tad, ja lapas piekļuves veids ir „Jaukta piekļuve”.
- **Lapas virsraksts**
- **Metaapraksts**
- **Kanoniskais URL**
- **Meklētājprogrammu roboti** — index, follow / noindex, nofollow. Nosaka indeksēšanu.
- **Schema veids** — Ja atspējots, šai lapai netiek izvadīts Schema.org JSON marķējums.
