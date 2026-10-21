            {if isset($pages_list) && $pages_list->count() > 0}
                <table id="pages_list_table" class="table table-bordered table-striped" style="--show-text:'{$other_translates->show}';--hide-text:'{$other_translates->hide}';">
                    {if ! isset($view_trash) }
                    <thead>
                        <tr>
                            <th>{$pages_manager_translates->page_name->title}</th>
                            <th>{$pages_manager_translates->page_status->title}</th>
                            <th>{$pages_manager_translates->page_auth_type->title}</th>
                            <th>{$pages_manager_translates->page_type->title}</th>
                            <th>{$module_translates->supported_langs->title}</th>
                            <th>{$other_translates->date}</th>
                        </tr>
                    </thead>
                    {/if}
                    <tbody>
                        {foreach from=$pages_list item=page}
                        <tr>
                            {if isset($view_trash) }
                            <td>
                                {$page->name|escape:'html'}
                            </td>
                            {else}
                            <td class="hover-div">
                                {$page->name|escape:'html'}
                                <div class="d-flex gap-02 mar-t-1">
                                    {if $page->status !== 'canceled'}
                                    <a class="btn btn-link w-fit pd-0" href="{$page->visit_url|escape:'html'}" target="_blank">
                                        {$other_translates->visit}
                                    </a>
                                    {/if}
                                    <a class="btn btn-link w-fit pd-0" href="addonmodules.php?module={$addonName}&subpage=pages_editor&page_id={$page->id}">
                                        {if $page->status !== 'canceled'}{$other_translates->edit}{/if}
                                    </a>
                                    <form class="d-inblock w-fit pd-0" method="DELETE" action="addonmodules.php">
                                        <input type="hidden" name="module" value="{$addonName}">
                                        <input type="hidden" name="subpage" value="{$subpage}">
                                        <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                                        {if $page->status === 'canceled'}
                                        <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce}">
                                        <input type="hidden" name="action" value="delete">
                                        {else}
                                        <input type="hidden" name="action" value="trash">
                                        {/if}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="type" value="page">
                                        <input type="hidden" name="id" value="{$page->id}">
                                        <button class="btn btn-link w-fit pd-0 btn-delete" type="submit" onclick="return confirm('{$other_translates->you_sure}');">
                                            {$other_translates->delete}
                                        </button>
                                    </form>
                                </div>
                            </td>
                            {/if}
                            <td>{$pages_manager_translates->page_status->translate->{$page->status}}</td>
                            <td>{$pages_manager_translates->page_auth_type->translate->{$page->auth_type}}</td>
                            <td>{$pages_manager_translates->page_type->translate->{$page->type}}</td>
                            <td>
                                {foreach from=$page->langs item=lang_name}
                                    {if $lang_name@index < 5}
                                        <element-with-flag>
                                            <i class="country-flags {$module_langs[$lang_name]['code']|lower}"></i>
                                            {$module_langs[$lang_name]['icon']} {$module_translates->supported_langs->translate->$lang_name}
                                        </element-with-flag>
                                    {/if}
                                {/foreach}
                                {if $page->langs|@count > 5}
                                <div class="extra-langs">
                                    <div class="extra-langs" style="display:none;">
                                        {foreach from=$page->langs item=lang_name}
                                            {if $lang_name@index >= 5}
                                                <element-with-flag>
                                                    <i class="country-flags {$module_langs[$lang_name]['code']|lower}"></i>
                                                    {$module_langs[$lang_name]['icon']} {$module_translates->supported_langs->translate->$lang_name}
                                                </element-with-flag>
                                            {/if}
                                        {/foreach}
                                    </div>
                                    <span>({$page->langs|@count-5})</span>
                                </div>
                                {/if}
                            </td>
                            <td>
                            {if $page->created_at < $page->updated_at }
                                <sub>{$other_translates->date_publish}</sub>
                                <span class="d-block">
                                    {$page->created_at}
                                </span>
                                <sub>{$other_translates->date_update_last}</sub>
                                <span class="d-block">
                                    {$page->updated_at}
                                </span>
                            {else}
                                {$page->created_at}
                            {/if}
                            </td>
                            {if isset($view_trash) }
                            <td>
                                <div class="d-flex gap-1">
                                    <a class="btn btn-primary" href="addonmodules.php?module={$addonName}&subpage=pages_editor&page_id={$page->id}" target="_blank">
                                        <i class="fas fa-edit"></i> {if $page->status !== 'canceled'}{$other_translates->edit}{/if}
                                    </a>
                                    <form class="d-inblock pd-0" method="DELETE" action="addonmodules.php">
                                        <input type="hidden" name="module" value="{$addonName}">
                                        <input type="hidden" name="subpage" value="{$subpage}">
                                        <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                                        {if $page->status === 'canceled'}
                                        <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce}">
                                        <input type="hidden" name="action" value="delete">
                                        {else}
                                        <input type="hidden" name="action" value="trash">
                                        {/if}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="type" value="page">
                                        <input type="hidden" name="id" value="{$page->id}">
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('{$other_translates->you_sure}');">
                                            <i class="fas fa-trash"></i> {if $page->status === 'canceled'}{$other_translates->delete}{/if}
                                        </button>
                                    </form>
                                </div>
                            </td>
                            {/if}
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
                {else}
                <div class="alert alert-info">{$pages_manager_translates->list_filters->no_results}</div>
                {/if}

                {if isset($pages_pagination) && $pages_pagination.last_page > 1}
                <nav aria-label="{$pages_manager_translates->list_filters->pagination|escape:'html'}">
                    <ul class="pagination mar-t-1">
                        {if $pages_pagination.page > 1}<li><a href="{$pages_filter_url|escape:'html'}&amp;page={$pages_pagination.page-1}">&laquo;</a></li>{/if}
                        {foreach from=$pages_pagination.pages item=page_number}
                        <li{if $page_number == $pages_pagination.page} class="active"{/if}><a href="{$pages_filter_url|escape:'html'}&amp;page={$page_number}">{$page_number}</a></li>
                        {/foreach}
                        {if $pages_pagination.page < $pages_pagination.last_page}<li><a href="{$pages_filter_url|escape:'html'}&amp;page={$pages_pagination.page+1}">&raquo;</a></li>{/if}
                    </ul>
                    <span class="text-muted mar-l-1">{$pages_pagination.from}–{$pages_pagination.to} / {$pages_pagination.total}</span>
                </nav>
                {/if}
                
                {if ! isset($view_trash) && isset($enable_page_overrides) }
                <div class="mar-t-5 pd-t-1 pd-b-1 border-0 border-t-2 border-b-2 border-solid" style="border-color: #f5f5f5;">
                    <h3 class="panel-title">{$pages_manager_translates->page_overrides->title}</h3>
                    <form id="page_overrides_form" method="POST" action="addonmodules.php" class="pd-0 mar-t-3">
                        <input type="hidden" name="module" value="{$addonName}">
                        <input type="hidden" name="subpage" value="{$subpage}">
                        <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                        <input type="hidden" name="action" value="page_overrides">

                        <button type="button" class="btn btn-sm btn-success mar-b-3 duplicate add" data-duplicate-target="page_overrides">{$other_translates->add} {$other_translates->override|lower}</button>

                        <div data-page-overrides-rows>
                        {foreach from=$page_override_rows item=override_row}
                        <div class="form-group d-flex ai-center gap-04" data-duplicate="page_overrides">
                            <div class="form-group d-inblock mar-0 w-20">
                                <select class="form-control" name="page_overrides[from][]" data-override-source>
                                    <option value="">-- {$other_translates->choice} --</option>
                                    {foreach from=$whmcs_pages_list item=whmcs_page}
                                    <option value="{$whmcs_page|escape:'html'}"{if $override_row.from === $whmcs_page} selected{/if}>{$pages_manager_translates->page_overrides->translate->$whmcs_page}</option>
                                    {/foreach}
                                </select>
                            </div>
                            =>
                            <div class="form-group d-inblock mar-0 w-20">
                                <select class="form-control" name="page_overrides[to][]">
                                    <option value="">-- {$other_translates->choice} --</option>
                                {foreach from=$pages_name_slug_array key=page_slug item=page_name}
                                    <option value="{$page_slug|escape:'html'}"{if $override_row.to === $page_slug} selected{/if}>{$page_name|escape:'html'}</option>
                                {/foreach}
                                </select>
                            </div>
                            <div class="form-group d-inblock mar-0 w-20">
                                <select class="form-control" name="page_overrides[type][]">
                                <option value="">-- {$other_translates->choice} --</option>
                                {foreach from=$pages_manager_translates->page_overrides->type key=override_type item=override_translate}
                                    <option value="{$override_type|escape:'html'}"{if $override_row.type === $override_type} selected{/if}>{$override_translate}</option>
                                {/foreach}
                                </select>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger duplicate delete" data-duplicate-target="page_overrides"><i class="fa fa-minus" aria-hidden="true"></i></button>
                        </div>
                        {/foreach}
                        </div>
                        <span class="description d-block">{$pages_manager_translates->page_overrides->type_description}</span>
                            
                        <div class="form-group-btn mar-t-6 sticky">            
                            <button type="submit" class="btn btn-success mar-r-1">{$other_translates->update}</button>
                        </div>
                    </form>
                </div>
            {/if}
