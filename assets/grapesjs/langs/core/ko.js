
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: '예: 여기에 텍스트 입력'
};
var _default = exports.default = {
  assetManager: {
    addButton: '이미지 추가',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: '이미지 선택',
    uploadTitle: '파일을 여기로 끌어다 놓거나 클릭하여 업로드하세요'
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
      '': '영역',
      wrapper: '본문',
      text: '텍스트',
      comment: '주석',
      image: '이미지',
      video: '동영상',
      label: '레이블',
      link: '링크',
      map: '지도',
      tfoot: '표 바닥글',
      tbody: '표 본문',
      thead: '표 머리글',
      table: '표',
      row: '표 행',
      cell: '표 셀'
    }
  },
  deviceManager: {
    device: '기기',
    devices: {
      desktop: '데스크톱',
      tablet: '태블릿',
      mobileLandscape: '모바일(가로)',
      mobilePortrait: '모바일(세로)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: '미리보기',
        fullscreen: '전체 화면',
        'sw-visibility': '구성 요소 보기',
        'export-template': '코드 보기',
        'open-sm': '스타일 관리자 열기',
        'open-tm': '설정',
        'open-layers': '레이어 관리자 열기',
        'open-blocks': '블록 패널 열기'
      }
    }
  },
  selectorManager: {
    label: '클래스',
    selected: '선택됨',
    emptyState: '- 상태 -',
    states: {
      hover: '마우스를 올렸을 때',
      active: '클릭했을 때',
      'nth-of-type(2n)': '짝수/홀수'
    }
  },
  styleManager: {
    empty: '스타일 관리자를 사용하기 전에 요소를 선택하세요',
    layer: '레이어',
    fileButton: '이미지',
    sectors: {
      general: '일반',
      layout: '레이아웃',
      typography: '타이포그래피',
      decorations: '꾸미기',
      extra: '추가',
      flex: 'Flex 속성',
      dimension: '크기'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': '흐림',
      'text-shadow-color': '색상',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': '흐림',
      'box-shadow-spread': '확산',
      'box-shadow-color': '색상',
      'box-shadow-type': '유형',
      'margin-top-sub': '위쪽',
      'margin-right-sub': '오른쪽',
      'margin-bottom-sub': '아래쪽',
      'margin-left-sub': '왼쪽',
      'padding-top-sub': '위쪽',
      'padding-right-sub': '오른쪽',
      'padding-bottom-sub': '아래쪽',
      'padding-left-sub': '왼쪽',
      'border-width-sub': '너비',
      'border-style-sub': '스타일',
      'border-color-sub': '색상',
      'border-top-left-radius-sub': '왼쪽 위',
      'border-top-right-radius-sub': '오른쪽 위',
      'border-bottom-right-radius-sub': '오른쪽 아래',
      'border-bottom-left-radius-sub': '왼쪽 아래',
      'transform-rotate-x': 'X축 회전',
      'transform-rotate-y': 'Y축 회전',
      'transform-rotate-z': 'Z축 회전',
      'transform-scale-x': 'X축 크기 조절',
      'transform-scale-y': 'Y축 크기 조절',
      'transform-scale-z': 'Z축 크기 조절',
      'transition-property-sub': '속성',
      'transition-duration-sub': '지속 시간',
      'transition-timing-function-sub': '타이밍 함수',
      'background-image-sub': '이미지',
      'background-repeat-sub': '반복',
      'background-position-sub': '위치',
      'background-attachment-sub': '고정 방식',
      'background-size-sub': '크기'
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
    empty: '속성 관리자를 사용하기 전에 요소를 선택하세요',
    label: '구성 요소 설정',
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
          placeholder: '예: https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: '현재 창',
          _blank: '새 창'
        }
      }
    }
  },
  storageManager: {
    recover: '저장하지 않은 변경 사항을 복구하시겠습니까?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "플로트",
  "display": "표시 방식",
  "position": "위치 지정",
  "top": "위쪽",
  "right": "오른쪽",
  "left": "왼쪽",
  "bottom": "아래쪽",
  "width": "너비",
  "height": "높이",
  "max-width": "최대 너비",
  "max-height": "최대 높이",
  "margin": "바깥 여백",
  "margin-top": "바깥 여백: 위쪽",
  "margin-right": "바깥 여백: 오른쪽",
  "margin-left": "바깥 여백: 왼쪽",
  "margin-bottom": "바깥 여백: 아래쪽",
  "padding": "안쪽 여백",
  "padding-top": "안쪽 여백: 위쪽",
  "padding-left": "안쪽 여백: 왼쪽",
  "padding-right": "안쪽 여백: 오른쪽",
  "padding-bottom": "안쪽 여백: 아래쪽",
  "font-family": "글꼴 종류",
  "font-size": "글꼴 크기",
  "font-weight": "글꼴 두께",
  "letter-spacing": "글자 간격",
  "color": "색상",
  "line-height": "줄 높이",
  "text-align": "텍스트 정렬",
  "text-shadow": "텍스트 그림자",
  "border-top-left": "테두리: 왼쪽 위",
  "border-top-right": "테두리: 오른쪽 위",
  "border-bottom-left": "테두리: 왼쪽 아래",
  "border-bottom-right": "테두리: 오른쪽 아래",
  "border-radius-top-left": "모서리 반경: 왼쪽 위",
  "border-radius-top-right": "모서리 반경: 오른쪽 위",
  "border-radius-bottom-left": "모서리 반경: 왼쪽 아래",
  "border-radius-bottom-right": "모서리 반경: 오른쪽 아래",
  "border-radius": "모서리 반경",
  "border": "테두리",
  "border-width": "테두리 두께",
  "border-style": "테두리 스타일",
  "border-color": "테두리 색상",
  "box-shadow": "상자 그림자",
  "background": "배경",
  "background-image": "배경 이미지",
  "background-repeat": "배경 반복",
  "background-position": "배경 위치",
  "background-attachment": "배경 고정 방식",
  "background-size": "배경 크기",
  "background-color": "배경 색상",
  "transition": "전환 효과",
  "transition-property": "전환 속성",
  "transition-duration": "전환 지속 시간",
  "transition-timing-function": "전환 타이밍 함수",
  "perspective": "원근감",
  "transform": "변형",
  "flex-direction": "Flex 방향",
  "flex-wrap": "Flex 줄 바꿈",
  "justify-content": "주축 방향 콘텐츠 정렬",
  "align-items": "교차축 항목 정렬",
  "align-content": "교차축 줄 정렬",
  "order": "순서",
  "flex-basis": "Flex 기본 크기",
  "flex-grow": "Flex 늘어남 비율",
  "flex-shrink": "Flex 줄어듦 비율",
  "align-self": "개별 항목 정렬"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "대체 텍스트",
  "title": "제목",
  "href": "링크"
});