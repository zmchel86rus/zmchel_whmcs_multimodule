# Stranjenje in filtri

Kliknite blok seznama. Esc prekliče izbiro. Straničenje postavite zunaj ciljnega bloka.

Za Smarty vnesite spremenljivko celotnega seznama. Brez spremenljivke se straničijo elementi HTML vsebnika; po potrebi navedite razred vrstic ali oznako tr. Povezave ohranijo count, sort in filtre. Podprtih je več neodvisnih seznamov.

Izbirnik elementov na stran: 10, 25, 50, 100, 250

Izbirnik števila elementov na stran povlecite v območje straničenja ali v druge bloke strani. Ostane povezan s tem straničenjem.

Izberite blok seznama Smarty. Iskanje in straničenje morata biti povezana z istim blokom.

Navedite spremenljivko celotnega seznama. Iskanje se ujema s katerim koli izbranim poljem, filtri pa se združujejo. Pogoji se uporabijo pred štetjem strani; uporaba ali ponastavitev vrne prikaz na prvo stran. Če je straničenje že povezano, se uporabi njegova spremenljivka.

Stranjenje in filtre povežite z istim seznamom. Izberite število rezultatov in obliko URL-ja; preverite drugo stran in en filter.

## Povezave in vir seznama

Straničenje postavite zunaj bloka seznama in izberite ta blok kot cilj. Za seznam Smarty navedite spremenljivko z vsemi elementi; sicer se razdelijo elementi HTML v vsebniku. Izberite obliko povezav po nastavitvi modula, `/page/2/` ali `?page=2`. Oblika poti zahteva pravila rewrite. Neodvisni seznami uporabljajo ločene parametre; povezave ohranijo jezik, filtre in razvrstitev.

## Velikost strani, SEO in filtri

Določite število elementov in po potrebi vključite izbiro 10/25/50/100/250. Sprememba velikosti vrne seznam na prvo stran. Noindex velja šele od druge strani; preverite naslov in kanonični URL. Filtre povežite z istim seznamom, nato preizkusite drugo stran in filtriran rezultat na javnem spletnem mestu.

## page / count / pager

Za seznam Smarty določite spremenljivko z vsemi elementi in ohranite zanko `{foreach}`: modul seznam razdeli sam, zato ne dodajte drugega `array_slice`. Brez spremenljivke se razdelijo elementi HTML v vsebniku; izberete lahko razred vrstice ali oznako `tr`, `thead` in `tfoot` pa ostaneta. Število gumbov okoli trenutne strani nastavite ločeno za računalnik in telefon. Na neposrednih poteh PHP uporabite `?page=2`; `/page/2/` zahteva rewrite pravila. Naslednje strani imajo svoj canonical in lahko dobijo `noindex`.

Pri več neodvisnih seznamih prvi uporablja `page`, `count` in `sort`, drugi pa parametre z ID-jem bloka. Pri poti `/page/N/` `pager` označuje, kateremu seznamu pripada številka. V bloku Smarty `$zm_pagination` ponuja `total`, `page`, `pages`, `count` in `offset`. `count` se omeji na 10–250. Če je seznam prazen ali ima le eno stran, se plošča za straničenje skrije.

## YYYY-MM-DD

Filtri delujejo na istem seznamu kot straničenje. Iskanje besedila lahko preveri več z vejicami ločenih polj; obseg datumov uporablja `YYYY-MM-DD` in zajame ves zadnji dan.

## Flex / Grid

Izberite Flex ali Grid ter nastavite širine in stolpce glede na napravo. Uporaba ali brisanje filtra vrne seznam na prvo stran. Izbirnik števila rezultatov lahko premaknete brez izgube povezave; podvojena plošča upravlja isti seznam.

## Navodila

- Ne indeksiraj strani od druge naprej
- Oblika povezav
- Privzeto število elementov na stran
