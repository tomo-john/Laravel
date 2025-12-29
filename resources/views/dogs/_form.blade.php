@csrf

<!-- name -->
<x-input
    label="名前"
    name="name"
    :value="$dog->name"
/>

<!-- age -->
<x-input
    label="年齢"
    name="age"
    type="number"
    :value="$dog->age"
/>

<!-- color -->
<div>
  <label class="block font-semibold mb-1">毛色</label>
  <select
    name="color"
    class="w-full border rounded-lg px-3 py-2"
    required
  >
    <option value="">選択してください</option>
    @foreach(config('dog.colors') as $value => $label)
      <option value="{{ $value }}"
        {{ old('color', $dog->color) === $value ? 'selected' : '' }}>
        {{ $label }}
      </option>
    @endforeach
  </select>

  @error('color')
    <p class="text-red-500 text-sm">{{ $message }}</p>
  @enderror
</div>

<!-- favorite_food -->
<x-input
    label="好きな食べ物"
    name="favorite_food"
    :value="$dog->favorite_food"
/>

<!-- フォームボタン -->
<x-button>
  {{ $submitText ?? '保存する' }}
</x-button>
