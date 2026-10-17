
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'pvz. Tekstas čia'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Pridėti paveikslėlį',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Pasirinkti paveikslėlį',
    uploadTitle: 'Nuvilkite failus čia arba spustelėkite, kad įkeltumėte'
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
      '': 'Konteineris',
      wrapper: 'Puslapio turinys',
      text: 'Tekstas',
      comment: 'Komentaras',
      image: 'Paveikslėlis',
      video: 'Vaizdo įrašas',
      label: 'Etiketė',
      link: 'Nuoroda',
      map: 'Žemėlapis',
      tfoot: 'Lentelės poraštė',
      tbody: 'Lentelės turinys',
      thead: 'Lentelės antraštė',
      table: 'Lentelė',
      row: 'Lentelės eilutė',
      cell: 'Lentelės langelis'
    }
  },
  deviceManager: {
    device: 'Įrenginys',
    devices: {
      desktop: 'Kompiuteris',
      tablet: 'Planšetė',
      mobileLandscape: 'Mobilusis (horizontaliai)',
      mobilePortrait: 'Mobilusis (vertikaliai)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Peržiūra',
        fullscreen: 'Visas ekranas',
        'sw-visibility': 'Rodyti komponentus',
        'export-template': 'Rodyti kodą',
        'open-sm': 'Atidaryti stilių tvarkyklę',
        'open-tm': 'Nustatymai',
        'open-layers': 'Atidaryti sluoksnių tvarkyklę',
        'open-blocks': 'Atidaryti blokus'
      }
    }
  },
  selectorManager: {
    label: 'Klasės',
    selected: 'Pasirinkta',
    emptyState: '- Būsena -',
    states: {
      hover: 'Užvedus pelės žymeklį',
      active: 'Spustelėjus',
      'nth-of-type(2n)': 'Lyginiai / nelyginiai'
    }
  },
  styleManager: {
    empty: 'Prieš naudodami stilių tvarkyklę pasirinkite elementą',
    layer: 'Sluoksnis',
    fileButton: 'Paveikslėliai',
    sectors: {
      general: 'Bendrieji',
      layout: 'Išdėstymas',
      typography: 'Tipografija',
      decorations: 'Dekoracijos',
      extra: 'Papildoma',
      flex: 'Flex',
      dimension: 'Matmenys'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Suliejimas',
      'text-shadow-color': 'Spalva',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Suliejimas',
      'box-shadow-spread': 'Išplitimas',
      'box-shadow-color': 'Spalva',
      'box-shadow-type': 'Tipas',
      'margin-top-sub': 'Viršus',
      'margin-right-sub': 'Dešinė',
      'margin-bottom-sub': 'Apačia',
      'margin-left-sub': 'Kairė',
      'padding-top-sub': 'Viršus',
      'padding-right-sub': 'Dešinė',
      'padding-bottom-sub': 'Apačia',
      'padding-left-sub': 'Kairė',
      'border-width-sub': 'Plotis',
      'border-style-sub': 'Stilius',
      'border-color-sub': 'Spalva',
      'border-top-left-radius-sub': 'Viršutinis kairysis kampas',
      'border-top-right-radius-sub': 'Viršutinis dešinysis kampas',
      'border-bottom-right-radius-sub': 'Apatinis dešinysis kampas',
      'border-bottom-left-radius-sub': 'Apatinis kairysis kampas',
      'transform-rotate-x': 'Pasukimas pagal X ašį',
      'transform-rotate-y': 'Pasukimas pagal Y ašį',
      'transform-rotate-z': 'Pasukimas pagal Z ašį',
      'transform-scale-x': 'Mastelio keitimas pagal X ašį',
      'transform-scale-y': 'Mastelio keitimas pagal Y ašį',
      'transform-scale-z': 'Mastelio keitimas pagal Z ašį',
      'transition-property-sub': 'Savybė',
      'transition-duration-sub': 'Trukmė',
      'transition-timing-function-sub': 'Laiko funkcija',
      'background-image-sub': 'Paveikslėlis',
      'background-repeat-sub': 'Kartojimas',
      'background-position-sub': 'Padėtis',
      'background-attachment-sub': 'Fiksavimas',
      'background-size-sub': 'Dydis'
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
    empty: 'Prieš naudodami atributų tvarkyklę pasirinkite elementą',
    label: 'Komponento nustatymai',
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
          placeholder: 'pvz. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Šis langas',
          _blank: 'Naujas langas'
        }
      }
    }
  },
  storageManager: {
    recover: 'Ar norite atkurti neišsaugotus pakeitimus?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Apgaubimas",
  "display": "Rodymas",
  "position": "Padėtis",
  "top": "Viršus",
  "right": "Dešinė",
  "left": "Kairė",
  "bottom": "Apačia",
  "width": "Plotis",
  "height": "Aukštis",
  "max-width": "Didžiausias plotis",
  "max-height": "Didžiausias aukštis",
  "margin": "Išorinė paraštė",
  "margin-top": "Viršutinė išorinė paraštė",
  "margin-right": "Dešinioji išorinė paraštė",
  "margin-left": "Kairioji išorinė paraštė",
  "margin-bottom": "Apatinė išorinė paraštė",
  "padding": "Vidinė paraštė",
  "padding-top": "Viršutinė vidinė paraštė",
  "padding-left": "Kairioji vidinė paraštė",
  "padding-right": "Dešinioji vidinė paraštė",
  "padding-bottom": "Apatinė vidinė paraštė",
  "font-family": "Šriftų šeima",
  "font-size": "Šrifto dydis",
  "font-weight": "Šrifto storis",
  "letter-spacing": "Tarpai tarp raidžių",
  "color": "Spalva",
  "line-height": "Eilutės aukštis",
  "text-align": "Teksto lygiavimas",
  "text-shadow": "Teksto šešėlis",
  "border-top-left": "Viršutinis kairysis rėmelis",
  "border-top-right": "Viršutinis dešinysis rėmelis",
  "border-bottom-left": "Apatinis kairysis rėmelis",
  "border-bottom-right": "Apatinis dešinysis rėmelis",
  "border-radius-top-left": "Viršutinio kairiojo kampo užapvalinimas",
  "border-radius-top-right": "Viršutinio dešiniojo kampo užapvalinimas",
  "border-radius-bottom-left": "Apatinio kairiojo kampo užapvalinimas",
  "border-radius-bottom-right": "Apatinio dešiniojo kampo užapvalinimas",
  "border-radius": "Kampų užapvalinimas",
  "border": "Rėmelis",
  "border-width": "Rėmelio plotis",
  "border-style": "Rėmelio stilius",
  "border-color": "Rėmelio spalva",
  "box-shadow": "Elemento šešėlis",
  "background": "Fonas",
  "background-image": "Fono paveikslėlis",
  "background-repeat": "Fono kartojimas",
  "background-position": "Fono padėtis",
  "background-attachment": "Fono fiksavimas",
  "background-size": "Fono dydis",
  "background-color": "Fono spalva",
  "transition": "Perėjimas",
  "transition-property": "Perėjimo savybė",
  "transition-duration": "Perėjimo trukmė",
  "transition-timing-function": "Perėjimo laiko funkcija",
  "perspective": "Perspektyva",
  "transform": "Transformacija",
  "flex-direction": "Flex kryptis",
  "flex-wrap": "Flex elementų perkėlimas į kitą eilutę",
  "justify-content": "Turinio lygiavimas pagrindine ašimi",
  "align-items": "Elementų lygiavimas",
  "align-content": "Turinio lygiavimas",
  "order": "Eiliškumas",
  "flex-basis": "Flex bazinis dydis",
  "flex-grow": "Flex didėjimas",
  "flex-shrink": "Flex mažėjimas",
  "align-self": "Atskiras lygiavimas"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternatyvusis tekstas",
  "title": "Pavadinimas",
  "href": "Nuoroda"
});