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
{if $lm_filename_fixes}
<form class="lm-action-form lm-filename-form" method="post" action="addonmodules.php">
    <input type="hidden" name="module" value="{$addonName|escape}">
    <input type="hidden" name="subpage" value="{$subpage}">
    <input type="hidden" name="section" value="all">
    <input type="hidden" name="action" value="fix_language_filename">
    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce|escape}">
    <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce|escape}">
    <select class="form-control input-sm lm-filename-select" name="language" aria-label="{$other_translates->fix|escape}">
        {foreach $lm_filename_fixes as $fix}
        <option value="{$fix.old|escape}" data-target="{$fix.new|escape}">{$fix.old|escape}.php</option>
        {/foreach}
    </select>
    <span class="lm-filename-arrow" aria-hidden="true">&rarr;</span>
    <code class="lm-filename-target">{$lm_filename_fixes[0].new|escape}.php</code>
    <button type="submit" class="btn btn-default btn-sm">{$other_translates->fix|escape}</button>
</form>
{/if}
