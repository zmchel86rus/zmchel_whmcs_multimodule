# Upravitelj stranica

## Pristup i stranice

U administraciji WHMCS-a otvorite **Addons → zmchel WHMCS Multimodule**. Popis stranica omogućuje stvaranje, pretraživanje, uređivanje i brisanje stranica. *Slug* je dio adrese nakon domene, primjerice `contact` u `/contact/`. Prije promjene URL-ova, preusmjeravanja ili pravila poslužitelja izvezite postavke modula.

Za novu stranicu unesite interni naziv i slug od latiničnih slova, znamenaka i crtica, bez domene ili `.php`. Odaberite pristup za goste, prijavljene korisnike ili sve. Zatim odaberite status (skica, objavljeno, odgođeno ili koš), vrstu (stranica, članak ili sistemska stranica) i jezike. Zadani jezik WHMCS-a mora biti u `supported_langs.php`; modul ga dodaje automatski.

Nakon spremanja otvorite stranicu i uredite **glavne postavke**, **sadržaj**, **metapodatke** i postavke **karte web-mjesta**. Svaki obrazac ima gumb Spremi; „Spremi sve” obrađuje sve obrasce. Provjerite poruke o uspjehu i javni prikaz. Brisanje prvo premješta stranicu u koš; trajno brisanje obavlja se ondje.

## URL

Filtrirajte popis po nazivu, pristupu, vrsti, statusu ili jeziku. **Posjeti** otvara javni URL. **Izbriši** najprije premješta stranicu u koš; trajno brisanje dostupno je ondje. Ako se stranica ne otvara, provjerite objavu, aktivni jezik i vrstu pristupa.

## WHMCS

Za zamjenu WHMCS stranice odaberite postojeću sistemsku adresu i objavljenu stranicu modula. Odaberite potpunu zamjenu, dodavanje prije ili poslije izvornog sadržaja ili samo meta/SEO. Spremite postavke i provjerite izvorni WHMCS URL kao gost i kao prijavljeni klijent.

## Upute

- Dodaj stranicu
- **Naziv stranice** — Interni naziv stranice
- **Slug stranice** — Dopuštena su samo latinična slova, crtice i znamenke.
- **Vrsta pristupa** — Prijavljeni korisnici: stranici mogu pristupiti samo prijavljeni korisnici; Gosti: mogu joj pristupiti samo gosti; Mješovito: mogu joj pristupiti svi, a vidljivost se kontrolira blokovima unutar stranice.
- **Vrsta stranice** — Sistemske stranice isključene su iz karte web-mjesta i nisu dostupne običnim korisnicima.
- **Jezici stranice** — Zadani jezik uvijek je uključen, bez obzira na vaš odabir.
- Potpuna zamjena zamjenjuje prikazani sadržaj i metapodatke.\ Dodaj prije umeće sadržaj prije postojećeg sadržaja stranice.\ Dodaj nakon umeće sadržaj nakon postojećeg sadržaja stranice.\ Samo metapodaci/SEO zamjenjuje metapodatke stranice.
- Navigacija popisom stranica
