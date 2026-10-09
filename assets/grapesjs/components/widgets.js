(function() {
    window.ZmPbComponents = window.ZmPbComponents || {};
    var api = window.ZmPbComponents;
    var escapeHtml = function(value) {
        return String(value).replace(/[&<>"']/g, function(char) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[char];
        });
    };

    api.accordionItem = function(t, open, faq) {
        return { type: 'zm-accordion-item', tagName: 'details', attributes: open ? { open: 'open', 'data-zm-pb-accordion-item': '1' } : { 'data-zm-pb-accordion-item': '1' }, droppable: true,
            components: [
                { type: 'text', tagName: 'summary', name: t(faq ? 'accordion_question' : 'accordion_title'), components: t(faq ? 'accordion_question' : 'accordion_title') },
                { tagName: 'div', attributes: { class: 'zm-pb-accordion-answer' }, droppable: true,
                    components: [{ type: 'text', tagName: 'p', components: t(faq ? 'accordion_answer' : 'accordion_content') }] }
            ] };
    };

    api.accordion = function(t) {
        return { type: 'zm-accordion', tagName: 'div', attributes: { class: 'zm-pb-accordion', 'data-zm-pb-accordion': '1',
                'data-zm-pb-animation': 'none', 'data-zm-pb-animation-speed': '300' },
            components: [api.accordionItem(t, true, true), api.accordionItem(t, false, true)] };
    };
    api.faq = function(t) {
        var faq = api.accordion(t);
        faq.attributes['data-zm-pb-faq'] = '1';
        return faq;
    };
    api.singleAccordion = function(t) {
        var item = api.accordionItem(t, false);
        item.attributes.class = 'zm-pb-accordion-single';
        item.attributes['data-zm-pb-animation'] = 'none';
        item.attributes['data-zm-pb-animation-speed'] = '300';
        return item;
    };

    api.registerWidgets = function(editor, t) {
        editor.DomComponents.addType('zm-accordion-item', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-accordion-item'); },
            model: { defaults: { tagName: 'details', name: t('accordion'), droppable: true,
                attributes: { 'data-zm-pb-accordion-item': '1' } } },
            view: { onRender: function() {
                var view = this;
                var parent = this.model.parent();
                this.model.set('name', t(parent && parent.get('type') === 'zm-accordion' ? 'accordion_item' : 'accordion'));
                if (this.el._zmPbAccordionClickBound) return;
                this.el._zmPbAccordionClickBound = true;
                this.el.addEventListener('click', function(event) {
                    var summary = event.target.closest && event.target.closest('summary');
                    if (!summary || summary.parentElement !== view.el) return;
                    if (!event.target.closest('[contenteditable="true"]')) event.preventDefault();
                }, true);
                this.el.addEventListener('toggle', function() {
                    var open = Object.prototype.hasOwnProperty.call(view.model.getAttributes(), 'open');
                    if (view.el.open !== open) view.el.open = open;
                });
                this.el.addEventListener('dblclick', function(event) {
                    var summary = event.target.closest && event.target.closest('summary');
                    if (!summary || summary.parentElement !== view.el || event.target.closest('[contenteditable="true"]')) return;
                    event.preventDefault();
                    if (Object.prototype.hasOwnProperty.call(view.model.getAttributes(), 'open')) view.model.removeAttributes('open');
                    else view.model.addAttributes({ open: 'open' });
                }, true);
            } }
        });
        editor.DomComponents.addType('zm-accordion', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-accordion'); },
            model: { defaults: { tagName: 'div', name: t('faq'), droppable: false,
                attributes: { class: 'zm-pb-accordion', 'data-zm-pb-accordion': '1', 'data-zm-pb-animation': 'none',
                    'data-zm-pb-animation-speed': '300', 'data-zm-pb-faq': '1' } },
                init: function() { this.set('name', t('faq')); this.addAttributes({ 'data-zm-pb-faq': '1' }); }
            }
        });
        editor.DomComponents.addType('zm-progress', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-progress'); },
            model: { defaults: { tagName: 'div', name: t('progress'), droppable: false,
                attributes: { class: 'zm-pb-progress', 'data-zm-pb-progress': '1' },
                zmLabel: t('progress_label'), zmValue: 50, zmMax: 100, zmColor: 'blue', components: [] },
                toHTML: function() {
                    var max = Math.max(1, parseInt(this.get('zmMax'), 10) || 100);
                    var value = Math.min(max, Math.max(0, parseInt(this.get('zmValue'), 10) || 0));
                    var color = ['blue', 'green', 'orange'].indexOf(this.get('zmColor')) >= 0 ? this.get('zmColor') : 'blue';
                    return '<div class="zm-pb-progress" data-zm-pb-progress="1" data-zm-pb-progress-color="' + color + '"><span class="zm-pb-progress-label">' +
                        escapeHtml(this.get('zmLabel') || '') + '</span><progress max="' + max + '" value="' + value + '">' +
                        Math.round(value / max * 100) + '%</progress></div>';
                }
            },
            view: { onRender: function() {
                var view = this;
                var render = function() {
                    var tmp = view.el.ownerDocument.createElement('div');
                    tmp.innerHTML = view.model.toHTML();
                    view.el.innerHTML = tmp.firstChild.innerHTML;
                    view.el.setAttribute('data-zm-pb-progress-color', view.model.get('zmColor') || 'blue');
                };
                this.listenTo(this.model, 'change:zmLabel change:zmValue change:zmMax change:zmColor', render);
                render();
            } }
        });
    };
})();
