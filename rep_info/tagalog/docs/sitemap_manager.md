# Sitemap

## XML

Inililista ng XML ang magkakatumbas na alternate URL para sa aktibong wika at x-default para sa default na address. Hindi kasama sa loc at alternates ang mga source ng redirect; ipinapakita ng fallback content ang tunay nitong wika. Nasa mga file ng pahina at artikulo ang XHTML namespace upang maisulat ang mga link sa bawat URL.

Nasa lib/sitemap.php ang generator, inc/sitemap_manager.php ang helpers, at hooks/sitemap.php ang AfterCronJob hook. Kapag nakapatay ang ZM_PB_ENABLE_SITEMAP, hindi available ang hook at manual generation. Pagkatapos ng cron, inihahambing ang oras sa ZM_PB_SITEMAP_LASTUPD at ZM_PB_SITEMAP_UPDFREQ. Kapag walang kilalang dalas, araw-araw ang gamit. Agad na tumatakbo ang **Generate**. Oras lamang ng huling matagumpay na pagbuo ang iniimbak.

Lumilikha sa site root ng sitemap_index.xml, sitemap_pages.xml, at sitemap_posts.xml. Ang kategoryang lampas sa 50,000 URL o 50 MB ay hinahati sa dagdag na file. Isinasama ng index ang ibang wastong root urlset, ngunit hindi ang ibang index. Sariling file lamang ng pahina at artikulo ang ina-update o inaalis ng module. Walang file para sa walang-lamang kategorya.

Tanging aktibo, published, pampublikong pahina at artikulong may lang_active ang isinasama. Ang override ng WHMCS page ay gumagamit ng orihinal na system URL, hindi ng slug ng builder layout. Umaayon din dito ang opsyonal na default-language prefix. Kailangan ang write access sa site root, resources/, at inc/editable_consts.php. Ayusin ang nawawalang table sa Module database. Kapag pumalya ang generation, ibinabalik ang lumang file at hindi binabago ang oras ng huling tagumpay.
