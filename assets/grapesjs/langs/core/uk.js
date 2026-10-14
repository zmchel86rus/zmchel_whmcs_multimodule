"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.default = {
  assetManager: { addButton: 'Додати зображення', modalTitle: 'Вибрати зображення', uploadTitle: 'Перетягніть файли сюди або натисніть для завантаження' },
  blockManager: { labels: {}, categories: {} },
  domComponents: { names: { '': 'Блок', wrapper: 'Вміст', text: 'Текст', image: 'Зображення', video: 'Відео', link: 'Посилання', map: 'Карта', table: 'Таблиця', row: 'Рядок', cell: 'Комірка' } },
  deviceManager: { device: 'Пристрій', devices: { desktop: 'Комп’ютер', tablet: 'Планшет', mobileLandscape: 'Телефон горизонтально', mobilePortrait: 'Телефон вертикально' } },
  panels: { buttons: { titles: { preview: 'Перегляд', fullscreen: 'На весь екран', 'sw-visibility': 'Показати компоненти', 'export-template': 'Переглянути код', 'open-sm': 'Стилі', 'open-tm': 'Налаштування', 'open-layers': 'Шари', 'open-blocks': 'Блоки' } } },
  selectorManager: { label: 'Класи', selected: 'Вибрано', emptyState: '- Стан -', states: { hover: 'Наведення', active: 'Натискання' } },
  styleManager: { empty: 'Виберіть елемент для зміни стилю', layer: 'Шар', fileButton: 'Зображення', sectors: { general: 'Загальне', layout: 'Макет', typography: 'Типографіка', decorations: 'Оформлення', extra: 'Додатково', flex: 'Flex', dimension: 'Розмір' } },
  traitManager: { empty: 'Виберіть елемент для налаштування', label: 'Налаштування компонента', traits: { labels: { href: 'Посилання', alt: 'Альтернативний текст', title: 'Назва' }, attributes: {}, options: { target: { false: 'Поточне вікно', _blank: 'Нове вікно' } } } },
  storageManager: { recover: 'Відновити незбережені зміни?' }
};

// Additional GrapesJS labels used by the editor.
exports.default.assetManager = Object.assign(exports.default.assetManager || {}, {
  "inputPlh": "http://шлях/до/зображення.jpg"
});
exports.default.domComponents.names = Object.assign(exports.default.domComponents.names || {}, {
  "comment": "Коментар",
  "label": "Мітка",
  "tfoot": "Нижній колонтитул таблиці",
  "tbody": "Тіло таблиці",
  "thead": "Заголовок таблиці"
});
exports.default.selectorManager.states = Object.assign(exports.default.selectorManager.states || {}, {
  "nth-of-type(2n)": "Парний/непарний"
});
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "text-shadow-h": "X",
  "text-shadow-v": "Y",
  "text-shadow-blur": "Розмиття",
  "text-shadow-color": "Колір",
  "box-shadow-h": "X",
  "box-shadow-v": "Y",
  "box-shadow-blur": "Розмиття",
  "box-shadow-spread": "Розмах",
  "box-shadow-color": "Колір",
  "box-shadow-type": "Тип",
  "margin-top-sub": "Зверху",
  "margin-right-sub": "Справа",
  "margin-bottom-sub": "Знизу",
  "margin-left-sub": "Зліва",
  "padding-top-sub": "Зверху",
  "padding-right-sub": "Справа",
  "padding-bottom-sub": "Знизу",
  "padding-left-sub": "Зліва",
  "border-width-sub": "Ширина",
  "border-style-sub": "Стиль",
  "border-color-sub": "Колір",
  "border-top-left-radius-sub": "Зверху Зліва",
  "border-top-right-radius-sub": "Зверху Справа",
  "border-bottom-right-radius-sub": "Знизу Справа",
  "border-bottom-left-radius-sub": "Знизу Зліва",
  "transform-rotate-x": "Поворот X",
  "transform-rotate-y": "Поворот Y",
  "transform-rotate-z": "Поворот Z",
  "transform-scale-x": "Масштаб X",
  "transform-scale-y": "Масштаб Y",
  "transform-scale-z": "Масштаб Z",
  "transition-property-sub": "Властивість",
  "transition-duration-sub": "Тривалість",
  "transition-timing-function-sub": "Час",
  "background-image-sub": "Зображення",
  "background-repeat-sub": "Повтор",
  "background-position-sub": "Положення",
  "background-attachment-sub": "Прив'язка",
  "background-size-sub": "Розмір",
  "float": "Обтікання",
  "display": "Відображення",
  "position": "Положення",
  "top": "Зверху",
  "right": "Справа",
  "left": "Зліва",
  "bottom": "Знизу",
  "width": "Ширина",
  "height": "Висота",
  "max-width": "Ширина (max.)",
  "max-height": "Висота (max.)",
  "margin": "Відступ",
  "margin-top": "Відступ: зверху",
  "margin-right": "Відступ: справа",
  "margin-left": "Відступ: зліва",
  "margin-bottom": "Відступ: знизу",
  "padding": "Внутрішній відступ",
  "padding-top": "Внутрішній відступ: зверху",
  "padding-left": "Внутрішній відступ: зліва",
  "padding-right": "Внутрішній відступ: справа",
  "padding-bottom": "Внутрішній відступ: знизу",
  "font-family": "Шрифт: родина",
  "font-size": "Шрифт: розмір",
  "font-weight": "Шрифт: насиченість",
  "letter-spacing": "Літери: інтервал",
  "color": "Колір",
  "line-height": "Рядок: висота",
  "text-align": "Текст: вирівнювання",
  "text-shadow": "Текст: тінь",
  "border-top-left": "Рамка: зверху · зліва",
  "border-top-right": "Рамка: зверху · справа",
  "border-bottom-left": "Рамка: знизу · зліва",
  "border-bottom-right": "Рамка: знизу · справа",
  "border-radius-top-left": "Рамка: радіус · зверху · зліва",
  "border-radius-top-right": "Рамка: радіус · зверху · справа",
  "border-radius-bottom-left": "Рамка: радіус · знизу · зліва",
  "border-radius-bottom-right": "Рамка: радіус · знизу · справа",
  "border-radius": "Рамка: радіус",
  "border": "Рамка",
  "border-width": "Рамка: ширина",
  "border-style": "Рамка: стиль",
  "border-color": "Рамка: колір",
  "box-shadow": "Блок: тінь",
  "background": "Фон",
  "background-image": "Фон: зображення",
  "background-repeat": "Фон: повтор",
  "background-position": "Фон: положення",
  "background-attachment": "Фон: прив'язка",
  "background-size": "Фон: розмір",
  "background-color": "Фон: колір",
  "transition": "Перехід",
  "transition-property": "Перехід: властивість",
  "transition-duration": "Перехід: тривалість",
  "transition-timing-function": "Перехід: час",
  "perspective": "Перспектива",
  "transform": "Перетворення",
  "flex-direction": "Flex: напрямок",
  "flex-wrap": "Flex: перенесення",
  "justify-content": "Розподіл: вміст",
  "align-items": "Вирівнювання: елементи",
  "align-content": "Вирівнювання: вміст",
  "order": "Порядок",
  "flex-basis": "Flex: основа",
  "flex-grow": "Flex: зростання",
  "flex-shrink": "Flex: стиснення",
  "align-self": "Вирівнювання: власне"
});
exports.default.traitManager.traits.attributes.id = Object.assign(exports.default.traitManager.traits.attributes.id || {}, {
  "placeholder": "наприклад, текст"
});
exports.default.traitManager.traits.attributes.alt = Object.assign(exports.default.traitManager.traits.attributes.alt || {}, {
  "placeholder": "наприклад, текст"
});
exports.default.traitManager.traits.attributes.title = Object.assign(exports.default.traitManager.traits.attributes.title || {}, {
  "placeholder": "наприклад, текст"
});
exports.default.traitManager.traits.attributes.href = Object.assign(exports.default.traitManager.traits.attributes.href || {}, {
  "placeholder": "наприклад, https://google.com"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID"
});
