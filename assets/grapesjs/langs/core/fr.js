
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'ex. Texte ici'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Ajouter une image',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Sélectionner une image',
    uploadTitle: 'Déposez des fichiers ici ou cliquez pour les importer'
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
      '': 'Boîte',
      wrapper: 'Corps de la page',
      text: 'Texte',
      comment: 'Commentaire',
      image: 'Image',
      video: 'Vidéo',
      label: 'Étiquette',
      link: 'Lien',
      map: 'Carte',
      tfoot: 'Pied de tableau',
      tbody: 'Corps du tableau',
      thead: 'En-tête du tableau',
      table: 'Tableau',
      row: 'Ligne du tableau',
      cell: 'Cellule du tableau'
    }
  },
  deviceManager: {
    device: 'Appareil',
    devices: {
      desktop: 'Ordinateur',
      tablet: 'Tablette',
      mobileLandscape: 'Mobile (paysage)',
      mobilePortrait: 'Mobile (portrait)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Aperçu',
        fullscreen: 'Plein écran',
        'sw-visibility': 'Afficher les composants',
        'export-template': 'Afficher le code',
        'open-sm': 'Ouvrir le gestionnaire de styles',
        'open-tm': 'Paramètres',
        'open-layers': 'Ouvrir le gestionnaire de calques',
        'open-blocks': 'Ouvrir les blocs'
      }
    }
  },
  selectorManager: {
    label: 'Classes',
    selected: 'Sélectionné',
    emptyState: '- État -',
    states: {
      hover: 'Survol',
      active: 'Clic',
      'nth-of-type(2n)': 'Pair/Impair'
    }
  },
  styleManager: {
    empty: 'Sélectionnez un élément avant d’utiliser le gestionnaire de styles',
    layer: 'Calque',
    fileButton: 'Images',
    sectors: {
      general: 'Général',
      layout: 'Mise en page',
      typography: 'Typographie',
      decorations: 'Décorations',
      extra: 'Supplémentaire',
      flex: 'Flex',
      dimension: 'Dimensions'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Flou',
      'text-shadow-color': 'Couleur',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Flou',
      'box-shadow-spread': 'Étendue',
      'box-shadow-color': 'Couleur',
      'box-shadow-type': 'Type',
      'margin-top-sub': 'Haut',
      'margin-right-sub': 'Droite',
      'margin-bottom-sub': 'Bas',
      'margin-left-sub': 'Gauche',
      'padding-top-sub': 'Haut',
      'padding-right-sub': 'Droite',
      'padding-bottom-sub': 'Bas',
      'padding-left-sub': 'Gauche',
      'border-width-sub': 'Largeur',
      'border-style-sub': 'Style',
      'border-color-sub': 'Couleur',
      'border-top-left-radius-sub': 'En haut à gauche',
      'border-top-right-radius-sub': 'En haut à droite',
      'border-bottom-right-radius-sub': 'En bas à droite',
      'border-bottom-left-radius-sub': 'En bas à gauche',
      'transform-rotate-x': 'Rotation X',
      'transform-rotate-y': 'Rotation Y',
      'transform-rotate-z': 'Rotation Z',
      'transform-scale-x': 'Échelle X',
      'transform-scale-y': 'Échelle Y',
      'transform-scale-z': 'Échelle Z',
      'transition-property-sub': 'Propriété',
      'transition-duration-sub': 'Durée',
      'transition-timing-function-sub': 'Fonction de temporisation',
      'background-image-sub': 'Image',
      'background-repeat-sub': 'Répétition',
      'background-position-sub': 'Position',
      'background-attachment-sub': 'Fixation',
      'background-size-sub': 'Taille'
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
    empty: 'Sélectionnez un élément avant d’utiliser le gestionnaire d’attributs',
    label: 'Paramètres du composant',
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
          placeholder: 'ex. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Cette fenêtre',
          _blank: 'Nouvelle fenêtre'
        }
      }
    }
  },
  storageManager: {
    recover: 'Voulez-vous récupérer les modifications non enregistrées ?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Flottement",
  "display": "Affichage",
  "position": "Position",
  "top": "Haut",
  "right": "Droite",
  "left": "Gauche",
  "bottom": "Bas",
  "width": "Largeur",
  "height": "Hauteur",
  "max-width": "Largeur (max.)",
  "max-height": "Hauteur (max.)",
  "margin": "Marge",
  "margin-top": "Marge: haut",
  "margin-right": "Marge: droite",
  "margin-left": "Marge: gauche",
  "margin-bottom": "Marge: bas",
  "padding": "Marge intérieure",
  "padding-top": "Marge intérieure: haut",
  "padding-left": "Marge intérieure: gauche",
  "padding-right": "Marge intérieure: droite",
  "padding-bottom": "Marge intérieure: bas",
  "font-family": "Police: famille",
  "font-size": "Police: taille",
  "font-weight": "Police: graisse",
  "letter-spacing": "Lettres: espacement",
  "color": "Couleur",
  "line-height": "Ligne: hauteur",
  "text-align": "Texte: alignement",
  "text-shadow": "Texte: ombre",
  "border-top-left": "Bordure: haut · gauche",
  "border-top-right": "Bordure: haut · droite",
  "border-bottom-left": "Bordure: bas · gauche",
  "border-bottom-right": "Bordure: bas · droite",
  "border-radius-top-left": "Bordure: rayon · haut · gauche",
  "border-radius-top-right": "Bordure: rayon · haut · droite",
  "border-radius-bottom-left": "Bordure: rayon · bas · gauche",
  "border-radius-bottom-right": "Bordure: rayon · bas · droite",
  "border-radius": "Bordure: rayon",
  "border": "Bordure",
  "border-width": "Bordure: largeur",
  "border-style": "Bordure: style",
  "border-color": "Bordure: couleur",
  "box-shadow": "Boîte: ombre",
  "background": "Arrière-plan",
  "background-image": "Arrière-plan: image",
  "background-repeat": "Arrière-plan: répétition",
  "background-position": "Arrière-plan: position",
  "background-attachment": "Arrière-plan: attachement",
  "background-size": "Arrière-plan: taille",
  "background-color": "Arrière-plan: couleur",
  "transition": "Transition",
  "transition-property": "Transition: propriété",
  "transition-duration": "Transition: durée",
  "transition-timing-function": "Transition: temporisation",
  "perspective": "Perspective",
  "transform": "Transformation",
  "flex-direction": "Flex: direction",
  "flex-wrap": "Flex: retour à la ligne",
  "justify-content": "Justification: contenu",
  "align-items": "Alignement: éléments",
  "align-content": "Alignement: contenu",
  "order": "Ordre",
  "flex-basis": "Flex: base",
  "flex-grow": "Flex: croissance",
  "flex-shrink": "Flex: réduction",
  "align-self": "Alignement: propre"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Texte alternatif",
  "title": "Titre",
  "href": "Lien"
});
