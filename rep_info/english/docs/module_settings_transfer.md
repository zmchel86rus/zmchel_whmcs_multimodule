# Import and export

## ZIP archive

Open **Module settings → Import / export**. Exports are ZIP archives (`zmchel_whmcs_multimodule`) with `manifest.json` and separate generated CSS/JS files. The archive can contain selected sections or all of them. JSON files are also supported for import.

- **Pages and posts:** settings, all translations, GrapesJS content, SEO and sitemap settings. Generated CSS/JS files are stored separately in the archive and recreated under new page IDs on import.
- **Menus:** hierarchy, label translations, locations and settings. Page IDs are matched by `slug + auth_type`; menus by name. Duplicate names on the target must be resolved first.
- **Settings:** editable constants, module settings, overrides, header/footer and `robots.txt`. System URL mode and last sitemap generation time remain local.
- **Redirects:** manual rules and links from automatic rules to pages.
- **Rewrite rules:** custom rules; apply them afterward with the rewrite manager's normal button.
- **Media:** registered media files, variants, descriptions and attributes, excluding unrelated WHMCS attachments. Name conflicts with unrelated files get new names, and imported references are updated.

Import updates matches, adds new records and leaves unrelated records intact. Missing selected sections are skipped. When moving only menus or automatic redirects to a new site, import the corresponding pages first or in the same operation. Source-site URLs are replaced with the target SystemURL; external URLs stay unchanged. Select media together with pages to move their images.

ZIP files are limited to 128 MiB; JSON imports are limited to 32 MiB. Consider PHP `upload_max_filesize` and `post_max_size`; the PHP ZIP extension is required. The manifest still has a 32 MiB limit, so large media libraries may need to be exported separately. If a generated CSS/JS file is missing, export skips it and shows a warning; resave the page before exporting again if needed. Revisions, collected Smarty variables, WHMCS accounts/secrets and theme files are excluded. Import uses existing tables; only activation and **Module database** perform schema changes.

Forms use the shared `main.js` POST handler, module nonces and settings access checks. Before import, the UI confirms record updates. Database changes use a transaction, and overwritten files are restored on exception. Editable constants are imported as a complete selected set: if one cannot be written, the operation fails. A file lock protects the import. On success, the import tab reloads to show current settings. Regenerate the sitemap separately.

To test in the project's PHP environment, run `php modules/addons/zmchel_whmcs_multimodule/tests/transfer.php`. It uses temporary directories and SQLite without the production database.
