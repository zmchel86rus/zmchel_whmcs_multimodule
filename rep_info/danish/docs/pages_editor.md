# Sideeditor

- [Sideinddeling og filtre](pages_editor_pagination.md)
- [Smarty og variabler](pages_editor_smarty.md)
- [Strukturerede data](module_structured_data.md)

## 3. Redigér indhold

Åbn siden, og udfyld Indhold, Metadata og Sitemap for hvert sprog. Træk blokke ind i editoren, ret tekst og billeder, og gem de enkelte faner. Kopiér med indhold giver et udgangspunkt; Kopiér struktur giver et layout til oversættelse. Teksten oversættes ikke automatisk.

## 4. Links og udgivelse

Slå tilføjelse af sidens sprog til for links til oversatte modulsider. Slå den fra for eksterne URL'er, e-mailadresser og WHMCS-ruter uden sprogversion. Efter udgivelse skal siden testes som gæst og kunde samt på mobil. Kontrollér titel, billeder, formularer og mindst to sprog.

## SEO

Kontrollér navn, slug, type, status, adgang og sprog i grundindstillingerne. WHMCS' standardsprog skal være aktiveret i modulet; en publiceret side skal have indhold på det viste sprog. Angiv titel og beskrivelse for hvert sprog, og gennemgå canonical, robots, Open Graph, brødkrummer og Schema. På fanen for sitemap vælges frekvens og prioritet for en offentlig side, der ikke er en systemside. Gem, og kontrollér den offentlige URL og XML.

## Kontaktformular

Tilføj blokken **Kontaktformular**. Vælg **WHMCS-supportsag** og afdeling eller **e-mail** og modtager; angiv overskrift, beskrivelse, emne og knaptekst. Giv hvert felt et navn, en type, krav om udfyldelse og validering. En supportsag fra en gæst kræver felter med roller som afsenderens navn og e-mail. Skriv én valgmulighed pr. linje i rullemenuen, for eksempel `sales : Salg`. Opret et særskilt felt for hvert samtykke, og brug CAPTCHA indstillet i WHMCS. Gem og send en rigtig prøve som gæst; kontrollér sag eller levering, fejl og nulstilling. En grøn status i editoren beviser ikke levering; konfigurér SMTP i WHMCS, hvis `mail()` fejler.

## Vejledning

- Indlejret flex-layoutcontainer. Træk andre blokke ind i den.
- Indlejret CSS Grid-container. Træk andre blokke ind i den.
- Indlejret Bootstrap-karrusel. Træk blokke ind i den; hver blok bliver til et dias.
- Alle blokke under denne blok vises kun for brugere, der er logget ind. Fungerer kun, når sidens adgangstype er Blandet.
- Alle blokke under denne blok vises kun for gæster. Fungerer kun, når sidens adgangstype er Blandet.
- **Sidetitel**
- **Metabeskrivelse**
- **Kanonisk URL**
- **Robots** — index, follow / noindex, nofollow. Styrer indeksering.
- **Schematype** — Når funktionen er deaktiveret, vises Schema.org-JSON-markup ikke for denne side.
