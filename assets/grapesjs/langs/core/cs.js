
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'např. Text zde'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Přidat obrázek',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Vybrat obrázek',
    uploadTitle: 'Přetáhněte soubory sem nebo klikněte pro nahrání'
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
      '': 'Kontejner',
      wrapper: 'Tělo stránky',
      text: 'Text',
      comment: 'Komentář',
      image: 'Obrázek',
      video: 'Video',
      label: 'Popisek',
      link: 'Odkaz',
      map: 'Mapa',
      tfoot: 'Zápatí tabulky',
      tbody: 'Tělo tabulky',
      thead: 'Záhlaví tabulky',
      table: 'Tabulka',
      row: 'Řádek tabulky',
      cell: 'Buňka tabulky'
    }
  },
  deviceManager: {
    device: 'Zařízení',
    devices: {
      desktop: 'Počítač',
      tablet: 'Tablet',
      mobileLandscape: 'Mobil (na šířku)',
      mobilePortrait: 'Mobil (na výšku)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Náhled',
        fullscreen: 'Celá obrazovka',
        'sw-visibility': 'Zobrazit komponenty',
        'export-template': 'Zobrazit kód',
        'open-sm': 'Otevřít správce stylů',
        'open-tm': 'Nastavení',
        'open-layers': 'Otevřít správce vrstev',
        'open-blocks': 'Otevřít bloky'
      }
    }
  },
  selectorManager: {
    label: 'Třídy',
    selected: 'Vybráno',
    emptyState: '- Stav -',
    states: {
      hover: 'Při najetí myší',
      active: 'Při kliknutí',
      'nth-of-type(2n)': 'Sudé/liché'
    }
  },
  styleManager: {
    empty: 'Před použitím správce stylů vyberte prvek',
    layer: 'Vrstva',
    fileButton: 'Obrázky',
    sectors: {
      general: 'Obecné',
      layout: 'Rozvržení',
      typography: 'Typografie',
      decorations: 'Dekorace',
      extra: 'Další',
      flex: 'Flex',
      dimension: 'Rozměry'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Rozostření',
      'text-shadow-color': 'Barva',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Rozostření',
      'box-shadow-spread': 'Rozšíření',
      'box-shadow-color': 'Barva',
      'box-shadow-type': 'Typ',
      'margin-top-sub': 'Nahoře',
      'margin-right-sub': 'Vpravo',
      'margin-bottom-sub': 'Dole',
      'margin-left-sub': 'Vlevo',
      'padding-top-sub': 'Nahoře',
      'padding-right-sub': 'Vpravo',
      'padding-bottom-sub': 'Dole',
      'padding-left-sub': 'Vlevo',
      'border-width-sub': 'Šířka',
      'border-style-sub': 'Styl',
      'border-color-sub': 'Barva',
      'border-top-left-radius-sub': 'Levý horní roh',
      'border-top-right-radius-sub': 'Pravý horní roh',
      'border-bottom-right-radius-sub': 'Pravý dolní roh',
      'border-bottom-left-radius-sub': 'Levý dolní roh',
      'transform-rotate-x': 'Otočení X',
      'transform-rotate-y': 'Otočení Y',
      'transform-rotate-z': 'Otočení Z',
      'transform-scale-x': 'Měřítko X',
      'transform-scale-y': 'Měřítko Y',
      'transform-scale-z': 'Měřítko Z',
      'transition-property-sub': 'Vlastnost',
      'transition-duration-sub': 'Doba trvání',
      'transition-timing-function-sub': 'Časování',
      'background-image-sub': 'Obrázek',
      'background-repeat-sub': 'Opakování',
      'background-position-sub': 'Pozice',
      'background-attachment-sub': 'Ukotvení',
      'background-size-sub': 'Velikost'
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
    empty: 'Před použitím správce atributů vyberte prvek',
    label: 'Nastavení komponenty',
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
          placeholder: 'např. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Toto okno',
          _blank: 'Nové okno'
        }
      }
    }
  },
  storageManager: {
    recover: 'Chcete obnovit neuložené změny?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Obtékání",
  "display": "Zobrazení",
  "position": "Pozice",
  "top": "Nahoře",
  "right": "Vpravo",
  "left": "Vlevo",
  "bottom": "Dole",
  "width": "Šířka",
  "height": "Výška",
  "max-width": "Šířka (max.)",
  "max-height": "Výška (max.)",
  "margin": "Okraj",
  "margin-top": "Okraj: nahoře",
  "margin-right": "Okraj: vpravo",
  "margin-left": "Okraj: vlevo",
  "margin-bottom": "Okraj: dole",
  "padding": "Vnitřní odsazení",
  "padding-top": "Vnitřní odsazení: nahoře",
  "padding-left": "Vnitřní odsazení: vlevo",
  "padding-right": "Vnitřní odsazení: vpravo",
  "padding-bottom": "Vnitřní odsazení: dole",
  "font-family": "Písmo: rodina",
  "font-size": "Písmo: velikost",
  "font-weight": "Písmo: tloušťka",
  "letter-spacing": "Písmena: mezery",
  "color": "Barva",
  "line-height": "Řádek: výška",
  "text-align": "Text: zarovnání",
  "text-shadow": "Text: stín",
  "border-top-left": "Ohraničení: nahoře · vlevo",
  "border-top-right": "Ohraničení: nahoře · vpravo",
  "border-bottom-left": "Ohraničení: dole · vlevo",
  "border-bottom-right": "Ohraničení: dole · vpravo",
  "border-radius-top-left": "Ohraničení: poloměr · nahoře · vlevo",
  "border-radius-top-right": "Ohraničení: poloměr · nahoře · vpravo",
  "border-radius-bottom-left": "Ohraničení: poloměr · dole · vlevo",
  "border-radius-bottom-right": "Ohraničení: poloměr · dole · vpravo",
  "border-radius": "Ohraničení: poloměr",
  "border": "Ohraničení",
  "border-width": "Ohraničení: šířka",
  "border-style": "Ohraničení: styl",
  "border-color": "Ohraničení: barva",
  "box-shadow": "Rámeček: stín",
  "background": "Pozadí",
  "background-image": "Pozadí: obrázek",
  "background-repeat": "Pozadí: opakování",
  "background-position": "Pozadí: pozice",
  "background-attachment": "Pozadí: ukotvení",
  "background-size": "Pozadí: velikost",
  "background-color": "Pozadí: barva",
  "transition": "Přechod",
  "transition-property": "Přechod: vlastnost",
  "transition-duration": "Přechod: doba trvání",
  "transition-timing-function": "Přechod: časování",
  "perspective": "Perspektiva",
  "transform": "Transformace",
  "flex-direction": "Flex: směr",
  "flex-wrap": "Flex: zalomení",
  "justify-content": "Rozložení: obsah",
  "align-items": "Zarovnání: položky",
  "align-content": "Zarovnání: obsah",
  "order": "Pořadí",
  "flex-basis": "Flex: základ",
  "flex-grow": "Flex: růst",
  "flex-shrink": "Flex: zmenšení",
  "align-self": "Zarovnání: vlastní"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternativní text",
  "title": "Název",
  "href": "Odkaz"
});
