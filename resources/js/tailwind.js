import './bootstrap';

// 読み込み確認
console.log("Vite経由でJSが動いている🐶");

// 特定のIDを持つ要素を操作する練習 
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('magic-btn');
  const text = document.getElementById('magic-text');

  if (btn && text) {
    btn.addEventListener('click', () => {
      text.innerText = "JavaScript特訓中！🐶🔥";
      text.style.color = "arange";
    })
  }
});

