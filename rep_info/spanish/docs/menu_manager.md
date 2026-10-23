# Gestor de menús

`menu_manager` permite crear varios menús independientes. Se pueden buscar y añadir páginas o artículos, crear enlaces propios y encabezados con URL `#`, arrastrar elementos, anidarlos y cambiar su orden. Cada elemento admite título visible y traducciones, atributo `title`, descripción, clases CSS, `rel`, icono, pestaña nueva y visibilidad para visitantes o clientes. También se pueden añadir automáticamente páginas recién publicadas. Un menú puede complementar o sustituir la navegación de WHMCS en escritorio, móvil o ambos.

Al eliminar un elemento padre, sus hijos suben al nivel que ocupaba. El árbol admite hasta 10 niveles y 300 elementos. Los cambios de menú y estructura se guardan en una sola transacción.

## Ubicaciones y ajustes

| Ubicación WHMCS | Ajuste |
| --- | --- |
| `ClientAreaPrimaryNavbar` | `ZM_PB_ENABLE_MAINNAV` |
| `ClientAreaSecondaryNavbar` | `ZM_PB_ENABLE_SECONDARYNAV` |
| `ClientAreaPrimarySidebar` | `ZM_PB_ENABLE_MAINSIDEBAR` |
| `ClientAreaSecondarySidebar` | `ZM_PB_ENABLE_SECONDARYSIDEBAR` |

Los ajustes están en la configuración del módulo. Si una ubicación está desactivada, su controlador no se carga ni consulta la base de datos. Sin asignación activa, la navegación original de WHMCS sigue igual. Cada ubicación tiene un menú; un mismo menú puede ocupar varias. Una nueva asignación desplaza la anterior.

Escritorio comienza a 768 px y móvil termina a 767 px. Si se sustituye la navegación solo en un tamaño, el otro conserva la de WHMCS. Los temas estándar muestran un nivel de submenú; los recursos del módulo añaden niveles más profundos en la barra. La barra lateral usa listas desplegables. El enlace padre sigue siendo accesible y dispone de otro botón para desplegar.

## Idiomas, URL y acceso

En rutas del sistema fuera de `ZM_PB_MAINSYSTEM_DEFAULT_PAGES`, como `clientarea.php`, los textos siguen el idioma guardado del usuario. La ausencia de prefijo en la URL no cambia su idioma ni su perfil o sesión. En páginas del módulo y páginas sustituibles se usa el idioma de la URL.

Para un enlace personalizado, **Idioma de la URL** permite conservar una dirección como `/clientarea.php` sin modificarla, aunque el texto siga traducido. La opción se guarda en `zm_pb_menu_items.localize_url` y se incluye en la exportación. En instalaciones anteriores hay que añadir la columna desde **Base de datos del módulo**.

Las URL de páginas se recalculan al mostrar el menú según slug, URL amigables, rutas de idioma y traducciones publicadas. El idioma principal no lleva prefijo. Las URL simples usan `?m=zmchel_whmcs_multimodule&slug=...&lang=...` sin cambiar el idioma del perfil. Si falta una traducción se usa la publicada del idioma principal. Un texto vacío toma el breadcrumb o título meta traducido y después el nombre de página. URL externas, `mailto:`, `tel:`, anclas y recursos del sistema no reciben prefijo.

No se muestran borradores, páginas eliminadas ni páginas sin acceso para el visitante. Ocultar un padre oculta su rama. El servidor rechaza esquemas de URL peligrosos y HTML en los textos.

## Tablas

`zm_pb_menus` guarda la configuración, `zm_pb_menu_items` los elementos y `zm_pb_menu_locations` las ubicaciones. El esquema está en `inc/menu_schema.php`; creación, reparación y eliminación se hacen en **Base de datos del módulo**, no en el gestor de menús. Al desactivar el módulo las tablas solo se eliminan con `db_action` activado. Salida: `lib/menu.php`; funciones auxiliares: `inc/menu_manager.php`; hooks: `hooks/menu.php`. Pruebas con WHMCS y PDO SQLite: `tests/menu.php` y `tests/menu.php --plain`.

## Instrucciones

- Crear menú
- Añada páginas, artículos o enlaces personalizados.
- Arrastre los elementos para cambiar su orden. Use el selector de elemento principal o los botones para cambiar la jerarquía.
- Usar el idioma de la página actual
- Usar la URL indicada sin cambios
- Etiquetas en otros idiomas
- Visible para
- Dispositivos
- Cada ubicación admite un menú. Al elegirla, se traslada aquí la asignación de otro menú.
- Los elementos de nivel superior serán columnas y los anidados, enlaces. Use URL # para un título sin enlace.
- Aún no se han creado las tablas de menús. Añádalas en «Base de datos del módulo».
