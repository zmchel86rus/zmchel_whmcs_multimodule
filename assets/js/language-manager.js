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
    var importReportKey = 'zm_pb_lm_import_report:' + window.location.pathname + window.location.search;
    if (box) {
        try {
            var pendingReport = window.sessionStorage.getItem(importReportKey);
            if (pendingReport) {
                window.sessionStorage.removeItem(importReportKey);
                var report = JSON.parse(pendingReport);
                box.hidden = false;
                box.className = report.partial ? 'alert alert-warning' : 'alert alert-success';
                box.style.whiteSpace = 'pre-line';
                box.textContent = report.text;
            }
        } catch (error) { /* Storage may be unavailable in private browsing. */ }
    }
    document.querySelectorAll('.langs-manager .lm-filename-select').forEach(function (select) {
        select.addEventListener('change', function () {
            var option = select.options[select.selectedIndex];
            select.form.querySelector('.lm-filename-target').textContent = option.dataset.target + '.php';
        });
    });
    document.querySelectorAll('.langs-manager .lm-action-form').forEach(function (form) {
        if (form.dataset.lmBound) return;
        form.dataset.lmBound = '1';
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            if (form.dataset.lmSubmitting) return;
            var action = form.elements.namedItem('action').value;
            var button = form.querySelector('button[type="submit"]');
            if (action === 'delete_translation' && !window.confirm(button.textContent.trim() + '?')) return;
            if (action === 'fix_language_filename') {
                var selected = form.elements.namedItem('language');
                var target = selected.options[selected.selectedIndex].dataset.target;
                if (!window.confirm(button.textContent.trim() + ': ' + selected.value + '.php → ' + target + '.php?')) return;
            }
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
                if (result.download) {
                    var file = new Blob([result.download.content], { type: 'application/json;charset=utf-8' });
                    var link = document.createElement('a');
                    link.href = URL.createObjectURL(file);
                    link.download = result.download.filename;
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                    setTimeout(function () { URL.revokeObjectURL(link.href); }, 1000);
                }
                if (status) status.textContent = result.title || 'Saved';
                else {
                    box.hidden = false;
                    box.className = result.message ? 'alert alert-warning' : 'alert alert-success';
                    box.style.whiteSpace = 'pre-line';
                    box.textContent = (result.title || 'Saved') + (result.message ? '\n' + result.message : '');
                }
                if (action !== 'save_translation' && action !== 'export_translations') {
                    if (action === 'import_translations') {
                        try {
                            window.sessionStorage.setItem(importReportKey, JSON.stringify({
                                text: (result.title || 'Saved') + (result.message ? '\n' + result.message : ''),
                                partial: Boolean(result.message)
                            }));
                        } catch (error) { return; }
                    }
                    window.location.hash = action === 'fix_language_filename' ? 'mod_lm_tab_lists'
                        : ['add_translation', 'rename_translation', 'delete_translation', 'import_translations'].indexOf(action) !== -1
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
