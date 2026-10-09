{include file="./menus.tpl"}

<div id="zm-pagebuilder" class="panel panel-default pages-list">
    <div class="panel-heading">
        <h3 class="panel-title">
        {if ! isset($view_trash) }
        {$module_translates->pages_manager->title}
        {else}
        {$module_translates->trash->title}
        {/if}
        </h3>
    </div>
    <div class="panel-body">
        {if $alertHtml}{$alertHtml}{/if}

        {if ! isset($view_trash) }
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#tab_pages_list" aria-controls="tab_pages_list" role="tab" data-toggle="tab">
                    {$module_translates->pages_manager->title}
                </a>
            </li>
            <li role="presentation">
                <a href="#tab_add_page" aria-controls="tab_add_page" role="tab" data-toggle="tab">
                    {$pages_manager_translates->add_page->title}
                </a>
            </li>
            
            <li class="{if isset($pages_trashed) && $pages_trashed == 0}d-none {/if}trash_route">
                <a href="?module={$addonName}&subpage={$subpage}&action=view_trash">
                    {$pages_manager_translates->page_status->translate->canceled} (<count>{$pages_trashed}</count>)
                </a>
            </li>
        </ul>
        {/if}
        
        <div class="tab-content mar-t-3">
            <div role="tabpanel" class="tab-pane active" id="tab_pages_list">
                <form method="GET" action="addonmodules.php" class="form-inline mar-b-3" id="pages_list_filters">
                    <input type="hidden" name="module" value="{$addonName|escape:'html'}">
                    <input type="hidden" name="subpage" value="pages_manager">
                    {if isset($view_trash)}<input type="hidden" name="action" value="view_trash">{/if}
                    <div class="form-group mar-r-1 mar-b-1">
                        <label class="sr-only" for="filter_name">{$pages_manager_translates->page_name->title}</label>
                        <input class="form-control" type="search" id="filter_name" name="filter_name" maxlength="128" value="{$pages_filters.name|default:''|escape:'html'}" placeholder="{$pages_manager_translates->page_name->title|escape:'html'}">
                    </div>
                    <div class="form-group mar-r-1 mar-b-1">
                        <label class="sr-only" for="filter_auth">{$pages_manager_translates->page_auth_type->title}</label>
                        <select class="form-control" id="filter_auth" name="filter_auth">
                            <option value="">{$pages_manager_translates->page_auth_type->title}: {$pages_manager_translates->list_filters->all}</option>
                            {foreach from=$pages_manager_translates->page_auth_type->translate key=value item=label}
                                <option value="{$value|escape:'html'}"{if $pages_filters.auth == $value} selected{/if}>{$label|escape:'html'}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group mar-r-1 mar-b-1">
                        <label class="sr-only" for="filter_type">{$pages_manager_translates->page_type->title}</label>
                        <select class="form-control" id="filter_type" name="filter_type">
                            <option value="">{$pages_manager_translates->page_type->title}: {$pages_manager_translates->list_filters->all}</option>
                            {foreach from=$pages_manager_translates->page_type->translate key=value item=label}
                                <option value="{$value|escape:'html'}"{if $pages_filters.type == $value} selected{/if}>{$label|escape:'html'}</option>
                            {/foreach}
                        </select>
                    </div>
                    {if !isset($view_trash)}
                    <div class="form-group mar-r-1 mar-b-1">
                        <label class="sr-only" for="filter_status">{$pages_manager_translates->page_status->title}</label>
                        <select class="form-control" id="filter_status" name="filter_status">
                            <option value="">{$pages_manager_translates->page_status->title}: {$pages_manager_translates->list_filters->all}</option>
                            {foreach from=$pages_manager_translates->page_status->translate key=value item=label}
                                {if $value != 'canceled'}<option value="{$value|escape:'html'}"{if $pages_filters.status == $value} selected{/if}>{$label|escape:'html'}</option>{/if}
                            {/foreach}
                        </select>
                    </div>
                    {/if}
                    <div class="form-group mar-r-1 mar-b-1">
                        <label class="sr-only" for="filter_lang">{$module_translates->supported_langs->title}</label>
                        <select class="form-control" id="filter_lang" name="filter_lang">
                            <option value="">{$module_translates->supported_langs->title}: {$pages_manager_translates->list_filters->all}</option>
                            {foreach from=$module_langs key=value item=lang_data}
                                <option value="{$value|escape:'html'}"{if $pages_filters.lang == $value} selected{/if}>{$module_translates->supported_langs->translate->$value|escape:'html'}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mar-b-1">{$pages_manager_translates->list_filters->apply}</button>
                    <a class="btn btn-default mar-b-1" href="addonmodules.php?module={$addonName|escape:'url'}&amp;subpage=pages_manager{if isset($view_trash)}&amp;action=view_trash{/if}">{$pages_manager_translates->list_filters->reset}</a>
                </form>
                {if isset($pages_list) && $pages_list->count() > 0}
                <table id="pages_list_table" class="table table-bordered table-striped">
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
                                {$page->name}
                            </td>
                            {else}
                            <td class="hover-div">
                                {$page->name}
                                <div class="d-flex gap-02 mar-t-1">
                                    {if $page->status !== 'canceled'}
                                    <a class="btn btn-link w-fit pd-0" href="/{$page->slug}" target="_blank">
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
                                <element-with-flag>
                                    <i class="country-flags {$module_langs[$lang_name]['code']|lower}"></i>
                                    {$module_langs[$lang_name]['icon']} {$module_translates->supported_langs->translate->$lang_name}
                                </element-with-flag>
                            {/foreach}
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
            </div>
            
            {if ! isset($view_trash) }
            <div role="tabpanel" class="tab-pane" id="tab_add_page">
                <div class="tab-content mar-t-3">
                    <form id="create_page_form" method="POST" action="addonmodules.php">
                        <input type="hidden" name="module" value="{$addonName}">
                        <input type="hidden" name="subpage" value="{$subpage}">
                        <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                        <input type="hidden" name="action" value="create_page">

                        <div class="form-group">
                            <label for="name"><span style="color:red">*</span>{$pages_manager_translates->page_name->title}:</label>
                            <input type="text" class="form-control page-name-field" id="name" name="name" placeholder="{$pages_manager_translates->page_name->title}" required>
                            <span class="description">{$pages_manager_translates->page_name->description|escape:'html'}</label>
                        </div>

                        <div class="form-group">
                            <label for="slug"><span style="color:red">*</span>{$pages_manager_translates->page_slug->title}:</label>
                            <input type="text" class="form-control page-slug-field" id="slug" name="slug" placeholder="{$pages_manager_translates->page_slug->example}" required>
                            <span class="description">{$pages_manager_translates->page_slug->description|escape:'html'}</span>
                        </div>
                        
                        <div class="form-group">
                            <label for="auth_type">{$pages_manager_translates->page_auth_type->title}:</label>
                            <select class="form-control" id="auth_type" name="auth_type">
                            {foreach from=$pages_manager_translates->page_auth_type->translate key=status item=translated_status}
                                <option value="{$status}">{$translated_status}</option>
                            {/foreach}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">{$pages_manager_translates->page_type->title}:</label>
                            <select class="form-control" id="type" name="type">
                            {foreach from=$pages_manager_translates->page_type->translate key=status item=translated_status}
                                <option value="{$status}">{$translated_status}</option>
                            {/foreach}
                            </select>
                            <span class="description">{$pages_manager_translates->page_type->description|escape:'html'}</span>
                        </div>

                        <div>
                            <label>{$pages_manager_translates->page_langs->title}:</label>
                            <div class="form-group">
                            {foreach from=$module_langs key=lang_name item=lang_data}
                                {if $lang_name !== $main_default_lang}
                                <label for="langs[{$lang_name}]">
                                    {$lang_data['name']} ({$module_translates->supported_langs->translate->$lang_name}) 
                                    <input type="checkbox" id="langs[{$lang_name}]" name="langs[{$lang_name}]" style="display:none">
                                </label>
                                {/if}
                            {/foreach}
                            </div>
                            <span class="description d-block">{$pages_manager_translates->page_langs->default_language}: {$module_langs[$main_default_lang]['name']} ({$module_translates->supported_langs->translate->$main_default_lang})</span>
                            <span class="description d-block">{$pages_manager_translates->page_langs->description|escape:'html'}</span>
                        </div>
                        
                        <div class="form-group-btn mar-t-6 sticky">            
                            <button type="submit" class="btn btn-success mar-r-1">{$other_translates->save}</button>
                            <button type="reset" class="btn btn-danger">{$other_translates->cancel}</button>
                        </div>
                    </form>
                </div>
            </div>  
            {/if}  
        </div>
    </div>
</div>
