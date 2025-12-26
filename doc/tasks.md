# tasks

どこにでもあるtask管理app :dog:

## フォーム共通化

1. `layouts/tasks.blade.php`: 全体の枠組み

2. `tasks/_form.blade.php`: 入力項目だけの部品

3. `tasks/create.blade.php`: 部品を呼び出して表示

4. `tasks/edit.blade.php`: 部品を呼び出して表示

`_form.blade.php`の書き方:

```blade
<input value="{{ old('title', $task->title) }}">
```

- バリデーションエラー時は古い入力内容が表示
- 編集画面ではDBに保存された内容が表示

```blade
<form action="{{ route('tasks.store') }}" method="post">
  <!-- 部品を埋め込む -->
  @include('tasks._form', ['submitText' => 'タスクを登録する'])
</form>
```

`['submitText' => 'タスクを登録する']`の部分で、部品を読込むときに変数を渡している。

作成画面では`登録する`、編集画面では`更新する`と表示を変えることができる。

## ステータス管理

`config`ではなく`Model`で実装。

Model側で定数と呼び出し用の関数を定義。

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  /**
   * 1. マスアサインメント設定(store/updateで一括代入を許可するカラム)
   */
  protected $fillable = [
    'title',
    'status',
  ];

  /**
   * 2. ステータスの定数定義(DBに保存する文字列)
   */
  public const STATUS_PENDING     = 'pending';     // 未着手
  public const STATUS_IN_PROGRESS = 'in_progress'; // 着手
  public const STATUS_COMPLETED   = 'completed';   // 完了

  /**
   * 3. 静的メソッド: 全てのステータスと表示名を取得
   * @return array<string, string>
   */
  public static function getStatusOptions(): array
  {
    return [
      self::STATUS_PENDING     => '未着手',
      self::STATUS_IN_PROGRESS => '着手',
      self::STATUS_COMPLETED   => '完了',
    ];
  }
}
```

コントローラ側ではこんな感じで呼び出して、ビューに渡せる。

```php
<?php
$statusOptions = Task::getStatusOptions();
return view('tasks.index', compact('tasks', 'statusOptions'));
```

## ステータス管理の場所

### 設定をどこに書くべきか? (Model VS Config)

モデル(`Model`)に書く場合:

- 向いているもの: そのテーブルに深く関連する設定
- `Task::STATUS_OPTIONS`のように独自メソッドで読み出せる

コンフィグ(`config/`)に書く場合:

- 向いているもの: アプリ全体での共通設定(アプリ名、ページに表示する件数など)
- `cinfig/app_settiong.php`のようなファイルを作り`config('app_setting.task_status')`のように呼び出す

