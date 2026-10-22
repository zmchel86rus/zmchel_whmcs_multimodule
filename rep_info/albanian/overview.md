# Multimodul falas për WHMCS

**Para përdorimit, krijoni vlera salt unike në `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` dhe `ZM_PB_NONCE_SALT`.** Moduli është zhvilluar dhe testuar në **WHMCS 8.13.1–8.13.7**. Përputhshmëria me **PHP 7.4–8.5** është kontrolluar. Apache mbështetet plotësisht (100%); Nginx mund të kërkojë konfigurim shtesë për rrugëzimin e gjuhës në faqen kryesore.

**Para përdorimit të parë, hapni Cilësimet e modulit → Gjuhët e mbështetura dhe aktivizoni gjuhët që ju nevojiten.**

**zmchel WHMCS Multimodule është falas.** Nga administrimi i WHMCS mund të menaxhoni faqe shumëgjuhëshe me redaktor pamor, meny, bibliotekë mediash, metadata SEO, harta XML, ridrejtime, rregulla rewrite dhe import/eksport. Lexoni [udhëzimet](instruction.md) para se të filloni.

## Menaxheri i gjuhëve (në zhvillim)

Në administrimin WHMCS, hapni Menaxherin e gjuhëve dhe zgjidhni seksionin (klientët ose administratorët e WHMCS, këtë modul ose një modul tjetër) dhe gjuhën. Krahasoni tekstin origjinal ose referencën me përkthimin, ndryshoni një rresht dhe ruajeni; çelësat ekzistues mund të eksportohen dhe importohen edhe si JSON. Gjuhët e saposhtuara përdorin referencën derisa të përkthehen. Menaxheri aktivizon ose çaktivizon skedarët e gjuhës dhe korrigjon emrat e vjetër të skedarëve; gjuhën e parazgjedhur ndryshojeni fillimisht në WHMCS.

## Zhvillimi i ardhshëm

- Shtimi i faqeve të ndërfutura dhe kategorive ose rubrikave.
- Ndarja e kodit monolit në përbërës që bashkëveprojnë.
- Krijimi i menaxherit të të drejtave të administratorëve dhe zgjerimi i gjuhëve në `supported_langs.php`.
- Krijimi i një redaktori kodi për skedarët `.tpl` të modulit dhe temat e klientit WHMCS, pa temën e administrimit.
- Zhvillimi i menaxherit të gjuhëve për skedarët e modulit dhe WHMCS, si edhe përmirësimi i menaxherit të mediave.
- Ndërtimi i një menaxheri të plotë SEO, të frymëzuar nga Yoast SEO, por më të optimizuar.
- Shtimi i hartave shumëgjuhëshe të faqes dhe i një faqeje harte HTML.
- Shtimi i statistikave të përdorimit te menaxheri i faqeve.
- Krijimi i menaxherit të optimizimit për zvogëlimin e JS, CSS e HTML, memorien e faqeve të plota dhe tabelat e modulit e WHMCS.
- Krijimi i një sistemi të plotë për përditësimet e modulit.

Këto janë **ide për të ardhmen, jo një plan i pandryshueshëm**.

## Sugjeroni një ide ose bëni pyetje

[Dërgoni sugjerim](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) ose [bëni pyetje](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E): `ackirkin@gmail.com`.
