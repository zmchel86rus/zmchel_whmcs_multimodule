# Podatkovna zbirka modula

- **Podatkovna zbirka modula:** `MISSING` → Izberi → Popravi Izbrani elementi.
- **Izbriši Izbrani elementi** — Tega dejanja ni mogoče razveljaviti.

Stran **Podatkovna zbirka modula** prikazuje potrebne tabele in stolpce ter njihovo stanje. Dostopna je samo določenemu superadministratorju. Odprite jo, ko drug razdelek javi manjkajočo tabelo ali stolpec. Preglejte seznam, označite le elemente za popravilo in kliknite **Popravi izbrane**. Nekaterih stolpcev ni mogoče popraviti samodejno; nato ponovno preverite stanje.

**Izbriši izbrane** trajno odstrani izbrane podatkovne objekte. Pred brisanjem izvozite podatke modula in ustvarite varnostno kopijo zbirke.

## Navodila

- Dostop zavrnjen. Stran Podatkovna zbirka modula lahko uporablja samo glavni skrbnik (ID …).
- Popravi
- Izbrani elementi
- Izbriši
- Tega dejanja ni mogoče razveljaviti.
- Tabele menijev še niso ustvarjene. Dodajte jih v razdelku Podatkovna zbirka modula.
- Najprej dodajte stolpec optimization_attempted v upravljalniku tabel modula.

## 1. Namestitev in dostop

V WHMCS aktivirajte dodatni modul in dodelite dostop pooblaščenim skrbnikom. V zbirki podatkov modula preverite potrebne tabele. Preglejte prijazne URL-je, jezikovne poti in položaje menijev. Apache uporablja .htaccess; v Nginxu enakovredna strežniška pravila nastavite posebej.
