(function() {
    if (window.zmPbAccordionLoaded) return;
    window.zmPbAccordionLoaded = true;
    document.addEventListener('click', function(event) {
        var summary = event.target.closest && event.target.closest('.zm-pb-accordion[data-zm-pb-animation="slide"] > details > summary, details.zm-pb-accordion-single[data-zm-pb-animation="slide"] > summary');
        if (!summary || !summary.closest('.zm-pb-page')) return;
        var details = summary.parentElement;
        var answer = details.querySelector('.zm-pb-accordion-answer');
        if (!answer || !answer.animate || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        event.preventDefault();
        if (details._zmPbAnimation) details._zmPbAnimation.cancel();
        var opening = !details.open;
        if (opening) details.open = true;
        var height = answer.scrollHeight;
        var container = details.hasAttribute('data-zm-pb-animation') ? details : summary.closest('.zm-pb-accordion');
        var speed = parseInt(container.getAttribute('data-zm-pb-animation-speed'), 10) || 300;
        var animation = answer.animate([{ height: opening ? '0px' : height + 'px', opacity: opening ? 0 : 1 },
            { height: opening ? height + 'px' : '0px', opacity: opening ? 1 : 0 }],
            { duration: Math.min(1500, Math.max(100, speed)), easing: 'ease-in-out' });
        details._zmPbAnimation = animation;
        var finish = function() {
            if (details._zmPbAnimation !== animation) return;
            if (!opening) details.open = false;
            details._zmPbAnimation = null;
        };
        animation.onfinish = finish;
        animation.oncancel = function() { if (details._zmPbAnimation === animation) details._zmPbAnimation = null; };
        setTimeout(finish, Math.min(1500, Math.max(100, speed)) + 50);
    });
})();
