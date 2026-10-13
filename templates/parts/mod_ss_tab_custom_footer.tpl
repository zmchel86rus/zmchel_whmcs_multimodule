                <form method="POST" action="addonmodules.php" class="pd-0 mar-t-3">
                    <input type="hidden" name="module" value="{$addonName}">
                    <input type="hidden" name="subpage" value="{$subpage}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                    <input type="hidden" name="action" value="edit_module_custom_footer">

                    <div class="form-group">
                        <label for="custom_footer_enable" class="d-flex gap-1 ai-center w-fit">
                        {$other_translates->turn_on}/{$other_translates->turn_off}
                        <input 
                            class="mar-0" 
                            type="checkbox" 
                            id="custom_footer_enable" 
                            name="custom_footer_enable"{if $editable_consts_footer['value'] && $editable_consts_footer['value'] === true } checked{/if}>
                        </label>
                        <span class="description">{$module_settings_translates->sitemap->enable->description|escape:'html'}</span>
                    </div>

                    <div class="form-group">
                        <label for="custom_footer_input" class="d-flex gap-1 ai-center w-fit">{$module_settings_translates->custom_footer->title}</label>
                        <textarea id="custom_footer_input" name="custom_footer_input" class="block-editor" placeholder="...">{$custom_footer_content}</textarea>
                        <span class="description">{$module_settings_translates->custom_footer->description|escape:'html'}</span>
                    </div>
                    <div class="form-group-btn mar-t-6 sticky">
                        <button type="submit" class="btn btn-success mar-r-1">{$other_translates->update}</button>
                    </div>
                </form>