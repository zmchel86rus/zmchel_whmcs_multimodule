
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'örn. Buraya metin yazın'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Resim ekle',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Resim seç',
    uploadTitle: 'Dosyaları buraya sürükleyip bırakın veya yüklemek için tıklayın'
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
      '': 'Kutu',
      wrapper: 'Gövde',
      text: 'Metin',
      comment: 'Yorum',
      image: 'Resim',
      video: 'Video',
      label: 'Etiket',
      link: 'Bağlantı',
      map: 'Harita',
      tfoot: 'Tablo alt bilgisi',
      tbody: 'Tablo gövdesi',
      thead: 'Tablo üst bilgisi',
      table: 'Tablo',
      row: 'Tablo satırı',
      cell: 'Tablo hücresi'
    }
  },
  deviceManager: {
    device: 'Cihaz',
    devices: {
      desktop: 'Masaüstü',
      tablet: 'Tablet',
      mobileLandscape: 'Mobil (yatay)',
      mobilePortrait: 'Mobil (dikey)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Önizleme',
        fullscreen: 'Tam ekran',
        'sw-visibility': 'Bileşenleri göster',
        'export-template': 'Kodu görüntüle',
        'open-sm': 'Stil yöneticisini aç',
        'open-tm': 'Ayarlar',
        'open-layers': 'Katman yöneticisini aç',
        'open-blocks': 'Blokları aç'
      }
    }
  },
  selectorManager: {
    label: 'Sınıflar',
    selected: 'Seçili',
    emptyState: '- Durum -',
    states: {
      hover: 'Üzerine gelme',
      active: 'Tıklama',
      'nth-of-type(2n)': 'Çift/Tek'
    }
  },
  styleManager: {
    empty: 'Stil yöneticisini kullanmadan önce bir öğe seçin',
    layer: 'Katman',
    fileButton: 'Resimler',
    sectors: {
      general: 'Genel',
      layout: 'Düzen',
      typography: 'Tipografi',
      decorations: 'Süslemeler',
      extra: 'Ek',
      flex: 'Flex',
      dimension: 'Boyutlar'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Bulanıklık',
      'text-shadow-color': 'Renk',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Bulanıklık',
      'box-shadow-spread': 'Yayılma',
      'box-shadow-color': 'Renk',
      'box-shadow-type': 'Tür',
      'margin-top-sub': 'Üst',
      'margin-right-sub': 'Sağ',
      'margin-bottom-sub': 'Alt',
      'margin-left-sub': 'Sol',
      'padding-top-sub': 'Üst',
      'padding-right-sub': 'Sağ',
      'padding-bottom-sub': 'Alt',
      'padding-left-sub': 'Sol',
      'border-width-sub': 'Genişlik',
      'border-style-sub': 'Stil',
      'border-color-sub': 'Renk',
      'border-top-left-radius-sub': 'Sol üst köşe',
      'border-top-right-radius-sub': 'Sağ üst köşe',
      'border-bottom-right-radius-sub': 'Sağ alt köşe',
      'border-bottom-left-radius-sub': 'Sol alt köşe',
      'transform-rotate-x': 'X ekseninde döndürme',
      'transform-rotate-y': 'Y ekseninde döndürme',
      'transform-rotate-z': 'Z ekseninde döndürme',
      'transform-scale-x': 'X ekseninde ölçekleme',
      'transform-scale-y': 'Y ekseninde ölçekleme',
      'transform-scale-z': 'Z ekseninde ölçekleme',
      'transition-property-sub': 'Özellik',
      'transition-duration-sub': 'Süre',
      'transition-timing-function-sub': 'Zamanlama',
      'background-image-sub': 'Resim',
      'background-repeat-sub': 'Tekrarlama',
      'background-position-sub': 'Konum',
      'background-attachment-sub': 'Sabitleme',
      'background-size-sub': 'Boyut'
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
    empty: 'Özellik yöneticisini kullanmadan önce bir öğe seçin',
    label: 'Bileşen ayarları',
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
          placeholder: 'örn. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Bu pencere',
          _blank: 'Yeni pencere'
        }
      }
    }
  },
  storageManager: {
    recover: 'Kaydedilmemiş değişiklikleri geri yüklemek istiyor musunuz?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Kaydırma",
  "display": "Görüntüleme",
  "position": "Konum",
  "top": "Üst",
  "right": "Sağ",
  "left": "Sol",
  "bottom": "Alt",
  "width": "Genişlik",
  "height": "Yükseklik",
  "max-width": "Genişlik (max.)",
  "max-height": "Yükseklik (max.)",
  "margin": "Kenar boşluğu",
  "margin-top": "Kenar boşluğu: üst",
  "margin-right": "Kenar boşluğu: sağ",
  "margin-left": "Kenar boşluğu: sol",
  "margin-bottom": "Kenar boşluğu: alt",
  "padding": "İç boşluk",
  "padding-top": "İç boşluk: üst",
  "padding-left": "İç boşluk: sol",
  "padding-right": "İç boşluk: sağ",
  "padding-bottom": "İç boşluk: alt",
  "font-family": "Yazı tipi: aile",
  "font-size": "Yazı tipi: boyut",
  "font-weight": "Yazı tipi: kalınlık",
  "letter-spacing": "Harf: aralık",
  "color": "Renk",
  "line-height": "Satır: yükseklik",
  "text-align": "Metin: hizalama",
  "text-shadow": "Metin: gölge",
  "border-top-left": "Kenarlık: üst · sol",
  "border-top-right": "Kenarlık: üst · sağ",
  "border-bottom-left": "Kenarlık: alt · sol",
  "border-bottom-right": "Kenarlık: alt · sağ",
  "border-radius-top-left": "Kenarlık: yarıçap · üst · sol",
  "border-radius-top-right": "Kenarlık: yarıçap · üst · sağ",
  "border-radius-bottom-left": "Kenarlık: yarıçap · alt · sol",
  "border-radius-bottom-right": "Kenarlık: yarıçap · alt · sağ",
  "border-radius": "Kenarlık: yarıçap",
  "border": "Kenarlık",
  "border-width": "Kenarlık: genişlik",
  "border-style": "Kenarlık: stil",
  "border-color": "Kenarlık: renk",
  "box-shadow": "Kutu: gölge",
  "background": "Arka plan",
  "background-image": "Arka plan: görsel",
  "background-repeat": "Arka plan: tekrar",
  "background-position": "Arka plan: konum",
  "background-attachment": "Arka plan: ek",
  "background-size": "Arka plan: boyut",
  "background-color": "Arka plan: renk",
  "transition": "Geçiş",
  "transition-property": "Geçiş: özellik",
  "transition-duration": "Geçiş: süre",
  "transition-timing-function": "Geçiş: zamanlama",
  "perspective": "Perspektif",
  "transform": "Dönüşüm",
  "flex-direction": "Flex: yön",
  "flex-wrap": "Flex: kaydırma",
  "justify-content": "Dağıtma: i̇çerik",
  "align-items": "Hizalama: öğeler",
  "align-content": "Hizalama: i̇çerik",
  "order": "Sıra",
  "flex-basis": "Flex: temel",
  "flex-grow": "Flex: büyüme",
  "flex-shrink": "Flex: küçülme",
  "align-self": "Hizalama: kendi"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternatif metin",
  "title": "Başlık",
  "href": "Bağlantı"
});
