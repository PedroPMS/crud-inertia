<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\StoreRequest;
use App\Http\Requests\Todo\UpdateRequest;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TodoController extends Controller
{
    public function index(): Response
    {
        $todos = Todo::all();
        return Inertia::render('Todo/Index', ['todos' => $todos]);
    }

    public function create(): Response
    {
        return Inertia::render('Todo/Create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        Todo::create($request->validated());
        return redirect()->route('todos.index')->with('message', 'Todo Created Successfully');
    }

    public function edit(Todo $todo): Response
    {
        return Inertia::render('Todo/Edit', ['todo' => $todo]);
    }

    public function update(Todo $todo, UpdateRequest $request): RedirectResponse
    {
        $todo->update($request->validated());
        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo): RedirectResponse
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('message', 'Todo Deleted Successfully');
    }
}
