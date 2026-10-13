                <form method="POST" action="addonmodules.php" class="pd-0 mar-t-3">
                    <input type="hidden" name="module" value="{$addonName}">
                    <input type="hidden" name="subpage" value="{$subpage}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                    <input type="hidden" name="action" value="edit_module_vars">
                    
                    {foreach from=$editable_consts_main key=con_name item=con_data}
                    <div class="form-group mar-b-3">
                    {if $con_data['type'] == 'bool' }
                        <label for="editable_vars[{$con_name}]" class="d-flex gap-1 ai-center w-fit">
                        {$other_translates->turn_on}/{$other_translates->turn_off} - {$module_settings_translates->editable_consts->translate[$con_name]->title}
                        <input class="mar-0" type="checkbox" id="editable_vars[{$con_name}]" name="editable_vars[{$con_name}]"{if $con_data['value'] && $con_data['value'] === true } checked{/if}>
                        </label>
                    {elseif $con_data['type'] == 'int' || $con_data['type'] == 'float' }
                        <label for="editable_vars[{$con_name}]">{$module_settings_translates->editable_consts->translate[$con_name]->title}:</label>
                        <input 
                            {if $con_data['type'] == 'int'}
                            type="number"
                            {elseif $con_data['type'] == 'float' } type="number" step="0.1"
                            {elseif $con_data['type'] == 'string' } 
                            type="text"
                            {/if}
                            class="form-control" 
                            id="editable_vars[{$con_name}]"
                            name="editable_vars[{$con_name}]" 
                            value="{$con_data['value']|default:''|escape:'html'}">
                    {elseif $con_data['type'] == 'string'} 
                        <label class="d-block" for="editable_vars[{$con_name}]">{$module_settings_translates->editable_consts->translate[$con_name]->title}:</label>
                        {if $con_name == 'site_favicon'}
                        <div class="image-wrapper">
                            <input 
                                type="url"
                                class="form-control image-wrapper-input with_preview d-none" 
                                id="editable_vars[{$con_name}]"
                                name="editable_vars[{$con_name}]" 
                                data-preview="preview_site_favicon_image_main,preview_site_favicon_image_2,preview_site_favicon_image_3"
                                value="{$con_data['value']|default:''|escape:'html'}">
                            <button type="button" class="btn btn-default open-media-manager mar-t-1 mar-b-1">{$media_manager_translates->select}</button>
                            <button type="button" class="btn btn-default reset-site-favicon mar-t-1 mar-b-1" aria-controls="editable_vars[site_favicon]">{$other_translates->reset|escape:'html'}</button>
                            <div class="browser-preview d-flex gap-1">
                                <div id="preview_site_favicon_image_main" class="browser-preview__favicon_main">{if $con_data['value']}<img src="{$con_data['value']|escape}" alt="Alternative name for Favicon not supported" class="img-favicon" onerror="this.style.display='none';">{/if}</div>
                                <div class="browser-preview__chrome">
                                    <div class="browser-preview__tabs">
                                        <div class="browser-preview__tab browser-preview__tab--active">
                                            <div id="preview_site_favicon_image_2" class="browser-preview__favicon">{if $con_data['value']}<img src="{$con_data['value']|escape}" alt="Alternative name for Favicon not supported" class="img-favicon" style="max-width: 32px; max-height: 32px;" onerror="this.style.display='none';">{/if}</div>
                                            <span class="browser-preview__tab-title">{$companyName}</span>
                                            <button type="button" class="browser-preview__tab-close">
                                                <svg viewBox="0 0 12 12" width="14" height="14" fill="none" aria-hidden="true">
                                                    <path d="M6 2v8M2 6h8" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="browser-preview__tab browser-preview__tab--inactive">
                                            <div id="preview_site_favicon_image_3" class="browser-preview__favicon">{if $con_data['value']}<img src="{$con_data['value']|escape}" alt="Alternative name for Favicon not supported" class="img-favicon" style="max-width: 32px; max-height: 32px;" onerror="this.style.display='none';">{/if}</div>
                                            <span class="browser-preview__tab-title">{$companyName}</span>
                                            <button type="button" class="browser-preview__tab-close">
                                                <svg viewBox="0 0 12 12" width="14" height="14" fill="none" aria-hidden="true">
                                                <path d="M6 2v8M2 6h8" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"></path>
                                            </svg>
                                            </button>
                                        </div>
                                        <button type="button" class="browser-preview__tab-new">
                                            <svg viewBox="0 0 12 12" width="16" height="16" fill="none" aria-hidden="true">
                                                <path d="M6 2v8M2 6h8" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="browser-preview__addressbar">
                                        <svg class="browser-preview__lock" viewBox="0 0 12 12" width="11" height="11" fill="none" aria-hidden="true">
                                            <path d="M3.5 5V3.5a2.5 2.5 0 1 1 5 0V5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"></path>
                                            <rect x="2.5" y="5" width="7" height="5" rx="1" stroke="currentColor" stroke-width="1.2"></rect>
                                        </svg>
                                        <span class="browser-preview__url">{$fullhost}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {else}
                        <input 
                            type="text"
                            class="form-control" 
                            id="editable_vars[{$con_name}]"
                            name="editable_vars[{$con_name}]" 
                            value="{$con_data['value']|default:''|escape:'html'}">
                        {/if}
                    {/if}
                        <span class="description">{$module_settings_translates->editable_consts->translate[$con_name]->description|escape:'html'}</span>
                    </div>
                    <hr>
                    {/foreach}
                    <div class="form-group-btn mar-t-6 sticky">
                        <button type="submit" class="btn btn-success mar-r-1">{$other_translates->update}</button>
                    </div>
                </form>