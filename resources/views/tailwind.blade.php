<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <title>Tailwind</title>
  @vite(['resources/css/app.css', 'resources/js/tailwind.js'])
</head>
<body class="flex flex-col bg-gray-100 min-h-screen">

  <!-- ヘッダーエリア -->
  <header class="flex items-center justify-between bg-rose-400">
    <!-- タイトル -->
    <div class="flex items-center text-gray-700 text-2xl px-8 py-6 gap-2">
      <i class="fa-solid fa-shield-dog text-rose-600"></i>
      <h1 class="font-extrabold">Tailwind</h1>
    </div>

    <!-- リンク -->
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

  <!-- 検証用エリア -->
  <main class="flex-grow p-8">
      <div class="flex flex-col gap-8">

        <!-- JSさわってみた -->
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-sm p-6">
          <h2 class="text-xl font-bold text-gray-800 text-center mb-4">🐶 JS検証用エリア 🐶<h2>

          <div class="p-8 text-center">
            <p id="magic-text" class="text-xl mb-4"><i class="fa-solid fa-dog"></i></p>
            <button id="magic-btn" class="bg-stone-400 hover:bg-stone-500 text-white px-4 py-2 rounded shadow">JS起動🐶</button>
          </div>
        </div>

        <!-- Grid -->
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-sm p-6 space-y-4">
          <h2 class="text-xl font-bold text-gray-800 text-center mb-4">🐶 Grid検証用エリア 🐶</h2>

          <div class="border border-gray-500 rounded-xl p-2">
            <p class="text-sm font-bold text-gray-500 my-2">基本3列</p>
            <div class="grid grid-cols-3 gap-4">
              <div class="bg-blue-200">1</div>
              <div class="bg-blue-200">2</div>
              <div class="bg-blue-200">3</div>
              <div class="bg-blue-200">4</div>
            </div>
          </div>

          <div class="border border-gray-500 rounded-xl p-2">
            <p class="text-sm font-bold text-gray-500 my-2">横幅に応じて1～3列</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
              <div class="bg-pink-200">🐶</div>
              <div class="bg-pink-200">🐶</div>
              <div class="bg-pink-200">🐶</div>
              <div class="bg-pink-200">🐶</div>
              <div class="bg-pink-200">🐶</div>
              <div class="bg-pink-200">🐶</div>
            </div>
        </div>

          <div class="border border-gray-500 rounded-xl p-2">
            <p class="text-sm font-bold text-gray-500 my-2">col-span</p>
            <div class="grid grid-cols-3 gap-4">
              <div class="bg-orange-200 col-span-2">col-span-2</div>
              <div class="bg-orange-200">normal</div>
              <div class="bg-orange-200">normal</div>
              <div class="bg-orange-200">normal</div>
              <div class="bg-orange-200 col-span-2">col-span-2</div>
              <div class="bg-orange-200">normal</div>
              <div class="bg-orange-200">normal</div>
              <div class="bg-orange-200 col-span-2">col-span-2</div>
            </div>
        </div>

          <div class="border border-gray-500 rounded-xl p-2">
            <p class="text-sm font-bold text-gray-500 my-2">Grid & Flex</p>

            <!-- 4分割 -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
              <!-- 4分割の内の 1 col-span-1 -->
              <div class="lg:col-span-1 bg-white p-4 rounded-xl shadow-sm">
                <h2 class="text-md">メニュー</h2>
                <nav class="flex flex-col gap-2">
                  <a href="#" class="text-xs">🐶</a>
                  <a href="#" class="text-xs">🐶</a>
                  <a href="#" class="text-xs">🐶</a>
                </nav>
              </div>
              
              <!-- 4分割の内の 3 col-span-3 -->
              <div class="lg:col-span-3 bg-white p-4 rounded-xl shadow-sm">
                <!-- さらに3分割 -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                  <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-orange-500"></div>
                  <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-orange-500"></div>
                  <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-orange-500"></div>
                </div>
                <!-- こっちは Flex -->
                <div class="flex flex-col gap-2">
                  <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-orange-500"></div>
                  <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-orange-500"></div>
                </div>
              </div>
            </div>

      </div>
  </main>

  <footer class="text-center text-xs text-gray-500 py-6">
    &copy; 2025 This is footer-like content. 🐶
  </footer>
</body>
</html>
