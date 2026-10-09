(function() {
    window.ZmPbComponents = window.ZmPbComponents || {};
    window.ZmPbComponents.registerDynamic = function(editor, t, state) {
        editor.DomComponents.addType('zm-code', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-code'); },
            model: { defaults: { tagName: 'div', attributes: { 'data-zm-pb-code': 'js', class: 'zm-pb-editor-placeholder' },
                zmCode: '', editable: false, droppable: false, stylable: false, components: '',
                traits: [{ name: 'data-zm-pb-code', type: 'select', label: t('code_type'), options: [
                    { id: 'js', label: 'JS' }, { id: 'css', label: 'CSS' }] }] },
                init: function() {
                    var model = this;
                    var rename = function() { model.set('name', t(model.getAttributes()['data-zm-pb-code'] === 'css' ? 'code_css_label' : 'code_js_label')); };
                    this.on('change:attributes', rename); rename();
                } },
            view: { onRender: function() {
                var view = this;
                this.renderCodePreview = function() {
                    if (state.activeCode && state.activeCode.component === view.model) return;
                    var css = view.model.getAttributes()['data-zm-pb-code'] === 'css';
                    var title = view.el.ownerDocument.createElement('strong');
                    title.textContent = t(css ? 'code_css_label' : 'code_js_label');
                    var preview = view.el.ownerDocument.createElement('pre');
                    preview.textContent = view.model.get('zmCode') || t('code_empty');
                    view.el.replaceChildren(title, preview);
                };
                this.listenTo(this.model, 'change:zmCode change:attributes', this.renderCodePreview);
                this.renderCodePreview();
            } }
        });
        editor.DomComponents.addType('zm-smarty', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-smarty'); },
            model: { defaults: { tagName: 'div', attributes: { 'data-zm-pb-smarty': '', class: 'zm-pb-editor-placeholder' },
                name: t('smarty'), editable: false, droppable: false, stylable: false, components: t('smarty'),
                traits: [] } },
            view: { onRender: function() {
                var view = this;
                var preview = function() {
                    var title = view.el.ownerDocument.createElement('strong');
                    title.textContent = 'Smarty';
                    var code = view.el.ownerDocument.createElement('pre');
                    code.textContent = view.model.getAttributes()['data-zm-pb-smarty'] || t('expression');
                    view.el.replaceChildren(title, code);
                };
                this.listenTo(this.model, 'change:attributes', preview);
                preview();
            } }
        });
        editor.DomComponents.addType('zm-auth', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-auth'); },
            model: { defaults: { tagName: 'section', attributes: { 'data-zm-pb-auth': 'mixed', class: 'zm-pb-auth-zone' },
                droppable: true, traits: [{ name: 'data-zm-pb-auth', type: 'select', label: t('traits'), options: [
                    { id: 'auth', label: t('auth') }, { id: 'guest', label: t('guest') }, { id: 'mixed', label: t('mixed') }] }] },
                init: function() {
                    var model = this;
                    var rename = function() { model.set('name', t((model.getAttributes()['data-zm-pb-auth'] || 'mixed') + '_section_label')); };
                    this.on('change:attributes', rename); rename();
                } },
            view: { onRender: function() {
                var view = this;
                var label = function() { view.el.setAttribute('data-zm-pb-editor-label', t((view.model.getAttributes()['data-zm-pb-auth'] || 'mixed') + '_section_label') + ' · ' + t('drop_content')); };
                this.listenTo(this.model, 'change:attributes', label); label();
            } }
        });
        editor.DomComponents.addType('zm-carousel', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-carousel'); },
            model: { defaults: { tagName: 'div', attributes: { class: 'zm-pb-carousel', 'data-zm-pb-carousel': '1',
                'data-autoplay': '0', 'data-loop': '1', 'data-interval': '5000', 'data-speed': '400', 'data-indicators': '1',
                'data-slides-desktop': '1', 'data-slides-tablet': '1', 'data-slides-mobile': '1' },
                name: t('carousel'), droppable: false, traits: [] } },
            view: { onRender: function() {
                var view = this;
                var update = function() {
                    var attrs = view.model.getAttributes();
                    view.el.setAttribute('data-zm-pb-editor-label', t('carousel_select_hint'));
                    ['desktop', 'tablet', 'mobile'].forEach(function(device) {
                        view.el.style.setProperty('--zm-pb-slides-' + device, attrs['data-slides-' + device] || '1');
                    });
                };
                this.listenTo(this.model, 'change:attributes', update);
                update();
            } }
        });
        editor.DomComponents.addType('zm-slide', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-slide'); },
            model: { defaults: { tagName: 'div', attributes: { class: 'zm-pb-slide', 'data-zm-pb-slide': '1' },
                name: t('slide'), droppable: true },
                init: function() {
                    var children = this.components();
                    var first = children.at(0);
                    if (children.length === 1 && first.get('type') === 'textnode' && first.get('content') === t('slide')) first.remove();
                } },
            view: { onRender: function() { this.el.setAttribute('data-zm-pb-editor-label', t('slide')); } }
        });
    };
})();
