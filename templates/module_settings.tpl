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
            <li role="presentation">
                <a href="#mod_ss_tab_transfer" aria-controls="mod_ss_tab_transfer" role="tab" data-toggle="tab">
                    {$transfer_text->title|escape}
                </a>
            </li>
            <li role="presentation" class="active">
                <a href="#mod_ss_tab_consts" aria-controls="mod_ss_tab_consts" role="tab" data-toggle="tab">
                    {$module_settings_translates->editable_consts->title}
                </a>
            </li>
            <li role="presentation">
                <a href="#mod_ss_tab_languages" aria-controls="mod_ss_tab_languages" role="tab" data-toggle="tab">
                    {$module_translates->supported_langs->title|escape}
                </a>
            </li>
            <li role="presentation">
                <a href="#mod_ss_tab_redirects" aria-controls="mod_ss_tab_redirects" role="tab" data-toggle="tab">{$redirects_text->settings|escape}</a>
            </li>
            <li role="presentation">
                <a href="#mod_ss_tab_sitemap" aria-controls="mod_ss_tab_sitemap" role="tab" data-toggle="tab">
                    {$module_settings_translates->sitemap->title}
                </a>
            </li>
            <li role="presentation">
                <a href="#mod_ss_tab_custom_header" aria-controls="mod_ss_tab_custom_header" role="tab" data-toggle="tab">
                    {$module_settings_translates->custom_header->title}
                </a>
            </li>
            <li role="presentation">
                <a href="#mod_ss_tab_custom_footer" aria-controls="mod_ss_tab_custom_footer" role="tab" data-toggle="tab">
                    {$module_settings_translates->custom_footer->title}
                </a>
            </li>
            <li role="presentation">
                <a href="#mod_ss_tab_robots" aria-controls="mod_ss_tab_robots" role="tab" data-toggle="tab">
                    {$module_settings_translates->robots->title}
                </a>
            </li>
        </ul>
        <div class="tab-content mar-t-3">
            <div role="tabpanel" class="tab-pane" id="mod_ss_tab_transfer">
                {include file="./parts/mod_ss_tab_transfer.tpl"}
            </div>
            <div role="tabpanel" class="tab-pane active" id="mod_ss_tab_consts">
                {include file="./parts/mod_ss_tab_consts.tpl"}
            </div>
            <div role="tabpanel" class="tab-pane" id="mod_ss_tab_languages">
                {include file="./parts/mod_ss_tab_languages.tpl"}
            </div>

            <div role="tabpanel" class="tab-pane" id="mod_ss_tab_redirects">
                {include file="./parts/mod_ss_tab_redirects.tpl"}
            </div>
            <div role="tabpanel" class="tab-pane" id="mod_ss_tab_sitemap">
                {include file="./parts/mod_ss_tab_sitemap.tpl"}
            </div>

            <div role="tabpanel" class="tab-pane" id="mod_ss_tab_custom_header">
                {include file="./parts/mod_ss_tab_custom_header.tpl"}
            </div>

            <div role="tabpanel" class="tab-pane" id="mod_ss_tab_custom_footer">
                {include file="./parts/mod_ss_tab_custom_footer.tpl"}
            </div>

            <div role="tabpanel" class="tab-pane" id="mod_ss_tab_robots">
                {include file="./parts/mod_ss_tab_robots.tpl"}
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
        $('a[href="#mod_ss_tab_custom_footer"],a[href="#mod_ss_tab_custom_header"],a[href="#mod_ss_tab_robots"]').on('click', function() {
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
