# Gestor de páginas

## Crear y publicar una página

1. Abra **Lista de páginas → Añadir página**. Escriba un nombre interno y un slug con letras latinas, números y guiones, por ejemplo `about-us`. No incluya dominio, prefijo de idioma, `?` ni `.php`.
2. Seleccione el acceso: **Mixto** para todos con zonas opcionales de invitados y usuarios, **Autorizados** para quienes han iniciado sesión o **No autorizados** para invitados.
3. Elija **Borrador** durante la preparación, **Publicado** para mostrarla, **Aplazado** para mantenerla fuera del sitio o **Papelera**. Aplazado no equivale a publicación programada. Elija el tipo **Página**, **Artículo** o **Página del sistema**; este último no se publica como página normal ni aparece en el mapa del sitio.
4. Marque los idiomas disponibles; el predeterminado ya está incluido. Guarde y vuelva a abrir el registro. Rellene **Contenido**, **Metadatos** y, para páginas publicadas no sistémicas, **Mapa del sitio** por idioma. Cada sección tiene su botón **Guardar** y al final está **Guardar todo**. Compruebe el mensaje de éxito y los avisos de cambios sin guardar.

La lista permite buscar y filtrar por acceso, tipo, estado e idioma. **Visitar** abre la URL pública. **Eliminar** envía primero la página a la papelera; desde allí se elimina definitivamente.

## Buscar, visitar y eliminar

Filtre la lista por nombre, acceso, tipo, estado o idioma. **Visitar** abre la URL pública. **Eliminar** mueve primero la página a la papelera; la eliminación definitiva se hace allí. Si la página no se abre, compruebe su publicación, el idioma activo y el tipo de acceso.

## Sustituir una página WHMCS

Cree y publique primero la página del editor. En **Lista de páginas → Sustitución de páginas**, pulse **Añadir sustitución**, elija la página WHMCS y la página creada, seleccione el tipo y guarde. **Completa** sustituye contenido y metadatos; **Antes** o **Después** añade bloques al contenido original; **Solo metadatos** cambia SEO; las opciones combinadas añaden bloques y cambian metadatos. Una misma página del sistema no puede asignarse dos veces.

Pruebe la **URL pública WHMCS**, como invitado y como cliente conectado. Si difieren, el slug interno redirige a la dirección pública. Para restringir solo partes de la página, use acceso Mixto con zonas para invitados y usuarios.
