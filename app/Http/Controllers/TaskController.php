<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        $statusOptions = Task::getStatusOptions();
        return view('tasks.index', compact('tasks', 'statusOptions'));
    }

    public function create()
    {
        $task = new Task();
        $statusOptions = Task::getStatusOptions();
        return view('tasks.create', compact('task', 'statusOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
          [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required'],
          ]
        );
        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', '登録しました');
    }

    public function show(Task $task)
    {
        $statusOptions = Task::getStatusOptions();
        return view('tasks.show', compact('task', 'statusOptions'));
    }

    public function edit(Task $task)
    {
        $statusOptions = Task::getStatusOptions();
        return view('tasks.edit', compact('task', 'statusOptions'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate(
          [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required'],
          ]
        );
        $task->update($validated);
        return redirect()->route('tasks.index', $task)->with('success', '更新しました');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', '削除しました');

    }
}
