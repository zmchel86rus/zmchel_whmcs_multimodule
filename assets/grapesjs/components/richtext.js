(function() {
    window.ZmPbComponents = window.ZmPbComponents || {};
    var api = window.ZmPbComponents;
    api.registerRichText = function(editor, t) {
        editor.DomComponents.addType('zm-richtext', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-richtext'); },
            model: { defaults: { tagName: 'div', name: t('rich_text'),
                attributes: { 'data-zm-pb-richtext': '1', class: 'zm-pb-richtext' },
                zmHtml: '<p>' + t('text') + '</p>', components: [], editable: false, droppable: false },
                toHTML: function() {
                    return '<div data-zm-pb-richtext="1" class="zm-pb-richtext">' + (this.get('zmHtml') || '') + '</div>';
                }
            },
            view: { onRender: function() {
                var view = this;
                this.renderRichTextPreview = function() {
                    if (window.BlockEditor && BlockEditor.activeRichText && BlockEditor.activeRichText.component === view.model) return;
                    view.el.innerHTML = view.model.get('zmHtml') || '<p><br></p>';
                };
                this.listenTo(this.model, 'change:zmHtml', this.renderRichTextPreview);
                this.renderRichTextPreview();
            } }
        });
    };
})();
