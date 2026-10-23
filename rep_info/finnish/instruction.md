# zmchel WHMCS Multimodule -käyttöohje

**Luo ennen käyttöä yksilölliset suolat ja lisää ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT ja ZM_PB_NONCE_SALT tiedostoon module_init.php.** Moduuli on kehitetty ja testattu WHMCS-versioilla 8.13.1–8.13.7. Apachea tuetaan täysin. Nginx voi toimia, mutta etusivun kielireititys saattaa vaatia lisäasetuksia.

**Avaa ennen ensimmäistä käyttöä Moduulin asetukset → Tuetut kielet ja ota tarvitsemasi kielet käyttöön.**

**Tarkistetut PHP-versiot:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 ja 8.5.

**zmchel WHMCS Multimodule on maksuton.** Sillä voi hallita sivuja ja artikkeleita WHMCS:n hallintapaneelissa. Toimintoihin kuuluvat visuaalinen editori, käännökset, valikot, mediakirjasto, SEO-kentät, XML-sivustokartat, uudelleenohjaukset ja URL-uudelleenkirjoitussäännöt.

## Moduulin asetukset

Valitse moduulin käyttämät kielet. Kielen poistaminen käytöstä ei poista sen sisältöä.

- **Moduulin asetukset → Tuetut kielet → Ota käyttöön**
- **Moduulin tietokanta → Korjaa Valitut kohteet**
- **Uudelleenkirjoitussäännöt → Tarkista säännöt → Lisää tai päivitä säännöt**

Nginx ei lue .htaccess-tiedostoa, joten nämä säännöt eivät toimi siinä. Määritä vastaavat säännöt nginx-palvelimeen.

## Sivujen hallinta

- **Lisää sivu → Sivun nimi → Sivun URL-tunniste → Tallenna**
- **Sivueditori → Sisällön asetukset → Metatietojen asetukset → Sivun sivustokartta-asetukset → Tallenna kaikki**
- **Sivujen hallinta → Vieraile**
- **Sivustokartta → Luo sivustokartat**

Vain latinalaiset kirjaimet, yhdysmerkit ja numerot sallitaan.

Kirjautuneet käyttäjät: vain kirjautuneet käyttäjät pääsevät sivulle; Vierailijat: vain kirjautumattomat pääsevät sivulle; Kaikki: kaikki pääsevät sivulle, ja näkyvyyttä säädetään sivun sisäisillä lohkoilla.

Automaattinen luonti käynnistyy WHMCS:n cron-ajon jälkeen, kun päivitys on ajankohtainen. Manuaalinen luonti käynnistyy heti.

## Osioiden oppaat

- [Sivujen hallinta](docs/pages_manager.md)
- [Sivueditori](docs/pages_editor.md)
- [Median hallinta](docs/media_manager.md)
- [Valikot](docs/menu_manager.md)
- [Kielten hallinta](docs/langs_manager.md)
- [Uudelleenohjaukset](docs/redirects_manager.md)
- [Sivustokartat](docs/sitemap_manager.md)
- [Uudelleenkirjoitussäännöt](docs/rewrite_manager.md)
- [Moduulin asetukset](docs/module_settings.md)
- [Moduulin tietokanta](docs/module_db.md)

## Lisämateriaalit

- [Sivutus ja suodattimet](docs/pages_editor_pagination.md)
- [Smarty ja muuttujat](docs/pages_editor_smarty.md)
- [Rakenteinen tieto](docs/module_structured_data.md)
- [Tuonti ja vienti](docs/module_settings_transfer.md)
