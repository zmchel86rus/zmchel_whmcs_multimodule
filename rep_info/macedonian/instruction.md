[![Следачи](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%A1%D0%BB%D0%B5%D0%B4%D0%B0%D1%87%D0%B8)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Ѕвезди](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%85%D0%B2%D0%B5%D0%B7%D0%B4%D0%B8)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Форкови](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%A4%D0%BE%D1%80%D0%BA%D0%BE%D0%B2%D0%B8)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Прашања](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%9F%D1%80%D0%B0%D1%88%D0%B0%D1%9A%D0%B0)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Упатство за zmchel WHMCS Multimodule

**zmchel WHMCS Multimodule е бесплатен.** Од администрацијата на WHMCS можете да управувате со страници и статии преку визуелен уредувач, преводи, менија, медијатека, SEO-полиња, XML-мапи на сајтот, пренасочувања и правила за препишување.

## Пред првата употреба

**Пред првата употреба отворете Поставки на модулот → Поддржани јазици и вклучете ги потребните јазици.**

При секое активирање модулот автоматски создава нови соли и ги запишува во `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Проверете дали се пополнети сите три соли.

## Проверена компатибилност и функционалност

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Компатибилност со веб-сервери

Apache е целосно поддржан. Nginx може да работи, но јазичните рути на почетната страница можеби бараат дополнителна конфигурација.

## Поставки на модулот

Изберете кои јазици може да ги користи модулот. Исклучувањето јазик не ја брише содржината.

- **Поставки на модулот → Поддржани јазици → Овозможи**
- **База на податоци на модулот → Поправи Избрани ставки**
- **Правила за препишување → Провери правила → Додај или ажурирај правила**

Nginx не ја чита .htaccess, па овие правила не функционираат таму. Конфигурирајте соодветни правила во nginx.

## Менаџер на страници

- **Додај страница → Име на страницата → Slug на страницата → Зачувај**
- **Уредувач на страници → Поставки на содржината → Поставки на метаподатоците → Поставки за мапата на сајтот на страницата → Зачувај сè**
- **Менаџер на страници → Посети**
- **Мапа на сајтот → Генерирај мапи на сајтот**

Дозволени се само латинични букви, цртички и цифри.

Најавени корисници: до страницата имаат пристап само најавени корисници; Гости: пристап имаат само гости; Мешано: пристап имаат сите, а видливоста се контролира преку блоковите во страницата.

Автоматското генерирање се извршува по WHMCS cron кога ќе дојде време за ажурирање. Рачното генерирање започнува веднаш.

## Упатства по оддели

- [Менаџер на страници](docs/pages_manager.md)
- [Уредувач на страници](docs/pages_editor.md)
- [Менаџер за медиуми](docs/media_manager.md)
- [Менија](docs/menu_manager.md)
- [Менаџер на јазици](docs/langs_manager.md)
- [Пренасочувања](docs/redirects_manager.md)
- [Мапи на сајтот](docs/sitemap_manager.md)
- [Правила за препишување](docs/rewrite_manager.md)
- [Поставки на модулот](docs/module_settings.md)
- [База на податоци на модулот](docs/module_db.md)

## Дополнителни материјали

- [Страницирање и филтри](docs/pages_editor_pagination.md)
- [Smarty и променливи](docs/pages_editor_smarty.md)
- [Структурирани податоци](docs/module_structured_data.md)
- [Увоз и извоз](docs/module_settings_transfer.md)
