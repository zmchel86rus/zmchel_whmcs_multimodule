# Omdirigeringar

Exakta adresser: källa → mål. Källan är en sökväg från webbplatsens rotkatalog eller en URL på den här webbplatsen. Målet är en sökväg eller en fullständig HTTP(S)-URL. En regel utan frågeparametrar matchar även förfrågningar som innehåller sådana; målet används exakt som det har angetts. Reglerna gäller GET/HEAD-förfrågningar som når WHMCS.

Standard: 14 dagar. Räknas från den senaste ändringen av den publicerade sidan eller dess aktiva översättningar; om sidan aldrig har ändrats räknas det från skapandet. Ange 0 för ingen fördröjning. Automatiska regler använder HTTP 301.

Adresser till åsidosatta sidor omdirigeras automatiskt till de systemsidor som de ersätter. Om en åsidosättning har flera mål används det första konfigurerade målet. Omdirigeringarna fungerar när åsidosättningar är aktiverade, oberoende av reglerna i Omdirigeringshanteraren.

Ange en giltig sökväg som börjar med / eller en fullständig HTTP(S)-URL. Källan måste tillhöra den här webbplatsen; #-fragment stöds inte.

## HTTP

Reglerna stöder HTTP-koderna `301`, `302`, `303`, `307` och `308` och gäller bara `GET`/`HEAD`-begäranden som når WHMCS. Källan matchas exakt mot sökvägen och angivna frågeparametrar; målets parametrar ersätter de gamla. Hanteraren lagrar reglerna i `zm_pb_redirects`, men skapar inte tabellen under en begäran: använd **Moduldatabas**. Befintliga URL-kolumner är begränsade till 128 byte.

Manuella regler går före automatiska. En ändring av slug för en publicerad sida kan efter angiven väntetid skapa en automatisk `301` för varje aktivt språk; publicering av ett utkast gör det inte. Senare namnändringar uppdaterar gamla mål. En regel med frågeparametrar går före en regel som bara gäller sökvägen. Käll-URL:en måste höra till denna webbplats och får inte ha något `#`-fragment.

## Instruktioner

- Källa
- Mål
- Aktiverad
- Inaktiverad
