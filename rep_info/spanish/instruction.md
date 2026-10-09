# Instrucciones de ZMChel WHMCS Multimodule

**Antes de usar el módulo, genere valores salt únicos e introdúzcalos en `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` y `ZM_PB_NONCE_SALT`.** El módulo se desarrolló y probó con **WHMCS 8.13.1** y ofrece **compatibilidad completa con Apache (100 %)**. También puede funcionar con Nginx, pero compruebe por separado el enrutamiento por idioma de la página de inicio.

Esta guía es para el personal que administra el contenido del sitio desde WHMCS. El trabajo cotidiano con textos, imágenes y menús no requiere programación. Antes de cambiar direcciones, redirecciones, reglas del servidor o código, exporte los ajustes: esos cambios pueden afectar a páginas publicadas.

## 1. Orientación

Entre en la administración de WHMCS con acceso al complemento y abra **Complementos → ZMChel WHMCS Multimodule**. Las pestañas incluyen lista de páginas, mapa del sitio, biblioteca multimedia, gestor de menús, reglas rewrite, redirecciones, base de datos y ajustes. En la lista puede crear, buscar, editar o quitar páginas y configurar sustituciones de páginas WHMCS. En **Base de datos del módulo**, un administrador puede detectar y reparar tablas ausentes.

Un **slug** es la parte de la dirección tras el dominio, por ejemplo `contact` en `/contact/`. Un borrador no es visible al público; una página publicada sí. Un **bloque** es una pieza del contenido. Una **sustitución** muestra contenido creado en el editor bajo una dirección WHMCS ya existente.

## 2. Crear y publicar una página

1. Abra **Lista de páginas → Añadir página**. Escriba un nombre interno y un slug con letras latinas, números y guiones, por ejemplo `about-us`. No incluya dominio, prefijo de idioma, `?` ni `.php`.
2. Seleccione el acceso: **Mixto** para todos con zonas opcionales de invitados y usuarios, **Autorizados** para quienes han iniciado sesión o **No autorizados** para invitados.
3. Elija **Borrador** durante la preparación, **Publicado** para mostrarla, **Aplazado** para mantenerla fuera del sitio o **Papelera**. Aplazado no equivale a publicación programada. Elija el tipo **Página**, **Artículo** o **Página del sistema**; este último no se publica como página normal ni aparece en el mapa del sitio.
4. Marque los idiomas disponibles; el predeterminado ya está incluido. Guarde y vuelva a abrir el registro. Rellene **Contenido**, **Metadatos** y, para páginas publicadas no sistémicas, **Mapa del sitio** por idioma. Cada sección tiene su botón **Guardar** y al final está **Guardar todo**. Compruebe el mensaje de éxito y los avisos de cambios sin guardar.

La lista permite buscar y filtrar por acceso, tipo, estado e idioma. **Visitar** abre la URL pública. **Eliminar** envía primero la página a la papelera; desde allí se elimina definitivamente.

## 3. Editor de bloques

Abra **Ajustes de contenido**, elija un idioma y arrastre un bloque GrapesJS al lienzo. Los bloques anidados van dentro de una sección, columna u otro contenedor. Al seleccionar uno, sus opciones aparecen en **GrapesJS · Ajustes del bloque**; la flecha oculta el panel y el navegador recuerda la elección. Edite texto normal en el bloque, texto enriquecido con TinyMCE y código en el editor del bloque correspondiente. Guarde el idioma y pulse **Visitar** para ver el resultado.

Hay bloques de texto, títulos, imágenes, vídeo, mapas, enlaces, botones, citas, listas, tablas, preguntas frecuentes, acordeón, índice, paginación, filtros, formulario de contacto, progreso, separadores, espacios, sección, Flex, Grid, `div`, tarjetas, galerías, carruseles, zonas para invitados/usuarios, CSS y JavaScript. Smarty depende de los ajustes. Los nombres y la disponibilidad pueden variar según el idioma y la configuración.

Para dos columnas, añada una **Sección**, seleccione `2` columnas e inserte una **Imagen** y un **Texto**. Configure también tabletas y móviles. Flex/Grid permiten diseños más específicos. Las tablas admiten filas, columnas, cabecera y pie. Los carruseles permiten configurar diapositivas, reproducción automática, bucle, velocidad y elementos visibles. Preguntas frecuentes produce marcado de FAQ; el acordeón sirve para otro contenido desplegable y se abre con doble clic en el editor.

En títulos, elija nivel `H1`–`H6`, tamaño y grosor; normalmente basta un `H1` principal. El índice enlaza los títulos posteriores. Los espacios se miden en píxeles. Escriba un `alt` significativo para las imágenes. Utilice el árbol de componentes de GrapesJS para seleccionar contenedores principales; antes de eliminar, verifique que haya seleccionado la celda o sección correcta.

### Pasar contenido entre idiomas

Encima del editor, elija el idioma destino y **Copiar con contenido**, **Copiar estructura** o **Clonar**. Las dos primeras añaden bloques con texto o solo diseño; Clonar sustituye el contenido de destino y pide confirmación si ya existe. Abra la pestaña de destino, traduzca el texto y guarde. También puede copiar un bloque seleccionado desde sus ajustes.

## 4. Idiomas y enlaces

La lista de idiomas está en `supported_langs.php`. Con rutas de idioma y URL legibles, el idioma predeterminado no lleva prefijo (`/contact/`) y los otros usan `/ru/contact/`, `/de/contact/`, etc. Cambiar el idioma de una página no debería modificar el idioma del perfil del cliente.

En un bloque **Enlace** o **Botón**, active **Incluir idioma de la página actual en la URL** para páginas traducidas. Así `/contact/` pasa a `/ru/contact/` en la versión rusa; un prefijo existente se sustituye y se conservan parámetros y fragmentos. Guarde y pruebe el enlace en dos idiomas. En bloques nuevos la opción está activa; los antiguos mantienen su comportamiento hasta que se cambien.

Desactive la opción para URL externas, archivos, `mailto:`, `tel:`, anclas y rutas WHMCS sin versión por idioma como `/login` o `/clientarea.php`. Activarla no crea una traducción de destino: publique también esa versión. Los enlaces escritos en TinyMCE o Smarty carecen de este interruptor y se revisan manualmente.

## 5. SEO y mapa del sitio de una página

Abra **Metadatos**, elija un idioma y rellene el **Título** y la **Meta descripción** en ese idioma. Opcionalmente configure migas de pan y datos/imágenes Open Graph y Twitter; los campos sociales vacíos pueden usar metadatos principales. Revise URL canónica, robots y tipo Schema: `WebPage` para una página común, un tipo de artículo para artículos y `ContactPage` para contacto. No elija `Organization` como tipo principal solo porque el sitio pertenezca a una empresa. Guarde cada idioma.

Para una página publicada que no sea del sistema, establezca frecuencia y prioridad en **Ajustes del mapa del sitio**. Compruebe título HTML, descripción, enlaces de idiomas y un `H1` útil. Una sustitución utiliza en el mapa la URL pública de la página reemplazada, no el slug interno.

## 6. Sustituir una página WHMCS

Cree y publique primero la página del editor. En **Lista de páginas → Sustitución de páginas**, pulse **Añadir sustitución**, elija la página WHMCS y la página creada, seleccione el tipo y guarde. **Completa** sustituye contenido y metadatos; **Antes** o **Después** añade bloques al contenido original; **Solo metadatos** cambia SEO; las opciones combinadas añaden bloques y cambian metadatos. Una misma página del sistema no puede asignarse dos veces.

Pruebe la **URL pública WHMCS**, como invitado y como cliente conectado. Si difieren, el slug interno redirige a la dirección pública. Para restringir solo partes de la página, use acceso Mixto con zonas para invitados y usuarios.

## 7. Imágenes y biblioteca multimedia

Abra **Gestor multimedia → Subir archivo**, seleccione un archivo y escriba un **Alt** descriptivo para las imágenes. Nombre, título y descripción ayudan a localizar y rotular el archivo. Después de subirlo, utilice búsqueda, filtro de tipo y **Cargar más**. En un bloque Imagen, pulse **Elegir imagen**, seleccione el archivo y guarde la página.

El gestor crea varios tamaños de imagen. Puede usar **Optimizar imagen** incluso si ya se optimizó antes; revise la calidad, especialmente texto de banners. Si las variantes adaptables no convienen, desactive `srcset` en ese bloque. No use un marcador `data:image/svg+xml…` como URL de una imagen real.

## 8. Menús

En **Gestor de menús**, cree uno y asígnele un nombre. Añada páginas o artículos; use **Enlace personalizado** para URL externas, páginas del sistema o títulos de columnas. Arrastre los elementos para ordenar y anidar. En cada elemento puede cambiar texto, etiquetas de otros idiomas, pestaña de destino, visibilidad, clases CSS y atributos. Para enlaces propios, elija si se añade el idioma actual; `/clientarea.php` y rutas sin traducción deben conservar su URL.

Active el menú, decida si **complementa** o **sustituye** la navegación WHMCS, y elija visibilidad de escritorio/móvil. Asígnelo a barras superiores/laterales principales o secundarias, o al pie; solo puede haber un menú por ubicación. Guarde y pruebe ambas pantallas. En el pie, los elementos principales son columnas y los anidados son enlaces; `#` sirve para un encabezado sin destino. Active también la ubicación en los ajustes del módulo. Si faltan tablas, repárelas en **Base de datos del módulo**. Más información: [menús](../../docs/menus.md).

## 9. Formulario de contacto

Inserte **Formulario de contacto** y configure título, descripción, asunto y botón. Elija **Ticket WHMCS** con departamento de soporte o **Correo electrónico** con destinatario en el bloque. Añada campos con nombre, tipo, obligatoriedad y validación. Un ticket de invitado necesita campos con funciones de nombre y email del remitente. Para listas desplegables, escriba una opción por línea como `valor : Etiqueta`, por ejemplo `sales : Ventas`.

Para varios consentimientos, cree campos **Consentimiento** separados, cada uno con texto y obligatoriedad propios. Se permiten enlaces seguros como `<a href="/privacy/">privacidad</a>`. Ordene los campos, anchuras y saltos de línea; si conviene, use Flex/Grid. CAPTCHA usa el tipo y las claves configuradas en WHMCS. Para email, seleccione mensaje de sistema sin plantilla WHMCS o formato normal. Guarde y envíe una prueba como visitante; verifique destinatario/ticket, errores y reinicio del formulario. Si PHP `mail()` falla, configure SMTP en WHMCS. El estado verde del editor no confirma entrega.

## 10. Listas, filtros y paginación

Vincule el bloque **Paginación** a la lista concreta, por ejemplo una lista Smarty. Configure fuente de datos, cantidad predeterminada, botones visibles, URL `/page/N/` o `?page=N`, selector opcional 10/25/50/100/250 e indexación de páginas posteriores. El servidor limita `count` a 10–250. El selector puede situarse junto a los botones o en otra parte. **Filtros** ofrece búsqueda por texto, rango y fecha; no existe bloque independiente de búsqueda. Vincule filtros a la misma lista. Compruebe que la página 2 cambia resultados y conserva URL limpias. Más información: [paginación](../../docs/pagination.md).

## 11. Smarty, CSS y JavaScript

Active **Uso de variables Smarty** antes de añadir un bloque Smarty. En su editor de código, elija una variable recopilada y guarde. La disponibilidad depende de la página y del momento en que otros módulos crean variables. Solo se permite la sintaxis de plantilla prevista: PHP, SQL y acceso directo a la base de datos están prohibidos. Ejemplo: `{$pageTitle|escape}`. Compruebe el resultado como invitado y cliente y no imprima objetos completos con datos personales. Más información: [Smarty](../../docs/smarty.md).

**Custom CSS** y **Custom JS** afectan a la página: pruebe móvil y otros idiomas. El código global de cabecera/pie está en los ajustes del módulo y debe editarlo alguien que conozca HTML, CSS y JavaScript.

## 12. Mapa del sitio, redirecciones y rewrite

Active la generación de mapas y configure la frecuencia en **Ajustes del módulo**. En **Mapa del sitio**, revise la última ejecución y las URL previstas, pulse **Generar mapas del sitio** y abra `sitemap_index.xml` y sus archivos. La generación automática depende del cron de WHMCS. El índice puede incluir otros mapas en la raíz del sitio. Las sustituciones usan URL públicas y los idiomas no publicados no deben aparecer. Más información: [mapas del sitio](../../docs/sitemaps.md).

En **Gestor de redirecciones**, indique origen `/old-page/` y destino `/new-page/`, seleccione `301` si el cambio es permanente o `302` si es temporal, active, guarde y pruebe la URL antigua. La creación automática tras cambiar un slug tiene interruptor y antigüedad mínima propios. Más información: [redirecciones](../../docs/redirects.md).

En **Gestor rewrite**, pulse **Comprobar reglas** y después **Añadir o actualizar reglas** para escribir `.htaccess`. En reglas personalizadas, indique patrón de URL, destino y flags, y vuelva a aplicar. Apache usa `.htaccess`; Nginx requiere reglas equivalentes del servidor. Una regla errónea puede afectar a todo el sitio.

## 13. Ajustes, importación y mantenimiento

Los **Ajustes del módulo** incluyen URL legibles, rutas de idiomas, sustituciones, posiciones de menús, modo de mantenimiento, Smarty, redirecciones, frecuencia del mapa, código de cabecera/pie, `robots.txt` e importación/exportación. Antes de cambios importantes, exporte todas o algunas secciones a JSON. Puede incluir páginas y traducciones, menús, ajustes, redirecciones, reglas y archivos multimedia. No sustituye una copia completa de WHMCS ni incluye cuentas, secretos, revisiones de páginas o temas. Más información: [importación y exportación](../../docs/transfer.md).

Para importar, elija el JSON y las secciones, pulse **Importar** y confirme. Pueden actualizarse registros coincidentes. Compruebe después páginas, menús y medios; aplique por separado las reglas importadas y regenere el mapa. **Base de datos del módulo** comprueba y repara tablas/columnas ausentes. El mantenimiento cierra las páginas públicas del módulo a visitantes normales; pruébelo en una ventana sin sesión.

En la primera instalación, active el complemento y conceda permisos, revise la base de datos, URL legibles, idiomas, sustituciones y áreas de menús, aplique reglas Apache o configure rutas Nginx, compruebe cron WHMCS y permisos de escritura para mapas y medios. Publique una página de prueba en dos idiomas y revise menús, sustituciones y redirecciones. Active la recopilación Smarty solo para personal que la necesite.

## 14. Comprobación y problemas comunes

Antes de entregar la página, compruebe estado **Publicado**, contenido y metadatos guardados en cada idioma. Abra la URL pública como visitante y en pantalla estrecha. Revise título, imágenes, `alt`, botones, enlaces y formularios. Compruebe dos idiomas y, para sustituciones, la URL del sistema. Pruebe menús en escritorio/móvil y la URL antigua tras cambiar un slug. Regenere `sitemap_index.xml` después de publicaciones o sustituciones.

Ante un 404 revise publicación, slug, traducción, URL legibles y rewrite. Si falta contenido en otro idioma, revise ese contenido y SEO: copiar la estructura no traduce el texto. Si un enlace lleva a `/ru/login`, desactive su opción de idioma. Si no aparece un menú, revise activación, ubicación, salida del módulo y modo de pantalla. Si falla una imagen, elija un archivo real. Si no llega un formulario, compruebe destinatario y correo/SMTP de WHMCS. Si falla el menú, revise campos obligatorios y tablas. Si el mapa no se actualiza, revise configuración, cron y escritura. Las reglas rewrite guardadas deben aplicarse y Nginx se configura aparte.

Al comunicar un error, incluya URL pública, nombre/número de página, idioma, acción, resultado esperado y real y mensaje exacto. No envíe contraseñas ni secretos.

### Documentación adicional

- [Menús](../../docs/menus.md)
- [Smarty y variables recopiladas](../../docs/smarty.md)
- [Paginación y filtros](../../docs/pagination.md)
- [Mapas del sitio](../../docs/sitemaps.md)
- [Redirecciones](../../docs/redirects.md)
- [Datos estructurados Schema.org](../../docs/structured-data.md)
- [Importación y exportación](../../docs/transfer.md)
