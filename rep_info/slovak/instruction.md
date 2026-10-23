# Návod pre zmchel WHMCS Multimodule

**Pred použitím vytvorte jedinečné soli a vložte ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT a ZM_PB_NONCE_SALT do module_init.php.** Modul bol vyvinutý a testovaný s WHMCS 8.13.1–8.13.7. Apache je plne podporovaný. Nginx môže fungovať, ale jazykové smerovanie na úvodnej stránke môže vyžadovať ďalšie nastavenie.

**Pred prvým použitím otvorte Nastavenia modulu → Podporované jazyky a zapnite jazyky, ktoré potrebujete.**

**Overené verzie PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 a 8.5.

**zmchel WHMCS Multimodule je bezplatný.** Umožňuje spravovať stránky a články v administrácii WHMCS pomocou vizuálneho editora, prekladov, ponúk, knižnice médií, polí SEO, máp stránok XML, presmerovaní a pravidiel prepisovania URL.

## Nastavenia modulu

Vyberte jazyky, ktoré môže modul používať. Vypnutie jazyka nevymaže jeho obsah.

- **Nastavenia modulu → Podporované jazyky → Zapnúť**
- **Databáza modulu → Opraviť Vybrané položky**
- **Pravidlá prepisovania URL → Skontrolovať pravidlá → Pridať alebo aktualizovať pravidlá**

Nginx nečíta súbor .htaccess, preto tam tieto pravidlá nefungujú. Nastavte zodpovedajúce pravidlá v nginx.

## Správca stránok

- **Pridať stránku → Názov stránky → Slug stránky → Uložiť**
- **Editor stránok → Nastavenia obsahu → Nastavenia metadát → Nastavenia mapy stránok → Uložiť všetko**
- **Správca stránok → Navštíviť**
- **Mapa stránok → Generovať mapy stránok**

Povolené sú iba písmená latinky, spojovníky a číslice.

Prihlásení používatelia: na stránku majú prístup len prihlásení používatelia; Hostia: prístup majú len hostia; Zmiešaný: prístup majú všetci a viditeľnosť riadia bloky na stránke.

Automatické generovanie sa spustí po vykonaní cronu WHMCS, keď nastane čas aktualizácie. Manuálne generovanie sa spustí okamžite.

## Návody podľa sekcií

- [Správca stránok](docs/pages_manager.md)
- [Editor stránok](docs/pages_editor.md)
- [Správca médií](docs/media_manager.md)
- [Ponuky](docs/menu_manager.md)
- [Správca jazykov](docs/langs_manager.md)
- [Presmerovania](docs/redirects_manager.md)
- [Mapy stránok](docs/sitemap_manager.md)
- [Pravidlá prepisovania URL](docs/rewrite_manager.md)
- [Nastavenia modulu](docs/module_settings.md)
- [Databáza modulu](docs/module_db.md)

## Ďalšie materiály

- [Stránkovanie a filtre](docs/pages_editor_pagination.md)
- [Smarty a premenné](docs/pages_editor_smarty.md)
- [Štruktúrované údaje](docs/module_structured_data.md)
- [Import a export](docs/module_settings_transfer.md)
