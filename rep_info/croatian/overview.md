# Besplatan multimodul za WHMCS

**Prije uporabe modula obavezno generirajte jedinstvene soli i upišite ih u `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` i `ZM_PB_NONCE_SALT`.

**Prije prve uporabe otvorite Postavke modula → Podržani jezici i uključite jezike koji su vam potrebni.**

Modul je razvijen i testiran na **WHMCS-u 8.13.1–8.13.7**. Kompatibilnost s PHP-om provjerena je za verzije **7.4–8.5**. Apache je u potpunosti podržan. Modul može raditi i na Nginxu, ali usmjeravanje jezika na početnoj stranici može zahtijevati dodatnu konfiguraciju.

**zmchel WHMCS Multimodule je besplatan.** Obuhvaća vizualni uređivač stranica, višejezični sadržaj, izbornike, medijsku zbirku, SEO polja, XML karte web-mjesta, preusmjeravanja, pravila prepisivanja te uvoz i izvoz. Pročitajte [upute](instruction.md).

## Upravitelj jezika (u razvoju)

U administraciji WHMCS-a otvorite Upravitelj jezika te odaberite odjeljak (klijentski ili administratorski jezici WHMCS-a, ovaj ili drugi modul) i jezik. Usporedite izvornik ili referentni tekst s prijevodom, uredite redak i spremite ga; postojeće ključeve možete i izvesti ili uvesti kao JSON. Novi jezici nasljeđuju referentni tekst dok ih ne prevedete. Upravitelj uključuje i isključuje jezične datoteke te ispravlja stare nazive; zadani jezik najprije promijenite u WHMCS-u.

## Planirani razvoj

- Dodati ugniježđene stranice i kategorije.
- Razdvojiti sadašnji modul na komponente.
- Dodati upravljanje pravima pristupa u administraciji.
- Proširiti zadani popis jezika u `supported_langs.php`.
- Dodati uređivač koda za `.tpl` datoteke modula i korisničke teme WHMCS-a.
- Dodati upravitelj jezičnih datoteka modula, drugih modula i WHMCS-a.
- Poboljšati medijsku zbirku i izraditi potpuniji SEO upravitelj.
- Dodati višejezične karte web-mjesta i HTML stranicu karte.
- Dodati statistiku uporabe upravitelju stranica.
- Dodati minifikaciju JS/CSS/HTML-a, predmemoriju stranica i optimizaciju tablica.
- Izraditi sustav ažuriranja modula.

Ovo su **ideje za budućnost, a ne obvezujući plan**.

## Predložite ideju

[Pošaljite prijedlog](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) s naslovom «Предложение по мультимодулю».

## Postavite pitanje

[Pošaljite pitanje e-poštom](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) s naslovom «Задать вопрос по модулю».
