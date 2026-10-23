# Webbplatskartor

Automatisk generering körs efter WHMCS cron när det är dags att uppdatera. Manuell generering startar omedelbart.

Aktiva sidor och inlägg som är tillgängliga för gäster, inklusive deras publicerade språkversioner, tas med. Åsidosättningar använder de offentliga URL:erna för sidorna som de ersätter.

När funktionen är aktiverad visas webbplatskartan på /html-sitemap som en vanlig HTML-sida; sitemap.xml påverkas inte.

## XML

XML innehåller ömsesidiga länkar för aktiva språk och `x-default` för standardspråkets adress. Källor till omdirigeringar tas inte med i `loc` eller språkalternativen; reservinnehåll märks med sitt faktiska språk. Sid- och inläggsfilerna deklarerar XHTML-namnrymden.

Hooken `AfterCronJob` jämför intervallet `ZM_PB_SITEMAP_UPDFREQ` med tiden för senaste lyckade generering `ZM_PB_SITEMAP_LASTUPD`; när webbplatskartan är avstängd kan den inte heller genereras manuellt. Språkversioner väljs efter `lang_active`, inte `lang_status`. Extra delar får suffixen `_2`, `_3` och så vidare. Om genereringen misslyckas återställs tidigare filer och tidpunkten för lyckad körning ändras inte. Kontrollera skrivrätt till roten, `resources/` och `inc/editable_consts.php`; reparera tabeller separat i moduldatabasen.

Automatisk generering beror på WHMCS cron och det inställda intervallet; knappen startar den direkt. Endast publicerade sidor och inlägg som gäster kan se, med aktiva översättningar, tas med. Om en sida ersätter en systemsida används systemsidans offentliga URL i stället för ersättningssidans slug. Filer med fler än 50 000 URL:er eller 50 MB delas upp. Indexet bevarar andra giltiga webbplatskartor.

Modulen skriver `sitemap_index.xml`, `sitemap_pages.xml` och `sitemap_posts.xml` i webbplatsens rotkatalog; tomma kategorier får ingen fil. Den skapar inte en sammanslagen `sitemap.xml`. Generera om kartorna efter ändringar i sidor eller språk och öppna indexet i webbläsaren. Kontrollera skrivbehörigheten i rotkatalogen vid fel; tiden för den senaste lyckade genereringen ändras inte.

## Instruktioner

- Generera webbplatskartor
- Filer i webbplatsens rotkatalog
- Senaste slutförda generering
- Nästa uppdatering tidigast
- Om inget väljs uppdateras webbplatskartan dagligen.
- **Uppdateringsfrekvens** — Om fältet lämnas tomt används 'monthly' som standard.
- **Uppdateringsprioritet** — Om fältet lämnas tomt används '0.5' som standard.
