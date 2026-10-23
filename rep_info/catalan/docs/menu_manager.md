# Menús

Creeu un menú, afegiu-hi pàgines o enllaços personalitzats i ordeneu-los arrossegant-los. Per crear un submenú, trieu l’element pare; configureu les etiquetes per idioma, la visibilitat per a convidats o clients i els dispositius. Assigneu una ubicació: cada ubicació només pot tenir un menú. Decidiu si els enllaços interns han d’adaptar l’URL a la llengua actual. Reviseu el menú públic a l’ordinador i al mòbil.

A cada element podeu definir títol, descripció, classes CSS, `rel`, icona i obertura en una pestanya nova; també podeu afegir automàticament pàgines publicades. Trieu per separat per a escriptori i mòbil si el menú amplia o substitueix la navegació de WHMCS. L’enllaç a una pàgina del mòdul es recalcula segons el slug, l’idioma i el mode d’URL actuals; una etiqueta buida pren el títol traduït o el nom de la pàgina. Visitar una pàgina no modifica l’idioma del perfil del client. El servidor rebutja esquemes d’URL insegurs i HTML a les etiquetes.

## WHMCS

Activeu les posicions de menú de WHMCS a la configuració del mòdul. Cada posició admet un sol menú, però un mateix menú es pot assignar a diverses posicions. La vista d'escriptori s'aplica a partir de 768 px i la mòbil a amplades inferiors. Si una posició està desactivada, el menú habitual de WHMCS no es modifica.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

A les rutes de sistema de WHMCS sense encaminament lingüístic del mòdul, les etiquetes del menú fan servir l’idioma desat del client; les pàgines del mòdul fan servir l’idioma de l’URL. Si s’activa la ruta pròpia de l’idioma predeterminat, aquest també rep prefix. L’URL simple és `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Un enllaç personalitzat pot quedar sense localitzar, com ara `clientarea.php`. Amagar un element pare amaga tota la branca.

Els URL dels elements de pàgina es tornen a calcular amb el slug actual i la traducció publicada. Si no hi ha traducció, s'utilitza la versió publicada de l'idioma predeterminat. Un enllaç personalitzat pot conservar l'URL introduït; els enllaços externs, mailto, tel i les àncores no reben prefix d'idioma. Les pàgines en esborrany, eliminades o sense permís d'accés no es mostren.

## zm_pb_menus

Les dades es guarden a `zm_pb_menus`, `zm_pb_menu_items` i `zm_pb_menu_locations`. Creeu o repareu aquestes taules des de Base de dades del mòdul. L'arbre admet fins a 10 nivells i 300 elements; en eliminar un pare, els fills pugen un nivell.

## Instruccions

- Creeu un menú, afegiu-hi pàgines o enllaços personalitzats i ordeneu-los arrossegant-los.
