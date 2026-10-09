<script>
const formsNonce = '{$zm_pb_forms_nonce}';
const formsAdminNonce = '{$zm_pb_admin_nonce}';
const addonName = '{$addonName}';
const subpage = '{$subpage}';
const translate_texts = {
    you_sure: '{$other_translates->you_sure}',
    list_ol: '{$other_translates->list_ol}',
    list_ul: '{$other_translates->list_ul}',
    choose_mediafile:'{$media_manager_translates->select}',
    img_err_size:'{$media_manager_translates->upload_file_alerts->img_err_size}',
    img_err_format:'{$media_manager_translates->upload_file_alerts->img_err_format}',
    img_err_novalid:'{$media_manager_translates->upload_file_alerts->img_err_novalid}',
    image_optimized: {$media_manager_translates->optimization_attempted|json_encode nofilter},
}
</script>


{include file="./menus.tpl"}


<div id="zm-pagebuilder" class="panel panel-default mediafiles-manager">
    <div class="panel-heading">
        <h3 class="panel-title">{$module_translates->media_manager->title}</h3>
    </div>
    <div class="panel-body">
        {if $alertHtml}{$alertHtml}{/if}
        <form id="zm_pb_media_manager_form">
            <div class="zm-pb-media-manager-actions">
                <button type="button" class="btn btn-primary" id="zm_pb_mediamanager_upload_button">{$media_manager_translates->upload}</button>
                <input type="file" name="file" id="zm_pb_mediamanager_upload_input" class="d-none image-wrapper-input with_preview" data-preview="mediamanager_upload_preview_image" accept="image/*,audio/*,video/*,.pdf">
            </div>
            <div id="mediamanager_upload_preview_image" class="file-preview"></div>
            <div class="form-group with-max-count d-none" max-count="{$media_manager_translates->name->max_input}">
                <label for="name">{$media_manager_translates->name->title}:</label>
                <input-with-button>
                    <input type="text" class="form-control" id="name" name="name">
                    <i class="mini_reset_btn"></i>
                </input-with-button>
                <span class="description">{$media_manager_translates->input->max} {$media_manager_translates->input->count|lower} {$media_manager_translates->input->symbols|lower}: {$media_manager_translates->name->max_input}</span>
            </div>
            <div class="form-group with-max-count d-none" max-count="{$media_manager_translates->alt->max_input}">
                <label for="alt">{$media_manager_translates->alt->title}:</label>
                <input-with-button>
                    <input type="text" class="form-control" id="alt" name="alt">
                    <i class="mini_reset_btn"></i>
                </input-with-button>
                <span class="description">{$media_manager_translates->input->max} {$media_manager_translates->input->count|lower} {$media_manager_translates->input->symbols|lower}: {$media_manager_translates->alt->max_input}</span>
            </div>
            <div class="form-group with-max-count d-none" max-count="{$media_manager_translates->title->max_input}">
                <label for="title">{$media_manager_translates->title->title}:</label>
                <input-with-button>
                    <input type="text" class="form-control" id="title" name="title">
                    <i class="mini_reset_btn"></i>
                </input-with-button>
                <span class="description">{$media_manager_translates->input->max} {$media_manager_translates->input->count|lower} {$media_manager_translates->input->symbols|lower}: {$media_manager_translates->title->max_input}</span>
            </div>
            <div class="form-group with-max-count d-none" max-count="{$media_manager_translates->description->max_input}">
                <label for="description">{$media_manager_translates->description->title}:</label>
                <input-with-button>
                    <textarea class="form-control" id="description" name="description"></textarea>
                    <i class="mini_reset_btn"></i>
                </input-with-button>
                <span class="description">{$media_manager_translates->input->max} {$media_manager_translates->input->count|lower} {$media_manager_translates->input->symbols|lower}: {$media_manager_translates->description->max_input}</span>
            </div>
            <div class="form-group-btn d-none">
                <button type="submit" class="btn btn-success mr-8px">{$media_manager_translates->upload}</button>
                <button type="reset" class="btn btn-danger">{$other_translates->cancel}</button>
            </div>
        </form>
        <div class="zm-pb-media-filters">
            <label class="sr-only" for="zm_pb_media_filter_search">{$media_manager_translates->filters->search}</label>
            <input type="search" id="zm_pb_media_filter_search" class="form-control" maxlength="128" placeholder="{$media_manager_translates->filters->search|escape:'html'}">
            <label class="sr-only" for="zm_pb_media_filter_type">{$media_manager_translates->filters->type}</label>
            <select id="zm_pb_media_filter_type" class="form-control">
                <option value="">{$media_manager_translates->filters->all}</option>
                <option value="image">{$media_manager_translates->filters->image}</option>
                <option value="audio">{$media_manager_translates->filters->audio}</option>
                <option value="video">{$media_manager_translates->filters->video}</option>
                <option value="pdf">PDF</option>
            </select>
        </div>
        <div id="zm_pb_admin_media_files" class="zm-pb-admin-media-files" data-empty="{$media_manager_translates->filters->no_results|escape:'html'}"></div>
        <button type="button" id="zm_pb_admin_media_more" class="btn btn-default zm-pb-media-more d-none">{$media_manager_translates->filters->load_more}</button>
    </div>
</div>

{$modal_mediamanager_image}

{$page_assets}
