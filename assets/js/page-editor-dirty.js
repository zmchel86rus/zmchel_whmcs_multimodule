/* Unsaved changes guard for the page editor's independently saved forms. */
(function() {
    var state = window.ZmPbPageDirty = {
        saved: Object.create(null),
        armedEditors: Object.create(null),
        contentChanged: Object.create(null),
        contentChangeRevision: Object.create(null),
        navigationApproved: false,

        contentLanguage: function(form) {
            return form.id.indexOf('form_content_') === 0 ? form.id.slice('form_content_'.length) : '';
        },

        projectSnapshot: function(editor) {
            var project = editor.getProjectData();
            // Compare authored content, not canvas geometry, asset-manager entries,
            // localized component labels or selector-panel state. Never modify the
            // actual project: the complete project is still submitted when saving.
            var componentUi = ['name', 'status', 'open', 'toolbar', 'traits', 'selected',
                'selectable', 'hoverable', 'highlightable', 'editable', 'draggable',
                'droppable', 'resizable', 'layerable', 'stylable', 'stylable-require',
                'unstylable', 'badgable', 'copyable', 'removable', '_undoexc'];
            var selector = function(value) {
                if (!value || typeof value !== 'object') return value;
                return { name: value.name, type: value.type };
            };
            var component = function(value) {
                if (Array.isArray(value)) return value.map(component);
                if (!value || typeof value !== 'object') return value;
                var result = {};
                Object.keys(value).forEach(function(key) {
                    if (componentUi.indexOf(key) !== -1) return;
                    if (key === 'components') result[key] = component(value[key]);
                    else if (key === 'classes' && Array.isArray(value[key])) result[key] = value[key].map(selector);
                    else result[key] = value[key];
                });
                return result;
            };
            var content = {
                pages: (project.pages || []).map(function(page) {
                    return (page.frames || []).map(function(frame) { return component(frame.component); });
                }),
                styles: (project.styles || []).map(function(rule) {
                    var result = Object.assign({}, rule);
                    if (Array.isArray(result.selectors)) result.selectors = result.selectors.map(selector);
                    return result;
                })
            };
            // Object key order can change after a remount/undo without any edits.
            var ordered = function(value) {
                if (Array.isArray(value)) return value.map(ordered);
                if (!value || typeof value !== 'object') return value;
                var result = {};
                Object.keys(value).sort().forEach(function(key) { result[key] = ordered(value[key]); });
                return result;
            };
            return JSON.stringify(ordered(content));
        },

        snapshot: function(form, forSave) {
            if (!form || !form.id) return null;
            var lang = this.contentLanguage(form);
            var fields = [];
            Array.prototype.forEach.call(form.elements, function(field) {
                // Only persisted page fields belong to this snapshot. GrapesJS,
                // TinyMCE and CodeMirror create their own named controls lazily.
                if (!/^edit_(?:main|content|meta|sitemap)\[/.test(field.name || '') ||
                    /^(?:submit|button|reset)$/i.test(field.type) ||
                    (field.closest && field.closest('.block-editor-container')) ||
                    (lang && field.name === 'edit_content[' + lang + '][content]')) return;
                var value;
                if (field.type === 'checkbox' || field.type === 'radio') value = field.checked ? field.value : null;
                else if (field.type === 'select-multiple') value = Array.prototype.filter.call(field.options, function(option) {
                    return option.selected;
                }).map(function(option) { return option.value; });
                else value = field.value;
                fields.push([field.name, value]);
            });
            var result = { fields: JSON.stringify(fields) };
            if (lang) {
                result.contentChangeRevision = this.contentChangeRevision[lang] || 0;
                var editor = window.BlockEditor && BlockEditor.editors[lang];
                var textarea = form.elements.namedItem('edit_content[' + lang + '][content]');
                var saved = this.saved[form.id];
                result.content = editor && (this.armedEditors[lang] || forSave) ?
                    this.projectSnapshot(editor) :
                    (saved ? saved.content : (textarea ? textarea.value : ''));
            }
            return result;
        },

        registerEditor: function(lang, editor) {
            var self = this;
            var container = document.getElementById('block_content_' + lang);
            // Include the module's toolbar as well as the GrapesJS canvas.
            var root = container && (container.closest('.block-editor-container') || container);
            var arm = function(event) {
                if (event.isTrusted !== false) self.armEditor(lang, editor);
            };
            var events = ['pointerdown', 'keydown', 'beforeinput', 'paste', 'drop'];
            if (root) events.forEach(function(type) { root.addEventListener(type, arm, true); });
            var canvasBody = null;
            var bindCanvas = function() {
                var body = editor.Canvas.getBody();
                if (!body || body === canvasBody) return;
                canvasBody = body;
                events.forEach(function(type) { body.addEventListener(type, arm, true); });
            };
            editor.on('load canvas:frame:load', bindCanvas);
            bindCanvas();
        },

        armEditor: function(lang, editor) {
            if (this.armedEditors[lang]) return;
            this.armedEditors[lang] = true;
            var saved = this.saved['form_content_' + lang];
            // GrapesJS can keep normalizing its project after the canvas is shown.
            // Start comparing only from the first user action in this editor.
            if (saved && !this.contentChanged[lang]) {
                saved.content = this.projectSnapshot(editor);
            }
        },

        markContentChanged: function(lang) {
            this.contentChanged[lang] = true;
            this.contentChangeRevision[lang] = (this.contentChangeRevision[lang] || 0) + 1;
        },

        markSaved: function(formId, submitted) {
            if (!submitted || !this.saved[formId]) return;
            this.saved[formId] = submitted;
            var lang = this.contentLanguage({ id: formId });
            if (lang && submitted.contentChangeRevision === (this.contentChangeRevision[lang] || 0)) {
                delete this.contentChanged[lang];
            }
        },

        sectionLabel: function(form) {
            var pane = form.closest('.tab-pane');
            var heading = pane && pane.querySelector('h3');
            if (heading) return heading.textContent.trim();
            var tab = pane && document.querySelector('a[href="#' + pane.id + '"]');
            return tab ? tab.textContent.trim() : form.id;
        },

        unsavedSections: function() {
            var self = this;
            return Array.prototype.filter.call(document.querySelectorAll('#zm-pagebuilder form[data-form-order]'), function(form) {
                var saved = self.saved[form.id];
                if (!saved) return false;
                var current = self.snapshot(form);
                var lang = self.contentLanguage(form);
                return current.fields !== saved.fields || (lang && self.contentChanged[lang]) || current.content !== saved.content;
            }).map(function(form) { return self.sectionLabel(form); });
        },

        confirmNavigation: function(event) {
            if (event.defaultPrevented || event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
            var link = event.target.closest && event.target.closest('a[href]');
            if (!link || link.hasAttribute('download') ||
                (link.target && link.target.toLowerCase() !== '_self') ||
                link.hasAttribute('data-toggle') || link.hasAttribute('data-bs-toggle') ||
                link.closest('.block-editor-container')) return;
            var href = (link.getAttribute('href') || '').trim();
            if (!href || href.charAt(0) === '#') return;
            var destination;
            try { destination = new URL(link.href, document.baseURI); } catch (error) { return; }
            if (!/^https?:$/.test(destination.protocol)) return;
            if (destination.hash && destination.origin === window.location.origin &&
                destination.pathname === window.location.pathname && destination.search === window.location.search) return;
            var sections = this.unsavedSections();
            if (!sections.length) return;
            var text = window.zmPbGrapesText || {};
            var message = (text.unsaved_changes || 'You have unsaved changes.') + '\n\n' +
                sections.map(function(section) { return '\u2022 ' + section; }).join('\n') + '\n\n' +
                (text.unsaved_leave_confirm || 'Leave this page without saving?');
            if (!window.confirm(message)) {
                event.preventDefault();
                event.stopImmediatePropagation();
                return;
            }
            // Let the link navigate normally, without a second browser prompt.
            // Reset if another handler cancels navigation or the response downloads a file.
            var self = this;
            self.navigationApproved = true;
            window.setTimeout(function() { self.navigationApproved = false; }, 1000);
        },

        init: function() {
            var self = this;
            Array.prototype.forEach.call(document.querySelectorAll('#zm-pagebuilder form[data-form-order]'), function(form) {
                self.saved[form.id] = self.snapshot(form);
            });
            document.addEventListener('click', function(event) { self.confirmNavigation(event); }, true);
            window.addEventListener('pageshow', function() { self.navigationApproved = false; });
            window.addEventListener('beforeunload', function(event) {
                if (self.navigationApproved) {
                    self.navigationApproved = false;
                    return;
                }
                var sections = self.unsavedSections();
                if (!sections.length) return;
                var text = (window.zmPbGrapesText && window.zmPbGrapesText.unsaved_changes) || 'You have unsaved changes.';
                event.preventDefault();
                event.returnValue = text + '\n' + sections.join(', ');
                return event.returnValue;
            });
        }
    };

    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', function() { state.init(); });
    else state.init();
})();
