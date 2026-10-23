# Moduulin asetukset

- [Tuonti ja vienti](module_settings_transfer.md)

## Ohjeet

- Valitse moduulin käyttämät kielet. Kielen poistaminen käytöstä ei poista sen sisältöä.
- Jos käytät Apachella selkokielisiä URL-osoitteita, päivitä uudelleenkirjoitussäännöt kielimuutosten jälkeen.
- **Siistit URL-osoitteet** — Ota siistit URL-osoitteet käyttöön, myös järjestelmän URL-osoitteissa.
- **Kielikohtainen reititys** — Ota kielireitit käyttöön tai poista ne käytöstä. Kun asetus on käytössä, sivut ovat saatavilla osoitteissa /de/, /en/, /es/ ja muilla tuetuilla kielietuliitteillä. Kun asetus on pois käytöstä, yksi sivuosoite näyttää sisällön käyttäjälle määritetyllä kielellä.
- **Oletuskielen reitti** — Lisää oletuskielelle oman URL-etuliitteen ja ohjaa moduulin sivut ilman etuliitettä siihen.
- **Ylläpitotila (moduuli)** — Ota moduulin ylläpitotila käyttöön tai poista se käytöstä. Tämä kevyempi tila sallii WHMCS:n hookit ja muiden komponenttien toiminnan, toisin kuin järjestelmän ylläpitotila.
- **Kerää Smarty-muuttujat** — Ota Smarty-muuttujien kerääminen käyttöön tai poista se käytöstä.
- **Käytä kerättyjä Smarty-muuttujia** — Ota kerättyjen Smarty-muuttujien käyttö sivueditorissa käyttöön tai poista se käytöstä.
- **Sivujen korvaukset** — Ota sivujen korvaukset käyttöön tai poista ne käytöstä.
- **Päivitystiheys** — Jos mitään ei ole valittu, sivustokartta päivitetään päivittäin.
- **HTML-sivustokartta** — Kun asetus on käytössä, /html-sitemap näyttää sivustokartan tavallisena HTML-sivuna; sitemap.xml ei muutu.
- **Sivuston ylätunniste** — Mukautettu HTML <head>-osioon, mukaan lukien <script> ja <style>.
- **Sivuston alatunniste** — Mukautettu HTML ennen </body>-tagia, mukaan lukien <script> ja <style>.
- **Muokkaa robots.txt-tiedostoa**

## 1. Asennus ja käyttöoikeudet

Ota lisämoduuli käyttöön WHMCS:ssä ja myönnä pääsy tarvittaville ylläpitäjille. Tarkista vaaditut taulut moduulin tietokantatyökalulla. Käy läpi siistit URL-osoitteet, kielireitit ja valikkopaikat. Apache käyttää .htaccess-tiedostoa; Nginxissä vastaavat säännöt määritetään erikseen.
