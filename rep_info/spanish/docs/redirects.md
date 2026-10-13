# Redirecciones e idiomas del mapa del sitio

El **Gestor de redirecciones** guarda origen → destino con estado HTTP 301, 302, 303, 307 o 308. Las reglas pueden editarse, desactivarse y eliminarse; se muestran 50 por página.

El origen acepta rutas desde `/` o URL absolutas del mismo sitio. El destino acepta rutas o URL HTTP(S). Las barras finales se consideran equivalentes al comparar, pero el destino conserva la suya. Una regla con parámetros tiene prioridad sobre la regla de ruta; la regla de ruta también coincide con solicitudes que llevan parámetros. Los parámetros del destino sustituyen a los del origen.

Las reglas se aplican a GET/HEAD que llegan a WHMCS antes del constructor de páginas. No modifican `.htaccess`, sesión de idioma ni perfil. Las redirecciones del servidor y las reglas de idioma/canonical del módulo funcionan por separado. `ZM_PB_ENABLE_REDIRECTS_MANAGER` activa las reglas guardadas. `ZM_PB_AUTO_REDIRECTS` y `ZM_PB_AUTO_REDIRECT_DAYS` controlan las automáticas; el plazo predeterminado es 14 días y 0 elimina la espera.

Al cambiar el slug de una página que permanece publicada se crea una regla 301. La antigüedad se calcula antes de guardar con la marca más reciente de página o traducción activa. Publicar un borrador no crea redirección. Cada idioma disponible obtiene su regla. Los cambios posteriores actualizan destinos históricos y volver a un slug antiguo elimina una redirección a sí mismo. Las reglas manuales tienen preferencia.

Con sustituciones de páginas activas, el alias del diseño redirige a su página nativa incluso si las reglas guardadas están desactivadas. Si un diseño sustituye varias páginas, el alias apunta a la primera configurada; el mapa lista cada página nativa por separado. Cambiar el slug del diseño actualiza `page_overrides.to` en la misma transacción.

Se usa `zm_pb_redirects`. Las solicitudes no crean ni reparan tablas: hágalo en **Base de datos del módulo**. Las columnas URL admiten 128 bytes y se rechazan valores más largos. `sitemap_pages.xml` y `sitemap_posts.xml` incluyen alternancias recíprocas por idioma y `x-default` para la URL principal sin prefijo. Solo aparecen traducciones activas; los orígenes de redirecciones se excluyen de `loc` y alternancias. Regeneración: **Mapa del sitio** o cron. Pruebas aisladas con SQLite temporal: `tests/redirects.php` y `tests/sitemap.php`, con opciones como `--plain`, `--routes-off` y `--disabled`.
