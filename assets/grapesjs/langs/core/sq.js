
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'p.sh. Shkruani tekst këtu'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Shto imazh',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Zgjidh imazhin',
    uploadTitle: 'Tërhiqni skedarët këtu ose klikoni për ngarkim'
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
      '': 'Kuti',
      wrapper: 'Trupi i faqes',
      text: 'Tekst',
      comment: 'Koment',
      image: 'Imazh',
      video: 'Video',
      label: 'Etiketë',
      link: 'Lidhje',
      map: 'Hartë',
      tfoot: 'Fundi i tabelës',
      tbody: 'Trupi i tabelës',
      thead: 'Kreu i tabelës',
      table: 'Tabelë',
      row: 'Rresht tabele',
      cell: 'Qelizë tabele'
    }
  },
  deviceManager: {
    device: 'Pajisje',
    devices: {
      desktop: 'Kompjuter',
      tablet: 'Tablet',
      mobileLandscape: 'Telefon (horizontal)',
      mobilePortrait: 'Telefon (vertikal)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Parapamje',
        fullscreen: 'Ekran i plotë',
        'sw-visibility': 'Shfaq komponentët',
        'export-template': 'Shfaq kodin',
        'open-sm': 'Hap menaxherin e stileve',
        'open-tm': 'Cilësimet',
        'open-layers': 'Hap menaxherin e shtresave',
        'open-blocks': 'Hap blloqet'
      }
    }
  },
  selectorManager: {
    label: 'Klasat',
    selected: 'Përzgjedhur',
    emptyState: '- Gjendja -',
    states: {
      hover: 'Kur kursori është sipër',
      active: 'Me klikim',
      'nth-of-type(2n)': 'Çift/Tek'
    }
  },
  styleManager: {
    empty: 'Zgjidhni një element përpara se të përdorni menaxherin e stileve',
    layer: 'Shtresë',
    fileButton: 'Imazhe',
    sectors: {
      general: 'Të përgjithshme',
      layout: 'Paraqitja',
      typography: 'Tipografia',
      decorations: 'Dekorime',
      extra: 'Shtesë',
      flex: 'Flex',
      dimension: 'Përmasat'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Turbullim',
      'text-shadow-color': 'Ngjyrë',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Turbullim',
      'box-shadow-spread': 'Përhapje',
      'box-shadow-color': 'Ngjyrë',
      'box-shadow-type': 'Lloji',
      'margin-top-sub': 'Sipër',
      'margin-right-sub': 'Djathtas',
      'margin-bottom-sub': 'Poshtë',
      'margin-left-sub': 'Majtas',
      'padding-top-sub': 'Sipër',
      'padding-right-sub': 'Djathtas',
      'padding-bottom-sub': 'Poshtë',
      'padding-left-sub': 'Majtas',
      'border-width-sub': 'Gjerësia',
      'border-style-sub': 'Stili',
      'border-color-sub': 'Ngjyra',
      'border-top-left-radius-sub': 'Sipër majtas',
      'border-top-right-radius-sub': 'Sipër djathtas',
      'border-bottom-right-radius-sub': 'Poshtë djathtas',
      'border-bottom-left-radius-sub': 'Poshtë majtas',
      'transform-rotate-x': 'Rrotullim X',
      'transform-rotate-y': 'Rrotullim Y',
      'transform-rotate-z': 'Rrotullim Z',
      'transform-scale-x': 'Shkallëzim X',
      'transform-scale-y': 'Shkallëzim Y',
      'transform-scale-z': 'Shkallëzim Z',
      'transition-property-sub': 'Vetia',
      'transition-duration-sub': 'Kohëzgjatja',
      'transition-timing-function-sub': 'Funksioni kohor',
      'background-image-sub': 'Imazh',
      'background-repeat-sub': 'Përsëritje',
      'background-position-sub': 'Pozicioni',
      'background-attachment-sub': 'Fiksimi',
      'background-size-sub': 'Madhësia'
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
    empty: 'Zgjidhni një element përpara se të përdorni menaxherin e atributeve',
    label: 'Cilësimet e komponentit',
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
          placeholder: 'p.sh. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Kjo dritare',
          _blank: 'Dritare e re'
        }
      }
    }
  },
  storageManager: {
    recover: 'A dëshironi të riktheni ndryshimet e paruajtura?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Pozicionim lundrues",
  "display": "Shfaqja",
  "position": "Pozicioni",
  "top": "Sipër",
  "right": "Djathtas",
  "left": "Majtas",
  "bottom": "Poshtë",
  "width": "Gjerësia",
  "height": "Lartësia",
  "max-width": "Gjerësia maksimale",
  "max-height": "Lartësia maksimale",
  "margin": "Hapësira e jashtme",
  "margin-top": "Hapësira e jashtme sipër",
  "margin-right": "Hapësira e jashtme djathtas",
  "margin-left": "Hapësira e jashtme majtas",
  "margin-bottom": "Hapësira e jashtme poshtë",
  "padding": "Hapësira e brendshme",
  "padding-top": "Hapësira e brendshme sipër",
  "padding-left": "Hapësira e brendshme majtas",
  "padding-right": "Hapësira e brendshme djathtas",
  "padding-bottom": "Hapësira e brendshme poshtë",
  "font-family": "Familja e fontit",
  "font-size": "Madhësia e fontit",
  "font-weight": "Trashësia e fontit",
  "letter-spacing": "Hapësira ndërmjet shkronjave",
  "color": "Ngjyra",
  "line-height": "Lartësia e rreshtit",
  "text-align": "Rreshtimi i tekstit",
  "text-shadow": "Hija e tekstit",
  "border-top-left": "Korniza sipër majtas",
  "border-top-right": "Korniza sipër djathtas",
  "border-bottom-left": "Korniza poshtë majtas",
  "border-bottom-right": "Korniza poshtë djathtas",
  "border-radius-top-left": "Rrumbullakimi i këndit sipër majtas",
  "border-radius-top-right": "Rrumbullakimi i këndit sipër djathtas",
  "border-radius-bottom-left": "Rrumbullakimi i këndit poshtë majtas",
  "border-radius-bottom-right": "Rrumbullakimi i këndit poshtë djathtas",
  "border-radius": "Rrumbullakimi i këndeve",
  "border": "Korniza",
  "border-width": "Trashësia e kornizës",
  "border-style": "Stili i kornizës",
  "border-color": "Ngjyra e kornizës",
  "box-shadow": "Hija e kutisë",
  "background": "Sfondi",
  "background-image": "Imazhi i sfondit",
  "background-repeat": "Përsëritja e sfondit",
  "background-position": "Pozicioni i sfondit",
  "background-attachment": "Fiksimi i sfondit",
  "background-size": "Madhësia e sfondit",
  "background-color": "Ngjyra e sfondit",
  "transition": "Tranzicioni",
  "transition-property": "Vetia e tranzicionit",
  "transition-duration": "Kohëzgjatja e tranzicionit",
  "transition-timing-function": "Funksioni kohor i tranzicionit",
  "perspective": "Perspektiva",
  "transform": "Transformimi",
  "flex-direction": "Drejtimi Flex",
  "flex-wrap": "Kalimi në rresht i elementeve Flex",
  "justify-content": "Shpërndarja e përmbajtjes",
  "align-items": "Rreshtimi i elementeve",
  "align-content": "Rreshtimi i përmbajtjes",
  "order": "Renditja",
  "flex-basis": "Madhësia bazë Flex",
  "flex-grow": "Zgjerimi Flex",
  "flex-shrink": "Tkurrja Flex",
  "align-self": "Rreshtimi individual"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Tekst alternativ",
  "title": "Titulli",
  "href": "Lidhja"
});
