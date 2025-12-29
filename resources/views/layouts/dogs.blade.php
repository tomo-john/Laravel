<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <title>@yield('title', 'Dogs')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col bg-gray-100 text-gray-800 min-h-screen">

  <!-- Dogs Header -->
  <header class="bg-gray-800 text-gray-100 shadow">
    <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">

      <div class="flex items-center space-x-6">
        <h1 class="text-xl font-bold">Dogs</h1>

        <div class="flex flex-col text-xs text-gray-400">
          <span class="font-semibold text-gray-200">{{ Auth::user()->name }}</span>
          <span>{{ auth()->user()->email }}</span>
        </div>

        @if (auth()->user()->isAdmin())
          <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                      bg-gradient-to-r from-yellow-400 to-orange-500 text-white shadow-sm animate-pulse">
            <span class="mr-1"><i class="fa-solid fa-crown"></i></span>
            Admin Mode 🐶
          </div>
        @endif
      </div>

      <nav class="space-x-4 text-sm flex items-center">
        @php
          $navClass = "inline-block w-24 text-center bg-gray-700 hover:bg-gray-600 transition duration-400 ease-in-out rounded-xl py-2";
        @endphp
        <a href="{{ route('dogs.index') }}" class="{{ $navClass }}">Index</a>
        <a href="{{ route('dogs.create') }}" class="{{ $navClass }}">Create</a>
        <a href="{{ route('dogs.special') }}" class="{{ $navClass }}">Special</a>
        <a href="{{ route('main_menu') }}" class="{{ $navClass }}">Main Menu</a>
        <a href="{{ route('welcome') }}" class="{{ $navClass }}">Laravel</a>
      </nav>
    </div>
  </header>

  <main class="flex-grow w-full max-w-2xl mx-auto px-6 py-8">
    @yield('content')
  </main>

  <footer class="text-center text-xs text-gray-500 py-6">
    🐶 Dogs App 🐶
  </footer>

</body>
</html>
