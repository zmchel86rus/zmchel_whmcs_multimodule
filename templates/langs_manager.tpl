{include file="./menus.tpl"}
<div id="zm-pagebuilder" class="panel panel-default langs-manager">
    <div class="panel-heading"><h3 class="panel-title">{$module_translates->langs_manager->title|escape}</h3></div>
    <div class="panel-body">
        {if $alertHtml}{$alertHtml}{/if}
        {if !$lm_access_denied}
        <div id="lm-message" class="alert" role="status" aria-live="polite" hidden></div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#mod_lm_tab_lists" data-toggle="tab">{$lm_text->sections|escape}</a></li>
            <li role="presentation"><a href="#mod_lm_tab_lang_list" data-toggle="tab">{$lm_text->languages|escape}</a></li>
            <li role="presentation"><a href="#mod_lm_tab_lang_list_edit" data-toggle="tab">{$lm_text->translations|escape}</a></li>
        </ul>
        <div class="tab-content" style="padding-top:20px">
            <div role="tabpanel" class="tab-pane active" id="mod_lm_tab_lists">
                {include file="./parts/mod_lm_tab_lists.tpl"}
            </div>
            <div role="tabpanel" class="tab-pane" id="mod_lm_tab_lang_list">
                {include file="./parts/mod_lm_tab_lang_list.tpl"}
            </div>
            <div role="tabpanel" class="tab-pane" id="mod_lm_tab_lang_list_edit">
                {include file="./parts/mod_lm_tab_lang_list_edit.tpl"}
            </div>
        </div>
        {/if}
    </div>
</div>
{$page_assets|default:'' nofilter}
