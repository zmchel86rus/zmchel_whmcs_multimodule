# Module settings

Module settings control site-wide module behavior. Open the relevant tab, change the required values, save them, and test a page that uses that feature.

## Available tabs

- **Import / export:** back up selected module data to JSON or import it. Read [Import and export](module_settings_transfer.md) before using import.
- **Editable constants:** configure the module's URL, routing, output, media, maintenance, Smarty, and other available switches. Read each field's description and check the public result after saving.
- **Supported languages:** enable the languages you need before creating pages. Keep the WHMCS default language enabled; change the default in WHMCS before disabling the old one.
- **Redirects:** configure stored redirects and automatic redirects for published page slug changes. Manage individual rules in [Redirect Manager](redirects_manager.md).
- **Sitemap:** enable generation and set its timing. Check the files and entries in [Sitemap Manager](sitemap_manager.md).
- **Header**, **Footer**, and **Robots:** edit module output in the site header or footer and the `robots.txt` content. Check the generated page or file after saving.

Settings that depend on web server routing need a matching configuration on the server. On Apache, use [Rewrite Manager](rewrite_manager.md) to apply the module rules. Nginx needs its own routing configuration.

## Instructions

- Choose which languages the module can use. Disabling a language does not delete its content.
- If you use pretty URLs on Apache, update the rules in Rewrite Manager after changing languages.
- **Pretty URLs** — Enable pretty URLs, including system URLs.
- **Language routing** — Enable or disable language routes. When enabled, pages are available under /de/, /en/, /es/ and other supported language prefixes. When disabled, one page URL shows content in the user's configured language.
- **Route for default language** — Give the default language its own URL prefix and redirect unprefixed module pages to it.
- **Maintenance mode (module)** — Enable or disable module maintenance mode. This softer mode lets WHMCS hooks and other components run, unlike system maintenance mode.
- **Collect Smarty variables** — Enable or disable collecting Smarty variables.
- **Use collected Smarty variables** — Enable or disable using collected Smarty variables in the page editor.
- **Page overrides** — Enable or disable page overrides.
- **Update frequency** — If nothing is selected, the sitemap is updated daily.
- **HTML sitemap** — When enabled, /html-sitemap shows the sitemap as a normal HTML page; sitemap.xml is unaffected.
- **Site header** — Custom HTML for the <head> section, including <script> and <style>.
- **Site footer** — Custom HTML before </body>, including <script> and <style>.
- **Edit robots.txt**
