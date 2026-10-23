# Vejledning til zmchel WHMCS Multimodule

**Generér unikke salts før brug, og indsæt ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT og ZM_PB_NONCE_SALT i module_init.php.** Modulet er udviklet og testet med WHMCS 8.13.1–8.13.7. Apache understøttes fuldt ud. Nginx kan fungere, men sprogruter på forsiden kan kræve ekstra konfiguration.

**Før første brug skal du åbne Modulindstillinger → Understøttede sprog og aktivere de sprog, du har brug for.**

**Kontrollerede PHP-versioner:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 og 8.5.

**zmchel WHMCS Multimodule er gratis.** Administrér sider og artikler fra WHMCS-administrationen med visuel editor, oversættelser, menuer, mediefiler, SEO-felter, XML-sitemaps, viderestillinger og omskrivningsregler.

## Modulindstillinger

Vælg de sprog, modulet kan bruge. Deaktivering sletter ikke indholdet.

- **Modulindstillinger → Understøttede sprog → Aktivér**
- **Moduldatabase → Ret Valgte elementer**
- **Omskrivningsregler → Kontrollér regler → Tilføj eller opdater regler**

Nginx læser ikke .htaccess, så disse regler virker ikke her. Konfigurér tilsvarende regler i nginx.

## Sidemanager

- **Tilføj side → Sidenavn → Sideslug → Gem**
- **Sideeditor → Indholdsindstillinger → Metadataindstillinger → Sidens sitemapindstillinger → Gem alle**
- **Sidemanager → Besøg**
- **Sitemap → Generér sitemaps**

Kun latinske bogstaver, bindestreger og cifre er tilladt.

Brugere, der er logget ind: Kun brugere, der er logget ind, kan tilgå siden; Gæster: Kun gæster kan tilgå den; Blandet: Alle kan tilgå siden, og synligheden styres af blokke på siden.

Automatisk generering kører efter WHMCS-cron, når det er tid til en opdatering. Manuel generering starter med det samme.

## Vejledninger til sektionerne

- [Sidemanager](docs/pages_manager.md)
- [Sideeditor](docs/pages_editor.md)
- [Mediehåndtering](docs/media_manager.md)
- [Menuer](docs/menu_manager.md)
- [Sprogstyring](docs/langs_manager.md)
- [Viderestillinger](docs/redirects_manager.md)
- [Sitemaps](docs/sitemap_manager.md)
- [Omskrivningsregler](docs/rewrite_manager.md)
- [Modulindstillinger](docs/module_settings.md)
- [Moduldatabase](docs/module_db.md)

## Yderligere materiale

- [Sideinddeling og filtre](docs/pages_editor_pagination.md)
- [Smarty og variabler](docs/pages_editor_smarty.md)
- [Strukturerede data](docs/module_structured_data.md)
- [Import og eksport](docs/module_settings_transfer.md)
