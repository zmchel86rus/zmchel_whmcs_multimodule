# zmchel WHMCS Multimodule: bruksanvisning

**zmchel WHMCS Multimodule er gratis.** Den inneholder en visuell sideredigerer, flerspråklig innhold, menyer, mediebibliotek, SEO-felt, XML-nettstedskart, viderekoblinger, omskrivingsregler og import/eksport.

## Før første bruk

**Før første bruk åpner du Modulinnstillinger → Støttede språk og aktiverer språkene du trenger.**

Ved hver aktivering genererer modulen automatisk nye salter og skriver dem til `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Kontroller at alle de tre saltverdiene er fylt ut.

## Testet kompatibilitet og funksjon

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Kompatibilitet med webservere

Apache støttes fullt ut. Modulen kan også fungere med Nginx, men språkruting på forsiden kan kreve ekstra oppsett.

## Modulinnstillinger

Velg språkene modulen kan bruke. Deaktivering sletter ikke innholdet.

- **Modulinnstillinger → Støttede språk → Aktiver**
- **Moduldatabase → Rett opp Valgte elementer**
- **Omskrivingsregler → Kontroller regler → Legg til eller oppdater regler**

Nginx leser ikke .htaccess, så disse reglene fungerer ikke der. Konfigurer tilsvarende regler i nginx.

## Sideadministrator

- **Legg til side → Sidenavn → Sideslug → Lagre**
- **Sideredigerer → Innholdsinnstillinger → Metadatainnstillinger → Innstillinger for sidens nettstedskart → Lagre alle**
- **Sideadministrator → Besøk**
- **Nettstedskart → Generer nettstedskart**

Bare latinske bokstaver, bindestreker og sifre er tillatt.

Innloggede brukere: bare innloggede brukere har tilgang til siden; Gjester: bare gjester har tilgang; Blandet: alle har tilgang, men synligheten styres av blokker på siden.

Automatisk generering kjøres etter WHMCS cron når det er tid for en oppdatering. Manuell generering starter umiddelbart.

## Veiledninger for hver seksjon

- [Sideadministrator](docs/pages_manager.md)
- [Sideredigerer](docs/pages_editor.md)
- [Mediebehandling](docs/media_manager.md)
- [Menyer](docs/menu_manager.md)
- [Språkbehandling](docs/langs_manager.md)
- [Viderekoblinger](docs/redirects_manager.md)
- [Nettstedskart](docs/sitemap_manager.md)
- [Omskrivingsregler](docs/rewrite_manager.md)
- [Modulinnstillinger](docs/module_settings.md)
- [Moduldatabase](docs/module_db.md)

## Tilleggsmateriale

- [Paginering](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [Strukturerte data](docs/module_structured_data.md)
- [Import og eksport](docs/module_settings_transfer.md)
