{include file="./menus.tpl"}

<div class="row" style="margin-top: 12px;">
    <div class="col-sm-12">
        <div id="zm-pagebuilder" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{$addonName} DB</h3>
            </div>
            <div class="panel-body">
                <p><strong>Super Admin only.</strong> Select tables/columns and run <code>FIX</code> or <code>DELETE</code>.</p>

                {if $alertHtml}{$alertHtml}{/if}

                <form id="module_db_action_form" method="POST" action="addonmodules.php">
                    <input type="hidden" name="module" value="{$addonName}">
                    <input type="hidden" name="subpage" value="{$subpage}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                    <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce}">
                    <input type="hidden" name="action" value="module_db_action">
                    <div style="margin-bottom: 10px;">
                        <button type="submit" name="db_action" value="fix" class="btn btn-success">{$other_translates->fix} {$other_translates->selected_items|lower}</button>
                        <button type="submit" name="db_action" value="delete" class="btn btn-danger" onclick="return confirm('{$other_translates->you_sure} {$other_translates->action_is_irreversible}');">{$other_translates->delete} {$other_translates->selected_items|lower}</button>
                    </div>

                    <h4>Required Tables</h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:40px;"></th>
                                <th>Table</th>
                                <th style="width:140px;">Status</th>
                                <th style="width:120px;">Rows</th>
                                <th style="width:160px;">Missing Columns</th>
                                <th style="width:120px;">Columns</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$tableStatusRows item=row name=tables}
                                <tr>
                                    <td><input type="checkbox" name="selected_items[]" value="{$row.item_key}"></td>
                                    <td><code>{$row.table}</code></td>
                                    <td>
                                        {if $row.exists}
                                            <span class="label label-success">OK</span>
                                        {else}
                                            <span class="label label-danger">MISSING</span>
                                        {/if}
                                    </td>
                                    <td>{if $row.row_count !== null}{$row.row_count}{else}-{/if}</td>
                                    <td>
                                        {if $row.columns_total > 0}
                                            {$row.columns_missing} / {$row.columns_total}
                                        {else}
                                            -
                                        {/if}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-default" data-toggle="collapse" data-target="#cols_{$smarty.foreach.tables.index}">
                                            Show
                                        </button>
                                    </td>
                                </tr>
                                <tr id="cols_{$smarty.foreach.tables.index}" class="collapse">
                                    <td></td>
                                    <td colspan="5">
                                        <table class="table table-condensed table-bordered" style="margin: 8px 0;">
                                            <thead>
                                                <tr>
                                                    <th style="width:40px;"></th>
                                                    <th>Column</th>
                                                    <th style="width:140px;">Status</th>
                                                    <th style="width:180px;">Fix Support</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {foreach from=$row.columns item=col}
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="selected_items[]" value="{$col.item_key}">
                                                        </td>
                                                        <td><code>{$col.column}</code></td>
                                                        <td>
                                                            {if $col.exists}
                                                                <span class="label label-success">OK</span>
                                                            {else}
                                                                <span class="label label-danger">MISSING</span>
                                                            {/if}
                                                        </td>
                                                        <td>
                                                            {if $col.can_fix}
                                                                <span class="label label-info">FIX available</span>
                                                            {else}
                                                                <span class="label label-default">No recipe</span>
                                                            {/if}
                                                        </td>
                                                    </tr>
                                                {/foreach}
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
