{include file="./menus.tpl"}
<div id="zm-pagebuilder" class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">{$redirects_text->title|escape}</h3></div>
    <div class="panel-body">
        {if $alertHtml}{$alertHtml}{/if}
        {if $redirects_ready}
        <p>{$redirects_text->description|escape}</p>
        <p class="text-muted">{$redirects_text->override_help|escape}</p>
        {if !$redirects_enabled}<p class="alert alert-warning">{$redirects_text->disabled|escape}</p>{/if}
        <a href="addonmodules.php?module={$addonName|escape:'url'}&amp;subpage=module_settings#tab_redirects_settings">{$redirects_text->settings|escape}</a>
        <h4>{if $redirect_edit}{$redirects_text->edit}{else}{$redirects_text->add}{/if}</h4>
        <form id="redirect_rule_form" method="POST" action="addonmodules.php">
            <input type="hidden" name="module" value="{$addonName|escape}">
            <input type="hidden" name="subpage" value="redirects_manager">
            <input type="hidden" name="action" value="save_redirect">
            <input type="hidden" name="id" value="{$redirect_edit->id|default:0|intval}">
            <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
            <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
            <div class="row">
                <div class="col-sm-5 form-group">
                    <label for="redirect_from">{$redirects_text->from|escape}</label>
                    <input id="redirect_from" class="form-control" name="from" value="{$redirect_edit->from|default:''|escape}" placeholder="/old-page/" maxlength="128" required>
                </div>
                <div class="col-sm-5 form-group">
                    <label for="redirect_to">{$redirects_text->to|escape}</label>
                    <input id="redirect_to" class="form-control" name="to" value="{$redirect_edit->to|default:''|escape}" placeholder="/new-page/" maxlength="128" required>
                </div>
                <div class="col-sm-2 form-group">
                    <label for="redirect_status">{$redirects_text->status|escape}</label>
                    <select id="redirect_status" class="form-control" name="status_code">
                        {foreach [301,302,303,307,308] as $code}
                        <option value="{$code}"{if ($redirect_edit->status_code|default:301) == $code} selected{/if}>{$code}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="checkbox"><label><input type="checkbox" name="active" value="1"{if !$redirect_edit || $redirect_edit->active} checked{/if}> {$redirects_text->active|escape}</label></div>
            <button type="submit" class="btn btn-primary">{$redirects_text->save|escape}</button>
            {if $redirect_edit}<a class="btn btn-default" href="addonmodules.php?module={$addonName|escape:'url'}&amp;subpage=redirects_manager">{$redirects_text->cancel|escape}</a>{/if}
        </form>
        <hr>
        <div class="table-responsive"><table class="table table-striped table-bordered">
            <thead><tr><th>{$redirects_text->from|escape}</th><th>{$redirects_text->to|escape}</th><th>{$redirects_text->status|escape}</th><th>{$redirects_text->origin|escape}</th><th></th></tr></thead>
            <tbody>
            {foreach $redirect_rules as $rule}
                <tr>
                    <td><code>{$rule->from|escape}</code></td><td><code>{$rule->to|escape}</code></td>
                    <td>{$rule->status_code|intval}<br>{if $rule->active}{$redirects_text->active}{else}{$redirects_text->inactive}{/if}</td>
                    <td>{if $rule->type == 'system'}{$redirects_text->automatic}{else}{$redirects_text->manual}{/if}</td>
                    <td>
                        <a class="btn btn-default btn-sm" href="addonmodules.php?module={$addonName|escape:'url'}&amp;subpage=redirects_manager&amp;id={$rule->id|intval}&amp;page={$redirect_page}">{$redirects_text->edit|escape}</a>
                        <form method="POST" action="addonmodules.php" style="display:inline-block">
                            <input type="hidden" name="module" value="{$addonName|escape}">
                            <input type="hidden" name="subpage" value="redirects_manager">
                            <input type="hidden" name="action" value="delete_redirect">
                            <input type="hidden" name="id" value="{$rule->id|intval}">
                            <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                            <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                            <button type="submit" class="btn btn-danger btn-sm">{$redirects_text->delete|escape}</button>
                        </form>
                    </td>
                </tr>
            {foreachelse}<tr><td colspan="5">{$redirects_text->empty|escape}</td></tr>{/foreach}
            </tbody>
        </table></div>
        {if $redirect_page > 1}<a class="btn btn-default" href="addonmodules.php?module={$addonName|escape:'url'}&amp;subpage=redirects_manager&amp;page={$redirect_page-1}">{$redirects_text->previous|escape}</a>{/if}
        <span>{$redirect_page} / {$redirect_last_page}</span>
        {if $redirect_page < $redirect_last_page}<a class="btn btn-default" href="addonmodules.php?module={$addonName|escape:'url'}&amp;subpage=redirects_manager&amp;page={$redirect_page+1}">{$redirects_text->next|escape}</a>{/if}
        {/if}
    </div>
</div>
