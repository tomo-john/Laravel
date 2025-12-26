@extends('layouts.tasks')

@section('title', 'タスク作成')

@section('content')

  <div class="bg-white rounded-2xl shadow-xl p-8 max-w-2xl mx-auto">
    <div class="mb-8 flex items-center gap-3">
      <div class="p-3 bg-indigo-100 rounded-lg">
        <i class="fa-solid fa-plus text-indigo-600 text-xl"></i>
      </div>
      <h2 class="text-2xl font-bold text-gray-800">新しいタスクの作成</h2>
    </div>

    <form action="{{ route('tasks.store') }}" method="post">
      <!-- 部品を埋め込む -->
      @include('tasks._form', ['submitText' => 'タスクを登録する'])
    </form>

    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
      <a href="{{ route('tasks.index') }}" class="text-gray-400 hover:text-indigo-500 text-sm font-medium transition">
        <i class="fa-solid fa-arrow-left mr-1"></i> タスク一覧へ戻る
      </a>
    </div>
  </div>

@endsection
