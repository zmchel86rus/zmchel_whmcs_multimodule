# Sitemaps

Automatisk generering kører efter WHMCS-cron, når det er tid til en opdatering. Manuel generering starter med det samme.

Aktive sider og indlæg, som er tilgængelige for gæster, medtages sammen med deres offentliggjorte sprogversioner. Overstyringer bruger de offentlige URL'er for de sider, de erstatter.

Når funktionen er aktiveret, viser /html-sitemap sitemappet som en almindelig HTML-side; sitemap.xml påvirkes ikke.

Aktivér sitemap og generér XML-filerne. Kontrollér sitemap_index.xml for offentliggjorte sprogvarianter; kontrollér WHMCS-cron og skriverettigheder, hvis opdateringer mangler.

## XML

XML indeholder gensidige links for aktive sprog og `x-default` for standardsprogets adresse. Kilder til omdirigeringer medtages hverken i `loc` eller som sprogalternativer; en reserveoversættelse mærkes med indholdets faktiske sprog. Side- og indlægsfilerne deklarerer XHTML-navnerummet.

Hooken `AfterCronJob` sammenligner intervallet `ZM_PB_SITEMAP_UPDFREQ` med tidspunktet for seneste vellykkede generering `ZM_PB_SITEMAP_LASTUPD`; når sitemap er slået fra, er manuel generering heller ikke mulig. Sprogversioner vælges efter `lang_active`, ikke `lang_status`. Ekstra dele får endelserne `_2`, `_3` osv. Ved fejl gendannes de tidligere filer, og succes-tidspunktet ændres ikke. Kontroller skriveadgang til roden, `resources/` og `inc/editable_consts.php`; tabeller repareres særskilt i moduldatabase.

Automatisk generering afhænger af WHMCS cron og det valgte interval; knappen starter den med det samme. Kun udgivne sider og indlæg, som gæster kan se, samt deres aktive oversættelser medtages. Når en side erstatter en systemside, bruges systemssidens offentlige URL i stedet for erstatningens slug. Filer med over 50.000 URL'er eller 50 MB opdeles. Indekset bevarer andre gyldige sitemaps.

Modulet skriver `sitemap_index.xml`, `sitemap_pages.xml` og `sitemap_posts.xml` i webstedets rodmappe; tomme kategorier får ingen fil. Det opretter ikke en samlet `sitemap.xml`. Generér kortene igen efter ændringer i sider eller sprog, og åbn indekset i browseren. Ved fejl skal du kontrollere skrivetilladelsen i rodmappen; tidspunktet for seneste vellykkede generering ændres ikke.

## Vejledning

- Generér sitemaps
- Filer i websitets rodmappe
- Seneste vellykkede generering
- Næste opdatering tidligst
- Hvis intet er valgt, opdateres sitemappet dagligt.
- **Opdateringshyppighed** — Hvis feltet er tomt, bruges 'monthly' som standard.
- **Opdateringsprioritet** — Hvis feltet er tomt, bruges '0.5' som standard.
