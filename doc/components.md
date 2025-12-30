# Bladeコンポーネント

再利用なUI部品(ボタン、ナビゲーションメニューなど)を部品化して管理する機能。

`resources/views/components`ディレクトリに定義し、`<x-component-nama>`タグで呼び出して使う。

共通のHTMLコードを何度も書く手間が省け、コードの冗長性を減らし、保守性を高め、開発効率を上げる。

同じHTMLを2回書いたら負け🐶

- 2回: コンポーネント候補
- 3回以上: 即コンポーネント

## sample

`resources/views/components/input.blade.php`

```blade
@props([
  'label',
  'name',
  'type' => 'text',
  'value' => '',
])

<div>
  <label class="block font-semibold mb-1">
    {{ $label }}
  </label>

  <input
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    class="w-full border rounded-lg px-3 py-2"
  >

  @error($name)
    <p class="text-red-500 text-sm">{{ $message }}</p>
  @enderror
</div>
```

`呼び出す側`

```blade
<x-input
    label="名前"
    name="name"
    :value="$dog->name"
/>

<x-input
    label="年齢"
    name="age"
    type="number"
    :value="$dog->age"
/>

<x-input
    label="好きな食べ物"
    name="favorite_food"
    :value="$dog->favorite_food"
/>
```

Bladeでは:

- `value="abc"` => 文字列
- `:value="$dog->name"` => PHP式

  => PHPの変数をそのまま渡しますよという意味🐶

## ボタンもやってみる

```blade
<button
  {{ $attributes->merge([
    'class' => 'bg-gray-600 text-white px-6 py-2 rounded-xl hover:bg-gray-700'
  ]) }}
>
  {{ $slot }}
</button>
```

```blade
<!-- 呼び出す側 -->
<x-button>
  {{ $submitText ?? '保存する' }}
</x-button>
```

🐶`{{ $slot }}`って何者？🐶

```blade
<x-button>ここ</x-button>
```

この「ここ」が`{{ $slot }}`に入る！

🐶`$attributes->merge()`とは？🐶

- `$attributes`: コンポーネントに渡された「その他のすべての属性」

使う側:

```blade
<x-button class="bg-red-500" type="submit">
  保存
</x-button>
```

コンポーネント側:

```blade
<button {{ $attributes }}>
  {{ $slot }}
</button>
```

結果(HTML):

```html
<button class="bg-red-500" type="submit">
  保存
</button>
```

`maerge`は？🐶

=> デフォルトのclassを用意しておくけど、呼び出し側のclassがあれば合体させてねの意味

## @props()

意味: このコンポーネントは受け取っていい変数の一覧表。

```blade
@props ([
  'label',
  'name',
])
```

=> このコンポーネントは`$label`と`$name`を使います宣言

デフォルト値を持たすこともできる:

```blade
@props ([
  'type' => 'text'
])
```

