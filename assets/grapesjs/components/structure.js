(function() {
    window.ZmPbComponents = window.ZmPbComponents || {};
    var api = window.ZmPbComponents;
    var cell = function(text, header) {
        return { type: 'text', tagName: header ? 'th' : 'td', components: text };
    };
    var row = function(text, columns, header) {
        var cells = [];
        for (var i = 0; i < columns; i++) cells.push(cell(text, header));
        return { tagName: 'tr', components: cells };
    };
    var part = function(tag, text, columns) {
        return { tagName: tag, components: [row(text, columns, tag === 'thead')] };
    };

    api.list = function(text) {
        return { type: 'zm-list', tagName: 'ul', attributes: { 'data-zm-pb-list': '1' },
            components: [{ type: 'text', tagName: 'li', components: text },
                { type: 'text', tagName: 'li', components: text }] };
    };
    api.table = function(text) {
        return { type: 'zm-table', tagName: 'table', attributes: { class: 'zm-pb-table', 'data-zm-pb-table': '1' },
            components: [part('tbody', text, 2)] };
    };

    api.registerStructure = function(editor, t) {
        editor.DomComponents.addType('zm-list', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-list'); },
            model: { defaults: { tagName: 'ul', name: t('list'),
                attributes: { 'data-zm-pb-list': '1' }, droppable: 'li' } }
        });
        editor.DomComponents.addType('zm-table', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-table'); },
            model: { defaults: { tagName: 'table', name: t('table'),
                attributes: { class: 'zm-pb-table', 'data-zm-pb-table': '1' }, droppable: false } }
        });
    };

    api.listAdd = function(list, text) {
        var item = list.append({ type: 'text', tagName: 'li', components: text })[0];
        return item;
    };
    api.listRemove = function(list) {
        if (list.components().length > 1) list.components().last().remove();
    };
    api.tableParts = function(table) {
        var result = {};
        table.components().forEach(function(item) { result[item.get('tagName')] = item; });
        return result;
    };
    api.tableSize = function(table) {
        var body = api.tableParts(table).tbody;
        return { rows: body ? body.components().length : 0,
            columns: body && body.components().length ? body.components().at(0).components().length : 0 };
    };
    api.setTable = function(table, settings, text) {
        var parts = api.tableParts(table);
        var rows = Math.min(30, Math.max(1, parseInt(settings.rows, 10) || 1));
        var columns = Math.min(12, Math.max(1, parseInt(settings.columns, 10) || 1));
        if (!parts.tbody) parts.tbody = table.append(part('tbody', text, columns))[0];
        ['thead', 'tfoot'].forEach(function(name) {
            if (settings[name] && !parts[name]) {
                parts[name] = table.append(part(name, text, columns), { at: name === 'thead' ? 0 : undefined })[0];
            } else if (!settings[name] && parts[name]) parts[name].remove();
        });
        var bodyRows = parts.tbody.components();
        while (bodyRows.length < rows) parts.tbody.append(row(text, columns, false));
        while (bodyRows.length > rows) bodyRows.last().remove();
        api.tableParts(table).tbody.components().forEach(function(r) {
            while (r.components().length < columns) r.append(cell(text, false));
            while (r.components().length > columns) r.components().last().remove();
        });
        ['thead', 'tfoot'].forEach(function(name) {
            var section = api.tableParts(table)[name];
            if (!section) return;
            var r = section.components().at(0);
            while (r.components().length < columns) r.append(cell(text, name === 'thead'));
            while (r.components().length > columns) r.components().last().remove();
        });
    };
    api.insertTableRow = function(table, selected, text) {
        var body = api.tableParts(table).tbody;
        var count = api.tableSize(table);
        if (!body || count.rows >= 30) return;
        var current = selected;
        while (current && current !== body && current.get('tagName') !== 'tr') current = current.parent();
        var at = current && current.parent() === body ? body.components().indexOf(current) + 1 : count.rows;
        body.append(row(text, count.columns, false), { at: at });
    };
    api.insertTableColumn = function(table, selected, text) {
        var size = api.tableSize(table);
        if (size.columns >= 12) return;
        var current = selected;
        while (current && current !== table && ['td', 'th'].indexOf(current.get('tagName')) < 0) current = current.parent();
        var at = current && current !== table ? current.parent().components().indexOf(current) + 1 : size.columns;
        var parts = api.tableParts(table);
        ['thead', 'tbody', 'tfoot'].forEach(function(name) {
            if (!parts[name]) return;
            parts[name].components().forEach(function(r) {
                r.append(cell(text, name === 'thead'), { at: at });
            });
        });
    };
})();
