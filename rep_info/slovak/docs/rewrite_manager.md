# Pravidlá prepisovania URL

## .htaccess

Otvorte správcu a porovnajte pravidlá s hlavným súborom `.htaccess`. Pre vlastné pravidlo uložte vzor URL, cieľ a príznaky, potom kliknite na **Pridať alebo aktualizovať pravidlá**, aby sa blok zapísal pred pravidlá WHMCS. Znova skontrolujte stav a otvorte zverejnenú stránku v predvolenom a ďalšom jazyku. Príliš široký vzor môže ovplyvniť iné stránky. Pri Nginx → Apache pravidlá platia len pre požiadavky odovzdané Apache.

## Pokyny

- Pravidlá pre jazykové URL adresy vrátane stránok s prefixmi /ru/, /en/ a ďalšími. Jazyky sa načítavajú zo súboru supported_langs.php; pravidlá sa vkladajú do .htaccess pred pravidlá WHMCS.
- Nginx nečíta súbor .htaccess, preto tam tieto pravidlá nefungujú. Nastavte zodpovedajúce pravidlá v nginx.
- Zistila sa konfigurácia nginx → Apache. Tieto pravidlá fungujú iba pre požiadavky presmerované na Apache; nginx súbor .htaccess nečíta.
- Skontrolovať pravidlá
- Pridať alebo aktualizovať pravidlá
- Odstrániť všetky pravidlá zo súboru .htaccess
- Vzor URL adresy
- Cieľ
- Príznaky
- Po pridaní alebo odstránení pravidla kliknite na „Pridať alebo aktualizovať pravidlá“, aby sa zmeny použili v súbore .htaccess.

## 1. Inštalácia a prístup

Aktivujte doplnkový modul vo WHMCS a udeľte prístup oprávneným administrátorom. V databázovej sekcii modulu skontrolujte potrebné tabuľky. Prezrite si pekné URL, jazykové trasy a umiestnenie ponúk. Apache používa .htaccess; pre Nginx nastavte príslušné serverové pravidlá samostatne.
