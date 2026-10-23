# Redirections

Adresses exactes : source → destination. La source est un chemin depuis la racine du site ou une URL de ce site. La destination est un chemin ou une URL HTTP(S) complète. Une règle sans paramètres de requête s’applique également aux requêtes qui en contiennent ; la destination est utilisée telle qu’elle a été saisie. Les règles s’appliquent aux requêtes GET/HEAD qui parviennent à WHMCS.

Par défaut : 14 jours. Calculé depuis la dernière modification de la page publiée ou de ses traductions actives ; si elle n’a jamais été modifiée, depuis sa création. Définissez 0 pour ne pas appliquer de délai. Les règles automatiques utilisent HTTP 301.

Les adresses des pages de remplacement redirigent automatiquement vers les pages système qu’elles remplacent. Si un remplacement a plusieurs destinations, la première configurée est utilisée. Ces redirections fonctionnent dès que les remplacements sont activés, indépendamment des règles du gestionnaire de redirections.

Saisissez un chemin valide commençant par / ou une URL HTTP(S) complète. La source doit appartenir à ce site ; les fragments # ne sont pas pris en charge.

## HTTP

Les règles acceptent les codes HTTP `301`, `302`, `303`, `307` et `308` et ne s’appliquent qu’aux requêtes `GET`/`HEAD` qui atteignent WHMCS. La source est comparée exactement au chemin et, s’ils sont fournis, aux paramètres de requête ; ceux de la destination remplacent les anciens. Le gestionnaire stocke les règles dans `zm_pb_redirects`, mais ne crée pas la table pendant une requête : utilisez **Base de données du module**. Les colonnes URL existantes sont limitées à 128 octets.

Les règles manuelles ont priorité sur les règles automatiques. Le changement de slug d'une page publiée peut créer un `301` automatique pour chaque langue active après le délai défini; publier un brouillon ne le fait pas. Les renommages suivants mettent à jour les anciennes destinations. Une règle avec paramètres de requête prime sur une règle limitée au chemin. L'URL source doit appartenir à ce site et ne doit pas contenir de fragment `#`.

## Instructions

- Source
- Destination
- Activé
- Désactivé
