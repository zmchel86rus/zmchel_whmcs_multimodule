
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 't.ex. Text här'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Lägg till bild',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Välj bild',
    uploadTitle: 'Släpp filer här eller klicka för att ladda upp'
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
      '': 'Ruta',
      wrapper: 'Sidans innehåll',
      text: 'Text',
      comment: 'Kommentar',
      image: 'Bild',
      video: 'Video',
      label: 'Etikett',
      link: 'Länk',
      map: 'Karta',
      tfoot: 'Tabellfot',
      tbody: 'Tabellinnehåll',
      thead: 'Tabellhuvud',
      table: 'Tabell',
      row: 'Tabellrad',
      cell: 'Tabellcell'
    }
  },
  deviceManager: {
    device: 'Enhet',
    devices: {
      desktop: 'Dator',
      tablet: 'Surfplatta',
      mobileLandscape: 'Mobil (liggande)',
      mobilePortrait: 'Mobil (stående)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Förhandsvisning',
        fullscreen: 'Helskärm',
        'sw-visibility': 'Visa komponenter',
        'export-template': 'Visa kod',
        'open-sm': 'Öppna stilhanteraren',
        'open-tm': 'Inställningar',
        'open-layers': 'Öppna lagerhanteraren',
        'open-blocks': 'Öppna block'
      }
    }
  },
  selectorManager: {
    label: 'Klasser',
    selected: 'Vald',
    emptyState: '- Tillstånd -',
    states: {
      hover: 'När muspekaren är över',
      active: 'Vid klick',
      'nth-of-type(2n)': 'Jämna/udda'
    }
  },
  styleManager: {
    empty: 'Välj ett element innan du använder stilhanteraren',
    layer: 'Lager',
    fileButton: 'Bilder',
    sectors: {
      general: 'Allmänt',
      layout: 'Layout',
      typography: 'Typografi',
      decorations: 'Dekorationer',
      extra: 'Extra',
      flex: 'Flex',
      dimension: 'Dimensioner'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Oskärpa',
      'text-shadow-color': 'Färg',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Oskärpa',
      'box-shadow-spread': 'Spridning',
      'box-shadow-color': 'Färg',
      'box-shadow-type': 'Typ',
      'margin-top-sub': 'Överst',
      'margin-right-sub': 'Höger',
      'margin-bottom-sub': 'Nederst',
      'margin-left-sub': 'Vänster',
      'padding-top-sub': 'Överst',
      'padding-right-sub': 'Höger',
      'padding-bottom-sub': 'Nederst',
      'padding-left-sub': 'Vänster',
      'border-width-sub': 'Bredd',
      'border-style-sub': 'Stil',
      'border-color-sub': 'Färg',
      'border-top-left-radius-sub': 'Övre vänstra hörnet',
      'border-top-right-radius-sub': 'Övre högra hörnet',
      'border-bottom-right-radius-sub': 'Nedre högra hörnet',
      'border-bottom-left-radius-sub': 'Nedre vänstra hörnet',
      'transform-rotate-x': 'Rotation X',
      'transform-rotate-y': 'Rotation Y',
      'transform-rotate-z': 'Rotation Z',
      'transform-scale-x': 'Skala X',
      'transform-scale-y': 'Skala Y',
      'transform-scale-z': 'Skala Z',
      'transition-property-sub': 'Egenskap',
      'transition-duration-sub': 'Varaktighet',
      'transition-timing-function-sub': 'Tidsfunktion',
      'background-image-sub': 'Bild',
      'background-repeat-sub': 'Upprepning',
      'background-position-sub': 'Position',
      'background-attachment-sub': 'Fästläge',
      'background-size-sub': 'Storlek'
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
    empty: 'Välj ett element innan du använder attributshanteraren',
    label: 'Komponentinställningar',
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
          placeholder: 't.ex. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Det här fönstret',
          _blank: 'Nytt fönster'
        }
      }
    }
  },
  storageManager: {
    recover: 'Vill du återställa osparade ändringar?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Flyt",
  "display": "Visning",
  "position": "Position",
  "top": "Överkant",
  "right": "Höger",
  "left": "Vänster",
  "bottom": "Underkant",
  "width": "Bredd",
  "height": "Höjd",
  "max-width": "Bredd (max.)",
  "max-height": "Höjd (max.)",
  "margin": "Marginal",
  "margin-top": "Marginal: överkant",
  "margin-right": "Marginal: höger",
  "margin-left": "Marginal: vänster",
  "margin-bottom": "Marginal: underkant",
  "padding": "Utfyllnad",
  "padding-top": "Utfyllnad: överkant",
  "padding-left": "Utfyllnad: vänster",
  "padding-right": "Utfyllnad: höger",
  "padding-bottom": "Utfyllnad: underkant",
  "font-family": "Typsnitt: familj",
  "font-size": "Typsnitt: storlek",
  "font-weight": "Typsnitt: vikt",
  "letter-spacing": "Bokstäver: avstånd",
  "color": "Färg",
  "line-height": "Rad: höjd",
  "text-align": "Text: justering",
  "text-shadow": "Text: skugga",
  "border-top-left": "Kantlinje: överkant · vänster",
  "border-top-right": "Kantlinje: överkant · höger",
  "border-bottom-left": "Kantlinje: underkant · vänster",
  "border-bottom-right": "Kantlinje: underkant · höger",
  "border-radius-top-left": "Kantlinje: radie · överkant · vänster",
  "border-radius-top-right": "Kantlinje: radie · överkant · höger",
  "border-radius-bottom-left": "Kantlinje: radie · underkant · vänster",
  "border-radius-bottom-right": "Kantlinje: radie · underkant · höger",
  "border-radius": "Kantlinje: radie",
  "border": "Kantlinje",
  "border-width": "Kantlinje: bredd",
  "border-style": "Kantlinje: stil",
  "border-color": "Kantlinje: färg",
  "box-shadow": "Ruta: skugga",
  "background": "Bakgrund",
  "background-image": "Bakgrund: bild",
  "background-repeat": "Bakgrund: upprepning",
  "background-position": "Bakgrund: position",
  "background-attachment": "Bakgrund: fäste",
  "background-size": "Bakgrund: storlek",
  "background-color": "Bakgrund: färg",
  "transition": "Övergång",
  "transition-property": "Övergång: egenskap",
  "transition-duration": "Övergång: varaktighet",
  "transition-timing-function": "Övergång: tidsinställning",
  "perspective": "Perspektiv",
  "transform": "Omvandling",
  "flex-direction": "Flex: riktning",
  "flex-wrap": "Flex: radbrytning",
  "justify-content": "Fördelning: innehåll",
  "align-items": "Justering: objekt",
  "align-content": "Justering: innehåll",
  "order": "Ordning",
  "flex-basis": "Flex: bas",
  "flex-grow": "Flex: tillväxt",
  "flex-shrink": "Flex: krympning",
  "align-self": "Justering: egen"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternativ text",
  "title": "Titel",
  "href": "Länk"
});
