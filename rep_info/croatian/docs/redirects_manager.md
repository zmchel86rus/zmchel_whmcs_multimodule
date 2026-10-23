# Preusmjeravanja

Točne adrese: izvor → odredište. Izvor je putanja od korijena web-mjesta ili URL na ovom web-mjestu. Odredište je putanja ili puni HTTP(S) URL. Pravilo bez parametara upita odgovara i zahtjevima koji ih sadrže; odredište se koristi onako kako je uneseno. Pravila se primjenjuju na GET/HEAD zahtjeve koji stignu do WHMCS-a.

Zadano: 14 dana. Računa se od posljednje promjene objavljene stranice ili njezinih aktivnih prijevoda; ako nije mijenjana, od stvaranja. Postavite 0 za primjenu bez odgode. Automatska pravila koriste HTTP 301.

Adrese zamjenskih stranica automatski se preusmjeravaju na sistemske stranice koje zamjenjuju. Ako zamjena ima više odredišta, koristi se prvo konfigurirano. Ta preusmjeravanja rade kad god su zamjene omogućene, neovisno o pravilima Upravitelja preusmjeravanja.

Unesite valjanu putanju koja počinje znakom / ili puni HTTP(S) URL. Izvor mora pripadati ovom web-mjestu; fragmenti # nisu podržani.

## HTTP

Pravila podržavaju HTTP kodove `301`, `302`, `303`, `307`, `308` i primjenjuju se samo na zahtjeve `GET`/`HEAD` koji stignu u WHMCS. Izvor se točno uspoređuje s putanjom i, ako su zadani, parametrima upita; parametri odredišta zamjenjuju stare. Upravitelj sprema pravila u `zm_pb_redirects`, ali ne stvara tablicu tijekom zahtjeva: koristite **Bazu podataka modula**. Postojeći URL stupci ograničeni su na 128 bajtova.

Ručna pravila imaju prednost pred automatskima. Promjena sluga objavljene stranice može nakon zadane odgode stvoriti automatski `301` za svaki aktivni jezik; objava skice to ne čini. Kasnija preimenovanja ažuriraju odredišta starih pravila. Pravilo s parametrima upita ima prednost pred pravilom samo za putanju. Izvorni URL mora pripadati ovom web-mjestu i ne smije sadržavati fragment `#`.

## Upute

- Izvor
- Odredište
- Omogućeno
- Onemogućeno
