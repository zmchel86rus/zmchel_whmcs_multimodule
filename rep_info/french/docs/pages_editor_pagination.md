# Pagination

Cliquez sur le bloc contenant la liste. Échap pour annuler. La pagination doit se trouver à l’extérieur du bloc sélectionné.

Pour Smarty, indiquez la variable contenant la liste complète. Sans variable, les éléments HTML du conteneur sont répartis en pages ; si nécessaire, précisez la classe des lignes ou la balise tr. Les liens conservent count, sort et les filtres. Plusieurs listes indépendantes sont prises en charge.

Le sélecteur du nombre d’éléments peut être déplacé à l’intérieur de la pagination ou vers d’autres blocs de la page. Il reste associé à cette pagination.

Ne pas indexer les pages à partir de la page 2

Sélectionnez un bloc Smarty contenant une liste. La recherche et la pagination doivent être associées au même bloc.

Indiquez la variable contenant la liste complète. La recherche examine tous les champs indiqués et les filtres sont appliqués conjointement. Les conditions sont appliquées avant le calcul des pages ; l’application ou la réinitialisation des filtres ramène à la première page. Si une pagination existe déjà, sa variable est utilisée.

## Liens et source de la liste

Placez la pagination hors du bloc de liste et sélectionnez ce bloc comme cible. Pour une liste Smarty, indiquez la variable contenant tous les éléments ; sinon, les éléments HTML du conteneur sont répartis. Choisissez le format des liens selon le réglage du module, `/page/2/` ou `?page=2`. Le format chemin exige des règles rewrite. Les listes indépendantes utilisent des paramètres distincts ; les liens conservent langue, filtres et tri.

## Taille de page, SEO et filtres

Définissez le nombre d'éléments et activez si besoin le sélecteur 10/25/50/100/250. Changer cette taille ramène la liste à la première page. Noindex s'applique uniquement à partir de la deuxième page ; vérifiez le titre et l'URL canonique. Associez les filtres à cette même liste, puis testez la deuxième page et un résultat filtré sur le site public.

## page / count / pager

Pour une liste Smarty, indiquez la variable contenant tous les éléments et conservez la boucle `{foreach}` : le module découpe la liste, donc n’ajoutez pas un second `array_slice`. Sans variable, les éléments HTML du conteneur sont répartis ; vous pouvez préciser une classe de ligne ou la balise `tr`, tandis que `thead` et `tfoot` restent en place. Réglez séparément sur ordinateur et mobile le nombre de boutons autour de la page courante. Sur une route PHP directe, utilisez `?page=2` ; `/page/2/` exige les règles rewrite. Les pages suivantes ont leur propre canonical et peuvent recevoir `noindex`.

Avec plusieurs listes indépendantes, la première utilise `page`, `count` et `sort`; les autres ont des paramètres suffixés par l'ID du bloc. Pour le chemin `/page/N/`, `pager` indique à quelle liste appartient le numéro. Dans le bloc Smarty, `$zm_pagination` fournit `total`, `page`, `pages`, `count` et `offset`. `count` est limité à 10–250. Si la liste est vide ou tient sur une page, le panneau de pagination est masqué.

## YYYY-MM-DD

Les filtres portent sur la même liste que la pagination. La recherche textuelle peut examiner plusieurs champs séparés par des virgules; la plage de dates utilise `YYYY-MM-DD` et inclut toute la dernière journée.

## Flex / Grid

Choisissez Flex ou Grid et réglez largeurs et colonnes selon l'appareil. Appliquer ou effacer un filtre revient à la première page. Le sélecteur du nombre de résultats peut être déplacé sans perdre son lien; un panneau dupliqué contrôle la même liste.

## Instructions

- Nombre d’éléments : 10, 25, 50, 100, 250
- Format des liens
- Nombre d’éléments par défaut
