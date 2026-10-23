# Modulinnstillinger

## WHMCS

Velg språkene modulen kan bruke. Deaktivering sletter ikke innholdet. Hvis du bruker pene URL-er på Apache, oppdater reglene i Rewrite Manager etter at språkene er endret.

- [Import og eksport](module_settings_transfer.md)

## Instruksjoner

- **Lesbare URL-er** — Aktiver lesbare URL-er, inkludert system-URL-er.
- **Språkruting** — Aktiver eller deaktiver språkruter. Når dette er aktivert, er sidene tilgjengelige under /de/, /en/, /es/ og andre støttede språkprefikser. Når det er deaktivert, viser én side-URL innholdet på språket brukeren har valgt.
- **Rute for standardspråk** — Gir standardspråket sitt eget URL-prefiks og videresender modulsider uten prefiks dit.
- **Vedlikeholdsmodus (modul)** — Aktiver eller deaktiver modulens vedlikeholdsmodus. Denne mildere modusen lar WHMCS-hooks og andre komponenter kjøre, i motsetning til systemets vedlikeholdsmodus.
- **Samle inn Smarty-variabler** — Aktiver eller deaktiver innsamling av Smarty-variabler.
- **Bruk innsamlede Smarty-variabler** — Aktiver eller deaktiver bruk av innsamlede Smarty-variabler i sideredigereren.
- **Sideoverstyringer** — Aktiver eller deaktiver sideoverstyringer.
- **Oppdateringsfrekvens** — Hvis ingenting er valgt, oppdateres nettstedskartet daglig.
- **HTML-nettstedskart** — Når dette er aktivert, viser /html-sitemap nettstedskartet som en vanlig HTML-side; sitemap.xml påvirkes ikke.
- **Nettstedets topptekst** — Egendefinert HTML for \<head>-seksjonen, inkludert \<script> og \<style>.
- **Nettstedets bunntekst** — Egendefinert HTML før \</body>, inkludert \<script> og \<style>.
- **Rediger robots.txt**
