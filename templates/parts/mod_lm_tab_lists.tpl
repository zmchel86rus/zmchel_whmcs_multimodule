<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead><tr>
            <th>{$lm_text->sections|escape}</th>
            <th class="text-center">{$lm_text->languages|escape}</th>
            <th class="text-center">{$lm_text->disabled|escape}</th>
            <th class="text-center">{$lm_text->available|escape}</th>
        </tr></thead>
        <tbody>
        {foreach $lm_sections as $section}
        <tr>
            <td><a href="{$section.url|escape}#mod_lm_tab_lang_list">{$section.title|escape}</a></td>
            <td class="text-center">{$section.total|intval}</td>
            <td class="text-center">{$section.disabled|intval}</td>
            <td class="text-center">{$section.missing|intval}</td>
        </tr>
        {/foreach}
        </tbody>
    </table>
</div>
