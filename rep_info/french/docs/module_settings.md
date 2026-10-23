# Paramètres du module

## WHMCS

Choisissez les langues utilisables par le module. Désactiver une langue ne supprime pas son contenu.

Si vous utilisez des URL conviviales sur Apache, mettez à jour les règles dans Rewrite Manager après toute modification des langues.

- [Importation et exportation](module_settings_transfer.md)

## Instructions

- **URL conviviales** — Activer les URL conviviales, y compris les URL système.
- **Routage des langues** — Activer ou désactiver les routes linguistiques. Si elles sont activées, les pages sont accessibles sous /de/, /en/, /es/ et les autres préfixes linguistiques pris en charge. Sinon, une même URL de page affiche le contenu dans la langue configurée par l’utilisateur.
- **Route de la langue par défaut** — Ajoute un préfixe à la langue par défaut et redirige les pages du module sans préfixe vers cette route.
- **Mode maintenance (module)** — Activer ou désactiver le mode maintenance du module. Contrairement au mode maintenance du système, ce mode plus souple permet aux hooks WHMCS et aux autres composants de fonctionner.
- **Collecter les variables Smarty** — Activer ou désactiver la collecte des variables Smarty.
- **Utiliser les variables Smarty collectées** — Activer ou désactiver l’utilisation des variables Smarty collectées dans l’éditeur de pages.
- **Remplacements de pages** — Activer ou désactiver les remplacements de pages.
- **Fréquence de mise à jour** — Si aucune option n’est sélectionnée, le sitemap est mis à jour chaque jour.
- **Sitemap HTML** — Si cette option est activée, /html-sitemap affiche le sitemap sous forme de page HTML classique ; sitemap.xml reste inchangé.
- **En-tête du site** — HTML personnalisé pour la section \<head>, notamment \<script> et \<style>.
- **Pied de page du site** — HTML personnalisé avant \</body>, notamment \<script> et \<style>.
- **Modifier robots.txt**
