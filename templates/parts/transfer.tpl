<p>{$transfer_text->help|escape}</p>
<p class="text-muted">{$transfer_text->details|escape}</p>
<div class="row">
    {foreach ['export_module', 'import_module'] as $transfer_action}
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">{if $transfer_action == 'export_module'}{$transfer_text->export}{else}{$transfer_text->import}{/if}</div>
            <div class="panel-body">
                <form method="POST" action="addonmodules.php" enctype="multipart/form-data"{if $transfer_action == 'import_module'} data-confirm="{$transfer_text->confirm|escape}"{/if}>
                    <input type="hidden" name="module" value="{$addonName|escape}">
                    <input type="hidden" name="subpage" value="module_settings">
                    <input type="hidden" name="action" value="{$transfer_action}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                    <div class="checkbox"><label><input type="checkbox" data-transfer-all checked> <strong>{$transfer_text->all|escape}</strong></label></div>
                    {foreach $transfer_text->sections as $key => $label}
                    <div class="checkbox"><label><input type="checkbox" name="transfer_sections[]" value="{$key|escape}" checked> {$label|escape}</label></div>
                    {/foreach}
                    {if $transfer_action == 'import_module'}
                    <div class="form-group">
                        <label for="pb_transfer_file">{$transfer_text->file|escape}</label>
                        <input id="pb_transfer_file" type="file" name="transfer_file" accept=".json,application/json" required>
                    </div>
                    {/if}
                    <button type="submit" class="btn btn-primary">{if $transfer_action == 'export_module'}{$transfer_text->export}{else}{$transfer_text->import}{/if}</button>
                </form>
            </div>
        </div>
    </div>
    {/foreach}
</div>
