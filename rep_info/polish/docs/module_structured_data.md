# Dane strukturalne

- **Edytor stron → Ustawienia metadanych → Typ schematu → Zapisz.**

Uzupełnij metadane i właściwy typ strony dla każdego języka: WebPage, typ artykułu lub ContactPage. Po publikacji sprawdź JSON-LD i kanoniczny URL.

## Jakie dane oznacza moduł

Menu i spis treści mogą tworzyć `SiteNavigationElement`, widoczne pytania i odpowiedzi `FAQPage`, a ścieżka nawigacji z kilkoma elementami `BreadcrumbList`. Bloki układu, przyciski i filtry nie otrzymują automatycznie typu treści. Wybrany typ Schema steruje JSON-LD strony; po jego wyłączeniu te dane nie są emitowane.

## Kontrola po publikacji

Na publicznej stronie sprawdź JSON-LD, kanoniczny URL, język i faktycznie widoczną treść. Poprawne oznaczenie nie gwarantuje rozszerzonego wyniku wyszukiwania.

## Schema.org

`SiteNavigationElement` wykorzystuje rzeczywiście widoczne linki i nazwy menu; spis treści może dodać `WebPageElement` dla nagłówków faktycznie obecnych na stronie. `FAQPage` obejmuje tylko pełne pytania i odpowiedzi widoczne dla odwiedzającego: ukryte bloki i zwykłe akordeony są pomijane. `BreadcrumbList` powstaje tylko przy co najmniej dwóch elementach. Dane organizacji pochodzą z WHMCS; języki kontaktu są w `ContactPoint.availableLanguage` w formacie BCP 47. Dla filtrów, paginacji, formularzy i własnego HTML moduł nie zgaduje typu Schema.

## Instrukcje

- **Typ schematu** — Po wyłączeniu znaczniki JSON Schema.org nie są generowane dla tej strony.
- **Ścieżka nawigacyjna** — Nazwa strony w ścieżce nawigacyjnej
- **Kanoniczny adres URL**
- **Tytuł strony**
- **Opis meta**
- **Tytuł Open Graph** — Jeśli pole jest puste, używany jest tytuł strony.
- **Opis Open Graph** — Jeśli pole jest puste, używany jest opis meta.
- **Obraz Open Graph** — Jeśli pole jest puste, używany jest obraz strony.
