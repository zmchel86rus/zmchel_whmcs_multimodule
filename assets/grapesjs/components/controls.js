(function() {
    window.ZmPbComponents = window.ZmPbComponents || {};
    var api = window.ZmPbComponents;
    api.controls = {
        managedParent: function(component) {
            var selected = component;
            var types = ['zm-layout', 'zm-plain-div', 'zm-list', 'zm-table', 'zm-carousel', 'zm-accordion', 'zm-accordion-item', 'zm-toc', 'zm-pagination', 'zm-search', 'zm-filters', 'zm-contact-form', 'zm-progress', 'zm-heading', 'zm-button', 'zm-spacer', 'zm-smarty', 'image', 'video', 'map', 'link'];
            while (component && types.indexOf(component.get('type')) < 0) component = component.parent();
            if (!component && selected && selected.parent()) {
                component = selected;
                while (component.parent() && component.parent().parent()) component = component.parent();
                if (component.get('tagName') === 'hr') return null;
            }
            if (component && component.get('type') === 'zm-accordion-item' && component.parent() && component.parent().get('type') === 'zm-accordion') return component.parent();
            return component;
        },

        accordionItem: function(component, accordion) {
            while (component && component !== accordion && component.get('type') !== 'zm-accordion-item') component = component.parent();
            return component && component.get('type') === 'zm-accordion-item' && component.parent() === accordion ? component : null;
        },

        installControls: function(editor, lang) {
            var self = this;
            if (typeof this.controlsCollapsed !== 'boolean') {
                this.controlsCollapsed = document.cookie.split(';').some(function(item) {
                    return item.trim() === 'zm_pb_block_controls_collapsed=1';
                });
            }
            var panel = document.createElement('section');
            panel.className = 'zm-pb-component-controls';
            panel.classList.toggle('is-collapsed', this.controlsCollapsed);
            panel.setAttribute('aria-label', self.t('block_settings'));
            var dock = function() {
                var canvas = editor.Canvas.getElement();
                if (canvas && panel.parentNode !== canvas) canvas.appendChild(panel);
                if (canvas && state.canvasElement !== canvas) {
                    state.canvasElement = canvas;
                    canvas.addEventListener('mousedown', function(event) {
                        if (event.target === canvas) {
                            editor.select(null);
                            self.updateControls(editor, lang);
                        }
                    });
                }
                reserveSpace();
                var body = editor.Canvas.getBody();
                if (body && state.canvasBody !== body) {
                    state.canvasBody = body;
                    body.addEventListener('mousedown', function(event) {
                        var wrapper = editor.getWrapper();
                        var wrapperElement = wrapper && wrapper.getEl();
                        if (event.target === body || event.target === wrapperElement) {
                            editor.select(null);
                            self.updateControls(editor, lang);
                        }
                    });
                }
            };
            editor.on('load', dock);
            editor.on('canvas:frame:load', dock);
            setTimeout(dock, 0);
            this.controlsState = this.controlsState || {};
            var state = this.controlsState[lang] = { panel: panel, component: null, child: null, displayedComponent: null,
                updating: false, inputTimer: null, pendingField: null, targetLanguage: null, canvasElement: null, canvasBody: null };
            var reserveSpace = function() {
                var body = editor.Canvas.getBody();
                if (body) body.style.setProperty('padding-top', 
                    //self.controlsCollapsed ? '64px' : '208px', 'important'
                    '208px', 'important'
                );
            };
            state.reserveSpace = reserveSpace;
            var $panel = $(panel);
            $panel.on('mousedown', function(event) { event.stopPropagation(); });
            var applyControls = function(renderPanel) {
                var component = state.component;
                if (!component) return;
                state.pendingField = null;
                var value = function(key) { return $panel.find('[data-zm-control="' + key + '"]').val(); };
                state.updating = true;
                try {
                    if (component.get('type') === 'zm-plain-div') {
                        api.setContainerBackground(component, value('background-image'));
                        component.addStyle({ 'min-height': Math.min(2000, Math.max(0, parseInt(value('div-min-height'), 10) || 0)) + 'px' });
                    } else if (component.get('type') === 'zm-layout') {
                        api.setLayout(component, { kind: value('kind'), columns: value('columns'), rows: value('rows'),
                            sidebar: value('sidebar'), direction: value('direction'), wrap: value('wrap'), gap: value('gap'),
                            tabletColumns: value('tablet-columns'), mobileColumns: value('mobile-columns') }, self.t('text'));
                        var cell = api.layoutCell(state.child, component);
                        if (cell && $panel.find('[data-zm-control="cell-width"], [data-zm-control="cell-colspan"]').length) {
                            api.setLayoutCell(cell, { width: value('cell-width'), tabletWidth: value('cell-tablet-width'),
                                mobileWidth: value('cell-mobile-width'), colspan: value('cell-colspan'), rowspan: value('cell-rowspan') });
                        }
                    } else if (component.get('type') === 'zm-list') {
                        component.set('tagName', value('ordered') === '1' ? 'ol' : 'ul');
                    } else if (component.get('type') === 'zm-table') {
                        api.setTable(component, { rows: value('rows'), columns: value('columns'),
                            thead: $panel.find('[data-zm-control="thead"]').prop('checked'),
                            tfoot: $panel.find('[data-zm-control="tfoot"]').prop('checked') }, self.t('table_cell'));
                    } else if (component.get('type') === 'zm-progress') {
                        var max = Math.max(1, parseInt(value('progress-max'), 10) || 100);
                        component.set({ zmLabel: value('progress-label') || '', zmValue: Math.min(max, Math.max(0, parseInt(value('progress-value'), 10) || 0)),
                            zmMax: max, zmColor: value('progress-color') || 'blue' });
                    } else if (component.get('type') === 'zm-heading') {
                        component.set('tagName', value('heading-level'));
                        component.addAttributes({ 'data-zm-pb-heading-size': String(Math.min(5, Math.max(1, parseFloat(value('heading-size')) || 2))) });
                        component.addStyle({ 'font-weight': value('heading-weight') || '700' });
                    } else if (component.get('type') === 'zm-toc') {
                        var tocMin = Math.max(1, Math.min(6, parseInt(value('toc-min'), 10) || 1));
                        component.addAttributes({ 'data-zm-pb-toc-title': value('toc-title') || '', 'data-zm-pb-toc-min': String(tocMin),
                            'data-zm-pb-toc-max': String(Math.max(tocMin, Math.min(6, parseInt(value('toc-max'), 10) || 6))),
                            'data-zm-pb-toc-nested': $panel.find('[data-zm-control="toc-nested"]').prop('checked') ? '1' : '0',
                            'data-zm-pb-toc-numbered': $panel.find('[data-zm-control="toc-numbered"]').prop('checked') ? '1' : '0',
                            'data-zm-pb-toc-smooth': $panel.find('[data-zm-control="toc-smooth"]').prop('checked') ? '1' : '0',
                            'data-zm-pb-toc-offset': String(Math.max(0, Math.min(400, parseInt(value('toc-offset'), 10) || 0))) });
                    } else if (['zm-search', 'zm-filters'].indexOf(component.get('type')) >= 0) {
                        api.applyListControls(component, panel);
                    } else if (component.get('type') === 'zm-pagination') {
                        api.applyPaginationControls(component, panel);
                    } else if (component.get('type') === 'zm-contact-form') {
                        api.applyContactControls(component, panel, self.t.bind(self));
                    } else if (component.get('type') === 'image') {
                        var newSource = value('image-src') || '';
                        if (newSource !== component.get('src')) {
                            component.removeAttributes(['data-zm-pb-image-variants', 'data-zm-pb-media-id']);
                            $panel.find('[data-zm-control="image-intrinsic-width"], [data-zm-control="image-intrinsic-height"]').val('0');
                        }
                        component.set('src', newSource);
                        component.addAttributes({ alt: value('image-alt') || '', title: value('image-title') || '',
                            loading: value('image-loading') || 'lazy', width: value('image-intrinsic-width') || '',
                            height: value('image-intrinsic-height') || '', sizes: '100vw',
                            'data-zm-pb-srcset': $panel.find('[data-zm-control="image-srcset"]').prop('checked') ? '1' : '0' });
                        component.addStyle({ width: value('image-width') || 'auto', height: value('image-height') || 'auto',
                            'object-fit': value('image-fit') || 'contain' });
                    } else if (component.get('type') === 'video') {
                        var provider = value('video-provider') || 'so';
                        var providerChanged = component.get('provider') !== provider;
                        if (providerChanged) component.set('provider', provider);
                        component.set(provider === 'so' ? 'src' : 'videoId', providerChanged ? '' : (value('video-source') || ''));
                        component.set({ autoplay: !!$panel.find('[data-zm-control="video-autoplay"]').prop('checked'),
                            loop: !!$panel.find('[data-zm-control="video-loop"]').prop('checked'),
                            controls: !!$panel.find('[data-zm-control="video-controls"]').prop('checked'),
                            muted: !!$panel.find('[data-zm-control="video-muted"]').prop('checked') });
                        component.addStyle({ width: '100%', 'aspect-ratio': value('video-ratio') || '16 / 9' });
                    } else if (component.get('type') === 'map') {
                        component.set({ address: value('map-address') || '', mapType: value('map-type') || 'q',
                            zoom: String(Math.min(20, Math.max(1, parseInt(value('map-zoom'), 10) || 1))) });
                        component.addStyle({ width: '100%', height: Math.min(900, Math.max(150, parseInt(value('map-height'), 10) || 350)) + 'px' });
                    } else if (component.get('type') === 'link') {
                        component.addAttributes({ href: value('link-url') || '#', target: value('link-target') || '_self',
                            'data-zm-pb-localize-link': $panel.find('[data-zm-control="link-localize"]').prop('checked') ? '1' : '0',
                            rel: (value('link-target') === '_blank' ? 'noopener noreferrer' : '') +
                                ($panel.find('[data-zm-control="link-nofollow"]').prop('checked') ? ' nofollow' : '') });
                        if (value('link-aria-label')) component.addAttributes({ 'aria-label': value('link-aria-label') });
                        else component.removeAttributes('aria-label');
                    } else if (component.get('type') === 'zm-button') {
                        component.addAttributes({ 'data-zm-pb-action': value('button-action') || 'none',
                            'data-zm-pb-href': value('button-url') || '', 'data-zm-pb-target': value('button-target') || '_self',
                            'data-zm-pb-localize-link': $panel.find('[data-zm-control="button-localize"]').length
                                ? ($panel.find('[data-zm-control="button-localize"]').prop('checked') ? '1' : '0')
                                : (component.getAttributes()['data-zm-pb-localize-link'] || '0'),
                            'data-zm-pb-onclick': value('button-script') || '' });
                        if (value('button-aria-label')) component.addAttributes({ 'aria-label': value('button-aria-label') });
                        else component.removeAttributes('aria-label');
                    } else if (component.get('type') === 'zm-carousel') {
                        component.addAttributes({ 'data-autoplay': $panel.find('[data-zm-control="autoplay"]').prop('checked') ? '1' : '0',
                            'data-loop': $panel.find('[data-zm-control="loop"]').prop('checked') ? '1' : '0',
                            'data-indicators': $panel.find('[data-zm-control="indicators"]').prop('checked') ? '1' : '0',
                            'data-interval': String(Math.min(60000, Math.max(1000, parseInt(value('interval'), 10) || 5000))),
                            'data-speed': String(Math.min(3000, Math.max(0, parseInt(value('speed'), 10) || 0))),
                            'data-slides-desktop': String(Math.min(6, Math.max(1, parseInt(value('slides-desktop'), 10) || 1))),
                            'data-slides-tablet': String(Math.min(4, Math.max(1, parseInt(value('slides-tablet'), 10) || 1))),
                            'data-slides-mobile': String(Math.min(2, Math.max(1, parseInt(value('slides-mobile'), 10) || 1))) });
                    } else if (component.get('type') === 'zm-accordion' || component.get('type') === 'zm-accordion-item') {
                        component.addAttributes({ 'data-zm-pb-animation': value('accordion-animation') || 'none',
                            'data-zm-pb-animation-speed': String(Math.min(1500, Math.max(100, parseInt(value('accordion-speed'), 10) || 300))) });
                    } else if (component.get('type') === 'zm-spacer') {
                        var height = parseInt(value('spacer-height'), 10);
                        if ([8, 16, 32, 64, 96, 128].indexOf(height) >= 0) component.addStyle({ height: height + 'px' });
                    }
                } finally { state.updating = false; }
                if (renderPanel) self.updateControls(editor, lang);
                editor.refresh();
            };
            state.flush = function() {
                clearTimeout(state.inputTimer);
                if (state.pendingField && panel.contains(state.pendingField)) applyControls(false);
            };
            $panel.on('input', 'input[data-zm-control],textarea[data-zm-control]', function() {
                var field = this;
                clearTimeout(state.inputTimer);
                state.pendingField = null;
                if (field.type === 'number' && (field.value === '' || !field.validity.valid)) return;
                var component = state.component;
                state.pendingField = field;
                state.inputTimer = setTimeout(function() {
                    if (state.component === component && panel.contains(field)) applyControls(false);
                }, field.type === 'number' ? 300 : 100);
            });
            $panel.on('change', '[data-zm-control]', function() {
                clearTimeout(state.inputTimer);
                applyControls(true);
            });
            $panel.on('change', '[data-zm-transfer-target]', function() { state.targetLanguage = this.value; });
            $panel.on('click', '[data-zm-command]', function() {
                var command = $(this).data('zm-command');
                if (command === 'toggle-controls') {
                    state.flush();
                    self.controlsCollapsed = !self.controlsCollapsed;
                    document.cookie = 'zm_pb_block_controls_collapsed=' + (self.controlsCollapsed ? '1' : '0') +
                        '; Max-Age=31536000; Path=/; SameSite=Lax' + (location.protocol === 'https:' ? '; Secure' : '');
                    Object.keys(self.controlsState).forEach(function(key) {
                        var item = self.controlsState[key];
                        item.panel.classList.toggle('is-collapsed', self.controlsCollapsed);
                        var toggle = item.panel.querySelector('[data-zm-command="toggle-controls"]');
                        if (toggle) {
                            var label = self.t(self.controlsCollapsed ? 'expand_block_settings' : 'collapse_block_settings');
                            toggle.setAttribute('aria-expanded', self.controlsCollapsed ? 'false' : 'true');
                            toggle.setAttribute('aria-label', label);
                            toggle.setAttribute('title', label);
                        }
                        item.reserveSpace();
                        if (self.editors[key]) self.editors[key].refresh();
                    });
                    return;
                }
                var component = state.component;
                if (!component) return;
                if (['list-add-field', 'list-remove-field', 'list-field-up', 'list-field-down'].indexOf(command) >= 0) { state.flush(); api.listControlsCommand(component, command, Number(this.getAttribute('data-zm-list-index')), self.t.bind(self)); }
                else if (command === 'pagination-pick') { editor.zmPaginationPick = editor.zmPaginationPick ? null : component; }
                else if (command === 'select') editor.select(component);
                else if (command === 'copy-language') {
                    self.copyBlockToLanguage(editor, lang, component, $panel.find('[data-zm-transfer-target]').val(), $(this).attr('data-zm-mode'));
                    return;
                }
                else if (command === 'edit-smarty') self.editDynamic(editor, component);
                else if (command === 'delete') { component.remove(); state.component = null; editor.select(null); }
                else if (command === 'choose-image') self.chooseImage(editor);
                else if (command === 'choose-background-image') self.chooseBackgroundImage(editor, component, lang);
                else if (command === 'add-item') api.listAdd(component, self.t('list_item'));
                else if (command === 'remove-item') api.listRemove(component);
                else if (command === 'add-row') api.insertTableRow(component, state.child, self.t('table_cell'));
                else if (command === 'add-column') api.insertTableColumn(component, state.child, self.t('table_cell'));
                else if (command === 'toggle-single-accordion') {
                    if (Object.prototype.hasOwnProperty.call(component.getAttributes(), 'open')) component.removeAttributes('open');
                    else component.addAttributes({ open: 'open' });
                }
                else if (command === 'add-form-field' || command === 'remove-form-field' || command === 'move-form-field-up' || command === 'move-form-field-down') {
                    api.contactFieldCommand(component, command, parseInt($(this).attr('data-zm-field-index'), 10), self.t.bind(self));
                }
                else if (command === 'select-cell') editor.select(api.layoutCell(state.child, component));
                else if (command === 'merge-cell') {
                    var mergeCell = api.layoutCell(state.child, component);
                    if (api.mergeLayoutCell(component, mergeCell)) editor.select(mergeCell);
                    else { $panel.find('.zm-pb-layout-message').text(self.t('merge_unavailable')); return; }
                }
                else if (command === 'add-slide') {
                    var track = component.components().at(0);
                    if (track) track.append({ type: 'zm-slide' });
                }
                else if (command === 'add-accordion') component.append(api.accordionItem(self.t.bind(self), false, true));
                else if (command === 'remove-accordion' && component.components().length > 1) component.components().last().remove();
                else if (command === 'toggle-accordion-index') {
                    var index = parseInt($(this).attr('data-zm-item-index'), 10);
                    var indexedItem = component.components().at(index);
                    if (indexedItem && indexedItem.get('type') === 'zm-accordion-item') {
                        if (indexedItem.getAttributes().open) indexedItem.removeAttributes('open');
                        else indexedItem.addAttributes({ open: 'open' });
                    }
                }
                else if (command === 'remove-accordion-item' && component.components().length > 1) {
                    var selectedItem = api.controls.accordionItem(state.child, component);
                    if (selectedItem) { selectedItem.remove(); editor.select(component); }
                }
                else if (command === 'open-accordion' || command === 'close-accordion') component.components().forEach(function(item) {
                    if (command === 'open-accordion') item.addAttributes({ open: 'open' });
                    else item.removeAttributes('open');
                });
                self.updateControls(editor, lang);
                editor.refresh();
            });
        },

        updateControls: function(editor, lang) {
            var state = this.controlsState && this.controlsState[lang];
            if (!state || state.updating) return;
            var selected = editor.zmPaginationPick || editor.getSelected();
            if (state.pendingField && selected !== state.child) state.flush();
            var parent = this.managedParent(selected);
            if (selected && parent) { state.component = parent; state.child = selected; }
            else { state.component = null; state.child = null; }
            parent = state.component;
            var panel = state.panel;
            if (!parent) {
                panel.classList.remove('is-visible');
                panel.innerHTML = '';
                state.displayedComponent = null;
                return;
            }
            panel.classList.add('is-visible');

            var self = this;
            var attrs = parent.getAttributes();
            var type = parent.get('type');
            var escape = function(value) { return String(value == null ? '' : value).replace(/[&<>"']/g, function(char) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[char];
            }); };
            var opts = function(entries, current) {
                return entries.map(function(entry) { return '<option value="' + entry[0] + '"' +
                    (String(entry[0]) === String(current) ? ' selected' : '') + '>' + self.t(entry[1]) + '</option>'; }).join('');
            };
            var select = function(name, label, entries, current) {
                return '<label class="zm-pb-field"><span>' + self.t(label) + '</span><select data-zm-control="' + name + '">' + opts(entries, current) + '</select></label>';
            };
            var number = function(name, label, current, min, max) {
                return '<label class="zm-pb-field"><span>' + self.t(label) + '</span><input data-zm-control="' + name + '" type="number" min="' + min + '" max="' + max + '" value="' + (parseInt(current, 10) || min) + '"></label>';
            };
            var input = function(name, label, current) {
                return '<label class="zm-pb-field"><span>' + self.t(label) + '</span><input data-zm-control="' + name + '" type="text" value="' + escape(current) + '"></label>';
            };
            var textarea = function(name, label, current) {
                return '<label class="zm-pb-field zm-pb-field-wide"><span>' + self.t(label) + '</span><textarea data-zm-control="' + name + '" rows="3">' + escape(current) + '</textarea></label>';
            };
            var check = function(name, label, current) {
                return '<label class="zm-pb-check"><input data-zm-control="' + name + '" type="checkbox"' + (current ? ' checked' : '') + '> ' + self.t(label) + '</label>';
            };
            var button = function(command, label) { return '<button type="button" data-zm-command="' + command + '">' + self.t(label) + '</button>'; };
            var titles = { 'zm-layout': 'section', 'zm-plain-div': 'plain_div', 'zm-list': 'list', 'zm-table': 'table', 'zm-accordion': 'faq', 'zm-accordion-item': 'accordion', 'zm-toc': 'table_of_contents', 'zm-pagination': 'pagination', 'zm-search': 'list_search', 'zm-filters': 'list_filters', 'zm-contact-form': 'contact_form',
                'zm-progress': 'progress', 'zm-carousel': 'carousel', 'zm-heading': 'heading', 'zm-button': 'button', 'zm-spacer': 'spacer', 'zm-smarty': 'smarty',
                image: 'image', video: 'video', map: 'map', link: 'link' };
            var title = titles[type] ? this.t(titles[type]) : (parent.get('name') || this.t('block_settings'));
            var toggleLabel = this.t(this.controlsCollapsed ? 'expand_block_settings' : 'collapse_block_settings');
            var html = '<div class="zm-pb-controls-head"><button type="button" class="zm-pb-controls-collapse" data-zm-command="toggle-controls" aria-controls="zm-pb-controls-body-' + escape(lang) + '" aria-expanded="' +
                (this.controlsCollapsed ? 'false' : 'true') + '" aria-label="' + escape(toggleLabel) + '" title="' + escape(toggleLabel) +
                '"><span class="zm-pb-controls-chevron" aria-hidden="true"></span></button><span class="zm-pb-controls-kicker">GrapesJS · ' +
                this.t('block_settings') + '</span><strong>' + escape(title) + '</strong></div><div class="zm-pb-controls-body" id="zm-pb-controls-body-' + escape(lang) + '">';
            if (type === 'zm-plain-div') {
                html += input('background-image', 'background_image', api.containerBackgroundUrl(parent));
                html += number('div-min-height', 'div_min_height', parent.getStyle()['min-height'] || 160, 0, 2000);
                html += '<div class="zm-pb-controls-actions">' + button('choose-background-image', 'choose_image') + '</div>';
            } else if (type === 'zm-layout') {
                var mode = attrs['data-zm-pb-layout'] || 'columns';
                html += select('kind', 'layout_mode', [['columns', 'columns_mode'], ['flex', 'flex'], ['grid', 'grid']], mode);
                html += '<div class="zm-pb-fields-row">';
                html += number('columns', mode === 'flex' ? 'item_count' : 'column_count', attrs['data-zm-pb-columns'], 1, mode === 'columns' ? 4 : 12);
                if (mode === 'grid') html += number('rows', 'row_count', attrs['data-zm-pb-rows'], 1, 12);
                html += '</div>';
                if (mode === 'columns') html += select('sidebar', 'sidebar_position', [['none', 'sidebar_none'], ['left', 'sidebar_left'], ['right', 'sidebar_right']], attrs['data-zm-pb-sidebar']);
                if (mode === 'flex') {
                    html += select('direction', 'flex_direction', [['row', 'direction_row'], ['row-reverse', 'direction_row_reverse'], ['column', 'direction_column'], ['column-reverse', 'direction_column_reverse']], attrs['data-zm-pb-direction']);
                    html += select('wrap', 'flex_wrap', [['wrap', 'wrap_yes'], ['nowrap', 'wrap_no']], attrs['data-zm-pb-wrap']);
                }
                html += number('gap', 'gap_pixels', attrs['data-zm-pb-gap'], 0, 100);
                html += '<div class="zm-pb-fields-row">' +
                    number('tablet-columns', 'tablet_columns', attrs['data-zm-pb-tablet-columns'] || Math.min(2, parseInt(attrs['data-zm-pb-columns'], 10) || 1), 1, 12) +
                    number('mobile-columns', 'mobile_columns', attrs['data-zm-pb-mobile-columns'] || 1, 1, 12) + '</div>';
                html += '<p class="zm-pb-controls-hint">' + this.t(mode === 'columns' ? 'columns_hint' : mode === 'grid' ? 'grid_hint' : 'flex_hint') + '</p>';
                var activeCell = api.layoutCell(state.child, parent);
                if (activeCell && mode !== 'columns') {
                    var cellAttrs = activeCell.getAttributes();
                    html += '<div class="zm-pb-cell-controls"><strong>' + this.t('layout_cell') + ' ' + (parent.components().models.indexOf(activeCell) + 1) + '</strong>';
                    if (mode === 'flex') {
                        html += number('cell-width', 'cell_width', cellAttrs['data-zm-pb-width'], 0, 100) +
                            number('cell-tablet-width', 'cell_tablet_width', cellAttrs['data-zm-pb-width-tablet'], 0, 100) +
                            number('cell-mobile-width', 'cell_mobile_width', cellAttrs['data-zm-pb-width-mobile'], 0, 100);
                        html += '<p class="zm-pb-controls-hint">' + this.t('cell_width_hint') + '</p>';
                    } else html += '<div class="zm-pb-fields-row">' + number('cell-colspan', 'cell_colspan', cellAttrs['data-zm-pb-colspan'] || 1, 1, parseInt(attrs['data-zm-pb-columns'], 10) || 1) +
                        number('cell-rowspan', 'cell_rowspan', cellAttrs['data-zm-pb-rowspan'] || 1, 1, 12) + '</div>';
                    html += '<div class="zm-pb-controls-actions">' + button('select-cell', 'select_cell') + button('merge-cell', 'merge_next_cell') + '</div>';
                    html += '<p class="zm-pb-layout-message zm-pb-controls-hint" role="status"></p></div>';
                } else if (mode !== 'columns') html += '<p class="zm-pb-controls-hint">' + this.t('select_cell_hint') + '</p>';
            } else if (type === 'zm-list') {
                html += select('ordered', 'list_kind', [['0', 'unordered'], ['1', 'ordered']], parent.get('tagName') === 'ol' ? '1' : '0');
                html += '<div class="zm-pb-controls-actions">' + button('add-item', 'add_item') + button('remove-item', 'remove_item') + '</div>';
            } else if (type === 'zm-table') {
                var size = api.tableSize(parent);
                var parts = api.tableParts(parent);
                html += '<div class="zm-pb-fields-row">' + number('rows', 'row_count', size.rows, 1, 30) + number('columns', 'column_count', size.columns, 1, 12) + '</div>';
                html += '<div class="zm-pb-controls-checks"><label><input type="checkbox" data-zm-control="thead"' + (parts.thead ? ' checked' : '') + '>' + this.t('table_header') + '</label>';
                html += '<label><input type="checkbox" data-zm-control="tfoot"' + (parts.tfoot ? ' checked' : '') + '>' + this.t('table_footer') + '</label></div>';
                html += '<div class="zm-pb-controls-actions">' + button('add-row', 'insert_row') + button('add-column', 'insert_column') + '</div>';
            } else if (type === 'zm-carousel') {
                html += '<div class="zm-pb-controls-checks">' + check('autoplay', 'autoplay', attrs['data-autoplay'] === '1') +
                    check('loop', 'loop', attrs['data-loop'] !== '0') + check('indicators', 'indicators', attrs['data-indicators'] !== '0') + '</div>';
                html += number('interval', 'interval', attrs['data-interval'], 1000, 60000) + number('speed', 'speed', attrs['data-speed'], 0, 3000);
                html += number('slides-desktop', 'slides_desktop', attrs['data-slides-desktop'], 1, 6) +
                    number('slides-tablet', 'slides_tablet', attrs['data-slides-tablet'], 1, 4) +
                    number('slides-mobile', 'slides_mobile', attrs['data-slides-mobile'], 1, 2);
                html += '<div class="zm-pb-controls-actions">' + button('add-slide', 'add_slide') + '</div>';
            } else if (type === 'zm-toc') {
                html += input('toc-title', 'accordion_title', attrs['data-zm-pb-toc-title']);
                var levels = [['1', 'h1'], ['2', 'h2'], ['3', 'h3'], ['4', 'h4'], ['5', 'h5'], ['6', 'h6']];
                html += select('toc-min', 'toc_min_level', levels, attrs['data-zm-pb-toc-min'] || '1');
                html += select('toc-max', 'toc_max_level', levels, attrs['data-zm-pb-toc-max'] || '6');
                html += check('toc-nested', 'toc_nested', attrs['data-zm-pb-toc-nested'] !== '0');
                html += check('toc-numbered', 'toc_numbered', attrs['data-zm-pb-toc-numbered'] === '1');
                html += check('toc-smooth', 'toc_smooth', attrs['data-zm-pb-toc-smooth'] !== '0');
                html += number('toc-offset', 'toc_offset', attrs['data-zm-pb-toc-offset'] === undefined ? 96 : attrs['data-zm-pb-toc-offset'], 0, 400);
                html += '<p class="zm-pb-controls-hint">' + this.t('toc_hint') + '</p>';
            } else if (type === 'zm-search' || type === 'zm-filters') {
                html += api.renderListControls(parent, editor, this.t.bind(this));
            } else if (type === 'zm-pagination') {
                html += api.renderPaginationControls(parent, editor, this.t.bind(this));
            } else if (type === 'zm-contact-form') {
                html += api.renderContactControls(parent, this.t.bind(this), this.config);
            } else if (type === 'zm-accordion' || type === 'zm-accordion-item') {
                html += '<p class="zm-pb-controls-hint">' + this.t(type === 'zm-accordion' ? 'accordion_double_click' : 'accordion_title_double_click') + '</p>';
                html += select('accordion-animation', 'animation', [['none', 'animation_none'], ['slide', 'animation_slide']], attrs['data-zm-pb-animation'] || 'none');
                if (attrs['data-zm-pb-animation'] === 'slide') html += number('accordion-speed', 'speed', attrs['data-zm-pb-animation-speed'], 100, 1500);
                if (type === 'zm-accordion') {
                html += '<div class="zm-pb-controls-accordion-items">';
                parent.components().forEach(function(item, index) {
                    var itemElement = item.getEl();
                    var summary = itemElement && itemElement.querySelector('summary');
                    var caption = summary ? summary.textContent.trim() : '';
                    if (!caption) caption = self.t('accordion_question') + ' ' + (index + 1);
                    if (caption.length > 48) caption = caption.slice(0, 47) + '…';
                    html += '<button type="button" data-zm-command="toggle-accordion-index" data-zm-item-index="' + index + '">' +
                        escape(caption) + ' · ' + self.t(item.getAttributes().open ? 'close_item' : 'open_item') + '</button>';
                });
                html += '</div>';
                var activeItem = api.controls.accordionItem(state.child, parent);
                if (activeItem) html += '<div class="zm-pb-controls-actions">' + button('remove-accordion-item', 'remove_selected_item') + '</div>';
                html += '<div class="zm-pb-controls-actions">' + button('add-accordion', 'add_accordion_item') + button('remove-accordion', 'remove_accordion_item') +
                    button('open-accordion', 'open_all') + button('close-accordion', 'close_all') + '</div>';
                } else html += '<div class="zm-pb-controls-actions">' + button('toggle-single-accordion', Object.prototype.hasOwnProperty.call(attrs, 'open') ? 'close_item' : 'open_item') + '</div>';
            } else if (type === 'zm-progress') {
                html += '<label class="zm-pb-field"><span>' + this.t('progress_text') + '</span><input type="text" data-zm-control="progress-label" value="' +
                    String(parent.get('zmLabel') || '').replace(/[&<>"']/g, function(char) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[char]; }) + '"></label>';
                html += '<div class="zm-pb-fields-row">' + number('progress-value', 'progress_value', parent.get('zmValue'), 0, 10000) +
                    number('progress-max', 'progress_max', parent.get('zmMax'), 1, 10000) + '</div>';
                html += select('progress-color', 'progress_color', [['blue', 'color_blue'], ['green', 'color_green'], ['orange', 'color_orange']], parent.get('zmColor'));
            } else if (type === 'zm-spacer') {
                var currentHeight = parseInt(parent.getStyle().height, 10) || 32;
                html += select('spacer-height', 'spacer_height', [[8, 'height_8'],[16, 'height_16'], [32, 'height_32'], [64, 'height_64'], [96, 'height_96'], [128, 'height_128']], currentHeight);
            } else if (type === 'zm-heading') {
                html += select('heading-level', 'heading_level', [['h1', 'h1'], ['h2', 'h2'], ['h3', 'h3'], ['h4', 'h4'], ['h5', 'h5'], ['h6', 'h6']], parent.get('tagName'));
                html += '<label class="zm-pb-field"><span>' + this.t('heading_size') + '</span><input data-zm-control="heading-size" type="number" min="1" max="5" step="0.1" value="' + escape(attrs['data-zm-pb-heading-size'] || 2) + '"></label>';
                var headingWeight = parent.getStyle()['font-weight'] || '700';
                if (headingWeight === 'normal') headingWeight = '400';
                if (headingWeight === 'bold') headingWeight = '700';
                html += select('heading-weight', 'heading_weight', [
                    ['100', 'heading_weight_100'], ['200', 'heading_weight_200'], ['300', 'heading_weight_300'],
                    ['400', 'heading_weight_400'], ['500', 'heading_weight_500'], ['600', 'heading_weight_600'],
                    ['700', 'heading_weight_700'], ['800', 'heading_weight_800'], ['900', 'heading_weight_900']
                ], headingWeight);
            } else if (type === 'zm-smarty') {
                html += button('edit-smarty', 'edit_code');
            } else if (type === 'image') {
                var imageSrc = parent.get('src') || '';
                if (/^data:image\/svg\+xml/i.test(imageSrc)) imageSrc = '';
                html += input('image-src', 'image_source', imageSrc) + input('image-alt', 'image_alt', attrs.alt) + input('image-title', 'image_title', attrs.title);
                html += number('image-intrinsic-width', 'image_intrinsic_width', attrs.width || 0, 0, 10000) +
                    number('image-intrinsic-height', 'image_intrinsic_height', attrs.height || 0, 0, 10000);
                html += '<div class="zm-pb-controls-checks">' +
                    check('image-srcset', 'image_srcset', attrs['data-zm-pb-srcset'] !== '0') + '</div>';
                var imageStyle = parent.getStyle();
                html += input('image-width', 'image_width', imageStyle.width || 'auto') + input('image-height', 'image_height', imageStyle.height || 'auto');
                html += select('image-fit', 'image_fit', [['contain', 'fit_contain'], ['cover', 'fit_cover'], ['fill', 'fit_fill']], imageStyle['object-fit'] || 'contain');
                html += select('image-loading', 'image_loading', [['lazy', 'loading_lazy'], ['eager', 'loading_eager']], attrs.loading || 'lazy');
                html += '<div class="zm-pb-controls-actions">' + button('choose-image', 'choose_image') + '</div>';
            } else if (type === 'video') {
                var provider = parent.get('provider') || 'so';
                html += select('video-provider', 'video_provider', [['so', 'video_file'], ['yt', 'video_youtube'], ['ytnc', 'video_youtube_nocookie'], ['vi', 'video_vimeo']], provider);
                html += input('video-source', provider === 'so' ? 'video_source' : 'video_id', parent.get(provider === 'so' ? 'src' : 'videoId'));
                html += select('video-ratio', 'video_ratio', [['16 / 9', 'ratio_wide'], ['4 / 3', 'ratio_standard'], ['1 / 1', 'ratio_square']], parent.getStyle()['aspect-ratio'] || '16 / 9');
                html += '<div class="zm-pb-controls-checks">' + check('video-controls', 'video_controls', parent.get('controls')) +
                    check('video-autoplay', 'autoplay', parent.get('autoplay')) + check('video-loop', 'loop', parent.get('loop')) +
                    check('video-muted', 'video_muted', parent.get('muted')) + '</div>';
            } else if (type === 'map') {
                html += input('map-address', 'map_address', parent.get('address')) +
                    select('map-type', 'map_type', [['q', 'map_road'], ['w', 'map_satellite']], parent.get('mapType')) +
                    number('map-zoom', 'map_zoom', parent.get('zoom'), 1, 20) +
                    number('map-height', 'map_height', parseInt(parent.getStyle().height, 10) || 350, 150, 900);
            } else if (type === 'link') {
                html += input('link-url', 'link_url', attrs.href) +
                    input('link-aria-label', 'accessible_name', attrs['aria-label']) +
                    select('link-target', 'link_target', [['_self', 'target_same'], ['_blank', 'target_new']], attrs.target || '_self');
                html += '<div class="zm-pb-controls-checks">' + check('link-localize', 'link_localize', attrs['data-zm-pb-localize-link'] === '1') +
                    check('link-nofollow', 'link_nofollow', (attrs.rel || '').indexOf('nofollow') >= 0) + '</div>';
            } else if (type === 'zm-button') {
                var action = attrs['data-zm-pb-action'] || 'none';
                html += select('button-action', 'button_action', [['none', 'action_none'], ['link', 'action_link'], ['script', 'action_script']], action);
                html += input('button-aria-label', 'accessible_name', attrs['aria-label']);
                if (action === 'link') html += input('button-url', 'link_url', attrs['data-zm-pb-href']) +
                    select('button-target', 'link_target', [['_self', 'target_same'], ['_blank', 'target_new']], attrs['data-zm-pb-target'] || '_self') +
                    check('button-localize', 'link_localize', attrs['data-zm-pb-localize-link'] === '1');
                if (action === 'script') html += textarea('button-script', 'button_script', attrs['data-zm-pb-onclick']);
            }
            html += '</div><div class="zm-pb-controls-foot">';
            var targetSelect = document.querySelector('#block_editor_' + lang + ' .zm-pb-clone-target');
            if (type !== 'zm-spacer' && parent.get('tagName') !== 'hr' && targetSelect && targetSelect.options.length) {
                var targetOptions = Array.prototype.map.call(targetSelect.options, function(option) {
                    return '<option value="' + escape(option.value) + '"' +
                        (option.value === state.targetLanguage ? ' selected' : '') + '>' + escape(option.text) + '</option>';
                }).join('');
                html += '<div class="zm-pb-controls-transfer"><button type="button" data-zm-command="copy-language" data-zm-mode="copy-content">' +
                    escape(this.t('copy_block_content_to')) + '</button><button type="button" data-zm-command="copy-language" data-zm-mode="copy-structure">' +
                    escape(this.t('copy_block_structure_to')) + '</button><select data-zm-transfer-target aria-label="' +
                    escape(this.t('target_language')) + '">' + targetOptions + '</select></div>';
            }
            if (state.child !== parent) html += button('select', 'select_parent');
            html += '<button type="button" class="zm-pb-control-delete" data-zm-command="delete">' + this.t('delete_block') + '</button></div>';
            var controlsBody = panel.querySelector('.zm-pb-controls-body');
            var scrollTop = controlsBody && state.displayedComponent === parent ? controlsBody.scrollTop : 0;
            panel.innerHTML = html;
            state.displayedComponent = parent;
            controlsBody = panel.querySelector('.zm-pb-controls-body');
            if (controlsBody) controlsBody.scrollTop = scrollTop;
        },

        flushControls: function(_editor, lang) {
            var state = this.controlsState && this.controlsState[lang];
            if (state && state.flush) state.flush();
        }
    };
})();
