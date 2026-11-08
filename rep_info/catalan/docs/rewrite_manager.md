# Regles de reescriptura

## .htaccess

Obriu el gestor i compareu les regles amb el fitxer principal `.htaccess`. Per a una regla pròpia, deseu el patró d'URL, la destinació i els indicadors; després premeu **Afegeix o actualitza les regles** per escriure el bloc abans de les regles WHMCS. Comproveu-ne de nou l'estat i obriu una pàgina publicada en l'idioma principal i en un altre. Un patró massa ampli pot afectar altres pàgines. Amb Nginx → Apache, les regles només actuen en les peticions enviades a Apache.

## 1. Instal·lació i accés

Activeu el complement a WHMCS i doneu accés als administradors autoritzats. Comproveu les taules necessàries a la base de dades del mòdul. Reviseu els URL amigables, les rutes d'idioma i les ubicacions dels menús. Apache utilitza .htaccess; amb Nginx cal configurar les regles equivalents al servidor.
