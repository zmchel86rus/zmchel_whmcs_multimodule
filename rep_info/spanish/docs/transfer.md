# Importación y exportación

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
