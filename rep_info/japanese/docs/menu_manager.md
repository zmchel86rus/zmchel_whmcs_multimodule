# メニュー管理

menu_manager は独立した複数のメニュー、ページ・記事の検索、任意のリンク、URL が # の見出し項目を扱います。ドラッグして順序を変え、親項目を指定して階層化できます。項目には翻訳可能なラベル、タイトル、説明、CSS class、rel、アイコン、新規タブ、ゲストと顧客への表示条件を設定できます。新規公開ページを自動で追加することも可能です。デスクトップ、モバイル、または両方の WHMCS ナビゲーションを拡張・置換します。

## 配置場所とスイッチ

WHMCS の ClientAreaPrimaryNavbar、ClientAreaSecondaryNavbar、ClientAreaPrimarySidebar、ClientAreaSecondarySidebar は、順に ZM_PB_ENABLE_MAINNAV、ZM_PB_ENABLE_SECONDARYNAV、ZM_PB_ENABLE_MAINSIDEBAR、ZM_PB_ENABLE_SECONDARYSIDEBAR で制御します。無効な場所の処理は読み込まれません。割り当てがなければ元の WHMCS メニューは変わりません。場所ごとに一つのメニューを置けますが、同じメニューを複数の場所で使えます。既に使われている場所への新しい割り当ては、以前の割り当てを移します。

## 言語とアクセス

通常の WHMCS システムルートでは保存済みのユーザー言語がラベルを決め、モジュールページでは URL の言語を使います。ユーザーのプロフィールを勝手に変えません。独自リンクの **Link URL language** を無効にすれば、入力 URL をそのまま使いながらラベルだけを翻訳できます。この設定は zm_pb_menu_items.localize_url に保存されます。ページ項目は現在の slug、公開済みの翻訳、URL 設定からリンクを再計算します。通常形式は ?m=zmchel_whmcs_multimodule&slug=...&lang=... です。ラベルが空なら breadcrumb、meta title またはページ名を使います。下書き、削除済み、閲覧不可のページは表示しません。外部 URL、mailto、tel、アンカーには言語接頭辞を付けません。

## テーブルと実装

zm_pb_menus はメニュー設定、zm_pb_menu_items は項目と階層、zm_pb_menu_locations は配置場所を保存します。テーブルの作成・修復は Module database で行い、メニュー管理はレコードだけを操作します。親を削除すると子は一段上に移動します。最大 10 階層、300 項目で、保存は一つのトランザクションです。デスクトップとモバイル、ゲストと顧客で公開結果を確認してください。
