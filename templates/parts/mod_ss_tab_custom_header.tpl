                <form method="POST" action="addonmodules.php" class="pd-0 mar-t-3">
                    <input type="hidden" name="module" value="{$addonName}">
                    <input type="hidden" name="subpage" value="{$subpage}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                    <input type="hidden" name="action" value="edit_module_custom_header">

                    <div class="form-group">
                        <label for="custom_header_enable" class="d-flex gap-1 ai-center w-fit">
                        {$other_translates->turn_on}/{$other_translates->turn_off}
                        <input 
                            class="mar-0" 
                            type="checkbox" 
                            id="custom_header_enable" 
                            name="custom_header_enable"{if $editable_consts_header['value'] && $editable_consts_header['value'] === true } checked{/if}>
                        </label>
                        <span class="description">{$module_settings_translates->sitemap->enable->description|escape:'html'}</span>
                    </div>

                    <div class="form-group">
                        <label for="custom_header_input" class="d-flex gap-1 ai-center w-fit">{$module_settings_translates->custom_header->title}</label>
                        <textarea id="custom_header_input" name="custom_header_input" class="block-editor">{$custom_header_content}</textarea>
                        <span class="description">{$module_settings_translates->custom_header->description|escape:'html'}</span>
                    </div>
                    <div class="form-group-btn mar-t-6 sticky">
                        <button type="submit" class="btn btn-success mar-r-1">{$other_translates->update}</button>
                    </div>
                </form>