@extends('layouts.monsters')

@section('title', 'モンスター一覧')

@section('content')

  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">モンスター一覧</h2>
    <a href="{{ route('monsters.create') }}"
       class="bg-pink-300 hover:bg-pink-400 text-white text-sm px-4 py-2 rounded-xl shadow">
      ＋ 新規登録
    </a>
  </div>

  {{-- フラッシュメッセージ --}}
  @if (session('success'))
    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl">
      {{ session('success') }}
    </div>
  @endif

  @forelse ($monsters as $monster)
    <div class="bg-white rounded-2xl shadow-sm p-5 mb-4 flex justify-between items-center">

      {{-- 左側：情報 --}}
      <div class="space-y-1">
        <div class="flex items-center gap-3">
          <h3 class="text-lg font-bold">{{ $monster->name }}</h3>

          {{-- 色バッジ --}}
          <span class="
            text-xs font-bold px-3 py-1 rounded-full
            @if($monster->color === 'red') bg-red-100 text-red-600
            @elseif($monster->color === 'blue') bg-blue-100 text-blue-600
            @elseif($monster->color === 'yellow') bg-yellow-100 text-yellow-600
            @elseif($monster->color === 'purple') bg-purple-100 text-purple-600
            @elseif($monster->color === 'green') bg-green-100 text-green-600
            @elseif($monster->color === 'rainbow') bg-gradient-to-r from-red-100 via-yellow-100 to-blue-100 text-gray-500
            @elseif($monster->color === 'black') bg-gray-400 text-gray-600
            @elseif($monster->color === 'white') bg-gray-200 text-white
            @endif
          ">
            {{ config('monster.colors')[$monster->color] }}
          </span>
        </div>

        <p class="text-sm text-gray-600">
          コスト：{{ $monster->cost }} ／ 所持数：{{ $monster->quantity }}
        </p>

        @if ($monster->memo)
          <p class="text-xs text-gray-500">
            💬 {{ $monster->memo }}
          </p>
        @endif
      </div>

      {{-- 右側：操作 --}}
      <div class="flex gap-3 text-sm">
        <a href="{{ route('monsters.edit', $monster) }}"
           class="text-blue-500 hover:underline">
          編集
        </a>

        <form action="{{ route('monsters.destroy', $monster) }}"
              method="post"
              onsubmit="return confirm('本当に削除しますか？');">
          @csrf
          @method('DELETE')
          <button class="text-red-500 hover:underline">
            削除
          </button>
        </form>
      </div>

    </div>
  @empty
    <p class="text-gray-500">登録されたモンスターはいません 🐶</p>
  @endforelse

@endsection
