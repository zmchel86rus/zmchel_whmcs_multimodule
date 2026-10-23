# Strukturirani podatki

- **Urejevalnik strani → Nastavitve metapodatkov → Vrsta sheme → Shrani.**

Za vsak jezik izpolnite metapodatke in ustrezno vrsto strani: WebPage, vrsto članka ali ContactPage. Po objavi preverite JSON-LD in kanonični URL.

## Kaj modul označi

Meniji in kazalo lahko ustvarijo `SiteNavigationElement`, vidna vprašanja in odgovori `FAQPage`, navigacijska pot z več elementi pa `BreadcrumbList`. Bloki za postavitev, gumbi in filtri ne dobijo samodejno vrste vsebine. Vrsta Schema, izbrana za stran, določa njen JSON-LD; če je izklopljena, se ta oznaka ne izpiše.

## Preverjanje po objavi

Na javni strani preverite JSON-LD, kanonični URL, jezik in dejansko vidno vsebino. Veljavna oznaka ne zagotavlja obogatenega rezultata iskanja.

## Schema.org

`SiteNavigationElement` uporablja zares vidne povezave in naslove menija; kazalo lahko doda `WebPageElement` za naslove, ki na strani dejansko obstajajo. `FAQPage` zajema le popolna vprašanja in odgovore, vidne obiskovalcu: skriti bloki in navadne harmonike so izključeni. `BreadcrumbList` nastane samo pri vsaj dveh elementih. Podatki o organizaciji izvirajo iz WHMCS; jeziki za stik so v `ContactPoint.availableLanguage` v obliki BCP 47. Za filtre, straničenje, obrazce in lasten HTML modul ne ugiba vrste Schema.

## Navodila

- **Vrsta sheme** — Ko je možnost onemogočena, se oznake JSON Schema.org za to stran ne izpišejo.
- **Drobtinice** — Ime strani v drobtinicah
- **Kanonični URL**
- **Naslov strani**
- **Metaopis**
- **Naslov Open Graph** — Če je polje prazno, se uporabi naslov strani.
- **Opis Open Graph** — Če je polje prazno, se uporabi metaopis.
- **Slika Open Graph** — Če je polje prazno, se uporabi slika strani.
