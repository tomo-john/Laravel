# Breeze(ログイン導入)

Dogsにログインを導入する。

### 1. Breezeをインストール

```
composer require laravel/breeze --dev
```

成功したら:

```
php artisan breeze:install
```

=> 選択肢は`Blade with Alpine`を選択(他は初期値)

### 2. フロント周りをビルド

今回はすでにやってるのでPASS:

```
npm install
npm run dev
```

### 3. users テーブルを作る

これももうすでに何回かやってるのでPASS:

```
php artisan migrate
```

この時点で`routes/web.php`消えた。(書きかわってしまった)

Laravel Breezeはログインと会員登録機能の完成セットを丸ごとインストールするツール。

なので、`routes/web/php`に必要なルーティングを自動で追加(上書き)しようとする。

今回は、`git diff routes/web.php`にて差分を手動で書き直す。

