<?php
use Illuminate\Database\Capsule\Manager as Capsule;

if (!defined('ZM_PB_VER')) die('Direct access not allowed');
require_once __DIR__ . '/contact_captcha.php';

/** Definitions come from the rendered page, never from submitted form parameters. */
class ZM_PB_ContactForm
{
    public static function text($lang)
    {
        $lang = isset(ZM_PB_LANGS[$lang]) ? $lang : ZM_PB_DEFLANG;
        $path = ZM_PB_ASSETSDIR . 'grapesjs/langs/' . $lang . '.json';
        return is_file($path) ? (json_decode(file_get_contents($path), true) ?: []) : [];
    }

    private static function esc($text) { return htmlspecialchars((string) $text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

    /** Keep only text, line breaks and safe links from the consent caption. */
    public static function consentHtml($text)
    {
        $document = new DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8"?><html><body><div id="zm-pb-consent-root">' . (string) $text . '</div></body></html>', LIBXML_NONET);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        $root = (new DOMXPath($document))->query('//*[@id="zm-pb-consent-root"]')->item(0);
        if (!$root) return self::esc(strip_tags((string) $text));
        $render = function(DOMNode $node) use (&$render) {
            if ($node instanceof DOMText) return nl2br(self::esc($node->nodeValue), false);
            if (!($node instanceof DOMElement)) return '';
            $tag = strtolower($node->tagName);
            if (in_array($tag, ['script', 'style', 'iframe', 'svg'], true)) return '';
            if ($tag === 'br') return '<br>';
            $children = '';
            foreach ($node->childNodes as $child) $children .= $render($child);
            if ($tag !== 'a') return $children;
            $url = trim($node->getAttribute('href'));
            if ($url === '' || preg_match('/[\x00-\x20\x7f\\\\]/', $url)) return $children;
            $safe = preg_match('~^/(?!/)~', $url) || preg_match('/^#[A-Za-z0-9_-]+$/D', $url)
                || (preg_match('~^https?://~i', $url) && filter_var($url, FILTER_VALIDATE_URL))
                || (stripos($url, 'mailto:') === 0 && filter_var(substr($url, 7), FILTER_VALIDATE_EMAIL));
            return $safe ? '<a href="' . self::esc($url) . '">' . $children . '</a>' : $children;
        };
        $html = '';
        foreach ($root->childNodes as $child) $html .= $render($child);
        return $html;
    }

    public static function normalize(array $form)
    {
        $form['action'] = ($form['action'] ?? '') === 'email' ? 'email' : 'ticket';
        $form['emailFormat'] = ($form['emailFormat'] ?? '') === 'template' ? 'template' : 'system';
        $form['department'] = max(0, (int) ($form['department'] ?? 0));
        $form['captcha'] = !empty($form['captcha']);
        $form['recipient'] = trim((string) ($form['recipient'] ?? ''));
        $consent = is_array($form['consent'] ?? null) ? $form['consent'] : [];
        unset($form['consent']);
        // Retain an existing form-wide agreement as an ordinary field.
        $sourceFields = array_slice(is_array($form['fields'] ?? null) ? $form['fields'] : [], 0, !empty($consent['enabled']) ? 30 : 31);
        if (!empty($consent['enabled'])) {
            $id = 'consent'; $suffix = 2;
            $ids = array_column($sourceFields, 'id');
            while (in_array($id, $ids, true)) $id = 'consent_' . $suffix++;
            $sourceFields[] = ['id' => $id, 'type' => 'consent', 'label' => strip_tags((string) ($consent['text'] ?? '')),
                'text' => $consent['text'] ?? '', 'required' => true, 'width' => 12, 'breakBefore' => true];
        }
        $fields = [];
        foreach ($sourceFields as $field) {
            if (!is_array($field) || !preg_match('/^[a-z][a-z0-9_]{0,40}$/D', $field['id'] ?? '')) continue;
            $id = $field['id'];
            if (isset($fields[$id])) continue;
            $field['type'] = in_array($field['type'] ?? '', ['text', 'textarea', 'email', 'tel', 'url', 'number', 'date', 'select', 'checkbox', 'consent'], true) ? $field['type'] : 'text';
            $field['filter'] = in_array($field['filter'] ?? '', ['none', 'email', 'integer', 'number', 'url', 'phone'], true) ? $field['filter'] : 'none';
            $field['role'] = in_array($field['role'] ?? '', ['name', 'email', 'subject'], true) ? $field['role'] : 'none';
            if ($field['type'] === 'consent') {
                $field['filter'] = 'none'; $field['role'] = 'none';
                $field['text'] = mb_substr(trim((string) ($field['text'] ?? '')), 0, 3000);
            }
            $field['label'] = mb_substr(trim((string) ($field['label'] ?? $id)), 0, 200);
            $field['required'] = !empty($field['required']);
            $field['width'] = max(1, min(12, (int) ($field['width'] ?? (in_array($field['type'], ['textarea', 'consent'], true) ? 12 : 6))));
            $field['breakBefore'] = !empty($field['breakBefore']);
            $options = []; $seen = [];
            foreach (explode("\n", (string) ($field['options'] ?? '')) as $line) {
                $line = trim($line);
                $split = strpos($line, ': ');
                if ($split === false) $split = strpos($line, ':');
                $value = mb_substr(trim($split === false ? $line : substr($line, 0, $split)), 0, 200);
                $label = mb_substr(trim($split === false ? $line : substr($line, $split + 1)), 0, 200);
                if ($value === '' || $label === '' || isset($seen[$value])) continue;
                $options[] = ['value' => $value, 'label' => $label]; $seen[$value] = true;
                if (count($options) >= 100) break;
            }
            $field['options'] = $options;
            $fields[$id] = $field;
        }
        $form['fields'] = $fields;
        foreach (['title', 'description', 'subject', 'submit'] as $key) $form[$key] = mb_substr(trim((string) ($form[$key] ?? '')), 0, 1000);
        return $form;
    }

    public static function render(DOMElement $element, array $context)
    {
        $raw = json_decode(rawurldecode($element->getAttribute('data-zm-pb-form')), true);
        if (!is_array($raw) || empty($context['page_id'])) return '';
        $form = self::normalize($raw);
        if (!$form['fields']) return '';
        $lang = $context['lang'] ?? ZM_PB_DEFLANG;
        $text = self::text($lang);
        $t = function($key) use ($text) { return self::esc($text[$key] ?? $key); };
        if (!isset($_SESSION['zm_pb_forms']) || !is_array($_SESSION['zm_pb_forms'])) $_SESSION['zm_pb_forms'] = [];
        foreach ($_SESSION['zm_pb_forms'] as $key => $value) if (($value['expires'] ?? 0) < time()) unset($_SESSION['zm_pb_forms'][$key]);
        while (count($_SESSION['zm_pb_forms']) >= 64) array_shift($_SESSION['zm_pb_forms']);
        $token = bin2hex(random_bytes(32));
        $captcha = $form['captcha'] ? ZM_PB_ContactCaptcha::configuration() : ['type' => 'none'];
        $_SESSION['zm_pb_forms'][$token] = ['form' => $form, 'captcha' => $captcha, 'page_id' => (int) $context['page_id'], 'lang' => $lang,
            'expires' => time() + 3600, 'client_id' => (int) ($_SESSION['uid'] ?? 0)];
        $endpoint = ZM_PB_ROOTURL . 'public/contact.php';
        $html = '<form class="zm-pb-contact-form" id="' . self::esc($element->getAttribute('id') ?: 'zm-pb-form-' . substr($token, 0, 12)) . '" method="post" action="' . self::esc($endpoint) . '" data-zm-pb-contact-form="1" data-zm-network-error="' . $t('form_send_failed') . '"';
        if ($element->hasAttribute('style')) $html .= ' style="' . self::esc($element->getAttribute('style')) . '"';
        $html .= '><input type="hidden" name="zm_pb_form_token" value="' . $token . '"><div class="zm-pb-form-head"><h2>' . self::esc($form['title']) . '</h2><p>' . self::esc($form['description']) . '</p></div><div class="zm-pb-form-fields">';
        foreach ($form['fields'] as $field) {
            $id = 'zm-pb-' . substr($token, 0, 12) . '-' . $field['id'];
            $attrs = ' id="' . $id . '" name="fields[' . $field['id'] . ']"' . ($field['required'] ? ' required' : '');
            if ($field['type'] === 'consent') {
                $caption = $field['text'] !== '' ? $field['text'] : ($field['label'] ?: ($text['form_consent_default'] ?? 'I agree.'));
                $html .= '<div class="zm-pb-form-field zm-pb-form-consent' . ($field['breakBefore'] ? ' zm-pb-form-field-new-row' : '') . ($field['width'] === 12 ? ' zm-pb-form-field-full' : '') . '" style="--zm-pb-field-span:' . $field['width'] . '"><label for="' . $id . '"><input type="checkbox"' . $attrs . ' value="1" aria-describedby="' . $id . '-error"><span>' . self::consentHtml($caption) . ($field['required'] ? ' <b aria-hidden="true">*</b>' : '') . '</span></label><small class="zm-pb-field-error" id="' . $id . '-error" data-zm-field-error="' . $field['id'] . '"></small></div>';
                continue;
            }
            $html .= '<label class="zm-pb-form-field' . ($field['breakBefore'] ? ' zm-pb-form-field-new-row' : '') . ($field['width'] === 12 ? ' zm-pb-form-field-full' : '') . '" style="--zm-pb-field-span:' . $field['width'] . '" for="' . $id . '"><span>' . self::esc($field['label']) . ($field['required'] ? ' <b aria-hidden="true">*</b>' : '') . '</span>';
            $attrs .= ' aria-describedby="' . $id . '-error"';
            if ($field['type'] === 'textarea') $html .= '<textarea rows="5" maxlength="10000"' . $attrs . ' placeholder="' . self::esc($field['placeholder'] ?? '') . '"></textarea>';
            elseif ($field['type'] === 'select') {
                $html .= '<select' . $attrs . '><option value="">' . $t('form_choose') . '</option>';
                foreach ($field['options'] as $option) $html .= '<option value="' . self::esc($option['value']) . '">' . self::esc($option['label']) . '</option>';
                $html .= '</select>';
            } else $html .= '<input type="' . $field['type'] . '"' . $attrs . ($field['type'] === 'checkbox' ? ' value="1"' : ($field['type'] === 'number' ? ' step="any"' : '') . ' placeholder="' . self::esc($field['placeholder'] ?? '') . '"') . ($field['type'] !== 'number' && $field['type'] !== 'checkbox' ? ' maxlength="1000"' : '') . '>';
            $html .= '<small class="zm-pb-field-error" id="' . $id . '-error" data-zm-field-error="' . $field['id'] . '"></small></label>';
        }
        $html .= '</div>';
        $html .= '<div class="zm-pb-form-honey" aria-hidden="true"><label>' . $t('form_leave_empty') . '<input name="website" tabindex="-1" autocomplete="off"></label></div>';
        if ($captcha['type'] === 'local') {
            $captchaErrorId = 'zm-pb-' . substr($token, 0, 12) . '-captcha-error';
            $html .= '<div class="zm-pb-form-captcha"><img src="' . self::esc($endpoint . '?action=captcha&token=' . $token) . '" alt="' . $t('form_captcha') . '" width="180" height="55"><button type="button" data-zm-captcha-refresh="1">' . $t('form_captcha_refresh') . '</button><label>' . $t('form_captcha_code') . '<input type="text" name="captcha_code" required maxlength="6" autocomplete="off" aria-describedby="' . $captchaErrorId . '"><small id="' . $captchaErrorId . '" class="zm-pb-field-error" data-zm-field-error="captcha_code"></small></label></div>';
        } elseif ($captcha['type'] !== 'none') $html .= ZM_PB_ContactCaptcha::markup($captcha, $t);
        return $html . '<div class="zm-pb-form-footer"><button type="submit" class="zm-pb-button">' . self::esc($form['submit']) . '</button><div class="zm-pb-form-status" role="status" aria-live="polite"></div></div></form>';
    }

    public static function captcha($token)
    {
        $entry = $_SESSION['zm_pb_forms'][$token] ?? null;
        if (!$entry || ($entry['captcha']['type'] ?? '') !== 'local' || $entry['expires'] < time() || !function_exists('imagecreatetruecolor')) {
            http_response_code(404); return;
        }
        $alphabet = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < 6; $i++) $code .= $alphabet[random_int(0, strlen($alphabet) - 1)];
        $_SESSION['zm_pb_forms'][$token]['captcha_hash'] = hash('sha256', $code);
        $image = imagecreatetruecolor(180, 55);
        imagefill($image, 0, 0, imagecolorallocate($image, 244, 248, 252));
        for ($i = 0; $i < 12; $i++) imageline($image, random_int(0, 179), random_int(0, 54), random_int(0, 179), random_int(0, 54), imagecolorallocate($image, random_int(130, 200), random_int(150, 210), random_int(170, 225)));
        for ($i = 0; $i < 6; $i++) imagestring($image, 5, 15 + $i * 25, random_int(14, 25), $code[$i], imagecolorallocate($image, random_int(20, 70), random_int(35, 85), random_int(60, 110)));
        header('Content-Type: image/png'); header('Cache-Control: no-store, private');
        imagepng($image); imagedestroy($image);
    }

    public static function validate(array $form, array $posted)
    {
        $errors = []; $values = []; $roles = [];
        foreach ($form['fields'] as $id => $field) {
            $value = $posted[$id] ?? '';
            if (!is_string($value)) { $errors[$id] = 'form_invalid_field'; continue; }
            $value = trim($value);
            if ($field['type'] === 'consent') {
                if ($value !== '' && $value !== '1') $errors[$id] = 'form_invalid_field';
                elseif ($field['required'] && $value !== '1') $errors[$id] = 'form_consent_required';
                $values[$id] = $value;
                continue;
            }
            if ($field['required'] && $value === '') $errors[$id] = 'form_required_field';
            if (mb_strlen($value) > ($field['type'] === 'textarea' ? 10000 : 1000)) $errors[$id] = 'form_long_field';
            if ($value !== '') {
                $filters = [$field['filter']];
                if (in_array($field['type'], ['email', 'url', 'number'], true)) $filters[] = $field['type'];
                if ($field['type'] === 'tel') $filters[] = 'phone';
                if ($field['role'] === 'email') $filters[] = 'email';
                foreach (array_unique($filters) as $filter) {
                    $valid = true;
                    if ($filter === 'email') $valid = filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
                    elseif ($filter === 'url') $valid = filter_var($value, FILTER_VALIDATE_URL) !== false && in_array(strtolower(parse_url($value, PHP_URL_SCHEME) ?? ''), ['http', 'https'], true);
                    elseif ($filter === 'integer') $valid = preg_match('/^-?[0-9]+$/D', $value);
                    elseif ($filter === 'number') $valid = is_numeric($value) && is_finite((float) $value);
                    elseif ($filter === 'phone') $valid = preg_match('/^\+?[0-9() .-]{5,30}$/D', $value);
                    if (!$valid) $errors[$id] = 'form_invalid_field';
                }
                if ($field['type'] === 'select' && !in_array($value, array_column($field['options'], 'value'), true)) $errors[$id] = 'form_invalid_field';
                if ($field['type'] === 'checkbox' && $value !== '1') $errors[$id] = 'form_invalid_field';
                if ($field['type'] === 'date') {
                    $date = DateTimeImmutable::createFromFormat('!Y-m-d', $value);
                    if (!$date || $date->format('Y-m-d') !== $value) $errors[$id] = 'form_invalid_field';
                }
            }
            $values[$id] = $value;
            if ($field['role'] !== 'none' && !isset($roles[$field['role']])) $roles[$field['role']] = $value;
        }
        return [$values, $roles, $errors];
    }

    public static function submit(array $post)
    {
        $token = is_string($post['zm_pb_form_token'] ?? null) ? $post['zm_pb_form_token'] : '';
        $entry = $_SESSION['zm_pb_forms'][$token] ?? null;
        $lang = $entry['lang'] ?? ZM_PB_DEFLANG;
        $text = self::text($lang);
        $fail = function($key, $status = 422, $errors = []) use ($text) {
            return ['status' => $status, 'success' => false, 'message' => $text[$key] ?? $key,
                'errors' => array_map(function($error) use ($text) { return $text[$error] ?? $error; }, $errors)];
        };
        if (!$entry || $entry['expires'] < time() || isset($entry['form']['consent'])) return $fail('form_expired', 419);
        $client = (int) ($_SESSION['uid'] ?? 0);
        if ($entry['client_id'] !== $client) return $fail('form_expired', 419);
        $page = Capsule::table('zm_pb_pages')->where('id', $entry['page_id'])->first();
        if (!$page || $page->status !== 'publish' || $page->type === 'system' || ($page->auth_type === 'auth' && !$client) || ($page->auth_type === 'noauth' && $client)) return $fail('form_unavailable', 403);
        if (!empty($post['website'])) return $fail('form_invalid_field');
        if (time() - (int) ($_SESSION['zm_pb_form_last_sent'] ?? 0) < 20) return $fail('form_rate_limit', 429);
        $form = $entry['form'];
        $posted = is_array($post['fields'] ?? null) ? $post['fields'] : [];
        [$values, $roles, $errors] = self::validate($form, $posted);
        if (($entry['captcha']['type'] ?? '') === 'local') {
            $code = is_string($post['captcha_code'] ?? null) ? strtoupper(trim($post['captcha_code'])) : '';
            if (empty($entry['captcha_hash']) || !hash_equals($entry['captcha_hash'], hash('sha256', $code))) $errors['captcha_code'] = 'form_invalid_captcha';
            unset($_SESSION['zm_pb_forms'][$token]['captcha_hash']);
        } elseif (($entry['captcha']['type'] ?? 'none') !== 'none') {
            if (!ZM_PB_ContactCaptcha::verify($entry['captcha'], $post)) $errors['captcha_code'] = 'form_invalid_captcha';
        }
        if ($errors) return $fail('form_check_fields', 422, $errors);
        $displayValues = $values;
        foreach ($form['fields'] as $id => $field) {
            if ($field['type'] === 'consent') {
                $caption = trim(html_entity_decode(strip_tags(str_replace('<br>', "\n", self::consentHtml($field['text']))), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                $answer = $values[$id] === '1' ? ($text['form_value_yes'] ?? 'Yes') : ($text['form_value_no'] ?? 'No');
                $displayValues[$id] = ($caption !== '' ? $caption . "\n" : '') . $answer;
            }
        }
        $subject = preg_replace('/[\r\n]+/', ' ', $roles['subject'] ?? $form['subject']);
        if ($subject === '') $subject = $form['title'];
        $subject = mb_substr($subject, 0, 200);
        $message = [];
        foreach ($form['fields'] as $id => $field) $message[] = $field['label'] . ":\n" . $displayValues[$id];
        $message = implode("\n\n", $message);
        $department = $form['department'] ? Capsule::table('tblticketdepartments')->where('id', $form['department'])->first() : null;
        if ($form['action'] === 'ticket') {
            if (!$department || (!$client && !empty($department->clientsonly))) return $fail('form_department_unavailable');
            if (!$client && (empty($roles['name']) || empty($roles['email']))) return $fail('form_identity_required');
            $params = ['deptid' => $form['department'], 'subject' => $subject, 'message' => $message, 'priority' => 'Medium', 'markdown' => true];
            if ($client) $params['clientid'] = $client;
            else { $params['name'] = $roles['name']; $params['email'] = $roles['email']; }
            $result = localAPI('OpenTicket', $params);
        } else {
            if (!filter_var($form['recipient'], FILTER_VALIDATE_EMAIL)) return $fail('form_recipient_invalid');
            $html = '<div style="padding:24px"><h2>' . self::esc($form['title']) . '</h2>';
            $plain = $form['title'] . "\n\n";
            foreach ($form['fields'] as $id => $field) {
                $html .= '<h3>' . self::esc($field['label']) . '</h3><p>' . nl2br(self::esc($displayValues[$id])) . '</p>';
                $plain .= $field['label'] . ":\n" . $displayValues[$id] . "\n\n";
            }

            if( isset($_SESSION['uid']) ) $html .= '<h3>USER-ID</h3> ' . $_SESSION['uid'];

            $html .= '</div>';
            require_once ZM_PB_LIBDIR . 'email.php';
            $result = ZM_PB_Email::send($form['recipient'], $subject, $html, $roles['email'] ?? '', $roles['name'] ?? '',
                $form['emailFormat'] === 'system', $plain);
        }
        if (($result['result'] ?? '') !== 'success') {
            if (function_exists('logActivity')) logActivity('Page Builder contact form: ' . ($result['message'] ?? 'Delivery failed'));
            return $fail('form_send_failed', 500);
        }
        $_SESSION['zm_pb_form_last_sent'] = time();
        unset($_SESSION['zm_pb_forms'][$token]);
        $nextToken = bin2hex(random_bytes(32));
        unset($entry['captcha_hash']);
        $entry['expires'] = time() + 3600;
        $_SESSION['zm_pb_forms'][$nextToken] = $entry;
        return ['status' => 200, 'success' => true, 'message' => $text['form_success'] ?? 'Message sent.', 'token' => $nextToken];
    }
}
