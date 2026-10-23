# Éditeur de pages

- [Pagination](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [Données structurées](module_structured_data.md)

## Contenu et langues

Dans l’onglet Contenu, choisissez une langue et faites glisser les blocs GrapesJS sur la zone de travail. Modifiez les textes, images et réglages du bloc sélectionné, puis enregistrez la langue. Les blocs proposent notamment sections, colonnes, tableaux, FAQ, accordéons, formulaires de contact, listes, pagination, zones visiteurs/clients et code personnalisé. Pour réutiliser une mise en page, copiez la structure ou le contenu vers une autre langue, puis traduisez les textes avant publication.

Avec les jolies URL et le routage linguistique, la langue par défaut utilise `/contact/` seulement si sa route facultative est désactivée, les autres un préfixe comme `/fr/contact/`. Dans les blocs Lien et Bouton, activez l’option d’ajout de la langue courante uniquement pour les pages traduites du site. Laissez-la désactivée pour les liens externes, fichiers, `mailto:`, `tel:` et routes WHMCS sans traduction. Vérifiez chaque lien publié dans plusieurs langues.

## WHMCS

Dans les réglages principaux, vérifiez le nom, le slug, le type, l'état, l'accès et les langues. La langue par défaut de WHMCS doit être activée dans le module; une page publiée doit avoir du contenu dans la langue affichée.

## SEO

Pour chaque langue, renseignez le titre et la description puis vérifiez canonical, robots, Open Graph, le fil d'Ariane et Schema. Dans l'onglet du plan du site, choisissez fréquence et priorité d'une page publique non système. Enregistrez et contrôlez l'URL publique et le XML.

## Formulaire de contact

Ajoutez le bloc **Formulaire de contact**. Choisissez un **ticket WHMCS** et un service d'assistance, ou un **e-mail** et un destinataire; renseignez titre, description, sujet et bouton. Pour chaque champ, définissez nom, type, obligation et validation. Un ticket envoyé par un visiteur nécessite des champs affectés aux rôles du nom et de l'adresse e-mail de l'expéditeur. Saisissez une option de liste déroulante par ligne, par exemple `sales : Ventes`. Créez un champ distinct par consentement et utilisez le CAPTCHA configuré dans WHMCS. Enregistrez et faites un véritable essai en visiteur; vérifiez ticket ou livraison, erreurs et remise à zéro. L'état vert de l'éditeur ne confirme pas la livraison; configurez SMTP dans WHMCS si `mail()` échoue.

## Instructions

- Conteneur Flex imbriqué. Faites glisser d’autres blocs à l’intérieur.
- Conteneur CSS Grid imbriqué. Faites glisser d’autres blocs à l’intérieur.
- Carrousel Bootstrap imbriqué. Faites glisser des blocs à l’intérieur ; chacun devient une diapositive.
- Tous les blocs situés sous ce bloc sont affichés uniquement aux utilisateurs connectés. Fonctionne seulement si le type d’accès de la page est Mixte.
- Tous les blocs situés sous ce bloc sont affichés uniquement aux visiteurs non connectés. Fonctionne seulement si le type d’accès de la page est Mixte.
- **Titre de la page**
- **Méta-description**
- **URL canonique**
- **Robots** — index, follow / noindex, nofollow. Contrôle l’indexation.
- **Type Schema** — Si cette option est désactivée, le balisage JSON Schema.org n’est pas généré pour cette page.
