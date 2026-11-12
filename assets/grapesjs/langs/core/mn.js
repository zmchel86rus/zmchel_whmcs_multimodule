
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'жишээ нь: Энд текст бичнэ үү'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Зураг нэмэх',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Зураг сонгох',
    uploadTitle: 'Файлуудаа энд чирж оруулах эсвэл дарж байршуулах'
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
      '': 'Хэсэг',
      wrapper: 'Хуудасны үндсэн хэсэг',
      text: 'Текст',
      comment: 'Тайлбар',
      image: 'Зураг',
      video: 'Видео',
      label: 'Шошго',
      link: 'Холбоос',
      map: 'Газрын зураг',
      tfoot: 'Хүснэгтийн хөл хэсэг',
      tbody: 'Хүснэгтийн үндсэн хэсэг',
      thead: 'Хүснэгтийн толгой хэсэг',
      table: 'Хүснэгт',
      row: 'Хүснэгтийн мөр',
      cell: 'Хүснэгтийн нүд'
    }
  },
  deviceManager: {
    device: 'Төхөөрөмж',
    devices: {
      desktop: 'Суурин компьютер',
      tablet: 'Таблет',
      mobileLandscape: 'Гар утас (хэвтээ)',
      mobilePortrait: 'Гар утас (босоо)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Урьдчилан харах',
        fullscreen: 'Дэлгэц дүүрэн',
        'sw-visibility': 'Бүрэлдэхүүн хэсгүүдийг харуулах',
        'export-template': 'Кодыг харах',
        'open-sm': 'Хэв маягийн удирдлагыг нээх',
        'open-tm': 'Тохиргоо',
        'open-layers': 'Давхаргын удирдлагыг нээх',
        'open-blocks': 'Блокуудыг нээх'
      }
    }
  },
  selectorManager: {
    label: 'Классууд',
    selected: 'Сонгосон',
    emptyState: '- Төлөв -',
    states: {
      hover: 'Хулганын заагчийг дээр нь аваачихад',
      active: 'Дарахад',
      'nth-of-type(2n)': 'Тэгш/сондгой'
    }
  },
  styleManager: {
    empty: 'Хэв маягийн удирдлагыг ашиглахаас өмнө элемент сонгоно уу',
    layer: 'Давхарга',
    fileButton: 'Зургууд',
    sectors: {
      general: 'Ерөнхий',
      layout: 'Байрлал',
      typography: 'Үсгийн хэв',
      decorations: 'Чимэглэл',
      extra: 'Нэмэлт',
      flex: 'Flex',
      dimension: 'Хэмжээс'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Бүдгэрэлт',
      'text-shadow-color': 'Өнгө',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Бүдгэрэлт',
      'box-shadow-spread': 'Тархалт',
      'box-shadow-color': 'Өнгө',
      'box-shadow-type': 'Төрөл',
      'margin-top-sub': 'Дээд',
      'margin-right-sub': 'Баруун',
      'margin-bottom-sub': 'Доод',
      'margin-left-sub': 'Зүүн',
      'padding-top-sub': 'Дээд',
      'padding-right-sub': 'Баруун',
      'padding-bottom-sub': 'Доод',
      'padding-left-sub': 'Зүүн',
      'border-width-sub': 'Өргөн',
      'border-style-sub': 'Загвар',
      'border-color-sub': 'Өнгө',
      'border-top-left-radius-sub': 'Зүүн дээд булан',
      'border-top-right-radius-sub': 'Баруун дээд булан',
      'border-bottom-right-radius-sub': 'Баруун доод булан',
      'border-bottom-left-radius-sub': 'Зүүн доод булан',
      'transform-rotate-x': 'X тэнхлэгээр эргүүлэх',
      'transform-rotate-y': 'Y тэнхлэгээр эргүүлэх',
      'transform-rotate-z': 'Z тэнхлэгээр эргүүлэх',
      'transform-scale-x': 'X тэнхлэгээр масштаблах',
      'transform-scale-y': 'Y тэнхлэгээр масштаблах',
      'transform-scale-z': 'Z тэнхлэгээр масштаблах',
      'transition-property-sub': 'Шинж чанар',
      'transition-duration-sub': 'Үргэлжлэх хугацаа',
      'transition-timing-function-sub': 'Хугацааны функц',
      'background-image-sub': 'Зураг',
      'background-repeat-sub': 'Давталт',
      'background-position-sub': 'Байрлал',
      'background-attachment-sub': 'Бэхэлгээ',
      'background-size-sub': 'Хэмжээ'
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
    empty: 'Шинж чанарын удирдлагыг ашиглахаас өмнө элемент сонгоно уу',
    label: 'Бүрэлдэхүүн хэсгийн тохиргоо',
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
          placeholder: 'жишээ нь: https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Энэ цонх',
          _blank: 'Шинэ цонх'
        }
      }
    }
  },
  storageManager: {
    recover: 'Хадгалаагүй өөрчлөлтүүдийг сэргээх үү?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Хөвүүлэх",
  "display": "Харагдах байдал",
  "position": "Байрлал",
  "top": "Дээд",
  "right": "Баруун",
  "left": "Зүүн",
  "bottom": "Доод",
  "width": "Өргөн",
  "height": "Өндөр",
  "max-width": "Хамгийн их өргөн",
  "max-height": "Хамгийн их өндөр",
  "margin": "Гадна зай",
  "margin-top": "Дээд гадна зай",
  "margin-right": "Баруун гадна зай",
  "margin-left": "Зүүн гадна зай",
  "margin-bottom": "Доод гадна зай",
  "padding": "Дотор зай",
  "padding-top": "Дээд дотор зай",
  "padding-left": "Зүүн дотор зай",
  "padding-right": "Баруун дотор зай",
  "padding-bottom": "Доод дотор зай",
  "font-family": "Фонтын төрөл",
  "font-size": "Фонтын хэмжээ",
  "font-weight": "Фонтын зузаан",
  "letter-spacing": "Үсэг хоорондын зай",
  "color": "Өнгө",
  "line-height": "Мөрийн өндөр",
  "text-align": "Текстийн зэрэгцүүлэлт",
  "text-shadow": "Текстийн сүүдэр",
  "border-top-left": "Зүүн дээд хүрээ",
  "border-top-right": "Баруун дээд хүрээ",
  "border-bottom-left": "Зүүн доод хүрээ",
  "border-bottom-right": "Баруун доод хүрээ",
  "border-radius-top-left": "Зүүн дээд булангийн дугуйруулалт",
  "border-radius-top-right": "Баруун дээд булангийн дугуйруулалт",
  "border-radius-bottom-left": "Зүүн доод булангийн дугуйруулалт",
  "border-radius-bottom-right": "Баруун доод булангийн дугуйруулалт",
  "border-radius": "Булангийн дугуйруулалт",
  "border": "Хүрээ",
  "border-width": "Хүрээний өргөн",
  "border-style": "Хүрээний загвар",
  "border-color": "Хүрээний өнгө",
  "box-shadow": "Хэсгийн сүүдэр",
  "background": "Дэвсгэр",
  "background-image": "Дэвсгэр зураг",
  "background-repeat": "Дэвсгэрийн давталт",
  "background-position": "Дэвсгэрийн байрлал",
  "background-attachment": "Дэвсгэрийн бэхэлгээ",
  "background-size": "Дэвсгэрийн хэмжээ",
  "background-color": "Дэвсгэрийн өнгө",
  "transition": "Шилжилт",
  "transition-property": "Шилжилтийн шинж чанар",
  "transition-duration": "Шилжилтийн үргэлжлэх хугацаа",
  "transition-timing-function": "Шилжилтийн хугацааны функц",
  "perspective": "Алслалт",
  "transform": "Хувиргалт",
  "flex-direction": "Flex-ийн чиглэл",
  "flex-wrap": "Flex-ийн мөр шилжүүлэлт",
  "justify-content": "Үндсэн тэнхлэг дагуух зэрэгцүүлэлт",
  "align-items": "Элементүүдийн зэрэгцүүлэлт",
  "align-content": "Агуулгын зэрэгцүүлэлт",
  "order": "Дараалал",
  "flex-basis": "Flex-ийн суурь хэмжээ",
  "flex-grow": "Flex-ийн өсөлт",
  "flex-shrink": "Flex-ийн агшилт",
  "align-self": "Элементийн өөрийн зэрэгцүүлэлт"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Орлуулах текст",
  "title": "Гарчиг",
  "href": "Холбоос"
});