{include file="./menus.tpl"}

<style>
.zm-pb-doc { max-width: 1100px; line-height: 1.65; overflow-wrap: anywhere; }
.zm-pb-doc h1, .zm-pb-doc h2, .zm-pb-doc h3, .zm-pb-doc h4 { margin-top: 1.4em; scroll-margin-top: 20px; }
.zm-pb-doc h1 { margin-top: 0; }
.zm-pb-doc pre { overflow-x: auto; padding: 14px; background: #f5f7fa; border: 1px solid #dce2e8; border-radius: 4px; }
.zm-pb-doc code { overflow-wrap: normal; }
.zm-pb-doc table { display: block; max-width: 100%; overflow-x: auto; border-collapse: collapse; margin: 16px 0; }
.zm-pb-doc th, .zm-pb-doc td { border: 1px solid #dce2e8; padding: 8px 12px; vertical-align: top; }
.zm-pb-doc th { background: #f5f7fa; }
</style>

<div class="panel panel-default">
    <div class="panel-body">
        {if $readme_additional_doc}
            <p><a href="addonmodules.php?module={$addonName|escape:'url'}&amp;subpage=README.md">&larr; {$module_translates->instruction|escape:'html'}</a></p>
        {/if}
        {if $alertHtml}{$alertHtml nofilter}{/if}
        {if $readme_html}<article class="zm-pb-doc">{$readme_html nofilter}</article>{/if}
    </div>
</div>
