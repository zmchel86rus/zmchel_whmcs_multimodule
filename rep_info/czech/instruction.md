# zmchel WHMCS Multimodule: návod

**Před použitím modulu vygenerujte jedinečné soli a vložte je do `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` a `ZM_PB_NONCE_SALT`.

**Před prvním použitím otevřete Nastavení modulu → Podporované jazyky a zapněte jazyky, které potřebujete.**

Modul byl vyvinut a testován na **WHMCS 8.13.1–8.13.7**. Kompatibilita s PHP byla ověřena pro verze **7.4–8.5**. Apache je plně podporován. Modul může fungovat také na Nginxu, ale směrování jazyků na úvodní stránce může vyžadovat další nastavení.

**zmchel WHMCS Multimodule je zdarma.** Obsahuje vizuální editor stránek, vícejazyčný obsah, nabídky, knihovnu médií, pole SEO, XML mapy webu, přesměrování, pravidla přepisování a import/export.

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
