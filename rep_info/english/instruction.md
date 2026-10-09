# ZMChel WHMCS Multimodule: user instructions

**Before using the module, generate unique salts and put them in `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, and `ZM_PB_NONCE_SALT`.** The module was developed and tested on **WHMCS 8.13.1** and has **full Apache support (100%)**. It may also work with Nginx, but check language routing on the home page separately.

This guide is for staff who manage site content in WHMCS. Daily work with text, images and menus does not require programming. Export your settings before changing URLs, redirects, server rules or code, as those changes can affect published pages.

## 1. Finding your way around

Sign in to the WHMCS admin area with access to the add-on and open **Addons → ZMChel WHMCS Multimodule**. The tabs cover the page list, sitemap, media library, menu manager, rewrite rules, redirects, module database and module settings. The page list lets you create, find, edit and remove pages and configure replacements for WHMCS pages. In the module database tab, an administrator can check or repair missing tables.

A **slug** is the address part after the domain, such as `contact` in `/contact/`. A published page is visible to visitors; a draft is not. A **block** is one piece of page content. A **page override** displays builder content at an existing WHMCS address.

## 2. Creating and publishing a page

1. Open **Page list → Add page**. Enter an internal page name and a slug using Latin letters, digits and hyphens, for example `about-us`. Do not include a domain, language prefix, `?` or `.php`.
2. Select access: **Mixed** for everyone with optional guest/member zones, **Authorized** for signed-in users, or **Unauthorized** for guests.
3. Select a status: **Draft** while working, **Published** for visitors, **Deferred** to keep it unavailable, or **Trash** to remove it from normal work. Deferred is not a scheduled publication calendar.
4. Select **Page**, **Article**, or **System page**. A system page is not published as a regular user page and is not added to the sitemap. Select the supported languages; the site default is included.
5. Save, then open the page from the list. Fill the separate **Content**, **Meta data** and, for a published non-system page, **Sitemap** tabs for each language. Each part has its own Save button, with **Save all** at the bottom. Check the success message and any unsaved-change warning.

Search and filter the page list by name, access, type, status and language. **Visit** opens the public URL. **Delete** moves a page to trash first; permanent deletion happens from the trash view.

## 3. Using the block editor

Open **Content settings** and choose a language. Drag a GrapesJS block onto the canvas; drag nested blocks into a section, column or other container. Click a block to edit its options in **GrapesJS · Block settings**. The chevron collapses this panel and the browser remembers that choice. Edit ordinary text in place; use TinyMCE for rich text and the code editor in code-related blocks. Save the current language and use **Visit** to check the result.

Available blocks include text, headings, images, video, maps, links, buttons, quotes, lists, tables, FAQ, accordion, table of contents, pagination, filters, a contact form, progress, spacers, sections, Flex, Grid, `div`, cards, galleries, carousels, guest/member zones, CSS and JavaScript. Smarty blocks depend on module settings. Labels and availability can vary with language and configuration.

For two columns, add a **Section**, set its column layout to `2`, then put an **Image** in one column and **Text** in the other. Set tablet and mobile columns as needed. Use Flex or Grid for custom alignment or cell spans. Tables have rows, columns and optional headers/footers; carousels have slide, autoplay, loop, speed and responsive visible-slide settings. FAQ provides question markup, while Accordion is for ordinary collapsible content. Double-click an accordion item in the editor to open it without interfering with selection.

Choose an `H1`–`H6` level, size and weight for headings; usually keep one main `H1`. The table-of-contents block links to subsequent headings. Set spacers in pixels and meaningful image `alt` text. Use the GrapesJS component tree if selecting a parent container is difficult. Check which element is selected before deleting it: deleting a cell and deleting a whole section are different operations.

### Moving content between languages

Above the language editor, select a destination language and choose **Copy with content**, **Copy structure**, or **Clone**. Copy with content appends blocks and their text; Copy structure appends a layout to translate; Clone replaces the destination editor and asks for confirmation if it already has content. Open the destination tab, translate the text and save. A selected block can also be copied from its block settings.

## 4. Languages and links

Languages come from `supported_langs.php`. With language routing and pretty URLs, the default language has no prefix (`/contact/`), while others use `/ru/contact/`, `/de/contact/` and so on. Switching the page language should not alter a client's profile language.

For a **Link** or **Button** block, enter the URL and enable **Include the current page language in the URL** for translated site pages. `/contact/` then becomes `/ru/contact/` on the Russian page; an existing language prefix is replaced, and query strings and fragments remain. Save and check the link in two languages. The option is enabled for new blocks; older saved blocks keep their previous URL behavior until explicitly changed.

Turn the option off for external URLs, files, `mailto:`, `tel:`, fragment links and WHMCS routes without language versions such as `/login` or `/clientarea.php`. The URL option does not create a translation; publish the target language too. Links typed inside TinyMCE or Smarty have no separate block toggle, so inspect them manually.

## 5. SEO and sitemaps for a page

Open **Meta data settings**, select a language and enter its page **Title** and **Meta description**. Optionally set breadcrumbs and Open Graph/Twitter images and text; empty optional social fields can fall back to main metadata. Review the canonical URL, robots setting and Schema type: `WebPage` for a regular page, an article type for an article, and `ContactPage` for contact pages. Do not set `Organization` as the primary page type merely because the site belongs to an organization. Save each language.

For a published non-system page, set sitemap frequency and priority in the **Sitemap settings** tab. After publication, check the HTML title, description, language links and a meaningful `H1`. An override uses the replaced page's public URL in the sitemap, not its internal builder slug.

## 6. Replacing an existing WHMCS page

Create, complete and publish a builder page. In **Page list → Page overrides**, click **Add override**, select the WHMCS page and the builder page, choose the type and save. **Full** replaces content and metadata; **Before** or **After** inserts blocks around native content; **Meta only** changes metadata; combined types insert blocks and replace metadata. The same system page cannot be assigned twice.

Open the original **public WHMCS URL** to test the result. The builder slug redirects to that public URL when they differ. Test as a guest and a logged-in client because access settings affect output. For selective restrictions, use Mixed access with guest/member content zones.

## 7. Images and the media library

Open **Media Manager → Upload media**, choose a file and give images descriptive **Alt** text. Name, title and description help with searching and captions. Upload, then find the item using search and type filters or **Load more**. In an Image block, click **Choose image**, select the media item and save the page.

The manager produces several image sizes. **Optimize image** is available for uploaded images and can be run again even if a previous optimization is marked. Inspect quality afterward, especially text on banners. Disable `srcset` on an individual Image block if its responsive variants do not suit that image. Do not use a placeholder `data:image/svg+xml…` as the real image URL.

## 8. Site menus

In **Menu Manager**, create a menu and enter its name. Add pages or articles from the left, or use a **Custom link** for an external URL, system page or column heading. Drag items into order and nested levels. Edit each item's text, language labels, target tab, visibility, CSS classes and other attributes. For custom links, choose whether to add the current page language to the URL; leave `/clientarea.php` and routes without language variants unchanged.

Enable the menu, choose whether it **adds to** or **replaces** native WHMCS navigation, and set desktop/mobile visibility. Assign a main or secondary navbar/sidebar or the footer; only one menu can occupy a location. Save and check desktop and mobile views. In the footer, top-level items become columns and nested items become links; use `#` for a heading without navigation. Enable the corresponding output area in module settings. If menu tables are missing, repair them in **Module database**. See [menu details](../../docs/menus.md).

## 9. Contact form

Drag a **Contact form** into the content editor. Set heading, description, subject and button text. Choose **WHMCS ticket** with a support department or **Email** with a recipient address in the block. Add fields and set each name, type, required flag and validation. Guest tickets need sender name and email roles. For dropdowns, enter one option per line as `value : Label`, for example `sales : Sales team`; the stored value and visible label differ.

Add separate **Consent** fields for separate agreements. Each has its own text and required flag; safe links such as `<a href="/privacy/">privacy policy</a>` can be used. Arrange width, new rows and order, or choose Flex/Grid layout. Enable CAPTCHA if needed; it uses the WHMCS CAPTCHA type and keys. For email, choose a system message without a WHMCS template or standard styling. Save and submit a test as a visitor; verify delivery, errors and form reset. If PHP `mail()` does not work, configure working SMTP in WHMCS. A green editor status alone does not confirm delivery.

## 10. Lists, filters and pagination

Connect a **Pagination** block to the specific list block it controls, such as a Smarty list. Set its data source, default count, visible button count, `/page/N/` or `?page=N` URL mode, optional 10/25/50/100/250 count selector and indexing behavior for later pages. The selector can sit beside pagination or elsewhere. Server-side count is limited to 10–250. Add **Filters** for text, range or date search; there is no separate Search block. Connect filters to the same list. Save and check page 2 for changed results and clean URLs. See [pagination details](../../docs/pagination.md).

## 11. Smarty, CSS and JavaScript

Enable **Use Smarty variables** before adding a Smarty block. Select the block, open its code editor, choose a collected variable and save. Availability depends on the page and when other modules create variables. Only the permitted template syntax is accepted; PHP, SQL and direct database access are forbidden. A simple output is `{$pageTitle|escape}`. Check arrays and collections as guest and client, and never print a whole object containing personal data. See [Smarty details](../../docs/smarty.md).

**Custom CSS** and **Custom JS** blocks belong to the page; check them on mobile and in other languages. Site-wide header/footer code is in module settings and should be edited by staff familiar with HTML, CSS and JavaScript.

## 12. Sitemap, redirects and rewrite rules

Enable sitemap generation and set its frequency in **Module settings**. In **Sitemap**, inspect the last run and planned URLs, click **Generate sitemaps**, then open `sitemap_index.xml` and its child files. Automatic generation follows WHMCS cron. The index can include other root sitemap files. Overrides use their public URLs, and unpublished language variants should be absent. See [sitemap details](../../docs/sitemaps.md).

In **Redirect Manager**, enter a source such as `/old-page/` and destination such as `/new-page/`. Choose `301` for a permanent move or `302` for a temporary one, keep it active, save and test the old URL. Automatic redirects after slug changes have their own enable switch and minimum page-age setting. See [redirect details](../../docs/redirects.md).

In **Rewrite Manager**, click **Check rules** and then **Add or update rules** to write `.htaccess`. For a custom rule, enter URL pattern, destination and flags, then apply rules again. Apache reads `.htaccess`; Nginx requires equivalent server configuration. Incorrect rules can affect the whole site.

## 13. Settings, import and maintenance

**Module settings** include pretty URLs, language routing, overrides, menu areas, maintenance mode, Smarty, redirect behavior, sitemap timing, header/footer code, `robots.txt`, and import/export. Export before major changes: choose all or selected sections and download the JSON file. It can include pages and translations, menus, settings, redirects, rewrite rules and media; it does not replace a full WHMCS backup or include accounts, secrets, page revisions or theme files. See [transfer details](../../docs/transfer.md).

To import, choose a JSON file and sections, click **Import** and confirm. Matching existing records can be updated. Check pages, menus and media afterward; apply imported rewrite rules separately and regenerate the sitemap. The **Module database** tab checks required tables and columns and can repair missing ones. Maintenance mode closes public module pages to regular visitors while an administrator continues working; test it in a signed-out browser window.

For the first setup, activate the add-on and grant access, check the module database, review pretty URLs, language routes, overrides and menu areas, apply Apache rewrite rules or configure Nginx routes, confirm WHMCS cron runs, and make sure PHP can write sitemap and media files. Publish a test page in the default and another language, then check menus, overrides and redirects. Enable Smarty collection only for staff who need it.

## 14. Final checks and common problems

Before handing over a page, confirm **Published** status, saved content and metadata for each enabled language. Open the public URL as a visitor and on a narrow screen. Check title, images, `alt`, buttons, links and forms. Test two language versions; for overrides, test the system URL. Check desktop/mobile menus and an old URL after slug changes. Regenerate `sitemap_index.xml` after publication or override changes.

If a page returns 404, check publication, slug, translation, pretty URLs and rewrite rules. For missing language content, check that language's content and SEO; copying structure does not translate text. For `/ru/login`, turn off language handling on the link. For a missing menu, check enablement, location, module output area and desktop/mobile mode. For missing images, select a real media file. For undelivered forms, check recipient and WHMCS mail/SMTP. For failed menu saves, check required fields and database tables. For stale sitemaps, check settings, cron and write access. For rewrite changes, apply the rules after saving and configure Nginx separately.

When reporting a problem, include the public URL, page name/number, language, action, expected and actual result, and exact error text. Do not send secrets or passwords.

### More documentation

- [Menus](../../docs/menus.md)
- [Smarty and collected variables](../../docs/smarty.md)
- [Pagination and filters](../../docs/pagination.md)
- [Sitemaps](../../docs/sitemaps.md)
- [Redirects](../../docs/redirects.md)
- [Schema.org structured data](../../docs/structured-data.md)
- [Import and export](../../docs/transfer.md)
