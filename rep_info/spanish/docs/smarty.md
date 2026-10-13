# Bloque Smarty y catálogo de variables

`ZM_PB_COLLECT_VARS` activa la recogida del catálogo; `ZM_PB_USE_COLLECT_VARS === true` permite usar y mostrar el bloque Smarty. Después de activar la recogida, visite las páginas necesarias y recargue el editor.

## Catálogo

Los archivos están en `resources/available_vars/<tema>__<plantilla>_smarty_vars.json`. Registran nombres, tipos, estructura anidada, ejemplos ficticios y etapas en que aparece cada variable: `ClientAreaPage:9999`, `ClientAreaHeadOutput:9999`, `ClientAreaFooterOutput:9999`. La etapa indica disponibilidad, no qué hook creó la variable. `children.[]` describe un elemento de lista. El muestreo tiene límites y marca nodos `sampled` o `truncated`; la ausencia de un campo no demuestra que nunca exista.

No se guardan valores reales. Contraseñas, tokens y datos personales se marcan también `redacted`. De colecciones y modelos solo se leen `items`/`attributes` ya cargados, sin invocar métodos, relaciones ni consultas. Otros objetos permanecen opacos. Los JSON antiguos se anonimizan en la siguiente recogida. La carpeta está protegida por `.htaccess`, pero tampoco contiene valores reales en servidores que no lo usan.

## Editor y ejecución

**Editar código** o doble clic en el bloque abre CodeMirror en GrapesJS. Arriba está el código, debajo la información de la variable; a la derecha se buscan tema, plantilla y variable. `Ctrl+Space` busca variables; `Ctrl+S`/`Cmd+S` aplica cambios; `F11` activa pantalla completa; `Escape` sale o cierra sin aplicar.

```smarty
{foreach $registered_domains as $item}
    <div class="domain">{$item.domain|escape}</div>
{foreachelse}
    <p>No hay dominios.</p>
{/foreach}
```

El código se compila y comprueba al guardar y antes de mostrar. Smarty aislado recibe una copia de variables existentes como arrays y escalares. Se permiten condiciones, `foreach`, `assign` local, `capture`, `literal`, `strip`, `break`/`continue` y modificadores limitados: `escape`, `default`, `count`, `nl2br`, `upper`, `lower`, `capitalize`, `truncate`, `replace`, `cat`, `date_format`. Se prohíben PHP, métodos, funciones arbitrarias, SQL, inclusiones de archivos, red, superglobales y `nofilter`. Los valores se escapan automáticamente; escriba el HTML deseado en la plantilla. Los datos sensibles tampoco pasan a la copia de renderizado.

Los bloques se resuelven en `ClientAreaFooterOutput:10000` y un filtro Smarty inserta el resultado en su posición original antes de enviar la respuesta. Las zonas sin autorización se eliminan antes. Si faltan datos o hay error, el bloque queda vacío y se registra el fallo en el log PHP. El catálogo no proporciona datos de otras páginas. Para comprobarlo con las dependencias del proyecto: `tests/smarty_blocks.php`.
