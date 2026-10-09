if (['#tab_redirects_settings', '#tab_transfer'].includes(window.location.hash)) {
    $('#zm-pagebuilder a').filter(function () { return this.getAttribute('href') === window.location.hash; }).tab('show');
}

$('#zm-pagebuilder [data-transfer-all]').on('change', function () {
    $(this.form).find('[name="transfer_sections[]"]').prop('checked', this.checked);
});
$('#zm-pagebuilder [name="transfer_sections[]"]').on('change', function () {
    const $choices = $(this.form).find('[name="transfer_sections[]"]');
    const selected = $choices.filter(':checked').length;
    $(this.form).find('[data-transfer-all]').prop('checked', selected === $choices.length).prop('indeterminate', selected > 0 && selected < $choices.length);
});

$('#zm-pagebuilder form').filter(function () {
    return (this.getAttribute('method') || '').toLowerCase() === 'post';
}).on('submit', function (e) {
    e.preventDefault();

    const $form = $(e.target);
    // Enter in GrapesJS fields (notably the class manager) commits that field.
    // The browser may also submit the containing page form implicitly.
    if (($form.attr('id') || '').indexOf('form_content_') === 0
        && document.activeElement
        && document.activeElement.closest('.gjs-editor, .gjs-clm-tags, .zm-pb-component-controls')) return;
    if ($form.data('confirm') && !window.confirm($form.data('confirm'))) return;
    const formId = $form.attr('id');
    if (formId === 'rewrite_custom_rule_form') {
        $form.find('#zm-pb-rewrite-form-message').prop('hidden', true).text('');
    }
    
    if (window.tinymce) {
        tinymce.triggerSave();
    }

    if (formId && formId.indexOf('form_content_') === 0 && typeof BlockEditor != "undefined" ) {
        const lang = $form.attr('id').replace('form_content_', '');
        const $container = $('#block_content_' + lang);
        BlockEditor.syncBlocksToTextarea($container, lang);
    }

    const formData = new FormData($form[0]);
    if (!formData.has('token') && typeof csrfToken !== 'undefined' && csrfToken) formData.append('token', csrfToken);
    if (formId && formId.indexOf('form_content_') === 0 && typeof BlockEditor !== 'undefined') {
        BlockEditor.encodeContentForTransport(formData, formId.replace('form_content_', ''));
    }

    const submitter = e.originalEvent?.submitter || (e.currentTarget.contains(document.activeElement) ? document.activeElement : null);
    if (submitter && submitter.name && submitter.name === 'db_action') {
        formData.append(submitter.name, submitter.value);
    }
    if (formData.get('subpage') === 'menu_manager') {
        if (submitter && submitter.name === 'action') formData.set('action', submitter.value);
        if (formData.get('action') === 'save_menu' && window.ZmPbMenuManager) {
            const itemsJson = JSON.stringify(window.ZmPbMenuManager.serialize());
            formData.set('items', 'zm_pb_b64:' + btoa(unescape(encodeURIComponent(itemsJson))));
        }
        $form.find('#zm-pb-menu-message').text('').removeClass('text-danger');
    }

    if( formData.get('subpage') === 'module_settings')
    $form.find('input[type="checkbox"]').each(function () {
        if (!this.checked && this.name && this.name.indexOf('transfer_') !== 0) {
            formData.append(this.name, 'off');
        }
    });
    const pageDirtySnapshot = window.ZmPbPageDirty && window.ZmPbPageDirty.snapshot($form[0], true);
        
    $.ajax({
        url: $form.attr('action'),
        method: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (response) {
            if (formId === 'rewrite_custom_rule_form' && response.status !== 'success') {
                const $message = $form.find('#zm-pb-rewrite-form-message');
                $message.text(response.message || $message.data('error')).prop('hidden', false).addClass('text-danger');
            }
            if (formData.get('subpage') === 'menu_manager') {
                $form.find('#zm-pb-menu-message').text(response.message || '').toggleClass('text-danger', response.status !== 'success');
            }
            if( response.status === 'success') {
                if (response.download && typeof response.download.content === 'string') {
                    const url = URL.createObjectURL(new Blob([response.download.content], {type: 'application/json;charset=utf-8'}));
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = response.download.filename || 'pagebuilder.json';
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                    setTimeout(function () { URL.revokeObjectURL(url); }, 1000);
                }
                jQuery.growl.notice({ title: response.title, message: response.message })
                if (formData.get('subpage') === 'module_settings' && formData.get('action') === 'import_module') {
                    window.location.hash = 'tab_transfer';
                    window.location.reload();
                    return;
                }
                if (formId && formId.indexOf('form_content_') === 0 && response.contents) {
                    const lang = formId.replace('form_content_', '');
                    if (response.contents[lang]) BlockEditor.updateCodeAssetFiles($('#block_content_' + lang), response.contents[lang]);
                }
                if (window.ZmPbPageDirty) window.ZmPbPageDirty.markSaved(formId, pageDirtySnapshot);
                if (formData.get('subpage') === 'menu_manager') {
                    if (window.ZmPbMenuManager) window.ZmPbMenuManager.markSaved();
                    const target = new URL(window.location.href);
                    target.searchParams.set('menu_id', response.menu_id || '0');
                    window.location.assign(target.href);
                    return;
                }
                if( formId === 'create_page_form'){
                    if( typeof response.page_id === 'number'){
                        const url = new URL(location.origin + location.pathname);
                        url.searchParams.set('module', formData.get('module') );
                        url.searchParams.set('subpage', 'pages_editor' );
                        url.searchParams.set('page_id', response.page_id );
                        location.href =  url.href;
                    } else location.reload();
                }
            
                if( formId === 'module_db_action_form' || ['rewrite_manager', 'sitemap_manager', 'redirects_manager'].includes(formData.get('subpage')) ) location.reload();
            } 
            else jQuery.growl.error({ title: response.title, message: response.message });
        },
        error: function (xhr, status) {
            if (formId === 'rewrite_custom_rule_form') {
                const $message = $form.find('#zm-pb-rewrite-form-message');
                $message.text($message.data('error') + ' (HTTP ' + xhr.status + ', ' + status + ')').prop('hidden', false).addClass('text-danger');
            }
            if (formData.get('subpage') === 'menu_manager') {
                $form.find('#zm-pb-menu-message').text('Unable to save the form.').addClass('text-danger');
            }
            jQuery.growl.error({ title: 'Error', message: 'Unable to save the form.' });
        },
    });
});

$('#zm-pagebuilder form[method="DELETE"]').on('submit', function (e) {
    e.preventDefault();

    const $form = $(e.target);
    const formData = new FormData($form[0]);

    if( ! formData.get('token') ) formData.append('token',csrfToken);
        
    $.ajax({
        url: $form.attr('action'),
        method: 'POST', // WHMCS - говно, с современными методами естесно нихуя не работает, но разделение делаем искуственно на бэке
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (response) {
            if( response.status === 'success') {
                jQuery.growl.notice({ title: response.title, message: response.message })
                $form.closest('tr').length ? $form.closest('tr').remove() : $form.closest('div');
                if( $('.trash_route').length ){
                    $('.trash_route').find('count').text( Number($('.trash_route').find('count').text()) + 1 )
                    if( $('.trash_route').hasClass('d-none') ) $('.trash_route').removeClass('d-none')
                }
            }
            else jQuery.growl.error({ title: response.title, message: response.message });
        },
        error: function () {
            jQuery.growl.error({ title: response.title, message: response.message });
        },
    });
});

function transliterate(text) {
    const map = {
        'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd',
        'е': 'e', 'ё': 'e', 'ж': 'zh', 'з': 'z', 'и': 'i',
        'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
        'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't',
        'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'ts', 'ч': 'ch',
        'ш': 'sh', 'щ': 'sch', 'ъ': '', 'ы': 'y', 'ь': '',
        'э': 'e', 'ю': 'yu', 'я': 'ya',
        'ґ': 'g', 'є': 'ye', 'і': 'i', 'ї': 'yi', ' ': '-'
    };

    return text.split('').map(char => {
        const lower = char.toLowerCase();
        return map[lower] ?? (char.match(/[a-z0-9]/i) ? char : '');
    }).join('');
}

$('#zm-pagebuilder form input:not([type=checkbox]):not([type=radio]),#zm-pagebuilder form textarea').on('change', function (e) {
    const input_element = $(this);
    input_element.val() !== '' ? input_element.addClass('filled') : input_element.removeClass('filled');
});

$('#zm-pagebuilder form .page-name-field').on('change', function (e) {
    const val = $(this).val();
    const transliterated = transliterate(val);
    const slug = transliterated.toLowerCase().replace(/[^a-z0-9-]/g, '-').replace(/-+/g, '-').replace(/^-+|-+$/g, '');
    
    if( $(this).closest('form').find('.page-slug-field').val() === '' ) $(this).closest('form').find('.page-slug-field').val(slug).trigger('input');
});

$('#zm-pagebuilder form .page-slug-field').on('input', function (e) {
    let val = $(this).val().toLowerCase();
    val = val.replace(/[^a-z0-9-]/g, '-');
    val = val.replace(/-+/g, '-');
    val = val.replace(/^-+|-+$/g, '');
    $(this).val(val);
});

$('#zm-pagebuilder .mini_reset_btn').on('click', function (e) {
    const input_element = $(this).closest('input:not([type=checkbox]):not([type=radio]),textarea') 
    || $(this).next('input:not([type=checkbox]):not([type=radio]),textarea')
    || $(this).prev('input:not([type=checkbox]):not([type=radio]),textarea');
    input_element.val('')
});

$('#zm-pagebuilder .toggle-content').on('click', function (e) {
    e.preventDefault();
    const elements = jQuery(e.target).closest('div').children('div').slideToggle();
    jQuery(e.target).toggleClass('collapsed')
});

$('#zm-pagebuilder .image-wrapper-input.with_preview').on('change', function (e) {
    const $input = $(this);
    const file = this.files ? this.files[0] : null;

    const previewIds = String($input.data('preview') || '')
        .split(',')
        .map(id => id.trim())
        .filter(Boolean);

    const $previews = $(previewIds.map(id => document.getElementById(id)).filter(Boolean));

    if (!$previews.length) return;

    const showError = (text) => {
        $previews.each(function () {
            $(this).empty().append($('<span class="text-danger"></span>').text(text));
        });
        $input.val('');
    };

    const showImage = (src, hideOnError = false) => {
        $previews.each(function () {
            const $img = $('<img alt="Preview" class="img-thumbnail">')
                .css({ 'max-width': '33vw', 'max-height': '25vh' })
                .attr('src', src);

            if (hideOnError) {
                $img.on('error', function () { $(this).hide(); });
            }

            $(this).empty().append($img);
        });
    };

    $previews.empty();

    if (file) {
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (!validTypes.includes(file.type)) {
            return showError(translate_texts.img_err_format);
        }

        if (file.size > maxSize) {
            return showError(translate_texts.img_err_size);
        }

        const reader = new FileReader();
        reader.onload = function (ev) {
            showImage(ev.target.result);
        };
        reader.readAsDataURL(file);
        return;
    }

    const url = this.value.trim();
    if (!url) return;

    if (!URL.canParse(url)) {
        return showError(translate_texts.img_err_format);
    }

    showImage(url, true);
});

$('#zm-pagebuilder #reset_all_forms').on('click', function() {
    if (confirm(translate_texts.you_sure)) {
        $('#zm-pagebuilder form').each(function(){ this.reset(); })
    }
});

$('#zm-pagebuilder .with-max-count input, #zm-pagebuilder .with-max-count textarea').on('input',function () {
    
    const element = $(this);
    const parent_element = element.closest('.with-max-count');
    const max_count = Number( parent_element.attr('max-count') ) || false;

    if( ! max_count ) return;

    if (element.val().length >= max_count) {
        element.val(element.val().substring(0, max_count));
        parent_element.find('max-count-element').addClass('error')
    } else parent_element.find('max-count-element').removeClass('error')
    

    if( ! parent_element.find('max-count-element').length ) parent_element.append('<max-count-element></max-count-element>');
    parent_element.find('max-count-element').text(`${element.val().length} / ${max_count}`);
    if( element.val().length === 0 ) parent_element.find('max-count-element').remove()
});
