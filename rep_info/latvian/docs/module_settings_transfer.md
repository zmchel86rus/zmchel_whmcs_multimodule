# Imports un eksports

Pirms lielām izmaiņām eksportējiet vajadzīgās sadaļas. Pēc importa pārbaudiet lapas, izvēlnes un medijus, atsevišķi piemērojiet pārrakstīšanas noteikumus un atjaunojiet karti. Tas neaizstāj WHMCS rezerves kopiju.

## JSON

Eksportā var iekļaut lapas un ierakstus ar tulkojumiem, saturu, SEO un CSS/JS; izvēlnes ar hierarhiju un atrašanās vietām; iestatījumus, pāradresācijas, savus noteikumus un multivides bibliotēku ar failiem. Versiju vēsture, savāktie Smarty mainīgie, WHMCS konti un noslēpumi un motīva faili netiek iekļauti. JSON faila ierobežojums ir 32 MiB; spēkā ir arī PHP `upload_max_filesize` un `post_max_size`. Pārceļot izvēlnes uz citu vietni, importējiet arī lapas un iepriekš atrisiniet vienādus izvēļņu nosaukumus.

Eksporta fails izmanto formātu `zmchel_whmcs_multimodule` (1. versija). Importējot avota vietnes URL pielāgo mērķa vietnes `SystemURL`, bet ārējās saites paliek nemainīgas. Imports neveido tabulas: vispirms sagatavojiet tās Moduļa datubāzē. Pirms sākuma tiek prasīts apstiprinājums; ieraksti mainās transakcijā, un kļūdas gadījumā aizstātie faili tiek atjaunoti.

## Instrukcijas

- Viens JSON fails visām vai atlasītajām sadaļām, līdz 32 MiB (tiek piemēroti arī PHP augšupielādes ierobežojumi). Atbilstošās lapas tiek atjauninātas pēc URL identifikatora (slug) un piekļuves veida, bet izvēlnes — pēc nosaukuma. Pārējie ieraksti netiek mainīti. Importējot izvēlnes jaunā vietnē, iekļaujiet arī lapas. Atlasītās sadaļas, kuru failā nav, tiek izlaistas.
- CSS/JS tiek iekļauti kopā ar lapām, bet attēli un citi augšupielādētie faili — kopā ar multivides bibliotēku. Labojumu vēsture, apkopotie Smarty mainīgie un WHMCS sensitīvie dati netiek eksportēti. Pēc importēšanas atkārtoti ģenerējiet vietnes karti; pārrakstīšanas noteikumus piemērojiet URL pārrakstīšanas pārvaldniekā.
- Lapas un ieraksti (tulkojumi, saturs, SEO, vietnes kartes iestatījumi, CSS/JS bloki)
- Izvēlnes un to atrašanās vietas
- Moduļa iestatījumi, aizstāšana, galvene/kājene, robots.txt
- Pāradresācijas
- Pielāgoti URL pārrakstīšanas noteikumi
- Multivides bibliotēka (faili un apraksti)
- Atbilstošie ieraksti atlasītajās sadaļās tiks atjaunināti no faila. Turpināt?
