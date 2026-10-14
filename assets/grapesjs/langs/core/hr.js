
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'npr. Tekst ovdje'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Dodaj sliku',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Odaberi sliku',
    uploadTitle: 'Povucite datoteke ovdje ili kliknite za prijenos'
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
      wrapper: 'Tijelo stranice',
      text: 'Tekst',
      comment: 'Komentar',
      image: 'Slika',
      video: 'Videozapis',
      label: 'Oznaka',
      link: 'Poveznica',
      map: 'Karta',
      tfoot: 'Podnožje tablice',
      tbody: 'Tijelo tablice',
      thead: 'Zaglavlje tablice',
      table: 'Tablica',
      row: 'Redak tablice',
      cell: 'Ćelija tablice'
    }
  },
  deviceManager: {
    device: 'Uređaj',
    devices: {
      desktop: 'Računalo',
      tablet: 'Tablet',
      mobileLandscape: 'Mobitel (vodoravno)',
      mobilePortrait: 'Mobitel (okomito)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Pregled',
        fullscreen: 'Cijeli zaslon',
        'sw-visibility': 'Prikaži komponente',
        'export-template': 'Prikaži kod',
        'open-sm': 'Otvori upravitelj stilova',
        'open-tm': 'Postavke',
        'open-layers': 'Otvori upravitelj slojeva',
        'open-blocks': 'Otvori blokove'
      }
    }
  },
  selectorManager: {
    label: 'Klase',
    selected: 'Odabrano',
    emptyState: '- Stanje -',
    states: {
      hover: 'Prelazak pokazivačem',
      active: 'Klik',
      'nth-of-type(2n)': 'Parno/neparno'
    }
  },
  styleManager: {
    empty: 'Odaberite element prije korištenja upravitelja stilova',
    layer: 'Sloj',
    fileButton: 'Slike',
    sectors: {
      general: 'Općenito',
      layout: 'Raspored',
      typography: 'Tipografija',
      decorations: 'Ukrašavanje',
      extra: 'Dodatno',
      flex: 'Flex',
      dimension: 'Dimenzije'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Zamućenje',
      'text-shadow-color': 'Boja',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Zamućenje',
      'box-shadow-spread': 'Širenje',
      'box-shadow-color': 'Boja',
      'box-shadow-type': 'Vrsta',
      'margin-top-sub': 'Gore',
      'margin-right-sub': 'Desno',
      'margin-bottom-sub': 'Dolje',
      'margin-left-sub': 'Lijevo',
      'padding-top-sub': 'Gore',
      'padding-right-sub': 'Desno',
      'padding-bottom-sub': 'Dolje',
      'padding-left-sub': 'Lijevo',
      'border-width-sub': 'Širina',
      'border-style-sub': 'Stil',
      'border-color-sub': 'Boja',
      'border-top-left-radius-sub': 'Gore lijevo',
      'border-top-right-radius-sub': 'Gore desno',
      'border-bottom-right-radius-sub': 'Dolje desno',
      'border-bottom-left-radius-sub': 'Dolje lijevo',
      'transform-rotate-x': 'Rotacija X',
      'transform-rotate-y': 'Rotacija Y',
      'transform-rotate-z': 'Rotacija Z',
      'transform-scale-x': 'Skaliranje X',
      'transform-scale-y': 'Skaliranje Y',
      'transform-scale-z': 'Skaliranje Z',
      'transition-property-sub': 'Svojstvo',
      'transition-duration-sub': 'Trajanje',
      'transition-timing-function-sub': 'Vremenska funkcija',
      'background-image-sub': 'Slika',
      'background-repeat-sub': 'Ponavljanje',
      'background-position-sub': 'Položaj',
      'background-attachment-sub': 'Pričvršćivanje',
      'background-size-sub': 'Veličina'
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
    empty: 'Odaberite element prije korištenja upravitelja atributa',
    label: 'Postavke komponente',
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
          false: 'Ovaj prozor',
          _blank: 'Novi prozor'
        }
      }
    }
  },
  storageManager: {
    recover: 'Želite li vratiti nespremljene promjene?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Plutanje",
  "display": "Prikaz",
  "position": "Položaj",
  "top": "Gore",
  "right": "Desno",
  "left": "Lijevo",
  "bottom": "Dolje",
  "width": "Širina",
  "height": "Visina",
  "max-width": "Širina (max.)",
  "max-height": "Visina (max.)",
  "margin": "Margina",
  "margin-top": "Margina: gore",
  "margin-right": "Margina: desno",
  "margin-left": "Margina: lijevo",
  "margin-bottom": "Margina: dolje",
  "padding": "Unutarnji razmak",
  "padding-top": "Unutarnji razmak: gore",
  "padding-left": "Unutarnji razmak: lijevo",
  "padding-right": "Unutarnji razmak: desno",
  "padding-bottom": "Unutarnji razmak: dolje",
  "font-family": "Font: obitelj",
  "font-size": "Font: veličina",
  "font-weight": "Font: debljina",
  "letter-spacing": "Slova: razmak",
  "color": "Boja",
  "line-height": "Redak: visina",
  "text-align": "Tekst: poravnanje",
  "text-shadow": "Tekst: sjena",
  "border-top-left": "Obrub: gore · lijevo",
  "border-top-right": "Obrub: gore · desno",
  "border-bottom-left": "Obrub: dolje · lijevo",
  "border-bottom-right": "Obrub: dolje · desno",
  "border-radius-top-left": "Obrub: polumjer · gore · lijevo",
  "border-radius-top-right": "Obrub: polumjer · gore · desno",
  "border-radius-bottom-left": "Obrub: polumjer · dolje · lijevo",
  "border-radius-bottom-right": "Obrub: polumjer · dolje · desno",
  "border-radius": "Obrub: polumjer",
  "border": "Obrub",
  "border-width": "Obrub: širina",
  "border-style": "Obrub: stil",
  "border-color": "Obrub: boja",
  "box-shadow": "Okvir: sjena",
  "background": "Pozadina",
  "background-image": "Pozadina: slika",
  "background-repeat": "Pozadina: ponavljanje",
  "background-position": "Pozadina: položaj",
  "background-attachment": "Pozadina: povezivanje",
  "background-size": "Pozadina: veličina",
  "background-color": "Pozadina: boja",
  "transition": "Prijelaz",
  "transition-property": "Prijelaz: svojstvo",
  "transition-duration": "Prijelaz: trajanje",
  "transition-timing-function": "Prijelaz: vremenski raspored",
  "perspective": "Perspektiva",
  "transform": "Transformacija",
  "flex-direction": "Flex: smjer",
  "flex-wrap": "Flex: prelamanje",
  "justify-content": "Raspodjela: sadržaj",
  "align-items": "Poravnanje: stavke",
  "align-content": "Poravnanje: sadržaj",
  "order": "Redoslijed",
  "flex-basis": "Flex: osnova",
  "flex-grow": "Flex: rast",
  "flex-shrink": "Flex: smanjenje",
  "align-self": "Poravnanje: vlastito"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternativni tekst",
  "title": "Naslov",
  "href": "Poveznica"
});
