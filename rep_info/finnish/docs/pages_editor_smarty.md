# Smarty ja muuttujat

- **Moduulin asetukset → Kerää Smarty-muuttujat → Käytä kerättyjä Smarty-muuttujia → Sivueditori.**

Ota Smarty-muuttujat käyttöön ennen lohkon lisäämistä. Käytä vain sallittuja muuttujia, suojaa dynaamiset arvot escape-suodattimella äläkä näytä henkilötietoja; PHP ja SQL eivät ole sallittuja.

## Muuttujaluettelo

Ota Smarty-muuttujien keruu ja käyttö käyttöön moduulin asetuksissa. Avaa sitten asiaankuuluvat sivuston sivut ja päivitä editori. Luettelo tallentaa muuttujien nimet, tyypit ja rakenteen, mutta ei todellisia arvoja tai henkilötietoja. Jos muuttuja puuttuu, käy uudelleen sivulla, jolla sitä käytetään.

## Editori ja rajoitukset

Avaa Smarty-lohko sivueditorissa ja valitse muuttujat luettelosta. Käytä sallittuja ehtoja ja silmukoita; lisää `|escape`, kun tulostat dynaamista tekstiä. PHP, SQL, metodikutsut, tiedostojen sisällyttäminen ja `nofilter` eivät ole sallittuja. Tallenna sivu ja tarkista julkinen näkymä.

## resources/available_vars/

Luettelo kertoo vain sivulla havaituista muuttujista: se ei tuo niitä toiselle sivulle. Koodi tarkistetaan tallennettaessa ja ennen näyttöä; lohko saa erillisen kopion sallituista arvoista. Ehdot, `foreach`, paikallinen `assign` sekä muuntimet `escape`, `default`, `count` ja `date_format` ovat käytettävissä. Tulostettavat arvot escapetaan automaattisesti; kirjoita haluttu HTML malliin. Jos tiedot puuttuvat tai koodi epäonnistuu, lohko jää tyhjäksi ja virhe kirjataan PHP-lokiin.

Hakemisto `resources/available_vars/` tallentaa nimet, tyypit, rakenteen ja keinotekoiset esimerkit, mutta ei todellisia arvoja. Se kertoo, missä muuttuja havaittiin, muttei tee sitä käytettäväksi toisella sivulla. Avaa editori kaksoisnapsauttamalla Smarty-lohkoa. `Ctrl+Space` hakee muuttujia, `Ctrl+S` ottaa koodin käyttöön ja `F11` avaa koko näytön. Koodi suoritetaan erillään; puuttuvilla tiedoilla lohko jää tyhjäksi ja varoitus kirjataan PHP-lokiin.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Ohjeet

- **Kerää Smarty-muuttujat** — Ota Smarty-muuttujien kerääminen käyttöön tai poista se käytöstä.
- **Käytä kerättyjä Smarty-muuttujia** — Ota kerättyjen Smarty-muuttujien käyttö sivueditorissa käyttöön tai poista se käytöstä.
- Smarty (PHP) -muuttuja
- Smarty: PHP, oliometodit, staattiset kutsut ja nofilter ovat kiellettyjä.
- Smarty-mallipohja on liian suuri.
- Smarty
- Smarty-editori
