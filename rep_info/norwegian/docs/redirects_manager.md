# Viderekoblinger

Eksakte adresser: kilde → mål. Kilden er en bane fra nettstedets rotmappe eller en URL på dette nettstedet. Målet er en bane eller en fullstendig HTTP(S)-URL. En regel uten spørringsparametere samsvarer også med forespørsler som har slike parametere; målet brukes slik det er angitt. Reglene gjelder GET/HEAD-forespørsler som når WHMCS.

Standard: 14 dager. Beregnes fra siste endring av den publiserte siden eller dens aktive oversettelser; hvis den aldri er endret, fra opprettelsen. Angi 0 for ingen forsinkelse. Automatiske regler bruker HTTP 301.

Adresser til overstyrte sider viderekobles automatisk til systemsidene de erstatter. Hvis en overstyring har flere mål, brukes det første konfigurerte målet. Disse viderekoblingene fungerer når overstyringer er aktivert, uavhengig av reglene i Viderekoblingsbehandling.

Angi en gyldig bane som begynner med /, eller en fullstendig HTTP(S)-URL. Kilden må tilhøre dette nettstedet; #-fragmenter støttes ikke.

## HTTP

Reglene støtter HTTP-kodene `301`, `302`, `303`, `307` og `308` og gjelder bare `GET`/`HEAD`-forespørsler som når WHMCS. Kilden matches nøyaktig mot banen og eventuelle oppgitte spørringsparametre; destinasjonsparametre erstatter de gamle. Behandleren lagrer regler i `zm_pb_redirects`, men oppretter ikke tabellen under en forespørsel: bruk **Moduldatabase**. Eksisterende URL-kolonner er begrenset til 128 byte.

Manuelle regler går foran automatiske. Når slug for en publisert side endres, kan en automatisk `301` opprettes for hvert aktive språk etter den angitte ventetiden; publisering av et utkast gjør ikke dette. Senere navneendringer oppdaterer gamle mål. En regel med spørringsparametere går foran en regel som bare gjelder stien. Kilde-URL-en må tilhøre dette nettstedet og ikke ha et `#`-fragment.

## Instruksjoner

- Kilde
- Mål
- Aktivert
- Deaktivert
