<button
  {{ $attributes->merge([
    'class' => 'bg-gray-600 text-white px-6 py-2 rounded-xl hover:bg-gray-700'
  ]) }}
>
  {{ $slot }}
</button>
