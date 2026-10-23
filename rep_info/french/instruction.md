# zmchel WHMCS Multimodule : instructions

**Avant toute utilisation, générez des sels uniques et placez-les dans `module_init.php`** : `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` et `ZM_PB_NONCE_SALT`.

**Avant la première utilisation, ouvrez Paramètres du module → Langues prises en charge et activez les langues nécessaires.**

Module développé et testé avec **WHMCS 8.13.1–8.13.7** ; compatibilité PHP vérifiée de **7.4 à 8.5**. Apache est entièrement pris en charge. Nginx peut fonctionner, mais le routage des langues sur la page d’accueil demande parfois une configuration supplémentaire. **Le module est gratuit.**

## Gestionnaire de langues (en cours de développement)

Dans l'administration WHMCS, ouvrez le Gestionnaire de langues, puis choisissez une section (langues client ou admin de WHMCS, ce module ou un autre module) et une langue. Comparez l'original ou la référence à la traduction, modifiez une ligne et enregistrez-la ; vous pouvez aussi exporter et importer les clés existantes en JSON. Une nouvelle langue utilise la référence jusqu'à sa traduction. Le gestionnaire active ou désactive les fichiers linguistiques et corrige leurs anciens noms ; changez d'abord la langue par défaut dans WHMCS.

→ [Gestionnaire de langues](../english/docs/language-manager.md) (English)

## Accès et pages

Dans l’administration WHMCS, ouvrez **Modules complémentaires → zmchel WHMCS Multimodule**. La liste des pages permet de créer, retrouver, modifier et supprimer les pages. Un *slug* est la partie de l’adresse après le domaine, par exemple `contact` dans `/contact/`. Avant de modifier les URL, les redirections ou les règles serveur, exportez les paramètres du module.

Pour créer une page, renseignez son nom interne et un slug composé de lettres latines, chiffres et tirets, sans domaine ni `.php`. Choisissez le type d’accès : visiteurs, clients connectés ou mixte. Choisissez ensuite le statut (brouillon, publié, différé ou corbeille), le type (page, article ou page système) et les langues. La langue par défaut de WHMCS doit figurer dans `supported_langs.php` ; elle est ajoutée automatiquement.

Après l’enregistrement, ouvrez la page pour modifier ses **paramètres principaux**, son **contenu**, ses **métadonnées** et ses paramètres de **plan de site**. Chaque formulaire possède son bouton Enregistrer ; « Tout enregistrer » traite l’ensemble. Vérifiez les messages de réussite et l’aperçu public. La suppression place d’abord la page dans la corbeille ; la suppression définitive s’effectue depuis celle-ci.

## Contenu et langues

Dans l’onglet Contenu, choisissez une langue et faites glisser les blocs GrapesJS sur la zone de travail. Modifiez les textes, images et réglages du bloc sélectionné, puis enregistrez la langue. Les blocs proposent notamment sections, colonnes, tableaux, FAQ, accordéons, formulaires de contact, listes, pagination, zones visiteurs/clients et code personnalisé. Pour réutiliser une mise en page, copiez la structure ou le contenu vers une autre langue, puis traduisez les textes avant publication.

Avec les jolies URL et le routage linguistique, la langue par défaut utilise `/contact/`, les autres un préfixe comme `/fr/contact/`. Dans les blocs Lien et Bouton, activez l’option d’ajout de la langue courante uniquement pour les pages traduites du site. Laissez-la désactivée pour les liens externes, fichiers, `mailto:`, `tel:` et routes WHMCS sans traduction. Vérifiez chaque lien publié dans plusieurs langues.

## SEO, médias et menus

Pour chaque langue, définissez le titre, la description, l’image sociale, l’URL canonique, les robots et le type Schema dans l’onglet Métadonnées. Une page publiée non système peut figurer dans le plan de site XML. Dans la médiathèque, téléversez les images, indiquez un texte alternatif utile et vérifiez la qualité après optimisation.

Dans le Gestionnaire de menus, créez un menu, ajoutez des pages ou liens personnalisés, ordonnez-les et choisissez leur emplacement et leur visibilité. Une seule affectation est possible par emplacement. Pour remplacer une page WHMCS, publiez d’abord la nouvelle page, puis configurez la substitution dans la liste des pages et testez l’URL WHMCS d’origine comme visiteur et comme client connecté.

## Outils du site

Le Gestionnaire de redirections définit une source et une destination ; utilisez `301` pour un déplacement permanent et `302` pour un déplacement temporaire. Le Gestionnaire de réécriture contrôle les règles de jolies URL. Générez les plans de site dans l’onglet Plan du site et vérifiez `sitemap_index.xml`. Les paramètres du module contrôlent aussi les menus, Smarty, le mode maintenance et l’importation/exportation. Une exportation JSON ne remplace pas une sauvegarde complète de WHMCS.

Le formulaire de contact peut envoyer un ticket WHMCS ou un courriel. Configurez ses champs, destinataire ou service d’assistance, consentements et CAPTCHA, puis faites un envoi réel de test. Si les tables du module manquent, utilisez l’onglet Base de données du module.

## Documentation complémentaire (English)

[Menus](../english/docs/menus.md) · [Smarty](../english/docs/smarty.md) · [Pagination](../english/docs/pagination.md) · [Plans de site](../english/docs/sitemaps.md) · [Redirections](../english/docs/redirects.md) · [Données structurées](../english/docs/structured-data.md) · [Importation et exportation](../english/docs/transfer.md).
