# Import en export

Exporteer gewenste secties vóór grote wijzigingen. Controleer na import pagina's, menu's en media, pas herschrijfregels apart toe en genereer de sitemap opnieuw. Dit vervangt geen WHMCS-back-up. JSON-bestanden kunnen ook worden geïmporteerd.

## ZIP

De export kan pagina’s en berichten met vertalingen, inhoud, SEO en CSS/JS bevatten; menu’s met structuur en posities; instellingen, omleidingen, eigen regels en de mediabibliotheek met bestanden. Revisiegeschiedenis, verzamelde Smarty-variabelen, WHMCS-accounts en geheimen en themabestanden worden uitgesloten. Het ZIP-bestand heeft een limiet van 128 MiB; de PHP-limieten `upload_max_filesize` en `post_max_size` gelden ook. Importeer bij een verhuizing van menu’s naar een andere site ook de pagina’s en los dubbele menunamen vooraf op.

Het exportbestand gebruikt de indeling `zmchel_whmcs_multimodule` (versie 2). Bij import worden URL's van de bronsite aangepast aan de `SystemURL` van de doelsite; externe links blijven behouden. Import maakt geen tabellen aan: bereid deze eerst voor via Moduledatabase. Vooraf verschijnt een bevestiging; records worden binnen een transactie gewijzigd en vervangen bestanden worden bij een fout hersteld.
