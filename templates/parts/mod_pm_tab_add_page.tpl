                    <form id="create_page_form" method="POST" action="addonmodules.php">
                        <input type="hidden" name="module" value="{$addonName}">
                        <input type="hidden" name="subpage" value="{$subpage}">
                        <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                        <input type="hidden" name="action" value="create_page">

                        <div class="form-group">
                            <label for="name"><span style="color:red">*</span>{$pages_manager_translates->page_name->title}:</label>
                            <input type="text" class="form-control page-name-field" id="name" name="name" placeholder="{$pages_manager_translates->page_name->title}" required>
                            <span class="description">{$pages_manager_translates->page_name->description|escape:'html'}</label>
                        </div>

                        <div class="form-group">
                            <label for="slug"><span style="color:red">*</span>{$pages_manager_translates->page_slug->title}:</label>
                            <input type="text" class="form-control page-slug-field" id="slug" name="slug" placeholder="{$pages_manager_translates->page_slug->example}" required>
                            <span class="description">{$pages_manager_translates->page_slug->description|escape:'html'}</span>
                        </div>
                        
                        <div class="form-group">
                            <label for="auth_type">{$pages_manager_translates->page_auth_type->title}:</label>
                            <select class="form-control" id="auth_type" name="auth_type">
                            {foreach from=$pages_manager_translates->page_auth_type->translate key=status item=translated_status}
                                <option value="{$status}">{$translated_status}</option>
                            {/foreach}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">{$pages_manager_translates->page_type->title}:</label>
                            <select class="form-control" id="type" name="type">
                            {foreach from=$pages_manager_translates->page_type->translate key=status item=translated_status}
                                <option value="{$status}">{$translated_status}</option>
                            {/foreach}
                            </select>
                            <span class="description">{$pages_manager_translates->page_type->description|escape:'html'}</span>
                        </div>

                        <div>
                            <label>{$pages_manager_translates->page_langs->title}:</label>
                            <div class="form-group">
                            {foreach from=$module_langs key=lang_name item=lang_data}
                                {if $lang_name !== $main_default_lang}
                                <label for="langs[{$lang_name}]">
                                    {$lang_data['name']} ({$module_translates->supported_langs->translate->$lang_name}) 
                                    <input type="checkbox" id="langs[{$lang_name}]" name="langs[{$lang_name}]" style="display:none">
                                </label>
                                {/if}
                            {/foreach}
                            </div>
                            <span class="description d-block">{$pages_manager_translates->page_langs->default_language}: {$module_langs[$main_default_lang]['name']} ({$module_translates->supported_langs->translate->$main_default_lang})</span>
                            <span class="description d-block">{$pages_manager_translates->page_langs->description|escape:'html'}</span>
                        </div>
                        
                        <div class="form-group-btn mar-t-6 sticky">            
                            <button type="submit" class="btn btn-success mar-r-1">{$other_translates->save}</button>
                            <button type="reset" class="btn btn-danger">{$other_translates->cancel}</button>
                        </div>
                    </form>