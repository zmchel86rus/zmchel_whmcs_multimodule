# 모듈 설정

먼저 필요한 언어를 활성화한 다음 URL 형식과 언어 라우팅을 선택하고 저장하세요. 경로를 바꾼 경우 Apache의 Rewrite Manager 규칙 또는 Nginx의 대응 설정을 갱신해야 합니다. 기본 언어와 다른 활성 언어에서 페이지를 열어 결과를 확인합니다. 큰 설정 변경이나 가져오기 전에 모듈 데이터를 내보내 백업하세요.

## 사용 가능한 탭

- **Import / export:** 선택한 데이터를 ZIP으로 백업하거나 ZIP 및 JSON을 가져옵니다. 가져오기 전에 [전송 안내](module_settings_transfer.md)를 읽으세요.
- **Editable constants:** URL, 출력, 미디어, 유지 관리, Smarty 및 라우팅 스위치를 설정합니다. 각 설명을 읽고 공개 페이지에서 결과를 확인하세요.
- **Supported languages:** 페이지를 만들기 전에 언어를 켭니다. WHMCS 기본 언어는 WHMCS에서 기본값을 바꾸기 전까지 활성화한 채로 두세요.
- **Redirects와 Sitemap:** 저장된 리디렉션, 자동 리디렉션, XML 생성 시점을 정합니다. 개별 규칙과 파일은 해당 관리 화면에서 다룹니다.
- **Header, Footer, Robots:** 사이트 머리말과 꼬리말의 코드, robots.txt 내용을 편집하고 실제 출력 결과를 확인합니다.

웹 서버 경로에 의존하는 설정은 서버 규칙과 맞아야 합니다. Apache에는 .htaccess를, Nginx에는 별도 서버 설정을 사용합니다.
