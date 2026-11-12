[![Jälgijad](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=J%C3%A4lgijad)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Tähed](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=T%C3%A4hed)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Forkid](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Forkid)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Teated](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=Teated)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule: juhend

**zmchel WHMCS Multimodule on tasuta.** See sisaldab visuaalset leheredaktorit, mitmekeelset sisu, menüüsid, meediakogu, SEO välju, XML-saidikaarte, ümbersuunamisi, ümberkirjutusreegleid ning importi ja eksporti.

## Enne esimest kasutamist

**Enne esimest kasutuskorda ava Mooduli seaded → Toetatud keeled ja lülita vajalikud keeled sisse.**

Igal aktiveerimisel loob moodul automaatselt uued soolad ja kirjutab need faili `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Kontrollige, et kõik kolm soola väärtust oleksid täidetud.

## Kontrollitud ühilduvus ja toimivus

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Ühilduvus veebiserveritega

Apache on täielikult toetatud. Moodul võib töötada ka Nginxiga, kuid keelte suunamine avalehel võib vajada lisaseadistust.

## Mooduli seaded

Valige keeled, mida moodul saab kasutada. Keele väljalülitamine ei kustuta selle sisu.

- **Mooduli seaded → Toetatud keeled → Lülita sisse**
- **Mooduli andmebaas → Paranda Valitud elemendid**
- **Ümberkirjutamise reeglid → Kontrolli reegleid → Lisa või uuenda reegleid**

Nginx ei loe faili .htaccess, seega need reeglid seal ei tööta. Seadistage vastavad reeglid nginxis.

## Lehtede haldur

- **Lisa leht → Lehe nimi → Lehe püsiviide → Salvesta**
- **Leheredaktor → Sisu seaded → Metaandmete seaded → Lehe saidikaardi seaded → Salvesta kõik**
- **Lehtede haldur → Külasta**
- **Saidikaart → Genereeri saidikaardid**

Lubatud on ainult ladina tähed, sidekriipsud ja numbrid.

Sisseloginud kasutajad: lehele pääsevad ligi ainult sisseloginud kasutajad; külalised: lehele pääsevad ligi ainult külalised; segatud: lehele pääsevad ligi kõik, kuid nähtavust juhitakse lehe plokkide kaudu.

Automaatne genereerimine käivitub pärast WHMCS-i croni, kui uuendamise aeg on käes. Käsitsi genereerimine algab kohe.

## Jaotiste juhendid

- [Lehtede haldur](docs/pages_manager.md)
- [Leheredaktor](docs/pages_editor.md)
- [Meediahaldur](docs/media_manager.md)
- [Menüüd](docs/menu_manager.md)
- [Keelehaldur](docs/langs_manager.md)
- [Ümbersuunamised](docs/redirects_manager.md)
- [Saidikaardid](docs/sitemap_manager.md)
- [Ümberkirjutamise reeglid](docs/rewrite_manager.md)
- [Mooduli seaded](docs/module_settings.md)
- [Mooduli andmebaas](docs/module_db.md)

## Lisamaterjalid

- [Lehitsemine](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [Struktureeritud andmed](docs/module_structured_data.md)
- [Import ja eksport](docs/module_settings_transfer.md)
