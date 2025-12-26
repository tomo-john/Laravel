<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <title>@yield('title', 'Animations')</title>
  @vite(['resources/css/app.css', 'resources/js/animation.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen">

  <!-- Header -->
  <header class="flex items-center justify-between bg-rose-400">
    <div class="flex items-center text-gray-700 text-2xl px-8 py-6 gap-2">
      <i class="fa-solid fa-shield-dog text-rose-600"></i>
      <h1 class="font-extrabold">Animations</h1>
    </div>

    <nav class="flex gap-4 mx-6">
      <a href="{{ route('main_menu') }}" class="flex items-center justify-center w-32 bg-rose-300 hover:bg-rose-500 text-white font-bold rounded-full text-sm py-2.5 duration-300 shadow-sm">
        Main menu
      </a>
      <a href="{{ route('test') }}" class="flex items-center justify-center w-32 bg-rose-300 hover:bg-rose-500 text-white font-bold rounded-full text-sm py-2.5 duration-300 shadow-sm">
        Test page
      </a>
      <a href="{{ route('dogs.index') }}" class="flex items-center justify-center w-32 bg-rose-300 hover:bg-rose-500 text-white font-bold rounded-full text-sm py-2.5 duration-300 shadow-sm">
        Dogs
      </a>
      <a href="{{ route('tasks.index') }}" class="flex items-center justify-center w-32 bg-rose-300 hover:bg-rose-500 text-white font-bold rounded-full text-sm py-2.5 duration-300 shadow-sm">
        Tasks
      </a>
      <a href="{{ route('monsters.index') }}" class="flex items-center justify-center w-32 bg-rose-300 hover:bg-rose-500 text-white font-bold rounded-full text-sm py-2.5 duration-300 shadow-sm">
        Monsters
      </a>
      <a href="{{ route('animations.home') }}" class="flex items-center justify-center w-32 bg-rose-300 hover:bg-rose-500 text-white font-bold rounded-full text-sm py-2.5 duration-300 shadow-sm">
        Animations
      </a>
    </nav>

  </header>

  <!-- Main -->
  <main class="flex-grow w-full max-w-6xl mx-auto px-6 py-8">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="text-center text-xs text-gray-500 py-6">
    &copy; 2025 This is footer-like content. 🐶
  </footer>

</body>
</html>
