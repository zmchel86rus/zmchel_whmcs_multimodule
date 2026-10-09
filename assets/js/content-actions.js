(function() {
    if (window.zmPbActionsLoaded) return;
    window.zmPbActionsLoaded = true;
    document.addEventListener('click', function(event) {
        var button = event.target.closest && event.target.closest('button[data-zm-pb-button][data-zm-pb-action="link"]');
        if (!button || !button.closest('.zm-pb-page')) return;
        var url = button.getAttribute('data-zm-pb-href');
        if (!url) return;
        if (button.getAttribute('data-zm-pb-target') === '_blank') window.open(url, '_blank', 'noopener,noreferrer');
        else window.location.assign(url);
    });
})();
