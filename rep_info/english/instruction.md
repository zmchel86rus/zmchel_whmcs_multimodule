# ZMChel WHMCS Multimodule: user instructions

**Before using the module, generate unique salts and put them in `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, and `ZM_PB_NONCE_SALT`.** The module was developed and tested on **WHMCS 8.13.1–8.13.7** and has **full Apache support (100%)**. It may also work with Nginx, but language routing on the home page can require extra configuration and testing.

**Before first use, open Module settings → Supported languages and enable the languages you need.**

**PHP compatibility checked:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, and 8.5. All PHP files passed syntax checks on each version; standalone tests were also run.

**ZMChel WHMCS Multimodule is free.** It lets you manage site content from the WHMCS admin area. Its tools include a visual page and block editor, multilingual content, menus, a media library, SEO metadata, XML sitemaps, redirects, rewrite rules, and import/export.

## Module settings

Choose which languages the module can use. Disabling a language does not delete its content.

- **Module settings → Supported languages → Enable**
- **Module database → Fix Selected items**
- **Rewrite rules → Check rules → Add or update rules**

Nginx does not read .htaccess, so these rules do not work there. Configure equivalent rules in nginx.

## Page Manager

- **Add page → Page name → Page slug → Save**
- **Page editor → Content settings → Metadata settings → Page sitemap settings → Save all**
- **Page Manager → Visit**
- **Sitemap → Generate sitemaps**

Only Latin letters, hyphens and digits are allowed.

Signed-in users: only signed-in users can access the page; Guests: only guests can access it; Mixed: everyone can access it, with visibility controlled by blocks inside the page.

Automatic generation runs after WHMCS cron when an update is due. Manual generation starts immediately.

## Section guides

- [Page Manager](docs/pages_manager.md)
- [Page Editor](docs/pages_editor.md)
- [Media Manager](docs/media_manager.md)
- [Menus](docs/menu_manager.md)
- [Language Manager](docs/langs_manager.md)
- [Redirects](docs/redirects_manager.md)
- [Sitemaps](docs/sitemap_manager.md)
- [Rewrite Manager](docs/rewrite_manager.md)
- [Module settings](docs/module_settings.md)
- [Module database](docs/module_db.md)

## More documentation

- [Pagination and filters](docs/pages_editor_pagination.md)
- [Smarty and collected variables](docs/pages_editor_smarty.md)
- [Schema.org structured data](docs/module_structured_data.md)
- [Import and export](docs/module_settings_transfer.md)
