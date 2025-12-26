<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <title>@yield('title', 'Tasks')</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen">

  <div class="max-w-4xl mx-auto py-10 px-4">
    
    <header class="mb-10 text-center">
      <h1 class="text-4xl font-extrabold text-indigo-600 mb-2">
        🐶 タスク管理ボード 🐾
      </h1>
      <p class="text-gray-500">Hello Laravel</p>
    </header>

    <main class="">
      @yield('content')
    </main>


  </div>

  <footer class="text-center text-xs text-gray-500 py-6">
    🐶 Tasks App 🐶
  </footer>

</body>
</html>
