# Multimódulo gratuito para WHMCS

**Antes de utilizar el módulo, genere valores salt únicos e introdúzcalos en `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` y `ZM_PB_NONCE_SALT`.** El módulo se desarrolló y probó con **WHMCS 8.13.1** y ofrece **compatibilidad completa con Apache (100 %)**. También puede funcionar con Nginx, aunque el enrutamiento por idioma de la página de inicio puede necesitar configuración y pruebas adicionales.

**ZMChel WHMCS Multimodule es gratuito.** Permite gestionar el contenido del sitio desde la administración de WHMCS: editor visual de páginas y bloques, contenido multilingüe, menús, biblioteca multimedia, metadatos SEO, mapas del sitio XML, redirecciones, reglas rewrite e importación/exportación. Consulte las [instrucciones](instruction.md) para usarlo.

## Desarrollo futuro

- Añadir páginas anidadas y categorías o secciones de páginas.
- Dividir el monolito actual en componentes que interactúen entre sí.
- Crear un gestor de permisos de acceso al módulo en la administración.
- Ampliar los idiomas predeterminados en `supported_langs.php`.
- Incorporar un editor de código para crear, editar y eliminar archivos `.tpl` del módulo y editar archivos de temas de cliente del CMS (excepto el tema de administración).
- Crear un gestor de idiomas para editar archivos de este módulo, de otros módulos y del propio CMS.
- Mejorar el gestor multimedia.
- Crear un gestor SEO completo y más optimizado, inspirado en Yoast SEO para WordPress.
- Añadir varios idiomas al generador de mapas del sitio y crear una página HTML del mapa.
- Añadir estadísticas de uso al gestor de páginas.

Son **planes de futuro, no una hoja de ruta estricta**.

## Proponer una idea

[Envíe un correo](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) con el asunto «Предложение по мультимодулю».
