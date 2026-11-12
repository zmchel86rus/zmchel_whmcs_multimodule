
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'bijv. Tekst hier'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Afbeelding toevoegen',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Afbeelding selecteren',
    uploadTitle: 'Sleep bestanden hierheen of klik om ze te uploaden'
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
      '': 'Vak',
      wrapper: 'Pagina-inhoud',
      text: 'Tekst',
      comment: 'Opmerking',
      image: 'Afbeelding',
      video: 'Video',
      label: 'Label',
      link: 'Link',
      map: 'Kaart',
      tfoot: 'Tabelvoet',
      tbody: 'Tabelinhoud',
      thead: 'Tabelkop',
      table: 'Tabel',
      row: 'Tabelrij',
      cell: 'Tabelcel'
    }
  },
  deviceManager: {
    device: 'Apparaat',
    devices: {
      desktop: 'Desktop',
      tablet: 'Tablet',
      mobileLandscape: 'Mobiel (liggend)',
      mobilePortrait: 'Mobiel (staand)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Voorbeeld',
        fullscreen: 'Volledig scherm',
        'sw-visibility': 'Componenten weergeven',
        'export-template': 'Code weergeven',
        'open-sm': 'Stijlbeheer openen',
        'open-tm': 'Instellingen',
        'open-layers': 'Lagenbeheer openen',
        'open-blocks': 'Blokken openen'
      }
    }
  },
  selectorManager: {
    label: 'Klassen',
    selected: 'Geselecteerd',
    emptyState: '- Status -',
    states: {
      hover: 'Aanwijzen',
      active: 'Klikken',
      'nth-of-type(2n)': 'Even/oneven'
    }
  },
  styleManager: {
    empty: 'Selecteer een element voordat u Stijlbeheer gebruikt',
    layer: 'Laag',
    fileButton: 'Afbeeldingen',
    sectors: {
      general: 'Algemeen',
      layout: 'Indeling',
      typography: 'Typografie',
      decorations: 'Decoraties',
      extra: 'Extra',
      flex: 'Flex',
      dimension: 'Afmetingen'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Vervaging',
      'text-shadow-color': 'Kleur',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Vervaging',
      'box-shadow-spread': 'Spreiding',
      'box-shadow-color': 'Kleur',
      'box-shadow-type': 'Type',
      'margin-top-sub': 'Boven',
      'margin-right-sub': 'Rechts',
      'margin-bottom-sub': 'Onder',
      'margin-left-sub': 'Links',
      'padding-top-sub': 'Boven',
      'padding-right-sub': 'Rechts',
      'padding-bottom-sub': 'Onder',
      'padding-left-sub': 'Links',
      'border-width-sub': 'Breedte',
      'border-style-sub': 'Stijl',
      'border-color-sub': 'Kleur',
      'border-top-left-radius-sub': 'Linksboven',
      'border-top-right-radius-sub': 'Rechtsboven',
      'border-bottom-right-radius-sub': 'Rechtsonder',
      'border-bottom-left-radius-sub': 'Linksonder',
      'transform-rotate-x': 'Rotatie X',
      'transform-rotate-y': 'Rotatie Y',
      'transform-rotate-z': 'Rotatie Z',
      'transform-scale-x': 'Schaal X',
      'transform-scale-y': 'Schaal Y',
      'transform-scale-z': 'Schaal Z',
      'transition-property-sub': 'Eigenschap',
      'transition-duration-sub': 'Duur',
      'transition-timing-function-sub': 'Timing',
      'background-image-sub': 'Afbeelding',
      'background-repeat-sub': 'Herhaling',
      'background-position-sub': 'Positie',
      'background-attachment-sub': 'Vastzetten',
      'background-size-sub': 'Grootte'
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
    empty: 'Selecteer een element voordat u Eigenschappenbeheer gebruikt',
    label: 'Componentinstellingen',
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
          placeholder: 'bijv. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Dit venster',
          _blank: 'Nieuw venster'
        }
      }
    }
  },
  storageManager: {
    recover: 'Wilt u niet-opgeslagen wijzigingen herstellen?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Zweven",
  "display": "Weergave",
  "position": "Positie",
  "top": "Boven",
  "right": "Rechts",
  "left": "Links",
  "bottom": "Onder",
  "width": "Breedte",
  "height": "Hoogte",
  "max-width": "Maximale breedte",
  "max-height": "Maximale hoogte",
  "margin": "Marge",
  "margin-top": "Bovenmarge",
  "margin-right": "Rechtermarge",
  "margin-left": "Linkermarge",
  "margin-bottom": "Ondermarge",
  "padding": "Binnenmarge",
  "padding-top": "Binnenmarge boven",
  "padding-left": "Binnenmarge links",
  "padding-right": "Binnenmarge rechts",
  "padding-bottom": "Binnenmarge onder",
  "font-family": "Lettertype",
  "font-size": "Lettergrootte",
  "font-weight": "Letterdikte",
  "letter-spacing": "Letterafstand",
  "color": "Kleur",
  "line-height": "Regelhoogte",
  "text-align": "Tekstuitlijning",
  "text-shadow": "Tekstschaduw",
  "border-top-left": "Rand linksboven",
  "border-top-right": "Rand rechtsboven",
  "border-bottom-left": "Rand linksonder",
  "border-bottom-right": "Rand rechtsonder",
  "border-radius-top-left": "Hoekafronding linksboven",
  "border-radius-top-right": "Hoekafronding rechtsboven",
  "border-radius-bottom-left": "Hoekafronding linksonder",
  "border-radius-bottom-right": "Hoekafronding rechtsonder",
  "border-radius": "Hoekafronding",
  "border": "Rand",
  "border-width": "Randbreedte",
  "border-style": "Randstijl",
  "border-color": "Randkleur",
  "box-shadow": "Vakschaduw",
  "background": "Achtergrond",
  "background-image": "Achtergrondafbeelding",
  "background-repeat": "Achtergrondherhaling",
  "background-position": "Achtergrondpositie",
  "background-attachment": "Achtergrond vastzetten",
  "background-size": "Achtergrondgrootte",
  "background-color": "Achtergrondkleur",
  "transition": "Overgang",
  "transition-property": "Overgangseigenschap",
  "transition-duration": "Overgangsduur",
  "transition-timing-function": "Overgangstiming",
  "perspective": "Perspectief",
  "transform": "Transformatie",
  "flex-direction": "Flexrichting",
  "flex-wrap": "Flexterugloop",
  "justify-content": "Inhoud uitlijnen",
  "align-items": "Items uitlijnen",
  "align-content": "Inhoud langs de dwarsas uitlijnen",
  "order": "Volgorde",
  "flex-basis": "Flexbasis",
  "flex-grow": "Flexgroei",
  "flex-shrink": "Flexkrimp",
  "align-self": "Zelf uitlijnen"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternatieve tekst",
  "title": "Titel",
  "href": "Link"
});
