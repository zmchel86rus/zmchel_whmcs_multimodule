# Editor de páginas

- [Paginación y filtros](pages_editor_pagination.md)
- [Smarty y variables recopiladas](pages_editor_smarty.md)
- [Datos estructurados Schema.org](module_structured_data.md)

## Editor de bloques

Abra **Ajustes de contenido**, elija un idioma y arrastre un bloque GrapesJS al lienzo. Los bloques anidados van dentro de una sección, columna u otro contenedor. Al seleccionar uno, sus opciones aparecen en **GrapesJS · Ajustes del bloque**; la flecha oculta el panel y el navegador recuerda la elección. Edite texto normal en el bloque, texto enriquecido con TinyMCE y código en el editor del bloque correspondiente. Guarde el idioma y pulse **Visitar** para ver el resultado.

Hay bloques de texto, títulos, imágenes, vídeo, mapas, enlaces, botones, citas, listas, tablas, preguntas frecuentes, acordeón, índice, paginación, filtros, formulario de contacto, progreso, separadores, espacios, sección, Flex, Grid, `div`, tarjetas, galerías, carruseles, zonas para invitados/usuarios, CSS y JavaScript. Smarty depende de los ajustes. Los nombres y la disponibilidad pueden variar según el idioma y la configuración.

Para dos columnas, añada una **Sección**, seleccione `2` columnas e inserte una **Imagen** y un **Texto**. Configure también tabletas y móviles. Flex/Grid permiten diseños más específicos. Las tablas admiten filas, columnas, cabecera y pie. Los carruseles permiten configurar diapositivas, reproducción automática, bucle, velocidad y elementos visibles. Preguntas frecuentes produce marcado de FAQ; el acordeón sirve para otro contenido desplegable y se abre con doble clic en el editor.

En títulos, elija nivel `H1`–`H6`, tamaño y grosor; normalmente basta un `H1` principal. El índice enlaza los títulos posteriores. Los espacios se miden en píxeles. Escriba un `alt` significativo para las imágenes. Utilice el árbol de componentes de GrapesJS para seleccionar contenedores principales; antes de eliminar, verifique que haya seleccionado la celda o sección correcta.

### Pasar contenido entre idiomas

Encima del editor, elija el idioma destino y **Copiar con contenido**, **Copiar estructura** o **Clonar**. Las dos primeras añaden bloques con texto o solo diseño; Clonar sustituye el contenido de destino y pide confirmación si ya existe. Abra la pestaña de destino, traduzca el texto y guarde. También puede copiar un bloque seleccionado desde sus ajustes.

## Idiomas y enlaces

La lista de idiomas está en `supported_langs.php`. Con rutas de idioma y URL legibles, el idioma predeterminado solo va sin prefijo (`/contact/`) si su ruta opcional está desactivada y los otros usan `/ru/contact/`, `/de/contact/`, etc. Cambiar el idioma de una página no debería modificar el idioma del perfil del cliente.

En un bloque **Enlace** o **Botón**, active **Incluir idioma de la página actual en la URL** para páginas traducidas. Así `/contact/` pasa a `/ru/contact/` en la versión rusa; un prefijo existente se sustituye y se conservan parámetros y fragmentos. Guarde y pruebe el enlace en dos idiomas. En bloques nuevos la opción está activa; los antiguos mantienen su comportamiento hasta que se cambien.

Desactive la opción para URL externas, archivos, `mailto:`, `tel:`, anclas y rutas WHMCS sin versión por idioma como `/login` o `/clientarea.php`. Activarla no crea una traducción de destino: publique también esa versión. Los enlaces escritos en TinyMCE o Smarty carecen de este interruptor y se revisan manualmente.

## SEO y mapa del sitio de una página

Abra **Metadatos**, elija un idioma y rellene el **Título** y la **Meta descripción** en ese idioma. Opcionalmente configure migas de pan y datos/imágenes Open Graph y Twitter; los campos sociales vacíos pueden usar metadatos principales. Revise URL canónica, robots y tipo Schema: `WebPage` para una página común, un tipo de artículo para artículos y `ContactPage` para contacto. No elija `Organization` como tipo principal solo porque el sitio pertenezca a una empresa. Guarde cada idioma.

Para una página publicada que no sea del sistema, establezca frecuencia y prioridad en **Ajustes del mapa del sitio**. Compruebe título HTML, descripción, enlaces de idiomas y un `H1` útil. Una sustitución utiliza en el mapa la URL pública de la página reemplazada, no el slug interno.

## Formulario de contacto

Inserte **Formulario de contacto** y configure título, descripción, asunto y botón. Elija **Ticket WHMCS** con departamento de soporte o **Correo electrónico** con destinatario en el bloque. Añada campos con nombre, tipo, obligatoriedad y validación. Un ticket de invitado necesita campos con funciones de nombre y email del remitente. Para listas desplegables, escriba una opción por línea como `valor : Etiqueta`, por ejemplo `sales : Ventas`.

Para varios consentimientos, cree campos **Consentimiento** separados, cada uno con texto y obligatoriedad propios. Se permiten enlaces seguros como `<a href="/privacy/">privacidad</a>`. Ordene los campos, anchuras y saltos de línea; si conviene, use Flex/Grid. CAPTCHA usa el tipo y las claves configuradas en WHMCS. Para email, seleccione mensaje de sistema sin plantilla WHMCS o formato normal. Guarde y envíe una prueba como visitante; verifique destinatario/ticket, errores y reinicio del formulario. Si PHP `mail()` falla, configure SMTP en WHMCS. El estado verde del editor no confirma entrega.

## Instrucciones

- Contenedor anidado con diseño flex. Arrastre otros bloques dentro.
- Contenedor anidado con diseño CSS Grid. Arrastre otros bloques dentro.
- Carrusel Bootstrap anidado. Arrastre bloques dentro; cada uno será una diapositiva.
- Todos los bloques bajo este bloque solo se muestran a usuarios autenticados. Funciona únicamente con el tipo de acceso «Mixto».
- Todos los bloques bajo este bloque solo se muestran a invitados. Funciona únicamente con el tipo de acceso «Mixto».
- **Título de la página**
- **Metadescripción**
- **URL canónica**
- **Robots** — index, follow / noindex, nofollow. Controla la indexación.
- **Tipo de Schema** — Si se desactiva, no se genera marcado JSON de Schema.org para esta página.
