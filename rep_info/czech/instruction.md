# zmchel WHMCS Multimodule: návod

**zmchel WHMCS Multimodule je zdarma.** Obsahuje vizuální editor stránek, vícejazyčný obsah, nabídky, knihovnu médií, pole SEO, XML mapy webu, přesměrování, pravidla přepisování a import/export.

## Před prvním použitím

**Před prvním použitím otevřete Nastavení modulu → Podporované jazyky a zapněte jazyky, které potřebujete.**

Při každé aktivaci modul automaticky vytvoří nové soli a zapíše je do `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Ověřte, že jsou vyplněny všechny tři soli.

## Ověřená kompatibilita a funkčnost

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Kompatibilita s webovými servery

Apache je plně podporován. Modul může fungovat také na Nginxu, ale směrování jazyků na úvodní stránce může vyžadovat další nastavení.

## Nastavení modulu

Vyberte jazyky, které může modul používat. Vypnutí jazyka nesmaže jeho obsah.

- **Nastavení modulu → Podporované jazyky → Zapnout**
- **Databáze modulu → Opravit Vybrané položky**
- **Pravidla přepisu URL → Zkontrolovat pravidla → Přidat nebo aktualizovat pravidla**

Nginx nečte soubor .htaccess, proto zde tato pravidla nefungují. Nastavte odpovídající pravidla v nginx.

## Správce stránek

- **Přidat stránku → Název stránky → Slug stránky → Uložit**
- **Editor stránek → Nastavení obsahu → Nastavení metadat → Nastavení mapy webu pro stránku → Uložit vše**
- **Správce stránek → Navštívit**
- **Mapa webu → Generovat mapy webu**

Jsou povolena pouze latinská písmena, pomlčky a číslice.

Přihlášení uživatelé: ke stránce mají přístup pouze přihlášení uživatelé; Hosté: přístup mají pouze hosté; Smíšený: přístup mají všichni, přičemž viditelnost určují bloky uvnitř stránky.

Automatické generování se spouští po cronu WHMCS, když nastane čas aktualizace. Ruční generování se spustí okamžitě.

## Průvodci jednotlivými sekcemi

- [Správce stránek](docs/pages_manager.md)
- [Editor stránek](docs/pages_editor.md)
- [Správce médií](docs/media_manager.md)
- [Nabídky](docs/menu_manager.md)
- [Správce jazyků](docs/langs_manager.md)
- [Přesměrování](docs/redirects_manager.md)
- [Mapy webu](docs/sitemap_manager.md)
- [Pravidla přepisu URL](docs/rewrite_manager.md)
- [Nastavení modulu](docs/module_settings.md)
- [Databáze modulu](docs/module_db.md)

## Další materiály

- [Stránkování](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [Strukturovaná data](docs/module_structured_data.md)
- [Import a export](docs/module_settings_transfer.md)
