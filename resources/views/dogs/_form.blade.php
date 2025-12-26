@csrf

<!-- name -->
<div>
  <label class="block font-semibold mb-1">名前</label>
  <input
    type="text"
    name="name"
    value="{{ old('name', $dog->name) }}"
    class="w-full border rounded-lg px-3 py-2"
  >
  @error('name')
    <p class="text-red-500 text-sm">{{ $message }}</p>
  @enderror
</div>

<!-- age -->
<div>
  <label class="block font-semibold mb-1">年齢</label>
  <input
    type="number"
    name="age"
    value="{{ old('age', $dog->age) }}"
    class="w-full border rounded-lg px-3 py-2"
  >
  @error('age')
    <p class="text-red-500 text-sm">{{ $message }}</p>
  @enderror
</div>

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
<div>
  <label class="block font-semibold mb-1">好きな食べ物</label>
  <input
    type="text"
    name="favorite_food"
    value="{{ old('favorite_food', $dog->favorite_food) }}"
    class="w-full border rounded-lg px-3 py-2"
  >
  @error('favorite_food')
    <p class="text-red-500 text-sm">{{ $message }}</p>
  @enderror
</div>

<!-- フォームボタン -->
<button class="bg-gray-600 text-white px-6 py-2 rounded-xl hover:bg-gray-700">
  {{ $submitText ?? '保存する' }}
</button>
