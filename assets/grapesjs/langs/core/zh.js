
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: '例如：在此輸入文字'
};
var _default = exports.default = {
  assetManager: {
    addButton: '新增圖片',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: '選擇圖片',
    uploadTitle: '將檔案拖曳至此，或點擊以上傳'
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
      '': '區域',
      wrapper: '主體',
      text: '文字',
      comment: '註解',
      image: '圖片',
      video: '影片',
      label: '標籤',
      link: '連結',
      map: '地圖',
      tfoot: '表格頁尾',
      tbody: '表格主體',
      thead: '表格表頭',
      table: '表格',
      row: '表格列',
      cell: '表格儲存格'
    }
  },
  deviceManager: {
    device: '裝置',
    devices: {
      desktop: '桌面裝置',
      tablet: '平板電腦',
      mobileLandscape: '手機（橫向）',
      mobilePortrait: '手機（直向）'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: '預覽',
        fullscreen: '全螢幕',
        'sw-visibility': '檢視元件',
        'export-template': '檢視程式碼',
        'open-sm': '開啟樣式管理員',
        'open-tm': '設定',
        'open-layers': '開啟圖層管理員',
        'open-blocks': '開啟區塊面板'
      }
    }
  },
  selectorManager: {
    label: 'CSS 類別',
    selected: '已選取',
    emptyState: '- 狀態 -',
    states: {
      hover: '滑鼠移入時',
      active: '點擊時',
      'nth-of-type(2n)': '偶數／奇數'
    }
  },
  styleManager: {
    empty: '請先選取元素，再使用樣式管理員',
    layer: '圖層',
    fileButton: '圖片',
    sectors: {
      general: '一般',
      layout: '版面配置',
      typography: '文字排版',
      decorations: '裝飾',
      extra: '其他',
      flex: 'Flex 屬性',
      dimension: '尺寸'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': '模糊',
      'text-shadow-color': '顏色',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': '模糊',
      'box-shadow-spread': '擴散',
      'box-shadow-color': '顏色',
      'box-shadow-type': '類型',
      'margin-top-sub': '上方',
      'margin-right-sub': '右側',
      'margin-bottom-sub': '下方',
      'margin-left-sub': '左側',
      'padding-top-sub': '上方',
      'padding-right-sub': '右側',
      'padding-bottom-sub': '下方',
      'padding-left-sub': '左側',
      'border-width-sub': '寬度',
      'border-style-sub': '樣式',
      'border-color-sub': '顏色',
      'border-top-left-radius-sub': '左上角',
      'border-top-right-radius-sub': '右上角',
      'border-bottom-right-radius-sub': '右下角',
      'border-bottom-left-radius-sub': '左下角',
      'transform-rotate-x': '沿 X 軸旋轉',
      'transform-rotate-y': '沿 Y 軸旋轉',
      'transform-rotate-z': '沿 Z 軸旋轉',
      'transform-scale-x': 'X 軸縮放',
      'transform-scale-y': 'Y 軸縮放',
      'transform-scale-z': 'Z 軸縮放',
      'transition-property-sub': '屬性',
      'transition-duration-sub': '持續時間',
      'transition-timing-function-sub': '時間函式',
      'background-image-sub': '圖片',
      'background-repeat-sub': '重複',
      'background-position-sub': '位置',
      'background-attachment-sub': '固定方式',
      'background-size-sub': '大小'
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
    empty: '請先選取元素，再使用屬性管理員',
    label: '元件設定',
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
          placeholder: '例如：https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: '目前視窗',
          _blank: '新視窗'
        }
      }
    }
  },
  storageManager: {
    recover: '是否要還原尚未儲存的變更？'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "浮動",
  "display": "顯示方式",
  "position": "定位",
  "top": "上方",
  "right": "右側",
  "left": "左側",
  "bottom": "下方",
  "width": "寬度",
  "height": "高度",
  "max-width": "最大寬度",
  "max-height": "最大高度",
  "margin": "外距",
  "margin-top": "外距：上方",
  "margin-right": "外距：右側",
  "margin-left": "外距：左側",
  "margin-bottom": "外距：下方",
  "padding": "內距",
  "padding-top": "內距：上方",
  "padding-left": "內距：左側",
  "padding-right": "內距：右側",
  "padding-bottom": "內距：下方",
  "font-family": "字型",
  "font-size": "字型大小",
  "font-weight": "字重",
  "letter-spacing": "字距",
  "color": "顏色",
  "line-height": "行高",
  "text-align": "文字對齊",
  "text-shadow": "文字陰影",
  "border-top-left": "邊框：左上",
  "border-top-right": "邊框：右上",
  "border-bottom-left": "邊框：左下",
  "border-bottom-right": "邊框：右下",
  "border-radius-top-left": "圓角：左上",
  "border-radius-top-right": "圓角：右上",
  "border-radius-bottom-left": "圓角：左下",
  "border-radius-bottom-right": "圓角：右下",
  "border-radius": "圓角",
  "border": "邊框",
  "border-width": "邊框寬度",
  "border-style": "邊框樣式",
  "border-color": "邊框顏色",
  "box-shadow": "方框陰影",
  "background": "背景",
  "background-image": "背景圖片",
  "background-repeat": "背景重複方式",
  "background-position": "背景位置",
  "background-attachment": "背景固定方式",
  "background-size": "背景大小",
  "background-color": "背景顏色",
  "transition": "轉場效果",
  "transition-property": "轉場屬性",
  "transition-duration": "轉場持續時間",
  "transition-timing-function": "轉場時間函式",
  "perspective": "透視",
  "transform": "變形",
  "flex-direction": "Flex 方向",
  "flex-wrap": "Flex 換行",
  "justify-content": "主軸內容對齊",
  "align-items": "交叉軸項目對齊",
  "align-content": "交叉軸內容對齊",
  "order": "排列順序",
  "flex-basis": "Flex 基準尺寸",
  "flex-grow": "Flex 放大比例",
  "flex-shrink": "Flex 縮小比例",
  "align-self": "個別項目對齊"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "替代文字",
  "title": "標題",
  "href": "連結"
});