# Smarty block and variable catalog

`ZM_PB_COLLECT_VARS` collects the catalog. `ZM_PB_USE_COLLECT_VARS === true` enables the Smarty block and its output. After enabling collection, visit the relevant site pages and reload the page editor.

## Catalog

Files are stored under `resources/available_vars/<theme>__<template>_smarty_vars.json`. The catalog records names, types, nested structure, synthetic examples and observation stages such as `ClientAreaPage:9999`, `ClientAreaHeadOutput:9999` and `ClientAreaFooterOutput:9999`. A stage shows when a variable was available, not which hook created it. Types and structure accumulate across visits; `children.[]` describes a list item. Sampling depth and size are limited, with `sampled` or `truncated` markers. A missing field in the catalog does not prove it is absent from every request.

Real values are never stored. Password, token and personal-data fields are also marked `redacted`. For collections and models, only already-loaded `items` or `attributes` are read; getters, relations and queries are not invoked. Other objects remain opaque. Old JSON dumps are anonymized on the next collection. Revisit pages to refresh suggestions from older catalogs. The directory has `.htaccess` protection, but catalog values are absent even on servers without `.htaccess` support.

## Editor

Click **Edit code** in the block toolbar or double-click a Smarty block to open CodeMirror in GrapesJS. Code appears above the selected variable details; theme/template selection and search are on the right. Insert a collection as a `foreach` skeleton or a scalar as an expression.

- `Ctrl+Space`: search variables.
- `Ctrl+S` / `Cmd+S`: apply code to the block.
- `F11`: full screen.
- `Escape`: exit full screen or close without applying.

Example for an already-loaded collection:

```smarty
{foreach $registered_domains as $item}
    <div class="domain">{$item.domain|escape}</div>
{foreachelse}
    <p>No domains.</p>
{/foreach}
```

## Execution and limits

Code is compiled and validated on save and before output. Isolated Smarty receives a snapshot of defined variables as arrays and scalars. Model and collection methods are unavailable; use `foreach`, array fields and `count`. Supported constructs include conditions, `foreach`, local `assign`, `capture`, `literal`, `strip`, `break`/`continue` and a restricted modifier set: `escape`, `default`, `count`, `nl2br`, `upper`, `lower`, `capitalize`, `truncate`, `replace`, `cat`, `date_format`.

PHP, static access, object methods, arbitrary functions, SQL and WHMCS plugins, file includes, network resources, global `assign`, superglobals and `nofilter` are forbidden. Output values are escaped automatically; write intended HTML markup in the template. Sensitive fields are excluded from the rendering snapshot too.

Blocks resolve in `ClientAreaFooterOutput:10000`. A [Smarty output filter](https://www.smarty.net/docs/en/api.register.filter.tpl) places each result back at its original HTML position before the HTTP response. Separately loaded templates use variables already defined in their context. Authorization-restricted zones are removed before Smarty blocks are queued. Missing data or template errors leave the block empty, suppress its internal marker and write the error to PHP error log.

The catalog is a guide, not a data source: it cannot make a variable from another page available here. A full page override may lack variables created only by the native controller. For a check with WHMCS dependencies, run `php modules/addons/zmchel_whmcs_multimodule/tests/smarty_blocks.php`; it uses Smarty, Collection and Eloquent without a database connection.
