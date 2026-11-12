# Mapy stránok

Zapnite mapu stránok a vytvorte súbory XML. Skontrolujte publikované jazykové verzie v sitemap_index.xml; ak aktualizácie chýbajú, overte WHMCS cron a práva na zápis.

## XML

XML obsahuje vzájomné odkazy pre aktívne jazyky a `x-default` pre adresu predvoleného jazyka. Zdroje presmerovaní sa nedostanú do `loc` ani jazykových alternatív; náhradný preklad sa označí skutočným jazykom obsahu. Súbory stránok a príspevkov deklarujú menný priestor XHTML.

Hook `AfterCronJob` porovnáva interval `ZM_PB_SITEMAP_UPDFREQ` s časom posledného úspešného generovania `ZM_PB_SITEMAP_LASTUPD`; keď je mapa vypnutá, nie je dostupné ani ručné generovanie. Jazykové verzie sa vyberajú podľa `lang_active`. Ďalšie časti dostávajú prípony `_2`, `_3` atď. Pri chybe sa obnovia predchádzajúce súbory a čas úspechu zostane rovnaký. Skontrolujte zápis do koreňa, `resources/` a `inc/editable_consts.php`; tabuľky sa opravujú zvlášť v databáze modulu.

Automatické generovanie závisí od cronu WHMCS a nastaveného intervalu; tlačidlo ho spustí ihneď. Zahrnuté sú iba zverejnené stránky a príspevky dostupné hosťom spolu s aktívnymi prekladmi. Ak stránka nahrádza systémovú stránku, použije sa verejná URL systémovej stránky, nie slug náhradnej stránky. Súbory s viac než 50 000 URL alebo 50 MB sa rozdelia. Index zachová ostatné platné mapy webu.

Modul zapisuje do koreňa webu `sitemap_index.xml`, `sitemap_pages.xml` a `sitemap_posts.xml`; prázdna kategória nevytvorí súbor. Nevytvára spoločný `sitemap.xml`. Po zmene stránok alebo jazykov mapy vygenerujte znova a otvorte index v prehliadači. Pri chybe skontrolujte právo zápisu do koreňa; čas posledného úspešného generovania sa nemení.
