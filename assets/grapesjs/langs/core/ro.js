
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'de ex. Text aici'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Adaugă imagine',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Selectează imaginea',
    uploadTitle: 'Trage fișierele aici sau fă clic pentru a le încărca'
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
      '': 'Casetă',
      wrapper: 'Corpul paginii',
      text: 'Text',
      comment: 'Comentariu',
      image: 'Imagine',
      video: 'Videoclip',
      label: 'Etichetă',
      link: 'Link',
      map: 'Hartă',
      tfoot: 'Subsolul tabelului',
      tbody: 'Corpul tabelului',
      thead: 'Antetul tabelului',
      table: 'Tabel',
      row: 'Rând de tabel',
      cell: 'Celulă de tabel'
    }
  },
  deviceManager: {
    device: 'Dispozitiv',
    devices: {
      desktop: 'Desktop',
      tablet: 'Tabletă',
      mobileLandscape: 'Mobil (orizontal)',
      mobilePortrait: 'Mobil (vertical)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Previzualizare',
        fullscreen: 'Ecran complet',
        'sw-visibility': 'Afișează componentele',
        'export-template': 'Afișează codul',
        'open-sm': 'Deschide managerul de stiluri',
        'open-tm': 'Setări',
        'open-layers': 'Deschide managerul de straturi',
        'open-blocks': 'Deschide blocurile'
      }
    }
  },
  selectorManager: {
    label: 'Clase',
    selected: 'Selectat',
    emptyState: '- Stare -',
    states: {
      hover: 'La trecerea cursorului',
      active: 'La clic',
      'nth-of-type(2n)': 'Par/Impar'
    }
  },
  styleManager: {
    empty: 'Selectează un element înainte de a utiliza managerul de stiluri',
    layer: 'Strat',
    fileButton: 'Imagini',
    sectors: {
      general: 'General',
      layout: 'Aspect',
      typography: 'Tipografie',
      decorations: 'Decorațiuni',
      extra: 'Suplimentar',
      flex: 'Flex',
      dimension: 'Dimensiuni'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Estompare',
      'text-shadow-color': 'Culoare',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Estompare',
      'box-shadow-spread': 'Extindere',
      'box-shadow-color': 'Culoare',
      'box-shadow-type': 'Tip',
      'margin-top-sub': 'Sus',
      'margin-right-sub': 'Dreapta',
      'margin-bottom-sub': 'Jos',
      'margin-left-sub': 'Stânga',
      'padding-top-sub': 'Sus',
      'padding-right-sub': 'Dreapta',
      'padding-bottom-sub': 'Jos',
      'padding-left-sub': 'Stânga',
      'border-width-sub': 'Lățime',
      'border-style-sub': 'Stil',
      'border-color-sub': 'Culoare',
      'border-top-left-radius-sub': 'Stânga sus',
      'border-top-right-radius-sub': 'Dreapta sus',
      'border-bottom-right-radius-sub': 'Dreapta jos',
      'border-bottom-left-radius-sub': 'Stânga jos',
      'transform-rotate-x': 'Rotire X',
      'transform-rotate-y': 'Rotire Y',
      'transform-rotate-z': 'Rotire Z',
      'transform-scale-x': 'Scalare X',
      'transform-scale-y': 'Scalare Y',
      'transform-scale-z': 'Scalare Z',
      'transition-property-sub': 'Proprietate',
      'transition-duration-sub': 'Durată',
      'transition-timing-function-sub': 'Temporizare',
      'background-image-sub': 'Imagine',
      'background-repeat-sub': 'Repetare',
      'background-position-sub': 'Poziție',
      'background-attachment-sub': 'Fixare',
      'background-size-sub': 'Dimensiune'
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
    empty: 'Selectează un element înainte de a utiliza managerul de atribute',
    label: 'Setările componentei',
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
          placeholder: 'de ex. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Această fereastră',
          _blank: 'Fereastră nouă'
        }
      }
    }
  },
  storageManager: {
    recover: 'Dorești să recuperezi modificările nesalvate?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Poziționare flotantă",
  "display": "Afișare",
  "position": "Poziție",
  "top": "Sus",
  "right": "Dreapta",
  "left": "Stânga",
  "bottom": "Jos",
  "width": "Lățime",
  "height": "Înălțime",
  "max-width": "Lățime maximă",
  "max-height": "Înălțime maximă",
  "margin": "Margine exterioară",
  "margin-top": "Margine exterioară sus",
  "margin-right": "Margine exterioară dreapta",
  "margin-left": "Margine exterioară stânga",
  "margin-bottom": "Margine exterioară jos",
  "padding": "Spațiere interioară",
  "padding-top": "Spațiere interioară sus",
  "padding-left": "Spațiere interioară stânga",
  "padding-right": "Spațiere interioară dreapta",
  "padding-bottom": "Spațiere interioară jos",
  "font-family": "Familie de fonturi",
  "font-size": "Dimensiunea fontului",
  "font-weight": "Grosimea fontului",
  "letter-spacing": "Spațierea literelor",
  "color": "Culoare",
  "line-height": "Înălțimea rândului",
  "text-align": "Alinierea textului",
  "text-shadow": "Umbră text",
  "border-top-left": "Bordură stânga sus",
  "border-top-right": "Bordură dreapta sus",
  "border-bottom-left": "Bordură stânga jos",
  "border-bottom-right": "Bordură dreapta jos",
  "border-radius-top-left": "Rotunjire colț stânga sus",
  "border-radius-top-right": "Rotunjire colț dreapta sus",
  "border-radius-bottom-left": "Rotunjire colț stânga jos",
  "border-radius-bottom-right": "Rotunjire colț dreapta jos",
  "border-radius": "Rotunjirea colțurilor",
  "border": "Bordură",
  "border-width": "Grosimea bordurii",
  "border-style": "Stilul bordurii",
  "border-color": "Culoarea bordurii",
  "box-shadow": "Umbră casetă",
  "background": "Fundal",
  "background-image": "Imagine de fundal",
  "background-repeat": "Repetarea fundalului",
  "background-position": "Poziția fundalului",
  "background-attachment": "Fixarea fundalului",
  "background-size": "Dimensiunea fundalului",
  "background-color": "Culoarea fundalului",
  "transition": "Tranziție",
  "transition-property": "Proprietatea tranziției",
  "transition-duration": "Durata tranziției",
  "transition-timing-function": "Temporizarea tranziției",
  "perspective": "Perspectivă",
  "transform": "Transformare",
  "flex-direction": "Direcția Flex",
  "flex-wrap": "Încadrarea elementelor Flex",
  "justify-content": "Distribuirea conținutului",
  "align-items": "Alinierea elementelor",
  "align-content": "Alinierea conținutului",
  "order": "Ordine",
  "flex-basis": "Dimensiunea de bază Flex",
  "flex-grow": "Factor de extindere Flex",
  "flex-shrink": "Factor de micșorare Flex",
  "align-self": "Aliniere individuală"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Text alternativ",
  "title": "Titlu",
  "href": "Link"
});