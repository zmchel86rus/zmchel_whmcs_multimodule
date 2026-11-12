
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'cth. Teks di sini'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Tambah imej',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Pilih imej',
    uploadTitle: 'Seret dan lepaskan fail di sini atau klik untuk memuat naik'
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
      '': 'Kotak',
      wrapper: 'Badan halaman',
      text: 'Teks',
      comment: 'Komen',
      image: 'Imej',
      video: 'Video',
      label: 'Label',
      link: 'Pautan',
      map: 'Peta',
      tfoot: 'Pengaki jadual',
      tbody: 'Badan jadual',
      thead: 'Pengepala jadual',
      table: 'Jadual',
      row: 'Baris jadual',
      cell: 'Sel jadual'
    }
  },
  deviceManager: {
    device: 'Peranti',
    devices: {
      desktop: 'Komputer meja',
      tablet: 'Tablet',
      mobileLandscape: 'Mudah alih (landskap)',
      mobilePortrait: 'Mudah alih (potret)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Pratonton',
        fullscreen: 'Skrin penuh',
        'sw-visibility': 'Lihat komponen',
        'export-template': 'Lihat kod',
        'open-sm': 'Buka Pengurus Gaya',
        'open-tm': 'Tetapan',
        'open-layers': 'Buka Pengurus Lapisan',
        'open-blocks': 'Buka blok'
      }
    }
  },
  selectorManager: {
    label: 'Kelas',
    selected: 'Dipilih',
    emptyState: '- Keadaan -',
    states: {
      hover: 'Apabila penuding berada di atas',
      active: 'Apabila diklik',
      'nth-of-type(2n)': 'Genap/Ganjil'
    }
  },
  styleManager: {
    empty: 'Pilih elemen sebelum menggunakan Pengurus Gaya',
    layer: 'Lapisan',
    fileButton: 'Imej',
    sectors: {
      general: 'Umum',
      layout: 'Susun atur',
      typography: 'Tipografi',
      decorations: 'Hiasan',
      extra: 'Tambahan',
      flex: 'Flex',
      dimension: 'Dimensi'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Kekaburan',
      'text-shadow-color': 'Warna',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Kekaburan',
      'box-shadow-spread': 'Sebaran',
      'box-shadow-color': 'Warna',
      'box-shadow-type': 'Jenis',
      'margin-top-sub': 'Atas',
      'margin-right-sub': 'Kanan',
      'margin-bottom-sub': 'Bawah',
      'margin-left-sub': 'Kiri',
      'padding-top-sub': 'Atas',
      'padding-right-sub': 'Kanan',
      'padding-bottom-sub': 'Bawah',
      'padding-left-sub': 'Kiri',
      'border-width-sub': 'Lebar',
      'border-style-sub': 'Gaya',
      'border-color-sub': 'Warna',
      'border-top-left-radius-sub': 'Bucu kiri atas',
      'border-top-right-radius-sub': 'Bucu kanan atas',
      'border-bottom-right-radius-sub': 'Bucu kanan bawah',
      'border-bottom-left-radius-sub': 'Bucu kiri bawah',
      'transform-rotate-x': 'Putaran X',
      'transform-rotate-y': 'Putaran Y',
      'transform-rotate-z': 'Putaran Z',
      'transform-scale-x': 'Penskalaan X',
      'transform-scale-y': 'Penskalaan Y',
      'transform-scale-z': 'Penskalaan Z',
      'transition-property-sub': 'Sifat',
      'transition-duration-sub': 'Tempoh',
      'transition-timing-function-sub': 'Pemasaan',
      'background-image-sub': 'Imej',
      'background-repeat-sub': 'Ulangan',
      'background-position-sub': 'Kedudukan',
      'background-attachment-sub': 'Lekatan',
      'background-size-sub': 'Saiz'
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
    empty: 'Pilih elemen sebelum menggunakan Pengurus Atribut',
    label: 'Tetapan komponen',
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
          placeholder: 'cth. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Tetingkap ini',
          _blank: 'Tetingkap baharu'
        }
      }
    }
  },
  storageManager: {
    recover: 'Adakah anda mahu memulihkan perubahan yang belum disimpan?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Apungan",
  "display": "Paparan",
  "position": "Kedudukan",
  "top": "Atas",
  "right": "Kanan",
  "left": "Kiri",
  "bottom": "Bawah",
  "width": "Lebar",
  "height": "Tinggi",
  "max-width": "Lebar maksimum",
  "max-height": "Tinggi maksimum",
  "margin": "Jidar luar",
  "margin-top": "Jidar luar atas",
  "margin-right": "Jidar luar kanan",
  "margin-left": "Jidar luar kiri",
  "margin-bottom": "Jidar luar bawah",
  "padding": "Ruang dalam",
  "padding-top": "Ruang dalam atas",
  "padding-left": "Ruang dalam kiri",
  "padding-right": "Ruang dalam kanan",
  "padding-bottom": "Ruang dalam bawah",
  "font-family": "Keluarga fon",
  "font-size": "Saiz fon",
  "font-weight": "Ketebalan fon",
  "letter-spacing": "Jarak antara huruf",
  "color": "Warna",
  "line-height": "Ketinggian baris",
  "text-align": "Penjajaran teks",
  "text-shadow": "Bayang-bayang teks",
  "border-top-left": "Sempadan kiri atas",
  "border-top-right": "Sempadan kanan atas",
  "border-bottom-left": "Sempadan kiri bawah",
  "border-bottom-right": "Sempadan kanan bawah",
  "border-radius-top-left": "Pembulatan bucu kiri atas",
  "border-radius-top-right": "Pembulatan bucu kanan atas",
  "border-radius-bottom-left": "Pembulatan bucu kiri bawah",
  "border-radius-bottom-right": "Pembulatan bucu kanan bawah",
  "border-radius": "Pembulatan bucu",
  "border": "Sempadan",
  "border-width": "Lebar sempadan",
  "border-style": "Gaya sempadan",
  "border-color": "Warna sempadan",
  "box-shadow": "Bayang-bayang kotak",
  "background": "Latar belakang",
  "background-image": "Imej latar belakang",
  "background-repeat": "Ulangan latar belakang",
  "background-position": "Kedudukan latar belakang",
  "background-attachment": "Lekatan latar belakang",
  "background-size": "Saiz latar belakang",
  "background-color": "Warna latar belakang",
  "transition": "Peralihan",
  "transition-property": "Sifat peralihan",
  "transition-duration": "Tempoh peralihan",
  "transition-timing-function": "Pemasaan peralihan",
  "perspective": "Perspektif",
  "transform": "Transformasi",
  "flex-direction": "Arah Flex",
  "flex-wrap": "Pembalutan Flex",
  "justify-content": "Pengagihan kandungan",
  "align-items": "Penjajaran item",
  "align-content": "Penjajaran kandungan",
  "order": "Susunan",
  "flex-basis": "Asas Flex",
  "flex-grow": "Pertumbuhan Flex",
  "flex-shrink": "Pengecutan Flex",
  "align-self": "Penjajaran sendiri"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Teks alternatif",
  "title": "Tajuk",
  "href": "Pautan"
});