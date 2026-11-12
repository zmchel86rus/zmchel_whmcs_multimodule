
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'ví dụ: Nhập văn bản ở đây'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Thêm hình ảnh',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Chọn hình ảnh',
    uploadTitle: 'Kéo thả tệp vào đây hoặc nhấp để tải lên'
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
      '': 'Khối',
      wrapper: 'Phần thân trang',
      text: 'Văn bản',
      comment: 'Bình luận',
      image: 'Hình ảnh',
      video: 'Video',
      label: 'Nhãn',
      link: 'Liên kết',
      map: 'Bản đồ',
      tfoot: 'Chân bảng',
      tbody: 'Thân bảng',
      thead: 'Đầu bảng',
      table: 'Bảng',
      row: 'Hàng trong bảng',
      cell: 'Ô trong bảng'
    }
  },
  deviceManager: {
    device: 'Thiết bị',
    devices: {
      desktop: 'Máy tính',
      tablet: 'Máy tính bảng',
      mobileLandscape: 'Di động (ngang)',
      mobilePortrait: 'Di động (dọc)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Xem trước',
        fullscreen: 'Toàn màn hình',
        'sw-visibility': 'Hiển thị các thành phần',
        'export-template': 'Xem mã nguồn',
        'open-sm': 'Mở trình quản lý kiểu',
        'open-tm': 'Cài đặt',
        'open-layers': 'Mở trình quản lý lớp',
        'open-blocks': 'Mở các khối'
      }
    }
  },
  selectorManager: {
    label: 'Lớp CSS',
    selected: 'Đã chọn',
    emptyState: '- Trạng thái -',
    states: {
      hover: 'Khi di chuột',
      active: 'Khi nhấp',
      'nth-of-type(2n)': 'Chẵn/Lẻ'
    }
  },
  styleManager: {
    empty: 'Chọn một phần tử trước khi sử dụng trình quản lý kiểu',
    layer: 'Lớp',
    fileButton: 'Hình ảnh',
    sectors: {
      general: 'Chung',
      layout: 'Bố cục',
      typography: 'Kiểu chữ',
      decorations: 'Trang trí',
      extra: 'Khác',
      flex: 'Flex',
      dimension: 'Kích thước'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Độ mờ',
      'text-shadow-color': 'Màu sắc',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Độ mờ',
      'box-shadow-spread': 'Độ lan rộng',
      'box-shadow-color': 'Màu sắc',
      'box-shadow-type': 'Kiểu',
      'margin-top-sub': 'Trên',
      'margin-right-sub': 'Phải',
      'margin-bottom-sub': 'Dưới',
      'margin-left-sub': 'Trái',
      'padding-top-sub': 'Trên',
      'padding-right-sub': 'Phải',
      'padding-bottom-sub': 'Dưới',
      'padding-left-sub': 'Trái',
      'border-width-sub': 'Chiều rộng',
      'border-style-sub': 'Kiểu',
      'border-color-sub': 'Màu sắc',
      'border-top-left-radius-sub': 'Góc trên bên trái',
      'border-top-right-radius-sub': 'Góc trên bên phải',
      'border-bottom-right-radius-sub': 'Góc dưới bên phải',
      'border-bottom-left-radius-sub': 'Góc dưới bên trái',
      'transform-rotate-x': 'Xoay trục X',
      'transform-rotate-y': 'Xoay trục Y',
      'transform-rotate-z': 'Xoay trục Z',
      'transform-scale-x': 'Thay đổi tỷ lệ trục X',
      'transform-scale-y': 'Thay đổi tỷ lệ trục Y',
      'transform-scale-z': 'Thay đổi tỷ lệ trục Z',
      'transition-property-sub': 'Thuộc tính',
      'transition-duration-sub': 'Thời lượng',
      'transition-timing-function-sub': 'Hàm thời gian',
      'background-image-sub': 'Hình ảnh',
      'background-repeat-sub': 'Lặp lại',
      'background-position-sub': 'Vị trí',
      'background-attachment-sub': 'Kiểu cuộn nền',
      'background-size-sub': 'Kích thước'
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
    empty: 'Chọn một phần tử trước khi sử dụng trình quản lý thuộc tính',
    label: 'Cài đặt thành phần',
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
          placeholder: 'ví dụ: https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Cửa sổ này',
          _blank: 'Cửa sổ mới'
        }
      }
    }
  },
  storageManager: {
    recover: 'Bạn có muốn khôi phục các thay đổi chưa lưu không?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Định vị nổi",
  "display": "Hiển thị",
  "position": "Vị trí",
  "top": "Trên",
  "right": "Phải",
  "left": "Trái",
  "bottom": "Dưới",
  "width": "Chiều rộng",
  "height": "Chiều cao",
  "max-width": "Chiều rộng tối đa",
  "max-height": "Chiều cao tối đa",
  "margin": "Lề ngoài",
  "margin-top": "Lề ngoài phía trên",
  "margin-right": "Lề ngoài bên phải",
  "margin-left": "Lề ngoài bên trái",
  "margin-bottom": "Lề ngoài phía dưới",
  "padding": "Lề trong",
  "padding-top": "Lề trong phía trên",
  "padding-left": "Lề trong bên trái",
  "padding-right": "Lề trong bên phải",
  "padding-bottom": "Lề trong phía dưới",
  "font-family": "Họ phông chữ",
  "font-size": "Cỡ chữ",
  "font-weight": "Độ đậm chữ",
  "letter-spacing": "Khoảng cách giữa các chữ",
  "color": "Màu sắc",
  "line-height": "Chiều cao dòng",
  "text-align": "Căn chỉnh văn bản",
  "text-shadow": "Đổ bóng chữ",
  "border-top-left": "Viền góc trên bên trái",
  "border-top-right": "Viền góc trên bên phải",
  "border-bottom-left": "Viền góc dưới bên trái",
  "border-bottom-right": "Viền góc dưới bên phải",
  "border-radius-top-left": "Bo góc trên bên trái",
  "border-radius-top-right": "Bo góc trên bên phải",
  "border-radius-bottom-left": "Bo góc dưới bên trái",
  "border-radius-bottom-right": "Bo góc dưới bên phải",
  "border-radius": "Bo góc",
  "border": "Đường viền",
  "border-width": "Độ dày đường viền",
  "border-style": "Kiểu đường viền",
  "border-color": "Màu đường viền",
  "box-shadow": "Đổ bóng khối",
  "background": "Nền",
  "background-image": "Ảnh nền",
  "background-repeat": "Lặp lại nền",
  "background-position": "Vị trí nền",
  "background-attachment": "Kiểu cuộn nền",
  "background-size": "Kích thước nền",
  "background-color": "Màu nền",
  "transition": "Chuyển tiếp",
  "transition-property": "Thuộc tính chuyển tiếp",
  "transition-duration": "Thời lượng chuyển tiếp",
  "transition-timing-function": "Hàm thời gian chuyển tiếp",
  "perspective": "Phối cảnh",
  "transform": "Biến đổi",
  "flex-direction": "Hướng Flex",
  "flex-wrap": "Xuống dòng Flex",
  "justify-content": "Căn chỉnh theo trục chính",
  "align-items": "Căn chỉnh các phần tử",
  "align-content": "Căn chỉnh các dòng",
  "order": "Thứ tự",
  "flex-basis": "Kích thước cơ sở Flex",
  "flex-grow": "Hệ số giãn Flex",
  "flex-shrink": "Hệ số co Flex",
  "align-self": "Tự căn chỉnh"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Văn bản thay thế",
  "title": "Tiêu đề",
  "href": "Liên kết"
});