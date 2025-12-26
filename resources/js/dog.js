/**
 * Dog Page Script
 * dogs専用のJavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('dog.jsが正常に読み込まれました🐶');

  // 初期化処理
  initDogActions();
  initCareModule();

});

/** 
 * dogs.special
 */
function initDogActions() {
  const barkButton   = document.getElementById('bark-button');
  const messageArea  = document.getElementById('dog-message');
  const dogContainer = document.getElementById('dogContainer');
  const bigButton    = document.getElementById('big-button');
  const smallButton  = document.getElementById('small-button');
  const snackButton  = document.getElementById('snack-button');
  const snackCounter = document.getElementById('snackCounter');

  let dogSnack = 0;
  let timerId = null;

  // 共通関数：サイズクラスを一度リセットする
  const resetSizeClasses = () => {
    dogContainer.classList.remove('text-sm', 'text-4xl', 'text-5xl', 'text-8xl', 'text-9xl', 'rotate-180');
  };

  // 共通関数：メッセージ表示(タイマー管理付き)
  const showMessage = (text, duration = 2000, keep = false) => {
    if (timerId) clearTimeout(timerId);
    messageArea.textContent = text;
    
    if (!keep) {
      timerId = setTimeout(() => {
        messageArea.textContent = '';
        timerId = null;
      }, duration);
    }
  };

  // 吠えるボタン
  if (barkButton && messageArea) {
    barkButton.addEventListener('click', () => {
      console.log('bark-button起動🐶');
      const barks = ['わんわん！', 'バウーン', 'くんくん', 'じょ～ん'];
      const randomBark = barks[Math.floor(Math.random() * barks.length)];

      messageArea.classList.add('animate-bounce');
      showMessage(randomBark, 3000);

      setTimeout(() => {
        messageArea.classList.remove('animate-bounce');
      }, 1000);
    });
  }

  // 巨大化ボタン (Big!)
  if (dogContainer && bigButton) {
    bigButton.addEventListener('click', () => {
      console.log('big-button起動🐶');
      resetSizeClasses();
      dogContainer.classList.add('text-8xl', 'rotate-180');

      setTimeout(() => {
        resetSizeClasses();
        dogContainer.classList.add('text-5xl'); // 元のサイズ
      }, 2000);
    });
  }

  // 小さくなる (Small!)
  if (dogContainer && smallButton) {
    smallButton.addEventListener('click', () => {
      console.log('small-button起動🐶');
      resetSizeClasses();
      dogContainer.classList.add('text-sm', 'animate-bounce');
      dogContainer.textContent = '🐶'.repeat(20); // リピート使うとスッキリ

      setTimeout(() => {
        dogContainer.classList.remove('animate-bounce');
      }, 2000);

      setTimeout(() => {
        resetSizeClasses();
        dogContainer.textContent = '🐶';
        dogContainer.classList.add('text-5xl');
      }, 3000);
    });
  }

  // おやつボタン
  if (dogContainer && snackButton && messageArea) {
    snackButton.addEventListener('click', () => {
      dogSnack = dogSnack + 1;
      snackCounter.textContent = dogSnack;
      console.log(`snack-button起動🐶 現在のdogSnackは ${dogSnack} 🐶`);

      if (dogSnack >= 5) {
        // 5回目の大進化
        resetSizeClasses();
        dogContainer.classList.add('text-9xl');
        showMessage('うほっ', 0, true); // trueにして消さないようにする
        
        dogSnack = 0;
        // 5秒後に元のサイズに戻るおまけ機能
        setTimeout(() => {
          resetSizeClasses();
          dogContainer.classList.add('text-5xl');
          messageArea.textContent = '満足したわん';
          snackCounter.textContent = 0;
          setTimeout(() => messageArea.textContent = '', 2000);
        }, 5000);

      } else {
        showMessage('ありがとう✨');
      }
    });
  }
}

/** 
 * dogs.show
 */
function initCareModule() {
  window.addCareLog = (type, dogName) => {
    const historyList = document.getElementById('care-history');
    if (!historyList) return;

    if (historyList.querySelector('.italic')) {
      historyList.innerHTML = '';
    }

    const config = {
      food: { emoji: '🍖', text: 'にごはんをあげました！', color: 'text-orange-600', bg: 'bg-orange-50'},
      walk: { emoji: '🐾', text: 'と散歩に行きました！', color: 'text-green-600', bg: 'bg-green-50'},
      love: { emoji: '❤', text: 'をなでなでしました！', color: 'text-pink-600', bg: 'bg-pink-50'}
    };

    const now = new Date();
    const timeStr = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
    const item = config[type];

    const li = document.createElement('li');
    li.className = `flex items-center p-3 mb-2 rounded-xl ${item.bg} animate-in fade-in slide-in-from-right-4 duration-300`;
    li.innerHTML = `
      <span class="text-xs font-mono font-bold text-gray-400 mr-3">${timeStr}</span>
      <span class="mr-2">${item.emoji}</span>
      <span class="text-sm font-bold ${item.color}">${dogName} ${item.text}</span>
    `;
    historyList.prepend(li);
  };
}
