
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: '例：ここにテキストを入力'
};
var _default = exports.default = {
  assetManager: {
    addButton: '画像を追加',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: '画像を選択',
    uploadTitle: 'ファイルをここにドラッグ＆ドロップするか、クリックしてアップロード'
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
      '': '領域',
      wrapper: 'ページ本文',
      text: 'テキスト',
      comment: 'コメント',
      image: '画像',
      video: '動画',
      label: 'ラベル',
      link: 'リンク',
      map: '地図',
      tfoot: '表のフッター',
      tbody: '表の本体',
      thead: '表のヘッダー',
      table: '表',
      row: '表の行',
      cell: '表のセル'
    }
  },
  deviceManager: {
    device: 'デバイス',
    devices: {
      desktop: 'デスクトップ',
      tablet: 'タブレット',
      mobileLandscape: 'モバイル（横向き）',
      mobilePortrait: 'モバイル（縦向き）'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'プレビュー',
        fullscreen: '全画面表示',
        'sw-visibility': 'コンポーネントを表示',
        'export-template': 'コードを表示',
        'open-sm': 'スタイルマネージャーを開く',
        'open-tm': '設定',
        'open-layers': 'レイヤーマネージャーを開く',
        'open-blocks': 'ブロックパネルを開く'
      }
    }
  },
  selectorManager: {
    label: 'クラス',
    selected: '選択中',
    emptyState: '- 状態 -',
    states: {
      hover: 'ホバー時',
      active: 'クリック時',
      'nth-of-type(2n)': '偶数／奇数'
    }
  },
  styleManager: {
    empty: 'スタイルマネージャーを使用する前に要素を選択してください',
    layer: 'レイヤー',
    fileButton: '画像',
    sectors: {
      general: '一般',
      layout: 'レイアウト',
      typography: 'タイポグラフィ',
      decorations: '装飾',
      extra: 'その他',
      flex: 'Flex プロパティ',
      dimension: 'サイズ'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'ぼかし',
      'text-shadow-color': '色',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'ぼかし',
      'box-shadow-spread': '広がり',
      'box-shadow-color': '色',
      'box-shadow-type': '種類',
      'margin-top-sub': '上',
      'margin-right-sub': '右',
      'margin-bottom-sub': '下',
      'margin-left-sub': '左',
      'padding-top-sub': '上',
      'padding-right-sub': '右',
      'padding-bottom-sub': '下',
      'padding-left-sub': '左',
      'border-width-sub': '幅',
      'border-style-sub': 'スタイル',
      'border-color-sub': '色',
      'border-top-left-radius-sub': '左上',
      'border-top-right-radius-sub': '右上',
      'border-bottom-right-radius-sub': '右下',
      'border-bottom-left-radius-sub': '左下',
      'transform-rotate-x': 'X軸回転',
      'transform-rotate-y': 'Y軸回転',
      'transform-rotate-z': 'Z軸回転',
      'transform-scale-x': 'X軸拡大・縮小',
      'transform-scale-y': 'Y軸拡大・縮小',
      'transform-scale-z': 'Z軸拡大・縮小',
      'transition-property-sub': 'プロパティ',
      'transition-duration-sub': '継続時間',
      'transition-timing-function-sub': 'タイミング関数',
      'background-image-sub': '画像',
      'background-repeat-sub': '繰り返し',
      'background-position-sub': '位置',
      'background-attachment-sub': '固定方法',
      'background-size-sub': 'サイズ'
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
    empty: '属性マネージャーを使用する前に要素を選択してください',
    label: 'コンポーネント設定',
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
          placeholder: '例：https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: '現在のウィンドウ',
          _blank: '新しいウィンドウ'
        }
      }
    }
  },
  storageManager: {
    recover: '保存されていない変更を復元しますか？'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "フロート",
  "display": "表示",
  "position": "位置指定",
  "top": "上",
  "right": "右",
  "left": "左",
  "bottom": "下",
  "width": "幅",
  "height": "高さ",
  "max-width": "最大幅",
  "max-height": "最大高さ",
  "margin": "外側の余白",
  "margin-top": "外側の余白：上",
  "margin-right": "外側の余白：右",
  "margin-left": "外側の余白：左",
  "margin-bottom": "外側の余白：下",
  "padding": "内側の余白",
  "padding-top": "内側の余白：上",
  "padding-left": "内側の余白：左",
  "padding-right": "内側の余白：右",
  "padding-bottom": "内側の余白：下",
  "font-family": "フォントファミリー",
  "font-size": "フォントサイズ",
  "font-weight": "フォントの太さ",
  "letter-spacing": "文字間隔",
  "color": "色",
  "line-height": "行の高さ",
  "text-align": "テキストの配置",
  "text-shadow": "テキストの影",
  "border-top-left": "枠線：左上",
  "border-top-right": "枠線：右上",
  "border-bottom-left": "枠線：左下",
  "border-bottom-right": "枠線：右下",
  "border-radius-top-left": "角丸：左上",
  "border-radius-top-right": "角丸：右上",
  "border-radius-bottom-left": "角丸：左下",
  "border-radius-bottom-right": "角丸：右下",
  "border-radius": "角丸",
  "border": "枠線",
  "border-width": "枠線の太さ",
  "border-style": "枠線のスタイル",
  "border-color": "枠線の色",
  "box-shadow": "ボックスの影",
  "background": "背景",
  "background-image": "背景画像",
  "background-repeat": "背景の繰り返し",
  "background-position": "背景の位置",
  "background-attachment": "背景の固定方法",
  "background-size": "背景サイズ",
  "background-color": "背景色",
  "transition": "トランジション",
  "transition-property": "トランジションの対象プロパティ",
  "transition-duration": "トランジションの継続時間",
  "transition-timing-function": "トランジションのタイミング関数",
  "perspective": "遠近感",
  "transform": "変形",
  "flex-direction": "Flex：方向",
  "flex-wrap": "Flex：折り返し",
  "justify-content": "主軸方向の配置",
  "align-items": "交差軸方向のアイテム配置",
  "align-content": "交差軸方向の行の配置",
  "order": "表示順序",
  "flex-basis": "Flex：基準サイズ",
  "flex-grow": "Flex：伸長率",
  "flex-shrink": "Flex：縮小率",
  "align-self": "個別アイテムの配置"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "代替テキスト",
  "title": "タイトル",
  "href": "リンク"
});