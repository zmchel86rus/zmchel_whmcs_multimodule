
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'π.χ. Κείμενο εδώ'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Προσθήκη εικόνας',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Επιλογή εικόνας',
    uploadTitle: 'Σύρετε αρχεία εδώ ή κάντε κλικ για μεταφόρτωση'
  },
  // Here just as a reference, GrapesJS core doesn't contain any block,
  // so this should be omitted from other local files
  blockManager: {
    labels: {
      // 'block-id': 'Block Label',
    },
    categories: {
      // 'category-id': 'Category Label',
    }
  },
  domComponents: {
    names: {
      '': 'Πλαίσιο',
      wrapper: 'Σώμα',
      text: 'Κείμενο',
      comment: 'Σχόλιο',
      image: 'Εικόνα',
      video: 'Βίντεο',
      label: 'Ετικέτα',
      link: 'Σύνδεσμος',
      map: 'Χάρτης',
      tfoot: 'Υποσέλιδο πίνακα',
      tbody: 'Σώμα πίνακα',
      thead: 'Κεφαλίδα πίνακα',
      table: 'Πίνακας',
      row: 'Γραμμή πίνακα',
      cell: 'Κελί πίνακα'
    }
  },
  deviceManager: {
    device: 'Συσκευή',
    devices: {
      desktop: 'Υπολογιστής',
      tablet: 'Τάμπλετ',
      mobileLandscape: 'Κινητό (οριζόντια)',
      mobilePortrait: 'Κινητό (κατακόρυφα)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Προεπισκόπηση',
        fullscreen: 'Πλήρης οθόνη',
        'sw-visibility': 'Εμφάνιση στοιχείων',
        'export-template': 'Προβολή κώδικα',
        'open-sm': 'Άνοιγμα διαχείρισης στυλ',
        'open-tm': 'Ρυθμίσεις',
        'open-layers': 'Άνοιγμα διαχείρισης επιπέδων',
        'open-blocks': 'Άνοιγμα μπλοκ'
      }
    }
  },
  selectorManager: {
    label: 'Κλάσεις',
    selected: 'Επιλεγμένο',
    emptyState: '- Κατάσταση -',
    states: {
      hover: 'Κατά την τοποθέτηση του δείκτη',
      active: 'Κατά το κλικ',
      'nth-of-type(2n)': 'Ζυγά/μονά'
    }
  },
  styleManager: {
    empty: 'Επιλέξτε ένα στοιχείο πριν χρησιμοποιήσετε τη διαχείριση στυλ',
    layer: 'Επίπεδο',
    fileButton: 'Εικόνες',
    sectors: {
      general: 'Γενικά',
      layout: 'Διάταξη',
      typography: 'Τυπογραφία',
      decorations: 'Διακόσμηση',
      extra: 'Πρόσθετα',
      flex: 'Flex',
      dimension: 'Διαστάσεις'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Θόλωση',
      'text-shadow-color': 'Χρώμα',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Θόλωση',
      'box-shadow-spread': 'Εξάπλωση',
      'box-shadow-color': 'Χρώμα',
      'box-shadow-type': 'Τύπος',
      'margin-top-sub': 'Πάνω',
      'margin-right-sub': 'Δεξιά',
      'margin-bottom-sub': 'Κάτω',
      'margin-left-sub': 'Αριστερά',
      'padding-top-sub': 'Πάνω',
      'padding-right-sub': 'Δεξιά',
      'padding-bottom-sub': 'Κάτω',
      'padding-left-sub': 'Αριστερά',
      'border-width-sub': 'Πλάτος',
      'border-style-sub': 'Στυλ',
      'border-color-sub': 'Χρώμα',
      'border-top-left-radius-sub': 'Επάνω αριστερά',
      'border-top-right-radius-sub': 'Επάνω δεξιά',
      'border-bottom-right-radius-sub': 'Κάτω δεξιά',
      'border-bottom-left-radius-sub': 'Κάτω αριστερά',
      'transform-rotate-x': 'Περιστροφή X',
      'transform-rotate-y': 'Περιστροφή Y',
      'transform-rotate-z': 'Περιστροφή Z',
      'transform-scale-x': 'Κλιμάκωση X',
      'transform-scale-y': 'Κλιμάκωση Y',
      'transform-scale-z': 'Κλιμάκωση Z',
      'transition-property-sub': 'Ιδιότητα',
      'transition-duration-sub': 'Διάρκεια',
      'transition-timing-function-sub': 'Χρονισμός',
      'background-image-sub': 'Εικόνα',
      'background-repeat-sub': 'Επανάληψη',
      'background-position-sub': 'Θέση',
      'background-attachment-sub': 'Στερέωση',
      'background-size-sub': 'Μέγεθος'
    }
    // Translate options in style properties
    // options: {
    //   float: { // Id of the property
    //     ...
    //     left: 'Left', // {option id}: {Option label}
    //   }
    // }
  },
  traitManager: {
    empty: 'Επιλέξτε ένα στοιχείο πριν χρησιμοποιήσετε τη διαχείριση χαρακτηριστικών',
    label: 'Ρυθμίσεις στοιχείου',
    traits: {
      // The core library generates the name by their `name` property
      labels: {
        // id: 'Id',
        // alt: 'Alt',
        // title: 'Title',
        // href: 'Href',
      },
      // In a simple trait, like text input, these are used on input attributes
      attributes: {
        id: traitInputAttr,
        alt: traitInputAttr,
        title: traitInputAttr,
        href: {
          placeholder: 'π.χ. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Αυτό το παράθυρο',
          _blank: 'Νέο παράθυρο'
        }
      }
    }
  },
  storageManager: {
    recover: 'Θέλετε να επαναφέρετε τις μη αποθηκευμένες αλλαγές;'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Πλεύση",
  "display": "Εμφάνιση",
  "position": "Θέση",
  "top": "Πάνω",
  "right": "Δεξιά",
  "left": "Αριστερά",
  "bottom": "Κάτω",
  "width": "Πλάτος",
  "height": "Ύψος",
  "max-width": "Μέγιστο πλάτος",
  "max-height": "Μέγιστο ύψος",
  "margin": "Εξωτερικό περιθώριο",
  "margin-top": "Επάνω εξωτερικό περιθώριο",
  "margin-right": "Δεξί εξωτερικό περιθώριο",
  "margin-left": "Αριστερό εξωτερικό περιθώριο",
  "margin-bottom": "Κάτω εξωτερικό περιθώριο",
  "padding": "Εσωτερικό περιθώριο",
  "padding-top": "Επάνω εσωτερικό περιθώριο",
  "padding-left": "Αριστερό εσωτερικό περιθώριο",
  "padding-right": "Δεξί εσωτερικό περιθώριο",
  "padding-bottom": "Κάτω εσωτερικό περιθώριο",
  "font-family": "Οικογένεια γραμματοσειράς",
  "font-size": "Μέγεθος γραμματοσειράς",
  "font-weight": "Πάχος γραμματοσειράς",
  "letter-spacing": "Απόσταση γραμμάτων",
  "color": "Χρώμα",
  "line-height": "Ύψος γραμμής",
  "text-align": "Στοίχιση κειμένου",
  "text-shadow": "Σκιά κειμένου",
  "border-top-left": "Περίγραμμα επάνω αριστερά",
  "border-top-right": "Περίγραμμα επάνω δεξιά",
  "border-bottom-left": "Περίγραμμα κάτω αριστερά",
  "border-bottom-right": "Περίγραμμα κάτω δεξιά",
  "border-radius-top-left": "Στρογγυλοποίηση επάνω αριστερής γωνίας",
  "border-radius-top-right": "Στρογγυλοποίηση επάνω δεξιάς γωνίας",
  "border-radius-bottom-left": "Στρογγυλοποίηση κάτω αριστερής γωνίας",
  "border-radius-bottom-right": "Στρογγυλοποίηση κάτω δεξιάς γωνίας",
  "border-radius": "Στρογγυλοποίηση γωνιών",
  "border": "Περίγραμμα",
  "border-width": "Πάχος περιγράμματος",
  "border-style": "Στυλ περιγράμματος",
  "border-color": "Χρώμα περιγράμματος",
  "box-shadow": "Σκιά πλαισίου",
  "background": "Φόντο",
  "background-image": "Εικόνα φόντου",
  "background-repeat": "Επανάληψη φόντου",
  "background-position": "Θέση φόντου",
  "background-attachment": "Στερέωση φόντου",
  "background-size": "Μέγεθος φόντου",
  "background-color": "Χρώμα φόντου",
  "transition": "Μετάβαση",
  "transition-property": "Ιδιότητα μετάβασης",
  "transition-duration": "Διάρκεια μετάβασης",
  "transition-timing-function": "Χρονισμός μετάβασης",
  "perspective": "Προοπτική",
  "transform": "Μετασχηματισμός",
  "flex-direction": "Κατεύθυνση Flex",
  "flex-wrap": "Αναδίπλωση Flex",
  "justify-content": "Στοίχιση περιεχομένου στον κύριο άξονα",
  "align-items": "Στοίχιση στοιχείων",
  "align-content": "Στοίχιση περιεχομένου",
  "order": "Σειρά",
  "flex-basis": "Βασικό μέγεθος Flex",
  "flex-grow": "Ανάπτυξη Flex",
  "flex-shrink": "Συρρίκνωση Flex",
  "align-self": "Ατομική στοίχιση"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Εναλλακτικό κείμενο",
  "title": "Τίτλος",
  "href": "Σύνδεσμος"
});