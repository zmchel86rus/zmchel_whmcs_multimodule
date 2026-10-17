
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'на пр. Текст овде'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Додај слика',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Избери слика',
    uploadTitle: 'Повлечете датотеки овде или кликнете за да ги прикачите'
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
      wrapper: 'Тело на страницата',
      text: 'Текст',
      comment: 'Коментар',
      image: 'Слика',
      video: 'Видео',
      label: 'Ознака',
      link: 'Врска',
      map: 'Мапа',
      tfoot: 'Подножје на табелата',
      tbody: 'Тело на табелата',
      thead: 'Заглавие на табелата',
      table: 'Табела',
      row: 'Ред во табелата',
      cell: 'Ќелија во табелата'
    }
  },
  deviceManager: {
    device: 'Уред',
    devices: {
      desktop: 'Компјутер',
      tablet: 'Таблет',
      mobileLandscape: 'Мобилен уред (хоризонтално)',
      mobilePortrait: 'Мобилен уред (вертикално)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Преглед',
        fullscreen: 'Цел екран',
        'sw-visibility': 'Прикажи компоненти',
        'export-template': 'Прикажи код',
        'open-sm': 'Отвори управувач со стилови',
        'open-tm': 'Поставки',
        'open-layers': 'Отвори управувач со слоеви',
        'open-blocks': 'Отвори блокови'
      }
    }
  },
  selectorManager: {
    label: 'Класи',
    selected: 'Избрано',
    emptyState: '- Состојба -',
    states: {
      hover: 'При поминување со покажувачот',
      active: 'При кликнување',
      'nth-of-type(2n)': 'Парни/непарни'
    }
  },
  styleManager: {
    empty: 'Изберете елемент пред да го користите управувачот со стилови',
    layer: 'Слој',
    fileButton: 'Слики',
    sectors: {
      general: 'Општо',
      layout: 'Распоред',
      typography: 'Типографија',
      decorations: 'Декорации',
      extra: 'Дополнително',
      flex: 'Flex',
      dimension: 'Димензии'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Заматување',
      'text-shadow-color': 'Боја',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Заматување',
      'box-shadow-spread': 'Ширење',
      'box-shadow-color': 'Боја',
      'box-shadow-type': 'Тип',
      'margin-top-sub': 'Горе',
      'margin-right-sub': 'Десно',
      'margin-bottom-sub': 'Долу',
      'margin-left-sub': 'Лево',
      'padding-top-sub': 'Горе',
      'padding-right-sub': 'Десно',
      'padding-bottom-sub': 'Долу',
      'padding-left-sub': 'Лево',
      'border-width-sub': 'Ширина',
      'border-style-sub': 'Стил',
      'border-color-sub': 'Боја',
      'border-top-left-radius-sub': 'Горе лево',
      'border-top-right-radius-sub': 'Горе десно',
      'border-bottom-right-radius-sub': 'Долу десно',
      'border-bottom-left-radius-sub': 'Долу лево',
      'transform-rotate-x': 'Ротација X',
      'transform-rotate-y': 'Ротација Y',
      'transform-rotate-z': 'Ротација Z',
      'transform-scale-x': 'Скалирање X',
      'transform-scale-y': 'Скалирање Y',
      'transform-scale-z': 'Скалирање Z',
      'transition-property-sub': 'Својство',
      'transition-duration-sub': 'Времетраење',
      'transition-timing-function-sub': 'Темпирање',
      'background-image-sub': 'Слика',
      'background-repeat-sub': 'Повторување',
      'background-position-sub': 'Позиција',
      'background-attachment-sub': 'Прицврстување',
      'background-size-sub': 'Големина'
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
    empty: 'Изберете елемент пред да го користите управувачот со атрибути',
    label: 'Поставки на компонентата',
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
          placeholder: 'на пр. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Овој прозорец',
          _blank: 'Нов прозорец'
        }
      }
    }
  },
  storageManager: {
    recover: 'Дали сакате да ги вратите незачуваните промени?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Пловечко позиционирање",
  "display": "Приказ",
  "position": "Позиција",
  "top": "Горе",
  "right": "Десно",
  "left": "Лево",
  "bottom": "Долу",
  "width": "Ширина",
  "height": "Висина",
  "max-width": "Максимална ширина",
  "max-height": "Максимална висина",
  "margin": "Надворешна маргина",
  "margin-top": "Горна надворешна маргина",
  "margin-right": "Десна надворешна маргина",
  "margin-left": "Лева надворешна маргина",
  "margin-bottom": "Долна надворешна маргина",
  "padding": "Внатрешно растојание",
  "padding-top": "Горно внатрешно растојание",
  "padding-left": "Лево внатрешно растојание",
  "padding-right": "Десно внатрешно растојание",
  "padding-bottom": "Долно внатрешно растојание",
  "font-family": "Семејство на фонтови",
  "font-size": "Големина на фонтот",
  "font-weight": "Дебелина на фонтот",
  "letter-spacing": "Растојание меѓу буквите",
  "color": "Боја",
  "line-height": "Висина на редот",
  "text-align": "Порамнување на текстот",
  "text-shadow": "Сенка на текстот",
  "border-top-left": "Горна лева рамка",
  "border-top-right": "Горна десна рамка",
  "border-bottom-left": "Долна лева рамка",
  "border-bottom-right": "Долна десна рамка",
  "border-radius-top-left": "Заоблување на горниот лев агол",
  "border-radius-top-right": "Заоблување на горниот десен агол",
  "border-radius-bottom-left": "Заоблување на долниот лев агол",
  "border-radius-bottom-right": "Заоблување на долниот десен агол",
  "border-radius": "Заоблување на аглите",
  "border": "Рамка",
  "border-width": "Ширина на рамката",
  "border-style": "Стил на рамката",
  "border-color": "Боја на рамката",
  "box-shadow": "Сенка на елементот",
  "background": "Заднина",
  "background-image": "Слика за заднина",
  "background-repeat": "Повторување на заднината",
  "background-position": "Позиција на заднината",
  "background-attachment": "Прицврстување на заднината",
  "background-size": "Големина на заднината",
  "background-color": "Боја на заднината",
  "transition": "Премин",
  "transition-property": "Својство на преминот",
  "transition-duration": "Времетраење на преминот",
  "transition-timing-function": "Темпирање на преминот",
  "perspective": "Перспектива",
  "transform": "Трансформација",
  "flex-direction": "Насока на флекс-распоредот",
  "flex-wrap": "Пренесување на флекс-елементите",
  "justify-content": "Распределба на содржината",
  "align-items": "Порамнување на елементите",
  "align-content": "Порамнување на содржината",
  "order": "Редослед",
  "flex-basis": "Основна големина на флекс-елементот",
  "flex-grow": "Проширување на флекс-елементот",
  "flex-shrink": "Смалување на флекс-елементот",
  "align-self": "Самостојно порамнување"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Алтернативен текст",
  "title": "Наслов",
  "href": "Врска"
});