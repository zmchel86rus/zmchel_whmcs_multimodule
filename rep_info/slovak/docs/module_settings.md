# Nastavenia modulu

- [Import a export](module_settings_transfer.md)

## Pokyny

- Vyberte jazyky, ktoré môže modul používať. Vypnutie jazyka nevymaže jeho obsah.
- Ak používate pekné URL na Apache, po zmene jazykov aktualizujte pravidlá v správcovi prepisovania.
- **Čitateľné URL adresy** — Povoliť čitateľné URL adresy vrátane systémových adries.
- **Jazykové smerovanie** — Povoliť alebo zakázať jazykové trasy. Ak sú povolené, stránky sú dostupné pod prefixmi /de/, /en/, /es/ a ďalšími podporovanými jazykovými prefixmi. Ak sú zakázané, jedna URL adresa stránky zobrazuje obsah v jazyku nastavenom používateľom.
- **Trasa predvoleného jazyka** — Pridá predvolenému jazyku vlastný prefix URL a presmeruje stránky modulu bez prefixu naň.
- **Režim údržby (modul)** — Povoliť alebo zakázať režim údržby modulu. Tento miernejší režim na rozdiel od systémového režimu údržby umožňuje fungovanie hookov WHMCS a ďalších komponentov.
- **Zhromažďovať premenné Smarty** — Povoliť alebo zakázať zhromažďovanie premenných Smarty.
- **Používať zhromaždené premenné Smarty** — Povoliť alebo zakázať používanie zhromaždených premenných Smarty v editore stránok.
- **Nahrádzanie stránok** — Povoliť alebo zakázať nahrádzanie stránok.
- **Frekvencia aktualizácie** — Ak nič nevyberiete, mapa stránok sa aktualizuje denne.
- **HTML mapa stránok** — Ak je povolená, cesta /html-sitemap zobrazuje mapu stránok ako bežnú stránku HTML; súbor sitemap.xml zostáva nezmenený.
- **Hlavička webu** — Vlastný HTML kód pre sekciu <head> vrátane <script> a <style>.
- **Pätička webu** — Vlastný HTML kód pred </body> vrátane <script> a <style>.
- **Upraviť robots.txt**

## 1. Inštalácia a prístup

Aktivujte doplnkový modul vo WHMCS a udeľte prístup oprávneným administrátorom. V databázovej sekcii modulu skontrolujte potrebné tabuľky. Prezrite si pekné URL, jazykové trasy a umiestnenie ponúk. Apache používa .htaccess; pre Nginx nastavte príslušné serverové pravidlá samostatne.
