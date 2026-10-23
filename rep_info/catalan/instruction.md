# Instruccions de zmchel WHMCS Multimodule

**Abans d'utilitzar-lo, genereu salts únics i introduïu ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT i ZM_PB_NONCE_SALT a module_init.php.** El mòdul s'ha desenvolupat i provat amb WHMCS 8.13.1–8.13.7. Apache té suport complet. Nginx també pot funcionar, però l'encaminament per idiomes de la pàgina inicial pot requerir configuració addicional.

**Abans del primer ús, obriu Configuració del mòdul → Idiomes compatibles i activeu els idiomes que necessiteu.**

**Versions de PHP comprovades:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 i 8.5.

**zmchel WHMCS Multimodule és gratuït.** Permet gestionar pàgines i articles des de l'administració de WHMCS amb un editor visual, traduccions, menús, fitxers multimèdia, camps SEO, mapes del lloc XML, redireccions i regles de reescriptura.

## Configuració del mòdul

Trieu els idiomes que pot utilitzar el mòdul. Desactivar-ne un no elimina el contingut.

- **Configuració del mòdul → Idiomes admesos → Activa**
- **Base de dades del mòdul → Corregeix Elements seleccionats**
- **Regles de reescriptura → Comprova les regles → Afegeix o actualitza les regles**

Nginx no llegeix .htaccess i, per tant, aquestes regles no hi funcionen. Configureu regles equivalents a nginx.

## Gestor de pàgines

- **Afegeix una pàgina → Nom de la pàgina → Slug de la pàgina → Desa**
- **Editor de pàgines → Configuració del contingut → Configuració de les metadades → Configuració del mapa del lloc de la pàgina → Desa-ho tot**
- **Gestor de pàgines → Visita**
- **Mapa del lloc → Genera els mapes del lloc**

Només s'admeten lletres llatines, guionets i dígits.

Usuaris amb sessió iniciada: només poden accedir a la pàgina els usuaris amb sessió iniciada; visitants: només hi poden accedir els visitants; mixt: tothom hi pot accedir, amb la visibilitat controlada pels blocs de la pàgina.

La generació automàtica s'executa després del cron de WHMCS quan correspon una actualització. La generació manual comença immediatament.

## Guies per secció

- [Gestor de pàgines](docs/pages_manager.md)
- [Editor de pàgines](docs/pages_editor.md)
- [Gestor multimèdia](docs/media_manager.md)
- [Menús](docs/menu_manager.md)
- [Gestor d'idiomes](docs/langs_manager.md)
- [Redireccions](docs/redirects_manager.md)
- [Mapes del lloc](docs/sitemap_manager.md)
- [Regles de reescriptura](docs/rewrite_manager.md)
- [Configuració del mòdul](docs/module_settings.md)
- [Base de dades del mòdul](docs/module_db.md)

## Materials addicionals

- [Paginació i filtres](docs/pages_editor_pagination.md)
- [Smarty i variables](docs/pages_editor_smarty.md)
- [Dades estructurades](docs/module_structured_data.md)
- [Importació i exportació](docs/module_settings_transfer.md)
