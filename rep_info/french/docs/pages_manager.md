# Gestionnaire de pages

## Accès et pages

Dans l’administration WHMCS, ouvrez **Modules complémentaires → zmchel WHMCS Multimodule**. La liste des pages permet de créer, retrouver, modifier et supprimer les pages. Un *slug* est la partie de l’adresse après le domaine, par exemple `contact` dans `/contact/`. Avant de modifier les URL, les redirections ou les règles serveur, exportez les paramètres du module.

Pour créer une page, renseignez son nom interne et un slug composé de lettres latines, chiffres et tirets, sans domaine ni `.php`. Choisissez le type d’accès : visiteurs, clients connectés ou mixte. Choisissez ensuite le statut (brouillon, publié, différé ou corbeille), le type (page, article ou page système) et les langues. La langue par défaut de WHMCS doit figurer dans `supported_langs.php` ; elle est ajoutée automatiquement.

Après l’enregistrement, ouvrez la page pour modifier ses **paramètres principaux**, son **contenu**, ses **métadonnées** et ses paramètres de **plan de site**. Chaque formulaire possède son bouton Enregistrer ; « Tout enregistrer » traite l’ensemble. Vérifiez les messages de réussite et l’aperçu public. La suppression place d’abord la page dans la corbeille ; la suppression définitive s’effectue depuis celle-ci.

## URL

Filtrez la liste par nom, accès, type, état ou langue. **Visiter** ouvre l'URL publique. **Supprimer** déplace d'abord la page dans la corbeille; la suppression définitive se fait là. Si la page ne s'ouvre pas, vérifiez sa publication, sa langue active et son type d'accès.

## WHMCS

Pour remplacer une page WHMCS, choisissez l'adresse système existante et une page publiée du module. Sélectionnez un remplacement complet, un ajout avant ou après le contenu habituel, ou seulement les données meta/SEO. Enregistrez et testez l'URL WHMCS d'origine en visiteur puis en client connecté.

## Instructions

- Ajouter une page
- **Nom de la page** — Nom interne de la page
- **Slug de la page** — Seules les lettres latines, les traits d’union et les chiffres sont autorisés.
- **Type d’accès** — Utilisateurs connectés : seuls les utilisateurs connectés peuvent accéder à la page ; Visiteurs : seuls les visiteurs non connectés peuvent y accéder ; Mixte : tous peuvent y accéder, la visibilité étant contrôlée par les blocs de la page.
- **Type de page** — Les pages système sont exclues du sitemap et ne sont pas accessibles aux utilisateurs ordinaires.
- **Langues de la page** — La langue par défaut est toujours incluse, quelle que soit votre sélection.
- Le remplacement complet remplace le contenu affiché et les métadonnées.\ « Ajouter avant » place le contenu avant le contenu existant de la page.\ « Ajouter après » place le contenu après le contenu existant de la page.\ « Métadonnées/SEO uniquement » remplace les métadonnées de la page.
- Navigation dans la liste des pages
