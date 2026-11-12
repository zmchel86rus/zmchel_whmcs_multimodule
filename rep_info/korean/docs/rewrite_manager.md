# Rewrite Manager

## WHMCS

Rewrite Manager는 사이트 루트의 .htaccess에 필요한 Apache 규칙을 확인하고 설치합니다. 사용자 정의 rewrite 규칙도 이곳에서 관리합니다. 한 URL에서 다른 URL로 보내는 일반적인 리디렉션은 [Redirect Manager](redirects_manager.md)에서 별도로 만들며, 두 기능은 적용되는 단계가 다릅니다.

## 규칙 확인과 적용

관리자를 열고 활성 언어의 경로 상태를 살펴봅니다. **Add or update rules**는 모듈의 규칙 블록을 .htaccess에 기록합니다. 다시 상태를 확인한 후 기본 언어와 다른 활성 언어의 게시된 페이지를 각각 열어 보세요. **Remove all rules**는 모듈 규칙 블록 전체를 제거합니다.

사용자 규칙을 만들 때에는 URL 패턴, 목적지, flags를 입력하고 저장한 뒤 규칙을 다시 적용합니다. 범위가 넓은 패턴은 무관한 페이지도 가로챌 수 있으므로 적용 전에 검토하세요. Apache는 .htaccess를 읽지만 nginx는 읽지 않습니다. Nginx에서는 웹 서버 설정에 동등한 규칙을 작성하고 기존 경로도 다시 시험해야 합니다.
