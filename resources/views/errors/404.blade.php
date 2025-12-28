@extends('layouts.menu')

@section('title', '404 Page Not Found')

@section('content')
  <div class="min-h-screen m-4 border flex justify-center items-center">
    <div class="flex flex-col items-center">
      <p class="text-gray-500 text-xl font-bold">🐶 404 Not Found 🐶</p>
      <a href="{{ route('main_menu') }}"
         class="inline-block bg-gray-500 hover:bg-gray-400 rounded p-2 m-2 transition">
        Main Menu
      </a>
    </div>
  </div>
@endsection
