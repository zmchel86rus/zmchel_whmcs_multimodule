# Bloque de paginación

Sitúe el bloque antes o después de la lista. En ajustes pulse **Seleccionar bloque en el lienzo** y elija el bloque Smarty o contenedor de elementos; Esc cancela. La paginación debe quedar fuera del bloque de destino. Para Smarty indique la variable de la lista completa, por ejemplo `$registered_domains`; el signo `$` es opcional. Mantenga el `{foreach}` normal sin otro `array_slice`. Configure elementos por página y botones al principio, final y lados de la página actual por separado para escritorio y móvil. Puede duplicar los controles al otro lado de la misma lista.

## Enlaces y varias listas

Cada bloque puede usar la opción del módulo (`ZM_PB_PRETTY_URLS`), `/page/2/` o `?page=2`. Las URL con ruta necesitan reglas rewrite activas. Las rutas PHP directas usan parámetros GET. Los enlaces conservan filtros, orden, carpeta de instalación y prefijo de idioma; al cambiar de formato se elimina el número anterior.

La primera lista usa `page`, `count`, `sort`; las siguientes usan parámetros con sufijo basado en el ID del bloque. En `/page/N/`, `pager` indica a qué lista adicional corresponde el número. Duplicar la barra no crea otra lista. En subastas se admite ordenar por `domain_name`, `base_price`, `highest_bid`, `expiry_date` y `domain_rank`; `-` delante indica orden descendente. Campos desconocidos no llegan a SQL.

## Fuentes de datos

Archivo, precios fijos, lista general y dominios registrados realizan un conteo SQL separado y cargan solo la página actual. Los bloques independientes que usan la misma variable reciben su propio tramo. Las listas de pujas y de participación en portada filtran por estado antes de dividir, aunque aún cargan la colección original. Otros arrays Smarty conocidos se dividen en el contexto aislado del bloque.

Sin variable se dividen elementos HTML del contenedor elegido. Se puede indicar una clase o etiqueta repetida, como `tr`; se conservan `thead` y `tfoot`. Para listas grandes conviene usar una variable y evitar renderizarlo todo. El bloque Smarty vinculado dispone de `$zm_pagination`: `total`, `page`, `pages`, `count`, `offset`; por ejemplo `{$zm_pagination.offset + $v@iteration}`. La barra se oculta si no hay datos o solo hay una página.

## Cantidad, SEO y filtros

El selector opcional ofrece 10/25/50/100/250 registros. Puede colocarse junto a los botones o en otro contenedor; cambiarlo conserva filtros y vuelve a la primera página. El servidor limita tanto ajustes como `count`/`count_<id>` a 10–250 antes de calcular resultados y enlaces. Desde la página dos se añade el número al título, descripción existente y último breadcrumb; canonical apunta a esa página. **No indexar páginas posteriores** aplica `noindex` solo a ellas.

El antiguo bloque Buscar se convierte en Filtros al abrirlo. El filtro de texto puede buscar en varios campos separados por comas. Hay opciones Flex/Grid, espacios, alineación, posición de botones y columnas por dispositivo. Las fechas usan `YYYY-MM-DD` y el límite superior incluye todo el último día seleccionado. Pruebas aisladas con DOM y dependencias de WHMCS: `tests/pagination.php`, `tests/pagination.php query` y `tests/smarty_blocks.php`.
