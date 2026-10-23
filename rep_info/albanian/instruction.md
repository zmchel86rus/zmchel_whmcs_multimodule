# Udhëzime për zmchel WHMCS Multimodule

**Para përdorimit, krijoni vlera salt unike në `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` dhe `ZM_PB_NONCE_SALT`.** Moduli është zhvilluar dhe testuar në **WHMCS 8.13.1–8.13.7**. Përputhshmëria me **PHP 7.4–8.5** është kontrolluar. Apache mbështetet plotësisht (100%); Nginx mund të kërkojë konfigurim shtesë për rrugëzimin e gjuhës në faqen kryesore.

**Para përdorimit të parë, hapni Cilësimet e modulit → Gjuhët e mbështetura dhe aktivizoni gjuhët që ju nevojiten.**

**zmchel WHMCS Multimodule është falas.** Nga administrimi i WHMCS mund të menaxhoni faqe shumëgjuhëshe me redaktor pamor, meny, bibliotekë mediash, metadata SEO, harta XML, ridrejtime, rregulla rewrite dhe import/eksport.

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
