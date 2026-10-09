(function () {
    var script = document.currentScript;
    var content = script && script.previousElementSibling;
    if (!content || !content.hasAttribute('data-zm-pb-partial')) return;

    var target = document.querySelector('#main-body .primary-content') ||
        document.querySelector('#main-body .main-content') ||
        document.querySelector('.primary-content, .main-content') ||
        document.querySelector('#main-body, main');
    if (target) {
        if (content.getAttribute('data-zm-pb-partial') === 'before') target.insertBefore(content, target.firstChild);
        else target.appendChild(content);
    }
    content.hidden = false;
    script.remove();
})();
