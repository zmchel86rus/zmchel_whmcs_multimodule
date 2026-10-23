# Paginacija

Kliknite blok koji sadrži popis. Pritisnite Esc za odustajanje. Paginacija mora biti izvan odabranog bloka.

Za Smarty navedite varijablu koja sadrži cijeli popis. Bez varijable HTML elementi spremnika dijele se na stranice; po potrebi navedite klasu redaka ili oznaku tr. Poveznice zadržavaju count, sort i filtre. Podržani su neovisni popisi.

Odabir broja stavki možete povući unutar paginacije ili u druge blokove stranice. Ostat će povezan s ovom paginacijom.

Odaberite Smarty blok s popisom. Pretraživanje i paginacija moraju biti povezani s istim blokom.

Navedite varijablu koja sadrži cijeli popis. Pretraživanje provjerava bilo koje od navedenih polja, a filtri se primjenjuju zajedno. Uvjeti se primjenjuju prije izračuna stranica; primjena i poništavanje filtara vraćaju na prvu stranicu. Ako paginacija već postoji, upotrebljava se njezina varijabla.

## Poveznice i izvor popisa

Postavite stranice izvan bloka popisa i odaberite taj blok kao cilj. Za Smarty popis navedite varijablu sa svim stavkama; inače se dijele HTML elementi spremnika. Odaberite oblik poveznica prema postavci modula, `/page/2/` ili `?page=2`. Putanja zahtijeva rewrite pravila. Neovisni popisi koriste zasebne parametre; poveznice čuvaju jezik, filtre i redoslijed.

## Veličina stranice, SEO i filtri

Odredite broj stavki i po potrebi uključite izbor 10/25/50/100/250. Promjena veličine vraća popis na prvu stranicu. Noindex se primjenjuje tek od druge stranice; provjerite naslov i kanonski URL. Povežite filtre s istim popisom te isprobajte drugu stranicu i filtrirani rezultat na javnom web-mjestu.

## page / count / pager

Za Smarty popis navedite varijablu sa svim stavkama i zadržite petlju `{foreach}`: modul dijeli popis, stoga ne dodajte drugi `array_slice`. Bez varijable dijele se HTML elementi spremnika; možete odrediti klasu retka ili oznaku `tr`, dok `thead` i `tfoot` ostaju na mjestu. Broj gumba oko trenutačne stranice postavite zasebno za računalo i mobitel. Za izravne PHP putanje rabite `?page=2`; `/page/2/` zahtijeva rewrite pravila. Sljedeće stranice imaju vlastiti canonical i mogu dobiti `noindex`.

Ako postoji više neovisnih popisa, prvi koristi `page`, `count` i `sort`, a ostali parametre s ID-jem bloka. Za putanju `/page/N/` parametar `pager` pokazuje kojem popisu pripada broj. U bloku Smarty `$zm_pagination` sadrži `total`, `page`, `pages`, `count` i `offset`. Vrijednost `count` ograničena je na 10–250. Kad je popis prazan ili ima jednu stranicu, navigacija po stranicama se skriva.

## YYYY-MM-DD

Filtri rade nad istim popisom kao straničenje. Tekstualno pretraživanje može provjeravati više polja odvojenih zarezima; raspon datuma koristi `YYYY-MM-DD` i uključuje cijeli posljednji dan.

## Flex / Grid

Odaberite Flex ili Grid te prilagodite širine i stupce po uređajima. Primjena ili poništavanje filtra vraća popis na prvu stranicu. Birač broja rezultata može se premjestiti bez gubitka veze; duplicirana ploča upravlja istim popisom.

## Upute

- Odabir broja stavki: 10, 25, 50, 100, 250
- Nemoj indeksirati stranice od druge nadalje
- Format poveznica
- Zadani broj stavki
