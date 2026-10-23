# Valikot

Luo valikko, lisää sivuja tai omia linkkejä ja järjestä kohteet vetämällä. Valitse alavalikolle yläkohde ja määritä kielikohtaiset tekstit, näkyvyys vieraille tai asiakkaille sekä laitteet. Määritä sijainti; yhdessä sijainnissa voi olla vain yksi valikko. Valitse sisäisille linkeille, seuraako URL nykyistä kieltä. Tarkista julkinen valikko tietokoneella ja puhelimella.

Jokaiselle kohteelle voi määrittää otsikon, kuvauksen, CSS-luokat, `rel`-arvon, kuvakkeen ja avauksen uuteen välilehteen; julkaistuja sivuja voi lisätä automaattisesti. Valitse erikseen tietokoneelle ja puhelimelle, täydentääkö valikko WHMCS:n navigointia vai korvaako se sen. Moduulin sivun linkki lasketaan uudelleen nykyisen slugin, kielen ja URL-tilan mukaan; tyhjä nimi käyttää käännettyä otsikkoa tai sivun nimeä. Sivun avaaminen ei vaihda asiakkaan profiilin kieltä. Palvelin hylkää turvattomat URL-muodot ja HTML:n nimissä.

## WHMCS

Ota tarvittavat WHMCS-valikon sijainnit käyttöön moduulin asetuksissa. Yhteen sijaintiin voi määrittää yhden valikon, mutta sama valikko voi näkyä useassa sijainnissa. Työpöytänäkymä alkaa 768 pikselin leveydestä ja mobiilinäkymä koskee kapeampia näyttöjä. Käytöstä poistettu sijainti jättää WHMCS:n oletusvalikon ennalleen.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

WHMCS:n järjestelmäreiteillä, joilla moduuli ei ohjaa kieltä, valikon nimet käyttävät asiakkaan tallennettua kieltä; moduulin sivut käyttävät URL:n kieltä. Kun oletuskielen oma reitti otetaan käyttöön, sillekin tulee etuliite. Tavallinen URL on `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Oman linkin voi jättää lokalisoimatta, esimerkiksi `clientarea.php`. Yläkohdan piilottaminen piilottaa koko haaran.

Sivukohdan URL muodostetaan uudelleen nykyisestä slugista ja julkaistusta käännöksestä. Jos käännös puuttuu, käytetään oletuskielen julkaistua versiota. Mukautettu linkki voi säilyttää annetun URL:n muuttumattomana; ulkoisiin osoitteisiin, mailto- ja tel-linkkeihin sekä ankkureihin ei lisätä kielietuliitettä. Luonnoksia, poistettuja tai käyttöoikeuden estämiä sivuja ei näytetä.

## zm_pb_menus

Tiedot tallennetaan tauluihin `zm_pb_menus`, `zm_pb_menu_items` ja `zm_pb_menu_locations`. Luo tai korjaa taulut moduulin tietokantaosiossa. Puussa voi olla enintään 10 tasoa ja 300 kohtaa; pääkohdan poistaminen nostaa sen alikohdat yhden tason ylemmäs.

## Ohjeet

- Luo valikko, lisää sivuja tai omia linkkejä ja järjestä kohteet vetämällä.
