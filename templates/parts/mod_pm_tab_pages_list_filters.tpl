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