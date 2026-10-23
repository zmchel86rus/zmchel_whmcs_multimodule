# Page Manager

The Page Manager lists the pages created by the module. Use it to create a page, find an existing one, change its status, or assign builder content to a WHMCS page. The page content and metadata are edited separately in [Page Editor](pages_editor.md).

## Create a page

Open **Add page**. Enter an internal name and a slug such as `about-us`, without a domain or language prefix. Choose the access mode (**Mixed**, **Signed-in users only**, or **Guests only**) and page type (**Page**, **Article**, or **System page**). Select the languages you need; the WHMCS default language must be enabled in **Module settings → Supported languages**. Save the page, then open it in Page Editor to add content and metadata. A draft is not public; publish it when it is ready.

## Find, visit, and remove pages

Use the list filters to search by name, access, type, status, and language. **Visit** opens the public page URL. **Delete** first moves a page to Trash. Open the Trash view to delete it permanently. Check the page's status and language before investigating a missing public URL.

## Page overrides

In **Page overrides**, select an existing WHMCS page and the published builder page that should supply its content. The override type controls whether builder content replaces native content, appears before or after it, changes metadata only, or combines these effects. Save, then visit the original WHMCS URL as a guest and as a signed-in client. The builder slug can redirect to the original URL when they differ.

## Instructions

- Add page
- **Page name** — Internal page name
- **Page slug** — Only Latin letters, hyphens and digits are allowed.
- **Access type** — Signed-in users: only signed-in users can access the page; Guests: only guests can access it; Mixed: everyone can access it, with visibility controlled by blocks inside the page.
- **Page type** — System pages are excluded from the sitemap and are not available to regular users.
- **Page languages** — The default language is always included regardless of your selection.
- Full override replaces the displayed content and metadata. Add before places content before the existing page content. Add after places content after the existing page content. Metadata/SEO only replaces the page metadata.
- Page list navigation
