@extends('layouts.dogs')

@section('title', '犬の編集')

@section('content')

  <!-- タイトル -->
  <div class="flex justify-between items-center mb-8">
    <h2 class="text-xl font-bold text-gray-700">🐶 犬を編集</h2>

    <a href="{{ route('dogs.show', $dog) }}"
       class="bg-gray-700 hover:bg-gray-600 text-white text-sm
              px-4 py-2 rounded-xl transition">
      <i class="fa-solid fa-backward"></i> 戻る
    </a>
  </div>

  <!-- フォーム -->
  <form action="{{ route('dogs.update', $dog) }}" method="post" class="space-y-6">
    @method('PUT')
    @include('dogs._form', ['submitText' => '更新'])
  </form>
@endsection
