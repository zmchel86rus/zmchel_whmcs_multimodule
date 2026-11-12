[![Seguidores](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=Seguidores)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Estrellas](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Estrellas)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Bifurcaciones](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Bifurcaciones)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Incidencias](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=Incidencias)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Instrucciones de ZMChel WHMCS Multimodule

**ZMChel WHMCS Multimodule es gratuito.** Permite gestionar el contenido del sitio desde la administración de WHMCS: editor visual de páginas y bloques, contenido multilingüe, menús, biblioteca multimedia, metadatos SEO, mapas del sitio XML, redirecciones, reglas rewrite e importación/exportación.

## Antes del primer uso

**Antes del primer uso, abre Configuración del módulo → Idiomas compatibles y activa los idiomas que necesites.**

En cada activación, el módulo genera automáticamente nuevos valores salt y los escribe en `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Compruebe que los tres valores salt estén definidos.

## Compatibilidad y funcionamiento comprobados

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Compatibilidad con servidores web

Apache tiene compatibilidad completa. Nginx también puede funcionar, pero el enrutamiento por idioma de la página de inicio puede requerir configuración y pruebas adicionales.

## Ajustes del módulo

Elige los idiomas que puede usar el módulo. Desactivar un idioma no elimina su contenido.

- **Ajustes del módulo → Idiomas compatibles → Activar**
- **Base de datos del módulo → Corregir Elementos seleccionados**
- **Reglas de reescritura → Comprobar reglas → Añadir o actualizar reglas**

Nginx no lee .htaccess, por lo que estas reglas no funcionan allí. Configure reglas equivalentes en nginx.

## Gestor de páginas

- **Añadir página → Nombre de la página → Slug de la página → Guardar**
- **Editor de páginas → Ajustes de contenido → Ajustes de metadatos → Ajustes del sitemap de la página → Guardar todo**
- **Gestor de páginas → Visitar**
- **Sitemap → Generar sitemaps**

Solo se permiten letras latinas, guiones y cifras.

Usuarios autenticados: solo pueden acceder quienes iniciaron sesión; Invitados: solo pueden acceder los invitados; Mixto: todos pueden acceder y cada bloque controla su propia visibilidad.

La generación automática se ejecuta tras el cron de WHMCS cuando corresponde actualizar. La generación manual comienza de inmediato.

## Guías por sección

- [Gestor de páginas](docs/pages_manager.md)
- [Editor de páginas](docs/pages_editor.md)
- [Gestor multimedia](docs/media_manager.md)
- [Menús](docs/menu_manager.md)
- [Gestor de idiomas](docs/langs_manager.md)
- [Redirecciones](docs/redirects_manager.md)
- [Mapas del sitio](docs/sitemap_manager.md)
- [Reglas de reescritura](docs/rewrite_manager.md)
- [Ajustes del módulo](docs/module_settings.md)
- [Base de datos del módulo](docs/module_db.md)

## Material adicional

- [Paginación y filtros](docs/pages_editor_pagination.md)
- [Smarty y variables recopiladas](docs/pages_editor_smarty.md)
- [Datos estructurados Schema.org](docs/module_structured_data.md)
- [Importación y exportación](docs/module_settings_transfer.md)
