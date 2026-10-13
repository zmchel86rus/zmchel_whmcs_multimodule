                    <form id="form_main" method="POST" action="addonmodules.php" data-form-order="1">
                        <input type="hidden" name="module" value="{$addonName}">
                        <input type="hidden" name="subpage" value="{$subpage}">
                        <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                        <input type="hidden" name="action" value="edit_page_main">
                        <input type="hidden" name="page_id" value="{$page_data->main->id}">

                        <div class="form-group">
                            <label for="edit_main[name]"><span style="color:red">*</span>{$pages_editor_translates->page_name->title}:</label>
                            <input type="text" class="form-control page-name-field" id="edit_main[name]" name="edit_main[name]" value="{$page_data->main->name|escape}" required>
                            <span class="description">{$pages_editor_translates->page_name->description|escape:'html'}</span>
                        </div>

                        <div class="form-group">
                            <label for="edit_main[slug]"><span style="color:red">*</span>{$pages_editor_translates->page_slug->title}:</label>
                            <input type="text" class="form-control page-slug-field" id="edit_main[slug]" name="edit_main[slug]" value="{$page_data->main->slug|escape}" required {if isset($override_main_page)}readonly{/if}>
                        </div>

                        <div class="form-group">
                            <label for="edit_main[auth_type]">{$pages_editor_translates->page_auth_type->title}:</label>
                            <select class="form-control" id="edit_main[auth_type]" name="edit_main[auth_type]">
                            {foreach from=$pages_editor_translates->page_auth_type->translate key=status item=translated_status}
                                <option value="{$status}" {if $status === $page_data->main->auth_type}selected{/if}>{$translated_status}</option>
                            {/foreach}
                            </select>
                            <span class="description">{$pages_editor_translates->page_auth_type->description|escape:'html'}</span>
                        </div>

                        <div class="form-group">
                            <label for="edit_main[status]">{$pages_editor_translates->page_status->title}:</label>
                            <select class="form-control" id="edit_main[status]" name="edit_main[status]">
                                {foreach from=$pages_editor_translates->page_status->translate key=status item=translated_status}
                                <option value="{$status}" {if $status === $page_data->main->status}selected{/if}>{$translated_status}</option>
                                {/foreach}
                            </select>
                            <span class="description">{$pages_editor_translates->page_status->description|escape:'html'}</span>
                        </div>

                        <div class="form-group">
                            <label for="edit_main[type]">{$pages_editor_translates->page_type->title}:</label>
                            <select class="form-control" id="edit_main[type]" name="edit_main[type]">
                            {foreach from=$pages_editor_translates->page_type->translate key=status item=translated_status}
                                <option value="{$status}" {if $status === $page_data->main->type}selected{/if}>{$translated_status}</option>
                            {/foreach}
                            </select>
                            <span class="description">{$pages_editor_translates->page_type->description|escape:'html'}</span>
                        </div>

                        <div>
                            <label>{$module_translates->supported_langs->title}:</label>
                            <div class="form-group">
                                {foreach from=$module_langs key=lang_name item=lang_data}
                                <label for="edit_main[langs][{$lang_name}]" class="lang-checkbox-label">
                                    {$lang_data['name']} ({$module_translates->supported_langs->translate->$lang_name}) 
                                    <input class="d-none" type="checkbox" id="edit_main[langs][{$lang_name}]" name="edit_main[langs][{$lang_name}]" {if in_array($lang_name,$page_data->main->langs ) }checked{/if}{if $lang_name === $main_default_lang} disabled{/if}>
                                </label>
                                {/foreach}
                            </div>
                            <span class="description d-block">{$pages_editor_translates->page_langs->default_language}: {$module_langs[$main_default_lang]['name']} ({$module_translates->supported_langs->translate->$main_default_lang})</span>
                            <span class="description d-block">{$pages_editor_translates->page_langs->description|escape:'html'}</span>
                        </div>

                        <div class="form-group-btn sticky">
                            <button type="submit" class="btn btn-success mr-8px">{$other_translates->save}</button>
                            <button type="reset" class="btn btn-danger">{$other_translates->cancel}</button>
                        </div>
                    </form>