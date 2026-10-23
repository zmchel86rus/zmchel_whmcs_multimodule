# Navodila za zmchel WHMCS Multimodule

**Pred uporabo ustvarite edinstvene soli in v module_init.php vnesite ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT in ZM_PB_NONCE_SALT.** Modul je bil razvit in preizkušen z WHMCS 8.13.1–8.13.7. Apache je v celoti podprt. Nginx lahko deluje, vendar lahko jezikovno usmerjanje na domači strani zahteva dodatne nastavitve.

**Pred prvo uporabo odprite Nastavitve modula → Podprti jeziki in vključite jezike, ki jih potrebujete.**

**Preverjene različice PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 in 8.5.

**zmchel WHMCS Multimodule je brezplačen.** V skrbništvu WHMCS omogoča upravljanje strani in člankov z vizualnim urejevalnikom, prevodi, meniji, medijsko knjižnico, polji SEO, zemljevidi spletnega mesta XML, preusmeritvami in pravili za prepisovanje URL-jev.

## Nastavitve modula

Izberite jezike, ki jih modul lahko uporablja. Izklop jezika ne izbriše njegove vsebine.

- **Nastavitve modula → Podprti jeziki → Omogoči**
- **Podatkovna zbirka modula → Popravi Izbrani elementi**
- **Pravila prepisovanja URL → Preveri pravila → Dodaj ali posodobi pravila**

Nginx ne bere datoteke .htaccess, zato ta pravila v njem ne delujejo. Enakovredna pravila nastavite v nginx.

## Upravitelj strani

- **Dodaj stran → Ime strani → URL-oznaka strani (slug) → Shrani**
- **Urejevalnik strani → Nastavitve vsebine → Nastavitve metapodatkov → Nastavitve zemljevida spletnega mesta za stran → Shrani vse**
- **Upravitelj strani → Obišči**
- **Zemljevid spletnega mesta → Ustvari zemljevide spletnega mesta**

Dovoljene so samo latinične črke, vezaji in številke.

Prijavljeni uporabniki: do strani lahko dostopajo samo prijavljeni uporabniki; Gostje: dostopajo lahko samo gostje; Mešano: dostopajo lahko vsi, vidnost pa določajo bloki na strani.

Samodejno ustvarjanje se izvede po opravilu WHMCS cron, ko je čas za posodobitev. Ročno ustvarjanje se začne takoj.

## Navodila po razdelkih

- [Upravitelj strani](docs/pages_manager.md)
- [Urejevalnik strani](docs/pages_editor.md)
- [Upravljalnik predstavnostnih datotek](docs/media_manager.md)
- [Meniji](docs/menu_manager.md)
- [Upravitelj jezikov](docs/langs_manager.md)
- [Preusmeritve](docs/redirects_manager.md)
- [Zemljevidi spletnega mesta](docs/sitemap_manager.md)
- [Pravila prepisovanja URL](docs/rewrite_manager.md)
- [Nastavitve modula](docs/module_settings.md)
- [Podatkovna zbirka modula](docs/module_db.md)

## Dodatno gradivo

- [Stranjenje in filtri](docs/pages_editor_pagination.md)
- [Smarty in spremenljivke](docs/pages_editor_smarty.md)
- [Strukturirani podatki](docs/module_structured_data.md)
- [Uvoz in izvoz](docs/module_settings_transfer.md)
