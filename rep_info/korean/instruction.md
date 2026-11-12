[![구독자](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%EA%B5%AC%EB%8F%85%EC%9E%90)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![별](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=%EB%B3%84)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![포크](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=%ED%8F%AC%ED%81%AC)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![이슈](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%EC%9D%B4%EC%8A%88)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule 사용 안내

**zmchel WHMCS Multimodule은 무료 모듈입니다.** WHMCS 관리자 화면에서 시각적 페이지와 블록 편집, 다국어 콘텐츠, 메뉴, 미디어 라이브러리, SEO 메타데이터, XML 사이트맵, 리디렉션, rewrite 규칙, 데이터 가져오기와 내보내기를 관리할 수 있습니다.

## 처음 사용하기 전에

**모듈 설정 → 지원 언어를 열어 사용할 언어를 활성화하세요.** 언어를 비활성화해도 이미 작성한 콘텐츠는 삭제되지 않습니다.

모듈을 활성화할 때마다 새로운 salt를 생성해 module_init.php의 ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT, ZM_PB_NONCE_SALT에 기록합니다. 세 값이 모두 채워졌는지 확인하세요.

## 확인된 호환성과 기능

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3과 4

## 웹 서버 호환성

Apache는 완전히 지원됩니다. Nginx에서도 사용할 수 있지만 홈페이지의 언어 라우팅에는 추가 설정과 테스트가 필요할 수 있습니다.

## 모듈 설정

사용할 언어, URL 형식, 언어 라우팅을 선택하세요. Apache에서는 Rewrite Manager에서 규칙을 확인하고 적용합니다. Nginx는 .htaccess를 읽지 않으므로 서버에 대응하는 규칙을 설정해야 합니다. 저장 후 기본 언어와 다른 활성 언어에서 게시된 페이지를 직접 열어 확인하세요.

## 페이지 관리

내부 이름과 라틴 문자, 숫자, 하이픈으로 된 slug를 입력해 페이지를 만듭니다. 언어와 로그인 사용자, 방문자 또는 모두를 위한 접근 모드를 선택합니다. 저장한 뒤 Page Editor에서 콘텐츠와 메타데이터를 편집하고 게시하여 공개 URL을 확인하세요. 사이트맵은 수동으로 생성하거나 WHMCS의 예약 작업을 기다릴 수 있습니다.

## 섹션별 안내

- [페이지 관리자](docs/pages_manager.md)
- [페이지 편집기](docs/pages_editor.md)
- [미디어 관리자](docs/media_manager.md)
- [메뉴](docs/menu_manager.md)
- [언어 관리자](docs/langs_manager.md)
- [리디렉션](docs/redirects_manager.md)
- [사이트맵](docs/sitemap_manager.md)
- [Rewrite Manager](docs/rewrite_manager.md)
- [모듈 설정](docs/module_settings.md)
- [모듈 데이터베이스](docs/module_db.md)

## 추가 문서

- [페이지 나누기와 필터](docs/pages_editor_pagination.md)
- [Smarty와 변수 목록](docs/pages_editor_smarty.md)
- [Schema.org 구조화 데이터](docs/module_structured_data.md)
- [가져오기와 내보내기](docs/module_settings_transfer.md)
