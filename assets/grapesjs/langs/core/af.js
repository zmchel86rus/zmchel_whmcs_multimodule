
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'bv. Teks hier'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Voeg prent by',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Kies prent',
    uploadTitle: 'Sleep lêers hierheen of klik om op te laai'
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
      wrapper: 'Bladsyinhoud',
      text: 'Teks',
      comment: 'Kommentaar',
      image: 'Prent',
      video: 'Video',
      label: 'Etiket',
      link: 'Skakel',
      map: 'Kaart',
      tfoot: 'Tabelvoetskrif',
      tbody: 'Tabelinhoud',
      thead: 'Tabelopskrif',
      table: 'Tabel',
      row: 'Tabelry',
      cell: 'Tabelsel'
    }
  },
  deviceManager: {
    device: 'Toestel',
    devices: {
      desktop: 'Rekenaar',
      tablet: 'Tablet',
      mobileLandscape: 'Selfoon (horisontaal)',
      mobilePortrait: 'Selfoon (vertikaal)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Voorskou',
        fullscreen: 'Volskerm',
        'sw-visibility': 'Wys komponente',
        'export-template': 'Wys kode',
        'open-sm': 'Maak stylbestuurder oop',
        'open-tm': 'Instellings',
        'open-layers': 'Maak laagbestuurder oop',
        'open-blocks': 'Maak blokke oop'
      }
    }
  },
  selectorManager: {
    label: 'Klasse',
    selected: 'Gekies',
    emptyState: '- Toestand -',
    states: {
      hover: 'Wanneer die muiswyser daaroor beweeg',
      active: 'By klik',
      'nth-of-type(2n)': 'Ewe/onewe'
    }
  },
  styleManager: {
    empty: 'Kies eers ’n element voordat jy die stylbestuurder gebruik',
    layer: 'Laag',
    fileButton: 'Prente',
    sectors: {
      general: 'Algemeen',
      layout: 'Uitleg',
      typography: 'Tipografie',
      decorations: 'Versierings',
      extra: 'Ekstra',
      flex: 'Flex-eienskappe',
      dimension: 'Afmetings'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Vervaging',
      'text-shadow-color': 'Kleur',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Vervaging',
      'box-shadow-spread': 'Verspreiding',
      'box-shadow-color': 'Kleur',
      'box-shadow-type': 'Tipe',
      'margin-top-sub': 'Bo',
      'margin-right-sub': 'Regs',
      'margin-bottom-sub': 'Onder',
      'margin-left-sub': 'Links',
      'padding-top-sub': 'Bo',
      'padding-right-sub': 'Regs',
      'padding-bottom-sub': 'Onder',
      'padding-left-sub': 'Links',
      'border-width-sub': 'Breedte',
      'border-style-sub': 'Styl',
      'border-color-sub': 'Kleur',
      'border-top-left-radius-sub': 'Links bo',
      'border-top-right-radius-sub': 'Regs bo',
      'border-bottom-right-radius-sub': 'Regs onder',
      'border-bottom-left-radius-sub': 'Links onder',
      'transform-rotate-x': 'Draai X',
      'transform-rotate-y': 'Draai Y',
      'transform-rotate-z': 'Draai Z',
      'transform-scale-x': 'Skaal X',
      'transform-scale-y': 'Skaal Y',
      'transform-scale-z': 'Skaal Z',
      'transition-property-sub': 'Eienskap',
      'transition-duration-sub': 'Tydsduur',
      'transition-timing-function-sub': 'Tydsberekening',
      'background-image-sub': 'Prent',
      'background-repeat-sub': 'Herhaling',
      'background-position-sub': 'Posisie',
      'background-attachment-sub': 'Vashegting',
      'background-size-sub': 'Grootte'
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
    empty: 'Kies eers ’n element voordat jy die attribuutbestuurder gebruik',
    label: 'Komponentinstellings',
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
          placeholder: 'bv. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Hierdie venster',
          _blank: 'Nuwe venster'
        }
      }
    }
  },
  storageManager: {
    recover: 'Wil jy ongestoorde veranderinge herstel?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Omvloeiing",
  "display": "Vertoon",
  "position": "Posisionering",
  "top": "Bo",
  "right": "Regs",
  "left": "Links",
  "bottom": "Onder",
  "width": "Breedte",
  "height": "Hoogte",
  "max-width": "Maksimum breedte",
  "max-height": "Maksimum hoogte",
  "margin": "Buitenste kantlyn",
  "margin-top": "Buitenste kantlyn: bo",
  "margin-right": "Buitenste kantlyn: regs",
  "margin-left": "Buitenste kantlyn: links",
  "margin-bottom": "Buitenste kantlyn: onder",
  "padding": "Binne-spasiëring",
  "padding-top": "Binne-spasiëring: bo",
  "padding-left": "Binne-spasiëring: links",
  "padding-right": "Binne-spasiëring: regs",
  "padding-bottom": "Binne-spasiëring: onder",
  "font-family": "Lettertipefamilie",
  "font-size": "Lettergrootte",
  "font-weight": "Letterdikte",
  "letter-spacing": "Letterspasiëring",
  "color": "Kleur",
  "line-height": "Reëlhoogte",
  "text-align": "Teksbelyning",
  "text-shadow": "Teksskaduwee",
  "border-top-left": "Rand: links bo",
  "border-top-right": "Rand: regs bo",
  "border-bottom-left": "Rand: links onder",
  "border-bottom-right": "Rand: regs onder",
  "border-radius-top-left": "Hoekafronding: links bo",
  "border-radius-top-right": "Hoekafronding: regs bo",
  "border-radius-bottom-left": "Hoekafronding: links onder",
  "border-radius-bottom-right": "Hoekafronding: regs onder",
  "border-radius": "Hoekafronding",
  "border": "Rand",
  "border-width": "Randwydte",
  "border-style": "Randstyl",
  "border-color": "Randkleur",
  "box-shadow": "Boksskaduwee",
  "background": "Agtergrond",
  "background-image": "Agtergrondprent",
  "background-repeat": "Agtergrondherhaling",
  "background-position": "Agtergrondposisie",
  "background-attachment": "Agtergrondvashegting",
  "background-size": "Agtergrondgrootte",
  "background-color": "Agtergrondkleur",
  "transition": "Oorgang",
  "transition-property": "Oorgangseienskap",
  "transition-duration": "Oorgangsduur",
  "transition-timing-function": "Oorgangstydsberekening",
  "perspective": "Perspektief",
  "transform": "Transformasie",
  "flex-direction": "Flex-rigting",
  "flex-wrap": "Flex-omvouing",
  "justify-content": "Inhoudverspreiding",
  "align-items": "Elementbelyning",
  "align-content": "Inhoudbelyning",
  "order": "Volgorde",
  "flex-basis": "Flex-basis",
  "flex-grow": "Flex-groei",
  "flex-shrink": "Flex-krimp",
  "align-self": "Selfbelyning"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternatiewe teks",
  "title": "Titel",
  "href": "Skakel"
});