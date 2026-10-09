(function() {
    window.ZmPbComponents = window.ZmPbComponents || {};
    var api = window.ZmPbComponents;

    api.cell = function(text) {
        return { type: 'zm-layout-cell', tagName: 'div', attributes: { class: 'zm-pb-layout-cell', 'data-zm-pb-layout-cell': '1' }, droppable: true,
            components: [{ type: 'text', tagName: 'p', components: text }] };
    };

    var isCell = function(component) {
        var attrs = component.getAttributes();
        return attrs['data-zm-pb-layout-cell'] === '1' || (' ' + (attrs.class || '') + ' ').indexOf(' zm-pb-layout-cell ') >= 0;
    };

    var markSidebar = function(component) { component.addAttributes({ 'data-zm-pb-sidebar-cell': '1' }); };

    var bounded = function(value, min, max, fallback) {
        var parsed = parseInt(value, 10);
        return Math.min(max, Math.max(min, isNaN(parsed) ? fallback : parsed));
    };
    api.layoutCell = function(component, layout) {
        while (component && component.parent() !== layout) component = component.parent();
        return component && isCell(component) ? component : null;
    };
    api.setLayoutCell = function(cell, values) {
        if (!cell) return;
        var layout = cell.parent();
        var columns = layout ? bounded(layout.getAttributes()['data-zm-pb-columns'], 1, 12, 12) : 12;
        cell.addAttributes({ 'data-zm-pb-colspan': String(bounded(values.colspan, 1, columns, 1)),
            'data-zm-pb-rowspan': String(bounded(values.rowspan, 1, 12, 1)),
            'data-zm-pb-width': String(bounded(values.width, 0, 100, 0)),
            'data-zm-pb-width-tablet': String(bounded(values.tabletWidth, 0, 100, 0)),
            'data-zm-pb-width-mobile': String(bounded(values.mobileWidth, 0, 100, 0)) });
        api.applyLayoutCell.call(cell);
    };
    api.mergeLayoutCell = function(layout, cell) {
        if (!cell) return false;
        var cells = layout.components().models;
        var index = cells.indexOf(cell);
        var next = cells[index + 1];
        if (!next || !isCell(next)) return false;
        var attrs = layout.getAttributes();
        var count = bounded(attrs['data-zm-pb-columns'], 1, 12, 1);
        var a = cell.getAttributes(), b = next.getAttributes();
        var span = bounded(a['data-zm-pb-colspan'], 1, count, 1) + bounded(b['data-zm-pb-colspan'], 1, count, 1);
        var usedWidth = 0, automatic = 0;
        cells.forEach(function(item) {
            var width = bounded(item.getAttributes()['data-zm-pb-width'], 0, 100, 0);
            if (width) usedWidth += width; else automatic++;
        });
        var autoWidth = automatic ? Math.max(0, 100 - usedWidth) / automatic : 100 / count;
        if (attrs['data-zm-pb-layout'] !== 'flex') {
            // Only merge adjacent cells on the same grid row; never silently rearrange other cells.
            var occupied = 0;
            for (var i = 0; i < index; i++) {
                var previous = cells[i].getAttributes();
                if (bounded(previous['data-zm-pb-rowspan'], 1, 12, 1) !== 1) return false;
                var size = bounded(previous['data-zm-pb-colspan'], 1, count, 1);
                if (occupied % count + size > count) occupied += count - occupied % count;
                occupied += size;
            }
            if (occupied % count + span > count || bounded(a['data-zm-pb-rowspan'], 1, 12, 1) !== 1 || bounded(b['data-zm-pb-rowspan'], 1, 12, 1) !== 1) return false;
        }
        layout._zmLayoutUpdating = true;
        try {
            next.components().models.slice().forEach(function(child) { child.move(cell); });
            cell.addAttributes(attrs['data-zm-pb-layout'] === 'flex'
                ? { 'data-zm-pb-width': String(Math.min(100, (parseInt(a['data-zm-pb-width'], 10) || autoWidth) + (parseInt(b['data-zm-pb-width'], 10) || autoWidth))) }
                : { 'data-zm-pb-colspan': String(span) });
            next.remove();
            if (attrs['data-zm-pb-layout'] === 'flex') layout.addAttributes({ 'data-zm-pb-columns': String(layout.components().length) });
        } finally { layout._zmLayoutUpdating = false; }
        return true;
    };

    api.layout = function(text, kind, count, side) {
        var cells = [];
        for (var i = 0; i < count + (side && side !== 'none' ? 1 : 0); i++) cells.push(api.cell(text));
        if (side === 'left') cells[0].attributes['data-zm-pb-sidebar-cell'] = '1';
        if (side === 'right') cells[cells.length - 1].attributes['data-zm-pb-sidebar-cell'] = '1';
        return { type: 'zm-layout', tagName: 'section',
            attributes: { class: 'zm-pb-section zm-pb-layout', 'data-zm-pb-layout': kind || 'columns',
                'data-zm-pb-columns': String(count), 'data-zm-pb-rows': '1', 'data-zm-pb-sidebar': side || 'none',
                'data-zm-pb-direction': 'row', 'data-zm-pb-wrap': 'wrap', 'data-zm-pb-gap': '16' },
            components: cells };
    };

    api.registerLayout = function(editor, t) {
        editor.DomComponents.addType('zm-layout-cell', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-layout-cell'); },
            model: { defaults: { name: t('layout_cell'), tagName: 'div', droppable: true,
                attributes: { class: 'zm-pb-layout-cell', 'data-zm-pb-layout-cell': '1' } },
                init: function() { this.on('change:attributes', this.applyCell); this.applyCell(); },
                applyCell: api.applyLayoutCell = function() {
                    var a = this.getAttributes(), style = {};
                    var layout = this.parent(), parentAttrs = layout ? layout.getAttributes() : {};
                    var columns = bounded(parentAttrs['data-zm-pb-columns'], 1, 12, 12);
                    var span = bounded(a['data-zm-pb-colspan'], 1, columns, 1);
                    style['--zm-pb-colspan'] = span;
                    style['--zm-pb-colspan-tablet'] = Math.min(span, bounded(parentAttrs['data-zm-pb-tablet-columns'], 1, 12, Math.min(2, columns)));
                    style['--zm-pb-colspan-mobile'] = Math.min(span, bounded(parentAttrs['data-zm-pb-mobile-columns'], 1, 12, 1));
                    style['--zm-pb-rowspan'] = bounded(a['data-zm-pb-rowspan'], 1, 12, 1);
                    ['', '-tablet', '-mobile'].forEach(function(device) {
                        var width = bounded(a['data-zm-pb-width' + device], 0, 100, 0);
                        style['--zm-pb-basis' + device] = width ? 'calc(' + width + '% - var(--zm-pb-gap) * ' + (1 - width / 100) + ')' : 'var(--zm-pb-default-basis)';
                        style['--zm-pb-grow' + device] = width ? '0' : '1';
                        style['--zm-pb-width' + device] = width ? width + '%' : '100%';
                    });
                    this.addStyle(style);
                }
            }
        });
        editor.DomComponents.addType('zm-layout', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-layout'); },
            model: { defaults: { tagName: 'section', name: t('section'), droppable: false,
                attributes: { class: 'zm-pb-section zm-pb-layout', 'data-zm-pb-layout': 'columns',
                'data-zm-pb-columns': '1', 'data-zm-pb-rows': '1', 'data-zm-pb-sidebar': 'none',
                    'data-zm-pb-direction': 'row', 'data-zm-pb-wrap': 'wrap', 'data-zm-pb-gap': '16' } },
                init: function() {
                    this.on('change:attributes', this.applyLayout);
                    this.listenTo(this.components(), 'add remove', this.reconcileCells);
                    this.listenTo(this.components(), 'add', this.watchCell);
                    this.components().forEach(this.watchCell.bind(this));
                    this.applyLayout();
                },
                watchCell: function(cell) {
                    if (!isCell(cell)) return;
                    // Saved projects may have generic div cells; handle their attributes too.
                    this.listenTo(cell, 'change:attributes', function() { api.applyLayoutCell.call(cell); this.applyLayout(); });
                    api.applyLayoutCell.call(cell);
                },
                reconcileCells: function(changed) {
                    if (this._zmLayoutUpdating || (changed && !isCell(changed))) return;
                    var cells = this.components().filter(isCell);
                    if (!cells.length) {
                        this._zmLayoutUpdating = true;
                        this.append(api.cell(t('text')));
                        this._zmLayoutUpdating = false;
                        cells = this.components().filter(isCell);
                    }
                    var attrs = this.getAttributes();
                    var kind = attrs['data-zm-pb-layout'] || 'columns';
                    var columns = parseInt(attrs['data-zm-pb-columns'], 10) || 1;
                    var rows = parseInt(attrs['data-zm-pb-rows'], 10) || 1;
                    var sidebar = 'none';
                    if (kind === 'columns') {
                        var sidebarCell = cells.filter(function(cell) { return cell.getAttributes()['data-zm-pb-sidebar-cell'] === '1'; })[0];
                        if (sidebarCell) sidebar = cells[0] === sidebarCell ? 'left' : 'right';
                        columns = Math.max(1, cells.length - (sidebarCell ? 1 : 0));
                    } else if (kind === 'flex') columns = cells.length;
                    else {
                        rows = Math.max(1, Math.ceil(cells.reduce(function(total, cell) {
                            var a = cell.getAttributes();
                            return total + bounded(a['data-zm-pb-colspan'], 1, columns, 1) * bounded(a['data-zm-pb-rowspan'], 1, 12, 1);
                        }, 0) / columns));
                    }
                    this.addAttributes({ 'data-zm-pb-columns': String(columns), 'data-zm-pb-rows': String(rows), 'data-zm-pb-sidebar': sidebar });
                },
                applyLayout: function() {
                    var a = this.getAttributes();
                    var kind = a['data-zm-pb-layout'] || 'columns';
                    var count = Math.min(12, Math.max(1, parseInt(a['data-zm-pb-columns'], 10) || 1));
                    var gap = Math.min(100, Math.max(0, parseInt(a['data-zm-pb-gap'], 10) || 0));
                    var side = a['data-zm-pb-sidebar'] || 'none';
                    var direction = a['data-zm-pb-direction'] || 'row';
                    var style = { display: kind === 'flex' ? 'flex' : 'grid', gap: gap + 'px' };
                    style['--zm-pb-gap'] = gap + 'px';
                    style['--zm-pb-desktop-columns'] = count;
                    style['--zm-pb-tablet-columns'] = bounded(a['data-zm-pb-tablet-columns'], 1, 12, Math.min(2, count));
                    style['--zm-pb-mobile-columns'] = bounded(a['data-zm-pb-mobile-columns'], 1, 12, 1);
                    if (kind === 'flex') {
                        var automatic = 0, usedWidth = 0;
                        this.components().forEach(function(cell) {
                            var width = bounded(cell.getAttributes()['data-zm-pb-width'], 0, 100, 0);
                            if (width) usedWidth += width; else automatic++;
                        });
                        var share = automatic ? Math.max(0, 100 - usedWidth) / automatic : 100 / count;
                        style['--zm-pb-default-desktop-basis'] = 'calc(' + share + '% - var(--zm-pb-gap) * ' + (1 - share / 100) + ')';
                        style['flex-direction'] = direction;
                        style['flex-wrap'] = a['data-zm-pb-wrap'] || 'wrap';
                        style['grid-template-columns'] = '';
                        style['grid-template-rows'] = '';
                    } else {
                        var tracks = Array(count).fill('minmax(0, 1fr)');
                        if (kind === 'columns' && side !== 'none') {
                            if (side === 'left') tracks.unshift('minmax(160px, .45fr)');
                            else tracks.push('minmax(160px, .45fr)');
                        }
                        style['grid-template-columns'] = tracks.join(' ');
                        style['--zm-pb-desktop-tracks'] = tracks.join(' ');
                        style['grid-template-rows'] = '';
                        style['flex-direction'] = '';
                        style['flex-wrap'] = '';
                    }
                    this.addStyle(style);
                    this.set('name', t(kind === 'flex' ? 'flex' : kind === 'grid' ? 'grid' : 'section'));
                    this.components().filter(isCell).forEach(function(cell) { api.applyLayoutCell.call(cell); });
                }
            }
        });
    };

    api.setLayout = function(component, values, text) {
        var attrs = component.getAttributes();
        var kind = values.kind || attrs['data-zm-pb-layout'] || 'columns';
        var columns = Math.min(kind === 'columns' ? 4 : 12, Math.max(1, parseInt(values.columns, 10) || 1));
        var rows = Math.min(12, Math.max(1, parseInt(values.rows, 10) || 1));
        var side = kind === 'columns' ? (values.sidebar || 'none') : 'none';
        var oldSide = attrs['data-zm-pb-layout'] === 'columns' ? (attrs['data-zm-pb-sidebar'] || 'none') : 'none';
        var cells = component.components();
        component._zmLayoutUpdating = true;
        if (oldSide === 'none' && side === 'left') markSidebar(component.append(api.cell(text), { at: 0 })[0]);
        else if (oldSide === 'none' && side === 'right') markSidebar(component.append(api.cell(text))[0]);
        else if (oldSide !== 'none' && side === 'none' && cells.length > 1) {
            var sidebar = oldSide === 'left' ? cells.at(0) : cells.last();
            var targetCell = oldSide === 'left' ? cells.at(1) : cells.at(cells.length - 2);
            sidebar.components().models.slice().forEach(function(child) { targetCell.append(child); });
            sidebar.remove();
        } else if (oldSide === 'left' && side === 'right') component.append(cells.at(0));
        else if (oldSide === 'right' && side === 'left') component.append(cells.last(), { at: 0 });
        var count = kind === 'grid' ? columns * rows : columns + (side !== 'none' ? 1 : 0);
        var resize = kind !== attrs['data-zm-pb-layout'] || columns !== parseInt(attrs['data-zm-pb-columns'], 10) ||
            (kind === 'grid' && rows !== parseInt(attrs['data-zm-pb-rows'], 10)) || side !== oldSide;
        if (resize) cells.forEach(function(cell) { cell.removeAttributes(['data-zm-pb-colspan', 'data-zm-pb-rowspan']); });
        while (resize && cells.length < count) component.append(api.cell(text), side === 'right' ? { at: cells.length - 1 } : {});
        while (resize && cells.length > count) {
            var last = cells.at(side === 'right' ? cells.length - 2 : cells.length - 1);
            var target = cells.at(side === 'right' ? count - 2 : count - 1);
            last.components().models.slice().forEach(function(child) { target.append(child); });
            last.remove();
        }
        component.addAttributes({ 'data-zm-pb-layout': kind,
            'data-zm-pb-columns': String(columns), 'data-zm-pb-rows': String(rows), 'data-zm-pb-sidebar': side,
            'data-zm-pb-direction': values.direction || 'row', 'data-zm-pb-wrap': values.wrap || 'wrap',
            'data-zm-pb-gap': String(values.gap),
            'data-zm-pb-tablet-columns': String(bounded(values.tabletColumns, 1, 12, Math.min(2, columns))),
            'data-zm-pb-mobile-columns': String(bounded(values.mobileColumns, 1, 12, 1)) });
        component._zmLayoutUpdating = false;
        component.applyLayout();
    };
})();
