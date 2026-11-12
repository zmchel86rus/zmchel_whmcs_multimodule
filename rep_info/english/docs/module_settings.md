# Module settings

Start by enabling the languages you need. Choose the URL format and language routing options, then save. If routes changed, update the Apache rules in Rewrite Manager or the matching Nginx configuration. Open a module page in the default language and another enabled language to verify the result. Export a backup before major settings changes or an import.

Module settings control site-wide module behavior. Open the relevant tab, change the required values, save them, and test a page that uses that feature.

## Available tabs

- **Import / export:** back up selected module data to a ZIP archive or import a ZIP or JSON file. Read [Import and export](module_settings_transfer.md) before using import.
- **Editable constants:** configure the module's URL, routing, output, media, maintenance, Smarty, and other available switches. Read each field's description and check the public result after saving.
- **Supported languages:** enable the languages you need before creating pages. Keep the WHMCS default language enabled; change the default in WHMCS before disabling the old one.
- **Redirects:** configure stored redirects and automatic redirects for published page slug changes. Manage individual rules in [Redirect Manager](redirects_manager.md).
- **Sitemap:** enable generation and set its timing. Check the files and entries in [Sitemap Manager](sitemap_manager.md).
- **Header**, **Footer**, and **Robots:** edit module output in the site header or footer and the `robots.txt` content. Check the generated page or file after saving.

Settings that depend on web server routing need a matching configuration on the server. On Apache, use [Rewrite Manager](rewrite_manager.md) to apply the module rules. Nginx needs its own routing configuration.
