{include file="./menus.tpl"}
<div id="zm-pagebuilder" class="panel panel-default zm-pb-menu-manager">
    <div class="panel-heading"><h3 class="panel-title">{$module_translates->menu_manager->title|escape}</h3></div>
    <div class="panel-body">
        {if $alertHtml}{$alertHtml}{/if}
        {if !$menu_ready}
            <a class="btn btn-primary" href="addonmodules.php?module={$addonName|escape}&amp;subpage=module_db">{$module_translates->module_db->title|escape}</a>
        {else}
        <div class="zm-pb-menu-switch">
            <label for="zm-pb-menu-select">{$menu_manager_translates->choose|escape}</label>
            <select id="zm-pb-menu-select" class="form-control">
                <option value="0">{$menu_manager_translates->new|escape}</option>
                {foreach $menu_data.menus as $menu}
                <option value="{$menu->id}"{if $menu_data.selected && $menu_data.selected->id == $menu->id} selected{/if}>{$menu->name|escape}</option>
                {/foreach}
            </select>
            <a href="addonmodules.php?module={$addonName|escape}&amp;subpage=menu_manager&amp;menu_id=0" class="btn btn-default">{$menu_manager_translates->new|escape}</a>
        </div>
        <div class="zm-pb-menu-layout">
            <aside class="zm-pb-menu-sources">
                <input type="search" id="zm-pb-menu-search" class="form-control" placeholder="{$menu_manager_translates->search|escape}" aria-label="{$menu_manager_translates->search|escape}">
                {foreach ['page','post'] as $type}
                <details open class="zm-pb-menu-source">
                    <summary>{if $type == 'page'}{$menu_manager_translates->pages|escape}{else}{$menu_manager_translates->posts|escape}{/if}</summary>
                    <div class="zm-pb-menu-page-list">
                    {foreach $menu_data.pages[$type] as $page}
                        <label class="zm-pb-menu-page" data-search="{$page.name|escape}">
                            <input type="checkbox" value="{$page.id}" data-page-type="{$type}">
                            <span>{$page.name|escape}<small>{$page.url|escape}</small><small>{$pages_manager_translates->page_status->translate->{$page.status|escape}}</small></span>
                        </label>
                    {/foreach}
                    </div>
                    {if $menu_data.pages[$type]}<button type="button" class="btn btn-default zm-pb-menu-add-pages">{$menu_manager_translates->add|escape}</button>{/if}
                </details>
                {/foreach}
                <details open class="zm-pb-menu-source">
                    <summary>{$menu_manager_translates->custom|escape}</summary>
                    <label for="zm-pb-menu-custom-label">{$menu_manager_translates->label|escape}</label>
                    <input id="zm-pb-menu-custom-label" class="form-control" maxlength="255">
                    <label for="zm-pb-menu-custom-url">{$menu_manager_translates->url|escape}</label>
                    <input id="zm-pb-menu-custom-url" class="form-control" value="/" maxlength="2048">
                    <button type="button" id="zm-pb-menu-add-custom" class="btn btn-default">{$menu_manager_translates->add|escape}</button>
                </details>
            </aside>
            <form method="post" action="addonmodules.php" id="zm-pb-menu-editor" class="zm-pb-menu-form zm-pb-menu-edit">
                <input type="hidden" name="module" value="{$addonName|escape}">
                <input type="hidden" name="subpage" value="menu_manager">
                <input type="hidden" name="action" value="save_menu">
                <input type="hidden" name="menu_id" value="{if $menu_data.selected}{$menu_data.selected->id}{else}0{/if}">
                <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce}">
                <input type="hidden" name="items" value="[]">
                <label for="zm-pb-menu-name">{$menu_manager_translates->name|escape}</label>
                <input id="zm-pb-menu-name" name="name" class="form-control" required maxlength="128" value="{if $menu_data.selected}{$menu_data.selected->name|escape}{/if}">
                <h4>{$menu_manager_translates->structure|escape}</h4>
                <p class="text-muted">{$menu_manager_translates->hint|escape}</p>
                <ul id="zm-pb-menu-tree" class="zm-pb-menu-group"></ul>
                <p id="zm-pb-menu-empty" class="text-muted">{$menu_manager_translates->empty|escape}</p>
                <section class="zm-pb-menu-settings">
                    <h4>{$menu_manager_translates->settings|escape}</h4>
                    <label><input type="checkbox" name="active" value="1"{if !$menu_data.selected || $menu_data.selected->active} checked{/if}> {$menu_manager_translates->active|escape}</label>
                    <label><input type="checkbox" name="auto_add" value="1"{if $menu_data.selected && $menu_data.selected->auto_add} checked{/if}> {$menu_manager_translates->auto_add|escape}</label>
                    <div class="zm-pb-menu-setting-row">
                        <label>{$menu_manager_translates->mode|escape}
                            <select name="mode" class="form-control"><option value="append">{$menu_manager_translates->append|escape}</option><option value="replace"{if $menu_data.selected && $menu_data.selected->mode == 'replace'} selected{/if}>{$menu_manager_translates->replace|escape}</option></select>
                        </label>
                        <label>{$menu_manager_translates->device|escape}
                            <select name="device" class="form-control"><option value="mixed">{$menu_manager_translates->device_mixed|escape}</option><option value="pc"{if $menu_data.selected && $menu_data.selected->device == 'pc'} selected{/if}>{$menu_manager_translates->device_pc|escape}</option><option value="mobile"{if $menu_data.selected && $menu_data.selected->device == 'mobile'} selected{/if}>{$menu_manager_translates->device_mobile|escape}</option></select>
                        </label>
                    </div>
                    <h4>{$menu_manager_translates->locations|escape}</h4>
                    <p class="text-muted">{$menu_manager_translates->location_hint|escape}</p>
                    {foreach $menu_data.locations as $location => $config}
                    <label class="zm-pb-menu-location">
                        <input type="checkbox" name="locations[]" value="{$location}"{if $menu_data.selected && $config.menu_id == $menu_data.selected->id} checked{/if}>
                        {$menu_manager_translates->$location|escape}
                        {if $location == 'footer'}<small class="text-muted">{$menu_manager_translates->footer_hint|escape}</small>{/if}
                        {if !$config.enabled}<small class="text-warning">{$menu_manager_translates->disabled_location|escape}: {$config.constant|escape}</small>{/if}
                        {if $config.menu_id && (!$menu_data.selected || $config.menu_id != $menu_data.selected->id)}<small>{$menu_manager_translates->assigned|escape} {$config.menu_id}</small>{/if}
                    </label>
                    {/foreach}
                </section>
                <div class="zm-pb-menu-savebar">
                    <span id="zm-pb-menu-message" role="status" aria-live="polite"></span>
                    {if $menu_data.selected}<button type="submit" name="action" value="delete_menu" formnovalidate class="btn btn-danger" id="zm-pb-menu-delete">{$menu_manager_translates->delete|escape}</button>{/if}
                    <button type="submit" class="btn btn-success">{$menu_manager_translates->save|escape}</button>
                </div>
            </form>
        </div>
        <script type="application/json" id="zm-pb-menu-editor-data">{$menu_editor_json nofilter}</script>
        {/if}
    </div>
</div>
{$page_assets}
