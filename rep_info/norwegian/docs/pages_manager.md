# Sideadministrator

## Tilgang og sider

Åpne **Addons → zmchel WHMCS Multimodule** i WHMCS-administrasjonen. Sidelisten lar deg opprette, finne, redigere og slette sider. En *slug* er adressedelen etter domenet, for eksempel `contact` i `/contact/`. Eksporter modulinnstillingene før du endrer URL-er, viderekoblinger eller serverregler.

Når du oppretter en side, skriver du inn et internt navn og en slug med latinske bokstaver, tall og bindestreker, uten domene eller `.php`. Velg tilgang for gjester, innloggede kunder eller alle. Velg deretter status (utkast, publisert, utsatt eller papirkurv), type (side, artikkel eller systemside) og språk. WHMCS-standardspråket må finnes i `supported_langs.php`; modulen legger det til automatisk.

Etter lagring åpner du siden og redigerer **hovedinnstillinger**, **innhold**, **metadata** og **nettstedskart**. Hvert skjema har sin egen Lagre-knapp; «Lagre alle» behandler dem samlet. Kontroller bekreftelsen og den offentlige siden. Sletting flytter først siden til papirkurven; permanent sletting skjer derfra.

## URL

Filtrer listen etter navn, tilgang, type, status eller språk. **Besøk** åpner den offentlige URL-en. **Slett** flytter først siden til papirkurven; permanent sletting gjøres der. Hvis siden ikke åpnes, kontroller publiseringsstatus, aktivt språk og tilgangstype.

## WHMCS

For å erstatte en WHMCS-side velger du den eksisterende systemadressen og en publisert modulside. Velg full erstatning, tillegg før eller etter vanlig innhold, eller bare meta/SEO. Lagre og test den opprinnelige WHMCS-URL-en som gjest og som innlogget kunde.
