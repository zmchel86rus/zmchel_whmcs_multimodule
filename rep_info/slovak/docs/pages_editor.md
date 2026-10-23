# Editor stránok

- [Stránkovanie a filtre](pages_editor_pagination.md)
- [Smarty a premenné](pages_editor_smarty.md)
- [Štruktúrované údaje](module_structured_data.md)

## 3. Úprava obsahu

Pre každý jazyk vyplňte karty Obsah, Metadáta a Mapa stránok. Presuňte bloky do editora, upravte text a obrázky a uložte každú kartu. Kopírovanie s obsahom vytvorí východisko; kopírovanie štruktúry pripraví rozloženie na preklad. Text sa neprekladá automaticky.

## 4. Odkazy a publikovanie

Pri odkazoch na preložené stránky modulu zapnite pridávanie aktuálneho jazyka do URL. Vypnite ho pre externé adresy, e-mail a trasy WHMCS bez jazykových verzií. Po publikovaní skontrolujte stránku ako hosť aj klient, na počítači a telefóne, aspoň v dvoch jazykoch.

## SEO

V základných nastaveniach skontrolujte názov, slug, typ, stav, prístup a jazyky. Predvolený jazyk WHMCS musí byť v module zapnutý; zverejnená stránka potrebuje obsah v zobrazovanom jazyku. Pre každý jazyk vyplňte titulok a opis, potom skontrolujte canonical, robots, Open Graph, navigačnú cestu a Schema. Na karte mapy webu nastavte frekvenciu a prioritu verejnej nesystémovej stránky. Uložte a skontrolujte verejnú URL a XML.

## Kontaktný formulár

Pridajte blok **Kontaktný formulár**. Vyberte **požiadavku WHMCS** a oddelenie podpory alebo **e-mail** a príjemcu; vyplňte nadpis, opis, predmet a text tlačidla. Každému poľu určite názov, typ, povinnosť a overenie. Požiadavka hosťa potrebuje polia s rolami mena a e-mailu odosielateľa. Do rozbaľovacieho zoznamu vložte jednu možnosť na riadok, napríklad `sales : Predaj`. Vytvorte samostatné pole pre každý súhlas a použite CAPTCHA nastavenú vo WHMCS. Uložte a odošlite skutočný test ako hosť; skontrolujte požiadavku alebo doručenie, chyby a vymazanie formulára. Zelený stav editora nepotvrdzuje doručenie; ak `mail()` zlyhá, nastavte SMTP vo WHMCS.

## Pokyny

- Vnorený kontajner s rozložením flex. Presuňte doň ďalšie bloky.
- Vnorený kontajner CSS Grid. Presuňte doň ďalšie bloky.
- Vnorený karusel Bootstrap. Presuňte doň bloky; každý bude samostatným snímkom.
- Všetky bloky pod týmto blokom sa zobrazujú iba prihláseným používateľom. Funguje len vtedy, keď je typ prístupu k stránke Zmiešaný.
- Všetky bloky pod týmto blokom sa zobrazujú iba hosťom. Funguje len vtedy, keď je typ prístupu k stránke Zmiešaný.
- **Nadpis stránky**
- **Meta popis**
- **Kanonická URL adresa**
- **Robots** — index, follow / noindex, nofollow. Riadi indexovanie.
- **Typ schémy** — Ak je táto možnosť zakázaná, pre stránku sa nevypisujú údaje Schema.org vo formáte JSON.
