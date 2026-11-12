
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'npr. Besedilo tukaj'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Dodaj sliko',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Izberi sliko',
    uploadTitle: 'Povlecite datoteke sem ali kliknite za nalaganje'
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
      '': 'Okvir',
      wrapper: 'Telo strani',
      text: 'Besedilo',
      comment: 'Komentar',
      image: 'Slika',
      video: 'Video',
      label: 'Oznaka',
      link: 'Povezava',
      map: 'Zemljevid',
      tfoot: 'Noga tabele',
      tbody: 'Telo tabele',
      thead: 'Glava tabele',
      table: 'Tabela',
      row: 'Vrstica tabele',
      cell: 'Celica tabele'
    }
  },
  deviceManager: {
    device: 'Naprava',
    devices: {
      desktop: 'Namizni računalnik',
      tablet: 'Tablični računalnik',
      mobileLandscape: 'Mobilna naprava (ležeče)',
      mobilePortrait: 'Mobilna naprava (pokončno)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Predogled',
        fullscreen: 'Celozaslonski način',
        'sw-visibility': 'Prikaži komponente',
        'export-template': 'Prikaži kodo',
        'open-sm': 'Odpri upravljalnik slogov',
        'open-tm': 'Nastavitve',
        'open-layers': 'Odpri upravljalnik plasti',
        'open-blocks': 'Odpri bloke'
      }
    }
  },
  selectorManager: {
    label: 'Razredi',
    selected: 'Izbrano',
    emptyState: '- Stanje -',
    states: {
      hover: 'Ob prehodu kazalca',
      active: 'Ob kliku',
      'nth-of-type(2n)': 'Sodo/liho'
    }
  },
  styleManager: {
    empty: 'Pred uporabo upravljalnika slogov izberite element',
    layer: 'Plast',
    fileButton: 'Slike',
    sectors: {
      general: 'Splošno',
      layout: 'Postavitev',
      typography: 'Tipografija',
      decorations: 'Dekoracije',
      extra: 'Dodatno',
      flex: 'Flex',
      dimension: 'Dimenzije'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Zameglitev',
      'text-shadow-color': 'Barva',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Zameglitev',
      'box-shadow-spread': 'Razširitev',
      'box-shadow-color': 'Barva',
      'box-shadow-type': 'Vrsta',
      'margin-top-sub': 'Zgoraj',
      'margin-right-sub': 'Desno',
      'margin-bottom-sub': 'Spodaj',
      'margin-left-sub': 'Levo',
      'padding-top-sub': 'Zgoraj',
      'padding-right-sub': 'Desno',
      'padding-bottom-sub': 'Spodaj',
      'padding-left-sub': 'Levo',
      'border-width-sub': 'Širina',
      'border-style-sub': 'Slog',
      'border-color-sub': 'Barva',
      'border-top-left-radius-sub': 'Zgornji levi kot',
      'border-top-right-radius-sub': 'Zgornji desni kot',
      'border-bottom-right-radius-sub': 'Spodnji desni kot',
      'border-bottom-left-radius-sub': 'Spodnji levi kot',
      'transform-rotate-x': 'Vrtenje X',
      'transform-rotate-y': 'Vrtenje Y',
      'transform-rotate-z': 'Vrtenje Z',
      'transform-scale-x': 'Skaliranje X',
      'transform-scale-y': 'Skaliranje Y',
      'transform-scale-z': 'Skaliranje Z',
      'transition-property-sub': 'Lastnost',
      'transition-duration-sub': 'Trajanje',
      'transition-timing-function-sub': 'Časovni potek',
      'background-image-sub': 'Slika',
      'background-repeat-sub': 'Ponavljanje',
      'background-position-sub': 'Položaj',
      'background-attachment-sub': 'Pritrditev',
      'background-size-sub': 'Velikost'
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
    empty: 'Pred uporabo upravljalnika atributov izberite element',
    label: 'Nastavitve komponente',
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
          placeholder: 'npr. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'To okno',
          _blank: 'Novo okno'
        }
      }
    }
  },
  storageManager: {
    recover: 'Ali želite obnoviti neshranjene spremembe?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Obtekanje",
  "display": "Prikaz",
  "position": "Položaj",
  "top": "Zgoraj",
  "right": "Desno",
  "left": "Levo",
  "bottom": "Spodaj",
  "width": "Širina",
  "height": "Višina",
  "max-width": "Največja širina",
  "max-height": "Največja višina",
  "margin": "Zunanji odmik",
  "margin-top": "Zgornji zunanji odmik",
  "margin-right": "Desni zunanji odmik",
  "margin-left": "Levi zunanji odmik",
  "margin-bottom": "Spodnji zunanji odmik",
  "padding": "Notranji odmik",
  "padding-top": "Zgornji notranji odmik",
  "padding-left": "Levi notranji odmik",
  "padding-right": "Desni notranji odmik",
  "padding-bottom": "Spodnji notranji odmik",
  "font-family": "Družina pisav",
  "font-size": "Velikost pisave",
  "font-weight": "Debelina pisave",
  "letter-spacing": "Razmik med črkami",
  "color": "Barva",
  "line-height": "Višina vrstice",
  "text-align": "Poravnava besedila",
  "text-shadow": "Senca besedila",
  "border-top-left": "Zgornja leva obroba",
  "border-top-right": "Zgornja desna obroba",
  "border-bottom-left": "Spodnja leva obroba",
  "border-bottom-right": "Spodnja desna obroba",
  "border-radius-top-left": "Zaobljenost zgornjega levega kota",
  "border-radius-top-right": "Zaobljenost zgornjega desnega kota",
  "border-radius-bottom-left": "Zaobljenost spodnjega levega kota",
  "border-radius-bottom-right": "Zaobljenost spodnjega desnega kota",
  "border-radius": "Zaobljenost vogalov",
  "border": "Obroba",
  "border-width": "Debelina obrobe",
  "border-style": "Slog obrobe",
  "border-color": "Barva obrobe",
  "box-shadow": "Senca elementa",
  "background": "Ozadje",
  "background-image": "Slika ozadja",
  "background-repeat": "Ponavljanje ozadja",
  "background-position": "Položaj ozadja",
  "background-attachment": "Pritrditev ozadja",
  "background-size": "Velikost ozadja",
  "background-color": "Barva ozadja",
  "transition": "Prehod",
  "transition-property": "Lastnost prehoda",
  "transition-duration": "Trajanje prehoda",
  "transition-timing-function": "Časovni potek prehoda",
  "perspective": "Perspektiva",
  "transform": "Transformacija",
  "flex-direction": "Smer Flex",
  "flex-wrap": "Prelamljanje Flex",
  "justify-content": "Razporeditev vsebine",
  "align-items": "Poravnava elementov",
  "align-content": "Poravnava vsebine",
  "order": "Vrstni red",
  "flex-basis": "Osnovna velikost Flex",
  "flex-grow": "Razširjanje Flex",
  "flex-shrink": "Krčenje Flex",
  "align-self": "Samostojna poravnava"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Nadomestno besedilo",
  "title": "Naslov",
  "href": "Povezava"
});