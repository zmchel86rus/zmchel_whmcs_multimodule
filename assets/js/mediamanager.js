var MediaManager = {
    onSelect: null,
    modalState: { cursor: null, hasMore: true, loading: false, requestId: 0 },
    adminState: { cursor: null, hasMore: true, loading: false, requestId: 0 },

    request: function(method = 'POST', action, formData) {
        if( method === 'POST' ){
            formData = formData || new FormData();
            formData.append('module', addonName);
            formData.append('subpage', subpage);
            formData.append('action', action);
            formData.append('zm_pb_forms_nonce', formsNonce);

            if( formData.get('delete') || action === 'media_manager_image_optimize' ) formData.append('zm_pb_admin_nonce', formsAdminNonce);

            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: 'addonmodules.php',
                    method: method,
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 'success') resolve(response);
                        else reject(response.message || 'Unable to process the media file.');
                    },
                    error: function() {
                        reject('Unable to process the media file.');
                    },
                });
            });
        } else if(method === 'GET'){
            const payload = Object.assign({}, formData, {
                module: addonName,
                subpage: subpage,
                action: action,
                zm_pb_forms_nonce: formsNonce,
            });
            const query = $.param(payload);
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: 'addonmodules.php?' + query,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') resolve(response);
                        else reject(response.message || 'Error');
                    },
                    error: function() { reject('Error'); },
                });
            });
        }
        
    },

    open: function(onSelect) {
        this.onSelect = onSelect;
        $('div.modal.zm_pb_media_manager').modal('show');
        if( subpage !== 'media_manager' ) this.load();
    },

    renderModalFile: function(file) {
        const $button = $('<button type="button" class="zm-pb-media-file">')
            .attr('data-url', file.url).attr('data-name', file.alt || file.name || file.filename)
            .data('imagedata', file).data('size', 'full');
        if (file.is_image) $button.append($('<img alt="">').attr('src', (file.sized || {}).thumbnail || file.url));
        else $button.append($('<span>').text(file.name || file.filename));
        if (!file.is_image || !file.sized || !Object.keys(file.sized).length) return $button;
        const $wrapper = $('<div class="image-sizes-wrapper">');
        const $sizes = $('<div class="image-sizes">');
        Object.entries(file.sized).forEach(function(entry) {
            const label = (translate_texts.image_sizes_translate || {})[entry[0]] || entry[0];
            $sizes.append($('<button type="button" class="zm-pb-media-file image-size">')
                .attr('data-url', entry[1]).attr('data-name', file.alt || file.name || file.filename)
                .data('imagedata', file).data('size', entry[0]).text(label));
        });
        return $wrapper.append($sizes, $button);
    },

    renderAdminFile: function(file) {
        const $card = $('<button type="button" class="zm-pb-admin-media-card media-manager-element">')
            .attr('media-id', file.id).data('imagedata', file);
        if (file.is_image) $card.append($('<img alt="">').attr('src', (file.sized || {}).thumbnail || file.url));
        else {
            const icon = file.mime_type && file.mime_type.indexOf('audio/') === 0 ? 'fa-file-audio'
                : file.mime_type && file.mime_type.indexOf('video/') === 0 ? 'fa-file-video' : 'fa-file-pdf';
            $card.append($('<i class="fas">').addClass(icon).attr('aria-hidden', 'true'));
        }
        return $card.append($('<span>').text(file.name || file.filename));
    },

    loadPage: function(mode, reset) {
        const admin = mode === 'admin';
        const state = admin ? this.adminState : this.modalState;
        const $files = admin ? $('#zm_pb_admin_media_files') : $('#zm_pb_media_manager_files');
        const $more = admin ? $('#zm_pb_admin_media_more') : $('#zm_pb_modal_media_more');
        const $search = admin ? $('#zm_pb_media_filter_search') : $('#zm_pb_modal_media_search');
        const $type = admin ? $('#zm_pb_media_filter_type') : $('#zm_pb_modal_media_type');
        if (!$files.length) return;
        if (reset) {
            state.requestId += 1;
            state.cursor = null;
            state.hasMore = true;
            state.loading = false;
            $files.empty();
        }
        if (state.loading || !state.hasMore) return;
        state.loading = true;
        $more.prop('disabled', true);
        const requestId = state.requestId;
        const self = this;
        this.request('GET', 'media_manager_list', {
            search: $search.val() || '', type: $type.val() || '', before_id: state.cursor || 0
        }).then(function(response) {
            if (requestId !== state.requestId) return;
            response.files.forEach(function(file) {
                $files.append(admin ? self.renderAdminFile(file) : self.renderModalFile(file));
            });
            state.cursor = response.next_cursor;
            state.hasMore = !!response.has_more;
            $more.toggleClass('d-none', !state.hasMore);
            if (!$files.children().length) $files.append($('<p>').text($files.data('empty') || 'No files found.'));
        }).catch(function(message) {
            if (requestId === state.requestId) jQuery.growl.error({ title: 'Error', message: message });
        }).then(function() {
            if (requestId === state.requestId) {
                state.loading = false;
                $more.prop('disabled', false);
            }
        });
    },

    load: function(reset) {
        this.loadPage('modal', reset !== false);
    },

    loadAdmin: function(reset) {
        this.loadPage('admin', reset !== false);
    },

    upload: function(data) {
        let formData;
        
        if (!(data instanceof FormData)) {
            formData = new FormData();
            formData.append('file', data);
        } else {
            formData = data;
        }

        const temp_action_name = (subpage === 'media_manager' ? 'media_manager_upload_data' : 'media_manager_upload');
        
        return this.request('POST',temp_action_name, formData).then(function(response) {
            return response.file;
        });
    },
    action: function(formData) {

        let temp_action_name = 'media_manager_image_save';

        if (!(formData instanceof FormData)) jQuery.growl.error({ title: 'Error', message: '! FormData' });

        if( formData.get('delete') ) {
            formData.append('_method','DELETE');
            formData.append('type','media');
            temp_action_name = 'delete';
        }
        
        return this.request('POST',temp_action_name, formData).then(function(response) {
            return response;
        });
    },
};

$('#zm_pb_media_manager_form_edit').on('submit', function(e) {
    e.preventDefault();

    const $form = $(e.target);
    const formData = new FormData($form[0]);

    const submitter = e.originalEvent?.submitter;
    if (submitter && submitter.name) {
        formData.append(submitter.name, submitter.value);
    }

    MediaManager.action(formData).then(function(response) {
        jQuery.growl.notice({ title: response.title, message: response.message });
        if( formData.get('delete') ) {
            $form.closest('.modal').modal('hide');
            let media_id = formData.get('id');
            $(`[media-id="${media_id}"]`).remove();
            if (subpage === 'media_manager') MediaManager.loadAdmin(true);
        } else if (subpage === 'media_manager') {
            MediaManager.loadAdmin(true);
        }
    }).catch(function(response) {
        jQuery.growl.error({ title: 'Error', message: String(response) });
    });
});

$('#zm_pb_media_upload_button,#zm_pb_mediamanager_upload_button').on('click', function() {
    $(this).parent().find('input[type="file"]').trigger('click')
});

$('#zm_pb_mediamanager_upload_input').on('change', function() {
    var input = this;
    if (!input.files[0]){
        $(this).closest('form').find('.form-group,.form-group-btn').addClass('d-none')
    } else {
        $(this).closest('form').find('.form-group.d-none,.form-group-btn.d-none').removeClass('d-none')
    }
});

$('#zm_pb_media_manager_form,#zm_pb_media_manager_form_edit').on('submit', function(e) {
    e.preventDefault();

    const $form = $(e.target);
    const formData = new FormData($form[0]);

    if ( !formData.get('file') ) return;

    MediaManager.upload(formData).then(function() {
        location.reload();
    }).catch(function(message) {
        jQuery.growl.error({ title: 'Error', message: String(message) });
    });
});

$('#zm_pb_media_upload_input').on('change', function() {
    var input = this;
    if (!input.files[0]) return;

    MediaManager.upload(input.files[0]).then(function(file) {
        input.value = '';
        MediaManager.load();
        if (MediaManager.onSelect) MediaManager.onSelect(file);
        $('div.modal.zm_pb_media_manager').modal('hide');
    }).catch(function(message) {
        input.value = '';
        jQuery.growl.error({ title: 'Error', message: message });
    });
});

$('.image-wrapper .open-media-manager').on('click', function() {
    const mediafile_manager_button = $(this);
    MediaManager.open(function(file) {
        mediafile_manager_button.closest('div').find('input[type=url]').val(file.url).trigger('change');
    });
});

$('#zm_pb_media_manager_files').on('click', '.zm-pb-media-file', function() {
    const file = $(this).data('imagedata') || {};
    const variant = (file.variants || {})[$(this).data('size')] || {};
    if (MediaManager.onSelect) MediaManager.onSelect(Object.assign({}, file, {
        url: $(this).data('url'), name: $(this).data('name'),
        width: variant.width || file.width || 0, height: variant.height || file.height || 0
    }));
    $('div.modal.zm_pb_media_manager').modal('hide');
});

$('#zm_pb_optimize_image').on('click', function() {
    const $button = $(this);
    const $form = $('#zm_pb_media_manager_form_edit');
    const id = Number($form.find('input#id').val());
    if (!id || $button.prop('disabled')) return;
    const data = new FormData();
    data.append('id', String(id));
    $button.prop('disabled', true);
    MediaManager.request('POST', 'media_manager_image_optimize', data).then(function(response) {
        $('#zm_pb_optimization_status').text(translate_texts.image_optimized);
        const $card = $('#zm_pb_admin_media_files .media-manager-element[media-id="' + id + '"]');
        $card.data('imagedata', response.file);
        if (response.file && response.file.is_image) {
            $card.find('img').attr('src', ((response.file.sized || {}).thumbnail || response.file.url) + '?v=' + Date.now());
            $('div.modal.zm_pb_media_manager_image img').attr('src', response.file.url + '?v=' + Date.now());
        }
        jQuery.growl.notice({ title: response.title, message: response.message });
    }).catch(function(message) {
        jQuery.growl.error({ title: 'Error', message: String(message) });
    }).then(function() { $button.prop('disabled', false); });
});

$('#zm_pb_admin_media_files').on('click', '.media-manager-element', function() {
    const file = $(this).data('imagedata');
    if (!file) return;
    const $modal = $('div.modal.zm_pb_media_manager_image');
    const $form = $modal.find('form#zm_pb_media_manager_form_edit');
    $modal.find('img').attr('src', file.is_image ? file.url : '').toggleClass('d-none', !file.is_image);
    $modal.find('.zm-pb-media-nonimage').toggleClass('d-none', !!file.is_image).find('span').text(file.name || file.filename);
    $form.find('input#id').val(file.id);
    $form.find('input#name').val(file.name);
    $form.find('input#title').val(file.title);
    $form.find('input#alt').val(file.alt);
    $form.find('textarea#description').val(file.description);
    $modal.find('#zm_pb_optimize_image').toggleClass('d-none', !file.is_image);
    $modal.find('#zm_pb_optimization_status').text(file.is_image && file.optimization_attempted ? translate_texts.image_optimized : '');
    $modal.modal('show');
    $form.find('input:not([type="hidden"]),textarea').trigger('input');
});

let mediaAdminSearchTimer;
$('#zm_pb_media_filter_search').on('input', function() {
    clearTimeout(mediaAdminSearchTimer);
    mediaAdminSearchTimer = setTimeout(function() { MediaManager.loadAdmin(true); }, 250);
});
$('#zm_pb_media_filter_type').on('change', function() { MediaManager.loadAdmin(true); });
$('#zm_pb_admin_media_more').on('click', function() { MediaManager.loadAdmin(false); });

let mediaModalSearchTimer;
$('#zm_pb_modal_media_search').on('input', function() {
    clearTimeout(mediaModalSearchTimer);
    mediaModalSearchTimer = setTimeout(function() { MediaManager.load(true); }, 250);
});
$('#zm_pb_modal_media_type').on('change', function() { MediaManager.load(true); });
$('#zm_pb_modal_media_more').on('click', function() { MediaManager.load(false); });

if (subpage === 'media_manager') MediaManager.loadAdmin(true);
