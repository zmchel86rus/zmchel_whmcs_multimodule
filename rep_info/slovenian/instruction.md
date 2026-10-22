# Navodila za zmchel WHMCS Multimodule

**Pred uporabo ustvarite edinstvene soli in v module_init.php vnesite ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT in ZM_PB_NONCE_SALT.** Modul je bil razvit in preizkušen z WHMCS 8.13.1–8.13.7. Apache je v celoti podprt. Nginx lahko deluje, vendar lahko jezikovno usmerjanje na domači strani zahteva dodatne nastavitve.

**Pred prvo uporabo odprite Nastavitve modula → Podprti jeziki in vključite jezike, ki jih potrebujete.**

**Preverjene različice PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 in 8.5.

**zmchel WHMCS Multimodule je brezplačen.** V skrbništvu WHMCS omogoča upravljanje strani in člankov z vizualnim urejevalnikom, prevodi, meniji, medijsko knjižnico, polji SEO, zemljevidi spletnega mesta XML, preusmeritvami in pravili za prepisovanje URL-jev.

## Upravitelj jezikov (v razvoju)

V skrbništvu WHMCS odprite Upravitelja jezikov ter izberite razdelek (jeziki za stranke ali skrbnike WHMCS, ta ali drug modul) in jezik. Primerjajte izvirnik ali referenco s prevodom, uredite eno vrstico in jo shranite; obstoječe ključe lahko tudi izvozite in uvozite kot JSON. Novi jeziki uporabljajo referenco, dokler niso prevedeni. Upravitelj omogoča ali onemogoča jezikovne datoteke in popravi stara imena; privzeti jezik najprej spremenite v WHMCS.

## 1. Namestitev in dostop

V WHMCS aktivirajte dodatni modul in dodelite dostop pooblaščenim skrbnikom. V zbirki podatkov modula preverite potrebne tabele. Preglejte prijazne URL-je, jezikovne poti in položaje menijev. Apache uporablja .htaccess; v Nginxu enakovredna strežniška pravila nastavite posebej.

## 2. Ustvarjanje strani

Odprite seznam strani in dodajte stran. Vnesite notranje ime in slug iz latiničnih črk, številk in vezajev, na primer about-us. Izberite dostop za vse, samo za prijavljene stranke ali samo za goste. Nastavite stanje in jezike. Privzeti jezik WHMCS mora modul podpirati.

## 3. Urejanje vsebine

Za vsak jezik izpolnite zavihke Vsebina, Metapodatki in Zemljevid spletnega mesta. Bloke povlecite v urejevalnik, spremenite besedilo in slike ter shranite vsak zavihek. Kopiranje z vsebino ponudi izhodišče, kopiranje strukture pa pripravi postavitev za prevod. Besedilo se ne prevede samodejno.

## 4. Povezave in objava

Pri povezavah do prevedenih strani modula vključite dodajanje trenutnega jezika v URL. Izključite ga za zunanje naslove, e-pošto in poti WHMCS brez jezikovnih različic. Po objavi preverite stran kot gost in stranka, na računalniku in telefonu ter v najmanj dveh jezikih.

## 5. Upravljanje in vzdrževanje

Upravitelj menijev ureja navigacijo, upravitelj medijev pa slike. Upravitelj preusmeritev ustvarja pravila 301 in 302. Zemljevid spletnega mesta ustvari datoteke XML. Pred večjimi spremembami izvozite nastavitve; po spremembah pravil za prepisovanje jih ponovno uporabite in preverite zemljevid.

## Podrobnejše teme

- [Meniji](docs/menus.md)
- [Stranjenje in filtri](docs/pagination.md)
- [Preusmeritve](docs/redirects.md)
- [Zemljevidi spletnega mesta](docs/sitemaps.md)
- [Smarty in spremenljivke](docs/smarty.md)
- [Strukturirani podatki](docs/structured-data.md)
- [Uvoz in izvoz](docs/transfer.md)
