
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'f.eks. Tekst her'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Tilføj billede',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Vælg billede',
    uploadTitle: 'Træk filer hertil, eller klik for at uploade'
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
      '': 'Boks',
      wrapper: 'Sideindhold',
      text: 'Tekst',
      comment: 'Kommentar',
      image: 'Billede',
      video: 'Video',
      label: 'Etiket',
      link: 'Link',
      map: 'Kort',
      tfoot: 'Tabelfod',
      tbody: 'Tabelindhold',
      thead: 'Tabelhoved',
      table: 'Tabel',
      row: 'Tabelrække',
      cell: 'Tabelcelle'
    }
  },
  deviceManager: {
    device: 'Enhed',
    devices: {
      desktop: 'Computer',
      tablet: 'Tablet',
      mobileLandscape: 'Mobil (liggende)',
      mobilePortrait: 'Mobil (stående)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Forhåndsvisning',
        fullscreen: 'Fuld skærm',
        'sw-visibility': 'Vis komponenter',
        'export-template': 'Vis kode',
        'open-sm': 'Åbn stilhåndtering',
        'open-tm': 'Indstillinger',
        'open-layers': 'Åbn laghåndtering',
        'open-blocks': 'Åbn blokke'
      }
    }
  },
  selectorManager: {
    label: 'Klasser',
    selected: 'Valgt',
    emptyState: '- Tilstand -',
    states: {
      hover: 'Når musen holdes over',
      active: 'Ved klik',
      'nth-of-type(2n)': 'Lige/ulige'
    }
  },
  styleManager: {
    empty: 'Vælg et element, før du bruger stilhåndtering',
    layer: 'Lag',
    fileButton: 'Billeder',
    sectors: {
      general: 'Generelt',
      layout: 'Layout',
      typography: 'Typografi',
      decorations: 'Dekorationer',
      extra: 'Ekstra',
      flex: 'Flex',
      dimension: 'Dimensioner'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Sløring',
      'text-shadow-color': 'Farve',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Sløring',
      'box-shadow-spread': 'Spredning',
      'box-shadow-color': 'Farve',
      'box-shadow-type': 'Type',
      'margin-top-sub': 'Øverst',
      'margin-right-sub': 'Højre',
      'margin-bottom-sub': 'Nederst',
      'margin-left-sub': 'Venstre',
      'padding-top-sub': 'Øverst',
      'padding-right-sub': 'Højre',
      'padding-bottom-sub': 'Nederst',
      'padding-left-sub': 'Venstre',
      'border-width-sub': 'Bredde',
      'border-style-sub': 'Stil',
      'border-color-sub': 'Farve',
      'border-top-left-radius-sub': 'Øverst til venstre',
      'border-top-right-radius-sub': 'Øverst til højre',
      'border-bottom-right-radius-sub': 'Nederst til højre',
      'border-bottom-left-radius-sub': 'Nederst til venstre',
      'transform-rotate-x': 'Rotation X',
      'transform-rotate-y': 'Rotation Y',
      'transform-rotate-z': 'Rotation Z',
      'transform-scale-x': 'Skalering X',
      'transform-scale-y': 'Skalering Y',
      'transform-scale-z': 'Skalering Z',
      'transition-property-sub': 'Egenskab',
      'transition-duration-sub': 'Varighed',
      'transition-timing-function-sub': 'Timing',
      'background-image-sub': 'Billede',
      'background-repeat-sub': 'Gentagelse',
      'background-position-sub': 'Placering',
      'background-attachment-sub': 'Fastgørelse',
      'background-size-sub': 'Størrelse'
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
    empty: 'Vælg et element, før du bruger egenskabshåndtering',
    label: 'Komponentindstillinger',
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
          placeholder: 'f.eks. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Dette vindue',
          _blank: 'Nyt vindue'
        }
      }
    }
  },
  storageManager: {
    recover: 'Vil du gendanne ændringer, der ikke er gemt?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Flydende placering",
  "display": "Visning",
  "position": "Placering",
  "top": "Øverst",
  "right": "Højre",
  "left": "Venstre",
  "bottom": "Nederst",
  "width": "Bredde",
  "height": "Højde",
  "max-width": "Maksimal bredde",
  "max-height": "Maksimal højde",
  "margin": "Ydre margen",
  "margin-top": "Ydre margen øverst",
  "margin-right": "Ydre margen til højre",
  "margin-left": "Ydre margen til venstre",
  "margin-bottom": "Ydre margen nederst",
  "padding": "Indvendig margen",
  "padding-top": "Indvendig margen øverst",
  "padding-left": "Indvendig margen til venstre",
  "padding-right": "Indvendig margen til højre",
  "padding-bottom": "Indvendig margen nederst",
  "font-family": "Skrifttype",
  "font-size": "Skriftstørrelse",
  "font-weight": "Skrifttykkelse",
  "letter-spacing": "Bogstavafstand",
  "color": "Farve",
  "line-height": "Linjehøjde",
  "text-align": "Tekstjustering",
  "text-shadow": "Tekstskygge",
  "border-top-left": "Kant øverst til venstre",
  "border-top-right": "Kant øverst til højre",
  "border-bottom-left": "Kant nederst til venstre",
  "border-bottom-right": "Kant nederst til højre",
  "border-radius-top-left": "Hjørneafrunding øverst til venstre",
  "border-radius-top-right": "Hjørneafrunding øverst til højre",
  "border-radius-bottom-left": "Hjørneafrunding nederst til venstre",
  "border-radius-bottom-right": "Hjørneafrunding nederst til højre",
  "border-radius": "Hjørneafrunding",
  "border": "Kant",
  "border-width": "Kantbredde",
  "border-style": "Kantstil",
  "border-color": "Kantfarve",
  "box-shadow": "Boksskygge",
  "background": "Baggrund",
  "background-image": "Baggrundsbillede",
  "background-repeat": "Gentagelse af baggrund",
  "background-position": "Baggrundsplacering",
  "background-attachment": "Fastgørelse af baggrund",
  "background-size": "Baggrundsstørrelse",
  "background-color": "Baggrundsfarve",
  "transition": "Overgang",
  "transition-property": "Overgangsegenskab",
  "transition-duration": "Overgangsvarighed",
  "transition-timing-function": "Overgangens tidsfunktion",
  "perspective": "Perspektiv",
  "transform": "Transformation",
  "flex-direction": "Flex-retning",
  "flex-wrap": "Flex-ombrydning",
  "justify-content": "Justering af indhold",
  "align-items": "Justering af elementer",
  "align-content": "Justering af indhold på tværaksen",
  "order": "Rækkefølge",
  "flex-basis": "Flex-basis",
  "flex-grow": "Flex-vækst",
  "flex-shrink": "Flex-krympning",
  "align-self": "Selvjustering"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternativ tekst",
  "title": "Titel",
  "href": "Link"
});