# Uudelleenkirjoitussäännöt

## .htaccess

Avaa hallinta ja vertaa sääntöjä sivuston pääasialliseen `.htaccess`-tiedostoon. Tallenna oman sääntösi URL-malli, kohde ja liput; valitse sitten **Lisää tai päivitä säännöt**, jotta lohko kirjoitetaan ennen WHMCS:n sääntöjä. Tarkista tila uudelleen ja avaa julkaistu sivu oletuskielellä sekä toisella kielellä. Liian laaja malli voi vaikuttaa muihin sivuihin. Nginx → Apache -kokoonpanossa säännöt koskevat vain Apachelle välitettyjä pyyntöjä.

## 1. Asennus ja käyttöoikeudet

Ota lisämoduuli käyttöön WHMCS:ssä ja myönnä pääsy tarvittaville ylläpitäjille. Tarkista vaaditut taulut moduulin tietokantatyökalulla. Käy läpi siistit URL-osoitteet, kielireitit ja valikkopaikat. Apache käyttää .htaccess-tiedostoa; Nginxissä vastaavat säännöt määritetään erikseen.
