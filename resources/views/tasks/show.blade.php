@extends('layouts.tasks')

@section('title', 'タスク詳細')

@section('content')

  <div class="bg-white rounded-2xl shadow-xl p-8 max-w-2xl mx-auto">

    <!-- ヘッダー部分 -->
    <div class="mb-8 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="p-3 bg-sky-100 rounded-lg text-sky-600">
          <i class="fa-solid fa-circle-info text-xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">タスク詳細</h2>
      </div>

      <!-- 編集ボタン -->
      <a href="{{ route('tasks.edit', $task) }}"
         class="flex items-center gap-2 text-indigo-500 hover:text-indigo-700 font-bold transition">
        <i class="fa-solid fa-pen-to-square"></i>編集する
      </a>
    </div>

    @php
      $statusDisplayName = $statusOptions[$task->status] ?? '不明';
      $statusColor = $task->status == 'completed' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700';
    @endphp

    <!-- 詳細表示エリア -->
    <div class="space-y-8 py-4">

      <!-- 状態表示 -->
      <div>
        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Status / 状態</p>
        <span class="px-4 py-2 text-sm font-bold rounded-full {{ $statusColor }}">{{ $statusDisplayName }}</span>
      </div>

      <!-- 内容表示 -->
      <div>
        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Content / 内容</p>
        <p class="text-xl text-gray-700 font-medium leading-relaxed">{{ $task->title }}</p>
      </div>
    </div>

    <!-- アクションエリア -->
    <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col items-center gap-6">
      <!-- 削除フォーム -->
      <form action="{{ route('tasks.destroy', $task) }}" method="post" 
            onsubmit="return confirm('本当に削除してもよろしいですか？🐶🐾');" 
            class="w-full">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full text-red-400 hover:text-red-600 text-sm font-medium 
                                     flex items-center justify-center gap-2 transition">
          <i class="fa-solid fa-trash-can"></i>このタスクを完全に削除する
        </button>
      </form>

      <!-- 戻るリンク -->
      <a href="{{ route('tasks.index') }}" class="text-gray-400 hover:text-indigo-500 text-sm font-medium transition">
        <i class="fa-solid fa-arrow-left mr-1"></i> タスク一覧へ戻る
      </a>
    </div>

  </div>
@endsection
