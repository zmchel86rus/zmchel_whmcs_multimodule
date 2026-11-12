[![Ακόλουθοι](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%CE%91%CE%BA%CF%8C%CE%BB%CE%BF%CF%85%CE%B8%CE%BF%CE%B9)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Αστέρια](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=%CE%91%CF%83%CF%84%CE%AD%CF%81%CE%B9%CE%B1)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Διακλαδώσεις](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=%CE%94%CE%B9%CE%B1%CE%BA%CE%BB%CE%B1%CE%B4%CF%8E%CF%83%CE%B5%CE%B9%CF%82)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Ζητήματα](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%CE%96%CE%B7%CF%84%CE%AE%CE%BC%CE%B1%CF%84%CE%B1)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Οδηγίες χρήσης του zmchel WHMCS Multimodule

**Το zmchel WHMCS Multimodule είναι δωρεάν.** Διαχειρίζεται το περιεχόμενο του ιστότοπου μέσα από τη διαχείριση του WHMCS: οπτικό επεξεργαστή σελίδων και μπλοκ, πολυγλωσσικό περιεχόμενο, μενού, αρχεία πολυμέσων, στοιχεία SEO, χάρτες XML, ανακατευθύνσεις, κανόνες rewrite και εισαγωγή/εξαγωγή.

## Πριν από την πρώτη χρήση

**Ανοίξτε Ρυθμίσεις μονάδας → Υποστηριζόμενες γλώσσες και ενεργοποιήστε όσες χρειάζεστε.** Η απενεργοποίηση γλώσσας δεν διαγράφει το περιεχόμενό της.

Σε κάθε ενεργοποίηση η μονάδα δημιουργεί νέες τιμές salt στο module_init.php: ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT και ZM_PB_NONCE_SALT. Ελέγξτε ότι συμπληρώθηκαν και οι τρεις.

## Ελεγμένη συμβατότητα και λειτουργία

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3 και 4

## Συμβατότητα διακομιστή

Ο Apache υποστηρίζεται πλήρως. Το Nginx μπορεί επίσης να χρησιμοποιηθεί, αλλά η δρομολόγηση γλώσσας στην αρχική σελίδα ενδέχεται να χρειαστεί πρόσθετη ρύθμιση και έλεγχο.

## Ρυθμίσεις μονάδας

Επιλέξτε τις γλώσσες και τη μορφή των URL. Στον Apache ελέγξτε και εφαρμόστε τους κανόνες από τον Διαχειριστή rewrite· το Nginx απαιτεί αντίστοιχη ρύθμιση στον διακομιστή, επειδή αγνοεί το .htaccess. Ελέγξτε μετά μια δημοσιευμένη σελίδα στην προεπιλεγμένη γλώσσα και σε μία ακόμη ενεργή γλώσσα.

## Διαχείριση σελίδων

Δημιουργήστε σελίδα με εσωτερικό όνομα και slug με λατινικά γράμματα, αριθμούς και παύλες. Επιλέξτε γλώσσες και πρόσβαση για συνδεδεμένους χρήστες, επισκέπτες ή όλους, αποθηκεύστε, επεξεργαστείτε περιεχόμενο και μεταδεδομένα, δημοσιεύστε και ανοίξτε τη δημόσια διεύθυνση. Δημιουργήστε τον χάρτη ιστότοπου χειροκίνητα ή περιμένετε την προγραμματισμένη εργασία WHMCS.

## Οδηγοί ενοτήτων

- [Διαχείριση σελίδων](docs/pages_manager.md)
- [Επεξεργαστής σελίδων](docs/pages_editor.md)
- [Διαχείριση πολυμέσων](docs/media_manager.md)
- [Μενού](docs/menu_manager.md)
- [Διαχείριση γλωσσών](docs/langs_manager.md)
- [Ανακατευθύνσεις](docs/redirects_manager.md)
- [Χάρτες ιστότοπου](docs/sitemap_manager.md)
- [Διαχείριση rewrite](docs/rewrite_manager.md)
- [Ρυθμίσεις μονάδας](docs/module_settings.md)
- [Βάση δεδομένων μονάδας](docs/module_db.md)

## Πρόσθετη τεκμηρίωση

- [Σελιδοποίηση και φίλτρα](docs/pages_editor_pagination.md)
- [Smarty και κατάλογος μεταβλητών](docs/pages_editor_smarty.md)
- [Δομημένα δεδομένα Schema.org](docs/module_structured_data.md)
- [Εισαγωγή και εξαγωγή](docs/module_settings_transfer.md)
