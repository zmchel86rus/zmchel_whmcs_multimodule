{if $lm_language}
    <h4>{$lm_current_title|escape}: {$module_translates->supported_langs->translate->$lm_language} ({$lm_language|escape}) <small>({$lm_total|intval})</small></h4>
    {if $lm_state == 'disabled'}<p class="alert alert-info">{$lm_text->disabled_editable|escape}</p>{/if}
    {if $lm_readonly}<p class="alert alert-warning">This module returns a PHP catalog instead of using a language variable. Its loader needs an override adapter before edits can be saved.</p>{/if}
    <p class="text-muted">{$lm_text->reference|escape}: {$lm_reference|escape}. {$lm_text->save_one|escape}</p>
    <form id="lm-search-form" class="form-inline mar-b-2" method="get" action="addonmodules.php#mod_lm_tab_lang_list_edit">
        <input type="hidden" name="module" value="{$addonName|escape}">
        <input type="hidden" name="subpage" value="langs_manager">
        <input type="hidden" name="section" value="{$lm_section|escape}">
        <input type="hidden" name="language" value="{$lm_language|escape}">
        <label for="lm-search">{$lm_text->key|escape} / {$lm_text->translation|escape}</label>
        <input id="lm-search" class="form-control" type="search" name="q" value="{$lm_search|escape}" maxlength="200">
        <select id="lm-view" class="form-control" name="view" aria-label="{$lm_text->translations|escape}">
            <option value="all"{if $lm_view == 'all'} selected{/if}>{$lm_text->show_all|escape}</option>
            <option value="original"{if $lm_view == 'original'} selected{/if}>{$lm_text->show_original|escape}</option>
            <option value="added"{if $lm_view == 'added'} selected{/if}>{$lm_text->show_added|escape}</option>
        </select>
        <button class="btn btn-sm btn-primary" type="submit" aria-label="{$lm_text->key|escape} / {$lm_text->translation|escape}">{$other_translates->search|escape}</button>
        {if $lm_search !== ''}<a class="btn btn-sm btn-default" href="{$lm_reset_url|escape}#mod_lm_tab_lang_list_edit">{$other_translates->reset|escape}</a>{/if}
    </form>
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead><tr><th style="width:28%">{$lm_text->key|escape}</th><th style="width:30%">{$lm_text->reference_value|escape}</th><th>{$lm_text->translation|escape}</th></tr></thead>
        <tbody>
        {foreach $lm_rows as $row}
        <tr>
            <td class="lang_translates key"><code>{$row.label|escape}</code>
                {if $row.managed_custom && !$lm_readonly}
                <form class="lm-action-form mar-t-1" method="post" action="addonmodules.php">
                    <input type="hidden" name="module" value="{$addonName|escape}">
                    <input type="hidden" name="subpage" value="langs_manager">
                    <input type="hidden" name="section" value="{$lm_section|escape}">
                    <input type="hidden" name="language" value="{$lm_language|escape}">
                    <input type="hidden" name="action" value="rename_translation">
                    <input type="hidden" name="key_path" value="{$row.id|escape}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce|escape}">
                    <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce|escape}">
                    <input class="form-control input-sm" name="new_key" value="{$row.key|escape}" required maxlength="200" aria-label="{$lm_text->key|escape}">
                    <button class="btn btn-default btn-xs mar-t-1" type="submit">{$other_translates->edit|escape}</button>
                </form>
                {/if}
            </td>
            <td class="lang_translates source">{$row.source|escape}</td>
            <td>
                <form class="lm-action-form d-in" method="post" action="addonmodules.php">
                    <input type="hidden" name="module" value="{$addonName|escape}">
                    <input type="hidden" name="subpage" value="langs_manager">
                    <input type="hidden" name="section" value="{$lm_section|escape}">
                    <input type="hidden" name="language" value="{$lm_language|escape}">
                    <input type="hidden" name="action" value="save_translation">
                    <input type="hidden" name="key_path" value="{$row.id|escape}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce|escape}">
                    <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce|escape}">
                    <textarea class="form-control" name="value" rows="2" maxlength="65535">{$row.value|escape}</textarea>
                    {if !$lm_readonly}<button class="btn btn-primary btn-xs mar-t-1" type="submit">{$other_translates->save|escape}</button>{/if}
                </form>
                {if $row.managed_custom && !$lm_readonly}
                <form class="lm-action-form d-in" method="post" action="addonmodules.php">
                    <input type="hidden" name="module" value="{$addonName|escape}">
                    <input type="hidden" name="subpage" value="langs_manager">
                    <input type="hidden" name="section" value="{$lm_section|escape}">
                    <input type="hidden" name="language" value="{$lm_language|escape}">
                    <input type="hidden" name="action" value="delete_translation">
                    <input type="hidden" name="key_path" value="{$row.id|escape}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce|escape}">
                    <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce|escape}">
                    <button class="btn btn-danger btn-xs mar-t-1" type="submit">{$other_translates->delete|escape}</button>
                </form>
                {/if}
                <span class="lm-row-status" role="status"></span>
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
    <form class="lm-action-form d-flex flex-dir-col" method="post" action="addonmodules.php">
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
        <button type="submit" class="btn d-block w-fit btn-success">{$other_translates->add|escape}</button>
    </form>
    {/if}
{else}<p class="text-muted">{$lm_text->select_language|escape}</p>{/if}
