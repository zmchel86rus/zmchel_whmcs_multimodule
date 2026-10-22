# Vejledning til zmchel WHMCS Multimodule

**Generér unikke salts før brug, og indsæt ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT og ZM_PB_NONCE_SALT i module_init.php.** Modulet er udviklet og testet med WHMCS 8.13.1–8.13.7. Apache understøttes fuldt ud. Nginx kan fungere, men sprogruter på forsiden kan kræve ekstra konfiguration.

**Før første brug skal du åbne Modulindstillinger → Understøttede sprog og aktivere de sprog, du har brug for.**

**Kontrollerede PHP-versioner:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 og 8.5.

**zmchel WHMCS Multimodule er gratis.** Administrér sider og artikler fra WHMCS-administrationen med visuel editor, oversættelser, menuer, mediefiler, SEO-felter, XML-sitemaps, viderestillinger og omskrivningsregler.

## Sprogstyring (under udvikling)

Åbn Sprogstyring i WHMCS-administrationen, og vælg en sektion (WHMCS-klient- eller administratorsprog, dette modul eller et andet modul) og et sprog. Sammenlign originalen eller referencen med oversættelsen, rediger én række, og gem den; eksisterende nøgler kan også eksporteres og importeres som JSON. Nye sprog bruger referencen, indtil de oversættes. Styringen aktiverer og deaktiverer sprogfiler og retter gamle filnavne; skift først standardsprog i WHMCS.

## 1. Installation og adgang

Aktivér tilføjelsesmodulet i WHMCS, og giv relevante medarbejdere adgang. Kontrollér de nødvendige tabeller under Moduldatabase. Gennemgå derefter pæne URL'er, sprogruter og menuområder. Apache bruger .htaccess; på Nginx skal tilsvarende serverregler konfigureres særskilt.

## 2. Opret sider

Åbn Sideliste, og vælg Tilføj side. Angiv et internt navn og en slug med latinske bogstaver, tal og bindestreger, f.eks. about-us. Vælg adgang for alle, kun loggede kunder eller kun gæster. Vælg status og sprog. WHMCS' standardsprog skal være understøttet af modulet.

## 3. Redigér indhold

Åbn siden, og udfyld Indhold, Metadata og Sitemap for hvert sprog. Træk blokke ind i editoren, ret tekst og billeder, og gem de enkelte faner. Kopiér med indhold giver et udgangspunkt; Kopiér struktur giver et layout til oversættelse. Teksten oversættes ikke automatisk.

## 4. Links og udgivelse

Slå tilføjelse af sidens sprog til for links til oversatte modulsider. Slå den fra for eksterne URL'er, e-mailadresser og WHMCS-ruter uden sprogversion. Efter udgivelse skal siden testes som gæst og kunde samt på mobil. Kontrollér titel, billeder, formularer og mindst to sprog.

## 5. Drift og vedligeholdelse

Menu Manager styrer navigation, og Media Manager styrer billeder. Redirect Manager opretter 301- og 302-viderestillinger. Sitemap genererer XML-filer. Eksportér indstillinger før større ændringer eller import. Anvend omskrivningsregler igen efter ændringer, og kontrollér sitemappet efter udgivelse.

## Uddybende emner

- [Menuer](docs/menus.md)
- [Sideinddeling og filtre](docs/pagination.md)
- [Viderestillinger](docs/redirects.md)
- [Sitemaps](docs/sitemaps.md)
- [Smarty og variabler](docs/smarty.md)
- [Strukturerede data](docs/structured-data.md)
- [Import og eksport](docs/transfer.md)
