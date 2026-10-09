/* Run: node modules/addons/zmchel_whmcs_multimodule/tests/page-editor-dirty.js */
function testPageEditorDirty(source, URLClass) {
    var checks = 0;
    function equal(actual, expected, label) {
        checks++;
        if (JSON.stringify(actual) !== JSON.stringify(expected)) {
            throw new Error(label + ': ' + JSON.stringify(actual) + ' !== ' + JSON.stringify(expected));
        }
    }
    function field(name, value) { return { name: name, value: value, type: 'text' }; }
    function emitter() {
        return { handlers: {}, addEventListener: function(type, fn) { this.handlers[type] = fn; } };
    }
    var roots = {}, bodies = {}, editors = {}, forms = [], window = emitter(), document = emitter();
    function form(id, label, fields) {
        fields.namedItem = function(name) { return this.find(function(item) { return item.name === name; }); };
        var result = { id: id, elements: fields, closest: function() {
            return { querySelector: function() { return { textContent: label }; } };
        } };
        forms.push(result);
        return result;
    }
    var ru = form('form_content_russian', 'Контент — Русский', [field('edit_content[russian][content]', 'stored-ru')]);
    var de = form('form_content_german', 'Контент — Немецкий', [field('edit_content[german][content]', 'stored-de')]);
    var meta = form('form_meta_german', 'Мета — Немецкий', [field('edit_meta[german][meta_title]', 'Title')]);
    window.BlockEditor = { editors: editors };
    window.zmPbGrapesText = { unsaved_changes: 'Не сохранено', unsaved_leave_confirm: 'Уйти?' };
    window.location = { origin: 'https://example.test', pathname: '/editor', search: '?id=1' };
    window.setTimeout = function(fn) { window.resetNavigation = fn; };
    document.baseURI = 'https://example.test/editor?id=1';
    document.readyState = 'complete';
    document.querySelectorAll = function() { return forms; };
    document.getElementById = function(id) { return roots[id]; };
    new Function('window', 'document', 'BlockEditor', 'URL', source)(window, document, window.BlockEditor, URLClass);
    var state = window.ZmPbPageDirty;
    function editor(lang) {
        var root = roots['block_content_' + lang] = emitter();
        root.closest = function() { return root; };
        bodies[lang] = emitter();
        var components = ['initial'];
        var result = editors[lang] = {
            components: components,
            project: { assets: [], styles: [], pages: [{ id: lang, frames: [{
                id: 'frame-' + lang, width: '100%', component: { type: 'wrapper', components: components }
            }] }] },
            getProjectData: function() { return this.project; },
            Canvas: { getBody: function() { return bodies[lang]; } },
            on: function() {}
        };
        state.registerEditor(lang, result);
        return result;
    }
    var russian = editor('russian'), german = editor('german');
    // Reproduce fields added by lazy GrapesJS initialization/tab refresh.
    ru.elements.push(field('width', 'auto'), field('device', 'Desktop'));
    de.elements.push(field('height', '650px'), field('search', ''));
    russian.components.push('normalized during canvas load');
    german.components.push('normalized during canvas load');
    equal(state.unsavedSections(), [], 'opening language tabs is clean');
    ru.elements[1].value = '100%';
    de.elements[2].value = 'search UI only';
    equal(state.unsavedSections(), [], 'changing editor UI is clean');
    bodies.russian.handlers.pointerdown({ isTrusted: true });
    equal(state.unsavedSections(), [], 'first selection establishes normalized baseline');
    var frame = russian.project.pages[0].frames[0];
    frame.width = '375px';
    frame.height = '1200px';
    frame.x = 42;
    frame.component.name = 'Translated wrapper label';
    frame.component.status = 'selected';
    russian.project.assets.push({ src: '/unused-library-image.jpg' });
    equal(state.unsavedSections(), [], 'canvas/device/asset UI changes after selection stay clean');
    var before = JSON.stringify(russian.project);
    state.projectSnapshot(russian);
    equal(JSON.stringify(russian.project), before, 'comparison does not modify saved project data');
    russian.components.push({ type: 'image', attributes: { src: '/one.jpg', alt: 'Image' }, classes: [
        { name: 'picture', type: 1, active: true, label: 'Picture' }
    ] });
    state.markSaved(ru.id, state.snapshot(ru, true));
    var picture = russian.components[russian.components.length - 1];
    picture.classes[0].active = false;
    picture.classes[0].label = 'Localized selector';
    picture.attributes = { alt: 'Image', src: '/one.jpg' };
    equal(state.unsavedSections(), [], 'selector UI and property order are ignored');
    picture.attributes.src = '/two.jpg';
    equal(state.unsavedSections(), ['Контент — Русский'], 'image source change is tracked');
    picture.attributes.src = '/one.jpg';
    russian.project.styles.push({ selectors: ['.picture'], style: { width: '50%' } });
    equal(state.unsavedSections(), ['Контент — Русский'], 'CSS changes are tracked');
    russian.project.styles.pop();
    ['zmCode', 'zmHtml', 'zmForm'].forEach(function(property) {
        picture[property] = property === 'zmForm' ? { email: 'support@example.test' } : 'changed';
        equal(state.unsavedSections(), ['Контент — Русский'], property + ' changes are tracked');
        delete picture[property];
    });
    picture.attributes['data-zm-pb-smarty'] = '{$domain}';
    equal(state.unsavedSections(), ['Контент — Русский'], 'Smarty changes are tracked');
    delete picture.attributes['data-zm-pb-smarty'];
    equal(state.unsavedSections(), [], 'restoring component content clears dirty state');
    russian.components.push('user text');
    equal(state.unsavedSections(), ['Контент — Русский'], 'real text edit identifies its language');
    russian.components.pop();
    equal(state.unsavedSections(), [], 'undo back to baseline clears content warning');
    russian.components.push('edited again');
    meta.elements[0].value = 'Changed title';
    equal(state.unsavedSections(), ['Контент — Русский', 'Мета — Немецкий'], 'all dirty tabs listed');
    var submitted = state.snapshot(ru, true);
    russian.components.push('edit while saving');
    state.markSaved(ru.id, submitted);
    equal(state.unsavedSections(), ['Контент — Русский', 'Мета — Немецкий'], 'save response preserves newer edits');
    state.markSaved(ru.id, state.snapshot(ru, true));
    state.markSaved(meta.id, state.snapshot(meta, true));
    equal(state.unsavedSections(), [], 'successful saves clear matching tabs');
    german.components.push('copied block');
    state.markContentChanged('german');
    equal(state.unsavedSections(), ['Контент — Немецкий'], 'copy into unvisited editor is dirty');
    state.armEditor('german', german);
    equal(state.unsavedSections(), ['Контент — Немецкий'], 'opening copy target does not erase dirty state');
    var copied = state.snapshot(de, true);
    state.markContentChanged('german');
    state.markSaved(de.id, copied);
    equal(state.unsavedSections(), ['Контент — Немецкий'], 'copy during save keeps its revision dirty');
    function click(href, attributes) {
        attributes = attributes || {};
        var link = { href: href, target: attributes.target || '',
            hasAttribute: function(name) { return !!attributes[name]; },
            getAttribute: function() { return href; }, closest: function() { return null; } };
        return { button: 0, target: { closest: function() { return link; } },
            preventDefault: function() { this.defaultPrevented = true; },
            stopImmediatePropagation: function() { this.stopped = true; } };
    }
    var confirmations = [], accept = false;
    window.confirm = function(message) { confirmations.push(message); return accept; };
    document.handlers.click(click('#tab_russian', { 'data-toggle': true }));
    document.handlers.click(click('https://example.test/preview', { target: '_blank' }));
    equal(confirmations.length, 0, 'tabs and new-window previews do not ask to leave');
    var leaving = click('https://example.test/pages');
    document.handlers.click(leaving);
    equal(leaving.defaultPrevented && leaving.stopped, true, 'cancel keeps current page');
    equal(confirmations[0], 'Не сохранено\n\n• Контент — Немецкий\n\nУйти?', 'confirmation names only dirty tab');
    accept = true;
    document.handlers.click(click('https://example.test/pages'));
    var unload = { preventDefault: function() { this.prevented = true; } };
    window.handlers.beforeunload(unload);
    equal(unload.prevented, undefined, 'confirmed navigation has no duplicate prompt');
    window.handlers.beforeunload(unload);
    equal(unload.prevented, true, 'later close/reload still protected');
    state.markSaved(de.id, state.snapshot(de, true));
    equal(state.unsavedSections(), [], 'saving copy removes final warning');
    return checks;
}

if (typeof module !== 'undefined') module.exports = testPageEditorDirty;
if (typeof require !== 'undefined' && require.main === module) {
    var source = require('fs').readFileSync(require('path').join(__dirname, '../assets/js/page-editor-dirty.js'), 'utf8');
    console.log('Passed ' + testPageEditorDirty(source, URL) + ' page editor dirty-state checks.');
}
