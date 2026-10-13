# Микроразметка вывода

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
