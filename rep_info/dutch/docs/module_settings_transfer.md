# Import en export

Exporteer gewenste secties vóór grote wijzigingen. Controleer na import pagina's, menu's en media, pas herschrijfregels apart toe en genereer de sitemap opnieuw. Dit vervangt geen WHMCS-back-up.

## JSON

De export kan pagina’s en berichten met vertalingen, inhoud, SEO en CSS/JS bevatten; menu’s met structuur en posities; instellingen, omleidingen, eigen regels en de mediabibliotheek met bestanden. Revisiegeschiedenis, verzamelde Smarty-variabelen, WHMCS-accounts en geheimen en themabestanden worden uitgesloten. Het JSON-bestand heeft een limiet van 32 MiB; de PHP-limieten `upload_max_filesize` en `post_max_size` gelden ook. Importeer bij een verhuizing van menu’s naar een andere site ook de pagina’s en los dubbele menunamen vooraf op.

Het exportbestand gebruikt de indeling `zmchel_whmcs_multimodule` (versie 1). Bij import worden URL's van de bronsite aangepast aan de `SystemURL` van de doelsite; externe links blijven behouden. Import maakt geen tabellen aan: bereid deze eerst voor via Moduledatabase. Vooraf verschijnt een bevestiging; records worden binnen een transactie gewijzigd en vervangen bestanden worden bij een fout hersteld.

## Instructies

- Eén JSON-bestand voor alle of geselecteerde secties, tot 32 MiB (de uploadlimieten van PHP zijn ook van toepassing). Overeenkomende pagina's worden bijgewerkt op basis van slug en toegangstype, menu's op basis van naam. Andere records blijven ongewijzigd. Neem pagina's mee wanneer u menu's naar een nieuwe website importeert. Geselecteerde secties die niet in het bestand voorkomen, worden overgeslagen.
- CSS/JS worden met de pagina's geëxporteerd; afbeeldingen en andere geüploade bestanden met de mediabibliotheek. Revisiegeschiedenis, verzamelde Smarty-variabelen en geheime WHMCS-gegevens worden niet geëxporteerd. Genereer de sitemap na het importeren opnieuw en pas de herschrijfregels toe in Herschrijfregelbeheer.
- Pagina's en berichten (vertalingen, inhoud, SEO, sitemapinstellingen, CSS/JS-blokken)
- Menu's en locaties
- Module-instellingen, paginavervangingen, head/footer, robots.txt
- Doorverwijzingen
- Aangepaste herschrijfregels
- Mediabibliotheek (bestanden en beschrijvingen)
- Overeenkomende records in de geselecteerde secties worden bijgewerkt vanuit het bestand. Doorgaan?
