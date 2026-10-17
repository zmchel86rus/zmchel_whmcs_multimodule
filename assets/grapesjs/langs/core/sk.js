"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'napr. Sem zadajte text'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Pridať obrázok',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Vybrať obrázok',
    uploadTitle: 'Presuňte sem súbory alebo kliknite na nahratie'
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
      '': 'Kontajner',
      wrapper: 'Telo stránky',
      text: 'Text',
      comment: 'Komentár',
      image: 'Obrázok',
      video: 'Video',
      label: 'Popisok',
      link: 'Odkaz',
      map: 'Mapa',
      tfoot: 'Päta tabuľky',
      tbody: 'Telo tabuľky',
      thead: 'Hlavička tabuľky',
      table: 'Tabuľka',
      row: 'Riadok tabuľky',
      cell: 'Bunka tabuľky'
    }
  },
  deviceManager: {
    device: 'Zariadenie',
    devices: {
      desktop: 'Počítač',
      tablet: 'Tablet',
      mobileLandscape: 'Mobil (na šírku)',
      mobilePortrait: 'Mobil (na výšku)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Náhľad',
        fullscreen: 'Celá obrazovka',
        'sw-visibility': 'Zobraziť komponenty',
        'export-template': 'Zobraziť kód',
        'open-sm': 'Otvoriť správcu štýlov',
        'open-tm': 'Nastavenia',
        'open-layers': 'Otvoriť správcu vrstiev',
        'open-blocks': 'Otvoriť bloky'
      }
    }
  },
  selectorManager: {
    label: 'Triedy',
    selected: 'Vybrané',
    emptyState: '- Stav -',
    states: {
      hover: 'Pri prejdení myšou',
      active: 'Pri kliknutí',
      'nth-of-type(2n)': 'Párne/nepárne'
    }
  },
  styleManager: {
    empty: 'Pred použitím správcu štýlov vyberte prvok',
    layer: 'Vrstva',
    fileButton: 'Obrázky',
    sectors: {
      general: 'Všeobecné',
      layout: 'Rozloženie',
      typography: 'Typografia',
      decorations: 'Dekorácie',
      extra: 'Doplnkové',
      flex: 'Flex',
      dimension: 'Rozmery'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Rozmazanie',
      'text-shadow-color': 'Farba',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Rozmazanie',
      'box-shadow-spread': 'Rozšírenie',
      'box-shadow-color': 'Farba',
      'box-shadow-type': 'Typ',
      'margin-top-sub': 'Hore',
      'margin-right-sub': 'Vpravo',
      'margin-bottom-sub': 'Dole',
      'margin-left-sub': 'Vľavo',
      'padding-top-sub': 'Hore',
      'padding-right-sub': 'Vpravo',
      'padding-bottom-sub': 'Dole',
      'padding-left-sub': 'Vľavo',
      'border-width-sub': 'Šírka',
      'border-style-sub': 'Štýl',
      'border-color-sub': 'Farba',
      'border-top-left-radius-sub': 'Ľavý horný roh',
      'border-top-right-radius-sub': 'Pravý horný roh',
      'border-bottom-right-radius-sub': 'Pravý dolný roh',
      'border-bottom-left-radius-sub': 'Ľavý dolný roh',
      'transform-rotate-x': 'Otočenie X',
      'transform-rotate-y': 'Otočenie Y',
      'transform-rotate-z': 'Otočenie Z',
      'transform-scale-x': 'Mierka X',
      'transform-scale-y': 'Mierka Y',
      'transform-scale-z': 'Mierka Z',
      'transition-property-sub': 'Vlastnosť',
      'transition-duration-sub': 'Trvanie',
      'transition-timing-function-sub': 'Časovanie',
      'background-image-sub': 'Obrázok',
      'background-repeat-sub': 'Opakovanie',
      'background-position-sub': 'Pozícia',
      'background-attachment-sub': 'Ukotvenie',
      'background-size-sub': 'Veľkosť'
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
    empty: 'Pred použitím správcu atribútov vyberte prvok',
    label: 'Nastavenia komponentu',
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
          placeholder: 'napr. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Toto okno',
          _blank: 'Nové okno'
        }
      }
    }
  },
  storageManager: {
    recover: 'Chcete obnoviť neuložené zmeny?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Obtekanie",
  "display": "Zobrazenie",
  "position": "Pozícia",
  "top": "Hore",
  "right": "Vpravo",
  "left": "Vľavo",
  "bottom": "Dole",
  "width": "Šírka",
  "height": "Výška",
  "max-width": "Maximálna šírka",
  "max-height": "Maximálna výška",
  "margin": "Vonkajší okraj",
  "margin-top": "Horný vonkajší okraj",
  "margin-right": "Pravý vonkajší okraj",
  "margin-left": "Ľavý vonkajší okraj",
  "margin-bottom": "Dolný vonkajší okraj",
  "padding": "Vnútorný okraj",
  "padding-top": "Horný vnútorný okraj",
  "padding-left": "Ľavý vnútorný okraj",
  "padding-right": "Pravý vnútorný okraj",
  "padding-bottom": "Dolný vnútorný okraj",
  "font-family": "Rodina písiem",
  "font-size": "Veľkosť písma",
  "font-weight": "Hrúbka písma",
  "letter-spacing": "Rozstupy medzi písmenami",
  "color": "Farba",
  "line-height": "Výška riadka",
  "text-align": "Zarovnanie textu",
  "text-shadow": "Tieň textu",
  "border-top-left": "Ohraničenie vľavo hore",
  "border-top-right": "Ohraničenie vpravo hore",
  "border-bottom-left": "Ohraničenie vľavo dole",
  "border-bottom-right": "Ohraničenie vpravo dole",
  "border-radius-top-left": "Zaoblenie ľavého horného rohu",
  "border-radius-top-right": "Zaoblenie pravého horného rohu",
  "border-radius-bottom-left": "Zaoblenie ľavého dolného rohu",
  "border-radius-bottom-right": "Zaoblenie pravého dolného rohu",
  "border-radius": "Zaoblenie rohov",
  "border": "Ohraničenie",
  "border-width": "Šírka ohraničenia",
  "border-style": "Štýl ohraničenia",
  "border-color": "Farba ohraničenia",
  "box-shadow": "Tieň prvku",
  "background": "Pozadie",
  "background-image": "Obrázok pozadia",
  "background-repeat": "Opakovanie pozadia",
  "background-position": "Pozícia pozadia",
  "background-attachment": "Ukotvenie pozadia",
  "background-size": "Veľkosť pozadia",
  "background-color": "Farba pozadia",
  "transition": "Prechod",
  "transition-property": "Vlastnosť prechodu",
  "transition-duration": "Trvanie prechodu",
  "transition-timing-function": "Časovanie prechodu",
  "perspective": "Perspektíva",
  "transform": "Transformácia",
  "flex-direction": "Smer rozloženia Flex",
  "flex-wrap": "Zalamovanie Flex",
  "justify-content": "Zarovnanie obsahu na hlavnej osi",
  "align-items": "Zarovnanie prvkov",
  "align-content": "Zarovnanie obsahu",
  "order": "Poradie",
  "flex-basis": "Základná veľkosť Flex",
  "flex-grow": "Rast Flex",
  "flex-shrink": "Zmenšovanie Flex",
  "align-self": "Vlastné zarovnanie"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternatívny text",
  "title": "Názov",
  "href": "Odkaz"
});