<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DogStoreRequest;
use App\Models\Dog;

class DogController extends Controller
{
  // index
  public function index()
  {
    $this->authorize('viewAny', Dog::class);

    if (auth()->user()->isAdmin()) {
      $dogs = Dog::all();
    } else {
      $dogs = auth()->user()->dogs;
    }
    return view('dogs.index', compact('dogs'));
  }
  
  // create
  public function create()
  {
    $dog = new Dog();
    return view('dogs.create', compact('dog'));
  }
  
  // store
  public function store(DogStoreRequest $request)
  {
    $validated = $request->validated();
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
  public function update(DogStoreRequest $request, Dog $dog)
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
