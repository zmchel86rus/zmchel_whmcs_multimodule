# Paginació i filtres

Connecteu la paginació i els filtres a la mateixa llista. Trieu la quantitat de resultats i el format de l'URL; proveu la segona pàgina i un filtre.

## Enllaços i origen de la llista

Situeu la paginació fora del bloc de la llista i seleccioneu aquest bloc com a objectiu. Per a una llista Smarty, indiqueu la variable amb tots els elements; si no, es divideixen els elements HTML del contenidor. Trieu el format dels enllaços segons el mòdul, `/page/2/` o `?page=2`. El format de ruta necessita regles rewrite. Les llistes independents utilitzen paràmetres separats; els enllaços conserven la llengua, els filtres i l'ordre.

## Mida de pàgina, SEO i filtres

Establiu el nombre d'elements i, si cal, activeu el selector 10/25/50/100/250. Canviar la mida torna la llista a la primera pàgina. Noindex només s'aplica a partir de la segona pàgina; comproveu el títol i l'URL canònic. Vinculeu els filtres a la mateixa llista i proveu la segona pàgina i un resultat filtrat al lloc públic.

## page / count / pager

Per a una llista Smarty, indiqueu la variable amb tots els elements i manteniu el bucle `{foreach}`: el mòdul ja divideix la llista; no afegiu un segon `array_slice`. Sense variable es divideixen els elements HTML del contenidor; podeu indicar la classe d’una fila o l’etiqueta `tr`, mentre `thead` i `tfoot` romanen intactes. Configureu els botons prop de la pàgina actual per separat per a ordinador i mòbil. A les rutes PHP directes feu servir `?page=2`; `/page/2/` requereix regles rewrite. Les pàgines posteriors tenen un canonical propi i poden rebre `noindex`.

Si hi ha diverses llistes independents, la primera fa servir `page`, `count` i `sort`; les altres empren paràmetres amb l'ID del bloc. Amb la ruta `/page/N/`, `pager` indica a quina llista pertany el número. Al bloc Smarty, `$zm_pagination` ofereix `total`, `page`, `pages`, `count` i `offset`. El valor de `count` es limita a 10–250. Si la llista és buida o només té una pàgina, la paginació s'amaga.

## YYYY-MM-DD

Els filtres actuen sobre la mateixa llista que la paginació. La cerca de text pot consultar diversos camps separats per comes; l'interval de dates usa `YYYY-MM-DD` i inclou tot l'últim dia.

## Flex / Grid

Trieu Flex o Grid i ajusteu amplades i columnes per dispositiu. Aplicar o netejar filtres retorna la llista a la primera pàgina. Podeu moure el selector del nombre de resultats sense perdre'n l'enllaç; un panell duplicat controla la mateixa llista.

## Instruccions

- Fes clic al bloc de llista. Prem Esc per cancel·lar. Col·loca la paginació fora del bloc de destinació.
- Per a Smarty, indica la variable de la llista completa. Sense variable, es paginen els elements HTML del contenidor; opcionalment, indica una classe de fila o l'etiqueta tr. Els enllaços conserven count, sort i els filtres. S'admeten diverses llistes independents.
- Selector d'elements per pàgina: 10, 25, 50, 100, 250
- Arrossega el selector d'elements per pàgina dins de la paginació o a altres blocs de la pàgina. Continuarà vinculat a aquesta paginació.
- No indexis les pàgines a partir de la 2
- Selecciona el bloc de llista Smarty. La cerca i la paginació han d'apuntar al mateix bloc.
- Indica la variable de la llista completa. La cerca comprova qualsevol dels camps seleccionats i els filtres s'apliquen conjuntament. Les condicions s'apliquen abans de calcular les pàgines; aplicar o restablir torna a la primera pàgina. Si ja hi ha una paginació vinculada, se n'utilitza la variable.
- Format dels enllaços
- Elements per pàgina per defecte
