# zmchel WHMCS Multimodule -käyttöohje

**Luo ennen käyttöä yksilölliset suolat ja lisää ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT ja ZM_PB_NONCE_SALT tiedostoon module_init.php.** Moduuli on kehitetty ja testattu WHMCS-versioilla 8.13.1–8.13.7. Apachea tuetaan täysin. Nginx voi toimia, mutta etusivun kielireititys saattaa vaatia lisäasetuksia.

**Avaa ennen ensimmäistä käyttöä Moduulin asetukset → Tuetut kielet ja ota tarvitsemasi kielet käyttöön.**

**Tarkistetut PHP-versiot:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 ja 8.5.

**zmchel WHMCS Multimodule on maksuton.** Sillä voi hallita sivuja ja artikkeleita WHMCS:n hallintapaneelissa. Toimintoihin kuuluvat visuaalinen editori, käännökset, valikot, mediakirjasto, SEO-kentät, XML-sivustokartat, uudelleenohjaukset ja URL-uudelleenkirjoitussäännöt.

## Kielten hallinta (kehitteillä)

Avaa WHMCS:n ylläpidossa Kielten hallinta ja valitse osio (WHMCS:n asiakas- tai ylläpitokielet, tämä moduuli tai muu moduuli) sekä kieli. Vertaa alkuperäistä tai vertailutekstiä käännökseen, muokkaa yhtä riviä ja tallenna se; olemassa olevia avaimia voi myös viedä ja tuoda JSON-tiedostona. Uusi kieli käyttää vertailutekstiä, kunnes se käännetään. Hallinta ottaa kielitiedostoja käyttöön tai poistaa niitä käytöstä ja korjaa vanhoja tiedostonimiä; vaihda oletuskieli ensin WHMCS:ssä.

→ [Kielten hallinta](docs/language-manager.md)

## 1. Asennus ja käyttöoikeudet

Ota lisämoduuli käyttöön WHMCS:ssä ja myönnä pääsy tarvittaville ylläpitäjille. Tarkista vaaditut taulut moduulin tietokantatyökalulla. Käy läpi siistit URL-osoitteet, kielireitit ja valikkopaikat. Apache käyttää .htaccess-tiedostoa; Nginxissä vastaavat säännöt määritetään erikseen.

## 2. Sivun luominen

Avaa sivuluettelo ja lisää uusi sivu. Anna sisäinen nimi ja slug, jossa on latinalaisia kirjaimia, numeroita ja yhdysmerkkejä, esimerkiksi about-us. Valitse pääsy kaikille, vain kirjautuneille asiakkaille tai vain vierailijoille. Valitse tila ja kielet. WHMCS:n oletuskielen täytyy olla moduulin tukema.

## 3. Sisällön muokkaus

Täytä jokaiselle kielelle Sisältö-, Metatiedot- ja Sivustokartta-välilehdet. Vedä lohkoja editoriin, muokkaa tekstiä ja kuvia ja tallenna jokainen välilehti. Kopioi sisällön kanssa antaa pohjan; kopioi rakenne valmistelee asettelun käännöstä varten. Tekstiä ei käännetä automaattisesti.

## 4. Linkit ja julkaisu

Ota nykyisen kielen lisääminen URL-osoitteeseen käyttöön, kun linkki vie moduulin käännetylle sivulle. Poista se käytöstä ulkoisille linkeille, sähköpostiosoitteille ja WHMCS-reiteille, joilla ei ole kieliversioita. Testaa julkaistu sivu vieraana ja asiakkaana, tietokoneella ja puhelimella sekä kahdella kielellä.

## 5. Ylläpito

Valikkojen hallinta ohjaa navigointia ja median hallinta kuvia. Uudelleenohjausten hallinnassa voi lisätä 301- ja 302-sääntöjä. Sivustokarttatyökalu luo XML-tiedostot. Vie asetukset ennen suuria muutoksia; ota muuttuneet URL-säännöt uudelleen käyttöön ja tarkista sivustokartta julkaisun jälkeen.

## Lisäohjeet

- [Valikot](docs/menus.md)
- [Sivutus ja suodattimet](docs/pagination.md)
- [Uudelleenohjaukset](docs/redirects.md)
- [Sivustokartat](docs/sitemaps.md)
- [Smarty ja muuttujat](docs/smarty.md)
- [Rakenteinen tieto](docs/structured-data.md)
- [Tuonti ja vienti](docs/transfer.md)
