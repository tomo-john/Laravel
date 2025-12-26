@extends('layouts.animation')

@section('content')

  <!-- Free Area -->
  <div class="w-full bg-white rounded-2xl border">

    <!-- Classes animate-xxx -->
    <div class="grid grid-cols-4 gap-4">
      <div class="bg-pink-200 border rounded-full text-center text-pink-700 m-4 p-4"><i class="fa-solid fa-dog mr-4 animate-spin"></i>spin</div>
      <div class="bg-pink-200 border rounded-full text-center text-pink-700 m-4 p-4"><i class="fa-solid fa-dog mr-4 animate-ping"></i>ping</div>
      <div class="bg-pink-200 border rounded-full text-center text-pink-700 m-4 p-4"><i class="fa-solid fa-dog mr-4 animate-pulse"></i>pulse</div>
      <div class="bg-pink-200 border rounded-full text-center text-pink-700 m-4 p-4"><i class="fa-solid fa-dog mr-4 animate-bounce"></i>bounce</div>
    </div>

    <!-- Run-1 -->
    <div class="flex flex-col items-center my-6">
      <div class="w-3/4 h-12 border bg-green-200 rounded-xl">
        <span id="puni-container" class="inline-block transition-transform duration-[1200ms] ease-in-out">
          <i id="puni-icon" class="fa-solid fa-dog text-3xl text-green-500 mt-2 ml-2 transition-transform duration-200"></i>
        </span>
      </div>
      <!-- Puni Button -->
      <div class="">
        <button id="puni-button"class="bg-yellow-400 text-white px-6 py-2 m-4 rounded-full shadow-lg
                    transition-transform duration-200 hover:scale-110 active:scale-95">
          ぷにっとボタン<i class="fa-solid fa-paw"></i>
        </button>
      </div>
    </div>

    <!-- Run-2 -->
    <div class="flex flex-col items-center my-6">
      <div class="w-3/4 h-12 border bg-green-300 rounded-xl">
        <span id="run-container" class="inline-block transition-transform duration-[1200ms] ease-in-out">
          <i id="run-icon" class="fa-solid fa-dog text-3xl text-green-500 mt-2 ml-2 transition-transform duration-200"></i>
        </span>
      </div>
      <!-- Run Button -->
      <div class="">
        <button id="run-button"class="bg-yellow-400 hover:bg-yellow-200 text-white px-6 py-2 m-4 rounded-full shadow-lg transition-color duration-200">
          ぷにっとボタン<i class="fa-solid fa-paw"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Dog Icon Operation -->
  <div class="w-full flex flex-col items-center gap-6 bg-white border rounded-2xl mt-6">

    <h2 class="text-4xl font-bold mt-6">Dog Icon Operation</h2>

    <!-- アイコンエリア -->
    <div class="w-64 h-64 flex flex-col justify-center items-center bg-gray-300 rounded-2xl mt-6">
      <span id="dog-container" class="">
        <i id="dog-icon" class="fa-solid fa-dog text-white text-8xl transition-all duration-300"></i>
      </span>
    </div>

    <!-- Select: 色 -->
    <div class="flex flex-col items-center gap-2">
      <p class="font-bold text-gray-600">色を選んでください</p>
      <select id="color-select" class="border-2 border-gray-300 rounded-lg px-4 py-2 focus:border-blue-500 outline-none cursor-pointer">
        <option value="">-- デフォルト(白) --</option>
        <option value="red">赤(Red)</option>
        <option value="blue">青(Blue)</option>
        <option value="yellow">黄(Yellow)</option>
        <option value="green">緑(Green)</option>
        <option value="orange">オレンジ(Orange)</option>
      </select>
    </div>

    <!-- 選択された色: -->
    <div id="color-message" class="text-gray-400 text-sm mb-4">
      選択された色: <span id="current-color-name" class="font-mono">white</span>
    </div>
  </div>

  <!-- Dog Walking -->
  <div class="w-full min-h-screen flex flex-col gap-6 items-center bg-white border rounded-2xl mt-6">
    
    <h2 class="text-4xl font-bold mt-6">Dog Walking</h2>

    <div class="w-256 h-128 flex flex-col justify-center items-center bg-green-50 rounded-2xl relative overflow-hidden">
      <i id="walking-dog" class="fa-solid fa-dog text-2xl text-pink-500 transition-transform duration-150"></i>
    </div>

    <div class="flex gap-4">
      <button id="" class=""><i class="fa-solid fa-font-awesome"></i></button>
    </div>
  </div>
@endsection
