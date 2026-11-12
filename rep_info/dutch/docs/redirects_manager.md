# Omleidingen

Vul de oude en nieuwe URL in. Gebruik 301 voor blijvende en 302 voor tijdelijke verhuizingen; test de bron-URL en vermijd omleidingen naar zichzelf.

## HTTP

Regels ondersteunen HTTP-codes `301`, `302`, `303`, `307` en `308` en gelden alleen voor `GET`/`HEAD`-verzoeken die WHMCS bereiken. De bron wordt exact vergeleken op pad en, indien opgegeven, queryparameters; doelparameters vervangen de oude. De manager bewaart regels in `zm_pb_redirects`, maar maakt de tabel niet tijdens een verzoek aan: gebruik **Moduledatabase**. Bestaande URL-kolommen zijn beperkt tot 128 bytes.

Handmatige regels gaan vóór automatische regels. Een wijziging van de slug van een gepubliceerde pagina kan na de ingestelde wachttijd een automatische `301` per actieve taal maken; het publiceren van een concept doet dat niet. Latere naamswijzigingen werken oude bestemmingen bij. Een regel met queryparameters gaat vóór een regel voor alleen het pad. De bron-URL moet bij deze site horen en mag geen `#`-fragment bevatten.
