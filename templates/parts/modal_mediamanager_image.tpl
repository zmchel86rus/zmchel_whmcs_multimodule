<div class="modal fade zm_pb_media_manager_image" id="zm-pagebuilder" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="zm_pb_media_manager_form_edit">
                    <input type="hidden" id="id" name="id">
                    <div class="d-flex gap-x2 jc-sbtw">
                        <img src="" alt="">
                        <div class="zm-pb-media-nonimage d-none"><i class="fas fa-file" aria-hidden="true"></i><span></span></div>
                        <div class="form-wrapper">
                            <div class="form-group with-max-count" max-count="{$media_manager_translates->name->max_input}">
                                <label for="name">{$media_manager_translates->name->title}:</label>
                                <input-with-button>
                                    <input type="text" class="form-control" id="name" name="name">
                                    <i class="mini_reset_btn"></i>
                                </input-with-button>
                                <span class="description">{$media_manager_translates->input->max} {$media_manager_translates->input->count|lower} {$media_manager_translates->input->symbols|lower}: {$media_manager_translates->name->max_input}</span>
                            </div>
                            <div class="form-group with-max-count" max-count="{$media_manager_translates->alt->max_input}">
                                <label for="alt">{$media_manager_translates->alt->title}:</label>
                                <input-with-button>
                                    <input type="text" class="form-control" id="alt" name="alt">
                                    <i class="mini_reset_btn"></i>
                                </input-with-button>
                                <span class="description">{$media_manager_translates->input->max} {$media_manager_translates->input->count|lower} {$media_manager_translates->input->symbols|lower}: {$media_manager_translates->alt->max_input}</span>
                            </div>
                            <div class="form-group with-max-count" max-count="{$media_manager_translates->title->max_input}">
                                <label for="title">{$media_manager_translates->title->title}:</label>
                                <input-with-button>
                                    <input type="text" class="form-control" id="title" name="title">
                                    <i class="mini_reset_btn"></i>
                                </input-with-button>
                                <span class="description">{$media_manager_translates->input->max} {$media_manager_translates->input->count|lower} {$media_manager_translates->input->symbols|lower}: {$media_manager_translates->title->max_input}</span>
                            </div>
                            <div class="form-group with-max-count" max-count="{$media_manager_translates->description->max_input}">
                                <label for="description">{$media_manager_translates->description->title}:</label>
                                <input-with-button>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                    <i class="mini_reset_btn"></i>
                                </input-with-button>
                                <span class="description">{$media_manager_translates->input->max} {$media_manager_translates->input->count|lower} {$media_manager_translates->input->symbols|lower}: {$media_manager_translates->description->max_input}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group-btn d-flex jc-right">
                        <div class="zm-pb-media-optimize-controls mr-auto">
                            <button type="button" id="zm_pb_optimize_image" class="btn btn-default">{$media_manager_translates->optimize|escape}</button>
                            <span id="zm_pb_optimization_status" class="description" aria-live="polite"></span>
                        </div>
                        <input type="submit" name="delete" value="{$other_translates->delete}" class="btn btn-link mar-r-6" id="delete_mediafile" onclick="return confirm('{$other_translates->you_sure} {$other_translates->action_is_irreversible}');">
                        <input type="submit" name="save" value="{$other_translates->save}" class="btn btn-primary mar-l-6">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
