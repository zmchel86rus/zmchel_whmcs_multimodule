[![Tagasubaybay](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=Tagasubaybay)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Bituin](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Bituin)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Mga fork](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Mga%20fork)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Mga isyu](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=Mga%20isyu)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Gabay sa zmchel WHMCS Multimodule

**Libre ang zmchel WHMCS Multimodule.** Sa admin ng WHMCS, maaari kang gumawa ng mga pahina gamit ang visual na editor, maghanda ng nilalaman sa maraming wika, at pamahalaan ang mga menu, media, SEO metadata, XML sitemap, redirect, rewrite rule, at pag-import o pag-export ng datos.

## Bago unang gamitin

**Buksan ang Module settings → Supported languages at paganahin ang lahat ng wikang kailangan mo.** Hindi binubura ang nilalaman kapag pinatay ang isang wika.

Sa bawat pag-activate, gumagawa ang module ng bagong mga salt at isinusulat ang mga ito sa module_init.php: ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT, at ZM_PB_NONCE_SALT. Tiyaking may halaga ang tatlo.

## Nasubok na pagkakatugma at paggana

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3 at 4

## Pagkakatugma sa web server

Ganap na suportado ang Apache. Maaari ring gumana ang Nginx, ngunit maaaring mangailangan ng karagdagang configuration at pagsusuri ang routing ng wika sa home page.

## Mga setting ng module

Piliin ang mga wikang gagamitin, anyo ng URL, at language routing. Sa Apache, suriin at ilapat ang mga tuntunin sa Rewrite Manager. Hindi binabasa ng Nginx ang .htaccess, kaya kailangan ang katumbas na configuration sa server. Subukan ang nailathalang pahina sa default na wika at sa isa pang aktibong wika.

## Pamamahala ng mga pahina

Gumawa ng pahina na may panloob na pangalan at slug na binubuo ng mga letrang Latin, numero, at gitling. Piliin ang wika at kung para ito sa naka-login, bisita, o lahat. I-save, idagdag ang nilalaman at metadata sa Page Editor, saka i-publish at buksan ang pampublikong URL. I-generate ang sitemap nang manu-mano o hintayin ang naka-iskedyul na WHMCS cron.

## Mga gabay sa bawat seksyon

- [Page Manager](docs/pages_manager.md)
- [Page Editor](docs/pages_editor.md)
- [Media Manager](docs/media_manager.md)
- [Mga menu](docs/menu_manager.md)
- [Language Manager](docs/langs_manager.md)
- [Mga redirect](docs/redirects_manager.md)
- [Mga sitemap](docs/sitemap_manager.md)
- [Rewrite Manager](docs/rewrite_manager.md)
- [Mga setting ng module](docs/module_settings.md)
- [Database ng module](docs/module_db.md)

## Karagdagang dokumentasyon

- [Pagination at mga filter](docs/pages_editor_pagination.md)
- [Smarty at talaan ng variable](docs/pages_editor_smarty.md)
- [Structured data ng Schema.org](docs/module_structured_data.md)
- [Pag-import at pag-export](docs/module_settings_transfer.md)
