<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Build contents from the visible, rendered module content in document order. */
class ZM_PB_TableOfContents
{
    private static function excluded(DOMElement $element, DOMElement $root, $allowContents = false)
    {
        for ($parent = $element; $parent instanceof DOMElement && $parent !== $root; $parent = $parent->parentNode) {
            if ($parent->hasAttribute('hidden') || $parent->getAttribute('aria-hidden') === 'true'
                || strtolower($parent->tagName) === 'form' || $parent->hasAttribute('data-zm-pb-code')
                || ($parent->hasAttribute('data-zm-pb-toc') && (!$allowContents || $parent !== $element))
                || preg_match('/(?:^|;)\s*(?:display\s*:\s*none|visibility\s*:\s*hidden)\s*(?:!important\s*)?(?:;|$)/i', $parent->getAttribute('style'))) return true;
        }
        return false;
    }

    private static function id(DOMElement $element, $fallback, array &$ids)
    {
        $id = $element->getAttribute('id');
        if ($id !== '' && !preg_match('/\s/u', $id) && ($ids[$id] ?? 0) === 1) return $id;
        $id = $fallback; $suffix = 2;
        while (isset($ids[$id])) $id = $fallback . '-' . $suffix++;
        $ids[$id] = 1;
        $element->setAttribute('id', $id);
        return $id;
    }

    public static function render(DOMElement $root, array $context)
    {
        $xpath = new DOMXPath($root->ownerDocument);
        if (!$xpath->query('.//*[@data-zm-pb-toc]', $root)->length) return ['has_contents' => false, 'schemas' => []];
        $ids = []; $headings = []; $contents = []; $position = 0;
        foreach ($xpath->query('.//*[@id]', $root) as $element) {
            $id = $element->getAttribute('id');
            $ids[$id] = ($ids[$id] ?? 0) + 1;
        }
        foreach ($xpath->query('.//*', $root) as $element) {
            $position++;
            if ($element->hasAttribute('data-zm-pb-toc')) {
                if (!self::excluded($element, $root, true)) $contents[] = ['node' => $element, 'position' => $position];
            } elseif (preg_match('/^h([1-6])$/iD', $element->tagName, $match) && !self::excluded($element, $root)) {
                $name = trim(preg_replace('/\s+/u', ' ', $element->textContent));
                if ($name !== '') $headings[] = ['node' => $element, 'position' => $position, 'level' => (int) $match[1], 'name' => $name];
            }
        }
        $graphs = []; $targets = []; $hasContents = false;
        $pageUrl = explode('#', (string) ($context['schema']['URL'] ?? ''), 2)[0];
        foreach ($contents as $index => $content) {
            $toc = $content['node'];
            $minimum = max(1, min(6, (int) ($toc->getAttribute('data-zm-pb-toc-min') ?: 1)));
            $maximum = max($minimum, min(6, (int) ($toc->getAttribute('data-zm-pb-toc-max') ?: 6)));
            $entries = [];
            foreach ($headings as $heading) {
                if ($heading['position'] <= $content['position'] || $heading['level'] < $minimum || $heading['level'] > $maximum) continue;
                $key = spl_object_id($heading['node']);
                if (!isset($targets[$key])) {
                    $targets[$key] = self::id($heading['node'], 'zm-pb-heading-' . substr(sha1(($context['page_id'] ?? '') . ':' . $heading['position'] . ':' . $heading['name']), 0, 12), $ids);
                }
                $heading['id'] = $targets[$key];
                $heading['url'] = $pageUrl . '#' . rawurlencode($heading['id']);
                $entries[] = $heading;
            }
            if (!$entries) { $toc->parentNode->removeChild($toc); continue; }
            $hasContents = true;
            $tocId = self::id($toc, 'zm-pb-toc-' . ($index + 1), $ids);
            $title = trim($toc->getAttribute('data-zm-pb-toc-title'));
            $offset = $toc->getAttribute('data-zm-pb-toc-offset');
            $offset = $offset === '' ? 96 : max(0, min(400, (int) $offset));
            $toc->setAttribute('aria-label', $title !== '' ? $title : 'Contents');
            self::addClass($toc, 'zm-pb-toc');
            while ($toc->firstChild) $toc->removeChild($toc->firstChild);
            if ($title !== '') {
                $caption = $root->ownerDocument->createElement('div');
                $caption->setAttribute('class', 'zm-pb-toc-title');
                $caption->appendChild($root->ownerDocument->createTextNode($title));
                $toc->appendChild($caption);
            }
            $listTag = $toc->getAttribute('data-zm-pb-toc-numbered') === '1' ? 'ol' : 'ul';
            $list = $root->ownerDocument->createElement($listTag);
            $toc->appendChild($list);
            $stack = [];
            foreach ($entries as $entry) {
                while ($stack && end($stack)['level'] >= $entry['level']) array_pop($stack);
                $parentList = $list;
                if ($stack && $toc->getAttribute('data-zm-pb-toc-nested') !== '0') {
                    $parent = end($stack)['item'];
                    $parentList = $parent->lastChild;
                    if (!$parentList instanceof DOMElement || strtolower($parentList->tagName) !== $listTag) {
                        $parentList = $root->ownerDocument->createElement($listTag);
                        $parent->appendChild($parentList);
                    }
                }
                $item = $root->ownerDocument->createElement('li');
                $link = $root->ownerDocument->createElement('a');
                $link->setAttribute('href', $entry['url']);
                $link->appendChild($root->ownerDocument->createTextNode($entry['name']));
                $item->appendChild($link); $parentList->appendChild($item);
                $stack[] = ['level' => $entry['level'], 'item' => $item];
                self::addClass($entry['node'], 'zm-pb-toc-target');
                $style = preg_replace('/(?:^|;)\s*--zm-pb-anchor-offset\s*:[^;]*/', '', $entry['node']->getAttribute('style'));
                $style = trim($style, '; ');
                $entry['node']->setAttribute('style', ($style !== '' ? $style . ';' : '') . '--zm-pb-anchor-offset:' . $offset . 'px');
            }
            if (($context['schema_enabled'] ?? true) && $pageUrl !== '') {
                $graphs[] = zm_pb_schema_contents($tocId, $title, $entries, $context);
            }
        }
        return ['has_contents' => $hasContents, 'schemas' => $graphs];
    }

    private static function addClass(DOMElement $element, $class)
    {
        if (strpos(' ' . $element->getAttribute('class') . ' ', ' ' . $class . ' ') === false) {
            $element->setAttribute('class', trim($element->getAttribute('class') . ' ' . $class));
        }
    }
}
