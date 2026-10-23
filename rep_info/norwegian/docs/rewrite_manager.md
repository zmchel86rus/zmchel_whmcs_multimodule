# Omskrivingsregler

## WHMCS

Regler for språk-URL-er, inkludert sider under /ru/, /en/ og andre prefikser. Språkene hentes fra supported_langs.php; reglene settes inn i .htaccess før WHMCS-reglene.

Nginx leser ikke .htaccess, så disse reglene fungerer ikke der. Konfigurer tilsvarende regler i nginx.

Et oppsett med nginx → Apache ble oppdaget. Disse reglene fungerer bare for forespørsler som videresendes til Apache; nginx leser ikke .htaccess.

Etter at du har lagt til eller slettet en regel, klikker du på «Legg til eller oppdater regler» for å bruke endringene i .htaccess.

## .htaccess

Åpne regelbehandleren og sammenlign reglene med nettstedets hovedfil `.htaccess`. Lagre URL-mønster, mål og flagg for en egen regel, og velg deretter **Legg til eller oppdater regler** slik at blokken skrives før WHMCS-reglene. Kontroller status på nytt og åpne en publisert side på standardspråket og et annet språk. Et for bredt mønster kan påvirke andre sider. Med Nginx → Apache gjelder reglene bare for forespørsler som sendes videre til Apache.

## Instruksjoner

- Kontroller regler
- Legg til eller oppdater regler
- Fjern alle regler fra .htaccess
- URL-mønster
- Mål
- Flagg
