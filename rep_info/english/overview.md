# Free multimodule for WHMCS

**Before using the module, generate unique salts and put them in `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, and `ZM_PB_NONCE_SALT`.** The module was developed and tested on **WHMCS 8.13.1** and has **full Apache support (100%)**. It may also work with Nginx, but language routing on the home page can require extra configuration and testing.

**ZMChel WHMCS Multimodule is free.** It lets you manage site content from the WHMCS admin area. Its tools include a visual page and block editor, multilingual content, menus, a media library, SEO metadata, XML sitemaps, redirects, rewrite rules, and import/export. See the [instructions](instruction.md) for everyday use.

## Future development

- Add nested pages and page categories or sections.
- Split the current monolith into interacting components.
- Add an admin access rights manager for the module.
- Expand the default language list in `supported_langs.php`.
- Add an admin code editor to create, edit, and delete module `.tpl` files and edit CMS client theme files (excluding the admin theme).
- Add a language manager for editing language files of this module, other modules, and the CMS itself.
- Improve the media manager.
- Build a full, more optimized SEO manager inspired by Yoast SEO for WordPress.
- Add multilingual sitemap generation and an HTML sitemap page.
- Add usage statistics to the page manager.

These are **ideas for the future, not a fixed roadmap**.

## Suggest an idea

[Email your suggestion](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) with the subject “Предложение по мультимодулю”.
