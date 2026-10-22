# Multimòdul gratuït per a WHMCS

**Abans d'utilitzar-lo, genereu salts únics i introduïu ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT i ZM_PB_NONCE_SALT a module_init.php.** El mòdul s'ha desenvolupat i provat amb WHMCS 8.13.1–8.13.7. Apache té suport complet. Nginx també pot funcionar, però l'encaminament per idiomes de la pàgina inicial pot requerir configuració addicional.

**Abans del primer ús, obriu Configuració del mòdul → Idiomes compatibles i activeu els idiomes que necessiteu.**

**Versions de PHP comprovades:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 i 8.5.

**zmchel WHMCS Multimodule és gratuït.** Permet gestionar pàgines i articles des de l'administració de WHMCS amb un editor visual, traduccions, menús, fitxers multimèdia, camps SEO, mapes del lloc XML, redireccions i regles de reescriptura.

## Gestor d'idiomes (en desenvolupament)

A l'administració de WHMCS, obriu el Gestor d'idiomes i trieu una secció (idiomes de client o d'administració de WHMCS, aquest mòdul o un altre) i un idioma. Compareu l'original o la referència amb la traducció, editeu una fila i deseu-la; també podeu exportar i importar les claus existents com a JSON. Els idiomes nous hereten la referència fins que es tradueixen. El gestor activa i desactiva fitxers d'idioma i corregeix noms antics; canvieu abans l'idioma per defecte a WHMCS.

## Desenvolupament futur

- Afegir pàgines imbricades i categories de pàgines.
- Dividir el monòlit actual en components que col·laborin.
- Crear un gestor de permisos d'accés a l'administració del mòdul.
- Ampliar els idiomes predeterminats de supported_langs.php.
- Crear un editor de codi per a plantilles del mòdul i temes de client, excloent-ne el tema d'administració.
- Crear un gestor dels fitxers d'idioma de WHMCS i d'altres mòduls.
- Millorar el gestor multimèdia.
- Desenvolupar un gestor SEO complet i eficient inspirat en Yoast SEO.
- Afegir mapes del lloc XML multilingües i una pàgina HTML del mapa del lloc.
- Afegir estadístiques d'ús al gestor de pàgines.
- Minificar JS, CSS i HTML, emmagatzemar en memòria cau pàgines completes i optimitzar les taules del mòdul i de WHMCS.
- Afegir un sistema d'actualització adequat.

Són plans, no un calendari de desenvolupament definit.

## Proposa una idea

Envia una proposta per correu electrònic. [ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E)

## Fes una pregunta

Envia una pregunta sobre el mòdul per correu electrònic. [ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E)
