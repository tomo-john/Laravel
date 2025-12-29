# FormRequest

バリデーション専門のクラス。

- Controllerにバリデーションを書くとだんんだん太る
- create / update で同じルールを書く
- 許可(`authorize`)と混ざりがち

Controllerでは処理の流れを管理する係、FormRequestは入力チェックと権限チェック専門係のように責務を分離させる。

## Dogsに導入してみる(store)

```
php artisan make:request DogStoreRequest
```

=> `app/Http/Requests/DogStoreRequest.php`が生成

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DogStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0', 'max:100'],
            'color' => ['required', 'in:' . implode(',', array_keys(config('dog.colors')))],
            'favorite_food' => ['nullable', 'string', 'max:30'],
        ];
    }
}
```

- `authorize()`: 権限チェックもできる(Policyjとは別枠)
- `rules()`: 今までControllerに書いてたやつ(バリデーション)

### Controllerをスリムにする

```php
<?php

// 追加を忘れない
use App\Http\Requests\DogStoreRequest;

class DogController extends Controller
{
    // ... 略 ...
    public function store(DogStoreRequest $request)
    {
      $validated = $request->validated();
      $validated['user_id'] = Auth::id();

      Dog::create($validated);
      return redirect()->route('dogs.index')->with('success', '登録しました');
    }

    // ... 略 ...
}
```

## updateもやってみる

```
php artisan make:request DogUpdateRequest
```

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DogUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        $dog = $this->role('dog');
        return $this->user()->can('update', $dog);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0', 'max:100'],
            'color' => ['required', 'in:' . implode(',', array_keys(config('dog.colors')))],
            'favorite_food' => ['nullable', 'string', 'max:30'],
        ];
    }
}
```

- `$this->route('dog')`: ルートモデルバインディングで渡された`Dog $dog`
- `$this->user()->can('update', $dog)`: Policyをここで読んでる

  => `authorize()`の中でPolicyを使ってOK

コントローラーは`FormRequest`に全部委譲:

```php
<?php
  // update
  public function update(DogStoreRequest $request, Dog $dog)
  {
    $dog->update($request->validated());
    return redirect()->route('dogs.show', $dog)->with('success', '更新しました');
  }
```

