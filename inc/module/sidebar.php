<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

function zmchel_whmcs_multimodule_sidebar($vars){
    $module_subpages = ZM_PB_SUBPAGES;
    $module_translates = $GLOBALS['ZM_PB_ADMINLANG']->module;
    $addonName = ZM_PB_NAME;
    
    $include_subpages = ['sitemap_manager','module_db','module_settings'];
    $sidebar = '<div class="sidebar-header"><span class="header"><i class="fa fa-cogs"></i>'.$module_translates->main->title.'</span></div><ul class="menu">';
    
    foreach ($module_subpages as $subpage){
        if ( !in_array($subpage,$include_subpages) || $subpage == 'pages_editor') continue;
        $sidebar .='<li> <a href="addonmodules.php?module='.$addonName.'&subpage='.$subpage.'">'.$module_translates->$subpage->title.'</a></li>';
    }

    $sidebar .= '<li><a href="addonmodules.php?module='.$addonName.'&subpage=README.md">'.$module_translates->instruction.'</a></li>';
        
    $sidebar .= '</ul>';

    add_hook('AdminAreaFooterOutput', 99999, function ($vars) use ($sidebar) {

        if ( ($vars['template'] ?? '') !== 'iris' || ($vars['filename'] ?? '') !== 'addonmodules' || ($_GET['module'] ?? '') !== ZM_PB_NAME) return '';
        

        $sidebarJson = json_encode(
            $sidebar,
            JSON_HEX_TAG | JSON_HEX_AMP |
            JSON_HEX_APOS | JSON_HEX_QUOT |
            JSON_INVALID_UTF8_SUBSTITUTE
        );

        return <<<HTML
        <script>
        (function () {

            const sidebarHTML = {$sidebarJson};

            function init() {

                const target = document.querySelector(
                    'nav.rail-menu > ul.rail-root:not(.rail-pinned)'
                );

                if (!target || document.getElementById('zm-pb-iris-menu')) {
                    return;
                }

                // Разбираем существующий HTML сайдбара
                const template = document.createElement('template');
                template.innerHTML = sidebarHTML;

                const title = template.content.querySelector('.sidebar-header .header');
                const links = template.content.querySelectorAll('ul.menu a[href]');

                if (!title || !links.length) return;

                // Новый блок навигации Iris
                const menu = document.createElement('ul');
                menu.id = 'zm-pb-iris-menu';
                menu.className = 'rail-root';

                const group = document.createElement('li');
                group.className = 'rail-group rail-section open';

                // Заголовок
                const header = document.createElement('div');
                header.className = 'rail-section-toggle';

                const label = document.createElement('span');
                label.className = 'rail-section-label';
                label.innerHTML = '<i class="fa fa-cogs"></i> '+title.textContent.trim();

                header.appendChild(label);
                group.appendChild(header);

                // Пункты меню
                const children = document.createElement('ul');
                children.className = 'rail-children';

                links.forEach(function (link) {

                    const li = document.createElement('li');
                    const a = document.createElement('a');

                    a.className = 'rail-link rail-child';
                    a.href = link.getAttribute('href');
                    a.textContent = link.textContent.trim();

                    // Подсветка текущего раздела
                    const currentUrl = new URL(window.location.href);
                    const linkUrl = new URL(a.href, window.location.href);

                    if (
                        currentUrl.searchParams.get('subpage') ===
                        linkUrl.searchParams.get('subpage')
                    ) {
                        a.classList.add('active');
                        a.setAttribute('aria-current', 'page');
                    }

                    li.appendChild(a);
                    children.appendChild(li);
                });

                group.appendChild(children);
                menu.appendChild(group);

                // Разделитель после меню
                const divider = document.createElement('li');
                divider.className = 'rail-divider';
                divider.setAttribute('role', 'separator');
                divider.setAttribute('aria-hidden', 'true');

                menu.appendChild(divider);

                // Вставляем ПЕРЕД штатным меню Iris
                target.before(menu);
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', init, { once: true });
            } else {
                init();
            }

        })();
        </script>
        HTML;
    });

    return $sidebar;
}