[![Sledilci](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=Sledilci)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Zvezdice](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Zvezdice)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Forki](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Forki)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Prijave](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=Prijave)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Navodila za zmchel WHMCS Multimodule

**zmchel WHMCS Multimodule je brezplačen.** V skrbništvu WHMCS omogoča upravljanje strani in člankov z vizualnim urejevalnikom, prevodi, meniji, medijsko knjižnico, polji SEO, zemljevidi spletnega mesta XML, preusmeritvami in pravili za prepisovanje URL-jev.

## Pred prvo uporabo

**Pred prvo uporabo odprite Nastavitve modula → Podprti jeziki in vključite jezike, ki jih potrebujete.**

Ob vsaki aktivaciji modul samodejno ustvari nove soli in jih zapiše v `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Preverite, ali so izpolnjene vse tri vrednosti soli.

## Preverjena združljivost in delovanje

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Združljivost s spletnimi strežniki

Apache je v celoti podprt. Nginx lahko deluje, vendar lahko jezikovno usmerjanje na domači strani zahteva dodatne nastavitve.

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
