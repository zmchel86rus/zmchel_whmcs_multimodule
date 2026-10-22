<h4>{$lm_current_title|escape}</h4>
<div class="row lm-language-grid">
    {foreach $lm_languages as $language}
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="list-group-item{if $language.untranslated} lm-language-untranslated{/if}">
            <span class="lm-language-name"><a href="{$language.url|escape}#mod_lm_tab_lang_list_edit">
                <strong>{$language.title|escape}</strong> <small>({$language.name|escape})</small>
            </a>{if $language.state == 'disabled'} <span class="label label-default">{$lm_text->disabled|escape}</span>{/if}
            {if $language.untranslated} <span class="label label-warning">{$lm_text->untranslated|escape}</span>{/if}</span>
            <form class="lm-action-form" method="post" action="addonmodules.php">
                <input type="hidden" name="module" value="{$addonName|escape}">
                <input type="hidden" name="subpage" value="langs_manager">
                <input type="hidden" name="section" value="{$lm_section|escape}">
                <input type="hidden" name="language" value="{$language.name|escape}">
                <input type="hidden" name="action" value="{if $language.state == 'disabled'}enable_language{else}disable_language{/if}">
                <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce|escape}">
                <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce|escape}">
                <button type="submit" class="btn btn-default btn-xs">{if $language.state == 'disabled'}{$other_translates->turn_on|escape}{else}{$other_translates->turn_off|escape}{/if}</button>
            </form>
        </div>
    </div>
    {foreachelse}<div class="col-xs-12"><p class="text-muted">{$lm_text->no_languages|escape}</p></div>{/foreach}
</div>
{if $lm_missing}
<h4>{$lm_text->available|escape}</h4>
<div class="row lm-language-grid">
    {foreach $lm_missing as $language}
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="list-group-item">
            <span class="lm-language-name">{$language.title|escape} <small>({$language.name|escape})</small></span>
            <form class="lm-action-form" method="post" action="addonmodules.php">
                <input type="hidden" name="module" value="{$addonName|escape}">
                <input type="hidden" name="subpage" value="langs_manager">
                <input type="hidden" name="section" value="{$lm_section|escape}">
                <input type="hidden" name="language" value="{$language.name|escape}">
                <input type="hidden" name="action" value="add_language">
                <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce|escape}">
                <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce|escape}">
                <button type="submit" class="btn btn-default btn-xs">{$other_translates->add|escape}</button>
            </form>
        </div>
    </div>
    {/foreach}
</div>
{/if}
