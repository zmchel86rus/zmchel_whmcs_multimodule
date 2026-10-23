# Strukturerte data

- **Sideredigerer → Metadatainnstillinger → Schema-type → Lagre.**

## Hva modulen merker

Menyer og innholdsfortegnelser kan gi `SiteNavigationElement`, synlige spørsmål og svar `FAQPage`, og en brødsmulesti med flere ledd `BreadcrumbList`. Oppsettblokker, knapper og filtre får ikke automatisk en innholdstype. Valgt Schema-type styrer sidens JSON-LD; hvis den er slått av, sendes ikke denne merkingen ut.

## Kontroll etter publisering

Kontroller JSON-LD, kanonisk URL, språk og faktisk synlig innhold på den offentlige siden. Gyldig merking garanterer ikke et utvidet søkeresultat.

## Schema.org

`SiteNavigationElement` bruker menykoblinger og titler som faktisk er synlige; innholdsfortegnelsen kan legge til `WebPageElement` for overskrifter som finnes på siden. `FAQPage` tar bare med fullstendige spørsmål og svar som gjesten kan se: skjulte blokker og vanlige trekkspill utelates. `BreadcrumbList` opprettes først med minst to punkter. Organisasjonsdata hentes fra WHMCS; kontaktspråk ligger i `ContactPoint.availableLanguage` med BCP 47-format. Det gjettes ingen Schema-type for filtre, sideinndeling, skjemaer eller egen HTML.

## Instruksjoner

- **Schema-type** — Når dette er deaktivert, vises ikke Schema.org JSON-markup for denne siden.
- **Brødsmulesti** — Sidenavn i brødsmulestien
- **Kanonisk URL**
- **Sidetittel**
- **Metabeskrivelse**
- **Open Graph-tittel** — Hvis feltet er tomt, brukes sidetittelen.
- **Open Graph-beskrivelse** — Hvis feltet er tomt, brukes metabeskrivelsen.
- **Open Graph-bilde** — Hvis feltet er tomt, brukes sidebildet.

