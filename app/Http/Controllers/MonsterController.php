<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MonsterController extends Controller
{
    public function index()
    {
        $monsters = Monster::all();
        return view('monsters.index', compact('monsters'));
    }

    public function create()
    {
        $monster = new Monster();
        return view('monsters.create', compact('monster'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'cost' => ['required', 'integer', 'min:0', 'max:1000'],
                'color' => ['required', Rule::in(array_keys(config('monster.colors')))],
                'quantity' => ['required', 'integer', 'min:0', 'max:1000'],
                'memo' => ['max:255'],
            ]
        );
        Monster::create($validated);
        return redirect()->route('monsters.index')->with('success', '登録しました');
    }

    public function show(Monster $monster)
    {
        // 今回は使用しない
    }

    public function edit(Monster $monster)
    {
        return view('monsters.edit', compact('monster'));
    }

    public function update(Request $request, Monster $monster)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'cost' => ['required', 'integer', 'min:0', 'max:1000'],
                'color' => ['required', Rule::in(array_keys(config('monster.colors')))],
                'quantity' => ['required', 'integer', 'min:0', 'max:1000'],
                'memo' => ['max:255'],
            ]
        );
        $monster->update($validated);
        return redirect()->route('monsters.index')->with('success', '更新しました');
        
    }

    public function destroy(Monster $monster)
    {
        $monster->delete();
        return redirect()->route('monsters.index')->with('success', '削除しました');
    }
}
