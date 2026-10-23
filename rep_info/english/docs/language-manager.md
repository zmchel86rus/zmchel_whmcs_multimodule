# Language Manager

Language Manager lets you edit WHMCS and module language strings in the admin area. This feature is still in development. The module's super administrator can use it; PHP also needs write access to the relevant language directories.

## Getting started

1. In **Module settings → Supported languages**, enable the languages you need. This list controls which languages the manager can add and which languages module pages can use. Language Manager does not enable a language in module settings automatically.
2. Open **Language Manager → Sections**. Choose WHMCS client or admin languages, this module, or another discovered module. The table shows the number of existing, disabled, and available languages in each section.
3. On **Languages**, select an existing language or click **Add** beside an available one. A newly added language initially loads strings from a reference language. It is not a completed translation: write its own strings before relying on it. The **Untranslated** badge marks a catalog with no translations of its own.

## Editing translations

Open a language on **Translations**. The table shows each key path, its source text, and an editable translation. **Original** shows strings actually present in the selected language's original file, without your override changes. When a new language has no original translation, the column says **Reference** and shows the base language. An empty translation field in that catalog means the reference is still in use.

Search by key or text and select **Show all**, **Show original**, or **Show added** as needed. Long catalogs are paginated. Edit a value and click **Save** on that row; each translation is saved separately. Clearing a translation in a manager-created language restores its reference fallback.

To add a custom key, choose its parent under **Inside**, enter the key name and translation, then click **Add**. You can rename or delete a key added this way beside its row. Original keys cannot be deleted that way. Some third-party module catalogs are read-only when the manager cannot safely save their format.

## JSON export and import

**Export JSON** downloads the selected section's keys and current translations for one language. Keep a copy before bulk editing. Change the values and upload the file with **Import JSON**. Import updates existing keys only; it cannot create new keys. Keep the section and language identifiers and key paths intact. Unknown and duplicate keys are skipped and listed in the result while valid entries continue importing. The upload limit is 8 MiB.

## Language files and filenames

On **Languages**, you can disable or re-enable a section's language file. A disabled language can still be edited. The English base file and the current WHMCS default language cannot be disabled. For WHMCS client and admin languages created by the manager, it keeps backup copies so it can restore them after a WHMCS update.

If an old filename is found, **Sections** shows a shared filename correction selector. Check the displayed new filename and click **Fix**. The correction covers the detected sections and the module's language lists; compatible old names remain supported.

To change the default language, first enable the replacement in **Module settings → Supported languages**, then change the WHMCS default. You can disable the old language afterward. An empty catalog still displays its reference strings, so check both the admin and client areas before using the new language.
