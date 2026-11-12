
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'piem., Teksts šeit'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Pievienot attēlu',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Izvēlēties attēlu',
    uploadTitle: 'Ievelciet failus šeit vai noklikšķiniet, lai augšupielādētu'
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
      '': 'Konteiners',
      wrapper: 'Lapas pamatdaļa',
      text: 'Teksts',
      comment: 'Komentārs',
      image: 'Attēls',
      video: 'Video',
      label: 'Etiķete',
      link: 'Saite',
      map: 'Karte',
      tfoot: 'Tabulas kājene',
      tbody: 'Tabulas pamatdaļa',
      thead: 'Tabulas galvene',
      table: 'Tabula',
      row: 'Tabulas rinda',
      cell: 'Tabulas šūna'
    }
  },
  deviceManager: {
    device: 'Ierīce',
    devices: {
      desktop: 'Dators',
      tablet: 'Planšetdators',
      mobileLandscape: 'Mobilā ierīce (horizontāli)',
      mobilePortrait: 'Mobilā ierīce (vertikāli)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Priekšskatījums',
        fullscreen: 'Pilnekrāna režīms',
        'sw-visibility': 'Rādīt komponentus',
        'export-template': 'Rādīt kodu',
        'open-sm': 'Atvērt stilu pārvaldnieku',
        'open-tm': 'Iestatījumi',
        'open-layers': 'Atvērt slāņu pārvaldnieku',
        'open-blocks': 'Atvērt blokus'
      }
    }
  },
  selectorManager: {
    label: 'Klases',
    selected: 'Atlasīts',
    emptyState: '- Stāvoklis -',
    states: {
      hover: 'Novietojot kursoru virs',
      active: 'Noklikšķinot',
      'nth-of-type(2n)': 'Pāra/nepāra'
    }
  },
  styleManager: {
    empty: 'Pirms stilu pārvaldnieka izmantošanas atlasiet elementu',
    layer: 'Slānis',
    fileButton: 'Attēli',
    sectors: {
      general: 'Vispārīgi',
      layout: 'Izkārtojums',
      typography: 'Tipogrāfija',
      decorations: 'Dekorācijas',
      extra: 'Papildu',
      flex: 'Flex',
      dimension: 'Izmēri'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Izpludinājums',
      'text-shadow-color': 'Krāsa',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Izpludinājums',
      'box-shadow-spread': 'Izplešanās',
      'box-shadow-color': 'Krāsa',
      'box-shadow-type': 'Tips',
      'margin-top-sub': 'Augšā',
      'margin-right-sub': 'Pa labi',
      'margin-bottom-sub': 'Apakšā',
      'margin-left-sub': 'Pa kreisi',
      'padding-top-sub': 'Augšā',
      'padding-right-sub': 'Pa labi',
      'padding-bottom-sub': 'Apakšā',
      'padding-left-sub': 'Pa kreisi',
      'border-width-sub': 'Platums',
      'border-style-sub': 'Stils',
      'border-color-sub': 'Krāsa',
      'border-top-left-radius-sub': 'Augšējais kreisais stūris',
      'border-top-right-radius-sub': 'Augšējais labais stūris',
      'border-bottom-right-radius-sub': 'Apakšējais labais stūris',
      'border-bottom-left-radius-sub': 'Apakšējais kreisais stūris',
      'transform-rotate-x': 'Pagriešana ap X asi',
      'transform-rotate-y': 'Pagriešana ap Y asi',
      'transform-rotate-z': 'Pagriešana ap Z asi',
      'transform-scale-x': 'Mērogošana pa X asi',
      'transform-scale-y': 'Mērogošana pa Y asi',
      'transform-scale-z': 'Mērogošana pa Z asi',
      'transition-property-sub': 'Īpašība',
      'transition-duration-sub': 'Ilgums',
      'transition-timing-function-sub': 'Laika funkcija',
      'background-image-sub': 'Attēls',
      'background-repeat-sub': 'Atkārtošana',
      'background-position-sub': 'Novietojums',
      'background-attachment-sub': 'Piesaistīšana',
      'background-size-sub': 'Izmērs'
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
    empty: 'Pirms atribūtu pārvaldnieka izmantošanas atlasiet elementu',
    label: 'Komponenta iestatījumi',
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
          placeholder: 'piem., https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Šis logs',
          _blank: 'Jauns logs'
        }
      }
    }
  },
  storageManager: {
    recover: 'Vai vēlaties atjaunot nesaglabātās izmaiņas?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Aplūšana",
  "display": "Attēlošana",
  "position": "Novietojums",
  "top": "Augša",
  "right": "Labā puse",
  "left": "Kreisā puse",
  "bottom": "Apakša",
  "width": "Platums",
  "height": "Augstums",
  "max-width": "Maksimālais platums",
  "max-height": "Maksimālais augstums",
  "margin": "Ārējā atkāpe",
  "margin-top": "Augšējā ārējā atkāpe",
  "margin-right": "Labās puses ārējā atkāpe",
  "margin-left": "Kreisās puses ārējā atkāpe",
  "margin-bottom": "Apakšējā ārējā atkāpe",
  "padding": "Iekšējā atkāpe",
  "padding-top": "Augšējā iekšējā atkāpe",
  "padding-left": "Kreisās puses iekšējā atkāpe",
  "padding-right": "Labās puses iekšējā atkāpe",
  "padding-bottom": "Apakšējā iekšējā atkāpe",
  "font-family": "Fontu saime",
  "font-size": "Fonta lielums",
  "font-weight": "Fonta biezums",
  "letter-spacing": "Atstarpe starp burtiem",
  "color": "Krāsa",
  "line-height": "Rindas augstums",
  "text-align": "Teksta līdzinājums",
  "text-shadow": "Teksta ēna",
  "border-top-left": "Apmale augšējā kreisajā stūrī",
  "border-top-right": "Apmale augšējā labajā stūrī",
  "border-bottom-left": "Apmale apakšējā kreisajā stūrī",
  "border-bottom-right": "Apmale apakšējā labajā stūrī",
  "border-radius-top-left": "Augšējā kreisā stūra noapaļojums",
  "border-radius-top-right": "Augšējā labā stūra noapaļojums",
  "border-radius-bottom-left": "Apakšējā kreisā stūra noapaļojums",
  "border-radius-bottom-right": "Apakšējā labā stūra noapaļojums",
  "border-radius": "Stūru noapaļojums",
  "border": "Apmale",
  "border-width": "Apmales platums",
  "border-style": "Apmales stils",
  "border-color": "Apmales krāsa",
  "box-shadow": "Elementa ēna",
  "background": "Fons",
  "background-image": "Fona attēls",
  "background-repeat": "Fona atkārtošana",
  "background-position": "Fona novietojums",
  "background-attachment": "Fona piesaiste",
  "background-size": "Fona izmērs",
  "background-color": "Fona krāsa",
  "transition": "Pāreja",
  "transition-property": "Pārejas īpašība",
  "transition-duration": "Pārejas ilgums",
  "transition-timing-function": "Pārejas laika funkcija",
  "perspective": "Perspektīva",
  "transform": "Transformācija",
  "flex-direction": "Flex virziens",
  "flex-wrap": "Flex elementu pārnešana jaunā rindā",
  "justify-content": "Satura līdzināšana pa galveno asi",
  "align-items": "Elementu līdzināšana",
  "align-content": "Satura līdzināšana",
  "order": "Secība",
  "flex-basis": "Flex pamatizmērs",
  "flex-grow": "Flex palielināšana",
  "flex-shrink": "Flex samazināšana",
  "align-self": "Atsevišķa elementa līdzināšana"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternatīvais teksts",
  "title": "Virsraksts",
  "href": "Saite"
});