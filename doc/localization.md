# Localization

Laravel日本語化の仕組み :dog:

## 言語リソースの場所(langディレクトリ)

Laravelは画面に表示する固定テキストをプログラムに直接書かず、専用のファイルにまとめて管理している。

- 場所: `lang/` ディレクトリ
- 構造:

  - `lang/en/` (英語: デフォルト)
  - `lang/ja/` (日本語: 追加した)

各ファイル(`auth.php`, `pagination.php`など)は以下のような単純な連想配列。

```php
<?php
// lang/ja/pagination.php のイメージ
return [
    'previous' => '&laquo; 前へ',
    'next' => '次へ &raquo;',
];
```

## どこで「今、何語か」を決めている？

Laravelの心臓部(フレームワーク全体)が動くとき、以下の順番でどの言語フォルダを見に行くかを決定する。

- 1. `.env`ファイル: `APP_LOCALE=ja`を見て、最優先の言語を把握
- 2. `config/app/php`: `.env`の値を受け取り、システム全体の`locale`設定として保持
- 3. `AppServiceProvider`実行時にプログラムから言語を動的に変えることも可能

  => `App:setLocale('ja')`など

## 翻訳が呼び出されるプロセス

例: プログラムの中で、 `__('pagination.next')`が呼ばれた時の動き

- 1. 関数の実行: `__('ファイル名.キー')`が呼び出される
- 2. 設定の確認: 現在の`locale`が`ja`であることを確認
- 3. ファイルの検索: `lang/ja/pagination.php`を探しに行く
- 4. 値の取得: 配列の中から`next`に対応する値(`次へ &raquo`)を取り出して返す
- 5. フォールバック(予備): もし、`lang/ja`にファイルがなかったら、`config/app.php`の`fallback_locale`(通常は`en`)を見に行く

---

## ビュー(Blade)での翻訳呼び出し

### 基本の書き方

```blade
<!-- 基本系 -->
{{ __('pagination.next') }}

<!-- 省略形(どちらも同じ動き -->
@lang('pagination.next')
```

### 変数を埋め込む

設定ファイル: `lang/ja/messages.php`

```php
<?php

declare(strict_types=1);

return [
    'welcome' => ':nameさん、こんにちは！',
];
```

Bladeファイル

```blade
<!-- 第二引数に配列で渡す -->
<p>{{ __('messages.welcome', ['name' => 'じょん']) }}</p>
```

