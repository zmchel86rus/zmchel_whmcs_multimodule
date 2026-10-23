# Stránkovanie a filtre

Kliknite na blok zoznamu. Kláves Esc výber zruší. Stránkovanie umiestnite mimo cieľového bloku.

Pre Smarty zadajte premennú úplného zoznamu. Bez premennej sa stránkujú prvky HTML v kontajneri; voliteľne môžete uviesť triedu riadkov alebo značku tr. Odkazy zachovávajú count, sort a filtre. Podporovaných je viacero nezávislých zoznamov.

Výber počtu položiek na stranu: 10, 25, 50, 100, 250

Presuňte výber počtu položiek na stranu do stránkovania alebo do iných blokov stránky. Zostane prepojený s týmto stránkovaním.

Vyberte blok zoznamu Smarty. Vyhľadávanie a stránkovanie musia byť prepojené s rovnakým blokom.

Zadajte premennú úplného zoznamu. Vyhľadávanie prehľadáva ľubovoľné zo zvolených polí a filtre sa kombinujú. Podmienky sa uplatnia pred výpočtom počtu strán; použitie alebo obnovenie filtrov vás vráti na prvú stranu. Ak je stránkovanie už prepojené, použije sa jeho premenná.

Stránkovanie a filtre pripojte k rovnakému zoznamu. Vyberte počet výsledkov a tvar URL; otestujte druhú stranu a jeden filter.

## Odkazy a zdroj zoznamu

Umiestnite stránkovanie mimo blok zoznamu a vyberte tento blok ako cieľ. Pre zoznam Smarty zadajte premennú so všetkými položkami; inak sa delia HTML prvky kontajnera. Zvoľte formát odkazov podľa nastavenia modulu, `/page/2/` alebo `?page=2`. Cesta vyžaduje rewrite pravidlá. Nezávislé zoznamy používajú oddelené parametre; odkazy zachovajú jazyk, filtre a zoradenie.

## Veľkosť stránky, SEO a filtre

Nastavte počet položiek a prípadne zapnite výber 10/25/50/100/250. Zmena veľkosti vráti zoznam na prvú stránku. Noindex platí až od druhej stránky; skontrolujte názov a kanonickú URL. Pripojte filtre k rovnakému zoznamu a na verejnej stránke otestujte druhú stranu aj filtrovaný výsledok.

## page / count / pager

Pre zoznam Smarty uveďte premennú so všetkými položkami a ponechajte cyklus `{foreach}`: modul zoznam rozdelí, preto nepridávajte druhý `array_slice`. Bez premennej sa stránkujú HTML prvky kontajnera; možno určiť triedu riadku alebo značku `tr`, pričom `thead` a `tfoot` zostanú. Počet tlačidiel okolo aktuálnej stránky nastavte zvlášť pre počítač a mobil. Na priamych trasách PHP použite `?page=2`; `/page/2/` vyžaduje pravidlá rewrite. Ďalšie stránky majú vlastný canonical a môžu dostať `noindex`.

Pri viacerých nezávislých zoznamoch prvý používa `page`, `count` a `sort`; ostatné používajú parametre s ID bloku. Pri ceste `/page/N/` parameter `pager` určuje, ktorému zoznamu číslo patrí. V bloku Smarty `$zm_pagination` poskytuje `total`, `page`, `pages`, `count` a `offset`. `count` sa obmedzuje na 10–250. Ak je zoznam prázdny alebo má len jednu stránku, stránkovací panel sa skryje.

## YYYY-MM-DD

Filtre pracujú s tým istým zoznamom ako stránkovanie. Textové hľadanie môže preveriť viacero polí oddelených čiarkami; rozsah dátumov používa `YYYY-MM-DD` a zahŕňa celý posledný deň.

## Flex / Grid

Vyberte Flex alebo Grid a nastavte šírky a stĺpce podľa zariadenia. Použitie alebo vymazanie filtra vráti zoznam na prvú stránku. Volič počtu výsledkov možno presunúť bez straty väzby; duplicitný panel ovláda ten istý zoznam.

## Pokyny

- Neindexovať stranu 2 a ďalšie
- Formát odkazov
- Predvolený počet položiek na stranu
