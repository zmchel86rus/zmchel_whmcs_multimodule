<script>
const pageId = {$page_data->main->id};
const formsNonce = '{$zm_pb_forms_nonce}';
const addonName = '{$addonName}';
const subpage = '{$subpage}';
const translate_texts = {
    you_sure: '{$other_translates->you_sure}',
    select: '{$other_translates->select}',
    list_ol: '{$other_translates->list_ol}',
    list_ul: '{$other_translates->list_ul}',
    choose_mediafile:'{$media_manager_translates->select}',
    turn_on: '{$other_translates->turn_on}',
    turn_off: '{$other_translates->turn_off}',
    img_err_size:'{$media_manager_translates->upload_file_alerts->img_err_size}',
    img_err_format:'{$media_manager_translates->upload_file_alerts->img_err_format}',
    img_err_novalid:'{$media_manager_translates->upload_file_alerts->img_err_novalid}',
    image_sizes_translate: {$media_manager_translates->sizes|json_encode nofilter},
}
const page_editor_tools = {$pages_editor_translates->page_editor|json_encode nofilter};
</script>


{include file="./menus.tpl"}


<div id="zm-pagebuilder" class="panel panel-default pages-editor">
    <div class="panel-heading">
        <button type="button" id="zm-pb-whmcs-sidebar-toggle" class="btn btn-default btn-sm pull-right" aria-pressed="false">{$grapes_translates.sidebar_hide|escape:'html'}</button>
        <h3 class="panel-title">{$module_translates->pages_editor->title} - {$other_translates->editing} «{$page_data->main->name|escape:'html'}»</h3>
    </div>
    <div class="panel-body">
        {if $alertHtml}{$alertHtml}{/if}
        
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#tab_main_page_settings" aria-controls="tab_main_page_settings" role="tab" data-toggle="tab">
                    {$pages_editor_translates->page_headers->main}
                </a>
            </li>
            <li role="presentation">
                <a href="#tab_content_page_settings" aria-controls="tab_content_page_settings" role="tab" data-toggle="tab">
                    {$pages_editor_translates->page_headers->content}
                </a>
            </li>
            <li role="presentation">
                <a href="#tab_metacontent_page_settings" aria-controls="tab_metacontent_page_settings" role="tab" data-toggle="tab">
                    {$pages_editor_translates->page_headers->meta}
                </a>
            </li>
            <li role="presentation">
                <a href="#tab_sitemap_page_settings" aria-controls="tab_sitemap_page_settings" role="tab" data-toggle="tab">
                    {$pages_editor_translates->page_headers->sitemap}
                </a>
            </li>
        </ul>
        
        <div class="tab-content mar-t-3">
            <!-- Main Page Settings Tab -->
            <div role="tabpanel" class="tab-pane active" id="tab_main_page_settings">
                <div class="page-edit edit-block main mar-t-3">
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
                </div>
            </div>
        
            <!-- Content Page Settings Tab -->
            <div role="tabpanel" class="tab-pane" id="tab_content_page_settings">
                <div class="page-edit edit-block content with-langs mar-t-3">
                    {*<!-- Language Management Bar -->
                    <div class="language-management-bar">
                        <div class="language-add-form">
                            <label>Add Language:</label>
                            <select id="new_language_select" class="form-control" style="width: auto; display: inline-block;">
                                <option value="">-- Select Language --</option>
                                {foreach from=$module_langs key=lang_name item=lang_data}
                                    <option value="{$lang_name}">{$lang_data['name']} ({$module_translates->supported_langs->translate->$lang_name})</option>
                                {/foreach}
                            </select>
                            <button type="button" id="add_language_btn" class="btn btn-primary btn-sm">Add</button>
                        </div>
                    </div>*}
                    
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
                </div>
            </div>

            <!-- Meta Content Page Settings Tab -->
            <div role="tabpanel" class="tab-pane" id="tab_metacontent_page_settings">
                <div class="page-edit edit-block content with-langs mar-t-3">
                    
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
                </div>
            </div>
        
            <!-- Sitemap Page Settings Tab -->
            <div role="tabpanel" class="tab-pane" id="tab_sitemap_page_settings">
                <div class="page-edit edit-block sitemap with-langs mar-t-3">
                    <h2>{$pages_editor_translates->page_headers->sitemap}</h2>
                    {assign var="can_edit_sitemap" value=$page_data->main->status === 'publish' && $page_data->main->type !== 'system'}
                    <form id="form_sitemap" method="POST" action="addonmodules.php?module={$addonName}&subpage={$subpage}" data-form-order="4" {if !$can_edit_sitemap}class="disabled-form"{/if}>
                        <input type="hidden" name="module" value="{$addonName}">
                        <input type="hidden" name="subpage" value="{$subpage}">
                        <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                        <input type="hidden" name="action" value="edit_page_sitemap">
                        <input type="hidden" name="page_id" value="{$page_data->main->id}">
                            
                        <div class="form-group">
                            <label for="edit_sitemap[changefreq]">{$pages_editor_translates->page_sitemap_changefreq->title}:</label>
                            <select class="form-control" id="edit_sitemap[changefreq]" name="edit_sitemap[changefreq]" {if !$can_edit_sitemap}disabled{/if}>
                            {foreach from=$pages_editor_translates->page_sitemap_changefreq->translate key=status item=translated_status}
                                <option value="{$status}" {if isset($page_data->sitemap->changefreq) && $status === $page_data->sitemap->changefreq}selected{elseif !isset($page_data->sitemap->changefreq) && $status === 'monthly'}selected{/if}>{$translated_status}</option>
                            {/foreach}
                            </select>
                            <span class="description">{$pages_editor_translates->page_sitemap_changefreq->description|escape:'html'}</span>
                        </div>
                        <div class="form-group">
                            <label for="edit_sitemap[priority]">{$pages_editor_translates->page_sitemap_priority->title}:</label>
                            <input type="number" step="0.1" min="0" max="1" class="form-control" id="edit_sitemap[priority]" name="edit_sitemap[priority]" value="{if isset($page_data->sitemap->priority)}{$page_data->sitemap->priority}{else}0.5{/if}" {if !$can_edit_sitemap}disabled{/if}>
                            <span class="description">{$pages_editor_translates->page_sitemap_priority->description|escape:'html'}</span>
                        </div>

                        {*
                        <div class="form-group">
                            <label for="edit_sitemap[url]">{$pages_editor_translates->page_sitemap_url->title}:</label>
                            <input type="text" 
                                class="form-control" 
                                id="edit_sitemap[url]" 
                                name="edit_sitemap[url]" 
                                value="{if isset($page_data->sitemap->url) && ! empty($page_data->sitemap->url) }{$page_data->sitemap->url|escape:'html'}{else}{$main_host_url}{$page_data->main->slug|escape}{/if}" readonly>
                            <span class="description">{$pages_editor_translates->page_sitemap_url->description|escape:'html'}</span>
                        </div>
                        *}
                        <input type="hidden" id="edit_sitemap[url]" name="edit_sitemap[url]" 
                            value="{if isset($page_data->sitemap->url) && ! empty($page_data->sitemap->url) }{$page_data->sitemap->url|escape:'html'}{else}{$main_host_url}{$page_data->main->slug|escape}{/if}" readonly>

                        <div class="form-group-btn sticky">
                            <button type="submit" class="btn btn-success mr-8px" {if !$can_edit_sitemap}disabled{/if}>{$other_translates->save}</button>
                            <button type="reset" class="btn btn-danger" {if !$can_edit_sitemap}disabled{/if}>{$other_translates->cancel}</button>
                        </div>
                    </form>
                    {if $page_data->main->type === 'system'}
                    <div class="alert alert-info">{$pages_editor_translates->page_sitemap_noshow->type}</div>
                    {elseif $page_data->main->status !== 'publish'}
                    <div class="alert alert-warning">{$pages_editor_translates->page_sitemap_noshow->no_publish}</div>
                    {/if}
                </div>
            </div>
        </div>
        <hr>
        <div class="pd-l-2 pd-r-2">
            <button id="submit_all_forms" class="btn btn-success mar-r-1">{$other_translates->save_all}</button>
            <button id="reset_all_forms" class="btn btn-danger mar-r-1">{$other_translates->cancel_all}</button>
            <a class="btn btn-primary" href="{if isset($page_data->sitemap->url) && ! empty($page_data->sitemap->url) }{$page_data->sitemap->url|escape:'html'}{else}{$main_host_url}{$page_data->main->slug|escape}{/if}" target="_blank">{$other_translates->goto}</a>
        </div>
    </div>
</div>

{$mediamanager_modal}

<div id="zm-pb-grapes-edit-modal" class="zm-pb-grapes-modal" role="dialog" aria-modal="true" aria-hidden="true" style="display:none">
    <div class="zm-pb-grapes-modal-content">
        <h3 class="zm-pb-modal-title"></h3>
        <textarea class="form-control" rows="14"></textarea>
        <div class="zm-pb-grapes-modal-actions">
            <button type="button" class="btn btn-default zm-pb-modal-cancel">{$grapes_translates.cancel|escape:'html'}</button>
            <button type="button" class="btn btn-primary zm-pb-modal-save">{$grapes_translates.save|escape:'html'}</button>
        </div>
    </div>
</div>

{$page_assets}

<script>
$('#edit_main\\[status\\]').on('change', function() {
    var newStatus = $(this).val();
    var pageType = $('#edit_main\\[type\\]').val();
        
    if (newStatus === 'publish' && pageType !== 'system') {
        $('#form_sitemap').removeClass('disabled-form');
        $('#form_sitemap').find('input, select, button').prop('disabled', false);
        $('#form_sitemap').find('input:not([name="edit_sitemap[url]"]), select, button').prop('readonly', false);
        $('#tab_sitemap_page_settings .alert-warning').hide();
    } else {
        $('#form_sitemap').addClass('disabled-form');
        $('#form_sitemap').find('input, select, button').prop('disabled', true);
        $('#form_sitemap').find('input, select, button').prop('readonly', true);
    }
});
$('#zm-pagebuilder #submit_all_forms').on('click', function() {
    var $btn = $(this);
    $btn.prop('disabled', true);
        
    var $forms = $('#zm-pagebuilder .tab-content .tab-pane form[data-form-order]').sort(function(a, b) {
        return $(a).data('form-order') - $(b).data('form-order');
    });
        
    var formIndex = 0;
    var totalForms = $forms.length;
    var saveFailed = false;
        
    function submitNextForm() {
        if (formIndex >= totalForms) {
            if (!saveFailed) jQuery.growl.notice({ title: '{$other_translates->success}', message: '{$other_translates->all_saved}' });
            $btn.prop('disabled', false);
            return;
        }
            
        var $form = $($forms[formIndex]);
        formIndex++;
            
        // Skip disabled forms
        if ($form.hasClass('disabled-form')) {
            submitNextForm();
            return;
        }
            
        // Sync block editors before submit
        var formId = $form.attr('id');
        if (formId && formId.indexOf('form_content_') === 0) {
            var lang = formId.replace('form_content_', '');
            var $container = $('#block_content_' + lang);
            BlockEditor.syncBlocksToTextarea($container, lang);
        }
            
        const formData = new FormData($form[0]);
        if (formId && formId.indexOf('form_content_') === 0) {
            BlockEditor.encodeContentForTransport(formData, formId.replace('form_content_', ''));
        }
        var pageDirtySnapshot = window.ZmPbPageDirty && window.ZmPbPageDirty.snapshot($form[0], true);
            
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    if (formId && formId.indexOf('form_content_') === 0 && response.contents) {
                        var savedLang = formId.replace('form_content_', '');
                        if (response.contents[savedLang]) BlockEditor.updateCodeAssetFiles($('#block_content_' + savedLang), response.contents[savedLang]);
                    }
                    if (window.ZmPbPageDirty) window.ZmPbPageDirty.markSaved(formId, pageDirtySnapshot);
                } else {
                    saveFailed = true;
                    jQuery.growl.error({ title: response.title, message: response.message });
                }
                submitNextForm();
            },
            error: function() {
                saveFailed = true;
                jQuery.growl.error({ title: '{$other_translates->error|escape:'javascript'}', message: '{$other_translates->all_saved_with_error|escape:'javascript'} #form ' + (formId || formIndex) + '.' });
                submitNextForm();
            }
        });

    }
        
    submitNextForm();
}); 
</script>
