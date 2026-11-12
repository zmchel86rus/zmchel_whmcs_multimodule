<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
        {foreach $module_subpages as $subpage}
            {if ! in_array($subpage, ['pages_editor','sitemap_manager','module_db','module_settings'])}
                <li class="{if $menuName == $subpage && !isset($view_trash) }active{/if}">
                    <a href="addonmodules.php?module={$addonName}&subpage={$subpage}">
                    {if $module_translates->$subpage}
                        {$module_translates->$subpage->title}
                    {else}
                        {$subpage|capitalize}
                    {/if}
                    </a>
                </li>
            {/if}
        {/foreach}
        </ul>
    </div>
</div>
