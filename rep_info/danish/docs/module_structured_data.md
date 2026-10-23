# Strukturerede data

- **Sideeditor → Metadataindstillinger → Schematype → Gem.**

Udfyld metadata og en passende sidetype for hvert sprog: WebPage, en artikeltype eller ContactPage. Kontrollér JSON-LD og den kanoniske URL efter offentliggørelse.

## Hvad modulet markerer

Menuer og indholdsfortegnelser kan danne `SiteNavigationElement`, synlige spørgsmål og svar kan danne `FAQPage`, og brødkrummer med flere led kan danne `BreadcrumbList`. Layoutblokke, knapper og filtre får ikke automatisk en indholdstype. Den valgte Schema-type styrer sidens JSON-LD; når den er slået fra, udsendes denne markering ikke.

## Kontrol efter udgivelse

Kontrollér JSON-LD, kanonisk URL, sprog og faktisk synligt indhold på den offentlige side. Gyldig markering garanterer ikke et udvidet søgeresultat.

## Schema.org

`SiteNavigationElement` bruger de menulinks og titler, der faktisk er synlige; indholdsfortegnelsen kan også tilføje `WebPageElement` for overskrifter, som findes på siden. `FAQPage` omfatter kun udfyldte spørgsmål og svar, der er synlige for gæsten: skjulte blokke og almindelige harmonikaer udelades. `BreadcrumbList` oprettes kun med mindst to punkter. Organisationsdata kommer fra WHMCS; kontaktsprog angives i `ContactPoint.availableLanguage` som BCP 47. Der gættes ikke en Schema-type for filtre, sideinddeling, formularer eller egen HTML.

## Vejledning

- **Schematype** — Når funktionen er deaktiveret, vises Schema.org-JSON-markup ikke for denne side.
- **Brødkrummer** — Sidenavn i brødkrummer
- **Kanonisk URL**
- **Sidetitel**
- **Metabeskrivelse**
- **Open Graph-titel** — Hvis feltet er tomt, bruges sidetitlen.
- **Open Graph-beskrivelse** — Hvis feltet er tomt, bruges metabeskrivelsen.
- **Open Graph-billede** — Hvis feltet er tomt, bruges sidebilledet.
