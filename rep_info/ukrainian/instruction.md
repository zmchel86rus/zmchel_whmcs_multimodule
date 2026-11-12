[![Спостерігачі](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%A1%D0%BF%D0%BE%D1%81%D1%82%D0%B5%D1%80%D1%96%D0%B3%D0%B0%D1%87%D1%96)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Зірки](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%97%D1%96%D1%80%D0%BA%D0%B8)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Форки](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%A4%D0%BE%D1%80%D0%BA%D0%B8)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Задачі](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%97%D0%B0%D0%B4%D0%B0%D1%87%D1%96)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Інструкція з використання ZMChel WHMCS Multimodule

**ZMChel WHMCS Multimodule — безкоштовний модуль.** Він дає змогу керувати вмістом сайту з адмінпанелі WHMCS: візуальний редактор сторінок і блоків, багатомовний вміст, меню, медіатека, SEO-метадані, XML-мапи сайту, перенаправлення, rewrite-правила та імпорт/експорт.

## Перед першим використанням

**Перед першим використанням обов’язково відкрийте Налаштування модуля → Підтримувані мови та ввімкніть потрібні вам мови.**

Під час кожної активації модуль автоматично генерує нові солі та записує їх у `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Рекомендується перевірити, що всі три солі заповнені.

## Перевірена сумісність і працездатність

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Сумісність із вебсерверами

Apache підтримується повністю (100 %). Він також може працювати з Nginx, але мовну маршрутизацію головної сторінки слід окремо налаштувати й перевірити.

## Налаштування модуля

Виберіть мови, які може використовувати модуль. Вимкнення мови не видаляє її вміст.

- **Налаштування модуля → Підтримувані мови → Увімкнути**
- **База даних модуля → Виправити Вибране**
- **Правила перезапису → Перевірити правила → Додати або оновити правила**

Nginx не читає .htaccess: ці правила в ньому не працюють. Аналогічні правила потрібно налаштувати в nginx.

## Менеджер сторінок

- **Додати сторінку → Назва сторінки → Slug сторінки → Зберегти**
- **Редактор сторінок → Налаштування вмісту → Налаштування метаданих → Налаштування карти сайту для сторінки → Зберегти все**
- **Менеджер сторінок → Відвідати**
- **Карта сайту → Створити карти сайту**

Дозволено лише латинські літери, дефіси та цифри.

Авторизовані: сторінка доступна лише користувачам, які ввійшли; Гості: лише неавторизованим; Змішаний: сторінка доступна всім, а видимість окремих блоків налаштовується всередині сторінки.

Автоматичне створення запускається після cron WHMCS, коли настає час оновлення. Ручний запуск починається одразу.

## Посібники за розділами

- [Менеджер сторінок](docs/pages_manager.md)
- [Редактор сторінок](docs/pages_editor.md)
- [Менеджер медіафайлів](docs/media_manager.md)
- [Меню](docs/menu_manager.md)
- [Менеджер мов](docs/langs_manager.md)
- [Перенаправлення](docs/redirects_manager.md)
- [Мапи сайту](docs/sitemap_manager.md)
- [Правила перезапису](docs/rewrite_manager.md)
- [Налаштування модуля](docs/module_settings.md)
- [База даних модуля](docs/module_db.md)

## Додаткові матеріали

- [Пагінація й фільтри](docs/pages_editor_pagination.md)
- [Smarty та зібрані змінні](docs/pages_editor_smarty.md)
- [Структуровані дані Schema.org](docs/module_structured_data.md)
- [Імпорт та експорт](docs/module_settings_transfer.md)
