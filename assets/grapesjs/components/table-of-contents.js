(function() {
    window.ZmPbComponents = window.ZmPbComponents || {};
    var api = window.ZmPbComponents;
    var esc = function(value) { return String(value == null ? '' : value).replace(/[&<>"']/g, function(c) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    }); };
    api.registerTableOfContents = function(editor, t) {
        var views = new Set(), timer;
        var refresh = function() {
            clearTimeout(timer);
            timer = setTimeout(function() {
                views.forEach(function(view) {
                    if (!view.model.parent()) views.delete(view);
                    else view.renderContents();
                });
            }, 60);
        };
        editor.on('load component:add component:remove component:update component:mount undo redo', refresh);
        editor.on('destroy', function() { clearTimeout(timer); views.clear(); });
        editor.DomComponents.addType('zm-toc', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-toc'); },
            model: { defaults: { tagName: 'nav', name: t('table_of_contents'), components: [], editable: false, droppable: false,
                attributes: { class: 'zm-pb-toc', 'data-zm-pb-toc': '1', 'data-zm-pb-toc-title': t('table_of_contents'),
                    'data-zm-pb-toc-min': '1', 'data-zm-pb-toc-max': '6', 'data-zm-pb-toc-nested': '1',
                    'data-zm-pb-toc-numbered': '0', 'data-zm-pb-toc-smooth': '1', 'data-zm-pb-toc-offset': '96' } },
                toHTML: function() {
                    var attrs = Object.assign({}, this.getAttributes(), { id: this.getId() });
                    return '<nav' + Object.keys(attrs).map(function(key) { return ' ' + key + '="' + esc(attrs[key]) + '"'; }).join('') + '></nav>';
                }
            },
            view: {
                onRender: function() {
                    views.add(this);
                    if (!this.contentsClickBound) {
                        this.contentsClickBound = true;
                        var view = this;
                        this.el.addEventListener('click', function(event) {
                            var link = event.target.closest && event.target.closest('a[data-zm-toc-target]');
                            if (!link) return;
                            event.preventDefault(); event.stopPropagation();
                            var target = view.targets[Number(link.getAttribute('data-zm-toc-target'))];
                            if (!target) return;
                            for (var parent = target.parentElement; parent; parent = parent.parentElement) {
                                if (parent.tagName === 'DETAILS') {
                                    var element = parent;
                                    editor.getWrapper().find('details').forEach(function(component) {
                                        if (component.getEl() === element) component.addAttributes({ open: 'open' });
                                    });
                                }
                            }
                            target.scrollIntoView({ block: 'center' });
                        });
                    }
                    this.renderContents(); refresh();
                },
                renderContents: function() {
                    var root = editor.getWrapper().getEl();
                    if (!root) return;
                    var attrs = this.model.getAttributes(), view = this;
                    var minimum = Math.max(1, Math.min(6, parseInt(attrs['data-zm-pb-toc-min'], 10) || 1));
                    var maximum = Math.max(minimum, Math.min(6, parseInt(attrs['data-zm-pb-toc-max'], 10) || 6));
                    var entries = [], after = false;
                    root.querySelectorAll('[data-zm-pb-toc],h1,h2,h3,h4,h5,h6').forEach(function(el) {
                        if (el === view.el) { after = true; return; }
                        if (!after || el.hasAttribute('data-zm-pb-toc') || el.closest('[data-zm-pb-toc],form,[data-zm-pb-code],[hidden],[aria-hidden="true"]')) return;
                        var hidden = false;
                        for (var parent = el; parent && parent !== root; parent = parent.parentElement) {
                            if (parent.style.display === 'none' || parent.style.visibility === 'hidden') { hidden = true; break; }
                        }
                        var level = Number(el.tagName.slice(1)), text = el.textContent.replace(/\s+/g, ' ').trim();
                        if (!hidden && level >= minimum && level <= maximum && text) entries.push({ element: el, level: level, text: text });
                    });
                    this.el.replaceChildren(); this.targets = entries.map(function(entry) { return entry.element; });
                    var doc = this.el.ownerDocument;
                    if (attrs['data-zm-pb-toc-title']) {
                        var title = doc.createElement('div'); title.className = 'zm-pb-toc-title';
                        title.textContent = attrs['data-zm-pb-toc-title']; this.el.appendChild(title);
                    }
                    if (!entries.length) {
                        var hint = doc.createElement('p'); hint.className = 'zm-pb-toc-empty'; hint.textContent = t('toc_empty');
                        this.el.appendChild(hint); return;
                    }
                    var tag = attrs['data-zm-pb-toc-numbered'] === '1' ? 'ol' : 'ul';
                    var list = doc.createElement(tag), stack = []; this.el.appendChild(list);
                    entries.forEach(function(entry, index) {
                        while (stack.length && stack[stack.length - 1].level >= entry.level) stack.pop();
                        var parentList = list;
                        if (stack.length && attrs['data-zm-pb-toc-nested'] !== '0') {
                            var parentItem = stack[stack.length - 1].item;
                            parentList = parentItem.lastElementChild;
                            if (!parentList || parentList.tagName.toLowerCase() !== tag) { parentList = doc.createElement(tag); parentItem.appendChild(parentList); }
                        }
                        var item = doc.createElement('li'), link = doc.createElement('a');
                        link.href = '#' + encodeURIComponent(entry.element.id || 'zm-pb-preview-heading-' + index);
                        link.setAttribute('data-zm-toc-target', String(index)); link.textContent = entry.text;
                        item.appendChild(link); parentList.appendChild(item); stack.push({ level: entry.level, item: item });
                    });
                }
            }
        });
    };
})();
