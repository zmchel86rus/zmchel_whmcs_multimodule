"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'eg. Text here'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Add image',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Select Image',
    uploadTitle: 'Drop files here or click to upload'
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
      '': 'Box',
      wrapper: 'Body',
      text: 'Text',
      comment: 'Comment',
      image: 'Image',
      video: 'Video',
      label: 'Label',
      link: 'Link',
      map: 'Map',
      tfoot: 'Table foot',
      tbody: 'Table body',
      thead: 'Table head',
      table: 'Table',
      row: 'Table row',
      cell: 'Table cell'
    }
  },
  deviceManager: {
    device: 'Device',
    devices: {
      desktop: 'Desktop',
      tablet: 'Tablet',
      mobileLandscape: 'Mobile Landscape',
      mobilePortrait: 'Mobile Portrait'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Preview',
        fullscreen: 'Fullscreen',
        'sw-visibility': 'View components',
        'export-template': 'View code',
        'open-sm': 'Open Style Manager',
        'open-tm': 'Settings',
        'open-layers': 'Open Layer Manager',
        'open-blocks': 'Open Blocks'
      }
    }
  },
  selectorManager: {
    label: 'Classes',
    selected: 'Selected',
    emptyState: '- State -',
    states: {
      hover: 'Hover',
      active: 'Click',
      'nth-of-type(2n)': 'Even/Odd'
    }
  },
  styleManager: {
    empty: 'Select an element before using Style Manager',
    layer: 'Layer',
    fileButton: 'Images',
    sectors: {
      general: 'General',
      layout: 'Layout',
      typography: 'Typography',
      decorations: 'Decorations',
      extra: 'Extra',
      flex: 'Flex',
      dimension: 'Dimension'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Blur',
      'text-shadow-color': 'Color',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Blur',
      'box-shadow-spread': 'Spread',
      'box-shadow-color': 'Color',
      'box-shadow-type': 'Type',
      'margin-top-sub': 'Top',
      'margin-right-sub': 'Right',
      'margin-bottom-sub': 'Bottom',
      'margin-left-sub': 'Left',
      'padding-top-sub': 'Top',
      'padding-right-sub': 'Right',
      'padding-bottom-sub': 'Bottom',
      'padding-left-sub': 'Left',
      'border-width-sub': 'Width',
      'border-style-sub': 'Style',
      'border-color-sub': 'Color',
      'border-top-left-radius-sub': 'Top Left',
      'border-top-right-radius-sub': 'Top Right',
      'border-bottom-right-radius-sub': 'Bottom Right',
      'border-bottom-left-radius-sub': 'Bottom Left',
      'transform-rotate-x': 'Rotate X',
      'transform-rotate-y': 'Rotate Y',
      'transform-rotate-z': 'Rotate Z',
      'transform-scale-x': 'Scale X',
      'transform-scale-y': 'Scale Y',
      'transform-scale-z': 'Scale Z',
      'transition-property-sub': 'Property',
      'transition-duration-sub': 'Duration',
      'transition-timing-function-sub': 'Timing',
      'background-image-sub': 'Image',
      'background-repeat-sub': 'Repeat',
      'background-position-sub': 'Position',
      'background-attachment-sub': 'Attachment',
      'background-size-sub': 'Size'
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
    empty: 'Select an element before using Trait Manager',
    label: 'Component settings',
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
          placeholder: 'eg. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'This window',
          _blank: 'New window'
        }
      }
    }
  },
  storageManager: {
    recover: 'Do you want to recover unsaved changes?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Float",
  "display": "Display",
  "position": "Position",
  "top": "Top",
  "right": "Right",
  "left": "Left",
  "bottom": "Bottom",
  "width": "Width",
  "height": "Height",
  "max-width": "Width (max.)",
  "max-height": "Height (max.)",
  "margin": "Margin",
  "margin-top": "Margin Top",
  "margin-right": "Margin Right",
  "margin-left": "Margin Left",
  "margin-bottom": "Margin Bottom",
  "padding": "Padding",
  "padding-top": "Padding Top",
  "padding-left": "Padding Left",
  "padding-right": "Padding Right",
  "padding-bottom": "Padding Bottom",
  "font-family": "Font Family",
  "font-size": "Font Size",
  "font-weight": "Font Weight",
  "letter-spacing": "Letter Spacing",
  "color": "Color",
  "line-height": "Line Height",
  "text-align": "Text Align",
  "text-shadow": "Text Shadow",
  "border-top-left": "Border Top Left",
  "border-top-right": "Border Top Right",
  "border-bottom-left": "Border Bottom Left",
  "border-bottom-right": "Border Bottom Right",
  "border-radius-top-left": "Border Radius Top Left",
  "border-radius-top-right": "Border Radius Top Right",
  "border-radius-bottom-left": "Border Radius Bottom Left",
  "border-radius-bottom-right": "Border Radius Bottom Right",
  "border-radius": "Border Radius",
  "border": "Border",
  "border-width": "Border Width",
  "border-style": "Border Style",
  "border-color": "Border Color",
  "box-shadow": "Box Shadow",
  "background": "Background",
  "background-image": "Background Image",
  "background-repeat": "Background Repeat",
  "background-position": "Background Position",
  "background-attachment": "Background Attachment",
  "background-size": "Background Size",
  "background-color": "Background Color",
  "transition": "Transition",
  "transition-property": "Transition Property",
  "transition-duration": "Transition Duration",
  "transition-timing-function": "Transition Timing",
  "perspective": "Perspective",
  "transform": "Transform",
  "flex-direction": "Flex Direction",
  "flex-wrap": "Flex Wrap",
  "justify-content": "Justify Content",
  "align-items": "Align Items",
  "align-content": "Align Content",
  "order": "Order",
  "flex-basis": "Flex Basis",
  "flex-grow": "Flex Grow",
  "flex-shrink": "Flex Shrink",
  "align-self": "Align Self"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternative text",
  "title": "Title",
  "href": "Link"
});
