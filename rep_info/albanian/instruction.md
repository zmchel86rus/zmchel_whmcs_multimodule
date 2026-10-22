# Udhëzime për zmchel WHMCS Multimodule

**Para përdorimit të modulit, krijoni vlera salt unike dhe vendosini në `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` dhe `ZM_PB_NONCE_SALT`.** Moduli është zhvilluar dhe testuar në **WHMCS 8.13.1–8.13.7**. Përputhshmëria me **PHP 7.4–8.5** është kontrolluar. Apache mbështetet plotësisht; Nginx mund të kërkojë konfigurim shtesë për rrugëzimin e gjuhës në faqen kryesore. **Moduli është falas.**

**Para përdorimit të parë, hapni Cilësimet e modulit → Gjuhët e mbështetura dhe aktivizoni gjuhët që ju nevojiten.**

## Menaxheri i gjuhëve (në zhvillim)

Në administrimin WHMCS, hapni Menaxherin e gjuhëve dhe zgjidhni seksionin (klientët ose administratorët e WHMCS, këtë modul ose një modul tjetër) dhe gjuhën. Krahasoni tekstin origjinal ose referencën me përkthimin, ndryshoni një rresht dhe ruajeni; çelësat ekzistues mund të eksportohen dhe importohen edhe si JSON. Gjuhët e saposhtuara përdorin referencën derisa të përkthehen. Menaxheri aktivizon ose çaktivizon skedarët e gjuhës dhe korrigjon emrat e vjetër të skedarëve; gjuhën e parazgjedhur ndryshojeni fillimisht në WHMCS.

## Krijimi i faqeve

Në administrimin e WHMCS, hapni **Addons → zmchel WHMCS Multimodule**. Eksportoni cilësimet para ndryshimeve në URL, ridrejtime ose rregulla të serverit. Te lista e faqeve, shtoni një faqe me emër të brendshëm dhe *slug* si `rreth-nesh`, pa domen ose `.php`. Zgjidhni qasjen për të gjithë, për përdorues të identifikuar ose të përzier; pastaj caktoni statusin draft apo publikuar, llojin dhe gjuhët. Gjuha e parazgjedhur e WHMCS duhet të jetë në `supported_langs.php`.

Pas ruajtjes, hapni faqen dhe plotësoni përmbajtjen, metadatat dhe cilësimet e hartës së faqes për secilën gjuhë. Çdo seksion ka butonin e vet Ruaj. Kontrolloni njoftimin e rezultatit dhe faqen publike. Fshirja e parë e zhvendos faqen në kosh; fshirja përfundimtare bëhet aty.

## Redaktori dhe gjuhët

Zgjidhni gjuhën në skedën e përmbajtjes, tërhiqni blloqet GrapesJS në hapësirën e punës dhe ndryshoni tekstin, figurat dhe cilësimet. Ka seksione, kolona, tabela, FAQ, formular kontakti, lista, faqëzim dhe zona për vizitorë ose anëtarë. Mund të kopjoni strukturën në një gjuhë tjetër dhe të përktheni tekstin para publikimit. Blloqet e lidhjeve dhe butonave mund t'i shtojnë gjuhën aktuale URL-së së brendshme; çaktivizojeni për lidhje të jashtme, skedarë, `mailto:` dhe rrugë WHMCS pa përkthim.

Me URL të bukura dhe rrugëzim gjuhësh aktiv, gjuha kryesore përdor rrugë të shkurtër si `/sq/`, ose pa prefiks nëse rruga e gjuhës së parazgjedhur është çaktivizuar. Variantet rajonale përdorin locale BCP 47. Testoni lidhjet në disa gjuhë.

## SEO, media dhe mirëmbajtja

Plotësoni titullin, përshkrimin, robots, URL-në kanonike dhe të dhënat sociale për secilën gjuhë. Një faqe e publikuar që nuk është faqe sistemi mund të përfshihet në hartën XML. Ngarkoni figurat në Media Manager, shtoni tekst alternativ dhe kontrolloni cilësinë pas optimizimit. Në Menu Manager renditni faqet dhe lidhjet e personalizuara, caktoni emërtimet sipas gjuhës dhe vendndodhjen.

Redirect Manager krijon ridrejtime të përhershme `301` ose të përkohshme `302`. Rewrite Manager shkruan rregullat `.htaccess` për Apache; Nginx kërkon rregulla përkatëse në server. Eksportoni JSON përpara një importi të madh. Udhëzime të hollësishme në anglisht: [menytë](../english/docs/menus.md), [faqëzimi](../english/docs/pagination.md), [ridrejtimet](../english/docs/redirects.md), [hartat e faqes](../english/docs/sitemaps.md), [Smarty](../english/docs/smarty.md), [të dhënat e strukturuara](../english/docs/structured-data.md), [transferimi i të dhënave](../english/docs/transfer.md).
