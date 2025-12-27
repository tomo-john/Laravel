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

