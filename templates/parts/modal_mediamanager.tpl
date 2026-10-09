<div class="modal fade zm_pb_media_manager" id="zm-pagebuilder" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{$media_manager_translates->mediafiles}</h4>
            </div>
            <div class="modal-body">
                <div class="zm-pb-media-manager-actions">
                    <button type="button" class="btn btn-primary" id="zm_pb_media_upload_button">{$media_manager_translates->upload}</button>
                    <input type="file" id="zm_pb_media_upload_input" class="d-none" accept="image/*,audio/*,video/*,.pdf">
                </div>
                <div class="zm-pb-media-filters">
                    <label class="sr-only" for="zm_pb_modal_media_search">{$media_manager_translates->filters->search}</label>
                    <input type="search" id="zm_pb_modal_media_search" class="form-control" maxlength="128" placeholder="{$media_manager_translates->filters->search|escape:'html'}">
                    <label class="sr-only" for="zm_pb_modal_media_type">{$media_manager_translates->filters->type}</label>
                    <select id="zm_pb_modal_media_type" class="form-control">
                        <option value="">{$media_manager_translates->filters->all}</option>
                        <option value="image">{$media_manager_translates->filters->image}</option>
                        <option value="audio">{$media_manager_translates->filters->audio}</option>
                        <option value="video">{$media_manager_translates->filters->video}</option>
                        <option value="pdf">PDF</option>
                    </select>
                </div>
                <div id="zm_pb_media_manager_files" class="zm-pb-media-manager-files" data-empty="{$media_manager_translates->filters->no_results|escape:'html'}"></div>
                <button type="button" id="zm_pb_modal_media_more" class="btn btn-default zm-pb-media-more d-none">{$media_manager_translates->filters->load_more}</button>
            </div>
        </div>
    </div>
</div>
