# Přesměrování

Přesné adresy: zdroj → cíl. Zdrojem je cesta od kořene webu nebo URL na tomto webu. Cílem je cesta nebo úplná URL HTTP(S). Pravidlo bez parametrů dotazu odpovídá i požadavkům s těmito parametry; cílová adresa se použije v zadané podobě. Pravidla se vztahují na požadavky GET/HEAD, které dorazí do WHMCS.

Výchozí hodnota: 14 dní. Počítá se od poslední změny publikované stránky nebo jejích aktivních překladů; pokud nikdy nebyla změněna, od vytvoření. Hodnota 0 znamená bez prodlevy. Automatická pravidla používají HTTP 301.

Adresy nahrazovaných stránek se automaticky přesměrovávají na systémové stránky, které nahrazují. Pokud má nahrazení více cílů, použije se první nastavený. Tato přesměrování fungují vždy, když je nahrazování stránek povoleno, nezávisle na pravidlech Správce přesměrování.

Zadejte platnou cestu začínající / nebo úplnou URL HTTP(S). Zdroj musí patřit tomuto webu; fragmenty # nejsou podporovány.

## HTTP

Pravidla podporují HTTP kódy `301`, `302`, `303`, `307`, `308` a platí jen pro požadavky `GET`/`HEAD`, které dorazí do WHMCS. Zdroj se porovnává přesně podle cesty a případně zadaných parametrů; parametry cíle nahrazují původní. Správce ukládá pravidla do `zm_pb_redirects`, ale během požadavku tabulku nevytváří: použijte **Databázi modulu**. Stávající sloupce URL mají limit 128 bajtů.

Ruční pravidla mají přednost před automatickými. Změna slugu zveřejněné stránky může po nastavené prodlevě vytvořit automatické `301` pro každý aktivní jazyk; zveřejnění konceptu nikoli. Pozdější přejmenování aktualizuje cíle starších pravidel. Pravidlo s parametry dotazu má přednost před pravidlem pouze pro cestu. Zdrojová URL musí patřit tomuto webu a nesmí obsahovat fragment `#`.

## Pokyny

- Zdroj
- Cíl
- Povoleno
- Zakázáno
