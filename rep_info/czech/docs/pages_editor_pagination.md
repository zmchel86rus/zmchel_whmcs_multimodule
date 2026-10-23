# Stránkování

Klikněte na blok se seznamem. Klávesou Esc výběr zrušíte. Stránkování musí být mimo vybraný blok.

Pro Smarty zadejte proměnnou obsahující celý seznam. Bez proměnné se stránkují prvky HTML v kontejneru; v případě potřeby zadejte třídu řádků nebo značku tr. Odkazy zachovávají count, sort a filtry. Podporovány jsou nezávislé seznamy.

Výběr počtu položek můžete přetáhnout v rámci stránkování i do jiných bloků stránky. Zůstane propojený s tímto stránkováním.

Vyberte blok Smarty se seznamem. Vyhledávání a stránkování musí být propojené se stejným blokem.

Zadejte proměnnou obsahující celý seznam. Vyhledávání kontroluje kterékoli ze zadaných polí a filtry se používají společně. Podmínky se uplatní před výpočtem počtu stránek; použití i resetování filtrů vrátí zobrazení na první stránku. Pokud stránkování již existuje, použije se jeho proměnná.

## Odkazy a zdroj seznamu

Umístěte stránkování mimo blok seznamu a vyberte tento blok jako cíl. U seznamu Smarty zadejte proměnnou se všemi položkami; jinak se dělí HTML prvky kontejneru. Zvolte formát odkazů podle nastavení modulu, `/page/2/` nebo `?page=2`. Formát cesty vyžaduje rewrite pravidla. Nezávislé seznamy používají oddělené parametry; odkazy zachovají jazyk, filtry a řazení.

## Velikost stránky, SEO a filtry

Nastavte počet položek a případně zapněte výběr 10/25/50/100/250. Změna velikosti vrátí seznam na první stránku. Noindex platí až od druhé stránky; zkontrolujte titulek a kanonickou URL. Připojte filtry ke stejnému seznamu a na veřejném webu otestujte druhou stránku i filtrovaný výsledek.

## page / count / pager

Pro seznam Smarty zadejte proměnnou se všemi položkami a ponechte cyklus `{foreach}`: seznam dělí modul, proto nepřidávejte druhý `array_slice`. Bez proměnné se stránkují HTML prvky kontejneru; lze určit třídu řádku nebo značku `tr`, zatímco `thead` a `tfoot` zůstávají. Počet tlačítek kolem aktuální stránky nastavte zvlášť pro počítač a mobil. U přímých tras PHP použijte `?page=2`; `/page/2/` vyžaduje pravidla rewrite. Další stránky mají vlastní canonical a mohou dostat `noindex`.

Při více nezávislých seznamech první používá `page`, `count` a `sort`; ostatní mají parametry s ID bloku. U cesty `/page/N/` parametr `pager` určuje, kterému seznamu číslo patří. V bloku Smarty nabízí `$zm_pagination` hodnoty `total`, `page`, `pages`, `count` a `offset`. Hodnota `count` je omezena na 10–250. Je-li seznam prázdný nebo má jen jednu stránku, stránkovací panel se skryje.

## YYYY-MM-DD

Filtry pracují se stejným seznamem jako stránkování. Textové hledání může kontrolovat více polí oddělených čárkami; rozsah dat používá `YYYY-MM-DD` a zahrnuje celý poslední den.

## Flex / Grid

Zvolte Flex nebo Grid a nastavte šířky a sloupce podle zařízení. Použití nebo vymazání filtru vrátí seznam na první stránku. Volič počtu výsledků lze přesunout bez ztráty vazby; duplicitní panel ovládá stejný seznam.

## Pokyny

- Výběr počtu položek: 10, 25, 50, 100, 250
- Neindexovat stránky od druhé dále
- Formát odkazů
- Výchozí počet položek
