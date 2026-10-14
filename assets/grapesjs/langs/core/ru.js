"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'Прим. Текст здесь'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Добавить изображение',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Выбрать изображение',
    uploadTitle: 'Перетащите файлы сюда или нажмите, чтобы загрузить'
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
      '': 'Область',
      wrapper: 'Тело',
      text: 'Текст',
      comment: 'Комментарий',
      image: 'Изображение',
      video: 'Визео',
      label: 'Ярлык',
      link: 'Ссылка',
      map: 'Карта',
      tfoot: 'Подвал таблицы',
      tbody: 'Тело таблицы',
      thead: 'Заголовок таблицы',
      table: 'Таблица',
      row: 'Строка таблицы',
      cell: 'Ячейка таблицы'
    }
  },
  deviceManager: {
    device: 'Устройство',
    devices: {
      desktop: 'Десктоп',
      tablet: 'Планшет',
      mobileLandscape: 'Мобильный горизонтально',
      mobilePortrait: 'Мобильный верикально'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Предварительный просмотр',
        fullscreen: 'Полноэкранный режим',
        'sw-visibility': 'Просмотр компонентов',
        'export-template': 'Просмотреть код',
        'open-sm': 'Открыть диспетчер стилей',
        'open-tm': 'Настройки',
        'open-layers': 'Открыть диспетчер слоев',
        'open-blocks': 'Открытые блоки'
      }
    }
  },
  selectorManager: {
    label: 'Классы',
    selected: 'Выбрано',
    emptyState: '- Состояние -',
    states: {
      hover: 'Наведение',
      active: 'Клик',
      'nth-of-type(2n)': 'Четный/Нечетный'
    }
  },
  styleManager: {
    empty: 'Выберите элемент перед использованием Диспетчера стилей',
    layer: 'Слой',
    fileButton: 'Изображения',
    sectors: {
      general: 'Общее',
      layout: 'Макет',
      typography: 'Шрифты',
      decorations: 'Оформление',
      extra: 'Дополнительно',
      flex: 'Flex-атрибуты',
      dimension: 'Измерение'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Размытие',
      'text-shadow-color': 'Цвет',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Размытие',
      'box-shadow-spread': 'Распространение',
      'box-shadow-color': 'Цвет',
      'box-shadow-type': 'Тип',
      'margin-top-sub': 'Сверху',
      'margin-right-sub': 'Справа',
      'margin-bottom-sub': 'Снизу',
      'margin-left-sub': 'Слева',
      'padding-top-sub': 'Сверху',
      'padding-right-sub': 'Справа',
      'padding-bottom-sub': 'Снизу',
      'padding-left-sub': 'Слева',
      'border-width-sub': 'Ширина',
      'border-style-sub': 'Стиль',
      'border-color-sub': 'Цвет',
      'border-top-left-radius-sub': 'Вверху слева',
      'border-top-right-radius-sub': 'Вверху справа',
      'border-bottom-right-radius-sub': 'Внизу справа',
      'border-bottom-left-radius-sub': 'Внизу слева',
      'transform-rotate-x': 'Повернуть X',
      'transform-rotate-y': 'Повернуть Y',
      'transform-rotate-z': 'Повернуть Z',
      'transform-scale-x': 'Масштаб X',
      'transform-scale-y': 'Масштаб Y',
      'transform-scale-z': 'Масштаб Z',
      'transition-property-sub': 'Свойство',
      'transition-duration-sub': 'Продолжительность',
      'transition-timing-function-sub': 'Время',
      'background-image-sub': 'Изображение',
      'background-repeat-sub': 'Повтор',
      'background-position-sub': 'Позиция',
      'background-attachment-sub': 'Вложение',
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
    empty: 'Выберите элемент перед использованием Trait Manager',
    label: 'Настройки компонента',
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
          placeholder: 'Прим. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Это окно',
          _blank: 'Новое окно'
        }
      }
    }
  },
  storageManager: {
    recover: 'Вы хотите восстановить несохраненные изменения?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Обтекание",
  "display": "Отображение",
  "position": "Положение",
  "top": "Сверху",
  "right": "Справа",
  "left": "Слева",
  "bottom": "Снизу",
  "width": "Ширина",
  "height": "Высота",
  "max-width": "Ширина (max.)",
  "max-height": "Высота (max.)",
  "margin": "Отступ",
  "margin-top": "Отступ: сверху",
  "margin-right": "Отступ: справа",
  "margin-left": "Отступ: слева",
  "margin-bottom": "Отступ: снизу",
  "padding": "Внутренний отступ",
  "padding-top": "Внутренний отступ: сверху",
  "padding-left": "Внутренний отступ: слева",
  "padding-right": "Внутренний отступ: справа",
  "padding-bottom": "Внутренний отступ: снизу",
  "font-family": "Шрифт: гарнитура",
  "font-size": "Шрифт: размер",
  "font-weight": "Шрифт: насыщенность",
  "letter-spacing": "Буквы: интервал",
  "color": "Цвет",
  "line-height": "Строка: высота",
  "text-align": "Текст: выравнивание",
  "text-shadow": "Текст: тень",
  "border-top-left": "Рамка: сверху · слева",
  "border-top-right": "Рамка: сверху · справа",
  "border-bottom-left": "Рамка: снизу · слева",
  "border-bottom-right": "Рамка: снизу · справа",
  "border-radius-top-left": "Рамка: радиус · сверху · слева",
  "border-radius-top-right": "Рамка: радиус · сверху · справа",
  "border-radius-bottom-left": "Рамка: радиус · снизу · слева",
  "border-radius-bottom-right": "Рамка: радиус · снизу · справа",
  "border-radius": "Рамка: радиус",
  "border": "Рамка",
  "border-width": "Рамка: ширина",
  "border-style": "Рамка: стиль",
  "border-color": "Рамка: цвет",
  "box-shadow": "Блок: тень",
  "background": "Фон",
  "background-image": "Фон: изображение",
  "background-repeat": "Фон: повтор",
  "background-position": "Фон: положение",
  "background-attachment": "Фон: привязка",
  "background-size": "Фон: размер",
  "background-color": "Фон: цвет",
  "transition": "Переход",
  "transition-property": "Переход: свойство",
  "transition-duration": "Переход: длительность",
  "transition-timing-function": "Переход: время",
  "perspective": "Перспектива",
  "transform": "Трансформация",
  "flex-direction": "Flex: направление",
  "flex-wrap": "Flex: перенос",
  "justify-content": "Распределение: содержимое",
  "align-items": "Выравнивание: элементы",
  "align-content": "Выравнивание: содержимое",
  "order": "Порядок",
  "flex-basis": "Flex: базис",
  "flex-grow": "Flex: рост",
  "flex-shrink": "Flex: сжатие",
  "align-self": "Выравнивание: собственное"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Альтернативный текст",
  "title": "Заголовок",
  "href": "Ссылка"
});
