# Redireccions

Introduïu l'URL antic i el nou. Feu servir 301 per als canvis permanents i 302 per als temporals; proveu l'origen i eviteu les redireccions cap a si mateixes.

## HTTP

Les regles admeten els codis HTTP `301`, `302`, `303`, `307` i `308` i només s’apliquen a les peticions `GET`/`HEAD` que arriben a WHMCS. L’origen coincideix exactament amb el camí i, si s’han indicat, amb els paràmetres; els paràmetres de la destinació substitueixen els anteriors. El gestor desa les regles a `zm_pb_redirects`, però no crea la taula durant una petició: feu servir **Base de dades del mòdul**. Les columnes URL existents admeten fins a 128 bytes.

Les regles manuals tenen prioritat sobre les automàtiques. Canviar el slug d'una pàgina publicada pot crear un `301` automàtic per a cada idioma actiu després del retard configurat; publicar un esborrany no el crea. Els canvis de nom posteriors actualitzen les destinacions antigues. Una regla amb paràmetres de consulta té prioritat sobre la regla només de ruta. L'URL d'origen ha de pertànyer al lloc i no pot incloure un fragment `#`.

## Instruccions

- Adreces exactes: origen → destinació. L'origen és un camí des de l'arrel del lloc o un URL d'aquest lloc. La destinació és un camí o un URL HTTP(S) complet. Una regla sense paràmetres de consulta també coincideix amb les sol·licituds que en contenen; s'utilitza la destinació tal com s'ha introduït. Les regles s'apliquen a les sol·licituds GET/HEAD que arriben a WHMCS.
- Origen
- Destinació
- Activat
- Desactivat
- Per defecte: 14 dies. Es compten des de l'últim canvi de la pàgina publicada o de les seves traduccions actives; si no s'ha modificat mai, des de la creació. Establiu 0 per eliminar l'espera. Les regles automàtiques utilitzen HTTP 301.
- Les adreces de les pàgines substitutives redirigeixen automàticament a les pàgines del sistema que substitueixen. Si una substitució té diverses destinacions, s'utilitza la primera que s'hagi configurat. Aquestes redireccions funcionen sempre que les substitucions estiguin activades, independentment de les regles del gestor de redireccions.
- Introduïu un camí vàlid que comenci per / o un URL HTTP(S) complet. L'origen ha de pertànyer a aquest lloc; no s'admeten fragments #.
