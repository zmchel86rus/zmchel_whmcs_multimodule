# Микроразметка вывода

## Schema.org

- **Редактор страниц → Настройки Meta данных → Тип Schema → Сохранить.**

Проверено по документации 5 октября 2026 года.

| Вывод | Разметка |
| --- | --- |
| Меню navbar, sidebar, footer | `SiteNavigationElement`, с реальными названиями, языком и URL после проверки доступа и подмен. Группы передаются через `hasPart`. JSON-LD не зависит от поддержки дополнительных атрибутов темой WHMCS. |
| Содержание | `SiteNavigationElement` и `WebPageElement` с якорями реально найденных заголовков. Тип родителя учитывает страницу/статью. |
| Вопрос-ответ | `FAQPage` с непустыми вопросами и ответами. Не берутся скрытые блоки, служебный текст и обычные аккордеоны. Закрытый `details` остаётся доступным по клику и участвует. |
| Хлебные крошки | `BreadcrumbList` в клиентских темах только при двух и более пунктах. Одиночная крошка остаётся видимой без микроразметки. Второй JSON-LD с теми же крошками не создаётся. |
| Организация и контакты | Данные WHMCS; язык страницы — в `WebPage`/`ContactPage`, языки поддержки — `ContactPoint.availableLanguage` в BCP47. `Organization.inLanguage` не используется. |
| Фильтры, поля, выбор количества, пагинация, контактная форма | Отдельная Schema.org сущность автоматически не создаётся. Это элементы управления, а не товары, статьи, поисковый сервис или контактные данные организации. |
| Секции, flex/grid, отступы, кнопки, обычные аккордеоны, карусели | Автоматическая разметка отсутствует. Тип содержимого не выводится из его оформления. |
| Smarty и пользовательский HTML | Существующая авторская разметка не переписывается: строитель не может достоверно угадать тип произвольных данных. |

`SiteNavigationElement` описывает навигацию, но не гарантирует дополнительные ссылки в поисковой выдаче. Google прекратил показ FAQ rich results с 7 мая 2026 года; корректный `FAQPage` сохранён как описание реального содержимого, без обещания расширенного сниппета. Разметка поискового блока `SearchAction` к локальным фильтрам не добавляется.

`inLanguage` исключён из шаблонов `Organization`, `Person`, `Product` и `Service`: они не входят в область применения свойства. Языковые сведения не выдумываются и не заменяются фиктивными объектами.

Источники:

- https://developers.google.com/search/docs/appearance/structured-data/sd-policies
- https://schema.org/SiteNavigationElement
- https://schema.org/inLanguage
- https://developers.google.com/search/docs/appearance/structured-data/breadcrumb
- https://developers.google.com/search/updates#may-2026
- https://developers.google.com/search/blog/2024/10/sitelinks-search-box
- https://yandex.ru/support/webmaster/ru/schema-org/what-is-schema-org

Локальные проверки (PHP с расширением DOM):

```sh
php modules/addons/zmchel_whmcs_multimodule/tests/schema_output.php
php modules/addons/zmchel_whmcs_multimodule/tests/contact_schema.php
php modules/addons/zmchel_whmcs_multimodule/tests/table_of_contents.php
php modules/addons/zmchel_whmcs_multimodule/tests/footer_menu.php
```

## JSON-LD

После публикации сравните итоговый JSON-LD с содержимым, которое действительно видит посетитель. Навигационная и FAQ-разметка должна описывать реальные ссылки, заголовки, вопросы и ответы. Даже корректная разметка не гарантирует расширенное представление в поиске.

## ContactPoint.availableLanguage

Языки контактов берутся из WHMCS и записываются в `ContactPoint.availableLanguage` в формате BCP 47. Язык страницы указывается у `WebPage` или `ContactPage`; для `Organization` не следует придумывать значение `inLanguage`.

## Инструкция

- **Тип Schema** — Если выключено, json схемы по разметке Schema.org не выводятся для страницы
- **Хлебные крошки** — Название страницы в хлебных крошках
- **Канонический URL**
- **Заголовок страницы (Title)**
- **Мета описание страницы**
- **Заголовок страницы для Open Graph** — Если не указано, используется 'Заголовок страницы (Title)'
- **Мета OG описание страницы** — Если не указано, используется 'Мета описание страницы'
- **Изображение страницы для Open Graph** — Если не указано, используется 'Изображение страницы'
