# Instruccions de zmchel WHMCS Multimodule

**Abans d'utilitzar-lo, genereu salts únics i introduïu ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT i ZM_PB_NONCE_SALT a module_init.php.** El mòdul s'ha desenvolupat i provat amb WHMCS 8.13.1–8.13.7. Apache té suport complet. Nginx també pot funcionar, però l'encaminament per idiomes de la pàgina inicial pot requerir configuració addicional.

**Abans del primer ús, obriu Configuració del mòdul → Idiomes compatibles i activeu els idiomes que necessiteu.**

**Versions de PHP comprovades:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 i 8.5.

**zmchel WHMCS Multimodule és gratuït.** Permet gestionar pàgines i articles des de l'administració de WHMCS amb un editor visual, traduccions, menús, fitxers multimèdia, camps SEO, mapes del lloc XML, redireccions i regles de reescriptura.

## Gestor d'idiomes (en desenvolupament)

A l'administració de WHMCS, obriu el Gestor d'idiomes i trieu una secció (idiomes de client o d'administració de WHMCS, aquest mòdul o un altre) i un idioma. Compareu l'original o la referència amb la traducció, editeu una fila i deseu-la; també podeu exportar i importar les claus existents com a JSON. Els idiomes nous hereten la referència fins que es tradueixen. El gestor activa i desactiva fitxers d'idioma i corregeix noms antics; canvieu abans l'idioma per defecte a WHMCS.

→ [Gestor d'idiomes](docs/language-manager.md)

## 1. Instal·lació i accés

Activeu el complement a WHMCS i doneu accés als administradors autoritzats. Comproveu les taules necessàries a la base de dades del mòdul. Reviseu els URL amigables, les rutes d'idioma i les ubicacions dels menús. Apache utilitza .htaccess; amb Nginx cal configurar les regles equivalents al servidor.

## 2. Creació de pàgines

Obriu la llista de pàgines i afegiu-ne una. Indiqueu un nom intern i un slug amb lletres llatines, números i guionets, per exemple about-us. Trieu accés per a tothom, només per a clients identificats o només per a visitants. Seleccioneu l'estat i els idiomes. El mòdul ha de reconèixer l'idioma per defecte de WHMCS.

## 3. Edició del contingut

Per a cada idioma, ompliu les pestanyes Contingut, Metadades i Mapa del lloc. Arrossegueu blocs a l'editor, modifiqueu textos i imatges i deseu cada pestanya. Copiar amb contingut proporciona una base; copiar l'estructura prepara la disposició per traduir-la. El text no es tradueix automàticament.

## 4. Enllaços i publicació

Activeu l'opció d'afegir l'idioma actual a l'URL per als enllaços a pàgines traduïdes del mòdul. Desactiveu-la per a URL externs, correu electrònic i rutes de WHMCS sense versió lingüística. Després de publicar, comproveu la pàgina com a visitant i com a client, en mòbil i ordinador, i en dos idiomes.

## 5. Gestió i manteniment

El gestor de menús controla la navegació i el gestor multimèdia controla les imatges. El gestor de redireccions crea regles 301 i 302. El mapa del lloc genera fitxers XML. Exporteu la configuració abans de canvis importants; torneu a aplicar les regles de reescriptura i reviseu el mapa del lloc després de publicar.

## Temes detallats

- [Menús](docs/menus.md)
- [Paginació i filtres](docs/pagination.md)
- [Redireccions](docs/redirects.md)
- [Mapes del lloc](docs/sitemaps.md)
- [Smarty i variables](docs/smarty.md)
- [Dades estructurades](docs/structured-data.md)
- [Importació i exportació](docs/transfer.md)
