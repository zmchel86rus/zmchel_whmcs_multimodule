# 메뉴 관리자

menu_manager는 독립적인 여러 메뉴, 페이지와 게시물 검색, 사용자 정의 링크, URL #로 만든 제목 항목을 지원합니다. 항목을 끌어 순서를 바꾸거나 부모를 지정해 중첩하세요. 항목마다 언어별 라벨, 제목, 설명, CSS 클래스, rel, 아이콘, 새 탭 여부와 방문자·고객 노출 조건을 설정할 수 있습니다. 새로 게시한 페이지를 자동으로 추가할 수도 있습니다. 메뉴는 데스크톱, 모바일 또는 둘 다에서 WHMCS 탐색을 확장하거나 교체합니다.

## 위치와 스위치

WHMCS 위치 ClientAreaPrimaryNavbar, ClientAreaSecondaryNavbar, ClientAreaPrimarySidebar, ClientAreaSecondarySidebar는 각각 ZM_PB_ENABLE_MAINNAV, ZM_PB_ENABLE_SECONDARYNAV, ZM_PB_ENABLE_MAINSIDEBAR, ZM_PB_ENABLE_SECONDARYSIDEBAR가 제어합니다. 위치가 꺼져 있으면 처리기를 불러오지 않습니다. 활성 할당이 없으면 원래 WHMCS 메뉴가 유지됩니다. 각 위치에는 메뉴 하나가 들어가지만 같은 메뉴를 여러 위치에 둘 수 있습니다. 이미 사용 중인 위치를 다른 메뉴에 할당하면 배치가 옮겨집니다. 깊은 탐색 메뉴와 펼칠 수 있는 사이드바는 모듈 자산이 처리합니다.

## 언어와 접근

일반 WHMCS 시스템 경로에서는 사용자 프로필에 저장된 언어가 라벨을 정합니다. 모듈 페이지는 URL의 언어를 사용하며 사용자 프로필은 바꾸지 않습니다. 사용자 링크의 **Link URL language**를 끄면 입력한 URL을 그대로 쓰면서 라벨만 번역할 수 있습니다. 이 값은 zm_pb_menu_items.localize_url에 저장됩니다. 페이지 항목 URL은 현재 slug, 게시된 번역, 예쁜 URL 설정에서 다시 계산합니다. 일반 링크는 ?m=zmchel_whmcs_multimodule&slug=...&lang=... 형식입니다. 라벨이 비어 있으면 breadcrumb, 메타 제목 또는 페이지 이름을 사용합니다. 초안, 삭제된 페이지와 접근할 수 없는 페이지는 표시하지 않습니다. 외부 URL, mailto, tel, 앵커에는 언어 접두사를 붙이지 않습니다.

## 테이블과 코드

zm_pb_menus는 메뉴 설정, zm_pb_menu_items는 계층, zm_pb_menu_locations는 위치를 저장합니다. 스키마 생성과 복구는 Module database에서 하며 메뉴 관리자는 레코드만 바꿉니다. 부모를 삭제하면 자식 항목은 부모의 수준으로 이동합니다. 메뉴에는 최대 10단계와 300개 항목을 둘 수 있고 트리 저장은 하나의 트랜잭션으로 처리합니다. 모바일과 데스크톱, 게스트와 고객 상태를 각각 확인하세요.
