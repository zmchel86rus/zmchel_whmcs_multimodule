# Maelekezo ya zmchel WHMCS Multimodule

**Kabla ya kutumia moduli, tengeneza thamani za salt za kipekee ndani ya `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` na `ZM_PB_NONCE_SALT`.** Moduli ilitengenezwa na kupimwa kwenye **WHMCS 8.13.1–8.13.7**. Uoanifu wa **PHP 7.4–8.5** umekaguliwa. Apache inaungwa mkono kikamilifu (100%); Nginx inaweza kuhitaji usanidi wa ziada kwa uelekezaji wa lugha kwenye ukurasa wa mwanzo.

**Kabla ya matumizi ya kwanza, fungua Mipangilio ya moduli → Lugha zinazoungwa mkono na uwashe lugha unazohitaji.**

**zmchel WHMCS Multimodule ni ya bure.** Kutoka eneo la usimamizi la WHMCS, simamia kurasa za lugha nyingi kwa kihariri cha picha, menyu, maktaba ya media, taarifa za SEO, ramani za tovuti za XML, uelekezaji upya, sheria za rewrite, kuingiza na kuhamisha data.

## Mipangilio ya moduli

Chagua lugha ambazo moduli inaweza kutumia. Kuzima lugha hakufuti maudhui yake.

- **Mipangilio ya moduli → Lugha zinazotumika → Washa**
- **Hifadhidata ya moduli → Rekebisha Vipengee vilivyochaguliwa**
- **Kanuni za kuandika upya → Kagua kanuni → Ongeza au sasisha kanuni**

Nginx haisomi .htaccess, hivyo kanuni hizi hazifanyi kazi humo. Sanidi kanuni zinazolingana katika nginx.

## Kidhibiti cha Kurasa

- **Ongeza ukurasa → Jina la ukurasa → Slug ya ukurasa → Hifadhi**
- **Kihariri cha kurasa → Mipangilio ya maudhui → Mipangilio ya metadata → Mipangilio ya ramani ya tovuti ya ukurasa → Hifadhi zote**
- **Kidhibiti cha Kurasa → Tembelea**
- **Ramani ya tovuti → Tengeneza ramani za tovuti**

Herufi za Kilatini, vistari na tarakimu pekee zinaruhusiwa.

Watumiaji walioingia: watumiaji walioingia pekee wanaweza kufikia ukurasa; Wageni: wageni pekee wanaweza kuufikia; Mchanganyiko: kila mtu anaweza kuufikia, na mwonekano hudhibitiwa na vitalu vilivyo ndani ya ukurasa.

Utengenezaji wa kiotomatiki huendeshwa baada ya cron ya WHMCS wakati sasisho linapohitajika. Utengenezaji wa mikono huanza mara moja.

## Miongozo kwa kila sehemu

- [Kidhibiti cha Kurasa](docs/pages_manager.md)
- [Kihariri cha kurasa](docs/pages_editor.md)
- [Kidhibiti cha Midia](docs/media_manager.md)
- [menyu](docs/menu_manager.md)
- [Meneja wa lugha](docs/langs_manager.md)
- [uelekezaji upya](docs/redirects_manager.md)
- [ramani ya tovuti](docs/sitemap_manager.md)
- [Kanuni za kuandika upya](docs/rewrite_manager.md)
- [Mipangilio ya moduli](docs/module_settings.md)
- [Hifadhidata ya moduli](docs/module_db.md)

## Nyenzo za ziada

- [ugawaji wa kurasa](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [data yenye muundo](docs/module_structured_data.md)
- [uhamishaji wa data](docs/module_settings_transfer.md)
