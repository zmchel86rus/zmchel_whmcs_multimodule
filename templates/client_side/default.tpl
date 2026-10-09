{* Page Builder - client area page output.
   $content is fully rendered HTML produced by ZM_PB_ContentBuilder (lib/content_builder.php).
   WHMCS itself renders the header/footer - do not add them here. *}

<div class="zm-pb-page" data-page-id="{$page->id}" lang="{$lang_localeBCP47|default:''}">
    {$content nofilter}
</div>