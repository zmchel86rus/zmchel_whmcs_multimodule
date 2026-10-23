# Mapy witryny

Włącz mapę witryny i wygeneruj pliki XML. Sprawdź opublikowane wersje językowe w sitemap_index.xml; jeśli brak aktualizacji, sprawdź cron WHMCS i prawa zapisu.

## XML

XML zawiera wzajemne odnośniki dla aktywnych języków i `x-default` dla adresu języka domyślnego. Źródła przekierowań nie trafiają do `loc` ani alternatyw językowych; treść zastępcza jest oznaczona swoim rzeczywistym językiem. Pliki stron i wpisów deklarują przestrzeń nazw XHTML.

Hook `AfterCronJob` porównuje odstęp `ZM_PB_SITEMAP_UPDFREQ` z czasem ostatniego udanego generowania `ZM_PB_SITEMAP_LASTUPD`; przy wyłączonej mapie ręczne generowanie również nie jest dostępne. Wersje językowe wybiera się według `lang_active`, nie `lang_status`. Dodatkowe części dostają przyrostki `_2`, `_3` itd. Po błędzie poprzednie pliki są przywracane, a czas sukcesu pozostaje bez zmian. Sprawdź prawa zapisu w katalogu głównym, `resources/` i `inc/editable_consts.php`; tabele naprawia się osobno w bazie modułu.

Automatyczne generowanie zależy od zadania cron WHMCS i ustawionego odstępu; przycisk uruchamia je natychmiast. Uwzględniane są tylko opublikowane strony i wpisy dostępne dla gości wraz z aktywnymi tłumaczeniami. Jeśli strona zastępuje stronę systemową, używany jest publiczny URL strony systemowej, a nie slug strony zastępczej. Pliki przekraczające 50 000 adresów URL lub 50 MB są dzielone. Indeks zachowuje inne prawidłowe mapy witryny.

Moduł zapisuje w katalogu głównym witryny pliki `sitemap_index.xml`, `sitemap_pages.xml` i `sitemap_posts.xml`; pusta kategoria nie tworzy pliku. Nie powstaje połączony `sitemap.xml`. Po zmianie stron lub języków ponownie wygeneruj mapy i otwórz indeks w przeglądarce. W razie błędu sprawdź uprawnienia zapisu w katalogu głównym; czas ostatniego udanego generowania pozostaje bez zmian.

## Instrukcje

- Automatyczne generowanie jest uruchamiane po zadaniu cron WHMCS, gdy nadejdzie termin aktualizacji. Generowanie ręczne rozpoczyna się natychmiast.
- Uwzględniane są aktywne strony i wpisy dostępne dla gości, w tym ich opublikowane wersje językowe. Strony zastępujące korzystają z publicznych adresów URL stron, które zastępują.
- Generuj mapy witryny
- Pliki w katalogu głównym witryny
- Ostatnie pomyślne generowanie
- Następna aktualizacja nie wcześniej niż
- Jeśli nic nie wybrano, mapa witryny jest aktualizowana codziennie.
- Po włączeniu /html-sitemap wyświetla mapę witryny jako zwykłą stronę HTML; sitemap.xml pozostaje bez zmian.
- **Częstotliwość aktualizacji** — Jeśli pole jest puste, domyślnie ustawiana jest wartość 'monthly'.
- **Priorytet aktualizacji** — Jeśli pole jest puste, domyślnie ustawiana jest wartość '0.5'.
