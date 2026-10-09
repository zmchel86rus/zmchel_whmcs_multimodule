<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Resolve WHMCS logo paths against SystemURL, including installations in a subdirectory. */
function zm_pb_schema_logo_url($logo, $siteUrl)
{
    $logo = trim((string) $logo);
    if ($logo === '' || preg_match('~^https?://~i', $logo)) return $logo;
    $site = parse_url($siteUrl);
    if (!$site || empty($site['host']) || !in_array($site['scheme'] ?? '', ['http', 'https'], true)) return '';
    if (strpos($logo, '//') === 0) return $site['scheme'] . ':' . $logo;
    if (preg_match('~^[a-z][a-z0-9+.-]*:~i', $logo)) return '';
    $origin = $site['scheme'] . '://' . $site['host'] . (isset($site['port']) ? ':' . $site['port'] : '');
    $reference = parse_url($logo);
    if ($reference === false) return '';
    $relativePath = $reference['path'] ?? '';
    $path = $logo[0] === '/' ? $relativePath : rtrim($site['path'] ?? '', '/') . '/' . $relativePath;
    $segments = [];
    foreach (explode('/', $path) as $segment) {
        if ($segment === '..') array_pop($segments);
        elseif ($segment !== '' && $segment !== '.') $segments[] = $segment;
    }
    return $origin . '/' . implode('/', $segments)
        . (isset($reference['query']) ? '?' . $reference['query'] : '')
        . (isset($reference['fragment']) ? '#' . $reference['fragment'] : '');
}

/** Fill decoded JSON templates, then encode once. No raw substitution into JSON. */
function zm_pb_schema_template($type, array $values = [])
{
    if (!preg_match('/^[a-z]+$/D', $type)) return [];
    $path = ZM_PB_SCHEMAS_DIR . $type . '.json';
    $template = is_file($path) ? json_decode(file_get_contents($path), true) : null;
    if (!is_array($template)) return [];
    if (in_array($type, ['contactpage', 'organization', 'website', 'webpage', 'aboutpage', 'faqpage'], true)) {
        $siteUrl = trim((string) ($values['SITE_URL'] ?? ''));
        if ($siteUrl !== '') {
            $siteUrl = rtrim($siteUrl, '/') . '/';
            $values['SITE_URL'] = $siteUrl;
            $values['ORGANIZATION_ID'] = $siteUrl . '#organization';
            $values['WEBSITE_ID'] = $siteUrl . '#website';
            $values['CONTACT_POINT_ID'] = $siteUrl . '#customer-support';
        }
        if (in_array($type, ['contactpage', 'organization'], true)) {
            $values['ORGANIZATION_LOGO'] = zm_pb_schema_logo_url($values['ORGANIZATION_LOGO'] ?? '', $siteUrl);
        }
        if (!empty($values['URL'])) $values['PAGE_ID'] = explode('#', $values['URL'], 2)[0] . '#webpage';
    }
    $fill = function ($value) use (&$fill, $values) {
        if (is_array($value)) {
            $result = [];
            foreach ($value as $key => $child) {
                $child = $fill($child);
                if ($child !== '' && $child !== null && $child !== []) $result[$key] = $child;
            }
            if (count($result) === 1 && isset($result['@type'])) return [];
            return array_keys($value) === range(0, count($value) - 1) ? array_values($result) : $result;
        }
        if (!is_string($value)) return $value;
        if (preg_match('/^\{\{([A-Z0-9_]+)\}\}$/D', $value, $match)) return $values[$match[1]] ?? '';
        return preg_replace_callback('/\{\{([A-Z0-9_]+)\}\}/', function ($match) use ($values) {
            return (string) ($values[$match[1]] ?? '');
        }, $value);
    };
    $schema = $fill($template);
    if (!empty($values['URL'])) {
        if (in_array($type, ['article', 'blogposting'], true)) $schema['@id'] = $values['URL'] . '#article';
        elseif (in_array($type, ['webpage', 'aboutpage', 'faqpage'], true)) $schema['@id'] = $values['URL'];
    }
    return $schema;
}

/** Page sections are WebPageElement; an ordinary page is never inferred to be an article. */
function zm_pb_schema_contents($id, $title, array $entries, array $context)
{
    $values = $context['schema'] ?? [];
    $url = explode('#', (string) ($values['URL'] ?? ''), 2)[0];
    $type = strtolower((string) ($context['schema_type'] ?? ''));
    if ($type === '' && ($context['page_type'] ?? '') === 'post') $type = 'article';
    $types = ['article' => 'Article', 'blogposting' => 'BlogPosting', 'aboutpage' => 'AboutPage',
        'contactpage' => 'ContactPage', 'faqpage' => 'FAQPage'];
    $parentId = $url . (in_array($type, ['article', 'blogposting'], true) ? '#article' : '');
    if ($type === 'contactpage') $parentId = $url . '#webpage';
    $parent = ['@type' => $types[$type] ?? 'WebPage', '@id' => $parentId, 'url' => $url];
    if (!empty($values['TITLE'])) $parent['name'] = $values['TITLE'];
    if (in_array($type, ['article', 'blogposting'], true)) $parent['mainEntityOfPage'] = ['@type' => 'WebPage', '@id' => $url];
    $toc = zm_pb_schema_template('sitenavigationelement', ['TOC_URL' => $url . '#' . rawurlencode($id),
        'TITLE' => $title, 'LANG_BCP47' => $values['LANG_BCP47'] ?? '']);
    unset($toc['@context']);
    $toc['isPartOf'] = ['@id' => $parentId];
    $parent['hasPart'] = [['@id' => $toc['@id']]];
    $sections = [];
    foreach ($entries as $entry) {
        $section = zm_pb_schema_template('webpageelement', ['URL' => $entry['url'], 'TITLE' => $entry['name']]);
        $section['isPartOf'] = ['@id' => $parentId];
        $sections[] = $section;
        $parent['hasPart'][] = ['@id' => $entry['url']];
        $toc['hasPart'][] = ['@type' => 'SiteNavigationElement', 'name' => $entry['name'], 'url' => $entry['url'],
            'about' => ['@id' => $entry['url']]];
    }
    return ['@context' => 'https://schema.org', '@graph' => array_merge([$parent, $toc], $sections)];
}

function zm_pb_schema_jsonld(array $schema)
{
    if (!$schema) return '';
    $json = json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_INVALID_UTF8_SUBSTITUTE);
    return $json === false ? '' : '<script type="application/ld+json">' . $json . '</script>' . "\n";
}

/** Describe only links/groups already selected for the rendered menu, never query the menu database here. */
function zm_pb_schema_navigation($title, array $items, $language, $pageUrl)
{
    $document = parse_url($pageUrl);
    if (!$document || empty($document['host']) || !in_array($document['scheme'] ?? '', ['http', 'https'], true)) return [];
    $pageUrl = explode('#', $pageUrl, 2)[0];
    $path = $document['path'] ?? '/';
    $directory = $document['scheme'] . '://' . $document['host'] . (isset($document['port']) ? ':' . $document['port'] : '')
        . substr($path, 0, strrpos($path, '/') + 1);
    $walk = function (array $items) use (&$walk, $directory, $pageUrl) {
        $parts = [];
        foreach ($items as $item) {
            $name = trim((string) ($item['label'] ?? ''));
            if ($name === '') continue;
            $children = $walk($item['children'] ?? []);
            $url = trim((string) ($item['url'] ?? ''));
            if ($url === '' || $url === '#') $url = '';
            elseif ($url[0] === '#') $url = $pageUrl . $url;
            elseif ($url[0] === '?') $url = explode('?', $pageUrl, 2)[0] . $url;
            else $url = zm_pb_schema_logo_url($url, $directory);
            if ($url === '' && !$children) continue;
            $entry = ['@type' => 'SiteNavigationElement', 'name' => $name];
            if ($url !== '') $entry['url'] = $url;
            if ($children) $entry['hasPart'] = $children;
            $parts[] = $entry;
        }
        return $parts;
    };
    $parts = $walk($items);
    if (!$parts) return [];
    $schema = zm_pb_schema_template('sitenavigationelement', ['TITLE' => $title, 'LANG_BCP47' => $language]);
    $schema['hasPart'] = $parts;
    return $schema;
}

function zm_pb_schema_organization($language = null)
{
    $config = $GLOBALS['CONFIG'] ?? [];
    $language = strtolower((string) ($language ?? ZM_PB_DEFLANG));
    $availableLanguages = [];
    foreach (ZM_PB_LANGS as $info) {
        $locale = trim((string) ($info['locale_BCP47'] ?? ''));
        if ($locale !== '') $availableLanguages[] = $locale;
    }
    $schema = zm_pb_schema_template('organization', [
        'SITE_NAME' => trim((string) ($config['CompanyName'] ?? '')),
        'SITE_URL' => rtrim((string) ($config['SystemURL'] ?? ''), '/') . '/',
        'ORGANIZATION_LOGO' => (string) ($config['LogoURL'] ?? ''),
        'EMAIL' => (string) ($config['Email'] ?? ''),
        'LANG_BCP47' => ZM_PB_LANGS[$language]['locale_BCP47'] ?? '',
        'ARRAY_LANGS_BCP47' => array_values(array_unique($availableLanguages)),
    ]);
    if (empty($schema['name']) || empty($config['SystemURL'])) return [];
    // WHMCS stores a free-form invoice address. Keep it as Text; do not guess its parts.
    $address = trim(html_entity_decode(strip_tags(preg_replace('/<br\s*\/?\s*>/i', "\n", (string) ($config['CompanyAddress'] ?? ''))), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    if ($address !== '') $schema['address'] = $address;
    if (empty($schema['contactPoint']['email']) && empty($schema['contactPoint']['telephone'])
        && empty($schema['contactPoint']['availableLanguage'])) unset($schema['contactPoint']);
    return $schema;
}

function zm_pb_schema_website()
{
    $config = $GLOBALS['CONFIG'] ?? [];
    $siteName = trim((string) ($config['CompanyName'] ?? ''));
    $siteUrl = trim((string) ($config['SystemURL'] ?? ''));
    $parts = parse_url($siteUrl);
    if ($siteName === '' || !is_array($parts) || empty($parts['host'])
        || !in_array(strtolower($parts['scheme'] ?? ''), ['http', 'https'], true)) return [];
    return zm_pb_schema_template('website', ['SITE_NAME' => $siteName, 'SITE_URL' => $siteUrl]);
}

function zm_pb_schema_homepage_request(array $request, array $query)
{
    $slug = trim((string) ($request['slug'] ?? ''), '/');
    return ($slug === '' || $slug === 'index.php')
        && !isset($query['m'])
        && (!isset($query['rp']) || $query['rp'] === '' || $query['rp'] === '/');
}

function zm_pb_schema_faq(DOMElement $root, array $values = [])
{
    $xpath = new DOMXPath($root->ownerDocument);
    $questions = [];
    $seen = [];
    foreach ($xpath->query('.//*[@data-zm-pb-faq="1"]', $root) as $faq) {
        if (zm_pb_schema_hidden($faq, $root)) continue;
        foreach ($faq->childNodes as $item) {
            if (!$item instanceof DOMElement || strtolower($item->tagName) !== 'details') continue;
            if (zm_pb_schema_hidden($item, $root)) continue;
            $question = '';
            $answer = '';
            foreach ($item->childNodes as $part) {
                if (!$part instanceof DOMElement) continue;
                if (strtolower($part->tagName) === 'summary') $question = zm_pb_schema_text($part);
                elseif (strpos(' ' . $part->getAttribute('class') . ' ', ' zm-pb-accordion-answer ') !== false) $answer = zm_pb_schema_text($part);
            }
            if ($question === '' || $answer === '') continue;
            $key = $question . "\0" . $answer;
            if (isset($seen[$key])) continue;
            $seen[$key] = true;
            $questions[] = ['@type' => 'Question', 'name' => $question, 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $answer]];
        }
    }
    if (!$questions) return [];
    $schema = zm_pb_schema_template('faqpage', $values);
    $schema['mainEntity'] = $questions;
    return $schema;
}

/** Closed details remain accessible; hidden/template/script content is not page content. */
function zm_pb_schema_hidden(DOMElement $element, DOMElement $root)
{
    for ($node = $element; $node instanceof DOMElement; $node = $node->parentNode) {
        if ($node->hasAttribute('hidden') || strtolower($node->getAttribute('aria-hidden')) === 'true'
            || in_array(strtolower($node->tagName), ['script', 'style', 'template'], true)
            || preg_match('/(?:^|;)\s*(?:display\s*:\s*none|visibility\s*:\s*hidden)\s*(?:!important\s*)?(?:;|$)/i', $node->getAttribute('style'))) return true;
        if ($node->isSameNode($root)) break;
    }
    return false;
}

function zm_pb_schema_text(DOMElement $element)
{
    $walk = function ($node) use (&$walk, $element) {
        if ($node instanceof DOMText) return $node->nodeValue;
        if (!$node instanceof DOMElement || zm_pb_schema_hidden($node, $element)) return '';
        $text = '';
        foreach ($node->childNodes as $child) $text .= $walk($child);
        return in_array(strtolower($node->tagName), ['p', 'div', 'li', 'br', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true) ? ' ' . $text . ' ' : $text;
    };
    return trim(preg_replace('/\s+/u', ' ', $walk($element)));
}
