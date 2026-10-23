# Ustawienia modułu

- [Import i eksport](module_settings_transfer.md)

## Instrukcje

- Wybierz języki dostępne w module. Wyłączenie języka nie usuwa jego treści.
- Jeśli używasz przyjaznych adresów URL na Apache, po zmianie języków zaktualizuj reguły w menedżerze przepisywania.
- **Przyjazne adresy URL** — Włącz przyjazne adresy URL, w tym adresy systemowe.
- **Routing językowy** — Włącz lub wyłącz trasy językowe. Po włączeniu strony są dostępne pod prefiksami /de/, /en/, /es/ i innymi obsługiwanymi prefiksami językowymi. Po wyłączeniu jeden adres URL strony wyświetla treść w języku skonfigurowanym przez użytkownika.
- **Trasa języka domyślnego** — Dodaje prefiks URL dla języka domyślnego i przekierowuje na niego strony modułu bez prefiksu.
- **Tryb konserwacji (moduł)** — Włącz lub wyłącz tryb konserwacji modułu. Ten łagodniejszy tryb pozwala działać hookom WHMCS i innym komponentom, w przeciwieństwie do systemowego trybu konserwacji.
- **Zbieraj zmienne Smarty** — Włącz lub wyłącz zbieranie zmiennych Smarty.
- **Używaj zebranych zmiennych Smarty** — Włącz lub wyłącz używanie zebranych zmiennych Smarty w edytorze stron.
- **Zastępowanie stron** — Włącz lub wyłącz zastępowanie stron.
- **Częstotliwość aktualizacji** — Jeśli nic nie wybrano, mapa witryny jest aktualizowana codziennie.
- **Mapa witryny HTML** — Po włączeniu /html-sitemap wyświetla mapę witryny jako zwykłą stronę HTML; sitemap.xml pozostaje bez zmian.
- **Nagłówek witryny** — Niestandardowy HTML dla sekcji <head>, w tym <script> i <style>.
- **Stopka witryny** — Niestandardowy HTML przed </body>, w tym <script> i <style>.
- **Edytuj robots.txt**

## 1. Instalacja i dostęp

Włącz dodatek w WHMCS i przyznaj dostęp uprawnionym administratorom. Sprawdź wymagane tabele w sekcji bazy danych modułu. Przejrzyj przyjazne adresy, trasy językowe i miejsca menu. Apache korzysta z .htaccess; w Nginx równoważne reguły trzeba skonfigurować osobno.
