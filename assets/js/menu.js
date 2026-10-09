(function() {
    'use strict';
    var data = document.getElementById('zm-pb-menu-data');
    if (!data) return;
    var menus = JSON.parse(data.textContent), toggles = [];
    function create(tag, className, text) {
        var node = document.createElement(tag); node.className = className || '';
        if (text !== undefined) node.textContent = text;
        return node;
    }
    function decorate(li, item, prefix, top) {
        li.replaceChildren(); li.classList.add('zm-pb-menu-item');
        var row = create('div', 'zm-pb-menu-link-row');
        var link = create('a', top ? 'nav-link' : '', item.label); link.href = item.url || '#';
        link.target = item.target || '_self'; link.title = item.title || '';
        link.rel = (item.rel || '') + (link.target === '_blank' ? ' noopener noreferrer' : '');
        if (item.icon) { var icon = create('i', item.icon); icon.setAttribute('aria-hidden', 'true'); link.prepend(icon, ' '); }
        try {
            var target = new URL(link.href), current = new URL(window.location.href);
            if (target.origin === current.origin && target.pathname.replace(/\/$/, '') === current.pathname.replace(/\/$/, '') && target.search === current.search) {
                link.setAttribute('aria-current', 'page'); li.classList.add('zm-pb-menu-current');
            }
        } catch (error) { /* Relative fragments are still usable links. */ }
        row.appendChild(link); li.appendChild(row);
        if (item.description) li.appendChild(create('small', 'zm-pb-menu-description', item.description));
        if (item.children && item.children.length) {
            var list = create('ul', 'dropdown-menu zm-pb-menu-submenu');
            list.id = prefix + item.id + '_children';
            var toggle = create('button', 'zm-pb-menu-toggle'); toggle.type = 'button';
            toggle.setAttribute('aria-label', item.label); toggle.setAttribute('aria-expanded', 'false'); toggle.setAttribute('aria-controls', list.id);
            toggle.onclick = function(event) {
                event.preventDefault(); event.stopPropagation();
                var open = list.classList.toggle('show'); toggle.setAttribute('aria-expanded', String(open));
            };
            row.appendChild(toggle); toggles.push({ button: toggle, list: list, root: li });
            item.children.forEach(function(child) {
                var entry = create('li', (child.classes || '') + ' zm-pb-menu-item');
                entry.setAttribute('menuItemName', prefix + child.id); decorate(entry, child, prefix, false); list.appendChild(entry);
            });
            li.appendChild(list);
        } else li.classList.remove('dropdown');
    }
    Object.keys(menus).forEach(function(location) {
        var menu = menus[location];
        menu.items.forEach(function(item) {
            document.querySelectorAll('[menuItemName="' + menu.prefix + item.id + '"]').forEach(function(li, index) {
                decorate(li, item, menu.prefix + index + '_', true);
            });
        });
    });
    if (menus.primary_navbar) {
        var overflow = document.querySelector('#nav > .collapsable-dropdown');
        var overflowList = overflow && overflow.querySelector('.collapsable-dropdown-menu');
        if (overflowList) {
            var syncOverflow = function() { overflow.classList.toggle('d-none', overflowList.children.length === 0); };
            var observer = new MutationObserver(syncOverflow);
            observer.observe(overflow, { attributes: true, attributeFilter: ['class'] });
            observer.observe(overflowList, { childList: true });
            syncOverflow();
        }
    }
    document.addEventListener('click', function(event) {
        toggles.forEach(function(toggle) { if (!toggle.root.contains(event.target)) { toggle.list.classList.remove('show'); toggle.button.setAttribute('aria-expanded', 'false'); } });
    });
    document.addEventListener('keydown', function(event) {
        if (event.key !== 'Escape') return;
        var last = toggles.slice().reverse().find(function(toggle) { return toggle.list.classList.contains('show') && toggle.root.contains(document.activeElement); });
        if (last) { last.list.classList.remove('show'); last.button.setAttribute('aria-expanded', 'false'); last.button.focus(); event.preventDefault(); }
    });
    document.querySelectorAll('.zm-pb-sidebar-menu a').forEach(function(link) {
        if (link.href === window.location.href) { link.setAttribute('aria-current', 'page'); for (var ancestor = link.parentNode; ancestor; ancestor = ancestor.parentNode) if (ancestor.tagName === 'DETAILS') ancestor.open = true; }
    });
})();
