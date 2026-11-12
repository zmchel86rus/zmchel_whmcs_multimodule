# 사이트맵

## XML

XML에는 활성 언어의 상호 대체 URL과 기본 언어 주소의 x-default가 들어갑니다. 리디렉션 출발지는 loc와 언어 대체 링크에서 제외됩니다. 대체 콘텐츠를 쓰는 경우 실제 콘텐츠 언어가 표시됩니다. 페이지 및 게시물 파일은 XHTML 네임스페이스를 선언하므로 한 URL 항목에 여러 언어 링크를 넣을 수 있습니다.

생성 코드는 lib/sitemap.php, 보조 함수는 inc/sitemap_manager.php, AfterCronJob 훅은 hooks/sitemap.php에 있습니다. ZM_PB_ENABLE_SITEMAP이 꺼져 있으면 자동 훅과 수동 생성이 모두 비활성화됩니다. cron 뒤에는 ZM_PB_SITEMAP_LASTUPD와 ZM_PB_SITEMAP_UPDFREQ를 비교합니다. 알 수 없는 빈도는 매일로 처리하며 **Generate**는 즉시 실행합니다. 마지막 성공 시간만 저장합니다.

사이트 루트에는 sitemap_index.xml, sitemap_pages.xml, sitemap_posts.xml이 만들어집니다. 50,000개 URL 또는 50 MB를 넘는 범주는 추가 파일로 나뉩니다. 인덱스는 다른 올바른 루트 urlset 파일도 포함하지만 인덱스를 중첩하지 않습니다. 모듈은 자신의 페이지와 게시물 파일만 갱신하거나 제거하고, 비어 있는 범주는 파일을 만들지 않습니다.

게시되고 공개 접근이 가능하며 lang_active가 켜진 번역만 포함됩니다. WHMCS 페이지 덮어쓰기는 빌더 slug가 아니라 원래 공개 주소를 사용합니다. 기본 언어의 선택적 접두사도 반영됩니다. 사이트 루트, resources/, inc/editable_consts.php에 쓰기 권한이 있어야 합니다. 테이블이 없으면 Module database에서 복구하세요. 실패하면 임시 복사본에서 이전 파일을 복원하고 마지막 성공 시간은 바꾸지 않습니다.
