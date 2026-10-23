# Databáza modulu

- **Databáza modulu:** `MISSING` → Vybrať → Opraviť Vybrané položky.
- **Odstrániť Vybrané položky** — Túto akciu nie je možné vrátiť späť.

Stránka **Databáza modulu** zobrazuje potrebné tabuľky a stĺpce a ich stav. Prístup k nej má iba určený superadministrátor. Otvorte ju, keď iná sekcia hlási chýbajúcu tabuľku alebo stĺpec. Prezrite si zoznam, vyberte len položky na opravu a kliknite na **Opraviť vybrané**. Niektoré stĺpce nemožno opraviť automaticky; po operácii stav opäť skontrolujte.

**Odstrániť vybrané** natrvalo odstráni zvolené databázové objekty. Pred odstránením exportujte údaje modulu a vytvorte zálohu databázy.

## Pokyny

- Prístup zamietnutý. Stránku Databáza modulu môže používať iba superadministrátor (ID …).
- Opraviť
- Vybrané položky
- Odstrániť
- Túto akciu nie je možné vrátiť späť.
- Tabuľky ponúk ešte neboli vytvorené. Pridajte ich v Databáze modulu.
- Najskôr pridajte stĺpec optimization_attempted v správcovi tabuliek modulu.

## 1. Inštalácia a prístup

Aktivujte doplnkový modul vo WHMCS a udeľte prístup oprávneným administrátorom. V databázovej sekcii modulu skontrolujte potrebné tabuľky. Prezrite si pekné URL, jazykové trasy a umiestnenie ponúk. Apache používa .htaccess; pre Nginx nastavte príslušné serverové pravidlá samostatne.
