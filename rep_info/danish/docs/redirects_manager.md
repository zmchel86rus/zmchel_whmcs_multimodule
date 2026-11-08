# Viderestillinger

Angiv gammel og ny URL. Brug 301 til permanente og 302 til midlertidige flytninger; test kilde-URL'en, og undgå viderestilling til samme adresse.

## HTTP

Reglerne understøtter HTTP-koderne `301`, `302`, `303`, `307` og `308` og gælder kun `GET`/`HEAD`-anmodninger, der når WHMCS. Kilden sammenlignes nøjagtigt med stien og eventuelle angivne forespørgselsparametre; destinationsparametrene erstatter de gamle. Manageren gemmer regler i `zm_pb_redirects`, men opretter ikke tabellen under en anmodning: brug **Moduldatabase**. Eksisterende URL-kolonner har en grænse på 128 byte.

Manuelle regler har forrang for automatiske. Når en publiceret sides slug ændres, kan der efter den valgte ventetid oprettes en automatisk `301` for hvert aktivt sprog; publicering af en kladde gør ikke dette. Senere omdøbninger opdaterer målene i gamle regler. En regel med forespørgselsparametre har forrang for en regel kun for stien. Kilde-URL'en skal tilhøre dette websted og må ikke indeholde et `#`-fragment.
