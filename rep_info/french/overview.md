# Multimodule gratuit pour WHMCS

**Avant toute utilisation, générez des sels uniques et placez-les dans `module_init.php`** : `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` et `ZM_PB_NONCE_SALT`.

**Avant la première utilisation, ouvrez Paramètres du module → Langues prises en charge et activez les langues nécessaires.**

Le module a été développé et testé avec **WHMCS 8.13.1 à 8.13.7**. Sa compatibilité PHP a été vérifiée de **7.4 à 8.5**. Il prend entièrement en charge Apache. Il peut aussi fonctionner avec Nginx, mais le routage des langues sur la page d’accueil peut nécessiter une configuration supplémentaire.

**zmchel WHMCS Multimodule est gratuit.** Il réunit un éditeur visuel de pages, des contenus multilingues, des menus, une médiathèque, des champs SEO, des plans de site XML, des redirections, des règles de réécriture et l’importation/exportation. Consultez les [instructions](instruction.md).

## Gestionnaire de langues (en cours de développement)

Dans l'administration WHMCS, ouvrez le Gestionnaire de langues, puis choisissez une section (langues client ou admin de WHMCS, ce module ou un autre module) et une langue. Comparez l'original ou la référence à la traduction, modifiez une ligne et enregistrez-la ; vous pouvez aussi exporter et importer les clés existantes en JSON. Une nouvelle langue utilise la référence jusqu'à sa traduction. Le gestionnaire active ou désactive les fichiers linguistiques et corrige leurs anciens noms ; changez d'abord la langue par défaut dans WHMCS.

## Évolutions envisagées

- Ajouter des pages imbriquées et des catégories.
- Découper le module actuel en composants.
- Ajouter une gestion des droits d’accès dans l’administration.
- Étendre les langues proposées par défaut dans `supported_langs.php`.
- Ajouter un éditeur de code pour les fichiers `.tpl` du module et les thèmes clients de WHMCS.
- Ajouter un gestionnaire des fichiers de langue du module, des autres modules et de WHMCS.
- Améliorer la médiathèque et créer un gestionnaire SEO plus complet.
- Rendre la génération de plans de site multilingue et proposer un plan de site HTML.
- Ajouter des statistiques d’utilisation au gestionnaire de pages.
- Ajouter la minification JS/CSS/HTML, un cache de pages et l’optimisation des tables.
- Mettre en place un véritable système de mises à jour.

Il s’agit **d’idées pour l’avenir, pas d’un calendrier ferme**.

## Proposer une idée

[Envoyez votre suggestion](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) avec l’objet «Предложение по мультимодулю».

## Poser une question

[Envoyez votre question par e-mail](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) avec l’objet «Задать вопрос по модулю».
