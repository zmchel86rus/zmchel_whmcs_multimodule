# Mapes del lloc

Activeu el mapa del lloc i genereu els fitxers XML. Reviseu les versions lingüístiques publicades a sitemap_index.xml; si no s'actualitza, comproveu el cron de WHMCS i els permisos d'escriptura.

## XML

L’XML inclou enllaços recíprocs per als idiomes actius i `x-default` per a l’adreça de l’idioma predeterminat. Els orígens de redireccions no entren a `loc` ni a les alternatives lingüístiques; una traducció de reserva s’indica amb l’idioma real del contingut. Els fitxers de pàgines i entrades declaren l’espai de noms XHTML.

El hook `AfterCronJob` compara l’interval `ZM_PB_SITEMAP_UPDFREQ` amb l’hora de l’última generació correcta `ZM_PB_SITEMAP_LASTUPD`; amb el mapa desactivat tampoc no es pot generar manualment. Les versions lingüístiques es trien amb `lang_active`, no amb `lang_status`. Els fragments addicionals reben els sufixos `_2`, `_3` i següents. Si falla la generació, es restauren els fitxers anteriors i l’hora de l’èxit no canvia. Reviseu l’escriptura a l’arrel, `resources/` i `inc/editable_consts.php`; les taules es reparen a part a la base de dades del mòdul.

La generació automàtica depèn del cron de WHMCS i de l’interval configurat; el botó la inicia immediatament. Només s’hi inclouen pàgines i entrades publicades accessibles als visitants, amb les traduccions actives. Si una pàgina substitueix una pàgina del sistema, s’utilitza l’URL públic de la pàgina del sistema i no l’slug de la substitució. Els fitxers de més de 50.000 URL o 50 MB es divideixen. L’índex conserva altres mapes del lloc vàlids.

El mòdul escriu `sitemap_index.xml`, `sitemap_pages.xml` i `sitemap_posts.xml` a l'arrel del lloc; les categories buides no creen fitxer. No genera cap `sitemap.xml` combinat. Després de canviar pàgines o idiomes, torneu a generar els mapes i obriu l'índex al navegador. Si hi ha un error, comproveu els permisos d'escriptura a l'arrel; la data de la darrera generació correcta no canvia.

## Instruccions

- La generació automàtica s'executa després del cron de WHMCS quan correspon una actualització. La generació manual comença immediatament.
- S'inclouen les pàgines i entrades actives accessibles als visitants, incloses les seves versions publicades en altres idiomes. Les substitucions utilitzen els URL públics de les pàgines que substitueixen.
- Genera els mapes del lloc
- Fitxers a l'arrel del lloc
- Última generació correcta
- Pròxima actualització, no abans de
- Si no se selecciona res, el mapa del lloc s'actualitza diàriament.
- Quan està activat, /html-sitemap mostra el mapa del lloc com una pàgina HTML normal; sitemap.xml no es modifica.
- **Freqüència d'actualització** — Si és buit, s'utilitza 'monthly' per defecte.
- **Prioritat d'actualització** — Si és buit, s'utilitza '0.5' per defecte.
