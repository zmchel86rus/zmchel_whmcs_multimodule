# Gestor de idiomas

El Gestor de idiomas permite editar los textos de WHMCS y de los módulos desde el área de administración. La función sigue en desarrollo. Puede usarla el superadministrador del módulo; PHP también necesita permisos de escritura en los directorios de idiomas correspondientes.

## Elegir una sección y un idioma

Primero active los idiomas necesarios en **Configuración del módulo → Idiomas admitidos**. Después, en **Gestor de idiomas → Secciones**, elija los idiomas del área de clientes o administración de WHMCS, de este módulo o de otro módulo detectado. La tabla muestra los idiomas existentes, desactivados y disponibles para añadir. En **Idiomas**, seleccione un archivo o añada un idioma que falte. El archivo nuevo utiliza inicialmente los textos de un idioma de referencia; todavía no es una traducción completa. La marca de «sin traducir» indica que no tiene traducciones propias.

## Editar traducciones

En **Traducciones**, **Original** muestra el texto del archivo original del idioma seleccionado, sin sus cambios. Si ese idioma aún no tiene textos propios, la columna pasa a llamarse **Referencia**. Busque por clave o texto, filtre todas las claves, las originales o las añadidas y guarde cada fila por separado. Puede añadir una clave propia dentro de una sección y después cambiarle el nombre o eliminarla. Algunos catálogos de otros módulos son de solo lectura cuando su formato no se puede guardar de forma segura.

**Exportar JSON** descarga las claves y traducciones de la sección y el idioma seleccionados. **Importar JSON** solo actualiza claves existentes. Las claves desconocidas o duplicadas se omiten y aparecen en el resultado. No modifique los identificadores de sección e idioma ni las rutas de las claves. El tamaño máximo del archivo es de 8 MiB.

## Archivos e idioma predeterminado

Puede desactivar y volver a activar un archivo de idioma; incluso desactivado sigue siendo editable. El archivo base inglés y el idioma predeterminado actual de WHMCS están protegidos. Para los idiomas de clientes y administración de WHMCS añadidos por el gestor, se guardan copias que permiten restaurarlos tras una actualización. Si en **Secciones** aparece una corrección de nombre de archivo, compruebe el nombre nuevo y pulse **Corregir**; el cambio se aplica a las secciones detectadas.

Para cambiar el idioma predeterminado, active primero el nuevo idioma en la configuración del módulo, cambie después el idioma predeterminado de WHMCS y solo entonces desactive el antiguo. Compruebe los textos tanto en administración como en el área de clientes.
