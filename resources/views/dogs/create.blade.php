@extends('layouts.dogs')

@section('title', '犬の登録')

@section('content')

  <!-- タイトル -->
  <div class="flex justify-between items-center mb-8">
    <h2 class="text-xl font-bold text-gray-700">🐶 犬を登録</h2>

    <a href="{{ route('dogs.index') }}"
       class="bg-gray-700 hover:bg-gray-600 text-white text-sm
              px-4 py-2 rounded-xl transition">
      <i class="fa-solid fa-backward"></i> 戻る
    </a>
  </div>

  <!-- フォーム -->
  <form action="{{ route('dogs.store') }}" method="post" class="space-y-6">
    @include('dogs._form', ['submitText' => '登録'])
  </form>
@endsection
