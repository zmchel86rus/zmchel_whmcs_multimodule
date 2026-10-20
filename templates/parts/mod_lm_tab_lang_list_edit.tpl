{if $lm_language}
<h4>{$lm_current_title|escape}: {$lm_language|escape} <small>({$lm_total|intval})</small></h4>
{if $lm_state == 'disabled'}<p class="alert alert-info">{$lm_text->disabled_editable|escape}</p>{/if}
{if $lm_readonly}<p class="alert alert-warning">This module returns a PHP catalog instead of using a language variable. Its loader needs an override adapter before edits can be saved.</p>{/if}
<p class="text-muted">{$lm_text->reference|escape}: {$lm_reference|escape}. {$lm_text->save_one|escape}</p>
<form id="lm-search-form" class="form-inline" method="get" action="addonmodules.php#mod_lm_tab_lang_list_edit" style="margin-bottom:15px">
    <input type="hidden" name="module" value="{$addonName|escape}">
    <input type="hidden" name="subpage" value="langs_manager">
    <input type="hidden" name="section" value="{$lm_section|escape}">
    <input type="hidden" name="language" value="{$lm_language|escape}">
    <label for="lm-search">{$lm_text->key|escape} / {$lm_text->translation|escape}</label>
    <input id="lm-search" class="form-control" type="search" name="q" value="{$lm_search|escape}" maxlength="200">
    <button class="btn btn-default" type="submit" aria-label="{$lm_text->key|escape} / {$lm_text->translation|escape}">&#128269;</button>
    {if $lm_search !== ''}<a class="btn btn-default" href="{$lm_edit_url|escape}#mod_lm_tab_lang_list_edit">{$other_translates->reset|escape}</a>{/if}
</form>
<div class="table-responsive">
<table class="table table-striped table-bordered">
    <thead><tr><th style="width:28%">{$lm_text->key|escape}</th><th style="width:30%">{$lm_text->reference_value|escape}</th><th>{$lm_text->translation|escape}</th></tr></thead>
    <tbody>
    {foreach $lm_rows as $row}
    <tr>
        <td><code style="white-space:normal;word-break:break-all">{$row.label|escape}</code></td>
        <td style="white-space:pre-wrap;word-break:break-word">{$row.source|escape}</td>
        <td>
            <form class="lm-action-form" method="post" action="addonmodules.php">
                <input type="hidden" name="module" value="{$addonName|escape}">
                <input type="hidden" name="subpage" value="langs_manager">
                <input type="hidden" name="section" value="{$lm_section|escape}">
                <input type="hidden" name="language" value="{$lm_language|escape}">
                <input type="hidden" name="action" value="save_translation">
                <input type="hidden" name="key_path" value="{$row.id|escape}">
                <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce|escape}">
                <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce|escape}">
                <textarea class="form-control" name="value" rows="2" maxlength="65535">{$row.value|escape}</textarea>
                {if !$lm_readonly}<button class="btn btn-primary btn-xs" type="submit" style="margin-top:5px">{$other_translates->save|escape}</button>{/if}
                <span class="lm-row-status" role="status"></span>
            </form>
        </td>
    </tr>
    {foreachelse}
    <tr><td colspan="3" class="text-muted">&mdash;</td></tr>
    {/foreach}
    </tbody>
</table>
</div>
{if $lm_pages > 1}
<nav aria-label="Translation pages">
    {if $lm_page > 1}<a class="btn btn-default" href="{$lm_current_url|escape}&amp;page={$lm_page-1}#mod_lm_tab_lang_list_edit">&larr;</a>{/if}
    <span>{$lm_page|intval} / {$lm_pages|intval}</span>
    {if $lm_page < $lm_pages}<a class="btn btn-default" href="{$lm_current_url|escape}&amp;page={$lm_page+1}#mod_lm_tab_lang_list_edit">&rarr;</a>{/if}
</nav>
{/if}
{if !$lm_readonly}<hr>
<h4>{$lm_text->new_translation|escape}</h4>
<form class="lm-action-form form-inline" method="post" action="addonmodules.php">
    <input type="hidden" name="module" value="{$addonName|escape}">
    <input type="hidden" name="subpage" value="langs_manager">
    <input type="hidden" name="section" value="{$lm_section|escape}">
    <input type="hidden" name="language" value="{$lm_language|escape}">
    <input type="hidden" name="action" value="add_translation">
    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce|escape}">
    <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce|escape}">
    <div class="form-group"><label>{$lm_text->inside|escape}
        <select class="form-control" name="parent_path">
            {foreach $lm_parents as $parent}<option value="{$parent.id|escape}">{$parent.label|escape}</option>{/foreach}
        </select></label></div>
    <div class="form-group"><label>{$lm_text->key|escape} <input class="form-control" name="new_key" required maxlength="200" placeholder="newKey"></label></div>
    <div class="form-group"><label>{$lm_text->translation|escape} <input class="form-control" name="value" required maxlength="65535"></label></div>
    <button type="submit" class="btn btn-success">{$other_translates->add|escape}</button>
</form>
{/if}
{else}<p class="text-muted">{$lm_text->select_language|escape}</p>{/if}
