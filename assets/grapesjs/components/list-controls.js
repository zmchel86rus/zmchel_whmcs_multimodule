(function() {
    var api = window.ZmPbComponents = window.ZmPbComponents || {};
    var esc = function(v) { return String(v == null ? '' : v).replace(/[&<>"']/g, function(c) { return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]; }); };
    var settings = function(component) {
        try { return JSON.parse(component.getAttributes()['data-zm-pb-list-settings'] || '{}'); } catch (e) { return {}; }
    };
    api.registerListControls = function(editor, t) {
        ['search', 'filters'].forEach(function(kind) {
            editor.DomComponents.addType('zm-' + kind, {
                isComponent: function(el) { return el.getAttribute && el.getAttribute('data-zm-pb-list-control') === kind; },
                model: { defaults: { tagName: 'div', name: t('list_' + kind), droppable: false, editable: false, components: [],
                    attributes: { 'data-zm-pb-list-control': kind, 'data-zm-pb-page-target': '', 'data-zm-pb-page-variable': 'auction_sites',
                        'data-zm-pb-list-settings': JSON.stringify({ label: t('list_search'), submit: t(kind === 'search' ? 'list_search' : 'list_apply'),
                            reset: t('list_reset'), all: t('list_all'), min: t('list_min'), max: t('list_max'), searchFields: 'domain_name',
                            desktop: '3', tablet: '2', mobile: '1', size: 'standard', appearance: 'outline', autoApply: '0',
                            layout: 'flex', direction: 'row', wrap: 'wrap', justify: 'flex-start', align: 'stretch', gap: '18', buttons: 'end',
                            fields: [{ field: 'domain_name', label: t('list_search'), type: 'text', options: '' }] }) } },
                    init: function() {
                        // Opening an old search block converts it to a text filter.
                        if (kind !== 'search') return;
                        var s = settings(this);
                        s.fields = [{field:s.searchFields || 'domain_name', label:s.label || t('list_search'), type:'text', options:''}];
                        this.set('type', 'zm-filters');
                        this.addAttributes({'data-zm-pb-list-control':'filters', 'data-zm-pb-list-settings':JSON.stringify(s)});
                    },
                    toHTML: function() {
                        var attrs = Object.assign({}, this.getAttributes(), { id: this.getId() });
                        return '<div' + Object.keys(attrs).map(function(key) { return ' ' + key + '="' + esc(attrs[key]) + '"'; }).join('') + '></div>';
                    }
                },
                view: { init: function() { this.listenTo(this.model, 'change:attributes', this.onRender); },
                    onRender: function() {
                        var s = settings(this.model), fields = this.model.getAttributes()['data-zm-pb-list-control'] === 'search' ? [{label:s.label,type:'text'}] : (s.fields || []);
                        var layoutStyle = ['direction','wrap','justify','align'].map(function(k) { return '--zm-list-' + k + ':' + esc(s[k] || ({direction:'row',wrap:'wrap',justify:'flex-start',align:'stretch'})[k]); }).join(';');
                        var html = '<div class="zm-pb-list-controls zm-pb-list-preview zm-pb-list-size-' + esc(s.size || 'standard') + ' zm-pb-list-' + esc(s.appearance || 'outline') + ' zm-pb-list-layout-' + esc(s.layout || 'grid') + ' zm-pb-list-buttons-' + esc(s.buttons || 'end') + '" data-list-direction="' + esc(s.direction || 'row') + '" style="' + layoutStyle + ';--zm-list-gap:' + Math.max(0,Math.min(64,Number(s.gap === undefined ? 18 : s.gap))) + 'px;--zm-list-desktop:' + (Number(s.desktop) || 3) + ';--zm-list-tablet:' + (Number(s.tablet) || 2) + ';--zm-list-mobile:' + (Number(s.mobile) || 1) + '">';
                        fields.forEach(function(field) {
                            html += '<label class="zm-pb-list-field" style="--zm-list-span:' + (Number(field.span) || 1) + ';--zm-list-ratio:' + (Number(field.width) ? Number(field.width) / 100 : 'auto') + ';--zm-list-width:' + (Number(field.width) ? Number(field.width) + '%' : 'auto') + '"><span>' + esc(field.label || field.field) + '</span>';
                            if (field.type === 'select') html += '<select disabled><option>' + esc(s.all) + '</option></select>';
                            else if (field.type === 'range' || field.type === 'date') html += '<span class="zm-pb-list-range"><input disabled type="' + (field.type === 'date' ? 'date' : 'number') + '" placeholder="' + esc(s.min) + '"><input disabled type="' + (field.type === 'date' ? 'date' : 'number') + '" placeholder="' + esc(s.max) + '"></span>';
                            else html += '<input disabled placeholder="' + esc(field.placeholder || '') + '" type="' + (field.type === 'checkbox' ? 'checkbox' : 'search') + '">';
                            html += '</label>';
                        });
                        this.el.innerHTML = html + '<div class="zm-pb-list-actions"><button disabled>' + esc(s.submit) + '</button><span>' + esc(s.reset) + '</span></div></div>';
                    }
                }
            });
        });
    };
    api.applyListControls = function(component, panel) {
        var s = settings(component), attrs = {};
        panel.querySelectorAll('[data-zm-list-setting]').forEach(function(input) { s[input.dataset.zmListSetting] = input.value; });
        panel.querySelectorAll('[data-zm-list-attribute]').forEach(function(input) { attrs[input.dataset.zmListAttribute] = input.value; });
        panel.querySelectorAll('[data-zm-list-field]').forEach(function(input) {
            var index = Number(input.dataset.zmListIndex);
            if (s.fields && s.fields[index]) s.fields[index][input.dataset.zmListField] = input.value;
        });
        attrs['data-zm-pb-list-settings'] = JSON.stringify(s);
        component.addAttributes(attrs);
    };
    api.listControlsCommand = function(component, command, index, t) {
        var s = settings(component); s.fields = s.fields || [];
        if (command === 'list-add-field' && s.fields.length < 30) s.fields.push({field:'', label:t('list_field_label'), type:'text', options:''});
        if (command === 'list-remove-field') s.fields.splice(index, 1);
        if (command === 'list-field-up' && index > 0) s.fields.splice(index - 1, 0, s.fields.splice(index, 1)[0]);
        if (command === 'list-field-down' && index < s.fields.length - 1) s.fields.splice(index + 1, 0, s.fields.splice(index, 1)[0]);
        component.addAttributes({'data-zm-pb-list-settings': JSON.stringify(s)});
    };
    api.renderListControls = function(component, editor, t) {
        var s = settings(component), attrs = component.getAttributes(), html = '';
        var input = function(label, value, data, multiline) {
            return '<label class="zm-pb-field"><span>' + esc(t(label)) + '</span>' + (multiline
                ? '<textarea data-zm-control="list" ' + data + ' rows="3">' + esc(value) + '</textarea>'
                : '<input data-zm-control="list" ' + data + ' value="' + esc(value) + '">') + '</label>';
        };
        var target = api.paginationTarget(editor, attrs['data-zm-pb-page-target']);
        html += '<div class="zm-pb-field-wide">' + esc(t('pagination_target')) + ': ' + esc(target ? target.getName() + ' · #' + target.getId() : t('pagination_target_missing')) + '</div>';
        html += '<div class="zm-pb-controls-actions"><button type="button" data-zm-command="pagination-pick">' + esc(t(editor.zmPaginationPick ? 'pagination_cancel' : 'pagination_pick')) + '</button></div>';
        if (editor.zmPaginationPick) html += '<p class="zm-pb-controls-hint">' + esc(t('list_pick_hint')) + '</p>';
        html += input('pagination_variable', attrs['data-zm-pb-page-variable'], 'data-zm-list-attribute="data-zm-pb-page-variable"');
        var select = function(key, label, options, value, fieldIndex) {
            var data = fieldIndex === undefined ? 'data-zm-list-setting="' + key + '"' : 'data-zm-list-index="' + fieldIndex + '" data-zm-list-field="' + key + '"';
            return '<label class="zm-pb-field"><span>' + esc(t(label)) + '</span><select data-zm-control="list" ' + data + '>' + options.map(function(option) { return '<option value="' + option[0] + '"' + (String(value) === option[0] ? ' selected' : '') + '>' + esc(option[1]) + '</option>'; }).join('') + '</select></label>';
        };
        ['desktop','tablet','mobile'].forEach(function(device) { html += select(device, 'list_columns_' + device, ['1','2','3','4'].map(function(n) { return [n,n]; }), s[device] || (device === 'desktop' ? '3' : device === 'tablet' ? '2' : '1')); });
        html += select('layout','layout_mode',[['flex','Flex'],['grid','Grid']],s.layout || 'grid');
        html += select('direction','flex_direction',['row','column','row-reverse','column-reverse'].map(function(v){return [v,t('direction_' + v.replace('-','_'))];}),s.direction || 'row');
        html += select('wrap','flex_wrap',[['wrap',t('wrap_yes')],['nowrap',t('wrap_no')]],s.wrap || 'wrap');
        html += select('justify','list_justify',[['flex-start',t('list_start')],['center',t('list_center')],['flex-end',t('list_end')],['space-between',t('list_between')]],s.justify || 'flex-start');
        html += select('align','list_align',[['stretch',t('list_stretch')],['flex-start',t('list_start')],['center',t('list_center')],['flex-end',t('list_end')]],s.align || 'stretch');
        html += '<label class="zm-pb-field"><span>' + esc(t('gap_pixels')) + '</span><input type="number" min="0" max="64" data-zm-control="list" data-zm-list-setting="gap" value="' + esc(s.gap === undefined ? 18 : s.gap) + '"></label>';
        html += select('buttons','list_buttons',[['start',t('list_start')],['end',t('list_end')],['inline',t('list_inline')]],s.buttons || 'end');
        html += select('size', 'list_size', ['small','standard','large'].map(function(v) { return [v,t('size_' + v)]; }), s.size || 'standard');
        html += select('appearance', 'list_appearance', ['outline','underline'].map(function(v) { return [v,t('list_appearance_' + v)]; }), s.appearance || 'outline');
        html += select('autoApply', 'list_auto_apply', [['0',t('list_apply_button')],['1',t('list_apply_change')]], s.autoApply || '0');
        if (component.get('type') === 'zm-search') {
            html += input('list_search_fields', s.searchFields, 'data-zm-list-setting="searchFields"');
            html += input('list_field_label', s.label, 'data-zm-list-setting="label"');
        } else {
            (s.fields || []).forEach(function(field, index) {
                var data = 'data-zm-list-index="' + index + '" ';
                html += '<fieldset class="zm-pb-field-wide"><legend>' + esc(t('list_field_label')) + ' ' + (index + 1) + '</legend>';
                html += input('list_field_path', field.field, data + 'data-zm-list-field="field"') + input('list_field_label', field.label, data + 'data-zm-list-field="label"');
                html += '<label class="zm-pb-field"><span>' + esc(t('list_field_type')) + '</span><select data-zm-control="list" ' + data + 'data-zm-list-field="type">';
                ['text','select','range','date','checkbox'].forEach(function(type) { html += '<option value="' + type + '"' + (type === field.type ? ' selected' : '') + '>' + esc(t('list_type_' + type)) + '</option>'; });
                html += '</select></label>';
                if (field.type === 'select') html += input('list_options', field.options, data + 'data-zm-list-field="options"', true);
                if (field.type === 'text') html += input('list_placeholder', field.placeholder || '', data + 'data-zm-list-field="placeholder"');
                html += select('span', 'list_field_span', ['1','2','3','4'].map(function(n) { return [n,n]; }), field.span || '1', index);
                html += select('width','list_field_width',[['auto',t('list_auto')]].concat(['25','33','50','75','100'].map(function(n){return [n,n+'%'];})),field.width || 'auto',index);
                ['up','down'].forEach(function(dir) { html += '<button type="button" data-zm-command="list-field-' + dir + '" data-zm-list-index="' + index + '">' + esc(t('list_move_' + dir)) + '</button>'; });
                html += '<button type="button" data-zm-command="list-remove-field" data-zm-list-index="' + index + '">' + esc(t('list_remove')) + '</button></fieldset>';
            });
            html += '<button type="button" data-zm-command="list-add-field">' + esc(t('list_add')) + '</button>';
        }
        ['submit','reset','all','min','max'].forEach(function(key) { html += input('list_label_' + key, s[key], 'data-zm-list-setting="' + key + '"'); });
        return html + '<p class="zm-pb-controls-hint">' + esc(t('list_hint')) + '</p>';
    };
})();
