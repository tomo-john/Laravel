<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\AnimationController;

// 最初からあるやつ(あえて残す)
Route::get('/', function () {
    return view('welcome');
});

/**
 * 検証用ページ
 */
// Main Menu
Route::get('/menus', function() {
    return view('menus');
})->name('main_menu');

// Tailwind
Route::get('/tailwind', function() {
  return view('tailwind');
})->name('tailwind');

// Test
Route::get('/test', function() {
  return view('test');
})->name('test');

/**
 * 基本CRUD
 */
// Dogs
Route::get('/dogs/special', function() {
  return view('dogs.special');
})->name('dogs.special');
Route::get('dogs', [DogController::class, 'index'])->name('dogs.index');
Route::get('dogs/create', [DogController::class, 'create'])->name('dogs.create');
Route::post('dogs', [DogController::class, 'store'])->name('dogs.store');
Route::get('dogs/{dog}', [DogController::class, 'show'])->name('dogs.show');
Route::get('dogs/{dog}/edit', [DogController::class, 'edit'])->name('dogs.edit');
Route::put('dogs/{dog}', [DogController::class, 'update'])->name('dogs.update');
Route::delete('dogs/{dog}', [DogController::class, 'destroy'])->name('dogs.destroy');

// Tasks
Route::resource('tasks', TaskController::class);

// Monsters
Route::resource('monsters', MonsterController::class);

// Animation
Route::get('/animations/home', function() {
  return view('animations.home');
})->name('animations.home');
Route::resource('animations', AnimationController::class);

