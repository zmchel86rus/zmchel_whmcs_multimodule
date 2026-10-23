# Uređivač stranica

- [Paginacija](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [Strukturirani podaci](module_structured_data.md)

## Sadržaj i jezici

U kartici Sadržaj odaberite jezik i povucite GrapesJS blokove na radnu površinu. Uredite tekst, slike i opcije odabranog bloka te spremite taj jezik. Dostupni su odjeljci, stupci, tablice, FAQ, harmonike, kontaktni obrasci, popisi, paginacija, zone za goste i članove te prilagođeni kod. Kopirajte strukturu ili sadržaj na drugi jezik i prevedite tekst prije objave.

Uz lijepe URL-ove i jezično usmjeravanje zadani jezik koristi `/contact/` samo kad je njegova neobvezna ruta isključena, a ostali prefiks kao `/hr/contact/`. U blokovima poveznice i gumba uključite trenutni jezik samo za prevedene stranice web-mjesta. Isključite ga za vanjske adrese, datoteke, `mailto:`, `tel:` i WHMCS rute bez prijevoda. Provjerite poveznice na više jezika.

## WHMCS

U osnovnim postavkama provjerite naziv, slug, vrstu, status, pristup i jezike. Zadani jezik WHMCS-a mora biti uključen u modulu; objavljena stranica mora imati sadržaj na jeziku koji prikazujete.

## SEO

Za svaki jezik ispunite naslov i opis te provjerite canonical, robots, Open Graph, navigacijsku stazu i Schema. U karti web-mjesta odaberite učestalost i prioritet za javnu nesistemsku stranicu. Spremite i provjerite javni URL i XML.

## Kontaktni obrazac

Dodajte blok **Kontaktni obrazac**. Odaberite **WHMCS tiket** i odjel podrške ili **e-poštu** i primatelja; upišite naslov, opis, predmet i tekst gumba. Svakom polju zadajte naziv, vrstu, obveznost i provjeru. Tiket gosta treba polja s ulogama imena i e-pošte pošiljatelja. U padajući popis upišite jednu opciju po retku, primjerice `sales : Prodaja`. Za svaki pristanak dodajte zasebno polje i koristite CAPTCHA postavljenu u WHMCS-u. Spremite i pošaljite stvarnu probu kao gost; provjerite tiket ili dostavu, pogreške i čišćenje obrasca. Zeleni status uređivača ne potvrđuje isporuku; ako `mail()` ne radi, postavite SMTP u WHMCS-u.

## Upute

- Ugniježđeni spremnik s fleksibilnim rasporedom. Povucite druge blokove u njega.
- Ugniježđeni CSS Grid spremnik. Povucite druge blokove u njega.
- Ugniježđeni Bootstrap karusel. Povucite blokove u njega; svaki postaje slajd.
- Svi blokovi ispod ovoga prikazuju se samo prijavljenim korisnicima. Radi samo kada je vrsta pristupa stranici Mješovito.
- Svi blokovi ispod ovoga prikazuju se samo gostima. Radi samo kada je vrsta pristupa stranici Mješovito.
- **Naslov stranice**
- **Metaopis**
- **Kanonski URL**
- **Robots** — index, follow / noindex, nofollow. Upravlja indeksiranjem.
- **Vrsta sheme** — Kada je onemogućeno, JSON oznake Schema.org neće se ispisivati za ovu stranicu.
