(function () {
    'use strict';
    var tabs = ['#mod_lm_tab_lists', '#mod_lm_tab_lang_list', '#mod_lm_tab_lang_list_edit'];
    if (tabs.indexOf(window.location.hash) !== -1 && window.jQuery &&
        window.jQuery.fn && window.jQuery.fn.tab) {
        window.jQuery('.langs-manager a[href="' + window.location.hash + '"][data-toggle="tab"]').tab('show');
    }
    var box = document.getElementById('lm-message');
    document.querySelectorAll('.langs-manager .lm-action-form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            var button = form.querySelector('button[type="submit"]');
            var status = form.querySelector('.lm-row-status');
            button.disabled = true;
            if (status) status.textContent = '';
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
                if (form.elements.namedItem('action').value !== 'save_translation') window.location.reload();
            }).catch(function (error) {
                box.hidden = false;
                box.className = 'alert alert-danger';
                box.textContent = error.message;
            }).finally(function () {
                button.disabled = false;
            });
        });
    });
}());
