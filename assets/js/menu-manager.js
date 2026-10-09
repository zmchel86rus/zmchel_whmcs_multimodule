(function() {
    'use strict';
    var root = document.querySelector('.zm-pb-menu-manager');
    if (!root) return;
    var dataNode = document.getElementById('zm-pb-menu-editor-data');
    var config = dataNode ? JSON.parse(dataNode.textContent) : { text: {} };
    var text = config.text || {};
    var tree = document.getElementById('zm-pb-menu-tree');
    var cards = {}, counter = 0, pages = {}, initializing = true, dirty = false;
    Object.keys(config.pages || {}).forEach(function(type) {
        config.pages[type].forEach(function(page) { pages[page.id] = page; });
    });
    function node(tag, cls, content) {
        var el = document.createElement(tag); el.className = cls || '';
        if (content !== undefined) el.textContent = content;
        return el;
    }
    function parentKey(card) {
        var parent = card.parentNode.closest('.zm-pb-menu-card');
        return parent ? parent.dataset.key : '';
    }
    function caption(card) {
        return card.querySelector('[data-field="label"]').value || (pages[card.item.page_id] || {}).name || text.missing_page || card.item.url;
    }
    function refresh() {
        Object.keys(cards).forEach(function(key) {
            var card = cards[key], select = card.querySelector('[data-field="parent"]');
            card.querySelector('.zm-pb-menu-caption').textContent = caption(card);
            var selected = parentKey(card); select.replaceChildren();
            var top = node('option', '', text.root); top.value = ''; select.appendChild(top);
            Object.keys(cards).forEach(function(other) {
                if (other === key || card.contains(cards[other])) return;
                var option = node('option', '', caption(cards[other])); option.value = other; select.appendChild(option);
            });
            select.value = selected;
        });
        if (tree) document.getElementById('zm-pb-menu-empty').hidden = tree.children.length > 0;
    }
    function sortable(group) {
        if (!window.Sortable) return;
        new Sortable(group, { group: 'zm-pb-menu', handle: '.zm-pb-menu-handle', animation: 150,
            emptyInsertThreshold: 20, fallbackOnBody: true, swapThreshold: .65,
            onMove: function(event) { return !event.dragged.contains(event.to); },
            onStart: function() { root.classList.add('is-dragging'); },
            onEnd: function() { root.classList.remove('is-dragging'); dirty = true; refresh(); }
        });
    }
    function field(container, name, label, value, options, wide) {
        var wrap = node('label', wide ? 'wide' : '', label);
        var input = node(options ? 'select' : (name === 'description' ? 'textarea' : 'input'), 'form-control');
        input.dataset.field = name;
        if (options) options.forEach(function(option) {
            var opt = node('option', '', option[1]); opt.value = option[0]; input.appendChild(opt);
        });
        input.value = value || ''; wrap.appendChild(input); container.appendChild(wrap); return input;
    }
    function add(item, group) {
        if (!initializing) dirty = true;
        item = Object.assign({ type: 'custom', label: '', url: '', target: '_self', visibility: 'mixed', labels: {} }, item);
        var key = String(item.key || ('new_' + Date.now() + '_' + (++counter)));
        var card = node('li', 'zm-pb-menu-card'); card.dataset.key = key; card.item = item; cards[key] = card;
        var details = node('details'), summary = node('summary');
        var handle = node('span', 'zm-pb-menu-handle', '☰'); handle.setAttribute('aria-hidden', 'true');
        summary.appendChild(handle); summary.appendChild(node('span', 'zm-pb-menu-caption'));
        summary.appendChild(node('small', 'zm-pb-menu-kind', item.type === 'page' ? text.pages : text.custom));
        details.appendChild(summary);
        var fields = node('div', 'zm-pb-menu-fields');
        var label = field(fields, 'label', text.label, item.label, null, true); label.maxLength = 255;
        if (item.type === 'page') label.placeholder = text.automatic_label;
        label.addEventListener('input', refresh);
        var url = field(fields, 'url', text.url, item.type === 'page' && pages[item.page_id] ? pages[item.page_id].url : item.url, null, true);
        url.maxLength = 2048; url.readOnly = item.type === 'page';
        if (item.type === 'custom') {
            var localizeUrl = item.localize_url === false || item.localize_url === 0 || item.localize_url === '0' ? '0' : '1';
            field(fields, 'localize_url', text.localize_url, localizeUrl,
                [['1', text.localize_url_auto], ['0', text.localize_url_off]], true);
        }
        var parent = field(fields, 'parent', text.parent, '', [['', text.root]]);
        parent.onchange = function() {
            var destination = parent.value ? cards[parent.value].group : tree;
            if (card.contains(destination)) return;
            destination.appendChild(card); refresh();
            dirty = true;
        };
        field(fields, 'target', text.target, item.target, [['_self', text.self], ['_blank', text.blank]]);
        field(fields, 'visibility', text.visibility, item.visibility, [['mixed', text.mixed], ['auth', text.auth], ['noauth', text.noauth]]);
        field(fields, 'title', text.title_attr, item.title);
        field(fields, 'classes', text.classes, item.classes);
        field(fields, 'rel', text.rel, item.rel);
        field(fields, 'icon', text.icon, item.icon);
        field(fields, 'description', text.description, item.description, null, true);
        var translations = node('details'); translations.appendChild(node('summary', '', text.translations));
        var languages = node('div', 'zm-pb-menu-translations');
        (config.languages || []).forEach(function(lang) {
            var input = field(languages, 'labels.' + lang, (config.languageLabels || {})[lang] || lang, (item.labels || {})[lang]); input.maxLength = 255;
        });
        translations.appendChild(languages); fields.appendChild(translations); details.appendChild(fields);
        var actions = node('div', 'zm-pb-menu-item-actions');
        function action(label, callback, cls) {
            var button = node('button', cls, label); button.type = 'button'; button.onclick = function() { callback(); dirty = true; refresh(); };
            actions.appendChild(button);
        }
        action(text.up, function() { var previous = card.previousElementSibling; if (previous) card.parentNode.insertBefore(card, previous); });
        action(text.down, function() { var next = card.nextElementSibling; if (next) card.parentNode.insertBefore(next, card); });
        action(text.indent, function() { var previous = card.previousElementSibling; if (previous) previous.group.appendChild(card); });
        action(text.outdent, function() { var ancestor = card.parentNode.closest('.zm-pb-menu-card'); if (ancestor) ancestor.parentNode.insertBefore(card, ancestor.nextSibling); });
        action(text.delete_item, function() {
            if (!window.confirm(text.confirm_item)) return;
            Array.from(card.group.children).forEach(function(child) { card.parentNode.insertBefore(child, card); });
            delete cards[key]; card.remove();
        }, 'delete');
        details.appendChild(actions); card.appendChild(details);
        card.group = node('ul', 'zm-pb-menu-group'); card.appendChild(card.group);
        (group || tree).appendChild(card); sortable(card.group); return card;
    }
    function serialize() {
        var result = [];
        function visit(group, parent) {
            Array.from(group.children).forEach(function(card) {
                var item = { key: card.dataset.key, parent: parent, type: card.item.type, page_id: card.item.page_id || null, labels: {} };
                card.querySelector('.zm-pb-menu-fields').querySelectorAll('[data-field]').forEach(function(input) {
                    var key = input.dataset.field;
                    if (key === 'parent') return;
                    if (key.indexOf('labels.') === 0) item.labels[key.substr(7)] = input.value;
                    else item[key] = input.value;
                });
                result.push(item); visit(card.group, card.dataset.key);
            });
        }
        visit(tree, ''); return result;
    }
    if (tree) {
        sortable(tree);
        (config.items || []).forEach(function(item) { add(item); });
        (config.items || []).forEach(function(item) {
            var card = cards[String(item.key)], parent = cards[String(item.parent)];
            if (parent && !card.contains(parent.group)) parent.group.appendChild(card);
        });
        refresh();
        root.querySelectorAll('.zm-pb-menu-add-pages').forEach(function(button) {
            button.onclick = function() {
                button.closest('.zm-pb-menu-source').querySelectorAll('input[type="checkbox"]:checked').forEach(function(input) {
                    add({ type: 'page', page_id: Number(input.value), label: '', url: pages[input.value].url }); input.checked = false;
                }); refresh();
            };
        });
        document.getElementById('zm-pb-menu-add-custom').onclick = function() {
            var label = document.getElementById('zm-pb-menu-custom-label');
            var url = document.getElementById('zm-pb-menu-custom-url');
            if (!label.value.trim()) { label.focus(); return; }
            var card = add({ label: label.value.trim(), url: url.value.trim() }); card.querySelector('details').open = true;
            label.value = ''; refresh();
        };
        document.getElementById('zm-pb-menu-search').oninput = function(event) {
            var value = event.target.value.toLowerCase();
            root.querySelectorAll('.zm-pb-menu-page').forEach(function(page) { page.hidden = page.dataset.search.toLowerCase().indexOf(value) === -1; });
        };
        document.getElementById('zm-pb-menu-select').onchange = function(event) {
            var target = new URL(window.location.href); target.searchParams.set('menu_id', event.target.value); window.location.assign(target.href);
        };
    }
    initializing = false;
    root.addEventListener('input', function(event) { if (event.target.closest('#zm-pb-menu-editor')) dirty = true; });
    window.addEventListener('beforeunload', function(event) { if (dirty) { event.preventDefault(); event.returnValue = ''; } });
    window.ZmPbMenuManager = {
        serialize: serialize,
        markSaved: function() { dirty = false; }
    };
    var deleteButton = document.getElementById('zm-pb-menu-delete');
    if (deleteButton) deleteButton.addEventListener('click', function(event) {
        if (!window.confirm(text.confirm_delete)) event.preventDefault();
    });
})();
