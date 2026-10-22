
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'мысалы, Мәтінді осы жерге енгізіңіз'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Сурет қосу',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Суретті таңдау',
    uploadTitle: 'Файлдарды осында сүйреп апарыңыз немесе жүктеу үшін басыңыз'
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
      '': 'Контейнер',
      wrapper: 'Бет мазмұны',
      text: 'Мәтін',
      comment: 'Пікір',
      image: 'Сурет',
      video: 'Бейне',
      label: 'Белгі',
      link: 'Сілтеме',
      map: 'Карта',
      tfoot: 'Кестенің төменгі бөлігі',
      tbody: 'Кестенің негізгі бөлігі',
      thead: 'Кестенің жоғарғы бөлігі',
      table: 'Кесте',
      row: 'Кесте жолы',
      cell: 'Кесте ұяшығы'
    }
  },
  deviceManager: {
    device: 'Құрылғы',
    devices: {
      desktop: 'Компьютер',
      tablet: 'Планшет',
      mobileLandscape: 'Ұялы құрылғы (көлденең)',
      mobilePortrait: 'Ұялы құрылғы (тігінен)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Алдын ала қарау',
        fullscreen: 'Толық экран',
        'sw-visibility': 'Компоненттерді көрсету',
        'export-template': 'Кодты көрсету',
        'open-sm': 'Стильдер менеджерін ашу',
        'open-tm': 'Параметрлер',
        'open-layers': 'Қабаттар менеджерін ашу',
        'open-blocks': 'Блоктарды ашу'
      }
    }
  },
  selectorManager: {
    label: 'Кластар',
    selected: 'Таңдалған',
    emptyState: '- Күй -',
    states: {
      hover: 'Меңзерді апарғанда',
      active: 'Басқанда',
      'nth-of-type(2n)': 'Жұп/тақ'
    }
  },
  styleManager: {
    empty: 'Стильдер менеджерін пайдаланбас бұрын элементті таңдаңыз',
    layer: 'Қабат',
    fileButton: 'Суреттер',
    sectors: {
      general: 'Жалпы',
      layout: 'Орналасу',
      typography: 'Типография',
      decorations: 'Безендіру',
      extra: 'Қосымша',
      flex: 'Flex',
      dimension: 'Өлшемдер'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Бұлыңғырлық',
      'text-shadow-color': 'Түс',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Бұлыңғырлық',
      'box-shadow-spread': 'Жайылу',
      'box-shadow-color': 'Түс',
      'box-shadow-type': 'Түрі',
      'margin-top-sub': 'Жоғары',
      'margin-right-sub': 'Оң',
      'margin-bottom-sub': 'Төмен',
      'margin-left-sub': 'Сол',
      'padding-top-sub': 'Жоғары',
      'padding-right-sub': 'Оң',
      'padding-bottom-sub': 'Төмен',
      'padding-left-sub': 'Сол',
      'border-width-sub': 'Ені',
      'border-style-sub': 'Стиль',
      'border-color-sub': 'Түс',
      'border-top-left-radius-sub': 'Жоғарғы сол жақ бұрыш',
      'border-top-right-radius-sub': 'Жоғарғы оң жақ бұрыш',
      'border-bottom-right-radius-sub': 'Төменгі оң жақ бұрыш',
      'border-bottom-left-radius-sub': 'Төменгі сол жақ бұрыш',
      'transform-rotate-x': 'X осі бойынша бұру',
      'transform-rotate-y': 'Y осі бойынша бұру',
      'transform-rotate-z': 'Z осі бойынша бұру',
      'transform-scale-x': 'X осі бойынша масштабтау',
      'transform-scale-y': 'Y осі бойынша масштабтау',
      'transform-scale-z': 'Z осі бойынша масштабтау',
      'transition-property-sub': 'Қасиет',
      'transition-duration-sub': 'Ұзақтығы',
      'transition-timing-function-sub': 'Уақыт функциясы',
      'background-image-sub': 'Сурет',
      'background-repeat-sub': 'Қайталау',
      'background-position-sub': 'Орын',
      'background-attachment-sub': 'Бекіту',
      'background-size-sub': 'Өлшем'
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
    empty: 'Атрибуттар менеджерін пайдаланбас бұрын элементті таңдаңыз',
    label: 'Компонент параметрлері',
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
          placeholder: 'мысалы, https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Осы терезе',
          _blank: 'Жаңа терезе'
        }
      }
    }
  },
  storageManager: {
    recover: 'Сақталмаған өзгерістерді қалпына келтіргіңіз келе ме?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Қалқымалы орналастыру",
  "display": "Көрсету",
  "position": "Орын",
  "top": "Жоғары",
  "right": "Оң",
  "left": "Сол",
  "bottom": "Төмен",
  "width": "Ені",
  "height": "Биіктігі",
  "max-width": "Ең үлкен ені",
  "max-height": "Ең үлкен биіктігі",
  "margin": "Сыртқы шегініс",
  "margin-top": "Жоғарғы сыртқы шегініс",
  "margin-right": "Оң жақ сыртқы шегініс",
  "margin-left": "Сол жақ сыртқы шегініс",
  "margin-bottom": "Төменгі сыртқы шегініс",
  "padding": "Ішкі шегініс",
  "padding-top": "Жоғарғы ішкі шегініс",
  "padding-left": "Сол жақ ішкі шегініс",
  "padding-right": "Оң жақ ішкі шегініс",
  "padding-bottom": "Төменгі ішкі шегініс",
  "font-family": "Қаріптер тобы",
  "font-size": "Қаріп өлшемі",
  "font-weight": "Қаріп қалыңдығы",
  "letter-spacing": "Әріптер аралығы",
  "color": "Түс",
  "line-height": "Жол биіктігі",
  "text-align": "Мәтінді туралау",
  "text-shadow": "Мәтін көлеңкесі",
  "border-top-left": "Жоғарғы сол жақ жиек",
  "border-top-right": "Жоғарғы оң жақ жиек",
  "border-bottom-left": "Төменгі сол жақ жиек",
  "border-bottom-right": "Төменгі оң жақ жиек",
  "border-radius-top-left": "Жоғарғы сол жақ бұрышты дөңгелектеу",
  "border-radius-top-right": "Жоғарғы оң жақ бұрышты дөңгелектеу",
  "border-radius-bottom-left": "Төменгі сол жақ бұрышты дөңгелектеу",
  "border-radius-bottom-right": "Төменгі оң жақ бұрышты дөңгелектеу",
  "border-radius": "Бұрыштарды дөңгелектеу",
  "border": "Жиек",
  "border-width": "Жиек қалыңдығы",
  "border-style": "Жиек стилі",
  "border-color": "Жиек түсі",
  "box-shadow": "Элемент көлеңкесі",
  "background": "Фон",
  "background-image": "Фон суреті",
  "background-repeat": "Фонды қайталау",
  "background-position": "Фонның орны",
  "background-attachment": "Фонды бекіту",
  "background-size": "Фон өлшемі",
  "background-color": "Фон түсі",
  "transition": "Ауысу",
  "transition-property": "Ауысу қасиеті",
  "transition-duration": "Ауысу ұзақтығы",
  "transition-timing-function": "Ауысудың уақыт функциясы",
  "perspective": "Перспектива",
  "transform": "Түрлендіру",
  "flex-direction": "Flex бағыты",
  "flex-wrap": "Flex элементтерін жаңа жолға көшіру",
  "justify-content": "Мазмұнды негізгі ось бойынша туралау",
  "align-items": "Элементтерді туралау",
  "align-content": "Мазмұнды туралау",
  "order": "Реті",
  "flex-basis": "Flex негізгі өлшемі",
  "flex-grow": "Flex үлкеюі",
  "flex-shrink": "Flex кішіреюі",
  "align-self": "Өзіндік туралау"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Балама мәтін",
  "title": "Тақырып",
  "href": "Сілтеме"
});