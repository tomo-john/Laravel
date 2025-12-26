@extends('layouts.tasks')

@section('title', 'Tasks Index')

@section('content')

@if (session('success'))
  <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r shadow-sm">
    {{ session('success') }}
  </div>
@endif

<div class="flex justify-between items-center mb-6">
  <h2 class="text-xl font-bold">現在のタスク<h2>
  <a href="{{ route('tasks.create') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-200">
    ＋ 新しいタスクを作成
  </a>
  </h2>
</div>

<div class="bg-white rounded-l shadow-md overflow-hidden">
  <ul class="divide-y divide-gray-100">
    @forelse ($tasks as $task)
      @php
        $statusDisplayName = $statusOptions[$task->status] ?? '不明';
        $statusColor = $task->status === 'completed' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700'
      @endphp

      <li class="p-5 flex items-center justify-between hover:bg-gray-50 transition">
        <div class="flex items-center space-x-4">
          <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
            {{ $statusDisplayName }}
          </span>
          <span class="text-lg font-medium text-gray-700">
            {{ $task->title }}
          </span>
        </div>
        <div class="flex space-x-3">
          <a href="{{ route('tasks.show', $task) }}" class="text-indigo-500 hover:text-indigo-700 text-sm font-semibold">
            詳細を表示
          </a>
        </div>
      </li>
    @empty
      <li class="p-10 text-center text-gray-400">
        <p class="text-lg">登録されたタスクはありません🐶</p>
      </li>
    @endforelse
  </ul>
</div>

<div class="mt-10 text-center">
  <a href="{{ route('main_menu') }}" class="text-gray-500 hover:text-indigo-500 transition">
    &laquo; メニューへ戻る
  </a>
</div>

@endsection
