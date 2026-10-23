# Rakenteinen tieto

- **Sivueditori → Metatietojen asetukset → Schema-tyyppi → Tallenna.**

Täytä metatiedot ja sopiva sivutyyppi joka kielelle: WebPage, artikkelityyppi tai ContactPage. Tarkista julkaisun jälkeen JSON-LD ja ensisijainen URL-osoite.

## Mitä moduuli merkitsee

Valikot ja sisällysluettelo voivat tuottaa `SiteNavigationElement`-merkintää, näkyvät kysymykset ja vastaukset `FAQPage`-merkintää ja useasta osasta koostuva murupolku `BreadcrumbList`-merkintää. Asettelulohkoille, painikkeille ja suodattimille ei anneta sisältötyyppiä automaattisesti. Sivun Schema-tyyppi määrää sen JSON-LD-tulosteen; kun tyyppi on pois käytöstä, tätä merkintää ei tulosteta.

## Tarkistus julkaisemisen jälkeen

Tarkista julkiselta sivulta JSON-LD, kanoninen URL, kieli ja todella näkyvä sisältö. Kelvollinen merkintä ei takaa rikastettua hakutulosta.

## Schema.org

`SiteNavigationElement` käyttää oikeasti näkyviä valikkolinkkejä ja niiden nimiä; sisällysluettelo voi lisätä `WebPageElement`-merkintöjä sivulta löytyville otsikoille. `FAQPage` sisältää vain vierailijalle näkyvät täydet kysymykset ja vastaukset: piilotetut lohkot ja tavalliset haitarit jätetään pois. `BreadcrumbList` luodaan vasta vähintään kahdesta kohdasta. Organisaatiotiedot tulevat WHMCS:stä; yhteydenottokielet ovat `ContactPoint.availableLanguage`-kentässä BCP 47 -muodossa. Suodattimille, sivutukselle, lomakkeille tai omalle HTML:lle ei arvata Schema-tyyppiä.

## Ohjeet

- **Schema-tyyppi** — Kun asetus on pois käytöstä, sivulle ei tulosteta Schema.org JSON -merkintää.
- **Murupolku** — Sivun nimi murupolussa
- **Kanoninen URL-osoite**
- **Sivun otsikko**
- **Metakuvaus**
- **Open Graph -otsikko** — Jos kenttä on tyhjä, käytetään sivun otsikkoa.
- **Open Graph -kuvaus** — Jos kenttä on tyhjä, käytetään metakuvausta.
- **Open Graph -kuva** — Jos kenttä on tyhjä, käytetään sivun kuvaa.
