@extends('layouts.monsters')

@section('title', 'モンスター登録')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-2xl shadow-md p-8">

  <!-- タイトル -->
  <h1 class="text-2xl font-bold text-pink-500 mb-6 text-center">
    モンスター登録
  </h1>

  <!-- フォーム -->
  <form action="{{ route('monsters.store') }}" method="post" class="space-y-6">
    <!-- 部品を埋め込む -->
    @include('monsters._form', ['submitText' => '登録する'])
  </form>

  <!-- 戻る -->
  @include('monsters._back_to_index')

</div>
@endsection
