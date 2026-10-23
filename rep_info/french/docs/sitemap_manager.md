# Plans de site

La génération automatique s’exécute après le cron WHMCS lorsqu’une mise à jour est nécessaire. La génération manuelle démarre immédiatement.

Les pages et articles actifs accessibles aux visiteurs, y compris leurs versions linguistiques publiées, sont inclus. Les remplacements utilisent les URL publiques des pages qu’ils remplacent.

Si aucune option n’est sélectionnée, le sitemap est mis à jour chaque jour.

Si cette option est activée, /html-sitemap affiche le sitemap sous forme de page HTML classique ; sitemap.xml reste inchangé.

## XML

Le XML comprend des liens réciproques pour les langues actives et `x-default` pour l’adresse de la langue par défaut. Les sources de redirection sont exclues de `loc` et des variantes linguistiques ; un contenu de repli porte sa langue réelle. Les fichiers de pages et d’articles déclarent l’espace de noms XHTML.

Le hook `AfterCronJob` compare l’intervalle `ZM_PB_SITEMAP_UPDFREQ` à la date de dernière génération réussie `ZM_PB_SITEMAP_LASTUPD` ; si le plan est désactivé, la génération manuelle est indisponible aussi. Les versions linguistiques sont choisies par `lang_active`, et non par `lang_status`. Les parties supplémentaires portent les suffixes `_2`, `_3`, etc. En cas d’échec, les anciens fichiers sont restaurés et la date de réussite ne change pas. Vérifiez l’écriture à la racine, dans `resources/` et `inc/editable_consts.php` ; réparez les tables à part dans la base du module.

La génération automatique dépend du cron WHMCS et de l’intervalle configuré ; le bouton la lance immédiatement. Seules les pages et publications accessibles aux visiteurs, publiées et dotées de traductions actives, sont incluses. Si une page remplace une page système, son URL public est celui de la page système, pas le slug de la page de remplacement. Les fichiers dépassant 50 000 URL ou 50 Mo sont scindés. L’index conserve les autres plans de site valides.

Le module écrit `sitemap_index.xml`, `sitemap_pages.xml` et `sitemap_posts.xml` à la racine du site; une catégorie vide ne produit pas de fichier. Il ne crée pas de `sitemap.xml` combiné. Régénérez les plans après une modification des pages ou des langues, puis ouvrez l'index dans le navigateur. En cas d'erreur, vérifiez les droits d'écriture à la racine; la date de la dernière génération réussie reste inchangée.

## Instructions

- Générer les sitemaps
- Fichiers à la racine du site
- Dernière génération réussie
- Prochaine mise à jour au plus tôt
- **Fréquence de mise à jour** — Si ce champ est vide, la valeur par défaut est « monthly ».
- **Priorité de mise à jour** — Si ce champ est vide, la valeur par défaut est « 0.5 ».
