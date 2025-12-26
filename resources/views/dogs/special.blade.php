@extends('layouts.dogs')

@section('title', 'Dogs Special')

@section('content')

  <div class="flex justify-center gap-4 max-w-6xl m-4">
    <button id="bark-button" class="flex items-center justify-center w-32 bg-white text-rose-500 hover:bg-rose-100 font-bold rounded-full text-sm py-2.5 transition-all shadow-sm">
      Bark!🐶
    </button>
    <button id="big-button" class="flex items-center justify-center w-32 bg-white text-rose-500 hover:bg-rose-100 font-bold rounded-full text-sm py-2.5 transition-all shadow-sm">
      Big!🐶
    </button>
    <button id="small-button" class="flex items-center justify-center w-32 bg-white text-rose-500 hover:bg-rose-100 font-bold rounded-full text-sm py-2.5 transition-all shadow-sm">
      Small!🐶
    </button>
    <button id="snack-button" class="flex items-center justify-center w-32 bg-white text-rose-500 hover:bg-rose-100 font-bold rounded-full text-sm py-2.5 transition-all shadow-sm">
      おやつ🐶
    </button>
  </div>

  <div class="flex-grow flex flex-col items-center justify-center p-8">

    <div id="dogContainer" class="text-5xl mb-8 transition-transform duration-200">
      🐶
    </div>

    <div id="dog-message" class="bg-white p-4 rounded-2xl shadow-lg border-2 border-rose-200 text-center text-xs min-w-[150px] min-h-[60px]">
    </div>

    <div class="mt-4 text-xs text-gray-400">
      現在の満足度: <span id="snackCounter">0</span> / 5
    </div>
  </div>

@endsection
