# Uvoz i izvoz

Jedna JSON datoteka za sve ili odabrane odjeljke, veličine do 32 MiB (primjenjuju se i PHP ograničenja za prijenos). Podudarne stranice ažuriraju se prema slugu i vrsti pristupa, a izbornici prema nazivu. Ostali zapisi ostaju nepromijenjeni. Pri uvozu izbornika na novo web-mjesto uključite i stranice. Odabrani odjeljci kojih nema u datoteci preskaču se.

CSS/JS uključeni su sa stranicama, a slike i ostale prenesene datoteke s medijskom bibliotekom. Povijest revizija, prikupljene Smarty varijable i povjerljivi podaci WHMCS-a ne izvoze se. Nakon uvoza ponovno generirajte kartu web-mjesta, a pravila prepisivanja primijenite u Upravitelju pravila prepisivanja.

Stranice i objave (prijevodi, sadržaj, SEO, postavke karte web-mjesta, CSS/JS blokovi)

Podudarni zapisi u odabranim odjeljcima ažurirat će se iz datoteke. Nastaviti?

## JSON

Izvoz može obuhvatiti stranice i objave s prijevodima, sadržajem, SEO podacima i CSS/JS kodom; izbornike s hijerarhijom i položajima; postavke, preusmjeravanja, prilagođena pravila i medijsku biblioteku s datotekama. Povijest revizija, prikupljene Smarty varijable, WHMCS računi i tajne te datoteke teme ne izvoze se. JSON je ograničen na 32 MiB; vrijede i PHP ograničenja `upload_max_filesize` i `post_max_size`. Pri prijenosu izbornika na drugo web-mjesto uvezite i stranice te unaprijed riješite ista imena izbornika.

Izvozna datoteka koristi format `zmchel_whmcs_multimodule` (verzija 1). Pri uvozu URL-ovi izvornog web-mjesta prilagođavaju se vrijednosti `SystemURL` odredišta, a vanjske poveznice ostaju iste. Uvoz ne stvara tablice: najprije ih pripremite u Bazi podataka modula. Prije početka traži se potvrda; zapisi se mijenjaju u transakciji, a zamijenjene datoteke vraćaju se ako dođe do pogreške.

## Upute

- Izbornici i lokacije
- Postavke modula, zamjene stranica, zaglavlje/podnožje, robots.txt
- Preusmjeravanja
- Prilagođena pravila prepisivanja URL-ova
- Medijska biblioteka (datoteke i opisi)
