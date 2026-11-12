[![Volgers](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=Volgers)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Sterre](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Sterre)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Vertakkings](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Vertakkings)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Kwessies](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=Kwessies)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Gebruiksaanwysings vir zmchel WHMCS Multimodule

**zmchel WHMCS Multimodule is gratis.** Dit laat jou webwerf-inhoud vanuit die WHMCS-administrasie bestuur: 'n visuele bladsy- en blokredigeerder, veeltalige inhoud, kieslyste, 'n mediabiblioteek, SEO-metadata, XML-werfkaarte, herleidings, herskryfreëls en invoer of uitvoer.

## Voor die eerste gebruik

**Open Module settings → Supported languages en aktiveer die tale wat jy nodig het.** Wanneer jy 'n taal deaktiveer, bly die bestaande inhoud behoue.

By elke aktivering skep die module nuwe soute en skryf dit na module_init.php: ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT en ZM_PB_NONCE_SALT. Kontroleer dat al drie ingevul is.

## Getoetste versoenbaarheid en funksionaliteit

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3 en 4

## Webbedienerversoenbaarheid

Apache word ten volle ondersteun. Nginx kan ook werk, maar taalroetes op die tuisblad kan ekstra opstelling en toetsing vereis.

## Module-instellings

Kies die tale, URL-formaat en taalroetes. Kontroleer en pas die reëls in Rewrite Manager toe wanneer jy Apache gebruik. Nginx lees nie .htaccess nie en benodig ooreenstemmende bedienerreëls. Toets daarna 'n gepubliseerde bladsy in die verstektaal en in nog 'n aktiewe taal.

## Bladsybestuur

Skep 'n bladsy met 'n interne naam en 'n slug wat net Latynse letters, syfers en koppeltekens gebruik. Kies tale en toegang vir aangemelde gebruikers, gaste of almal. Stoor die bladsy, voeg inhoud en metadata in die redigeerder by, publiseer dit en besoek die openbare URL. Genereer die werfkaart self of wag vir die geskeduleerde WHMCS-taak.

## Afdelingsgidse

- [Bladsybestuurder](docs/pages_manager.md)
- [Bladsyredigeerder](docs/pages_editor.md)
- [Mediabestuurder](docs/media_manager.md)
- [Kieslyste](docs/menu_manager.md)
- [Taalbestuurder](docs/langs_manager.md)
- [Herleidings](docs/redirects_manager.md)
- [Werfkaarte](docs/sitemap_manager.md)
- [Rewrite Manager](docs/rewrite_manager.md)
- [Module-instellings](docs/module_settings.md)
- [Module-databasis](docs/module_db.md)

## Verdere dokumentasie

- [Paginering en filters](docs/pages_editor_pagination.md)
- [Smarty en versamelde veranderlikes](docs/pages_editor_smarty.md)
- [Gestruktureerde Schema.org-data](docs/module_structured_data.md)
- [Invoer en uitvoer](docs/module_settings_transfer.md)
