# Handleiding voor zmchel WHMCS Multimodule

**Genereer vóór gebruik unieke salts en vul ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT en ZM_PB_NONCE_SALT in module_init.php in.** De module is ontwikkeld en getest met WHMCS 8.13.1–8.13.7. Apache wordt volledig ondersteund. Nginx kan werken, maar taalroutering op de startpagina vereist mogelijk extra configuratie.

**Open vóór het eerste gebruik Module-instellingen → Ondersteunde talen en schakel de talen in die je nodig hebt.**

**Gecontroleerde PHP-versies:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 en 8.5.

**zmchel WHMCS Multimodule is gratis.** Beheer pagina's en artikelen vanuit de WHMCS-administratie, met een visuele editor, vertalingen, menu's, mediabestanden, SEO-velden, XML-sitemaps, omleidingen en herschrijfregels.

## Module-instellingen

Kies welke talen de module kan gebruiken. Uitschakelen verwijdert de inhoud niet.

- **Module-instellingen → Ondersteunde talen → Inschakelen**
- **Moduledatabase → Herstellen Geselecteerde items**
- **Herschrijfregels → Regels controleren → Regels toevoegen of bijwerken**

Nginx leest .htaccess niet, dus deze regels werken daar niet. Configureer gelijkwaardige regels in nginx.

## Paginabeheerder

- **Pagina toevoegen → Paginanaam → Paginaslug → Opslaan**
- **Pagina-editor → Inhoudsinstellingen → Metadata-instellingen → Sitemapinstellingen voor pagina → Alles opslaan**
- **Paginabeheerder → Bezoeken**
- **Sitemap → Sitemaps genereren**

Alleen Latijnse letters, koppeltekens en cijfers zijn toegestaan.

Ingelogde gebruikers: alleen ingelogde gebruikers hebben toegang tot de pagina; Gasten: alleen gasten hebben toegang; Gemengd: iedereen heeft toegang, waarbij de zichtbaarheid wordt geregeld door blokken op de pagina.

Automatische generatie vindt na de WHMCS-crontaak plaats wanneer een update nodig is. Handmatige generatie begint direct.

## Handleidingen per onderdeel

- [Paginabeheerder](docs/pages_manager.md)
- [Pagina-editor](docs/pages_editor.md)
- [Mediabeheer](docs/media_manager.md)
- [Menu's](docs/menu_manager.md)
- [Talenbeheer](docs/langs_manager.md)
- [Omleidingen](docs/redirects_manager.md)
- [Sitemaps](docs/sitemap_manager.md)
- [Herschrijfregels](docs/rewrite_manager.md)
- [Module-instellingen](docs/module_settings.md)
- [Moduledatabase](docs/module_db.md)

## Aanvullend materiaal

- [Paginering en filters](docs/pages_editor_pagination.md)
- [Smarty en variabelen](docs/pages_editor_smarty.md)
- [Gestructureerde gegevens](docs/module_structured_data.md)
- [Import en export](docs/module_settings_transfer.md)
