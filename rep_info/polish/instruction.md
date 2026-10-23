# Instrukcja zmchel WHMCS Multimodule

**Przed użyciem wygeneruj unikalne sole i wpisz ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT oraz ZM_PB_NONCE_SALT w module_init.php.** Moduł opracowano i przetestowano z WHMCS 8.13.1–8.13.7. Apache jest w pełni obsługiwany. Nginx może działać, lecz routing językowy strony głównej może wymagać dodatkowej konfiguracji.

**Przed pierwszym użyciem otwórz Ustawienia modułu → Obsługiwane języki i włącz potrzebne języki.**

**Sprawdzone wersje PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 i 8.5.

**zmchel WHMCS Multimodule jest darmowy.** Pozwala zarządzać stronami i artykułami z panelu WHMCS. Zawiera edytor wizualny, tłumaczenia, menu, bibliotekę multimediów, pola SEO, mapy witryny XML, przekierowania i reguły przepisywania adresów.

## Ustawienia modułu

Wybierz języki dostępne w module. Wyłączenie języka nie usuwa jego treści.

- **Ustawienia modułu → Obsługiwane języki → Włącz**
- **Baza danych modułu → Napraw Wybrane elementy**
- **Reguły przepisywania adresów → Sprawdź reguły → Dodaj lub zaktualizuj reguły**

Nginx nie odczytuje pliku .htaccess, dlatego te reguły nie będą w nim działać. Skonfiguruj odpowiednie reguły w nginx.

## Menedżer stron

- **Dodaj stronę → Nazwa strony → Slug strony → Zapisz**
- **Edytor stron → Ustawienia treści → Ustawienia metadanych → Ustawienia mapy witryny strony → Zapisz wszystko**
- **Menedżer stron → Odwiedź**
- **Mapa witryny → Generuj mapy witryny**

Dozwolone są tylko litery łacińskie, łączniki i cyfry.

Zalogowani użytkownicy: dostęp do strony mają tylko zalogowani użytkownicy; Goście: tylko niezalogowani; Mieszany: dostęp mają wszyscy, a widoczność jest kontrolowana przez bloki wewnątrz strony.

Automatyczne generowanie jest uruchamiane po zadaniu cron WHMCS, gdy nadejdzie termin aktualizacji. Generowanie ręczne rozpoczyna się natychmiast.

## Instrukcje według sekcji

- [Menedżer stron](docs/pages_manager.md)
- [Edytor stron](docs/pages_editor.md)
- [Menedżer multimediów](docs/media_manager.md)
- [Menu](docs/menu_manager.md)
- [Menedżer języków](docs/langs_manager.md)
- [Przekierowania](docs/redirects_manager.md)
- [Mapy witryny](docs/sitemap_manager.md)
- [Reguły przepisywania adresów](docs/rewrite_manager.md)
- [Ustawienia modułu](docs/module_settings.md)
- [Baza danych modułu](docs/module_db.md)

## Materiały dodatkowe

- [Stronicowanie i filtry](docs/pages_editor_pagination.md)
- [Smarty i zmienne](docs/pages_editor_smarty.md)
- [Dane strukturalne](docs/module_structured_data.md)
- [Import i eksport](docs/module_settings_transfer.md)
