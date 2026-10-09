{include file="./menus.tpl"}

<div id="zm-pagebuilder" class="panel panel-default pages-list">
    <div class="panel-heading">
        <h3 class="panel-title">{$module_translates->sitemap_manager->title|escape}</h3>
    </div>
    <div class="panel-body">
    {if $alertHtml}{$alertHtml}{/if}
    <div class="well well-sm">
        <div><strong>{$sitemap_manager_translates->frequency|escape}:</strong> {$sitemap_status.frequency|escape}</div>
        <div><strong>{$sitemap_manager_translates->last_update|escape}:</strong> {$sitemap_status.last_update|default:$sitemap_manager_translates->never|escape}</div>
        {if $sitemap_status.enabled}<div><strong>{$sitemap_manager_translates->next_update|escape}:</strong> {$sitemap_status.next_update|default:$sitemap_manager_translates->next_cron|escape}</div>{/if}
        <p class="help-block">{$sitemap_manager_translates->cron_hint|escape}</p>
        <form method="POST" action="addonmodules.php" id="zm-pb-sitemap-generate">
            <input type="hidden" name="module" value="{$addonName}">
            <input type="hidden" name="subpage" value="sitemap_manager">
            <input type="hidden" name="action" value="generate_sitemaps">
            <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
            <input type="hidden" name="zm_pb_admin_nonce" value="{$zm_pb_admin_nonce}">
            <button type="submit" class="btn btn-primary"{if !$sitemap_status.enabled || !$sitemap_ready} disabled{/if}><i class="fas fa-sync-alt"></i> {$sitemap_manager_translates->generate|escape}</button>
            <a class="btn btn-default" href="addonmodules.php?module={$addonName|escape}&amp;subpage=module_settings">{$sitemap_manager_translates->settings|escape}</a>
            {if !$sitemap_ready}<a class="btn btn-default" href="addonmodules.php?module={$addonName|escape}&amp;subpage=module_db">{$module_translates->module_db->title|escape}</a>{/if}
        </form>
    </div>
    {if $sitemap_status.files}
        <h4>{$sitemap_manager_translates->files|escape}</h4>
        <table class="table table-bordered table-striped">
            <thead><tr><th>{$sitemap_manager_translates->file|escape}</th><th>{$other_translates->date_update_last|escape}</th><th>{$sitemap_manager_translates->owner|escape}</th></tr></thead>
            <tbody>{foreach $sitemap_status.files as $file}<tr>
                <td><a href="{$file.url|escape}" target="_blank" rel="noopener">{$file.name|escape}</a></td>
                <td>{$file.lastmod|escape}</td>
                <td>{if $file.owned || $file.name === 'sitemap_index.xml'}{$sitemap_manager_translates->module|escape}{else}{$sitemap_manager_translates->external|escape}{/if}</td>
            </tr>{/foreach}</tbody>
        </table>
    {/if}
    <h4>{$sitemap_manager_translates->entries|escape}</h4>
    <p class="help-block">{$sitemap_manager_translates->entries_hint|escape}</p>
    {if $elements_list}
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{$sitemap_translates->page_sitemap_url->title}</th>
                    <th>{$other_translates->type}</th>
                    <th>{$sitemap_translates->page_sitemap_changefreq->title}</th>
                    <th>{$sitemap_translates->page_sitemap_priority->title}</th>
                    <th>{$other_translates->date_update_last}</th>
                    <th>{$other_translates->action}</th>
                </tr>
            </thead>
            <tbody>
            {foreach from=$elements_list item=element}
                <tr>
                    <td>{$element.url|escape}</td>
                    <td>{$sitemap_translates->page_type->translate->{$element.sitemap_type}|escape} ({$element.lang|escape})</td>
                    <td>{$sitemap_translates->page_sitemap_changefreq->translate->{$element.changefreq}|escape} ({$element.changefreq|escape})</td>
                    <td>{$element.priority|escape}</td>
                    <td>{$element.lastmod|escape}</td>
                    <td>
                        <a class="btn btn-primary" href="addonmodules.php?module={$addonName|escape}&amp;subpage=pages_editor&amp;page_id={$element.page_id}" target="_blank" rel="noopener">
                            <i class="fas fa-edit"></i> {$other_translates->edit}
                        </a>
                        <a class="btn btn-primary" href="{$element.url|escape}" target="_blank" rel="noopener">
                            <i class="fas fa-eye"></i> {$other_translates->visit}
                        </a>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    {else}
        <div class="alert alert-warning">
            {$other_translates->no_found}<br>
        </div>
    {/if}
    </div>
</div>
