# Správce stránek

## Přístup a stránky

V administraci WHMCS otevřete **Addons → zmchel WHMCS Multimodule**. Seznam stránek umožňuje stránky vytvářet, vyhledávat, upravovat a mazat. *Slug* je část adresy za doménou, například `contact` v `/contact/`. Před změnou URL, přesměrování nebo pravidel serveru exportujte nastavení modulu.

Při vytváření stránky zadejte interní název a slug složený z latinských písmen, číslic a pomlček, bez domény a `.php`. Vyberte přístup pro návštěvníky, přihlášené klienty nebo všechny. Poté zvolte stav (koncept, zveřejněno, odloženo nebo koš), typ (stránka, článek či systémová stránka) a jazyky. Výchozí jazyk WHMCS musí být v `supported_langs.php`; modul jej přidá automaticky.

Po uložení stránku otevřete a upravte **hlavní nastavení**, **obsah**, **metadata** a nastavení **mapy webu**. Každý formulář má vlastní tlačítko Uložit; „Uložit vše“ zpracuje všechny. Zkontrolujte potvrzení a veřejnou stránku. Smazání nejprve přesune stránku do koše; trvalé odstranění probíhá v koši.

## URL

Seznam filtrujte podle názvu, přístupu, typu, stavu nebo jazyka. **Navštívit** otevře veřejnou URL. **Smazat** stránku nejprve přesune do koše; trvalé odstranění je možné až tam. Pokud se stránka neotevře, zkontrolujte zveřejnění, aktivní jazyk a typ přístupu.

## WHMCS

Chcete-li nahradit stránku WHMCS, vyberte existující systémovou adresu a zveřejněnou stránku modulu. Zvolte úplnou náhradu, přidání před nebo za původní obsah, případně pouze meta/SEO. Uložte nastavení a vyzkoušejte původní URL WHMCS jako host i přihlášený klient.

## Pokyny

- Přidat stránku
- **Název stránky** — Interní název stránky
- **Slug stránky** — Jsou povolena pouze latinská písmena, pomlčky a číslice.
- **Typ přístupu** — Přihlášení uživatelé: ke stránce mají přístup pouze přihlášení uživatelé; Hosté: přístup mají pouze hosté; Smíšený: přístup mají všichni, přičemž viditelnost určují bloky uvnitř stránky.
- **Typ stránky** — Systémové stránky nejsou zahrnuty do mapy webu a nejsou dostupné běžným uživatelům.
- **Jazyky stránky** — Výchozí jazyk je vždy zahrnut bez ohledu na váš výběr.
- Úplné nahrazení nahradí zobrazený obsah i metadata.\ Přidat před vloží obsah před stávající obsah stránky.\ Přidat za vloží obsah za stávající obsah stránky.\ Pouze metadata/SEO nahradí metadata stránky.
- Navigace seznamem stránek
