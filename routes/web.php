<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\AnimationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menus', function() {
    return view('menus');
})->name('main_menu');

Route::get('/tailwind', function() {
    return view('tailwind');
})->name('tailwind');

Route::get('/test', function() {
    return view('test');
})->name('test');

Route::get('/dogs/special', function() {
    return view('dogs.special');
})->name('dogs.special');
Route::middleware('auth')->group(function () {
  Route::get('dogs', [DogController::class, 'index'])->name('dogs.index');
  Route::get('dogs/create', [DogController::class, 'create'])->name('dogs.create');
  Route::post('dogs', [DogController::class, 'store'])->name('dogs.store');
  Route::get('dogs/{dog}', [DogController::class, 'show'])->name('dogs.show');
  Route::get('dogs/{dog}/edit', [DogController::class, 'edit'])->name('dogs.edit');
  Route::put('dogs/{dog}', [DogController::class, 'update'])->name('dogs.update');
  Route::delete('dogs/{dog}', [DogController::class, 'destroy'])->name('dogs.destroy');
});

Route::resource('tasks', TaskController::class);
Route::resource('monsters', MonsterController::class);

Route::get('/animations/home', function() {
    return view('animations.home');
})->name('animations.home');
Route::resource('animations', AnimationController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
