(function () {
    'use strict';
    var tabs = ['#mod_lm_tab_lists', '#mod_lm_tab_lang_list', '#mod_lm_tab_lang_list_edit'];
    if (tabs.indexOf(window.location.hash) !== -1 && window.jQuery &&
        window.jQuery.fn && window.jQuery.fn.tab) {
        window.jQuery('.langs-manager a[href="' + window.location.hash + '"][data-toggle="tab"]').tab('show');
    }
    if (window.jQuery) {
        window.jQuery('.langs-manager a[data-toggle="tab"]').on('shown.bs.tab', function () {
            var hash = this.getAttribute('href');
            if (tabs.indexOf(hash) !== -1 && window.location.hash !== hash)
                window.history.replaceState(null, '', window.location.pathname + window.location.search + hash);
        });
    }
    var searchForm = document.getElementById('lm-search-form');
    if (searchForm) searchForm.addEventListener('submit', function (event) {
        event.preventDefault();
        var url = new URL(searchForm.action, window.location.href);
        new FormData(searchForm).forEach(function (value, key) { url.searchParams.set(key, value); });
        if (!searchForm.elements.namedItem('q').value.trim()) url.searchParams.delete('q');
        url.hash = 'mod_lm_tab_lang_list_edit';
        window.location.assign(url.toString());
    });
    var viewSelect = document.getElementById('lm-view');
    if (viewSelect) viewSelect.addEventListener('change', function () {
        searchForm.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
    });
    var box = document.getElementById('lm-message');
    document.querySelectorAll('.langs-manager .lm-action-form').forEach(function (form) {
        if (form.dataset.lmBound) return;
        form.dataset.lmBound = '1';
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            if (form.dataset.lmSubmitting) return;
            var action = form.elements.namedItem('action').value;
            var button = form.querySelector('button[type="submit"]');
            if (action === 'delete_translation' && !window.confirm(button.textContent.trim() + '?')) return;
            form.dataset.lmSubmitting = '1';
            var status = form.parentElement.querySelector('.lm-row-status');
            button.disabled = true;
            if (status) status.textContent = '';
            box.hidden = true;
            fetch(form.getAttribute('action'), {
                method: 'POST',
                body: new FormData(form),
                credentials: 'same-origin',
                headers: { 'Accept': 'application/json' }
            }).then(function (response) {
                if (!response.ok) throw new Error('HTTP ' + response.status);
                return response.json();
            }).then(function (result) {
                if (result.status !== 'success') throw new Error(result.message || 'Could not save.');
                if (status) status.textContent = result.title || 'Saved';
                else {
                    box.hidden = false;
                    box.className = 'alert alert-success';
                    box.textContent = result.title || 'Saved';
                }
                if (action !== 'save_translation') {
                    window.location.hash = ['add_translation', 'rename_translation', 'delete_translation'].indexOf(action) !== -1
                        ? 'mod_lm_tab_lang_list_edit' : 'mod_lm_tab_lang_list';
                    window.location.reload();
                }
            }).catch(function (error) {
                box.hidden = false;
                box.className = 'alert alert-danger';
                box.textContent = error.message;
            }).finally(function () {
                delete form.dataset.lmSubmitting;
                button.disabled = false;
            });
        });
    });
}());
