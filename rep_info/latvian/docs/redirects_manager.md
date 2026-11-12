# Pāradresācijas

Ievadiet veco un jauno URL. Pastāvīgai pārcelšanai izmantojiet 301, īslaicīgai — 302; pārbaudiet avotu un izvairieties no pāradresācijas uz to pašu adresi.

## HTTP

Noteikumi atbalsta HTTP kodus `301`, `302`, `303`, `307`, `308` un darbojas tikai `GET`/`HEAD` pieprasījumiem, kas nonāk WHMCS. Avots precīzi atbilst ceļam un, ja norādīti, vaicājuma parametriem; galamērķa parametri aizstāj iepriekšējos. Pārvaldnieks saglabā noteikumus tabulā `zm_pb_redirects`, bet pieprasījuma laikā tabulu neveido: izmantojiet **Moduļa datubāzi**. Esošo URL kolonnu ierobežojums ir 128 baiti.

Manuālajiem noteikumiem ir priekšroka pār automātiskajiem. Publicētas lapas slug maiņa pēc iestatītās aiztures var izveidot automātisku `301` katrai aktīvajai valodai; melnraksta publicēšana to neveido. Vēlāka pārdēvēšana atjaunina vecos galamērķus. Noteikumam ar vaicājuma parametriem ir priekšroka pār tikai ceļa noteikumu. Avota URL jābūt šīs vietnes adresei bez `#` fragmenta.
