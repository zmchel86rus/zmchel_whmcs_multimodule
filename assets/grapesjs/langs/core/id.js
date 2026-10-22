
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'mis. Teks di sini'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Tambahkan gambar',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Pilih gambar',
    uploadTitle: 'Seret file ke sini atau klik untuk mengunggah'
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
      comment: 'Komentar',
      image: 'Gambar',
      video: 'Video',
      label: 'Label',
      link: 'Tautan',
      map: 'Peta',
      tfoot: 'Bagian bawah tabel',
      tbody: 'Isi tabel',
      thead: 'Bagian atas tabel',
      table: 'Tabel',
      row: 'Baris tabel',
      cell: 'Sel tabel'
    }
  },
  deviceManager: {
    device: 'Perangkat',
    devices: {
      desktop: 'Komputer desktop',
      tablet: 'Tablet',
      mobileLandscape: 'Ponsel (lanskap)',
      mobilePortrait: 'Ponsel (potret)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Pratinjau',
        fullscreen: 'Layar penuh',
        'sw-visibility': 'Tampilkan komponen',
        'export-template': 'Lihat kode',
        'open-sm': 'Buka Pengelola Gaya',
        'open-tm': 'Pengaturan',
        'open-layers': 'Buka Pengelola Lapisan',
        'open-blocks': 'Buka Blok'
      }
    }
  },
  selectorManager: {
    label: 'Kelas',
    selected: 'Dipilih',
    emptyState: '- Status -',
    states: {
      hover: 'Saat kursor diarahkan',
      active: 'Saat diklik',
      'nth-of-type(2n)': 'Genap/Ganjil'
    }
  },
  styleManager: {
    empty: 'Pilih elemen sebelum menggunakan Pengelola Gaya',
    layer: 'Lapisan',
    fileButton: 'Gambar',
    sectors: {
      general: 'Umum',
      layout: 'Tata letak',
      typography: 'Tipografi',
      decorations: 'Dekorasi',
      extra: 'Lainnya',
      flex: 'Flex',
      dimension: 'Dimensi'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Keburaman',
      'text-shadow-color': 'Warna',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Keburaman',
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
      'border-top-left-radius-sub': 'Sudut kiri atas',
      'border-top-right-radius-sub': 'Sudut kanan atas',
      'border-bottom-right-radius-sub': 'Sudut kanan bawah',
      'border-bottom-left-radius-sub': 'Sudut kiri bawah',
      'transform-rotate-x': 'Rotasi X',
      'transform-rotate-y': 'Rotasi Y',
      'transform-rotate-z': 'Rotasi Z',
      'transform-scale-x': 'Skala X',
      'transform-scale-y': 'Skala Y',
      'transform-scale-z': 'Skala Z',
      'transition-property-sub': 'Properti',
      'transition-duration-sub': 'Durasi',
      'transition-timing-function-sub': 'Fungsi waktu',
      'background-image-sub': 'Gambar',
      'background-repeat-sub': 'Pengulangan',
      'background-position-sub': 'Posisi',
      'background-attachment-sub': 'Perlekatan',
      'background-size-sub': 'Ukuran'
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
    empty: 'Pilih elemen sebelum menggunakan Pengelola Atribut',
    label: 'Pengaturan komponen',
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
          placeholder: 'mis. https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Jendela ini',
          _blank: 'Jendela baru'
        }
      }
    }
  },
  storageManager: {
    recover: 'Apakah Anda ingin memulihkan perubahan yang belum disimpan?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Mengambang",
  "display": "Tampilan",
  "position": "Posisi",
  "top": "Atas",
  "right": "Kanan",
  "left": "Kiri",
  "bottom": "Bawah",
  "width": "Lebar",
  "height": "Tinggi",
  "max-width": "Lebar maksimum",
  "max-height": "Tinggi maksimum",
  "margin": "Margin luar",
  "margin-top": "Margin atas",
  "margin-right": "Margin kanan",
  "margin-left": "Margin kiri",
  "margin-bottom": "Margin bawah",
  "padding": "Padding dalam",
  "padding-top": "Padding atas",
  "padding-left": "Padding kiri",
  "padding-right": "Padding kanan",
  "padding-bottom": "Padding bawah",
  "font-family": "Jenis huruf",
  "font-size": "Ukuran huruf",
  "font-weight": "Ketebalan huruf",
  "letter-spacing": "Jarak antarhuruf",
  "color": "Warna",
  "line-height": "Tinggi baris",
  "text-align": "Perataan teks",
  "text-shadow": "Bayangan teks",
  "border-top-left": "Batas kiri atas",
  "border-top-right": "Batas kanan atas",
  "border-bottom-left": "Batas kiri bawah",
  "border-bottom-right": "Batas kanan bawah",
  "border-radius-top-left": "Radius sudut kiri atas",
  "border-radius-top-right": "Radius sudut kanan atas",
  "border-radius-bottom-left": "Radius sudut kiri bawah",
  "border-radius-bottom-right": "Radius sudut kanan bawah",
  "border-radius": "Radius sudut",
  "border": "Batas",
  "border-width": "Ketebalan batas",
  "border-style": "Gaya batas",
  "border-color": "Warna batas",
  "box-shadow": "Bayangan kotak",
  "background": "Latar belakang",
  "background-image": "Gambar latar belakang",
  "background-repeat": "Pengulangan latar belakang",
  "background-position": "Posisi latar belakang",
  "background-attachment": "Perlekatan latar belakang",
  "background-size": "Ukuran latar belakang",
  "background-color": "Warna latar belakang",
  "transition": "Transisi",
  "transition-property": "Properti transisi",
  "transition-duration": "Durasi transisi",
  "transition-timing-function": "Fungsi waktu transisi",
  "perspective": "Perspektif",
  "transform": "Transformasi",
  "flex-direction": "Arah Flex",
  "flex-wrap": "Pembungkusan Flex",
  "justify-content": "Perataan konten",
  "align-items": "Perataan item",
  "align-content": "Perataan konten lintas baris",
  "order": "Urutan",
  "flex-basis": "Basis Flex",
  "flex-grow": "Pertumbuhan Flex",
  "flex-shrink": "Penyusutan Flex",
  "align-self": "Perataan diri"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Teks alternatif",
  "title": "Judul",
  "href": "Tautan"
});