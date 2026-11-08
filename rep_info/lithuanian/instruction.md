# zmchel WHMCS Multimodule instrukcija

**zmchel WHMCS Multimodule yra nemokamas.** WHMCS administravimo srityje galima tvarkyti puslapius ir straipsnius naudojant vaizdinę rengyklę, vertimus, meniu, medijos biblioteką, SEO laukus, XML svetainės schemas, peradresavimus ir URL perrašymo taisykles.

## Prieš pirmą naudojimą

**Prieš pirmą naudojimą atverkite Modulio nustatymai → Palaikomos kalbos ir įjunkite reikalingas kalbas.**

Kaskart aktyvinant modulis automatiškai sugeneruoja naujas druskų reikšmes ir įrašo jas į `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Patikrinkite, ar užpildytos visos trys salt reikšmės.

## Patikrintas suderinamumas ir veikimas

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Suderinamumas su žiniatinklio serveriais

Apache palaikomas visiškai. Nginx taip pat gali veikti, tačiau kalbų maršrutizavimui pagrindiniame puslapyje gali reikėti papildomų nustatymų.

## Modulio nustatymai

Pasirinkite kalbas, kurias modulis gali naudoti. Išjungus kalbą jos turinys neištrinamas.

- **Modulio nustatymai → Palaikomos kalbos → Įjungti**
- **Modulio duomenų bazė → Taisyti Pasirinkti elementai**
- **URL perrašymo taisyklės → Patikrinti taisykles → Pridėti arba atnaujinti taisykles**

Nginx neskaito .htaccess, todėl šios taisyklės jame neveikia. Lygiavertes taisykles sukonfigūruokite nginx.

## Puslapių tvarkyklė

- **Pridėti puslapį → Puslapio pavadinimas → Puslapio URL identifikatorius (slug) → Išsaugoti**
- **Puslapių redaktorius → Turinio nustatymai → Metaduomenų nustatymai → Puslapio svetainės schemos nustatymai → Išsaugoti viską**
- **Puslapių tvarkyklė → Apsilankyti**
- **Svetainės schema → Generuoti svetainės schemas**

Leidžiamos tik lotyniškos raidės, brūkšneliai ir skaitmenys.

Prisijungę naudotojai: puslapį gali pasiekti tik prisijungę naudotojai; Svečiai: puslapį gali pasiekti tik neprisijungę lankytojai; Mišri: puslapį gali pasiekti visi, o matomumą valdo puslapio blokai.

Automatinis generavimas vykdomas po WHMCS cron, kai ateina laikas atnaujinti. Rankinis generavimas pradedamas iš karto.

## Skyrių vadovai

- [Puslapių tvarkyklė](docs/pages_manager.md)
- [Puslapių redaktorius](docs/pages_editor.md)
- [Medijos tvarkytuvė](docs/media_manager.md)
- [Meniu](docs/menu_manager.md)
- [Kalbų tvarkytuvė](docs/langs_manager.md)
- [Peradresavimai](docs/redirects_manager.md)
- [Svetainės schemos](docs/sitemap_manager.md)
- [URL perrašymo taisyklės](docs/rewrite_manager.md)
- [Modulio nustatymai](docs/module_settings.md)
- [Modulio duomenų bazė](docs/module_db.md)

## Papildoma medžiaga

- [Puslapiavimas ir filtrai](docs/pages_editor_pagination.md)
- [Smarty ir kintamieji](docs/pages_editor_smarty.md)
- [Struktūrizuoti duomenys](docs/module_structured_data.md)
- [Importas ir eksportas](docs/module_settings_transfer.md)
