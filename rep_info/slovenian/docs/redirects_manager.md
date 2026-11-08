# Preusmeritve

Vnesite stari in novi URL. Uporabite 301 za trajno in 302 za začasno spremembo; preverite izvor in se izognite preusmeritvi na isti naslov.

## HTTP

Pravila podpirajo kode HTTP `301`, `302`, `303`, `307`, `308` in veljajo le za zahtevke `GET`/`HEAD`, ki dosežejo WHMCS. Vir se natančno ujema s potjo in morebitnimi navedenimi parametri poizvedbe; parametri cilja zamenjajo stare. Upravitelj hrani pravila v `zm_pb_redirects`, vendar tabele med zahtevkom ne ustvari: uporabite **Bazo podatkov modula**. Obstoječi stolpci URL imajo omejitev 128 bajtov.

Ročna pravila imajo prednost pred samodejnimi. Sprememba sluga objavljene strani lahko po nastavljeni zakasnitvi ustvari samodejno preusmeritev `301` za vsak aktivni jezik; objava osnutka je ne ustvari. Poznejša preimenovanja posodobijo stare cilje. Pravilo s parametri poizvedbe ima prednost pred pravilom samo za pot. Izvorni URL mora pripadati temu mestu in ne sme vsebovati fragmenta `#`.
