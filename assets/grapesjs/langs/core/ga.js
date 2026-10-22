
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'm.sh. Cuir téacs anseo'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Cuir íomhá leis',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Roghnaigh íomhá',
    uploadTitle: 'Scaoil comhaid anseo nó cliceáil chun iad a uaslódáil'
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
      '': 'Bosca',
      wrapper: 'Corp an leathanaigh',
      text: 'Téacs',
      comment: 'Nóta tráchta',
      image: 'Íomhá',
      video: 'Físeán',
      label: 'Lipéad',
      link: 'Nasc',
      map: 'Léarscáil',
      tfoot: 'Buntásc an tábla',
      tbody: 'Corp an tábla',
      thead: 'Ceanntásc an tábla',
      table: 'Tábla',
      row: 'Ró tábla',
      cell: 'Cill tábla'
    }
  },
  deviceManager: {
    device: 'Gléas',
    devices: {
      desktop: 'Ríomhaire deisce',
      tablet: 'Táibléad',
      mobileLandscape: 'Fón póca (tírdhreach)',
      mobilePortrait: 'Fón póca (portráid)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Réamhamharc',
        fullscreen: 'Lánscáileán',
        'sw-visibility': 'Taispeáin na comhpháirteanna',
        'export-template': 'Féach ar an gcód',
        'open-sm': 'Oscail an Bainisteoir Stíleanna',
        'open-tm': 'Socruithe',
        'open-layers': 'Oscail an Bainisteoir Sraitheanna',
        'open-blocks': 'Oscail na bloic'
      }
    }
  },
  selectorManager: {
    label: 'Aicmí',
    selected: 'Roghnaithe',
    emptyState: '- Staid -',
    states: {
      hover: 'Ar ainliú',
      active: 'Ar chliceáil',
      'nth-of-type(2n)': 'Ré/Corr'
    }
  },
  styleManager: {
    empty: 'Roghnaigh eilimint sula n-úsáideann tú an Bainisteoir Stíleanna',
    layer: 'Sraith',
    fileButton: 'Íomhánna',
    sectors: {
      general: 'Ginearálta',
      layout: 'Leagan amach',
      typography: 'Clóghrafaíocht',
      decorations: 'Maisiúcháin',
      extra: 'Breise',
      flex: 'Flex',
      dimension: 'Toisí'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Doiléiriú',
      'text-shadow-color': 'Dath',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Doiléiriú',
      'box-shadow-spread': 'Scaipeadh',
      'box-shadow-color': 'Dath',
      'box-shadow-type': 'Cineál',
      'margin-top-sub': 'Barr',
      'margin-right-sub': 'Deas',
      'margin-bottom-sub': 'Bun',
      'margin-left-sub': 'Clé',
      'padding-top-sub': 'Barr',
      'padding-right-sub': 'Deas',
      'padding-bottom-sub': 'Bun',
      'padding-left-sub': 'Clé',
      'border-width-sub': 'Leithead',
      'border-style-sub': 'Stíl',
      'border-color-sub': 'Dath',
      'border-top-left-radius-sub': 'Barr ar chlé',
      'border-top-right-radius-sub': 'Barr ar dheis',
      'border-bottom-right-radius-sub': 'Bun ar dheis',
      'border-bottom-left-radius-sub': 'Bun ar chlé',
      'transform-rotate-x': 'Rothlú X',
      'transform-rotate-y': 'Rothlú Y',
      'transform-rotate-z': 'Rothlú Z',
      'transform-scale-x': 'Scálú X',
      'transform-scale-y': 'Scálú Y',
      'transform-scale-z': 'Scálú Z',
      'transition-property-sub': 'Airí',
      'transition-duration-sub': 'Fad ama',
      'transition-timing-function-sub': 'Uainiú',
      'background-image-sub': 'Íomhá',
      'background-repeat-sub': 'Athdhéanamh',
      'background-position-sub': 'Suíomh',
      'background-attachment-sub': 'Ceangal',
      'background-size-sub': 'Méid'
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
    empty: 'Roghnaigh eilimint sula n-úsáideann tú an Bainisteoir Tréithe',
    label: 'Socruithe na comhpháirte',
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
          placeholder: 'm.sh. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'An fhuinneog seo',
          _blank: 'Fuinneog nua'
        }
      }
    }
  },
  storageManager: {
    recover: 'Ar mhaith leat na hathruithe nár sábháladh a aisghabháil?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Snámh",
  "display": "Taispeáint",
  "position": "Suíomh",
  "top": "Barr",
  "right": "Deas",
  "left": "Clé",
  "bottom": "Bun",
  "width": "Leithead",
  "height": "Airde",
  "max-width": "Leithead uasta",
  "max-height": "Airde uasta",
  "margin": "Imeall seachtrach",
  "margin-top": "Imeall seachtrach ag an mbarr",
  "margin-right": "Imeall seachtrach ar dheis",
  "margin-left": "Imeall seachtrach ar chlé",
  "margin-bottom": "Imeall seachtrach ag an mbun",
  "padding": "Spásáil inmheánach",
  "padding-top": "Spásáil inmheánach ag an mbarr",
  "padding-left": "Spásáil inmheánach ar chlé",
  "padding-right": "Spásáil inmheánach ar dheis",
  "padding-bottom": "Spásáil inmheánach ag an mbun",
  "font-family": "Clann clónna",
  "font-size": "Clómhéid",
  "font-weight": "Meáchan an chló",
  "letter-spacing": "Spásáil idir litreacha",
  "color": "Dath",
  "line-height": "Airde líne",
  "text-align": "Ailíniú téacs",
  "text-shadow": "Scáth téacs",
  "border-top-left": "Teorainn ar barr ar chlé",
  "border-top-right": "Teorainn ar barr ar dheis",
  "border-bottom-left": "Teorainn ag an mbun ar chlé",
  "border-bottom-right": "Teorainn ag an mbun ar dheis",
  "border-radius-top-left": "Ga an choirnéil ar barr ar chlé",
  "border-radius-top-right": "Ga an choirnéil ar barr ar dheis",
  "border-radius-bottom-left": "Ga an choirnéil ag an mbun ar chlé",
  "border-radius-bottom-right": "Ga an choirnéil ag an mbun ar dheis",
  "border-radius": "Ga na gcoirnéal",
  "border": "Teorainn",
  "border-width": "Leithead na teorann",
  "border-style": "Stíl na teorann",
  "border-color": "Dath na teorann",
  "box-shadow": "Scáth bosca",
  "background": "Cúlra",
  "background-image": "Íomhá chúlra",
  "background-repeat": "Athdhéanamh an chúlra",
  "background-position": "Suíomh an chúlra",
  "background-attachment": "Ceangal an chúlra",
  "background-size": "Méid an chúlra",
  "background-color": "Dath an chúlra",
  "transition": "Aistriú",
  "transition-property": "Airí an aistrithe",
  "transition-duration": "Fad an aistrithe",
  "transition-timing-function": "Uainiú an aistrithe",
  "perspective": "Peirspictíocht",
  "transform": "Claochlú",
  "flex-direction": "Treo Flex",
  "flex-wrap": "Timfhilleadh Flex",
  "justify-content": "Dáileadh an ábhair",
  "align-items": "Ailíniú míreanna",
  "align-content": "Ailíniú an ábhair",
  "order": "Ord",
  "flex-basis": "Bunmhéid Flex",
  "flex-grow": "Fás Flex",
  "flex-shrink": "Crapadh Flex",
  "align-self": "Féinailíniú"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Téacs malartach",
  "title": "Teideal",
  "href": "Nasc"
});