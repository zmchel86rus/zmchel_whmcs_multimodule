
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'напрыклад, Тэкст тут'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Дадаць выяву',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Выбраць выяву',
    uploadTitle: 'Перацягніце файлы сюды або націсніце, каб загрузіць'
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
      '': 'Блок',
      wrapper: 'Цела старонкі',
      text: 'Тэкст',
      comment: 'Каментарый',
      image: 'Выява',
      video: 'Відэа',
      label: 'Пазнака',
      link: 'Спасылка',
      map: 'Карта',
      tfoot: 'Ніжняя частка табліцы',
      tbody: 'Цела табліцы',
      thead: 'Загаловак табліцы',
      table: 'Табліца',
      row: 'Радок табліцы',
      cell: 'Ячэйка табліцы'
    }
  },
  deviceManager: {
    device: 'Прылада',
    devices: {
      desktop: 'Камп’ютар',
      tablet: 'Планшэт',
      mobileLandscape: 'Мабільная прылада (гарызантальна)',
      mobilePortrait: 'Мабільная прылада (вертыкальна)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Папярэдні прагляд',
        fullscreen: 'Поўны экран',
        'sw-visibility': 'Паказаць кампаненты',
        'export-template': 'Паказаць код',
        'open-sm': 'Адкрыць менеджар стыляў',
        'open-tm': 'Налады',
        'open-layers': 'Адкрыць менеджар слаёў',
        'open-blocks': 'Адкрыць блокі'
      }
    }
  },
  selectorManager: {
    label: 'Класы',
    selected: 'Выбрана',
    emptyState: '- Стан -',
    states: {
      hover: 'Пры навядзенні курсора',
      active: 'Пры націсканні',
      'nth-of-type(2n)': 'Цотныя/няцотныя'
    }
  },
  styleManager: {
    empty: 'Выберыце элемент перад выкарыстаннем менеджара стыляў',
    layer: 'Слой',
    fileButton: 'Выявы',
    sectors: {
      general: 'Агульныя',
      layout: 'Размяшчэнне',
      typography: 'Тыпаграфіка',
      decorations: 'Дэкор',
      extra: 'Дадаткова',
      flex: 'Flex',
      dimension: 'Памеры'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Размыццё',
      'text-shadow-color': 'Колер',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Размыццё',
      'box-shadow-spread': 'Пашырэнне',
      'box-shadow-color': 'Колер',
      'box-shadow-type': 'Тып',
      'margin-top-sub': 'Зверху',
      'margin-right-sub': 'Справа',
      'margin-bottom-sub': 'Знізу',
      'margin-left-sub': 'Злева',
      'padding-top-sub': 'Зверху',
      'padding-right-sub': 'Справа',
      'padding-bottom-sub': 'Знізу',
      'padding-left-sub': 'Злева',
      'border-width-sub': 'Шырыня',
      'border-style-sub': 'Стыль',
      'border-color-sub': 'Колер',
      'border-top-left-radius-sub': 'Верхні левы вугал',
      'border-top-right-radius-sub': 'Верхні правы вугал',
      'border-bottom-right-radius-sub': 'Ніжні правы вугал',
      'border-bottom-left-radius-sub': 'Ніжні левы вугал',
      'transform-rotate-x': 'Паварот X',
      'transform-rotate-y': 'Паварот Y',
      'transform-rotate-z': 'Паварот Z',
      'transform-scale-x': 'Маштабаванне X',
      'transform-scale-y': 'Маштабаванне Y',
      'transform-scale-z': 'Маштабаванне Z',
      'transition-property-sub': 'Уласцівасць',
      'transition-duration-sub': 'Працягласць',
      'transition-timing-function-sub': 'Часавая функцыя',
      'background-image-sub': 'Выява',
      'background-repeat-sub': 'Паўтарэнне',
      'background-position-sub': 'Становішча',
      'background-attachment-sub': 'Замацаванне',
      'background-size-sub': 'Памер'
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
    empty: 'Выберыце элемент перад выкарыстаннем менеджара атрыбутаў',
    label: 'Налады кампанента',
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
          placeholder: 'напрыклад, https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Гэта акно',
          _blank: 'Новае акно'
        }
      }
    }
  },
  storageManager: {
    recover: 'Хочаце аднавіць незахаваныя змены?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Абцяканне",
  "display": "Адлюстраванне",
  "position": "Пазіцыянаванне",
  "top": "Зверху",
  "right": "Справа",
  "left": "Злева",
  "bottom": "Знізу",
  "width": "Шырыня",
  "height": "Вышыня",
  "max-width": "Максімальная шырыня",
  "max-height": "Максімальная вышыня",
  "margin": "Знешні водступ",
  "margin-top": "Верхні знешні водступ",
  "margin-right": "Правы знешні водступ",
  "margin-left": "Левы знешні водступ",
  "margin-bottom": "Ніжні знешні водступ",
  "padding": "Унутраны водступ",
  "padding-top": "Верхні ўнутраны водступ",
  "padding-left": "Левы ўнутраны водступ",
  "padding-right": "Правы ўнутраны водступ",
  "padding-bottom": "Ніжні ўнутраны водступ",
  "font-family": "Сямейства шрыфтоў",
  "font-size": "Памер шрыфту",
  "font-weight": "Таўшчыня шрыфту",
  "letter-spacing": "Інтэрвал паміж літарамі",
  "color": "Колер",
  "line-height": "Вышыня радка",
  "text-align": "Выраўноўванне тэксту",
  "text-shadow": "Цень тэксту",
  "border-top-left": "Рамка зверху злева",
  "border-top-right": "Рамка зверху справа",
  "border-bottom-left": "Рамка знізу злева",
  "border-bottom-right": "Рамка знізу справа",
  "border-radius-top-left": "Закругленне верхняга левага вугла",
  "border-radius-top-right": "Закругленне верхняга правага вугла",
  "border-radius-bottom-left": "Закругленне ніжняга левага вугла",
  "border-radius-bottom-right": "Закругленне ніжняга правага вугла",
  "border-radius": "Закругленне вуглоў",
  "border": "Рамка",
  "border-width": "Таўшчыня рамкі",
  "border-style": "Стыль рамкі",
  "border-color": "Колер рамкі",
  "box-shadow": "Цень блока",
  "background": "Фон",
  "background-image": "Фонавая выява",
  "background-repeat": "Паўтарэнне фону",
  "background-position": "Становішча фону",
  "background-attachment": "Замацаванне фону",
  "background-size": "Памер фону",
  "background-color": "Колер фону",
  "transition": "Пераход",
  "transition-property": "Уласцівасць пераходу",
  "transition-duration": "Працягласць пераходу",
  "transition-timing-function": "Часавая функцыя пераходу",
  "perspective": "Перспектыва",
  "transform": "Трансфармацыя",
  "flex-direction": "Напрамак Flex",
  "flex-wrap": "Перанос элементаў Flex",
  "justify-content": "Выраўноўванне змесціва па галоўнай восі",
  "align-items": "Выраўноўванне элементаў",
  "align-content": "Выраўноўванне змесціва",
  "order": "Парадак",
  "flex-basis": "Базавы памер Flex",
  "flex-grow": "Каэфіцыент павелічэння Flex",
  "flex-shrink": "Каэфіцыент сціскання Flex",
  "align-self": "Індывідуальнае выраўноўванне"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Альтэрнатыўны тэкст",
  "title": "Загаловак",
  "href": "Спасылка"
});