# Presmerovania

Zadajte starú a novú URL. Pre trvalú zmenu použite 301 a pre dočasnú 302; skontrolujte zdroj a vyhnite sa presmerovaniu na tú istú adresu.

## HTTP

Pravidlá podporujú HTTP kódy `301`, `302`, `303`, `307`, `308` a platia iba pre požiadavky `GET`/`HEAD`, ktoré dorazia do WHMCS. Zdroj sa presne porovná podľa cesty a uvedených parametrov dotazu; parametre cieľa nahradia pôvodné. Správca ukladá pravidlá do `zm_pb_redirects`, ale počas požiadavky tabuľku nevytvára: použite **Databázu modulu**. Existujúce stĺpce URL majú limit 128 bajtov.

Ručné pravidlá majú prednosť pred automatickými. Zmena slugu zverejnenej stránky môže po nastavenej čakacej dobe vytvoriť automatické `301` pre každý aktívny jazyk; zverejnenie konceptu ho nevytvorí. Neskoršie premenovania aktualizujú staré ciele. Pravidlo s parametrami dotazu má prednosť pred pravidlom len pre cestu. Zdrojová URL musí patriť tomuto webu a nesmie obsahovať fragment `#`.

## Pokyny

- Presné adresy: zdroj → cieľ. Zdrojom je cesta od koreňového priečinka webu alebo URL adresa na tomto webe. Cieľom je cesta alebo úplná URL adresa HTTP(S). Pravidlo bez parametrov dotazu zodpovedá aj požiadavkám s týmito parametrami; cieľ sa použije v zadanej podobe. Pravidlá sa vzťahujú na požiadavky GET/HEAD, ktoré sa dostanú do WHMCS.
- Zdroj
- Cieľ
- Povolené
- Zakázané
- Predvolené: 14 dní. Počíta sa od poslednej zmeny publikovanej stránky alebo jej aktívnych prekladov; ak sa nikdy nemenili, od vytvorenia. Hodnota 0 znamená bez čakania. Automatické pravidlá používajú HTTP 301.
- Adresy stránok, ktoré nahrádzajú systémové stránky, sa automaticky presmerujú na pôvodné systémové stránky. Ak má nahradenie viacero cieľov, použije sa prvý nakonfigurovaný cieľ. Tieto presmerovania fungujú vždy, keď je nahrádzanie stránok povolené, nezávisle od pravidiel Správcu presmerovaní.
- Zadajte platnú cestu začínajúcu znakom / alebo úplnú URL adresu HTTP(S). Zdroj musí patriť tomuto webu; fragmenty # nie sú podporované.
