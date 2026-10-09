# Redirects and sitemap languages

- **Менеджер редиректов**: exact source address → destination → HTTP status (301, 302, 303, 307, 308), edit, disable, delete; 50 rules per admin page. Uses the shared `main.js` POST handler.
- Sources accept local paths from `/` or absolute same-site URLs. Destinations accept paths or HTTP(S) URLs. Trailing slashes are equivalent for matching; the destination retains its slash. Query-specific rules take precedence over rules for a whole path. A path rule also matches requests with query parameters; destination parameters replace source parameters.
- Rules run for GET/HEAD requests reaching WHMCS, before the page builder. They do not modify `.htaccess`, language sessions or profiles. Web-server redirects and the existing module language/canonical redirects retain their own handling.
- `ZM_PB_ENABLE_REDIRECTS_MANAGER` enables stored rules. Settings → **Настройки редиректов** also exposes `ZM_PB_AUTO_REDIRECTS` and `ZM_PB_AUTO_REDIRECT_DAYS` (default 14; 0 means no delay).
- Automatic 301 rules are created when changing a published page's slug while keeping it published. The age gate uses the latest existing page/active-translation created/updated timestamp, **before saving**. Publishing a draft does not create a redirect. Each available language address gets a rule. Subsequent renames update historical automatic destinations; returning to an old slug removes a self-redirect. Manual rules take precedence over automatic insertion.
- Override aliases always redirect to their native destination when page overrides are enabled, independently of the stored-rule switch. Matching native slugs do not redirect. If one layout replaces multiple pages, its own alias redirects to the first configured native page. Sitemap lists each native page separately. Renaming the layout updates `page_overrides.to` in the same transaction as the page and automatic rules.
- Storage uses the existing `zm_pb_redirects` schema. No request handler creates or repairs tables; use **База данных** if the table is missing. Existing columns allow 128 bytes per URL; longer input is rejected explicitly.
- Sitemap files (`sitemap_pages.xml`, `sitemap_posts.xml`) declare the XHTML namespace. Every URL contains a reciprocal set of language alternates and `x-default` for the unprefixed default address. Only active translations are advertised; a fallback translation is identified by its actual language. Stored redirect sources are excluded from both `loc` and alternates. Separate source pages sharing an override layout are separate language groups.
- Regenerate via **Карта сайта** to replace existing XML files, or wait for the configured cron schedule.

## Verification (PHP environment with project vendor dependencies)

```sh
php modules/addons/zmchel_whmcs_multimodule/tests/redirects.php
php modules/addons/zmchel_whmcs_multimodule/tests/redirects.php --plain
php modules/addons/zmchel_whmcs_multimodule/tests/redirects.php --routes-off
php modules/addons/zmchel_whmcs_multimodule/tests/redirects.php --disabled
php modules/addons/zmchel_whmcs_multimodule/tests/redirects.php --auto-off
php modules/addons/zmchel_whmcs_multimodule/tests/sitemap.php
php modules/addons/zmchel_whmcs_multimodule/tests/sitemap.php --plain
php modules/addons/zmchel_whmcs_multimodule/tests/sitemap.php --routes-off
php modules/addons/zmchel_whmcs_multimodule/tests/sitemap.php --overrides-off
php modules/addons/zmchel_whmcs_multimodule/tests/sitemap.php --disabled
```

Tests use SQLite in memory; sitemap tests create and clean their own temporary site root.
