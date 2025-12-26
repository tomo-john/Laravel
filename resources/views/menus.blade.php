@extends('layouts.menu')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4">

  <header class="mb-12 text-center">
    <h1 class="text-5xl font-black text-indigo-600 mb-3 tracking-tight">Laravel App</h1>
    <p class="text-gray-500 font-medium">🐶learning laravel🐶</p>
  </header>

  <div class="text-center mb-8">
    <h2 class="inline-block text-2xl font-bold text-gray-700 border-b-4 border-pink-200 px-4 pb-1">Main Menu</h2>
  </div>
  
  <!--Link List -->
  <ul class="flex flex-col items-center gap-6 my-4">

    <!-- Dogs Page-->
    <li class="w-full max-w-xs">
      <a href="{{ route('dogs.index')}}"
         class="flex items-center justify-center gap-3 
                bg-white hover:bg-pink-50 text-gray-700 font-bold py-4 px-6 border-2 border-pink-100 rounded-2xl
                shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
        <span class="text-2xl text-pink-200"><i class="fa-solid fa-dog icon-dog"></i></span>
        <span>Dogs</span>
      </a>
    </li>

    <!-- Tailwind Page -->
    <li class="w-full max-w-xs">
      <a href="{{ route('tailwind')}}"
         class="flex items-center justify-center gap-3 
                bg-white hover:bg-pink-50 text-gray-700 font-bold py-4 px-6 border-2 border-pink-100 rounded-2xl
                shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
        <span class="text-2xl text-pink-200"><i class="fa-solid fa-paintbrush"></i></span>
        <span>Tailwind</span>
      </a>
    </li>

    <!-- Tasks Page -->
    <li class="w-full max-w-xs">
      <a href="{{ route('tasks.index')}}"
         class="flex items-center justify-center gap-3 
                bg-white hover:bg-pink-50 text-gray-700 font-bold py-4 px-6 border-2 border-pink-100 rounded-2xl
                shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
        <span class="text-2xl text-pink-200"><i class="fa-solid fa-list-check"></i></span>
        <span>Tasks</span>
      </a>
    </li>

    <!-- Monsters Page -->
    <li class="w-full max-w-xs">
      <a href="{{ route('monsters.index')}}"
         class="flex items-center justify-center gap-3 
                bg-white hover:bg-pink-50 text-gray-700 font-bold py-4 px-6 border-2 border-pink-100 rounded-2xl
                shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
        <span class="text-2xl text-pink-200"><i class="fa-solid fa-poo"></i></span>
        <span>Monsters</span>
      </a>
    </li>

    <!-- Animations Page -->
    <li class="w-full max-w-xs">
      <a href="{{ route('animations.home')}}"
         class="flex items-center justify-center gap-3 
                bg-white hover:bg-pink-50 text-gray-700 font-bold py-4 px-6 border-2 border-pink-100 rounded-2xl
                shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200">
        <span class="text-2xl text-pink-200"><i class="fa-solid fa-cow"></i></span>
        <span>Animations</span>
      </a>
    </li>

  </ul>

  <footer class="mt-16 text-center text-gray-400 text-sm">
    &copy; 2025 My Laravel Learning. Created with 🐶
  </footer>

</div>
@endsection
