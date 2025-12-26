<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <title>Tailwind</title>
  @vite(['resources/css/app.css', 'resources/js/test.js'])
</head>
<body class="bg-gray-100 p-4 md:p-8">

  <div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800"><i class="fa-solid fa-gear mr-2"></i>Flex & Grid</h1>
    <a href="{{ route('tailwind') }}"><i class="fa-solid fa-dog mb-6 ml-4"></i></a>

    <!-- 親要素の Grid: 左右の大きな分割 -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

      <!-- サイドバー(Gridの子) -->
      <div class="lg:col-span-1 bg-white p-4 rounded-xl shadow-sm">
        <h2 class="font-bold mb-4 border-b pb-2">メニュー</h2>
        <!-- サイドバーの中は Flex: 縦に等間隔で並べる -->
        <nav class="flex flex-col gap-2">
          <a href="#" class="p-2 hover:bg-indigo-50 rounded text-indigo-600 font-medium"><i class="fa-solid fa-house mr-2"></i>ホーム</a>
          <a href="#" class="p-2 hover:bg-indigo-50 rounded text-gray-600"><i class="fa-solid fa-bone mr-2"></i>おやつ管理</a>
          <a href="#" class="p-2 hover:bg-indigo-50 rounded text-gray-600"><i class="fa-solid fa-dog mr-2"></i>散歩ログ</a>
        </nav>
      </div>

      <!-- メインコンテンツ(Gridの子) -->
      <div class="lg:col-span-3">

        <!-- メインの中にさらに Grid: カードを3つ並べる -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

          <!-- カード1 -->
          <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-indigo-500">
            <div class="text-sm text-gray-500">今日の散歩</div>
            <!-- カードの中は Flex: 数字と単位を横に並べて下揃え -->
            <div class="flex items-baseline gap-1 mt-2">
                <span class="text-3xl font-bold text-gray-800">8,500</span>
                <span class="text-gray-500 text-sm">歩</span>
            </div>
          </div>

          <!-- カード2 -->
          <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-green-500">
            <div class="text-sm text-gray-500">おやつ残量</div>
            <div class="flex items-center gap-3 mt-2">
              <div class="w-full bg-gray-200 h-2 rounded-full">
                <div class="bg-green-200 h-2 rounded-full w-[70%]"></div>
              </div>
              <span class="text-sm font-bold">70%</span>
            </div>
          </div>

          <!-- カード3 -->
          <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-orange-500">
            <div class="text-sm text-gray-500">ステータス</div>
            <!-- Flexでバッジ風の遊び -->
            <div class="flex gap-2 mt-2">
                <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full">元気いっぱい</span>
                <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">空腹</span>
            </div>
          </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm h-64 flex flex-col items-center justify-center text-gray-400 border-2 border-dashed border-gray-200">
          <p>ここにグラフなどを表示(Flexで中央寄せ)</p>
          <button class="mt-4 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
            データを更新
          </button>
        </div>

      </div>
    </div>
  </div>
</body>
</html>
