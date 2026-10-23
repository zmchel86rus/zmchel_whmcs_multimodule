# zmchel WHMCS Multimodule: bruksanvisning

**Før du bruker modulen, må du generere unike salter og legge dem inn i `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` og `ZM_PB_NONCE_SALT`.

**Før første bruk åpner du Modulinnstillinger → Støttede språk og aktiverer språkene du trenger.**

Modulen er utviklet og testet med **WHMCS 8.13.1–8.13.7**; PHP-kompatibilitet er kontrollert for **7.4–8.5**. Apache støttes fullt ut. Nginx kan også fungere, men språkruting på forsiden kan kreve ekstra oppsett. **Modulen er gratis.**

## Språkbehandling (under utvikling)

Åpne Språkbehandling i WHMCS-administrasjonen og velg en seksjon (WHMCS-klient- eller administratorspråk, denne modulen eller en annen modul) og et språk. Sammenlign originalen eller referansen med oversettelsen, rediger én rad og lagre den; eksisterende nøkler kan også eksporteres og importeres som JSON. Nye språk bruker referansen til de er oversatt. Verktøyet aktiverer og deaktiverer språkfiler og retter gamle filnavn; endre standardspråk i WHMCS først.

→ [Språkbehandling](../english/docs/language-manager.md) (English)

## Tilgang og sider

Åpne **Addons → zmchel WHMCS Multimodule** i WHMCS-administrasjonen. Sidelisten lar deg opprette, finne, redigere og slette sider. En *slug* er adressedelen etter domenet, for eksempel `contact` i `/contact/`. Eksporter modulinnstillingene før du endrer URL-er, viderekoblinger eller serverregler.

Når du oppretter en side, skriver du inn et internt navn og en slug med latinske bokstaver, tall og bindestreker, uten domene eller `.php`. Velg tilgang for gjester, innloggede kunder eller alle. Velg deretter status (utkast, publisert, utsatt eller papirkurv), type (side, artikkel eller systemside) og språk. WHMCS-standardspråket må finnes i `supported_langs.php`; modulen legger det til automatisk.

Etter lagring åpner du siden og redigerer **hovedinnstillinger**, **innhold**, **metadata** og **nettstedskart**. Hvert skjema har sin egen Lagre-knapp; «Lagre alle» behandler dem samlet. Kontroller bekreftelsen og den offentlige siden. Sletting flytter først siden til papirkurven; permanent sletting skjer derfra.

## Innhold og språk

Velg et språk i Innhold-fanen og dra GrapesJS-blokker inn på arbeidsflaten. Rediger tekst, bilder og innstillingene til valgt blokk, og lagre språket. Du kan bruke seksjoner, kolonner, tabeller, FAQ, trekkspill, kontaktskjemaer, lister, paginering, gjeste-/kundeområder og egendefinert kode. Kopier oppsett eller innhold til et annet språk, og oversett teksten før publisering.

Med pene URL-er og språkruting bruker standardspråket `/contact/`, mens andre språk har prefiks som `/nb/contact/`. Slå på gjeldende språk i Lenke- og Knapp-blokker bare for oversatte sider på nettstedet. La det være av for eksterne adresser, filer, `mailto:`, `tel:` og WHMCS-ruter uten oversettelse. Test lenkene på flere språk.

## SEO, medier og menyer

Fyll inn tittel, beskrivelse, sosialt bilde, kanonisk URL, robots-innstillinger og Schema-type for hvert språk under Metadata. En publisert side som ikke er en systemside, kan være med i XML-nettstedskartet. Last opp bilder i mediebehandleren, gi dem nyttig alternativ tekst og sjekk kvaliteten etter optimalisering.

I menybehandleren oppretter du en meny, legger til sider eller egne lenker, sorterer elementene og velger plassering og synlighet. Hver plassering kan ha én meny. For å erstatte en WHMCS-side må du først publisere den nye siden, angi overstyringen i sidelistene og teste den opprinnelige WHMCS-URL-en som gjest og innlogget kunde.

## Nettstedets verktøy

I viderekoblingsbehandleren angir du kilde og mål: `301` for permanent flytting, `302` for midlertidig. Omskrivingsbehandleren styrer reglene for pene URL-er. Generer nettstedskart og sjekk `sitemap_index.xml`. Modulinnstillingene styrer også menyer, Smarty, vedlikehold og import/eksport. En JSON-eksport erstatter ikke en fullstendig WHMCS-sikkerhetskopi.

Kontaktskjemaet kan sende en WHMCS-støttesak eller e-post. Sett opp felter, mottaker eller støtteavdeling, samtykker og CAPTCHA, og send en ekte testmelding. Bruk Moduldatabase hvis modultabeller mangler.

## Mer dokumentasjon (English)

[Menyer](../english/docs/menus.md) · [Smarty](../english/docs/smarty.md) · [Paginering](../english/docs/pagination.md) · [Nettstedskart](../english/docs/sitemaps.md) · [Viderekoblinger](../english/docs/redirects.md) · [Strukturerte data](../english/docs/structured-data.md) · [Import og eksport](../english/docs/transfer.md).
