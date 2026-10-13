                {if isset($page_data->main->langs) && is_array($page_data->main->langs)}
                    <ul class="nav nav-tabs sticky lang-tabs" role="tablist">
                        {foreach from=$page_data->main->langs item=lang_name name=lang_data}
                            <li role="presentation" {if $smarty.foreach.lang_data.first}class="active"{/if}>
                                <a href="#tab_meta_{$lang_name}" aria-controls="tab_{$lang_name}" role="tab" data-toggle="tab" lang-data="{$module_langs[$lang_name]|@json_encode|escape:'html'}">
                                    {$module_translates->supported_langs->translate->$lang_name}
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                    {/if}
                    <div class="tab-content mar-t-3">
                        {if isset($page_data) && isset($page_data->main->langs) && is_array($page_data->main->langs)}
                            {foreach from=$page_data->main->langs item=lang_name name=lang_data}
                            <div role="tabpanel" class="tab-pane {if $smarty.foreach.lang_data.first}active{/if}" id="tab_meta_{$lang_name}">
                                <h3>{$pages_editor_translates->page_headers->meta} - "{$module_translates->supported_langs->translate->$lang_name}" </h3>
                                <form id="form_meta_{$lang_name}" method="POST" action="addonmodules.php?module={$addonName}&subpage={$subpage}" data-form-order="3">
                                    <input type="hidden" name="module" value="{$addonName}">
                                    <input type="hidden" name="subpage" value="{$subpage}">
                                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                                    <input type="hidden" name="action" value="edit_page_meta">
                                    <input type="hidden" name="page_id" value="{$page_data->main->id}">
                                    {assign var="seo_settings" value=$page_data->settings[$lang_name]->settings}

                                    <div class="input-form-group">
                                        <div class="form-group">
                                            <label for="edit_meta[{$lang_name}][enable_breadcrumb]" class="d-flex gap-1 ai-center w-fit">
                                                {$other_translates->turn_on}/{$other_translates->turn_off} - {$pages_editor_translates->page_breadcrumb->title}
                                                <input class="mar-0" type="checkbox" id="edit_meta[{$lang_name}][enable_breadcrumb]" name="edit_meta[{$lang_name}][enable_breadcrumb]"{if $seo_settings.enable_breadcrumb && $seo_settings.enable_breadcrumb === true || !isset($seo_settings.enable_breadcrumb) } checked{/if}>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_meta[{$lang_name}][breadcrumb]">{$pages_editor_translates->page_breadcrumb->title}:</label>
                                            <input-with-button><input type="text" class="form-control" id="edit_meta[{$lang_name}][breadcrumb]" name="edit_meta[{$lang_name}][breadcrumb]" value="{$seo_settings.breadcrumb|escape}"><i class="mini_reset_btn"></i></input-with-button>
                                            <span class="description">{$pages_editor_translates->page_breadcrumb->description|escape:'html'}</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="input-form-group">
                                        <div class="form-group">
                                            <label for="edit_meta[{$lang_name}][meta_title]"><span style="color:red">*</span>{$pages_editor_translates->page_meta_title->title}:</label>
                                            <input-with-button><input type="text" class="form-control" id="edit_meta[{$lang_name}][meta_title]" name="edit_meta[{$lang_name}][meta_title]" value="{$seo_settings.meta_title|escape}" required><i class="mini_reset_btn"></i></input-with-button>
                                            <span class="description">{$pages_editor_translates->page_meta_title->description|escape:'html'}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_meta[{$lang_name}][meta_description]"><span style="color:red">*</span>{$pages_editor_translates->page_meta_description->title}:</label>
                                            <input-with-button><input type="text" class="form-control" id="edit_meta[{$lang_name}][meta_description]" name="edit_meta[{$lang_name}][meta_description]" value="{$seo_settings.meta_description|escape}" required><i class="mini_reset_btn"></i></input-with-button>
                                            <span class="description">{$pages_editor_translates->page_meta_description->description|escape:'html'}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_meta[{$lang_name}][meta_image]">{$pages_editor_translates->page_meta_image->title}:</label>
                                            <div class="image-wrapper">
                                                <input type="url" 
                                                    class="form-control image-wrapper-input with_preview" 
                                                    id="edit_meta[{$lang_name}][meta_image]" 
                                                    name="edit_meta[{$lang_name}][meta_image]"
                                                    data-preview="preview_{$lang_name}_meta_image" 
                                                    value="{$seo_settings.meta_image|escape}">
                                                <button type="button" class="btn btn-default open-media-manager mar-t-1 mar-b-1">{$media_manager_translates->select}</button>
                                                <div id="preview_{$lang_name}_meta_image" class="file-preview">
                                                {if $seo_settings.meta_image}
                                                    <img src="{$seo_settings.meta_image|escape}" alt="Preview" class="img-thumbnail" style="max-width: 33vw; max-height: 25vh;" onerror="this.style.display='none';">
                                                {/if}
                                                </div>
                                            </div>
                                            <span class="description">{$media_manager_translates->upload_file_alerts->img_sup}</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="input-form-group">
                                        <h4>{$pages_editor_translates->page_headers->opengraph} <i class="toggle-content{if !$seo_settings.enable_og && $seo_settings.enable_og === false } collapsed{/if}"></i></h4>
                                        <div class="form-group"{if !$seo_settings.enable_og && $seo_settings.enable_og === false } style="display: none;"{/if}>
                                            <label for="edit_meta[{$lang_name}][enable_og]" class="d-flex gap-1 ai-center w-fit">
                                                {$other_translates->turn_on}/{$other_translates->turn_off} - {$pages_editor_translates->page_headers->opengraph}
                                                <input class="mar-0" type="checkbox" id="edit_meta[{$lang_name}][enable_og]" name="edit_meta[{$lang_name}][enable_og]"{if $seo_settings.enable_og && $seo_settings.enable_og === true } checked{/if}>
                                            </label>
                                        </div>
                                        <div class="form-group"{if !$seo_settings.enable_og && $seo_settings.enable_og === false } style="display: none;"{/if}>
                                            <label for="edit_meta[{$lang_name}][meta_og_title]">{$pages_editor_translates->page_meta_og_title->title}:</label>
                                            <input-with-button><input type="text" class="form-control" id="edit_meta[{$lang_name}][meta_og_title]" name="edit_meta[{$lang_name}][meta_og_title]" value="{$seo_settings.meta_og_title|escape}"><i class="mini_reset_btn"></i></input-with-button>
                                            <span class="description">{$pages_editor_translates->page_meta_og_title->description|escape:'html'}</span>
                                        </div>
                                        <div class="form-group"{if !$seo_settings.enable_og && $seo_settings.enable_og === false } style="display: none;"{/if}>
                                            <label for="edit_meta[{$lang_name}][meta_og_description]">{$pages_editor_translates->page_meta_og_description->title}:</label>
                                            <input-with-button><input type="text" class="form-control" id="edit_meta[{$lang_name}][meta_og_description]" name="edit_meta[{$lang_name}][meta_og_description]" value="{$seo_settings.meta_og_description|escape}"><i class="mini_reset_btn"></i></input-with-button>
                                            <span class="description">{$pages_editor_translates->page_meta_og_description->description|escape:'html'}</span>
                                        </div>
                                        <div class="form-group"{if !$seo_settings.enable_og && $seo_settings.enable_og === false } style="display: none;"{/if}>
                                            <label for="edit_meta[{$lang_name}][meta_og_image]">{$pages_editor_translates->page_meta_og_image->title}:</label>
                                            <div class="image-wrapper">
                                                <input type="url" 
                                                    class="form-control image-wrapper-input with_preview" 
                                                    id="edit_meta[{$lang_name}][meta_og_image]" 
                                                    name="edit_meta[{$lang_name}][meta_og_image]"
                                                    data-preview="preview_{$lang_name}_meta_og_image"
                                                    value="{$seo_settings.meta_og_image|escape}">
                                                <button type="button" class="btn btn-default open-media-manager mar-t-1 mar-b-1">{$media_manager_translates->select}</button>
                                                <div id="preview_{$lang_name}_meta_og_image" class="file-preview">
                                                {if $seo_settings.meta_og_image}
                                                    <img src="{$seo_settings.meta_og_image|escape}" alt="Preview" class="img-thumbnail" style="max-width: 33vw; max-height: 25vh;" onerror="this.style.display='none';">
                                                {/if}
                                                </div>
                                            </div>
                                            <span class="description">{$pages_editor_translates->page_meta_og_image->description|escape:'html'}</span>
                                        </div>
                                        <div class="form-group"{if !$seo_settings.enable_og && $seo_settings.enable_og === false } style="display: none;"{/if}>
                                            <label for="edit_meta[{$lang_name}][meta_og_type]">{$pages_editor_translates->page_meta_og_type->title}:</label>
                                            <select class="form-control" id="edit_meta[{$lang_name}][meta_og_type]" name="edit_meta[{$lang_name}][meta_og_type]">
                                                <option value="" {if empty($seo_settings.meta_og_type)}selected{/if}>-- {$other_translates->select} --</option>
                                                {foreach from=$pages_editor_translates->page_meta_og_type->translate key=status item=translated_status}
                                                <option value="{$status}" {if $seo_settings.meta_og_type === $status}selected{/if}>{$translated_status}</option>
                                                {/foreach}
                                            </select>
                                            <span class="description">{$pages_editor_translates->page_meta_og_type->description|escape:'html'}</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="input-form-group">
                                        <h4>{$pages_editor_translates->page_headers->twitter} <i class="toggle-content {if !$seo_settings.enable_twitter && $seo_settings.enable_twitter === false } collapsed{/if}"></i></h4>
                                        <div class="form-group"{if !$seo_settings.enable_twitter && $seo_settings.enable_twitter === false } style="display: none;"{/if}>
                                            <label for="edit_meta[{$lang_name}][enable_twitter]" class="d-flex gap-1 ai-center w-fit">
                                                {$other_translates->turn_on}/{$other_translates->turn_off} - {$pages_editor_translates->page_headers->twitter}
                                                <input class="mar-0" type="checkbox" id="edit_meta[{$lang_name}][enable_twitter]" name="edit_meta[{$lang_name}][enable_twitter]"{if $seo_settings.enable_twitter && $seo_settings.enable_twitter === true } checked{/if}>
                                            </label>
                                        </div>
                                        <div class="form-group"{if !$seo_settings.enable_twitter && $seo_settings.enable_twitter === false } style="display: none;"{/if}>
                                            <label for="edit_meta[{$lang_name}][meta_twitter_title]">{$pages_editor_translates->page_meta_twitter_title->title}:</label>
                                            <input-with-button><input type="text" class="form-control" id="edit_meta[{$lang_name}][meta_twitter_title]" name="edit_meta[{$lang_name}][meta_twitter_title]" value="{$seo_settings.meta_twitter_title|escape}"><i class="mini_reset_btn"></i></input-with-button>
                                            <span class="description">{$pages_editor_translates->page_meta_twitter_title->description|escape:'html'}</span>
                                        </div>
                                        <div class="form-group"{if !$seo_settings.enable_twitter && $seo_settings.enable_twitter === false } style="display: none;"{/if}>
                                            <label for="edit_meta[{$lang_name}][meta_twitter_description]">{$pages_editor_translates->page_meta_twitter_description->title}:</label>
                                            <input-with-button><input type="text" class="form-control" id="edit_meta[{$lang_name}][meta_twitter_description]" name="edit_meta[{$lang_name}][meta_twitter_description]" value="{$seo_settings.meta_twitter_description|escape}"><i class="mini_reset_btn"></i></input-with-button>
                                            <span class="description">{$pages_editor_translates->page_meta_twitter_description->description|escape:'html'}</span>
                                        </div>
                                        <div class="form-group"{if !$seo_settings.enable_twitter && $seo_settings.enable_twitter === false } style="display: none;"{/if}>
                                            <label for="edit_meta[{$lang_name}][meta_twitter_image]">{$pages_editor_translates->page_meta_twitter_image->title}:</label>
                                            <div class="image-wrapper">
                                                <input type="url" 
                                                    class="form-control image-wrapper-input with_preview" 
                                                    id="edit_meta[{$lang_name}][meta_twitter_image]" 
                                                    name="edit_meta[{$lang_name}][meta_twitter_image]"
                                                    data-preview="preview_{$lang_name}_meta_twitter_image"
                                                    value="{$seo_settings.meta_twitter_image|escape}">
                                                <button type="button" class="btn btn-default open-media-manager mar-t-1 mar-b-1">{$media_manager_translates->select}</button>
                                                <div id="preview_{$lang_name}_meta_twitter_image" class="file-preview">
                                                {if $seo_settings.meta_twitter_image}
                                                    <img src="{$seo_settings.meta_twitter_image|escape}" alt="Preview" class="img-thumbnail" style="max-width: 33vw; max-height: 25vh;" onerror="this.style.display='none';">
                                                {/if}
                                                </div>
                                            </div>
                                            <span class="description">{$pages_editor_translates->page_meta_twitter_image->description|escape:'html'}</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="input-form-group">
                                        <h4>{$pages_editor_translates->page_headers->other} <i class="toggle-content"></i></h4>
                                        <div class="form-group">
                                            <label for="edit_meta[{$lang_name}][meta_keywords]">{$pages_editor_translates->page_meta_keywords->title}:</label>
                                            <input-with-button><input type="text" class="form-control" id="edit_meta[{$lang_name}][meta_keywords]" name="edit_meta[{$lang_name}][meta_keywords]" value="{$seo_settings.meta_keywords|escape}"><i class="mini_reset_btn"></i></input-with-button>
                                            <span class="description">{$pages_editor_translates->page_meta_keywords->description|escape:'html'}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_meta[{$lang_name}][meta_robots]">{$pages_editor_translates->page_robots->title}:</label>
                                            <select class="form-control" id="edit_meta[{$lang_name}][meta_robots]" name="edit_meta[{$lang_name}][meta_robots]">
                                                <option value="i-f" {if $seo_settings.meta_robots === 'i-f' || empty($seo_settings.meta_robots)}selected{/if}>Index , Follow</option>
                                                <option value="n-f" {if $seo_settings.meta_robots === 'n-f'}selected{/if}>Noindex , Follow</option>
                                                <option value="i-n" {if $seo_settings.meta_robots === 'i-n'}selected{/if}>Index , Nofollow</option>
                                                <option value="n-n" {if $seo_settings.meta_robots === 'n-n'}selected{/if}>Noindex , Nofollow</option>
                                            </select>
                                            <span class="description">{$pages_editor_translates->page_robots->description|escape:'html'}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_meta[{$lang_name}][meta_schema]">{$pages_editor_translates->page_schema->title}:</label>
                                            <select class="form-control" id="edit_meta[{$lang_name}][meta_schema]" name="edit_meta[{$lang_name}][meta_schema]">
                                                <option value="" {if empty($seo_settings.meta_schema)}selected{/if}>-- {$other_translates->select} --</option>
                                                <option value="turn_off" {if $seo_settings.meta_schema === 'turn_off'}selected{/if}>-- {$other_translates->turn_off} --</option>
                                            {foreach from=$pages_editor_translates->page_schema->translate key=status item=translated_status}
                                                <option value="{$status|lower}" {if $seo_settings.meta_schema === $status|lower }selected{/if}>{$translated_status}</option>
                                            {/foreach}
                                            </select>
                                            <span class="description">{$pages_editor_translates->page_schema->description|escape:'html'}</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group-btn sticky">
                                        <button type="submit" class="btn btn-success mr-8px">{$other_translates->save}</button>
                                        <button type="reset" class="btn btn-danger">{$other_translates->cancel}</button>
                                    </div>
                                </form>
                            </div>
                            {/foreach}
                        {else}
                            <div class="alert alert-warning">{$pages_editor_translates->no_page_data->title}</div>
                        {/if}
                    </div>