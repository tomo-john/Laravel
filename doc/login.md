# ルーティング

```php
<?php
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
```

- `auth`: ログインしている？
- `verified`: メール認証してる？

```php
<?php
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
```

- `Route::middleware('auth')`: authミドルウェアを使うよ宣言
- `->group(function() {...})`: この中に書いたルート全部に適用するよ

### middleware(ミドルウェア)とは？

ルートに入る前の関所 :dog:

ブラウザ => `middleware` (チェック係) => コントローラ / view

authミドルウェアは、`この人ログインしてる？`をチェックしている。

- loginしてる: /profileに通す
- loginしてない: `/login`にリダイレクト

