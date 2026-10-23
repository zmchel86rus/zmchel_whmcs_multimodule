# Viderestillinger

Angiv gammel og ny URL. Brug 301 til permanente og 302 til midlertidige flytninger; test kilde-URL'en, og undgå viderestilling til samme adresse.

## HTTP

Reglerne understøtter HTTP-koderne `301`, `302`, `303`, `307` og `308` og gælder kun `GET`/`HEAD`-anmodninger, der når WHMCS. Kilden sammenlignes nøjagtigt med stien og eventuelle angivne forespørgselsparametre; destinationsparametrene erstatter de gamle. Manageren gemmer regler i `zm_pb_redirects`, men opretter ikke tabellen under en anmodning: brug **Moduldatabase**. Eksisterende URL-kolonner har en grænse på 128 byte.

Manuelle regler har forrang for automatiske. Når en publiceret sides slug ændres, kan der efter den valgte ventetid oprettes en automatisk `301` for hvert aktivt sprog; publicering af en kladde gør ikke dette. Senere omdøbninger opdaterer målene i gamle regler. En regel med forespørgselsparametre har forrang for en regel kun for stien. Kilde-URL'en skal tilhøre dette websted og må ikke indeholde et `#`-fragment.

## Vejledning

- Præcise adresser: kilde → destination. Kilden er en sti fra websitets rodmappe eller en URL på dette website. Destinationen er en sti eller en fuld HTTP(S)-URL. En regel uden forespørgselsparametre matcher også anmodninger med sådanne parametre; destinationen bruges præcis som angivet. Reglerne gælder for GET/HEAD-anmodninger, der når frem til WHMCS.
- Kilde
- Destination
- Aktiveret
- Deaktiveret
- Standard: 14 dage. Regnes fra den seneste ændring af den offentliggjorte side eller dens aktive oversættelser; hvis siden aldrig er ændret, regnes der fra oprettelsen. Angiv 0 for ingen forsinkelse. Automatiske regler bruger HTTP 301.
- Adresser for sider med overstyring omdirigerer automatisk til de systemsider, de erstatter. Hvis en overstyring har flere destinationer, bruges den først konfigurerede. Disse omdirigeringer fungerer, når overstyringer er aktiveret, uafhængigt af reglerne i Omdirigeringsstyring.
- Angiv en gyldig sti, der begynder med /, eller en fuld HTTP(S)-URL. Kilden skal høre til dette website; #-fragmenter understøttes ikke.
