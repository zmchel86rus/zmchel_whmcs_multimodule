# zmchel WHMCS Multimodule: juhend

**Enne mooduli kasutamist genereeri unikaalsed soolad ja lisa need faili `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` ja `ZM_PB_NONCE_SALT`.

**Enne esimest kasutuskorda ava Mooduli seaded → Toetatud keeled ja lülita vajalikud keeled sisse.**

Moodul on loodud ja testitud **WHMCS-i versioonidel 8.13.1–8.13.7**. PHP ühilduvust on kontrollitud versioonidel **7.4–8.5**. Apache on täielikult toetatud. Moodul võib töötada ka Nginxiga, kuid keelte suunamine avalehel võib vajada lisaseadistust.

**zmchel WHMCS Multimodule on tasuta.** See sisaldab visuaalset leheredaktorit, mitmekeelset sisu, menüüsid, meediakogu, SEO välju, XML-saidikaarte, ümbersuunamisi, ümberkirjutusreegleid ning importi ja eksporti.

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
