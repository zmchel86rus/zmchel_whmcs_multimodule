<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
        {foreach $module_subpages as $subpage}
            {if $subpage != 'pages_editor'}
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
            <li class="{if $menuName == 'readme.md'}active{/if}">
                <a href="addonmodules.php?module={$addonName|escape:'url'}&amp;subpage=README.md">{$module_translates->instruction|escape:'html'}</a>
            </li>
        </ul>
    </div>
</div>
