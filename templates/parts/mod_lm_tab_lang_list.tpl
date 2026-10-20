<h4>{$lm_current_title|escape}</h4>
<div class="list-group">
    {foreach $lm_languages as $language}
    <div class="list-group-item">
        <a href="{$language.url|escape}#mod_lm_tab_lang_list_edit">
            <strong>{$language.title|escape}</strong> <small>({$language.name|escape})</small>
        </a>
        {if $language.state == 'disabled'}<span class="label label-default">{$lm_text->disabled|escape}</span>{/if}
        <form class="lm-action-form pull-right" method="post" action="addonmodules.php" style="display:inline">
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
    {foreachelse}<p class="text-muted">{$lm_text->no_languages|escape}</p>{/foreach}
</div>
{if $lm_missing}
<h4>{$lm_text->available|escape}</h4>
<div class="list-group">
    {foreach $lm_missing as $language}
    <div class="list-group-item">
        {$language.title|escape} <small>({$language.name|escape})</small>
        <form class="lm-action-form pull-right" method="post" action="addonmodules.php" style="display:inline">
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
    {/foreach}
</div>
{/if}
