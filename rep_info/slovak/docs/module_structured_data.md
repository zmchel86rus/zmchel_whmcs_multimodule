# Štruktúrované údaje

- **Editor stránok → Nastavenia metadát → Typ schémy → Uložiť.**

Pre každý jazyk vyplňte metadáta a vhodný typ stránky: WebPage, typ článku alebo ContactPage. Po publikovaní skontrolujte JSON-LD a kanonickú URL.

## Čo modul označuje

Ponuky a obsah stránky môžu vytvárať `SiteNavigationElement`, viditeľné otázky a odpovede `FAQPage` a navigačná cesta s viacerými položkami `BreadcrumbList`. Bloky rozloženia, tlačidlá a filtre nedostávajú typ obsahu automaticky. Typ Schema vybraný pre stránku riadi jej JSON-LD; ak je vypnutý, toto značkovanie sa nevypíše.

## Kontrola po zverejnení

Na verejnej stránke overte JSON-LD, kanonickú URL, jazyk a skutočne viditeľný obsah. Platné značkovanie nezaručuje rozšírený výsledok vyhľadávania.

## Schema.org

`SiteNavigationElement` používa naozaj viditeľné odkazy a názvy ponuky; obsah stránky môže pridať `WebPageElement` pre nadpisy, ktoré skutočne existujú. `FAQPage` zahŕňa len úplné otázky a odpovede viditeľné návštevníkovi: skryté bloky a bežné akordeóny sa vynechávajú. `BreadcrumbList` vzniká iba pri aspoň dvoch položkách. Údaje organizácie pochádzajú z WHMCS; kontaktné jazyky sú v `ContactPoint.availableLanguage` vo formáte BCP 47. Pri filtroch, stránkovaní, formulároch a vlastnom HTML sa typ Schema neodhaduje.

## Pokyny

- **Typ schémy** — Ak je táto možnosť zakázaná, pre stránku sa nevypisujú údaje Schema.org vo formáte JSON.
- **Drobečková navigácia** — Názov stránky v drobečkovej navigácii
- **Kanonická URL adresa**
- **Nadpis stránky**
- **Meta popis**
- **Nadpis Open Graph** — Ak je pole prázdne, použije sa nadpis stránky.
- **Popis Open Graph** — Ak je pole prázdne, použije sa meta popis.
- **Obrázok Open Graph** — Ak je pole prázdne, použije sa obrázok stránky.
