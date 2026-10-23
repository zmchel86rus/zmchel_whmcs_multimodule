# Dades estructurades

- **Editor de pàgines → Configuració de les metadades → Tipus de Schema → Desa.**

Ompliu les metadades i el tipus de pàgina adequat per a cada idioma: WebPage, un tipus d'article o ContactPage. Després de publicar, comproveu JSON-LD i l'URL canònic.

## Què marca el mòdul

Els menús i la taula de continguts poden generar `SiteNavigationElement`, les preguntes i respostes visibles `FAQPage` i una ruta de navegació amb diversos elements `BreadcrumbList`. Els blocs de disseny, els botons i els filtres no reben automàticament un tipus de contingut. El tipus Schema triat per a la pàgina controla el seu JSON-LD; si està desactivat, aquest marcatge no s'emet.

## Comprovació després de publicar

A la pàgina pública, comproveu el JSON-LD, l'URL canònic, la llengua i el contingut realment visible. Un marcatge vàlid no garanteix resultats enriquits als cercadors.

## Schema.org

`SiteNavigationElement` fa servir els enllaços i títols de menú realment visibles; la taula de continguts pot afegir `WebPageElement` per als encapçalaments que existeixen. `FAQPage` només inclou preguntes i respostes completes visibles al visitant: se n'exclouen blocs ocults i acordions normals. `BreadcrumbList` es crea només amb dos elements o més. Les dades de l'organització provenen de WHMCS; els idiomes de contacte s'indiquen a `ContactPoint.availableLanguage` en format BCP 47. No s'endevina cap tipus Schema per a filtres, paginació, formularis o HTML personalitzat.

## Instruccions

- **Tipus de Schema** — Quan està desactivat, no es genera el marcatge JSON de Schema.org per a aquesta pàgina.
- **Ruta de navegació** — Nom de la pàgina a la ruta de navegació
- **URL canònic**
- **Títol de la pàgina**
- **Metadescripció**
- **Títol d'Open Graph** — Si és buit, s'utilitza el títol de la pàgina.
- **Descripció d'Open Graph** — Si és buida, s'utilitza la metadescripció.
- **Imatge d'Open Graph** — Si és buida, s'utilitza la imatge de la pàgina.
