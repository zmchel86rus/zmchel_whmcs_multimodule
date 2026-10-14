
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'es. Inserisci il testo qui'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Aggiungi immagine',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Seleziona immagine',
    uploadTitle: 'Trascina qui i file o fai clic per caricarli'
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
      '': 'Contenitore',
      wrapper: 'Corpo della pagina',
      text: 'Testo',
      comment: 'Commento',
      image: 'Immagine',
      video: 'Video',
      label: 'Etichetta',
      link: 'Collegamento',
      map: 'Mappa',
      tfoot: 'Piè di tabella',
      tbody: 'Corpo della tabella',
      thead: 'Intestazione della tabella',
      table: 'Tabella',
      row: 'Riga della tabella',
      cell: 'Cella della tabella'
    }
  },
  deviceManager: {
    device: 'Dispositivo',
    devices: {
      desktop: 'Computer',
      tablet: 'Tablet',
      mobileLandscape: 'Dispositivo mobile (orizzontale)',
      mobilePortrait: 'Dispositivo mobile (verticale)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Anteprima',
        fullscreen: 'Schermo intero',
        'sw-visibility': 'Mostra componenti',
        'export-template': 'Visualizza codice',
        'open-sm': 'Apri gestione stili',
        'open-tm': 'Impostazioni',
        'open-layers': 'Apri gestione livelli',
        'open-blocks': 'Apri blocchi'
      }
    }
  },
  selectorManager: {
    label: 'Classi',
    selected: 'Selezionato',
    emptyState: '- Stato -',
    states: {
      hover: 'Al passaggio del mouse',
      active: 'Al clic',
      'nth-of-type(2n)': 'Pari/Dispari'
    }
  },
  styleManager: {
    empty: 'Seleziona un elemento prima di utilizzare la gestione stili',
    layer: 'Livello',
    fileButton: 'Immagini',
    sectors: {
      general: 'Generale',
      layout: 'Layout',
      typography: 'Tipografia',
      decorations: 'Decorazioni',
      extra: 'Extra',
      flex: 'Flex',
      dimension: 'Dimensioni'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Sfocatura',
      'text-shadow-color': 'Colore',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Sfocatura',
      'box-shadow-spread': 'Espansione',
      'box-shadow-color': 'Colore',
      'box-shadow-type': 'Tipo',
      'margin-top-sub': 'Superiore',
      'margin-right-sub': 'Destro',
      'margin-bottom-sub': 'Inferiore',
      'margin-left-sub': 'Sinistro',
      'padding-top-sub': 'Superiore',
      'padding-right-sub': 'Destro',
      'padding-bottom-sub': 'Inferiore',
      'padding-left-sub': 'Sinistro',
      'border-width-sub': 'Spessore',
      'border-style-sub': 'Stile',
      'border-color-sub': 'Colore',
      'border-top-left-radius-sub': 'Angolo superiore sinistro',
      'border-top-right-radius-sub': 'Angolo superiore destro',
      'border-bottom-right-radius-sub': 'Angolo inferiore destro',
      'border-bottom-left-radius-sub': 'Angolo inferiore sinistro',
      'transform-rotate-x': 'Rotazione X',
      'transform-rotate-y': 'Rotazione Y',
      'transform-rotate-z': 'Rotazione Z',
      'transform-scale-x': 'Scala X',
      'transform-scale-y': 'Scala Y',
      'transform-scale-z': 'Scala Z',
      'transition-property-sub': 'Proprietà',
      'transition-duration-sub': 'Durata',
      'transition-timing-function-sub': 'Temporizzazione',
      'background-image-sub': 'Immagine',
      'background-repeat-sub': 'Ripetizione',
      'background-position-sub': 'Posizione',
      'background-attachment-sub': 'Ancoraggio',
      'background-size-sub': 'Dimensione'
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
    empty: 'Seleziona un elemento prima di utilizzare la gestione attributi',
    label: 'Impostazioni del componente',
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
          placeholder: 'es. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Questa finestra',
          _blank: 'Nuova finestra'
        }
      }
    }
  },
  storageManager: {
    recover: 'Vuoi recuperare le modifiche non salvate?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Allineamento flottante",
  "display": "Visualizzazione",
  "position": "Posizione",
  "top": "Alto",
  "right": "Destra",
  "left": "Sinistra",
  "bottom": "Basso",
  "width": "Larghezza",
  "height": "Altezza",
  "max-width": "Larghezza (max.)",
  "max-height": "Altezza (max.)",
  "margin": "Margine",
  "margin-top": "Margine: alto",
  "margin-right": "Margine: destra",
  "margin-left": "Margine: sinistra",
  "margin-bottom": "Margine: basso",
  "padding": "Spaziatura interna",
  "padding-top": "Spaziatura interna: alto",
  "padding-left": "Spaziatura interna: sinistra",
  "padding-right": "Spaziatura interna: destra",
  "padding-bottom": "Spaziatura interna: basso",
  "font-family": "Carattere: famiglia",
  "font-size": "Carattere: dimensione",
  "font-weight": "Carattere: peso",
  "letter-spacing": "Lettere: spaziatura",
  "color": "Colore",
  "line-height": "Riga: altezza",
  "text-align": "Testo: allineamento",
  "text-shadow": "Testo: ombra",
  "border-top-left": "Bordo: alto · sinistra",
  "border-top-right": "Bordo: alto · destra",
  "border-bottom-left": "Bordo: basso · sinistra",
  "border-bottom-right": "Bordo: basso · destra",
  "border-radius-top-left": "Bordo: raggio · alto · sinistra",
  "border-radius-top-right": "Bordo: raggio · alto · destra",
  "border-radius-bottom-left": "Bordo: raggio · basso · sinistra",
  "border-radius-bottom-right": "Bordo: raggio · basso · destra",
  "border-radius": "Bordo: raggio",
  "border": "Bordo",
  "border-width": "Bordo: larghezza",
  "border-style": "Bordo: stile",
  "border-color": "Bordo: colore",
  "box-shadow": "Riquadro: ombra",
  "background": "Sfondo",
  "background-image": "Sfondo: immagine",
  "background-repeat": "Sfondo: ripetizione",
  "background-position": "Sfondo: posizione",
  "background-attachment": "Sfondo: ancoraggio",
  "background-size": "Sfondo: dimensione",
  "background-color": "Sfondo: colore",
  "transition": "Transizione",
  "transition-property": "Transizione: proprietà",
  "transition-duration": "Transizione: durata",
  "transition-timing-function": "Transizione: temporizzazione",
  "perspective": "Prospettiva",
  "transform": "Trasformazione",
  "flex-direction": "Flex: direzione",
  "flex-wrap": "Flex: a capo",
  "justify-content": "Giustificazione: contenuto",
  "align-items": "Allineamento: elementi",
  "align-content": "Allineamento: contenuto",
  "order": "Ordine",
  "flex-basis": "Flex: base",
  "flex-grow": "Flex: crescita",
  "flex-shrink": "Flex: riduzione",
  "align-self": "Allineamento: proprio"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Testo alternativo",
  "title": "Titolo",
  "href": "Collegamento"
});
