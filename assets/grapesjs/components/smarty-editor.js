(function() {
    'use strict';
    var active = null;
    // Keep HTMLMixed's HTML/CSS/JS parsing and color Smarty tokens over it.
    if (window.CodeMirror) CodeMirror.defineMode('zm-pb-smarty-htmlmixed', function(config) {
        var htmlMode = CodeMirror.getMode(config, 'htmlmixed');
        var smartyTags = /^(?:if|elseif|else|foreach|foreachelse|for|while|section|sectionelse|assign|append|capture|include|extends|block|function|call|literal|strip|nocache|break|continue|lang|cycle|counter|config_load|insert|ldelim|rdelim|debug|html_options|html_select_date|html_table|math|mailto|textformat|fetch|eval)\b/i;

        function smartyToken(stream, state) {
            if (state.comment) {
                if (stream.skipTo('*}')) { stream.match('*}'); state.comment = false; }
                else stream.skipToEnd();
                return 'comment';
            }
            if (state.tag) {
                if (stream.match('}')) { state.tag = false; return 'keyword'; }
                if (stream.match(/^\$[a-z_]\w*(?:(?:->|\.|@)[a-z_]\w*|\[[^\]\r\n]*\])*/i)) return 'variable-2';
                if (stream.match(/^\|@?[a-z_]\w*/i)) return 'builtin';
                if (stream.match(/^"(?:[^"\\]|\\.)*"|^'(?:[^'\\]|\\.)*'/)) return 'string';
                if (stream.match(/^\b\d+(?:\.\d+)?\b/)) return 'number';
                if (stream.match(/^[a-z_]\w*(?=\s*=)/i)) return 'attribute';
                stream.next();
                return null;
            }
            if (stream.match('{*')) {
                state.comment = true;
                return smartyToken(stream, state);
            }
            if (stream.peek() === '{') {
                var match = /^\{\/?([a-z_]\w*)/i.exec(stream.string.slice(stream.pos));
                if (match && smartyTags.test(match[1])) {
                    stream.match(match[0]); state.tag = true; return 'keyword';
                }
                if (stream.match(/^\{(?=\$)/)) { state.tag = true; return 'keyword'; }
            }
            stream.next();
            if (!stream.skipTo('{')) stream.skipToEnd();
            return null;
        }

        return {
            startState: function() {
                return { html: CodeMirror.startState(htmlMode), smarty: { tag: false, comment: false },
                    htmlPos: 0, smartyPos: 0, htmlStyle: null, smartyStyle: null };
            },
            copyState: function(state) {
                return { html: CodeMirror.copyState(htmlMode, state.html),
                    smarty: { tag: state.smarty.tag, comment: state.smarty.comment },
                    htmlPos: state.htmlPos, smartyPos: state.smartyPos,
                    htmlStyle: state.htmlStyle, smartyStyle: state.smartyStyle };
            },
            token: function(stream, state) {
                if (stream.sol()) state.htmlPos = state.smartyPos = 0;
                if (stream.start === state.htmlPos) {
                    state.htmlStyle = htmlMode.token(stream, state.html);
                    state.htmlPos = stream.pos;
                }
                if (stream.start === state.smartyPos) {
                    stream.pos = stream.start;
                    state.smartyStyle = smartyToken(stream, state.smarty);
                    state.smartyPos = stream.pos;
                }
                stream.pos = Math.min(state.htmlPos, state.smartyPos);
                return state.smartyStyle || state.htmlStyle;
            },
            indent: function(state, textAfter, line) { return htmlMode.indent(state.html, textAfter, line); },
            innerMode: function(state) { return CodeMirror.innerMode(htmlMode, state.html); }
        };
    });

    function element(tag, className, text) {
        var node = document.createElement(tag);
        node.className = className || '';
        if (text !== undefined) node.textContent = text;
        return node;
    }
    window.ZmPbSmartyEditor = {
        open: function(editor, component, state) {
            if (active) active.close();
            var t = state.t.bind(state);
            var previousFocus = document.activeElement;
            var closed = false;
            var root = element('div', 'zm-pb-smarty-dialog');
            root.setAttribute('role', 'dialog');
            root.setAttribute('aria-modal', 'true');
            root.setAttribute('aria-label', 'Smarty');
            var panel = element('section', 'zm-pb-smarty-panel');
            var bar = element('header', 'zm-pb-smarty-bar');
            bar.appendChild(element('strong', '', 'Smarty'));
            var fullscreen = element('button', 'btn btn-default btn-sm', t('smarty_fullscreen'));
            fullscreen.type = 'button'; fullscreen.setAttribute('aria-pressed', 'false');
            bar.appendChild(fullscreen);
            var cancel = element('button', 'btn btn-default btn-sm', t('cancel'));
            var save = element('button', 'btn btn-primary btn-sm', t('save'));
            cancel.type = save.type = 'button';
            bar.appendChild(cancel); bar.appendChild(save);
            panel.appendChild(bar);
            panel.appendChild(element('p', 'zm-pb-smarty-help', t('smarty_help')));
            var body = element('div', 'zm-pb-smarty-body');
            var workspace = element('div', 'zm-pb-smarty-workspace');
            var codePane = element('div', 'zm-pb-smarty-code');
            var input = element('textarea');
            input.value = component.getAttributes()['data-zm-pb-smarty'] || '';
            codePane.appendChild(input); workspace.appendChild(codePane);
            var details = element('div', 'zm-pb-smarty-details'); workspace.appendChild(details);
            body.appendChild(workspace);
            var sidebar = element('aside', 'zm-pb-smarty-catalog');
            var source = element('select', 'form-control');
            source.setAttribute('aria-label', t('smarty_source'));
            var catalogs = state.config.smartyCatalogs || [];
            catalogs.forEach(function(catalog, index) {
                var option = element('option', '', catalog.theme + ' / ' + catalog.source);
                option.value = index; source.appendChild(option);
            });
            sidebar.appendChild(source);
            var search = element('input', 'form-control');
            search.type = 'search'; search.placeholder = t('smarty_search');
            search.setAttribute('aria-label', t('smarty_search')); sidebar.appendChild(search);
            var list = element('div', 'zm-pb-smarty-variables'); sidebar.appendChild(list);
            body.appendChild(sidebar); panel.appendChild(body); root.appendChild(panel);
            // Keep the dialog inside the element used by GrapesJS' fullscreen command.
            editor.getContainer().appendChild(root);
            var cm = window.CodeMirror ? CodeMirror.fromTextArea(input, {
                mode: 'zm-pb-smarty-htmlmixed', theme: 'monokai', lineNumbers: true,
                lineWrapping: true, indentUnit: 4, tabSize: 4,
                extraKeys: { 'Ctrl-S': apply, 'Cmd-S': apply, 'F11': toggleFullscreen,
                    'Esc': function() { if (root.classList.contains('is-fullscreen')) toggleFullscreen(); else close(); },
                    'Ctrl-Space': function() { search.focus(); } }
            }) : null;
            var variables = [];
            function insert(text) {
                if (cm) { cm.replaceSelection(text); cm.focus(); }
                else { input.setRangeText(text, input.selectionStart, input.selectionEnd, 'end'); input.focus(); }
            }
            function inspect(item) {
                details.replaceChildren(element('strong', '', '$' + item.path));
                details.appendChild(element('p', '', (item.node.types || [item.node.type]).join(' / ')));
                details.appendChild(element('p', '', t('smarty_stages') + ': ' + item.stages.join(', ')));
                if (item.node.redacted) {
                    details.appendChild(element('p', '', t('smarty_redacted'))); return;
                }
                var button = element('button', 'btn btn-default btn-sm', t('smarty_insert'));
                button.type = 'button'; button.onclick = function() {
                    if (item.node.kind !== 'list') {
                        // Output is escaped by the isolated Smarty engine, including non-scalar values.
                        insert('{$' + item.path + '}'); return;
                    }
                    var record = (item.node.children || {})['[]'] || {};
                    var field = Object.keys(record.children || {}).find(function(name) {
                        var child = record.children[name];
                        return !child.redacted && !child.children && !child.opaque;
                    });
                    insert('{foreach $' + item.path + ' as $item}\n    {$item' + (field ? '.' + field : '') + '|escape}\n{/foreach}');
                };
                details.appendChild(button);
                var tree = element('pre', '', JSON.stringify(item.node, null, 2));
                details.appendChild(tree);
            }
            function filter() {
                var query = search.value.toLowerCase(); list.replaceChildren();
                variables.filter(function(item) { return item.path.toLowerCase().indexOf(query) !== -1; })
                    .slice(0, 300).forEach(function(item) {
                        var button = element('button', 'zm-pb-smarty-var', '$' + item.path);
                        button.type = 'button'; button.onclick = function() { inspect(item); };
                        list.appendChild(button);
                    });
            }
            function load() {
                variables = []; details.replaceChildren();
                var catalog = catalogs[Number(source.value)];
                if (!catalog) { list.textContent = t('smarty_no_catalog'); source.disabled = true; return; }
                function visit(children, prefix, stages) {
                    Object.keys(children || {}).forEach(function(name) {
                        // List entries use $item inside foreach; they are described in the parent hint.
                        if (name === '[]') return;
                        var node = children[name], path = prefix ? prefix + '.' + name : name;
                        variables.push({ path: path, node: node, stages: stages || node.stages || [] });
                        if (!node.redacted) visit(node.children, path, stages || node.stages || []);
                    });
                }
                visit(catalog.variables, '', null); filter();
            }
            function close() {
                if (closed) return;
                closed = true;
                if (cm) cm.toTextArea();
                root.remove(); active = null;
                if (previousFocus && previousFocus.isConnected) previousFocus.focus();
                editor.refresh();
            }
            function apply() {
                component.addAttributes({ 'data-zm-pb-smarty': cm ? cm.getValue() : input.value });
                close();
            }
            function toggleFullscreen() {
                var enabled = root.classList.toggle('is-fullscreen');
                fullscreen.setAttribute('aria-pressed', String(enabled));
                if (cm) cm.refresh();
            }
            // Trap keyboard focus, so editor shortcuts cannot delete blocks while editing code.
            root.addEventListener('keydown', function(event) {
                event.stopPropagation();
                if (event.defaultPrevented) return;
                if (event.key === 'Escape') { event.preventDefault(); if (root.classList.contains('is-fullscreen')) toggleFullscreen(); else close(); }
                if (event.key === 'Tab') {
                    var focusable = Array.prototype.filter.call(root.querySelectorAll('button,input,select,textarea,[tabindex="0"]'), function(el) { return !el.disabled; });
                    var first = focusable[0], last = focusable[focusable.length - 1];
                    if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last.focus(); }
                    else if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first.focus(); }
                }
            });
            fullscreen.onclick = toggleFullscreen; cancel.onclick = close; save.onclick = apply;
            source.onchange = load; search.oninput = filter;
            active = { close: close }; load();
            if (cm) { cm.refresh(); cm.focus(); } else input.focus();
        }
    };
})();
