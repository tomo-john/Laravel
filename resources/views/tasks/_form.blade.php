@csrf

<div class="space-y-6">
  <!-- ステータス選択 -->
  <div>
    <label for="status" class="block text-sm font-bold text-gray-700 mb-2">
      <i class="fa-solid fa-tag mr-1 text-indigo-400"></i>状態
    </label>
    <select id="status" name="status"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3">
      @foreach ($statusOptions as $value => $label)
        <option value="{{ $value }}" @selected(old('status', $task->status) == $value)>
          {{ $label }}
        </option>
      @endforeach
    </select>
  </div>

  <!-- タスクタイトル -->
  <div>
    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">
       <i class="fa-solid fa-pen mr-1 text-indigo-400"></i> 登録するタスク
    </label>
    <input id="title" name="title" type="text"
           placeholder="例: 犬の散歩"
           value="{{ old('title', $task->title) }}"
           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4
                   @error('title') border-red-500 @enderror">
    @error('title')
      <p class="mt-2 text-sm text-red-600 flex items-center">
        <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
      </p>
    @enderror
  </div>

  <!-- 送信ボタン -->
  <div class="pt-4">
    <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-6 
                   rounded-xl shadow-lg transition duration-200 transform hover:-translate-y-0.5">
      <i class="fa-solid fa-paw mr-2"></i> {{ $submitText ?? '保存する' }}
    </button>
  </div>
</div>
