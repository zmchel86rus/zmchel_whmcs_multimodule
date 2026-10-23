# Editor stránek

- [Stránkování](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [Strukturovaná data](module_structured_data.md)

## Obsah a jazyky

Na kartě Obsah vyberte jazyk a přetáhněte bloky GrapesJS na pracovní plochu. Upravte text, obrázky a možnosti vybraného bloku a daný jazyk uložte. K dispozici jsou sekce, sloupce, tabulky, FAQ, rozbalovací panely, kontaktní formuláře, seznamy, stránkování, zóny pro hosty/klienty a vlastní kód. Strukturu nebo obsah lze zkopírovat do jiného jazyka; před zveřejněním přeložte texty.

Při použití hezkých URL a jazykového směrování používá výchozí jazyk `/contact/` jen při vypnuté volitelné trase výchozího jazyka, ostatní prefix jako `/cs/contact/`. V blocích odkazů a tlačítek zapněte přidávání aktuálního jazyka jen u přeložených stránek webu. Vypněte jej pro externí adresy, soubory, `mailto:`, `tel:` a cesty WHMCS bez překladu. Odkazy ověřte ve více jazycích.

## WHMCS

V základním nastavení zkontrolujte název, slug, typ, stav, přístup a jazyky. Výchozí jazyk WHMCS musí být v modulu zapnutý; zveřejněná stránka potřebuje obsah v zobrazovaném jazyce.

## SEO

Pro každý jazyk vyplňte titulek a popis a ověřte canonical, robots, Open Graph, drobečkovou navigaci a Schema. Na kartě mapy webu nastavte frekvenci a prioritu veřejné nesystémové stránky. Uložte a zkontrolujte veřejnou URL a XML.

## Kontaktní formulář

Přidejte blok **Kontaktní formulář**. Vyberte **požadavek WHMCS** a oddělení podpory, nebo **e-mail** a příjemce; nastavte nadpis, popis, předmět a text tlačítka. Každému poli zadejte název, typ, povinnost a ověření. Požadavek od hosta potřebuje pole s rolemi jména a e-mailu odesílatele. Do rozbalovacího seznamu vložte jednu možnost na řádek, třeba `sales : Prodej`. Pro každý souhlas vytvořte samostatné pole a použijte CAPTCHA nastavenou ve WHMCS. Uložte a odešlete skutečný test jako host; zkontrolujte požadavek či doručení, chyby a vymazání formuláře. Zelený stav editoru doručení nepotvrzuje; při selhání `mail()` nastavte SMTP ve WHMCS.

## Pokyny

- Vnořený kontejner s rozvržením Flex. Přetáhněte dovnitř další bloky.
- Vnořený kontejner s rozvržením CSS Grid. Přetáhněte dovnitř další bloky.
- Vnořený karusel Bootstrap. Přetáhněte dovnitř bloky; každý vytvoří jeden snímek.
- Všechny bloky pod tímto blokem se zobrazují pouze přihlášeným uživatelům. Funguje pouze při smíšeném typu přístupu ke stránce.
- Všechny bloky pod tímto blokem se zobrazují pouze hostům. Funguje pouze při smíšeném typu přístupu ke stránce.
- **Titulek stránky**
- **Meta popis**
- **Kanonická URL**
- **Robots** — index, follow / noindex, nofollow. Určuje indexování.
- **Typ schématu** — Je-li zakázáno, značkování Schema.org JSON se pro tuto stránku nevypisuje.
