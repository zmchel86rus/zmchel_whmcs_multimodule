(function() {
    function setup(root) {
        if (root.dataset.zmPbInitialized) return;
        var track = root.querySelector('.zm-pb-carousel-track');
        if (!track) return;
        var slides = Array.prototype.filter.call(track.children, function(node) { return node.classList.contains('zm-pb-slide'); });
        if (!slides.length) return;
        root.dataset.zmPbInitialized = '1';
        var language = ((root.closest('[lang]') || document.documentElement).getAttribute('lang') || 'en').slice(0, 2).toLowerCase();
        var labels = {
            en: ['Previous slide', 'Next slide', 'Slide '], ru: ['Предыдущий слайд', 'Следующий слайд', 'Слайд '],
            de: ['Vorherige Folie', 'Nächste Folie', 'Folie '], uk: ['Попередній слайд', 'Наступний слайд', 'Слайд '],
            es: ['Diapositiva anterior', 'Diapositiva siguiente', 'Diapositiva ']
        }[language] || ['Previous slide', 'Next slide', 'Slide '];
        var read = function(name, fallback, min, max) {
            var value = parseInt(root.getAttribute(name), 10);
            return Math.min(max, Math.max(min, isNaN(value) ? fallback : value));
        };
        var loop = root.getAttribute('data-loop') !== '0';
        var speed = read('data-speed', 400, 0, 3000);
        var interval = read('data-interval', 5000, 1000, 60000);
        var current = 0, visible = 1, timer = null, indicators = [];
        track.style.transitionDuration = speed + 'ms';
        var limit = function() { return Math.max(0, slides.length - visible); };
        var prev = null, next = null;
        var show = function(index) {
            var last = limit();
            current = loop ? (index < 0 ? last : index > last ? 0 : index) : Math.max(0, Math.min(last, index));
            track.style.transform = 'translate3d(-' + (slides[current].offsetLeft - slides[0].offsetLeft) + 'px,0,0)';
            indicators.forEach(function(button, i) {
                button.classList.toggle('active', i === current);
                button.setAttribute('aria-current', i === current ? 'true' : 'false');
            });
            if (prev) prev.disabled = !loop && current === 0;
            if (next) next.disabled = !loop && current === last;
        };
        var resize = function() {
            var width = root.clientWidth;
            var key = width < 640 ? 'mobile' : width < 1000 ? 'tablet' : 'desktop';
            visible = Math.min(slides.length, read('data-slides-' + key, 1, 1, 6));
            root.style.setProperty('--zm-pb-visible', visible);
            indicators.forEach(function(button, index) { button.hidden = index > limit(); });
            show(current);
            if (slides.length <= visible) stop();
            else start();
        };
        if (slides.length > 1) {
            prev = document.createElement('button');
            next = document.createElement('button');
            prev.type = next.type = 'button';
            prev.className = 'zm-pb-carousel-prev';
            next.className = 'zm-pb-carousel-next';
            prev.setAttribute('aria-label', labels[0]);
            next.setAttribute('aria-label', labels[1]);
            prev.textContent = '\u2039';
            next.textContent = '\u203a';
            prev.addEventListener('click', function() { show(current - 1); });
            next.addEventListener('click', function() { show(current + 1); });
            root.appendChild(prev);
            root.appendChild(next);
            if (root.getAttribute('data-indicators') !== '0') {
                var bar = document.createElement('div');
                bar.className = 'zm-pb-carousel-indicators';
                slides.forEach(function(_slide, index) {
                    var button = document.createElement('button');
                    button.type = 'button';
                    button.setAttribute('aria-label', labels[2] + (index + 1));
                    button.addEventListener('click', function() { show(Math.min(index, limit())); });
                    indicators.push(button);
                    bar.appendChild(button);
                });
                root.appendChild(bar);
            }
        }
        var start = function() {
            if (timer || root.getAttribute('data-autoplay') !== '1' || slides.length <= visible) return;
            timer = setInterval(function() {
                if (!document.hidden && !root.matches(':hover') && !root.contains(document.activeElement)) {
                    show(current + 1);
                    if (!loop && current === limit()) stop();
                }
            }, interval);
        };
        var stop = function() { clearInterval(timer); timer = null; };
        root.addEventListener('mouseenter', stop);
        root.addEventListener('mouseleave', start);
        root.addEventListener('focusin', stop);
        root.addEventListener('focusout', function() { setTimeout(start, 0); });
        var touchX = null;
        root.addEventListener('touchstart', function(event) { touchX = event.touches[0].clientX; }, { passive: true });
        root.addEventListener('touchend', function(event) {
            if (touchX === null) return;
            var delta = event.changedTouches[0].clientX - touchX;
            if (Math.abs(delta) > 40) show(current + (delta < 0 ? 1 : -1));
            touchX = null;
        }, { passive: true });
        if (window.ResizeObserver) new ResizeObserver(resize).observe(root);
        window.addEventListener('resize', resize);
        resize();
        start();
    }
    var start = function() { document.querySelectorAll('.zm-pb-page .zm-pb-carousel').forEach(setup); };
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start);
    else start();
})();
