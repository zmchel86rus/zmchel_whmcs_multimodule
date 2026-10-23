# Sideredigerer

- [Paginering](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [Strukturerte data](module_structured_data.md)

## Innhold og språk

Velg et språk i Innhold-fanen og dra GrapesJS-blokker inn på arbeidsflaten. Rediger tekst, bilder og innstillingene til valgt blokk, og lagre språket. Du kan bruke seksjoner, kolonner, tabeller, FAQ, trekkspill, kontaktskjemaer, lister, paginering, gjeste-/kundeområder og egendefinert kode. Kopier oppsett eller innhold til et annet språk, og oversett teksten før publisering.

Med pene URL-er og språkruting bruker standardspråket `/contact/` bare når den valgfrie ruten for standardspråket er av, mens andre språk har prefiks som `/nb/contact/`. Slå på gjeldende språk i Lenke- og Knapp-blokker bare for oversatte sider på nettstedet. La det være av for eksterne adresser, filer, `mailto:`, `tel:` og WHMCS-ruter uten oversettelse. Test lenkene på flere språk.

## WHMCS

Kontroller navn, slug, type, status, tilgang og språk i grunninnstillingene. WHMCS-standardspråket må være aktivert i modulen; en publisert side må ha innhold på språket som vises.

## SEO

Fyll inn tittel og beskrivelse for hvert språk, og kontroller canonical, robots, Open Graph, brødsmuler og Schema. Velg frekvens og prioritet for en offentlig side som ikke er systemside, i fanen for nettstedskart. Lagre og kontroller offentlig URL og XML.

## Kontaktskjema

Legg til blokken **Kontaktskjema**. Velg en **WHMCS-støttesak** og avdeling eller **e-post** og mottaker; fyll inn tittel, beskrivelse, emne og knappetekst. Angi navn, type, obligatorisk status og validering for hvert felt. En sak fra en gjest krever felt med rollene avsendernavn og e-post. Skriv ett alternativ per linje i nedtrekkslisten, for eksempel `sales : Salg`. Lag et eget felt for hvert samtykke, og bruk CAPTCHA konfigurert i WHMCS. Lagre og send en ekte test som gjest; kontroller sak eller levering, feil og tømming av skjemaet. Grønn status i redigereren bekrefter ikke levering; sett opp SMTP i WHMCS hvis `mail()` feiler.

## Instruksjoner

- Nøstet beholder med flex-oppsett. Dra andre blokker inn i den.
- Nøstet CSS Grid-beholder. Dra andre blokker inn i den.
- Nøstet Bootstrap-karusell. Dra blokker inn i den; hver blokk blir et lysbilde.
- Alle blokkene under denne blokken vises bare for innloggede brukere. Fungerer bare når sidens tilgangstype er Blandet.
- Alle blokkene under denne blokken vises bare for gjester. Fungerer bare når sidens tilgangstype er Blandet.
- **Sidetittel**
- **Metabeskrivelse**
- **Kanonisk URL**
- **Robots** — index, follow / noindex, nofollow. Styrer indeksering.
- **Schema-type** — Når dette er deaktivert, vises ikke Schema.org JSON-markup for denne siden.
