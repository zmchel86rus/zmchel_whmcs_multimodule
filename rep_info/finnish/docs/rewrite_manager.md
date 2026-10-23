# Uudelleenkirjoitussäännöt

## .htaccess

Avaa hallinta ja vertaa sääntöjä sivuston pääasialliseen `.htaccess`-tiedostoon. Tallenna oman sääntösi URL-malli, kohde ja liput; valitse sitten **Lisää tai päivitä säännöt**, jotta lohko kirjoitetaan ennen WHMCS:n sääntöjä. Tarkista tila uudelleen ja avaa julkaistu sivu oletuskielellä sekä toisella kielellä. Liian laaja malli voi vaikuttaa muihin sivuihin. Nginx → Apache -kokoonpanossa säännöt koskevat vain Apachelle välitettyjä pyyntöjä.

## Ohjeet

- Kielikohtaisten URL-osoitteiden säännöt, mukaan lukien /ru/-, /en/- ja muut kielietuliitteet. Kielet haetaan tiedostosta supported_langs.php; säännöt lisätään .htaccess-tiedostoon ennen WHMCS:n sääntöjä.
- Nginx ei lue .htaccess-tiedostoa, joten nämä säännöt eivät toimi siinä. Määritä vastaavat säännöt nginx-palvelimeen.
- Nginx → Apache -kokoonpano havaittu. Nämä säännöt toimivat vain Apachelle välitetyissä pyynnöissä; nginx ei lue .htaccess-tiedostoa.
- Tarkista säännöt
- Lisää tai päivitä säännöt
- Poista kaikki säännöt .htaccess-tiedostosta
- URL-malli
- Kohde
- Liput
- Kun olet lisännyt tai poistanut säännön, ota muutokset käyttöön .htaccess-tiedostossa valitsemalla ”Lisää tai päivitä säännöt”.

## 1. Asennus ja käyttöoikeudet

Ota lisämoduuli käyttöön WHMCS:ssä ja myönnä pääsy tarvittaville ylläpitäjille. Tarkista vaaditut taulut moduulin tietokantatyökalulla. Käy läpi siistit URL-osoitteet, kielireitit ja valikkopaikat. Apache käyttää .htaccess-tiedostoa; Nginxissä vastaavat säännöt määritetään erikseen.
