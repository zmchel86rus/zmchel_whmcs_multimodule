
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'напр. Текст тук'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Добави изображение',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Избери изображение',
    uploadTitle: 'Пуснете файловете тук или щракнете, за да ги качите'
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
      '': 'Кутия',
      wrapper: 'Тяло на страницата',
      text: 'Текст',
      comment: 'Коментар',
      image: 'Изображение',
      video: 'Видео',
      label: 'Етикет',
      link: 'Връзка',
      map: 'Карта',
      tfoot: 'Долна част на таблицата',
      tbody: 'Тяло на таблицата',
      thead: 'Заглавна част на таблицата',
      table: 'Таблица',
      row: 'Ред на таблицата',
      cell: 'Клетка на таблицата'
    }
  },
  deviceManager: {
    device: 'Устройство',
    devices: {
      desktop: 'Настолен компютър',
      tablet: 'Таблет',
      mobileLandscape: 'Мобилен (хоризонтално)',
      mobilePortrait: 'Мобилен (вертикално)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Предварителен преглед',
        fullscreen: 'Цял екран',
        'sw-visibility': 'Покажи компонентите',
        'export-template': 'Покажи кода',
        'open-sm': 'Отвори мениджъра на стилове',
        'open-tm': 'Настройки',
        'open-layers': 'Отвори мениджъра на слоеве',
        'open-blocks': 'Отвори блоковете'
      }
    }
  },
  selectorManager: {
    label: 'Класове',
    selected: 'Избран',
    emptyState: '- Състояние -',
    states: {
      hover: 'При посочване с курсора',
      active: 'При щракване',
      'nth-of-type(2n)': 'Четни/нечетни'
    }
  },
  styleManager: {
    empty: 'Изберете елемент, преди да използвате мениджъра на стилове',
    layer: 'Слой',
    fileButton: 'Изображения',
    sectors: {
      general: 'Общи',
      layout: 'Оформление',
      typography: 'Типография',
      decorations: 'Декорации',
      extra: 'Допълнителни',
      flex: 'Flex',
      dimension: 'Размери'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Размазване',
      'text-shadow-color': 'Цвят',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Размазване',
      'box-shadow-spread': 'Разпростиране',
      'box-shadow-color': 'Цвят',
      'box-shadow-type': 'Тип',
      'margin-top-sub': 'Горе',
      'margin-right-sub': 'Вдясно',
      'margin-bottom-sub': 'Долу',
      'margin-left-sub': 'Вляво',
      'padding-top-sub': 'Горе',
      'padding-right-sub': 'Вдясно',
      'padding-bottom-sub': 'Долу',
      'padding-left-sub': 'Вляво',
      'border-width-sub': 'Ширина',
      'border-style-sub': 'Стил',
      'border-color-sub': 'Цвят',
      'border-top-left-radius-sub': 'Горе вляво',
      'border-top-right-radius-sub': 'Горе вдясно',
      'border-bottom-right-radius-sub': 'Долу вдясно',
      'border-bottom-left-radius-sub': 'Долу вляво',
      'transform-rotate-x': 'Завъртане по X',
      'transform-rotate-y': 'Завъртане по Y',
      'transform-rotate-z': 'Завъртане по Z',
      'transform-scale-x': 'Мащабиране по X',
      'transform-scale-y': 'Мащабиране по Y',
      'transform-scale-z': 'Мащабиране по Z',
      'transition-property-sub': 'Свойство',
      'transition-duration-sub': 'Продължителност',
      'transition-timing-function-sub': 'Времева функция',
      'background-image-sub': 'Изображение',
      'background-repeat-sub': 'Повтаряне',
      'background-position-sub': 'Позиция',
      'background-attachment-sub': 'Закрепване',
      'background-size-sub': 'Размер'
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
    empty: 'Изберете елемент, преди да използвате мениджъра на атрибути',
    label: 'Настройки на компонента',
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
          placeholder: 'напр. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Този прозорец',
          _blank: 'Нов прозорец'
        }
      }
    }
  },
  storageManager: {
    recover: 'Искате ли да възстановите незапазените промени?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Обтичане",
  "display": "Показване",
  "position": "Позиция",
  "top": "Горе",
  "right": "Вдясно",
  "left": "Вляво",
  "bottom": "Долу",
  "width": "Ширина",
  "height": "Височина",
  "max-width": "Максимална ширина",
  "max-height": "Максимална височина",
  "margin": "Външен отстъп",
  "margin-top": "Горен външен отстъп",
  "margin-right": "Десен външен отстъп",
  "margin-left": "Ляв външен отстъп",
  "margin-bottom": "Долен външен отстъп",
  "padding": "Вътрешен отстъп",
  "padding-top": "Горен вътрешен отстъп",
  "padding-left": "Ляв вътрешен отстъп",
  "padding-right": "Десен вътрешен отстъп",
  "padding-bottom": "Долен вътрешен отстъп",
  "font-family": "Шрифтово семейство",
  "font-size": "Размер на шрифта",
  "font-weight": "Дебелина на шрифта",
  "letter-spacing": "Разстояние между буквите",
  "color": "Цвят",
  "line-height": "Височина на реда",
  "text-align": "Подравняване на текста",
  "text-shadow": "Сянка на текста",
  "border-top-left": "Рамка горе вляво",
  "border-top-right": "Рамка горе вдясно",
  "border-bottom-left": "Рамка долу вляво",
  "border-bottom-right": "Рамка долу вдясно",
  "border-radius-top-left": "Закръгляне на горния ляв ъгъл",
  "border-radius-top-right": "Закръгляне на горния десен ъгъл",
  "border-radius-bottom-left": "Закръгляне на долния ляв ъгъл",
  "border-radius-bottom-right": "Закръгляне на долния десен ъгъл",
  "border-radius": "Закръгляне на ъглите",
  "border": "Рамка",
  "border-width": "Дебелина на рамката",
  "border-style": "Стил на рамката",
  "border-color": "Цвят на рамката",
  "box-shadow": "Сянка на елемента",
  "background": "Фон",
  "background-image": "Фоново изображение",
  "background-repeat": "Повтаряне на фона",
  "background-position": "Позиция на фона",
  "background-attachment": "Закрепване на фона",
  "background-size": "Размер на фона",
  "background-color": "Цвят на фона",
  "transition": "Преход",
  "transition-property": "Свойство на прехода",
  "transition-duration": "Продължителност на прехода",
  "transition-timing-function": "Времева функция на прехода",
  "perspective": "Перспектива",
  "transform": "Трансформация",
  "flex-direction": "Посока на Flex",
  "flex-wrap": "Пренасяне на Flex елементите",
  "justify-content": "Разпределяне по главната ос",
  "align-items": "Подравняване на елементите",
  "align-content": "Подравняване на съдържанието",
  "order": "Ред",
  "flex-basis": "Базов размер на Flex",
  "flex-grow": "Разширяване на Flex",
  "flex-shrink": "Свиване на Flex",
  "align-self": "Индивидуално подравняване"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Алтернативен текст",
  "title": "Заглавие",
  "href": "Връзка"
});