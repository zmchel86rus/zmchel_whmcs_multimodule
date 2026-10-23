# Regles de reescriptura

## .htaccess

Obriu el gestor i compareu les regles amb el fitxer principal `.htaccess`. Per a una regla pròpia, deseu el patró d'URL, la destinació i els indicadors; després premeu **Afegeix o actualitza les regles** per escriure el bloc abans de les regles WHMCS. Comproveu-ne de nou l'estat i obriu una pàgina publicada en l'idioma principal i en un altre. Un patró massa ampli pot afectar altres pàgines. Amb Nginx → Apache, les regles només actuen en les peticions enviades a Apache.

## Instruccions

- Regles per als URL d'idioma, incloses les pàgines a /ru/, /en/ i altres prefixos. Els idiomes es defineixen a supported_langs.php; les regles s'insereixen a .htaccess abans de les regles de WHMCS.
- Nginx no llegeix .htaccess i, per tant, aquestes regles no hi funcionen. Configureu regles equivalents a nginx.
- S'ha detectat una configuració nginx → Apache. Aquestes regles només funcionen per a les sol·licituds reenviades a Apache; nginx no llegeix .htaccess.
- Comprova les regles
- Afegeix o actualitza les regles
- Elimina totes les regles de .htaccess
- Patró d'URL
- Destinació
- Indicadors
- Després d'afegir o suprimir una regla, feu clic a «Afegeix o actualitza les regles» per aplicar els canvis a .htaccess.

## 1. Instal·lació i accés

Activeu el complement a WHMCS i doneu accés als administradors autoritzats. Comproveu les taules necessàries a la base de dades del mòdul. Reviseu els URL amigables, les rutes d'idioma i les ubicacions dels menús. Apache utilitza .htaccess; amb Nginx cal configurar les regles equivalents al servidor.
