(function() {
    if (window.zmPbContentsBound) return;
    window.zmPbContentsBound = true;
    document.addEventListener('click', function(event) {
        var link = event.target.closest && event.target.closest('[data-zm-pb-toc] a');
        if (!link || event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
        var url = new URL(link.href, location.href);
        var id;
        try { id = decodeURIComponent(url.hash.slice(1)); } catch (error) { return; }
        var target = document.getElementById(id);
        if (!target) return;
        event.preventDefault();
        for (var parent = target.parentElement; parent; parent = parent.parentElement) {
            if (parent.tagName === 'DETAILS') {
                if (parent._zmPbAnimation) parent._zmPbAnimation.cancel();
                parent.open = true;
            }
        }
        var toc = link.closest('[data-zm-pb-toc]');
        var smooth = toc.getAttribute('data-zm-pb-toc-smooth') !== '0' && !window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        requestAnimationFrame(function() {
            target.scrollIntoView({ behavior: smooth ? 'smooth' : 'auto', block: 'start' });
            if (!target.hasAttribute('tabindex')) {
                target.setAttribute('tabindex', '-1');
                target.addEventListener('blur', function() { target.removeAttribute('tabindex'); }, { once: true });
            }
            target.focus({ preventScroll: true });
            try { history.pushState(null, '', location.pathname + location.search + url.hash); } catch (error) {}
        });
    });
})();
