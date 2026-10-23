# Données structurées

- **Éditeur de pages → Paramètres des métadonnées → Type Schema → Enregistrer.**

## Ce que le module balise

Les menus et tables des matières peuvent produire `SiteNavigationElement`, les questions et réponses visibles `FAQPage`, et un fil d'Ariane à plusieurs éléments `BreadcrumbList`. Les blocs de mise en page, boutons et filtres ne reçoivent pas automatiquement un type de contenu. Le type Schema choisi pour la page contrôle son JSON-LD ; s'il est désactivé, ce balisage n'est pas émis.

## Vérifier après publication

Sur la page publique, contrôlez le JSON-LD, l'URL canonique, la langue et le contenu réellement visible. Un balisage valide ne garantit pas un résultat enrichi dans les moteurs de recherche.

## Schema.org

`SiteNavigationElement` utilise les liens et libellés de menu réellement visibles; la table des matières peut ajouter `WebPageElement` pour les titres présents sur la page. `FAQPage` ne reprend que les questions et réponses complètes visibles par le visiteur : blocs masqués et accordéons ordinaires sont exclus. `BreadcrumbList` n'est créé qu'à partir de deux éléments. Les données de l'organisation viennent de WHMCS; les langues de contact figurent dans `ContactPoint.availableLanguage` au format BCP 47. Aucun type Schema n'est deviné pour les filtres, la pagination, les formulaires ou le HTML personnalisé.

## Instructions

- **Type Schema** — Si cette option est désactivée, le balisage JSON Schema.org n’est pas généré pour cette page.
- **Fil d’Ariane** — Nom de la page dans le fil d’Ariane
- **URL canonique**
- **Titre de la page**
- **Méta-description**
- **Titre Open Graph** — Si ce champ est vide, le titre de la page est utilisé.
- **Description Open Graph** — Si ce champ est vide, la méta-description est utilisée.
- **Image Open Graph** — Si ce champ est vide, l’image de la page est utilisée.

