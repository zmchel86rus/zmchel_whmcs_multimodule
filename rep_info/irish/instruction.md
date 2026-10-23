# Treoracha do zmchel WHMCS Multimodule

**Sula n-úsáideann tú é, cruthaigh luachanna salt uathúla i `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` agus `ZM_PB_NONCE_SALT`.** Forbraíodh agus tástáladh an modúl ar **WHMCS 8.13.1–8.13.7**. Seiceáladh comhoiriúnacht le **PHP 7.4–8.5**. Tacaítear go hiomlán le Apache (100%); d'fhéadfadh cumraíocht bhreise a bheith ag teastáil ó Nginx le haghaidh ródú teanga ar an leathanach baile.

**Sula n-úsáidtear an modúl den chéad uair, oscail Socruithe an Mhodúil → Teangacha Tacaithe agus cumasaigh na teangacha atá uait.**

**Tá zmchel WHMCS Multimodule saor in aisce.** Ó riarachán WHMCS is féidir leathanaigh ilteangacha a bhainistiú le heagarthóir amhairc, roghchláir, leabharlann meán, meiteashonraí SEO, léarscáileanna XML, atreoruithe, rialacha rewrite agus iompórtáil/easpórtáil.

## Socruithe an mhodúil

Roghnaigh na teangacha is féidir leis an modúl a úsáid. Ní scriosann díchumasú teanga a hábhar.

- **Socruithe an mhodúil → Teangacha tacaithe → Cumasaigh**
- **Bunachar sonraí an mhodúil → Deisigh Míreanna roghnaithe**
- **Rialacha athscríofa → Seiceáil rialacha → Cuir rialacha leis nó nuashonraigh iad**

Ní léann Nginx .htaccess, mar sin ní oibríonn na rialacha seo ann. Cumraigh rialacha comhionanna in nginx.

## Bainisteoir Leathanach

- **Cuir leathanach leis → Ainm an leathanaigh → Sluga an leathanaigh → Sábháil**
- **Eagarthóir Leathanach → Socruithe ábhair → Socruithe meiteashonraí → Socruithe léarscáil an tsuímh don leathanach → Sábháil gach ceann**
- **Bainisteoir Leathanach → Tabhair cuairt ar**
- **Léarscáil an tsuímh → Gin léarscáileanna suímh**

Ní cheadaítear ach litreacha Laidine, fleiscíní agus digití.

Úsáideoirí sínithe isteach: ní féidir ach le húsáideoirí sínithe isteach rochtain a fháil ar an leathanach; Cuairteoirí: ní féidir ach le cuairteoirí rochtain a fháil air; Measctha: is féidir le gach duine rochtain a fháil air, agus rialaíonn bloic laistigh den leathanach an infheictheacht.

Ritheann giniúint uathoibríoch tar éis cron WHMCS nuair a bhíonn nuashonrú dlite. Tosaíonn giniúint de láimh láithreach.

## Treoracha de réir rannáin

- [Bainisteoir Leathanach](docs/pages_manager.md)
- [Eagarthóir Leathanach](docs/pages_editor.md)
- [Bainisteoir Meán](docs/media_manager.md)
- [roghchláir](docs/menu_manager.md)
- [Bainisteoir Teangacha](docs/langs_manager.md)
- [atreoruithe](docs/redirects_manager.md)
- [léarscáileanna suímh](docs/sitemap_manager.md)
- [Rialacha athscríofa](docs/rewrite_manager.md)
- [Socruithe an mhodúil](docs/module_settings.md)
- [Bunachar sonraí an mhodúil](docs/module_db.md)

## Ábhar breise

- [uimhriú leathanach](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [sonraí struchtúrtha](docs/module_structured_data.md)
- [aistriú sonraí](docs/module_settings_transfer.md)
