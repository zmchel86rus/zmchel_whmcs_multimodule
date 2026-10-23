# Structured data in output

## Schema.org

- **Page editor → Metadata settings → Schema type → Save.**

| Output | Schema.org markup |
| --- | --- |
| Navbar, sidebar and footer menus | `SiteNavigationElement` with real labels, language and URLs after access and override checks; groups use `hasPart`. JSON-LD does not depend on extra theme attributes. |
| Table of contents | `SiteNavigationElement` and `WebPageElement` with anchors found in actual headings; parent type follows page or post. |
| Questions and answers | `FAQPage` for nonempty visible Q&A; hidden blocks, helper text and ordinary accordions are excluded. Closed `details` remain clickable and are included. |
| Breadcrumbs | `BreadcrumbList` on client themes with at least two items. A single crumb stays visible without markup; no duplicate JSON-LD is emitted. |
| Organization and contact | Uses WHMCS data. Page language belongs on `WebPage`/`ContactPage`; supported languages use BCP47 in `ContactPoint.availableLanguage`. `Organization.inLanguage` is omitted. |
| Filters, fields, page-size selector, pagination and contact form | No automatic separate entity: these controls are not products, articles, search services or organization contact details. |
| Sections, Flex/Grid, spacing, buttons, ordinary accordions and carousels | No automatic content type is inferred from presentation. |
| Smarty and custom HTML | Existing author markup is preserved; arbitrary data cannot be classified reliably. |

`SiteNavigationElement` describes navigation but cannot guarantee search-result sitelinks. Google stopped displaying FAQ rich results in May 2026; valid `FAQPage` still describes real content without promising a rich snippet. Local filters do not get `SearchAction` markup. `inLanguage` is omitted from `Organization`, `Person`, `Product` and `Service` templates where the property does not apply. Language data is not invented.

References: [Google structured data policies](https://developers.google.com/search/docs/appearance/structured-data/sd-policies), [Schema.org SiteNavigationElement](https://schema.org/SiteNavigationElement), [Schema.org inLanguage](https://schema.org/inLanguage), [Google breadcrumbs](https://developers.google.com/search/docs/appearance/structured-data/breadcrumb).

With PHP DOM, local checks include `tests/schema_output.php`, `tests/contact_schema.php`, `tests/table_of_contents.php` and `tests/footer_menu.php`.

## JSON-LD

After publication, inspect the rendered JSON-LD alongside the visible page. Navigation and FAQ markup must describe links, headings, questions, and answers actually shown to the visitor. Valid markup does not guarantee a search enhancement.

## ContactPoint.availableLanguage

Contact languages come from WHMCS and appear in `ContactPoint.availableLanguage` as BCP 47 tags. The page language belongs on `WebPage` or `ContactPage`; do not add an invented `inLanguage` value to `Organization`.

## Instructions

- **Schema type** — When disabled, Schema.org JSON markup is not output for this page.
- **Breadcrumbs** — Page name in breadcrumbs
- **Canonical URL**
- **Page title**
- **Meta description**
- **Open Graph title** — If empty, the page title is used.
- **Open Graph description** — If empty, the meta description is used.
- **Open Graph image** — If empty, the page image is used.
