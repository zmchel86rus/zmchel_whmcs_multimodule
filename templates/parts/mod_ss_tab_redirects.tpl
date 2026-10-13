                <form method="POST" action="addonmodules.php" class="mar-t-3">
                    <input type="hidden" name="module" value="{$addonName|escape}">
                    <input type="hidden" name="subpage" value="module_settings">
                    <input type="hidden" name="action" value="edit_module_vars">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                    <div class="checkbox"><label>
                        <input type="checkbox" name="editable_vars[enable_redirects_manager]"{if $editable_consts_redirects['enable_redirects_manager']['value']} checked{/if}>
                        {$redirects_text->enabled|escape}
                    </label></div>
                    <div class="checkbox"><label>
                        <input type="checkbox" name="editable_vars[auto_redirects]"{if $editable_consts_redirects['auto_redirects']['value']} checked{/if}>
                        {$redirects_text->auto_enabled|escape}
                    </label></div>
                    <div class="form-group">
                        <label for="redirect_days">{$redirects_text->days|escape}</label>
                        <input id="redirect_days" class="form-control" type="number" name="editable_vars[auto_redirect_days]" value="{$editable_consts_redirects['auto_redirect_days']['value']|intval}" min="0" max="365" step="1" required>
                        <p class="help-block">{$redirects_text->age_help|escape}</p>
                    </div>
                    <button type="submit" class="btn btn-success">{$other_translates->update}</button>
                </form>