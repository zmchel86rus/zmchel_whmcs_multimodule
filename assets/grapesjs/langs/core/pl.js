
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'np. Wpisz tekst tutaj'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Dodaj obraz',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Wybierz obraz',
    uploadTitle: 'Przeciągnij pliki tutaj lub kliknij, aby je przesłać'
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
      '': 'Kontener',
      wrapper: 'Treść strony',
      text: 'Tekst',
      comment: 'Komentarz',
      image: 'Obraz',
      video: 'Wideo',
      label: 'Etykieta',
      link: 'Łącze',
      map: 'Mapa',
      tfoot: 'Stopka tabeli',
      tbody: 'Treść tabeli',
      thead: 'Nagłówek tabeli',
      table: 'Tabela',
      row: 'Wiersz tabeli',
      cell: 'Komórka tabeli'
    }
  },
  deviceManager: {
    device: 'Urządzenie',
    devices: {
      desktop: 'Komputer',
      tablet: 'Tablet',
      mobileLandscape: 'Telefon (poziomo)',
      mobilePortrait: 'Telefon (pionowo)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Podgląd',
        fullscreen: 'Pełny ekran',
        'sw-visibility': 'Pokaż komponenty',
        'export-template': 'Pokaż kod',
        'open-sm': 'Otwórz menedżera stylów',
        'open-tm': 'Ustawienia',
        'open-layers': 'Otwórz menedżera warstw',
        'open-blocks': 'Otwórz bloki'
      }
    }
  },
  selectorManager: {
    label: 'Klasy',
    selected: 'Zaznaczono',
    emptyState: '- Stan -',
    states: {
      hover: 'Po najechaniu kursorem',
      active: 'Po kliknięciu',
      'nth-of-type(2n)': 'Parzyste/nieparzyste'
    }
  },
  styleManager: {
    empty: 'Zaznacz element przed użyciem menedżera stylów',
    layer: 'Warstwa',
    fileButton: 'Obrazy',
    sectors: {
      general: 'Ogólne',
      layout: 'Układ',
      typography: 'Typografia',
      decorations: 'Dekoracje',
      extra: 'Dodatkowe',
      flex: 'Flex',
      dimension: 'Wymiary'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Rozmycie',
      'text-shadow-color': 'Kolor',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Rozmycie',
      'box-shadow-spread': 'Rozszerzenie',
      'box-shadow-color': 'Kolor',
      'box-shadow-type': 'Typ',
      'margin-top-sub': 'Góra',
      'margin-right-sub': 'Prawo',
      'margin-bottom-sub': 'Dół',
      'margin-left-sub': 'Lewo',
      'padding-top-sub': 'Góra',
      'padding-right-sub': 'Prawo',
      'padding-bottom-sub': 'Dół',
      'padding-left-sub': 'Lewo',
      'border-width-sub': 'Szerokość',
      'border-style-sub': 'Styl',
      'border-color-sub': 'Kolor',
      'border-top-left-radius-sub': 'Lewy górny róg',
      'border-top-right-radius-sub': 'Prawy górny róg',
      'border-bottom-right-radius-sub': 'Prawy dolny róg',
      'border-bottom-left-radius-sub': 'Lewy dolny róg',
      'transform-rotate-x': 'Obrót X',
      'transform-rotate-y': 'Obrót Y',
      'transform-rotate-z': 'Obrót Z',
      'transform-scale-x': 'Skalowanie X',
      'transform-scale-y': 'Skalowanie Y',
      'transform-scale-z': 'Skalowanie Z',
      'transition-property-sub': 'Właściwość',
      'transition-duration-sub': 'Czas trwania',
      'transition-timing-function-sub': 'Funkcja czasowa',
      'background-image-sub': 'Obraz',
      'background-repeat-sub': 'Powtarzanie',
      'background-position-sub': 'Położenie',
      'background-attachment-sub': 'Przewijanie tła',
      'background-size-sub': 'Rozmiar'
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
    empty: 'Zaznacz element przed użyciem menedżera atrybutów',
    label: 'Ustawienia komponentu',
    categories: {
      // categoryId: 'Category label',
    },
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
          placeholder: 'np. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'To okno',
          _blank: 'Nowe okno'
        }
      }
    }
  },
  storageManager: {
    recover: 'Czy chcesz przywrócić niezapisane zmiany?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Opływanie",
  "display": "Wyświetlanie",
  "position": "Pozycjonowanie",
  "top": "Góra",
  "right": "Prawo",
  "left": "Lewo",
  "bottom": "Dół",
  "width": "Szerokość",
  "height": "Wysokość",
  "max-width": "Maksymalna szerokość",
  "max-height": "Maksymalna wysokość",
  "margin": "Margines zewnętrzny",
  "margin-top": "Górny margines zewnętrzny",
  "margin-right": "Prawy margines zewnętrzny",
  "margin-left": "Lewy margines zewnętrzny",
  "margin-bottom": "Dolny margines zewnętrzny",
  "padding": "Odstęp wewnętrzny",
  "padding-top": "Górny odstęp wewnętrzny",
  "padding-left": "Lewy odstęp wewnętrzny",
  "padding-right": "Prawy odstęp wewnętrzny",
  "padding-bottom": "Dolny odstęp wewnętrzny",
  "font-family": "Rodzina czcionek",
  "font-size": "Rozmiar czcionki",
  "font-weight": "Grubość czcionki",
  "letter-spacing": "Odstępy między literami",
  "color": "Kolor",
  "line-height": "Wysokość linii",
  "text-align": "Wyrównanie tekstu",
  "text-shadow": "Cień tekstu",
  "border-top-left": "Obramowanie lewego górnego rogu",
  "border-top-right": "Obramowanie prawego górnego rogu",
  "border-bottom-left": "Obramowanie lewego dolnego rogu",
  "border-bottom-right": "Obramowanie prawego dolnego rogu",
  "border-radius-top-left": "Zaokrąglenie lewego górnego rogu",
  "border-radius-top-right": "Zaokrąglenie prawego górnego rogu",
  "border-radius-bottom-left": "Zaokrąglenie lewego dolnego rogu",
  "border-radius-bottom-right": "Zaokrąglenie prawego dolnego rogu",
  "border-radius": "Zaokrąglenie rogów",
  "border": "Obramowanie",
  "border-width": "Szerokość obramowania",
  "border-style": "Styl obramowania",
  "border-color": "Kolor obramowania",
  "box-shadow": "Cień elementu",
  "background": "Tło",
  "background-image": "Obraz tła",
  "background-repeat": "Powtarzanie tła",
  "background-position": "Położenie tła",
  "background-attachment": "Przewijanie tła",
  "background-size": "Rozmiar tła",
  "background-color": "Kolor tła",
  "transition": "Przejście",
  "transition-property": "Właściwość przejścia",
  "transition-duration": "Czas trwania przejścia",
  "transition-timing-function": "Funkcja czasowa przejścia",
  "perspective": "Perspektywa",
  "transform": "Transformacja",
  "flex-direction": "Kierunek Flex",
  "flex-wrap": "Zawijanie Flex",
  "justify-content": "Wyrównanie w osi głównej",
  "align-items": "Wyrównanie elementów",
  "align-content": "Wyrównanie zawartości",
  "order": "Kolejność",
  "flex-basis": "Bazowy rozmiar Flex",
  "flex-grow": "Współczynnik wzrostu Flex",
  "flex-shrink": "Współczynnik kurczenia Flex",
  "align-self": "Wyrównanie własne"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Tekst alternatywny",
  "title": "Tytuł",
  "href": "Łącze"
});
