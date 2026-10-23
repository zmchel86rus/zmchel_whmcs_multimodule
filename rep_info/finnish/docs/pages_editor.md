# Sivueditori

- [Sivutus ja suodattimet](pages_editor_pagination.md)
- [Smarty ja muuttujat](pages_editor_smarty.md)
- [Rakenteinen tieto](module_structured_data.md)

## 3. Sisällön muokkaus

Täytä jokaiselle kielelle Sisältö-, Metatiedot- ja Sivustokartta-välilehdet. Vedä lohkoja editoriin, muokkaa tekstiä ja kuvia ja tallenna jokainen välilehti. Kopioi sisällön kanssa antaa pohjan; kopioi rakenne valmistelee asettelun käännöstä varten. Tekstiä ei käännetä automaattisesti.

## 4. Linkit ja julkaisu

Ota nykyisen kielen lisääminen URL-osoitteeseen käyttöön, kun linkki vie moduulin käännetylle sivulle. Poista se käytöstä ulkoisille linkeille, sähköpostiosoitteille ja WHMCS-reiteille, joilla ei ole kieliversioita. Testaa julkaistu sivu vieraana ja asiakkaana, tietokoneella ja puhelimella sekä kahdella kielellä.

## SEO

Tarkista perusasetuksista nimi, slug, tyyppi, tila, käyttöoikeus ja kielet. WHMCS:n oletuskielen on oltava käytössä moduulissa; julkaistulla sivulla on oltava sisältöä näytettävällä kielellä. Täytä otsikko ja kuvaus joka kielelle sekä tarkista canonical, robots, Open Graph, murupolku ja Schema. Valitse sivustokarttavälilehdellä julkisen, ei-järjestelmäsivun tiheys ja prioriteetti. Tallenna ja tarkista julkinen URL ja XML.

## Yhteydenottolomake

Lisää **Yhteydenottolomake**-lohko. Valitse **WHMCS-tukipyyntö** ja tukiosasto tai **sähköposti** ja vastaanottaja; täytä otsikko, kuvaus, aihe ja painikkeen teksti. Määritä jokaiselle kentälle nimi, tyyppi, pakollisuus ja tarkistus. Vieraan tukipyyntö tarvitsee lähettäjän nimen ja sähköpostin roolit sisältävät kentät. Lisää pudotusvalikkoon yksi vaihtoehto riville, esimerkiksi `sales : Myynti`. Luo erillinen kenttä jokaiselle suostumukselle ja käytä WHMCS:n CAPTCHA-asetuksia. Tallenna ja lähetä oikea testiviesti vieraana; tarkista pyyntö tai toimitus, virheet ja lomakkeen tyhjentyminen. Editorin vihreä tila ei todista toimitusta; määritä WHMCS:n SMTP, jos `mail()` ei toimi.

## Ohjeet

- Sisäkkäinen joustavan asettelun säilö. Vedä muita lohkoja sen sisään.
- Sisäkkäinen CSS Grid -säilö. Vedä muita lohkoja sen sisään.
- Sisäkkäinen Bootstrap-karuselli. Vedä lohkoja sisään; jokaisesta tulee dia.
- Kaikki tämän lohkon alapuoliset lohkot näkyvät vain kirjautuneille käyttäjille. Toimii vain, kun sivun käyttöoikeustyyppi on Kaikki käyttäjät.
- Kaikki tämän lohkon alapuoliset lohkot näkyvät vain vierailijoille. Toimii vain, kun sivun käyttöoikeustyyppi on Kaikki käyttäjät.
- **Sivun otsikko**
- **Metakuvaus**
- **Kanoninen URL-osoite**
- **Robots** — index, follow / noindex, nofollow. Hallitsee indeksointia.
- **Schema-tyyppi** — Kun asetus on pois käytöstä, sivulle ei tulosteta Schema.org JSON -merkintää.
