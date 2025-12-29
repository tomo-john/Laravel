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
