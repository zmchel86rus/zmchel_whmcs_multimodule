# Struktureeritud andmed

- **Leheredaktor → Metaandmete seaded → Schema tüüp → Salvesta.**

## Mida moodul märgistab

Menüüd ja sisukord võivad luua `SiteNavigationElement`, nähtavad küsimused ja vastused `FAQPage` ning mitme osaga leivapuru `BreadcrumbList`. Paigutusplokid, nupud ja filtrid ei saa sisutüüpi automaatselt. Lehele valitud Schema tüüp määrab selle JSON-LD väljundi; väljalülitamisel seda märgistust ei väljastata.

## Kontroll pärast avaldamist

Kontrollige avalikul lehel JSON-LD andmeid, kanoonilist URL-i, keelt ja tegelikult nähtavat sisu. Korrektne märgistus ei taga laiendatud otsingutulemust.

## Schema.org

`SiteNavigationElement` kasutab menüü tegelikult nähtavaid linke ja nimetusi; sisukord võib lisada `WebPageElement` nende pealkirjade jaoks, mis lehel päriselt olemas on. `FAQPage` hõlmab ainult külalisele nähtavaid täidetud küsimusi ja vastuseid: peidetud plokid ja tavalised akordionid jäetakse välja. `BreadcrumbList` luuakse vähemalt kahe kirje korral. Organisatsiooni andmed pärinevad WHMCS-ist; kontaktkeeled esitatakse `ContactPoint.availableLanguage` väljal BCP 47 kujul. Filtrite, lehitsemise, vormide ja oma HTML-i jaoks Schema tüüpi ei arvata.
