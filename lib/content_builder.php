<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Renders the content canvas saved by GrapesJS. WHMCS owns the page shell. */
class ZM_PB_ContentBuilder
{
    private $data;
    private $authType;
    private $hasCarousel = false;
    private $hasAccordion = false;
    private $hasActionButton = false;
    private $injections = [];
    private $context = [];
    private $hasContactForm = false;
    private $paginationTargets = [];
    private $paginationNodes = [];
    private $paginationParts = [];
    private $listControlNodes = [];
    private $preloadImage = '';
    private static $queuedPreload = '';
    private static $preloadHookRegistered = false;

    public function __construct($rawContent, $authType = 'mixed', array $context = [])
    {
        $decoded = is_string($rawContent) ? json_decode($rawContent, true) : null;
        $this->data = is_array($decoded) && ($decoded['format'] ?? '') === 'grapesjs' ? $decoded : [];
        $this->authType = $authType;
        $this->context = $context;
    }

    private function allowed($zone)
    {
        if ($this->authType !== 'mixed' || $zone === 'mixed') return true;
        $loggedIn = !empty($_SESSION['uid']);
        return ($zone === 'auth' && $loggedIn) || ($zone === 'guest' && !$loggedIn);
    }

    private function smarty($expression, $pagination = null)
    {
        if (!defined('ZM_PB_USE_COLLECT_VARS') || ZM_PB_USE_COLLECT_VARS !== true || $expression === '') return '';
        try {
            require_once ZM_PB_LIBDIR . 'smarty_blocks.php';
            ZM_PB_SmartyBlocks::validate($expression);
            return ZM_PB_SmartyBlocks::queue($expression, $this->context['lang'] ?? null, $pagination);
        } catch (Throwable $error) {
            error_log('zmchel WHMCS Multimodule Smarty block: ' . $error->getMessage());
            return '';
        }
    }

    private function replaceWithHtml(DOMElement $element, $html)
    {
        $parent = $element->parentNode;
        if (!$parent) return;
        if ($html !== '') {
            $fragment = new DOMDocument('1.0', 'UTF-8');
            $previous = libxml_use_internal_errors(true);
            $fragment->loadHTML('<?xml encoding="UTF-8"?><html><body><div id="zm-pb-fragment">' . $html . '</div></body></html>');
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
            $xpath = new DOMXPath($fragment);
            $root = $xpath->query('//*[@id="zm-pb-fragment"]')->item(0);
            if ($root) {
                foreach ($root->childNodes as $child) {
                    $parent->insertBefore($element->ownerDocument->importNode($child, true), $element);
                }
            }
        }
        $parent->removeChild($element);
    }

    private function generatedCode($url, $type, $id = '')
    {
        if (!is_string($url) || !in_array($type, ['css', 'js'], true)) return null;
        $base = ZM_PB_ASSETSURL . 'generated/';
        if (strpos($url, $base) !== 0) return null;
        $file = rawurldecode(explode('?', substr($url, strlen($base)), 2)[0]);
        if ($id === '') {
            if (!preg_match('/^page_[0-9]+_[a-z]+_styles\.css$/D', $file)) return null;
        } else {
            if (!preg_match('/^code_[a-z0-9]{1,32}$/D', $id)
                || !preg_match('/^page_[0-9]+_[a-z]+_' . preg_quote($id, '/') . '\.' . $type . '$/D', $file)) return null;
        }
        $path = ZM_PB_ASSETSDIR . 'generated/' . $file;
        return is_file($path) ? file_get_contents($path) : null;
    }

    private function inlineTag($type, $code)
    {
        $tag = $type === 'css' ? 'style' : 'script';
        $code = str_ireplace('</' . $tag, '<\/' . $tag, $code);
        return '<' . $tag . '>' . $code . '</' . $tag . '>';
    }

    private function assetUrl($path)
    {
        return htmlspecialchars(ZM_PB_ASSETSURL . $path . '?v=' . filemtime(ZM_PB_ASSETSDIR . $path), ENT_QUOTES, 'UTF-8');
    }

    private function imageUrl($url)
    {
        if (!is_string($url) || $url === '' || strlen($url) >= 2048 || preg_match('/[\s,<>"\']/', $url)) return false;
        if (preg_match('~^https?://[^/]+~i', $url)) return true;
        return !preg_match('~^[a-z][a-z0-9+.-]*:~i', $url)
            && (preg_match('~^/(?!/)~', $url) || preg_match('~^[a-z0-9_.-]~i', $url));
    }

    private function imageSrcset($raw, $selectedUrl)
    {
        if (!is_string($raw) || strlen($raw) > 16384) return '';
        $variants = json_decode($raw, true);
        if (!is_array($variants) || count($variants) > 10) return '';
        $entries = [];
        $containsSelected = false;
        foreach ($variants as $variant) {
            if (!is_array($variant) || !$this->imageUrl($variant['url'] ?? null)) continue;
            $width = (int) ($variant['width'] ?? 0);
            if ($width < 1 || $width > 20000) continue;
            $candidatePath = rawurldecode((string) parse_url($variant['url'], PHP_URL_PATH));
            $selectedPath = rawurldecode((string) parse_url($selectedUrl, PHP_URL_PATH));
            $candidateHost = (string) parse_url($variant['url'], PHP_URL_HOST);
            $selectedHost = (string) parse_url($selectedUrl, PHP_URL_HOST);
            $url = $variant['url'];
            $selectedScheme = (string) parse_url($selectedUrl, PHP_URL_SCHEME);
            if ($candidateHost && $selectedHost && strcasecmp($candidateHost, $selectedHost) === 0
                && in_array($selectedScheme, ['http', 'https'], true)) {
                $url = preg_replace('~^https?://~i', $selectedScheme . '://', $url);
            }
            $entries[$width] = $url . ' ' . $width . 'w';
            if ($candidatePath !== '' && $candidatePath === $selectedPath
                && (!$candidateHost || !$selectedHost || strcasecmp($candidateHost, $selectedHost) === 0)) {
                $containsSelected = true;
            }
        }
        if (!$containsSelected || count($entries) < 2) return '';
        ksort($entries, SORT_NUMERIC);
        return implode(', ', $entries);
    }

    private function mediaImageSrcset($id, $src)
    {
        if (!defined('ZM_PB_MAINSYSTEM_ATTACHMENTS_URL')
            || !class_exists('Illuminate\\Database\\Capsule\\Manager')) return '';
        static $cache = [];
        $srcPath = (string) parse_url($src, PHP_URL_PATH);
        $basePath = (string) parse_url(ZM_PB_MAINSYSTEM_ATTACHMENTS_URL, PHP_URL_PATH);
        $srcHost = (string) parse_url($src, PHP_URL_HOST);
        $baseHost = (string) parse_url(ZM_PB_MAINSYSTEM_ATTACHMENTS_URL, PHP_URL_HOST);
        if ($srcHost && $baseHost && strcasecmp($srcHost, $baseHost) !== 0) return '';
        if ($basePath === '' || strpos($srcPath, $basePath) !== 0) return '';
        $selectedFile = rawurldecode(substr($srcPath, strlen($basePath)));
        if ($selectedFile !== basename($selectedFile) || !preg_match('/^[a-zA-Z0-9_.-]+$/D', $selectedFile)) return '';
        $key = $id > 0 ? 'id:' . $id : 'file:' . $selectedFile;
        if (!array_key_exists($key, $cache)) {
            try {
                $query = \Illuminate\Database\Capsule\Manager::table('zm_pb_attachments')->select('filename', 'sizes');
                if ($id > 0) $record = $query->where('id', $id)->first();
                else {
                    $stem = pathinfo($selectedFile, PATHINFO_FILENAME);
                    $extension = pathinfo($selectedFile, PATHINFO_EXTENSION);
                    $original = preg_replace('/_(large|medium|small|thumbnail)$/', '', $stem) . '.' . $extension;
                    $record = $query->whereIn('filename', array_unique([$selectedFile, $original]))
                        ->orderByRaw('CASE WHEN filename = ? THEN 0 ELSE 1 END', [$selectedFile])->first();
                }
                $sizes = $record ? json_decode((string) $record->sizes, true) : [];
                if (!is_array($sizes)) $sizes = [];
                if ($record && empty($sizes['full']['width'])
                    && defined('ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR')) {
                    $fullFile = (string) $record->filename;
                    if ($fullFile === basename($fullFile) && preg_match('/^[a-zA-Z0-9_.-]+$/D', $fullFile)) {
                        $path = rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fullFile;
                        $dimensions = is_file($path) ? @getimagesize($path) : false;
                        if ($dimensions) $sizes['full'] = ['filename' => $fullFile, 'width' => (int) $dimensions[0]];
                    }
                }
                $cache[$key] = $sizes;
            } catch (Throwable $error) {
                $cache[$key] = [];
            }
        }
        if (!is_array($cache[$key])) return '';
        $variants = [];
        $urlBase = ZM_PB_MAINSYSTEM_ATTACHMENTS_URL;
        $srcScheme = (string) parse_url($src, PHP_URL_SCHEME);
        if ($srcHost && in_array($srcScheme, ['http', 'https'], true)) {
            $urlBase = preg_replace('~^https?://~i', $srcScheme . '://', $urlBase);
        }
        foreach ($cache[$key] as $name => $size) {
            if (!is_array($size) || empty($size['filename'])) continue;
            $file = $size['filename'];
            if ($file !== basename($file) || !preg_match('/^[a-zA-Z0-9_.-]+$/D', $file)) continue;
            $variants[$name] = [
                'url' => $urlBase . rawurlencode($file),
                'width' => (int) ($size['width'] ?? 0),
            ];
        }
        return $this->imageSrcset(json_encode($variants), $src);
    }

    private function prepareImage(DOMElement $image)
    {
        $src = $image->getAttribute('src');
        if (((int) $image->getAttribute('width') < 1 || (int) $image->getAttribute('height') < 1)
            && defined('ZM_PB_MAINSYSTEM_ATTACHMENTS_URL') && defined('ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR')
            && ZM_PB_MAINSYSTEM_ATTACHMENTS_URL !== ''
            && strpos($src, ZM_PB_MAINSYSTEM_ATTACHMENTS_URL) === 0) {
            $file = rawurldecode(explode('?', substr($src, strlen(ZM_PB_MAINSYSTEM_ATTACHMENTS_URL)), 2)[0]);
            if ($file === basename($file) && preg_match('/^[a-zA-Z0-9_.-]+$/D', $file)) {
                static $sizeCache = [];
                if (!array_key_exists($file, $sizeCache)) {
                    $path = rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file;
                    $sizeCache[$file] = is_file($path) ? @getimagesize($path) : false;
                }
                if ($sizeCache[$file]) {
                    if ((int) $image->getAttribute('width') < 1) $image->setAttribute('width', (string) $sizeCache[$file][0]);
                    if ((int) $image->getAttribute('height') < 1) $image->setAttribute('height', (string) $sizeCache[$file][1]);
                }
            }
        }
        $enabled = $image->getAttribute('data-zm-pb-srcset') !== '0';
        $mediaId = (int) $image->getAttribute('data-zm-pb-media-id');
        $desktop = $enabled ? $this->imageSrcset($image->getAttribute('data-zm-pb-image-variants'), $src) : '';
        if ($enabled && $desktop === '' && $mediaId > 0) $desktop = $this->mediaImageSrcset($mediaId, $src);
        if ($enabled && $desktop === '') $desktop = $this->mediaImageSrcset(0, $src);
        foreach (['data-zm-pb-media-id', 'data-zm-pb-image-variants', 'data-zm-pb-mobile-src', 'data-zm-pb-mobile-variants',
            'data-zm-pb-mobile-width', 'data-zm-pb-mobile-height', 'data-zm-pb-srcset'] as $attribute) $image->removeAttribute($attribute);

        foreach (['width', 'height'] as $attribute) {
            $value = (int) $image->getAttribute($attribute);
            if ($value < 1 || $value > 20000) $image->removeAttribute($attribute);
            else $image->setAttribute($attribute, (string) $value);
        }
        if ($desktop !== '') {
            $image->removeAttribute('srcset');
            $image->removeAttribute('sizes');
            $parent = $image->parentNode;
            $picture = $parent instanceof DOMElement && strtolower($parent->tagName) === 'picture'
                ? $parent : $image->ownerDocument->createElement('picture');
            $source = $image->ownerDocument->createElement('source');
            $source->setAttribute('srcset', $desktop);
            $source->setAttribute('sizes', '100vw');
            if ($picture !== $parent) {
                $parent->replaceChild($picture, $image);
                $picture->appendChild($image);
            }
            $picture->insertBefore($source, $image);
        } else {
            $image->removeAttribute('srcset');
            $image->removeAttribute('sizes');
        }
    }

    private function prioritizeImages(DOMElement $root)
    {
        $highChosen = false;
        $walk = function (DOMNode $node, $blockIndex) use (&$walk, &$highChosen) {
            if (!$node instanceof DOMElement || $node->hasAttribute('hidden')
                || $node->getAttribute('aria-hidden') === 'true'
                || preg_match('/(?:^|;)\s*display\s*:\s*none\b/i', $node->getAttribute('style'))) return;
            if (strtolower($node->tagName) === 'img') {
                $src = $node->getAttribute('src');
                if (!$this->imageUrl($src)) return;
                $width = (int) $node->getAttribute('width');
                $source = $node->previousSibling;
                while ($source && !($source instanceof DOMElement)) $source = $source->previousSibling;
                $srcset = $source instanceof DOMElement && strtolower($source->tagName) === 'source'
                    ? $source->getAttribute('srcset') : $node->getAttribute('srcset');
                if (preg_match_all('/\s([1-9][0-9]*)w(?:,|$)/', $srcset, $matches)) {
                    $width = max($width, max(array_map('intval', $matches[1])));
                }
                $nearTop = $blockIndex < 5 && !empty($this->context['preload_eligible']);
                if ($nearTop) $node->setAttribute('loading', 'eager');
                if (!$highChosen && $nearTop && $width >= 400) {
                    $highChosen = true;
                    $node->setAttribute('loading', 'eager');
                    $node->setAttribute('fetchpriority', 'high');
                    $esc = function ($value) { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); };
                    $tag = '<link rel="preload" as="image"';
                    if ($srcset !== '') {
                        $tag .= ' imagesrcset="' . $esc($srcset) . '" imagesizes="100vw"';
                    } else $tag .= ' href="' . $esc($src) . '"';
                    $this->preloadImage = $tag . ' fetchpriority="high">';
                } elseif (!$nearTop && !$node->hasAttribute('fetchpriority')
                    && $node->getAttribute('loading') !== 'eager') {
                    $node->setAttribute('fetchpriority', 'low');
                }
                return;
            }
            foreach ($node->childNodes as $child) $walk($child, $blockIndex);
        };
        $blockIndex = 0;
        foreach ($root->childNodes as $child) {
            if ($child instanceof DOMElement) {
                $walk($child, $blockIndex);
                $blockIndex++;
            } else $walk($child, $blockIndex);
        }
    }

    private function process(DOMNode $node)
    {
        for ($child = $node->firstChild; $child; $child = $next) {
            $next = $child->nextSibling;
            if (!$child instanceof DOMElement) continue;

            if (in_array(strtolower($child->tagName), ['script', 'style', 'link'], true)) {
                $node->removeChild($child);
                continue;
            }

            if ($child->hasAttribute('data-zm-pb-auth')) {
                $zone = $child->getAttribute('data-zm-pb-auth');
                if (!in_array($zone, ['auth', 'guest', 'mixed'], true) || !$this->allowed($zone)) {
                    $node->removeChild($child);
                    continue;
                }
                $child->removeAttribute('data-zm-pb-auth');
            }

            if ($child->hasAttribute('data-zm-pb-pagination') || $child->hasAttribute('data-zm-pb-list-control')
                || $child->hasAttribute('data-zm-pb-page-count-control') || $child->hasAttribute('data-zm-pb-page-buttons')) {
                // Navigation is inserted after processing, so no preview enters the output.
                if ($child->getAttribute('data-zm-pb-page-layout') === '1') $this->process($child);
                continue;
            }
            if ($child->hasAttribute('data-zm-pb-smarty')) {
                $id = $child->getAttribute('id');
                $pagination = isset($this->paginationTargets[$id]) ? $id : null;
                $html = $this->smarty($child->getAttribute('data-zm-pb-smarty'), $pagination);
                if ($pagination !== null) {
                    $child->removeAttribute('data-zm-pb-smarty');
                    $classes = preg_split('/\s+/', trim($child->getAttribute('class')), -1, PREG_SPLIT_NO_EMPTY);
                    $classes = array_values(array_diff($classes, ['zm-pb-editor-placeholder']));
                    $classes[] = 'zm-pb-paginated-block';
                    $child->setAttribute('class', implode(' ', $classes));
                    while ($child->firstChild) $child->removeChild($child->firstChild);
                    // Keep the target anchor and layout styles around deferred content.
                    $placeholder = $child->ownerDocument->createElement('div');
                    $child->appendChild($placeholder);
                    $this->replaceWithHtml($placeholder, $html);
                } else $this->replaceWithHtml($child, $html);
                continue;
            }
            if ($child->hasAttribute('data-zm-pb-form')) {
                require_once ZM_PB_LIBDIR . 'contact_form.php';
                $form = ZM_PB_ContactForm::render($child, $this->context);
                if ($form !== '') $this->hasContactForm = true;
                $this->replaceWithHtml($child, $form);
                continue;
            }

            if ($child->hasAttribute('data-zm-pb-code')) {
                $id = $child->getAttribute('data-zm-pb-code-id');
                $expectedType = $child->getAttribute('data-zm-pb-code');
                $asset = $this->data['assets'][$id] ?? null;
                $code = is_array($asset) && ($asset['type'] ?? '') === $expectedType
                    ? $this->generatedCode($asset['url'] ?? null, $expectedType, $id) : null;
                if ($code === null || $code === '') { $node->removeChild($child); continue; }
                $token = 'ZM_PB_INLINE_' . bin2hex(random_bytes(12));
                $this->injections[$token] = $this->inlineTag($expectedType, $code);
                $node->replaceChild($child->ownerDocument->createTextNode($token), $child);
                continue;
            }

            if (strtolower($child->tagName) === 'img'
                && preg_match('~^data:image/svg\+xml~i', $child->getAttribute('src'))) {
                $node->removeChild($child);
                continue;
            }
            if ($child->hasAttribute('data-zm-pb-carousel')) $this->hasCarousel = true;
            if (strtolower($child->tagName) === 'img') $this->prepareImage($child);
            if ($child->hasAttribute('data-zm-pb-localize-link')) {
                if ($child->getAttribute('data-zm-pb-localize-link') === '1') {
                    require_once __DIR__ . '/content_links.php';
                    $language = $this->context['lang'] ?? ZM_PB_DEFLANG;
                    if (strtolower($child->tagName) === 'a' && $child->hasAttribute('href')) {
                        $child->setAttribute('href', ZM_PB_ContentLinks::localize($child->getAttribute('href'), $language));
                    } elseif ($child->hasAttribute('data-zm-pb-button')
                        && $child->getAttribute('data-zm-pb-action') === 'link') {
                        $child->setAttribute('data-zm-pb-href', ZM_PB_ContentLinks::localize($child->getAttribute('data-zm-pb-href'), $language));
                    }
                }
                $child->removeAttribute('data-zm-pb-localize-link');
            }
            if (in_array(strtolower($child->tagName), ['a', 'button'], true)
                && trim($child->getAttribute('aria-label')) === '' && trim($child->textContent) === ''
                && trim($child->getAttribute('title')) !== '') {
                $images = $child->getElementsByTagName('img');
                $hasNamedImage = false;
                foreach ($images as $linkImage) {
                    if (trim($linkImage->getAttribute('alt')) !== '') { $hasNamedImage = true; break; }
                }
                if (!$hasNamedImage) $child->setAttribute('aria-label', $child->getAttribute('title'));
            }
            if (($child->hasAttribute('data-zm-pb-accordion') || $child->hasAttribute('data-zm-pb-accordion-item')) && $child->getAttribute('data-zm-pb-animation') === 'slide') $this->hasAccordion = true;
            if ($child->hasAttribute('data-zm-pb-button')) {
                $action = $child->getAttribute('data-zm-pb-action');
                if ($action === 'script') $child->setAttribute('onclick', $child->getAttribute('data-zm-pb-onclick'));
                if ($action === 'link') $this->hasActionButton = true;
            }
            $this->process($child);
            $id = $child->getAttribute('id');
            if (isset($this->paginationTargets[$id])) {
                $html = '';
                foreach ($child->childNodes as $item) $html .= $child->ownerDocument->saveHTML($item);
                // Static containers paginate their own children, regardless of a stale variable setting.
                $html = ZM_PB_Pagination::paginateHtml($id, $html);
                while ($child->firstChild) $child->removeChild($child->firstChild);
                $placeholder = $child->ownerDocument->createElement('div');
                $child->appendChild($placeholder);
                $this->replaceWithHtml($placeholder, $html);
            }
        }
    }

    private function preparePagination(DOMElement $root)
    {
        require_once ZM_PB_LIBDIR . 'pagination.php';
        ZM_PB_Pagination::language($this->context['lang'] ?? 'english');
        $elements = [];
        $walk = function ($node) use (&$walk, &$elements) {
            foreach (iterator_to_array($node->childNodes) as $child) {
                if (!$child instanceof DOMElement) continue;
                if ($child->hasAttribute('data-zm-pb-auth')) {
                    $zone = $child->getAttribute('data-zm-pb-auth');
                    if (!in_array($zone, ['auth', 'guest', 'mixed'], true) || !$this->allowed($zone)) continue;
                }
                $elements[] = $child;
                $walk($child);
            }
        };
        $walk($root);
        $ids = [];
        foreach ($elements as $index => $element) if ($element->hasAttribute('id')) $ids[$element->getAttribute('id')] = [$element, $index];
        foreach ($elements as $index => $element) {
            if (!$element->hasAttribute('data-zm-pb-pagination')) continue;
            $id = $element->getAttribute('data-zm-pb-page-target');
            $target = $ids[$id][0] ?? null;
            $valid = $target && !$target->hasAttribute('data-zm-pb-pagination');
            for ($parent = $element->parentNode; $parent; $parent = $parent->parentNode) {
                if ($target && $parent->isSameNode($target)) $valid = false;
            }
            for ($parent = $target ? $target->parentNode : null; $parent; $parent = $parent->parentNode) {
                if ($parent->isSameNode($element)) $valid = false;
            }
            if (!$valid || isset($this->paginationTargets[$id])) {
                if ($element->parentNode) $element->parentNode->removeChild($element);
                continue;
            }
            if (!$target->hasAttribute('data-zm-pb-smarty')) $element->setAttribute('data-zm-pb-page-variable', '');
            if (ZM_PB_Pagination::register($element) === null) continue;
            $this->paginationTargets[$id] = $target;
            $this->paginationNodes[] = [$element, $id, $index < $ids[$id][1]];
        }
        $owners = [];
        foreach ($this->paginationNodes as [$pager, $id]) {
            if ($pager->getAttribute('data-zm-pb-page-layout') === '1' && $pager->hasAttribute('id')) $owners[$pager->getAttribute('id')] = $id;
        }
        foreach ($elements as $element) {
            $part = $element->hasAttribute('data-zm-pb-page-count-control') ? 'count'
                : ($element->hasAttribute('data-zm-pb-page-buttons') ? 'buttons' : null);
            if ($part === null) continue;
            $owner = $element->getAttribute('data-zm-pb-page-owner');
            $id = $owners[$owner] ?? null;
            if ($id === null || ($part === 'count' && !ZM_PB_Pagination::config($id)['count-select'])) {
                if ($element->parentNode) $element->parentNode->removeChild($element);
                continue;
            }
            $element->setAttribute('data-page-size', ZM_PB_Pagination::config($id)['size']);
            $this->paginationParts[] = [$element, $id, $part];
        }
        foreach ($elements as $element) {
            if (!$element->hasAttribute('data-zm-pb-list-control')) continue;
            $id = $element->getAttribute('data-zm-pb-page-target');
            $target = $ids[$id][0] ?? null;
            if (!$target || !$target->hasAttribute('data-zm-pb-smarty')) {
                if ($element->parentNode) $element->parentNode->removeChild($element);
                continue;
            }
            $variable = ltrim(trim($element->getAttribute('data-zm-pb-page-variable')), '$');
            $config = ZM_PB_Pagination::config($id);
            if ((!$config || $config['variable'] === '') && !preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/D', $variable)) {
                if ($element->parentNode) $element->parentNode->removeChild($element);
                continue;
            }
            if ($config && $config['variable'] === '' && preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/D', $variable)) {
                ZM_PB_Pagination::bindVariable($id, $variable);
            }
            if (!$config) ZM_PB_Pagination::register($element, false);
            $this->paginationTargets[$id] = $target;
            $this->listControlNodes[] = [$element, ZM_PB_ListControls::register($element, $id)];
        }
    }

    private function finishPagination()
    {
        foreach ($this->listControlNodes as [$element, $block]) {
            if ($element->parentNode) $this->replaceWithHtml($element, ZM_PB_ListControls::render($block));
        }
        if (!$this->paginationNodes) return;
        require_once ZM_PB_LIBDIR . 'smarty_blocks.php';
        foreach ($this->paginationParts as [$element, $id, $part]) {
            if (!$element->parentNode) continue;
            while ($element->firstChild) $element->removeChild($element->firstChild);
            $element->appendChild($element->ownerDocument->createElement('div'));
            $this->replaceWithHtml($element->firstChild, ZM_PB_SmartyBlocks::queue('', $this->context['lang'] ?? null, $id, $part));
        }
        foreach ($this->paginationNodes as [$element, $id, $before]) {
            $target = $this->paginationTargets[$id];
            if (!$element->parentNode || !$target->parentNode) continue;
            if ($element->getAttribute('data-zm-pb-page-layout') === '1') {
                if (ZM_PB_Pagination::config($id)['duplicate']) {
                    $copy = $element->cloneNode(true);
                    $clearIds = function ($node) use (&$clearIds) {
                        if ($node instanceof DOMElement) $node->removeAttribute('id');
                        foreach ($node->childNodes as $child) $clearIds($child);
                    };
                    $clearIds($copy);
                    $target->parentNode->insertBefore($copy, $before ? $target->nextSibling : $target);
                }
                continue;
            }
            $token = ZM_PB_SmartyBlocks::queue('', $this->context['lang'] ?? null, $id, true);
            if (ZM_PB_Pagination::config($id)['duplicate']) {
                $copy = $element->ownerDocument->createElement('div');
                $target->parentNode->insertBefore($copy, $before ? $target->nextSibling : $target);
                $this->replaceWithHtml($copy, $token);
            }
            $this->replaceWithHtml($element, $token);
        }
    }

    public function render()
    {
        if (!$this->data || !is_string($this->data['html'] ?? null)) return '';
        $document = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        $contentHtml = preg_replace('~^<body(?:\s[^>]*)?>(.*)</body>$~is', '$1', trim($this->data['html']));
        $loaded = $document->loadHTML('<?xml encoding="UTF-8"?><html><body><div id="zm-pb-content-root">' . $contentHtml . '</div></body></html>');
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        if (!$loaded) return '';
        $xpath = new DOMXPath($document);
        $root = $xpath->query('//*[@id="zm-pb-content-root"]')->item(0);
        if (!$root) return '';
        $this->preparePagination($root);
        $this->process($root);
        $this->finishPagination();
        $this->prioritizeImages($root);
        require_once ZM_PB_LIBDIR . 'schema.php';
        require_once ZM_PB_LIBDIR . 'table_of_contents.php';
        $contents = ZM_PB_TableOfContents::render($root, $this->context);
        $faq = ($this->context['schema_enabled'] ?? true) ? zm_pb_schema_faq($root, $this->context['schema'] ?? []) : [];

        $html = '';
        foreach ($root->childNodes as $child) $html .= $document->saveHTML($child);
        $html = strtr($html, $this->injections);
        if ($html === '') return '';
        $base = $this->assetUrl('css/content.css');
        $output = '<link rel="stylesheet" href="' . $base . '">' . "\n";
        if (is_string($this->data['cssUrl'] ?? null) && $this->data['cssUrl'] !== '') {
            $css = $this->generatedCode($this->data['cssUrl'], 'css');
            if ($css !== null && $css !== '') $output .= $this->inlineTag('css', $css) . "\n";
        }
        $output .= $html;
        if ($this->paginationNodes || $this->listControlNodes) {
            $output .= '<script src="' . $this->assetUrl('js/content-lists.js') . '" defer></script>';
        }
        $output .= zm_pb_schema_jsonld($faq);
        foreach ($contents['schemas'] as $schema) $output .= zm_pb_schema_jsonld($schema);
        if ($contents['has_contents']) {
            $src = $this->assetUrl('js/content-toc.js');
            $output .= '<script src="' . $src . '" defer></script>' . "\n";
        }
        if ($this->hasContactForm) {
            $src = $this->assetUrl('js/content-contact-form.js');
            $output .= '<script src="' . $src . '" defer></script>' . "\n";
        }
        if ($this->hasCarousel) {
            $src = $this->assetUrl('js/content-carousel.js');
            $output .= '<script src="' . $src . '" defer></script>' . "\n";
        }
        if ($this->hasAccordion) {
            $src = $this->assetUrl('js/content-accordion.js');
            $output .= '<script src="' . $src . '" defer></script>' . "\n";
        }
        if ($this->hasActionButton) {
            $src = $this->assetUrl('js/content-actions.js');
            $output .= '<script src="' . $src . '" defer></script>' . "\n";
        }
        return $output;
    }

    public static function build($rawContent, $authType = 'mixed', array $context = [])
    {
        $builder = new self($rawContent, $authType, $context);
        $html = $builder->render();
        if ($builder->preloadImage !== '' && function_exists('add_hook')) {
            if (self::$queuedPreload === '') self::$queuedPreload = $builder->preloadImage;
            if (!self::$preloadHookRegistered) {
                self::$preloadHookRegistered = true;
                add_hook('ClientAreaHeadOutput', 1, function () { return ZM_PB_ContentBuilder::$queuedPreload; });
            }
        }
        return $html;
    }
}
