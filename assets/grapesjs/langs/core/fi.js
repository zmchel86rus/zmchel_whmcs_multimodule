"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'esim. Teksti tähän'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Lisää kuva',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Valitse kuva',
    uploadTitle: 'Pudota tiedostot tähän tai napsauta ladataksesi'
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
      '': 'Laatikko',
      wrapper: 'Sivun runko',
      text: 'Teksti',
      comment: 'Kommentti',
      image: 'Kuva',
      video: 'Video',
      label: 'Tunniste',
      link: 'Linkki',
      map: 'Kartta',
      tfoot: 'Taulukon alatunniste',
      tbody: 'Taulukon sisältö',
      thead: 'Taulukon ylätunniste',
      table: 'Taulukko',
      row: 'Taulukon rivi',
      cell: 'Taulukon solu'
    }
  },
  deviceManager: {
    device: 'Laite',
    devices: {
      desktop: 'Tietokone',
      tablet: 'Tabletti',
      mobileLandscape: 'Mobiili (vaaka)',
      mobilePortrait: 'Mobiili (pysty)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Esikatselu',
        fullscreen: 'Koko näyttö',
        'sw-visibility': 'Näytä komponentit',
        'export-template': 'Näytä koodi',
        'open-sm': 'Avaa tyylien hallinta',
        'open-tm': 'Asetukset',
        'open-layers': 'Avaa tasojen hallinta',
        'open-blocks': 'Avaa lohkot'
      }
    }
  },
  selectorManager: {
    label: 'Luokat',
    selected: 'Valittu',
    emptyState: '- Tila -',
    states: {
      hover: 'Osoitin kohdalla',
      active: 'Napsautus',
      'nth-of-type(2n)': 'Parilliset/parittomat'
    }
  },
  styleManager: {
    empty: 'Valitse elementti ennen tyylien hallinnan käyttöä',
    layer: 'Taso',
    fileButton: 'Kuvat',
    sectors: {
      general: 'Yleiset',
      layout: 'Asettelu',
      typography: 'Typografia',
      decorations: 'Koristeet',
      extra: 'Lisäasetukset',
      flex: 'Flex',
      dimension: 'Mitat'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Sumennus',
      'text-shadow-color': 'Väri',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Sumennus',
      'box-shadow-spread': 'Leviäminen',
      'box-shadow-color': 'Väri',
      'box-shadow-type': 'Tyyppi',
      'margin-top-sub': 'Ylhäällä',
      'margin-right-sub': 'Oikealla',
      'margin-bottom-sub': 'Alhaalla',
      'margin-left-sub': 'Vasemmalla',
      'padding-top-sub': 'Ylhäällä',
      'padding-right-sub': 'Oikealla',
      'padding-bottom-sub': 'Alhaalla',
      'padding-left-sub': 'Vasemmalla',
      'border-width-sub': 'Leveys',
      'border-style-sub': 'Tyyli',
      'border-color-sub': 'Väri',
      'border-top-left-radius-sub': 'Vasen yläkulma',
      'border-top-right-radius-sub': 'Oikea yläkulma',
      'border-bottom-right-radius-sub': 'Oikea alakulma',
      'border-bottom-left-radius-sub': 'Vasen alakulma',
      'transform-rotate-x': 'Kierto X',
      'transform-rotate-y': 'Kierto Y',
      'transform-rotate-z': 'Kierto Z',
      'transform-scale-x': 'Skaalaus X',
      'transform-scale-y': 'Skaalaus Y',
      'transform-scale-z': 'Skaalaus Z',
      'transition-property-sub': 'Ominaisuus',
      'transition-duration-sub': 'Kesto',
      'transition-timing-function-sub': 'Ajoitus',
      'background-image-sub': 'Kuva',
      'background-repeat-sub': 'Toisto',
      'background-position-sub': 'Sijainti',
      'background-attachment-sub': 'Kiinnitys',
      'background-size-sub': 'Koko'
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
    empty: 'Valitse elementti ennen ominaisuuksien hallinnan käyttöä',
    label: 'Komponentin asetukset',
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
          placeholder: 'esim. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Tämä ikkuna',
          _blank: 'Uusi ikkuna'
        }
      }
    }
  },
  storageManager: {
    recover: 'Haluatko palauttaa tallentamattomat muutokset?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Kellutus",
  "display": "Näyttötapa",
  "position": "Sijainti",
  "top": "Yläreuna",
  "right": "Oikea reuna",
  "left": "Vasen reuna",
  "bottom": "Alareuna",
  "width": "Leveys",
  "height": "Korkeus",
  "max-width": "Enimmäisleveys",
  "max-height": "Enimmäiskorkeus",
  "margin": "Ulkomarginaali",
  "margin-top": "Ylämarginaali",
  "margin-right": "Oikea ulkomarginaali",
  "margin-left": "Vasen ulkomarginaali",
  "margin-bottom": "Alamarginaali",
  "padding": "Sisämarginaali",
  "padding-top": "Yläsisämarginaali",
  "padding-left": "Vasen sisämarginaali",
  "padding-right": "Oikea sisämarginaali",
  "padding-bottom": "Alasisämarginaali",
  "font-family": "Fonttiperhe",
  "font-size": "Fonttikoko",
  "font-weight": "Fontin paksuus",
  "letter-spacing": "Merkkiväli",
  "color": "Väri",
  "line-height": "Rivikorkeus",
  "text-align": "Tekstin tasaus",
  "text-shadow": "Tekstin varjo",
  "border-top-left": "Vasemman yläkulman reunus",
  "border-top-right": "Oikean yläkulman reunus",
  "border-bottom-left": "Vasemman alakulman reunus",
  "border-bottom-right": "Oikean alakulman reunus",
  "border-radius-top-left": "Vasemman yläkulman pyöristys",
  "border-radius-top-right": "Oikean yläkulman pyöristys",
  "border-radius-bottom-left": "Vasemman alakulman pyöristys",
  "border-radius-bottom-right": "Oikean alakulman pyöristys",
  "border-radius": "Kulmien pyöristys",
  "border": "Reunus",
  "border-width": "Reunuksen leveys",
  "border-style": "Reunuksen tyyli",
  "border-color": "Reunuksen väri",
  "box-shadow": "Laatikon varjo",
  "background": "Tausta",
  "background-image": "Taustakuva",
  "background-repeat": "Taustan toisto",
  "background-position": "Taustan sijainti",
  "background-attachment": "Taustan kiinnitys",
  "background-size": "Taustan koko",
  "background-color": "Taustaväri",
  "transition": "Siirtymä",
  "transition-property": "Siirtymän ominaisuus",
  "transition-duration": "Siirtymän kesto",
  "transition-timing-function": "Siirtymän ajoitus",
  "perspective": "Perspektiivi",
  "transform": "Muunnos",
  "flex-direction": "Flex-suunta",
  "flex-wrap": "Flex-rivitys",
  "justify-content": "Sisällön jakautuminen",
  "align-items": "Elementtien tasaus",
  "align-content": "Sisällön kohdistus",
  "order": "Järjestys",
  "flex-basis": "Flex-peruskoko",
  "flex-grow": "Flex-kasvu",
  "flex-shrink": "Flex-kutistuminen",
  "align-self": "Oma tasaus"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Vaihtoehtoinen teksti",
  "title": "Otsikko",
  "href": "Linkki"
});
