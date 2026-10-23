# Kielten hallinta

- **Osiot → Kielet → Käännökset.** Jokainen Tallenna-painike tallentaa vain yhden käännöksen.

Kielten hallinnassa voi muokata WHMCS:n ja moduulien kielitekstejä ylläpidosta. Toimintoa kehitetään edelleen. Käyttöoikeus on moduulin pääkäyttäjällä, ja PHP tarvitsee kirjoitusoikeuden asianomaisiin kielihakemistoihin.

## Osion ja kielen valinta

Ota ensin tarvittavat kielet käyttöön kohdassa **Moduulin asetukset → Tuetut kielet**. Valitse sitten **Kielten hallinta → Osiot** ja WHMCS:n asiakas- tai ylläpitokielet, tämän moduulin kielet tai toisen löydetyn moduulin kielet. Taulukossa näkyvät käytössä olevat, poistetut käytöstä ja lisättävissä olevat kielet. **Kielet**-välilehdellä voit valita tiedoston tai lisätä puuttuvan kielen. Uusi tiedosto käyttää aluksi vertailukielen tekstejä; se ei ole valmis käännös. Kääntämättömyysmerkintä kertoo, ettei tiedostossa ole omia käännöksiä.

## Käännösten muokkaus

**Käännökset**-välilehden **Alkuperäinen**-sarake näyttää valitun kielen alkuperäisen tiedoston tekstit ilman omia muutoksiasi. Jos kielellä ei ole omia tekstejä, sarakkeen nimi on **Vertailuteksti**. Hae avainta tai tekstiä, suodata kaikkiin, alkuperäisiin tai lisättyihin avaimiin ja tallenna jokainen rivi erikseen. Voit lisätä oman avaimen valitun osion alle ja myöhemmin nimetä sen uudelleen tai poistaa sen. Osa muiden moduulien kielitiedostoista on vain luettavissa, jos niiden muotoa ei voi tallentaa turvallisesti.

## JSON

**Vie JSON** lataa valitun osion ja kielen avaimet sekä käännökset. **Tuo JSON** päivittää vain olemassa olevia avaimia. Tuntemattomat ja toistuvat avaimet ohitetaan ja luetellaan tuloksessa. Säilytä osion ja kielen tunnisteet sekä avainten polut. Tiedoston enimmäiskoko on 8 MiB.

## Kielitiedostot ja oletuskieli

Kielitiedoston voi poistaa käytöstä ja ottaa takaisin käyttöön; sitä voi muokata myös käytöstä poistettuna. Englannin perustiedostoa ja WHMCS:n nykyistä oletuskieltä ei voi poistaa käytöstä. Hallinnassa lisätyistä WHMCS:n asiakas- ja ylläpitokielistä säilytetään palautuskopiot päivityksiä varten. Jos **Osiot** näyttää tiedostonimen korjauksen, tarkista uusi nimi ja valitse **Korjaa**; korjaus koskee löydettyjä osioita.

Kun vaihdat oletuskieltä, ota uusi kieli ensin käyttöön moduulin asetuksissa, vaihda sitten WHMCS:n oletuskieli ja poista vasta sen jälkeen vanha kieli käytöstä. Tarkista tekstit sekä ylläpidossa että asiakaspuolella.

## Ohjeet

- Osiot
- Kielet
- Käännökset
- Tämä kieli on pois käytöstä, mutta sen käännöksiä voi edelleen muokata.
- Vertailukieli
- Jokainen Tallenna-painike tallentaa vain yhden käännöksen.
- Kääntämättä
- Näytä alkuperäiset
- Näytä lisätyt
- Seuraavia käännösavaimia ei tuotu:
- tuntematon avain
- päällekkäinen avain
