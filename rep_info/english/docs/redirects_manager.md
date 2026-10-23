# Redirects and sitemap languages

## HTTP

**Redirect Manager** creates exact source → destination rules with HTTP 301, 302, 303, 307 or 308. Rules can be edited, disabled and deleted; the admin list shows 50 per page.

Sources accept paths beginning with `/` or absolute URLs on the same site. Destinations accept paths or HTTP(S) URLs. Trailing slashes are equivalent for matching, while the destination keeps its own slash. A query-specific rule takes precedence over a path rule; a path rule also matches requests with query parameters. Destination parameters replace source parameters.

Rules handle GET/HEAD requests reaching WHMCS before the page builder. They do not change `.htaccess`, the language session or the profile. Server redirects and existing module language/canonical redirects keep their own behavior. `ZM_PB_ENABLE_REDIRECTS_MANAGER` enables stored rules. Module settings also provide `ZM_PB_AUTO_REDIRECTS` and `ZM_PB_AUTO_REDIRECT_DAYS` (14 by default; 0 removes the delay).

An automatic 301 is created when the slug of a published page changes while the page remains published. Age is checked against the latest existing page or active translation timestamp before saving. Publishing a draft creates no redirect. Every available language URL gets a rule. Later renames update historical destinations; returning to an old slug removes a self-redirect. Manual rules take precedence over automatic insertion.

When page overrides are enabled, an override alias redirects to its native destination even if stored redirects are disabled. A native slug matching itself does not redirect. If one layout replaces several pages, its alias points to the first configured native page; the sitemap lists each native page separately. Renaming the layout updates `page_overrides.to` in the same transaction as the page and automatic rules.

Rules use `zm_pb_redirects`. A request never creates or repairs the table: use **Module database** if it is missing. Existing URL columns hold 128 bytes; longer input is rejected.

`sitemap_pages.xml` and `sitemap_posts.xml` declare the XHTML namespace. Each URL lists reciprocal language alternates and `x-default` for the configured default-language address. Only active translations appear; a fallback uses its actual language. Redirect sources are excluded from `loc` and alternates. Pages sharing an override layout remain separate language groups. Regenerate XML in **Sitemap** or wait for the configured cron schedule.

For isolated checks with project dependencies, run `tests/redirects.php` with optional `--plain`, `--routes-off`, `--disabled` or `--auto-off`, and `tests/sitemap.php` with optional `--plain`, `--routes-off`, `--overrides-off` or `--disabled`. Tests use SQLite in memory; sitemap tests create a temporary site root.

## Instructions

- Exact addresses: source → destination. The source is a path from the site root or a URL on this site. The destination is a path or full HTTP(S) URL. A rule without query parameters also matches requests with them; the destination is used as entered. Rules apply to GET/HEAD requests that reach WHMCS.
- Source
- Destination
- Enabled
- Disabled
- Default: 14 days. Counted from the last change to the published page or its active translations; if never changed, from creation. Set 0 for no delay. Automatic rules use HTTP 301.
- Override page addresses automatically redirect to the system pages they replace. If an override has several destinations, the first configured one is used. These redirects work whenever overrides are enabled, independently of Redirect Manager rules.
- Enter a valid path beginning with / or a full HTTP(S) URL. The source must belong to this site; # fragments are not supported.
