@csrf

<!-- 名前 -->
<div>
  <label for="name" class="block font-semibold mb-1">モンスター名</label>
  <input
    id="name"
    name="name"
    type="text"
    value="{{ old('name', $monster->name) }}"
    class="w-full rounded-lg border px-3 py-2
           @error('name') border-red-400 @else border-gray-300 @enderror">

  @error('name')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
</div>

<!-- コスト -->
<div>
  <label for="cost" class="block font-semibold mb-1">コスト</label>
  <input
    id="cost"
    name="cost"
    type="number"
    value="{{ old('cost', $monster->cost) }}"
    class="w-full rounded-lg border px-3 py-2
           @error('cost') border-red-400 @else border-gray-300 @enderror">

  @error('cost')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
</div>

<!-- 色 -->
<div>
  <label for="color" class="block font-semibold mb-1">こころの色</label>
  <select
    id="color"
    name="color"
    class="w-full rounded-lg border px-3 py-2
           @error('color') border-red-400 @else border-gray-300 @enderror">
    <option value="">選択してください</option>
    @foreach (config('monster.colors') as $value => $label)
      <option value="{{ $value }}" {{ old('color', $monster->color) === $value ? 'selected' : '' }}>
        {{ $label }}
      </option>
    @endforeach
  </select>

  @error('color')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
</div>

<!-- 所持数 -->
<div>
  <label for="quantity" class="block font-semibold mb-1">所持数</label>
  <input
    id="quantity"
    name="quantity"
    type="number"
    value="{{ old('quantity', $monster->quantity) }}"
    class="w-full rounded-lg border px-3 py-2
           @error('quantity') border-red-400 @else border-gray-300 @enderror">

  @error('quantity')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
</div>

<!-- メモ -->
<div>
  <label for="memo" class="block font-semibold mb-1">メモ</label>
  <input
    id="memo"
    name="memo"
    type="text"
    value="{{ old('memo', $monster->memo) }}"
    class="w-full rounded-lg border px-3 py-2">
</div>

<!-- 登録ボタン -->
<button
  type="submit"
  class="w-full bg-pink-300 hover:bg-pink-400 text-white font-bold py-3 rounded-xl transition">
  {{ $submitText ?? '保存' }}
</button>
