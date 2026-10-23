# Smarty

- **Paramètres du module → Collecter les variables Smarty → Utiliser les variables Smarty collectées → Éditeur de pages.**

## Catalogue des variables

Activez la collecte et l'utilisation des variables Smarty dans les paramètres du module, puis ouvrez les pages concernées du site et actualisez l'éditeur. Le catalogue conserve les noms, les types et la structure des variables, mais pas leurs valeurs réelles ni les données personnelles. Si une variable manque, revisitez la page où elle apparaît.

## Éditeur et limites

Ouvrez le bloc Smarty dans l'éditeur de pages et choisissez les variables du catalogue. Utilisez les conditions et les boucles autorisées ; ajoutez `|escape` lorsque vous affichez un texte dynamique. PHP, SQL, les appels de méthodes, l'inclusion de fichiers et `nofilter` sont interdits. Enregistrez la page et vérifiez le rendu public.

## resources/available_vars/

Le catalogue décrit seulement les variables observées sur une page : il ne les rend pas disponibles sur une autre. Le code est validé à l’enregistrement et avant l’affichage ; le bloc reçoit une copie isolée des valeurs autorisées. Vous pouvez utiliser des conditions, `foreach`, `assign` local et des modificateurs comme `escape`, `default`, `count` et `date_format`. Les valeurs de sortie sont échappées automatiquement ; écrivez le HTML souhaité dans le modèle. Si les données manquent ou si le code échoue, le bloc reste vide et l’erreur est inscrite au journal PHP.

Le catalogue de `resources/available_vars/` conserve les noms, types, structures et exemples artificiels, jamais les valeurs réelles. Il indique où une variable a été observée sans la rendre disponible sur une autre page. Ouvrez l'éditeur en double-cliquant sur le bloc Smarty. `Ctrl+Space` recherche les variables, `Ctrl+S` applique le code et `F11` passe en plein écran. Le code s'exécute isolément; si les données manquent, le bloc reste vide et un avertissement est inscrit au journal PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Instructions

- **Collecter les variables Smarty** — Activer ou désactiver la collecte des variables Smarty.
- **Utiliser les variables Smarty collectées** — Activer ou désactiver l’utilisation des variables Smarty collectées dans l’éditeur de pages.
- Variable Smarty (PHP)
- Smarty : PHP, les méthodes d’objet, les appels statiques et nofilter sont interdits.
- Le modèle Smarty est trop volumineux.
- Smarty
- Éditeur Smarty

