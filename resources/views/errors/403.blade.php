@extends('layouts.dogs')

@section('title', '403 Forbidden')

@section('content')
<div class="max-w-xl mx-auto text-center mt-20">

  <div class="text-6xl mb-4">🐶💦</div>

  <h1 class="text-2xl font-bold mb-2">
    ここには入れないみたい...
  </h1>

  <p class="text-gray-600 mb-6">
    この操作はあなたには許可されていません。
  </p>

  @auth
    <a href="{{ route('dogs.index') }}"
       class="inline-block px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
      Dogsへ戻る
    </a>
  @else
    <a href="{{ route('login') }}"
       class="inline-block px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
      ログインする
    </a>
  @endauth
</div>
@endsection
