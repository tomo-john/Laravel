import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
  console.log("animation.js loaded 🐶");

  // simple run
  const puniIcon      = document.getElementById('puni-icon');
  const puniContainer = document.getElementById('puni-container');
  const puniButton    = document.getElementById('puni-button');

  let position = 0;

  if (puniIcon && puniContainer && puniButton) {
    puniButton.addEventListener('click', () => {
      position = (position === 0) ? 700 : 0;
      puniContainer.style.transform = `translateX(${position}px)`;

      if (position === 0) {
        puniIcon.style.transform = `scaleX(-1)`;
      } else {
        puniIcon.style.transform = `scaleX(1)`;
      }
    });
  }

  // return run
  const runIcon      = document.getElementById('run-icon');
  const runContainer = document.getElementById('run-container');
  const runButton    = document.getElementById('run-button');

  let isWalking = false;

  if (runIcon && runContainer && runButton) {

    runButton.addEventListener('click', () => {
      if (isWalking) return;
      isWalking = true;

      runIcon.classList.add('animate-bounce');
      runContainer.style.transform = `translateX(700px) skewX(-15deg)`;
      runIcon.style.transform = `scale(1)`;

      setTimeout(() => {
        runIcon.style.transform = `scaleX(-1)`;
        runIcon.classList.remove('animate-bounce');
      }, 1200);

      setTimeout(() => {
        runContainer.style.transform = `translateX(0px)`;
      }, 1500);

      setTimeout(() => {
        runIcon.style.transform = `scaleX(1)`;
        isWalking = false;
      }, 2800);

    });
  }

  // Dog Icon Operation
  const dogIcon       = document.getElementById('dog-icon');
  const colorSelect   = document.getElementById('color-select');
  const colorDisplay  = document.getElementById('current-color-name');

  function updateDogIconColor() {
    const color = colorSelect.value;

    dogIcon.style.color = color;
    colorDisplay.textContent = color || "white";
  }

  if (dogIcon && colorSelect && colorDisplay) {
    colorSelect.addEventListener('change', updateDogIconColor);
  }

  // Dog Walking

  // 状態と位置を定義
  const dog = document.getElementById('walking-dog');

  let state = 'idle'; // idle | walk
  let posX = 0;
  let posY = 0;

  const STEP = 10;

  // 状態ごとのクラス管理
  const stateClasses = {
    idle: ['scale-100'],
    walk: ['scale-110'],
  };

  function setState(newState) {
    Object.values(stateClasses).flat().forEach(cls => {
      dog.classList.remove(cls);
    });

    stateClasses[newState].forEach(cls => {
      dog.classList.add(cls);
    });

    state = newState;
  }

  // 移動用の関数
  function moveDog(dx, dy, direction = 'right') {
    posX += dx;
    posY += dy;

    dog.style.transform = `
      translate(${posX}px, ${posY}px)
      scaleX(${direction === 'left' ? -1 : 1})
    `;

    setState('walk');

    // 一定時間後に idle に戻す
    clearTimeout(dog.idleTimer);
    dog.idleTimer = setTimeout(() => {
      setState('idle');
    }, 150);
  }

  // キー入力を拾う
  document.addEventListener('keydown', (e) => {
    switch (e.key) {
      case 'ArrowRight':
      case 'l':
        moveDog(STEP, 0, 'right');
        break;

      case 'ArrowLeft':
      case 'h':
        moveDog(-STEP, 0, 'left');
        break;

      case 'ArrowUp':
      case 'j':
        moveDog(0, -STEP);
        break;

      case 'ArrowDown':
      case 'k':
        moveDog(0, STEP);
        break;
    }
  });
});
