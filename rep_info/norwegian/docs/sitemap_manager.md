# Nettstedskart

Automatisk generering kjøres etter WHMCS cron når det er tid for en oppdatering. Manuell generering starter umiddelbart.

Aktive sider og innlegg som er tilgjengelige for gjester, inkludert publiserte språkversjoner, tas med. Overstyringer bruker de offentlige URL-ene til sidene de erstatter.

Når dette er aktivert, viser /html-sitemap nettstedskartet som en vanlig HTML-side; sitemap.xml påvirkes ikke.

## XML

XML inneholder gjensidige lenker for aktive språk og `x-default` for adressen til standardspråket. Kilder til omdirigeringer tas ikke med i `loc` eller språkalternativene; en reserveoversettelse merkes med innholdets faktiske språk. Side- og innleggsfilene deklarerer XHTML-navnerommet.

Hooken `AfterCronJob` sammenligner intervallet `ZM_PB_SITEMAP_UPDFREQ` med tidspunktet for siste vellykkede generering `ZM_PB_SITEMAP_LASTUPD`; når nettstedskartet er slått av, er manuell generering heller ikke mulig. Språkversjoner velges etter `lang_active`, ikke `lang_status`. Ekstra deler får suffiksene `_2`, `_3` og videre. Ved feil gjenopprettes tidligere filer, og suksess-tidspunktet endres ikke. Kontroller skrivetilgang til roten, `resources/` og `inc/editable_consts.php`; tabeller repareres separat i moduldatabasen.

Automatisk generering avhenger av WHMCS cron og valgt intervall; knappen starter den med én gang. Bare publiserte sider og innlegg som gjester kan se, med sine aktive oversettelser, tas med. Hvis en side erstatter en systemside, brukes den offentlige URL-en til systemsiden og ikke erstatningens slug. Filer med over 50 000 URL-er eller 50 MB deles opp. Indeksen beholder andre gyldige nettstedskart.

Modulen skriver `sitemap_index.xml`, `sitemap_pages.xml` og `sitemap_posts.xml` i nettstedets rotmappe; tomme kategorier får ingen fil. Den lager ikke en samlet `sitemap.xml`. Generer kartene på nytt etter endringer i sider eller språk, og åpne indeksen i nettleseren. Ved feil må du kontrollere skrivetilgangen i rotmappen; tidspunktet for siste vellykkede generering endres ikke.

## Instruksjoner

- Generer nettstedskart
- Filer i nettstedets rotmappe
- Siste vellykkede generering
- Neste oppdatering tidligst
- Hvis ingenting er valgt, oppdateres nettstedskartet daglig.
- **Oppdateringsfrekvens** — Hvis feltet er tomt, brukes standardverdien 'monthly'.
- **Oppdateringsprioritet** — Hvis feltet er tomt, brukes standardverdien '0.5'.
