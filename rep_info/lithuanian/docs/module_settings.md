# Modulio nustatymai

- [Importas ir eksportas](module_settings_transfer.md)

## Instrukcijos

- Pasirinkite kalbas, kurias modulis gali naudoti. Išjungus kalbą jos turinys neištrinamas.
- Jei naudojate patogius URL su Apache, pakeitę kalbas atnaujinkite taisykles perrašymo tvarkytuvėje.
- **Supaprastinti URL** — Įjungti supaprastintus URL, įskaitant sistemos URL.
- **Kalbų maršrutizavimas** — Įjungti arba išjungti kalbinius maršrutus. Įjungus puslapiai pasiekiami su /de/, /en/, /es/ ir kitais palaikomų kalbų prefiksais. Išjungus vienas puslapio URL rodo turinį naudotojo nustatyta kalba.
- **Numatytosios kalbos maršrutas** — Prideda numatytajai kalbai URL priešdėlį ir nukreipia į jį modulio puslapius be priešdėlio.
- **Priežiūros režimas (modulis)** — Įjungti arba išjungti modulio priežiūros režimą. Šis švelnesnis režimas leidžia veikti WHMCS kabliukams (hooks) ir kitiems komponentams, kitaip nei sistemos priežiūros režimas.
- **Rinkti „Smarty“ kintamuosius** — Įjungti arba išjungti „Smarty“ kintamųjų rinkimą.
- **Naudoti surinktus „Smarty“ kintamuosius** — Įjungti arba išjungti surinktų „Smarty“ kintamųjų naudojimą puslapių redaktoriuje.
- **Puslapių perrašymai** — Įjungti arba išjungti puslapių perrašymus.
- **Atnaujinimo dažnumas** — Jei nieko nepasirinkta, svetainės schema atnaujinama kasdien.
- **HTML svetainės schema** — Įjungus /html-sitemap rodo svetainės schemą kaip įprastą HTML puslapį; sitemap.xml nesikeičia.
- **Svetainės antraštės sritis** — Pasirinktinis HTML, skirtas <head> sričiai, įskaitant <script> ir <style>.
- **Svetainės poraštė** — Pasirinktinis HTML prieš </body>, įskaitant <script> ir <style>.
- **Redaguoti robots.txt**

## 1. Diegimas ir prieiga

Įjunkite papildomą modulį WHMCS ir suteikite prieigą įgaliotiems administratoriams. Modulio duomenų bazės skiltyje patikrinkite būtinas lenteles. Peržiūrėkite tvarkingus URL, kalbų maršrutus ir meniu vietas. Apache naudoja .htaccess; Nginx atveju atitinkamas serverio taisykles nustatykite atskirai.
