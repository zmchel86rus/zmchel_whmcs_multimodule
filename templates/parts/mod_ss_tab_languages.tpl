<p class="text-muted">{$module_settings_translates->languages->description|escape}</p>
<p class="text-muted">{$module_settings_translates->language_rewrite_note|escape}</p>
{foreach $module_language_groups as $group}
<h4>{$group.title|escape} <small>({$group.count|intval})</small></h4>
<div class="row module-language-grid">
    {foreach $group.rows as $language}
    <div class="col-sm-6 col-lg-4">
        <div class="well well-sm module-language-item">
            <span>{$language.title|escape} <small>({$language.key|escape})</small></span>
            {if $language.default}
                <span class="label label-info">{$module_settings_translates->languages->default_language|escape}</span>
            {/if}
            {if $module_languages_can_edit && (!$language.default || $group.state == 'disabled')}
                <form method="post" action="addonmodules.php">
                    <input type="hidden" name="module" value="{$addonName|escape}">
                    <input type="hidden" name="subpage" value="module_settings">
                    <input type="hidden" name="action" value="toggle_module_language">
                    <input type="hidden" name="language" value="{$language.key|escape}">
                    <input type="hidden" name="language_operation" value="{$group.operation|escape}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce|escape}">
                    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce|escape}">
                    <button class="btn btn-xs {if $group.state == 'enabled'}btn-default{else}btn-success{/if}" type="submit">{if $group.state == 'enabled'}{$other_translates->turn_off|escape}{else}{$other_translates->turn_on|escape}{/if}</button>
                </form>
            {/if}
        </div>
    </div>
    {foreachelse}<div class="col-xs-12"><p class="text-muted">&mdash;</p></div>{/foreach}
</div>
{/foreach}
