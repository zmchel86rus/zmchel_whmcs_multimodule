# zmchel WHMCS Multimodule: upute

**Prije uporabe modula obavezno generirajte jedinstvene soli i upišite ih u `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` i `ZM_PB_NONCE_SALT`.

**Prije prve uporabe otvorite Postavke modula → Podržani jezici i uključite jezike koji su vam potrebni.**

Modul je razvijen i testiran na **WHMCS-u 8.13.1–8.13.7**. Kompatibilnost s PHP-om provjerena je za verzije **7.4–8.5**. Apache je u potpunosti podržan. Modul može raditi i na Nginxu, ali usmjeravanje jezika na početnoj stranici može zahtijevati dodatnu konfiguraciju.

**zmchel WHMCS Multimodule je besplatan.** Obuhvaća vizualni uređivač stranica, višejezični sadržaj, izbornike, medijsku zbirku, SEO polja, XML karte web-mjesta, preusmjeravanja, pravila prepisivanja te uvoz i izvoz.

## Postavke modula

Odaberite jezike koje modul može koristiti. Isključivanje jezika ne briše sadržaj.

- **Postavke modula → Podržani jezici → Omogući**
- **Baza podataka modula → Popravi Odabrane stavke**
- **Pravila prepisivanja URL-ova → Provjeri pravila → Dodaj ili ažuriraj pravila**

Nginx ne čita .htaccess pa ova pravila ondje ne rade. Konfigurirajte odgovarajuća pravila u nginxu.

## Upravitelj stranica

- **Dodaj stranicu → Naziv stranice → Slug stranice → Spremi**
- **Uređivač stranica → Postavke sadržaja → Postavke metapodataka → Postavke karte web-mjesta za stranicu → Spremi sve**
- **Upravitelj stranica → Posjeti**
- **Karta web-mjesta → Generiraj karte web-mjesta**

Dopuštena su samo latinična slova, crtice i znamenke.

Prijavljeni korisnici: stranici mogu pristupiti samo prijavljeni korisnici; Gosti: mogu joj pristupiti samo gosti; Mješovito: mogu joj pristupiti svi, a vidljivost se kontrolira blokovima unutar stranice.

Automatsko generiranje pokreće se nakon WHMCS crona kada dođe vrijeme za ažuriranje. Ručno generiranje počinje odmah.

## Vodiči po odjeljcima

- [Upravitelj stranica](docs/pages_manager.md)
- [Uređivač stranica](docs/pages_editor.md)
- [Upravitelj medijskih datoteka](docs/media_manager.md)
- [Izbornici](docs/menu_manager.md)
- [Upravitelj jezika](docs/langs_manager.md)
- [Preusmjeravanja](docs/redirects_manager.md)
- [Karte web-mjesta](docs/sitemap_manager.md)
- [Pravila prepisivanja URL-ova](docs/rewrite_manager.md)
- [Postavke modula](docs/module_settings.md)
- [Baza podataka modula](docs/module_db.md)

## Dodatni materijali

- [Paginacija](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [Strukturirani podaci](docs/module_structured_data.md)
- [Uvoz i izvoz](docs/module_settings_transfer.md)
