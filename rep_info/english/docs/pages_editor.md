# Page Editor

Page Editor opens after a page has been created in [Page Manager](pages_manager.md). It has separate tabs for **Main settings**, **Content settings**, **Meta data settings**, and **Sitemap settings**. Select a supported language before editing translated content. Each tab has its own save action; **Save all** saves the page's sections together. Check the result on the public page after saving.

## Main settings

Review the page name, slug, type, status, access mode, and enabled languages. A published page still needs content in the language you expect to serve. If the WHMCS default language is unsupported, enable it in **Module settings → Supported languages** before saving pages.

## Content settings

Choose a language, drag GrapesJS blocks onto the canvas, and select a block to edit its settings. Text can be edited in place; rich text uses TinyMCE. Use sections, columns, Flex, or Grid for layout. The language tools can copy content, copy structure, or clone the editor into another language; translate the destination after copying. Save the language and use **Visit** to inspect the result.

Some blocks need extra setup:

- [Pagination and filters](pages_editor_pagination.md) connect to a list block and determine how its results change between pages.
- [Smarty block and variable catalog](pages_editor_smarty.md) require the corresponding module setting and only expose permitted template syntax.
- [Structured data in output](module_structured_data.md) explains the markup produced by page content and other module components.

## Meta data and sitemap

In **Meta data settings**, enter a title and description for each language. Review canonical, robots, social metadata, breadcrumbs, and the page's Schema type as needed. Save each language. In **Sitemap settings**, set change frequency and priority for a published, non-system page. [Sitemap Manager](sitemap_manager.md) shows the resulting URLs and generates the XML files.

## Contact Form

Add a **Contact Form** block. Choose a **WHMCS ticket** and support department, or an **email** and recipient; set the heading, description, subject, and button text. Give each field a name, type, required setting, and validation. Guest tickets need fields assigned the sender name and email roles. Put one dropdown option per line, such as `sales : Sales`. Add separate fields for separate consents, arrange their widths and line breaks, and use the CAPTCHA configured in WHMCS. Save the form and submit a real test as a guest: check the ticket or email delivery, errors, and form reset. A green editor status does not confirm delivery; configure WHMCS SMTP if PHP `mail()` fails.

## Instructions

- Nested flex layout container. Drag other blocks inside.
- Nested CSS Grid container. Drag other blocks inside.
- Nested Bootstrap carousel. Drag blocks inside; each becomes a slide.
- All blocks below this block are shown only to signed-in users. Works only when the page access type is Mixed.
- All blocks below this block are shown only to guests. Works only when the page access type is Mixed.
- **Page title**
- **Meta description**
- **Canonical URL**
- **Robots** — index, follow / noindex, nofollow. Controls indexing.
- **Schema type** — When disabled, Schema.org JSON markup is not output for this page.
