<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Search/filter definitions belong to saved blocks, never to request-supplied column names. */
class ZM_PB_ListControls
{
    private static $rules = [];

    public static function register(DOMElement $block, $target)
    {
        $settings = json_decode($block->getAttribute('data-zm-pb-list-settings'), true);
        if (!is_array($settings)) $settings = [];
        $key = 'zq_' . substr(hash('sha256', $target . ':' . $block->getAttribute('id')), 0, 12);
        $definitions = [];
        if ($block->getAttribute('data-zm-pb-list-control') === 'search') {
            $fields = preg_split('/[\s,]+/', (string) ($settings['searchFields'] ?? 'domain_name'), -1, PREG_SPLIT_NO_EMPTY);
            $fields = array_values(array_filter(array_unique($fields), [self::class, 'validField']));
            if ($fields) $definitions[] = ['name' => $key, 'fields' => array_slice($fields, 0, 20), 'type' => 'text',
                'label' => (string) ($settings['label'] ?? 'Search'), 'options' => []];
        } else {
            foreach (array_slice(is_array($settings['fields'] ?? null) ? $settings['fields'] : [], 0, 30) as $index => $field) {
                if (!is_array($field)) continue;
                $type = in_array($field['type'] ?? '', ['text', 'select', 'range', 'date', 'checkbox'], true) ? $field['type'] : 'text';
                $fields = $type === 'text' ? preg_split('/[\s,]+/', (string) ($field['field'] ?? ''), -1, PREG_SPLIT_NO_EMPTY) : [$field['field'] ?? ''];
                $fields = array_values(array_filter($fields, [self::class, 'validField']));
                if (!$fields) continue;
                $options = [];
                foreach (explode("\n", (string) ($field['options'] ?? '')) as $line) {
                    $parts = explode(':', trim($line), 2);
                    if ($parts[0] !== '') $options[trim($parts[0])] = trim($parts[1] ?? $parts[0]);
                }
                $definitions[] = ['name' => $key . '_' . $index, 'fields' => array_slice($fields, 0, 20), 'type' => $type,
                    'label' => (string) ($field['label'] ?? $field['field']), 'options' => $options,
                    'placeholder' => (string) ($field['placeholder'] ?? ''), 'span' => max(1, min(4, (int) ($field['span'] ?? 1))),
                    'width' => in_array((string) ($field['width'] ?? ''), ['25','33','50','75','100'], true) ? $field['width'] . '%' : 'auto'];
            }
        }
        foreach ($definitions as $definition) self::$rules[$target][$definition['name']] = $definition;
        return ['target' => $target, 'definitions' => $definitions, 'settings' => $settings];
    }

    public static function validField($field)
    {
        return is_string($field) && preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*(?:\.[a-zA-Z_][a-zA-Z0-9_]*)*$/D', $field);
    }

    private static function input($name)
    {
        $query = ZM_PB_Pagination::cleanQuery($_GET);
        $value = $query[$name] ?? '';
        return is_string($value) ? mb_substr(trim($value), 0, 250, 'UTF-8') : '';
    }

    private static function active($target)
    {
        $rules = [];
        foreach (self::$rules[$target] ?? [] as $rule) {
            if ($rule['type'] === 'date') {
                $value = [self::date(self::input($rule['name'] . '_min')), self::date(self::input($rule['name'] . '_max'))];
                if ($value === [null, null]) continue;
                if ($value[0] !== null && $value[1] !== null && $value[0] > $value[1]) $value = [$value[1], $value[0]];
            } elseif ($rule['type'] === 'range') {
                $min = self::input($rule['name'] . '_min'); $max = self::input($rule['name'] . '_max');
                $value = [is_numeric($min) && is_finite((float) $min) ? (float) $min : null,
                    is_numeric($max) && is_finite((float) $max) ? (float) $max : null];
                if ($value === [null, null]) continue;
                if ($value[0] !== null && $value[1] !== null && $value[0] > $value[1]) $value = [$value[1], $value[0]];
            } else {
                $value = self::input($rule['name']);
                if ($value === '') continue;
                if ($rule['type'] === 'select' && !array_key_exists($value, $rule['options'])) continue;
                if ($rule['type'] === 'checkbox' && $value !== '1') continue;
            }
            $rule['value'] = $value; $rules[] = $rule;
        }
        return $rules;
    }

    public static function canQuery($target, array $columns)
    {
        foreach (self::active($target) as $rule) foreach ($rule['fields'] as $field) if (!isset($columns[$field])) return false;
        return true;
    }
    private static function date($value)
    {
        if (!preg_match('/^(\d{4})-(\d{2})-(\d{2})$/D', $value, $m) || !checkdate((int) $m[2], (int) $m[3], (int) $m[1])) return null;
        return $value;
    }

    public static function query($target, $query, array $columns)
    {
        foreach (self::active($target) as $rule) {
            $query->where(function ($group) use ($rule, $columns) {
                foreach ($rule['fields'] as $field) {
                    $column = $columns[$field]; $value = $rule['value'];
                    if ($rule['type'] === 'text') {
                        // Literal substring search: '%' and '_' are not SQL wildcards.
                        $wrapped = $group->getGrammar()->wrap($column);
                        $group->orWhereRaw('LOCATE(?, LOWER(COALESCE(' . $wrapped . ", ''))) > 0", [mb_strtolower($value, 'UTF-8')]);
                    } elseif ($rule['type'] === 'date') {
                        if ($value[0] !== null) $group->where($column, '>=', $value[0]);
                        if ($value[1] !== null) $group->where($column, '<', (new DateTimeImmutable($value[1]))->modify('+1 day')->format('Y-m-d'));
                    } elseif ($rule['type'] === 'range') {
                        if ($value[0] !== null) $group->where($column, '>=', $value[0]);
                        if ($value[1] !== null) $group->where($column, '<=', $value[1]);
                    } else $group->where($column, '=', $value);
                }
            });
        }
        return $query;
    }

    private static function value($row, $field)
    {
        foreach (explode('.', $field) as $part) {
            if (is_object($row)) $row = get_object_vars($row);
            if (!is_array($row) || !array_key_exists($part, $row)) return null;
            $row = $row[$part];
        }
        return is_scalar($row) ? $row : null;
    }

    public static function filter($target, array $items)
    {
        $rules = self::active($target);
        if (!$rules) return $items;
        return array_filter($items, function ($item) use ($rules) {
            foreach ($rules as $rule) {
                $matches = false;
                foreach ($rule['fields'] as $field) {
                    $value = self::value($item, $field);
                    if ($value === null) continue;
                    if ($rule['type'] === 'text') $matches = mb_stripos((string) $value, $rule['value'], 0, 'UTF-8') !== false;
                    elseif ($rule['type'] === 'date') {
                        $date = self::date(substr((string) $value, 0, 10));
                        $matches = $date !== null && ($rule['value'][0] === null || $date >= $rule['value'][0]) && ($rule['value'][1] === null || $date <= $rule['value'][1]);
                    }
                    elseif ($rule['type'] === 'range') $matches = is_numeric($value)
                        && ($rule['value'][0] === null || $value >= $rule['value'][0]) && ($rule['value'][1] === null || $value <= $rule['value'][1]);
                    else $matches = (string) $value === $rule['value'];
                    if ($matches) break;
                }
                if (!$matches) return false;
            }
            return true;
        });
    }

    private static function esc($value) { return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

    public static function hidden($name, $value, $depth = 0)
    {
        if ($depth > 5) return '';
        if (!is_array($value)) return '<input type="hidden" name="' . self::esc($name) . '" value="' . self::esc($value) . '">';
        $html = '';
        foreach ($value as $key => $item) $html .= self::hidden($name . '[' . $key . ']', $item, $depth + 1);
        return $html;
    }

    public static function render(array $block)
    {
        $url = ZM_PB_Pagination::url($block['target'], 1);
        $path = parse_url($url, PHP_URL_PATH) ?: '/';
        parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
        foreach ($block['definitions'] as $rule) {
            unset($query[$rule['name']], $query[$rule['name'] . '_min'], $query[$rule['name'] . '_max']);
        }
        $reset = $path . ($query ? '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986) : '') . '#' . rawurlencode($block['target']);
        $settings = $block['settings'];
        $size = in_array($settings['size'] ?? '', ['small', 'large'], true) ? $settings['size'] : 'standard';
        $appearance = ($settings['appearance'] ?? '') === 'underline' ? 'underline' : 'outline';
        $style = '';
        foreach (['desktop' => 3, 'tablet' => 2, 'mobile' => 1] as $device => $default) $style .= '--zm-list-' . $device . ':' . max(1, min(4, (int) ($settings[$device] ?? $default))) . ';';
        $mode = ($settings['layout'] ?? '') === 'flex' ? 'flex' : 'grid';
        foreach (['direction'=>['row','column','row-reverse','column-reverse'], 'wrap'=>['wrap','nowrap'],
            'justify'=>['flex-start','center','flex-end','space-between'], 'align'=>['stretch','flex-start','center','flex-end']] as $key => $allowed) {
            $style .= '--zm-list-' . $key . ':' . (in_array($settings[$key] ?? '', $allowed, true) ? $settings[$key] : $allowed[0]) . ';';
        }
        $style .= '--zm-list-gap:' . max(0, min(64, (int) ($settings['gap'] ?? 18))) . 'px;';
        $buttons = in_array($settings['buttons'] ?? '', ['start','inline'], true) ? $settings['buttons'] : 'end';
        $html = '<form method="get" class="zm-pb-list-controls zm-pb-list-size-' . $size . ' zm-pb-list-' . $appearance . ' zm-pb-list-layout-' . $mode . ' zm-pb-list-buttons-' . $buttons . '" data-list-direction="' . self::esc($settings['direction'] ?? 'row') . '" style="' . $style . '" data-zm-auto-apply="' . (($settings['autoApply'] ?? '') === '1' ? '1' : '0') . '" action="' . self::esc($path . '#' . rawurlencode($block['target'])) . '">';
        foreach ($query as $name => $value) $html .= self::hidden($name, $value);
        foreach ($block['definitions'] as $rule) {
            $name = $rule['name']; $value = self::input($name);
            $ratio = ($rule['width'] ?? 'auto') === 'auto' ? 'auto' : (int) $rule['width'] / 100;
            $html .= '<label class="zm-pb-list-field" style="--zm-list-span:' . ($rule['span'] ?? 1) . ';--zm-list-ratio:' . $ratio . ';--zm-list-width:' . ($rule['width'] ?? 'auto') . '"><span>' . self::esc($rule['label']) . '</span>';
            if ($rule['type'] === 'range' || $rule['type'] === 'date') {
                $html .= '<span class="zm-pb-list-range">';
                foreach (['min', 'max'] as $side) $html .= '<input type="' . ($rule['type'] === 'date' ? 'date' : 'number') . '" step="' . ($rule['type'] === 'date' ? '1' : 'any') . '" name="' . $name . '_' . $side . '" value="' . self::esc(self::input($name . '_' . $side)) . '" aria-label="' . self::esc($rule['label'] . ' ' . ($settings[$side] ?? $side)) . '" placeholder="' . self::esc($settings[$side] ?? $side) . '">';
                $html .= '</span>';
            } elseif ($rule['type'] === 'select') {
                $html .= '<select name="' . $name . '"><option value="">' . self::esc($settings['all'] ?? 'All') . '</option>';
                foreach ($rule['options'] as $option => $label) $html .= '<option value="' . self::esc($option) . '"' . ((string) $option === $value ? ' selected' : '') . '>' . self::esc($label) . '</option>';
                $html .= '</select>';
            } elseif ($rule['type'] === 'checkbox') {
                $html .= '<input type="checkbox" name="' . $name . '" value="1"' . ($value === '1' ? ' checked' : '') . '>';
            } else $html .= '<input type="search" maxlength="250" placeholder="' . self::esc($rule['placeholder'] ?? '') . '" name="' . $name . '" value="' . self::esc($value) . '">';
            $html .= '</label>';
        }
        return $html . '<div class="zm-pb-list-actions"><button type="submit">' . self::esc($settings['submit'] ?? 'Apply') . '</button><a href="' . self::esc($reset) . '">' . self::esc($settings['reset'] ?? 'Reset') . '</a></div></form>';
    }
}
