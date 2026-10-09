(function() {
    if (window.zmPbListsBound) return;
    window.zmPbListsBound = true;
    // Clean the submitted data, without disabling inputs or changing their values.
    document.addEventListener('formdata', function(event) {
        var form = event.target;
        if (!form.matches('form.zm-pb-list-controls, form.zm-pb-page-count') || form.method.toLowerCase() !== 'get') return;
        var data = event.formData, names = new Set();
        data.forEach(function(value, name) { names.add(name); });
        names.forEach(function(name) {
            var values = data.getAll(name);
            var filled = values.filter(function(value) { return typeof value !== 'string' || value.trim() !== ''; });
            if (filled.length === values.length) return;
            data.delete(name);
            filled.forEach(function(value) { data.append(name, value); });
        });
    }, true);
    document.addEventListener('change', function(event) {
        var field = event.target, form = field.form;
        if (!form) return;
        if (field.matches('[data-zm-page-count]') || (form.matches('[data-zm-auto-apply="1"]') && field.matches('select,input'))) {
            if (form.requestSubmit) form.requestSubmit(); else form.submit();
        }
    });
})();
