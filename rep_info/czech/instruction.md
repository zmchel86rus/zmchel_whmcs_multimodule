# zmchel WHMCS Multimodule: návod

**Před použitím modulu vygenerujte jedinečné soli a vložte je do `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` a `ZM_PB_NONCE_SALT`.

Modul byl vyvinut a testován na **WHMCS 8.13.1–8.13.7**; kompatibilita s PHP byla ověřena pro **7.4–8.5**. Apache je plně podporován. Nginx může také fungovat, ale směrování jazyků na úvodní stránce může vyžadovat další nastavení. **Modul je zdarma.**

## Přístup a stránky

V administraci WHMCS otevřete **Addons → zmchel WHMCS Multimodule**. Seznam stránek umožňuje stránky vytvářet, vyhledávat, upravovat a mazat. *Slug* je část adresy za doménou, například `contact` v `/contact/`. Před změnou URL, přesměrování nebo pravidel serveru exportujte nastavení modulu.

Při vytváření stránky zadejte interní název a slug složený z latinských písmen, číslic a pomlček, bez domény a `.php`. Vyberte přístup pro návštěvníky, přihlášené klienty nebo všechny. Poté zvolte stav (koncept, zveřejněno, odloženo nebo koš), typ (stránka, článek či systémová stránka) a jazyky. Výchozí jazyk WHMCS musí být v `supported_langs.php`; modul jej přidá automaticky.

Po uložení stránku otevřete a upravte **hlavní nastavení**, **obsah**, **metadata** a nastavení **mapy webu**. Každý formulář má vlastní tlačítko Uložit; „Uložit vše“ zpracuje všechny. Zkontrolujte potvrzení a veřejnou stránku. Smazání nejprve přesune stránku do koše; trvalé odstranění probíhá v koši.

## Obsah a jazyky

Na kartě Obsah vyberte jazyk a přetáhněte bloky GrapesJS na pracovní plochu. Upravte text, obrázky a možnosti vybraného bloku a daný jazyk uložte. K dispozici jsou sekce, sloupce, tabulky, FAQ, rozbalovací panely, kontaktní formuláře, seznamy, stránkování, zóny pro hosty/klienty a vlastní kód. Strukturu nebo obsah lze zkopírovat do jiného jazyka; před zveřejněním přeložte texty.

Při použití hezkých URL a jazykového směrování používá výchozí jazyk `/contact/`, ostatní prefix jako `/cs/contact/`. V blocích odkazů a tlačítek zapněte přidávání aktuálního jazyka jen u přeložených stránek webu. Vypněte jej pro externí adresy, soubory, `mailto:`, `tel:` a cesty WHMCS bez překladu. Odkazy ověřte ve více jazycích.

## SEO, média a nabídky

U každého jazyka na kartě Metadata vyplňte název, popis, obrázek pro sociální sítě, kanonickou URL, pravidla robots a typ Schema. Zveřejněná nesystémová stránka může být v XML mapě webu. Ve Správci médií nahrajte obrázky, doplňte smysluplný alternativní text a po optimalizaci ověřte kvalitu.

Ve Správci nabídek vytvořte nabídku, přidejte stránky nebo vlastní odkazy, seřaďte položky a nastavte umístění a viditelnost. Každé umístění může mít jen jednu nabídku. Chcete-li nahradit stránku WHMCS, nejprve novou stránku zveřejněte, v seznamu nastavte náhradu a původní URL WHMCS otestujte jako host i přihlášený klient.

## Nástroje webu

Ve Správci přesměrování zadejte zdroj a cíl: `301` pro trvalý přesun, `302` pro dočasný. Správce přepisování řídí pravidla hezkých URL. Vygenerujte mapy webu a zkontrolujte `sitemap_index.xml`. Nastavení modulu ovládá také nabídky, Smarty, údržbu a import/export. Export JSON nenahrazuje úplnou zálohu WHMCS.

Kontaktní formulář může odeslat tiket WHMCS nebo e-mail. Nastavte pole, adresáta nebo oddělení podpory, souhlasy a CAPTCHA a proveďte skutečný zkušební odesílání. Pokud chybí tabulky modulu, použijte sekci Databáze modulu.

## Další dokumentace (English)

[Nabídky](../english/docs/menus.md) · [Smarty](../english/docs/smarty.md) · [Stránkování](../english/docs/pagination.md) · [Mapy webu](../english/docs/sitemaps.md) · [Přesměrování](../english/docs/redirects.md) · [Strukturovaná data](../english/docs/structured-data.md) · [Import a export](../english/docs/transfer.md).
