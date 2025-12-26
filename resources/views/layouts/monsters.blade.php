<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Monsters')</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Monsters Header -->
  <header class="bg-pink-300 text-white shadow">
    <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold">Monsters</h1>
      <nav class="space-x-4 text-sm">
        <a href="{{ route('monsters.index') }}" class="hover:underline">一覧</a>
        <a href="{{ route('monsters.create') }}" class="hover:underline">作成</a>
        <a href="{{ route('main_menu') }}" class="hover:underline">メニュー</a>
      </nav>
    </div>
  </header>

  <main class="max-w-5xl mx-auto px-6 py-8">
    @yield('content')
  </main>

  <footer class="text-center text-xs text-gray-500 py-6">
    Monsters App 🐶
  </footer>

</body>
</html>
