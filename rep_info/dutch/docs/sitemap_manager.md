# Sitemaps

Schakel de sitemap in en genereer de XML-bestanden. Controleer sitemap_index.xml op gepubliceerde taalversies; controleer WHMCS-cron en schrijfrechten als updates ontbreken.

## XML

XML bevat wederkerige links voor actieve talen en `x-default` voor het adres van de standaardtaal. Bronnen van omleidingen komen niet in `loc` of taalalternatieven; een terugvalvertaling krijgt de werkelijke taal van de inhoud. De bestanden voor pagina’s en berichten declareren de XHTML-naamruimte.

De hook `AfterCronJob` vergelijkt het interval `ZM_PB_SITEMAP_UPDFREQ` met het tijdstip van de laatste geslaagde generatie `ZM_PB_SITEMAP_LASTUPD`; als de sitemap uitstaat, is handmatig genereren evenmin beschikbaar. Taalversies worden gekozen via `lang_active`, niet via `lang_status`. Extra delen krijgen de achtervoegsels `_2`, `_3` enzovoort. Bij een fout worden de vorige bestanden hersteld en verandert het succestijdstip niet. Controleer schrijfrechten op de sitehoofdmap, `resources/` en `inc/editable_consts.php`; tabellen worden afzonderlijk hersteld in de moduledatabase.

Automatisch genereren hangt af van WHMCS-cron en het ingestelde interval; de knop start het direct. Alleen gepubliceerde pagina’s en berichten die gasten kunnen bekijken, met hun actieve vertalingen, worden opgenomen. Als een pagina een systeempagina vervangt, wordt de openbare URL van de systeempagina gebruikt in plaats van de slug van de vervanging. Bestanden met meer dan 50.000 URL’s of 50 MB worden opgesplitst. De index behoudt andere geldige sitemaps.

De module schrijft `sitemap_index.xml`, `sitemap_pages.xml` en `sitemap_posts.xml` in de hoofdmap van de site; een lege categorie krijgt geen bestand. Er wordt geen gecombineerde `sitemap.xml` gemaakt. Genereer de kaarten opnieuw na wijzigingen aan pagina's of talen en open de index in de browser. Controleer bij fouten de schrijfrechten van de hoofdmap; het tijdstip van de laatste geslaagde generatie blijft staan.

## Instructies

- Automatische generatie vindt na de WHMCS-crontaak plaats wanneer een update nodig is. Handmatige generatie begint direct.
- Actieve pagina's en berichten die toegankelijk zijn voor gasten, inclusief de gepubliceerde taalversies, worden opgenomen. Paginavervangingen gebruiken de openbare URL's van de pagina's die ze vervangen.
- Sitemaps genereren
- Bestanden in de hoofdmap van de website
- Laatste geslaagde generatie
- Volgende update niet eerder dan
- Als er niets is geselecteerd, wordt de sitemap dagelijks bijgewerkt.
- Indien ingeschakeld, wordt de sitemap op /html-sitemap als een gewone HTML-pagina weergegeven; sitemap.xml blijft ongewijzigd.
- **Bijwerkfrequentie** — Als dit leeg is, wordt standaard 'monthly' gebruikt.
- **Bijwerkprioriteit** — Als dit leeg is, wordt standaard '0.5' gebruikt.
