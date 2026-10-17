
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'p. ex. Text aquí'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Afegeix una imatge',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Selecciona una imatge',
    uploadTitle: 'Arrossega els fitxers aquí o fes clic per pujar-los'
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
      '': 'Caixa',
      wrapper: 'Cos de la pàgina',
      text: 'Text',
      comment: 'Comentari',
      image: 'Imatge',
      video: 'Vídeo',
      label: 'Etiqueta',
      link: 'Enllaç',
      map: 'Mapa',
      tfoot: 'Peu de taula',
      tbody: 'Cos de taula',
      thead: 'Capçalera de taula',
      table: 'Taula',
      row: 'Fila de taula',
      cell: 'Cel·la de taula'
    }
  },
  deviceManager: {
    device: 'Dispositiu',
    devices: {
      desktop: 'Ordinador',
      tablet: 'Tauleta',
      mobileLandscape: 'Mòbil (horitzontal)',
      mobilePortrait: 'Mòbil (vertical)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Vista prèvia',
        fullscreen: 'Pantalla completa',
        'sw-visibility': 'Mostra els components',
        'export-template': 'Mostra el codi',
        'open-sm': 'Obre el gestor d’estils',
        'open-tm': 'Configuració',
        'open-layers': 'Obre el gestor de capes',
        'open-blocks': 'Obre els blocs'
      }
    }
  },
  selectorManager: {
    label: 'Classes',
    selected: 'Seleccionat',
    emptyState: '- Estat -',
    states: {
      hover: 'En passar-hi el cursor',
      active: 'En fer clic',
      'nth-of-type(2n)': 'Parells/Senars'
    }
  },
  styleManager: {
    empty: 'Selecciona un element abans d’utilitzar el gestor d’estils',
    layer: 'Capa',
    fileButton: 'Imatges',
    sectors: {
      general: 'General',
      layout: 'Disposició',
      typography: 'Tipografia',
      decorations: 'Decoracions',
      extra: 'Extres',
      flex: 'Flex',
      dimension: 'Dimensions'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Desenfocament',
      'text-shadow-color': 'Color',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Desenfocament',
      'box-shadow-spread': 'Expansió',
      'box-shadow-color': 'Color',
      'box-shadow-type': 'Tipus',
      'margin-top-sub': 'Superior',
      'margin-right-sub': 'Dret',
      'margin-bottom-sub': 'Inferior',
      'margin-left-sub': 'Esquerre',
      'padding-top-sub': 'Superior',
      'padding-right-sub': 'Dret',
      'padding-bottom-sub': 'Inferior',
      'padding-left-sub': 'Esquerre',
      'border-width-sub': 'Amplada',
      'border-style-sub': 'Estil',
      'border-color-sub': 'Color',
      'border-top-left-radius-sub': 'Cantonada superior esquerra',
      'border-top-right-radius-sub': 'Cantonada superior dreta',
      'border-bottom-right-radius-sub': 'Cantonada inferior dreta',
      'border-bottom-left-radius-sub': 'Cantonada inferior esquerra',
      'transform-rotate-x': 'Rotació X',
      'transform-rotate-y': 'Rotació Y',
      'transform-rotate-z': 'Rotació Z',
      'transform-scale-x': 'Escala X',
      'transform-scale-y': 'Escala Y',
      'transform-scale-z': 'Escala Z',
      'transition-property-sub': 'Propietat',
      'transition-duration-sub': 'Durada',
      'transition-timing-function-sub': 'Temporització',
      'background-image-sub': 'Imatge',
      'background-repeat-sub': 'Repetició',
      'background-position-sub': 'Posició',
      'background-attachment-sub': 'Fixació',
      'background-size-sub': 'Mida'
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
    empty: 'Selecciona un element abans d’utilitzar el gestor d’atributs',
    label: 'Configuració del component',
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
          placeholder: 'p. ex. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Aquesta finestra',
          _blank: 'Finestra nova'
        }
      }
    }
  },
  storageManager: {
    recover: 'Vols recuperar els canvis no desats?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Flotació",
  "display": "Visualització",
  "position": "Posició",
  "top": "Superior",
  "right": "Dreta",
  "left": "Esquerra",
  "bottom": "Inferior",
  "width": "Amplada",
  "height": "Alçada",
  "max-width": "Amplada màxima",
  "max-height": "Alçada màxima",
  "margin": "Marge exterior",
  "margin-top": "Marge superior",
  "margin-right": "Marge dret",
  "margin-left": "Marge esquerre",
  "margin-bottom": "Marge inferior",
  "padding": "Espaiat interior",
  "padding-top": "Espaiat interior superior",
  "padding-left": "Espaiat interior esquerre",
  "padding-right": "Espaiat interior dret",
  "padding-bottom": "Espaiat interior inferior",
  "font-family": "Família tipogràfica",
  "font-size": "Mida de la lletra",
  "font-weight": "Gruix de la lletra",
  "letter-spacing": "Espaiat entre lletres",
  "color": "Color",
  "line-height": "Alçada de línia",
  "text-align": "Alineació del text",
  "text-shadow": "Ombra del text",
  "border-top-left": "Vora superior esquerra",
  "border-top-right": "Vora superior dreta",
  "border-bottom-left": "Vora inferior esquerra",
  "border-bottom-right": "Vora inferior dreta",
  "border-radius-top-left": "Arrodoniment de la cantonada superior esquerra",
  "border-radius-top-right": "Arrodoniment de la cantonada superior dreta",
  "border-radius-bottom-left": "Arrodoniment de la cantonada inferior esquerra",
  "border-radius-bottom-right": "Arrodoniment de la cantonada inferior dreta",
  "border-radius": "Arrodoniment de les cantonades",
  "border": "Vora",
  "border-width": "Amplada de la vora",
  "border-style": "Estil de la vora",
  "border-color": "Color de la vora",
  "box-shadow": "Ombra de la caixa",
  "background": "Fons",
  "background-image": "Imatge de fons",
  "background-repeat": "Repetició del fons",
  "background-position": "Posició del fons",
  "background-attachment": "Fixació del fons",
  "background-size": "Mida del fons",
  "background-color": "Color de fons",
  "transition": "Transició",
  "transition-property": "Propietat de la transició",
  "transition-duration": "Durada de la transició",
  "transition-timing-function": "Temporització de la transició",
  "perspective": "Perspectiva",
  "transform": "Transformació",
  "flex-direction": "Direcció flex",
  "flex-wrap": "Ajustament de línia flex",
  "justify-content": "Justificació del contingut",
  "align-items": "Alineació dels elements",
  "align-content": "Alineació del contingut",
  "order": "Ordre",
  "flex-basis": "Mida base flex",
  "flex-grow": "Creixement flex",
  "flex-shrink": "Contracció flex",
  "align-self": "Autoalineació"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Text alternatiu",
  "title": "Títol",
  "href": "Enllaç"
});