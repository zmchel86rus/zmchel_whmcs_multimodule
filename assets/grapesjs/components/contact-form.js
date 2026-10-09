(function() {
    window.ZmPbComponents = window.ZmPbComponents || {};
    var api = window.ZmPbComponents;
    var esc = function(value) { return String(value == null ? '' : value).replace(/[&<>"']/g, function(c) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    }); };
    var consentPreview = function(text) {
        var doc = new DOMParser().parseFromString('<div id="zm-pb-consent-root">' + String(text || '') + '</div>', 'text/html');
        var render = function(node) {
            if (node.nodeType === 3) return esc(node.nodeValue).replace(/\r?\n/g, '<br>');
            if (node.nodeType !== 1) return '';
            var tag = node.tagName.toLowerCase();
            if (['script', 'style', 'iframe', 'svg'].indexOf(tag) !== -1) return '';
            if (tag === 'br') return '<br>';
            var content = Array.from(node.childNodes).map(render).join('');
            if (tag !== 'a') return content;
            var url = (node.getAttribute('href') || '').trim();
            if (!url || /[\x00-\x20\x7f\\]/.test(url) || !(/^\/(?!\/)/.test(url) ||
                /^#[A-Za-z0-9_-]+$/.test(url) || /^https?:\/\/[^\s]+$/i.test(url) || /^mailto:[^\s@]+@[^\s@]+\.[^\s@]+$/i.test(url))) return content;
            return '<a href="' + esc(url) + '">' + content + '</a>';
        };
        var root = doc.getElementById('zm-pb-consent-root');
        return root ? Array.from(root.childNodes).map(render).join('') : esc(text);
    };
    var defaults = function(t) { return { action: 'ticket', department: '', emailFormat: 'system', title: t('contact_form'),
        description: t('form_description_default'), submit: t('form_submit'), subject: t('contact_form'), captcha: true,
        fields: [
            { id: 'name', label: t('form_name'), type: 'text', filter: 'none', role: 'name', required: true, width: 6 },
            { id: 'email', label: t('form_email'), type: 'email', filter: 'email', role: 'email', required: true, width: 6 },
            { id: 'message', label: t('form_message'), type: 'textarea', filter: 'none', role: 'none', required: true, width: 12, breakBefore: true },
            { id: 'consent', label: t('field_type_consent'), type: 'consent', text: t('form_consent_default'), filter: 'none', role: 'none', required: true, width: 12, breakBefore: true }
        ] }; };
    var options = function(raw) { return String(raw || '').split(/\r?\n/).map(function(line) {
        var split = line.indexOf(': ');
        if (split < 0) split = line.indexOf(':');
        return { value: (split < 0 ? line : line.slice(0, split)).trim(), label: (split < 0 ? line : line.slice(split + 1)).trim() };
    }).filter(function(item) { return item.value && item.label; }); };
    var fieldSpan = function(field) { var width = parseInt(field.width, 10); return width >= 1 && width <= 12 ? width : (['textarea', 'consent'].indexOf(field.type) !== -1 ? 12 : 6); };
    api.registerContactForm = function(editor, t, config) {
        editor.DomComponents.addType('zm-contact-form', {
            isComponent: function(el) { return el.hasAttribute && el.hasAttribute('data-zm-pb-form'); },
            model: { defaults: { tagName: 'form', name: t('contact_form'), components: [], editable: false, droppable: false,
                attributes: { class: 'zm-pb-contact-form' }, zmForm: defaults(t) },
                init: function() {
                    var raw = this.getAttributes()['data-zm-pb-form'];
                    if (raw) { try { this.set('zmForm', JSON.parse(decodeURIComponent(raw))); } catch (error) {} }
                    var form = this.get('zmForm');
                    if (form.consent) {
                        form = Object.assign({}, form, { fields: (form.fields || []).slice() });
                        if (form.consent.enabled) {
                            var consentId = 'consent', suffix = 2;
                            while (form.fields.some(function(field) { return field.id === consentId; })) consentId = 'consent_' + suffix++;
                            form.fields.push({ id: consentId, label: t('field_type_consent'), type: 'consent',
                                text: form.consent.text || t('form_consent_default'), filter: 'none', role: 'none', required: true, width: 12, breakBefore: true });
                        }
                        delete form.consent;
                        this.set('zmForm', form);
                    }
                    if (!form.department && config.departments && config.departments.length) {
                        form = Object.assign({}, form, { department: String(config.departments[0].id) });
                        this.set('zmForm', form);
                    }
                },
                toHTML: function() {
                    var form = this.get('zmForm');
                    var html = '<form id="' + esc(this.getId()) + '" class="zm-pb-contact-form" data-zm-pb-form="' + esc(encodeURIComponent(JSON.stringify(form))) + '">';
                    html += '<div class="zm-pb-form-head"><h2>' + esc(form.title) + '</h2><p>' + esc(form.description) + '</p></div><div class="zm-pb-form-fields">';
                    form.fields.forEach(function(field) {
                        var id = 'zm-pb-' + this.getId() + '-' + field.id;
                        var attrs = ' id="' + esc(id) + '" name="fields[' + esc(field.id) + ']"' + (field.required ? ' required' : '');
                        if (field.type === 'consent') {
                            html += '<div class="zm-pb-form-field zm-pb-form-consent' + (field.breakBefore ? ' zm-pb-form-field-new-row' : '') + (fieldSpan(field) === 12 ? ' zm-pb-form-field-full' : '') + '" style="--zm-pb-field-span:' + fieldSpan(field) + '"><label for="' + esc(id) + '"><input type="checkbox"' + attrs + ' value="1"><span>' + consentPreview(field.text || field.label || t('form_consent_default')) + (field.required ? ' <b aria-hidden="true">*</b>' : '') + '</span></label></div>';
                            return;
                        }
                        html += '<label class="zm-pb-form-field' + (field.breakBefore ? ' zm-pb-form-field-new-row' : '') + (fieldSpan(field) === 12 ? ' zm-pb-form-field-full' : '') + '" style="--zm-pb-field-span:' + fieldSpan(field) + '" for="' + esc(id) + '"><span>' + esc(field.label) + (field.required ? ' <b aria-hidden="true">*</b>' : '') + '</span>';
                        if (field.type === 'textarea') html += '<textarea rows="5" maxlength="10000"' + attrs + ' placeholder="' + esc(field.placeholder) + '"></textarea>';
                        else if (field.type === 'select') {
                            html += '<select' + attrs + '><option value="">' + esc(t('form_choose')) + '</option>';
                            options(field.options).forEach(function(option) { html += '<option value="' + esc(option.value) + '">' + esc(option.label) + '</option>'; });
                            html += '</select>';
                        } else html += '<input type="' + esc(field.type) + '"' + attrs + (field.type === 'checkbox' ? ' value="1"' : ' placeholder="' + esc(field.placeholder) + '"') + '>';
                        html += '</label>';
                    }, this);
                    html += '</div>';
                    html += form.captcha ? '<div class="zm-pb-form-captcha-preview">' + esc(t('form_captcha')) + '</div>' : '';
                    return html + '<div class="zm-pb-form-footer"><button type="submit" class="zm-pb-button">' + esc(form.submit) + '</button></div></form>';
                }
            },
            view: { onRender: function() {
                var view = this;
                var render = function() {
                    var tmp = view.el.ownerDocument.createElement('div'); tmp.innerHTML = view.model.toHTML();
                    view.el.innerHTML = tmp.firstChild.innerHTML;
                    view.el.querySelectorAll('input,select,textarea,button').forEach(function(el) { el.disabled = true; });
                };
                this.listenTo(this.model, 'change:zmForm', render); render();
                this.el.addEventListener('submit', function(event) { event.preventDefault(); });
                this.el.addEventListener('click', function(event) { if (event.target.closest('.zm-pb-form-consent a')) event.preventDefault(); });
            } }
        });
    };
    api.renderContactControls = function(component, t, config) {
        var form = component.get('zmForm');
        var input = function(key, label, value, type) { return '<label class="zm-pb-field"><span>' + esc(t(label)) + '</span><input data-zm-control="' + key + '" type="' + (type || 'text') + '" value="' + esc(value) + '"></label>'; };
        var select = function(key, label, choices, current) {
            return '<label class="zm-pb-field"><span>' + esc(t(label)) + '</span><select data-zm-control="' + key + '">' + choices.map(function(choice) {
                return '<option value="' + esc(choice[0]) + '"' + (String(current) === String(choice[0]) ? ' selected' : '') + '>' + esc(t(choice[1])) + '</option>';
            }).join('') + '</select></label>';
        };
        var button = function(command, label, index) { return '<button type="button" data-zm-command="' + command + '" data-zm-field-index="' + index + '">' + esc(t(label)) + '</button>'; };
        var html = select('form-action', 'form_action', [['ticket', 'form_action_ticket'], ['email', 'form_action_email']], form.action);
        if (form.action === 'email') {
            html += input('form-recipient', 'form_recipient', form.recipient || '', 'email');
            html += select('form-email-format', 'form_email_format', [['system', 'form_email_system'], ['template', 'form_email_template']], form.emailFormat || 'system');
        }
        html += '<label class="zm-pb-field"' + (form.action === 'email' ? ' hidden' : '') + '><span>' + esc(t('form_department')) + '</span><select data-zm-control="form-department"><option value="">' + esc(t('form_choose')) + '</option>';
        (config.departments || []).forEach(function(dept) { html += '<option value="' + dept.id + '"' + (String(form.department) === String(dept.id) ? ' selected' : '') + '>' + esc(dept.name) + '</option>'; });
        html += '</select></label>' + input('form-title', 'form_title', form.title) + input('form-description', 'form_description', form.description) + input('form-subject', 'form_subject', form.subject) + input('form-submit', 'form_submit_label', form.submit);
        html += '<label class="zm-pb-check"><input type="checkbox" data-zm-control="form-captcha"' + (form.captcha ? ' checked' : '') + '> ' + esc(t('form_captcha')) + '</label>';
        html += '<p class="zm-pb-controls-hint">' + esc(t('form_captcha_source')) + '</p>';
        html += '<p class="zm-pb-controls-hint">' + esc(t('form_delivery_hint')) + '</p><div class="zm-pb-form-field-settings">';
        form.fields.forEach(function(field, index) {
            var prefix = 'form-field-' + index + '-';
            html += '<div class="zm-pb-form-field-card"><strong>' + (index + 1) + '. ' + esc(field.label) + '</strong>';
            html += input(prefix + 'label', 'form_field_label', field.label) + select(prefix + 'type', 'form_field_type', ['text', 'textarea', 'email', 'tel', 'url', 'number', 'date', 'select', 'checkbox', 'consent'].map(function(type) { return [type, 'field_type_' + type]; }), field.type);
            if (field.type === 'consent') {
                html += '<label class="zm-pb-field zm-pb-field-wide"><span>' + esc(t('form_consent_text')) + '</span><textarea rows="4" data-zm-control="' + prefix + 'text">' + esc(field.text || '') + '</textarea><small>' + esc(t('form_consent_hint')) + '</small></label>';
            } else {
                html += select(prefix + 'filter', 'form_field_filter', ['none', 'email', 'integer', 'number', 'url', 'phone'].map(function(filter) { return [filter, 'field_filter_' + filter]; }), field.filter || 'none');
                html += select(prefix + 'role', 'form_field_role', ['none', 'name', 'email', 'subject'].map(function(role) { return [role, 'field_role_' + role]; }), field.role || 'none');
                html += input(prefix + 'placeholder', 'form_field_placeholder', field.placeholder || '');
            }
            html += select(prefix + 'width', 'form_field_width', [[3, 'form_width_3'], [4, 'form_width_4'], [6, 'form_width_6'], [8, 'form_width_8'], [9, 'form_width_9'], [12, 'form_width_12']], fieldSpan(field));
            html += '<label class="zm-pb-check"><input type="checkbox" data-zm-control="' + prefix + 'breakBefore"' + (field.breakBefore ? ' checked' : '') + '> ' + esc(t('form_field_new_row')) + '</label>';
            if (field.type === 'select') html += '<label class="zm-pb-field zm-pb-field-wide"><span>' + esc(t('form_field_options')) + '</span><textarea rows="3" data-zm-control="' + prefix + 'options">' + esc(field.options || '') + '</textarea><small>' + esc(t('form_field_options_hint')) + '</small></label>';
            html += '<label class="zm-pb-check"><input type="checkbox" data-zm-control="' + prefix + 'required"' + (field.required ? ' checked' : '') + '> ' + esc(t('form_field_required')) + '</label>';
            html += '<div class="zm-pb-controls-actions">' + button('move-form-field-up', 'form_field_up', index) + button('move-form-field-down', 'form_field_down', index) + button('remove-form-field', 'form_field_remove', index) + '</div></div>';
        });
        return html + '</div><div class="zm-pb-controls-actions">' + button('add-form-field', 'form_field_add', -1) + '</div>';
    };
    api.applyContactControls = function(component, panel, t) {
        var value = function(key) { var el = panel.querySelector('[data-zm-control="' + key + '"]'); return el ? (el.type === 'checkbox' ? el.checked : el.value) : ''; };
        var old = component.get('zmForm');
        component.set('zmForm', Object.assign({}, old, { action: value('form-action'), department: value('form-department'),
            recipient: panel.querySelector('[data-zm-control="form-recipient"]') ? value('form-recipient') : old.recipient || '',
            emailFormat: panel.querySelector('[data-zm-control="form-email-format"]') ? value('form-email-format') : old.emailFormat || 'system',
            title: value('form-title'), description: value('form-description'), subject: value('form-subject'), submit: value('form-submit'), captcha: value('form-captcha'),
            fields: old.fields.map(function(field, index) {
                var updated = Object.assign({}, field), prefix = 'form-field-' + index + '-';
                ['label', 'type', 'filter', 'role', 'placeholder', 'required', 'width', 'breakBefore', 'text'].forEach(function(key) {
                    if (panel.querySelector('[data-zm-control="' + prefix + key + '"]')) updated[key] = value(prefix + key);
                });
                if (updated.type === 'consent') {
                    updated.filter = 'none'; updated.role = 'none';
                    if (field.type !== 'consent') {
                        updated.text = field.text || t('form_consent_default');
                        if (!updated.label || updated.label === t('form_new_field')) updated.label = t('field_type_consent');
                        updated.required = true; updated.width = 12; updated.breakBefore = true;
                    }
                }
                if (updated.type === 'select' && panel.querySelector('[data-zm-control="' + prefix + 'options"]')) updated.options = value(prefix + 'options');
                return updated;
            }) }));
    };
    api.contactFieldCommand = function(component, command, index, t) {
        var form = component.get('zmForm'), fields = form.fields.slice();
        if (command === 'add-form-field' && fields.length < 30) fields.push({ id: 'f_' + Math.random().toString(36).slice(2, 10), label: t('form_new_field'), type: 'text', filter: 'none', role: 'none', required: false, width: 6, breakBefore: false });
        else if (command === 'remove-form-field' && fields.length > 1) fields.splice(index, 1);
        else {
            var target = index + (command === 'move-form-field-up' ? -1 : 1);
            if (index >= 0 && index < fields.length && target >= 0 && target < fields.length) { var item = fields.splice(index, 1)[0]; fields.splice(target, 0, item); }
        }
        component.set('zmForm', Object.assign({}, form, { fields: fields }));
    };
})();
