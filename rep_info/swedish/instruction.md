[![Följare](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=F%C3%B6ljare)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Stjärnor](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Stj%C3%A4rnor)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Förgreningar](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=F%C3%B6rgreningar)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Ärenden](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%C3%84renden)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule: instruktioner

**zmchel WHMCS Multimodule är gratis.** Den innehåller en visuell sidredigerare, flerspråkigt innehåll, menyer, mediebibliotek, SEO-fält, XML-webbplatskartor, omdirigeringar, omskrivningsregler samt import och export.

## Före första användningen

**Öppna Modulinställningar → Språk som stöds och aktivera de språk du behöver innan du börjar använda modulen.**

Vid varje aktivering skapar modulen automatiskt nya saltvärden och skriver dem till `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Kontrollera att alla tre saltvärden är ifyllda.

## Testad kompatibilitet och funktion

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Kompatibilitet med webbservrar

Apache stöds fullt ut. Modulen kan även fungera med Nginx, men språkstyrningen på startsidan kan kräva ytterligare inställningar.

## Modulinställningar

Välj vilka språk modulen kan använda. Att stänga av ett språk raderar inte innehållet.

- **Modulinställningar → Språk som stöds → Aktivera**
- **Moduldatabas → Åtgärda Valda objekt**
- **Omskrivningsregler → Kontrollera regler → Lägg till eller uppdatera regler**

Nginx läser inte .htaccess, så de här reglerna fungerar inte där. Konfigurera motsvarande regler i nginx.

## Sidhanterare

- **Lägg till sida → Sidnamn → Sidans slug → Spara**
- **Sidredigerare → Innehållsinställningar → Metadatainställningar → Sidans inställningar för webbplatskarta → Spara alla**
- **Sidhanterare → Besök**
- **Webbplatskarta → Generera webbplatskartor**

Endast latinska bokstäver, bindestreck och siffror är tillåtna.

Inloggade användare: endast inloggade användare har åtkomst till sidan; Gäster: endast gäster har åtkomst; Blandad: alla har åtkomst, men synligheten styrs av blocken på sidan.

Automatisk generering körs efter WHMCS cron när det är dags att uppdatera. Manuell generering startar omedelbart.

## Guider för varje avsnitt

- [Sidhanterare](docs/pages_manager.md)
- [Sidredigerare](docs/pages_editor.md)
- [Mediehanterare](docs/media_manager.md)
- [Menyer](docs/menu_manager.md)
- [Språkhanterare](docs/langs_manager.md)
- [Omdirigeringar](docs/redirects_manager.md)
- [Webbplatskartor](docs/sitemap_manager.md)
- [Omskrivningsregler](docs/rewrite_manager.md)
- [Modulinställningar](docs/module_settings.md)
- [Moduldatabas](docs/module_db.md)

## Ytterligare material

- [Sidnumrering](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [Strukturerad data](docs/module_structured_data.md)
- [Import och export](docs/module_settings_transfer.md)
