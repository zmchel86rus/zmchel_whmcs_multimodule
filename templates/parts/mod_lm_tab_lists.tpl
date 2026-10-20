<div class="list-group">
    {foreach $lm_sections as $section}
    <a class="list-group-item" href="{$section.url|escape}#mod_lm_tab_lang_list">
        <strong>{$section.title|escape}</strong>
        <span class="badge">{$section.total|intval}</span>
        <small class="text-muted">{$lm_text->disabled|escape}: {$section.disabled|intval} · {$lm_text->available|escape}: {$section.missing|intval}</small>
    </a>
    {/foreach}
</div>
