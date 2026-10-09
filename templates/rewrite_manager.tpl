{include file="./menus.tpl"}

<div id="zm-pagebuilder" class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{$module_translates->rewrite_manager->title}</h3>
    </div>
    <div class="panel-body">
        {if $alertHtml}{$alertHtml}{/if}
        {if isset($rewrite_webserver)}
            <div id="zm-pb-rewrite-server-alert" {if $rewrite_webserver == 'apache'}hidden{/if}
                 data-backend="{$rewrite_webserver|escape}"
                 data-nginx="{$rewrite_server_messages.nginx|escape}"
                 data-proxy="{$rewrite_server_messages.proxy|escape}"
                 data-unknown="{$rewrite_server_messages.unknown|escape}">
                {$rewrite_server_alert}
            </div>
        {/if}
        {if isset($rewrite_status)}
            <p>{$rewrite_manager_translates->description}</p>
            <p><code>{$rewrite_status.path|escape}</code></p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead><tr>
                        <th>{$rewrite_manager_translates->language}</th>
                        <th>URL</th>
                        <th>{$rewrite_manager_translates->rule}</th>
                        <th>{$rewrite_manager_translates->status}</th>
                        <th>{$rewrite_manager_translates->action}</th>
                    </tr></thead>
                    <tbody>
                    {foreach $rewrite_status.rules as $rule}
                        <tr>
                            <td>{$rule.language|escape}</td>
                            <td>{foreach $rule.paths as $path}<code style="display:block">{$path|escape}</code>{/foreach}</td>
                            <td>{foreach $rule.directives as $directive}<code style="display:block">{$directive|escape}</code>{/foreach}</td>
                            <td>{if $rule.installed}<span class="label label-success">{$rewrite_manager_translates->present}</span>{else}<span class="label label-default">{$rewrite_manager_translates->missing}</span>{/if}</td>
                            <td>
                                {if isset($rule.custom_id)}
                                    <form method="POST" action="addonmodules.php">
                                        <input type="hidden" name="module" value="{$addonName|escape}">
                                        <input type="hidden" name="subpage" value="rewrite_manager">
                                        <input type="hidden" name="action" value="delete_rule">
                                        <input type="hidden" name="rule_id" value="{$rule.custom_id|escape}">
                                        <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                                        <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                                        <button type="submit" class="btn btn-danger btn-sm">{$rewrite_manager_translates->delete}</button>
                                    </form>
                                {/if}
                            </td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
            <a class="btn btn-default" href="addonmodules.php?module={$addonName|escape:'url'}&amp;subpage=rewrite_manager">{$rewrite_manager_translates->check}</a>
            <form id="rewrite_rules_form" method="POST" action="addonmodules.php" style="display:inline-block">
                <input type="hidden" name="module" value="{$addonName|escape}">
                <input type="hidden" name="subpage" value="rewrite_manager">
                <input type="hidden" name="action" value="install_rules">
                <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                <button type="submit" class="btn btn-primary">{$rewrite_manager_translates->install}</button>
            </form>

            <h4>{$rewrite_manager_translates->add_custom}</h4>
            <form id="rewrite_custom_rule_form" method="POST" action="addonmodules.php">
                <input type="hidden" name="module" value="{$addonName|escape}">
                <input type="hidden" name="subpage" value="rewrite_manager">
                <input type="hidden" name="action" value="add_rule">
                <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                <div class="row">
                    <div class="col-sm-4 form-group">
                        <label for="rewrite_rule_pattern">{$rewrite_manager_translates->pattern}</label>
                        <input id="rewrite_rule_pattern" class="form-control" name="rule_pattern" placeholder="^my-page/?$" required>
                    </div>
                    <div class="col-sm-5 form-group">
                        <label for="rewrite_rule_target">{$rewrite_manager_translates->target}</label>
                        <input id="rewrite_rule_target" class="form-control" name="rule_target" placeholder="index.php?rp=/my-page" required>
                    </div>
                    <div class="col-sm-3 form-group">
                        <label for="rewrite_rule_flags">{$rewrite_manager_translates->flags}</label>
                        <input id="rewrite_rule_flags" class="form-control" name="rule_flags" value="QSA,L" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">{$rewrite_manager_translates->add_custom}</button>
                <p id="zm-pb-rewrite-form-message" class="help-block" role="alert" data-error="{$other_translates->error|escape}" hidden></p>
                <p class="help-block">{$rewrite_manager_translates->apply_hint}</p>
            </form>
        {/if}
    </div>
</div>
