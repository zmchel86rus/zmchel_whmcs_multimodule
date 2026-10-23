# Nastavitve modula

- [Uvoz in izvoz](module_settings_transfer.md)

## Navodila

- Izberite jezike, ki jih modul lahko uporablja. Izklop jezika ne izbriše njegove vsebine.
- Če uporabljate lepe URL-je na Apache, po spremembi jezikov posodobite pravila v upravljalniku prepisovanja.
- **Berljivi URL-ji** — Omogočite berljive URL-je, vključno s sistemskimi URL-ji.
- **Usmerjanje glede na jezik** — Omogočite ali onemogočite jezikovne poti. Ko so omogočene, so strani dostopne s predponami /de/, /en/, /es/ in drugimi podprtimi jezikovnimi predponami. Ko so onemogočene, en sam URL strani prikazuje vsebino v jeziku, nastavljenem za uporabnika.
- **Pot privzetega jezika** — Privzetemu jeziku doda predpono URL in nanjo preusmeri strani modula brez predpone.
- **Način vzdrževanja (modul)** — Omogočite ali onemogočite način vzdrževanja modula. Ta blažji način za razliko od sistemskega načina vzdrževanja omogoča izvajanje kavljev WHMCS in drugih komponent.
- **Zbiranje spremenljivk Smarty** — Omogočite ali onemogočite zbiranje spremenljivk Smarty.
- **Uporaba zbranih spremenljivk Smarty** — Omogočite ali onemogočite uporabo zbranih spremenljivk Smarty v urejevalniku strani.
- **Nadomestitve strani** — Omogočite ali onemogočite nadomestitve strani.
- **Pogostost posodabljanja** — Če ni izbrana nobena možnost, se zemljevid spletnega mesta posodablja vsak dan.
- **Zemljevid spletnega mesta HTML** — Ko je možnost omogočena, /html-sitemap prikazuje zemljevid spletnega mesta kot običajno stran HTML; sitemap.xml ostane nespremenjen.
- **Glava spletnega mesta** — Koda HTML po meri za razdelek <head>, vključno z <script> in <style>.
- **Noga spletnega mesta** — Koda HTML po meri pred </body>, vključno z <script> in <style>.
- **Uredi robots.txt**

## 1. Namestitev in dostop

V WHMCS aktivirajte dodatni modul in dodelite dostop pooblaščenim skrbnikom. V zbirki podatkov modula preverite potrebne tabele. Preglejte prijazne URL-je, jezikovne poti in položaje menijev. Apache uporablja .htaccess; v Nginxu enakovredna strežniška pravila nastavite posebej.
