# Règles de réécriture

## WHMCS

Règles pour les URL multilingues, notamment les pages sous /ru/, /en/ et les autres préfixes. Les langues proviennent de supported_langs.php ; les règles sont insérées dans .htaccess avant celles de WHMCS.

Nginx ne lit pas le fichier .htaccess ; ces règles n’y fonctionnent donc pas. Configurez des règles équivalentes dans nginx.

Une configuration nginx → Apache a été détectée. Ces règles fonctionnent uniquement pour les requêtes transmises à Apache ; nginx ne lit pas .htaccess.

Après avoir ajouté ou supprimé une règle, cliquez sur « Ajouter ou mettre à jour les règles » pour appliquer les modifications à .htaccess.

## .htaccess

Ouvrez le gestionnaire et comparez les règles au fichier principal `.htaccess`. Pour une règle personnalisée, enregistrez le motif d'URL, la destination et les indicateurs, puis cliquez sur **Ajouter ou mettre à jour les règles** pour écrire le bloc avant les règles WHMCS. Vérifiez de nouveau l'état et ouvrez une page publiée dans la langue par défaut puis dans une autre langue. Un motif trop large peut toucher d'autres pages. Avec Nginx → Apache, seules les requêtes transmises à Apache suivent ces règles.

## Instructions

- Vérifier les règles
- Ajouter ou mettre à jour les règles
- Supprimer toutes les règles de .htaccess
- Modèle d’URL
- Cible
- Indicateurs
