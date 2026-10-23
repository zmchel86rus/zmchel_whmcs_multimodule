# Pravidla přepisu URL

## WHMCS

Pravidla pro jazykové URL, včetně stránek pod /ru/, /en/ a dalšími prefixy. Jazyky se načítají ze supported_langs.php; pravidla se vkládají do .htaccess před pravidla WHMCS.

Nginx nečte soubor .htaccess, proto zde tato pravidla nefungují. Nastavte odpovídající pravidla v nginx.

Bylo zjištěno uspořádání nginx → Apache. Tato pravidla fungují pouze pro požadavky předané Apache; nginx soubor .htaccess nečte.

Po přidání nebo smazání pravidla klikněte na „Přidat nebo aktualizovat pravidla“, aby se změny použily v .htaccess.

## .htaccess

Otevřete správce a porovnejte pravidla s hlavním souborem `.htaccess`. Pro vlastní pravidlo uložte vzor URL, cíl a příznaky; potom použijte **Přidat nebo aktualizovat pravidla**, čímž se blok zapíše před pravidla WHMCS. Znovu ověřte stav a otevřete zveřejněnou stránku ve výchozím i dalším jazyce. Příliš široký vzor může zasáhnout jiné stránky. Při zapojení Nginx → Apache fungují pravidla jen pro požadavky předané Apache.

## Pokyny

- Zkontrolovat pravidla
- Přidat nebo aktualizovat pravidla
- Odstranit všechna pravidla z .htaccess
- Vzor URL
- Cíl
- Příznaky
