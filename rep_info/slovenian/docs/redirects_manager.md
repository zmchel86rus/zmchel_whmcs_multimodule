# Preusmeritve

Vnesite stari in novi URL. Uporabite 301 za trajno in 302 za začasno spremembo; preverite izvor in se izognite preusmeritvi na isti naslov.

## HTTP

Pravila podpirajo kode HTTP `301`, `302`, `303`, `307`, `308` in veljajo le za zahtevke `GET`/`HEAD`, ki dosežejo WHMCS. Vir se natančno ujema s potjo in morebitnimi navedenimi parametri poizvedbe; parametri cilja zamenjajo stare. Upravitelj hrani pravila v `zm_pb_redirects`, vendar tabele med zahtevkom ne ustvari: uporabite **Bazo podatkov modula**. Obstoječi stolpci URL imajo omejitev 128 bajtov.

Ročna pravila imajo prednost pred samodejnimi. Sprememba sluga objavljene strani lahko po nastavljeni zakasnitvi ustvari samodejno preusmeritev `301` za vsak aktivni jezik; objava osnutka je ne ustvari. Poznejša preimenovanja posodobijo stare cilje. Pravilo s parametri poizvedbe ima prednost pred pravilom samo za pot. Izvorni URL mora pripadati temu mestu in ne sme vsebovati fragmenta `#`.

## Navodila

- Natančni naslovi: izvor → cilj. Izvor je pot od korenskega imenika spletnega mesta ali URL na tem spletnem mestu. Cilj je pot ali poln URL HTTP(S). Pravilo brez parametrov poizvedbe velja tudi za zahteve, ki jih vsebujejo; ciljni naslov se uporabi natanko tako, kot je vnesen. Pravila veljajo za zahteve GET/HEAD, ki dosežejo WHMCS.
- Izvor
- Cilj
- Omogočeno
- Onemogočeno
- Privzeto: 14 dni. Šteje se od zadnje spremembe objavljene strani ali njenih aktivnih prevodov; če sprememb še ni bilo, od nastanka strani. Za brez zakasnitve nastavite 0. Samodejna pravila uporabljajo HTTP 301.
- Naslovi nadomestitvenih strani samodejno preusmerjajo na sistemske strani, ki jih nadomeščajo. Če ima nadomestitev več ciljev, se uporabi prvi nastavljeni cilj. Te preusmeritve delujejo vedno, ko so nadomestitve omogočene, neodvisno od pravil upravljalnika preusmeritev.
- Vnesite veljavno pot, ki se začne z /, ali poln URL HTTP(S). Izvor mora pripadati temu spletnemu mestu; fragmenti # niso podprti.
