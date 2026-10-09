(function () {
    function checkServer() {
        var container = document.getElementById('zm-pb-rewrite-server-alert');
        if (!container || !window.fetch || !window.AbortController) return;
        var controller = new AbortController();
        var timeout = setTimeout(function () { controller.abort(); }, 5000);
        // PHP reports the backend; this same-origin response can reveal a proxy.
        fetch(window.location.href, { method: 'HEAD', credentials: 'same-origin', cache: 'no-store', redirect: 'error', signal: controller.signal })
            .then(function (response) {
                if (!response.ok) return;
                var software = response.headers.get('Server') || '';
                var front = /\b(?:nginx|openresty)\b/i.test(software) ? 'nginx' : (/\bapache\b/i.test(software) ? 'apache' : 'unknown');
                var backend = container.dataset.backend;
                var kind = front === 'nginx' && backend === 'apache' ? 'proxy'
                    : (front === 'nginx' || backend === 'nginx' ? 'nginx' : 'unknown');
                if (kind === 'unknown' && (front === 'apache' || backend === 'apache')) {
                    container.hidden = true;
                    return;
                }
                var alert = container.querySelector('.alert');
                if (alert) alert.textContent = container.dataset[kind];
                container.hidden = false;
            })
            // Keep the PHP result when headers are hidden or the request fails.
            .catch(function () {})
            .finally(function () { clearTimeout(timeout); });
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', checkServer);
    else checkServer();
})();
