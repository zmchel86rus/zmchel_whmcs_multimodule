# Návod pre zmchel WHMCS Multimodule

**Pred použitím vytvorte jedinečné soli a vložte ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT a ZM_PB_NONCE_SALT do module_init.php.** Modul bol vyvinutý a testovaný s WHMCS 8.13.1–8.13.7. Apache je plne podporovaný. Nginx môže fungovať, ale jazykové smerovanie na úvodnej stránke môže vyžadovať ďalšie nastavenie.

**Overené verzie PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 a 8.5.

**zmchel WHMCS Multimodule je bezplatný.** Umožňuje spravovať stránky a články v administrácii WHMCS pomocou vizuálneho editora, prekladov, ponúk, knižnice médií, polí SEO, máp stránok XML, presmerovaní a pravidiel prepisovania URL.

## 1. Inštalácia a prístup

Aktivujte doplnkový modul vo WHMCS a udeľte prístup oprávneným administrátorom. V databázovej sekcii modulu skontrolujte potrebné tabuľky. Prezrite si pekné URL, jazykové trasy a umiestnenie ponúk. Apache používa .htaccess; pre Nginx nastavte príslušné serverové pravidlá samostatne.

## 2. Vytvorenie stránky

Otvorte zoznam stránok a pridajte stránku. Zadajte interný názov a slug z latinských písmen, číslic a spojovníkov, napríklad about-us. Vyberte prístup pre všetkých, iba pre prihlásených klientov alebo iba pre hostí. Nastavte stav a jazyky. Predvolený jazyk WHMCS musí modul podporovať.

## 3. Úprava obsahu

Pre každý jazyk vyplňte karty Obsah, Metadáta a Mapa stránok. Presuňte bloky do editora, upravte text a obrázky a uložte každú kartu. Kopírovanie s obsahom vytvorí východisko; kopírovanie štruktúry pripraví rozloženie na preklad. Text sa neprekladá automaticky.

## 4. Odkazy a publikovanie

Pri odkazoch na preložené stránky modulu zapnite pridávanie aktuálneho jazyka do URL. Vypnite ho pre externé adresy, e-mail a trasy WHMCS bez jazykových verzií. Po publikovaní skontrolujte stránku ako hosť aj klient, na počítači a telefóne, aspoň v dvoch jazykoch.

## 5. Správa a údržba

Správca ponúk riadi navigáciu a správca médií obrázky. Správca presmerovaní vytvára pravidlá 301 a 302. Mapa stránok generuje súbory XML. Pred väčšími zmenami exportujte nastavenia; po zmene pravidiel prepisovania ich znova použite a skontrolujte mapu stránok.

## Podrobnejšie témy

- [Ponuky](docs/menus.md)
- [Stránkovanie a filtre](docs/pagination.md)
- [Presmerovania](docs/redirects.md)
- [Mapy stránok](docs/sitemaps.md)
- [Smarty a premenné](docs/smarty.md)
- [Štruktúrované údaje](docs/structured-data.md)
- [Import a export](docs/transfer.md)
