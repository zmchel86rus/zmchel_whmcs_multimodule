# Izbornici

Izradite izbornik, dodajte stranice ili vlastite poveznice i rasporedite stavke povlačenjem. Za podizbornik odaberite nadređenu stavku; postavite oznake po jeziku, vidljivost gostima ili klijentima i uređaje. Dodijelite položaj: svaki položaj može imati samo jedan izbornik. Za interne poveznice odaberite treba li URL pratiti trenutačni jezik. Provjerite javni izbornik na računalu i telefonu.

Za svaku stavku možete postaviti naslov, opis, CSS klase, `rel`, ikonu i otvaranje u novoj kartici; objavljene stranice mogu se dodavati automatski. Zasebno za računalo i mobitel odaberite proširuje li izbornik navigaciju WHMCS-a ili je zamjenjuje. Poveznica na stranicu modula iznova se računa prema trenutačnom slugu, jeziku i načinu URL-a; prazna oznaka koristi prevedeni naslov ili naziv stranice. Posjet stranici ne mijenja jezik korisničkog profila. Poslužitelj odbija nesigurne URL sheme i HTML u oznakama.

## WHMCS

U postavkama modula uključite potrebna mjesta izbornika u WHMCS-u. Svako mjesto može imati jedan izbornik, a isti izbornik može se dodijeliti na više mjesta. Prikaz za računalo vrijedi od širine 768 px, a mobilni za uže zaslone. Kad je mjesto isključeno, zadani izbornik WHMCS-a ostaje nepromijenjen.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Na sistemskim putanjama WHMCS-a bez jezičnog usmjeravanja modula oznake izbornika koriste spremljeni jezik klijenta; stranice modula koriste jezik URL-a. Ako zadani jezik dobije vlastitu rutu, i on dobiva prefiks. Obični URL glasi `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Prilagođena poveznica može ostati nelokalizirana, primjerice `clientarea.php`. Skrivanje roditeljske stavke skriva cijelu granu.

URL stavke stranice ponovno se izračunava iz trenutačnog sluga i objavljenog prijevoda. Ako prijevod ne postoji, koristi se objavljena verzija na zadanom jeziku. Prilagođena poveznica može zadržati uneseni URL; vanjske adrese, mailto, tel i sidra ne dobivaju jezični prefiks. Skice, obrisane stranice i stranice bez dopuštenja pristupa ne prikazuju se.

## zm_pb_menus

Podaci su u tablicama `zm_pb_menus`, `zm_pb_menu_items` i `zm_pb_menu_locations`. Tablice izradite ili popravite u odjeljku Baza podataka modula. Stablo ima najviše 10 razina i 300 stavki; brisanjem roditeljske stavke njezina djeca prelaze razinu više.

## Upute

- Stvori izbornik
- Dodajte stranice, objave ili prilagođene poveznice.
- Povucite stavke kako biste promijenili njihov redoslijed. Ugniježđivanje postavite odabirom nadređene stavke ili gumbima za pomicanje.
- Koristi jezik trenutačne stranice
- Koristi uneseni URL bez promjena
- Oznake na drugim jezicima
- Vidljivo za
- Uređaji
- Svaka lokacija može imati jedan izbornik. Odabirom lokacije njezina se dodjela premješta ovamo s drugog izbornika.
- Stavke najviše razine postaju stupci, a ugniježđene stavke postaju poveznice. Koristite URL # za naslov bez poveznice.
- Tablice izbornika još nisu stvorene. Dodajte ih u Bazi podataka modula.

