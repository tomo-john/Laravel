@extends('layouts.dogs')

@section('title', 'Dogs Index')

@section('content')

  <!-- Page Title -->
  <div class="flex justify-between items-center mb-8">
    <h2 class="text-xl font-bold text-gray-700">🐶 Dogs</h2>

    <a href="{{ route('dogs.create') }}"
       class="bg-gray-700 hover:bg-gray-600 text-white text-sm
              px-4 py-2 rounded-xl transition">
      <i class="fa-solid fa-plus"></i> 新規登録
    </a>
  </div>

  <!-- Flash Message -->
  @if (session('success'))
    <div class="mb-6 p-4 bg-gray-200 text-gray-700 rounded-xl">
      {{ session('success') }}
    </div>
  @endif

  <!-- Dogs List -->
  @forelse ($dogs as $dog)
    <div class="mb-4 p-5 bg-white rounded-2xl shadow-sm
                hover:shadow-md transition flex justify-between items-center">

      <div>
        <p class="text-lg font-semibold text-gray-800">
          {{ $dog->name }}
        </p>
        <p class="text-sm text-gray-500">
          {{ $dog->age }} 歳
        </p>
      </div>

      <a href="{{ route('dogs.show', $dog) }}"
         class="text-sm bg-gray-100 hover:bg-gray-200
                px-4 py-2 rounded-xl transition">
        詳細
      </a>

    </div>
  @empty
    <div class="p-6 bg-white rounded-2xl text-center text-gray-500">
      まだ登録された犬はいません 🐾
    </div>
  @endforelse

@endsection
