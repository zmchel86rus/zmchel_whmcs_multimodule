# Importación y exportación

## JSON

Abra **Ajustes del módulo → Importar / exportar**. Un archivo JSON (`zmchel_whmcs_multimodule`, versión 1) puede contener todas las secciones o solo las elegidas:

- **Páginas y artículos:** ajustes, traducciones, contenido GrapesJS, SEO y mapa del sitio. CSS/JS generado se exporta como código y se recrea con el nuevo ID de página.
- **Menús:** jerarquía, títulos traducidos, ubicaciones y ajustes. Las páginas se emparejan por `slug + auth_type` y los menús por nombre; resuelva antes los nombres duplicados en destino.
- **Ajustes:** constantes editables, valores del módulo, sustituciones, cabecera/pie y `robots.txt`. El modo de URL del sistema y la fecha del último mapa permanecen locales.
- **Redirecciones:** reglas manuales y vínculos de reglas automáticas a páginas.
- **Rewrite:** reglas propias; aplíquelas después en el gestor correspondiente.
- **Medios:** solo archivos registrados, variantes, descripciones y atributos, no otros adjuntos de WHMCS. Los conflictos de nombre se resuelven con otro nombre y se actualizan las referencias importadas.

La importación actualiza coincidencias, añade registros nuevos y conserva los demás. Se omiten secciones seleccionadas que faltan en el archivo. Si se trasladan solo menús o redirecciones automáticas, importe antes o junto con ellos sus páginas. Las URL del sitio origen se sustituyen por SystemURL del destino; las externas no cambian. Seleccione medios junto con páginas para mover sus imágenes.

El JSON tiene límite de 32 MiB; también rigen `upload_max_filesize` y `post_max_size`. Exportaciones grandes pueden requerir más memoria PHP. No se incluyen revisiones, variables Smarty recogidas, cuentas/secretos de WHMCS ni archivos del tema. Las tablas deben existir previamente.

Antes de importar se confirma la actualización. La base de datos cambia dentro de una transacción; los archivos sobrescritos se restauran si hay error. Las constantes se importan como conjunto completo y se usa un bloqueo de archivo durante la operación. Tras el éxito se recarga la pestaña; regenere el mapa del sitio por separado. Prueba con directorios temporales y SQLite sin base de producción: `tests/transfer.php`.

## Instrucciones

- Un archivo JSON para todas las secciones o solo las seleccionadas, hasta 32 MiB (también se aplican los límites de carga de PHP). Las páginas coincidentes se actualizan por slug y tipo de acceso; los menús, por nombre. Los demás registros se conservan. Al importar menús a otro sitio, incluya también las páginas. Se omiten las secciones seleccionadas que falten en el archivo.
- El CSS/JS se incluye con las páginas; las imágenes y otros archivos cargados, con la biblioteca multimedia. No se exportan el historial de revisiones, las variables Smarty recopiladas ni los secretos de WHMCS. Tras importar, regenere el sitemap; aplique las reglas de reescritura desde su gestor.
- Páginas y artículos (traducciones, contenido, SEO, ajustes del sitemap y bloques CSS/JS)
- Menús y ubicaciones
- Ajustes del módulo, sustituciones, head/footer y robots.txt
- Redirecciones
- Reglas de reescritura personalizadas
- Biblioteca multimedia (archivos y descripciones)
- Los registros coincidentes de las secciones elegidas se actualizarán con los datos del archivo. ¿Continuar?
