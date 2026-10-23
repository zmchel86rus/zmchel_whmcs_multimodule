# Karte web-mjesta

Automatsko generiranje pokreće se nakon WHMCS crona kada dođe vrijeme za ažuriranje. Ručno generiranje počinje odmah.

Uključene su aktivne stranice i objave dostupne gostima, uključujući njihove objavljene jezične verzije. Zamjene koriste javne URL-ove stranica koje zamjenjuju.

Ako ništa nije odabrano, karta web-mjesta ažurira se svakodnevno.

Kada je omogućeno, /html-sitemap prikazuje kartu web-mjesta kao običnu HTML stranicu; sitemap.xml ostaje nepromijenjen.

## XML

XML sadrži uzajamne poveznice za aktivne jezike i `x-default` za adresu zadanog jezika. Izvori preusmjeravanja ne ulaze u `loc` ni u jezične alternative; pričuvni prijevod označuje se stvarnim jezikom sadržaja. Datoteke stranica i objava deklariraju XHTML imenski prostor.

Hook `AfterCronJob` uspoređuje interval `ZM_PB_SITEMAP_UPDFREQ` s vremenom posljednje uspješne izrade `ZM_PB_SITEMAP_LASTUPD`; ako je karta isključena, ručna izrada također nije dostupna. Jezične inačice uzimaju se prema `lang_active`, ne prema `lang_status`. Dodatni dijelovi dobivaju nastavke `_2`, `_3` itd. Ako izrada ne uspije, prethodne se datoteke vraćaju, a vrijeme uspjeha ostaje isto. Provjerite pisanje u korijenu, `resources/` i `inc/editable_consts.php`; tablice se popravljaju zasebno u bazi modula.

Automatska izrada ovisi o WHMCS cron zadatku i odabranom intervalu; gumb je pokreće odmah. Uključuju se samo objavljene stranice i objave dostupne gostima, zajedno s aktivnim prijevodima. Ako stranica zamjenjuje sistemsku stranicu, koristi se javni URL sistemske stranice, a ne slug zamjene. Datoteke s više od 50 000 URL-ova ili 50 MB dijele se na dijelove. Indeks zadržava druge valjane karte web-mjesta.

Modul u korijen web-mjesta zapisuje `sitemap_index.xml`, `sitemap_pages.xml` i `sitemap_posts.xml`; prazna kategorija ne stvara datoteku. Zajednički `sitemap.xml` ne izrađuje se. Nakon promjene stranica ili jezika ponovno generirajte karte i otvorite indeks u pregledniku. Ako dođe do pogreške, provjerite dozvolu pisanja u korijenu; vrijeme posljednjeg uspješnog generiranja ostaje isto.

## Upute

- Generiraj karte web-mjesta
- Datoteke u korijenu web-mjesta
- Posljednje uspješno generiranje
- Sljedeće ažuriranje najranije
- **Učestalost ažuriranja** — Ako je prazno, zadano je 'monthly'.
- **Prioritet ažuriranja** — Ako je prazno, zadano je '0.5'.
