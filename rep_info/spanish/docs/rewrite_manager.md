# Reglas de reescritura

## WHMCS

Reglas para URL de idiomas, incluidas páginas bajo /ru/, /en/ y otros prefijos. Los idiomas proceden de supported_langs.php; las reglas se insertan en .htaccess antes de las de WHMCS.

Nginx no lee .htaccess, por lo que estas reglas no funcionan allí. Configure reglas equivalentes en nginx.

Se detectó nginx → Apache. Estas reglas solo funcionan para solicitudes enviadas a Apache; nginx no lee .htaccess.

Tras añadir o eliminar una regla, pulse «Añadir o actualizar reglas» para aplicar los cambios en .htaccess.

## Mapa del sitio, redirecciones y rewrite

Active la generación de mapas y configure la frecuencia en **Ajustes del módulo**. En **Mapa del sitio**, revise la última ejecución y las URL previstas, pulse **Generar mapas del sitio** y abra `sitemap_index.xml` y sus archivos. La generación automática depende del cron de WHMCS. El índice puede incluir otros mapas en la raíz del sitio. Las sustituciones usan URL públicas y los idiomas no publicados no deben aparecer. Más información: [mapas del sitio](sitemap_manager.md).

En **Gestor de redirecciones**, indique origen `/old-page/` y destino `/new-page/`, seleccione `301` si el cambio es permanente o `302` si es temporal, active, guarde y pruebe la URL antigua. La creación automática tras cambiar un slug tiene interruptor y antigüedad mínima propios. Más información: [redirecciones](redirects_manager.md).

En **Gestor rewrite**, pulse **Comprobar reglas** y después **Añadir o actualizar reglas** para escribir `.htaccess`. En reglas personalizadas, indique patrón de URL, destino y flags, y vuelva a aplicar. Apache usa `.htaccess`; Nginx requiere reglas equivalentes del servidor. Una regla errónea puede afectar a todo el sitio.

## Instrucciones

- Comprobar reglas
- Añadir o actualizar reglas
- Eliminar todas las reglas de .htaccess
- Patrón de URL
- Destino
- Indicadores
