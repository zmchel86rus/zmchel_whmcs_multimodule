<form method="POST" action="addonmodules.php" class="pd-0 mar-t-3">
    <input type="hidden" name="module" value="{$addonName}">
    <input type="hidden" name="subpage" value="{$subpage}">
    <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
    <input type="hidden" name="zm_pb_secure_nonce" value="{$zm_pb_secure_nonce}">
    <input type="hidden" name="action" value="edit_robots">

    <div class="form-group">
        <label for="edit_robots" class="d-flex gap-1 ai-center w-fit">{$module_settings_translates->robots->title}</label>
        <textarea id="edit_robots" name="edit_robots" placeholder="..." class="block-editor">{$robots}</textarea>
        <span class="description">{$module_settings_translates->robots->description|escape:'html'}</span>
    </div>
    <div class="form-group-btn mar-t-6 sticky">
        <button type="submit" class="btn btn-success mar-r-1">{$other_translates->update}</button>
    </div>
</form>