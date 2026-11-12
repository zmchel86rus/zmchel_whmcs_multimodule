# Smarty 블록과 변수 목록

모듈 설정에서 Smarty 변수 수집과 사용을 먼저 켭니다. ZM_PB_COLLECT_VARS가 변수 목록을 만들고 ZM_PB_USE_COLLECT_VARS가 블록의 출력을 허용합니다. 관련 사이트 페이지를 실제로 방문한 뒤 편집기를 다시 열어 제안 목록을 갱신하세요.

## 변수 목록

목록 파일은 테마와 템플릿별로 resources/available_vars/에 저장됩니다. 이름, 자료형, 중첩 구조, 관찰 단계만 기록하고 실제 값은 저장하지 않습니다. sampled 또는 truncated는 수집 범위가 제한되었음을 뜻합니다. 암호, 토큰, 개인 정보는 redacted로 표시합니다. 목록에 없는 필드가 모든 요청에 없다는 뜻은 아닙니다. 모델의 getter와 관계, 추가 데이터베이스 쿼리는 실행하지 않습니다. .htaccess로 폴더를 보호하지만 Nginx처럼 해당 파일을 무시하는 서버에서도 실제 값은 들어 있지 않습니다.

## 편집기

블록 도구막대의 **Edit code**를 누르거나 Smarty 블록을 두 번 클릭하면 CodeMirror가 열립니다. Ctrl+Space는 변수를 찾고 Ctrl+S는 코드를 적용하며 F11은 전체 화면, Escape는 닫기입니다. 이미 있는 컬렉션에 {foreach $items as $item}을 사용할 수 있습니다. 값을 출력할 때는 {$item.title|escape}처럼 escape를 적용하고 빈 목록의 출력도 준비하세요.

## foreach 예제

페이지에 이미 있는 목록이라면 {foreach $items as $item} 패턴을 사용하고 제목을 {$item.title|escape}로 출력하세요. 항목이 없을 때 보여 줄 문구도 준비합니다. 변수 목록은 사용할 이름을 찾는 데 도움을 주지만 다른 페이지의 데이터를 직접 불러오지는 않습니다.

## 실행과 제한

코드는 저장할 때와 출력 전에 검증합니다. 제한된 if, foreach, 지역 assign, capture 및 escape, default, count, date_format 같은 modifier가 허용됩니다. PHP, SQL, 객체 메서드, 임의 함수, 파일 포함, 네트워크 자원, nofilter는 금지됩니다. 값은 자동으로 이스케이프되므로 의도한 HTML 마크업은 템플릿에 직접 작성합니다. 데이터가 없거나 오류가 나면 블록은 비어 있게 되고 PHP 오류 로그에 기록됩니다. 접근 제한 구역은 Smarty 실행 전에 제거됩니다.
