# Configuració del mòdul

- [Importació i exportació](module_settings_transfer.md)

## Instruccions

- Trieu els idiomes que pot utilitzar el mòdul. Desactivar-ne un no elimina el contingut.
- Si feu servir URL amigables amb Apache, actualitzeu les regles al gestor de reescriptura després de canviar els idiomes.
- **URL amigables** — Activa els URL amigables, inclosos els URL del sistema.
- **Encaminament per idioma** — Activa o desactiva les rutes per idioma. Quan estan activades, les pàgines estan disponibles a /de/, /en/, /es/ i altres prefixos d'idiomes admesos. Quan estan desactivades, cada URL de pàgina mostra el contingut en l'idioma configurat per l'usuari.
- **Ruta de l'idioma predeterminat** — Afegeix un prefix a l'idioma predeterminat i redirigeix les pàgines del mòdul sense prefix cap a aquesta ruta.
- **Mode de manteniment (mòdul)** — Activa o desactiva el mode de manteniment del mòdul. Aquest mode menys restrictiu permet executar els hooks de WHMCS i altres components, a diferència del mode de manteniment del sistema.
- **Recopila variables de Smarty** — Activa o desactiva la recopilació de variables de Smarty.
- **Utilitza les variables de Smarty recopilades** — Activa o desactiva l'ús de les variables de Smarty recopilades a l'editor de pàgines.
- **Substitucions de pàgines** — Activa o desactiva les substitucions de pàgines.
- **Freqüència d'actualització** — Si no se selecciona res, el mapa del lloc s'actualitza diàriament.
- **Mapa del lloc HTML** — Quan està activat, /html-sitemap mostra el mapa del lloc com una pàgina HTML normal; sitemap.xml no es modifica.
- **Capçalera del lloc** — HTML personalitzat per a la secció <head>, inclosos <script> i <style>.
- **Peu de pàgina del lloc** — HTML personalitzat abans de </body>, inclosos <script> i <style>.
- **Edita robots.txt**

## 1. Instal·lació i accés

Activeu el complement a WHMCS i doneu accés als administradors autoritzats. Comproveu les taules necessàries a la base de dades del mòdul. Reviseu els URL amigables, les rutes d'idioma i les ubicacions dels menús. Apache utilitza .htaccess; amb Nginx cal configurar les regles equivalents al servidor.
