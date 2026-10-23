# Sivustokartat

Automaattinen luonti käynnistyy WHMCS:n cron-ajon jälkeen, kun päivitys on ajankohtainen. Manuaalinen luonti käynnistyy heti. Mukana ovat vierailijoille näkyvät aktiiviset sivut ja artikkelit sekä niiden julkaistut kieliversiot. Korvaavat sivut käyttävät korvaamiensa sivujen julkisia URL-osoitteita. Kun asetus on käytössä, /html-sitemap näyttää sivustokartan tavallisena HTML-sivuna; sitemap.xml ei muutu. Ota sivustokartta käyttöön ja luo XML-tiedostot. Tarkista julkaistut kieliversiot tiedostosta sitemap_index.xml; jos päivitys puuttuu, tarkista WHMCS:n cron ja kirjoitusoikeudet.



## XML

XML sisältää aktiivisten kielten vastavuoroiset linkit ja oletuskielen osoitteelle `x-default`-merkinnän. Uudelleenohjausten lähteitä ei lisätä `loc`-kenttään eikä kielivaihtoehtoihin; varakäännös merkitään sisällön todellisella kielellä. Sivu- ja artikkelitiedostot määrittävät XHTML-nimiavaruuden.

`AfterCronJob`-hook vertaa aikaväliä `ZM_PB_SITEMAP_UPDFREQ` viimeisen onnistuneen luonnin aikaan `ZM_PB_SITEMAP_LASTUPD`; jos sivustokartta on pois käytöstä, myös manuaalinen luonti on estetty. Kieliversiot valitaan `lang_active`-kentän, ei `lang_status`-kentän perusteella. Lisäosat saavat päätteet `_2`, `_3` ja niin edelleen. Virhetilanteessa aiemmat tiedostot palautetaan eikä onnistumisaika muutu. Tarkista kirjoitusoikeudet juureen, `resources/`-hakemistoon ja `inc/editable_consts.php`-tiedostoon; taulut korjataan erikseen moduulin tietokannassa.

Automaattinen luonti riippuu WHMCS:n cronista ja asetetusta aikavälistä; painike käynnistää sen heti. Mukaan tulevat vain vieraille näkyvät julkaistut sivut ja artikkelit sekä niiden aktiiviset käännökset. Jos sivu korvaa järjestelmäsivun, käytetään järjestelmäsivun julkista URL-osoitetta eikä korvaavan sivun slugia. Yli 50 000 URL:n tai 50 Mt:n tiedostot jaetaan osiin. Hakemisto säilyttää muut kelvolliset sivustokartat.

Moduuli kirjoittaa sivuston juureen tiedostot `sitemap_index.xml`, `sitemap_pages.xml` ja `sitemap_posts.xml`; tyhjälle luokalle ei tehdä tiedostoa. Yhdistettyä `sitemap.xml`-tiedostoa ei luoda. Luo kartat uudelleen sivu- tai kielimuutosten jälkeen ja avaa hakemisto selaimessa. Tarkista virhetilanteessa juurihakemiston kirjoitusoikeus; viimeisen onnistuneen luonnin aika ei muutu.

## Ohjeet

- Luo sivustokartat
- Sivuston juurihakemiston tiedostot
- Viimeisin onnistunut luonti
- Seuraava päivitys aikaisintaan
- Jos mitään ei ole valittu, sivustokartta päivitetään päivittäin.
- **Päivitystiheys** — Jos kenttä on tyhjä, oletusarvo on 'monthly'.
- **Päivitysprioriteetti** — Jos kenttä on tyhjä, oletusarvo on '0.5'.
