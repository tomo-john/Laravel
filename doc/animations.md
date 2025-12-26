# Animations

## 最強の一括生成コマンド

```
php artisan make:model Animation -mrc
```

コマンド末尾の`-mrc`オプションで以下のファイルを一気に生成してくれる。

- 1. Model: `app/Models/Animation.php`
- 2. Migration(m): `database/migrations/xxxx_create_animations_table.php`
- 3. Controller(c): `app/Http/Controllers/AnimationController.php`
- 4. Resource Methods(r): Controllerの中にCRUDに必要なメソッドをあらかじめ作成

## ルーティング

今回は`home`のページを単一で置く。

```php
<?php
use App\Http\Controllers\AnimationController;

Route::get('/animations/home', function() {
  return view('animations.home');
})->name('animations.home');
Route::resource('animations', AnimationController::class);
```

