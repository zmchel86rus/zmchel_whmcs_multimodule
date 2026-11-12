
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'mf. Andika maandishi hapa'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Ongeza picha',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Chagua picha',
    uploadTitle: 'Buruta faili hapa au bofya ili kuzipakia'
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
      '': 'Kisanduku',
      wrapper: 'Mwili wa ukurasa',
      text: 'Maandishi',
      comment: 'Maoni',
      image: 'Picha',
      video: 'Video',
      label: 'Lebo',
      link: 'Kiungo',
      map: 'Ramani',
      tfoot: 'Sehemu ya chini ya jedwali',
      tbody: 'Mwili wa jedwali',
      thead: 'Kichwa cha jedwali',
      table: 'Jedwali',
      row: 'Safu mlalo ya jedwali',
      cell: 'Seli ya jedwali'
    }
  },
  deviceManager: {
    device: 'Kifaa',
    devices: {
      desktop: 'Kompyuta',
      tablet: 'Kompyuta kibao',
      mobileLandscape: 'Simu (mlalo)',
      mobilePortrait: 'Simu (wima)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Onyesho la awali',
        fullscreen: 'Skrini nzima',
        'sw-visibility': 'Onyesha vijenzi',
        'export-template': 'Onyesha msimbo',
        'open-sm': 'Fungua kidhibiti cha mitindo',
        'open-tm': 'Mipangilio',
        'open-layers': 'Fungua kidhibiti cha tabaka',
        'open-blocks': 'Fungua vitalu'
      }
    }
  },
  selectorManager: {
    label: 'Madarasa',
    selected: 'Imechaguliwa',
    emptyState: '- Hali -',
    states: {
      hover: 'Unapopeleka kishale juu',
      active: 'Unapobofya',
      'nth-of-type(2n)': 'Shufwa/Witiri'
    }
  },
  styleManager: {
    empty: 'Chagua kipengele kabla ya kutumia kidhibiti cha mitindo',
    layer: 'Tabaka',
    fileButton: 'Picha',
    sectors: {
      general: 'Jumla',
      layout: 'Mpangilio wa ukurasa',
      typography: 'Tipografia',
      decorations: 'Mapambo',
      extra: 'Ziada',
      flex: 'Flex',
      dimension: 'Vipimo'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Ukungu',
      'text-shadow-color': 'Rangi',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Ukungu',
      'box-shadow-spread': 'Msambao',
      'box-shadow-color': 'Rangi',
      'box-shadow-type': 'Aina',
      'margin-top-sub': 'Juu',
      'margin-right-sub': 'Kulia',
      'margin-bottom-sub': 'Chini',
      'margin-left-sub': 'Kushoto',
      'padding-top-sub': 'Juu',
      'padding-right-sub': 'Kulia',
      'padding-bottom-sub': 'Chini',
      'padding-left-sub': 'Kushoto',
      'border-width-sub': 'Upana',
      'border-style-sub': 'Mtindo',
      'border-color-sub': 'Rangi',
      'border-top-left-radius-sub': 'Kona ya juu kushoto',
      'border-top-right-radius-sub': 'Kona ya juu kulia',
      'border-bottom-right-radius-sub': 'Kona ya chini kulia',
      'border-bottom-left-radius-sub': 'Kona ya chini kushoto',
      'transform-rotate-x': 'Zungusha X',
      'transform-rotate-y': 'Zungusha Y',
      'transform-rotate-z': 'Zungusha Z',
      'transform-scale-x': 'Badili kipimo X',
      'transform-scale-y': 'Badili kipimo Y',
      'transform-scale-z': 'Badili kipimo Z',
      'transition-property-sub': 'Sifa',
      'transition-duration-sub': 'Muda',
      'transition-timing-function-sub': 'Mpangilio wa muda',
      'background-image-sub': 'Picha',
      'background-repeat-sub': 'Urudiaji',
      'background-position-sub': 'Nafasi',
      'background-attachment-sub': 'Uambatisho',
      'background-size-sub': 'Ukubwa'
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
    empty: 'Chagua kipengele kabla ya kutumia kidhibiti cha sifa',
    label: 'Mipangilio ya kijenzi',
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
          placeholder: 'mf. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Dirisha hili',
          _blank: 'Dirisha jipya'
        }
      }
    }
  },
  storageManager: {
    recover: 'Je, ungependa kurejesha mabadiliko ambayo hayajahifadhiwa?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Ueleaji",
  "display": "Namna ya kuonyesha",
  "position": "Nafasi",
  "top": "Juu",
  "right": "Kulia",
  "left": "Kushoto",
  "bottom": "Chini",
  "width": "Upana",
  "height": "Urefu",
  "max-width": "Upana wa juu zaidi",
  "max-height": "Urefu wa juu zaidi",
  "margin": "Pengo la nje",
  "margin-top": "Pengo la nje la juu",
  "margin-right": "Pengo la nje la kulia",
  "margin-left": "Pengo la nje la kushoto",
  "margin-bottom": "Pengo la nje la chini",
  "padding": "Pengo la ndani",
  "padding-top": "Pengo la ndani la juu",
  "padding-left": "Pengo la ndani la kushoto",
  "padding-right": "Pengo la ndani la kulia",
  "padding-bottom": "Pengo la ndani la chini",
  "font-family": "Familia ya fonti",
  "font-size": "Ukubwa wa fonti",
  "font-weight": "Unene wa fonti",
  "letter-spacing": "Nafasi kati ya herufi",
  "color": "Rangi",
  "line-height": "Kimo cha mstari",
  "text-align": "Upangiliaji wa maandishi",
  "text-shadow": "Kivuli cha maandishi",
  "border-top-left": "Mpaka wa kona ya juu kushoto",
  "border-top-right": "Mpaka wa kona ya juu kulia",
  "border-bottom-left": "Mpaka wa kona ya chini kushoto",
  "border-bottom-right": "Mpaka wa kona ya chini kulia",
  "border-radius-top-left": "Mviringo wa kona ya juu kushoto",
  "border-radius-top-right": "Mviringo wa kona ya juu kulia",
  "border-radius-bottom-left": "Mviringo wa kona ya chini kushoto",
  "border-radius-bottom-right": "Mviringo wa kona ya chini kulia",
  "border-radius": "Mviringo wa pembe",
  "border": "Mpaka",
  "border-width": "Upana wa mpaka",
  "border-style": "Mtindo wa mpaka",
  "border-color": "Rangi ya mpaka",
  "box-shadow": "Kivuli cha kisanduku",
  "background": "Mandharinyuma",
  "background-image": "Picha ya mandharinyuma",
  "background-repeat": "Urudiaji wa mandharinyuma",
  "background-position": "Nafasi ya mandharinyuma",
  "background-attachment": "Uambatisho wa mandharinyuma",
  "background-size": "Ukubwa wa mandharinyuma",
  "background-color": "Rangi ya mandharinyuma",
  "transition": "Mpito",
  "transition-property": "Sifa ya mpito",
  "transition-duration": "Muda wa mpito",
  "transition-timing-function": "Mpangilio wa muda wa mpito",
  "perspective": "Mtazamo wa kina",
  "transform": "Ugeuzaji",
  "flex-direction": "Mwelekeo wa Flex",
  "flex-wrap": "Kuhamisha vipengee vya Flex kwenye mstari mwingine",
  "justify-content": "Upangiliaji wa maudhui kwenye mhimili mkuu",
  "align-items": "Upangiliaji wa vipengee",
  "align-content": "Upangiliaji wa maudhui",
  "order": "Mpangilio",
  "flex-basis": "Ukubwa wa msingi wa Flex",
  "flex-grow": "Ukuaji wa Flex",
  "flex-shrink": "Upungufu wa Flex",
  "align-self": "Upangiliaji binafsi"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Maandishi mbadala",
  "title": "Kichwa",
  "href": "Kiungo"
});