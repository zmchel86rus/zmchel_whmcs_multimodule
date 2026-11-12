# Smarty 區塊與變數目錄

先在模組設定中開啟 Smarty 變數收集與使用。ZM_PB_COLLECT_VARS 建立目錄，ZM_PB_USE_COLLECT_VARS 允許區塊輸出。啟用後，實際開啟相關網站頁面並重新載入編輯器，才會看到新收集的提示。

## 變數目錄

檔案按佈景與模板儲存在 resources/available_vars/。目錄記錄名稱、類型、巢狀結構和觀察階段，不保存真實值。sampled、truncated 代表取樣受限；密碼、token、個人資料標記為 redacted。目錄中沒有某欄位，不代表所有請求都沒有它。系統不呼叫物件 getter、模型關聯或新的資料庫查詢。資料夾以 .htaccess 保護，但即使在不使用 .htaccess 的 Nginx 上也不會暴露真實變數值。

## 編輯器

按區塊工具列的 **Edit code**，或在 Smarty 區塊上按兩下以開啟 CodeMirror。Ctrl+Space 搜尋變數，Ctrl+S 套用程式碼，F11 切換全螢幕，Escape 關閉。對既有集合可使用 {foreach $items as $item}，輸出欄位時使用 {$item.title|escape}。也要考慮空集合的畫面，不要假設每個請求都能提供相同資料。

## foreach 範例

若列表已在目前頁面可用，可使用 {foreach $items as $item}，並以 {$item.title|escape} 顯示標題。資料為空時也應有合適訊息。變數目錄幫助你找到正確的名稱，但不會把其他頁面的資料載入目前頁面。

## 執行與限制

儲存及輸出前都會驗證程式碼。可使用受限的 if、foreach、區域 assign、capture，以及 escape、default、count、date_format 等 modifier。PHP、SQL、物件方法、任意函式、檔案 include、網路資源與 nofilter 均禁止。輸出值會自動 escape；有意顯示的 HTML 應寫在模板中。資料缺失或驗證失敗時，區塊保持空白，錯誤記錄於 PHP 日誌。存取限制區域在執行 Smarty 區塊前就已移除。
