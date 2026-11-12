# 출력되는 구조화 데이터

## Schema.org

Page Editor의 메타데이터에서 Schema 유형을 선택하고 게시된 결과를 살펴보세요. 메뉴는 실제 라벨과 접근 가능한 URL을 담은 SiteNavigationElement를 출력할 수 있습니다. 목차는 실제 제목의 앵커를 사용해 SiteNavigationElement와 WebPageElement를 만듭니다. 화면에 보이는 비어 있지 않은 질문과 답변만 FAQPage에 포함됩니다. 클라이언트 테마의 breadcrumb가 둘 이상이면 BreadcrumbList가 생성됩니다.

조직과 연락처 정보는 WHMCS 데이터를 사용합니다. 페이지 언어는 WebPage 또는 ContactPage에 속하고, 연락처에서 지원하는 언어는 BCP 47 형식의 ContactPoint.availableLanguage에 기록됩니다. Organization에 근거 없는 inLanguage를 추가하지 마세요. 필터, 필드, 페이지 크기 선택기, 문의 양식은 자동으로 제품이나 서비스가 되지 않습니다. Flex/Grid, 버튼, 일반 아코디언도 표시 형태만으로 콘텐츠 유형을 결정하지 않습니다.

JSON-LD는 방문자가 실제로 볼 수 있는 콘텐츠를 설명해야 합니다. 올바른 구조화 데이터도 검색 결과의 특별한 표시를 보장하지 않습니다. 작성자가 Smarty나 HTML에 넣은 마크업은 그대로 유지되므로 공개 페이지의 링크, 제목, 질문, 답변과 결과를 비교하세요. 접근 제한으로 숨겨진 항목이 공개 FAQ로 나타나지 않아야 합니다.

## JSON-LD 검토

게스트와 로그인 고객으로 같은 공개 URL을 열어 메뉴와 breadcrumb가 실제 표시와 맞는지 확인합니다. 검색 엔진의 확장 결과가 나타나는지는 별개의 문제입니다. 잘못 분류된 엔터티를 억지로 추가하지 마세요.

## ContactPoint.availableLanguage

연락처 언어는 WHMCS에서 가져오며 BCP 47 태그를 사용합니다. 개별 페이지의 언어는 WebPage 또는 ContactPage에 두고 Organization의 inLanguage는 추측해서 채우지 않습니다.
