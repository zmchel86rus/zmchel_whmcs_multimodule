
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 't.d. Texti hér'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Bæta við mynd',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Velja mynd',
    uploadTitle: 'Dragðu skrár hingað eða smelltu til að hlaða upp'
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
      '': 'Kassi',
      wrapper: 'Meginmál síðu',
      text: 'Texti',
      comment: 'Athugasemd',
      image: 'Mynd',
      video: 'Myndband',
      label: 'Merki',
      link: 'Tengill',
      map: 'Kort',
      tfoot: 'Töflufótur',
      tbody: 'Meginmál töflu',
      thead: 'Töfluhaus',
      table: 'Tafla',
      row: 'Töfluröð',
      cell: 'Töflureitur'
    }
  },
  deviceManager: {
    device: 'Tæki',
    devices: {
      desktop: 'Borðtölva',
      tablet: 'Spjaldtölva',
      mobileLandscape: 'Farsími (lárétt)',
      mobilePortrait: 'Farsími (lóðrétt)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Forskoðun',
        fullscreen: 'Allur skjár',
        'sw-visibility': 'Sýna íhluti',
        'export-template': 'Sýna kóða',
        'open-sm': 'Opna stílstjórnun',
        'open-tm': 'Stillingar',
        'open-layers': 'Opna lagastjórnun',
        'open-blocks': 'Opna blokkir'
      }
    }
  },
  selectorManager: {
    label: 'CSS-klasar',
    selected: 'Valið',
    emptyState: '- Staða -',
    states: {
      hover: 'Þegar bendill er yfir',
      active: 'Við smell',
      'nth-of-type(2n)': 'Sléttar/oddatölur'
    }
  },
  styleManager: {
    empty: 'Veldu stak áður en þú notar stílstjórnun',
    layer: 'Lag',
    fileButton: 'Myndir',
    sectors: {
      general: 'Almennt',
      layout: 'Skipulag',
      typography: 'Leturfræði',
      decorations: 'Skreytingar',
      extra: 'Annað',
      flex: 'Flex',
      dimension: 'Stærðir'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Óskýrleiki',
      'text-shadow-color': 'Litur',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Óskýrleiki',
      'box-shadow-spread': 'Útbreiðsla',
      'box-shadow-color': 'Litur',
      'box-shadow-type': 'Gerð',
      'margin-top-sub': 'Efst',
      'margin-right-sub': 'Hægri',
      'margin-bottom-sub': 'Neðst',
      'margin-left-sub': 'Vinstri',
      'padding-top-sub': 'Efst',
      'padding-right-sub': 'Hægri',
      'padding-bottom-sub': 'Neðst',
      'padding-left-sub': 'Vinstri',
      'border-width-sub': 'Breidd',
      'border-style-sub': 'Stíll',
      'border-color-sub': 'Litur',
      'border-top-left-radius-sub': 'Efst til vinstri',
      'border-top-right-radius-sub': 'Efst til hægri',
      'border-bottom-right-radius-sub': 'Neðst til hægri',
      'border-bottom-left-radius-sub': 'Neðst til vinstri',
      'transform-rotate-x': 'Snúningur X',
      'transform-rotate-y': 'Snúningur Y',
      'transform-rotate-z': 'Snúningur Z',
      'transform-scale-x': 'Skölun X',
      'transform-scale-y': 'Skölun Y',
      'transform-scale-z': 'Skölun Z',
      'transition-property-sub': 'Eiginleiki',
      'transition-duration-sub': 'Tímalengd',
      'transition-timing-function-sub': 'Tímastilling',
      'background-image-sub': 'Mynd',
      'background-repeat-sub': 'Endurtekning',
      'background-position-sub': 'Staðsetning',
      'background-attachment-sub': 'Festing',
      'background-size-sub': 'Stærð'
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
    empty: 'Veldu stak áður en þú notar eiginleikastjórnun',
    label: 'Stillingar einingar',
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
          placeholder: 't.d. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Þessi gluggi',
          _blank: 'Nýr gluggi'
        }
      }
    }
  },
  storageManager: {
    recover: 'Viltu endurheimta óvistaðar breytingar?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Flot",
  "display": "Birting",
  "position": "Staðsetning",
  "top": "Efst",
  "right": "Hægri",
  "left": "Vinstri",
  "bottom": "Neðst",
  "width": "Breidd",
  "height": "Hæð",
  "max-width": "Hámarksbreidd",
  "max-height": "Hámarkshæð",
  "margin": "Ytri spássía",
  "margin-top": "Ytri spássía efst",
  "margin-right": "Ytri spássía hægra megin",
  "margin-left": "Ytri spássía vinstra megin",
  "margin-bottom": "Ytri spássía neðst",
  "padding": "Innri spássía",
  "padding-top": "Innri spássía efst",
  "padding-left": "Innri spássía vinstra megin",
  "padding-right": "Innri spássía hægra megin",
  "padding-bottom": "Innri spássía neðst",
  "font-family": "Leturgerð",
  "font-size": "Leturstærð",
  "font-weight": "Leturþykkt",
  "letter-spacing": "Stafabil",
  "color": "Litur",
  "line-height": "Línuhæð",
  "text-align": "Textajöfnun",
  "text-shadow": "Textaskuggi",
  "border-top-left": "Rammi efst til vinstri",
  "border-top-right": "Rammi efst til hægri",
  "border-bottom-left": "Rammi neðst til vinstri",
  "border-bottom-right": "Rammi neðst til hægri",
  "border-radius-top-left": "Hornrúnnun efst til vinstri",
  "border-radius-top-right": "Hornrúnnun efst til hægri",
  "border-radius-bottom-left": "Hornrúnnun neðst til vinstri",
  "border-radius-bottom-right": "Hornrúnnun neðst til hægri",
  "border-radius": "Hornrúnnun",
  "border": "Rammi",
  "border-width": "Rammabreidd",
  "border-style": "Rammastíll",
  "border-color": "Rammalitur",
  "box-shadow": "Kassaskuggi",
  "background": "Bakgrunnur",
  "background-image": "Bakgrunnsmynd",
  "background-repeat": "Endurtekning bakgrunns",
  "background-position": "Staðsetning bakgrunns",
  "background-attachment": "Festing bakgrunns",
  "background-size": "Stærð bakgrunns",
  "background-color": "Bakgrunnslitur",
  "transition": "Umskipti",
  "transition-property": "Eiginleiki umskipta",
  "transition-duration": "Lengd umskipta",
  "transition-timing-function": "Tímastilling umskipta",
  "perspective": "Sjónarhorn",
  "transform": "Umbreyting",
  "flex-direction": "Stefna Flex",
  "flex-wrap": "Línuskipting Flex",
  "justify-content": "Jöfnun efnis eftir meginás",
  "align-items": "Jöfnun staka",
  "align-content": "Jöfnun efnis",
  "order": "Röð",
  "flex-basis": "Grunnstærð Flex",
  "flex-grow": "Stækkun Flex",
  "flex-shrink": "Minnkun Flex",
  "align-self": "Jöfnun staks"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Valkostatexti",
  "title": "Titill",
  "href": "Tengill"
});