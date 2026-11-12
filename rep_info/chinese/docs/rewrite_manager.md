# Rewrite Manager

## WHMCS

Rewrite Manager 會檢查並安裝模組的 Apache 規則到網站根目錄的 .htaccess，也管理自訂 rewrite 規則。將一個 URL 導向另一個 URL 的一般規則，請改在[重新導向管理員](redirects_manager.md)設定；兩種功能的用途與套用時機不同。

## 檢查與套用規則

開啟管理員，檢查已啟用語言的路由狀態。**Add or update rules** 會把模組規則區塊寫入 .htaccess。完成後再檢查狀態，並分別開啟預設語言與另一個已啟用語言的已發佈頁面。**Remove all rules** 會在區塊存在時將它完整移除。

新增自訂規則時，輸入 URL 模式、目的地和 flags，儲存後重新套用規則。範圍過廣的模式可能影響不相關頁面，請先審查再上線。Apache 會讀取 .htaccess；nginx 不會，因此 Nginx 必須在伺服器設定中加入對應規則。變更後也要測試既有路由。
