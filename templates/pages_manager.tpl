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
                <a href="#mod_pm_tab_pages_list" aria-controls="mod_pm_tab_pages_list" role="tab" data-toggle="tab">
                    {$module_translates->pages_manager->title}
                </a>
            </li>
            <li role="presentation">
                <a href="#mod_pm_tab_add_page" aria-controls="mod_pm_tab_add_page" role="tab" data-toggle="tab">
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
            <div role="tabpanel" class="tab-pane active" id="mod_pm_tab_pages_list">
                {include file="./parts/mod_pm_tab_pages_list_filters.tpl"}
                {include file="./parts/mod_pm_tab_pages_list_content.tpl"}
            </div>
            
            {if ! isset($view_trash) }
            <div role="tabpanel" class="tab-pane" id="mod_pm_tab_add_page">
                {include file="./parts/mod_pm_tab_add_page.tpl"}
            </div>  
            {/if}  
        </div>
    </div>
    <hr>
    <a class="d-block pd-2" href="{$main_host_url}admin/addonmodules.php?module={$addonName|escape}&amp;subpage=README.md&amp;doc={$subpage}" target="_blank">{$module_translates->instruction|escape} - {$module_translates->{$subpage}->title|escape}</a>
</div>
