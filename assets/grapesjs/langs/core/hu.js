
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'pl. Írjon ide szöveget'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Kép hozzáadása',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Kép kiválasztása',
    uploadTitle: 'Húzza ide a fájlokat, vagy kattintson a feltöltéshez'
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
      '': 'Doboz',
      wrapper: 'Oldal törzse',
      text: 'Szöveg',
      comment: 'Megjegyzés',
      image: 'Kép',
      video: 'Videó',
      label: 'Címke',
      link: 'Hivatkozás',
      map: 'Térkép',
      tfoot: 'Táblázat lábléce',
      tbody: 'Táblázat törzse',
      thead: 'Táblázat fejléce',
      table: 'Táblázat',
      row: 'Táblázatsor',
      cell: 'Táblázatcella'
    }
  },
  deviceManager: {
    device: 'Eszköz',
    devices: {
      desktop: 'Asztali számítógép',
      tablet: 'Táblagép',
      mobileLandscape: 'Mobil (fekvő)',
      mobilePortrait: 'Mobil (álló)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Előnézet',
        fullscreen: 'Teljes képernyő',
        'sw-visibility': 'Összetevők megjelenítése',
        'export-template': 'Kód megtekintése',
        'open-sm': 'Stíluskezelő megnyitása',
        'open-tm': 'Beállítások',
        'open-layers': 'Rétegkezelő megnyitása',
        'open-blocks': 'Blokkok megnyitása'
      }
    }
  },
  selectorManager: {
    label: 'Osztályok',
    selected: 'Kijelölve',
    emptyState: '- Állapot -',
    states: {
      hover: 'Rámutatás',
      active: 'Kattintás',
      'nth-of-type(2n)': 'Páros/páratlan'
    }
  },
  styleManager: {
    empty: 'A stíluskezelő használata előtt jelöljön ki egy elemet',
    layer: 'Réteg',
    fileButton: 'Képek',
    sectors: {
      general: 'Általános',
      layout: 'Elrendezés',
      typography: 'Tipográfia',
      decorations: 'Díszítések',
      extra: 'Egyéb',
      flex: 'Flex',
      dimension: 'Méretek'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Elmosás',
      'text-shadow-color': 'Szín',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Elmosás',
      'box-shadow-spread': 'Kiterjedés',
      'box-shadow-color': 'Szín',
      'box-shadow-type': 'Típus',
      'margin-top-sub': 'Felső',
      'margin-right-sub': 'Jobb',
      'margin-bottom-sub': 'Alsó',
      'margin-left-sub': 'Bal',
      'padding-top-sub': 'Felső',
      'padding-right-sub': 'Jobb',
      'padding-bottom-sub': 'Alsó',
      'padding-left-sub': 'Bal',
      'border-width-sub': 'Szélesség',
      'border-style-sub': 'Stílus',
      'border-color-sub': 'Szín',
      'border-top-left-radius-sub': 'Bal felső sarok',
      'border-top-right-radius-sub': 'Jobb felső sarok',
      'border-bottom-right-radius-sub': 'Jobb alsó sarok',
      'border-bottom-left-radius-sub': 'Bal alsó sarok',
      'transform-rotate-x': 'Forgatás X',
      'transform-rotate-y': 'Forgatás Y',
      'transform-rotate-z': 'Forgatás Z',
      'transform-scale-x': 'Skálázás X',
      'transform-scale-y': 'Skálázás Y',
      'transform-scale-z': 'Skálázás Z',
      'transition-property-sub': 'Tulajdonság',
      'transition-duration-sub': 'Időtartam',
      'transition-timing-function-sub': 'Időzítés',
      'background-image-sub': 'Kép',
      'background-repeat-sub': 'Ismétlés',
      'background-position-sub': 'Pozíció',
      'background-attachment-sub': 'Rögzítés',
      'background-size-sub': 'Méret'
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
    empty: 'Az attribútumkezelő használata előtt jelöljön ki egy elemet',
    label: 'Összetevő beállításai',
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
          placeholder: 'pl. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Ez az ablak',
          _blank: 'Új ablak'
        }
      }
    }
  },
  storageManager: {
    recover: 'Szeretné visszaállítani a nem mentett módosításokat?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Lebegtetés",
  "display": "Megjelenítés",
  "position": "Pozíció",
  "top": "Fent",
  "right": "Jobb",
  "left": "Bal",
  "bottom": "Lent",
  "width": "Szélesség",
  "height": "Magasság",
  "max-width": "Szélesség (max.)",
  "max-height": "Magasság (max.)",
  "margin": "Margó",
  "margin-top": "Margó: fent",
  "margin-right": "Margó: jobb",
  "margin-left": "Margó: bal",
  "margin-bottom": "Margó: lent",
  "padding": "Belső margó",
  "padding-top": "Belső margó: fent",
  "padding-left": "Belső margó: bal",
  "padding-right": "Belső margó: jobb",
  "padding-bottom": "Belső margó: lent",
  "font-family": "Betűtípus: család",
  "font-size": "Betűtípus: méret",
  "font-weight": "Betűtípus: vastagság",
  "letter-spacing": "Betűk: térköz",
  "color": "Szín",
  "line-height": "Sor: magasság",
  "text-align": "Szöveg: igazítás",
  "text-shadow": "Szöveg: árnyék",
  "border-top-left": "Szegély: fent · bal",
  "border-top-right": "Szegély: fent · jobb",
  "border-bottom-left": "Szegély: lent · bal",
  "border-bottom-right": "Szegély: lent · jobb",
  "border-radius-top-left": "Szegély: sugár · fent · bal",
  "border-radius-top-right": "Szegély: sugár · fent · jobb",
  "border-radius-bottom-left": "Szegély: sugár · lent · bal",
  "border-radius-bottom-right": "Szegély: sugár · lent · jobb",
  "border-radius": "Szegély: sugár",
  "border": "Szegély",
  "border-width": "Szegély: szélesség",
  "border-style": "Szegély: stílus",
  "border-color": "Szegély: szín",
  "box-shadow": "Doboz: árnyék",
  "background": "Háttér",
  "background-image": "Háttér: kép",
  "background-repeat": "Háttér: ismétlés",
  "background-position": "Háttér: pozíció",
  "background-attachment": "Háttér: rögzítés",
  "background-size": "Háttér: méret",
  "background-color": "Háttér: szín",
  "transition": "Átmenet",
  "transition-property": "Átmenet: tulajdonság",
  "transition-duration": "Átmenet: időtartam",
  "transition-timing-function": "Átmenet: időzítés",
  "perspective": "Perspektíva",
  "transform": "Átalakítás",
  "flex-direction": "Flex: irány",
  "flex-wrap": "Flex: tördelés",
  "justify-content": "Elosztás: tartalom",
  "align-items": "Igazítás: elemek",
  "align-content": "Igazítás: tartalom",
  "order": "Sorrend",
  "flex-basis": "Flex: alap",
  "flex-grow": "Flex: növekedés",
  "flex-shrink": "Flex: zsugorodás",
  "align-self": "Igazítás: saját"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternatív szöveg",
  "title": "Cím",
  "href": "Hivatkozás"
});
