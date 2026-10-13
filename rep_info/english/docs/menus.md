# Menu manager

The `menu_manager` section supports several independent menus, page and post search, custom links and heading items with `#` URLs. Items can be dragged, nested, reordered and assigned a parent. Each item has a label and translations, a title, description, CSS classes, `rel`, icon, new-tab option and guest/client visibility. New published pages can be added automatically. A menu can extend or replace WHMCS navigation on desktop, mobile or both.

Deleting a parent in the editor moves its children to the deleted item's level. A menu supports up to 10 nested levels and 300 items. Saving the menu and its tree uses one transaction.

## Locations and switches

| WHMCS location | Module switch |
| --- | --- |
| `ClientAreaPrimaryNavbar` | `ZM_PB_ENABLE_MAINNAV` |
| `ClientAreaSecondaryNavbar` | `ZM_PB_ENABLE_SECONDARYNAV` |
| `ClientAreaPrimarySidebar` | `ZM_PB_ENABLE_MAINSIDEBAR` |
| `ClientAreaSecondarySidebar` | `ZM_PB_ENABLE_SECONDARYSIDEBAR` |

The switches are in module settings. When a location is disabled, its handler is not loaded and does not query the database. With no active assignment, the native WHMCS menu is unchanged. One menu can occupy each location; the same menu may occupy several locations. Assigning an occupied location transfers it to the new menu.

Desktop starts at 768 px; mobile ends at 767 px. If replacement is enabled for only one size, the native menu remains for the other. Standard WHMCS templates show one submenu level; module assets add deeper navbar levels. Sidebars use expandable nested lists. A parent link remains clickable and has a separate expand button.

## Languages and access

On WHMCS system routes outside `ZM_PB_MAINSYSTEM_DEFAULT_PAGES`, such as `clientarea.php` and `password/reset`, the saved user language controls labels and menus. A missing URL prefix does not reset that choice. Viewing a page does not change the profile or session. Module pages and overridable pages use the URL language.

For a custom link, **Link URL language** can leave the supplied URL unchanged, for example `/clientarea.php`; its label can still be translated. By default the URL is localized. This option is stored in `zm_pb_menu_items.localize_url` and included in menu exports. On an existing installation, add the column through **Module database**; the menu manager does not change the schema itself.

Page items store the default-language link. At output time the URL is recalculated from the current slug, pretty URL settings, language routing and published translations. The default language has no prefix. Plain URLs use `index.php?m=zmchel_whmcs_multimodule&slug=...&lang=...` without changing the profile language. If a translation is missing, the published default translation is used.

An empty page-item label uses its translated breadcrumb or meta title, then the page name. An explicit label overrides it; a translated label takes precedence when available. External URLs, `mailto:`, `tel:`, anchors and system assets receive no language prefix.

Draft, deleted and access-restricted pages are omitted. Hiding a parent hides its branch. Unsafe URL schemes and HTML in labels are rejected by the server.

## Tables and code

- `zm_pb_menus`: menu settings, including device modes.
- `zm_pb_menu_items`: items and hierarchy.
- `zm_pb_menu_locations`: location assignments.

`inc/menu_schema.php` defines the schema used during activation and by `inc/module/db.php`. Creation, column repair and removal happen in **Module database**. If tables are missing, the menu manager links there; it only manages records. Deactivation removes tables only if `db_action` is enabled.

Output is handled by `lib/menu.php`, helpers by `inc/menu_manager.php`, and hooks by `hooks/menu.php`. To check behavior in a WHMCS installation with PDO SQLite, run `php modules/addons/zmchel_whmcs_multimodule/tests/menu.php`, then repeat with `--plain`.
