
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'masalan, Matn shu yerda'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Rasm qoʻshish',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Rasmni tanlash',
    uploadTitle: 'Fayllarni bu yerga tashlang yoki yuklash uchun bosing'
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
      '': 'Quti',
      wrapper: 'Sahifa tanasi',
      text: 'Matn',
      comment: 'Izoh',
      image: 'Rasm',
      video: 'Video',
      label: 'Yorliq',
      link: 'Havola',
      map: 'Xarita',
      tfoot: 'Jadvalning quyi qismi',
      tbody: 'Jadval tanasi',
      thead: 'Jadval sarlavhasi',
      table: 'Jadval',
      row: 'Jadval qatori',
      cell: 'Jadval katagi'
    }
  },
  deviceManager: {
    device: 'Qurilma',
    devices: {
      desktop: 'Kompyuter',
      tablet: 'Planshet',
      mobileLandscape: 'Mobil (gorizontal)',
      mobilePortrait: 'Mobil (vertikal)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Oldindan koʻrish',
        fullscreen: 'Toʻliq ekran',
        'sw-visibility': 'Komponentlarni koʻrsatish',
        'export-template': 'Kodni koʻrish',
        'open-sm': 'Uslublar boshqaruvini ochish',
        'open-tm': 'Sozlamalar',
        'open-layers': 'Qatlamlar boshqaruvini ochish',
        'open-blocks': 'Bloklarni ochish'
      }
    }
  },
  selectorManager: {
    label: 'Sinflar',
    selected: 'Tanlangan',
    emptyState: '- Holat -',
    states: {
      hover: 'Sichqoncha koʻrsatkichi ustiga olib borilganda',
      active: 'Bosilganda',
      'nth-of-type(2n)': 'Juft/toq'
    }
  },
  styleManager: {
    empty: 'Uslublar boshqaruvidan foydalanishdan oldin elementni tanlang',
    layer: 'Qatlam',
    fileButton: 'Rasmlar',
    sectors: {
      general: 'Umumiy',
      layout: 'Joylashuv',
      typography: 'Tipografiya',
      decorations: 'Bezaklar',
      extra: 'Qoʻshimcha',
      flex: 'Flex',
      dimension: 'Oʻlchamlar'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Xiralik',
      'text-shadow-color': 'Rang',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Xiralik',
      'box-shadow-spread': 'Yoyilish',
      'box-shadow-color': 'Rang',
      'box-shadow-type': 'Tur',
      'margin-top-sub': 'Yuqori',
      'margin-right-sub': 'Oʻng',
      'margin-bottom-sub': 'Pastki',
      'margin-left-sub': 'Chap',
      'padding-top-sub': 'Yuqori',
      'padding-right-sub': 'Oʻng',
      'padding-bottom-sub': 'Pastki',
      'padding-left-sub': 'Chap',
      'border-width-sub': 'Kenglik',
      'border-style-sub': 'Uslub',
      'border-color-sub': 'Rang',
      'border-top-left-radius-sub': 'Yuqori chap burchak',
      'border-top-right-radius-sub': 'Yuqori oʻng burchak',
      'border-bottom-right-radius-sub': 'Pastki oʻng burchak',
      'border-bottom-left-radius-sub': 'Pastki chap burchak',
      'transform-rotate-x': 'X oʻqi boʻyicha aylantirish',
      'transform-rotate-y': 'Y oʻqi boʻyicha aylantirish',
      'transform-rotate-z': 'Z oʻqi boʻyicha aylantirish',
      'transform-scale-x': 'X oʻqi boʻyicha masshtablash',
      'transform-scale-y': 'Y oʻqi boʻyicha masshtablash',
      'transform-scale-z': 'Z oʻqi boʻyicha masshtablash',
      'transition-property-sub': 'Xususiyat',
      'transition-duration-sub': 'Davomiylik',
      'transition-timing-function-sub': 'Vaqt funksiyasi',
      'background-image-sub': 'Rasm',
      'background-repeat-sub': 'Takrorlash',
      'background-position-sub': 'Joylashuv',
      'background-attachment-sub': 'Mahkamlash',
      'background-size-sub': 'Oʻlcham'
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
    empty: 'Atributlar boshqaruvidan foydalanishdan oldin elementni tanlang',
    label: 'Komponent sozlamalari',
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
          placeholder: 'masalan, https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Shu oyna',
          _blank: 'Yangi oyna'
        }
      }
    }
  },
  storageManager: {
    recover: 'Saqlanmagan oʻzgarishlarni tiklamoqchimisiz?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Suzuvchi joylashuv",
  "display": "Koʻrsatish",
  "position": "Joylashuv",
  "top": "Yuqori",
  "right": "Oʻng",
  "left": "Chap",
  "bottom": "Pastki",
  "width": "Kenglik",
  "height": "Balandlik",
  "max-width": "Maksimal kenglik",
  "max-height": "Maksimal balandlik",
  "margin": "Tashqi chekinish",
  "margin-top": "Yuqori tashqi chekinish",
  "margin-right": "Oʻng tashqi chekinish",
  "margin-left": "Chap tashqi chekinish",
  "margin-bottom": "Pastki tashqi chekinish",
  "padding": "Ichki chekinish",
  "padding-top": "Yuqori ichki chekinish",
  "padding-left": "Chap ichki chekinish",
  "padding-right": "Oʻng ichki chekinish",
  "padding-bottom": "Pastki ichki chekinish",
  "font-family": "Shrift oilasi",
  "font-size": "Shrift oʻlchami",
  "font-weight": "Shrift qalinligi",
  "letter-spacing": "Harflar orasidagi masofa",
  "color": "Rang",
  "line-height": "Qator balandligi",
  "text-align": "Matnni tekislash",
  "text-shadow": "Matn soyasi",
  "border-top-left": "Yuqori chap chegara",
  "border-top-right": "Yuqori oʻng chegara",
  "border-bottom-left": "Pastki chap chegara",
  "border-bottom-right": "Pastki oʻng chegara",
  "border-radius-top-left": "Yuqori chap burchakning yumaloqligi",
  "border-radius-top-right": "Yuqori oʻng burchakning yumaloqligi",
  "border-radius-bottom-left": "Pastki chap burchakning yumaloqligi",
  "border-radius-bottom-right": "Pastki oʻng burchakning yumaloqligi",
  "border-radius": "Burchaklarni yumaloqlash",
  "border": "Chegara",
  "border-width": "Chegara qalinligi",
  "border-style": "Chegara uslubi",
  "border-color": "Chegara rangi",
  "box-shadow": "Blok soyasi",
  "background": "Fon",
  "background-image": "Fon rasmi",
  "background-repeat": "Fonni takrorlash",
  "background-position": "Fonning joylashuvi",
  "background-attachment": "Fonni mahkamlash",
  "background-size": "Fon oʻlchami",
  "background-color": "Fon rangi",
  "transition": "Oʻtish",
  "transition-property": "Oʻtish xususiyati",
  "transition-duration": "Oʻtish davomiyligi",
  "transition-timing-function": "Oʻtish vaqt funksiyasi",
  "perspective": "Perspektiva",
  "transform": "Transformatsiya",
  "flex-direction": "Flex yoʻnalishi",
  "flex-wrap": "Flex elementlarini yangi qatorga oʻtkazish",
  "justify-content": "Asosiy oʻq boʻyicha tekislash",
  "align-items": "Elementlarni tekislash",
  "align-content": "Kontentni tekislash",
  "order": "Tartib",
  "flex-basis": "Flex asosiy oʻlchami",
  "flex-grow": "Flex kengayishi",
  "flex-shrink": "Flex qisqarishi",
  "align-self": "Alohida tekislash"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Muqobil matn",
  "title": "Sarlavha",
  "href": "Havola"
});