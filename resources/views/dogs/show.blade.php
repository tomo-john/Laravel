@extends('layouts.dogs')

@section('title', '犬の詳細')

@section('content')

  <!-- タイトル -->
  <div class="flex justify-between items-center mb-8">
    <h2 class="text-xl font-bold text-gray-700">🐶 犬の詳細</h2>

    <a href="{{ route('dogs.index') }}"
       class="bg-gray-700 hover:bg-gray-600 text-white text-sm
              px-4 py-2 rounded-xl transition">
      <i class="fa-solid fa-backward"></i> 戻る
    </a>
  </div>

  <!-- フラッシュメッセージ -->
  @if (session('success'))
    <div class="mb-6 p-4 bg-gray-200 text-gray-700 rounded-xl">
      {{ session('success') }}
    </div>
  @endif

  <!-- 基本情報 -->
  <div class="space-y-6">
    <div class="p-5 bg-white rounded-2xl shadow-sm flex flex-col gap-4 border border-gray-100">
      <!-- 名前 -->
      <div class="flex flex-col">
        <p class="text-xs font-bold text-gray-400">名前</p>
        <p class="text-lg font-bold text-gray-800">{{ $dog->name }}</p>
      </div>
      <!-- 年齢 -->
      <div class="flex flex-col">
        <p class="text-xs font-bold text-gray-400">年齢</p>
        <p class="text-lg font-bold text-gray-800">{{ $dog->age }}</p>
      </div>
      <!-- 色 -->
      <div class="flex flex-col">
        <p class="text-xs font-bold text-gray-400">毛色</p>
        <p class="text-lg font-bold text-gray-800">{{ config('dog.colors')[$dog->color] }}</p>
      </div>
      <!-- 好きな食べ物 -->
      <div class="flex flex-col">
        <p class="text-xs font-bold text-gray-400">好きな食べ物</p>
        <p class="text-lg font-semibold text-gray-800">{{ $dog->favorite_food }}</p>
      </div>
    </div>

    <!-- アクションエリア(編集・削除) -->
    <div class="flex justify-between items-center gap-2">
      @can ('update', $dog)
        <a href="{{ route('dogs.edit', $dog) }}"
           class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold
                  px-4 py-3 rounded-xl transition line-clamp-1">
          <i class="fa-solid fa-pen mr-1"></i> 編集する
        </a>
      @endcan

      @can ('delete', $dog)
        <form action="{{ route('dogs.destroy', $dog) }}" method="post" onsubmit="return confirm('本当に削除しますか？🐶');">
          @csrf
          @method('DELETE')
          <button class="w-full bg-white border border-red-100 text-red-400 hover:bg-red-50 text-sm font-bold
                         px-4 py-3 rounded-xl transition line-clamp-1">
            <i class="fa-solid fa-trash-can"></i> 削除する
          </button>
        </form>
      @endcan
    </div>
  </div>

  <!-- お世話機能 -->
  <div class="space-y-6 mt-6">
    <!-- お世話ボタン -->
    <div class="p-6 bg-white rounded-3xl shadow-sm border border-gray-100">
      <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
        <span class="bg-yellow-100 p-2 rounded-lg mr-2">🍖</span>
        今日のお世話
      </h3>
      <div class="grid grid-cols-3 gap-3">
        <button onclick="addCareLog('food', '{{ $dog->name }}')"
                class="flex flex-col items-center justify-center p-4 bg-orange-50 hover:bg-orange-100 rounded-2xl transition group ">
          <span class="text-2xl mb-1 group-hover:scale-110 transition">🍖</span>
          <span class="text-xs font-bold text-orange-700">ごはん</span>
        </button>
        <button onclick="addCareLog('walk', '{{ $dog->name }}')"
                class="flex flex-col items-center justify-center p-4 bg-green-50 hover:bg-green-100 rounded-2xl transition group ">
          <span class="text-2xl mb-1 group-hover:scale-110 transition">🐾</span>
          <span class="text-xs font-bold text-green-700">お散歩</span>
        </button>
        <button onclick="addCareLog('love', '{{ $dog->name }}')"
                class="flex flex-col items-center justify-center p-4 bg-pink-50 hover:bg-pink-100 rounded-2xl transition group ">
          <span class="text-2xl mb-1 group-hover:scale-110 transition">❤</span>
          <span class="text-xs font-bold text-pink-700">なでなで</span>
        </button>
      </div>
    </div>

    <!-- ログ表示エリア -->
    <div>
      <h3 class="text-md font-bold text-gray-700 mb-4 flex item-center justify-between">
        <span><i class="fa-regular fa-clock"></i>アクティビティ履歴</span>
        <span class="text-[10px] text-gray-400 font-normal"><i class="fa-solid fa-triangle-exclamation"></i>リロードすると消えます(練習用)</span>
      </h3>
      <ul id="care-history" class="space-y-3 max-h-64 overflow-y-auto pr-2">
        <li class="text-sm text-gray-400 italic text-center py-4">まだ履歴がありません</li>
      </ul>
    </div>
  </div>

@endsection
