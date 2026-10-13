                    <h2>{$pages_editor_translates->page_headers->sitemap}</h2>
                    {assign var="can_edit_sitemap" value=$page_data->main->status === 'publish' && $page_data->main->type !== 'system'}
                    <form id="form_sitemap" method="POST" action="addonmodules.php?module={$addonName}&subpage={$subpage}" data-form-order="4" {if !$can_edit_sitemap}class="disabled-form"{/if}>
                        <input type="hidden" name="module" value="{$addonName}">
                        <input type="hidden" name="subpage" value="{$subpage}">
                        <input type="hidden" name="zm_pb_forms_nonce" value="{$zm_pb_forms_nonce}">
                        <input type="hidden" name="action" value="edit_page_sitemap">
                        <input type="hidden" name="page_id" value="{$page_data->main->id}">
                            
                        <div class="form-group">
                            <label for="edit_sitemap[changefreq]">{$pages_editor_translates->page_sitemap_changefreq->title}:</label>
                            <select class="form-control" id="edit_sitemap[changefreq]" name="edit_sitemap[changefreq]" {if !$can_edit_sitemap}disabled{/if}>
                            {foreach from=$pages_editor_translates->page_sitemap_changefreq->translate key=status item=translated_status}
                                <option value="{$status}" {if isset($page_data->sitemap->changefreq) && $status === $page_data->sitemap->changefreq}selected{elseif !isset($page_data->sitemap->changefreq) && $status === 'monthly'}selected{/if}>{$translated_status}</option>
                            {/foreach}
                            </select>
                            <span class="description">{$pages_editor_translates->page_sitemap_changefreq->description|escape:'html'}</span>
                        </div>
                        <div class="form-group">
                            <label for="edit_sitemap[priority]">{$pages_editor_translates->page_sitemap_priority->title}:</label>
                            <input type="number" step="0.1" min="0" max="1" class="form-control" id="edit_sitemap[priority]" name="edit_sitemap[priority]" value="{if isset($page_data->sitemap->priority)}{$page_data->sitemap->priority}{else}0.5{/if}" {if !$can_edit_sitemap}disabled{/if}>
                            <span class="description">{$pages_editor_translates->page_sitemap_priority->description|escape:'html'}</span>
                        </div>

                        {*
                        <div class="form-group">
                            <label for="edit_sitemap[url]">{$pages_editor_translates->page_sitemap_url->title}:</label>
                            <input type="text" 
                                class="form-control" 
                                id="edit_sitemap[url]" 
                                name="edit_sitemap[url]" 
                                value="{if isset($page_data->sitemap->url) && ! empty($page_data->sitemap->url) }{$page_data->sitemap->url|escape:'html'}{else}{$main_host_url}{$page_data->main->slug|escape}{/if}" readonly>
                            <span class="description">{$pages_editor_translates->page_sitemap_url->description|escape:'html'}</span>
                        </div>
                        *}
                        <input type="hidden" id="edit_sitemap[url]" name="edit_sitemap[url]" 
                            value="{if isset($page_data->sitemap->url) && ! empty($page_data->sitemap->url) }{$page_data->sitemap->url|escape:'html'}{else}{$main_host_url}{$page_data->main->slug|escape}{/if}" readonly>

                        <div class="form-group-btn sticky">
                            <button type="submit" class="btn btn-success mr-8px" {if !$can_edit_sitemap}disabled{/if}>{$other_translates->save}</button>
                            <button type="reset" class="btn btn-danger" {if !$can_edit_sitemap}disabled{/if}>{$other_translates->cancel}</button>
                        </div>
                    </form>
                    {if $page_data->main->type === 'system'}
                    <div class="alert alert-info">{$pages_editor_translates->page_sitemap_noshow->type}</div>
                    {elseif $page_data->main->status !== 'publish'}
                    <div class="alert alert-warning">{$pages_editor_translates->page_sitemap_noshow->no_publish}</div>
                    {/if}