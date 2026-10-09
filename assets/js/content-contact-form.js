(function() {
    if (window.zmPbContactFormLoaded) return;
    window.zmPbContactFormLoaded = true;
    var libraries = {};
    function load(type, site) {
        var provider = type.indexOf('hcaptcha') === 0 ? 'hcaptcha' : 'recaptcha';
        if (libraries[provider]) return libraries[provider];
        var global = provider === 'hcaptcha' ? 'hcaptcha' : 'grecaptcha';
        if (window[global]) return libraries[provider] = Promise.resolve(window[global]);
        libraries[provider] = new Promise(function(resolve, reject) {
            var script = document.createElement('script');
            script.src = provider === 'hcaptcha' ? 'https://js.hcaptcha.com/1/api.js?render=explicit' :
                'https://www.google.com/recaptcha/api.js?render=' + encodeURIComponent(type === 'recaptcha-v3' ? site : 'explicit');
            script.async = true;
            script.onload = function() { window[global] ? resolve(window[global]) : reject(new Error('Captcha unavailable')); };
            script.onerror = function() { reject(new Error('Captcha unavailable')); };
            document.head.appendChild(script);
        });
        return libraries[provider];
    }
    function service(form) { return form.querySelector('[data-zm-captcha-type]'); }
    function initCaptcha(form) {
        var holder = service(form);
        if (!holder) return Promise.resolve(null);
        if (holder.zmInit) return holder.zmInit;
        var type = holder.dataset.zmCaptchaType, site = holder.dataset.zmCaptchaSite;
        holder.zmInit = load(type, site).then(function(api) {
            if (api.ready) return new Promise(function(resolve) { api.ready(function() { resolve(api); }); });
            return api;
        }).then(function(api) {
            if (type === 'recaptcha-v3' || holder.dataset.zmCaptchaWidgetId) return api;
            var widget = api.render(holder.querySelector('[data-zm-captcha-widget]'), { sitekey: site,
                size: type.indexOf('invisible') >= 0 ? 'invisible' : 'normal',
                callback: function(token) {
                    form.elements.namedItem('zm_pb_captcha_response').value = token;
                    clearTimeout(holder.zmTimer);
                    if (holder.zmResolve) { holder.zmResolve(token); holder.zmResolve = holder.zmReject = null; }
                },
                'expired-callback': function() { form.elements.namedItem('zm_pb_captcha_response').value = ''; },
                'error-callback': function() { clearTimeout(holder.zmTimer); if (holder.zmReject) holder.zmReject(new Error('Captcha unavailable')); holder.zmResolve = holder.zmReject = null; }
            });
            holder.dataset.zmCaptchaWidgetId = String(widget);
            return api;
        }).catch(function(error) { holder.zmInit = null; throw error; });
        return holder.zmInit;
    }
    function captchaToken(form) {
        var holder = service(form);
        if (!holder) return Promise.resolve('');
        var type = holder.dataset.zmCaptchaType, site = holder.dataset.zmCaptchaSite;
        return initCaptcha(form).then(function(api) {
            if (type === 'recaptcha-v3') return new Promise(function(resolve, reject) {
                api.ready(function() { api.execute(site, { action: 'zm_pb_contact' }).then(resolve, reject); });
            });
            var widget = Number(holder.dataset.zmCaptchaWidgetId);
            if (type.indexOf('invisible') >= 0) return new Promise(function(resolve, reject) {
                holder.zmResolve = resolve; holder.zmReject = reject;
                holder.zmTimer = setTimeout(function() {
                    holder.zmResolve = holder.zmReject = null;
                    reject(new Error('Captcha unavailable'));
                }, 30000);
                api.execute(widget);
            });
            return api.getResponse(widget);
        }).then(function(token) {
            if (!token) throw new Error('Captcha incomplete');
            form.elements.namedItem('zm_pb_captcha_response').value = token;
            return token;
        });
    }
    function refresh(form) {
        var img = form.querySelector('.zm-pb-form-captcha img');
        if (img) { var url = new URL(img.src); url.searchParams.set('_', Date.now()); img.src = url.href; }
        var code = form.querySelector('[name="captcha_code"]'); if (code) code.value = '';
        var holder = service(form);
        if (holder && holder.dataset.zmCaptchaWidgetId) {
            var api = holder.dataset.zmCaptchaType.indexOf('hcaptcha') === 0 ? window.hcaptcha : window.grecaptcha;
            if (api && api.reset) api.reset(Number(holder.dataset.zmCaptchaWidgetId));
        }
        var response = form.elements.namedItem('zm_pb_captcha_response'); if (response) response.value = '';
    }
    function prepare() {
        document.querySelectorAll('form[data-zm-pb-contact-form]').forEach(function(form) {
            initCaptcha(form).catch(function() { /* Report when the visitor submits. */ });
        });
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', prepare);
    else prepare();
    document.addEventListener('click', function(event) {
        var button = event.target.closest('[data-zm-captcha-refresh]');
        if (button) refresh(button.closest('form'));
    });
    document.addEventListener('submit', function(event) {
        var form = event.target;
        if (!form.matches('[data-zm-pb-contact-form]')) return;
        event.preventDefault();
        if (form.dataset.zmSending === '1' || !form.reportValidity()) return;
        var button = form.querySelector('[type="submit"]'), status = form.querySelector('.zm-pb-form-status');
        form.dataset.zmSending = '1'; button.disabled = true; status.textContent = ''; status.className = 'zm-pb-form-status';
        form.querySelectorAll('.zm-pb-field-error').forEach(function(error) { error.textContent = ''; });
        form.querySelectorAll('[aria-invalid]').forEach(function(field) { field.removeAttribute('aria-invalid'); });
        captchaToken(form).then(function() {
            return fetch(form.action, { method: 'POST', credentials: 'same-origin', body: new FormData(form), headers: { Accept: 'application/json' } });
        }).then(function(response) { return response.json(); })
            .then(function(result) {
                status.textContent = result.message || ''; status.classList.add(result.success ? 'is-success' : 'is-error');
                if (result.success) {
                    form.reset();
                    var token = form.elements.namedItem('zm_pb_form_token');
                    if (token && result.token) token.value = token.defaultValue = result.token;
                    var image = form.querySelector('.zm-pb-form-captcha img');
                    if (image && result.token) {
                        var imageUrl = new URL(image.src);
                        imageUrl.searchParams.set('token', result.token);
                        image.src = imageUrl.href;
                    }
                    refresh(form);
                }
                else {
                    Object.keys(result.errors || {}).forEach(function(id) {
                        var field = id === 'captcha_code' ? form.elements.namedItem('captcha_code') :
                            form.elements.namedItem('fields[' + id + ']');
                        if (field) field.setAttribute('aria-invalid', 'true');
                        var error = Array.from(form.querySelectorAll('[data-zm-field-error]')).find(function(el) { return el.dataset.zmFieldError === id; });
                        if (error) error.textContent = result.errors[id];
                    });
                    var first = form.querySelector('[aria-invalid]'); if (first) first.focus();
                    refresh(form);
                }
            }).catch(function(error) {
                var holder = service(form);
                status.textContent = holder && String(error && error.message || '').indexOf('Captcha') === 0 ? holder.dataset.zmCaptchaError :
                    (form.getAttribute('data-zm-network-error') || 'Unable to send the form. Please try again.');
                status.classList.add('is-error'); refresh(form);
            }).finally(function() { form.dataset.zmSending = '0'; button.disabled = false; });
    });
})();
