# Menus

Créez un menu, ajoutez des pages ou des liens personnalisés et classez les éléments par glisser-déposer. Choisissez un parent pour les sous-menus, puis définissez les libellés par langue, la visibilité pour les visiteurs ou clients et les appareils. Attribuez un emplacement : chacun ne peut accueillir qu’un menu. Pour les liens internes, choisissez si l’URL suit la langue actuelle. Vérifiez le menu public sur ordinateur et téléphone.

Chaque élément peut avoir un titre, une description, des classes CSS, un attribut `rel`, une icône et une ouverture dans un nouvel onglet ; les pages publiées peuvent aussi être ajoutées automatiquement. Choisissez séparément sur ordinateur et mobile si le menu complète ou remplace la navigation WHMCS. Le lien vers une page du module est recalculé selon son slug, la langue et le mode d’URL actuels ; un libellé vide reprend le titre traduit ou le nom de la page. La visite d’une page ne change pas la langue du profil client. Le serveur refuse les schémas d’URL dangereux et le HTML dans les libellés.

## WHMCS

Activez les emplacements de menu WHMCS voulus dans les paramètres du module. Chaque emplacement accepte un seul menu, tandis qu'un même menu peut être affecté à plusieurs emplacements. L'affichage ordinateur commence à 768 px; en dessous, l'affichage mobile s'applique. Un emplacement désactivé laisse le menu standard de WHMCS intact.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Sur les routes système WHMCS sans routage linguistique du module, les libellés du menu utilisent la langue enregistrée du client ; les pages du module utilisent celle de l’URL. Si la langue par défaut possède sa propre route, elle reçoit aussi un préfixe. L’URL simple est `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Un lien personnalisé peut rester non localisé, par exemple `clientarea.php`. Masquer un parent masque toute sa branche.

L'URL d'un élément de page est recalculée à partir du slug actuel et de la traduction publiée. Si la traduction manque, la version publiée dans la langue par défaut est utilisée. Un lien personnalisé peut conserver l'URL saisie; les adresses externes, mailto, tel et ancres ne reçoivent pas de préfixe de langue. Les brouillons, pages supprimées et pages sans droit d'accès sont masqués.

## zm_pb_menus

Les données se trouvent dans `zm_pb_menus`, `zm_pb_menu_items` et `zm_pb_menu_locations`. Créez ou réparez ces tables dans la Base de données du module. L'arborescence admet au plus 10 niveaux et 300 éléments; supprimer un parent remonte ses enfants d'un niveau.

## Instructions

- Créer un menu
- Ajoutez des pages, des articles ou des liens personnalisés.
- Faites glisser les éléments pour les réorganiser. Définissez leur imbrication à l’aide du sélecteur de parent ou des boutons de déplacement.
- Utiliser la langue de la page actuelle
- Utiliser l’URL saisie sans modification
- Libellés dans les autres langues
- Visible par
- Appareils
- Chaque emplacement ne peut avoir qu’un seul menu. Choisir un emplacement transfère ici son affectation depuis un autre menu.
- Les éléments de premier niveau deviennent des colonnes et les éléments imbriqués deviennent des liens. Utilisez l’URL # pour un titre sans lien.
- Les tables des menus n’ont pas encore été créées. Ajoutez-les dans la section Base de données du module.

