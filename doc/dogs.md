# dogs

最初に作った超基本CRUD :dog:

## テーブル追加

- 初期: `name`, `age`のみ
- 追加: `color`, `favorite_food`の2つ

### 全体の流れ

- 1. dogsテーブル用のマイグレーション作成
- 2. カラム追加
- 3. `migrate`する
- 4. Modelの`$fillable`を更新
- 5. フォーム、コントローラーなど修正

### マイグレーションファイル作成:

```
php artisan make:migration add_columns_to_dogs_table --table=dogs
```

=> 新規ではなく「追加」用を作る :dog:

### マイグレーションを書く

生成されたファイルを編集:

```php
<?php

public function up(): void
{
    Schema::table('dogs', function (Blueprint $table) {
        $table->string('color')->nullable()->after('age');
        $table->string('favorite_food')->nullable()->after('color');
    });
}

public function down(): void
{
    Schema::table('dogs', function (Blueprint $table) {
        $table->dropColumn(['color', 'favorite_food']);
    });
}
```

ポイント:

- `nullable()`: nullを許可(既存データがあってもエラーにならない
- `after()`: カラム順を揃える(必須ではないが整頓大事)

編集後にマイグレーション実行: `php artisan migrate`

### Dogモデルを更新

```php
<?php
// app/Models/Dog.php
class Dog extends Model
{
  protected $fillable = [
    'name',
    'age',
    'color',
    'favorite_food'
  ];
}
```

=> これを忘れると、保存できないエラーが出る


## color管理(config管理/テーブルを必須項目に)

- `color`: 必須
- selectで選択
- 値は固定

=> `config`で管理

### config/dog.phpを作る

```php
<?php

return [
    'colors' => [
        'brown' => '茶色',
        'black' => '黒',
        'white' => '白',
        'gold' => 'ゴールド',
    ],
];
```

### マイグレーションの前に(必須カラム)

最初は`nullable()`したけど、やっぱり必須にしたい :dog:

すでに既存データがあるので、SQLで先にNULLを埋める。

```sql
UPDATE dogs SET color = 'brown' WHERE color IS NULL;
```

### マイグレーション

カラム変更専用のマイグレーションを作る。

```
php artisan make:migration change_color_nullable_on_dogs_table
```

```php
<?php
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dogs' , function (Blueprint $table) 
          {
              $table->string('color')->nullable(false)->change();
          }); 
    }

    public function down(): void
    {
        Schema::table('dogs' , function (Blueprint $table) 
          {
              $table->string('color')->nullable(false)->change();
          }); 
    }
};
```

```
php artisan migrate
```

---

# user_id を追加する

- ログインは`Breeze`をインストール済
- Dogsはログイン必須(ルーティングでミドルウェア)
- ログインユーザーと作成したdogを紐付け
- indexでは自分が作成したdogだけが表示されるようにする

### マイグレーション

```bash
php artisan make:migration add_user_id_to_dogs_table --table=dog
```

```php
<?php
    public function up(): void
    {
        Schema::table('dogs', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('dogs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id']);
        });
    }
```

=> マイグレーション実行

### Dogモデルにリレーションを追加

```php
<?php
class Dog extends Model
{
  protected $fillable = [
    'name',
    'age',
    'color',
    'favorite_food',
    'user_id',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
```

### Userモデルにも逆方向を追加

```php
<?php
// 最後に追記した
public function dogs()
{
    return $this->hasMany(Dog::class);
}
```

### store(コントローラ)でログイン中ユーザーを紐づける

```php
<?php
// コントローラの上部にこの追加を忘れない
use Illuminate\Support\Facades\Auth;
```

```php
<?php
// store
public function store(Request $request)
{
  $validated = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'age' => ['required', 'integer', 'min:0', 'max:100'],
      'color' => ['required', 'in:' . implode(',', array_keys(config('dog.colors')))],
      'favorite_food' => ['nullable', 'string', 'max:30'],
  ]);

  $validated['user_id'] = Auth::id();

  Dog::create($validated);
  return redirect()->route('dogs.index')->with('success', '登録しました');
}
```

- `user_id` はフォームから送らせない
- サーバー側で`Auth::id()`を入れる

### indexに表示するdogsをユーザーと紐づける

```php
<?php
// index
public function index()
{
  // $dogs = Dog::all();
  // $dogs = Dog::where('user_id', Auth::id())->get();
  $dogs = auth()->user()->dogs;
  return view('dogs.index', compact('dogs'));
}
```

Dogモデル、Userモデルそれぞれでリレーションを張ったのでこの書き方ができる。

---

# Policy(ポリシー)の追加

- 自分のDogだけ、`edit`, `update`, `destroy`できるようにする
- 他人のDogにアクセスしたら`403 Forbidden`

### DogPolicyを作る

```
php artisan make:policy DogPolicy --model=Dog
```

=> `app/Policies/DogPolicy.php`ができる

### DogPolicyに所有者チェックを書く

```php
<?php
class DogPolicy
{
    // 変更した箇所のみ
    public function view(User $user, Dog $dog): bool
    {
        return $user->id === $dog->user_id;
    }

    public function update(User $user, Dog $dog): bool
    {
        return $user->id === $dog->user_id;
    }

    public function delete(User $user, Dog $dog): bool
    {
        return $user->id === $dog->user_id;
    }
}
```

- この`user`はこの`dog`を操作してよいか、それだけをここに書く

### Controllerでauthorizeを使う

```php
<?php
// edit と update メソッドの先頭に追加
$this->authorize('update', $dog);

// destroy メソッドの先頭に追加
$this->authorize('delete', $dog);
```

これで自分のdogは編集可能、他人のdog(URL直打ち)は403 Forbiddenエラー。

`$this->authorize()`はControllerで、この処理を実行してよいか？を確認する命令。

`$this->authorize('update', $dog);`: 「今ログインしているuserはこのdogをupdateしてよいか？」

- ログイン中のuserを取得
- `DogPolicy::update($user, dog)`を探す
- `true` => 処理続行
- `false` =>  403 Forbidden を自動で投げる

### Blade側でもボタンを表示にする(UIも安全に)

```blade
<div class="flex justify-between items-center gap-2">
  @can ('update', $dog)
    <a href="{{ route('dogs.edit', $dog) }}"
       class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold
              px-4 py-3 rounded-xl transition line-clamp-1">
      <i class="fa-solid fa-pen mr-1"></i> 編集する
    </a>
  @endcan

  @can ('delete', $dog)
    <form action="{{ route('dogs.destroy', $dog) }}" method="post" onsubmit="return confirm('本当に削除しますか？🐶');">
      @csrf
      @method('DELETE')
      <button class="w-full bg-white border border-red-100 text-red-400 hover:bg-red-50 text-sm font-bold
                     px-4 py-3 rounded-xl transition line-clamp-1">
        <i class="fa-solid fa-trash-can"></i> 削除する
      </button>
    </form>
  @endcan
</div>
```

`@can('update', $dog)`: このuserがこのdogをupdateできるなら表示してね

- Blade: 見せない
- Policy: 実行させない

=> 両方やるのがよい

### メソッドありませんエラー

この時点で編集や削除呼び出すと下記のエラー

```
Call to undefined method App\Http\Controllers\DogController::authorize()
```

Laravel12のControllerは最初から`autorize()`を持っていない。

=> Controllerが最小構成になっていて、何も`trait`が入ってない

`app/Http/Controllers/Controller.php`を編集(追加)する。

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use AuthorizesRequests;
}
```

今回は、`Controller.php`に追加したので全コントローラ共通で使用できる。

