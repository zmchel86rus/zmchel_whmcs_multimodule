<p class="text-muted">{$module_settings_translates->languages->description|escape}</p>
<p class="text-muted">{$module_settings_translates->language_rewrite_note|escape}</p>
{foreach $module_language_groups as $group}
<h4>{$group.title|escape} <small>({$group.count|intval})</small></h4>
{if $module_languages_can_edit}
<form method="post" action="addonmodules.php" data-module-language-form>
    <input type="hidden" name="module" value="{$addonName|escape}">
    <input type="hidden" name="subpage" value="module_settings">
    <input type="hidden" name="action" value="toggle_module_language">
    <input type="hidden" name="language_operation" value="{$group.operation|escape}">
    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce|escape}">
    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce|escape}">
{/if}
<div class="row module-language-grid">
    {foreach $group.rows as $language}
    <div class="col-sm-6 col-lg-4">
        <div class="well well-sm module-language-item">
            {if $module_languages_can_edit && (!$language.default || $group.state == 'disabled')}
                <label class="module-language-choice">
                    <input type="checkbox" name="languages[]" value="{$language.key|escape}">
                    <span>{$language.title|escape} <small>({$language.key|escape})</small></span>
                </label>
            {else}
                <span>{$language.title|escape} <small>({$language.key|escape})</small></span>
            {/if}
            {if $language.default}
                <span class="label label-info">{$module_settings_translates->languages->default_language|escape}</span>
            {/if}
        </div>
    </div>
    {foreachelse}<div class="col-xs-12"><p class="text-muted">&mdash;</p></div>{/foreach}
</div>
{if $module_languages_can_edit && $group.rows}
    <button class="btn btn-sm {if $group.state == 'enabled'}btn-default{else}btn-success{/if}" type="submit" disabled>{if $group.state == 'enabled'}{$other_translates->turn_off|escape}{else}{$other_translates->turn_on|escape}{/if} {$other_translates->selected|escape}</button>
{/if}
{if $module_languages_can_edit}</form>{/if}
{/foreach}
