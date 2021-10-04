# ECサイトLaravel版 RenshuSTORE

## 概要

商品をカートに入れて購入できるECサイト
PHPで作成した、管理画面とフロント画面に分かれたECサイトのフロント部分のみをLaravelで再作成したもの。

## 使用技術

- Laravel 8
  - Laravel Breeze(認証)
  - Eloquent(データベース)
  - Bladeテンプレートエンジン(ビュー)
- MySQL
- Vue.js 4

## 機能

- 会員機能・ログイン機能
  - 会員登録・情報編集・退会
  - 注文履歴表示ページ
  - レビュー履歴表示ページ
- 商品表示
  - ランキング
  - 商品一覧
  - 商品個別
- レビュー機能
- カート機能(ゲスト用, 登録ユーザー用)
  - 商品の追加ページ, おすすめ商品
  - カートの内容の変更・クリア
- 注文機能
  - 注文情報入力フォーム
  - 会員用・住所入力省略機能
- UI
  - ペジネーション
  - 並べ替え・絞り込み
