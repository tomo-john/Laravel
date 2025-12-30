# 管理者ロール

Laravelでの管理者ロールのざっくり流れ:

- 1: usersテーブルに`role`を持たせる
- 2: Userモデルで`管理者か？`を判定できるようにする
- 3: Policyで`role`を使った分岐を書く
- 4: Controller / Bladeから自然に使う

### usersテーブルにroleを追加

```bash
php artisan make:migration add_role_to_users_table
```

```php
<?php
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
```

### Userモデルに管理者か？を教える

`app/Models/User.php`:

```php
<?php
public function isAdmin(): bool
{
  return $this->role === 'admin';
}
```

`protected $fillable`に`role`も追加しておいた。

=> 後から: これはセキュリティ的にNGなので、後で削除した🐶

### Policyで管理者は全部OKにする

今回は`DogPolicy.php`に追加:

```php
<?php
public function before(User $user, string $ability): bool|null
{
    if ($user->isAdmin()) {
        return true;
    }

    return null;
}
```

これにより、管理者なら全部のチェックを素通りする。

