# Mapy webu

Automatické generování se spouští po cronu WHMCS, když nastane čas aktualizace. Ruční generování se spustí okamžitě.

Zahrnuty jsou aktivní stránky a příspěvky dostupné hostům, včetně jejich publikovaných jazykových verzí. Nahrazované stránky používají veřejné URL stránek, které nahrazují.

Je-li povoleno, /html-sitemap zobrazí mapu webu jako běžnou stránku HTML; soubor sitemap.xml zůstane beze změny.

## XML

XML obsahuje vzájemné odkazy pro aktivní jazyky a `x-default` pro adresu výchozího jazyka. Zdroje přesměrování se neuvádějí v `loc` ani jazykových alternativách; náhradní překlad se označí skutečným jazykem obsahu. Soubory stránek a příspěvků deklarují jmenný prostor XHTML.

Hook `AfterCronJob` porovnává interval `ZM_PB_SITEMAP_UPDFREQ` s časem posledního úspěšného generování `ZM_PB_SITEMAP_LASTUPD`; při vypnuté mapě není dostupné ani ruční generování. Jazykové verze se vybírají podle `lang_active`, nikoli `lang_status`. Další části dostávají přípony `_2`, `_3` a další. Při chybě se předchozí soubory obnoví a čas úspěchu zůstane stejný. Zkontrolujte zápis do kořene webu, `resources/` a `inc/editable_consts.php`; tabulky se opravují zvlášť v databázi modulu.

Automatické generování závisí na cronu WHMCS a nastaveném intervalu; tlačítko jej spustí ihned. Do mapy patří jen zveřejněné stránky a příspěvky dostupné hostům včetně aktivních překladů. Pokud stránka nahrazuje systémovou stránku, použije se veřejná URL systémové stránky, nikoli slug náhrady. Soubory přes 50 000 URL nebo 50 MB se rozdělí. Index zachová další platné mapy webu.

Modul zapisuje do kořene webu soubory `sitemap_index.xml`, `sitemap_pages.xml` a `sitemap_posts.xml`; prázdná kategorie soubor nevytvoří. Souhrnný `sitemap.xml` se negeneruje. Po změně stránek nebo jazyků mapy vytvořte znovu a otevřete index v prohlížeči. Při chybě ověřte právo zápisu do kořene webu; čas posledního úspěšného generování se nemění.

## Pokyny

- Generovat mapy webu
- Soubory v kořenovém adresáři webu
- Poslední úspěšné generování
- Další aktualizace nejdříve
- Pokud nic nevyberete, mapa webu se aktualizuje denně.
- **Frekvence aktualizace** — Je-li prázdné, výchozí hodnota je 'monthly'.
- **Priorita aktualizace** — Je-li prázdné, výchozí hodnota je '0.5'.
