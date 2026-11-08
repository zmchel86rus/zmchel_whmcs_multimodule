# Moduulin asetukset

Ota ensin tarvittavat kielet käyttöön. Valitse sitten URL-muoto ja kielireititys ja tallenna asetukset. Jos reitit muuttuvat, päivitä Apachen säännöt Rewrite Managerissa tai vastaava Nginx-asetus. Tarkista moduulin sivu oletuskielellä ja toisella käytössä olevalla kielellä. Vie varmuuskopio ennen suuria muutoksia tai tuontia.

- [Tuonti ja vienti](module_settings_transfer.md)

## 1. Asennus ja käyttöoikeudet

Ota lisämoduuli käyttöön WHMCS:ssä ja myönnä pääsy tarvittaville ylläpitäjille. Tarkista vaaditut taulut moduulin tietokantatyökalulla. Käy läpi siistit URL-osoitteet, kielireitit ja valikkopaikat. Apache käyttää .htaccess-tiedostoa; Nginxissä vastaavat säännöt määritetään erikseen.
