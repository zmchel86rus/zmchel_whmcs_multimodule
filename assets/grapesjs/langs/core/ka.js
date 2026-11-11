
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'მაგ., ტექსტი აქ'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'სურათის დამატება',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'სურათის არჩევა',
    uploadTitle: 'გადმოათრიეთ ფაილები აქ ან დააწკაპუნეთ ასატვირთად'
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
      '': 'არე',
      wrapper: 'გვერდის ძირითადი ნაწილი',
      text: 'ტექსტი',
      comment: 'კომენტარი',
      image: 'სურათი',
      video: 'ვიდეო',
      label: 'იარლიყი',
      link: 'ბმული',
      map: 'რუკა',
      tfoot: 'ცხრილის ქვედა ნაწილი',
      tbody: 'ცხრილის ძირითადი ნაწილი',
      thead: 'ცხრილის სათაური',
      table: 'ცხრილი',
      row: 'ცხრილის მწკრივი',
      cell: 'ცხრილის უჯრედი'
    }
  },
  deviceManager: {
    device: 'მოწყობილობა',
    devices: {
      desktop: 'კომპიუტერი',
      tablet: 'პლანშეტი',
      mobileLandscape: 'მობილური (ჰორიზონტალურად)',
      mobilePortrait: 'მობილური (ვერტიკალურად)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'წინასწარი ნახვა',
        fullscreen: 'სრულეკრანიანი რეჟიმი',
        'sw-visibility': 'კომპონენტების ჩვენება',
        'export-template': 'კოდის ნახვა',
        'open-sm': 'სტილების მენეჯერის გახსნა',
        'open-tm': 'პარამეტრები',
        'open-layers': 'ფენების მენეჯერის გახსნა',
        'open-blocks': 'ბლოკების გახსნა'
      }
    }
  },
  selectorManager: {
    label: 'კლასები',
    selected: 'არჩეული',
    emptyState: '- მდგომარეობა -',
    states: {
      hover: 'კურსორის მიტანა',
      active: 'დაწკაპუნება',
      'nth-of-type(2n)': 'ლუწი/კენტი'
    }
  },
  styleManager: {
    empty: 'სტილების მენეჯერის გამოყენებამდე აირჩიეთ ელემენტი',
    layer: 'ფენა',
    fileButton: 'სურათები',
    sectors: {
      general: 'ზოგადი',
      layout: 'განლაგება',
      typography: 'ტიპოგრაფია',
      decorations: 'გაფორმება',
      extra: 'დამატებითი',
      flex: 'Flex-თვისებები',
      dimension: 'ზომები'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'დაბინდვა',
      'text-shadow-color': 'ფერი',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'დაბინდვა',
      'box-shadow-spread': 'გავრცელება',
      'box-shadow-color': 'ფერი',
      'box-shadow-type': 'ტიპი',
      'margin-top-sub': 'ზემოთ',
      'margin-right-sub': 'მარჯვნივ',
      'margin-bottom-sub': 'ქვემოთ',
      'margin-left-sub': 'მარცხნივ',
      'padding-top-sub': 'ზემოთ',
      'padding-right-sub': 'მარჯვნივ',
      'padding-bottom-sub': 'ქვემოთ',
      'padding-left-sub': 'მარცხნივ',
      'border-width-sub': 'სიგანე',
      'border-style-sub': 'სტილი',
      'border-color-sub': 'ფერი',
      'border-top-left-radius-sub': 'ზედა მარცხენა',
      'border-top-right-radius-sub': 'ზედა მარჯვენა',
      'border-bottom-right-radius-sub': 'ქვედა მარჯვენა',
      'border-bottom-left-radius-sub': 'ქვედა მარცხენა',
      'transform-rotate-x': 'ბრუნვა X',
      'transform-rotate-y': 'ბრუნვა Y',
      'transform-rotate-z': 'ბრუნვა Z',
      'transform-scale-x': 'მასშტაბირება X',
      'transform-scale-y': 'მასშტაბირება Y',
      'transform-scale-z': 'მასშტაბირება Z',
      'transition-property-sub': 'თვისება',
      'transition-duration-sub': 'ხანგრძლივობა',
      'transition-timing-function-sub': 'დროის ფუნქცია',
      'background-image-sub': 'სურათი',
      'background-repeat-sub': 'გამეორება',
      'background-position-sub': 'მდებარეობა',
      'background-attachment-sub': 'ფიქსაცია',
      'background-size-sub': 'ზომა'
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
    empty: 'ატრიბუტების მენეჯერის გამოყენებამდე აირჩიეთ ელემენტი',
    label: 'კომპონენტის პარამეტრები',
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
          placeholder: 'მაგ., https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'ეს ფანჯარა',
          _blank: 'ახალი ფანჯარა'
        }
      }
    }
  },
  storageManager: {
    recover: 'გსურთ შეუნახავი ცვლილებების აღდგენა?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "შემოვლება",
  "display": "ჩვენება",
  "position": "პოზიციონირება",
  "top": "ზემოთ",
  "right": "მარჯვნივ",
  "left": "მარცხნივ",
  "bottom": "ქვემოთ",
  "width": "სიგანე",
  "height": "სიმაღლე",
  "max-width": "მაქსიმალური სიგანე",
  "max-height": "მაქსიმალური სიმაღლე",
  "margin": "გარე დაშორება",
  "margin-top": "გარე დაშორება: ზემოთ",
  "margin-right": "გარე დაშორება: მარჯვნივ",
  "margin-left": "გარე დაშორება: მარცხნივ",
  "margin-bottom": "გარე დაშორება: ქვემოთ",
  "padding": "შიდა დაშორება",
  "padding-top": "შიდა დაშორება: ზემოთ",
  "padding-left": "შიდა დაშორება: მარცხნივ",
  "padding-right": "შიდა დაშორება: მარჯვნივ",
  "padding-bottom": "შიდა დაშორება: ქვემოთ",
  "font-family": "შრიფტის ოჯახი",
  "font-size": "შრიფტის ზომა",
  "font-weight": "შრიფტის სისქე",
  "letter-spacing": "ასოებს შორის დაშორება",
  "color": "ფერი",
  "line-height": "სტრიქონის სიმაღლე",
  "text-align": "ტექსტის გასწორება",
  "text-shadow": "ტექსტის ჩრდილი",
  "border-top-left": "ჩარჩო: ზედა მარცხენა",
  "border-top-right": "ჩარჩო: ზედა მარჯვენა",
  "border-bottom-left": "ჩარჩო: ქვედა მარცხენა",
  "border-bottom-right": "ჩარჩო: ქვედა მარჯვენა",
  "border-radius-top-left": "კუთხის მომრგვალება: ზედა მარცხენა",
  "border-radius-top-right": "კუთხის მომრგვალება: ზედა მარჯვენა",
  "border-radius-bottom-left": "კუთხის მომრგვალება: ქვედა მარცხენა",
  "border-radius-bottom-right": "კუთხის მომრგვალება: ქვედა მარჯვენა",
  "border-radius": "კუთხეების მომრგვალება",
  "border": "ჩარჩო",
  "border-width": "ჩარჩოს სისქე",
  "border-style": "ჩარჩოს სტილი",
  "border-color": "ჩარჩოს ფერი",
  "box-shadow": "ბლოკის ჩრდილი",
  "background": "ფონი",
  "background-image": "ფონის სურათი",
  "background-repeat": "ფონის გამეორება",
  "background-position": "ფონის მდებარეობა",
  "background-attachment": "ფონის ფიქსაცია",
  "background-size": "ფონის ზომა",
  "background-color": "ფონის ფერი",
  "transition": "გადასვლა",
  "transition-property": "გადასვლის თვისება",
  "transition-duration": "გადასვლის ხანგრძლივობა",
  "transition-timing-function": "გადასვლის დროის ფუნქცია",
  "perspective": "პერსპექტივა",
  "transform": "გარდაქმნა",
  "flex-direction": "Flex-ის მიმართულება",
  "flex-wrap": "Flex-ის ელემენტების გადატანა",
  "justify-content": "შიგთავსის განაწილება",
  "align-items": "ელემენტების გასწორება",
  "align-content": "შიგთავსის გასწორება",
  "order": "რიგითობა",
  "flex-basis": "Flex-ის საბაზისო ზომა",
  "flex-grow": "Flex-ის ზრდა",
  "flex-shrink": "Flex-ის შეკუმშვა",
  "align-self": "ინდივიდუალური გასწორება"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "ალტერნატიული ტექსტი",
  "title": "სათაური",
  "href": "ბმული"
});