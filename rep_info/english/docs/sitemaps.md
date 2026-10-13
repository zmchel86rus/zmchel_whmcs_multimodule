# Sitemap

The generator is in `lib/sitemap.php`, helpers in `inc/sitemap_manager.php`, and the `AfterCronJob` hook in `hooks/sitemap.php`. With `ZM_PB_ENABLE_SITEMAP` disabled, the hook is not registered and manual generation is unavailable too.

After cron, the hook compares the current time with `ZM_PB_SITEMAP_LASTUPD` and `ZM_PB_SITEMAP_UPDFREQ`. An empty or unknown frequency means daily. The last **successful** generation time is stored in `inc/editable_consts.php`. **Generate** in `sitemap_manager` runs immediately.

The site root receives `sitemap_index.xml`, `sitemap_pages.xml` and `sitemap_posts.xml`. Categories over 50,000 URLs or 50 MB are split into `_2`, `_3`, and further files. The index also includes other valid root `urlset` sitemaps, without nesting indexes. The module updates or removes only its own page/post files and updates the shared index; it leaves other files alone.

Only active, published, publicly accessible pages and posts with active language versions are included. Publication uses `page.status = publish`, language availability uses `lang_active`. The editor does not publish `lang_status`, so the generator does not test it. An override uses the original system page's public URL, skipping the override page's own slug. Default-language URLs have no language prefix; other languages follow the routing setting.

If only the index remains after an update, generate again from the manager. This generator does not create a combined `sitemap.xml`, and empty categories produce no file. It needs write access to the site root, module `resources/` and `inc/editable_consts.php`. If tables are missing, the manager links to `module_db`; the generator never creates or repairs tables. On failure, files are restored from temporary copies and the successful-generation timestamp stays unchanged.

An isolated test is `php -d extension=pdo_sqlite tests/sitemap.php`. It needs project dependencies and XML, mbstring and SQLite extensions, and uses a temporary root and in-memory SQLite.
