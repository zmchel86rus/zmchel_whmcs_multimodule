<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Captcha for PageBuilder forms, using the provider and keys configured in WHMCS. */
class ZM_PB_ContactCaptcha
{
    private static function setting(array $names)
    {
        foreach ($names as $name) {
            $value = \WHMCS\Config\Setting::getValue($name);
            if (is_scalar($value) && trim((string) $value) !== '') return trim((string) $value);
        }
        return '';
    }

    public static function configuration()
    {
        $selected = strtolower(self::setting(['CaptchaType', 'captchaType']));
        $type = 'local';
        if (strpos($selected, 'hcaptcha') !== false) $type = strpos($selected, 'invisible') !== false ? 'hcaptcha-invisible' : 'hcaptcha';
        elseif (strpos($selected, 'recaptcha') !== false) {
            $type = strpos($selected, 'v3') !== false || preg_match('/3$/', $selected) ? 'recaptcha-v3' :
                (strpos($selected, 'invisible') !== false ? 'recaptcha-invisible' : 'recaptcha-v2');
        }
        if ($type === 'local') return ['type' => 'local'];
        $hcaptcha = strpos($type, 'hcaptcha') === 0;
        $site = self::setting($hcaptcha ? ['HCaptchaSiteKey', 'HCaptchaPublicKey', 'hCaptchaPublicKey', 'hcaptchapublickey'] :
            ['reCaptchaPublicKey', 'reCAPTCHAPublicKey', 'RecaptchaPublicKey', 'RecaptchaSiteKey', 'recaptchapublickey']);
        $secret = self::setting($hcaptcha ? ['HCaptchaSecretKey', 'HCaptchaPrivateKey', 'hCaptchaPrivateKey', 'hcaptchaprivatekey'] :
            ['reCaptchaPrivateKey', 'reCAPTCHAPrivateKey', 'RecaptchaPrivateKey', 'RecaptchaSecretKey', 'recaptchaprivatekey']);
        // A form with enabled captcha must never silently submit without working keys.
        if ($site === '' || $secret === '') return ['type' => 'local'];
        $threshold = (float) self::setting($hcaptcha ? ['hcaptchaScoreThreshold', 'HCaptchaScoreThreshold'] : ['recaptchaScoreThreshold', 'RecaptchaScoreThreshold']);
        return ['type' => $type, 'site' => $site, 'threshold' => $threshold > 0 && $threshold <= 1 ? $threshold : 0.5];
    }

    public static function markup(array $captcha, callable $t)
    {
        $type = htmlspecialchars($captcha['type'], ENT_QUOTES, 'UTF-8');
        $site = htmlspecialchars($captcha['site'], ENT_QUOTES, 'UTF-8');
        $label = $t('form_captcha');
        return '<div class="zm-pb-form-captcha zm-pb-form-captcha-service" data-zm-captcha-type="' . $type . '" data-zm-captcha-site="' . $site . '" data-zm-captcha-error="' . $t('form_invalid_captcha') . '">' .
            '<div data-zm-captcha-widget="1"></div><input type="hidden" name="zm_pb_captcha_response" value="">' .
            '<small class="zm-pb-field-error" data-zm-field-error="captcha_code" role="alert"></small>' .
            '<noscript>' . $label . ': JavaScript required.</noscript></div>';
    }

    public static function verify(array $captcha, array $post)
    {
        $type = $captcha['type'] ?? '';
        $token = $post['zm_pb_captcha_response'] ?? '';
        if (!is_string($token) || $token === '' || strlen($token) > 4096) return false;
        $current = self::configuration();
        if (($current['type'] ?? '') !== $type || ($current['site'] ?? '') !== ($captcha['site'] ?? '')) return false;
        $hcaptcha = strpos($type, 'hcaptcha') === 0;
        $secret = self::setting($hcaptcha ? ['HCaptchaSecretKey', 'HCaptchaPrivateKey', 'hCaptchaPrivateKey', 'hcaptchaprivatekey'] :
            ['reCaptchaPrivateKey', 'reCAPTCHAPrivateKey', 'RecaptchaPrivateKey', 'RecaptchaSecretKey', 'recaptchaprivatekey']);
        if ($secret === '' || !function_exists('curl_init')) return false;
        $url = $hcaptcha ? 'https://api.hcaptcha.com/siteverify' : 'https://www.google.com/recaptcha/api/siteverify';
        $handle = curl_init($url);
        $params = ['secret' => $secret, 'response' => $token];
        if ($hcaptcha) $params['sitekey'] = $captcha['site'];
        curl_setopt_array($handle, [CURLOPT_POST => true, CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_RETURNTRANSFER => true, CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 10]);
        $body = curl_exec($handle);
        $status = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);
        $result = $status === 200 && is_string($body) ? json_decode($body, true) : null;
        if (!is_array($result) || empty($result['success'])) return false;
        $host = strtolower((string) parse_url(ZM_PB_ROOTURL, PHP_URL_HOST));
        if ($host !== '' && strtolower((string) ($result['hostname'] ?? '')) !== $host) return false;
        if ($type === 'recaptcha-v3' && (($result['action'] ?? '') !== 'zm_pb_contact' ||
            !isset($result['score']) || (float) $result['score'] < $captcha['threshold'])) return false;
        return true;
    }
}
