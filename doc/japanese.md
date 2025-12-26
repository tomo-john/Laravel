# Laravelの日本語化

目的: バリデーションを日本語化する :dog:

## 日本語設定を有効にする

アプリ自体の設定を`日本語`に変更する。

`.env`を編集:

```
APP_LOCALE=ja
APP_FALLBACK_LOCALE=ja
APP_FAKER_LOCALE=ja_JP
```

編集後に、設定反映のコマンド:

```
php artisan config:clear
```

## langディレクトリとファイルの生成

以下の職人コマンドを実行する。

```
php artisan lang:publish
```

これを実行すると、ルートに`lang/en`ディレクトリと標準的な翻訳ファイル(`auth.php`など)が生成される。

## 日本語ファイルの設置

1. パッケージのインストール:

```
composer require laravel-lang/common --dev
```

2. 日本語を追加する

```
php artisan lang:add ja
```

2. 日本語を追加する

```
php artisan lang:add ja
```

