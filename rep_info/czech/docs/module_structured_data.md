# Strukturovaná data

- **Editor stránek → Nastavení metadat → Typ schématu → Uložit.**

## Co modul označuje

Nabídky a obsah stránky mohou vytvářet `SiteNavigationElement`, viditelné otázky a odpovědi `FAQPage` a navigační cesta s více položkami `BreadcrumbList`. Blokům rozvržení, tlačítkům a filtrům se typ obsahu nepřiřazuje automaticky. Typ Schema vybraný pro stránku řídí její JSON-LD; pokud je vypnutý, toto značkování se nevypíše.

## Kontrola po zveřejnění

Na veřejné stránce ověřte JSON-LD, kanonickou URL, jazyk a skutečně viditelný obsah. Platné značkování nezaručuje rozšířený výsledek vyhledávání.

## Schema.org

`SiteNavigationElement` používá skutečně viditelné odkazy a názvy nabídky; obsah stránky může přidat `WebPageElement` pro nadpisy, které opravdu existují. `FAQPage` zahrnuje jen úplné otázky a odpovědi viditelné návštěvníkovi: skryté bloky a běžné akordeony se vynechávají. `BreadcrumbList` vzniká pouze při alespoň dvou položkách. Údaje o organizaci pocházejí z WHMCS; kontaktní jazyky jsou v `ContactPoint.availableLanguage` ve formátu BCP 47. U filtrů, stránkování, formulářů a vlastního HTML se typ Schema neodhaduje.

## Pokyny

- **Typ schématu** — Je-li zakázáno, značkování Schema.org JSON se pro tuto stránku nevypisuje.
- **Drobečková navigace** — Název stránky v drobečkové navigaci
- **Kanonická URL**
- **Titulek stránky**
- **Meta popis**
- **Titulek Open Graph** — Je-li prázdný, použije se titulek stránky.
- **Popis Open Graph** — Je-li prázdný, použije se meta popis.
- **Obrázek Open Graph** — Je-li prázdný, použije se obrázek stránky.

