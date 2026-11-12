# Presmerovania

Zadajte starú a novú URL. Pre trvalú zmenu použite 301 a pre dočasnú 302; skontrolujte zdroj a vyhnite sa presmerovaniu na tú istú adresu.

## HTTP

Pravidlá podporujú HTTP kódy `301`, `302`, `303`, `307`, `308` a platia iba pre požiadavky `GET`/`HEAD`, ktoré dorazia do WHMCS. Zdroj sa presne porovná podľa cesty a uvedených parametrov dotazu; parametre cieľa nahradia pôvodné. Správca ukladá pravidlá do `zm_pb_redirects`, ale počas požiadavky tabuľku nevytvára: použite **Databázu modulu**. Existujúce stĺpce URL majú limit 128 bajtov.

Ručné pravidlá majú prednosť pred automatickými. Zmena slugu zverejnenej stránky môže po nastavenej čakacej dobe vytvoriť automatické `301` pre každý aktívny jazyk; zverejnenie konceptu ho nevytvorí. Neskoršie premenovania aktualizujú staré ciele. Pravidlo s parametrami dotazu má prednosť pred pravidlom len pre cestu. Zdrojová URL musí patriť tomuto webu a nesmie obsahovať fragment `#`.
