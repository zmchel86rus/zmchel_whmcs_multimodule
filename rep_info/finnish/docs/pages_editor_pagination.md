# Sivutus ja suodattimet

Napsauta luettelolohkoa. Esc peruuttaa valinnan. Sijoita sivutus kohdelohkon ulkopuolelle.

Anna Smartylle koko luettelon muuttuja. Ilman muuttujaa sivutetaan säilön HTML-elementit. Voit tarvittaessa määrittää rivin luokan tai tr-tagin. Linkit säilyttävät määrän, lajittelun ja suodattimet. Useita toisistaan riippumattomia luetteloita tuetaan.

Vedä sivukoon valitsin sivutuksen sisään tai muihin sivun lohkoihin. Valitsin pysyy yhdistettynä tähän sivutukseen.

Valitse Smarty-luettelolohko. Haun ja sivutuksen on kohdistuttava samaan lohkoon.

Määritä koko luettelon muuttuja. Haku kohdistuu mihin tahansa valittuun kenttään, ja suodattimia käytetään yhdessä. Ehdot huomioidaan ennen sivujen määrän laskemista. Suodattimien käyttö tai nollaus palauttaa ensimmäiselle sivulle. Jos sivutus on jo yhdistetty, sen muuttujaa käytetään.

Liitä sivutus ja suodattimet samaan luetteloon. Valitse tulosten määrä ja URL-muoto; testaa toinen sivu ja yksi suodatin.

## Linkit ja luettelon lähde

Sijoita sivutus luettelolohkon ulkopuolelle ja valitse lohko kohteeksi. Smarty-luettelolle määritä muuttuja, joka sisältää kaikki tietueet; muuten jaetaan säiliön HTML-elementit. Valitse linkkimuoto moduulin asetuksen mukaan, `/page/2/` tai `?page=2`. Polkuvaihtoehto vaatii rewrite-säännöt. Erilliset luettelot käyttävät omia parametrejaan; linkit säilyttävät kielen, suodattimet ja järjestyksen.

## Sivukoko, SEO ja suodattimet

Määritä tietueiden määrä ja ota tarvittaessa käyttöön valinta 10/25/50/100/250. Määrän vaihto palauttaa luettelon ensimmäiselle sivulle. Noindex koskee vain sivua kaksi ja sitä seuraavia; tarkista otsikko ja kanoninen URL. Liitä suodattimet samaan luetteloon ja testaa julkisella sivulla toinen sivu sekä suodatettu tulos.

## page / count / pager

Määritä Smarty-listalle kaikki rivit sisältävä muuttuja ja säilytä `{foreach}`-silmukka: moduuli jakaa listan, joten älä lisää toista `array_slice`-kutsua. Ilman muuttujaa jaetaan säiliön HTML-elementit; voit valita rivin luokan tai `tr`-tunnisteen, mutta `thead` ja `tfoot` säilyvät. Aseta nykyistä sivua ympäröivien painikkeiden määrä erikseen tietokoneelle ja puhelimelle. Käytä suorilla PHP-reiteillä `?page=2`; `/page/2/` vaatii rewrite-säännöt. Myöhemmillä sivuilla on oma canonical, ja niille voi asettaa `noindex`.

Kun riippumattomia luetteloita on useita, ensimmäinen käyttää parametreja `page`, `count` ja `sort`; muut käyttävät lohkon ID:llä täydennettyjä parametreja. Polussa `/page/N/` `pager` kertoo, mille luettelolle numero kuuluu. Smarty-lohkossa `$zm_pagination` antaa arvot `total`, `page`, `pages`, `count` ja `offset`. `count` rajataan välille 10–250. Tyhjässä tai yhden sivun luettelossa sivutuspaneeli piilotetaan.

## YYYY-MM-DD

Suodattimet kohdistuvat samaan luetteloon kuin sivutus. Tekstihaku voi tarkistaa useita pilkuilla erotettuja kenttiä; päivämääräväli käyttää muotoa `YYYY-MM-DD` ja kattaa viimeisen päivän kokonaan.

## Flex / Grid

Valitse Flex tai Grid ja säädä leveydet sekä sarakkeet laitteittain. Suodattimen käyttö tai nollaus palauttaa luettelon ensimmäiselle sivulle. Tulosmäärän valitsinta voi siirtää ilman että yhteys katkeaa; kopioitu paneeli ohjaa samaa luetteloa.

## Ohjeet

- Sivukohtaisen määrän valitsin: 10, 25, 50, 100, 250
- Älä indeksoi sivua 2 tai sitä seuraavia sivuja
- Linkkien muoto
- Kohteita sivulla oletusarvoisesti
