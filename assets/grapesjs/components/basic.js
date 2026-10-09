(function() {
    window.ZmPbComponents = window.ZmPbComponents || {};
    var api = window.ZmPbComponents;

    api.containerBackgroundUrl = function(component) {
        var value = String(component.getStyle()['background-image'] || '').trim();
        var match = /^url\(\s*(['"]?)(.*?)\1\s*\)$/i.exec(value);
        return match ? match[2] : '';
    };

    api.setContainerBackground = function(component, url) {
        url = String(url || '').trim();
        component.addStyle({
            'background-image': url ? 'url(' + JSON.stringify(url) + ')' : 'none',
            'background-size': 'cover',
            'background-position': 'center',
            'background-repeat': 'no-repeat'
        });
    };

    api.registerBasic = function(editor, t) {
        editor.DomComponents.addType('zm-plain-div', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-plain-div'); },
            model: { defaults: { tagName: 'div', name: t('plain_div'), droppable: true,
                attributes: { class: 'zm-pb-plain-div', 'data-zm-pb-plain-div': '1' },
                style: { 'min-height': '160px' } } }
        });
        editor.DomComponents.addType('zm-heading', {
            extend: 'text',
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-heading'); },
            model: { defaults: { tagName: 'h2', name: t('heading'), attributes: { 'data-zm-pb-heading': '1', 'data-zm-pb-heading-size': '2' } },
                init: function() {
                    this.on('change:attributes', this.applyHeadingSize);
                    this.applyHeadingSize();
                    if (!this.getStyle()['font-weight']) this.addStyle({ 'font-weight': '700' });
                },
                applyHeadingSize: function() {
                    var value = parseFloat(this.getAttributes()['data-zm-pb-heading-size']);
                    this.addStyle({ 'font-size': Math.min(5, Math.max(1, isNaN(value) ? 2 : value)) + 'em' });
                }
            }
        });
        editor.DomComponents.addType('zm-button', {
            extend: 'text',
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-button'); },
            model: { defaults: { tagName: 'button', name: t('button'), attributes: {
                class: 'zm-pb-button', 'data-zm-pb-button': '1', type: 'button', 'data-zm-pb-action': 'none' }
            } }
        });
        editor.DomComponents.addType('zm-spacer', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-spacer'); },
            model: { defaults: { tagName: 'div', name: t('spacer'), droppable: false,
                attributes: { class: 'zm-pb-spacer', 'data-zm-pb-spacer': '1' }, style: { height: '32px' } } }
        });
    };
})();
