
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'f.eks. Tekst her'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Legg til bilde',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Velg bilde',
    uploadTitle: 'Dra filer hit eller klikk for å laste opp'
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
      '': 'Boks',
      wrapper: 'Sideinnhold',
      text: 'Tekst',
      comment: 'Kommentar',
      image: 'Bilde',
      video: 'Video',
      label: 'Etikett',
      link: 'Lenke',
      map: 'Kart',
      tfoot: 'Tabellfot',
      tbody: 'Tabellinnhold',
      thead: 'Tabellhode',
      table: 'Tabell',
      row: 'Tabellrad',
      cell: 'Tabellcelle'
    }
  },
  deviceManager: {
    device: 'Enhet',
    devices: {
      desktop: 'Datamaskin',
      tablet: 'Nettbrett',
      mobileLandscape: 'Mobil (liggende)',
      mobilePortrait: 'Mobil (stående)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Forhåndsvisning',
        fullscreen: 'Fullskjerm',
        'sw-visibility': 'Vis komponenter',
        'export-template': 'Vis kode',
        'open-sm': 'Åpne stilbehandling',
        'open-tm': 'Innstillinger',
        'open-layers': 'Åpne lagbehandling',
        'open-blocks': 'Åpne blokker'
      }
    }
  },
  selectorManager: {
    label: 'Klasser',
    selected: 'Valgt',
    emptyState: '- Tilstand -',
    states: {
      hover: 'Når musepekeren er over',
      active: 'Ved klikk',
      'nth-of-type(2n)': 'Partall/oddetall'
    }
  },
  styleManager: {
    empty: 'Velg et element før du bruker stilbehandlingen',
    layer: 'Lag',
    fileButton: 'Bilder',
    sectors: {
      general: 'Generelt',
      layout: 'Oppsett',
      typography: 'Typografi',
      decorations: 'Dekorasjoner',
      extra: 'Ekstra',
      flex: 'Flex',
      dimension: 'Dimensjoner'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Uskarphet',
      'text-shadow-color': 'Farge',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Uskarphet',
      'box-shadow-spread': 'Spredning',
      'box-shadow-color': 'Farge',
      'box-shadow-type': 'Type',
      'margin-top-sub': 'Topp',
      'margin-right-sub': 'Høyre',
      'margin-bottom-sub': 'Bunn',
      'margin-left-sub': 'Venstre',
      'padding-top-sub': 'Topp',
      'padding-right-sub': 'Høyre',
      'padding-bottom-sub': 'Bunn',
      'padding-left-sub': 'Venstre',
      'border-width-sub': 'Bredde',
      'border-style-sub': 'Stil',
      'border-color-sub': 'Farge',
      'border-top-left-radius-sub': 'Øverst til venstre',
      'border-top-right-radius-sub': 'Øverst til høyre',
      'border-bottom-right-radius-sub': 'Nederst til høyre',
      'border-bottom-left-radius-sub': 'Nederst til venstre',
      'transform-rotate-x': 'Rotasjon X',
      'transform-rotate-y': 'Rotasjon Y',
      'transform-rotate-z': 'Rotasjon Z',
      'transform-scale-x': 'Skalering X',
      'transform-scale-y': 'Skalering Y',
      'transform-scale-z': 'Skalering Z',
      'transition-property-sub': 'Egenskap',
      'transition-duration-sub': 'Varighet',
      'transition-timing-function-sub': 'Tidsfunksjon',
      'background-image-sub': 'Bilde',
      'background-repeat-sub': 'Gjentakelse',
      'background-position-sub': 'Posisjon',
      'background-attachment-sub': 'Forankring',
      'background-size-sub': 'Størrelse'
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
    empty: 'Velg et element før du bruker attributtbehandlingen',
    label: 'Komponentinnstillinger',
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
          placeholder: 'f.eks. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Dette vinduet',
          _blank: 'Nytt vindu'
        }
      }
    }
  },
  storageManager: {
    recover: 'Vil du gjenopprette ulagrede endringer?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Flyt",
  "display": "Visning",
  "position": "Posisjon",
  "top": "Topp",
  "right": "Høyre",
  "left": "Venstre",
  "bottom": "Bunn",
  "width": "Bredde",
  "height": "Høyde",
  "max-width": "Bredde (max.)",
  "max-height": "Høyde (max.)",
  "margin": "Marg",
  "margin-top": "Marg: topp",
  "margin-right": "Marg: høyre",
  "margin-left": "Marg: venstre",
  "margin-bottom": "Marg: bunn",
  "padding": "Indre marg",
  "padding-top": "Indre marg: topp",
  "padding-left": "Indre marg: venstre",
  "padding-right": "Indre marg: høyre",
  "padding-bottom": "Indre marg: bunn",
  "font-family": "Skrift: familie",
  "font-size": "Skrift: størrelse",
  "font-weight": "Skrift: vekt",
  "letter-spacing": "Bokstaver: avstand",
  "color": "Farge",
  "line-height": "Linje: høyde",
  "text-align": "Tekst: justering",
  "text-shadow": "Tekst: skygge",
  "border-top-left": "Kantlinje: topp · venstre",
  "border-top-right": "Kantlinje: topp · høyre",
  "border-bottom-left": "Kantlinje: bunn · venstre",
  "border-bottom-right": "Kantlinje: bunn · høyre",
  "border-radius-top-left": "Kantlinje: radius · topp · venstre",
  "border-radius-top-right": "Kantlinje: radius · topp · høyre",
  "border-radius-bottom-left": "Kantlinje: radius · bunn · venstre",
  "border-radius-bottom-right": "Kantlinje: radius · bunn · høyre",
  "border-radius": "Kantlinje: radius",
  "border": "Kantlinje",
  "border-width": "Kantlinje: bredde",
  "border-style": "Kantlinje: stil",
  "border-color": "Kantlinje: farge",
  "box-shadow": "Boks: skygge",
  "background": "Bakgrunn",
  "background-image": "Bakgrunn: bilde",
  "background-repeat": "Bakgrunn: gjenta",
  "background-position": "Bakgrunn: posisjon",
  "background-attachment": "Bakgrunn: feste",
  "background-size": "Bakgrunn: størrelse",
  "background-color": "Bakgrunn: farge",
  "transition": "Overgang",
  "transition-property": "Overgang: egenskap",
  "transition-duration": "Overgang: varighet",
  "transition-timing-function": "Overgang: timing",
  "perspective": "Perspektiv",
  "transform": "Transformasjon",
  "flex-direction": "Flex: retning",
  "flex-wrap": "Flex: bryting",
  "justify-content": "Fordeling: innhold",
  "align-items": "Justering: elementer",
  "align-content": "Justering: innhold",
  "order": "Rekkefølge",
  "flex-basis": "Flex: grunnlag",
  "flex-grow": "Flex: vekst",
  "flex-shrink": "Flex: krymping",
  "align-self": "Justering: egen"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternativ tekst",
  "title": "Tittel",
  "href": "Lenke"
});
