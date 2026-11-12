# 選單管理員

menu_manager 支援多個獨立選單、搜尋頁面和文章、自訂連結，以及 URL 為 # 的純標題項目。可拖曳排序、指定父項目並建立階層。每個項目可設定多語標籤、標題、描述、CSS class、rel、圖示、新分頁選項與訪客或客戶可見性。新發佈頁面可以自動加入。選單可在電腦、手機或兩者上擴充或取代 WHMCS 導覽。

## 位置與開關

WHMCS 的 ClientAreaPrimaryNavbar、ClientAreaSecondaryNavbar、ClientAreaPrimarySidebar、ClientAreaSecondarySidebar 分別由 ZM_PB_ENABLE_MAINNAV、ZM_PB_ENABLE_SECONDARYNAV、ZM_PB_ENABLE_MAINSIDEBAR、ZM_PB_ENABLE_SECONDARYSIDEBAR 控制。位置關閉時不會載入處理器。沒有有效指派時，原本的 WHMCS 選單保持不變。每個位置同時只有一個選單，但一個選單可以用於多個位置。將已占用位置指派給新選單會移動原指派。較深層的導覽與側欄由模組資源處理。

## 語言與存取

一般 WHMCS 系統路由依使用者儲存的語言決定標籤；模組頁面依 URL 語言顯示，不修改個人檔案。自訂連結的 **Link URL language** 可保留輸入 URL 原樣，同時翻譯標籤。選項存於 zm_pb_menu_items.localize_url。頁面項目的 URL 依目前 slug、已發佈翻譯與漂亮網址設定重新計算；一般網址使用 ?m=zmchel_whmcs_multimodule&slug=...&lang=...。空標籤使用 breadcrumb、meta title 或頁面名稱。草稿、已刪除及無權限頁面不顯示；外部 URL、mailto、tel、錨點不加語言前綴。

## 資料表與程式

zm_pb_menus 儲存設定，zm_pb_menu_items 儲存階層，zm_pb_menu_locations 儲存位置。資料表的建立與修復在 Module database 執行；選單管理員只操作記錄。刪除父項目會讓子項目上移一層。每個選單最多 10 層、300 個項目，儲存使用單一交易。完成後分別檢查桌面與手機、訪客與已登入客戶的實際畫面。
