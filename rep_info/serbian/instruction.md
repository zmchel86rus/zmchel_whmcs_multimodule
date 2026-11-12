[![Пратиоци](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%9F%D1%80%D0%B0%D1%82%D0%B8%D0%BE%D1%86%D0%B8)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Звезде](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%97%D0%B2%D0%B5%D0%B7%D0%B4%D0%B5)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Форкови](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%A4%D0%BE%D1%80%D0%BA%D0%BE%D0%B2%D0%B8)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Пријаве](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%9F%D1%80%D0%B8%D1%98%D0%B0%D0%B2%D0%B5)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Упутство за zmchel WHMCS Multimodule

**zmchel WHMCS Multimodule је бесплатан.** Омогућава управљање страницама и чланцима из WHMCS администрације, уз визуелни уређивач, преводе, меније, медијатеку, SEO поља, XML мапе сајта, преусмеравања и правила преписивања.

## Пре прве употребе

**Пре прве употребе отворите Подешавања модула → Подржани језици и укључите потребне језике.**

При свакој активацији модул аутоматски генерише нове соли и уписује их у `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Проверите да ли су све три соли попуњене.

## Проверена компатибилност и функционалност

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Компатибилност са веб-серверима

Apache је у потпуности подржан. Nginx може да ради, али језичке руте на почетној страници могу захтевати додатно подешавање.

## Подешавања модула

Изаберите језике које модул може да користи. Искључивање језика не брише његов садржај.

- **Подешавања модула → Подржани језици → Омогући**
- **База података модула → Поправи Изабране ставке**
- **Правила за преписивање → Провери правила → Додај или ажурирај правила**

Nginx не чита .htaccess, па ова правила тамо не раде. Подесите одговарајућа правила у nginx-у.

## Менаџер страница

- **Додај страницу → Назив странице → Slug ознака странице → Сачувај**
- **Уређивач страница → Подешавања садржаја → Подешавања метаподатака → Подешавања мапе сајта за страницу → Сачувај све**
- **Менаџер страница → Посети**
- **Мапа сајта → Генериши мапе сајта**

Дозвољена су само латинична слова, цртице и цифре.

Пријављени корисници: само пријављени корисници могу приступити страници; Гости: само гости могу приступити; Мешовити приступ: сви могу приступити, а видљивост одређују блокови на страници.

Аутоматско генерисање се покреће након WHMCS cron задатка када дође време за ажурирање. Ручно генерисање почиње одмах.

## Упутства по одељцима

- [Менаџер страница](docs/pages_manager.md)
- [Уређивач страница](docs/pages_editor.md)
- [Управљач медијима](docs/media_manager.md)
- [Менији](docs/menu_manager.md)
- [Менаџер језика](docs/langs_manager.md)
- [Преусмеравања](docs/redirects_manager.md)
- [Мапе сајта](docs/sitemap_manager.md)
- [Правила за преписивање](docs/rewrite_manager.md)
- [Подешавања модула](docs/module_settings.md)
- [База података модула](docs/module_db.md)

## Додатни материјали

- [Странице и филтери](docs/pages_editor_pagination.md)
- [Smarty и променљиве](docs/pages_editor_smarty.md)
- [Структурисани подаци](docs/module_structured_data.md)
- [Увоз и извоз](docs/module_settings_transfer.md)
