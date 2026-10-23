# zmchel WHMCS Multimodule : instructions

**Avant toute utilisation, générez des sels uniques et placez-les dans `module_init.php`** : `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` et `ZM_PB_NONCE_SALT`.

**Avant la première utilisation, ouvrez Paramètres du module → Langues prises en charge et activez les langues nécessaires.**

Le module a été développé et testé avec **WHMCS 8.13.1 à 8.13.7**. Sa compatibilité PHP a été vérifiée de **7.4 à 8.5**. Il prend entièrement en charge Apache. Il peut aussi fonctionner avec Nginx, mais le routage des langues sur la page d’accueil peut nécessiter une configuration supplémentaire.

**zmchel WHMCS Multimodule est gratuit.** Il réunit un éditeur visuel de pages, des contenus multilingues, des menus, une médiathèque, des champs SEO, des plans de site XML, des redirections, des règles de réécriture et l’importation/exportation.

## Paramètres du module

Choisissez les langues utilisables par le module. Désactiver une langue ne supprime pas son contenu.

- **Paramètres du module → Langues prises en charge → Activer**
- **Base de données du module → Corriger Éléments sélectionnés**
- **Règles de réécriture → Vérifier les règles → Ajouter ou mettre à jour les règles**

Nginx ne lit pas le fichier .htaccess ; ces règles n’y fonctionnent donc pas. Configurez des règles équivalentes dans nginx.

## Gestionnaire de pages

- **Ajouter une page → Nom de la page → Slug de la page → Enregistrer**
- **Éditeur de pages → Paramètres du contenu → Paramètres des métadonnées → Paramètres du sitemap de la page → Tout enregistrer**
- **Gestionnaire de pages → Visiter**
- **Sitemap → Générer les sitemaps**

Seules les lettres latines, les traits d’union et les chiffres sont autorisés.

Utilisateurs connectés : seuls les utilisateurs connectés peuvent accéder à la page ; Visiteurs : seuls les visiteurs non connectés peuvent y accéder ; Mixte : tous peuvent y accéder, la visibilité étant contrôlée par les blocs de la page.

La génération automatique s’exécute après le cron WHMCS lorsqu’une mise à jour est nécessaire. La génération manuelle démarre immédiatement.

## Guides par section

- [Gestionnaire de pages](docs/pages_manager.md)
- [Éditeur de pages](docs/pages_editor.md)
- [Gestionnaire de médias](docs/media_manager.md)
- [Menus](docs/menu_manager.md)
- [Gestionnaire de langues](docs/langs_manager.md)
- [Redirections](docs/redirects_manager.md)
- [Plans de site](docs/sitemap_manager.md)
- [Règles de réécriture](docs/rewrite_manager.md)
- [Paramètres du module](docs/module_settings.md)
- [Base de données du module](docs/module_db.md)

## Ressources complémentaires

- [Pagination](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [Données structurées](docs/module_structured_data.md)
- [Importation et exportation](docs/module_settings_transfer.md)
