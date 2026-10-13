# Datos estructurados de la salida

| Salida | Marcado Schema.org |
| --- | --- |
| Menús de navegación, barras laterales y pie | `SiteNavigationElement` con nombres, idioma y URL reales tras comprobar acceso y sustituciones; grupos mediante `hasPart`. |
| Tabla de contenidos | `SiteNavigationElement` y `WebPageElement` con anclas de títulos encontrados de verdad. |
| Preguntas y respuestas | `FAQPage` para preguntas y respuestas visibles y no vacías. Se excluyen bloques ocultos y acordeones normales; `details` cerrado cuenta si puede abrirse. |
| Migas de pan | `BreadcrumbList` con dos o más elementos. Una sola miga sigue visible sin marcado; no se duplica JSON-LD. |
| Organización y contacto | Datos de WHMCS. El idioma de página corresponde a `WebPage`/`ContactPage`; idiomas de atención a `ContactPoint.availableLanguage` en BCP47. |
| Filtros, campos, selector de cantidad, paginación y formulario | No crean una entidad aparte: son controles, no productos, artículos ni datos de contacto de la organización. |
| Diseño, Smarty y HTML propio | No se infiere un tipo de contenido por su apariencia ni se reescribe el marcado del autor. |

`SiteNavigationElement` describe navegación, pero no garantiza enlaces adicionales en resultados de búsqueda. Google dejó de mostrar resultados enriquecidos de FAQ en mayo de 2026; un `FAQPage` válido sigue describiendo contenido real. Los filtros locales no reciben `SearchAction`. No se inventa `inLanguage` en plantillas `Organization`, `Person`, `Product` o `Service` cuando no corresponde.

Fuentes: [políticas de Google](https://developers.google.com/search/docs/appearance/structured-data/sd-policies), [SiteNavigationElement](https://schema.org/SiteNavigationElement), [inLanguage](https://schema.org/inLanguage), [migas de pan](https://developers.google.com/search/docs/appearance/structured-data/breadcrumb). Pruebas locales con PHP DOM: `tests/schema_output.php`, `tests/contact_schema.php`, `tests/table_of_contents.php`, `tests/footer_menu.php`.
