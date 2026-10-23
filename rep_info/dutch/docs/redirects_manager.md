# Omleidingen

Vul de oude en nieuwe URL in. Gebruik 301 voor blijvende en 302 voor tijdelijke verhuizingen; test de bron-URL en vermijd omleidingen naar zichzelf.

## HTTP

Regels ondersteunen HTTP-codes `301`, `302`, `303`, `307` en `308` en gelden alleen voor `GET`/`HEAD`-verzoeken die WHMCS bereiken. De bron wordt exact vergeleken op pad en, indien opgegeven, queryparameters; doelparameters vervangen de oude. De manager bewaart regels in `zm_pb_redirects`, maar maakt de tabel niet tijdens een verzoek aan: gebruik **Moduledatabase**. Bestaande URL-kolommen zijn beperkt tot 128 bytes.

Handmatige regels gaan vóór automatische regels. Een wijziging van de slug van een gepubliceerde pagina kan na de ingestelde wachttijd een automatische `301` per actieve taal maken; het publiceren van een concept doet dat niet. Latere naamswijzigingen werken oude bestemmingen bij. Een regel met queryparameters gaat vóór een regel voor alleen het pad. De bron-URL moet bij deze site horen en mag geen `#`-fragment bevatten.

## Instructies

- Exacte adressen: bron → bestemming. De bron is een pad vanaf de hoofdmap van de website of een URL op deze website. De bestemming is een pad of een volledige HTTP(S)-URL. Een regel zonder queryparameters komt ook overeen met verzoeken mét queryparameters; de bestemming wordt gebruikt zoals ingevoerd. Regels gelden voor GET/HEAD-verzoeken die WHMCS bereiken.
- Bron
- Bestemming
- Ingeschakeld
- Uitgeschakeld
- Standaard: 14 dagen. Gerekend vanaf de laatste wijziging van de gepubliceerde pagina of de actieve vertalingen ervan; als er nooit een wijziging is geweest, vanaf de aanmaakdatum. Stel 0 in om geen vertraging toe te passen. Automatische regels gebruiken HTTP 301.
- Adressen van vervangende pagina's verwijzen automatisch door naar de systeempagina's die ze vervangen. Als een vervanging meerdere bestemmingen heeft, wordt de eerst ingestelde bestemming gebruikt. Deze doorverwijzingen werken wanneer paginavervangingen zijn ingeschakeld, onafhankelijk van de regels van Doorverwijzingsbeheer.
- Voer een geldig pad in dat begint met /, of een volledige HTTP(S)-URL. De bron moet bij deze website horen; fragmenten met # worden niet ondersteund.
