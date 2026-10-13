# Mapa del sitio

El generador está en `lib/sitemap.php`, las funciones auxiliares en `inc/sitemap_manager.php` y el hook `AfterCronJob` en `hooks/sitemap.php`. Si `ZM_PB_ENABLE_SITEMAP` está desactivado, no se registra el hook ni se permite la generación manual.

Tras cada cron se comparan la hora actual, `ZM_PB_SITEMAP_LASTUPD` y `ZM_PB_SITEMAP_UPDFREQ`. Una frecuencia vacía o desconocida equivale a un día. La hora de la última generación **correcta** se guarda en `inc/editable_consts.php`. El botón **Generar** de `sitemap_manager` ejecuta el proceso inmediatamente.

En la raíz del sitio se crean `sitemap_index.xml`, `sitemap_pages.xml` y `sitemap_posts.xml`. Si una categoría supera 50.000 URL o 50 MB, se divide en archivos `_2`, `_3` y sucesivos. El índice incluye otros mapas `urlset` válidos presentes en la raíz, sin anidar índices. El módulo solo actualiza o elimina sus propios archivos de páginas/artículos y actualiza el índice compartido; no cambia los ajenos.

Solo entran páginas y artículos activos, publicados, accesibles sin iniciar sesión y con versiones de idioma activas. La publicación usa `page.status = publish` y la disponibilidad `lang_active`; no se consulta `lang_status`, que el editor no usa para publicar. Las sustituciones muestran la URL pública de la página nativa y omiten el slug propio del diseño. El idioma principal no lleva prefijo; los demás siguen la configuración de rutas.

Una categoría vacía no crea archivo. El generador no produce un `sitemap.xml` combinado. Si tras una actualización solo queda el índice, genere de nuevo desde el gestor. Se necesita escritura en la raíz, `resources/` del módulo e `inc/editable_consts.php`. Las tablas ausentes se reparan en **Base de datos del módulo**. Ante un fallo se restauran los archivos temporales y se conserva la hora de la última generación correcta. Prueba aislada con dependencias del proyecto y extensiones XML, mbstring y SQLite: `php -d extension=pdo_sqlite tests/sitemap.php`.
