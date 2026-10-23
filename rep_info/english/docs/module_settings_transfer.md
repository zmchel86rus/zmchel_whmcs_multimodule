# Import and export

## JSON

Open **Module settings → Import / export**. A single JSON file (`zmchel_whmcs_multimodule`, format version 1) can contain selected sections or all of them:

- **Pages and posts:** settings, all translations, GrapesJS content, SEO and sitemap settings. Generated CSS/JS is exported as source and recreated under new page IDs on import.
- **Menus:** hierarchy, label translations, locations and settings. Page IDs are matched by `slug + auth_type`; menus by name. Duplicate names on the target must be resolved first.
- **Settings:** editable constants, module settings, overrides, header/footer and `robots.txt`. System URL mode and last sitemap generation time remain local.
- **Redirects:** manual rules and links from automatic rules to pages.
- **Rewrite rules:** custom rules; apply them afterward with the rewrite manager's normal button.
- **Media:** registered media files, variants, descriptions and attributes, excluding unrelated WHMCS attachments. Name conflicts with unrelated files get new names, and imported references are updated.

Import updates matches, adds new records and leaves unrelated records intact. Missing selected sections are skipped. When moving only menus or automatic redirects to a new site, import the corresponding pages first or in the same operation. Source-site URLs are replaced with the target SystemURL; external URLs stay unchanged. Select media together with pages to move their images.

JSON is limited to 32 MiB; PHP `upload_max_filesize` and `post_max_size` also apply. Large exports may need a higher PHP memory limit. Revisions, collected Smarty variables, WHMCS accounts/secrets and theme files are excluded. Import uses existing tables; only activation and **Module database** perform schema changes.

Forms use the shared `main.js` POST handler, module nonces and settings access checks. Before import, the UI confirms record updates. Database changes use a transaction, and overwritten files are restored on exception. Editable constants are imported as a complete selected set: if one cannot be written, the operation fails. A file lock protects the import. On success, the import tab reloads to show current settings. Regenerate the sitemap separately.

To test in the project's PHP environment, run `php modules/addons/zmchel_whmcs_multimodule/tests/transfer.php`. It uses temporary directories and SQLite without the production database.

## Instructions

- One JSON file for all or selected sections, up to 32 MiB (PHP upload limits also apply). Matching pages are updated by slug and access type, menus by name. Other records remain intact. Include pages when importing menus to a new site. Selected sections missing from the file are skipped.
- CSS/JS are included with pages; images and other uploaded files with the media library. Revision history, collected Smarty variables and WHMCS secrets are not exported. Regenerate the sitemap after import; apply rewrite rules in Rewrite Manager.
- Pages and posts (translations, content, SEO, sitemap settings, CSS/JS blocks)
- Menus and locations
- Module settings, overrides, head/footer, robots.txt
- Redirects
- Custom rewrite rules
- Media library (files and descriptions)
- Matching records in the selected sections will be updated from the file. Continue?
