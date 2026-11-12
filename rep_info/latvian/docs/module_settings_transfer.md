# Imports un eksports

Pirms lielām izmaiņām eksportējiet vajadzīgās sadaļas. Pēc importa pārbaudiet lapas, izvēlnes un medijus, atsevišķi piemērojiet pārrakstīšanas noteikumus un atjaunojiet karti. Tas neaizstāj WHMCS rezerves kopiju. Importējot tiek atbalstīti arī JSON faili.

## ZIP

Eksportā var iekļaut lapas un ierakstus ar tulkojumiem, saturu, SEO un CSS/JS; izvēlnes ar hierarhiju un atrašanās vietām; iestatījumus, pāradresācijas, savus noteikumus un multivides bibliotēku ar failiem. Versiju vēsture, savāktie Smarty mainīgie, WHMCS konti un noslēpumi un motīva faili netiek iekļauti. ZIP faila ierobežojums ir 128 MiB; spēkā ir arī PHP `upload_max_filesize` un `post_max_size`. Pārceļot izvēlnes uz citu vietni, importējiet arī lapas un iepriekš atrisiniet vienādus izvēļņu nosaukumus.

Eksporta fails izmanto formātu `zmchel_whmcs_multimodule` (2. versija). Importējot avota vietnes URL pielāgo mērķa vietnes `SystemURL`, bet ārējās saites paliek nemainīgas. Imports neveido tabulas: vispirms sagatavojiet tās Moduļa datubāzē. Pirms sākuma tiek prasīts apstiprinājums; ieraksti mainās transakcijā, un kļūdas gadījumā aizstātie faili tiek atjaunoti.
