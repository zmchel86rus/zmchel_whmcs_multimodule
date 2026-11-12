[![Ndjekës](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=Ndjek%C3%ABs)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Yje](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Yje)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Degëzime](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Deg%C3%ABzime)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Çështje](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%C3%87%C3%ABshtje)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Udhëzime për zmchel WHMCS Multimodule

**zmchel WHMCS Multimodule është falas.** Nga administrimi i WHMCS mund të menaxhoni faqe shumëgjuhëshe me redaktor pamor, meny, bibliotekë mediash, metadata SEO, harta XML, ridrejtime, rregulla rewrite dhe import/eksport.

## Para përdorimit të parë

**Para përdorimit të parë, hapni Cilësimet e modulit → Gjuhët e mbështetura dhe aktivizoni gjuhët që ju nevojiten.**

Në çdo aktivizim, moduli krijon automatikisht vlera të reja salt dhe i shkruan në `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Kontrolloni që të tre vlerat salt të jenë plotësuar.

## Përputhshmëria dhe funksionimi i testuar

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Përputhshmëria me serverët web

Apache mbështetet plotësisht (100%); Nginx mund të kërkojë konfigurim shtesë për rrugëzimin e gjuhës në faqen kryesore.

## Cilësimet e modulit

Zgjidhni gjuhët që mund të përdorë moduli. Çaktivizimi i një gjuhe nuk e fshin përmbajtjen e saj.

- **Cilësimet e modulit → Gjuhët e mbështetura → Aktivizo**
- **Baza e të dhënave e modulit → Rregullo Elementet e përzgjedhura**
- **Rregullat e rishkrimit → Kontrollo rregullat → Shto ose përditëso rregullat**

Nginx nuk e lexon skedarin .htaccess, prandaj këto rregulla nuk funksionojnë aty. Konfiguroni rregulla të barasvlershme në nginx.

## Menaxheri i faqeve

- **Shto faqe → Emri i faqes → Slug-u i faqes → Ruaj**
- **Redaktori i faqeve → Cilësimet e përmbajtjes → Cilësimet e metadatave → Cilësimet e hartës së faqes → Ruaj të gjitha**
- **Menaxheri i faqeve → Vizito**
- **Harta e sajtit → Gjenero hartat e sajtit**

Lejohen vetëm shkronjat latine, vizat lidhëse dhe shifrat.

Përdoruesit e identifikuar: vetëm përdoruesit e identifikuar mund të hyjnë në faqe; Vizitorët: vetëm vizitorët mund të hyjnë; I përzier: të gjithë mund të hyjnë, ndërsa dukshmëria kontrollohet nga blloqet brenda faqes.

Gjenerimi automatik kryhet pas cron-it të WHMCS kur është koha për përditësim. Gjenerimi manual nis menjëherë.

## Udhëzuesit sipas seksioneve

- [Menaxheri i faqeve](docs/pages_manager.md)
- [Redaktori i faqeve](docs/pages_editor.md)
- [Menaxheri i mediave](docs/media_manager.md)
- [menytë](docs/menu_manager.md)
- [Menaxheri i gjuhëve](docs/langs_manager.md)
- [ridrejtimet](docs/redirects_manager.md)
- [hartat e faqes](docs/sitemap_manager.md)
- [Rregullat e rishkrimit](docs/rewrite_manager.md)
- [Cilësimet e modulit](docs/module_settings.md)
- [Baza e të dhënave e modulit](docs/module_db.md)

## Materiale shtesë

- [faqëzimi](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [të dhënat e strukturuara](docs/module_structured_data.md)
- [transferimi i të dhënave](docs/module_settings_transfer.md)
