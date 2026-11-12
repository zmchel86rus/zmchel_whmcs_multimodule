# 重新導向與網站地圖語言

## HTTP

Redirect Manager 建立精確的來源 → 目的地規則，支援 HTTP 301、302、303、307、308。規則可以編輯、停用或刪除，管理列表每頁顯示 50 筆。來源可為以 / 開頭的路徑或同站絕對 URL；目的地可為路徑或 HTTP(S) URL。

比對時結尾斜線視為相同，但目的地會保留自己的斜線。有特定 query 的規則優先於一般路徑規則；一般路徑規則也能比對帶參數的請求。目的地參數會取代來源參數。規則處理進入 WHMCS 的 GET 和 HEAD 請求，執行時機早於頁面建構器，不改動 .htaccess、語言 session 或個人設定。ZM_PB_ENABLE_REDIRECTS_MANAGER 控制已儲存規則。

已發佈頁面變更 slug 且保持發佈時，模組會建立自動 301。首次發佈草稿不會建立。ZM_PB_AUTO_REDIRECT_DAYS 預設為 14 天，設為 0 可取消等待；之後再次改名會更新歷史目的地，回到舊 slug 時會移除指向自己的規則。手動規則優先。WHMCS 頁面覆寫別名可導向原本的系統 URL。

規則儲存於 zm_pb_redirects。請求期間不會建立缺少的資料表，必須到 Module database 修復。既有 URL 欄位限制 128 bytes。sitemap_pages.xml 和 sitemap_posts.xml 會列出語言替代連結與 x-default，但排除重新導向來源。改動 URL 後請重新產生 XML。
