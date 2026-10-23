# zmchel WHMCS Multimodule: upute

**Prije uporabe modula obavezno generirajte jedinstvene soli i upišite ih u `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` i `ZM_PB_NONCE_SALT`.

**Prije prve uporabe otvorite Postavke modula → Podržani jezici i uključite jezike koji su vam potrebni.**

Modul je razvijen i testiran na **WHMCS-u 8.13.1–8.13.7**; PHP kompatibilnost provjerena je za **7.4–8.5**. Apache je potpuno podržan. Nginx također može raditi, ali usmjeravanje jezika na početnoj stranici može trebati dodatne postavke. **Modul je besplatan.**

## Upravitelj jezika (u razvoju)

U administraciji WHMCS-a otvorite Upravitelj jezika te odaberite odjeljak (klijentski ili administratorski jezici WHMCS-a, ovaj ili drugi modul) i jezik. Usporedite izvornik ili referentni tekst s prijevodom, uredite redak i spremite ga; postojeće ključeve možete i izvesti ili uvesti kao JSON. Novi jezici nasljeđuju referentni tekst dok ih ne prevedete. Upravitelj uključuje i isključuje jezične datoteke te ispravlja stare nazive; zadani jezik najprije promijenite u WHMCS-u.

→ [Upravitelj jezika](../english/docs/language-manager.md) (English)

## Pristup i stranice

U administraciji WHMCS-a otvorite **Addons → zmchel WHMCS Multimodule**. Popis stranica omogućuje stvaranje, pretraživanje, uređivanje i brisanje stranica. *Slug* je dio adrese nakon domene, primjerice `contact` u `/contact/`. Prije promjene URL-ova, preusmjeravanja ili pravila poslužitelja izvezite postavke modula.

Za novu stranicu unesite interni naziv i slug od latiničnih slova, znamenaka i crtica, bez domene ili `.php`. Odaberite pristup za goste, prijavljene korisnike ili sve. Zatim odaberite status (skica, objavljeno, odgođeno ili koš), vrstu (stranica, članak ili sistemska stranica) i jezike. Zadani jezik WHMCS-a mora biti u `supported_langs.php`; modul ga dodaje automatski.

Nakon spremanja otvorite stranicu i uredite **glavne postavke**, **sadržaj**, **metapodatke** i postavke **karte web-mjesta**. Svaki obrazac ima gumb Spremi; „Spremi sve” obrađuje sve obrasce. Provjerite poruke o uspjehu i javni prikaz. Brisanje prvo premješta stranicu u koš; trajno brisanje obavlja se ondje.

## Sadržaj i jezici

U kartici Sadržaj odaberite jezik i povucite GrapesJS blokove na radnu površinu. Uredite tekst, slike i opcije odabranog bloka te spremite taj jezik. Dostupni su odjeljci, stupci, tablice, FAQ, harmonike, kontaktni obrasci, popisi, paginacija, zone za goste i članove te prilagođeni kod. Kopirajte strukturu ili sadržaj na drugi jezik i prevedite tekst prije objave.

Uz lijepe URL-ove i jezično usmjeravanje zadani jezik koristi `/contact/`, a ostali prefiks kao `/hr/contact/`. U blokovima poveznice i gumba uključite trenutni jezik samo za prevedene stranice web-mjesta. Isključite ga za vanjske adrese, datoteke, `mailto:`, `tel:` i WHMCS rute bez prijevoda. Provjerite poveznice na više jezika.

## SEO, mediji i izbornici

Za svaki jezik u Metapodacima unesite naslov, opis, sliku za društvene mreže, kanonski URL, robots postavke i Schema vrstu. Objavljena stranica koja nije sistemska može biti u XML karti web-mjesta. U Upravitelju medija učitajte slike, dodajte smislen alternativni tekst i nakon optimizacije provjerite kvalitetu.

U Upravitelju izbornika stvorite izbornik, dodajte stranice ili prilagođene poveznice, poredajte stavke i postavite mjesto i vidljivost. Jedno mjesto može imati samo jedan izbornik. Za zamjenu WHMCS stranice najprije objavite novu stranicu, zatim postavite zamjenu u popisu i testirajte izvorni WHMCS URL kao gost i prijavljeni korisnik.

## Alati web-mjesta

U Upravitelju preusmjeravanja unesite izvor i cilj: `301` za trajnu promjenu, `302` za privremenu. Upravitelj prepisivanja kontrolira pravila lijepih URL-ova. Generirajte karte web-mjesta i provjerite `sitemap_index.xml`. Postavke modula upravljaju i izbornicima, Smartyjem, održavanjem te uvozom i izvozom. JSON izvoz nije zamjena za potpunu sigurnosnu kopiju WHMCS-a.

Kontaktni obrazac može poslati WHMCS zahtjev za podršku ili e-poštu. Postavite polja, primatelja ili odjel podrške, privole i CAPTCHA-u, a zatim izvršite probno slanje. Ako nedostaju tablice modula, otvorite Bazu podataka modula.

## Dodatna dokumentacija (English)

[Izbornici](../english/docs/menus.md) · [Smarty](../english/docs/smarty.md) · [Paginacija](../english/docs/pagination.md) · [Karte web-mjesta](../english/docs/sitemaps.md) · [Preusmjeravanja](../english/docs/redirects.md) · [Strukturirani podaci](../english/docs/structured-data.md) · [Uvoz i izvoz](../english/docs/transfer.md).
