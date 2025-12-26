# monsters

`dog_app/monsters`: 基本CRUD

## 最初にやること

### テーブル作成

```
# マイグレーションファイル作成
php artisan make:migration create_monsters_table

# マイグレーションファイル編集後にマイグレーション実行
php artisan migrate
```

### モデル作成

```
# Model作成
php artisan make:model Monster
```

=> 作成したModelに`fillable`の設定

### コントローラー作成

```
php artisan make:controller MonsterController --model=Monster
```

=> `--model=Monster`でMonsterモデルがuse済み + CRUDメソッド雛形(Route Model Binding)

### ルーティング

```
# これ忘れるとコントローラーないエラー
use App\Http\Controllers\MonsterController;

# リソースルーティング
Route::resource('monsters', MonsterController::class);
```

この1行で以下のルーティング全部OK:

| URL                          | 処理    |
|------------------------------|---------|
| GET /monsters                | index   |
| GET /monsters/create         | create  |
| POST /monsters               | store   |
| GET /monsters/{monster}      | show    |
| GET /monsters/{monster}/edit | edit    |
| PUT /monsters/{monster}      | update  |
| DELETE /monsters/{monster}   | destroy |

## テーブルメモ

```bash
$table->id();                     # id
$table->string('name');           # 名前
$table->integer('cost');          # コスト
$table->string('color');          # こころの色
$table->integer('quantity');      # 所持数
$table->text('memo')->nullable(); # 備考欄(空白OK)
$table->timestamps();             # タイムスタンプ
```

## memo

```bash
# 1. Laravelの全てのキャッシュを削除
php artisan optimize:clear

# 2. PHPのオートロードマップを再構築
composer dump-autoload
```

