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

## いろいろ変更された

この時点で`routes/web.php`消えた。(書きかわってしまった)

Laravel Breezeはログインと会員登録機能の完成セットを丸ごとインストールするツール。

なので、`routes/web/php`に必要なルーティングを自動で追加(上書き)しようとする。

今回は、`git diff routes/web.php`にて差分を手動で書き直す。

Tailwind CSS, JavaScript関連もいろいろ変わった。

- JSの入り口は1つ
- 機能ごとにわけるのは`import`でやる

### 1. vite.oconfig.js (入り口は1つ)

```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
```

### 2. resources/js/app/js (司令塔)

```javascript
import './bootstrap';
import './dog'
import './tailwind'
import './animation'
import './test'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
```

### 3. 各ファイルは部品

```
resources/js/
├─ app.js        ← 入口
├─ animation.js  ← 犬を動かす
├─ dog.js        ← Dogs用
├─ test.js       ← 実験用
```

### 4. Blade側

```bash
# 変更前
@vite(['resources/css/app.css', 'resources/js/dog.js'])

# 変更後
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

=> 全部`resources/js/app/js`でOK

