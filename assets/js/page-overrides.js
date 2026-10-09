(function () {
    const form = document.getElementById('page_overrides_form');
    if (!form) return;

    const container = form.querySelector('[data-page-overrides-rows]');
    const addButton = form.querySelector('.duplicate.add[data-duplicate-target="page_overrides"]');
    const firstSource = container && container.querySelector('[data-override-source]');
    if (!container || !addButton || !firstSource) return;

    const sourceOptions = Array.from(firstSource.options, option => option.cloneNode(true));
    const rows = () => Array.from(container.querySelectorAll('[data-duplicate="page_overrides"]'));

    function updateRequired() {
        rows().forEach(row => {
            const selects = Array.from(row.querySelectorAll('select'));
            const active = selects.some(select => select.value !== '');
            selects.forEach(select => { select.required = active; });
        });
    }

    function updateSources() {
        const used = new Set();

        rows().forEach(row => {
            const source = row.querySelector('[data-override-source]');
            if (source.value && used.has(source.value)) source.value = '';
            if (source.value) used.add(source.value);
        });

        const currentRows = rows();
        currentRows.forEach(row => {
            const source = row.querySelector('[data-override-source]');
            const current = source.value;
            const options = sourceOptions
                .filter(option => !option.value || option.value === current || !used.has(option.value))
                .map(option => {
                    const copy = option.cloneNode(true);
                    copy.selected = false;
                    return copy;
                });
            source.replaceChildren(...options);
            source.value = current;
            row.querySelector('.duplicate.delete').classList.toggle('d-none', currentRows.length === 1);
        });

        addButton.disabled = !sourceOptions.some(option => option.value && !used.has(option.value));
        updateRequired();
    }

    addButton.addEventListener('click', function () {
        if (addButton.disabled) return;
        const row = rows()[0].cloneNode(true);
        row.querySelectorAll('select').forEach(select => { select.value = ''; });
        container.appendChild(row);
        updateSources();
        row.querySelector('[data-override-source]').focus();
    });

    container.addEventListener('click', function (event) {
        const button = event.target.closest('.duplicate.delete[data-duplicate-target="page_overrides"]');
        if (!button || !container.contains(button)) return;
        const row = button.closest('[data-duplicate="page_overrides"]');
        if (rows().length > 1) row.remove();
        else row.querySelectorAll('select').forEach(select => { select.value = ''; });
        updateSources();
    });

    container.addEventListener('change', function (event) {
        if (event.target.matches('[data-override-source]')) updateSources();
        else if (event.target.matches('select')) updateRequired();
    });

    updateSources();
})();
