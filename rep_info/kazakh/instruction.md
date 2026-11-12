[![Бақылаушылар](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%91%D0%B0%D2%9B%D1%8B%D0%BB%D0%B0%D1%83%D1%88%D1%8B%D0%BB%D0%B0%D1%80)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Жұлдыздар](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%96%D2%B1%D0%BB%D0%B4%D1%8B%D0%B7%D0%B4%D0%B0%D1%80)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Форктар](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%A4%D0%BE%D1%80%D0%BA%D1%82%D0%B0%D1%80)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Мәселелер](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%9C%D3%99%D1%81%D0%B5%D0%BB%D0%B5%D0%BB%D0%B5%D1%80)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule нұсқаулығы

**zmchel WHMCS Multimodule тегін.** WHMCS әкімші панелінен визуалды редактор арқылы көптілді беттерді, мәзірлерді, медиа кітапхананы, SEO метадеректерін, XML сайт карталарын, қайта бағыттауларды, rewrite ережелерін және импорт пен экспортты басқарыңыз.

## Алғашқы қолдану алдында

**Алғаш қолданар алдында Модуль баптаулары → Қолдау көрсетілетін тілдер бөлімін ашып, қажет тілдерді қосыңыз.**

Әр белсендірілген сайын модуль жаңа salt мәндерін автоматты түрде жасап, оларды `module_init.php` файлына жазады (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Үш salt мәнінің де толтырылғанын тексеріңіз.

## Тексерілген үйлесімділік пен жұмыс

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Веб-серверлермен үйлесімділік

Apache толық (100%) қолдау табады; Nginx-та басты беттегі тілдік бағдарлау қосымша баптауды қажет етуі мүмкін.

## Модуль параметрлері

Модуль пайдалана алатын тілдерді таңдаңыз. Тілді өшіру оның мазмұнын жоймайды.

- **Модуль параметрлері → Қолдау көрсетілетін тілдер → Қосу**
- **Модуль дерекқоры → Түзету Таңдалған элементтер**
- **Қайта жазу ережелері → Ережелерді тексеру → Ережелерді қосу немесе жаңарту**

Nginx .htaccess файлын оқымайды, сондықтан бұл ережелер онда жұмыс істемейді. Баламалы ережелерді nginx ішінде баптаңыз.

## Бет менеджері

- **Бет қосу → Бет атауы → Беттің slug мәні → Сақтау**
- **Бет редакторы → Мазмұн параметрлері → Метадеректер параметрлері → Беттің сайт картасы параметрлері → Барлығын сақтау**
- **Бет менеджері → Өту**
- **Сайт картасы → Сайт карталарын жасау**

Тек латын әріптері, дефистер және сандар рұқсат етіледі.

Жүйеге кірген пайдаланушылар: бетке тек тіркелгісіне кіргендер кіре алады; Қонақтар: бет тек қонақтарға қолжетімді; Аралас: бет барлығына қолжетімді, ал ішкі блоктардың көрінуі жеке басқарылады.

Автоматты жасау жаңарту уақыты келгенде WHMCS cron тапсырмасынан кейін орындалады. Қолмен жасау бірден басталады.

## Бөлімдер бойынша нұсқаулықтар

- [Бет менеджері](docs/pages_manager.md)
- [Бет редакторы](docs/pages_editor.md)
- [Медиаменеджер](docs/media_manager.md)
- [мәзірлер](docs/menu_manager.md)
- [Тілдер менеджері](docs/langs_manager.md)
- [қайта бағыттау](docs/redirects_manager.md)
- [сайт картасы](docs/sitemap_manager.md)
- [Қайта жазу ережелері](docs/rewrite_manager.md)
- [Модуль параметрлері](docs/module_settings.md)
- [Модуль дерекқоры](docs/module_db.md)

## Қосымша материалдар

- [беттеу](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [құрылымдалған деректер](docs/module_structured_data.md)
- [дерек көшіру](docs/module_settings_transfer.md)
