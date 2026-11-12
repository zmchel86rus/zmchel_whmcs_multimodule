"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'məs. Buraya mətn yazın'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Şəkil əlavə et',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Şəkil seç',
    uploadTitle: 'Faylları buraya sürükləyin və ya yükləmək üçün klikləyin'
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
      '': 'Qutu',
      wrapper: 'Səhifənin gövdəsi',
      text: 'Mətn',
      comment: 'Şərh',
      image: 'Şəkil',
      video: 'Video',
      label: 'Etiket',
      link: 'Keçid',
      map: 'Xəritə',
      tfoot: 'Cədvəlin alt hissəsi',
      tbody: 'Cədvəlin gövdəsi',
      thead: 'Cədvəlin başlıq hissəsi',
      table: 'Cədvəl',
      row: 'Cədvəl sətri',
      cell: 'Cədvəl xanası'
    }
  },
  deviceManager: {
    device: 'Cihaz',
    devices: {
      desktop: 'Kompüter',
      tablet: 'Planşet',
      mobileLandscape: 'Mobil (üfüqi)',
      mobilePortrait: 'Mobil (şaquli)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Önizləmə',
        fullscreen: 'Tam ekran',
        'sw-visibility': 'Komponentləri göstər',
        'export-template': 'Kodu göstər',
        'open-sm': 'Üslub menecerini aç',
        'open-tm': 'Parametrlər',
        'open-layers': 'Qat menecerini aç',
        'open-blocks': 'Blokları aç'
      }
    }
  },
  selectorManager: {
    label: 'Siniflər',
    selected: 'Seçilmiş',
    emptyState: '- Vəziyyət -',
    states: {
      hover: 'Kursor üzərinə gətirildikdə',
      active: 'Klikləndikdə',
      'nth-of-type(2n)': 'Cüt/tək'
    }
  },
  styleManager: {
    empty: 'Üslub menecerindən istifadə etməzdən əvvəl elementi seçin',
    layer: 'Qat',
    fileButton: 'Şəkillər',
    sectors: {
      general: 'Ümumi',
      layout: 'Yerləşdirmə',
      typography: 'Tipoqrafiya',
      decorations: 'Bəzəklər',
      extra: 'Əlavə',
      flex: 'Flex',
      dimension: 'Ölçülər'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Bulanıqlıq',
      'text-shadow-color': 'Rəng',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Bulanıqlıq',
      'box-shadow-spread': 'Yayılma',
      'box-shadow-color': 'Rəng',
      'box-shadow-type': 'Növ',
      'margin-top-sub': 'Yuxarı',
      'margin-right-sub': 'Sağ',
      'margin-bottom-sub': 'Aşağı',
      'margin-left-sub': 'Sol',
      'padding-top-sub': 'Yuxarı',
      'padding-right-sub': 'Sağ',
      'padding-bottom-sub': 'Aşağı',
      'padding-left-sub': 'Sol',
      'border-width-sub': 'En',
      'border-style-sub': 'Üslub',
      'border-color-sub': 'Rəng',
      'border-top-left-radius-sub': 'Yuxarı sol künc',
      'border-top-right-radius-sub': 'Yuxarı sağ künc',
      'border-bottom-right-radius-sub': 'Aşağı sağ künc',
      'border-bottom-left-radius-sub': 'Aşağı sol künc',
      'transform-rotate-x': 'X oxu üzrə fırlatma',
      'transform-rotate-y': 'Y oxu üzrə fırlatma',
      'transform-rotate-z': 'Z oxu üzrə fırlatma',
      'transform-scale-x': 'X oxu üzrə miqyaslandırma',
      'transform-scale-y': 'Y oxu üzrə miqyaslandırma',
      'transform-scale-z': 'Z oxu üzrə miqyaslandırma',
      'transition-property-sub': 'Xüsusiyyət',
      'transition-duration-sub': 'Müddət',
      'transition-timing-function-sub': 'Vaxt funksiyası',
      'background-image-sub': 'Şəkil',
      'background-repeat-sub': 'Təkrarlama',
      'background-position-sub': 'Mövqe',
      'background-attachment-sub': 'Bərkitmə',
      'background-size-sub': 'Ölçü'
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
    empty: 'Atribut menecerindən istifadə etməzdən əvvəl elementi seçin',
    label: 'Komponent parametrləri',
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
          placeholder: 'məs. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Bu pəncərə',
          _blank: 'Yeni pəncərə'
        }
      }
    }
  },
  storageManager: {
    recover: 'Yadda saxlanmamış dəyişiklikləri bərpa etmək istəyirsiniz?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Üzən yerləşdirmə",
  "display": "Göstərilmə",
  "position": "Mövqe",
  "top": "Yuxarı",
  "right": "Sağ",
  "left": "Sol",
  "bottom": "Aşağı",
  "width": "En",
  "height": "Hündürlük",
  "max-width": "Maksimum en",
  "max-height": "Maksimum hündürlük",
  "margin": "Xarici boşluq",
  "margin-top": "Yuxarı xarici boşluq",
  "margin-right": "Sağ xarici boşluq",
  "margin-left": "Sol xarici boşluq",
  "margin-bottom": "Aşağı xarici boşluq",
  "padding": "Daxili boşluq",
  "padding-top": "Yuxarı daxili boşluq",
  "padding-left": "Sol daxili boşluq",
  "padding-right": "Sağ daxili boşluq",
  "padding-bottom": "Aşağı daxili boşluq",
  "font-family": "Şrift ailəsi",
  "font-size": "Şrift ölçüsü",
  "font-weight": "Şrift qalınlığı",
  "letter-spacing": "Hərflərarası məsafə",
  "color": "Rəng",
  "line-height": "Sətir hündürlüyü",
  "text-align": "Mətnin düzləndirilməsi",
  "text-shadow": "Mətn kölgəsi",
  "border-top-left": "Yuxarı sol çərçivə",
  "border-top-right": "Yuxarı sağ çərçivə",
  "border-bottom-left": "Aşağı sol çərçivə",
  "border-bottom-right": "Aşağı sağ çərçivə",
  "border-radius-top-left": "Yuxarı sol küncün yuvarlaqlaşdırılması",
  "border-radius-top-right": "Yuxarı sağ küncün yuvarlaqlaşdırılması",
  "border-radius-bottom-left": "Aşağı sol küncün yuvarlaqlaşdırılması",
  "border-radius-bottom-right": "Aşağı sağ küncün yuvarlaqlaşdırılması",
  "border-radius": "Künclərin yuvarlaqlaşdırılması",
  "border": "Çərçivə",
  "border-width": "Çərçivənin qalınlığı",
  "border-style": "Çərçivənin üslubu",
  "border-color": "Çərçivənin rəngi",
  "box-shadow": "Blokun kölgəsi",
  "background": "Fon",
  "background-image": "Fon şəkli",
  "background-repeat": "Fonun təkrarlanması",
  "background-position": "Fonun mövqeyi",
  "background-attachment": "Fonun bərkidilməsi",
  "background-size": "Fonun ölçüsü",
  "background-color": "Fon rəngi",
  "transition": "Keçid effekti",
  "transition-property": "Keçid xüsusiyyəti",
  "transition-duration": "Keçidin müddəti",
  "transition-timing-function": "Keçidin vaxt funksiyası",
  "perspective": "Perspektiv",
  "transform": "Transformasiya",
  "flex-direction": "Flex istiqaməti",
  "flex-wrap": "Flex elementlərinin növbəti sətrə keçirilməsi",
  "justify-content": "Məzmunun əsas ox üzrə düzləndirilməsi",
  "align-items": "Elementlərin düzləndirilməsi",
  "align-content": "Məzmunun düzləndirilməsi",
  "order": "Sıra",
  "flex-basis": "Flex baza ölçüsü",
  "flex-grow": "Flex böyüməsi",
  "flex-shrink": "Flex kiçilməsi",
  "align-self": "Fərdi düzləndirmə"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Alternativ mətn",
  "title": "Başlıq",
  "href": "Keçid"
});