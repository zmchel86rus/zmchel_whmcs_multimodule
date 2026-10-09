(function() {
    window.ZmPbComponents = window.ZmPbComponents || {};
    var api = window.ZmPbComponents, prefix = 'data-zm-pb-page-';
    var esc = function(value) { return String(value == null ? '' : value).replace(/[&<>"']/g, function(c) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    }); };
    api.paginationTarget = function(editor, id) {
        var result = null;
        var walk = function(component) {
            if (component.getId() === id) result = component;
            component.components().forEach(walk);
        };
        walk(editor.getWrapper());
        return result;
    };
    api.registerPagination = function(editor, t) {
        var scanning = false, timer = null;
        var all = function() {
            var items = [];
            var walk = function(model) { items.push(model); model.components().forEach(walk); };
            walk(editor.getWrapper());
            return items;
        };
        var setAttrs = function(model, values) {
            var current = model.getAttributes(), changed = {};
            Object.keys(values).forEach(function(key) { if (current[key] !== values[key]) changed[key] = values[key]; });
            if (Object.keys(changed).length) model.addAttributes(changed);
        };
        var owner = function(model) {
            for (var p = model.parent(); p; p = p.parent()) if (p.get('type') === 'zm-pagination') return p;
            return null;
        };
        var scan = function() {
            timer = null;
            if (scanning) return;
            scanning = true;
            try {
                var items = all(), pagers = items.filter(function(m) { return m.get('type') === 'zm-pagination'; });
                pagers.forEach(function(pager) {
                    var id = pager.getId(), attrs = pager.getAttributes();
                    var previousId = attrs['data-zm-pb-page-self'];
                    if (previousId && previousId !== id) items.forEach(function(part) {
                        if (owner(part) === pager && part.getAttributes()['data-zm-pb-page-owner'] === previousId) setAttrs(part, { 'data-zm-pb-page-owner': id });
                    });
                    setAttrs(pager, { id: id, 'data-zm-pb-page-layout': '1', 'data-zm-pb-page-self': id });
                    if (prefix + 'count-position' in attrs) pager.removeAttributes(prefix + 'count-position');
                    if (pager.get('tagName') !== 'div') pager.set('tagName', 'div');
                    if (pager.getClasses().indexOf('zm-pb-pagination') >= 0) pager.removeClass('zm-pb-pagination');
                    if (pager.getClasses().indexOf('zm-pb-pagination-layout') < 0) pager.addClass('zm-pb-pagination-layout');
                    var parts = items.filter(function(m) {
                        var bound = m.getAttributes()['data-zm-pb-page-owner'];
                        var exists = pagers.some(function(p) { return p.getId() === bound; });
                        return ['zm-pagination-buttons', 'zm-pagination-count'].indexOf(m.get('type')) >= 0 &&
                            (exists ? bound === id : owner(m) === pager);
                    });
                    if (!parts.some(function(m) { return m.get('type') === 'zm-pagination-buttons'; })) {
                        parts.push(pager.append({ type: 'zm-pagination-buttons' }, { at: 0 })[0]);
                    }
                    if (attrs[prefix + 'count-select'] === '1') {
                        if (!parts.some(function(m) { return m.get('type') === 'zm-pagination-count'; })) {
                            parts.push(pager.append({ type: 'zm-pagination-count' })[0]);
                        }
                    } else {
                        parts = parts.filter(function(m) {
                            if (m.get('type') !== 'zm-pagination-count') return true;
                            m.remove();
                            return false;
                        });
                    }
                    parts.forEach(function(part) {
                        var values = { 'data-zm-pb-page-owner': id };
                        ['count', 'size', 'show-status', 'desktop-start', 'desktop-middle', 'desktop-end', 'mobile-start', 'mobile-middle', 'mobile-end'].forEach(function(key) {
                            values[prefix + key] = attrs[prefix + key] || '';
                        });
                        setAttrs(part, values);
                    });
                });
                // A moved control stays bound to its original pager. Removing the pager removes its controls.
                all().forEach(function(part) {
                    if (['zm-pagination-count', 'zm-pagination-buttons'].indexOf(part.get('type')) < 0 || owner(part)) return;
                    var id = part.getAttributes()['data-zm-pb-page-owner'];
                    if (!pagers.some(function(p) { return p.getId() === id; })) part.remove();
                });
            } finally { scanning = false; }
        };
        var schedule = function() {
            if (!scanning && timer === null) timer = setTimeout(scan, 0);
        };
        editor.zmSyncPaginationParts = schedule;
        editor.on('load component:add component:remove component:clone undo redo', schedule);
        var placeholderHtml = function() {
            var attrs = Object.assign({}, this.getAttributes(), { id: this.getId() });
            attrs.class = this.getClasses().join(' ');
            var style = this.getStyle();
            if (Object.keys(style).length) attrs.style = Object.keys(style).map(function(key) { return key + ':' + style[key]; }).join(';');
            return '<div' + Object.keys(attrs).map(function(key) { return ' ' + key + '="' + esc(attrs[key]) + '"'; }).join('') + '></div>';
        };
        editor.DomComponents.addType('zm-pagination-count', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-page-count-control'); },
            model: {
                defaults: { tagName: 'div', name: t('pagination_count_select'), editable: false, droppable: false,
                    draggable: true, copyable: false, removable: false, components: [],
                    attributes: { class: 'zm-pb-page-count-block', 'data-zm-pb-page-count-control': '1' } },
                toHTML: placeholderHtml
            },
            view: {
                init: function() { this.listenTo(this.model, 'change:attributes', this.onRender); },
                onRender: function() {
                    var attrs = this.model.getAttributes();
                    this.el.setAttribute('data-page-size', attrs[prefix + 'size'] || 'standard');
                    this.el.innerHTML = '<div class="zm-pb-page-count"><label>' + esc(t('pagination_count_select')) +
                        '<select disabled><option>' + esc(attrs[prefix + 'count'] || '100') + '</option></select></label></div>';
                }
            }
        });
        editor.DomComponents.addType('zm-pagination-buttons', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-page-buttons'); },
            model: {
                defaults: { tagName: 'div', name: t('pagination'), editable: false, droppable: false,
                    draggable: '[data-zm-pb-pagination]', copyable: false, removable: false, components: [],
                    attributes: { class: 'zm-pb-pagination-buttons', 'data-zm-pb-page-buttons': '1' } },
                toHTML: placeholderHtml
            },
            view: {
                init: function() { this.listenTo(this.model, 'change:attributes', this.onRender); },
                onRender: function() {
                    var attrs = this.model.getAttributes(), output = '';
                    ['desktop', 'mobile'].forEach(function(device) {
                        var pages = { 8: true }, last = 0;
                        var number = function(key) { return Math.max(0, Math.min(10, parseInt(attrs[prefix + device + '-' + key], 10) || 0)); };
                        for (var i = 1; i <= number('start'); i++) pages[i] = true;
                        for (var j = 21 - number('end'); j <= 20; j++) pages[j] = true;
                        for (var k = Math.max(1, 8 - number('middle')); k <= Math.min(20, 8 + number('middle')); k++) pages[k] = true;
                        output += '<ul class="zm-pb-pagination-' + device + '"><li><span>‹</span></li>';
                        Object.keys(pages).map(Number).sort(function(a,b) { return a-b; }).forEach(function(page) {
                            if (last && page > last + 1) output += '<li class="zm-pb-pagination-gap">…</li>';
                            output += '<li><span' + (page === 8 ? ' aria-current="page"' : '') + '>' + page + '</span></li>';
                            last = page;
                        });
                        output += '<li><span>›</span></li></ul>';
                    });
                    if (attrs[prefix + 'show-status'] === '1') output += '<span class="zm-pb-page-status">' + esc(t('pagination_status_preview')) + '</span>';
                    this.el.innerHTML = '<nav class="zm-pb-pagination zm-pb-pagination-size-' + esc(attrs[prefix + 'size'] || 'standard') + '">' + output + '</nav>';
                }
            }
        });
        editor.DomComponents.addType('zm-pagination', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-pagination'); },
            model: {
                defaults: { tagName: 'div', name: t('pagination'), editable: false, droppable: true,
                    components: [{ type: 'zm-pagination-buttons' }],
                    attributes: { class: 'zm-pb-pagination-layout', 'data-zm-pb-pagination': '1', 'data-zm-pb-page-layout': '1',
                        'data-zm-pb-page-label': t('pagination'), 'data-zm-pb-page-target': '', 'data-zm-pb-page-variable': '',
                        'data-zm-pb-page-count': '100', 'data-zm-pb-page-duplicate': '0', 'data-zm-pb-page-url-mode': 'auto',
                        'data-zm-pb-page-count-select': '0', 'data-zm-pb-page-size': 'standard', 'data-zm-pb-page-noindex': '0',
                        'data-zm-pb-page-show-status': '0',
                        'data-zm-pb-page-desktop-start': '2', 'data-zm-pb-page-desktop-end': '2', 'data-zm-pb-page-desktop-middle': '2',
                        'data-zm-pb-page-mobile-start': '1', 'data-zm-pb-page-mobile-end': '1', 'data-zm-pb-page-mobile-middle': '1' } },
                init: function() { this.on('change:attributes', schedule); schedule(); }
            }
        });
        editor.on('component:selected', function(selected) {
            var pager = editor.zmPaginationPick;
            if (pager && ['zm-search', 'zm-filters'].indexOf(pager.get('type')) >= 0 && selected && selected.get('type') !== 'zm-smarty') return;
            if (!pager || !selected || selected === pager || selected === editor.getWrapper() || ['zm-pagination', 'zm-pagination-buttons', 'zm-pagination-count', 'zm-search', 'zm-filters'].indexOf(selected.get('type')) >= 0) return;
            for (var parent = pager.parent(); parent; parent = parent.parent()) if (parent === selected) return;
            for (var ancestor = selected.parent(); ancestor; ancestor = ancestor.parent()) if (ancestor === pager) return;
            selected.addAttributes({ id: selected.getId() });
            pager.addAttributes({ 'data-zm-pb-page-target': selected.getId() });
            editor.zmPaginationPick = null;
            setTimeout(function() { if (pager.parent()) editor.select(pager); }, 0);
        });
        editor.on('canvas:frame:load', function() {
            editor.Canvas.getDocument().addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && editor.zmPaginationPick) {
                    var pager = editor.zmPaginationPick; editor.zmPaginationPick = null; editor.select(pager);
                }
            });
        });
    };
    api.applyPaginationControls = function(component, panel) {
        var attrs = {};
        panel.querySelectorAll('[data-zm-pagination-field]').forEach(function(field) {
            attrs[prefix + field.getAttribute('data-zm-pagination-field')] = field.type === 'checkbox' ? (field.checked ? '1' : '0') : field.value;
        });
        component.addAttributes(attrs);
    };
    api.renderPaginationControls = function(component, editor, t) {
        var attrs = component.getAttributes();
        var field = function(key, label, type, min, max) {
            return '<label class="zm-pb-field"><span>' + esc(t(label)) + '</span><input data-zm-control="pagination-' + key + '" data-zm-pagination-field="' + key + '" type="' + type + '"' +
                (type === 'number' ? ' min="' + min + '" max="' + max + '"' : '') + ' value="' + esc(attrs[prefix + key] || (type === 'number' ? '0' : '')) + '"></label>';
        };
        var target = api.paginationTarget(editor, attrs[prefix + 'target']);
        var html = '<div class="zm-pb-field-wide"><strong>' + esc(t('pagination_target')) + ': </strong>' +
            esc(target ? (target.getName() + ' · #' + target.getId()) : t('pagination_target_missing')) + '</div>';
        html += '<div class="zm-pb-controls-actions"><button type="button" data-zm-command="pagination-pick">' + esc(t(editor.zmPaginationPick ? 'pagination_cancel' : 'pagination_pick')) + '</button></div>';
        if (editor.zmPaginationPick) html += '<p class="zm-pb-controls-hint" role="status">' + esc(t('pagination_pick_hint')) + '</p>';
        html += field('variable', 'pagination_variable', 'text') + field('count', 'pagination_count', 'number', 10, 250) + field('selector', 'pagination_selector', 'text');
        html += '<label class="zm-pb-field"><span>' + esc(t('pagination_url_mode')) + '</span><select data-zm-control="pagination-url-mode" data-zm-pagination-field="url-mode">';
        [['auto', t('pagination_url_auto')], ['path', '/page/2/'], ['query', '?page=2']].forEach(function(option) {
            html += '<option value="' + option[0] + '"' + ((attrs[prefix + 'url-mode'] || 'auto') === option[0] ? ' selected' : '') + '>' + esc(option[1]) + '</option>';
        });
        html += '</select></label>';
        html += '<label class="zm-pb-field"><span>' + esc(t('list_size')) + '</span><select data-zm-control="pagination-size" data-zm-pagination-field="size">';
        ['small', 'standard', 'large'].forEach(function(size) { html += '<option value="' + size + '"' + ((attrs[prefix + 'size'] || 'standard') === size ? ' selected' : '') + '>' + esc(t('size_' + size)) + '</option>'; });
        html += '</select></label>';
        ['count-select', 'show-status', 'noindex'].forEach(function(key) { html += '<label class="zm-pb-check"><input type="checkbox" data-zm-control="pagination-' + key + '" data-zm-pagination-field="' + key + '"' + (attrs[prefix + key] === '1' ? ' checked' : '') + '> ' + esc(t('pagination_' + key.replace(/-/g, '_'))) + '</label>'; });
        ['desktop', 'mobile'].forEach(function(device) {
            html += '<fieldset class="zm-pb-field-wide"><legend>' + esc(t('pagination_' + device)) + '</legend><div class="zm-pb-fields-row">';
            ['start', 'middle', 'end'].forEach(function(part) { html += field(device + '-' + part, 'pagination_' + part, 'number', 0, 10); });
            html += '</div></fieldset>';
        });
        html += '<label class="zm-pb-check"><input type="checkbox" data-zm-control="pagination-duplicate" data-zm-pagination-field="duplicate"' +
            (attrs[prefix + 'duplicate'] === '1' ? ' checked' : '') + '> ' + esc(t('pagination_duplicate')) + '</label>';
        return html + '<p class="zm-pb-controls-hint">' + esc(t('pagination_count_move_hint')) + '</p><p class="zm-pb-controls-hint">' + esc(t('pagination_hint')) + '</p>';
    };
})();
