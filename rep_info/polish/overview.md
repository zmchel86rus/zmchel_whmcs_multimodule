# Darmowy multimoduł dla WHMCS

**Przed użyciem wygeneruj unikalne sole i wpisz ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT oraz ZM_PB_NONCE_SALT w module_init.php.** Moduł opracowano i przetestowano z WHMCS 8.13.1–8.13.7. Apache jest w pełni obsługiwany. Nginx może działać, lecz routing językowy strony głównej może wymagać dodatkowej konfiguracji.

**Przed pierwszym użyciem otwórz Ustawienia modułu → Obsługiwane języki i włącz potrzebne języki.**

**Sprawdzone wersje PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 i 8.5.

**zmchel WHMCS Multimodule jest darmowy.** Pozwala zarządzać stronami i artykułami z panelu WHMCS. Zawiera edytor wizualny, tłumaczenia, menu, bibliotekę multimediów, pola SEO, mapy witryny XML, przekierowania i reguły przepisywania adresów.

## Menedżer języków (w trakcie rozwoju)

W administracji WHMCS otwórz Menedżer języków, wybierz sekcję (języki klienta lub administratora WHMCS, ten moduł albo inny) oraz język. Porównaj oryginał lub tekst odniesienia z tłumaczeniem, zmień jeden wiersz i zapisz go; istniejące klucze można też eksportować i importować jako JSON. Nowe języki korzystają z tekstu odniesienia do czasu przetłumaczenia. Menedżer włącza i wyłącza pliki językowe oraz poprawia dawne nazwy; najpierw zmień język domyślny w WHMCS.

## Dalszy rozwój

- Dodać zagnieżdżone strony i kategorie stron.
- Podzielić obecny monolit na współpracujące komponenty.
- Dodać zarządzanie uprawnieniami w panelu modułu.
- Rozszerzyć domyślną listę języków w supported_langs.php.
- Dodać edytor kodu szablonów modułu i motywów klienta, bez motywu administracyjnego.
- Dodać menedżer plików językowych WHMCS i innych modułów.
- Usprawnić menedżer mediów.
- Zbudować pełny, wydajny menedżer SEO inspirowany Yoast SEO.
- Dodać wielojęzyczne mapy XML i stronę mapy witryny w HTML.
- Dodać statystyki użycia do menedżera stron.
- Minifikować JS, CSS i HTML, buforować całe strony oraz optymalizować tabele modułu i WHMCS.
- Dodać porządny system aktualizacji modułu.

To plany, a nie sztywny harmonogram.

## Zaproponuj pomysł

Wyślij propozycję e-mailem. [ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E)

## Zadaj pytanie

Wyślij pytanie dotyczące modułu e-mailem. [ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E)
