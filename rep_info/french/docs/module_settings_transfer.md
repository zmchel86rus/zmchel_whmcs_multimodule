# Importation et exportation

Un seul fichier JSON pour toutes les sections ou celles sélectionnées, jusqu’à 32 Mio (les limites de téléversement PHP s’appliquent également). Les pages correspondantes sont mises à jour selon leur slug et leur type d’accès, les menus selon leur nom. Les autres enregistrements restent inchangés. Incluez les pages lorsque vous importez des menus sur un nouveau site. Les sections sélectionnées absentes du fichier sont ignorées.

Les fichiers CSS/JS sont inclus avec les pages ; les images et autres fichiers téléversés avec la médiathèque. L’historique des révisions, les variables Smarty collectées et les données confidentielles de WHMCS ne sont pas exportés. Régénérez le sitemap après l’importation ; appliquez les règles de réécriture dans le gestionnaire de réécriture.

Pages et articles (traductions, contenu, SEO, paramètres du sitemap, blocs CSS/JS)

Paramètres du module, remplacements de pages, en-tête/pied de page, robots.txt

Les enregistrements correspondants des sections sélectionnées seront mis à jour à partir du fichier. Continuer ?

## JSON

L’export peut contenir les pages et articles avec traductions, contenu, SEO et CSS/JS ; les menus avec hiérarchie et emplacements ; les réglages, redirections, règles personnalisées et fichiers de la médiathèque. L’historique des révisions, les variables Smarty collectées, les comptes et secrets WHMCS ainsi que les fichiers du thème sont exclus. Le JSON est limité à 32 MiB ; les limites PHP `upload_max_filesize` et `post_max_size` s’appliquent aussi. Pour transférer des menus vers un autre site, importez également les pages et résolvez d’abord les noms de menus en double.

Le fichier exporté utilise le format `zmchel_whmcs_multimodule` (version 1). À l'importation, les URL du site source sont adaptées au `SystemURL` du site cible, tandis que les liens externes restent intacts. L'importation ne crée pas de tables : préparez-les d'abord dans la Base de données du module. Une confirmation est demandée avant le début; les enregistrements sont modifiés dans une transaction et les fichiers remplacés sont restaurés en cas d'erreur.

## Instructions

- Menus et emplacements
- Redirections
- Règles de réécriture personnalisées
- Médiathèque (fichiers et descriptions)
