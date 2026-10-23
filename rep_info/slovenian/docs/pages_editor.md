# Urejevalnik strani

- [Stranjenje in filtri](pages_editor_pagination.md)
- [Smarty in spremenljivke](pages_editor_smarty.md)
- [Strukturirani podatki](module_structured_data.md)

## 3. Urejanje vsebine

Za vsak jezik izpolnite zavihke Vsebina, Metapodatki in Zemljevid spletnega mesta. Bloke povlecite v urejevalnik, spremenite besedilo in slike ter shranite vsak zavihek. Kopiranje z vsebino ponudi izhodišče, kopiranje strukture pa pripravi postavitev za prevod. Besedilo se ne prevede samodejno.

## 4. Povezave in objava

Pri povezavah do prevedenih strani modula vključite dodajanje trenutnega jezika v URL. Izključite ga za zunanje naslove, e-pošto in poti WHMCS brez jezikovnih različic. Po objavi preverite stran kot gost in stranka, na računalniku in telefonu ter v najmanj dveh jezikih.

## SEO

V osnovnih nastavitvah preverite ime, slug, vrsto, stanje, dostop in jezike. Privzeti jezik WHMCS mora biti v modulu vključen; objavljena stran potrebuje vsebino v prikazanem jeziku. Za vsak jezik izpolnite naslov in opis ter preverite canonical, robots, Open Graph, navigacijsko pot in Schema. Na zavihku zemljevida mesta izberite pogostost in prednost za javno nesistemsko stran. Shranite in preverite javni URL ter XML.

## Kontaktni obrazec

Dodajte blok **Kontaktni obrazec**. Izberite **zahtevek WHMCS** in oddelek za podporo ali **e-pošto** in prejemnika; vnesite naslov, opis, zadevo in besedilo gumba. Vsakemu polju določite ime, vrsto, obveznost in preverjanje. Zahtevek gosta potrebuje polji z vlogama imena in e-pošte pošiljatelja. V spustnem seznamu napišite eno možnost na vrstico, na primer `sales : Prodaja`. Ustvarite ločeno polje za vsako soglasje in uporabite CAPTCHA, nastavljeno v WHMCS. Shranite in pošljite pravi preizkus kot gost; preverite zahtevek ali dostavo, napake in čiščenje obrazca. Zeleno stanje urejevalnika ne potrjuje dostave; če `mail()` odpove, nastavite SMTP v WHMCS.

## Navodila

- Ugnezdeni vsebnik s prilagodljivo postavitvijo Flex. Vanj povlecite druge bloke.
- Ugnezdeni vsebnik CSS Grid. Vanj povlecite druge bloke.
- Ugnezdeni vrtiljak Bootstrap. Vanj povlecite bloke; vsak postane diapozitiv.
- Vsi bloki pod tem blokom so prikazani samo prijavljenim uporabnikom. Deluje le, če je vrsta dostopa do strani Mešano.
- Vsi bloki pod tem blokom so prikazani samo gostom. Deluje le, če je vrsta dostopa do strani Mešano.
- **Naslov strani**
- **Metaopis**
- **Kanonični URL**
- **Roboti** — index, follow / noindex, nofollow. Določa indeksiranje.
- **Vrsta sheme** — Ko je možnost onemogočena, se oznake JSON Schema.org za to stran ne izpišejo.
