
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'hal. Teksto rito'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Magdagdag ng larawan',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Pumili ng larawan',
    uploadTitle: 'I-drag ang mga file rito o mag-click para mag-upload'
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
      '': 'Kahon',
      wrapper: 'Katawan ng pahina',
      text: 'Teksto',
      comment: 'Komento',
      image: 'Larawan',
      video: 'Video',
      label: 'Label',
      link: 'Link',
      map: 'Mapa',
      tfoot: 'Paanan ng talahanayan',
      tbody: 'Katawan ng talahanayan',
      thead: 'Ulo ng talahanayan',
      table: 'Talahanayan',
      row: 'Hilera ng talahanayan',
      cell: 'Cell ng talahanayan'
    }
  },
  deviceManager: {
    device: 'Aparato',
    devices: {
      desktop: 'Desktop',
      tablet: 'Tablet',
      mobileLandscape: 'Mobile (pahalang)',
      mobilePortrait: 'Mobile (patayo)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Paunang tingin',
        fullscreen: 'Buong screen',
        'sw-visibility': 'Ipakita ang mga bahagi',
        'export-template': 'Tingnan ang code',
        'open-sm': 'Buksan ang tagapamahala ng estilo',
        'open-tm': 'Mga setting',
        'open-layers': 'Buksan ang tagapamahala ng mga layer',
        'open-blocks': 'Buksan ang mga block'
      }
    }
  },
  selectorManager: {
    label: 'Mga klase',
    selected: 'Napili',
    emptyState: '- Kalagayan -',
    states: {
      hover: 'Kapag itinapat ang pointer',
      active: 'Pag-click',
      'nth-of-type(2n)': 'Pares/Di-pares'
    }
  },
  styleManager: {
    empty: 'Pumili muna ng elemento bago gamitin ang tagapamahala ng estilo',
    layer: 'Layer',
    fileButton: 'Mga larawan',
    sectors: {
      general: 'Pangkalahatan',
      layout: 'Layout',
      typography: 'Tipograpiya',
      decorations: 'Mga dekorasyon',
      extra: 'Dagdag',
      flex: 'Flex',
      dimension: 'Mga sukat'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Paglabo',
      'text-shadow-color': 'Kulay',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Paglabo',
      'box-shadow-spread': 'Pagkalat',
      'box-shadow-color': 'Kulay',
      'box-shadow-type': 'Uri',
      'margin-top-sub': 'Itaas',
      'margin-right-sub': 'Kanan',
      'margin-bottom-sub': 'Ibaba',
      'margin-left-sub': 'Kaliwa',
      'padding-top-sub': 'Itaas',
      'padding-right-sub': 'Kanan',
      'padding-bottom-sub': 'Ibaba',
      'padding-left-sub': 'Kaliwa',
      'border-width-sub': 'Lapad',
      'border-style-sub': 'Estilo',
      'border-color-sub': 'Kulay',
      'border-top-left-radius-sub': 'Itaas na kaliwa',
      'border-top-right-radius-sub': 'Itaas na kanan',
      'border-bottom-right-radius-sub': 'Ibaba na kanan',
      'border-bottom-left-radius-sub': 'Ibaba na kaliwa',
      'transform-rotate-x': 'Pag-ikot sa X',
      'transform-rotate-y': 'Pag-ikot sa Y',
      'transform-rotate-z': 'Pag-ikot sa Z',
      'transform-scale-x': 'Pag-scale sa X',
      'transform-scale-y': 'Pag-scale sa Y',
      'transform-scale-z': 'Pag-scale sa Z',
      'transition-property-sub': 'Katangian',
      'transition-duration-sub': 'Tagal',
      'transition-timing-function-sub': 'Timing',
      'background-image-sub': 'Larawan',
      'background-repeat-sub': 'Pag-uulit',
      'background-position-sub': 'Posisyon',
      'background-attachment-sub': 'Pagkakabit',
      'background-size-sub': 'Laki'
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
    empty: 'Pumili muna ng elemento bago gamitin ang tagapamahala ng mga attribute',
    label: 'Mga setting ng bahagi',
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
          placeholder: 'hal. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Sa window na ito',
          _blank: 'Sa bagong window'
        }
      }
    }
  },
  storageManager: {
    recover: 'Gusto mo bang ibalik ang mga pagbabagong hindi na-save?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Paglutang",
  "display": "Pagpapakita",
  "position": "Posisyon",
  "top": "Itaas",
  "right": "Kanan",
  "left": "Kaliwa",
  "bottom": "Ibaba",
  "width": "Lapad",
  "height": "Taas",
  "max-width": "Pinakamalaking lapad",
  "max-height": "Pinakamalaking taas",
  "margin": "Margin",
  "margin-top": "Margin sa itaas",
  "margin-right": "Margin sa kanan",
  "margin-left": "Margin sa kaliwa",
  "margin-bottom": "Margin sa ibaba",
  "padding": "Padding",
  "padding-top": "Padding sa itaas",
  "padding-left": "Padding sa kaliwa",
  "padding-right": "Padding sa kanan",
  "padding-bottom": "Padding sa ibaba",
  "font-family": "Pamilya ng font",
  "font-size": "Laki ng font",
  "font-weight": "Kapal ng font",
  "letter-spacing": "Agwat ng mga titik",
  "color": "Kulay",
  "line-height": "Taas ng linya",
  "text-align": "Pagkakahanay ng teksto",
  "text-shadow": "Anino ng teksto",
  "border-top-left": "Border sa itaas na kaliwa",
  "border-top-right": "Border sa itaas na kanan",
  "border-bottom-left": "Border sa ibaba na kaliwa",
  "border-bottom-right": "Border sa ibaba na kanan",
  "border-radius-top-left": "Pagkabilog ng sulok sa itaas na kaliwa",
  "border-radius-top-right": "Pagkabilog ng sulok sa itaas na kanan",
  "border-radius-bottom-left": "Pagkabilog ng sulok sa ibaba na kaliwa",
  "border-radius-bottom-right": "Pagkabilog ng sulok sa ibaba na kanan",
  "border-radius": "Pagkabilog ng mga sulok",
  "border": "Border",
  "border-width": "Kapal ng border",
  "border-style": "Estilo ng border",
  "border-color": "Kulay ng border",
  "box-shadow": "Anino ng kahon",
  "background": "Background",
  "background-image": "Larawan sa background",
  "background-repeat": "Pag-uulit ng background",
  "background-position": "Posisyon ng background",
  "background-attachment": "Pagkakabit ng background",
  "background-size": "Laki ng background",
  "background-color": "Kulay ng background",
  "transition": "Transisyon",
  "transition-property": "Katangian ng transisyon",
  "transition-duration": "Tagal ng transisyon",
  "transition-timing-function": "Timing ng transisyon",
  "perspective": "Perspektiba",
  "transform": "Transformasyon",
  "flex-direction": "Direksiyon ng Flex",
  "flex-wrap": "Pag-wrap ng Flex",
  "justify-content": "Pagkakahanay ng nilalaman sa pangunahing axis",
  "align-items": "Pagkakahanay ng mga elemento",
  "align-content": "Pagkakahanay ng nilalaman",
  "order": "Pagkakasunod-sunod",
  "flex-basis": "Batayang sukat ng Flex",
  "flex-grow": "Paglaki ng Flex",
  "flex-shrink": "Pagliit ng Flex",
  "align-self": "Sariling pagkakahanay"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternatibong teksto",
  "title": "Pamagat",
  "href": "Link"
});