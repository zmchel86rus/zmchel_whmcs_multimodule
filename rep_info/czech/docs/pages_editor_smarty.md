# Smarty

- **Nastavení modulu → Shromažďovat proměnné Smarty → Používat shromážděné proměnné Smarty → Editor stránek.**

## Katalog proměnných

V nastavení modulu zapněte sběr a použití proměnných Smarty, potom otevřete příslušné stránky webu a obnovte editor. Katalog ukládá názvy, typy a strukturu proměnných, nikoli skutečné hodnoty nebo osobní údaje. Pokud proměnná chybí, navštivte znovu stránku, kde se používá.

## Editor a omezení

Otevřete blok Smarty v editoru stránek a vyberte proměnné z katalogu. Používejte povolené podmínky a cykly; při výpisu dynamického textu přidejte `|escape`. PHP, SQL, volání metod, vkládání souborů a `nofilter` nejsou povoleny. Uložte stránku a zkontrolujte veřejný výstup.

## resources/available_vars/

Katalog je jen vodítkem k proměnným pozorovaným na stránce: nezpřístupní je na jiné stránce. Kód se ověřuje při uložení i před výstupem; blok dostane izolovanou kopii povolených hodnot. Lze použít podmínky, `foreach`, lokální `assign` a modifikátory jako `escape`, `default`, `count` a `date_format`. Výstupní hodnoty se automaticky escapují; zamýšlené HTML napište do šablony. Pokud data chybí nebo kód selže, blok zůstane prázdný a chyba se zapíše do PHP logu.

Katalog v `resources/available_vars/` uchovává názvy, typy, strukturu a umělé příklady, nikoli skutečné hodnoty. Ukazuje, kde byla proměnná zaznamenána, ale nezpřístupňuje ji na jiné stránce. Editor otevřete dvojitým kliknutím na blok Smarty. `Ctrl+Space` vyhledá proměnnou, `Ctrl+S` použije kód a `F11` zapne celou obrazovku. Kód běží odděleně; pokud data chybí, blok zůstane prázdný a upozornění se zapíše do protokolu PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Pokyny

- **Shromažďovat proměnné Smarty** — Zapnout nebo vypnout shromažďování proměnných Smarty.
- **Používat shromážděné proměnné Smarty** — Zapnout nebo vypnout používání shromážděných proměnných Smarty v editoru stránek.
- Proměnná Smarty (PHP)
- Smarty: PHP, metody objektů, statická volání a nofilter jsou zakázány.
- Šablona Smarty je příliš velká.
- Smarty
- Editor Smarty

