/* Content-only GrapesJS editor for the WHMCS page builder. */
var BlockEditor = {
    editors: {},
    activeCode: null,
    activeRichText: null,
    text: window.zmPbGrapesText || {},
    config: window.zmPbGrapesConfig || {},

    t: function(key) { return this.text[key] || key; },

    init: function() {
        var self = this;
        if (!window.grapesjs) return;

        $('#zm-pb-whmcs-sidebar-toggle').on('click', function() {
            var hidden = $('body').toggleClass('zm-pb-hide-whmcs-sidebar').hasClass('zm-pb-hide-whmcs-sidebar');
            $(this).text(self.t(hidden ? 'sidebar_show' : 'sidebar_hide')).attr('aria-pressed', hidden ? 'true' : 'false');
            Object.keys(self.editors).forEach(function(lang) { self.editors[lang].refresh(); });
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
            var $active = $('#tab_content_page_settings.active .tab-pane.active .block-editor-content');
            if ($active.length) self.ensure($active.data('lang'));
        });

        $('.zm-pb-grapes-transfer').on('click', function() {
            var $wrap = $(this).closest('.block-editor-container');
            var source = $wrap.find('.block-editor-content').data('lang');
            var target = $wrap.find('.zm-pb-clone-target').val();
            if (!target || source === target) return;
            var mode = $(this).data('mode');
            if (mode !== 'copy-content' && mode !== 'copy-structure' && mode !== 'clone') return;
            var targetEditor = self.ensure(target);
            if (!targetEditor) return;
            var targetRoot = targetEditor.getWrapper();
            var hasTargetContent = targetRoot.components().length || String(targetRoot.get('content') || '').trim();
            if (mode === 'clone' && hasTargetContent) {
                var targetName = $wrap.find('.zm-pb-clone-target option:selected').text();
                if (!window.confirm(self.t('clone_confirm').replace('%s', targetName))) return;
            }
            self.syncBlocksToTextarea(null, source);
            var sourceEditor = self.editors[source];
            if (mode === 'clone') {
                targetEditor.loadProjectData(JSON.parse(JSON.stringify(sourceEditor.getProjectData())));
            } else {
                var sourceComponents = sourceEditor.getWrapper().components().models.slice();
                var components = [];
                sourceComponents.forEach(function(component) {
                    components.push(self.serializeComponent(component, mode));
                });
                if (!components.length) return;
                var appended = targetRoot.append(components);
                self.copyComponentStyles(sourceEditor, targetEditor, sourceComponents, appended);
            }
            if (window.ZmPbPageDirty) window.ZmPbPageDirty.markContentChanged(target);
            self.syncBlocksToTextarea(null, target);
            $('a[data-toggle="tab"][href="#tab_' + target + '"]').tab('show');
        });

        $('.zm-pb-grapes-action').on('click', function() {
            var $wrap = $(this).closest('.block-editor-container');
            var lang = $wrap.find('.block-editor-content').data('lang');
            var editor = self.ensure(lang);
            if (editor) self.runAction(editor, $(this).data('action'));
        });

        // The content tab is initially hidden in WHMCS. Initialize only when visible.
        var $active = $('#tab_content_page_settings.active .tab-pane.active .block-editor-content');
        if ($active.length) self.ensure($active.data('lang'));
    },

    parse: function(raw) {
        try {
            var data = JSON.parse(raw || '');
            return data && data.format === 'grapesjs' && data.project ? data : {};
        } catch (error) { return {}; }
    },

    serializeComponent: function(component, mode) {
        // GrapesJS toJSON() is shallow: its components value is a collection,
        // which cannot be passed back to append() as a component definition.
        var data = component.toJSON();
        delete data.components;
        data = JSON.parse(JSON.stringify(data));
        if (data.type === 'zm-contact-form') {
            data.zmForm = JSON.parse(JSON.stringify(component.get('zmForm') || {}));
            if (data.attributes) delete data.attributes['data-zm-pb-form'];
        }
        var self = this;
        data.components = component.components().models.map(function(child) {
            return self.serializeComponent(child, mode);
        });
        if (mode === 'copy-structure') this.clearComponentContent(data);
        return data;
    },

    clearComponentContent: function(data) {
        if (typeof data.content === 'string') data.content = '';
        if (data.type === 'zm-richtext') data.zmHtml = '';
        if (data.type === 'zm-code') data.zmCode = '';
        if (data.type === 'zm-progress') data.zmLabel = '';
        if (data.type === 'zm-smarty' && data.attributes) data.attributes['data-zm-pb-smarty'] = '';
        if (data.type === 'zm-contact-form' && data.zmForm) {
            ['title', 'description', 'subject', 'submit'].forEach(function(key) { data.zmForm[key] = ''; });
            (data.zmForm.fields || []).forEach(function(field) {
                ['label', 'placeholder', 'options', 'text'].forEach(function(key) { if (key in field) field[key] = ''; });
            });
        }
        if (data.attributes) {
            ['alt', 'title', 'placeholder', 'aria-label'].forEach(function(key) {
                if (key in data.attributes) data.attributes[key] = '';
            });
            if (data.type === 'image') {
                ['src', 'width', 'height', 'srcset', 'sizes', 'data-zm-pb-media-id', 'data-zm-pb-image-variants',
                    'data-zm-pb-mobile-src', 'data-zm-pb-mobile-variants',
                    'data-zm-pb-mobile-width', 'data-zm-pb-mobile-height'].forEach(function(key) {
                    delete data.attributes[key];
                });
            }
            if (data.type === 'zm-button' && 'data-zm-pb-onclick' in data.attributes) data.attributes['data-zm-pb-onclick'] = '';
            if (data.type === 'zm-button' && 'data-zm-pb-href' in data.attributes) data.attributes['data-zm-pb-href'] = '';
            if (data.type === 'link' && 'href' in data.attributes) data.attributes.href = '';
        }
        if (data.type === 'image') data.src = '';
        if (data.type === 'video') {
            data.src = '';
            data.videoId = '';
        }
        if (data.type === 'map') data.address = '';
    },

    copyComponentStyles: function(sourceEditor, targetEditor, sourceComponents, appended) {
        var idMap = Object.create(null);
        var mapIds = function(source, target) {
            if (!source || !target) return;
            var oldId = source.getId();
            var newId = target.getId();
            if (oldId !== newId) idMap[oldId] = newId;
            source.components().forEach(function(child, index) {
                mapIds(child, target.components().at(index));
            });
        };
        sourceComponents.forEach(function(component, index) { mapIds(component, appended[index]); });
        var remapPagination = function(component) {
            var target = component.getAttributes()['data-zm-pb-page-target'];
            if (target && idMap[target]) component.addAttributes({ 'data-zm-pb-page-target': idMap[target] });
            var owner = component.getAttributes()['data-zm-pb-page-owner'];
            if (owner && idMap[owner]) component.addAttributes({ 'data-zm-pb-page-owner': idMap[owner] });
            component.components().forEach(remapPagination);
        };
        appended.forEach(remapPagination);

        var rules = [];
        sourceComponents.forEach(function(component) {
            sourceEditor.getCss({ component: component, json: true, onlyMatched: true }).forEach(function(rule) {
                if (rules.indexOf(rule) < 0) rules.push(rule);
            });
        });
        rules.forEach(function(rule) {
            var selector = rule.selectorsToString().replace(/#([A-Za-z_][\w-]*)/g, function(match, id) {
                return idMap[id] ? '#' + idMap[id] : match;
            });
            if (!selector) return;
            var opts = { atRuleType: rule.get('atRuleType') || '', atRuleParams: rule.get('mediaText') || '' };
            if (targetEditor.Css.getRule(selector, opts)) return;
            var copied = targetEditor.Css.setRule(selector, JSON.parse(JSON.stringify(rule.get('style') || {})), opts);
            if (rule.get('important')) copied.set('important', rule.get('important'));
        });
    },

    copyBlockToLanguage: function(sourceEditor, sourceLang, component, targetLang, mode) {
        if (!component || !component.parent() || !targetLang || targetLang === sourceLang ||
            (mode !== 'copy-content' && mode !== 'copy-structure') ||
            component.get('type') === 'zm-spacer' || component.get('tagName') === 'hr') return;
        var targetEditor = this.ensure(targetLang);
        if (!targetEditor) return;
        this.syncBlocksToTextarea(null, sourceLang);
        var appended = targetEditor.getWrapper().append(this.serializeComponent(component, mode));
        this.copyComponentStyles(sourceEditor, targetEditor, [component], appended);
        if (window.ZmPbPageDirty) window.ZmPbPageDirty.markContentChanged(targetLang);
        this.syncBlocksToTextarea(null, targetLang);
        $('a[data-toggle="tab"][href="#tab_' + targetLang + '"]').tab('show');
    },

    ensure: function(lang) {
        if (this.editors[lang]) {
            this.editors[lang].refresh();
            return this.editors[lang];
        }
        var container = document.getElementById('block_content_' + lang);
        if (!container) return null;
        var self = this;
        var code = this.config.locale || 'en';
        var messages = {};
        messages[code] = window.zmPbGrapesLocale || {};
        var editor = grapesjs.init({
            container: container,
            height: '650px',
            width: 'auto',
            fromElement: false,
            protectedCss: '',
            storageManager: false,
            noticeOnUnload: false,
            selectorManager: { componentFirst: true },
            i18n: { locale: code, detectLocale: false, localeFallback: 'en', messages: messages },
            canvas: { styles: [this.config.contentCssUrl, this.config.grapesEditorCssUrl, this.config.codeMirrorCssUrl, this.config.codeMirrorThemeUrl].filter(Boolean) },
            deviceManager: { devices: [
                { name: 'Desktop', width: '' },
                { name: 'Tablet', width: '768px', widthMedia: '991px' },
                { name: 'Mobile', width: '375px', widthMedia: '767px' }
            ] }
        });
        this.editors[lang] = editor;
        this.registerComponents(editor);
        this.registerBlocks(editor);
        this.installControls(editor, lang);
        var pasteHandlers = new WeakMap();
        editor.on('rte:enable', function(view, rte) {
            var el = view && view.el;
            if (!el || pasteHandlers.has(el)) return;
            var onPaste = function(event) {
                var html = event.clipboardData && event.clipboardData.getData('text/html');
                if (!html || !rte || typeof rte.insertHTML !== 'function') return;
                var cleaned = self.cleanPastedHtml(html, el.ownerDocument);
                if (cleaned === null) return;
                event.preventDefault();
                event.stopPropagation();
                rte.insertHTML(cleaned);
            };
            el.addEventListener('paste', onPaste, true);
            pasteHandlers.set(el, onPaste);
        });
        editor.on('rte:disable', function(view) {
            var el = view && view.el;
            var onPaste = el && pasteHandlers.get(el);
            if (!onPaste) return;
            el.removeEventListener('paste', onPaste, true);
            pasteHandlers.delete(el);
        });
        editor.on('component:add', function(component) { self.labelComponent(component); });
        editor.on('component:mount', function(component) { self.labelComponent(component); });
        editor.Commands.add('sw-visibility', {
            run: function(current) {
                var body = current.Canvas.getBody();
                if (body) body.classList.add('zm-pb-show-components');
            },
            stop: function(current) {
                var body = current.Canvas.getBody();
                if (body) body.classList.remove('zm-pb-show-components');
            }
        });

        var payload = this.parse($('.editor_content_' + lang).val());
        if (payload.project) editor.loadProjectData(payload.project);
        var labelTree = function(component) {
            self.labelComponent(component);
            component.components().forEach(labelTree);
        };
        labelTree(editor.getWrapper());
        if (window.ZmPbPageDirty) window.ZmPbPageDirty.registerEditor(lang, editor);

        editor.on('component:selected', function() {
            // Wait for the iframe pointer event to finish before changing the
            // selected component's DOM (CodeMirror lives inside that DOM).
            setTimeout(function() { self.updateActions(editor, lang); }, 0);
        });
        editor.on('component:deselected', function() {
            setTimeout(function() {
                var active = self.activeCode;
                if (active && active.owner === editor && active.component.parent() &&
                    (!editor.getSelected() || editor.getSelected() === active.component) &&
                    ((active.editor && active.editor.hasFocus()) ||
                        active.textarea === active.textarea.ownerDocument.activeElement)) {
                    if (editor.getSelected() !== active.component) editor.select(active.component);
                    return;
                }
                self.updateActions(editor, lang);
            }, 0);
        });
        editor.on('component:remove', function() {
            if (self.activeRichText && !self.activeRichText.component.parent()) self.deactivateRichText();
            setTimeout(function() { self.updateActions(editor, lang); }, 0);
        });
        editor.on('component:update:attributes', function(component) {
            if (editor.getSelected() === component) self.updateActions(editor, lang);
        });
        editor.on('component:dblclick', function(component) {
            if (component.get('type') === 'zm-smarty') self.editDynamic(editor, component);
            else if (component.get('type') === 'image') self.chooseImage(editor);
        });
        editor.on('asset:open', function() { self.chooseImage(editor); });
        editor.on('load', function() {
            var frameBody = editor.Canvas.getBody();
            if (frameBody) frameBody.classList.add('zm-pb-editor-canvas');
            self.updateActions(editor, lang);
            editor.refresh();
        });
        setTimeout(function() { editor.refresh(); }, 0);
        return editor;
    },

    registerComponents: function(editor) {
        var api = window.ZmPbComponents;
        var t = this.t.bind(this);
        api.registerLayout(editor, t);
        api.registerStructure(editor, t);
        api.registerBasic(editor, t);
        api.registerRichText(editor, t);
        api.registerDynamic(editor, t, this);
        api.registerWidgets(editor, t);
        api.registerTableOfContents(editor, t);
        api.registerPagination(editor, t);
        api.registerListControls(editor, t);
        api.registerContactForm(editor, t, this.config);
    },

    registerBlocks: function(editor) {
        var self = this;
        var api = window.ZmPbComponents;
        var blocks = editor.Blocks;
        var add = function(id, category, content, opts) {
            blocks.add(id, Object.assign({ label: self.t(id), category: self.t(category), content: content, select: true }, opts || {}));
        };
        var editableText = function(text, tagName) {
            return { type: 'text', tagName: tagName || 'p', editable: true, components: text };
        };
        var layoutCell = function(style) {
            return { tagName: 'div', attributes: { class: 'zm-pb-layout-cell' }, droppable: true,
                style: style || {}, components: [editableText(self.t('text'))] };
        };
        add('text', 'category_content', { type: 'text', tagName: 'p', components: self.t('text') });
        add('rich_text', 'category_content', { type: 'zm-richtext' });
        add('heading', 'category_content', { type: 'zm-heading', components: self.t('heading') });
        add('image', 'category_content', { type: 'image', attributes: { alt: '' } });
        add('video', 'category_content', { type: 'video' });
        add('map', 'category_content', { type: 'map' });
        add('link', 'category_content', { type: 'link', components: self.t('link'), attributes: { href: '#', 'data-zm-pb-localize-link': '1' } });
        add('button', 'category_content', { type: 'zm-button', components: self.t('button'), attributes: {
            class: 'zm-pb-button', 'data-zm-pb-button': '1', type: 'button', 'data-zm-pb-action': 'none',
            'data-zm-pb-localize-link': '1'
        } });
        add('quote', 'category_content', editableText(self.t('quote_text'), 'blockquote'));
        add('list', 'category_content', api.list(self.t('list_item')));
        add('table', 'category_content', api.table(self.t('table_cell')));
        add('faq', 'category_content', api.faq(self.t.bind(self)));
        add('accordion', 'category_content', api.singleAccordion(self.t.bind(self)));
        add('table_of_contents', 'category_content', { type: 'zm-toc' });
        add('pagination', 'category_content', { type: 'zm-pagination' });
        add('list_filters', 'category_content', { type: 'zm-filters' });
        add('contact_form', 'category_content', { type: 'zm-contact-form' });
        add('progress', 'category_content', { type: 'zm-progress' });
        add('divider', 'category_content', { tagName: 'hr' });
        add('plain_div', 'category_layout', { type: 'zm-plain-div' });
        add('spacer', 'category_layout', { type: 'zm-spacer' });
        add('section', 'category_layout', api.layout(self.t('text'), 'columns', 1));
        add('flex', 'category_layout', api.layout(self.t('text'), 'flex', 2));
        add('grid', 'category_layout', api.layout(self.t('text'), 'grid', 2));
        add('image_text', 'category_layout', { tagName: 'div', attributes: { class: 'zm-pb-flex' }, droppable: true,
            style: { display: 'flex', gap: '16px', 'flex-wrap': 'wrap' }, components: [
                { tagName: 'div', attributes: { class: 'zm-pb-layout-cell' }, droppable: true,
                    style: { flex: '1 1 220px' }, components: [{ type: 'image', attributes: { alt: '' } }] },
                layoutCell({ flex: '1 1 220px' })
            ] });
        add('hero', 'category_layout', { tagName: 'section', attributes: { class: 'zm-pb-hero' }, droppable: true,
            components: [editableText(self.t('heading'), 'h2'), editableText(self.t('text')),
                { type: 'link', attributes: { href: '#', class: 'zm-pb-button', 'data-zm-pb-localize-link': '1' }, components: self.t('button') }] });
        add('card', 'category_layout', { tagName: 'article', attributes: { class: 'zm-pb-card' }, droppable: true,
            components: [{ type: 'image', attributes: { alt: '' } }, { type: 'zm-heading', tagName: 'h3', components: self.t('heading') }, editableText(self.t('text'))] });
        add('callout', 'category_layout', { tagName: 'aside', attributes: { class: 'zm-pb-callout' }, droppable: true,
            components: [editableText(self.t('text'))] });
        add('gallery', 'category_layout', { tagName: 'div', attributes: { class: 'zm-pb-gallery' }, droppable: true,
            components: [{ type: 'image', attributes: { alt: '' } }, { type: 'image', attributes: { alt: '' } }] });
        add('carousel', 'category_layout', { type: 'zm-carousel', components: [
            { tagName: 'div', attributes: { class: 'zm-pb-carousel-track' }, components: [
                { type: 'zm-slide' }, { type: 'zm-slide' }
            ] }
        ] });
        ['auth', 'guest', 'mixed'].forEach(function(zone) {
            add(zone, 'category_dynamic', { type: 'zm-auth', attributes: { 'data-zm-pb-auth': zone, class: 'zm-pb-auth-zone' }, components: [
                { type: 'text', tagName: 'p', components: self.t('text') }
            ] });
        });
        if (this.config.useSmarty) add('smarty', 'category_dynamic', { type: 'zm-smarty', attributes: { 'data-zm-pb-smarty': '', class: 'zm-pb-editor-placeholder' }, components: self.t('smarty') });
        add('custom_css', 'category_dynamic', { type: 'zm-code', attributes: { 'data-zm-pb-code': 'css', class: 'zm-pb-editor-placeholder' }, components: '' });
        add('custom_js', 'category_dynamic', { type: 'zm-code', attributes: { 'data-zm-pb-code': 'js', class: 'zm-pb-editor-placeholder' }, components: '' });
    },

    labelComponent: function(component) {
        var captionClass = ' ' + (component.getAttributes().class || '') + ' ';
        if (component.get('tagName') === 'summary' || captionClass.indexOf(' zm-pb-accordion-answer ') !== -1) {
            var ancestor = component.parent(), faq = false;
            while (ancestor) {
                if (ancestor.getAttributes()['data-zm-pb-faq'] === '1') { faq = true; break; }
                ancestor = ancestor.parent();
            }
            component.set('name', this.t(component.get('tagName') === 'summary'
                ? (faq ? 'accordion_question' : 'accordion_title') : (faq ? 'accordion_answer' : 'accordion_content')));
            return;
        }
        var existingName = component.get('name');
        if (existingName && existingName !== component.get('type') && existingName !== component.get('tagName')) return;
        var attrs = component.getAttributes();
        var classes = ' ' + (attrs.class || '') + ' ';
        var classLabels = { 'zm-pb-hero': 'hero', 'zm-pb-card': 'card', 'zm-pb-callout': 'callout',
            'zm-pb-gallery': 'gallery', 'zm-pb-flex': 'image_text', 'zm-pb-carousel-track': 'carousel_track',
            'zm-pb-layout-cell': 'layout_cell', 'zm-pb-accordion-answer': 'accordion_answer',
            'zm-pb-spacer': 'spacer', 'zm-pb-button': 'button', 'zm-pb-plain-div': 'plain_div' };
        var key = null;
        Object.keys(classLabels).some(function(name) {
            if (classes.indexOf(' ' + name + ' ') < 0) return false;
            key = classLabels[name];
            return true;
        });
        if (!key) {
            var types = { image: 'image', video: 'video', map: 'map', link: 'link', 'zm-heading': 'heading',
                'zm-button': 'button', 'zm-spacer': 'spacer', 'zm-plain-div': 'plain_div', 'zm-slide': 'slide', 'zm-accordion-item': 'accordion_item', 'zm-toc': 'table_of_contents', 'zm-pagination': 'pagination', 'zm-search': 'list_search', 'zm-filters': 'list_filters' };
            var tags = { body: 'content_area', div: 'container', section: 'section', article: 'card', aside: 'callout',
                hr: 'divider', p: 'text', blockquote: 'quote', li: 'list_item', summary: 'accordion_question',
                details: 'accordion_item', thead: 'table_header', tbody: 'table_body', tfoot: 'table_footer',
                tr: 'table_row', td: 'table_cell', th: 'table_cell', span: 'text' };
            var tag = (component.get('tagName') || '').toLowerCase();
            key = types[component.get('type')] || (tag.charAt(0) === 'h' && /^h[1-6]$/.test(tag) ? 'heading' : tags[tag]);
        }
        if (key) component.set('name', this.t(key));
    },

    updateActions: function(editor, lang) {
        var selected = editor.getSelected();
        var active = this.activeCode;
        // GrapesJS can select the DOM created by CodeMirror instead of its host
        // component. Restore the host only for a pointer event inside that host.
        if (active && active.owner === editor && active.component !== selected &&
            active.component.parent() &&
            ((active.clickInside && Date.now() - active.clickAt < 200) ||
                (!selected && ((active.editor && active.editor.hasFocus()) ||
                    active.textarea === active.textarea.ownerDocument.activeElement)))) {
            editor.select(active.component);
            return;
        }
        var type = selected ? selected.get('type') : '';
        var $wrap = $('#block_editor_' + lang);
        $wrap.find('[data-action="image"]').toggle(type === 'image');
        $wrap.find('[data-action="slide"]').toggle(type === 'zm-carousel' || type === 'zm-slide');
        this.activateCode(type === 'zm-code' ? selected : null, editor);
        var richText = selected;
        while (richText && richText.get('type') !== 'zm-richtext') richText = richText.parent();
        if (richText) this.activateRichText(richText);
        else if (selected && this.activeRichText) this.deactivateRichText();
        this.updateControls(editor, lang);
    },

    managedParent: function(component) { return window.ZmPbComponents.controls.managedParent.call(this, component); },
    installControls: function(editor, lang) { return window.ZmPbComponents.controls.installControls.call(this, editor, lang); },
    updateControls: function(editor, lang) { return window.ZmPbComponents.controls.updateControls.call(this, editor, lang); },
    flushControls: function(editor, lang) { return window.ZmPbComponents.controls.flushControls.call(this, editor, lang); },

    activateCode: function(component, editor) {
        if (this.activeCode && this.activeCode.component === component) {
            this.activeCode.owner = editor;
            var currentCss = component.getAttributes()['data-zm-pb-code'] === 'css';
            var currentTitle = component.getEl() && component.getEl().querySelector('strong');
            if (currentTitle) currentTitle.textContent = this.t(currentCss ? 'code_css_label' : 'code_js_label');
            var mode = currentCss ? 'text/css' : 'text/javascript';
            if (this.activeCode.editor && this.activeCode.editor.getOption('mode') !== mode)
                this.activeCode.editor.setOption('mode', mode);
            return;
        }
        this.deactivateCode();
        if (!component) return;
        var el = component.getEl();
        if (!el) return;
        var doc = el.ownerDocument;
        var css = component.getAttributes()['data-zm-pb-code'] === 'css';
        var title = doc.createElement('strong');
        title.textContent = this.t(css ? 'code_css_label' : 'code_js_label');
        var textarea = doc.createElement('textarea');
        textarea.value = component.get('zmCode') || '';
        el.replaceChildren(title, textarea);
        var self = this;
        var entry = this.activeCode = { component: component, owner: editor, element: el, textarea: textarea, editor: null };
        entry.trackPointer = function(event) {
            entry.clickInside = el.contains(event.target);
            entry.clickAt = Date.now();
        };
        doc.addEventListener('pointerdown', entry.trackPointer, true);
        doc.addEventListener('mousedown', entry.trackPointer, true);
        entry.stopSelection = function(event) { event.stopPropagation(); };
        ['pointerdown', 'mousedown', 'mouseup', 'click', 'dblclick'].forEach(function(type) {
            el.addEventListener(type, entry.stopSelection);
        });
        if (window.CodeMirror) {
            entry.editor = CodeMirror.fromTextArea(textarea, {
                mode: css ? 'text/css' : 'text/javascript', theme: 'monokai',
                lineNumbers: true, lineWrapping: true, viewportMargin: 10, indentUnit: 4
            });
            entry.editor.on('change', function(instance) { component.set('zmCode', instance.getValue()); });
            entry.editor.on('focus', function() {
                if (entry.owner && entry.owner.getSelected() !== component) entry.owner.select(component);
            });
            var wrapper = entry.editor.getWrapperElement();
            wrapper.addEventListener('pointerdown', function(event) { event.stopPropagation(); });
            wrapper.addEventListener('mousedown', function(event) { event.stopPropagation(); });
            wrapper.addEventListener('click', function(event) { event.stopPropagation(); });
            setTimeout(function() {
                if (self.activeCode === entry && entry.editor) entry.editor.refresh();
            }, 0);
        } else {
            textarea.addEventListener('input', function() { component.set('zmCode', textarea.value); });
            textarea.addEventListener('focus', function() {
                if (entry.owner && entry.owner.getSelected() !== component) entry.owner.select(component);
            });
        }
    },

    deactivateCode: function() {
        var entry = this.activeCode;
        if (!entry) return;
        var value = entry.editor ? entry.editor.getValue() : entry.textarea.value;
        entry.element.ownerDocument.removeEventListener('pointerdown', entry.trackPointer, true);
        entry.element.ownerDocument.removeEventListener('mousedown', entry.trackPointer, true);
        ['pointerdown', 'mousedown', 'mouseup', 'click', 'dblclick'].forEach(function(type) {
            entry.element.removeEventListener(type, entry.stopSelection);
        });
        if (entry.editor) entry.editor.toTextArea();
        this.activeCode = null;
        entry.component.set('zmCode', value);
        if (entry.component.view && entry.component.view.renderCodePreview) entry.component.view.renderCodePreview();
    },

    stripPastedColors: function(root) {
        var changed = false;
        var clean = function(el) {
            if (el.nodeType !== 1) return;
            var tag = el.tagName.toLowerCase();
            if (tag === 'style' || (tag === 'link' && (el.getAttribute('rel') || '').toLowerCase() === 'stylesheet')) {
                el.remove();
                changed = true;
                return;
            }
            ['class', 'color', 'bgcolor', 'background'].forEach(function(attribute) {
                if (el.hasAttribute(attribute)) {
                    el.removeAttribute(attribute);
                    changed = true;
                }
            });
            var style = el.style;
            if (!style) return;
            for (var i = style.length - 1; i >= 0; i--) {
                var property = style[i].toLowerCase();
                if (property === 'color' || property.indexOf('background') === 0 ||
                    property === '-webkit-text-fill-color' || property === '-webkit-text-stroke-color') {
                    style.removeProperty(property);
                    changed = true;
                }
            }
            if (!style.length) el.removeAttribute('style');
        };
        clean(root);
        var elements = root.querySelectorAll('*');
        for (var i = 0; i < elements.length; i++) clean(elements[i]);
        return changed;
    },

    cleanPastedHtml: function(html, doc) {
        var container = doc.createElement('div');
        container.innerHTML = html;
        return this.stripPastedColors(container) ? container.innerHTML : null;
    },

    activateRichText: function(component) {
        if (this.activeRichText && this.activeRichText.component === component) return;
        this.deactivateRichText();
        if (!component || !window.tinymce) return;
        var el = component.getEl();
        if (!el) return;
        var textarea = el.ownerDocument.createElement('textarea');
        textarea.value = component.get('zmHtml') || '<p><br></p>';
        el.replaceChildren(textarea);
        var entry = this.activeRichText = { component: component, element: el, textarea: textarea, editor: null };
        var stopEvents = function(event) { event.stopPropagation(); };
        entry.stopEvents = stopEvents;
        ['mousedown', 'click', 'dblclick', 'keydown', 'keyup', 'keypress', 'input', 'paste'].forEach(function(type) {
            el.addEventListener(type, stopEvents);
        });
        tinymce.init({
            target: textarea, license_key: 'gpl', base_url: this.config.tinyMceBaseUrl,
            language: this.config.tinyMceLanguage || 'en',
            menubar: false, plugins: 'lists link image table code',
            paste_postprocess: function(_instance, data) { BlockEditor.stripPastedColors(data.node); },
            // Keep semantic <i> and empty icon elements instead of normalizing to <em>.
            extended_valid_elements: 'i[*]',
            formats: { italic: { inline: 'i' } },
            setup: function(instance) {
                instance.on('PreInit', function() {
                    instance.schema.getNonEmptyElements().i = true;
                });
                instance.on('input change undo redo', function() {
                    if (BlockEditor.activeRichText === entry) component.set('zmHtml', instance.getContent());
                });
            },
            toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image table | alignleft aligncenter alignright | code',
            height: 300, resize: true, statusbar: true,
            branding: false, promotion: false
        }).then(function(instances) {
            if (entry !== BlockEditor.activeRichText) {
                if (instances[0]) instances[0].remove();
                return;
            }
            entry.editor = instances[0] || null;
            if (entry.editor) entry.editor.focus();
        }).catch(function(error) { console.error('TinyMCE initialization failed', error); });
    },

    deactivateRichText: function() {
        var entry = this.activeRichText;
        if (!entry) return;
        this.activeRichText = null;
        var html = entry.editor ? entry.editor.getContent() : entry.textarea.value;
        if (entry.editor) entry.editor.remove();
        ['mousedown', 'click', 'dblclick', 'keydown', 'keyup', 'keypress', 'input', 'paste'].forEach(function(type) {
            entry.element.removeEventListener(type, entry.stopEvents);
        });
        entry.component.set('zmHtml', html);
        if (entry.component.view && entry.component.view.renderRichTextPreview) entry.component.view.renderRichTextPreview();
    },

    runAction: function(editor, action) {
        var selected = editor.getSelected();
        if (action === 'image') this.chooseImage(editor);
        if (action === 'edit' && selected) this.editDynamic(editor, selected);
        if (action === 'slide' && selected) {
            var carousel = selected.get('type') === 'zm-slide' ? selected.parent().parent() : selected;
            if (carousel && carousel.get('type') === 'zm-carousel') {
                var track = carousel.components().at(0);
                track.append({ type: 'zm-slide' });
            }
        }
    },

    chooseImage: function(editor) {
        var selected = editor.getSelected();
        if (!selected || selected.get('type') !== 'image') return;
        if (editor.AssetManager.close) editor.AssetManager.close();
        var self = this;
        MediaManager.open(function(file) {
            if (!file || !file.url || !file.is_image) return;
            var attrs = {};
            selected.set('src', file.url);
            attrs.src = file.url;
            attrs.alt = file.alt || file.name || '';
            attrs.width = String(file.width || '');
            attrs.height = String(file.height || '');
            attrs['data-zm-pb-image-variants'] = JSON.stringify(file.variants || {});
            attrs['data-zm-pb-media-id'] = String(file.id || '');
            attrs.sizes = '100vw';
            selected.addAttributes(attrs);
            Object.keys(self.editors).forEach(function(lang) {
                if (self.editors[lang] === editor && editor.getSelected() === selected) self.updateActions(editor, lang);
            });
        });
    },

    chooseBackgroundImage: function(editor, component, lang) {
        if (!component || component.get('type') !== 'zm-plain-div') return;
        var self = this;
        MediaManager.open(function(file) {
            if (!component.parent() || !file || !file.url) return;
            window.ZmPbComponents.setContainerBackground(component, file.url);
            self.updateControls(editor, lang);
            editor.refresh();
        });
    },

    editDynamic: function(editor, component) {
        var type = component.get('type');
        if (type !== 'zm-code' && type !== 'zm-smarty') return;
        if (type === 'zm-smarty') {
            window.ZmPbSmartyEditor.open(editor, component, this);
            return;
        }
        var isCode = type === 'zm-code';
        var $modal = $('#zm-pb-grapes-edit-modal');
        var $input = $modal.find('textarea');
        $modal.find('.zm-pb-modal-title').text(this.t(isCode ? 'edit_code' : 'edit_variable'));
        $input.val(isCode ? (component.get('zmCode') || '') : (component.getAttributes()['data-zm-pb-smarty'] || ''));
        $input.attr('placeholder', isCode ? this.t('code_hint') : this.t('expression'));
        $modal.css('display', 'flex').attr('aria-hidden', 'false');
        $input.trigger('focus');
        $modal.find('.zm-pb-modal-save').off('click').on('click', function() {
            var value = $input.val();
            if (isCode) component.set('zmCode', value);
            else component.addAttributes({ 'data-zm-pb-smarty': value });
            $modal.hide().attr('aria-hidden', 'true');
        });
        $modal.find('.zm-pb-modal-cancel').off('click').on('click', function() {
            $modal.hide().attr('aria-hidden', 'true');
        });
    },

    syncBlocksToTextarea: function(_container, lang) {
        var editor = this.editors[lang] || this.ensure(lang);
        if (!editor) return;
        this.flushControls(editor, lang);
        this.deactivateRichText();
        this.deactivateCode();
        var codes = [];
        var used = {};
        var visit = function(component) {
            if (component.get('type') === 'zm-code') {
                if (component.components().length) component.components().reset();
                var attrs = component.getAttributes();
                var id = attrs['data-zm-pb-code-id'];
                if (!id || used[id]) {
                    id = 'code_' + Math.random().toString(36).slice(2, 14);
                    component.addAttributes({ 'data-zm-pb-code-id': id });
                }
                used[id] = true;
                codes.push({ id: id, type: attrs['data-zm-pb-code'] === 'css' ? 'css' : 'js', code: component.get('zmCode') || '' });
            }
            component.components().forEach(visit);
        };
        visit(editor.getWrapper());
        var data = {
            format: 'grapesjs',
            project: editor.getProjectData(),
            html: editor.getHtml().trim().replace(/^<body(?:\s[^>]*)?>([\s\S]*)<\/body>$/i, '$1'),
            css: editor.getCss(),
            code: codes
        };
        $('.editor_content_' + lang).val(JSON.stringify(data));
        this.updateActions(editor, lang);
    },

    encodeContentForTransport: function(formData, lang) {
        var field = 'edit_content[' + lang + '][content]';
        var raw = $('.editor_content_' + lang).val() || '';
        if (raw) formData.set(field, 'zm_pb_b64:' + btoa(unescape(encodeURIComponent(raw))));
    },

    updateCodeAssetFiles: function($container, content) {
        var lang = $container.data('lang');
        $('.editor_content_' + lang).val(content);
    }
};

document.addEventListener('DOMContentLoaded', function() { BlockEditor.init(); });
