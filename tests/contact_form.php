<?php
/** Isolated field normalization test; no WHMCS database or outbound captcha request. */
define('ZM_PB_VER', 'test');
define('ZM_PB_LANGS', ['english' => 'English']);
define('ZM_PB_DEFLANG', 'english');
define('ZM_PB_ASSETSDIR', dirname(__DIR__) . '/assets/');
define('ZM_PB_ROOTURL', '/modules/addons/zmchel_whmcs_multimodule/');
require dirname(__DIR__) . '/lib/contact_form.php';

$form = ZM_PB_ContactForm::normalize(['fields' => [
    ['id' => 'topic', 'label' => 'Topic', 'type' => 'select', 'required' => true,
        'options' => "sales : Sales team\nsupport : Support\nhttps://example.test : Website\nsales : Duplicate", 'width' => 4, 'breakBefore' => true],
    ['id' => 'message', 'label' => 'Message', 'type' => 'textarea', 'required' => true],
]]);
if ($form['fields']['topic']['options'] !== [
    ['value' => 'sales', 'label' => 'Sales team'], ['value' => 'support', 'label' => 'Support'],
    ['value' => 'https://example.test', 'label' => 'Website']
]) throw new RuntimeException('Select value/label parsing failed');
if ($form['fields']['topic']['width'] !== 4 || !$form['fields']['topic']['breakBefore'] ||
    $form['fields']['message']['width'] !== 12) throw new RuntimeException('Form layout normalization failed');
if ($form['emailFormat'] !== 'system' ||
    ZM_PB_ContactForm::normalize(['emailFormat' => 'template'])['emailFormat'] !== 'template') {
    throw new RuntimeException('Email format normalization failed');
}
$agreementDefinition = ['fields' => [
    ['id' => 'privacy', 'type' => 'consent', 'text' => 'Accept <a href="/privacy/">privacy policy</a>', 'required' => true, 'filter' => 'email', 'role' => 'email'],
    ['id' => 'terms', 'type' => 'consent', 'text' => 'Accept terms', 'required' => true, 'width' => 6],
    ['id' => 'marketing', 'type' => 'consent', 'text' => 'Receive news', 'required' => false],
]];
$agreements = ZM_PB_ContactForm::normalize($agreementDefinition);
if ($agreements['fields']['privacy']['filter'] !== 'none' || $agreements['fields']['privacy']['role'] !== 'none' ||
    $agreements['fields']['privacy']['width'] !== 12 || $agreements['fields']['terms']['width'] !== 6) {
    throw new RuntimeException('Consent field normalization failed');
}
[, , $errors] = ZM_PB_ContactForm::validate($agreements, []);
if ($errors !== ['privacy' => 'form_consent_required', 'terms' => 'form_consent_required']) {
    throw new RuntimeException('Required consents were not checked independently');
}
[, , $errors] = ZM_PB_ContactForm::validate($agreements, ['privacy' => '1']);
if ($errors !== ['terms' => 'form_consent_required']) throw new RuntimeException('Second consent was not required');
[$values, $roles, $errors] = ZM_PB_ContactForm::validate($agreements, ['privacy' => '1', 'terms' => '1']);
if ($errors || $roles || $values['marketing'] !== '') throw new RuntimeException('Optional consent incorrectly required');
[, , $errors] = ZM_PB_ContactForm::validate($agreements, ['privacy' => '1', 'terms' => '1', 'marketing' => 'yes']);
if ($errors !== ['marketing' => 'form_invalid_field']) throw new RuntimeException('Forged consent value accepted');
[, , $errors] = ZM_PB_ContactForm::validate($agreements, ['privacy' => ['1'], 'terms' => '1']);
if ($errors !== ['privacy' => 'form_invalid_field']) throw new RuntimeException('Array consent value accepted');
$migrated = ZM_PB_ContactForm::normalize(['fields' => [['id' => 'consent', 'type' => 'text']],
    'consent' => ['enabled' => true, 'text' => 'Please agree']]);
if (isset($migrated['consent']) || ($migrated['fields']['consent_2']['type'] ?? '') !== 'consent' ||
    $migrated['fields']['consent_2']['text'] !== 'Please agree' || !$migrated['fields']['consent_2']['required']) {
    throw new RuntimeException('Existing agreement was not preserved');
}
if (count(ZM_PB_ContactForm::normalize(['fields' => [['id' => 'name']], 'consent' => ['enabled' => false]])['fields']) !== 1) {
    throw new RuntimeException('Disabled agreement was added');
}
$fullFields = [];
for ($i = 0; $i < 30; $i++) $fullFields[] = ['id' => 'f_' . $i, 'type' => 'text'];
$fullForm = ZM_PB_ContactForm::normalize(['fields' => $fullFields, 'consent' => ['enabled' => true, 'text' => 'Required agreement']]);
if (count($fullForm['fields']) !== 31 || !$fullForm['fields']['consent']['required']) {
    throw new RuntimeException('Agreement lost on migration of a full form');
}
$_SESSION = [];
$document = new DOMDocument();
$element = $document->createElement('form');
$element->setAttribute('data-zm-pb-form', rawurlencode(json_encode($agreementDefinition)));
$html = ZM_PB_ContactForm::render($element, ['page_id' => 1, 'lang' => 'english']);
$document->loadHTML($html);
$xpath = new DOMXPath($document);
foreach (['privacy' => true, 'terms' => true, 'marketing' => false] as $id => $required) {
    $input = $xpath->query('//input[@name="fields[' . $id . ']"]')->item(0);
    if (!$input || $input->getAttribute('type') !== 'checkbox' || $input->getAttribute('value') !== '1' || $input->hasAttribute('required') !== $required) {
        throw new RuntimeException('Consent field markup or required state incorrect: ' . $id);
    }
    if (!$xpath->query('ancestor::div[contains(@class,"zm-pb-form-fields")]', $input)->length ||
        !$xpath->query('//*[@data-zm-field-error="' . $id . '"]')->length) {
        throw new RuntimeException('Consent missing from form layout or error markup: ' . $id);
    }
}
if ($xpath->query('//input[@name="zm_pb_consent"]')->length || $xpath->query('//a[@href="/privacy/"]')->length !== 1) {
    throw new RuntimeException('Global consent input retained or consent link lost');
}
[$values, $roles, $errors] = ZM_PB_ContactForm::validate($form, ['topic' => 'sales', 'message' => 'Hello']);
if ($errors || $values['topic'] !== 'sales') throw new RuntimeException('Select value rejected');
[, , $errors] = ZM_PB_ContactForm::validate($form, ['topic' => 'Sales team', 'message' => 'Hello']);
if (($errors['topic'] ?? '') !== 'form_invalid_field') throw new RuntimeException('Select label accepted as value');
$consent = ZM_PB_ContactForm::consentHtml('I accept <a href="/privacy/?x=1&amp;y=2">policy</a> and <a href="javascript:alert(1)">bad link</a><script>alert(1)</script>');
if (strpos($consent, '<a href="/privacy/?x=1&amp;y=2">policy</a>') === false ||
    strpos($consent, 'javascript:') !== false || strpos($consent, '<script') !== false) {
    throw new RuntimeException('Consent links were not sanitized');
}
echo "Contact form fields OK\n";
