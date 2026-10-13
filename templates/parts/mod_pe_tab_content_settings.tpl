                {if isset($page_data->main->langs) && is_array($page_data->main->langs)}
                    <ul class="nav nav-tabs sticky lang-tabs" role="tablist">
                        {foreach from=$page_data->main->langs item=lang_name name=lang_data}
                            <li role="presentation" {if $smarty.foreach.lang_data.first}class="active"{/if}>
                                <a href="#tab_{$lang_name}" aria-controls="tab_{$lang_name}" role="tab" data-toggle="tab" lang-data="{$module_langs[$lang_name]|@json_encode|escape:'html'}">
                                    {$module_translates->supported_langs->translate->$lang_name}
                                    {*<span class="remove-lang-btn" data-lang="{$lang_name}" title="Remove language">&times;</span>*}
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                    {/if}
                    <div class="tab-content mar-t-3">
                        {if isset($page_data) && isset($page_data->main->langs) && is_array($page_data->main->langs)}
                            {foreach from=$page_data->main->langs item=lang_name name=lang_data}
                            <div role="tabpanel" class="tab-pane {if $smarty.foreach.lang_data.first}active{/if}" id="tab_{$lang_name}">
                                {assign var="canonical_link" value=$page_data->settings[$lang_name]->settings['meta_canonical']}
                               
                                <h3>{$pages_editor_translates->page_headers->content} - "{$module_translates->supported_langs->translate->$lang_name}"</h3>
                                <form id="form_content_{$lang_name}" method="POST" action="addonmodules.php?module={$addonName}&subpage={$subpage}" data-form-order="2">
                                    <input type="hidden" name="module" value="{$addonName}">
                                    <input type="hidden" name="subpage" value="{$subpage}">
                                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                                    <input type="hidden" name="action" value="edit_page_content">
                                    <input type="hidden" name="page_id" value="{$page_data->main->id}">

                                    <div class="form-group">
                                        <label for="edit_content[{$lang_name}][content]">{$pages_editor_translates->page_headers->sub_content}:</label>
                                        <div class="block-editor-container" id="block_editor_{$lang_name}">
                                            <div class="zm-pb-grapes-toolbar">
                                                <button type="button" class="btn btn-default btn-sm zm-pb-grapes-transfer" data-mode="copy-content">{$grapes_translates.copy_content_to|escape:'html'}</button>
                                                <button type="button" class="btn btn-default btn-sm zm-pb-grapes-transfer" data-mode="copy-structure">{$grapes_translates.copy_structure_to|escape:'html'}</button>
                                                <button type="button" class="btn btn-default btn-sm zm-pb-grapes-transfer" data-mode="clone">{$grapes_translates.clone_to|escape:'html'}</button>
                                                <select class="form-control zm-pb-clone-target" aria-label="{$grapes_translates.target_language|escape:'html'}">
                                                    {foreach from=$page_data->main->langs item=sub_lang_name}
                                                        {if $sub_lang_name != $lang_name}
                                                            <option value="{$sub_lang_name|escape:'html'}">{$module_translates->supported_langs->translate->$sub_lang_name|escape:'html'}</option>
                                                        {/if}
                                                    {/foreach}
                                                </select>
                                                <button type="button" class="btn btn-default btn-sm zm-pb-grapes-action" data-action="image" style="display:none">{$grapes_translates.choose_image|escape:'html'}</button>
                                                <button type="button" class="btn btn-default btn-sm zm-pb-grapes-action" data-action="slide" style="display:none">{$grapes_translates.add_slide|escape:'html'}</button>
                                            </div>
                                            <div class="block-editor-content" id="block_content_{$lang_name}" data-lang="{$lang_name}">
                                                {$grapes_translates.empty|escape:'html'}
                                            </div>
                                        </div>
                                        <textarea class="editor_content_{$lang_name} d-none" name="edit_content[{$lang_name}][content]" id="edit_content[{$lang_name}][content]">{if isset($page_data->settings[$lang_name]->content)}{$page_data->settings[$lang_name]->content|escape:'html'}{/if}</textarea>
                                    </div>

                                    <div class="form-group-btn sticky">
                                        <button type="submit" class="btn btn-success mar-r-1">{$other_translates->save}</button>
                                        <button type="reset" class="btn btn-danger mar-r-1">{$other_translates->cancel}</button>
                                        <a class="btn btn-primary" href="{if isset($canonical_link) && ! empty($canonical_link) }{$canonical_link|escape:'html'}{else}{$main_host_url}{$module_langs[$lang_name]['code']|lower}/{$page_data->main->slug|escape}{/if}" target="_blank">{$other_translates->goto}</a>
                                    </div>
                                </form>
                            </div>
                            {/foreach}
                        {else}
                            <div class="alert alert-warning">{$pages_editor_translates->no_page_data->title}</div>
                        {/if}
                    </div>