# Redireccions

Introduïu l'URL antic i el nou. Feu servir 301 per als canvis permanents i 302 per als temporals; proveu l'origen i eviteu les redireccions cap a si mateixes.

## HTTP

Les regles admeten els codis HTTP `301`, `302`, `303`, `307` i `308` i només s’apliquen a les peticions `GET`/`HEAD` que arriben a WHMCS. L’origen coincideix exactament amb el camí i, si s’han indicat, amb els paràmetres; els paràmetres de la destinació substitueixen els anteriors. El gestor desa les regles a `zm_pb_redirects`, però no crea la taula durant una petició: feu servir **Base de dades del mòdul**. Les columnes URL existents admeten fins a 128 bytes.

Les regles manuals tenen prioritat sobre les automàtiques. Canviar el slug d'una pàgina publicada pot crear un `301` automàtic per a cada idioma actiu després del retard configurat; publicar un esborrany no el crea. Els canvis de nom posteriors actualitzen les destinacions antigues. Una regla amb paràmetres de consulta té prioritat sobre la regla només de ruta. L'URL d'origen ha de pertànyer al lloc i no pot incloure un fragment `#`.
