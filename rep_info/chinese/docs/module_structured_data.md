# 輸出的結構化資料

## Schema.org

在 Page Editor 的中繼資料設定 Schema 類型後，請檢查已發佈頁面。選單可產生含真實標籤、語言和可用 URL 的 SiteNavigationElement。目錄以實際標題中的錨點產生 SiteNavigationElement 與 WebPageElement。只有可見且非空白的問答會列入 FAQPage。客戶佈景主題中至少兩個 breadcrumbs 才建立 BreadcrumbList。

組織與聯絡資料取自 WHMCS。頁面語言屬於 WebPage 或 ContactPage，聯絡方式支援的語言使用 BCP 47 寫入 ContactPoint.availableLanguage。不要猜測並加上 Organization.inLanguage。篩選、欄位、每頁項目數選擇器、聯絡表單不會自動變成商品或服務。Flex/Grid、按鈕及一般手風琴區塊只是排版，不足以推斷內容類型。

JSON-LD 應描述訪客實際看得到的內容；格式正確不保證搜尋引擎顯示特殊結果。作者在 Smarty 或 HTML 中刻意加入的標記會保留。比較公開頁面的連結、標題、問題、答案與最終 JSON-LD，確認隱藏區塊沒有被描述成公開 FAQ。

## 檢查 JSON-LD

分別以訪客及登入客戶開啟相同公開 URL，核對選單與 breadcrumbs 的可見內容和標記。Schema.org 資料只說明頁面，不能取代可用的實際導覽，也不能保證搜尋結果外觀。

## ContactPoint.availableLanguage

聯絡語言從 WHMCS 讀取，以 BCP 47 標記表示。個別頁面的語言放在 WebPage 或 ContactPage，不應為 Organization 編造 inLanguage 值。
