<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dog;

class DogController extends Controller
{
  // index
  public function index()
  {
    // $dogs = Dog::all();
    // $dogs = Dog::where('user_id', Auth::id())->get();
    $dogs = auth()->user()->dogs;
    return view('dogs.index', compact('dogs'));
  }
  
  // create
  public function create()
  {
    $dog = new Dog();
    return view('dogs.create', compact('dog'));
  }
  
  // store
  public function store(Request $request)
  {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'age' => ['required', 'integer', 'min:0', 'max:100'],
        'color' => ['required', 'in:' . implode(',', array_keys(config('dog.colors')))],
        'favorite_food' => ['nullable', 'string', 'max:30'],
    ]);

    $validated['user_id'] = Auth::id();

    Dog::create($validated);
    return redirect()->route('dogs.index')->with('success', '登録しました');
  }

  // show
  public function show(Dog $dog)
  {
    return view('dogs.show', compact('dog'));
  }

  // edit
  public function edit(Dog $dog)
  {
    $this->authorize('update', $dog);

    return view('dogs.edit', compact('dog'));
  }
  // update
  public function update(Request $request, Dog $dog)
  {
    $this->authorize('update', $dog);

    $validated = $request->validate(
      [
        'name' => ['required', 'string', 'max:255'],
        'age' => ['required', 'integer', 'min:0', 'max:100'],
        'color' => ['required', 'in:' . implode(',', array_keys(config('dog.colors')))],
        'favorite_food' => ['nullable', 'string', 'max:30'],
      ]
    );
    $dog->update($validated);
    return redirect()->route('dogs.show', $dog)->with('success', '更新しました');
  }
  // destroy
  public function destroy(Dog $dog)
  {
    $this->authorize('delete', $dog);

    $dog->delete();
    return redirect()->route('dogs.index')->with('success', '削除しました');
  }
}
