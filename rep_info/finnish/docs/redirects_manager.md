# Uudelleenohjaukset

Tarkat osoitteet: lähde → kohde. Lähde on polku sivuston juuresta tai tämän sivuston URL-osoite. Kohde on polku tai täydellinen HTTP(S)-URL-osoite. Sääntö, jossa ei ole kyselyparametreja, vastaa myös niitä sisältäviä pyyntöjä; kohdetta käytetään annetussa muodossa. Säännöt koskevat WHMCS:ään saapuvia GET/HEAD-pyyntöjä.

Oletus: 14 päivää. Lasketaan julkaistun sivun tai sen aktiivisten käännösten viimeisimmästä muutoksesta; jos muutoksia ei ole, luontipäivästä. Aseta arvoksi 0, jos viivettä ei tarvita. Automaattiset säännöt käyttävät HTTP 301 -uudelleenohjausta.

Korvaavien sivujen osoitteet ohjaavat automaattisesti korvattaville järjestelmäsivuille. Jos korvaavalle sivulle on määritetty useita kohteita, käytetään ensimmäistä. Nämä uudelleenohjaukset toimivat aina, kun sivujen korvaukset ovat käytössä, uudelleenohjausten hallinnan säännöistä riippumatta.

Anna kelvollinen polku, joka alkaa merkillä /, tai täydellinen HTTP(S)-URL-osoite. Lähteen on kuuluttava tähän sivustoon; #-fragmentteja ei tueta.

Anna vanha ja uusi URL-osoite. Käytä pysyvään siirtoon 301:tä ja tilapäiseen 302:ta; testaa lähdeosoite ja vältä ohjausta samaan osoitteeseen.

## HTTP

Säännöt tukevat HTTP-koodeja `301`, `302`, `303`, `307` ja `308` ja koskevat vain WHMCS:ään päätyviä `GET`/`HEAD`-pyyntöjä. Lähde täsmäytetään tarkasti polun ja annettujen kyselyparametrien perusteella; kohteen parametrit korvaavat vanhat. Hallinta tallentaa säännöt tauluun `zm_pb_redirects`, mutta ei luo taulua pyynnön aikana: käytä **Moduulin tietokanta** -osiota. Nykyisten URL-sarakkeiden raja on 128 tavua.

Käsin lisätyt säännöt ovat automaattisia tärkeämpiä. Julkaistun sivun slugin muutos voi määrätyn viiveen jälkeen luoda automaattisen `301`-ohjauksen kullekin aktiiviselle kielelle; luonnoksen julkaisu ei tee niin. Myöhemmät nimenmuutokset päivittävät vanhojen sääntöjen kohteet. Kyselyparametreja sisältävä sääntö ohittaa pelkkää polkua koskevan säännön. Lähde-URL:n on kuuluttava tähän sivustoon eikä siinä saa olla `#`-katkelmaa.

## Ohjeet

- Lähde
- Kohde
- Käytössä
- Pois käytöstä
