# Pāradresācijas

Ievadiet veco un jauno URL. Pastāvīgai pārcelšanai izmantojiet 301, īslaicīgai — 302; pārbaudiet avotu un izvairieties no pāradresācijas uz to pašu adresi.

## HTTP

Noteikumi atbalsta HTTP kodus `301`, `302`, `303`, `307`, `308` un darbojas tikai `GET`/`HEAD` pieprasījumiem, kas nonāk WHMCS. Avots precīzi atbilst ceļam un, ja norādīti, vaicājuma parametriem; galamērķa parametri aizstāj iepriekšējos. Pārvaldnieks saglabā noteikumus tabulā `zm_pb_redirects`, bet pieprasījuma laikā tabulu neveido: izmantojiet **Moduļa datubāzi**. Esošo URL kolonnu ierobežojums ir 128 baiti.

Manuālajiem noteikumiem ir priekšroka pār automātiskajiem. Publicētas lapas slug maiņa pēc iestatītās aiztures var izveidot automātisku `301` katrai aktīvajai valodai; melnraksta publicēšana to neveido. Vēlāka pārdēvēšana atjaunina vecos galamērķus. Noteikumam ar vaicājuma parametriem ir priekšroka pār tikai ceļa noteikumu. Avota URL jābūt šīs vietnes adresei bez `#` fragmenta.

## Instrukcijas

- Precīzas adreses: avots → galamērķis. Avots ir ceļš no vietnes saknes vai šīs vietnes URL. Galamērķis ir ceļš vai pilns HTTP(S) URL. Noteikums bez vaicājuma parametriem atbilst arī pieprasījumiem ar tiem; galamērķis tiek izmantots tieši tā, kā ievadīts. Noteikumi attiecas uz GET/HEAD pieprasījumiem, kas sasniedz WHMCS.
- Avots
- Galamērķis
- Iespējots
- Atspējots
- Noklusējums: 14 dienas. Skaita no pēdējām izmaiņām publicētajā lapā vai tās aktīvajos tulkojumos; ja izmaiņu nav bijis — no izveides brīža. Iestatiet 0, lai nebūtu aizkaves. Automātiskie noteikumi izmanto HTTP 301.
- Aizstājējlapu adreses automātiski pāradresē uz sistēmas lapām, kuras tās aizstāj. Ja aizstājējlapai ir vairāki galamērķi, tiek izmantots pirmais konfigurētais. Šīs pāradresācijas darbojas, kad lapu aizstāšana ir iespējota, neatkarīgi no pāradresāciju pārvaldnieka noteikumiem.
- Ievadiet derīgu ceļu, kas sākas ar /, vai pilnu HTTP(S) URL. Avotam jāpieder šai vietnei; fragmenti ar # netiek atbalstīti.
