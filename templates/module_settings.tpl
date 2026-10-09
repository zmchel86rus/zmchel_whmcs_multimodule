<script>
const formsNonce = '{$zm_pb_forms_nonce}';
const addonName = '{$addonName}';
const subpage = '{$subpage}';
const translate_texts = {
    choose_mediafile:'{$media_manager_translates->select}',
    img_err_size:'{$media_manager_translates->upload_file_alerts->img_err_size}',
    img_err_format:'{$media_manager_translates->upload_file_alerts->img_err_format}',
    img_err_novalid:'{$media_manager_translates->upload_file_alerts->img_err_novalid}',
    image_sizes_translate: {$media_manager_translates->sizes|json_encode nofilter},
}
</script>

{include file="./menus.tpl"}

<div id="zm-pagebuilder" class="panel panel-default pages-list">
    <div class="panel-heading">
        <h3 class="panel-title">{$module_translates->module_settings->title}</h3>
    </div>
    <div class="panel-body">
    {if $alertHtml}{$alertHtml}{/if}
    {if !$alertHtml}
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><a href="#tab_transfer" role="tab" data-toggle="tab">{$transfer_text->title|escape}</a></li>
            <li role="presentation" class="active">
                <a href="#tab_consts_settings" aria-controls="tab_consts_settings" role="tab" data-toggle="tab">
                    {$module_settings_translates->editable_consts->title}
                </a>
            </li>
            <li role="presentation">
                <a href="#tab_redirects_settings" aria-controls="tab_redirects_settings" role="tab" data-toggle="tab">{$redirects_text->settings|escape}</a>
            </li>
            <li role="presentation">
                <a href="#tab_sitemap_settings" aria-controls="tab_sitemap_settings" role="tab" data-toggle="tab">
                    {$module_settings_translates->sitemap->title}
                </a>
            </li>
            <li role="presentation">
                <a href="#tab_custom_header_settings" aria-controls="tab_custom_header_settings" role="tab" data-toggle="tab">
                    {$module_settings_translates->custom_header->title}
                </a>
            </li>
            <li role="presentation">
                <a href="#tab_custom_footer_settings" aria-controls="tab_custom_footer_settings" role="tab" data-toggle="tab">
                    {$module_settings_translates->custom_footer->title}
                </a>
            </li>
            <li role="presentation">
                <a href="#tab_robots" aria-controls="tab_robots" role="tab" data-toggle="tab">
                    {$module_settings_translates->robots->title}
                </a>
            </li>
        </ul>
        <div class="tab-content mar-t-3">
            <div role="tabpanel" class="tab-pane" id="tab_transfer">
                {include file="./parts/transfer.tpl"}
            </div>
            <div role="tabpanel" class="tab-pane active" id="tab_consts_settings">
                <form method="POST" action="addonmodules.php" class="pd-0 mar-t-3">
                    <input type="hidden" name="module" value="{$addonName}">
                    <input type="hidden" name="subpage" value="{$subpage}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                    <input type="hidden" name="action" value="edit_module_vars">
                    
                {foreach from=$editable_vars key=con_name item=con_data}
                {if $con_name !== 'enable_redirects_manager' && $con_name !== 'auto_redirects' && $con_name !== 'auto_redirect_days' && $con_name !== 'enable_sitemap' && $con_name !== 'sitemap_lastupd' && $con_name !== 'sitemap_updfreq' && $con_name !== 'mainsystem_pretty_urls' && $con_name !== 'custom_header' && $con_name !== 'custom_footer' }
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
                {/if}
                {/foreach}
                    <div class="form-group-btn mar-t-6 sticky">
                        <button type="submit" class="btn btn-success mar-r-1">{$other_translates->update}</button>
                    </div>
                </form>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab_redirects_settings">
                <form method="POST" action="addonmodules.php" class="mar-t-3">
                    <input type="hidden" name="module" value="{$addonName|escape}">
                    <input type="hidden" name="subpage" value="module_settings">
                    <input type="hidden" name="action" value="edit_module_vars">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                    <div class="checkbox"><label>
                        <input type="checkbox" name="editable_vars[enable_redirects_manager]"{if $editable_vars['enable_redirects_manager']['value']} checked{/if}>
                        {$redirects_text->enabled|escape}
                    </label></div>
                    <div class="checkbox"><label>
                        <input type="checkbox" name="editable_vars[auto_redirects]"{if $editable_vars['auto_redirects']['value']} checked{/if}>
                        {$redirects_text->auto_enabled|escape}
                    </label></div>
                    <div class="form-group">
                        <label for="redirect_days">{$redirects_text->days|escape}</label>
                        <input id="redirect_days" class="form-control" type="number" name="editable_vars[auto_redirect_days]" value="{$editable_vars['auto_redirect_days']['value']|intval}" min="0" max="36500" step="1" required>
                        <p class="help-block">{$redirects_text->age_help|escape}</p>
                    </div>
                    <button type="submit" class="btn btn-success">{$other_translates->update}</button>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_sitemap_settings">
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
                            name="editable_vars[enable_sitemap]"{if $editable_vars['enable_sitemap']['value'] && $editable_vars['enable_sitemap']['value'] === true } checked{/if}>
                        </label>
                        <span class="description">{$module_settings_translates->sitemap->enable->description|escape:'html'}</span>
                    </div>
                    <div class="form-group">
                        <label for="editable_vars[sitemap_updfreq]">{$module_settings_translates->sitemap->updatefreq->title}:</label>
                        <select class="form-control" id="editable_vars[sitemap_updfreq]" name="editable_vars[sitemap_updfreq]">
                            <option value="" {if empty($editable_vars['sitemap_updfreq']['value'])}selected{/if}>-- {$other_translates->select} --</option>
                            {foreach from=$module_settings_translates->sitemap->translate key=updfreq item=translated}
                            <option value="{$updfreq|lower}" {if $updfreq === $editable_vars['sitemap_updfreq']['value']|lower }selected{/if}>{$translated}</option>
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
                            name="editable_vars[sitemap_html]"{if $editable_vars['sitemap_html']['value'] && $editable_vars['sitemap_html']['value'] === true } checked{/if}>
                        </label>
                        <span class="description">{$module_settings_translates->sitemap->htmlsitemap->description|escape:'html'}</span>
                    </div>
                    *}
                    <div class="form-group-btn mar-t-6 sticky">
                        <button type="submit" class="btn btn-success mar-r-1">{$other_translates->update}</button>
                    </div>
                </form>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab_custom_header_settings">
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
                            name="custom_header_enable"{if $editable_vars['custom_header']['value'] && $editable_vars['custom_header']['value'] === true } checked{/if}>
                        </label>
                        <span class="description">{$module_settings_translates->sitemap->enable->description|escape:'html'}</span>
                    </div>

                    <div class="form-group">
                        <label for="custom_header_input" class="d-flex gap-1 ai-center w-fit">{$module_settings_translates->custom_header->title}</label>
                        <textarea id="custom_header_input" name="custom_header_input" class="block-editor">{$custom_header}</textarea>
                        <span class="description">{$module_settings_translates->custom_header->description|escape:'html'}</span>
                    </div>
                    <div class="form-group-btn mar-t-6 sticky">
                        <button type="submit" class="btn btn-success mar-r-1">{$other_translates->update}</button>
                    </div>
                </form>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab_custom_footer_settings">
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
                            name="custom_footer_enable"{if $editable_vars['custom_footer']['value'] && $editable_vars['custom_footer']['value'] === true } checked{/if}>
                        </label>
                        <span class="description">{$module_settings_translates->sitemap->enable->description|escape:'html'}</span>
                    </div>

                    <div class="form-group">
                        <label for="custom_footer_input" class="d-flex gap-1 ai-center w-fit">{$module_settings_translates->custom_footer->title}</label>
                        <textarea id="custom_footer_input" name="custom_footer_input" class="block-editor" placeholder="...">{$custom_footer}</textarea>
                        <span class="description">{$module_settings_translates->custom_footer->description|escape:'html'}</span>
                    </div>
                    <div class="form-group-btn mar-t-6 sticky">
                        <button type="submit" class="btn btn-success mar-r-1">{$other_translates->update}</button>
                    </div>
                </form>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab_robots">
                <form method="POST" action="addonmodules.php" class="pd-0 mar-t-3">
                    <input type="hidden" name="module" value="{$addonName}">
                    <input type="hidden" name="subpage" value="{$subpage}">
                    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
                    <input type="hidden" name="action" value="edit_robots">

                    <div class="form-group">
                        <label for="edit_robots" class="d-flex gap-1 ai-center w-fit">{$module_settings_translates->robots->title}</label>
                        <textarea id="edit_robots" name="edit_robots" placeholder="..." class="block-editor">{$robots}</textarea>
                        <span class="description">{$module_settings_translates->robots->description|escape:'html'}</span>
                    </div>
                    <div class="form-group-btn mar-t-6 sticky">
                        <button type="submit" class="btn btn-success mar-r-1">{$other_translates->update}</button>
                    </div>
                </form>
            </div>
        </div>
    {/if}
    </div>
</div>

{$mediamanager_modal}

{$page_assets}

<script>
  if (window.CodeMirror) {
    $('.block-editor').each(function() {
        const blockId = $(this).attr('id')
        var codeEditor = CodeMirror.fromTextArea(document.getElementById(blockId), {
            mode: 'text/html',
            lineNumbers: true,
            indentUnit: 4,
            indentWithTabs: false,
            lineWrapping: true,
            theme: 'monokai',
        });
                
        codeEditor.on('change', function() {
            codeEditor.save();
        });
        $('a[href="#tab_custom_footer_settings"],a[href="#tab_custom_header_settings"],a[href="#tab_robots"]').on('click', function() {
            setTimeout(function() { codeEditor.refresh(); }, 100);
        });
    });
}
</script>
<style>
.browser-preview__favicon {
    width: 16px;
    height: 16px;
}

.browser-preview__tab--inactive:hover{
    background:#4661e333
}
.browser-preview__tab-close > svg{
    transform:rotate(45deg)
}
.browser-preview {
    --bp-bg:         #dee1e6;
    --bp-tab-active: #ffffff;
    --bp-text:       #202124;
    --bp-text-muted: #5f6368;
    --bp-border:     rgba(0, 0, 0, 0.08);
    --bp-radius:     10px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
    max-width: 40vw;
    width: 100%;
}

.browser-preview__chrome {
    background: var(--bp-bg);
    border-radius: var(--bp-radius) var(--bp-radius) 0 0;
    padding: 10px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    max-width: 40vw;
    width: 100%;
}

.browser-preview__chrome {}

.browser-preview__tabs {
    display: flex;
    align-items: center;
    gap: 6px;
}

.browser-preview__tab {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 10px 8px 12px;
    border-radius: 14px;
    min-width: 0;
    max-width: 240px;
    flex: 1;
    font-size: 12.5px;
    line-height: 1;
    color: var(--bp-text);
    cursor: default;
    user-select: none;
}

.browser-preview__tab--active {
    background: var(--bp-tab-active);
    box-shadow:
        0 -1px 0 var(--bp-border),
        -1px 0 0 var(--bp-border),
        1px 0 0 var(--bp-border);
}

.browser-preview__favicon > img {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    object-fit: cover;
    border-radius: 2px;
    padding: 0;
    background: transparent;
    border: 0;
}

.browser-preview__tab-title {
    flex: 1;
    min-width: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.browser-preview__tab-close {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    padding: 0;
    border: 0;
    background: transparent;
    color: var(--bp-text-muted);
    border-radius: 50%;
    cursor: default;
    flex-shrink: 0;
    transition: background 0.12s ease, color 0.12s ease;
}

.browser-preview__tab-close:hover {
    background: rgba(0, 0, 0, 0.08);
    color: var(--bp-text);
}

.browser-preview__tab-new {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    padding: 0;
    border: 0;
    background: transparent;
    color: var(--bp-text-muted);
    border-radius: 24px;
    cursor: default;
    flex-shrink: 0;
}

.browser-preview__tab-new:hover {
    background: rgba(0, 0, 0, 0.06);
    color: var(--bp-text);
}

.browser-preview__addressbar {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--bp-tab-active);
    border-radius: 999px;
    padding: 7px 14px;
    margin: 8px 0 0;
    font-size: 12.5px;
    color: var(--bp-text-muted);
}

.browser-preview__lock {
    flex-shrink: 0;
    color: #1a73e8;
}

.browser-preview__url {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.browser-preview__caption {
    margin: 10px 0 0;
    font-size: 12px;
    color: var(--bp-text-muted);
    text-align: center;
}

.browser-preview__favicon_main{
    min-width: 96px;
    max-width: 96px;
    background: #282828;
    border-radius: 8px;
    overflow: hidden;
}
.browser-preview__favicon_main > img{
    width: 100%;
    height: 100%;
    padding: 0;
    border: 0;
    border-radius: 8px;
}

@media (prefers-color-scheme: dark) {
    .browser-preview {
        --bp-bg:         #2a2d31;
        --bp-tab-active: #1f2124;
        --bp-text:       #e8eaed;
        --bp-text-muted: #9aa0a6;
        --bp-border:     rgba(255, 255, 255, 0.06);
    }
    .browser-preview__tab-close:hover,
    .browser-preview__tab-new:hover {
        background: rgba(255, 255, 255, 0.08);
    }
}

@media (max-width: 480px) {
    .browser-preview__tab {
        max-width: none;
    }
}
</style>
