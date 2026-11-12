[![Volgers](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=Volgers)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Sterren](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Sterren)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Forks](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Forks)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Meldingen](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=Meldingen)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Handleiding voor zmchel WHMCS Multimodule

**zmchel WHMCS Multimodule is gratis.** Beheer pagina's en artikelen vanuit de WHMCS-administratie, met een visuele editor, vertalingen, menu's, mediabestanden, SEO-velden, XML-sitemaps, omleidingen en herschrijfregels.

## Voor het eerste gebruik

**Open vóór het eerste gebruik Module-instellingen → Ondersteunde talen en schakel de talen in die je nodig hebt.**

Bij elke activering genereert de module automatisch nieuwe salts en schrijft deze naar `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Controleer of alle drie de saltwaarden zijn ingevuld.

## Geteste compatibiliteit en werking

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Compatibiliteit met webservers

Apache wordt volledig ondersteund. Nginx kan werken, maar taalroutering op de startpagina vereist mogelijk extra configuratie.

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
