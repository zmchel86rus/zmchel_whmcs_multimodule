                <form method="POST" action="addonmodules.php" class="pd-0 mar-t-3">
                    <input type="hidden" name="module" value="{$addonName}">
                    <input type="hidden" name="subpage" value="{$subpage}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                    <input type="hidden" name="action" value="edit_module_vars">

                    <div class="form-group">
                        <label for="editable_vars[enable_sitemap]" class="d-flex gap-1 ai-center w-fit">
                        {$other_translates->turn_on}/{$other_translates->turn_off} - {$module_settings_translates->sitemap->enable->title}
                        <input 
                            class="mar-0" 
                            type="checkbox" 
                            id="editable_vars[enable_sitemap]" 
                            name="editable_vars[enable_sitemap]"{if $editable_consts_sitemap['enable_sitemap']['value'] && $editable_consts_sitemap['enable_sitemap']['value'] === true } checked{/if}>
                        </label>
                        <span class="description">{$module_settings_translates->sitemap->enable->description|escape:'html'}</span>
                    </div>
                    <div class="form-group">
                        <label for="editable_vars[sitemap_updfreq]">{$module_settings_translates->sitemap->updatefreq->title}:</label>
                        <select class="form-control" id="editable_vars[sitemap_updfreq]" name="editable_vars[sitemap_updfreq]">
                            <option value="" {if empty($editable_consts_sitemap['sitemap_updfreq']['value'])}selected{/if}>-- {$other_translates->select} --</option>
                            {foreach from=$module_settings_translates->sitemap->translate key=updfreq item=translated}
                            <option value="{$updfreq|lower}" {if $updfreq === $editable_consts_sitemap['sitemap_updfreq']['value']|lower }selected{/if}>{$translated}</option>
                            {/foreach}
                        </select>
                        <span class="description">{$module_settings_translates->sitemap->updatefreq->description|escape:'html'}</span>
                    </div>
                    {*
                    <div class="form-group">
                        <label for="editable_vars[sitemap_html]" class="d-flex gap-1 ai-center w-fit">
                        {$other_translates->turn_on}/{$other_translates->turn_off} - {$module_settings_translates->sitemap->enable->title}
                        <input 
                            class="mar-0" 
                            type="checkbox" 
                            id="editable_vars[sitemap_html]" 
                            name="editable_vars[sitemap_html]"{if $editable_consts_sitemap['sitemap_html']['value'] && $editable_consts_sitemap['sitemap_html']['value'] === true } checked{/if}>
                        </label>
                        <span class="description">{$module_settings_translates->sitemap->htmlsitemap->description|escape:'html'}</span>
                    </div>
                    *}
                    <div class="form-group-btn mar-t-6 sticky">
                        <button type="submit" class="btn btn-success mar-r-1">{$other_translates->update}</button>
                    </div>
                </form>