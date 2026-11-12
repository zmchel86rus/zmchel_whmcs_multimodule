# Smarty ブロックと変数一覧

Module settings で Smarty 変数の収集と利用を有効にしてください。ZM_PB_COLLECT_VARS が一覧を作り、ZM_PB_USE_COLLECT_VARS がブロック出力を許可します。設定後に関連する公開ページを開いてから編集画面を更新すると、新しい候補が表示されます。

## 変数一覧

ファイルはテーマとテンプレート別に resources/available_vars/ に置かれます。名前、型、入れ子構造、観測した段階だけを記録し、実際の値は保存しません。sampled と truncated は収集量の制限を示します。パスワード、token、個人情報は redacted です。一覧にないフィールドがすべてのリクエストで欠けているとは限りません。getter、モデルの関連、新たなデータベース照会も実行しません。フォルダーは .htaccess で保護されますが、Nginx でも実値を含まない設計です。

## エディター

ブロックの **Edit code** を押すか Smarty ブロックをダブルクリックすると CodeMirror が開きます。Ctrl+Space で変数検索、Ctrl+S で適用、F11 で全画面、Escape で終了します。既に利用可能な集合なら {foreach $items as $item} を使い、値は {$item.title|escape} のように出力します。空のリストを扱う表示も準備してください。

## foreach の例

そのページですでに利用できるリストには {foreach $items as $item} を使い、タイトルを {$item.title|escape} として表示できます。リストが空のときの文言も用意してください。変数一覧は名前を探すための資料であり、別のページのデータを読み込む機能ではありません。

## 実行と制限

コードは保存時と表示前に検証されます。制限付きの if、foreach、ローカル assign、capture と escape、default、count、date_format などの modifier が利用できます。PHP、SQL、オブジェクトメソッド、任意の関数、ファイル include、ネットワーク資源、nofilter は禁止です。値は自動的に escape されるため、意図した HTML はテンプレートに書きます。データ不足やエラーがあればブロックを空にし、PHP のログに記録します。アクセス制限部分は Smarty の実行前に取り除かれます。
