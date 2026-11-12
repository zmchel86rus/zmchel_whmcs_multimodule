
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'нпр. Текст овде'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Додај слику',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Изабери слику',
    uploadTitle: 'Превуците датотеке овде или кликните да их отпремите'
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
      '': 'Кутија',
      wrapper: 'Тело странице',
      text: 'Текст',
      comment: 'Коментар',
      image: 'Слика',
      video: 'Видео',
      label: 'Ознака',
      link: 'Веза',
      map: 'Мапа',
      tfoot: 'Подножје табеле',
      tbody: 'Тело табеле',
      thead: 'Заглавље табеле',
      table: 'Табела',
      row: 'Ред табеле',
      cell: 'Ћелија табеле'
    }
  },
  deviceManager: {
    device: 'Уређај',
    devices: {
      desktop: 'Рачунар',
      tablet: 'Таблет',
      mobileLandscape: 'Мобилни (хоризонтално)',
      mobilePortrait: 'Мобилни (вертикално)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Преглед',
        fullscreen: 'Цео екран',
        'sw-visibility': 'Прикажи компоненте',
        'export-template': 'Прикажи код',
        'open-sm': 'Отвори менаџер стилова',
        'open-tm': 'Подешавања',
        'open-layers': 'Отвори менаџер слојева',
        'open-blocks': 'Отвори блокове'
      }
    }
  },
  selectorManager: {
    label: 'Класе',
    selected: 'Изабрано',
    emptyState: '- Стање -',
    states: {
      hover: 'Прелазак показивачем',
      active: 'Клик',
      'nth-of-type(2n)': 'Парни/непарни'
    }
  },
  styleManager: {
    empty: 'Изаберите елемент пре коришћења менаџера стилова',
    layer: 'Слој',
    fileButton: 'Слике',
    sectors: {
      general: 'Опште',
      layout: 'Распоред',
      typography: 'Типографија',
      decorations: 'Декорације',
      extra: 'Додатно',
      flex: 'Flex',
      dimension: 'Димензије'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Замућење',
      'text-shadow-color': 'Боја',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Замућење',
      'box-shadow-spread': 'Ширење',
      'box-shadow-color': 'Боја',
      'box-shadow-type': 'Тип',
      'margin-top-sub': 'Горе',
      'margin-right-sub': 'Десно',
      'margin-bottom-sub': 'Доле',
      'margin-left-sub': 'Лево',
      'padding-top-sub': 'Горе',
      'padding-right-sub': 'Десно',
      'padding-bottom-sub': 'Доле',
      'padding-left-sub': 'Лево',
      'border-width-sub': 'Ширина',
      'border-style-sub': 'Стил',
      'border-color-sub': 'Боја',
      'border-top-left-radius-sub': 'Горе лево',
      'border-top-right-radius-sub': 'Горе десно',
      'border-bottom-right-radius-sub': 'Доле десно',
      'border-bottom-left-radius-sub': 'Доле лево',
      'transform-rotate-x': 'Ротација X',
      'transform-rotate-y': 'Ротација Y',
      'transform-rotate-z': 'Ротација Z',
      'transform-scale-x': 'Скалирање X',
      'transform-scale-y': 'Скалирање Y',
      'transform-scale-z': 'Скалирање Z',
      'transition-property-sub': 'Својство',
      'transition-duration-sub': 'Трајање',
      'transition-timing-function-sub': 'Временска функција',
      'background-image-sub': 'Слика',
      'background-repeat-sub': 'Понављање',
      'background-position-sub': 'Позиција',
      'background-attachment-sub': 'Причвршћивање',
      'background-size-sub': 'Величина'
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
    empty: 'Изаберите елемент пре коришћења менаџера атрибута',
    label: 'Подешавања компоненте',
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
          placeholder: 'нпр. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Овај прозор',
          _blank: 'Нови прозор'
        }
      }
    }
  },
  storageManager: {
    recover: 'Да ли желите да вратите несачуване измене?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Плутајуће позиционирање",
  "display": "Приказ",
  "position": "Позиција",
  "top": "Горе",
  "right": "Десно",
  "left": "Лево",
  "bottom": "Доле",
  "width": "Ширина",
  "height": "Висина",
  "max-width": "Максимална ширина",
  "max-height": "Максимална висина",
  "margin": "Спољна маргина",
  "margin-top": "Горња спољна маргина",
  "margin-right": "Десна спољна маргина",
  "margin-left": "Лева спољна маргина",
  "margin-bottom": "Доња спољна маргина",
  "padding": "Унутрашњи размак",
  "padding-top": "Горњи унутрашњи размак",
  "padding-left": "Леви унутрашњи размак",
  "padding-right": "Десни унутрашњи размак",
  "padding-bottom": "Доњи унутрашњи размак",
  "font-family": "Породица фонтова",
  "font-size": "Величина фонта",
  "font-weight": "Дебљина фонта",
  "letter-spacing": "Размак између слова",
  "color": "Боја",
  "line-height": "Висина реда",
  "text-align": "Поравнање текста",
  "text-shadow": "Сенка текста",
  "border-top-left": "Ивица горе лево",
  "border-top-right": "Ивица горе десно",
  "border-bottom-left": "Ивица доле лево",
  "border-bottom-right": "Ивица доле десно",
  "border-radius-top-left": "Заобљеност горњег левог угла",
  "border-radius-top-right": "Заобљеност горњег десног угла",
  "border-radius-bottom-left": "Заобљеност доњег левог угла",
  "border-radius-bottom-right": "Заобљеност доњег десног угла",
  "border-radius": "Заобљеност углова",
  "border": "Ивица",
  "border-width": "Дебљина ивице",
  "border-style": "Стил ивице",
  "border-color": "Боја ивице",
  "box-shadow": "Сенка елемента",
  "background": "Позадина",
  "background-image": "Позадинска слика",
  "background-repeat": "Понављање позадине",
  "background-position": "Позиција позадине",
  "background-attachment": "Причвршћивање позадине",
  "background-size": "Величина позадине",
  "background-color": "Боја позадине",
  "transition": "Прелаз",
  "transition-property": "Својство прелаза",
  "transition-duration": "Трајање прелаза",
  "transition-timing-function": "Временска функција прелаза",
  "perspective": "Перспектива",
  "transform": "Трансформација",
  "flex-direction": "Смер Flex распореда",
  "flex-wrap": "Преламање Flex елемената",
  "justify-content": "Распоређивање садржаја",
  "align-items": "Поравнање елемената",
  "align-content": "Поравнање садржаја",
  "order": "Редослед",
  "flex-basis": "Основна величина Flex елемента",
  "flex-grow": "Ширење Flex елемента",
  "flex-shrink": "Скупљање Flex елемента",
  "align-self": "Појединачно поравнање"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Алтернативни текст",
  "title": "Наслов",
  "href": "Веза"
});