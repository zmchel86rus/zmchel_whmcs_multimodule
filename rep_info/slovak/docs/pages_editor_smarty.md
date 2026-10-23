# Smarty a premenné

- **Nastavenia modulu → Zhromažďovať premenné Smarty → Používať zhromaždené premenné Smarty → Editor stránok.**

Pred pridaním bloku povoľte premenné Smarty. Používajte len povolené premenné, dynamické hodnoty chráňte filtrom escape a nezobrazujte osobné údaje; PHP a SQL nie sú povolené.

## Katalóg premenných

V nastaveniach modulu zapnite zber a používanie premenných Smarty, potom otvorte príslušné stránky webu a obnovte editor. Katalóg uchováva názvy, typy a štruktúru premenných, nie skutočné hodnoty alebo osobné údaje. Ak premenná chýba, navštívte znovu stránku, na ktorej sa používa.

## Editor a obmedzenia

Otvorte blok Smarty v editore stránok a vyberte premenné z katalógu. Používajte povolené podmienky a cykly; pri výpise dynamického textu pridajte `|escape`. PHP, SQL, volania metód, vkladanie súborov a `nofilter` nie sú povolené. Uložte stránku a skontrolujte verejný výstup.

## resources/available_vars/

Katalóg je iba pomôcka k premenným pozorovaným na stránke: nesprístupní ich na inej stránke. Kód sa kontroluje pri uložení a pred výstupom; blok dostane izolovanú kópiu povolených hodnôt. Sú povolené podmienky, `foreach`, lokálny `assign` a modifikátory ako `escape`, `default`, `count` a `date_format`. Výstupné hodnoty sa automaticky escapujú; zamýšľané HTML napíšte do šablóny. Ak údaje chýbajú alebo kód zlyhá, blok zostane prázdny a chyba sa zapíše do PHP logu.

Katalóg v `resources/available_vars/` uchováva názvy, typy, štruktúru a umelé príklady, nie skutočné hodnoty. Ukazuje, kde bola premenná pozorovaná, ale nesprístupňuje ju na inej stránke. Editor otvoríte dvojitým kliknutím na blok Smarty. `Ctrl+Space` hľadá premenné, `Ctrl+S` použije kód a `F11` zapne celú obrazovku. Kód beží oddelene; pri chýbajúcich údajoch blok zostane prázdny a upozornenie sa zapíše do protokolu PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Pokyny

- **Zhromažďovať premenné Smarty** — Povoliť alebo zakázať zhromažďovanie premenných Smarty.
- **Používať zhromaždené premenné Smarty** — Povoliť alebo zakázať používanie zhromaždených premenných Smarty v editore stránok.
- Premenná Smarty (PHP)
- Smarty: PHP, metódy objektov, statické volania a nofilter sú zakázané.
- Šablóna Smarty je príliš veľká.
- Smarty
- Editor Smarty
