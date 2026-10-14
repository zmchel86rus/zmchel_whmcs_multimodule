
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'nt Tekst siia'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Lisa pilt',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Vali pilt',
    uploadTitle: 'Lohistage failid siia või klõpsake üleslaadimiseks'
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
      '': 'Kast',
      wrapper: 'Lehe sisu',
      text: 'Tekst',
      comment: 'Kommentaar',
      image: 'Pilt',
      video: 'Video',
      label: 'Silt',
      link: 'Link',
      map: 'Kaart',
      tfoot: 'Tabeli jalus',
      tbody: 'Tabeli sisu',
      thead: 'Tabeli päis',
      table: 'Tabel',
      row: 'Tabeli rida',
      cell: 'Tabeli lahter'
    }
  },
  deviceManager: {
    device: 'Seade',
    devices: {
      desktop: 'Lauaarvuti',
      tablet: 'Tahvelarvuti',
      mobileLandscape: 'Mobiil (rõhtpaigutus)',
      mobilePortrait: 'Mobiil (püstpaigutus)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Eelvaade',
        fullscreen: 'Täisekraan',
        'sw-visibility': 'Näita komponente',
        'export-template': 'Kuva kood',
        'open-sm': 'Ava stiilihaldur',
        'open-tm': 'Seaded',
        'open-layers': 'Ava kihtide haldur',
        'open-blocks': 'Ava plokid'
      }
    }
  },
  selectorManager: {
    label: 'Klassid',
    selected: 'Valitud',
    emptyState: '- Olek -',
    states: {
      hover: 'Hiirega osutamine',
      active: 'Klõps',
      'nth-of-type(2n)': 'Paaris/paaritu'
    }
  },
  styleManager: {
    empty: 'Enne stiilihalduri kasutamist valige element',
    layer: 'Kiht',
    fileButton: 'Pildid',
    sectors: {
      general: 'Üldine',
      layout: 'Paigutus',
      typography: 'Tüpograafia',
      decorations: 'Kujundus',
      extra: 'Lisad',
      flex: 'Flex',
      dimension: 'Mõõtmed'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Hägusus',
      'text-shadow-color': 'Värv',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Hägusus',
      'box-shadow-spread': 'Ulatus',
      'box-shadow-color': 'Värv',
      'box-shadow-type': 'Tüüp',
      'margin-top-sub': 'Üleval',
      'margin-right-sub': 'Paremal',
      'margin-bottom-sub': 'All',
      'margin-left-sub': 'Vasakul',
      'padding-top-sub': 'Üleval',
      'padding-right-sub': 'Paremal',
      'padding-bottom-sub': 'All',
      'padding-left-sub': 'Vasakul',
      'border-width-sub': 'Laius',
      'border-style-sub': 'Stiil',
      'border-color-sub': 'Värv',
      'border-top-left-radius-sub': 'Ülemine vasak nurk',
      'border-top-right-radius-sub': 'Ülemine parem nurk',
      'border-bottom-right-radius-sub': 'Alumine parem nurk',
      'border-bottom-left-radius-sub': 'Alumine vasak nurk',
      'transform-rotate-x': 'Pööre X',
      'transform-rotate-y': 'Pööre Y',
      'transform-rotate-z': 'Pööre Z',
      'transform-scale-x': 'Skaala X',
      'transform-scale-y': 'Skaala Y',
      'transform-scale-z': 'Skaala Z',
      'transition-property-sub': 'Omadus',
      'transition-duration-sub': 'Kestus',
      'transition-timing-function-sub': 'Ajastus',
      'background-image-sub': 'Pilt',
      'background-repeat-sub': 'Kordamine',
      'background-position-sub': 'Asukoht',
      'background-attachment-sub': 'Kinnitus',
      'background-size-sub': 'Suurus'
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
    empty: 'Enne atribuutide halduri kasutamist valige element',
    label: 'Komponendi seaded',
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
          placeholder: 'nt https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'See aken',
          _blank: 'Uus aken'
        }
      }
    }
  },
  storageManager: {
    recover: 'Kas soovite taastada salvestamata muudatused?'
  }
};

// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Hõljumine",
  "display": "Kuvamine",
  "position": "Asukoht",
  "top": "Üleval",
  "right": "Paremal",
  "left": "Vasakul",
  "bottom": "All",
  "width": "Laius",
  "height": "Kõrgus",
  "max-width": "Laius (max.)",
  "max-height": "Kõrgus (max.)",
  "margin": "Veeris",
  "margin-top": "Veeris: üleval",
  "margin-right": "Veeris: paremal",
  "margin-left": "Veeris: vasakul",
  "margin-bottom": "Veeris: all",
  "padding": "Siseveeris",
  "padding-top": "Siseveeris: üleval",
  "padding-left": "Siseveeris: vasakul",
  "padding-right": "Siseveeris: paremal",
  "padding-bottom": "Siseveeris: all",
  "font-family": "Font: perekond",
  "font-size": "Font: suurus",
  "font-weight": "Font: paksus",
  "letter-spacing": "Tähed: vahe",
  "color": "Värv",
  "line-height": "Rida: kõrgus",
  "text-align": "Tekst: joondus",
  "text-shadow": "Tekst: vari",
  "border-top-left": "Ääris: üleval · vasakul",
  "border-top-right": "Ääris: üleval · paremal",
  "border-bottom-left": "Ääris: all · vasakul",
  "border-bottom-right": "Ääris: all · paremal",
  "border-radius-top-left": "Ääris: raadius · üleval · vasakul",
  "border-radius-top-right": "Ääris: raadius · üleval · paremal",
  "border-radius-bottom-left": "Ääris: raadius · all · vasakul",
  "border-radius-bottom-right": "Ääris: raadius · all · paremal",
  "border-radius": "Ääris: raadius",
  "border": "Ääris",
  "border-width": "Ääris: laius",
  "border-style": "Ääris: stiil",
  "border-color": "Ääris: värv",
  "box-shadow": "Kast: vari",
  "background": "Taust",
  "background-image": "Taust: pilt",
  "background-repeat": "Taust: kordus",
  "background-position": "Taust: asukoht",
  "background-attachment": "Taust: kinnitus",
  "background-size": "Taust: suurus",
  "background-color": "Taust: värv",
  "transition": "Üleminek",
  "transition-property": "Üleminek: omadus",
  "transition-duration": "Üleminek: kestus",
  "transition-timing-function": "Üleminek: ajastus",
  "perspective": "Perspektiiv",
  "transform": "Teisendus",
  "flex-direction": "Flex: suund",
  "flex-wrap": "Flex: murdmine",
  "justify-content": "Jaotus: sisu",
  "align-items": "Joondus: elemendid",
  "align-content": "Joondus: sisu",
  "order": "Järjekord",
  "flex-basis": "Flex: alus",
  "flex-grow": "Flex: kasv",
  "flex-shrink": "Flex: kahanemine",
  "align-self": "Joondus: enda"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternatiivtekst",
  "title": "Pealkiri",
  "href": "Link"
});
