# Структуровані дані у виведенні

| Виведення | Розмітка Schema.org |
| --- | --- |
| Navbar, sidebar і footer | `SiteNavigationElement` зі справжніми назвами, мовою та URL після перевірки доступу й підмін. Групи використовують `hasPart`. |
| Зміст сторінки | `SiteNavigationElement` і `WebPageElement` з якорями реально знайдених заголовків. |
| Питання та відповіді | `FAQPage` лише для видимих непорожніх питань і відповідей. Приховані блоки й звичайні акордеони пропускаються; закритий, але доступний `details` враховується. |
| Хлібні крихти | `BreadcrumbList` від двох пунктів. Одна крихта лишається видимою без розмітки; дубльованого JSON-LD немає. |
| Організація й контакти | Дані WHMCS. Мова сторінки належить `WebPage`/`ContactPage`, мови підтримки — `ContactPoint.availableLanguage` у форматі BCP47. |
| Фільтри, поля, кількість, пагінація й форма | Окрема сутність автоматично не створюється: це елементи керування, а не товари, статті чи контакти організації. |
| Оформлення, Smarty та власний HTML | Тип вмісту не вгадується за оформленням; авторська розмітка не переписується. |

`SiteNavigationElement` описує навігацію, але не гарантує додаткових посилань у пошуку. Google припинив показ розширених результатів FAQ у травні 2026 року; коректний `FAQPage` і далі описує реальний вміст. Локальні фільтри не отримують `SearchAction`. `inLanguage` не вигадується для шаблонів `Organization`, `Person`, `Product` або `Service`, де властивість непридатна.

Джерела: [правила Google](https://developers.google.com/search/docs/appearance/structured-data/sd-policies), [SiteNavigationElement](https://schema.org/SiteNavigationElement), [inLanguage](https://schema.org/inLanguage), [хлібні крихти](https://developers.google.com/search/docs/appearance/structured-data/breadcrumb). Локальні перевірки з PHP DOM: `tests/schema_output.php`, `tests/contact_schema.php`, `tests/table_of_contents.php`, `tests/footer_menu.php`.
