# Strukturirani podaci

- **Uređivač stranica → Postavke metapodataka → Vrsta sheme → Spremi.**

## Što modul označava

Izbornici i sadržaj mogu generirati `SiteNavigationElement`, vidljiva pitanja i odgovori `FAQPage`, a navigacijski put s više stavki `BreadcrumbList`. Blokovi rasporeda, gumbi i filtri ne dobivaju automatski vrstu sadržaja. Vrsta Schema odabrana za stranicu upravlja njezinim JSON-LD izlazom; ako je isključena, te oznake nema.

## Provjera nakon objave

Na javnoj stranici provjerite JSON-LD, kanonski URL, jezik i sadržaj koji je stvarno vidljiv. Ispravna oznaka ne jamči obogaćeni rezultat pretraživanja.

## Schema.org

`SiteNavigationElement` koristi stvarno vidljive poveznice i nazive izbornika; sadržaj stranice može dodati `WebPageElement` za naslove koji zaista postoje. `FAQPage` uključuje samo potpuna pitanja i odgovore vidljive posjetitelju: skriveni blokovi i obični harmonika-elementi isključeni su. `BreadcrumbList` nastaje samo s najmanje dvije stavke. Podaci o organizaciji dolaze iz WHMCS-a; jezici kontakta nalaze se u `ContactPoint.availableLanguage` u formatu BCP 47. Za filtre, straničenje, obrasce i vlastiti HTML ne pogađa se vrsta Schema.

## Upute

- **Vrsta sheme** — Kada je onemogućeno, JSON oznake Schema.org neće se ispisivati za ovu stranicu.
- **Navigacijska putanja** — Naziv stranice u navigacijskoj putanji
- **Kanonski URL**
- **Naslov stranice**
- **Metaopis**
- **Naslov za Open Graph** — Ako je prazno, koristi se naslov stranice.
- **Opis za Open Graph** — Ako je prazno, koristi se metaopis.
- **Slika za Open Graph** — Ako je prazno, koristi se slika stranice.

