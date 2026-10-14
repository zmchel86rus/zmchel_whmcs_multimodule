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
                <a href="#mod_pe_tab_main_settings" aria-controls="mod_pe_tab_main_settings" role="tab" data-toggle="tab">
                    {$pages_editor_translates->page_headers->main}
                </a>
            </li>
            <li role="presentation">
                <a href="#mod_pe_tab_content_settings" aria-controls="mod_pe_tab_content_settings" role="tab" data-toggle="tab">
                    {$pages_editor_translates->page_headers->content}
                </a>
            </li>
            <li role="presentation">
                <a href="#mod_pe_tab_metacontent_settings" aria-controls="mod_pe_tab_metacontent_settings" role="tab" data-toggle="tab">
                    {$pages_editor_translates->page_headers->meta}
                </a>
            </li>
            <li role="presentation">
                <a href="#mod_pe_tab_sitemap_settings" aria-controls="mod_pe_tab_sitemap_settings" role="tab" data-toggle="tab">
                    {$pages_editor_translates->page_headers->sitemap}
                </a>
            </li>
        </ul>
        
        <div class="tab-content mar-t-3">
            <!-- Main Page Settings Tab -->
            <div role="tabpanel" class="tab-pane active" id="mod_pe_tab_main_settings">
                <div class="page-edit edit-block main mar-t-3">
                    {include file="./parts/mod_pe_tab_main_settings.tpl"}
                </div>
            </div>
        
            <!-- Content Page Settings Tab -->
            <div role="tabpanel" class="tab-pane" id="mod_pe_tab_content_settings">
                <div class="page-edit edit-block content with-langs mar-t-3">
                    {include file="./parts/mod_pe_tab_content_settings.tpl"}
                </div>
            </div>

            <!-- Meta Content Page Settings Tab -->
            <div role="tabpanel" class="tab-pane" id="mod_pe_tab_metacontent_settings">
                <div class="page-edit edit-block content with-langs mar-t-3">
                    {include file="./parts/mod_pe_tab_metacontent_settings.tpl"}
                </div>
            </div>
        
            <!-- Sitemap Page Settings Tab -->
            <div role="tabpanel" class="tab-pane" id="mod_pe_tab_sitemap_settings">
                <div class="page-edit edit-block sitemap with-langs mar-t-3">
                    {include file="./parts/mod_pe_tab_sitemap_settings.tpl"}
                </div>
            </div>
        </div>
        <hr>
        <div class="pd-l-2 pd-r-2">
            <button id="submit_all_forms" class="btn btn-success mar-r-1">{$other_translates->save_all}</button>
            <button id="reset_all_forms" class="btn btn-danger mar-r-1">{$other_translates->cancel_all}</button>
            {if $default_lang_supported && isset($page_visit_urls[$main_default_lang])}<a class="btn btn-primary" href="{$page_visit_urls[$main_default_lang]|escape:'html'}" target="_blank">{$other_translates->goto}</a>{/if}
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
        $('#mod_pe_tab_sitemap_settings .alert-warning').hide();
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
