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
});
